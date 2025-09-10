<?php

namespace App\Http\Controllers\ClientController;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryViewController extends Controller
{
    public function show(Request $request, $slug)
    {
        $categories = Category::where('status', 1)->get();
        $category = Category::where('slug', $slug)->firstOrFail();

        $query = $category->products()->where('status', 1);

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

        return Inertia::render('client_pages/view_all/CategoryProduct', [
            'category'    => $category,
            'products' => $products,
            'categories'   => $categories,
            'filters'  => [
                'min'  => $request->min,
                'max'  => $request->max,
                'sort' => $request->sort ?? 'default',
            ],
        ]);
    }
}
