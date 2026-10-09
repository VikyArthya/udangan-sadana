<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Rsvp;
use App\Models\WeddingSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class DashboardController extends Controller
{
    /**
     * Display admin overview dashboard.
     */
    public function index(): View
    {
        $setting = WeddingSetting::getSettings();

        $totalRsvp = 0;
        $totalHadir = 0;
        $totalTidakHadir = 0;
        $totalRagu = 0;
        $totalGuests = 0;
        $recentWishes = collect();
        $totalPhotos = 0;

        try {
            if (Schema::hasTable('rsvps')) {
                $totalRsvp = Rsvp::count();
                $totalHadir = Rsvp::where('attendance', 'hadir')->count();
                $totalTidakHadir = Rsvp::where('attendance', 'tidak_hadir')->count();
                $totalRagu = Rsvp::where('attendance', 'ragu')->count();
                $totalGuests = Rsvp::where('attendance', 'hadir')->sum('guest_count');
                $recentWishes = Rsvp::latest()->take(5)->get();
            } else {
                $totalRsvp = 3;
                $totalHadir = 2;
                $totalTidakHadir = 1;
                $totalRagu = 0;
                $totalGuests = 3;
                $recentWishes = Rsvp::defaultWishes();
            }

            if (Schema::hasTable('galleries')) {
                $totalPhotos = Gallery::count();
            } else {
                $totalPhotos = 6;
            }
        } catch (Throwable $e) {
            $totalRsvp = 3;
            $totalHadir = 2;
            $totalTidakHadir = 1;
            $totalGuests = 3;
            $recentWishes = Rsvp::defaultWishes();
            $totalPhotos = 6;
        }

        return view('admin.dashboard', compact(
            'setting',
            'totalRsvp',
            'totalHadir',
            'totalTidakHadir',
            'totalRagu',
            'totalGuests',
            'recentWishes',
            'totalPhotos'
        ));
    }
}
