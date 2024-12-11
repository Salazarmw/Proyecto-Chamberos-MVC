<?php
// routes/web.php
use App\Http\Controllers\ChamberoProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Models\Canton;
use App\Http\Controllers\quotationController;
use App\Models\Quotation;
use App\Http\Controllers\quotationController;
use App\Models\Quotation;
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


Route::get('/cantones/{province}', [LocationController::class, 'getCantones']);
Route::get('/dashboard', [ChamberoProfileController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('chambero_profiles', ChamberoProfileController::class);


Route::get('/cantones/{province}', [LocationController::class, 'getCantones']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ChamberoProfileController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/reviews/{user}', [ReviewController::class, 'index']);
    Route::get('/quotations', [quotationController::class, 'index'])->name('quotations');
    Route::get('/quotations/create/{chamberoId}', [quotationController::class, 'create'])->name('quotations.create');
    Route::post('/quotations', [QuotationController::class, 'store'])->name('quotations.store');
    Route::post('/quotations/{id}/accept', [QuotationController::class, 'accept'])->name('quotations.accept');
    Route::post('/quotations/{id}/reject', [QuotationController::class, 'reject'])->name('quotations.reject');
    Route::put('/quotations/{id}/counteroffer', [quotationController::class, 'updateCounteroffer'])->name('quotations.updateCounteroffer');
    Route::get('/quotations/{id}/counteroffer', function ($id) {
        $quotation = Quotation::findOrFail($id);
        return view('quotations.counteroffer', compact('quotation'));
    })->name('quotations.counteroffer.view');
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
    Route::post('/jobs/{id}/update', [JobController::class, 'updateJobStatus']);
    Route::get('/reviews/create/{job}', [ReviewController::class, 'create']);
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::get('/reviews/{user}', [ReviewController::class, 'index']);

Route::get('/api/cantons/{provinceId}', function ($provinceId) {
    return Canton::where('province_id', $provinceId)->get(['id', 'name']);
});
Route::get('/quotations', [quotationController::class, 'index'])->middleware(['auth', 'verified'])->name('quotations');
Route::get('/quotations/create/{chamberoId}', [quotationController::class, 'create'])->name('quotations.create');
Route::post('/quotations', [QuotationController::class, 'store'])->name('quotations.store');
Route::post('/quotations/{id}/accept', [QuotationController::class, 'accept'])->name('quotations.accept');
Route::post('/quotations/{id}/reject', [QuotationController::class, 'reject'])->name('quotations.reject');
Route::put('/quotations/{id}/counteroffer', [quotationController::class, 'updateCounteroffer'])->name('quotations.updateCounteroffer');

Route::get('/quotations/{id}/counteroffer', function ($id) {
    $quotation = Quotation::findOrFail($id);
    return view('quotations.counteroffer', compact('quotation'));
})->name('quotations.counteroffer.view');


Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
Route::post('/jobs/{id}/update', [JobController::class, 'updateJobStatus']);


require __DIR__ . '/auth.php';
