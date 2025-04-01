@extends('layouts.app')

@section('contents')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 style="color: rgb(123, 115, 115)">Blogs</h1>
    <a href="{{ route('blogs.create') }}" class="btn btn-success">Créer un nouveau blog</a>

</div>

{{-- <h1>Voici les derniers blogs publiés :</h1> --}}
<hr />

<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Image</th>
            <th>Date de l'événement</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($blogs as $blog)
        <tr>
            <td>{{ $blog->id }}</td>
            <td>{{ $blog->titre }}</td>
            <td>{{ \Illuminate\Support\Str::limit($blog->description, 50) }}</td>
            <td>
                @if($blog->img)
                <img src="{{ asset('storage/' . $blog->img) }}" alt="{{ $blog->titre }}" style="width: 100px; height: auto;">
                @else
                Pas d'image
                @endif
            </td>
            <td>{{ $blog->event_date instanceof \DateTime ? $blog->event_date->format('d/m/Y') : 'N/A' }}</td>
            <td>
                <!-- Bouton Voir -->


                <!-- Bouton Modifier -->
                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                <!-- Bouton Supprimer -->
                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce blog ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
