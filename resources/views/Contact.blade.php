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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Casa de Selfie - Contactez-nous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        header {
            background-image: url(assets_casa_de_selfie/your_background_image.jpg);
            background-size: cover;
            height: 360px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .contact-card {
            border: none;
            margin: 2% 0;
        }
        .contact-card img {
            height: 80%;
            margin: auto;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }
        .contact-form {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        .contact-form {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        margin-top: 30px;
    }
    
    /* Style personnalisé pour le bouton noir */
    .btn-custom-black {
        background-color: #000;
        border-color: #000;
        color: black;
        transition: all 0.3s ease;
    }
    
    .btn-custom-black:hover {
        background-color: #333;
        border-color: #333;
        color: white;
    }
    
    .btn-custom-black:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.25);
    }
    </style>
</head>

<body>
 @include('navbar')

    <!-- Header Section -->
 <header class="bg-dark text-white text-center py-5" style="background-image: url(assets_casa_de_selfie/360_F_512933916_Wzr2Jw0EQYuWDDOJI9mT5buG7LEGpAeM.jpg);background-repeat: no-repeat; background-position: right;height: 360px; background-size: cover;">
    <div class="container" style="margin: auto; padding: auto; margin-top: 100px;">
        <h1>LA CASA DE SELFIE</h1>
        <p>Contact</p>
    </div>
</header>

    <!-- Section Contact -->
    <section class="py-5">
        <div class="container">
            <div class="card contact-card mb-3">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">Prenez contact avec nous</h4>
                            <p class="card-text">Nous serions ravis de vous entendre ! Voici comment nous joindre :</p>
                            <table class="table">
                                <tr>
                                    <td style="width: 20%; text-align: center;">
                                        <i class="fas fa-phone fa-2x"></i>
                                    </td>
                                    <td>
                                        <b>Téléphone :</b>
                                        <a href="https://wa.me/212612345678" class="nav-link">+212612345678</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; text-align: center;">
                                        <i class="fas fa-envelope fa-2x"></i>
                                    </td>
                                    <td>
                                        <b>Email :</b>
                                        <a href="mailto:scte_contact@email.com" class="nav-link">CasaDeSelfie@email.com</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; text-align: center;">
                                        <i class="fas fa-map-marker-alt fa-2x"></i>
                                    </td>
                                    <td>
                                        <b>Adresse :</b>
                                        <p>street, 47 Rue Aït Ba Amrane, Casablanca 20540</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <img src="assets_casa_de_selfie/image-removebg-preview.png" class="img-fluid rounded-start" alt="Logo">
                    </div>
                </div>
            </div>

            <!-- Formulaire de contact ajouté ici -->
            <!-- Formulaire de contact avec bouton noir -->
<div class="contact-form">
    <h3 class="text-center mb-4">Envoyez-nous un message</h3>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Prénom *</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="last_name" class="form-label">Nom *</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="object" class="form-label">objet *</label>
            <input type="text" class="form-control" id="object" name="object" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Votre message *</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-custom-black bg-black text-white btn-lg">
                <i class="fas fa-paper-plane me-2"></i> Envoyer
            </button>
        </div>
    </form>
</div>


        </div>
    </section>

    <!-- Google Maps -->
    <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.4137721634456!2d-7.598086976000276!3d33.5945670733329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7cde9249fac31%3A0x11ce1ef2d51d3233!2sIbtikarCom!5e0!3m2!1sar!2sma!4v1723203258418!5m2!1sar!2sma" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <!-- Section Footer -->
    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>