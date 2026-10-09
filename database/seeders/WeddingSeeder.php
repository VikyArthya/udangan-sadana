<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use App\Models\Gallery;
use App\Models\LoveStory;
use App\Models\Rsvp;
use App\Models\WeddingEvent;
use App\Models\WeddingSetting;
use Illuminate\Database\Seeder;

class WeddingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Wedding Settings
        WeddingSetting::updateOrCreate(
            ['id' => 1],
            [
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
            ]
        );

        // 2. Events
        WeddingEvent::truncate();
        WeddingEvent::create([
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

        WeddingEvent::create([
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

        // 3. Love Stories
        LoveStory::truncate();
        LoveStory::create([
            'year_or_date' => 'Awal Cerita',
            'title' => 'Pertemuan Pertama',
            'story' => 'Berawal dari pertemuan sederhana, kami saling mengenal dan mulai berbagi banyak cerita. Tanpa disadari, kebersamaan itu tumbuh menjadi rasa nyaman yang semakin kuat dari hari ke hari.',
            'image' => 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/awal-3.jpg',
            'order' => 1,
        ]);
        LoveStory::create([
            'year_or_date' => 'Komitmen',
            'title' => 'Momen Lamaran',
            'story' => 'Dengan niat yang tulus dan restu keluarga, kami memutuskan untuk melangkah ke tahap yang lebih serius. Momen lamaran menjadi awal dari perjalanan baru yang penuh harapan dan doa baik.',
            'image' => 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/1-e1740985931589.jpg',
            'order' => 2,
        ]);
        LoveStory::create([
            'year_or_date' => 'Hari Bahagia',
            'title' => 'Pernikahan Suci',
            'story' => 'Kini kami sampai pada hari yang kami nantikan, hari di mana dua hati dipersatukan dalam ikatan suci pernikahan. Semoga langkah ini menjadi awal kehidupan baru yang penuh cinta, kebahagiaan, dan keberkahan.',
            'image' => 'https://inv.punakawandigital.id/wp-content/uploads/2026/06/23RSW2031-co.jpg',
            'order' => 3,
        ]);

        // 4. Galleries
        Gallery::truncate();
        $urls = [
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/awal-3.jpg',
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/23RSW2031-co.jpg',
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/8-.jpg',
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/7-.jpg',
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/5-.jpg',
            'https://inv.punakawandigital.id/wp-content/uploads/2026/06/1-e1740985931589.jpg',
        ];
        foreach ($urls as $i => $url) {
            Gallery::create([
                'image_url' => $url,
                'caption' => 'Prewedding Photo '.($i + 1),
                'order' => $i + 1,
            ]);
        }

        // 5. Bank Accounts
        BankAccount::truncate();
        BankAccount::create([
            'bank_name' => 'BCA',
            'account_number' => '1234567890',
            'account_holder' => 'Habib Yulianto',
            'order' => 1,
        ]);
        BankAccount::create([
            'bank_name' => 'MANDIRI',
            'account_number' => '9876543210123',
            'account_holder' => 'Adiba Putri Syakila',
            'order' => 2,
        ]);

        // 6. Initial RSVP
        Rsvp::truncate();
        Rsvp::create([
            'name' => 'Dimas & Keluarga',
            'attendance' => 'hadir',
            'guest_count' => 2,
            'message' => 'Barakallahu lakuma wa baraka alaikuma wa jama\'a bainakuma fii khoir. Selamat menempuh hidup baru Habib & Adiba! Semoga menjadi keluarga yang sakinah mawaddah warahmah.',
        ]);
        Rsvp::create([
            'name' => 'Siti Aisyah',
            'attendance' => 'hadir',
            'guest_count' => 1,
            'message' => 'Happy wedding Adiba & Mas Habib! Semoga bahagia selalu sampai maut memisahkan dan lekas diberikan momongan.',
        ]);
        Rsvp::create([
            'name' => 'Budi Santoso',
            'attendance' => 'tidak_hadir',
            'guest_count' => 0,
            'message' => 'Selamat berbahagia sahabatku! Mohon maaf belum bisa hadir langsung karena masih di luar kota. Doa terbaik untuk kalian berdua.',
        ]);
    }
}
