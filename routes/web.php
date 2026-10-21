<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/destinations', [\App\Http\Controllers\DestinationController::class, 'index'])->name('destinations');
Route::get('/destinations/{slug}', [\App\Http\Controllers\DestinationController::class, 'show'])->name('destinations.show');
Route::get('/plan', [\App\Http\Controllers\QuizController::class, 'show'])->name('plan');
Route::post('/plan', [\App\Http\Controllers\QuizController::class, 'submit'])->name('plan.submit');
Route::get('/plan/results', [\App\Http\Controllers\QuizController::class, 'results'])->name('plan.results');
Route::get('/plan/reset', [\App\Http\Controllers\QuizController::class, 'reset'])->name('plan.reset');
Route::get('/interest/{interest?}', [\App\Http\Controllers\DestinationController::class, 'exploreByInterest'])->name('interest');
Route::get('/stays', [\App\Http\Controllers\BrowseController::class, 'stays'])->name('stays');
Route::get('/eat', [\App\Http\Controllers\BrowseController::class, 'eat'])->name('eat');
Route::get('/recreation', [\App\Http\Controllers\BrowseController::class, 'recreation'])->name('recreation');
Route::post('/picks', [\App\Http\Controllers\BrowseController::class, 'savePick'])->name('picks.save');
Route::get('/saved', [\App\Http\Controllers\SavedTripController::class, 'index'])->name('saved');
Route::post('/saved', [\App\Http\Controllers\SavedTripController::class, 'store'])->name('saved.store');
Route::delete('/saved/{savedTrip}', [\App\Http\Controllers\SavedTripController::class, 'destroy'])->name('saved.destroy');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/currency/{currency}', [\App\Http\Controllers\CurrencyController::class, 'setCurrency'])->name('currency.set');

