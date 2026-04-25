<?php

namespace App\Repositories\Contracts;

interface CommentContract
{
    public function create(array $data);
    public function findById(int $id);
    public function getByPostId(int $postId, int $status = null);
    public function updateById(int $id, array $data);
    public function deleteById(int $id);
}
