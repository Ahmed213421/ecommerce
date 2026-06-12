<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminCommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $adminCommentService;

    public function __construct(AdminCommentService $adminCommentService)
    {
        $this->adminCommentService = $adminCommentService;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->adminCommentService->deleteComment($id);

        toastr()->success(__('toaster.del'));

        return back();
    }
}
