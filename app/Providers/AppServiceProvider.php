<?php

namespace App\Providers;
use App\Repositories\Admin\SQL\AdminRepository;
use App\Repositories\Admin\Contracts\AdminContract;
use App\Repositories\Admin\SQL\CategoryRepository;
use App\Repositories\Admin\Contracts\TestmonialContract;
use App\Repositories\Admin\SQL\PostRepository;
use App\Repositories\Admin\Contracts\CategoryContract as AdminCategoryContract;
use App\Repositories\Admin\Contracts\PostContract as AdminPostContract;
use App\Repositories\Admin\Contracts\SubCategoryContract;
use App\Repositories\Admin\SQL\SubCategoryRepository;
use App\Repositories\Admin\SQL\TestmonialRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdminCategoryContract::class, CategoryRepository::class);
        $this->app->bind(AdminPostContract::class, PostRepository::class);
        $this->app->bind(AdminContract::class, AdminRepository::class);
        $this->app->bind(TestmonialContract::class, TestmonialRepository::class);
        $this->app->bind(SubCategoryContract::class, SubCategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();
    }
}
