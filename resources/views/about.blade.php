@php
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
    <title>La Casa de Selfie - About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
<!-- Navbar -->
@include('navbar')

    <!-- Header Section -->
    <header class="bg-dark text-white text-center py-5" style="background-image: url(assets_casa_de_selfie/360_F_512933916_Wzr2Jw0EQYuWDDOJI9mT5buG7LEGpAeM.jpg);background-repeat: no-repeat; background-position: right;height: 360px; background-size: cover;">
        <div class="container" style="margin: auto; padding: auto; margin-top: 100px;">
            <h1>LA CASA DE SELFIE</h1>
            <p>About</p>
        </div>
    </header>

    <section>

        <div class="row-cols-1">

            <div class="col-sm-12">

                <div class="card mb-3 mt-4" style="max-width: 95%;margin-left : 2%;">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex">
                            <img src="{{ asset('studio.jpg') }}" class="img-fluid rounded-start" alt="Studio Image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title">Qui Sommes Nous ?</h4>
                                <h6 class="card-text"><small class="text-body-secondary">Qui Sommes Nous ?</small></h6>
                                <br>
                                <p class="card-text">
                                    La Casa de Selfie est bien plus qu’un simple studio photo. Nous croyons en la magie de capturer des moments précieux à distance. Notre concept unique permet aux utilisateurs de prendre des selfies professionnels dans le confort de leur maison, tout en bénéficiant de conseils personnalisés sur la mise en scène et l'éclairage. Notre équipe passionnée est dédiée à offrir une expérience exceptionnelle à chaque client, transformant la photographie en une aventure inoubliable.
                                </p>
                                <p class="card-text">Notre vision est d'élargir les horizons de la photographie traditionnelle en intégrant des technologies innovantes. Chaque selfie que nous aidons à capturer est une œuvre d’art, mettant en valeur non seulement la beauté extérieure, mais aussi l’authenticité de la personnalité de chacun.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">

                <div class="card mb-3 mt-3" style="max-width: 95%;margin-left : 2%;">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title">Notre Engagement</h4>
                                <h6 class="card-text"><small class="text-body-secondary">Notre Engagement</small></h6>
                                <br>
                                <p class="card-text">Nous nous engageons à offrir une plateforme sécurisée où chaque utilisateur peut explorer sa créativité. La confidentialité et la qualité sont nos priorités, et nous nous efforçons de créer un environnement positif où chaque selfie est célébré.</p>
                                <p class="card-text">Avec La Casa de Selfie, chaque instant devient un souvenir inoubliable. Rejoignez-nous pour redéfinir l’art de la photographie à distance et laissez-nous capturer votre unicité.</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex">
                            <img src="{{ asset('team.jpg') }}" class="img-fluid rounded-start" alt="Team Image">
                        </div>
                    </div>
                </div>

            </div>

        </div>


         <!-- Équipe -->
        <!-- Équipe -->
