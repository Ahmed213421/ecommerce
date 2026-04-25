<?php

namespace App\Repositories\SQL;

use App\Models\Comment;
use App\Repositories\Contracts\CommentContract;

class CommentRepository extends BaseRepository implements CommentContract
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
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

    public function updateById(int $id, array $data)
    {
        $comment = $this->findById($id);
        $comment->update($data);
        return $comment;
    }

    public function deleteById(int $id)
    {
        $comment = $this->findById($id);
        return $comment->delete();
    }
}
