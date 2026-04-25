<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
//tambahan
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

use Illuminate\Support\Facades\Route;

Route::get('/about', [AboutController::class, 'index'])->middleware(['auth', 'verified'])->name('about');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource otomatis membuatkan rute index, create, store, edit, update, dan destroy
    Route::resource('category', CategoryController::class);

    // Product Page
    Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function () {
        
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/create', 'create')->name('create');
        Route::get('/export', 'export')->name('export')->middleware('can:export-product');
        
        Route::get('/{id}', 'show')->name('show');
        Route::get('/edit/{product}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });
});

require __DIR__.'/auth.php';