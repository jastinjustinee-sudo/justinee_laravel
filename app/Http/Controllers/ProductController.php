<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string|max:50|unique:products,product_code',
            'product_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_code' => 'required|string|max:50|unique:products,product_code,' . $product->id,
            'product_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Data produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->packingReports()->exists()) {
            return back()->with('error', 'Produk tidak dapat dihapus karena sudah digunakan pada laporan packing.');
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
