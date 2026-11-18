<?php

namespace App\Http\Controllers;

use App\Models\PackingReport;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PackingReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = $this->filteredQuery($request)->latest('packing_date')->latest('id')->paginate(10)->withQueryString();
        $products = Product::all();

        return view('packing.index', compact('reports', 'products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('packing.create', compact('products'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (menggunakan product_name)
        $request->validate([
            'product_name' => 'required|string|max:255',
            'packing_date' => 'required|date',
            'quantity'     => 'required|integer|min:1',
            'notes'        => 'nullable|string',
        ]);

        // 2. Trik Cerdas: Cari produk berdasarkan nama, jika belum ada otomatis buat baru di DB
        $productInput = trim($request->product_name);
        
        // Membersihkan format jika user memilih dari saran datalist ("PRD-001 - Nama Produk")
        if (str_contains($productInput, ' - ')) {
            $parts = explode(' - ', $productInput, 2);
            $productName = $parts[1];
            $product = Product::where('product_code', $parts[0])->first();
        } else {
            $productName = $productInput;
            $product = Product::where('product_code', $productInput)
                ->orWhere('product_name', $productInput)
                ->first();
        }

        $product ??= Product::firstOrCreate(
            ['product_name' => $productName], ['product_code' => $this->nextProductCode()]
        );

        // 3. Simpan Laporan Packing
        PackingReport::create([
            'user_id'      => auth()->id(),
            'product_id'   => $product->id,
            'packing_date' => $request->packing_date,
            'quantity'     => $request->quantity,
            'status'       => 'completed',
            'notes'        => $request->notes,
        ]);

        return redirect()->route('packing.index')->with('success', 'Laporan packing harian berhasil disimpan.');
    }

    public function edit(PackingReport $packing)
    {
        if (auth()->user()->role === 'user' && $packing->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $products = Product::all();
        return view('packing.edit', compact('packing', 'products'));
    }

    public function update(Request $request, PackingReport $packing)
    {
        if (auth()->user()->role === 'user' && $packing->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'packing_date' => 'required|date',
            'quantity'     => 'required|integer|min:1',
            'notes'        => 'nullable|string',
        ]);

        $packing->update([
            'product_id'   => $request->product_id,
            'packing_date' => $request->packing_date,
            'quantity'     => $request->quantity,
            'notes'        => $request->notes,
        ]);

        return redirect()->route('packing.index')->with('success', 'Laporan packing berhasil diperbarui.');
    }

    public function destroy(PackingReport $packing)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $packing->delete();
        return redirect()->route('packing.index')->with('success', 'Laporan packing berhasil dihapus.');
    }

    public function exportExcel(Request $request): StreamedResponse
    {
        $reports = $this->filteredQuery($request)->latest('packing_date')->get();
        $filename = 'laporan-packing-' . now()->format('Ymd-His') . '.csv';

        return response()->streamDownload(function () use ($reports) {
            $handle = fopen('php://output', 'w');
            // UTF-8 BOM keeps Indonesian characters readable in Microsoft Excel.
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['Tanggal', 'Operator', 'Kode Produk', 'Nama Produk', 'Jumlah', 'Status', 'Catatan'], ';');
            foreach ($reports as $report) {
                fputcsv($handle, [
                    $report->packing_date, $report->user->name, $report->product->product_code,
                    $report->product->product_name, $report->quantity, $report->status, $report->notes,
                ], ';');
            }
            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function exportPdf(Request $request)
    {
        $reports = $this->filteredQuery($request)->latest('packing_date')->get();
        return view('packing.print', compact('reports'));
    }

    private function filteredQuery(Request $request)
    {
        $query = PackingReport::with(['user', 'product']);
        if (auth()->user()->role === 'user') {
            $query->where('user_id', auth()->id());
        }
        if ($request->filled('start_date')) {
            $query->whereDate('packing_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('packing_date', '<=', $request->end_date);
        }
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }
        return $query;
    }

    private function nextProductCode(): string
    {
        do {
            $code = 'PRD-' . strtoupper(str()->random(6));
        } while (Product::where('product_code', $code)->exists());
        return $code;
    }
}
