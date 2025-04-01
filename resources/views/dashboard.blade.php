@extends('layouts.app')
{{-- @section('title', 'Home - Laravel Admin Panel With Login and Registration') --}}
@php
    // Use Laravel's session management to check user role
    $userRole = session('role');
    $isLoggedIn = Auth::check();

    // dd($id);
@endphp
@if ($userRole === 'user')
<script>
    window.location.href = "{{ route('lcds') }}";
    </script>

@else
@section('contents')
<div class="row">
    <div class="col-lg-12">
        <h1 class="mb-4">Accueil</h1>
        <p>Bienvenue sur le panneau d'administration La Casa De Selfie.</p>
        <p>Ce panneau d'administration vous permet de gérer les utilisateurs, les photos, les réservations, etc.</p>
        <p>N'hésitez pas à explorer les différentes fonctionnalités disponibles.</p>
    </div>
</div>

<div class="layer"></div>
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Gestion de Profile</h2>
                        <p class="card-text">Gérez les utilisateurs enregistrés dans votre application. Ajoutez, modifiez ou supprimez des utilisateurs selon vos besoins.</p>
                        <a href="{{ route('utilisateurs.index') }}" class="btn btn-primary">Voir les Utilisateurs</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Gestion de Galerie</h2>
                        <p class="card-text">Gérez les Galeries de votre application. Ajoutez des nouvelles photos, mettez à jour les informations existantes, etc.</p>
                        <a href="{{ route('galeries.index') }}" class="btn btn-primary">Voir les photos</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@section('scripts')
<!-- Chart library -->
<script src="{{ asset('admin_assets/plugins/chart.min.js') }}"></script>
<!-- Icons library -->
<script src="{{ asset('admin_assets/plugins/feather.min.js') }}"></script>
<!-- Custom scripts -->
<script src="{{ asset('admin_assets/js/script.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Change to 'line' or other types if needed
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
@endsection

@endif
