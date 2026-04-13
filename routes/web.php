<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SecretaryController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\OrdonnanceController;

// 1. Accueil
Route::get("/", function () {
    return view("welcome");
});

// 2. Agent de circulation : Redirection intelligente après Login
// Cette route remplace le dashboard par défaut de Laravel
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('doctor')) {
        return redirect()->route('doctor.dashboard');
    } elseif ($user->hasRole('secretary')) {
        return redirect()->route('secretary.dashboard');
    } elseif ($user->hasRole('patient')) {
        return redirect()->route('patient.dashboard');
    }

    abort(403, 'Accès refusé : Aucun rôle assigné.');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Routes communes (Profil)
Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
    Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::delete("/profile", [ProfileController::class, "destroy"])->name("profile.destroy");
});

// 4. Dashboards Spécifiques par Rôle
Route::middleware(['auth'])->group(function () {
    
    // Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });

    // Docteur
    Route::middleware(['role:doctor'])->group(function () {
        Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    });

    // Secrétaire
    Route::middleware(['role:secretary'])->group(function () {
        Route::get('/secretary/dashboard', [SecretaryController::class, 'dashboard'])->name('secretary.dashboard');
    });

    // Patient
    Route::middleware(['role:patient'])->group(function () {
        Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    });
});

// 5. Gestion des Ressources (Accès selon rôles)
Route::middleware(['auth'])->group(function () {
    // Patients et Médecins : Admin et Secrétaire uniquement
    Route::middleware(['role:admin|secretary'])->group(function () {
        Route::resource('patients', PatientController::class);
        Route::resource('medecins', MedecinController::class);
    });

    // Rendez-vous : Tout le monde (le filtrage se fait dans le contrôleur)
    Route::resource('rendezvous', RendezvousController::class);

    // Consultations et Ordonnances : Admin et Docteur
    Route::middleware(['role:admin|doctor'])->group(function () {
        Route::resource('consultations', ConsultationController::class);
        Route::resource('ordonnances', OrdonnanceController::class);
    });
});

// 6. Authentification Laravel (Breeze/Fortify)
require __DIR__.'/auth.php';