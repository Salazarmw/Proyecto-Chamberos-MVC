<?php

use App\Http\Controllers\ChamberoProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Models\Canton;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        // If there is an authenticated user, redirect to the dashboard
        return redirect()->route('dashboard');
    } else {
        // If there is no authenticated user, show the login view
        return view('auth.login');
    }
});

Route::resource('chambero_profiles', ChamberoProfileController::class);

Route::get('/cantones/{province}', [LocationController::class, 'getCantones']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ChamberoProfileController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    //Route::get('/quotations/create', [QuotationController::class, 'create'])->name('quotations.create');
});

Route::get('/reviews/{user}', [ReviewController::class, 'index']);

Route::get('/api/cantons/{provinceId}', function ($provinceId) {
    return Canton::where('province_id', $provinceId)->get(['id', 'name']);
});

require __DIR__ . '/auth.php';
