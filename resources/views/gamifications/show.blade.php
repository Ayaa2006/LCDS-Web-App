@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Détails de la Gamification</h1>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Utilisateur ID: {{ $gamification->user_id }}</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">Points: <strong>{{ $gamification->point }}</strong></li>
                <li class="list-group-item">Niveau: <strong>{{ $gamification->level }}</strong></li>
            </ul>
            <div class="mt-4">
                <a href="{{ route('gamifications.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>
@endsection
