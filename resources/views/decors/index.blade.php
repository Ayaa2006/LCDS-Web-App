@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Gestion des boxes de décors</h1>
<!-- Liste des boxes existantes sous forme de tableau -->
<h2 class="mt-5">Boxes existantes</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($decors->isEmpty())
        <div class="alert alert-warning">Aucune box enregistrée.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Fournisseur</th>
                        <th>Date acquisition</th>
                        <th>Date exposition</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($decors as $decor)
                    <tr>
                        <td>{{ $decor->nom_box }}</td>
                        <td>{{ $decor->fournisseur }}</td>
                        <td>{{ $decor->date_acquisition->format('d/m/Y') }}</td>
                        <td>
                            @if($decor->date_exposition)
                                {{ $decor->date_exposition->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $decor->description }}</td>
                         <td class="d-flex">
                            <a href="{{ route('decors.edit', $decor->id) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('decors.destroy', $decor->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette box ?')">
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
    <!-- Ajouter une nouvelle box -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Ajouter une nouvelle box</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('decors.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom_box" class="form-label">Nom de la box*</label>
                    <input type="text" class="form-control" id="nom_box" name="nom_box" 
                           value="{{ old('nom_box') }}" required>
                    @error('nom_box')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="fournisseur" class="form-label">Fournisseur*</label>
                    <input type="text" class="form-control" id="fournisseur" name="fournisseur"
                           value="{{ old('fournisseur') }}" required>
                    @error('fournisseur')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="date_acquisition" class="form-label">Date d'acquisition*</label>
                    <input type="date" class="form-control" id="date_acquisition" name="date_acquisition"
                           value="{{ old('date_acquisition') }}" required>
                    @error('date_acquisition')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="date_exposition" class="form-label">Date d'exposition</label>
                    <input type="date" class="form-control" id="date_exposition" name="date_exposition"
                           value="{{ old('date_exposition') }}">
                    <small class="text-muted">Optionnel - à remplir lorsque la box est exposée</small>
                    @error('date_exposition')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Ajouter la box</button>
                <a href="{{ route('decors.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>

    
</div>
@endsection