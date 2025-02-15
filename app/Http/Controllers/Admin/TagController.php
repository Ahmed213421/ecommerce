<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tags'] = Tag::latest()->get();
        return view('dashboard.tags.index',$data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name_en' => 'required',
            'name_ar' => 'required',
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $tag = new Tag();
        $tag->name = ['en' => $request->name_en , 'ar' => $request->name_ar];
        $tag->save();

        toastr()->success(__('toaster.add'));

        return back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name_en' => 'required',
            'name_ar' => 'required',
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $tag = Tag::find($id);
        $tag->name = ['en' => $request->name_en , 'ar' => $request->name_ar];
        $tag->save();

        toastr()->success(__('toaster.update'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::find($id)->delete();

        toastr()->success(__('toaster.del'));

        return back();
    }
}
