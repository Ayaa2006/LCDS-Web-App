<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('stock.index', compact('stocks'));
    }

    public function indexs()
{
    $stocks = Stock::all();
    // dd($stocks); // Check if data is retrieved
    return view('service-photographie', compact('stocks'));
}





    public function create()
    {
        return view('stock.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Stock::create($request->all());

        return redirect()->route('stock.index')->with('success', 'Forfait créé avec succès.');
    }

    public function edit(Stock $stock)
    {
        return view('stock.edit', compact('stock'));
    }


    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $stock->update($request->all());

        return redirect()->route('stock.index')->with('success', 'Forfait mis à jour avec succès.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stock.index')->with('success', 'Forfait supprimé avec succès.');
    }
}
