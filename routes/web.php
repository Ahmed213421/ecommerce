<?php

use App\Http\Controllers\AccountSettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutCancelController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CheckoutSuccessController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\WishList;
use App\Models\Order;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Session;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/shop',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'as' => 'customer.',
    ], function(){

        Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store'])->name('store.register');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');

    Route::resource('settings' , AccountSettingController::class)->only('index','update','destroy')->middleware('auth');



        Route::get('/', function () {
            $categories = Category::all();
            return view('welcome',['categories' => $categories]);
        })->name('home');

        Route::get('/checkout-success/{status}' , CheckoutSuccessController::class)->name('checkout-success');
        Route::get('/checkout-cancel/{status}' , CheckoutCancelController::class)->name('checkout-cancel');



        Route::resource('product',ProductController::class)->only('index','show')->parameters([
            'product' => 'slug'
        ]);;
        Route::resource('/category', CategoryController::class)->only('index','show')->parameters([
            'category' => 'slug'
        ]);;
        Route::get('shop',ShopController::class)->name('shop');
        Route::resource('subcategory',SubCategoryController::class)->only('index','show')->parameters([
            'subcategory' => 'slug'
        ]);;
        Route::resource('review',ReviewController::class)->only('index','store');
        Route::post('search',SearchController::class)->name('search');
        Route::post('addproduct/',[CartController::class , 'addToCart'])->name('cart.product.add');
        Route::resource('cart',CartController::class);
        Route::resource('check-out',CheckOutController::class)->only('index','store')->middleware('auth');
        Route::resource('wishlist',WishList::class)->middleware('auth');

        Route::view('orders', 'shop.orders.show');
        Route::post('/favorites/toggle/{id}', FavoriteController::class)->name('favorites.toggle');

        Route::any('{any}', function () {
            return view('shop.errorpage');
        })->where('any', '.*');


    });

    Route::get('select/{id}/subcategory', function ($id) {
        $locale = app()->getLocale();

        $jobs = Subcategory::where('category_id', $id)
            ->get()
            ->map(function ($job) use ($locale) {
                return [
                    'id' => $job->id,
                    'name' => $job->getTranslation('name', $locale),
                ];
            });

        return response()->json($jobs);
    });

    Route::view('home', 'welcome')->name('home');






require __DIR__.'/auth.php';
