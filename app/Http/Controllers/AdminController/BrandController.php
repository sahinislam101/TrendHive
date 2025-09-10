<?php

namespace App\Http\Controllers\AdminController;

use Inertia\Inertia;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\Brand\StoreBrandRequest as StoreBrandRequest;
use App\Http\Requests\AdminRequest\Brand\UpdateBrandRequest as UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search','');
        $status = $request->input('status','');

        $query = Brand::query();

        if($search){
            $query->where('name','like','%'.$search.'%');
        }

        if($status === 'active'){
            $query->where('status',true);
        }elseif($status === 'inactive'){
            $query->where('status',false);
        }

        $brands = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $filters = [
            $search => 'search',
            $status => 'status'
        ];

        return Inertia::render('admin_pages/brand/Index',[
            'brands' => $brands,
            'filters' => $filters,
        ]);

    }  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin_pages/brand/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        Brand::create($request->validated());

        return redirect('brands');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return Inertia::render('admin_pages/brand/Edit',[
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());

        return redirect('brands');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
    }
}
