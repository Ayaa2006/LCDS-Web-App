@php
// Check if the user is logged in and their role
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
    <title>Edit Profile - La Casa de Selfie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            height: 50px;
        }

        .profile-container {
            max-width: 800px;
            margin: 5% auto;
            padding: 40px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid #031d39;
            transition: opacity 0.3s;
        }

        .profile-header h2 {
            margin: 0;
            margin-left: 20px;
            font-size: 2.5rem;
            font-weight: 600;
            color: #031d39;
        }

        .form-label {
            font-weight: 600;
            color: #031d39;
        }

        .btn-custom {
            background-color: #031d39;
            color: #ffffff;
            border-radius: 5px;
        }

        .btn-custom:hover {
            background-color: #022b45;
            color: #ffffff;
        }

        .btn-secondary {
            margin-left: 10px;
        }

        .profile-img-preview {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            display: block;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .profile-header img {
                margin-bottom: 15px;
            }

            .profile-header h2 {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('lcds') }}">
                <img src="{{ asset('image-removebg-preview.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('lcds') }}">Home</a></li>
                    <li class="nav-item dropdown">
                        <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{ route('vs') }}">Visite Virtuelle Interactive</a></li>
                            <li><a class="dropdown-item" href="{{ route('sphoto') }}">Prise de Photos à Distance</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('galerie.index') }}">Galerie</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>

                    @if ($isLoggedIn)
                        <li class="nav-item"><a class="btn btn-custom" href="{{ route('logout') }}">Logout</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.index') }}">Profile</a></li>
                    @else
                        <li class="nav-item"><a class="btn btn-light" href="{{ route('login') }}">Sign In</a></li>
                        <li class="nav-item"><a class="btn btn-dark" href="{{ route('register') }}">Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Edit Profile Container -->
    <div class="container profile-container">
        <!-- Edit Profile Header -->
        <div class="profile-header">
            <img src="{{ asset('storage/' . $user->img) }}" alt="Profile Picture" id="profile-pic" class="profile-img">
            <div>
                <h2>Edit Profile</h2>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $user->code) }}">
            </div>

            <!-- Profile Picture Upload -->
            <div class="mb-3">
                <label for="img" class="form-label">Profile Picture:</label>
                <input type="file" id="img" name="img" class="form-control-file mb-3" onchange="previewImage(event)">
                @if($user->img)
                <div class="mt-2">
                    <img id="profile-img-preview" src="{{ asset('storage/' . $user->img) }}" alt="Current Profile Picture" class="profile-img-preview" style="display: {{ $user->img ? 'block' : 'none' }}">
                </div>
                @endif
            </div>
            <button type="submit" class="btn btn-custom">Update Profile</button>
            <a href="{{ route('profile.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- JS & Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.8.3/sweetalert2.all.min.js"></script>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profile-img-preview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Handle profile picture hover effect
            const profilePic = document.getElementById('profile-pic');
            profilePic.addEventListener('mouseover', function () {
                profilePic.style.opacity = 0.8;
            });
            profilePic.addEventListener('mouseout', function () {
                profilePic.style.opacity = 1;
            });
        });
    </script>
</body>
</html>
