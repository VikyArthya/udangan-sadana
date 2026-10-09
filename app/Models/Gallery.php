<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Throwable;

class Gallery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function getGalleries(): Collection
    {
        try {
            if (Schema::hasTable('galleries')) {
                $items = self::orderBy('order')->get();
                if ($items->isNotEmpty()) {
                    return $items;
                }
            }
        } catch (Throwable $e) {
            // Fallback
        }

        return self::defaultGalleries();
    }

    public static function defaultGalleries(): Collection
    {
        $urls = [
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/awal-3.jpg',
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/23RSW2031-co.jpg',
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/8-.jpg',
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/7-.jpg',
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/5-.jpg',
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/1-e1740985931589.jpg',
        ];

        $collection = new Collection;
        foreach ($urls as $i => $url) {
            $g = new self;
            $g->forceFill([
                'id' => $i + 1,
                'image_url' => $url,
                'caption' => 'Prewedding Moment '.($i + 1),
                'order' => $i + 1,
            ]);
            $collection->push($g);
        }

        return $collection;
    }
}
