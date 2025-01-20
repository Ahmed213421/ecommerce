<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['settings'] = Setting::all();
        return view('dashboard.setting.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::count();
        if($setting == 1){
            abort(404);
        }
        return view('dashboard.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'iconpage' => ['image','nullable'],
            'logo' => ['image','nullable'],
            'email' => ['email','email:filter','unique:settings,email'],
            'phone' => ['regex:/^\d{11}$/'],
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if ($request->hasFile('iconpage')) {
            $icon = 'dashboard/'.$request->iconpage->storeAs('settings', time().'_'.$request->iconpage->getClientOriginalName(),'images');
        }
        else{
            $icon = null;
        }

        if ($request->hasFile('logo')) {
            $logo = 'dashboard/'.$request->logo->storeAs('settings', time().'_'.$request->logo->getClientOriginalName(),'images');
        }
        else{
            $logo = null;
        }

        $setting = Setting::create([
            'pageIcon' => $icon,
            'street' => $request->street,
            'country' => $request->country,
            'address' => $request->address,
            'phone' => $request->phone,
            'description' => $request->description,
            'map' => $request->map,
            'email' => $request->email,
            'logo' => $logo,
        ]);

        $link = new Link();
        $link->fb = $request->fb;
        $link->tw = $request->tw;
        $link->li = $request->li;
        $link->ins = $request->ins;

        $link->linkable()->associate($setting);

        $link->save();

        toastr()->success(__('toaster.add'));

        return redirect()->route('admin.setting.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('dashboard.setting.edit',['setting' => Setting::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'iconpage' => ['image','nullable'],
            'logo' => ['image','nullable'],
            'email' => ['email','email:filter',Rule::unique('settings', 'email')->ignore($id)],
            'phone' => ['regex:/^\d{11}$/'],
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $setting = Setting::find($id);
        $icon = $setting->pageIcon;
        $logo = $setting->logo;

        if ($request->hasFile('iconpage')) {
            if ($icon &&  file_exists(public_path($icon))) {
                unlink(public_path($icon));
            }
            $icon = 'dashboard/'.$request->iconpage->storeAs('settings', time().'_'.$request->iconpage->getClientOriginalName(),'images');
        }
        if ($request->hasFile('logo')) {
            if ($logo &&  file_exists(public_path($logo))) {
                unlink(public_path($logo));
            }
            $logo = 'dashboard/'.$request->logo->storeAs('settings', time().'_'.$request->logo->getClientOriginalName(),'images');
        }

        Setting::find($id)->update([
            'pageIcon' => $icon,
            'street' => $request->street,
            'country' => $request->country,
            'address' => $request->address,
            'phone' => $request->phone,
            'description' => $request->description,
            'map' => $request->map,
            'email' => $request->email,
            'logo' => $logo,
        ]);

        $link = Link::where('linkable_id', $id)->where('linkable_type', Setting::class)->first();
        $link->fb = $request->fb;
        $link->tw = $request->tw;
        $link->li = $request->li;
        $link->ins = $request->ins;


        $link->save();

        toastr()->success(__('toaster.update'));

        return redirect()->route('admin.setting.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setting = Setting::find($id);
        if ($setting) {

            if ($setting->logo && file_exists(public_path($setting->logo))) {
                unlink(public_path($setting->logo));
            }

            if ($setting->pageIcon && file_exists(public_path($setting->pageIcon))) {
                unlink(public_path($setting->pageIcon));
            }
        }

        Setting::destroy($id);

        toastr()->success(__('toaster.del'));

        return back();
    }
}
