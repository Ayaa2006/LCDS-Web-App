<?php

namespace App\Http\Controllers;

use App\Models\Parrainage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\str;

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
        $parrainages = Parrainage::where('user_id', $user->id)->get();

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
        $code = $request->input('code');

        // Find user by the code
        $user = User::where('code', $code)->first();

        if ($user) {
            Parrainage::create([
                'name_filleul' => Auth::user()->name,
                'code' => $code,
                'user_id' => $user->id,
            ]);

            return response()->json(['valid' => true, 'message' => 'Referral code is valid']);
        } else {
            return response()->json(['valid' => false, 'message' => 'Invalid referral code']);
        }
    }




}
