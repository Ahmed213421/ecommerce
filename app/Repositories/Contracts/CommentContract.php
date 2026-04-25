<?php

namespace App\Repositories\Contracts;

interface CommentContract extends BaseContract
{
    public function getByPostId(int $postId, int $status = null);
}
