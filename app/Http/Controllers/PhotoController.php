<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PhotoCreated;



class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'adress' => 'required|string',
            'img' => 'required|string',
        ]);
        

        // Retrieve the user based on the email
        $user = User::where('email', $request->input('email'))->first();

        // If the user exists, use their ID, otherwise, set user_id to 0
        $user_id = $user ? $user->id : 0;
        $request->merge(['user_id' => $user_id]);

        $img = $request->input('img');
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $photo = base64_decode($img);

        $fileName = time() . '.png';
        $filePath = public_path('images/' . $fileName);

        file_put_contents($filePath, $photo);

        $upload=Upload::create([
            'name' => $request->input('name'),
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'adress' => $request->input('adress'),
            'img' => 'images/' . $fileName,
            'user_id' => $user_id,

            
        ]);
        Mail::to($upload->email)->send(new PhotoCreated($upload));


        return redirect()->route('lcds')->with('success', 'Photo envoyer  successfully!');
    }

    public function index()
    {
        $reservations = Upload::all();
        return view('Photos.index', compact('reservations'));
}

public function destroy($id)
{
    // Trouvez la réservation par ID
    $reservation = Upload::findOrFail($id);

    // Supprimez la réservation
    $reservation->delete();

    // Redirigez avec un message de succès
    return redirect()->route('photoget')->with('success', 'photo supprimée avec succès.');
}

}
