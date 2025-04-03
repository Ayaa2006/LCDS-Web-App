<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\AgendaCrm;
use Illuminate\Support\Facades\Validator;

class MissionController extends Controller
{

    public function create()
    {
        $missions = Mission::all(); // Or your query for missions
        $clients = AgendaCrm::all(); // Or your query for clients
        return view('missions.create', compact('missions', 'clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'remarques' => 'nullable|string',
            'id_client' => 'required|exists:agenda_crm,id'
        ]);

        Mission::create($validated);

        return redirect()->route('missions.create')
                       ->with('success', 'Mission créée avec succès');
    }

    public function index()
    {
        //
    }

   
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $mission = Mission::findOrFail($id);
        $clients = AgendaCrm::all();
        
        return view('missions.edit', compact('mission', 'clients'));
    }

    /**
     * Met à jour une mission
     */
    public function update(Request $request, string $id)
    {
        $mission = Mission::findOrFail($id);
        
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'remarques' => 'nullable|string',
            'id_client' => 'required|exists:agenda_crm,id'
        ]);

        $mission->update($validated);

        return redirect()->route('missions.create')
                       ->with('success', 'Mission mise à jour avec succès');
    }

    /**
     * Supprime une mission
     */
    public function destroy(string $id)
    {
        $mission = Mission::findOrFail($id);
        $mission->delete();

        return redirect()->route('missions.create')
                       ->with('success', 'Mission supprimée avec succès');
    }
}
