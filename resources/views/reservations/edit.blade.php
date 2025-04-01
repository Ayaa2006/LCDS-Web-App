@extends('layouts.app')

@section('title', 'Modifier Réservation')

@section('contents')
    <h1 class="mb-0">Modifier la réservation</h1>
    <hr />
    <form action="{{ route('Reservation.update', $Reservation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" placeholder="nom" value="{{ $Reservation->name }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" placeholder="phone_number" value="{{ $Reservation->phone }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="email" value="{{ $Reservation->email }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Date</label>
                <input type="datetime-local" name="date" class="form-control" placeholder="date" value="{{ $Reservation->date }}" >
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Mettre à jour</button>
            </div>
        </div>
    </form>
@endsection
