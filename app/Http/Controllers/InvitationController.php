<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Gallery;
use App\Models\LoveStory;
use App\Models\Rsvp;
use App\Models\WeddingEvent;
use App\Models\WeddingSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class InvitationController extends Controller
{
    /**
     * Display the wedding invitation.
     */
    public function index(Request $request): View
    {
        $guestName = $request->query('to', 'Tamu Undangan');
        // Clean and sanitize guest name
        $guestName = trim(strip_tags($guestName));
        if (empty($guestName)) {
            $guestName = 'Tamu Undangan';
        }

        $setting = WeddingSetting::getSettings();
        $events = WeddingEvent::getEvents();
        $stories = LoveStory::getStories();
        $galleries = Gallery::getGalleries();
        $bankAccounts = BankAccount::getAccounts();
        $wishes = Rsvp::getRecentWishes(50);

        return view('invitation.index', compact(
            'guestName',
            'setting',
            'events',
            'stories',
            'galleries',
            'bankAccounts',
            'wishes'
        ));
    }

    /**
     * Store incoming RSVP and wishes via AJAX.
     */
    public function storeRsvp(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'attendance' => ['required', 'string', 'in:hadir,tidak_hadir,ragu'],
            'guest_count' => ['nullable', 'integer', 'min:0', 'max:10'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $guestCount = (int) ($validated['guest_count'] ?? 1);
        if ($validated['attendance'] === 'tidak_hadir') {
            $guestCount = 0;
        }

        $rsvpData = [
            'name' => strip_tags($validated['name']),
            'attendance' => $validated['attendance'],
            'guest_count' => $guestCount,
            'message' => strip_tags($validated['message']),
        ];

        try {
            if (Schema::hasTable('rsvps')) {
                $created = Rsvp::create($rsvpData);
                $rsvpData['id'] = $created->id;
                $rsvpData['created_at_human'] = $created->created_at->diffForHumans();
            } else {
                $rsvpData['id'] = time();
                $rsvpData['created_at_human'] = 'Baru saja';
            }
        } catch (Throwable $e) {
            $rsvpData['id'] = time();
            $rsvpData['created_at_human'] = 'Baru saja';
        }

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas konfirmasi kehadiran dan doa restunya!',
            'data' => $rsvpData,
        ]);
    }

    /**
     * Get recent wishes as JSON.
     */
    public function getWishes(): JsonResponse
    {
        $wishes = Rsvp::getRecentWishes(50);

        $formatted = $wishes->map(function ($w) {
            return [
                'id' => $w->id,
                'name' => $w->name,
                'attendance' => $w->attendance,
                'guest_count' => $w->guest_count,
                'message' => $w->message,
                'created_at_human' => $w->created_at ? $w->created_at->diffForHumans() : 'Baru saja',
            ];
        });

        return response()->json([
            'success' => true,
            'wishes' => $formatted,
        ]);
    }
}
