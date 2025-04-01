<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenteController extends Controller
{
    public function index()
    {
        // Récupérer toutes les ventes
        $ventes = Vente::with('user')->get(); // Charge également les utilisateurs associés

        return view('ventes.index', compact('ventes'));
    }

//     public function index()
// {
//     // Utilisez paginate() au lieu de all() ou get()
//     $ventes = Vente::paginate(10); // Nombre de ventes par page (par exemple 10)
//     return view('ventes.index', compact('ventes'));
// }




    public function create()
    {
        return view('ventes.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'montant' => 'required|numeric',
    ]);

    // Créez la vente en associant l'utilisateur
    Vente::create([
        'user_id' => Auth::id(), // Assurez-vous que l'utilisateur est authentifié
        'name' => $request->name,
        'montant' => $request->montant,
    ]);

    return redirect()->route('ventes.index')->with('success', 'Vente créée avec succès.');
}

    public function edit(Vente $vente)
    {
        return view('ventes.edit', compact('vente'));
    }

    public function update(Request $request, Vente $vente)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'montant' => 'required|numeric',
        ]);

        $vente->update($request->all());

        return redirect()->route('ventes.index')->with('success', 'Vente mise à jour avec succès.');
    }

    public function destroy(Vente $vente)
    {
        $vente->delete();
        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès.');
    }
}
