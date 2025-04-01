@extends('layouts.app')

{{-- @section('title', 'Gestion des Ventes') --}}

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Gestion des Ventes</h1>
    
    <!-- Search Bar -->
    <div class="row mb-4">
        <div class="col-md-4 mx-auto">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher une vente...">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">Rechercher</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sales Table -->
    <table class="table table-hover shadow rounded">
        <thead class="table-dark text-uppercase">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Montant</th>
                <th>Utilisateur</th>
                <th>Date de Vente</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ventes as $vente)
                <tr>
                    <td class="align-middle">{{ $vente->id }}</td>
                    <td class="align-middle">{{ $vente->name }}</td>
                    <td class="align-middle">{{ number_format($vente->montant, 2, ',', ' ') }} MAD</td>
                    <td class="align-middle">{{ $vente->user->name ?? 'Utilisateur inconnu' }}</td>
                    <td class="align-middle">{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                    <td class="align-middle">
                        <div class="btn-group">
                            <a href="{{ route('ventes.show', $vente->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <form action="{{ route('ventes.destroy', $vente->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-button" data-form-id="delete-form-{{ $vente->id }}">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune vente trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    {{-- <div class="d-flex justify-content-center">
        {{ $ventes->links() }}
    </div> --}}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const formId = this.getAttribute('data-form-id');
                const form = document.getElementById(formId);

                Swal.fire({
                    title: "Êtes-vous sûr ?",
                    text: "Vous ne pourrez pas revenir en arrière !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Oui, supprimez-le !"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
