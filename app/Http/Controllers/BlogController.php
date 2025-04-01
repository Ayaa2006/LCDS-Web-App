<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;



class BlogController extends Controller
{

    // Afficher la liste des blogs pour l'admin
    public function index()
    {
        $blogs = Blog::all(); // Récupère tous les blogs
        return view('blogs.index', compact('blogs')); // Vue admin
    }

    // Afficher la liste des blogs pour les utilisateurs
    public function indexs()
    {
        $blogs = Blog::all(); // Récupère tous les blogs-Fetch all blogs
        return view('blog', compact('blogs')); // Vue utilisateur-Return view for users
    }

    // Afficher le formulaire de création d'un blog (admin)
    public function create()
    {
        return view('blogs.create');
    }

    // Enregistrer un nouveau blog dans la base de données
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gestion de l'image
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('blogs', 'public');
            $validated['img'] = $imagePath;
        }

        // Création du blog
        Blog::create($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog créé avec succès');
    }

    // Afficher un blog spécifique
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    // Afficher le formulaire d'édition d'un blog
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    // Mettre à jour un blog dans la base de données
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Validation des données
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gestion de l'image
        if ($request->hasFile('img')) {
            // Supprimer l'ancienne image si elle existe
            if ($blog->img) {
                \Storage::delete('public/' . $blog->img);
            }
            $imagePath = $request->file('img')->store('blogs', 'public');
            $validated['img'] = $imagePath;
        }

        // Mise à jour des données
        $blog->update($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog mis à jour avec succès');
    }

    public function destroy($id)
{
    $blog = Blog::findOrFail($id);

    // Supprimer l'image associée si elle existe
    if ($blog->img) {
        $imagePath = public_path('storage/' . $blog->img);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Utilisation de unlink pour supprimer le fichier
        }
    }

    // Supprimer le blog
    $blog->delete();

    return redirect()->route('blogs.index')->with('success', 'Blog supprimé avec succès');
}


}
