@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Modifier le contact</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Éditer les informations</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('agenda-crm.update', $agendaCrm->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nom_client" class="form-label">Nom Client*</label>
                    <input type="text" class="form-control" id="nom_client" name="nom_client" 
                           value="{{ old('nom_client', $agendaCrm->nom_client) }}" required>
                    @error('nom_client')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone*</label>
                    <input type="text" class="form-control" id="telephone" name="telephone" 
                           value="{{ old('telephone', $agendaCrm->telephone) }}" required>
                    @error('telephone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email*</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="{{ old('email', $agendaCrm->email) }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="adresse_postale" class="form-label">Adresse Postale*</label>
                    <textarea class="form-control" id="adresse_postale" name="adresse_postale" rows="3" required>{{ old('adresse_postale', $agendaCrm->adresse_postale) }}</textarea>
                    @error('adresse_postale')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
    <label for="etat_advertissement" class="form-label fw-semibold">État*</label>
    <div class="input-group">
        <select class="form-select form-select-lg shadow-sm" id="etat_advertissement" name="etat_advertissement" required>
            <option value="en_attente" {{ old('etat_advertissement', $agendaCrm->etat_advertissement) == 'en_attente' ? 'selected' : '' }}>
                ⏳ En attente
            </option>
            <option value="confirme" {{ old('etat_advertissement', $agendaCrm->etat_advertissement) == 'confirme' ? 'selected' : '' }}>
                ✅ Confirmé
            </option>
            <option value="annule" {{ old('etat_advertissement', $agendaCrm->etat_advertissement) == 'annule' ? 'selected' : '' }}>
                ❌ Annulé
            </option>
        </select>
       
    </div>
    @error('etat_advertissement')
        <div class="text-danger small mt-2">{{ $message }}</div>
    @enderror
</div>
                
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('agenda-crm.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection