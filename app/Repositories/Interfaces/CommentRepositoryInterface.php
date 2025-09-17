<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function create(array $data);
    public function findById(int $id);
    public function getByPostId(int $postId, int $status = null);
    public function update(int $id, array $data);
    public function delete(int $id);
}
