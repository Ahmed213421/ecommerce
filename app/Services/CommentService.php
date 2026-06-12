<?php

namespace App\Services;

use App\Repositories\Contracts\CommentContract;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentContract $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function submitComment(array $data)
    {
        return $this->commentRepository->create([
            'post_id' => $data['postid'],
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
            'status' => 0,
        ]);
    }
}
