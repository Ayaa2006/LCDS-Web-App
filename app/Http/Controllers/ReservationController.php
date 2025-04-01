<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ResrvationCreated;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // Enregistrer une nouvelle réservation
    public function store(Request $request)
    {
        // Valider les données d'entrée
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'date' => 'required|date',
            'code' => 'required|string|max:10',
        ]);

        // Convertir la date en objet Carbon
        $requestedDate = Carbon::parse($validatedData['date']);

        // Vérifier si la date est dans le passé
        if ($requestedDate->isPast()) {
            return redirect()->route('sphoto')->with('error', 'La date sélectionnée est dans le passé.');
        }

        // Vérifier si la date tombe un week-end
        if ($requestedDate->isWeekend()) {
            return redirect()->route('sphoto')->with('error', 'Les réservations ne sont pas possibles les week-ends.');
        }

        // Vérifier si la date et l'heure sont déjà prises
        $existingReservation = Reservation::where('date', '=', $requestedDate->format('Y-m-d H'))->exists();

        if ($existingReservation) {
            return redirect()->route('sphoto')->with('error', 'Cette heure est déjà réservée.');
        }

        // Associer l'utilisateur si connecté
        if (Auth::check()) {
            $validatedData['user_id'] = Auth::id();
        }

        // Créer la réservation
        $reservation = Reservation::create($validatedData);

        // Envoyer un email de confirmation
        Mail::to($reservation->email)->send(new ResrvationCreated($reservation));

        // Rediriger vers la route sphoto avec message de succès
        return redirect()->route('sphoto')->with('success', 'Réservation créée avec succès!');
    }

    // Lister toutes les réservations
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    // Méthode pour récupérer les réservations
    public function getReservations(Request $request)
    {
        // Valider la date passée par l'utilisateur
        $request->validate([
            'date' => 'required|date',
        ]);

        // Récupérer la date envoyée par le client
        $selectedDate = $request->query('date');

        // Vérifier si une réservation existe déjà pour cette date et heure
        $existingReservation = Reservation::where('date', $selectedDate)->first();

        if ($existingReservation) {
            return response()->json(['exists' => true, 'message' => 'Une réservation existe déjà à cette date et heure.']);
        } else {
            // Si aucune réservation n'existe, renvoyer false avec un message
            return response()->json(['exists' => false, 'message' => 'Aucune réservation à cette date. Vous pouvez réserver.']);
        }
    }

    // Lister les réservations de l'utilisateur connecté
    public function indexUserReservations()
    {
        $user = auth()->user();
        $reservations = $user->reservations;

        return view('profile', compact('reservations', 'user'));
    }

    // Modifier une réservation
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    // Mettre à jour une réservation
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());
        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
    }

    // Supprimer une réservation par ID
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }

    // Supprimer une réservation par code
    public function deleteReservationByCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10', 
        ]);

        $reservation = Reservation::where('code', $request->code)->first();

        if (!$reservation) {
            return redirect()->route('lcds')->with('error', 'Aucune réservation trouvée avec ce code.');
        }

        $reservation->delete();

        return redirect()->route('profile.index')->with('success', 'Réservation supprimée avec succès.');
    }
}
