<?php

namespace App\Http\Controllers;

use App\Models\Gamification;
use App\Models\Submited_Task;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Added missing import
use Illuminate\Support\Facades\Log;
use App\Services\GamificationService;

class GamificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    

    public function index()
    {
      
    $user = Auth::user();
    $submissions = $this->getUserSubmissions(); // Récupération des soumissions

        // Get user's gamification data
        $gamification = Gamification::where('user_id', $user->id)->first();
        
        // Calculate level progress
        list($pointsToNextLevel, $currentLevelProgress) = $this->calculateLevelProgress($gamification);

        // Get all available tasks
        $tasks = Task::all();
    
        return view('gamification', [
           'submissions' => $submissions ?? collect(), // 💡 Assure qu'on passe toujours une collection vide au minimum
    'hasSubmissions' => isset($submissions) && $submissions->isNotEmpty(),
     'gamification' => $gamification,
            'tasks' => $tasks // Added to match your view
        ]);
    }
    
    public function showTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        $user = Auth::user();
        
        $submission = Submited_Task::where('id_task', $taskId)
            ->where('id_user', $user->id)
            ->first();
        
        return view('tasks.show', [
            'task' => $task,
            'submission' => $submission
        ]);
    }
  
    /**
     * Format file strings to consistent array format
     * 
     * @param mixed $files
     * @return array
     */
    protected function formatFiles($files)
    {
        if (empty($files)) return [];
        
        return is_array($files) 
            ? $files 
            : (json_decode($files, true) ?? explode(',', $files));
    }

    public function getUserSubmissionsForAjax($userId)
{
    // Récupérer les soumissions pour cet utilisateur
    $submissions = DB::table('submited_tasks')
        ->where('id_user', $userId)
        ->join('tasks', 'submited_tasks.id_task', '=', 'tasks.id')
        ->select('submited_tasks.*', 'tasks.title as task_title')
        ->get();

    // Retourner les soumissions en format JSON
    return response()->json($submissions);
}

public function generateCode(Request $request = null, $autoGenerate = false)
{
    try {
        $user = auth()->user();
        $gamification = Gamification::firstOrNew(['user_id' => $user->id]);

        if (!empty($gamification->code)) {
            if ($autoGenerate) {
                return $gamification->code; // Retourne le code existant si déjà généré
            }
            return response()->json([
                'success' => false,
                'message' => 'Vous avez déjà un code'
            ], 400);
        }

        // Génération automatique du code
        $code = $autoGenerate ? $this->generateUniqueCode() : $request->input('code');

        if (!$autoGenerate && Gamification::where('code', $code)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Code déjà utilisé'
            ], 400);
        }

        $gamification->code = $code;
        $gamification->save();

        if ($autoGenerate) {
            return $code; // Retourne juste le code pour la création automatique
        }

        return response()->json([
            'success' => true,
            'code' => $code,
            'message' => 'Code généré avec succès'
        ]);
    } catch (\Exception $e) {
        \Log::error("Erreur lors de la génération du code : " . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Une erreur interne est survenue'
        ], 500);
    }
}


public function getGamificationData($userId)
{
    $gamification = Gamification::where('user_id', $userId)->first();
    $rang = $gamification ? $gamification->rang : null;
    if (!$gamification) {
        return response()->json(['error' => 'Gamification profile not found'], 404);
    }

    $remaining = app(GamificationService::class)->calculateRemainingTasksToNextLevel($gamification);

    return response()->json([
        'gamification' => $gamification,
        'rang' => $rang,
        'remaining_tasks' => $remaining,
    ]);
}

    
}