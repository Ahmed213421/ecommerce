<?php

namespace App\Services\Admin;

use App\Models\Link;
use App\Models\Setting;

class AdminSettingService
{
    public function getAllSettings()
    {
        return Setting::all();
    }

    public function getSettingCount()
    {
        return Setting::count();
    }

    public function getSettingById($id)
    {
        return Setting::find($id);
    }

    public function createSetting(array $data, $request)
    {
        $icon = null;
        if ($request->hasFile('pageIcon')) {
            $icon = 'dashboard/' . $request->pageIcon->storeAs('settings', time() . '_' . $request->pageIcon->getClientOriginalName(), 'images');
        }

        $logo = null;
        if ($request->hasFile('logo')) {
            $logo = 'dashboard/' . $request->logo->storeAs('settings', time() . '_' . $request->logo->getClientOriginalName(), 'images');
        }

        $setting = Setting::create([
            'pageIcon' => $icon,
            'address' => ['en' => $data['address_en'] ?? null, 'ar' => $data['address_ar'] ?? null],
            'phone' => $data['phone'] ?? null,
            'description' => ['en' => $data['description_en'] ?? null, 'ar' => $data['description_ar'] ?? null],
            'map' => $data['map'] ?? null,
            'email' => $data['email'] ?? null,
            'logo' => $logo,
            'whoweare' => ['en' => $data['whoweare_en'] ?? null, 'ar' => $data['whoweare_ar'] ?? null],
            'hours_working' => ['en' => $data['hours_working_en'] ?? null, 'ar' => $data['hours_working_ar'] ?? null],
            'tax_rate' => $data['tax_rate'],
        ]);

        $link = new Link();
        $link->fb = $data['fb'] ?? null;
        $link->tw = $data['tw'] ?? null;
        $link->li = $data['li'] ?? null;
        $link->ins = $data['ins'] ?? null;

        $link->linkable()->associate($setting);
        $link->save();

        return $setting;
    }

    public function updateSetting($id, array $data, $request)
    {
        $setting = Setting::find($id);
        if (!$setting) return false;

        $icon = $setting->pageIcon;
        $logo = $setting->logo;

        if ($request->hasFile('pageIcon')) {
            if ($icon && file_exists(public_path($icon))) {
                unlink(public_path($icon));
            }
            $icon = 'dashboard/' . $request->pageIcon->storeAs('settings', time() . '_' . $request->pageIcon->getClientOriginalName(), 'images');
        }

        if ($request->hasFile('logo')) {
            if ($logo && file_exists(public_path($logo))) {
                unlink(public_path($logo));
            }
            $logo = 'dashboard/' . $request->logo->storeAs('settings', time() . '_' . $request->logo->getClientOriginalName(), 'images');
        }

        $setting->update([
            'pageIcon' => $icon,
            'address' => ['en' => $data['address_en'] ?? null, 'ar' => $data['address_ar'] ?? null],
            'phone' => $data['phone'] ?? null,
            'description' => ['en' => $data['description_en'] ?? null, 'ar' => $data['description_ar'] ?? null],
            'map' => $data['map'] ?? null,
            'email' => $data['email'] ?? null,
            'logo' => $logo,
            'whoweare' => ['en' => $data['whoweare_en'] ?? null, 'ar' => $data['whoweare_ar'] ?? null],
            'hours_working' => ['en' => $data['hours_working_en'] ?? null, 'ar' => $data['hours_working_ar'] ?? null],
            'tax_rate' => $data['tax_rate'],
        ]);

        $link = Link::where('linkable_id', $id)->where('linkable_type', Setting::class)->first();
        if ($link) {
            $link->fb = $data['fb'] ?? null;
            $link->tw = $data['tw'] ?? null;
            $link->li = $data['li'] ?? null;
            $link->ins = $data['ins'] ?? null;
            $link->save();
        }

        return true;
    }

    public function deleteSetting($id)
    {
        $setting = Setting::find($id);
        if ($setting) {
            if ($setting->logo && file_exists(public_path($setting->logo))) {
                unlink(public_path($setting->logo));
            }

            if ($setting->pageIcon && file_exists(public_path($setting->pageIcon))) {
                unlink(public_path($setting->pageIcon));
            }
            
            return Setting::destroy($id);
        }
        
        return false;
    }
}
