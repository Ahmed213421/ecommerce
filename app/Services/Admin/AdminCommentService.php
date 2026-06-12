<?php

namespace App\Services\Admin;

use App\Models\Comment;

class AdminCommentService
{
    public function deleteComment($id)
    {
        return Comment::destroy($id);
    }
}
