<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    //Brands
    Route::get('brands', [BrandController::class, 'index'])->name('brands');
    Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::get('brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::post('brands', [BrandController::class, 'store'])->name('brands.store');
    Route::put('brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('brands/dellete/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

    //Discounts
    Route::get('discounts', [DiscountController::class, 'index'])->name('discounts');
    Route::get('discounts/create', [DiscountController::class, 'create'])->name('discounts.create');
    Route::get('discounts/{discount}/edit', [DiscountController::class, 'edit'])->name('discounts.edit');
    Route::post('discounts', [DiscountController::class, 'store'])->name('discounts.store');
    Route::put('discounts/{discount}', [DiscountController::class, 'update'])->name('discounts.update');
    Route::delete('discounts/dellete/{discount}', [DiscountController::class, 'destroy'])->name('discounts.destroy');

    // Products
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('products/table', [ProductController::class, 'table'])->name('products.table');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/dellete/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
});
