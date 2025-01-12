<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;


class ReportsController extends Controller
{
    public function index()
    {
        $salesData = DB::table('sales')
        ->join('products', 'sales.product_id', '=', 'products.id')
        ->select(
            'products.name',
            DB::raw('SUM(sales.quantity) as total_quantity'),
            DB::raw('SUM(sales.total_price) as total_sales')
        )
        ->groupBy('sales.product_id', 'products.name')
        ->get();
    
    }
}
