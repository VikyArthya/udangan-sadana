<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class SettingController extends Controller
{
    /**
     * Show general wedding settings form.
     */
    public function index(): View
    {
        $setting = WeddingSetting::getSettings();

        return view('admin.settings.index', compact('setting'));
    }

    /**
     * Update wedding settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'groom_name' => ['required', 'string', 'max:150'],
            'groom_nickname' => ['required', 'string', 'max:50'],
            'groom_father' => ['nullable', 'string', 'max:100'],
            'groom_mother' => ['nullable', 'string', 'max:100'],
            'groom_parent_status' => ['nullable', 'string', 'max:255'],
            'groom_instagram' => ['nullable', 'string', 'max:100'],
            'groom_photo' => ['nullable', 'string'],
            'groom_photo_file' => ['nullable', 'image', 'max:4096'],

            'bride_name' => ['required', 'string', 'max:150'],
            'bride_nickname' => ['required', 'string', 'max:50'],
            'bride_father' => ['nullable', 'string', 'max:100'],
            'bride_mother' => ['nullable', 'string', 'max:100'],
            'bride_parent_status' => ['nullable', 'string', 'max:255'],
            'bride_instagram' => ['nullable', 'string', 'max:100'],
            'bride_photo' => ['nullable', 'string'],
            'bride_photo_file' => ['nullable', 'image', 'max:4096'],

            'cover_photo' => ['nullable', 'string'],
            'cover_photo_file' => ['nullable', 'image', 'max:4096'],

            'hero_photo' => ['nullable', 'string'],
            'hero_photo_file' => ['nullable', 'image', 'max:4096'],

            'quote_arabic' => ['nullable', 'string'],
            'quote_text' => ['nullable', 'string'],
            'quote_source' => ['nullable', 'string', 'max:150'],

            'background_music' => ['nullable', 'string'],
            'background_music_file' => ['nullable', 'file', 'mimes:mp3,wav,ogg', 'max:15360'],
            'wedding_date' => ['nullable', 'date'],
            'video_url' => ['nullable', 'string', 'max:255'],

            'gift_recipient_name' => ['nullable', 'string', 'max:100'],
            'gift_phone' => ['nullable', 'string', 'max:50'],
            'gift_address' => ['nullable', 'string'],

            'stream_enabled' => ['nullable', 'boolean'],
            'stream_platform' => ['nullable', 'string', 'max:100'],
            'stream_url' => ['nullable', 'string', 'max:255'],
            'stream_time' => ['nullable', 'string', 'max:150'],
        ]);

        $data = $request->except(['_token', '_method', 'groom_photo_file', 'bride_photo_file', 'cover_photo_file', 'hero_photo_file', 'background_music_file']);
        $data['stream_enabled'] = $request->has('stream_enabled');

        // Handle File Uploads
        if ($request->hasFile('groom_photo_file')) {
            $path = $request->file('groom_photo_file')->store('uploads/photos', 'public');
            $data['groom_photo'] = '/storage/'.$path;
        }

        if ($request->hasFile('bride_photo_file')) {
            $path = $request->file('bride_photo_file')->store('uploads/photos', 'public');
            $data['bride_photo'] = '/storage/'.$path;
        }

        if ($request->hasFile('cover_photo_file')) {
            $path = $request->file('cover_photo_file')->store('uploads/photos', 'public');
            $data['cover_photo'] = '/storage/'.$path;
        }

        if ($request->hasFile('hero_photo_file')) {
            $path = $request->file('hero_photo_file')->store('uploads/photos', 'public');
            $data['hero_photo'] = '/storage/'.$path;
        }

        if ($request->hasFile('background_music_file')) {
            $path = $request->file('background_music_file')->store('uploads/audio', 'public');
            $data['background_music'] = '/storage/'.$path;
        }

        try {
            if (Schema::hasTable('wedding_settings')) {
                WeddingSetting::updateOrCreate(['id' => 1], $data);
            }
        } catch (Throwable $e) {
            // DB not yet migrated
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan undangan berhasil diperbarui!');
    }
}
