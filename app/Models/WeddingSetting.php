<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Throwable;

class WeddingSetting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'wedding_date' => 'datetime',
        'stream_enabled' => 'boolean',
    ];

    /**
     * Get wedding settings or return default fallback if table does not exist or empty.
     */
    public static function getSettings(): self
    {
        try {
            if (Schema::hasTable('wedding_settings')) {
                $setting = self::first();
                if ($setting) {
                    return $setting;
                }
            }
        } catch (Throwable $e) {
            // Fallback gracefully if database is not yet migrated or unreachable
        }

        return self::defaultSetting();
    }

    /**
     * Create default setting instance
     */
    public static function defaultSetting(): self
    {
        $setting = new self;
        $setting->forceFill([
            'id' => 1,
            'groom_name' => 'Habib Yulianto',
            'groom_nickname' => 'Habib',
            'groom_father' => 'M. Dawam',
            'groom_mother' => 'Dewi Sudarwati',
            'groom_parent_status' => 'Putra Kedua dari Bapak M. Dawam & (Almh) Ibu Dewi Sudarwati',
            'groom_instagram' => 'habibyulianto',
            'groom_photo' => 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/awal-3.jpg',

            'bride_name' => 'Adiba Putri Syakila',
            'bride_nickname' => 'Adiba',
            'bride_father' => 'Anas Rifai',
            'bride_mother' => 'Kholifah',
            'bride_parent_status' => 'Putri Pertama dari Bapak Anas Rifai & Ibu Kholifah',
            'bride_instagram' => 'adibaputri',
            'bride_photo' => 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/23RSW2031-co.jpg',

            'cover_photo' => 'https://inv.punakawandigital.id/wp-content/uploads/2025/05/Premium-Vintage-03-3.webp',
            'hero_photo' => 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/merah-art-numga-3.webp',

            'quote_arabic' => 'وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ أَنفُسِكُمْ أَزْوَاجًا لِّتَسْكُنُوا إِلَيْهَا وَجَعَلَ بَيْنَكُم مَّوَدَّةً وَرَحْمَةً',
            'quote_text' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda (kebesaran Allah) bagi kaum yang berpikir.',
            'quote_source' => '(Qs. Ar-Rum : 21)',

            'background_music' => 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/golden-hour-jvke-cinematic-violin-cover.mp3',
            'wedding_date' => '2026-12-28 08:00:00',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',

            'gift_recipient_name' => 'Habib Yulianto',
            'gift_phone' => '081234567890',
            'gift_address' => 'Ds Pagu Kec. Wates Kab. Kediri, Jawa Timur (Kode Pos 64174)',

            'stream_enabled' => true,
            'stream_platform' => 'Instagram Live & YouTube',
            'stream_url' => 'https://instagram.com/habibyulianto',
            'stream_time' => 'Senin, 28 Desember 2026 - Pukul 08.00 WIB',
        ]);

        return $setting;
    }
}
