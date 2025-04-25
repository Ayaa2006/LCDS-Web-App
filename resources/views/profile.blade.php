@php
$userRole = session('role');
$isLoggedIn = Auth::check();

@endphp

@if ($userRole === 'admin')
<script>
window.location.href = "{{ route('dashboard') }}";
</script>
@endif

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Casa de Selfie - Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    :root {
        --primary-color: #2c3e50; /* Noir bleuté sophistiqué */
        --secondary-color: #e74c3c; /* Rouge accent pour les actions */
        --accent-color: #3498db; /* Bleu pour les interactions */
        --light-bg: #f8f9fa;
        --border-color: #ecf0f1;
        --text-dark: #2c3e50;
        --text-medium: #7f8c8d;
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Arial', sans-serif;
        color: var(--text-dark);
    }

    .navbar {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        background-color: white;
        border-bottom: 1px solid var(--border-color);
    }

    .profile-container {
        max-width: 1100px;
        margin: 50px auto;
        background-color: white;
        border-radius: 8px;
        padding: 30px 40px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
    }

    .profile-header {
        display: flex;
        align-items: center;
        padding-bottom: 25px;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 25px;
    }

    .profile-header img {
        border-radius: 50%;
        width: 120px;
        height: 120px;
        object-fit: cover;
        margin-right: 30px;
        border: 4px solid var(--primary-color);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-header h2 {
        font-size: 2.2rem;
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 5px;
    }

    .profile-header p {
        font-size: 1rem;
        color: var(--text-medium);
        margin-bottom: 15px;
    }

    .btn-custom {
        background-color: var(--primary-color);
        color: white;
        border-radius: 30px;
        padding: 10px 20px 10px 15px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-custom:hover {
        background-color: #1a252f;
        color: white;
        transform: translateY(-1px);
    }

    .btn-custom i {
        font-size: 0.9rem;
    }

    .btn-gamification {
        background-color: var(--accent-color);
        color: white;
        border-radius: 30px;
        padding: 10px 20px 10px 15px;
        font-weight: 600;
        margin-left: 10px;
        transition: all 0.3s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-gamification:hover {
        background-color: #2980b9;
        color: white;
        transform: translateY(-1px);
    }

    .btn-cancel {
        background-color: var(--secondary-color);
        color: white;
        border-radius: 5px;
        font-weight: 600;
        padding: 5px 12px 5px 10px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        background-color: #c0392b;
        color: white;
    }

    .table th {
        color: var(--primary-color);
        font-weight: 600;
    }

    .table td {
        color: var(--text-dark);
    }

    .table thead th {
        background-color: var(--light-bg);
        color: var(--primary-color);
        font-weight: 600;
        border-bottom: 2px solid var(--border-color);
    }

    .btn-danger-custom {
        background-color: var(--secondary-color);
        color: white;
        border-radius: 30px;
        padding: 10px 20px 10px 15px;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-danger-custom:hover {
        background-color: #c0392b;
        color: white;
        transform: translateY(-1px);
    }

    .gamification-section {
        background-color: var(--light-bg);
        border-radius: 8px;
        padding: 20px;
        margin-top: 40px;
        border: 1px solid var(--border-color);
    }

    .gamification-section h3 {
        color: var(--primary-color);
        margin-bottom: 15px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .gamification-card {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
    }

    .navbar .nav-link {
        color: var(--primary-color);
        font-weight: 500;
        padding: 5px 15px;
        transition: all 0.2s;
    }

    .navbar .nav-link:hover {
        color: var(--accent-color);
    }

    h3 {
        color: var(--primary-color);
        font-weight: 600;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .table {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
    }

    .table tr:not(:last-child) {
        border-bottom: 1px solid var(--border-color);
    }

    .table-responsive {
        border-radius: 8px;
    }
    </style>
</head>

<body>
    @include('navbar')

    <div class="container profile-container">
        <div class="profile-header">
            <img src="{{ $user->img ? asset('storage/' . $user->img) : asset('storage/images/profil.jpg') }}" id="img" class="profile-img">
            <div>
                <h2 id="profile-name">{{ $user->name }}</h2>
                <p><i class="fas fa-calendar-alt me-2"></i>Member since {{ $user->created_at->format('F d, Y') }}</p>
                <a href="{{ route('profile-edit') }}" class="btn-custom mt-3">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>
                <a href="{{ route('gamification') }}" class="btn-gamification mt-3">
                    <i class="fas fa-trophy"></i> Gamification
                </a>
            </div>
        </div>

        <h3 class="mt-4"><i class="fas fa-info-circle me-2"></i>Profile Information</h3>
        <table class="table">
            <tbody>
                <tr>
                    <th>Nom :</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email :</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Code :</th>
                    <td>{{ $user->code ?? 'Not Set' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="gamification-section">
            <h3><i class="fas fa-medal me-2"></i>Gamification</h3>
            @if($user->gamification)
            <div class="gamification-card">
                <p><i class="fas fa-level-up-alt me-2"></i>Level : {{ $user->gamification->level }}</p>
                <p><i class="fas fa-star me-2"></i>Points : {{ $user->gamification->point }}</p>
                <p><i class="fas fa-tasks me-2"></i>Tasks Completed : {{ $user->gamification->tasks_done }}</p>
            </div>
            @else
            <p>No gamification data available.</p>
            @endif
        </div>

        <div class="mt-4">
            <h3 class="mt-4"><i class="fas fa-calendar-check me-2"></i>Tableau des Réservations</h3>

            @if(isset($reservations) && $reservations->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Date de rendez-vous</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->code }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->phone }}</td>
                        <td>{{ $reservation->date }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form id="delete-form-{{ $reservation->code }}" action="{{ route('reservation.delete') }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="code" value="{{ $reservation->code }}">
                                    <button type="button" class="btn-cancel delete-button" data-form-id="delete-form-{{ $reservation->code }}">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Aucune réservation trouvée.</p>
            @endif
        </div>

        @if($parrainages && count($parrainages))
            <div class="mt-4">
                <h3><i class="fas fa-users me-2"></i>Parrainages</h3>
                @foreach($parrainages as $parrainage)
                    <div class="d-flex align-items-center justify-content-between p-3 mb-3" style="background-color: var(--light-bg); border: 1px solid var(--border-color); border-radius: 8px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
                        <div class="d-flex align-items-center">
                            <img src="{{ $parrainage['img'] ? asset('storage/' . $parrainage['img']) : asset('storage/images/profil.jpg') }}" alt="Profile Picture" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; margin-right: 15px; border: 2px solid var(--primary-color);">
                            <div>
                                <h5 style="margin: 0; color: var(--primary-color); font-weight: 600;">{{ $parrainage['name'] }}</h5>
                                <p style="margin: 0; color: var(--text-medium); font-size: 0.9rem;">{{ $parrainage['email'] }}</p>
                            </div>
                        </div>
                        <div style="color: var(--text-medium); font-size: 0.9rem;">
                            {{ \Carbon\Carbon::parse($parrainage['created_at'])->format('F d, Y') }}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Aucun filleul n’a encore utilisé votre code.</p>
        @endif


        <div class="mt-4">
            <form action="{{ route('deleteAccount') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your profile?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger-custom">
                    <i class="fas fa-user-times"></i> Delete Profile
                </button>
            </form>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11/sweetalert2.min.js"></script>
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
                    confirmButtonColor: "#2c3e50",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Supprimer"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
    </script>
</body>

</html>