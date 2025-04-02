@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Modifier la prestation</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Éditer les informations</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('prestations.update', $prestation->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="date_debut" class="form-label">Date début*</label>
                    <input type="date" class="form-control" id="date_debut" name="date_debut" 
                           value="{{ old('date_debut', $prestation->date_debut) }}" required>
                    @error('date_debut')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="date_fin" class="form-label">Date fin*</label>
                    <input type="date" class="form-control" id="date_fin" name="date_fin" 
                           value="{{ old('date_fin', $prestation->date_fin) }}" required>
                    @error('date_fin')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="remarques" class="form-label">Remarques</label>
                    <textarea class="form-control" id="remarques" name="remarques" rows="3">{{ old('remarques', $prestation->remarques) }}</textarea>
                    @error('remarques')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('prestations.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection