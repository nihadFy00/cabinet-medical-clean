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

// 2. Redirection apres Login
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->hasRole('admin'))     return redirect()->route('admin.dashboard');
    if ($user->hasRole('doctor'))    return redirect()->route('doctor.dashboard');
    if ($user->hasRole('secretary')) return redirect()->route('secretary.dashboard');
    if ($user->hasRole('patient'))   return redirect()->route('patient.dashboard');
    abort(403, 'Acces refuse : Aucun role assigne.');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Dashboards par role
Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard',      [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/statistiques',   [AdminController::class, 'statistiques'])->name('admin.statistiques');
        Route::get('/admin/configuration',  [AdminController::class, 'configuration'])->name('admin.configuration');
    });
    Route::middleware('role:doctor')->group(function () {
        Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    });
    Route::middleware('role:secretary')->group(function () {
        Route::get('/secretary/dashboard', [SecretaryController::class, 'dashboard'])->name('secretary.dashboard');
    });
    Route::middleware('role:patient')->group(function () {
        Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    });
});

// 5. Resources
Route::middleware('auth')->group(function () {

    // Admin + Secretaire : gestion patients et medecins
    Route::middleware('role:admin|secretary')->group(function () {
        Route::resource('patients', PatientController::class);
        Route::resource('medecins',  MedecinController::class);
    });

    // Rendezvous : tous les roles
    Route::resource('rendezvous', RendezvousController::class);

    // Consultations : admin + doctor
    Route::middleware('role:admin|doctor')->group(function () {
        Route::resource('consultations', ConsultationController::class);
    });

    // Ordonnances : admin + doctor + patient (read only for patient)
    Route::middleware('role:admin|doctor|patient')->group(function () {
        Route::resource('ordonnances', OrdonnanceController::class);
        Route::get('ordonnances/{ordonnance}/pdf', [OrdonnanceController::class, 'generatePDF'])->name('ordonnances.pdf');
    });
});

// 6. Auth
require __DIR__.'/auth.php';
