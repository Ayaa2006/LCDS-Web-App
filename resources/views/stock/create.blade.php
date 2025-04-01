@extends('layouts.app')

@section('contents')
<div class="container">
    <h1>Créer un Forfait</h1>

    <form action="{{ route('stock.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom du Forfait</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" class="form-control" id="prix" name="prix" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Créer le Forfait</button>
        <a href="{{ route('stock.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
