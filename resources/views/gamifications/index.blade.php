@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Gestion des Gamifications</h1>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Liste des Gamifications</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Points</th>
                        <th scope="col">Niveau</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gamifications as $gamification)
                        <tr>
                            <td>{{ $gamification->user_id }}</td>
                            <td>{{ $gamification->point }}</td>
                            <td>{{ $gamification->level }}</td>
                            <td>
                                {{-- <a href="{{ route('gamifications.show', $gamification->user_id) }}" class="btn btn-info btn-sm">Voir Détails</a>
                                <a href="{{ route('gamifications.edit', $gamification->user_id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('gamifications.destroy', $gamification->user_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette gamification ?');">Supprimer</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
