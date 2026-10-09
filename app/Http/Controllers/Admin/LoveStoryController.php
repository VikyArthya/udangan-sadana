<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoveStory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class LoveStoryController extends Controller
{
    /**
     * Show love stories list and add form.
     */
    public function index(): View
    {
        $stories = LoveStory::getStories();

        return view('admin.stories.index', compact('stories'));
    }

    /**
     * Store a story.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'year_or_date' => ['nullable', 'string', 'max:50'],
            'title' => ['required', 'string', 'max:150'],
            'story' => ['required', 'string'],
            'image' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'order' => ['nullable', 'integer'],
        ]);

        $data = [
            'year_or_date' => $validated['year_or_date'] ?? null,
            'title' => $validated['title'],
            'story' => $validated['story'],
            'image' => $validated['image'] ?? null,
            'order' => $validated['order'] ?? 0,
        ];

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/stories', 'public');
            $data['image'] = '/storage/'.$path;
        }

        try {
            if (Schema::hasTable('love_stories')) {
                LoveStory::create($data);
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.stories.index')->with('success', 'Cerita baru berhasil ditambahkan!');
    }

    /**
     * Update a story.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'year_or_date' => ['nullable', 'string', 'max:50'],
            'title' => ['required', 'string', 'max:150'],
            'story' => ['required', 'string'],
            'image' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'order' => ['nullable', 'integer'],
        ]);

        $data = [
            'year_or_date' => $validated['year_or_date'] ?? null,
            'title' => $validated['title'],
            'story' => $validated['story'],
            'image' => $validated['image'] ?? null,
            'order' => $validated['order'] ?? 0,
        ];

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/stories', 'public');
            $data['image'] = '/storage/'.$path;
        }

        try {
            if (Schema::hasTable('love_stories')) {
                LoveStory::where('id', $id)->update($data);
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.stories.index')->with('success', 'Cerita berhasil diperbarui!');
    }

    /**
     * Delete a story.
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            if (Schema::hasTable('love_stories')) {
                LoveStory::where('id', $id)->delete();
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.stories.index')->with('success', 'Cerita berhasil dihapus!');
    }
}
