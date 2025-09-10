<?php

namespace App\Http\Controllers\AdminController;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\Category\StoreCategoryRequest as StoreCategoryRequest;
use App\Http\Requests\AdminRequest\Category\UpdateCategoryRequest as UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search','');
        $status = $request->input('status','');

        $query = Category::query();

        if($search){
            $query->where('name','like','%'.$search.'%');
        }

        if($status === 'active'){
            $query->where('status',true);
        }elseif($status === 'inactive'){
            $query->where('status',false);
        }

        $categories = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $filters = [
            $search => 'search',
            $status => 'status'
        ];

        return Inertia::render('admin_pages/category/Index',[
            'categories' => $categories,
            'filters' => $filters,
        ]);

    }   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin_pages/category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect('categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('admin_pages/category/Edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
