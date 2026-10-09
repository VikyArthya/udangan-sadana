<?php

test('invitation page displays recipient name correctly', function () {
    $response = $this->get('/?to=Bapak+Joko+Widodo');

    $response->assertStatus(200);
    $response->assertSee('Bapak Joko Widodo');
    $response->assertSee('The Wedding of');
    $response->assertSee('Buka Undangan');
});

test('rsvp endpoint accepts submission and returns json', function () {
    $response = $this->postJson('/rsvp', [
        'name' => 'Keluarga Budi Santoso',
        'attendance' => 'hadir',
        'guest_count' => 2,
        'message' => 'Selamat menempuh hidup baru!',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'success' => true,
    ]);
});

test('admin login page loads successfully', function () {
    $response = $this->get('/admin/login');

    $response->assertStatus(200);
    $response->assertSee('Panel Admin');
});

test('admin login succeeds with default credentials', function () {
    $response = $this->withSession(['_token' => 'test-token'])->post('/admin/login', [
        '_token' => 'test-token',
        'email' => 'admin@gmail.com',
        'password' => 'admin123',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
});

test('unauthenticated user accessing /admin is redirected to /admin/login', function () {
    $response = $this->get('/admin');

    $response->assertRedirect('/admin/login');
});

test('invitation page displays dynamic galleries and wedding settings', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Galeri Foto');
    $response->assertSee('elementor-gallery__container');
});

test('invitation page displays love stories section dynamically', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Love Story');
    $response->assertSee('idb-timeline');
});
