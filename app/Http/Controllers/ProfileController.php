<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation; 
use App\Models\Parrainage;  

class ProfileController extends Controller
{
    // Afficher le profil de l'utilisateur avec ses parrainages
    public function showProfile()
    {
        $user = Auth::user();
        if (!$user) {
           
        }
        else {
            $reservations = Reservation::where('user_id', $user->id)->get(); // Récupère les réservations pour l'utilisateur
            $parrainages = Parrainage::with('filleul')->where('reff_id', $user->id)->get();
            $parrainages = Parrainage::with('parrain')->where('user_id', $user->id)->get();
            return view('profile', compact('user', 'reservations', 'parrainages'));   
        }
        
    }
    
}