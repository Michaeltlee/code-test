<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'products' => auth()->user()->products()->get()->toArray(),
        ]);
    }

    public function create(Request $request, Product $product)
    {
        if (!auth()->user()->canAddProduct()) {
            throw new \Exception('User must have an active subscription in order to add a product.');
        }

        auth()->user()->products()->attach($product->id);

        return response()->json([
            'product_id' => $product->id,
        ]);
    }

    public function delete(Request $request, Product $product)
    {
        $productId = $product->id;

        auth()->user()->products()->detach($product->id);

        return response()->json([
            'product_id' => $productId,
        ]);
    }
}
