<?php

namespace App\Http\Controllers;

use App\Models\Paiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Services\GamificationService;

class PaimentController extends Controller
{
    protected $gamificationService;

    public function __construct(GamificationService $gamificationService)
    {
        $this->gamificationService = $gamificationService;
    }

    public function savePayment(Request $request)
    {
        // Validation des données de la requête
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'adress' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'mode_paiement' => 'required|string|in:en ligne,sur site',
            
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        try {
            // Gestion de la photo si elle existe
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoPath = $photo->store('photos', 'public');
            }
    
            // Sauvegarde du paiement
            $payment = Paiment::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'adress' => $request->adress,
                'montant' => $request->montant,
                'date' => now(),
                'mode_paiement' => $request->mode_paiement,
                'status' => 'completed',
                'user_id' => auth()->id(), 
                'photo_path' => $photoPath,
            ]);
            
            // Trigger gamification update if user_id is provided
            if (auth()->id()) {
                $this->gamificationService->handlePaymentGamification(auth()->id());
            }
    
            return redirect()->route('vs')->with('success', 'Paiement créé avec succès!');
        
        } catch (\Exception $e) {
            Log::error('Payment save error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur serveur',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}