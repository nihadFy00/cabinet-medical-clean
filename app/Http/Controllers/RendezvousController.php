<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rendezvous;
use App\Models\Patient;
use App\Models\Medecin;

class RendezvousController extends Controller
{
    public function index()
    {
        $rendezvous = Rendezvous::with(['patient', 'medecin'])->orderBy('date_rdv', 'desc')->get();
        return view('rendezvous.index', compact('rendezvous'));
    }

    public function create()
    {
        $patients = Patient::all();
        $medecins = Medecin::all();
        return view('rendezvous.create', compact('patients', 'medecins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'medecin_id' => 'required',
            'date_rdv'   => 'required|date',
            'motif'      => 'nullable|string',
        ]);
        Rendezvous::create([
            'patient_id' => $request->patient_id,
            'medecin_id' => $request->medecin_id,
            'date_rdv'   => $request->date_rdv,
            'motif'      => $request->motif,
            'statut'     => 'pending',
        ]);
        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous créé.');
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}

    public function destroy(string $id)
    {
        Rendezvous::findOrFail($id)->delete();
        return redirect()->route('rendezvous.index')->with('success', 'Supprimé.');
    }
}