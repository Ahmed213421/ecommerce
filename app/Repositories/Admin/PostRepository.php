<?php

namespace App\Repositories\Admin;

use App\Mail\NewPostMail;
use App\Models\Post;
use App\Models\Subscriber;
use App\Repositories\Admin\Interfaces\PostRepositoryInterface;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface
{
    protected $model;
    public function __construct(Post $post){
        $this->model = $post;
    }

    public function create(array $data){
        if (request()->hasFile('imagepath')) {
            $data['imagepath'] = 'dashboard/'.$data['imagepath']->storeAs('news', time().'_'.$data['imagepath']->getClientOriginalName(),'images');
        }
        else{
            $data['imagepath'] = null;
        }

        $post = $this->model->create($data);
        $post->tags()->attach(request()->tags);
        $subscribers = Subscriber::all();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->queue(new NewPostMail($post,$subscriber->unsubscribe_token));
        }
        return $post;
    }

    public function update($model,array $data){
    }

    public function destroy($model){
        if(request()->page == 1){
            if ($model) {
                if (file_exists(filename: public_path($model['imagepath']))) {
                    unlink(public_path($model['imagepath']));
                }
                $model->delete();
            }

            $model->delete();
            toastr()->success(__('toaster.del'));
            return redirect()->route('admin.news.index');
        }

        return $model;
    }

    public function deleteAll(){
        $postids = json_decode(request()->input('delete_all_id'), true);

        if (empty($postids)) {
            toastr()->error(__('dashboard.no.items.selected'));
            return back();
        }

        $posts = Post::whereIn('id', $postids)->get();

        foreach ($posts as $post) {
            if ($post->imagepath) {
                if (file_exists(public_path($post->imagepath))) {
                    unlink(public_path($post->imagepath));
                }
            }
            $post->delete();
        }

        return back();
    }
}
