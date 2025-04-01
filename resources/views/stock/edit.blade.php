@extends('layouts.app')

@section('contents')
<div class="container">
    <h1>Modifier le Forfait</h1>

    <form action="{{ route('stock.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom du Forfait</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $stock->nom) }}" required>
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" class="form-control" id="prix" name="prix" step="0.01" value="{{ old('prix', $stock->prix) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $stock->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour le Forfait</button>
        <a href="{{ route('stock.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
