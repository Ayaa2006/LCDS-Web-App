@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Créer un nouvel événement</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Nouvel Événement</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('evenements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="nomEvent" class="form-label">Nom*</label>
                    <input type="text" class="form-control" id="nomEvent" name="nomEvent" 
                           value="{{ old('nomEvent') }}" required>
                    @error('nomEvent')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description*</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="mediaAssocie" class="form-label">Média associé</label>
                    <input type="file" class="form-control" id="mediaAssocie" name="mediaAssocie">
                    <small class="text-muted">Formats acceptés: JPG, PNG, MP4</small>
                    @error('mediaAssocie')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="statut" class="form-label">Statut*</label>
                        <br>
                        <select class="form-select" id="statut" name="statut" required>
                            <option value="publie" {{ old('statut') == 'publie' ? 'selected' : '' }}>publié</option>
                            <option value="supprimer" {{ old('statut') == 'supprimer' ? 'selected' : '' }}>supprimer</option>
                            <option value="archive" {{ old('statut') == 'archive' ? 'selected' : '' }}>Archivé</option>
                        </select>
                        @error('statut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="nbrDeJours" class="form-label">Durée (jours)*</label>
                        <input type="number" class="form-control" id="nbrDeJours" name="nbrDeJours" 
                               min="1" value="{{ old('nbrDeJours', 1) }}" required>
                        @error('nbrDeJours')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="datePublication" class="form-label">Date de publication</label>
                    <input type="datetime-local" class="form-control" id="datePublication" 
                           name="datePublication" value="{{ old('datePublication') }}">
                    @error('datePublication')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection