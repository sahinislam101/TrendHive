<?php

namespace App\Http\Controllers\AdminController;

use Inertia\Inertia;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\Slider\StoreSliderRequest as StoreSliderRequest;
use App\Http\Requests\AdminRequest\Slider\UpdateSliderRequest as UpdateSliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search','');
        $status = $request->input('status','');

        $query = Slider::query();

        if($search){
            $query->where('name', 'like', '%' . $search . '%');
        }

        if($status === 'active'){
            $query->where('status',true);
        }elseif($status === 'inactive'){
            $query->where('status',false);
        }

        $sliders = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $filters = [
            $search => 'search',
            $status => 'status'
        ];

        return Inertia::render('admin_pages/slider/Index',[
            'sliders' => $sliders,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin_pages/slider/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        Slider::create($request->validated());

        return redirect('sliders');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return Inertia::render('admin_pages/slider/Edit',[
            'slider' => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $slider->update($request->validated());

        return redirect('/sliders');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect('/sliders');
    }
}
