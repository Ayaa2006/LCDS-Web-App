<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaCrm;

class AgendaCrmController extends Controller
{
    /**
     * Affiche la liste des contacts
     */
    public function index()
    {
        $contacts = AgendaCrm::orderBy('created_at', 'desc')->get();
        return view('agenda-crm.index', compact('contacts'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('agenda-crm.create');
    }

    /**
     * Enregistre un nouveau contact
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'telephone' => 'required|string|max:20|regex:/^[0-9\+]+$/',
            'email' => 'required|email:rfc,dns',
            'adresse_postale' => 'required|string|max:500',
            'etat_advertissement' => 'required|in:en_attente,confirme,annule'
        ], [
            'telephone.regex' => 'Le format du téléphone est invalide',
            'email.email' => 'Veuillez entrer une adresse email valide'
        ]);

        AgendaCrm::create($validated);

        return redirect()->route('agenda-crm.index')
                       ->with('success', 'Contact créé avec succès');
    }

    /**
     * Affiche un contact spécifique
     */
    public function show(AgendaCrm $agendaCrm)
    {
        return view('agenda-crm.show', compact('agendaCrm'));
    }

    public function edit(AgendaCrm $agendaCrm)
    {
        return view('agenda-crm.edit', compact('agendaCrm'));
    }

    /**
     * Met à jour un contact existant
     */
    public function update(Request $request, AgendaCrm $agendaCrm)
    {
        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'telephone' => 'required|string|max:20|regex:/^[0-9\+]+$/',
            'email' => 'required|email:rfc,dns',
            'adresse_postale' => 'required|string|max:500',
            'etat_advertissement' => 'required|in:en_attente,confirme,annule'
        ]);

        $agendaCrm->update($validated);

        return redirect()->route('agenda-crm.index')
                       ->with('success', 'Contact mis à jour avec succès');
    }

    /**
     * Supprime un contact
     */
    public function destroy(AgendaCrm $agendaCrm)
    {
        $agendaCrm->delete();

        return redirect()->route('agenda-crm.index')
                       ->with('success', 'Contact supprimé avec succès');
    }
}