<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Throwable;

class WeddingEvent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'event_datetime' => 'datetime',
    ];

    /**
     * Get wedding events with fallback
     */
    public static function getEvents(): Collection
    {
        try {
            if (Schema::hasTable('wedding_events')) {
                $events = self::orderBy('order')->get();
                if ($events->isNotEmpty()) {
                    return $events;
                }
            }
        } catch (Throwable $e) {
            // Fallback gracefully
        }

        return self::defaultEvents();
    }

    /**
     * Default events fallback
     */
    public static function defaultEvents(): Collection
    {
        $akad = new self;
        $akad->forceFill([
            'id' => 1,
            'title' => 'Akad Nikah',
            'date_text' => 'Senin, 28 Desember 2026',
            'event_datetime' => '2026-12-28 08:00:00',
            'time_text' => 'Pukul 08.00 WIB - Selesai',
            'venue_name' => 'Kediaman Mempelai Wanita',
            'venue_address' => 'Ds Pagu, Wates, Kediri, Jawa Timur',
            'maps_url' => 'https://maps.google.com/?q=Pagu+Wates+Kediri',
            'calendar_url' => 'https://calendar.google.com/calendar/render?action=TEMPLATE&text=Akad+Nikah+Habib+%26+Adiba&dates=20261228T010000Z/20261228T040000Z&details=Akad+Nikah+Habib+dan+Adiba&location=Kediaman+Mempelai+Wanita+Ds+Pagu+Wates+Kediri',
            'order' => 1,
        ]);

        $resepsi = new self;
        $resepsi->forceFill([
            'id' => 2,
            'title' => 'Resepsi Pernikahan',
            'date_text' => 'Senin, 28 Desember 2026',
            'event_datetime' => '2026-12-28 10:00:00',
            'time_text' => 'Pukul 10.00 WIB - Selesai',
            'venue_name' => 'Kediaman Mempelai Wanita',
            'venue_address' => 'Ds Pagu, Wates, Kediri, Jawa Timur',
            'maps_url' => 'https://maps.google.com/?q=Pagu+Wates+Kediri',
            'calendar_url' => 'https://calendar.google.com/calendar/render?action=TEMPLATE&text=Resepsi+Pernikahan+Habib+%26+Adiba&dates=20261228T030000Z/20261228T090000Z&details=Resepsi+Pernikahan+Habib+dan+Adiba&location=Kediaman+Mempelai+Wanita+Ds+Pagu+Wates+Kediri',
            'order' => 2,
        ]);

        return new Collection([$akad, $resepsi]);
    }
}
