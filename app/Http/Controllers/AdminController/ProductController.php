<?php

namespace App\Http\Controllers\AdminController;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\Product\StoreProductRequest as StoreProductRequest;
use App\Http\Requests\AdminRequest\Product\UpdateProductRequest as UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search','');
        $status = $request->input('status','');

        $query = Product::query();

        if($search){
            $query->where('name','like','%'.$search.'%');
        }

        if($status === 'active'){
            $query->where('status',true);
        }elseif($status === 'inactive'){
            $query->where('status',false);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $filters = [
            $search => 'search',
            $status => 'status'
        ];

        return Inertia::render('admin_pages/product/Index',[
            'products' => $products,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin_pages/product/Create',[
            'categories' => Category::select('id','name')->get(),
            'brands' => Brand::select('id','name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());

        return redirect('products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('admin_pages/product/Edit',[
            'product'=>$product,
            'flash_sales' => $product->flash_sales,
            'best_sell' => $product->best_sell,
            'categories' => Category::select('id', 'name')->get(),
            'brands' => Brand::select('id','name')->get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

       return redirect('products');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('products');
    }
} 
