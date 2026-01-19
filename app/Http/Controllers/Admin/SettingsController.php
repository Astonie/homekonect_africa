<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display the settings page
     */
    public function index()
    {
        $settings = Setting::getAllGrouped();
        
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'settings' => 'array',
            'settings.*' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.site-settings.index')
                ->withErrors($validator)
                ->withInput();
        }

        // Process file uploads
        if ($request->hasFile('settings')) {
            foreach ($request->file('settings') as $key => $file) {
                // Validate if it's an image
                if (!in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'])) {
                    continue;
                }
                
                // Store the file
                $path = $file->store('settings', 'public');
                
                // Update specific setting with file path
                $setting = Setting::where('key', $key)->first();
                if ($setting) {
                    $setting->value = $path;
                    $setting->save();
                    
                    // Clear cache for this specific setting
                    \Cache::forget("setting_{$key}");
                }
            }
        }

        // Process text fields
        foreach ($request->input('settings', []) as $key => $value) {
            // Skip if it was a file upload
            if ($request->hasFile("settings.$key")) {
                continue;
            }

            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                // Determine if it's an image type setting but text was sent (shouldn't happen on file input but just in case)
                if ($setting->type !== 'image') {
                    $setting->value = $value;
                    $setting->save();
                    
                    // Clear cache for this specific setting
                    \Cache::forget("setting_{$key}");
                }
            }
        }

        // Clear the cache
        Setting::clearCache();

        return redirect()
            ->route('admin.site-settings.index')
            ->with('success', 'Settings updated successfully!');
    }
}
