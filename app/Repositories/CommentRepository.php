<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    protected $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function getByPostId(int $postId, int $status = null)
    {
        $query = $this->model->where('post_id', $postId);
        
        if ($status !== null) {
            $query->where('status', $status);
        }
        
        return $query->get();
    }

    public function update(int $id, array $data)
    {
        $comment = $this->findById($id);
        $comment->update($data);
        return $comment;
    }

    public function delete(int $id)
    {
        $comment = $this->findById($id);
        return $comment->delete();
    }
}
