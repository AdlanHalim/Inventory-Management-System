<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Sale;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }
    
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock, 
            'image' => $imagePath,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }
    
    

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = Product::findOrFail($id);

    // Update product details
    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->stock = $request->input('stock');

    // Handle image upload (if a new image is uploaded)
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        // Store new image
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

    $product->save(); // Save changes to database

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}

    

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
