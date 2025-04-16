<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormuleController;
use App\Http\Controllers\CalculController;
use App\Http\Controllers\CalculPDFController;
use Illuminate\Support\Facades\Route;

// 👋 Accueil
Route::get('/', function () {
    return view('welcome');
});

// 🔐 Dashboard utilisateur par défaut (non admin)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔐 Routes pour utilisateurs authentifiés (tous rôles confondus)
Route::middleware('auth')->group(function () {
    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Consultation et utilisation des formules
    Route::get('/formules', [FormuleController::class, 'index'])->name('formules.index');
    Route::get('/formules/{id}', [FormuleController::class, 'show'])->name('formules.show');
    Route::post('/calculer', [CalculController::class, 'calculer'])->name('calculer');
    Route::get('/pdf/{id}', [CalculController::class, 'genererPDF'])->name('pdf.generer');

    // Génération PDF
    Route::post('/calcul/pdf', [CalculPDFController::class, 'generatePDF'])->name('calcul.pdf');
});

// 🛡️ Routes pour administrateur uniquement
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Crée cette vue dans resources/views/admin/dashboard.blade.php
    })->name('admin.dashboard');

    // Tu peux ajouter ici d'autres routes réservées à l'admin
    // Exemple :
    // Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
});

require __DIR__.'/auth.php';
