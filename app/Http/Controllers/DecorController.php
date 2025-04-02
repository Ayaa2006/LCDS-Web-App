<?php

namespace App\Http\Controllers;

use App\Models\Decor;
use Illuminate\Http\Request;

class DecorController extends Controller
{
    public function index()
    {
        $decors = Decor::latest()->get();
        return view('decors.index', compact('decors'));
    }

    public function create()
    {
        return view('decors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_box' => 'required|string|max:255',
            'date_acquisition' => 'required|date',
            'fournisseur' => 'required|string|max:255',
            'date_exposition' => 'nullable|date',
            'description' => 'nullable|string'
        ]);

        Decor::create($validated);

        return redirect()->route('decors.index')
                       ->with('success', 'Box ajoutée avec succès!');
    }

    public function show(Decor $decor)
    {
        return view('decors.show', compact('decor'));
    }

    public function edit(Decor $decor)
    {
        return view('decors.edit', compact('decor'));
    }

    public function update(Request $request, Decor $decor)
    {
        $validated = $request->validate([
            'nom_box' => 'required|string|max:255',
            'date_acquisition' => 'required|date',
            'fournisseur' => 'required|string|max:255',
            'date_exposition' => 'nullable|date',
            'description' => 'nullable|string'
        ]);

        $decor->update($validated);

        return redirect()->route('decors.index')
                       ->with('success', 'Box mise à jour avec succès!');
    }

    public function destroy(Decor $decor)
    {
        $decor->delete();
        return redirect()->route('decors.index')
                       ->with('success', 'Box supprimée avec succès!');
    }
}