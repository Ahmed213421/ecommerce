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
        $comment = $this->findOrFail($id);
        return $this->update($comment, $data);
    }

    public function deleteById(int $id)
    {
        $comment = $this->findOrFail($id);
        return $this->remove($comment);
    }
}
