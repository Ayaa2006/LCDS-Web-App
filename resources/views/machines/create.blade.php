@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Gestion des machines</h1>



    <!-- Liste des machines existantes sous forme de tableau -->
    <h2 class="mt-5">Machines existantes</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($machines->isEmpty())
        <div class="alert alert-warning">Aucune machine enregistrée.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Fournisseur</th>
                        <th>Date d'achat</th>
                        <th>Prix (DH)</th>
                        <th>Maintenances</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($machines as $machine)
                    <tr>
                        <td>{{ $machine->nom }}</td>
                        <td>{{ $machine->fournisseur }}</td>
                        <td>{{ $machine->date_achat->format('d/m/Y') }}</td>
                        <td>{{ number_format($machine->prix, 2) }}</td>
                        <td>
    @if($machine->maintenance_dates)
        @foreach(explode(', ', $machine->maintenance_dates) as $date)
            {{ $date }}<br>
        @endforeach
    @else
        Aucune
    @endif
</td>
                        <td class="d-flex">
                            <a href="{{ route('machines.edit', $machine->id) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('machines.destroy', $machine->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette machine ?')">
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
        <!-- Ajouter une nouvelle machine -->
        <div class="card mb-4">
        <div class="card-header">
            <h5>Ajouter une nouvelle machine</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('machines.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de la machine</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                    @error('nom')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="fournisseur" class="form-label">Fournisseur</label>
                    <input type="text" class="form-control" id="fournisseur" name="fournisseur" required>
                    @error('fournisseur')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="date_achat" class="form-label">Date d'achat</label>
                    <input type="date" class="form-control" id="date_achat" name="date_achat" required>
                    @error('date_achat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix (DH)</label>
                    <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
                    @error('prix')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
    <label for="maintenance_dates" class="form-label">Dates de maintenance</label>
    <input type="text" class="form-control" id="maintenance_dates" name="maintenance_dates"
           value="{{ old('maintenance_dates', $machine->maintenance_dates ?? '') }}"
           placeholder="Ex: 20/03/2023, 30/04/2023">
    <small class="text-muted">Séparez les dates par des virgules</small>
</div>
                
                <button type="submit" class="btn btn-primary">Ajouter la machine</button>
            </form>
        </div>
    </div>

</div>
@endsection