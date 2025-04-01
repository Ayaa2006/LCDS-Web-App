<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Casa de Selfie - Blogue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
    }

    header {
        background-image: url('assets_casa_de_selfie/360_F_512933916_Wzr2Jw0EQYuWDDOJI9mT5buG7LEGpAeM.jpg');
        background-size: cover;
        height: 360px;
        color: white;
        text-align: center;
        padding: 100px 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .card {
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        position: relative;
        background-color: white;
        height: 750px;
        /* Augmenter la hauteur des cartes */
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .card img {
        height: 250px;
        /* Augmenter la taille des images */
        object-fit: cover;
        width: 100%;
    }

    .card-body {
        padding: 20px;
        height: 140px;
        /* Augmenter la taille de la zone de contenu */
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 0.9rem;
        color: #6c757d;
        height: 60px;
        /* Ajuster la hauteur du texte */
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .btn-read-more {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80%;
        padding: 10px;
        text-align: center;
        background-color: rgb(0, 0, 0);
        color: white;
        border-radius: 30px;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .btn-read-more:hover {
        background-color: rgb(54, 54, 54);
    }

    footer {
        background-color: #343a40;
        color: white;
        padding: 20px 0;
    }

    footer a {
        color: white;
        transition: color 0.3s ease;
    }

    footer a:hover {
        color: #ffc107;
    }
    </style>
</head>

<body>
    @include('navbar')

    <header class="bg-dark text-white text-center py-5"
        style="background-image: url(assets_casa_de_selfie/360_F_512933916_Wzr2Jw0EQYuWDDOJI9mT5buG7LEGpAeM.jpg);background-repeat: no-repeat; background-position: right;height: 360px; background-size: cover;">
        <div class="container" style="margin: auto; padding: auto; margin-top: 100px;">
            <h1>LA CASA DE SELFIE</h1>
            <p>Blogue</p>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <p class="text-center text-muted mb-5">Découvrez nos derniers articles</p>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($blogs as $blog)
                <div class="col mb-4">
                    <div class="card">
                        <img src="{{ $blog->img ? asset('storage/' . $blog->img) : 'https://via.placeholder.com/200' }}"
                            class="card-img-top" alt="{{ $blog->titre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->titre }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($blog->description, 100) }}</p>
                        </div>
                        <br><br><br>
                        <a href="#" class="btn-read-more" data-bs-toggle="modal"
                            data-bs-target="#blogModal{{ $blog->id }}">Lire plus</a>
                    </div>
                </div>

                <div class="modal fade" id="blogModal{{ $blog->id }}" tabindex="-1"
                    aria-labelledby="blogModalLabel{{ $blog->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="blogModalLabel{{ $blog->id }}">{{ $blog->titre }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ $blog->img ? asset('storage/' . $blog->img) : 'https://via.placeholder.com/200' }}"
                                    class="img-fluid mb-3" alt="{{ $blog->titre }}">
                                <p>{{ $blog->description }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>