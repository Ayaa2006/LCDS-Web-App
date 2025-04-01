@extends('layouts.app')

@section('contents')
<div class="container">
    <h1 class="mb-4">Gestion des Livraisons</h1>
    <a href="{{ route('livraisons.create') }}" class="btn btn-primary mb-3">Créer une Livraison</a>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Destinataire</th>
                    <th>Adresse</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($livraisons as $livraison)
                    <tr>
                        <td>{{ $livraison->destinataire }}</td>
                        <td>{{ $livraison->adresse }}</td>
                        <td>
                            <span class="badge 
                                {{ $livraison->status === 'pending' ? 'badge-warning' : '' }}
                                {{ $livraison->status === 'delivered' ? 'badge-success' : '' }}
                                {{ $livraison->status === 'canceled' ? 'badge-danger' : '' }}">
                                {{ ucfirst($livraison->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('livraisons.show', $livraison->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('livraisons.edit', $livraison->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('livraisons.destroy', $livraison->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
