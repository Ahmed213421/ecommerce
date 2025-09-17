<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Testmonial;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Post;
use App\Repositories\Interfaces\WelcomeRepositoryInterface;

class WelcomeRepository implements WelcomeRepositoryInterface
{
    public function getHomePageData()
    {
        return [
            'products_most_viewed' => $this->getMostViewedProducts(),
            'categories' => $this->getAllCategories(),
            'testmonials' => $this->getTestmonials(),
            'featured' => $this->getFeaturedProducts(),
            'slider' => $this->getAllSliders(),
            'setting' => $this->getSettings(),
            'posts' => $this->getLatestPosts(),
        ];
    }

    public function getMostViewedProducts(int $limit = 3)
    {
        return Product::orderBy('views', 'desc')->inRandomOrder()->limit($limit)->get();
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getTestmonials(int $limit = 3)
    {
        return Testmonial::where('status', 1)->take($limit)->get();
    }

    public function getFeaturedProducts(int $limit = 3)
    {
        return Product::where('featured', 1)->inRandomOrder()->limit($limit)->get();
    }

    public function getAllSliders()
    {
        return Slider::all();
    }

    public function getSettings()
    {
        return Setting::all('whoweare');
    }

    public function getLatestPosts(int $limit = 3)
    {
        return Post::latest()->take($limit)->get();
    }
}
