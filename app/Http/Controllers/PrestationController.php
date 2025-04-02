<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestation;

class PrestationController extends Controller
{
    public function index()
    {
        $prestations = Prestation::orderBy('date_debut', 'desc')->get();
        return view('prestations.index', compact('prestations'));
    }

    public function create()
    {
        return view('prestations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'remarques' => 'nullable|string'
        ]);

        Prestation::create($validated);

        return redirect()->route('prestations.index')
                        ->with('success', 'Prestation ajoutée avec succès');
    }

    public function edit(Prestation $prestation)
    {
        return view('prestations.edit', compact('prestation'));
    }

    public function update(Request $request, Prestation $prestation)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'remarques' => 'nullable|string'
        ]);

        $prestation->update($validated);

        return redirect()->route('prestations.index')
                        ->with('success', 'Prestation mise à jour avec succès');
    }

    public function destroy(Prestation $prestation)
    {
        $prestation->delete();
        return redirect()->route('prestations.index')
                        ->with('success', 'Prestation supprimée avec succès');
    }
}