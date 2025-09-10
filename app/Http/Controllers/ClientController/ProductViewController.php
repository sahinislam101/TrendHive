<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductViewController extends Controller
{
    public function show($slug) {
        $product = Product::where('slug', $slug)
            ->with(['category', 'brand']) // only relations needed
            ->firstOrFail();

        $relatedItems = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return Inertia::render('client_pages/view_all/ProductShow', [
            'product' => $product,
            'relatedItems' => $relatedItems,
        ]);
    }
}

