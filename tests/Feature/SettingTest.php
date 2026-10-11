<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;

test('updating settings validates background music file format and size', function () {
    $user = User::factory()->make([
        'id' => 1,
        'email' => 'admin@gmail.com',
    ]);

    // An invalid file type (e.g. PDF)
    $invalidFile = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

    $response = $this->actingAs($user)->post(route('admin.settings.update'), [
        'groom_name' => 'Habib Yulianto',
        'groom_nickname' => 'Habib',
        'bride_name' => 'Adiba Putri Syakila',
        'bride_nickname' => 'Adiba',
        'background_music_file' => $invalidFile,
    ]);

    $response->assertSessionHasErrors(['background_music_file']);
});
