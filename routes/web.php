<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/filter-blogs', [BlogController::class, 'filter']);

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [BlogController::class, 'index'])->name('dashboard');

    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');

    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');

    Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');

    Route::post('/blogs/{id}/update', [BlogController::class, 'update'])->name('blogs.update');

    Route::delete('/blogs/{id}/delete', [BlogController::class, 'destroy'])->name('blogs.destroy');});

require __DIR__.'/auth.php';