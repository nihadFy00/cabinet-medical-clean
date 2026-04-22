<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function dashboard()
    {
        return view('patient.dashboard');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $patients = Patient::when($search, function ($query, $search) {
                return $query->where('nom', 'like', "%{$search}%")
                             ->orWhere('prenom', 'like', "%{$search}%");
            })->paginate(10);
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'nullable|email|unique:patients,email',
            'birth_date'     => 'required|date',
            'genre'          => 'required|in:Homme,Femme',
            'telephone'      => 'nullable|string',
            'groupe_sanguin' => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        $fullName = explode(' ', $request->name, 2);
        $nom    = $fullName[0];
        $prenom = $fullName[1] ?? '';

        Patient::create([
            'code_patient'        => 'P-' . strtoupper(substr(uniqid(), -5)),
            'nom'                 => $nom,
            'prenom'              => $prenom,
            'date_naissance'      => $request->birth_date,
            'genre'               => $request->genre,
            'telephone'           => $request->telephone ?? '0000000000',
            'email'               => $request->email,
            'antecedents_medicaux' => $request->medical_history ?? 'Aucun',
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient créé avec succès !');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $patient->update($request->only(['nom', 'prenom', 'date_naissance', 'genre', 'telephone', 'email', 'antecedents_medicaux']));
        return redirect()->route('patients.index')->with('success', 'Patient mis à jour !');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient supprimé !');
    }
}