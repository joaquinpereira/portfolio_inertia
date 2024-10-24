<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TechnologyTypeController;
use App\Http\Controllers\TechnologyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('main');
    // return Inertia::render('Welcome');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('technology_type', TechnologyTypeController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('technologies', TechnologyController::class)->only(['index', 'store', 'update', 'destroy']);
});

require __DIR__ . '/auth.php';
