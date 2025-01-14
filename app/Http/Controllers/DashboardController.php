<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Check if the user is authenticated
            $user = Auth::user();
            
            // Perform role checks based on 'name' column
            if ($user) {
                if ($user->name === 'admin') {
                    // Admin can access everything
                    return $next($request);
                } elseif ($user->name === 'supplier') {
                    // Supplier can only access certain routes
                    if ($request->is('products*') || $request->is('dashboard')) {
                        return $next($request);
                    }
                } elseif ($user->name === 'customer') {
                    // Customer can only access sales
                    if ($request->is('sales*')) {
                        return $next($request);
                    }
                }
            }

            // If role is not matched, return access denied
            abort(403, 'Unauthorized access.');
        });
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Low Stock Products
        $lowStockProducts = Product::where('stock', '<', 10)->get();

        // Sales data for the last week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Get total sales for the week
        $weeklySalesTotal = Sale::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('total_price');

        // Get the total number of products sold this week
        $weeklySalesCount = Sale::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('quantity');

        // Get the top-selling product of the week
        $topSellingProduct = Sale::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->select('product_id', \DB::raw('sum(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->first();

        if ($topSellingProduct) {
            $topSellingProduct = Product::find($topSellingProduct->product_id);
        }

        return view('dashboard', [
            'lowStockProducts' => $lowStockProducts,
            'weeklySalesTotal' => $weeklySalesTotal,
            'weeklySalesCount' => $weeklySalesCount,
            'topSellingProduct' => $topSellingProduct,
        ]);
    }
}


