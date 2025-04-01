@extends('layouts.app')

@section('contents')
    <h1>Ajouter une nouvelle Galerie</h1>
    <form action="{{ route('galeries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" name="titre" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Image</label>
            <input type="file" class="form-control" name="img" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
@endsection

