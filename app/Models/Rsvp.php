<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Throwable;

class Rsvp extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function getRecentWishes(int $limit = 30): Collection
    {
        try {
            if (Schema::hasTable('rsvps')) {
                return self::latest()->take($limit)->get();
            }
        } catch (Throwable $e) {
            // Fallback
        }

        return self::defaultWishes();
    }

    public static function defaultWishes(): Collection
    {
        $w1 = new self;
        $w1->forceFill([
            'id' => 1,
            'name' => 'Dimas & Keluarga',
            'attendance' => 'hadir',
            'guest_count' => 2,
            'message' => 'Barakallahu lakuma wa baraka alaikuma wa jama\'a bainakuma fii khoir. Selamat menempuh hidup baru Habib & Adiba! Semoga menjadi keluarga yang sakinah mawaddah warahmah.',
            'created_at' => now()->subHours(2),
        ]);

        $w2 = new self;
        $w2->forceFill([
            'id' => 2,
            'name' => 'Siti Aisyah',
            'attendance' => 'hadir',
            'guest_count' => 1,
            'message' => 'Happy wedding Adiba & Mas Habib! Semoga bahagia selalu sampai maut memisahkan dan lekas diberikan momongan.',
            'created_at' => now()->subHours(5),
        ]);

        $w3 = new self;
        $w3->forceFill([
            'id' => 3,
            'name' => 'Budi Santoso',
            'attendance' => 'tidak_hadir',
            'guest_count' => 0,
            'message' => 'Selamat berbahagia sahabatku! Mohon maaf belum bisa hadir langsung karena masih di luar kota. Doa terbaik untuk kalian berdua.',
            'created_at' => now()->subDay(),
        ]);

        return new Collection([$w1, $w2, $w3]);
    }
}
