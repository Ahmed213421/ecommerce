<?php

namespace App\Repositories\Interfaces;

interface WelcomeRepositoryInterface
{
    public function getHomePageData();
    public function getMostViewedProducts(int $limit = 3);
    public function getAllCategories();
    public function getTestmonials(int $limit = 3);
    public function getFeaturedProducts(int $limit = 3);
    public function getAllSliders();
    public function getSettings();
    public function getLatestPosts(int $limit = 3);
}
