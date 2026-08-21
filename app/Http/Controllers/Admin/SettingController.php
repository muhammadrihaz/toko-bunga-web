<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request) 
    {
        $inputs = $request->except(['_token', 'hero_image', 'about_image']);
        
        foreach ($inputs as $key => $value) {
            if ($value !== null) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'hero_image_path'], ['value' => $path]);
        }
        
        if ($request->hasFile('about_image')) {
            $path = $request->file('about_image')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'about_image_path'], ['value' => $path]);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
