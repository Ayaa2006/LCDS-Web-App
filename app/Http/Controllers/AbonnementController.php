<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abonnement;
use Illuminate\Support\Facades\Mail;
use App\Mail\AbonnementCreated;


class AbonnementController extends Controller
{
   
        public function store(Request $request)
        {
            // Validation pour l'email uniquement
            $request->validate([
                'email' => 'required|email|unique:abonnements,email', // Validation de l'email uniquement
            ]);
    
            // Générer un code aléatoire
            $code = $this->generateCode(); // Si pas de code dans la requête, le générer
    
            // Création de l'abonnement avec les données du formulaire
            $abonnement = Abonnement::create([
                'email' => $request->email,
                'code' => $code, // Le code généré est inséré dans la base
            ]);
    
            // Envoi de l'email de confirmation
            Mail::to($abonnement->email)->send(new AbonnementCreated($abonnement));
    
            // Redirection avec un message de succès
            return redirect()->route('lcds')->with('success', 'Abonnement créé avec succès!');
        }
    
        protected function generateCode()
        {
            // Générer un code aléatoire de 10 caractères (chiffres et lettres)
            $code = '';
            for ($i = 0; $i < 10; $i++) {
                $randomType = rand(1, 3); // Choisir aléatoirement entre chiffre, lettre minuscule et majuscule
    
                if ($randomType === 1) {
                    $code .= rand(0, 9); // Chiffre aléatoire
                } elseif ($randomType === 2) {
                    $code .= chr(rand(97, 122)); // Lettre minuscule
                } elseif ($randomType === 3) {
                    $code .= chr(rand(65, 90)); // Lettre majuscule
                }
            }
            return $code;
        }
    
        public function destroyByCode(Request $request)
{
    $request->validate([
        'code' => 'required|string|exists:abonnements,code',
    ]);

    $abonnement = Abonnement::where('code', $request->code)->first();

    if ($abonnement) {
        $abonnement->delete();
        return redirect()->back()->with('success', 'Désabonnement effectué avec succès.');
    } else {
        return redirect()->back()->with('error', 'Code non trouvé.');
    }
}

    }
    


