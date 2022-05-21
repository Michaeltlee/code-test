<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Product::all()->toArray());
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'description' => 'required|string',
            'price'       => 'required|int',
            'image'       => 'file',
        ]);

        $product = Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $request->image,
        ]);

        return response()->json([
            'product_id' => $product->id,
        ]);
    }

    public function show(Request $request, Product $product)
    {
        return response()->json($product->toArray());
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string',
            'description' => 'required|string',
            'price'       => 'required|int',
            'image'       => 'file',
        ]);

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $request->image,
        ]);

        return response()->json([
            'product_id' => $product->id,
        ]);
    }

    public function delete(Request $request, Product $product)
    {
        $productId = $product->id;

        $product->delete();

        return response()->json([
            'product_id' => $productId,
        ]);
    }
}