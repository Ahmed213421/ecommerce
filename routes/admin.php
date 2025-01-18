<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'admin'],
        'as' => 'admin.'
    ], function(){

        Route::get('/index',function(){
            return view('dashboard.empty');
        })->name('dashboard');
        Route::resource('category', Admin\CategoryController::class);
        Route::resource('subcategory', Admin\SubCategoryController::class);

        Route::resource('products', Admin\ProductController::class);
        Route::resource('slider',Admin\SlideController::class);

        Route::resource('review',Admin\ReviewController::class);
        Route::post('changeStatus/{id}',Admin\ChangeStatusContnroller::class)->name('stauts.change');
        Route::resource('setting', Admin\SettingController::class);


});

require __DIR__.'/auth.php';
