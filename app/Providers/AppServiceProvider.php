<?php

namespace App\Providers;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\Interfaces\TestmonialRepositoryInterface;
use App\Repositories\Admin\PostRepository;
use App\Repositories\Admin\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Admin\Interfaces\PostRepositoryInterface;
use App\Repositories\Admin\TestmonialRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(PostRepositoryInterface::class,PostRepository::class);
        $this->app->bind(AdminRepositoryInterface::class,AdminRepository::class);
        $this->app->bind(TestmonialRepositoryInterface::class,TestmonialRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();
    }
}
