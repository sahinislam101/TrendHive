<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function product(){
        $flash_sales = Product::where('status',1)->where('flash_sales',1)->get();
        return Inertia::render('About',[
            'flash_sales' =>$flash_sales,
        ]);
    }
}
