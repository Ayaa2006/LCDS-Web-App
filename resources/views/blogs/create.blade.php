@extends('layouts.app')

@section('contents')
<h1>Créer un nouveau blog</h1>

<form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" name="titre" id="titre" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label for="img" class="form-label">Image</label>
        <input type="file" name="img" id="img" class="form-control">
    </div>

    <div class="mb-3">
        <label for="event_date" class="form-label">Date de l'événement</label>
        <input type="date" name="event_date" id="event_date" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
@endsection
