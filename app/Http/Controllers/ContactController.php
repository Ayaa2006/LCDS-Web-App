<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Reponse;
use App\Mail\ContactReply;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('Contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'object' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Votre message a été envoyé avec succès!');
    }

    public function index()
{
    $contacts = Contact::orderBy('created_at', 'desc')->get();
    return view('contact.messages', compact('contacts'));
}


public function show($id)
{
    $contact = Contact::with('reponses')->findOrFail($id);
    return view('contact.messages', compact('contact'));
}





public function reply(Request $request, $id)
{
    $request->validate([
        'subject' => 'required|string|max:255',
        'message' => 'required|string'
    ]);

    $contact = Contact::findOrFail($id);

    // Enregistrer la réponse en base de données
    $reponse = new Reponse();
    $reponse->contact_id = $id;
    $reponse->object = $request->subject;
    $reponse->message = $request->message;
    $reponse->save();

    // Envoyer l'email
    try {
        Mail::to($contact->email)
            ->send(new ContactReply(
                $request->subject,
                $request->message,
                $contact->message
            ));
        
        return response()->json([
            'success' => true,
            'message' => 'Réponse envoyée avec succès par email'
        ]);
    } catch (\Exception $e) {
        // En cas d'erreur d'envoi d'email, on enregistre quand même la réponse
        return response()->json([
            'success' => true,
            'message' => 'Réponse enregistrée mais échec d\'envoi d\'email: '.$e->getMessage()
        ]);
    }
}
   
}