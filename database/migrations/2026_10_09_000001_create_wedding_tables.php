<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wedding_settings', function (Blueprint $table) {
            $table->id();

            // Groom
            $table->string('groom_name')->default('Habib Yulianto');
            $table->string('groom_nickname')->default('Habib');
            $table->string('groom_father')->nullable()->default('M. Dawam');
            $table->string('groom_mother')->nullable()->default('Dewi Sudarwati');
            $table->string('groom_parent_status')->nullable()->default('Putra Kedua dari Bapak M. Dawam & (Almh) Ibu Dewi Sudarwati');
            $table->string('groom_instagram')->nullable()->default('@habib');
            $table->string('groom_photo')->nullable();

            // Bride
            $table->string('bride_name')->default('Adiba Putri Syakila');
            $table->string('bride_nickname')->default('Adiba');
            $table->string('bride_father')->nullable()->default('Anas Rifai');
            $table->string('bride_mother')->nullable()->default('Kholifah');
            $table->string('bride_parent_status')->nullable()->default('Putri Pertama dari Bapak Anas Rifai & Ibu Kholifah');
            $table->string('bride_instagram')->nullable()->default('@adiba');
            $table->string('bride_photo')->nullable();

            // Cover & Hero Photos
            $table->string('cover_photo')->nullable();
            $table->string('hero_photo')->nullable();

            // Quotes
            $table->text('quote_arabic')->nullable();
            $table->text('quote_text')->nullable();
            $table->string('quote_source')->nullable()->default('(Qs. Ar-Rum : 21)');

            // Background Music & Video
            $table->string('background_music')->nullable();
            $table->dateTime('wedding_date')->nullable();
            $table->string('video_url')->nullable();

            // Gift / Amplop Address
            $table->string('gift_recipient_name')->nullable()->default('Habib Yulianto');
            $table->string('gift_phone')->nullable()->default('081234567890');
            $table->text('gift_address')->nullable();

            // Live Streaming
            $table->boolean('stream_enabled')->default(true);
            $table->string('stream_platform')->nullable()->default('YouTube / Instagram');
            $table->string('stream_url')->nullable()->default('https://instagram.com');
            $table->string('stream_time')->nullable()->default('Senin, 28 Desember 2026 - Pukul 08.00 WIB');

            $table->timestamps();
        });

        Schema::create('wedding_events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g. Akad Nikah, Resepsi
            $table->string('date_text');
            $table->dateTime('event_datetime')->nullable();
            $table->string('time_text');
            $table->string('venue_name');
            $table->text('venue_address');
            $table->text('maps_url')->nullable();
            $table->text('calendar_url')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('love_stories', function (Blueprint $table) {
            $table->id();
            $table->string('year_or_date')->nullable();
            $table->string('title');
            $table->text('story');
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');
            $table->string('caption')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name'); // e.g. BCA, Mandiri, BRI, QRIS
            $table->string('account_number');
            $table->string('account_holder');
            $table->string('qris_image')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('rsvps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('attendance')->default('hadir'); // hadir, tidak_hadir, ragu
            $table->integer('guest_count')->default(1);
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsvps');
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('love_stories');
        Schema::dropIfExists('wedding_events');
        Schema::dropIfExists('wedding_settings');
    }
};
