<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Admin\PermissionRepository;
use App\Repositories\Admin\Interfaces\RoleRepositoryInterface;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\TagRepository;
use App\Repositories\Admin\Interfaces\TagRepositoryInterface;
use App\Repositories\Admin\SliderRepository;
use App\Repositories\Admin\Interfaces\SliderRepositoryInterface;
use App\Repositories\Admin\SubCategoryRepository;
use App\Repositories\Admin\Interfaces\SubCategoryRepositoryInterface;
use App\Repositories\Admin\Interfaces\ReviewRepositoryInterface as AdminReviewRepositoryInterface;
use App\Repositories\Admin\ReviewRepository as AdminReviewRepository;
use App\Repositories\Admin\Interfaces\ProductRepositoryInterface as AdminProductRepositoryInterface;
use App\Repositories\Admin\ProductRepository as AdminProductRepository;

// Non-Admin Repository Interfaces and Implementations
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\CartRepository;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Repositories\ReviewRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\WelcomeRepositoryInterface;
use App\Repositories\WelcomeRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use App\Repositories\ContactRepository;
use App\Repositories\Interfaces\SearchRepositoryInterface;
use App\Repositories\SearchRepository;
use App\Repositories\Interfaces\SubscriberRepositoryInterface;
use App\Repositories\SubscriberRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Admin Repository Bindings
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(SliderRepositoryInterface::class, SliderRepository::class);
        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);
        $this->app->bind(AdminReviewRepositoryInterface::class, AdminReviewRepository::class);
        $this->app->bind(AdminProductRepositoryInterface::class, AdminProductRepository::class);

        // Non-Admin Repository Bindings
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(ReviewRepositoryInterface::class, ReviewRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(WelcomeRepositoryInterface::class, WelcomeRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(SearchRepositoryInterface::class, SearchRepository::class);
        $this->app->bind(SubscriberRepositoryInterface::class, SubscriberRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
