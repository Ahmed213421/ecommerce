<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewPostMail;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\Subscriber;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
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
    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(),[
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image' => 'image|required',
            'subcategory_id' => 'required|exists:subcategories,id',
            'tags.*' => 'required|exists:tags,id',
            'slug' => 'unique:posts,slug',
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if ($request->hasFile('image')) {
            $img = 'dashboard/'.$request->image->storeAs('news', time().'_'.$request->image->getClientOriginalName(),'images');
        }
        else{
            $img = null;
        }

        $post = Post::create([
            'title' => ['en' => $request->title_en , 'ar' => $request->title_ar],
            'description' => ['en' => $request->description_en , 'ar' => $request->description_ar],
            'imagepath' => $img,
            'subcategory_id' => $request->subcategory_id,
            'slug' => Str::slug($request->title_en),
            'admin_id' => auth('admin')->user()->id,


        ]);

        $post->tags()->attach($request->tags);

        $subscribers = Subscriber::all();

        foreach ($subscribers as $subscriber) {

            Mail::to($subscriber->email)->queue(new NewPostMail($post,$subscriber->unsubscribe_token));

        }

        toastr()->success(__('toaster.add'));

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
    public function destroy(string $id,Request $request)
    {
        if($request->page == 1){
            $post = Post::findOrFail($id);
            if ($post) {



                    if (file_exists(public_path($post->imagepath))) {
                        unlink(public_path($post->imagepath));
                    }
                    $post->delete();
                }


            Post::destroy($id);
            toastr()->success(__('toaster.del'));
            return redirect()->route('admin.news.index');
        }
        if ($request->page == 2) {
            $postids = json_decode($request->input('delete_all_id'), true);

            $posts = Post::whereIn('id', $postids)->get();

            foreach ($posts as $post) {
                if ($post->imagepath) {
                    if (file_exists(public_path($post->imagepath))) {
                        unlink(public_path($post->imagepath));
                    }
                }
                $post->delete();
            }
            toastr()->success(__('dashboard.del.item'));
            return back();

        }
    }
}
