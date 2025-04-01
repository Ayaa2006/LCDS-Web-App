@extends('layouts.app')

@section('contents')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 style="color: rgb(123, 115, 115)">Gestion des Utilisateurs</h1>
    <!-- Ajouter un bouton pour créer un nouvel utilisateur si nécessaire -->
</div>

<hr />

<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Code</th>
            <th>Date d'Inscription</th>
            {{-- <th>Photo</th> --}}
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($utilisateurs as $utilisateur)
        <tr>
            <td>{{ $utilisateur->id }}</td>
            <td>{{ $utilisateur->name }}</td>
            <td>{{ $utilisateur->email }}</td>
            <td>{{ $utilisateur->code ?? 'N/A' }}</td>
            <td>{{ $utilisateur->created_at->format('d/m/Y') }}</td>
            {{-- <td>
                @if($utilisateur->photo)
                <img src="{{ asset('storage/' . $utilisateur->photo) }}" alt="Photo de {{ $utilisateur->name }}" style="width: 100px; height: auto;">
                @else
                Pas de photo
                @endif
            </td> --}}
             <td>
               <!-- Bouton Supprimer -->
                <form action="{{ route('utilisateurs.destroy', $utilisateur->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

{{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif --}}
