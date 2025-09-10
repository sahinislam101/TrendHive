<?php

namespace App\Http\Controllers\ClientController;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandViewController extends Controller
{
    public function show(Request $request, $slug)
    {
        $brands = Brand::where('status', 1)->get();
        $brand = Brand::where('slug', $slug)->firstOrFail();

        $query = $brand->products()->where('status', 1);

        if ($request->filled('min')) {
            $query->where('selling_price', '>=', $request->min);
        }

        if ($request->filled('max')) {
            $query->where('selling_price', '<=', $request->max);
        }

        if ($request->sort === 'low') {
            $query->orderBy('selling_price', 'asc');
        } elseif ($request->sort === 'high') {
            $query->orderBy('selling_price', 'desc');
        }

        $products = $query->paginate(12)->withQueryString();

        return Inertia::render('client_pages/view_all/BrandProduct', [
            'brand'    => $brand,
            'products' => $products,
            'brands'   => $brands,
            'filters'  => [
                'min'  => $request->min,
                'max'  => $request->max,
                'sort' => $request->sort ?? 'default',
            ],
        ]);
    }
}
