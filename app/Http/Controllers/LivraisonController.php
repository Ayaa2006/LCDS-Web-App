<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livraison;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LivraisonController extends Controller
{
    // Display a listing of the deliveries
    public function index()
{
    $livraisons = Livraison::all(); // Fetch all deliveries

    return view('livraisons.index', compact('livraisons'));
}

    

    // Show the form for creating a new delivery

    public function create()
{
    $users = User::all(); // Fetch all users
    return view('livraisons.create', compact('users'));
}


public function show($id)
{
    $livraison = Livraison::findOrFail($id); // Fetch the delivery by ID

    return view('livraisons.show', compact('livraison'));
}


    // Store a newly created delivery in storage
    public function store(Request $request)
    {
        $request->validate([
            'destinataire' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Ensure a user is selected
        ]);
    
        Livraison::create([
            'destinataire' => $request->destinataire,
            'user_id' => $request->user_id, // Use the user ID from the form
            'adresse' => $request->adresse,
            'status' => 'pending',
        ]);
    
        return redirect()->route('livraisons.index')->with('success', 'Livraison créée avec succès.');
    }    
    


    // Show the form for editing the specified delivery
    public function edit($id)
    {
        $livraison = Livraison::findOrFail($id);
        return view('livraisons.edit', compact('livraison'));
    }

    // Update the specified delivery in storage
    public function update(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'destinataire' => 'required|string|max:255',
        'adresse' => 'required|string|max:255',
        'status' => 'required|string|in:pending,delivered,canceled',
    ]);

    // Find the livraison by ID and update it
    $livraison = Livraison::findOrFail($id);
    $livraison->destinataire = $request->destinataire;
    $livraison->adresse = $request->adresse;
    $livraison->status = $request->status; // Update the status here
    $livraison->save(); // Save the changes

    return redirect()->route('livraisons.index')->with('success', 'Livraison mise à jour avec succès.');
}


    // Remove the specified delivery from storage
    public function destroy($id)
    {
        $livraison = Livraison::findOrFail($id);
        $livraison->delete();

        return redirect()->route('livraisons.index')->with('success', 'Livraison supprimée avec succès.');
    }
}
