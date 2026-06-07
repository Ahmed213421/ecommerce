<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Admin Repository Contracts and Implementations
use App\Repositories\Admin\Contracts\AdminContract;
use App\Repositories\Admin\SQL\AdminRepository;
use App\Repositories\Admin\Contracts\PermissionContract;
use App\Repositories\Admin\SQL\PermissionRepository;
use App\Repositories\Admin\Contracts\RoleContract;
use App\Repositories\Admin\SQL\RoleRepository;
use App\Repositories\Admin\Contracts\TagContract;
use App\Repositories\Admin\SQL\TagRepository;
use App\Repositories\Admin\Contracts\SliderContract;
use App\Repositories\Admin\SQL\SliderRepository;
use App\Repositories\Admin\Contracts\ReviewContract as AdminReviewContract;
use App\Repositories\Admin\SQL\ReviewRepository as AdminReviewRepository;
use App\Repositories\Admin\Contracts\ProductContract as AdminProductContract;
use App\Repositories\Admin\SQL\ProductRepository as AdminProductRepository;

// Non-Admin Repository Contracts and Implementations
use App\Repositories\Contracts\ProductContract;
use App\Repositories\SQL\ProductRepository;
use App\Repositories\Contracts\CartContract;
use App\Repositories\SQL\CartRepository;
use App\Repositories\Contracts\PostContract;
use App\Repositories\SQL\PostRepository;
use App\Repositories\Contracts\OrderContract;
use App\Repositories\SQL\OrderRepository;
use App\Repositories\Contracts\ReviewContract;
use App\Repositories\SQL\ReviewRepository;
use App\Repositories\Contracts\CategoryContract;
use App\Repositories\SQL\CategoryRepository;
use App\Repositories\Contracts\WelcomeContract;
use App\Repositories\SQL\WelcomeRepository;
use App\Repositories\Contracts\UserContract;
use App\Repositories\SQL\UserRepository;
use App\Repositories\Contracts\CommentContract;
use App\Repositories\SQL\CommentRepository;
use App\Repositories\Contracts\ContactContract;
use App\Repositories\SQL\ContactRepository;
use App\Repositories\Contracts\SearchContract;
use App\Repositories\SQL\SearchRepository;
use App\Repositories\Contracts\SubscriberContract;
use App\Repositories\SQL\SubscriberRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Admin Repository Bindings
        $this->app->bind(AdminContract::class, AdminRepository::class);
        $this->app->bind(PermissionContract::class, PermissionRepository::class);
        $this->app->bind(RoleContract::class, RoleRepository::class);
        $this->app->bind(TagContract::class, TagRepository::class);
        $this->app->bind(SliderContract::class, SliderRepository::class);
        $this->app->bind(AdminReviewContract::class, AdminReviewRepository::class);
        $this->app->bind(AdminProductContract::class, AdminProductRepository::class);

        // Non-Admin Repository Bindings
        $this->app->bind(ProductContract::class, ProductRepository::class);
        $this->app->bind(CartContract::class, CartRepository::class);
        $this->app->bind(PostContract::class, PostRepository::class);
        $this->app->bind(OrderContract::class, OrderRepository::class);
        $this->app->bind(ReviewContract::class, ReviewRepository::class);
        $this->app->bind(CategoryContract::class, CategoryRepository::class);
        $this->app->bind(WelcomeContract::class, WelcomeRepository::class);
        $this->app->bind(UserContract::class, UserRepository::class);
        $this->app->bind(CommentContract::class, CommentRepository::class);
        $this->app->bind(ContactContract::class, ContactRepository::class);
        $this->app->bind(SearchContract::class, SearchRepository::class);
        $this->app->bind(SubscriberContract::class, SubscriberRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
