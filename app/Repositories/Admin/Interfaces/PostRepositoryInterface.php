<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Post;

interface PostRepositoryInterface
{
    /**
     * Create new post
     *
     * @param array $data
     * @return Post
     */
    public function create(array $data);

    /**
     * Update post
     *
     * @param Post $model
     * @param array $data
     * @return Post
     */
    public function update($model, array $data);

    /**
     * Delete post
     *
     * @param Post $model
     * @return Post
     */
    public function destroy($model);

    /**
     * Delete multiple posts
     *
     * @return mixed
     */
    public function deleteAll();
}
