@extends('layouts.app')

@section('contents')
<div class="container">
    <h1>Créer une Livraison</h1>

    <form action="{{ route('livraisons.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="destinataire">Destinataire</label>
            <input type="text" name="destinataire" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="user_id">Sélectionner l'utilisateur</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer Livraison</button>
    </form>
</div>
@endsection
