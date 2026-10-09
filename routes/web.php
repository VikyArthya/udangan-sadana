<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BankAccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\LoveStoryController;
use App\Http\Controllers\Admin\RsvpController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Wedding Invitation Routes
Route::get('/', [InvitationController::class, 'index'])->name('invitation.index');
Route::post('/rsvp', [InvitationController::class, 'storeRsvp'])->name('invitation.rsvp');
Route::get('/api/wishes', [InvitationController::class, 'getWishes'])->name('invitation.wishes');

// Login Route for standard Laravel Auth middleware fallback
Route::redirect('/login', '/admin/login')->name('login');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Wedding General Settings (Bride, Groom, Music, etc.)
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Events Management (Akad & Resepsi)
        Route::get('/events', [EventController::class, 'index'])->name('events.index');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

        // Love Story Timeline
        Route::get('/stories', [LoveStoryController::class, 'index'])->name('stories.index');
        Route::post('/stories', [LoveStoryController::class, 'store'])->name('stories.store');
        Route::put('/stories/{id}', [LoveStoryController::class, 'update'])->name('stories.update');
        Route::delete('/stories/{id}', [LoveStoryController::class, 'destroy'])->name('stories.destroy');

        // Gallery & Video
        Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
        Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
        Route::delete('/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
        Route::post('/galleries/video', [GalleryController::class, 'updateVideo'])->name('galleries.video');

        // Bank Accounts & Gift Delivery Address
        Route::get('/banks', [BankAccountController::class, 'index'])->name('banks.index');
        Route::post('/banks', [BankAccountController::class, 'store'])->name('banks.store');
        Route::post('/banks/address', [BankAccountController::class, 'updateAddress'])->name('banks.address');
        Route::delete('/banks/{id}', [BankAccountController::class, 'destroy'])->name('banks.destroy');

        // RSVP & Guest Wishes Management
        Route::get('/rsvps', [RsvpController::class, 'index'])->name('rsvps.index');
        Route::delete('/rsvps/{id}', [RsvpController::class, 'destroy'])->name('rsvps.destroy');

        // WhatsApp Guest Link Generator
        Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
    });
});
