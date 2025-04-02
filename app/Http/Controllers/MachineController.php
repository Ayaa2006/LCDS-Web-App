<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function index()
{
    return redirect()->route('machines.create');
}

    public function create()
    {
        $machines = Machine::all(); // Récupère toutes les machines
        return view('machines.create', compact('machines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'fournisseur' => 'required|string|max:255',
            'date_achat' => 'required|date',
            'prix' => 'required|numeric|min:0',
            'maintenance_dates' => 'nullable|string',
        ]);

        if ($request->maintenance_dates) {
            $validated['maintenance_dates'] = implode(', ', 
                array_filter(
                    array_map('trim', explode(',', $request->maintenance_dates))
                )
            );
        }

        Machine::create($validated);

        return redirect()->route('machines.create')
                         ->with('success', 'Machine ajoutée avec succès!');
    }


    public function edit(Machine $machine)
{
    return view('machines.edit', compact('machine'));
}

public function update(Request $request, Machine $machine)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'fournisseur' => 'required|string|max:255',
        'date_achat' => 'required|date',
        'prix' => 'required|numeric|min:0',
        'maintenance_dates' => 'nullable|string',
    ]);

    // Conversion des dates de maintenance
    if ($request->maintenance_dates) {
        $validated['maintenance_dates'] = implode(', ', 
            array_filter(
                array_map('trim', explode(',', $request->maintenance_dates))
            )
        );
    } else {
        $validated['maintenance_dates'] = null;
    }

    $machine->update($validated);

    return redirect()->route('machines.create')
                     ->with('success', 'Machine mise à jour avec succès!');
}

    public function destroy(Machine $machine)
    {
        $machine->delete();

        return redirect()->route('machines.create')
                         ->with('success', 'Machine supprimée avec succès!');
    }
    
}