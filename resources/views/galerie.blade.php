<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Casa de Selfie - Galeries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
       
        .header-section {
            background-image: url(assets_casa_de_selfie/360_F_512933916_Wzr2Jw0EQYuWDDOJI9mT5buG7LEGpAeM.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 360px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .header-section h1 {
            font-size: 3rem;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
        }
        .header-section p {
            font-size: 1.5rem;
            margin-top: 10px;
        }

        /* Gallery cards styling */
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            position: relative;
            background-color: white;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .card img {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }
        footer a {
            color: white;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('navbar')

    <!-- Header Section -->
    <header class="bg-dark text-white text-center py-5" style="background-image: url(assets_casa_de_selfie/360_F_512933916_Wzr2Jw0EQYuWDDOJI9mT5buG7LEGpAeM.jpg);background-repeat: no-repeat; background-position: right;height: 360px; background-size: cover;">
        <div class="container" style="margin: auto; padding: auto; margin-top: 100px;">
            <h1>LA CASA DE SELFIE</h1>
            <p>Galerie</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <section class="py-5">
        <div class="container">
            <p class="text-center text-muted">Explorez Notre Galerie</p>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Gallery Content -->
                @foreach ($galeries as $galerie)
                    <div class="col">
                        <div class="card">
                            <img src="{{ asset('storage/' . $galerie->img) }}" class="card-img-top" alt="{{ $galerie->titre }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $galerie->titre }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($galerie->description, 100) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
