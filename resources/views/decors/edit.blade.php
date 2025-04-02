@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Modifier la box de décor</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Éditer les informations</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('decors.update', $decor->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nom_box" class="form-label">Nom de la box</label>
                    <input type="text" class="form-control" id="nom_box" name="nom_box" 
                           value="{{ old('nom_box', $decor->nom_box) }}" required>
                    @error('nom_box')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="fournisseur" class="form-label">Fournisseur</label>
                    <input type="text" class="form-control" id="fournisseur" name="fournisseur" 
                           value="{{ old('fournisseur', $decor->fournisseur) }}" required>
                    @error('fournisseur')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="date_acquisition" class="form-label">Date d'acquisition</label>
                    <input type="date" class="form-control" id="date_acquisition" name="date_acquisition" 
                           value="{{ old('date_acquisition', $decor->date_acquisition->format('Y-m-d')) }}" required>
                    @error('date_acquisition')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="date_exposition" class="form-label">Date d'exposition</label>
                    <input type="date" class="form-control" id="date_exposition" name="date_exposition" 
                           value="{{ old('date_exposition', $decor->date_exposition ? $decor->date_exposition->format('Y-m-d') : '') }}">
                    <small class="text-muted">Optionnel - à remplir lorsque la box est exposée</small>
                    @error('date_exposition')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('decors.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection