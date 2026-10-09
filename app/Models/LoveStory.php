<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Throwable;

class LoveStory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function getStories(): Collection
    {
        try {
            if (Schema::hasTable('love_stories')) {
                $stories = self::orderBy('order')->get();
                if ($stories->isNotEmpty()) {
                    return $stories;
                }
            }
        } catch (Throwable $e) {
            // Fallback
        }

        return self::defaultStories();
    }

    public static function defaultStories(): Collection
    {
        $s1 = new self;
        $s1->forceFill([
            'id' => 1,
            'year_or_date' => 'Awal Cerita',
            'title' => 'Pertemuan Pertama',
            'story' => 'Berawal dari pertemuan sederhana, kami saling mengenal dan mulai berbagi banyak cerita. Tanpa disadari, kebersamaan itu tumbuh menjadi rasa nyaman yang semakin kuat dari hari ke hari.',
            'image' => 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/awal-3.jpg',
            'order' => 1,
        ]);

        $s2 = new self;
        $s2->forceFill([
            'id' => 2,
            'year_or_date' => 'Komitmen',
            'title' => 'Momen Lamaran',
            'story' => 'Dengan niat yang tulus dan restu keluarga, kami memutuskan untuk melangkah ke tahap yang lebih serius. Momen lamaran menjadi awal dari perjalanan baru yang penuh harapan dan doa baik.',
            'image' => 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/1-e1740985931589.jpg',
            'order' => 2,
        ]);

        $s3 = new self;
        $s3->forceFill([
            'id' => 3,
            'year_or_date' => 'Hari Bahagia',
            'title' => 'Pernikahan Suci',
            'story' => 'Kini kami sampai pada hari yang kami nantikan, hari di mana dua hati dipersatukan dalam ikatan suci pernikahan. Semoga langkah ini menjadi awal kehidupan baru yang penuh cinta, kebahagiaan, dan keberkahan.',
            'image' => 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/23RSW2031-co.jpg',
            'order' => 3,
        ]);

        return new Collection([$s1, $s2, $s3]);
    }
}
