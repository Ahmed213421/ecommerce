<?php

use App\Http\Controllers\AccountSettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeactiveController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WelcomeController;
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
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReplyCommentController;
use App\Http\Controllers\TestmonialController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WishList;
use App\Mail\NewPostMail;
use App\Mail\TestMail;
use App\Models\Order;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('register', [RegisteredUserController::class, 'store'])->name('store.register');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');



    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');

    Route::resource('settings' , AccountSettingController::class)->only('index','update','destroy')->middleware('auth');

    Route::get('/',[WelcomeController::class, 'index'])->name('home');



        // Route::get('/', function () {
        //     $categories = Category::all();
        //     return view('welcome',['categories' => $categories]);
        // })->name('home');

        Route::get('/checkout-success/{status}' , CheckoutSuccessController::class)->name('checkout-success');
        Route::get('/checkout-cancel/{status}' , CheckoutCancelController::class)->name('checkout-cancel');



        Route::resource('product',ProductController::class)->only('index','show')->parameters([
            'product' => 'slug'
        ]);
        Route::resource('/category', CategoryController::class)->only('index','show')->parameters([
            'category' => 'slug'
        ]);
        Route::get('shop',ShopController::class)->name('shop');
        Route::resource('subcategory',SubCategoryController::class)->only('index','show')->parameters([
            'subcategory' => 'slug'
        ]);
        Route::resource('testmonials',TestmonialController::class)->only('index','store');
        Route::resource('reviews',ReviewController::class)->only('index','store');
        Route::get('search/{search}',SearchController::class)->name('search');
        Route::post('addproduct/',[CartController::class , 'addToCart'])->name('cart.product.add');
        Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

        Route::resource('cart',CartController::class)->only('edit','index','destroy','update');
        Route::resource('check-out',CheckOutController::class)->only('index','store')->middleware('auth');
        Route::resource('wishlist',WishList::class)->only('index')->middleware('auth');

        Route::resource('contact/us',ContactUsController::class)->only('index','store');
        Route::resource('orders',OrderController::class)->only('index','destroy');

        Route::post('/favorites/toggle/{id}', FavoriteController::class)->name('favorites.toggle');

        Route::resource('subscribe',SubscriptionController::class)->only(['store']);
        Route::resource('news',NewsController::class)->only('index','show')->parameters([
            'news' => 'slug'
        ]);
        Route::resource('comments',CommentController::class)->only(['store']);
        Route::resource('reply',ReplyCommentController::class)->only(['store']);
        Route::get('deactive',DeactiveController::class)->name('deactive');

        Route::fallback(function () {
            return response()->view('shop.errorpage', [], 404);
        });


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

    // Route::view('home', 'welcome')->name('home');


    Route::get('/unsubscribe/{token}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

require __DIR__.'/auth.php';
