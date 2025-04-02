@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Modifier la machine</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Éditer les informations</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('machines.update', $machine->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de la machine</label>
                    <input type="text" class="form-control" id="nom" name="nom" 
                           value="{{ old('nom', $machine->nom) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="fournisseur" class="form-label">Fournisseur</label>
                    <input type="text" class="form-control" id="fournisseur" name="fournisseur" 
                           value="{{ old('fournisseur', $machine->fournisseur) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="date_achat" class="form-label">Date d'achat</label>
                    <input type="date" class="form-control" id="date_achat" name="date_achat" 
                           value="{{ old('date_achat', $machine->date_achat->format('Y-m-d')) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix (DH)</label>
                    <input type="number" step="0.01" class="form-control" id="prix" name="prix" 
                           value="{{ old('prix', $machine->prix) }}" required>
                </div>
                
                <div class="mb-3">
    <label for="maintenance_dates" class="form-label">Dates de maintenance</label>
    <input type="text" class="form-control" id="maintenance_dates" name="maintenance_dates"
           value="{{ old('maintenance_dates', $machine->maintenance_dates) }}"
           placeholder="20/03/2023, 30/04/2023">
    <small class="text-muted">Séparez les dates par des virgules (format: JJ/MM/AAAA)</small>
    @error('maintenance_dates')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
                
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('machines.create') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection