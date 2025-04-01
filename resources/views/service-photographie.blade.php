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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Casa de Selfie - Services de Photographie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
        font-family: 'Roboto', sans-serif;
    }


    .navbar {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }


    .navbar-nav .nav-link {
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #007bff;
    }

    /* .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            transition: transform 0.3s ease;
        } */

    .card-img-top:hover {
        transform: scale(1.05);
    }

    .btn-dark:hover {
        background-color: #343a40;
        transition: background-color 0.3s ease;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        /* Ensures that images do not overflow the card */
    }

    .card-img-top {
        height: 300px;
        /* Consistent height for all images */
        object-fit: cover;
        /* Ensures images fill the area without distortion */
    }


    header {
        background-image: url(assets_casa_de_selfie/photo_background.jpg);
        background-repeat: no-repeat;
        background-position: center;
        height: 360px;
        background-size: cover;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('navbar')



    <!-- Header Section -->
    <header class="bg-dark text-white text-center py-5"
        style="background-image: url(assets_casa_de_selfie/360_F_512933916_Wzr2Jw0EQYuWDDOJI9mT5buG7LEGpAeM.jpg);background-repeat: no-repeat; background-position: right;height: 360px; background-size: cover;">
        <div class="container" style="margin: auto; padding: auto; margin-top: 100px;">
            <h1>LA CASA DE SELFIE</h1>
            <p>Services de Photographie Professionnelle</p>
        </div>
    </header>



    <!-- Service Description Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center">Nos Services de Photographie</h2>
            <p class="text-center text-muted">Capturez vos moments précieux avec nos services professionnels.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4" style="height: 450px;">
                        <img src="service_photo_1.jpg" class="card-img-top img-fluid" alt="Service Photo 1"
                            style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Prise de Photos à Distance</h5>
                            <p class="card-text">Nous offrons des sessions de photo à distance pour capturer vos
                                meilleurs moments sans que vous ayez à vous déplacer. Profitez de la commodité de la
                                photographie à distance.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4" style="height: 450px;">
                        <img src="studio.jpg" class="card-img-top img-fluid" alt="Service Photo 2"
                            style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Visite Virtuelle Interactive</h5>
                            <p class="card-text">Explorez nos services à travers une visite virtuelle interactive.
                                Découvrez comment nous travaillons et ce que nous offrons.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Nos Forfaits de Photographie</h2>
            <div class="row">
                @foreach ($stocks as $stock)
                <div class="col-md-4 mb-4">
                    <div class="card shadow border-light"
                        style="background-image: url('{{ asset('wedding.jpg') }}'); background-size: cover; color: white;">
                        <div class="card-body text-center" style="background-color: rgba(0, 0, 0, 0.5);">
                            <!-- Ajout d'un fond semi-transparent -->
                            <h5 class="card-title">{{ $stock->nom }}</h5>
                            <p class="card-text"><strong>{{ $stock->prix }} DH</strong></p>
                            <p class="card-text">{{ $stock->description }}</p>
                            <a href="#reservation" class="btn btn-outline-light">Réserver Maintenant</a>
                            <!-- Bouton clair pour visibilité -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>



    <!-- Booking Section -->
    <!-- Booking Section -->
    <section id="reservation" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Prenez Votre Rendez-Vous en Ligne</h2>
            <p class="text-center text-muted mb-5">Réservez votre session de photographie facilement en remplissant le
                formulaire ci-dessous.</p>

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <!-- Formulaire de réservation -->
                            <form action="{{ route('reservationsclient') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nom</label>
                                        <input type="text" class="form-control" name="name" placeholder="Votre nom"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Numéro de Téléphone</label>
                                        <input type="tel" class="form-control" name="phone" placeholder="0612345678"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="exemple@email.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="datetime-local" class="form-control" name="date" id="date" required>
                                    </div>
                                </div>
                                <input type="hidden" name="code" value="">
                                <script>
    document.addEventListener("DOMContentLoaded", function() {
        const dateInput = document.querySelector("input[name='date']");

        // Récupérer l'heure actuelle et formater avec les minutes à 00
        const currentDate = new Date();
        currentDate.setMinutes(0); // Fixer les minutes à 00
        currentDate.setSeconds(0); // Fixer les secondes à 00
        currentDate.setMilliseconds(0); // Fixer les millisecondes à 00

        // Formater la date au format 'YYYY-MM-DDTHH:00'
        const formattedDate = currentDate.toISOString().slice(0, 16);

        // Définir la valeur du champ datetime-local avec l'heure actuelle
        dateInput.value = formattedDate;

        // Ajouter un événement pour forcer l'heure à chaque modification
        dateInput.addEventListener("input", function() {
            const selectedDate = new Date(dateInput.value);
            selectedDate.setMinutes(0);
            selectedDate.setSeconds(0);
            selectedDate.setMilliseconds(0);
            dateInput.value = selectedDate.toISOString().slice(0, 16); // Mettre à jour avec les minutes et secondes à 00
        });
    });
</script>

                                <script>
                                function generateCode() {
                                    let code = '';

                                    // Liste des types de caractères à générer : chiffre, lettre minuscule, lettre majuscule
                                    for (let i = 0; i < 10; i++) {
                                        let randomType = Math.floor(Math.random() * 3) + 1; // Choisit entre 1, 2 ou 3

                                        if (randomType === 1) {
                                            // Génère un chiffre aléatoire entre 0 et 9
                                            code += Math.floor(Math.random() * 10).toString();
                                        } else if (randomType === 2) {
                                            // Génère une lettre minuscule aléatoire
                                            code += String.fromCharCode(Math.floor(Math.random() * 26) +
                                                97); // 97 est le code ASCII de 'a'
                                        } else if (randomType === 3) {
                                            // Génère une lettre majuscule aléatoire
                                            code += String.fromCharCode(Math.floor(Math.random() * 26) +
                                                65); // 65 est le code ASCII de 'A'
                                        }
                                    }

                                    return code;
                                }

                                // Exemple d'utilisation
                                document.querySelector('input[name="code"]').value = generateCode();
                                </script>

                                <!-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="code" class="form-label">Code de Réservation</label>
                                    <input type="text" class="form-control" name="code" placeholder="P012X4P" required>
                                </div>
                            </div> -->
                                <button type="submit" class="btn btn-dark w-100">Soumettre</button>
                            </form>


                            <form action="{{ route('reservation.delete') }}" method="POST" class="mt-4">
                                @csrf
                                @method('DELETE')
                                <p class="text-center text-muted">Supprimez votre réservation si vous n'avez pas de
                                    compte.</p>
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-3">
                                        <label for="code" class="form-label">Code de Réservation</label>
                                        <input type="text" class="form-control" name="code" placeholder="P012X4P"
                                            required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark w-100">Supprimer</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <!-- Footer Section -->
    @include('footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form[action='{{ route('reservationsclient') }}']");
        const dateInput = form.querySelector("input[name='date']");

        form.addEventListener("submit", function(event) {
            event.preventDefault(); // Empêcher l'envoi immédiat du formulaire

            const selectedDate = new Date(dateInput.value); // Créer un objet Date à partir de la date choisie
            const currentDate = new Date();

            // Vérifier si la date est dans le passé
            if (selectedDate < currentDate) {
                Swal.fire({
                    icon: "error",
                    title: "Date invalide",
                    text: "Veuillez choisir une date future pour votre réservation."
                });
                return; // Ne pas envoyer le formulaire si la date est invalide
            }

            // Vérifier si la réservation existe déjà en appelant l'API
            const formattedDate = selectedDate.toISOString().slice(0, 19).replace("T", " "); // Format 'YYYY-MM-DD HH:MM:SS'

            fetch(`/reservations/existantes?date=${encodeURIComponent(formattedDate)}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Données de la réponse de l'API : ", data); // Ajouter un log pour vérifier les données reçues

                    if (data.exists) {
                        // Si une réservation existe déjà
                        Swal.fire({
                            icon: "error",
                            title: "Réservation déjà existante",
                            text: data.message // Afficher le message d'erreur renvoyé par le contrôleur
                        });
                        return; // Ne pas envoyer le formulaire si la réservation existe déjà
                    }

                    // Vérifier si la réservation tombe un week-end
                    const dayOfWeek = selectedDate.getDay();
                    if (dayOfWeek === 6 || dayOfWeek === 0) { // 0 = dimanche, 6 = samedi
                        Swal.fire({
                            icon: "error",
                            title: "Week-end non disponible",
                            text: "Les réservations ne sont pas possibles le week-end. Veuillez choisir un jour de semaine."
                        });
                        return; // Ne pas envoyer le formulaire si c'est un week-end
                    }

                    // Si tout est valide, soumettre le formulaire
                    Swal.fire({
                        icon: "success",
                        title: "Réservation confirmée",
                        text: "Votre réservation a été prise en compte avec succès."
                    }).then(() => {
                        form.submit(); // Soumettre le formulaire après la confirmation
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: "error",
                        title: "Erreur",
                        text: "Une erreur s'est produite lors de la vérification de la réservation."
                    });
                    console.error("Erreur lors de la vérification de la réservation", error);
                });
        });
    });
</script>






</body>

</html>