@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Missions</h1>

    <!-- Liste des missions existantes -->
    <h2 class="mt-5">Missions existantes</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($missions->isEmpty())
        <div class="alert alert-warning">Aucune mission enregistrée.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Client</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Remarques</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($missions as $mission)
                    <tr>
                        <td>{{ $mission->client->nom_client }}</td>
                        <td>{{ $mission->date_debut}}</td>
                        <td>{{ $mission->date_fin }}</td>
                        <td>{{ $mission->remarques}}</td>
                        <td class="d-flex">
                            <a href="{{ route('missions.edit', $mission->id) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('missions.destroy', $mission->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette mission ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <br>
    
    <!-- Ajouter une nouvelle mission -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Ajouter une nouvelle mission</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('missions.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label fw-semibold">Client*</label>
                    <div class="input-group">
                        <select class="form-select form-select-lg shadow-sm" id="id_client" name="id_client" required>
                            <option value="" disabled {{ !old('id_client') ? 'selected' : '' }}>Sélectionnez un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('id_client') == $client->id ? 'selected' : '' }}>
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
                               value="{{ old('date_debut') }}" required>
                        @error('date_debut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="date_fin" class="form-label">Date fin*</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin" 
                               value="{{ old('date_fin') }}" required>
                        @error('date_fin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="remarques" class="form-label">Remarques</label>
                    <textarea class="form-control" id="remarques" name="remarques" rows="3">{{ old('remarques') }}</textarea>
                    @error('remarques')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Ajouter la mission</button>
                   </form>
        </div>
    </div>
</div>
@endsection