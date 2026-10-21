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
Route::get('/saved', [PageController::class, 'saved'])->name('saved');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/currency/{currency}', [\App\Http\Controllers\CurrencyController::class, 'setCurrency'])->name('currency.set');

