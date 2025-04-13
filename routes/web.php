<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormuleController;
use App\Http\Controllers\CalculController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/formules', [FormuleController::class, 'index'])->middleware('auth')->name('formules.index');
    Route::get('/formules/{id}', [FormuleController::class, 'show'])->name('formules.show');
    Route::post('/calculer', [CalculController::class, 'calculer'])->name('calculer');
    Route::get('/pdf/{id}', [CalculController::class, 'genererPDF'])->name('pdf.generer');
});

require __DIR__.'/auth.php';
