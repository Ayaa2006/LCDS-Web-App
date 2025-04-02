@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Gestion de l'agenda CRM</h1>

    <!-- Liste des contacts existants -->
    <h2 class="mt-5">Contacts existants</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($contacts->isEmpty())
        <div class="alert alert-warning">Aucun contact enregistré.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nom Client</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th>État</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->nom_client }}</td>
                        <td>{{ $contact->telephone }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->adresse_postale }}</td>
                        <td>
                            <span class="badge 
                                @if($contact->etat_advertissement == 'confirme') bg-success
                                @elseif($contact->etat_advertissement == 'annule') bg-danger
                                @else bg-warning text-dark @endif">
                                {{ ucfirst(str_replace('_', ' ', $contact->etat_advertissement)) }}
                            </span>
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('agenda-crm.edit', $contact->id) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('agenda-crm.destroy', $contact->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
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
    
    <!-- Ajouter un nouveau contact -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Ajouter un nouveau contact</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('agenda-crm.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom_client" class="form-label">Nom Client*</label>
                    <input type="text" class="form-control" id="nom_client" name="nom_client" 
                           value="{{ old('nom_client') }}" required>
                    @error('nom_client')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone*</label>
                    <input type="text" class="form-control" id="telephone" name="telephone"
                           value="{{ old('telephone') }}" required>
                    @error('telephone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email*</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="adresse_postale" class="form-label">Adresse Postale*</label>
                    <textarea class="form-control" id="adresse_postale" name="adresse_postale" rows="3" required>{{ old('adresse_postale') }}</textarea>
                    @error('adresse_postale')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
    <label for="etat_advertissement" class="form-label fw-semibold">État*</label>
    <div class="input-group">
        <select class="form-select form-select-lg shadow-sm" id="etat_advertissement" name="etat_advertissement" required>
            <option value="" disabled {{ !old('etat_advertissement') ? 'selected' : '' }}>Sélectionnez un état</option>
            <option value="en_attente" {{ old('etat_advertissement', $agendaCrm->etat_advertissement ?? '') == 'en_attente' ? 'selected' : '' }}>
                ⏳ En attente
            </option>
            <option value="confirme" {{ old('etat_advertissement', $agendaCrm->etat_advertissement ?? '') == 'confirme' ? 'selected' : '' }}>
                ✅ Confirmé
            </option>
            <option value="annule" {{ old('etat_advertissement', $agendaCrm->etat_advertissement ?? '') == 'annule' ? 'selected' : '' }}>
                ❌ Annulé
            </option>
        </select>
        
    </div>
    @error('etat_advertissement')
        <div class="text-danger small mt-2">{{ $message }}</div>
    @enderror
</div>
                
                <button type="submit" class="btn btn-primary">Ajouter le contact</button>
                <a href="{{ route('agenda-crm.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection