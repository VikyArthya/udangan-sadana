<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class EventController extends Controller
{
    /**
     * Show events management page.
     */
    public function index(): View
    {
        $events = WeddingEvent::getEvents();

        return view('admin.events.index', compact('events'));
    }

    /**
     * Store new event.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'date_text' => ['required', 'string', 'max:150'],
            'time_text' => ['required', 'string', 'max:150'],
            'venue_name' => ['required', 'string', 'max:200'],
            'venue_address' => ['required', 'string'],
            'maps_url' => ['nullable', 'string'],
            'order' => ['nullable', 'integer'],
        ]);

        try {
            if (Schema::hasTable('wedding_events')) {
                WeddingEvent::create($validated);
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.events.index')->with('success', 'Acara baru berhasil ditambahkan!');
    }

    /**
     * Update an event.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'date_text' => ['required', 'string', 'max:150'],
            'time_text' => ['required', 'string', 'max:150'],
            'venue_name' => ['required', 'string', 'max:200'],
            'venue_address' => ['required', 'string'],
            'maps_url' => ['nullable', 'string'],
        ]);

        try {
            if (Schema::hasTable('wedding_events')) {
                WeddingEvent::where('id', $id)->update($validated);
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.events.index')->with('success', 'Data acara berhasil diperbarui!');
    }

    /**
     * Delete an event.
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            if (Schema::hasTable('wedding_events')) {
                WeddingEvent::where('id', $id)->delete();
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.events.index')->with('success', 'Acara berhasil dihapus!');
    }
}
