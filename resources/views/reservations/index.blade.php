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

    @section('title', 'Liste des Réservations')

    @section('contents')

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date</th>
                <th>Actions</th> <!-- Colonne Actions ajoutée -->
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $Reservation)
            <tr>
                <td class="align-middle">{{ $Reservation->id }}</td>
                <td class="align-middle">{{ $Reservation->name }}</td>
                <td class="align-middle">{{ $Reservation->email }}</td>
                <td class="align-middle">{{ $Reservation->phone }}</td>
                <td class="align-middle">{{ $Reservation->date }}</td>
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('Reservation.edit', $Reservation->id)}}" type="button"
                            class="btn btn-warning ">Modifier</a>


                        <form id="delete-form-{{ $Reservation->id }}"
                            action="{{ route('resdestroy', $Reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete-button"
                                data-form-id="delete-form-{{ $Reservation->id }}">Supprimer</button>
                        </form>

                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Aucune réservation trouvée.</td>
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