<?php

use App\Livewire\CricketBannerGenerator;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::get('/cricket-banner-generator', CricketBannerGenerator::class);
Route::get('/banner-preview', function () {
    // Retrieve the generated banner URL from the query parameter
    $bannerUrl = request()->query('banner');

    // Render the BannerPreview Livewire component with the banner URL
    return view('banner-preview', ['bannerUrl' => $bannerUrl]);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
