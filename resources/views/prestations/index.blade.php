@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Prestations</h1>

    <!-- Liste des prestations existantes sous forme de tableau -->
    <h2 class="mt-5">Prestations existantes</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($prestations->isEmpty())
        <div class="alert alert-warning">Aucune prestation enregistrée.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Remarques</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prestations as $prestation)
                    <tr>
                        <td>{{ $prestation->date_debut}}</td>
                        <td>{{ $prestation->date_fin }}</td>
                        <td>{{ $prestation->remarques ?: '-' }}</td>
                        <td class="d-flex">
                            <a href="{{ route('prestations.edit', $prestation->id) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('prestations.destroy', $prestation->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette prestation ?')">
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
    <!-- Ajouter une nouvelle prestation -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Ajouter une nouvelle prestation</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('prestations.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="date_debut" class="form-label">Date début*</label>
                    <input type="date" class="form-control" id="date_debut" name="date_debut" 
                           value="{{ old('date_debut') }}" required>
                    @error('date_debut')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="date_fin" class="form-label">Date fin*</label>
                    <input type="date" class="form-control" id="date_fin" name="date_fin"
                           value="{{ old('date_fin') }}" required>
                    @error('date_fin')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="remarques" class="form-label">Remarques</label>
                    <textarea class="form-control" id="remarques" name="remarques" rows="3">{{ old('remarques') }}</textarea>
                    @error('remarques')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Ajouter la prestation</button>
                <a href="{{ route('prestations.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection