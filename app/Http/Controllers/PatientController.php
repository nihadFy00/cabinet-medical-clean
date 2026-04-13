<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Afficher le tableau de bord du patient connecté
     */
    public function dashboard()
    {
        return view('patient.dashboard');
    }

    /**
     * Liste des patients (pour Admin/Secrétaire) avec recherche
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::with('user') 
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->paginate(10); 

        return view('patients.index', compact('patients'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Enregistrer un nouveau patient
     */
    public function store(Request $request)
    {
        // 1. Validation des données 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'birth_date' => 'required|date',
            'medical_history' => 'nullable|string',
        ]);

        // 2. Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'),
            'role' => 'patient', // Assure-toi que ton système gère ce champ ou utilise Spatie
        ]);

        // 3. Création de la fiche patient liée
        Patient::create([
            'user_id' => $user->id,
            'code_patient' => 'P-' . strtoupper(substr(uniqid(), -5)), 
            'nom' => $request->name, 
            'prenom' => 'Patient', 
            'date_naissance' => $request->birth_date,
            'genre' => $request->genre ?? 'M',
            'telephone' => '0000000000',
            'antecedents_medicaux' => $request->medical_history ?? 'Aucun',
        ]);

        return redirect()->back()->with('success', 'Patient créé avec succès !');
    }

    /**
     * Voir le profil complet d'un patient
     */
    public function show(Patient $patient)
    {
        $patient->load(['user', 'consultations.ordonnance', 'consultations.medecin.user']);
        return view('patients.show', compact('patient'));
    }
}