<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .custom-navbar {
            background-color:rgb(240, 240, 240); /* AliceBlue */
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .custom-navbar .navbar-brand img {
            border-radius: 10px;
        }
        /* Style commun pour tous les éléments de navigation */
        .custom-navbar .nav-link,
        .custom-navbar .btn {
            color: #333;
            font-weight: bold;
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 8px 14px;
            margin: 0 2px;
        }
        /* Style pour les liens standard */
        .custom-navbar .nav-link {
            text-decoration: none;
        }
        .custom-navbar .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: #000;
        }
        /* Style pour les boutons principaux */
        .custom-navbar .btn-custom {
            background-color: black;
            color: white;
            border: none;
        }
        .custom-navbar .btn-custom:hover {
            background-color: #333;
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        /* Style pour le bouton outline */
        .custom-navbar .btn-outline-dark {
            border: 1px solid #333;
            background-color: transparent;
            color: #333;
        }
        .custom-navbar .btn-outline-dark:hover {
            background-color: #333;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        /* Style pour le dropdown */
        .dropdown-menu-custom {
            background-color: #F0F8FF;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .dropdown-menu-custom .dropdown-item {
            color: #333;
            font-weight: 500;
            padding: 8px 16px;
            transition: all 0.2s ease;
        }
        .dropdown-menu-custom .dropdown-item:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: #000;
            transform: translateX(3px);
        }
        /* Style pour l'élément actif */
        .custom-navbar .nav-link.active {
            background-color: rgba(0, 0, 0, 0.1);
            color: #000;
            font-weight: bold;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .custom-navbar .btn-custom.active {
            background-color: #333;
            color: white;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
        }
        .dropdown-menu-custom .dropdown-item.active {
            background-color: rgba(0, 0, 0, 0.1);
            color: #000;
            font-weight: bold;
        }
        /* Style pour la version mobile */
        @media (max-width: 992px) {
            .custom-navbar .nav-link,
            .custom-navbar .btn {
                margin: 5px 0;
                display: block;
                text-align: left;
            }
        }
    </style>
</head>

@php
use Illuminate\Support\Facades\Route;
$userRole = session('role');
$isLoggedIn = Auth::check();
$currentRoute = Route::currentRouteName();
@endphp

<body>
<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('lcds') }}">
            <img src="{{ asset('image-removebg-preview.png') }}" width="80" height="55" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent"
            aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute == 'lcds' ? 'active' : '' }}" href="{{ route('lcds') }}">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <button class="btn btn-custom dropdown-toggle {{ in_array($currentRoute, ['vs', 'sphoto']) ? 'active' : '' }}" 
                            data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </button>
                    <ul class="dropdown-menu dropdown-menu-custom">
                        <li>
                            <a class="dropdown-item {{ $currentRoute == 'vs' ? 'active' : '' }}" 
                               href="{{ route('vs') }}">Visite Virtuelle</a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ $currentRoute == 'sphoto' ? 'active' : '' }}" 
                               href="{{ route('sphoto') }}">Prise de Photos</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute == 'blog.index' ? 'active' : '' }}" 
                       href="{{ route('blog.index') }}">Blogue</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute == 'galerie.index' ? 'active' : '' }}" 
                       href="{{ route('galerie.index') }}">Galerie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute == 'contact' ? 'active' : '' }}" 
                       href="{{ route('contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute == 'about' ? 'active' : '' }}" 
                       href="{{ route('about') }}">À propos</a>
                </li>
                @if ($isLoggedIn)
                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute == 'profile.index' ? 'active' : '' }}" 
                       href="{{ route('profile.index') }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-custom {{ $currentRoute == 'logout' ? 'active' : '' }}" 
                       href="{{ route('logout') }}">Déconnexion</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="btn btn-custom {{ $currentRoute == 'login' ? 'active' : '' }}" 
                       href="{{ route('login') }}">Se connecter</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-dark {{ $currentRoute == 'register' ? 'active' : '' }}" 
                       href="{{ route('register') }}">S'inscrire</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
</body>
