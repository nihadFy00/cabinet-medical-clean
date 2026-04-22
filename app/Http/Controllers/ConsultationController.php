<?php
namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::with(['patient', 'medecin'])->latest()->get();
        return view('consultations.index', compact('consultations'));
    }

    public function create()
    {
        $patients = Patient::all();
        $medecins = Medecin::all();
        return view('consultations.create', compact('patients', 'medecins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id'      => 'required',
            'medecin_id'      => 'required',
            'date_consultation' => 'required|date',
            'notes_medecin'   => 'required',
            'poids'           => 'nullable|numeric',
            'tension'         => 'nullable|numeric',
        ]);
        Consultation::create([
            'patient_id'        => $request->patient_id,
            'medecin_id'        => $request->medecin_id,
            'date_consultation' => $request->date_consultation,
            'notes_medecin'     => $request->notes_medecin,
            'poids'             => $request->poids,
            'tension'           => $request->tension,
            'rendezvous_id'     => null,
        ]);
        return redirect()->route('consultations.index')->with('success', 'Consultation ajoutée!');
    }

    public function show($id)
    {
        $consultation = Consultation::with(['patient', 'medecin'])->findOrFail($id);
        return view('consultations.show', compact('consultation'));
    }

    public function edit($id)
    {
        $consultation = Consultation::findOrFail($id);
        $patients = Patient::all();
        $medecins = Medecin::all();
        return view('consultations.edit', compact('consultation', 'patients', 'medecins'));
    }

    public function update(Request $request, $id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->update($request->only(['notes_medecin', 'poids', 'tension', 'date_consultation']));
        return redirect()->route('consultations.index')->with('success', 'Consultation mise à jour!');
    }

    public function destroy($id)
    {
        Consultation::findOrFail($id)->delete();
        return redirect()->route('consultations.index')->with('success', 'Supprimée!');
    }
}