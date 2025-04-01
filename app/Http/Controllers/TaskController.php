<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Gamification;


class TaskController extends Controller
{
    // Afficher la page de gestion de la gamification
    public function index()
    {
        $tasks = Task::all(); // Récupérer toutes les tâches
        return view('tasks.index', compact('tasks'));
    }


    // Ajouter une nouvelle tâche de gamification
    // public function addTask(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string',
    //         'description' => 'required|string',
    //         'point' => 'required|integer',
    //     ]);

    //     Task::create([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'point' => $request->point,
    //     ]);

    //     return redirect()->back()->with('success', 'Tâche ajoutée avec succès.');
    // }

    public function addTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'point' => 'required|integer',
            'CanLink' => 'sometimes|boolean', // Modifié pour être optionnel
        ]);
    
        // Valeur par défaut si CanLink n'est pas coché
        $canLink = $request->has('CanLink') ? $request->CanLink : false;
    
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'point' => $request->point,
            'CanLink' => $canLink,
        ]);
    
        return redirect()->route('tasks.index')->with('success', 'Tâche ajoutée avec succès!');
    }






public function edit($id)
{
    $task = Task::findOrFail($id);
    return view('tasks.edit-task', compact('task'));
}



public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'point' => 'required|integer',
            'CanLink' => 'sometimes|boolean',
        ]);

        $task = Task::findOrFail($id);
        
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'point' => $request->point,
            'CanLink' => $request->has('CanLink') ? $request->CanLink : false,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Tâche mise à jour avec succès!');
    }

   


    // Supprimer une tâche de gamification
    public function deleteTask($id)
    {
        Task::destroy($id);
        return redirect()->back()->with('success', 'Tâche supprimée avec succès.');
    }


   


}
