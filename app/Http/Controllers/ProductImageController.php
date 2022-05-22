<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|file',
        ]);

        $path = Storage::disk('product-images')->putFile('product-images', $request->file('image'));

        $product->update([
            'image' => $path,
        ]);

        return response()->json([
            'product_id' => $product->id,
        ]);
    }
}
