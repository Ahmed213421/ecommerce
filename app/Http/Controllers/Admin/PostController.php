<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Mail\NewPostMail;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\Subscriber;
use App\Models\Tag;
use App\Repositories\Admin\Interfaces\PostRepositoryInterface;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['posts'] = Post::latest()->get();

        return view('dashboard.news.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();
        return view('dashboard.news.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {

        try{
            DB::beginTransaction();
            $this->postRepository->create($request->validated());
            toastr()->success(__('toaster.add'));
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();

            toastr()->error(__('error'.$e->getMessage()));
        }


        return to_route('admin.news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['tags', 'comments'])->findOrFail($id);

        return view('dashboard.news.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('dashboard.news.edit',['post' => Post::findOrFail($id),'categories'=> category::all(),
        'tags' => Tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $news,Request $request)
    {

        $this->postRepository->destroy($news);

        return back();
    }
    public function deleteAll()
    {

        $this->postRepository->deleteAll();

        toastr()->success(__('toaster.del'));

        return back();
    }
}
