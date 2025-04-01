@extends('layouts.app')

@section('contents')
<div class="container">
    <h1>Gestion des Forfaits</h1>
    <a href="{{ route('stock.create') }}" class="btn btn-primary mb-3">Créer un Forfait</a>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $stock)
                    <tr>
                        <td>{{ $stock->nom }}</td>
                        <td>{{ $stock->prix }} DH</td>
                        <td>{{ $stock->description }}</td>
                        <td>
                            <a href="{{ route('stock.edit', $stock->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('stock.destroy', $stock->id) }}" method="POST" style="display:inline;">
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
