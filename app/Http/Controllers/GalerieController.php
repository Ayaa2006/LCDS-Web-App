<?php

namespace App\Http\Controllers;

use App\Models\Galerie;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class GalerieController extends Controller
{
    /**
     * Display a listing of the galleries.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $galeries = Galerie::all(); // Fetch all galleries
        return view('galeries.index', compact('galeries'));
    }
 


    public function indexs(): View
    {
        $galeries = Galerie::all(); // Fetch all galleries
        return view('galerie', compact('galeries'));
    }

    public function indexsLCDS(): View
    {
        $galeries = Galerie::all(); // Fetch all galleries
        return view('index-client', compact('galeries'));
    }

    /**
     * Show the form for creating a new gallery.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('galeries.create');
    }

    /**
     * Store a newly created gallery in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $galerie = new Galerie();
        $galerie->titre = $request->input('titre');
        $galerie->description = $request->input('description');

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images', 'public');
            $galerie->img = $imagePath;
        }

        $galerie->save();

        return redirect()->route('galeries.index')->with('success', 'Galerie created successfully.');
    }

    /**
     * Display the specified gallery.
     *
     * @param  \App\Models\Galerie  $galerie
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Galerie $galerie): View
    {
        return view('galeries.show', compact('galerie'));
    }

    /**
     * Show the form for editing the specified gallery.
     *
     * @param  \App\Models\Galerie  $galerie
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Galerie $galerie): View
    {
        return view('galeries.edit', compact('galerie'));
    }

    /**
     * Update the specified gallery in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galerie  $galerie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Galerie $galerie): RedirectResponse
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $galerie->titre = $request->input('titre');
        $galerie->description = $request->input('description');

        if ($request->hasFile('img')) {
            // Delete the old image if it exists
            if ($galerie->img) {
                Storage::disk('public')->delete($galerie->img);
            }

            $imagePath = $request->file('img')->store('images', 'public');
            $galerie->img = $imagePath;
        }

        $galerie->save();

        return redirect()->route('galeries.index')->with('success', 'Galerie updated successfully.');
    }

    /**
     * Remove the specified gallery from storage.
     *
     * @param  \App\Models\Galerie  $galerie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Galerie $galerie): RedirectResponse
    {
        // Delete the image if it exists
        if ($galerie->img) {
            Storage::disk('public')->delete($galerie->img);
        }

        $galerie->delete();

        return redirect()->route('galeries.index')->with('success', 'Galerie deleted successfully.');
    }
}
