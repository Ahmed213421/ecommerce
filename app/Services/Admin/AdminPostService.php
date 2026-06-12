<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Repositories\Admin\Contracts\PostContract;
use Illuminate\Support\Facades\DB;

class AdminPostService
{
    protected $postRepository;

    public function __construct(PostContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return Post::latest()->get();
    }

    public function getPostFormData()
    {
        return [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ];
    }

    public function getPostFormDataWithPost($id)
    {
        $data = $this->getPostFormData();
        $data['post'] = Post::findOrFail($id);
        return $data;
    }

    public function createPost(array $data)
    {
        DB::beginTransaction();
        try {
            $this->postRepository->create($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function getPostWithRelations($id)
    {
        return Post::with(['tags', 'comments'])->findOrFail($id);
    }

    public function updatePost($id, array $data)
    {
        DB::beginTransaction();
        try {
            $post = Post::findOrFail($id);
            $this->postRepository->update($post, $data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function deletePost(Post $post)
    {
        return $this->postRepository->destroy($post);
    }

    public function deleteAllPosts()
    {
        return $this->postRepository->deleteAll();
    }
}
