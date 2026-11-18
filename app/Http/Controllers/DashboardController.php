<?php

namespace App\Http\Controllers;

use App\Models\PackingReport;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $isUser = auth()->user()->role === 'user';

        $packingQuery = PackingReport::query();
        if ($isUser) {
            $packingQuery->where('user_id', $userId);
        }

        $totalPacking = (clone $packingQuery)->sum('quantity');
        $totalReports = (clone $packingQuery)->count();
        $todayPacking = (clone $packingQuery)->whereDate('packing_date', today())->sum('quantity');
        $monthPacking = (clone $packingQuery)->whereBetween('packing_date', [now()->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()])->sum('quantity');
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();

        $chartQuery = PackingReport::select(
            DB::raw('DATE(packing_date) as date'),
            DB::raw('SUM(quantity) as total')
        );

        if ($isUser) {
            $chartQuery->where('user_id', $userId);
        }

        $rawChartData = $chartQuery->whereDate('packing_date', '>=', now()->subDays(6)->toDateString())
            ->groupBy('date')->orderBy('date')->pluck('total', 'date');

        $chartData = collect(range(6, 0))->map(function ($daysAgo) use ($rawChartData) {
            $date = Carbon::today()->subDays($daysAgo)->toDateString();
            return ['date' => $date, 'total' => (int) ($rawChartData[$date] ?? 0)];
        });

        return view('dashboard', compact('totalPacking', 'totalReports', 'todayPacking', 'monthPacking', 'totalProducts', 'totalUsers', 'chartData'));
    }
}
