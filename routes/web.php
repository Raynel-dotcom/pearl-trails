<?php

use App\Http\Controllers\AdminListingController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SavedTripController;
use App\Http\Controllers\VendorListingController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations');
Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');
Route::get('/interest/{interest?}', [DestinationController::class, 'exploreByInterest'])->name('interest');

// Quiz
Route::get('/plan', [QuizController::class, 'show'])->name('plan');
Route::post('/plan', [QuizController::class, 'submit'])->name('plan.submit');
Route::get('/plan/results', [QuizController::class, 'results'])->name('plan.results');
Route::get('/plan/reset', [QuizController::class, 'reset'])->name('plan.reset');

// Stays, Eat, Recreation
Route::get('/stays', [BrowseController::class, 'stays'])->name('stays');
Route::get('/eat', [BrowseController::class, 'eat'])->name('eat');
Route::get('/recreation', [BrowseController::class, 'recreation'])->name('recreation');
Route::post('/picks', [BrowseController::class, 'savePick'])->name('picks.save');

// Saved Trips
Route::get('/saved', [SavedTripController::class, 'index'])->name('saved');
Route::post('/saved', [SavedTripController::class, 'store'])->name('saved.store');
Route::delete('/saved/{savedTrip}', [SavedTripController::class, 'destroy'])->name('saved.destroy');

// Currency Switcher
Route::get('/currency/{currency}', [CurrencyController::class, 'setCurrency'])->name('currency.set');

// Static / Informational Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');

// Vendor Business Listing Form
Route::get('/list-your-business', [VendorListingController::class, 'create'])->name('list-your-business');
Route::get('/list-business', fn() => redirect()->route('list-your-business'))->name('list-business');
Route::post('/list-your-business', [VendorListingController::class, 'store'])->middleware('auth')->name('list-your-business.store');
Route::post('/list-business', [VendorListingController::class, 'store'])->middleware('auth')->name('list-business.store');

// Vendor Dashboard
Route::middleware('auth')->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', [VendorListingController::class, 'index'])->name('dashboard');
    Route::get('/listings', [VendorListingController::class, 'index'])->name('listings');
    Route::post('/listings', [VendorListingController::class, 'store'])->name('listings.store');
    Route::get('/listings/{listing}/edit', [VendorListingController::class, 'edit'])->name('listings.edit');
    Route::put('/listings/{listing}', [VendorListingController::class, 'update'])->name('listings.update');
    Route::delete('/listings/{listing}', [VendorListingController::class, 'destroy'])->name('listings.destroy');
});

use App\Http\Middleware\EnsureAdmin;

// Admin Moderation
Route::middleware(['auth', EnsureAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/listings', [AdminListingController::class, 'index'])->name('listings');
    Route::post('/listings/{listing}/approve', [AdminListingController::class, 'approve'])->name('listings.approve');
    Route::post('/listings/{listing}/reject', [AdminListingController::class, 'reject'])->name('listings.reject');
    Route::delete('/listings/{listing}', [AdminListingController::class, 'destroy'])->name('listings.destroy');
});

// User Profile & Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.listings');
        } elseif (auth()->user()->isVendor()) {
            return redirect()->route('vendor.listings');
        }
        return redirect()->route('saved');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
