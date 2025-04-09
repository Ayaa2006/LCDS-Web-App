@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Événements</h1>

    <div class="mb-3">
        <a href="{{ route('evenements.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter événement
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nom d'événement</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Date Publication</th>
                    <th>Durée (jours)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($evenements as $event)
                <tr>
                    <td>{{ $event->nomEvent }}</td>
                    <td>
    <div class="d-flex flex-column">
        <div class="mb-2">{{ $event->description }}</div>
        @if($event->mediaAssocie)
            @php
                $extension = strtolower(pathinfo($event->mediaAssocie, PATHINFO_EXTENSION));
                $filePath = storage_path('app/' . $event->mediaAssocie);
            @endphp
            
            @if(file_exists($filePath))
                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ route('evenements.showImage', ['filename' => basename($event->mediaAssocie)]) }}" 
                         alt="Image événement" 
                         class="img-thumbnail" 
                         style="max-width: 150px; max-height: 100px;">
                @elseif($extension === 'mp4')
                    <video width="150" height="100" controls class="img-thumbnail">
                        <source src="{{ route('evenements.showImage', ['filename' => basename($event->mediaAssocie)]) }}" type="video/mp4">
                        Votre navigateur ne supporte pas la vidéo.
                    </video>
                @endif
            @else
                <span class="text-danger small">Fichier introuvable</span>
            @endif
        @endif
    </div>
</td>
                    <td>
                        <span class="badge 
                            @if($event->statut == 'publie') bg-success
                            @elseif($event->statut == 'archive') bg-secondary text-white
                            @else bg-warning text-dark @endif">
                            {{ ucfirst($event->statut) }}
                        </span>
                    </td>
                    <td>{{ $event->datePublication?->format('d/m/Y H:i') ?? '-' }}</td>
                    <td>{{ $event->nbrDeJours }}</td>
                    <td>
                        @if($event->statut == 'archive')
                            <form action="{{ route('evenements.updateStatus', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="new_status" value="publie">
                                <button type="submit" class="btn btn-sm btn-success" title="Publier l'événement">
                                    <i class="fas fa-check"></i> Publier
                                </button>
                            </form>
                        @endif
                        @if($event->statut != 'supprimer')
                        <form action="{{ route('evenements.updateStatus', $event->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="new_status" value="supprimer">
                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer l'événement"
                                onclick="return confirm('Voulez-vous vraiment supprimer cet événement?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection