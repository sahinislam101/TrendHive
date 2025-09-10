<?php

namespace App\Http\Controllers\ClientController;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
    $sliders = Slider::where('status',1)->latest()->get();
    $categories = Category::where('status',1)->latest()->take(8)->get();
    $brands = Brand::where('status',1 )->get();
    //products
        $flash_sales = Product::where('status',1)->where('flash_sales',1)->get();
        $best_sell = Product::where('status',1)->where('best_sell',1)->get();
        return Inertia::render('Home',[
            'sliders' => $sliders,
            'categories' => $categories,
            'brands' => $brands,
            'flash_sales' => $flash_sales,
            'best_sell' => $best_sell,
        ]);
    }

    public function allproducts(Request $request)
{
    $query = Product::where('status', 1);

    // Min Price Filter
    if ($request->filled('minPrice')) {
        $query->where('selling_price', '>=', $request->minPrice);
    }

    // Max Price Filter
    if ($request->filled('maxPrice')) {
        $query->where('selling_price', '<=', $request->maxPrice);
    }

    // Sorting
    if ($request->sort === 'low') {
        $query->orderBy('selling_price', 'asc');
    } elseif ($request->sort === 'high') {
        $query->orderBy('selling_price', 'desc');
    }

    // Pagination
    $products = $query->paginate(15)->withQueryString();

    return Inertia::render('client_pages/view_all/AllProduct', [
        'products' => $products
    ]);
}

//  
    public function allcategories(){
        $categories = Category::where('status',1)->get();
        return Inertia::render('client_pages/view_all/AllCategory',[
            'categories' => $categories,
        ]);
    }

    public function allbrads(){
        $brands = Brand::where('status',1)->get();
        return Inertia::render('client_pages/view_all/AllBrand',[
            'brands' => $brands,
        ]);
    }
}
