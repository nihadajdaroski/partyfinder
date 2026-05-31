<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartyController;

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [PartyController::class, 'index']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/parties/{party}/join', [PartyController::class, 'join'])->name('parties.join');
    Route::delete('/parties/{party}/leave', [PartyController::class, 'leave'])->name('parties.leave');
    Route::resource('parties', PartyController::class);
});

require __DIR__.'/auth.php';