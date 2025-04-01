@extends('layouts.app')

@section('contents')
    <div class="container mt-5">
        <h1 class="mb-4">Modifier la Galerie</h1>
        <form action="{{ route('galeries.update', $galerie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" name="titre" value="{{ $galerie->titre }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="4" required>{{ $galerie->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Image (laisser vide pour conserver l'ancienne)</label>
                <input type="file" class="form-control" name="img">
                @if($galerie->img)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $galerie->img) }}" class="img-thumbnail" width="150" alt="Image">
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('galeries.index') }}" class="btn btn-secondary ms-2">Retour</a>
        </form>
    </div>
@endsection
