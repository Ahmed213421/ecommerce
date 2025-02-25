<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sliders'] = Slider::latest()->get();
        return view('dashboard.slider.index',$data);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'main_title' => 'required',
            'branch_title' => 'required',
            'image' => 'image|required',
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if ($request->hasFile('image')) {
            $img =  'dashboard/'.$request->image->storeAs('slider', time().'_'.$request->image->getClientOriginalName(),'images');
        }
        else{
            $img = null;
        }

        Slider::create([
            'main_title' => $request->main_title,
            'branch_title' => $request->branch_title,
            'imagepath' => $img,
        ]);

        toastr()->success(__('toaster.add'));

        return back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'main_title' => 'required',
            'branch_title' => 'required',
            'image' => 'image',
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $slider = Slider::find($id);
        $img = $slider->imagepath;

        if ($request->hasFile('image')) {
            if ($slider->imagepath &&  file_exists(public_path($slider->imagepath))) {
                unlink(public_path($slider->imagepath));
            }
            $img =  'dashboard/'.$request->image->storeAs('slider', time().'_'.$request->image->getClientOriginalName(),'images');
        }


        $slider->update([
            'main_title' => $request->main_title,
            'branch_title' => $request->branch_title,
            'imagepath' => $img,
        ]);

        toastr()->success(__('toaster.add'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            if ($slider->imagepath && file_exists(public_path($slider->imagepath))) {
                unlink(public_path($slider->imagepath));
            }
        }
        Slider::destroy($id);
        toastr()->success(__('toaster.del'));
        return back();
    }
}
