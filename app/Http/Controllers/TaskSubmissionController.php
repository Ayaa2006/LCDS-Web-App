<?php

namespace App\Http\Controllers;
use App\Models\Task; // Ajoutez cette ligne
use Illuminate\Support\Facades\DB; // Ajoutez cette ligne si vous utilisez DB
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Submited_Task;
use Illuminate\Support\Facades\Auth;


class TaskSubmissionController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(Request $request, $taskId)
    {
        $request->validate([
            'images.*' => 'required|image|max:2048'
        ]);

        $result = $this->taskService->storeTaskSubmission(
            $taskId,
            auth()->id(),
            $request->file('images') // Reçoit un tableau associatif [1 => fichier1, 2 => fichier2]
        );

        return response()->json($result);
    }

    public function viewSubmissions($id)
{
    $task = Task::findOrFail($id);
    
    $submissions = DB::table('submited_tasks')
        ->where('id_task', $id)
        ->join('users', 'submited_tasks.id_user', '=', 'users.id')
        ->select('submited_tasks.*', 'users.name as user_name')
        ->get()
        ->map(function ($submission) {
            // Convertir la chaîne de fichiers séparés par des virgules en tableau
            $files = !empty($submission->files) ? explode(',', $submission->files) : [];
            
            // Préparer les données pour la vue
            $submission->files = array_map(function ($filePath) {
                return [
                    'path' => trim($filePath),
                    'name' => basename(trim($filePath)) // Nom du fichier généré par TaskService
                ];
            }, $files);
            
            return $submission;
        });

    return view('tasks.submit-task', [
        'task' => $task,
        'submissions' => $submissions
    ]);
}

public function download($path)
{
    // Nettoyage du chemin
    $cleanPath = ltrim($path, '/');
    $storagePath = 'public/' . $cleanPath;

    // Vérification plus robuste
    if (!Storage::exists($storagePath)) {
        abort(404, "Le fichier n'existe pas dans le stockage.");
    }

    // Récupération des infos du fichier
    $filePath = Storage::path($storagePath);
    $fileName = basename($filePath);
    $mimeType = Storage::mimeType($storagePath);

    // Headers pour forcer le téléchargement
    $headers = [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
        'Content-Length' => Storage::size($storagePath)
    ];

    return new StreamedResponse(function() use ($storagePath) {
        $stream = Storage::readStream($storagePath);
        fpassthru($stream);
        fclose($stream);
    }, 200, $headers);
}


public function approve($id)
{
    // Récupère la soumission avec les relations
    $submission = Submited_Task::with(['task', 'user.gamification'])
        ->where('id_Sub_task', $id)
        ->firstOrFail();

    // Vérifie que le statut était bien 'waiting'
    if ($submission->status === 'waiting') {
        DB::transaction(function () use ($submission) {
            // Met à jour le statut
            $submission->update(['status' => 'done']);

            // Récupère ou crée le profil gamification
            $gamification = $submission->user->gamification ?? Gamification::create([
                'user_id' => $submission->user->id,
                'point' => 0,
                'level' => 1,
                'tasks_done' => 0,
                'Code' => null,
                'friendCode' => null
            ]);

            // Ajoute les points de la tâche
            $pointsToAdd = $submission->task->point ?? 0;
            $gamification->increment('point', $pointsToAdd);
            $gamification->increment('tasks_done');
        });

        return back()->with('success', 'Soumission approuvée et points attribués');
    }

    return back()->with('error', 'Seules les soumissions en attente peuvent être approuvées');
}

public function reject($id)
{
    DB::table('submited_tasks')
        ->where('id_Sub_task', $id)
        ->update(['status' => 'rejected']);

    return back()->with('success', 'Soumission rejetée avec succès');
}

public function delete($id)
{
    $submission = Submited_Task::findOrFail($id);

    // Vérifie que le statut est 'waiting' avant de supprimer
    if ($submission->status !== 'waiting') {
        return response()->json(['success' => false, 'message' => 'Impossible de supprimer une soumission qui n\'est pas en attente.']);
    }
    $submission->delete();
    
    // Supprime les fichiers associés
    $files = explode(',', $submission->files);
    foreach ($files as $file) {
        $filePath = 'public/' . trim($file);
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }

    return response()->json(['success' => true, 'message' => 'Soumission supprimée avec succès']);
}


}