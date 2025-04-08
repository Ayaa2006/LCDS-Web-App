<?php

namespace App\Http\Controllers;

use App\Models\Parrainage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\str;
use App\Models\Gamification;
use App\Models\Task;
use App\Models\Submited_Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParrainageController extends Controller
{

    // Afficher la liste des parrainages pour l'admin
    public function index()
    {
        $parrainages = Parrainage::all(); // Récupère tous les parrainages
        return view('parrainages.index', compact('parrainages')); // Vue admin
    }

    // Afficher le profil utilisateur avec ses parrainages
    public function showProfile()
    {
        $user = Auth::user();

        // Récupérer les parrainages pour l'utilisateur connecté
        $parrainages = Parrainage::with('filleul')->where('reff_id', $user->id)->get();
        $parrainages = Parrainage::with('parrain')->where('user_id', $user->id)->get();


        return view('profile', compact('user', 'parrainages')); // Vue du profil avec parrainages
    }


    public function storeCode(Request $request)
    {
        $user = Auth::user();
        $code = $request->input('code');

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated']);
        }

        // Store the generated code for the authenticated user
        $user->update(['code' => $code]);

        return response()->json(['success' => true, 'message' => 'Code stored successfully']);
    }



    public function validateReferralCode(Request $request)
{
    try {
        $request->validate([
            'code' => 'required|string|size:7'
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication required'
            ], 401);
        }

        // Vérifier si l'utilisateur a déjà utilisé un code
        $userGamification = Gamification::where('user_id', $user->id)->first();
        
        if ($userGamification->friendCode) {
            return response()->json([
                'success' => false,
                'message' => 'Vous avez déjà utilisé un code de parrainage'
            ], 400);
        }

        // Trouver le parrain par son code personnel
        $referrer = Gamification::where('code', $request->code)->first();

        if (!$referrer) {
            return response()->json([
                'success' => false,
                'message' => 'Code de parrainage invalide'
            ], 404);
        }

        // Empêcher l'auto-parrainage
        if ($referrer->user_id === $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez pas utiliser votre propre code'
            ], 400);
        }

        DB::beginTransaction();

        // 1. Enregistrer le friendCode pour l'utilisateur actuel
        $userGamification->update([
            'friendCode' => $request->code
        ]);
         // Débogue pour voir si $referrer est correctement récupéré
       
        // 2. Créer la relation de parrainage
        Parrainage::create([
            'reff_id' => $referrer->user_id,
            'user_id' => $user->id
        ]);

        // 3. Attribuer les points (100 à chaque partie)
        $referrer->increment('point', 100);
        $userGamification->increment('point', 100);
        $referrer->increment('tasks_done', 1);
        $userGamification->increment('tasks_done', 1);
        // 4. Compléter la tâche "Parrainage"
        $task = Task::firstOrCreate(
            ['title' => 'Parrainage'],
            ['description' => 'Utilisation code parrainage', 'point' => 100]
        );

        Submited_Task::create([
            'id_user' => $user->id,
            'id_task' => $task->id,
            'status' => 'completed'
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Parrainage réussi! 100 points attribués.'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Erreur: ' . $e->getMessage()
        ], 500);
    }
}
    
    
}
    



