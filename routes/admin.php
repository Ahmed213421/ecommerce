<?php

use App\Events\NewUserRegisteredEvent;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin;
use App\Models\User;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'admin'],
        'as' => 'admin.'
    ], function(){

        Route::get('/index',Admin\HomeController::class)->name('dashboard');
        Route::resource('category', Admin\CategoryController::class);
        Route::resource('subcategory', Admin\SubCategoryController::class);

        Route::resource('products', Admin\ProductController::class);
        Route::resource('slider',Admin\SlideController::class)->only('index','store','update','destroy');

        Route::resource('testmonials',Admin\TestmonialController::class)->only('index','update','destroy');
        Route::resource('review',Admin\ReviewController::class)->only('index','update','destroy');
        Route::post('changeStatus/{id}',Admin\ChangeStatusController::class)->name('stauts.change');
        Route::resource('setting', Admin\SettingController::class);
        Route::resource('profile/settings', Admin\ProfileSettingController::class)->names('profile')->only('index','update','destroy');
        Route::delete('news/deleteAll', [Admin\PostController::class,'deleteAll'])->name('news.deleteAll');
        Route::resource('news', Admin\PostController::class);
        Route::resource('subscribers', Admin\SubscriberController::class)->only('index');
        Route::resource('comments', Admin\CommentController::class);
        Route::resource('orders', Admin\OrderController::class)->only('index','destroy');
        Route::resource('tags', Admin\TagController::class)->only('index','store','update','destroy');
        Route::post('/notifications/mark-all-read', Admin\NotificationReadController::class)->name('notifications.markAllRead');
        Route::get('/notifications/clear-all', Admin\ClearNotificationController::class)->name('notifications.clear');
        Route::get('search/{search}',Admin\SearhController::class)->name('search');
        Route::resource('contact',Admin\ContactController::class)->only('index','destroy');
        Route::resource('customers',Admin\CustomersController::class);

        Route::fallback(function () {
            return response()->view('dashboard.errorpage', [], 404);
        });

        Route::get('dis',function(){
            $user = User::find(1);
            broadcast(new NewUserRegisteredEvent($user));

            return 'done';;
        });
});



Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/dashboard',
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'admin'],
    'as' => 'admin.',
], function(){

    Route::resource('permissions', Admin\PermissionController::class);

    Route::get('roles/{roleId}/delete', [Admin\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [Admin\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [Admin\RoleController::class, 'givePermissionToRole']);
    Route::resource('roles', Admin\RoleController::class);

    Route::get('users/{userId}/delete', [Admin\AdminController::class, 'destroy']);
    Route::resource('users', Admin\AdminController::class);

});

require __DIR__.'/auth.php';
