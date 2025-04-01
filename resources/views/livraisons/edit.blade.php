@extends('layouts.app')

@section('contents')
<div class="container">
    <h1>Modifier la Livraison</h1>

    <form action="{{ route('livraisons.update', $livraison->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="destinataire">Destinataire</label>
            <input type="text" class="form-control" id="destinataire" name="destinataire" value="{{ $livraison->destinataire }}" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $livraison->adresse }}" required>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending" {{ $livraison->status == 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="delivered" {{ $livraison->status == 'delivered' ? 'selected' : '' }}>Livrée</option>
                <option value="canceled" {{ $livraison->status == 'canceled' ? 'selected' : '' }}>Annulée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour la Livraison</button>
        <a href="{{ route('livraisons.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
