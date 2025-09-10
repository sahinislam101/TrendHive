<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController\BrandController;
use App\Http\Controllers\ClientController\HomeController;
use App\Http\Controllers\AdminController\SliderController;
use App\Http\Controllers\ClientController\AboutController;
use App\Http\Controllers\AdminController\ProductController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\ClientController\BrandViewController;
use App\Http\Controllers\ClientController\ProductViewController;
use App\Http\Controllers\ClientController\CategoryViewController;

Route::get('/',[HomeController::class,'index'])->name('home');

// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Admin Route
Route::resource('sliders', SliderController::class);
Route::resource('categories', CategoryController::class);
Route::resource('brands', BrandController::class);
Route::resource('products', ProductController::class);


// product cart demo 
Route::get('/about',[AboutController::class, 'product']);

// view all route
Route::get('/allproducts',[HomeController::class,'allproducts'])->name('product.all');
Route::get('/allcategories',[HomeController::class, 'allcategories'])->name('categories.all');
Route::get('/allbrads',[HomeController::class, 'allbrads'])->name('brands.all');
Route::get('/category/{slug}', [CategoryViewController::class, 'show'])->name('categories.show');
Route::get('/brand/{slug}',[BrandViewController::class, 'show'])->name('brands.show');
Route::get('product/{slug}', [ProductViewController::class, 'show'])->name('products.show');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