<div class="team">
    <div class="btn btn-dark mt-3" style="padding: 15px 30px; border-radius: 100px; margin-left: 2%;">
        <h4 class="card-text text-white">Notre Équipe</h4>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3" style="width: 99%; padding: 4%;">
        <!-- Personne 1 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <img src="directeurcreatif.jpg" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; margin-top: 10px;">
                <div class="card-body">
                    <h5 class="card-title">Directeur Créatif</h5>
                    <p class="card-text">Supervise la vision artistique et la direction du studio.</p>
                </div>
            </div>
        </div>

        <!-- Personne 2 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <img src="photographer.jpg" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; margin-top: 10px;">
                <div class="card-body">
                    <h5 class="card-title">Photographe</h5>
                    <p class="card-text">Responsable de la capture d'images de haute qualité.</p>
                </div>
            </div>
        </div>

        <!-- Personne 3 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <img src="editeurphoto.jpg" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; margin-top: 10px;">
                <div class="card-body">
                    <h5 class="card-title">Éditeur Photo</h5>
                    <p class="card-text">Édite et retouche les images pour améliorer leur qualité.</p>
                </div>
            </div>
        </div>

        <!-- Personne 4 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <img src="communitymanager.jpg" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; margin-top: 10px;">
                <div class="card-body">
                    <h5 class="card-title">Community Manager</h5>
                    <p class="card-text">Gère la présence en ligne et l'engagement avec la communauté.</p>
                </div>
            </div>
        </div>

        <!-- Personne 5 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <img src="developpeurweb.jpg" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; margin-top: 10px;">
                <div class="card-body">
                    <h5 class="card-title">Développeur Web</h5>
                    <p class="card-text">Responsable du développement et de la maintenance de l'application.</p>
                </div>
            </div>
        </div>

        <!-- Personne 6 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <img src="assistant.jpg" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; margin-top: 10px;">
                <div class="card-body">
                    <h5 class="card-title">Assistant Administratif</h5>
                    <p class="card-text">Assiste dans la gestion quotidienne et la planification des projets.</p>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Équipe -->
{{-- <div class="team">
    <div class="btn btn-dark mt-3" style="padding: 15px 30px; border-radius: 100px; margin-left: 2%;">
        <h4 class="card-text text-white">Notre Équipe</h4>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3" style="width: 99%; padding: 4%;">
        <!-- Personne 1 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <i class="bi bi-brush" style="font-size: 50px;"></i>
                <div class="card-body">
                    <h5 class="card-title">Directeur Créatif</h5>
                    <p class="card-text">Supervise la vision artistique et la direction du studio.</p>
                </div>
            </div>
        </div>

        <!-- Personne 2 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <i class="bi bi-camera" style="font-size: 50px;"></i>
                <div class="card-body">
                    <h5 class="card-title">Photographe</h5>
                    <p class="card-text">Responsable de la capture d'images de haute qualité.</p>
                </div>
            </div>
        </div>

        <!-- Personne 3 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <i class="bi bi-image" style="font-size: 50px;"></i>
                <div class="card-body">
                    <h5 class="card-title">Éditeur Photo</h5>
                    <p class="card-text">Édite et retouche les images pour améliorer leur qualité.</p>
                </div>
            </div>
        </div>

        <!-- Personne 4 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <i class="bi bi-chat-dots" style="font-size: 50px;"></i>
                <div class="card-body">
                    <h5 class="card-title">Community Manager</h5>
                    <p class="card-text">Gère la présence en ligne et l'engagement avec la communauté.</p>
                </div>
            </div>
        </div>

        <!-- Personne 5 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <i class="bi bi-code-slash" style="font-size: 50px;"></i>
                <div class="card-body">
                    <h5 class="card-title">Développeur Web</h5>
                    <p class="card-text">Responsable du développement et de la maintenance de l'application.</p>
                </div>
            </div>
        </div>

        <!-- Personne 6 -->
        <div class="col mb-4">
            <div class="card h-100 text-center shadow-sm">
                <i class="bi bi-person-lines-fill" style="font-size: 50px;"></i>
                <div class="card-body">
                    <h5 class="card-title">Assistant Administratif</h5>
                    <p class="card-text">Assiste dans la gestion quotidienne et la planification des projets.</p>
                </div>
            </div>
        </div>
    </div>
</div> --}}




            <!-- Valeurs de notre studio -->
            <!-- Valeurs de notre studio -->
                <div class="values">
                    <div class="btn btn-dark mt-3" style="padding: 15px 30px; border-radius: 100px; margin-left: 2%;">
                        <h4 class="card-text text-white">
                            Nos Valeurs
                        </h4>
                    </div>

                    <div class="row row-cols-1 row-cols-sm-3" style="width: 99%; padding: 4%;">
                        <!-- Post 1 -->
                        <div class="col mb-4">
                            <div class="card h-100 shadow-sm text-center">
                                <div class="card-body">
                                    <i class="bi bi-lock" style="font-size: 60px; color: #007bff;"></i>
                                    <h5 class="card-title mt-3">Sécurité des informations</h5>
                                    <p class="card-text">Nous nous engageons à protéger vos données et à garantir la confidentialité de chaque client. La sécurité est notre priorité.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Post 2 -->
                        <div class="col mb-4">
                            <div class="card h-100 shadow-sm text-center">
                                <div class="card-body">
                                    <i class="bi bi-brush" style="font-size: 60px; color: #007bff;"></i>
                                    <h5 class="card-title mt-3">Créativité</h5>
                                    <p class="card-text">Nous croyons que chaque projet est une opportunité de faire preuve d'innovation. La créativité est au cœur de notre travail.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Post 3 -->
                        <div class="col mb-4">
                            <div class="card h-100 shadow-sm text-center">
                                <div class="card-body">
                                    <i class="bi bi-star" style="font-size: 60px; color: #007bff;"></i>
                                    <h5 class="card-title mt-3">Excellence</h5>
                                    <p class="card-text">Nous visons l'excellence dans tout ce que nous faisons, en fournissant un service de haute qualité à nos clients.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Post 4 -->
                        {{-- <div class="col mb-4">
                            <div class="card h-100 shadow-sm text-center">
                                <div class="card-body">
                                    <i class="bi bi-chat" style="font-size: 60px; color: #007bff;"></i>
                                    <h5 class="card-title mt-3">Communication</h5>
                                    <p class="card-text">Nous valorisons la communication ouverte et honnête avec nos clients, pour garantir une collaboration efficace.</p>
                                </div>
                            </div>
                        </div> --}}


                    <!-- Post 4 (ajout d'une quatrième valeur) -->
                    {{-- <div class="col mb-4">
                        <div class="card h-100 shadow-sm text-center">
                            <div class="card-body">
                                <img src="assets_casa_de_selfie/communication-icon.png" alt="Communication" style="width: 60px; height: 60px;">
                                <h5 class="card-title mt-3">Communication</h5>
                                <p class="card-text">Nous valorisons la communication ouverte et honnête avec nos clients, pour garantir une collaboration efficace.</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>


    </section>

    <!-- Footer Section -->
   @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

</body>

</html>
