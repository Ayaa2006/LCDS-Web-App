<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Abonnement;
use App\Mail\NewEventPublished;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventDeleted;



class EvenementController extends Controller
{
    public function index()
    {
        $evenements = Evenement::orderBy('datePublication', 'desc')->get();
        return view('evenements.index', compact('evenements'));
    }

    public function create()
    {
        return view('evenements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomEvent' => 'required|string|max:255',
            'description' => 'required|string',
            'mediaAssocie' => 'nullable|file|mimes:jpg,png,mp4',
            'statut' => 'required|in:publie,supprimer,archive',
            'datePublication' => 'nullable|date',
            'nbrDeJours' => 'required|integer|min:1'
        ]);

        if ($request->hasFile('mediaAssocie')) {
            $validated['mediaAssocie'] = $request->file('mediaAssocie')->store('medias/evenements');
        }

       
        $event = Evenement::create($validated);

        if ($event->statut === 'publie') {
            $this->sendNotificationToSubscribers($event);
        }

        return redirect()->route('evenements.index')
                       ->with('success', 'Événement créé avec succès');
    }


// Ajoutez cette nouvelle méthode
public function updateStatus(Request $request, $id)
{
    $event = Evenement::findOrFail($id);
    $newStatus = $request->input('new_status');
    $validated = $request->validate([
        'new_status' => 'required|in:supprimer,publie,archive'
    ]);
    
    $event->update(['statut' => $validated['new_status']]);

    // Envoyer les emails si le nouveau statut est 'publie'
    if ($newStatus === 'publie') {
        $this->sendNotificationToSubscribers($event);
    } elseif ($newStatus === 'supprimer') {
        $this->sendDeletionNotification($event);
    }

    
    return back()->with('success', 'Statut de l\'événement mis à jour avec succès');
}

// Modifiez la méthode destroy si vous voulez archiver au lieu de supprimer
public function destroy($id)
{
    $event = Evenement::findOrFail($id);
    $event->update(['statut' => 'supprimer']);
    $this->sendDeletionNotification($event);
    return back()->with('success', 'Événement supprimé avec succès');
}

public function showImage($filename)
{
    $path = storage_path('app/medias/evenements/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    
    return $response;
}

protected function sendNotificationToSubscribers($event)
{
    $subscribers = Abonnement::all();
    
    foreach ($subscribers as $subscriber) {
        Mail::to($subscriber->email)
            ->queue(new NewEventPublished($event));
    }
}
protected function sendDeletionNotification($event)
{
    $subscribers = Abonnement::all();
    
    foreach ($subscribers as $subscriber) {
        Mail::to($subscriber->email)
            ->queue(new EventDeleted($event));
    }
}
}