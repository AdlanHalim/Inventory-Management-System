<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Sale;

class SalesController extends Controller
{
    public function index()
    {
        // Retrieve all sales with associated product data
        $sales = Sale::with('product')->get();
        $products = Product::all();

        return view('sales.index', compact('sales', 'products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Retrieve the product
        $product = Product::findOrFail($request->product_id);
    
        // Check if there's enough stock
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock for this product.');
        }
    
        // Calculate total price
        $totalPrice = $product->price * $request->quantity;
    
        // Create the sale
        $sale = Sale::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);
    
        // Deduct stock from the product
        $product->decrement('stock', $request->quantity);
    
        return redirect()->route('sales.index')->with('success', 'Sale created successfully, and stock updated.');
    }

    public function report()
    {
        // Total revenue and total sales count
        $totalRevenue = Sale::sum('total_price');
        $totalSales = Sale::sum('quantity');

        // Sales by product
        $salesByProduct = Sale::selectRaw('products.name as product_name, SUM(sales.quantity) as total_quantity, SUM(sales.total_price) as total_revenue')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->groupBy('sales.product_id', 'products.name')
            ->get();

        return view('reports.index', compact('totalRevenue', 'totalSales', 'salesByProduct'));
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale record deleted successfully!');
    }
}


