<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon; // Keep this line here!

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Calculate total cash income
        $totalCashIncome = Sale::sum('total_price');

        // Sales Analytics - Filter by date range
        // Get dates from request or default to last 30 days
        $startDateInput = $request->input('start_date', Carbon::now()->subDays(30)->toDateString());
        $endDateInput = $request->input('end_date', Carbon::now()->toDateString());

        // Parse inputs into Carbon instances for consistency and formatting
        $startDate = Carbon::parse($startDateInput);
        $endDate = Carbon::parse($endDateInput);

        $salesQuery = Sale::whereBetween('created_at', [$startDate->toDateString() . ' 00:00:00', $endDate->toDateString() . ' 23:59:59']);

        $totalSalesPeriod = $salesQuery->sum('total_price');
        $totalItemsSoldPeriod = $salesQuery->sum('quantity');
        $numberOfTransactionsPeriod = $salesQuery->count();

        // Top Selling Products (simple, based on quantity sold in the period)
        $topSellingProducts = Sale::select('product_id')
            ->selectRaw('SUM(quantity) as total_quantity_sold')
            ->whereBetween('created_at', [$startDate->toDateString() . ' 00:00:00', $endDate->toDateString() . ' 23:59:59'])
            ->groupBy('product_id')
            ->orderByDesc('total_quantity_sold')
            ->with('product') // Eager load product details
            ->limit(5)
            ->get();

        // Low Stock Products
        $lowStockProducts = Product::where('stock', '<=', 10)->orderBy('stock')->get();

        return view('dashboard.index', compact(
            'totalCashIncome',
            'totalSalesPeriod',
            'totalItemsSoldPeriod',
            'numberOfTransactionsPeriod',
            'topSellingProducts',
            'lowStockProducts',
            'startDate', // Pass the Carbon instances
            'endDate'    // Pass the Carbon instances
        ));
    }
}