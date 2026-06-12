<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Services\Admin\AdminPostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $adminPostService;

    public function __construct(AdminPostService $adminPostService)
    {
        $this->adminPostService = $adminPostService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['posts'] = $this->adminPostService->getAllPosts();
        return view('dashboard.news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->adminPostService->getPostFormData();
        return view('dashboard.news.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $success = $this->adminPostService->createPost($request->validated());

        if ($success) {
            toastr()->success(__('toaster.add'));
        } else {
            toastr()->error(__('error'));
        }

        return to_route('admin.news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->adminPostService->getPostWithRelations($id);
        return view('dashboard.news.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->adminPostService->getPostFormDataWithPost($id);
        return view('dashboard.news.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $success = $this->adminPostService->updatePost($id, $request->validated());

        if ($success) {
            toastr()->success(__('toaster.update'));
        } else {
            toastr()->error(__('error'));
        }

        return to_route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $news, Request $request)
    {
        $this->adminPostService->deletePost($news);
        return back();
    }

    public function deleteAll()
    {
        $this->adminPostService->deleteAllPosts();
        toastr()->success(__('toaster.del'));
        return back();
    }
}
