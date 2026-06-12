<?php

namespace App\Services;

use App\Repositories\Contracts\PostContract;

class NewsService
{
    protected $postRepository;

    public function __construct(PostContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getLatestNews(int $perPage = 12)
    {
        return [
            'posts' => $this->postRepository->getLatestPaginated($perPage)
        ];
    }

    public function getNewsDetails(string $slug)
    {
        return [
            'post' => $this->postRepository->findBySlug($slug),
            'posts' => $this->postRepository->getLatest(5)
        ];
    }
}
