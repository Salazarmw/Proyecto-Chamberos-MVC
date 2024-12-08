<?php

use App\Http\Controllers\ChamberoProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Models\Canton;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/dashboard', [ChamberoProfileController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('chambero_profiles', ChamberoProfileController::class);


Route::get('/cantones/{province}', [LocationController::class, 'getCantones']);

Route::get('/cantones/{province}', [LocationController::class, 'getCantones']);

Route::get('/cantones/{province}', [LocationController::class, 'getCantones']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
