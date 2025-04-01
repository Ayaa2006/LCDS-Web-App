@extends('layouts.app')

@section('contents')
<div class="container">
    <h1>Détails de la Livraison</h1>
    <p><strong>Destinataire:</strong> {{ $livraison->destinataire }}</p>
    <p><strong>Adresse:</strong> {{ $livraison->adresse }}</p>
    <p><strong>Status:</strong> {{ $livraison->status }}</p>
    <p><strong>Numéro de suivi:</strong> {{ $livraison->tracking_number }}</p>

    <a href="{{ route('livraisons.index') }}" class="btn btn-primary">Retour à la liste des livraisons</a>
</div>
@endsection
