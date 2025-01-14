<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        // Calculate total revenue
        $totalRevenue = Sale::sum('total_price'); // Sum of total_price from sales table
        
        // Calculate total sales (the number of sales transactions)
        $totalSales = Sale::count(); // Count the total number of sales records

        // Fetch sales data by product
        $salesByProduct = DB::table('sales')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->select(
                'products.name as product_name',
                DB::raw('SUM(sales.quantity) as total_quantity'),
                DB::raw('SUM(sales.total_price) as total_revenue')
            )
            ->groupBy('sales.product_id', 'products.name')
            ->get();

        // Fetch weekly sales data (grouping by week)
        $weeklySales = DB::table('sales')
            ->selectRaw('YEARWEEK(sales.created_at) as week, SUM(sales.total_price) as total_revenue, SUM(sales.quantity) as total_sales')
            ->groupBy(DB::raw('YEARWEEK(sales.created_at)'))
            ->orderBy(DB::raw('YEARWEEK(sales.created_at)'), 'desc')
            ->get();

        // Pass the data to the view
        return view('reports.index', compact('totalRevenue', 'totalSales', 'salesByProduct', 'weeklySales'));
    }
}


