<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('test',function(){
    echo 'test';
});

Route::prefix('admin')->group(function(){
    Route::prefix('categories')->group(function(){
        Route::get('test',function(){
            echo 'test';
        });
    });
});

Route::prefix('admin')->group(function(){
    Route::prefix('categories')->group(function(){
        Route::get('',[CategoriesController::class,'all'])->name('admin.categories.all');
        Route::get('create',[CategoriesController::class,'create'])->name('admin.categories.create');
        Route::post('',[CategoriesController::class,'store'])->name('admin.categories.store');
    });
});
