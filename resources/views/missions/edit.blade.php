@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Modifier la Mission</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Éditer les informations</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('missions.update', $mission->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="form-label fw-semibold">Client*</label>
                    <div class="input-group">
                        <select class="form-select form-select-lg shadow-sm" id="id_client" name="id_client" required>
                            <option value="" disabled>Choisir un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" 
                                    {{ old('id_client', $mission->id_client) == $client->id ? 'selected' : '' }}>
                                    {{ $client->nom_client }} ({{ $client->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_client')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date_debut" class="form-label">Date début*</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut" 
                               value="{{ old('date_debut', $mission->date_debut) }}" required>
                        @error('date_debut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="date_fin" class="form-label">Date fin*</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin" 
                               value="{{ old('date_fin', $mission->date_fin) }}" required>
                        @error('date_fin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="remarques" class="form-label">Remarques</label>
                    <textarea class="form-control" id="remarques" name="remarques" rows="3">{{ old('remarques', $mission->remarques) }}</textarea>
                    @error('remarques')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('missions.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection