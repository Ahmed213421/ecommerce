<?php

namespace App\Services;

use App\Repositories\Contracts\WelcomeContract;

class WelcomeService
{
    protected $welcomeRepository;

    public function __construct(WelcomeContract $welcomeRepository)
    {
        $this->welcomeRepository = $welcomeRepository;
    }

    public function getHomePageData()
    {
        return [
            'products_most_viewed' => $this->welcomeRepository->getMostViewedProducts(),
            'categories' => $this->welcomeRepository->getAllCategories(),
            'testmonials' => $this->welcomeRepository->getTestmonials(),
            'featured' => $this->welcomeRepository->getFeaturedProducts(),
            'slider' => $this->welcomeRepository->getAllSliders(),
            'setting' => $this->welcomeRepository->getSettings(),
            'posts' => $this->welcomeRepository->getLatestPosts(),
        ];
    }
}
