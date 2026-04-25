<?php

namespace App\Repositories\SQL;

use App\Models\Post;
use App\Repositories\Contracts\PostContract;

class PostRepository extends BaseRepository implements PostContract
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getLatestPaginated(int $perPage = 12)
    {
        return $this->model->latest()->paginate($perPage);
    }

    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->with(['comments' => function($query) {
            $query->where('status', 1);
        }])->firstOrFail();
    }

    public function getLatest(int $limit = 5)
    {
        return $this->model->latest()->take($limit)->get();
    }

    public function getLatestWithLimit(int $limit = 3)
    {
        return $this->model->latest()->take($limit)->get();
    }
}
