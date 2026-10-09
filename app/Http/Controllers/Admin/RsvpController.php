<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rsvp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class RsvpController extends Controller
{
    /**
     * Display list of RSVPs & wishes.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $rsvps = collect();

        try {
            if (Schema::hasTable('rsvps')) {
                $query = Rsvp::latest();
                if ($status && in_array($status, ['hadir', 'tidak_hadir', 'ragu'])) {
                    $query->where('attendance', $status);
                }
                $rsvps = $query->paginate(20)->withQueryString();
            } else {
                $rsvps = Rsvp::defaultWishes();
            }
        } catch (Throwable $e) {
            $rsvps = Rsvp::defaultWishes();
        }

        return view('admin.rsvps.index', compact('rsvps', 'status'));
    }

    /**
     * Delete an RSVP / wish entry.
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            if (Schema::hasTable('rsvps')) {
                Rsvp::where('id', $id)->delete();
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.rsvps.index')->with('success', 'Ucapan berhasil dihapus!');
    }
}
