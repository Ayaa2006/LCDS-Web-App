<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Casa de Selfie - Services de photographie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/105/three.min.js"
        integrity="sha512-uWKImujbh9CwNa8Eey5s8vlHDB4o1HhrVszkympkm5ciYTnUEQv3t4QHU02CUqPtdKTg62FsHo12x63q6u0wmg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/panolens.min.js"></script>
    <style>
        .btn-check:checked+.btn-outline-warning .fas.fa-star {
            color: white;
        }

        .main-container {
            display: flex;
            height: 100vh;
            align-items: center;
            background: #111;
        }

        .main-container .image-container {
            height: 100%;
            position: fixed;
            width: 100%;
        }

        #cameraPreview {
            width: 100%;
            max-width: 300px;
            height: auto;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        #photoCanvas {
            display: none;
        }

        #capturedPhoto {
            display: none;
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('lcds') }}">
                <img src="{{ asset('image-removebg-preview.png') }}" width="75" height="50">
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('gamif') }}">Gamification</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About us</a></li>

                    <li class="nav-item" style="padding-right: 5px;padding-left: 2px;"><a class="btn btn-light"
                            style="padding: 5px;" href="#">Sign in</a></li>
                    <li class="nav-item"><a class="btn btn-dark" style="padding: 5px;" href="#">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="bg-dark text-white text-center py-5"
        style="background-image: url(assets_casa_de_selfie/360_F_512933916_Wzr2Jw0EQYuWDDOJI9mT5buG7LEGpAeM.jpg);background-repeat: no-repeat; background-position: right;height: 360px; background-size: cover;">
        <div class="container">
            <h1>LA CASA DE SELFIE</h1>
            <p>Visite Virtuelle du studio</p>
        </div>
    </header>

    <!-- Simple Card Section -->
    <section>
        <div class="row-cols-1">
            <div class="col-sm-12">
                <div class="card mb-3 mt-4" style="max-width: 95%;margin-left : 2%;">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex">
                            <img src="assets_casa_de_selfie/4k-nature-ztbad1qj8vdjqe0p.jpg"
                                class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title">Studio de prise de photo à distance</h4>
                                <h6 class="card-text"><small class="text-body-secondary">Qui Sommes Nous ?</small></h6>
                                <br>
                                <p class="card-text">
                                    Body text for your whole article or post. We’ll put in some lorem ipsum to show how
                                    a filled-out
                                    page might look:
                                </p>
                                <p class="card-text">Excepteur efficient emerging, minim veniam anim aute carefully
                                    curated Ginza
                                    conversation exquisite perfect nostrud nisi
                                    intricate Content. Qui international first-class nulla ut. Punctual adipisicing,
                                    essential lovely
                                    queen tempor eiusmod
                                    irure. Exclusive izakaya charming Scandinavian impeccable aute quality of life soft
                                    power pariatur
                                    Melbourne occaecat
                                    discerning. Qui wardrobe aliquip, et Porter destination Toto remarquable officia
                                    Helsinki excepteur
                                    Basset hound. Zürich
                                    sleepy perfect consectetur.</p>
                                <p>
                                    Excepteur efficient emerging, minim veniam anim aute carefully
                                    curated Ginza
                                    conversation exquisite perfect nostrud nisi
                                    intricate Content. Qui international first-class nulla ut. Punctual adipisicing,
                                    essential lovely
                                    queen tempor eiusmod
                                    irure.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image 360° -->
    <div class="main-container">
        <iframe src="{{ asset('360 Image/index.html') }}" style="width: 100%;height: 100%;"></iframe>
    </div>

    <!-- Photo Capture Form -->
    <section>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form class="bg-light p-4 rounded" action="{{ route('photo') }}" method="POST">
                        @csrf
                        <h4 class="text-center mb-4">Soumettez votre photo</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="exple@email.com" required>
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Adresse" required>
                            </div>
                            <div class="col-md-12">
                                <label for="capturedPhoto" class="form-label">Photo Capturée</label>
                                <img id="capturedPhoto" />
                                <input type="hidden" id="img" name="img">
                            </div>
                        </div>
                        <div class="text-center mb-3">
                            <button type="button" id="openCameraBtn" class="btn btn-primary">Ouvrir la caméra</button>
                            <button type="button" id="captureBtn" class="btn btn-success">Capturer la photo</button>
                            <button type="button" id="downloadBtn" class="btn btn-info">Télécharger la photo</button>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-dark w-100">Soumettre</button>
                        </div>
                        <div class="text-center mt-3" id="prev">
                            <video id="cameraPreview" autoplay></video>
                            <canvas id="photoCanvas"></canvas>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light text-center py-4">
        <p>&copy; 2024 La Casa de Selfie. All rights reserved.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const openCameraBtn = document.getElementById('openCameraBtn');
            const captureBtn = document.getElementById('captureBtn');
            const downloadBtn = document.getElementById('downloadBtn');
            const cameraPreview = document.getElementById('cameraPreview');
            const photoCanvas = document.getElementById('photoCanvas');
            const capturedPhoto = document.getElementById('capturedPhoto');
            const imgInput = document.getElementById('img');

            let stream;

            openCameraBtn.addEventListener('click', async () => {
                try {
                    stream = await navigator.mediaDevices.getUserMedia({ video: true });
                    cameraPreview.srcObject = stream;
                } catch (err) {
                    console.error('Error accessing camera: ', err);
                }
            });

            captureBtn.addEventListener('click', () => {
                const context = photoCanvas.getContext('2d');
                photoCanvas.width = cameraPreview.videoWidth;
                photoCanvas.height = cameraPreview.videoHeight;
                context.drawImage(cameraPreview, 0, 0, photoCanvas.width, photoCanvas.height);
                capturedPhoto.src = photoCanvas.toDataURL('image/png');
                capturedPhoto.style.display = 'block';
                imgInput.value = capturedPhoto.src;
            });

            downloadBtn.addEventListener('click', () => {
                if (capturedPhoto.src) {
                    const link = document.createElement('a');
                    link.href = capturedPhoto.src;
                    link.download = 'photo.png';
                    link.click();
                } else {
                    alert('Aucune photo capturée pour le téléchargement.');
                }
            });
        });
    </script>
</body>

</html>

