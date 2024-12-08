<?php

use App\Http\Controllers\ChamberoProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Models\Canton;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [ChamberoProfileController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('chambero_profiles', ChamberoProfileController::class);


Route::get('/cantones/{province}', [LocationController::class, 'getCantones']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
