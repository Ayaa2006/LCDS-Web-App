@php
use Illuminate\Support\Facades\Session;
// Check if the user is logged in
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
    <title>La Casa de Selfie - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
        overflow-x: hidden;

    }





    /* Rendre la card plus jolie avec une bordure arrondie et une ombre */
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Plus de styles pour la section de profil si nécessaire */
    .profile-container {
        max-width: 1100px;
        margin: 50px auto;
        background-color: white;
        border-radius: 15px;
        padding: 20px 40px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }
    </style>

</head>

<body>
    @include('navbar')



    {{-- Success Popup --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    @if(Session::has('success'))
    <script>
    Swal.fire({
        title: "Good job!",
        text: "{{ session('success') }}",
        icon: "success"
    });
    </script>
    @endif


    <!-- Header Section -->
    <header class="text-white py-5"
        style="background-image: url({{ asset('bg.jpg') }}); background-repeat: no-repeat; background-position: center; background-size: cover; height: 360px;">
        <div class="container text-center">
            <div class="header-text" style="max-width: 600px; margin: auto;">
                <h1 class="display-4">LA CASA DE SELFIE</h1>
                <p class="lead">Bienvenue chez La Casa de Selfie, situé à Casablanca, Maroc. Nous sommes bien plus qu'un
                    studio photo, offrant un espace créatif pour la capture de photos, vidéos, podcasts, et la
                    production de courts-métrages et de publicités.</p>
                <a class="btn btn-light btn-custom" href="{{ route('about') }}">À propos</a>
                <a class="btn btn-dark btn-custom" href="{{ route('sphoto') }}">Rendez-vous</a>
            </div>
        </div>
    </header>
    <section class="values py-5">
        <div class="container text-center">
            <h2 class="mb-4">Nos Valeurs</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Value 1 -->
                <div class="col">
                    <div class="card h-100 border-light shadow">
                        <div class="card-body text-center">
                            <i class="fas fa-shield-alt fa-3x mb-3 text-secondary"></i>
                            <h5 class="card-title">Sécurité des Informations</h5>
                            <p class="card-text">Nous garantissons la sécurité et la confidentialité de vos données à
                                chaque étape.</p>
                        </div>
                    </div>
                </div>

                <!-- Value 2 -->
                <div class="col">
                    <div class="card h-100 border-light shadow">
                        <div class="card-body text-center">
                            <i class="fas fa-camera-retro fa-3x mb-3 text-secondary"></i>
                            <h5 class="card-title">Qualité Professionnelle</h5>
                            <p class="card-text">Nos équipements de pointe assurent des photos et vidéos de la plus
                                haute qualité.</p>
                        </div>
                    </div>
                </div>

                <!-- Value 3 -->
                <div class="col">
                    <div class="card h-100 border-light shadow">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x mb-3 text-secondary"></i>
                            <h5 class="card-title">Expérience Client</h5>
                            <p class="card-text">Notre priorité est de vous offrir une expérience inoubliable et
                                personnalisée.</p>
                        </div>
                    </div>
                </div>

                <!-- Value 4 -->
                <div class="col">
                    <div class="card h-100 border-light shadow">
                        <div class="card-body text-center">
                            <i class="fas fa-lightbulb fa-3x mb-3 text-secondary"></i>
                            <h5 class="card-title">Innovation</h5>
                            <p class="card-text">Nous restons à la pointe des tendances pour offrir des services
                                modernes et créatifs.</p>
                        </div>
                    </div>
                </div>

                <!-- Value 5 -->
                <div class="col">
                    <div class="card h-100 border-light shadow">
                        <div class="card-body text-center">
                            <i class="fas fa-thumbs-up fa-3x mb-3 text-secondary"></i>
                            <h5 class="card-title">Satisfaction Garantie</h5>
                            <p class="card-text">Nous nous engageons à vous offrir des résultats qui dépassent vos
                                attentes.</p>
                        </div>
                    </div>
                </div>

                <!-- Value 6 -->
                <div class="col">
                    <div class="card h-100 border-light shadow">
                        <div class="card-body text-center">
                            <i class="fas fa-comments fa-3x mb-3 text-secondary"></i>
                            <h5 class="card-title">Communication Ouverte</h5>
                            <p class="card-text">Nous valorisons la communication avec nos clients pour mieux comprendre
                                leurs besoins.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


   <!-- Gallery Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Galerie</h2>
        <div class="text-center mb-4">
            <a class="btn btn-link" id="a2" href="{{ route('galerie.index') }}" style="font-size: 14px; color: #007bff;">
                Voir Tout
            </a>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <!-- Gallery Item -->
    @php
        $i = 0; // Initialize counter
    @endphp
    @foreach ($galeries as $galerie)
        @if ($i >= 3)
            @break
        @endif
        <div class="col mb-4">
            <div class="card border-0 shadow-sm" style="height: 400px;">
                <img src="{{ asset('storage/' . $galerie->img) }}" class="card-img-top img-fluid" alt="{{ $galerie->titre }}" style="object-fit: cover; height: 250px;">
                <div class="card-body text-center" style="padding-bottom: 10px;">
                    <h5 class="card-title">{{ $galerie->titre }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($galerie->description, 100) }}</p>
                </div>
            </div>
        </div>
        @php
            $i++; // Increment counter
        @endphp
    @endforeach
</div>

    </div>
</section>



    <style>
    .btn-link {
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .btn-link:hover {
        color: #0056b3;
        /* Couleur au survol */
    }
    </style>

    <!-- Équipe -->
    <section class="team py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Notre Équipe</h2>
            <h4 class="text-muted mb-4">Rencontrez Nos Experts</h4>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                <!-- Personne 1 -->
                <div class="col mb-4">
                    <div class="card h-100 text-center shadow">
                        <i class="bi bi-brush" style="font-size: 60px; color: #333;"></i>
                        <div class="card-body">
                            <h5 class="card-title">Directeur Créatif</h5>
                            <p class="card-text">Supervise la vision artistique et la direction du studio.</p>
                        </div>
                    </div>
                </div>

                <!-- Personne 2 -->
                <div class="col mb-4">
                    <div class="card h-100 text-center shadow">
                        <i class="bi bi-camera" style="font-size: 60px; color: #333;"></i>
                        <div class="card-body">
                            <h5 class="card-title">Photographe</h5>
                            <p class="card-text">Responsable de la capture d'images de haute qualité.</p>
                        </div>
                    </div>
                </div>

                <!-- Personne 3 -->
                <div class="col mb-4">
                    <div class="card h-100 text-center shadow">
                        <i class="bi bi-image" style="font-size: 60px; color: #333;"></i>
                        <div class="card-body">
                            <h5 class="card-title">Éditeur Photo</h5>
                            <p class="card-text">Édite et retouche les images pour améliorer leur qualité.</p>
                        </div>
                    </div>
                </div>

                <!-- Personne 4 -->
                <div class="col mb-4">
                    <div class="card h-100 text-center shadow">
                        <i class="bi bi-chat-dots" style="font-size: 60px; color: #333;"></i>
                        <div class="card-body">
                            <h5 class="card-title">Community Manager</h5>
                            <p class="card-text">Gère la présence en ligne et l'engagement avec la communauté.</p>
                        </div>
                    </div>
                </div>

                <!-- Personne 5 -->
                <div class="col mb-4">
                    <div class="card h-100 text-center shadow">
                        <i class="bi bi-code-slash" style="font-size: 60px; color: #333;"></i>
                        <div class="card-body">
                            <h5 class="card-title">Développeur Web</h5>
                            <p class="card-text">Responsable du développement et de la maintenance de l'application.</p>
                        </div>
                    </div>
                </div>

                <!-- Personne 6 -->
                <div class="col mb-4">
                    <div class="card h-100 text-center shadow">
                        <i class="bi bi-person-lines-fill" style="font-size: 60px; color: #333;"></i>
                        <div class="card-body">
                            <h5 class="card-title">Assistant Administratif</h5>
                            <p class="card-text">Assiste dans la gestion quotidienne et la planification des projets.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="team py-5 bg-light">
        <div class="row-cols-1">
            <div class="col-sm-12">
                <div class="card mb-3 mt-4"
                    style="max-width: 95%; margin-left: 2%; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('studio.jpg') }}" class="img-fluid rounded-start" alt="Notre équipe"
                                style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; object-fit: cover; height: 325px; width: 100%;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title text-center" style="color: #333; font-weight: bold;">Qui Sommes
                                    Nous ?</h4>
                                <h6 class="card-text text-center"><small class="text-body-secondary">Votre partenaire en
                                        photographie</small></h6>
                                <br>
                                <p class="card-text">
                                    Chez La Casa de Selfie, notre mission est de capturer des moments précieux avec
                                    passion et créativité. Voici ce que nous vous offrons :
                                </p>
                                <ul class="list-unstyled" style="line-height: 1.6;">
                                    <li><i class="bi bi-check-circle" style="color: #007bff;"></i> Services de
                                        photographie professionnelle adaptés à vos besoins.</li>
                                    <li><i class="bi bi-check-circle" style="color: #007bff;"></i> Expériences uniques
                                        pour chaque client, créant des souvenirs inoubliables.</li>
                                    <li><i class="bi bi-check-circle" style="color: #007bff;"></i> Une équipe passionnée
                                        et expérimentée à votre service.</li>
                                </ul>
                                <p class="card-text">
                                    Notre équipe travaille sans relâche pour vous fournir des photos de la plus haute
                                    qualité, tout en vous offrant un service exceptionnel.
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="team py-5 bg-light" style="display:block" id="abonner">
        <div
            style="width: 40%; margin: 0 auto; padding: 20px; background-color:rgb(255, 255, 255); border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
            <h4 class="text-center" style="color: #333; margin-bottom: 20px;">Abonnez-vous à notre newsletter</h4>
            <form action="{{ route('abnstore') }}" class="form" method="POST">
                @csrf
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="example@email.com" name="email" required
                        style="border-radius: 20px 0 0 20px;" />
                    <button type="submit" class="btn btn-dark" style="border-radius: 0 20px 20px 0;">S'abonner</button>
                </div>
            </form>
            <p class="text-center" style="margin-top: 10px; font-size: 0.9em; color: #666;">
                Recevez les dernières nouvelles et offres directement dans votre boîte de réception.
            </p>

            <a class="text-center toggle-link"
   style=""
   onclick="ShowHideDiv()"> 
    Se désabonner à notre newsletter
</a>
        </div>
    </section>

    <section class="team py-5 bg-light" style="display:none" id="desabonner">
        <div
            style="width: 40%; margin: 0 auto; padding: 20px; background-color:rgb(255, 255, 255); border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
            <h4 class="text-center" style="color: #333; margin-bottom: 20px;">Se désabonner à notre newsletter</h4>
            <form action="{{ route('desabonner') }}" class="form" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="ABC123EFG9" name="code" required
                        style="border-radius: 20px 0 0 20px;" />
                        
                    <button type="submit" class="btn btn-dark" style="border-radius: 0 20px 20px 0;">Désabonner</button>
                </div>
            </form>
            <p class="text-center" style="margin-top: 10px; font-size: 0.9em; color: #666;">
                Utiliser votre code envoyé par email pour vous désabonner.    
        </p>

        <a class="text-center toggle-link"
   style=""
   onclick="ShowHideDiv()"> 
    S'abonnez à notre newsletter
</a>
        </div>
    </section>
    <style>
    
    section a {
        color: inherit; /* Inherits color from parent */
        text-decoration: inherit; /* Inherits text-decoration from parent */
        cursor: pointer; /* Ensures pointer cursor on hover */
    }

    section a:hover {
        color: #007bff; /* Your desired hover color */
        text-decoration: underline; /* Underline on hover */
    }

    .toggle-link {
        margin-top: 10px; 
        font-size: 0.9em; 
        color: #666;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        text-decoration: none;
    }

    .toggle-link:hover {
        color:rgb(66, 85, 72);
        text-decoration: none;
        font-size : 14px;
    }
</style>
        <script>
            function ShowHideDiv()
            {
                var abonner = document.getElementById("abonner");
                var desabonner = document.getElementById("desabonner");
                if(abonner.style.display === "block")
                {
                    abonner.style.display = "none";
                    desabonner.style.display = "block";
                }
                else
                {
                    abonner.style.display = "block";
                    desabonner.style.display = "none";
                }
            }
        
        </script>
    <section>
        <!-- Témoignages -->
        <div class="testimonials py-5 bg-light">
            <div class="text-center mb-4">
                <h4 class="text-dark">Témoignages</h4>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" style="padding: 0 4%;">
                <!-- Témoignage 1 -->
                <div class="col mb-4">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('assistant.jpg')}}" class="img-fluid rounded-circle"
                                alt="Photo du client" style="width: 100px; height: 100px;">
                        </div>
                        <h5 class="card-title mt-3">Kenza Berrada</h5>
                        <h6 class="card-text"><small class="text-muted">Cliente satisfaite</small></h6>
                        <div class="mb-2">
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-secondary">&#9733;</span>
                        </div>
                        <p class="card-text mt-4">
                            "La Casa de Selfie a été une expérience incroyable ! La qualité des photos a dépassé mes
                            attentes. Le service à distance est très pratique !"
                        </p>
                    </div>
                </div>

                <!-- Témoignage 2 -->
                <div class="col mb-4">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('fashion.jpg')}}" class="img-fluid rounded-circle" alt="Photo du client"
                                style="width: 100px; height: 100px;">
                        </div>
                        <h5 class="card-title mt-3">Sara Lahlou</h5>
                        <h6 class="card-text"><small class="text-muted">Cliente heureuse</small></h6>
                        <div class="mb-2">
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-secondary">&#9733;</span>
                        </div>
                        <p class="card-text mt-4">
                            "J'ai adoré le studio de selfie virtuel! Les options de fond étaient fantastiques, et
                            l'équipe était très réactive et disponible!"
                        </p>
                    </div>
                </div>

                <!-- Témoignage 3 -->
                <div class="col mb-4">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('editeurphoto.jpg')}}" class="img-fluid rounded-circle"
                                alt="Photo du client" style="width: 100px; height: 100px;">
                        </div>
                        <h5 class="card-title mt-3">Taha Soulami</h5>
                        <h6 class="card-text"><small class="text-muted">Utilisateur fréquent</small></h6>
                        <div class="mb-2">
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-warning">&#9733;</span>
                            <span class="text-secondary">&#9733;</span>
                        </div>
                        <p class="card-text mt-4">
                            "Prendre des selfies professionnels à distance était un jeu d'enfant ! Le résultat était
                            superbe, et j'ai adoré la simplicité du processus !"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer -->
    @include('footer')

    {{-- *! alert --}}
    <!-- Include SweetAlert2 -->

    {{-- @section('scripts')
@if (session('status'))
    <script>
        Swal.fire({
            title: "Good job!",
            text: "{{ session('status') }}",
    icon: "success"
    });
    </script>
    @endif

    @if (session('error'))
    <script>
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "{{ session('error') }}",
        footer: '<a href="#">Why do I have this issue?</a>'
    });
    </script>
    @endif
    @endsection --}}
    {{-- *! --}}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>