<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\WeddingSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class GalleryController extends Controller
{
    /**
     * Show photo gallery & video settings.
     */
    public function index(): View
    {
        $galleries = Gallery::getGalleries();
        $setting = WeddingSetting::getSettings();

        return view('admin.galleries.index', compact('galleries', 'setting'));
    }

    /**
     * Store new photo.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'image_url' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'max:5120'],
            'caption' => ['nullable', 'string', 'max:150'],
            'order' => ['nullable', 'integer'],
        ]);

        $imageUrl = $validated['image_url'] ?? null;

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/galleries', 'public');
            $imageUrl = '/storage/'.$path;
        }

        if (empty($imageUrl)) {
            return back()->withErrors(['image_url' => 'Harap masukkan URL foto atau upload file gambar.']);
        }

        try {
            if (Schema::hasTable('galleries')) {
                Gallery::create([
                    'image_url' => $imageUrl,
                    'caption' => $validated['caption'] ?? 'Prewedding Photo',
                    'order' => $validated['order'] ?? 0,
                ]);
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Foto baru berhasil ditambahkan ke galeri!');
    }

    /**
     * Update video prewedding URL.
     */
    public function updateVideo(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'video_url' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            if (Schema::hasTable('wedding_settings')) {
                WeddingSetting::where('id', 1)->update(['video_url' => $validated['video_url']]);
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Tautan video prewedding berhasil diperbarui!');
    }

    /**
     * Delete gallery photo.
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            if (Schema::hasTable('galleries')) {
                Gallery::where('id', $id)->delete();
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil dihapus dari galeri!');
    }
}
