<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Votre CSS personnalisé -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    @yield('contents')

    <script src="{{ asset('js/app.js') }}"></script> <!-- Votre JS personnalisé -->



@extends('layouts.app')

@section('title', 'Liste des Photos')

@section('contents')
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr>
                    <td class="align-middle">{{ $reservation->id }}</td>
                    <td class="align-middle">{{ $reservation->name }}</td>
                    <td class="align-middle">{{ $reservation->prenom }}</td>
                    <td class="align-middle">{{ $reservation->email }}</td>
                    <td class="align-middle">{{ $reservation->adress }}</td>
                    <td class="align-middle">
                        <img src="{{ asset($reservation->img) }}" alt="Reservation Photo" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                    </td>
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Actions">
                            <a href="{{ asset($reservation->img) }}" download class="btn btn-warning">Télécharger la photo</a>
                            <form id="delete-form-{{ $reservation->id }}" action="{{ route('photos.destroy', $reservation->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-button" data-form-id="delete-form-{{ $reservation->id }}">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucune photo trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    const formId = this.getAttribute('data-form-id');
                    const form = document.getElementById(formId);

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
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

</body>
</html>
