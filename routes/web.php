<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/destinations', [PageController::class, 'destinations'])->name('destinations');
Route::get('/plan', [PageController::class, 'plan'])->name('plan');
Route::get('/interest/{interest?}', [PageController::class, 'interest'])->name('interest');
Route::get('/saved', [PageController::class, 'saved'])->name('saved');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/currency/{currency}', [\App\Http\Controllers\CurrencyController::class, 'setCurrency'])->name('currency.set');

