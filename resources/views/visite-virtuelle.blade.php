<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Casa de Selfie - Services de photographie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/105/three.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        display: none;
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
        border: 2px solid #ddd;
        border-radius: 8px;
    }

    #fileInput {
        display: none;
    }

    /* Style amélioré pour le modal de paiement */
    #paypal_div {
        max-width: 700px;
        width: 95%;
        padding: 30px;
        background-color: #f8f9fa;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .payment-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .payment-description {
        margin: 10px 0;
        line-height: 1.5;
        color: #505050;
        font-size: 1.1rem;
    }

    .product-card {
        background-color: white;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .price-tag {
        display: inline-block;
        background-color: #28a745;
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: bold;
        margin: 10px 0;
        font-size: 1.2rem;
    }

    .benefits-list {
        margin: 15px 0;
        padding-left: 20px;
        font-size: 1.05rem;
    }

    .benefits-list li {
        margin-bottom: 8px;
    }

    /* Lock icon overlay sur l'image */
    .image-container-locked {
        position: relative;
        margin-bottom: 15px;
    }

    .lock-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }

    /* Responsive */
    @media (max-width: 767px) {
        #paypal_div {
            width: 95%;
            padding: 20px;
        }

        .payment-header h3 {
            font-size: 1.3rem;
        }

        .product-card {
            margin-bottom: 15px;
        }
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('navbar')

    <header class="bg-dark text-white text-center py-5"
        style="background-image: url(assets_casa_de_selfie/360_F_512933916_Wzr2Jw0EQYuWDDOJI9mT5buG7LEGpAeM.jpg);background-repeat: no-repeat; background-position: right;height: 360px; background-size: cover;">
        <div class="container" style="margin: auto; padding: auto; margin-top: 100px;">
            <h1>LA CASA DE SELFIE</h1>
            <p>Visite Virtuelle du studio</p>
        </div>
    </header>

    <!-- Studio Description Section -->
    <section>
        <div class="card mb-3 mt-4 mx-2">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="studio.jpg" class="img-fluid rounded-start" alt="Studio Image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title">Studio de prise de photo à distance</h4>
                        <h6 class="card-text"><small class="text-body-secondary">Qui Sommes Nous ?</small></h6>
                        <p class="card-text">
                            Body text for your whole article or post. We'll put in some lorem ipsum to show how a
                            filled-out
                            page might look:
                        </p>
                        <p class="card-text">
                            Excepteur efficient emerging, minim veniam anim aute carefully curated Ginza conversation
                            exquisite perfect nostrud nisi intricate Content. Qui international first-class nulla ut.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 360° Image Section -->
    <div class="main-container">
        <iframe src="{{ asset('360 Image/index.html') }}" style="width: 100%; height: 100%;"></iframe>
    </div>

    <!-- PayPal Payment Section - Agrandi et avec scrollview -->
    <div id="paypal_div"
        style="display: none; z-index: 999; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 700px; max-width: 95vw; max-height: 85vh; overflow-y: auto;">
        <button onclick="hidePaypalDiv()"
            style="position: sticky; top: 10px; right: 10px; background: transparent; border: none; font-size: 1.5rem; cursor: pointer; float: right;">&times;</button>

        <div class="row">
            <!-- Première colonne: information produit et prix -->
            <div class="col-md-6 pe-md-2">
                <!-- En-tête amélioré -->
                <div class="payment-header">
                    <h3>Téléchargez votre photo en qualité professionnelle</h3>
                    <p class="payment-description">Obtenez une version haute résolution de votre photo, optimisée pour
                        l'impression ou le partage sur les réseaux sociaux.</p>
                </div>

                <!-- Carte produit améliorée -->
                <div class="product-card">
                    <div class="image-container-locked">
                        <img src="{{ asset('360 Image/images/2.jpeg') }}" alt="Exemple de photo professionnelle"
                            style="width: 100%; height: auto; border-radius: 8px;">
                        <div class="lock-overlay">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>

                    <h4>Photo professionnelle en haute résolution</h4>
                    <p>Déverrouillez votre photo pour une utilisation sans restriction.</p>

                    <div class="text-center">
                        <div class="price-tag">Prix: {{ env('PAYPAL_AMOUNT') }} € seulement</div>
                    </div>
                </div>
            </div>

            <!-- Deuxième colonne: avantages et bouton PayPal -->
            <div class="col-md-6 ps-md-2">
                <div class="product-card">
                    <h5>Ce que vous obtenez:</h5>
                    <ul class="benefits-list">
                        <li>Format haute résolution prêt à imprimer</li>
                        <li>Accès permanent à votre photo</li>
                        <li>Téléchargements illimités</li>
                        <li>Sans filigrane ni restriction</li>
                        <li>Support client premium</li>
                        <li>Satisfaction garantie</li>
                    </ul>
                </div>

                <!-- Conteneur PayPal -->
                <div id="paypal-button-container" class="mt-3"></div>
            </div>
        </div>
    </div>

    <!-- Photo Submission Form - Modifié -->
    <section>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form class="bg-light p-4 rounded" action="{{ route('save.payment') }}" method="POST">
                        @csrf
                        <h4 class="text-center mb-4">Soumettez votre photo</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fname" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Nom"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="lname" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Prénom"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="exple@email.com" required>
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="adress" name="adress" placeholder="Adresse"
                                    required>
                            </div>
                            <input type="hidden" id="mode_paiement" name="mode_paiement" value="">
<input type="hidden" id="montant" name="montant" value="">
                            <div class="col-md-12 mt-3">
                                <label for="capturedPhoto" class="form-label">Votre Photo</label>
                                <div class="image-container-locked" id="photoContainer">
                                    <img id="capturedPhoto" class="img-fluid" />
                                    <div class="lock-overlay" id="photoLockOverlay" style="display: none;">
                                        <i class="fas fa-lock fa-3x"></i>
                                    </div>
                                </div>
                                <input type="hidden" id="img" name="img">
                                <div id="photoStatus" class="alert alert-warning mt-2" style="display: none;">
                                    <i class="fas fa-info-circle me-2"></i>Pour télécharger cette photo en haute
                                    qualité, veuillez compléter le paiement.
                                    <button type="button" class="btn btn-sm btn-warning ms-2"
                                        onclick="showPaypalDiv()">Payer maintenant</button>
                                </div>
                            </div>
                        </div>

                        <!-- Options initiales -->
                        <div class="text-center mb-3" id="initialOptions">
                            <button type="button" id="chooseCamera" class="btn btn-primary">
                                <i class="fas fa-camera me-2"></i>Prendre une photo
                            </button>
                            <button type="button" id="chooseUpload" class="btn btn-secondary">
                                <i class="fas fa-upload me-2"></i>Télécharger une image
                            </button>
                        </div>

                        <!-- Options après capture -->
                        <div class="text-center mb-3" id="options" style="display:none;">
                            <button type="button" id="openCameraBtn" class="btn btn-primary" style="display:none;">
                                <i class="fas fa-camera me-1"></i>Ouvrir la caméra
                            </button>
                            <button type="button" id="captureBtn" class="btn btn-success" style="display:none;">
                                <i class="fas fa-camera-retro me-1"></i>Capturer la photo
                            </button>
                            <button type="button" id="downloadBtn" class="btn btn-info" disabled>
                                <i class="fas fa-download me-1"></i>Télécharger en haute qualité
                            </button>
                        </div>

                        <!-- Prévisualisation caméra -->
                        <div class="text-center mt-3" id="prev">
                            <video id="cameraPreview" autoplay></video>
                            <canvas id="photoCanvas"></canvas>
                            <input type="file" id="fileInput" accept="image/*">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <br>
    <!-- Footer -->
    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script
        src="https://www.sandbox.paypal.com/sdk/js?client-id=AasbLPWkh0JvC7XKJBIGn1a1CBLkbOOx8Uf0e0BIO1p1gZmIENBeOEn9wshTYV_QH7LFHr7P1FpNtg-B">
    </script>
    <script>
    // Variables globales
    let userChoice = null;
    let photoUploaded = false;
    let cameraPrev = false;
    const photoContainer = document.getElementById("photoContainer");
    const photoLockOverlay = document.getElementById("photoLockOverlay");
    const photoStatus = document.getElementById("photoStatus");
    const video = document.getElementById("cameraPreview");
    const canvas = document.getElementById("photoCanvas");
    const capturedPhoto = document.getElementById("capturedPhoto");
    const photoDataInput = document.getElementById("img");
    const downloadBtn = document.getElementById("downloadBtn");
    const fileInput = document.getElementById("fileInput");
    const initialOptions = document.getElementById("initialOptions");
    const options = document.getElementById("options");
    const captureBtn = document.getElementById("captureBtn");
    const openCameraBtn = document.getElementById("openCameraBtn");
    const chooseUpload = document.getElementById("chooseUpload");
    let stream;

    // Afficher le modal PayPal
    function showPaypalDiv() {
        document.getElementById("paypal_div").style.display = "block";
    }

    // Masquer le modal PayPal
    function hidePaypalDiv() {
        document.getElementById("paypal_div").style.display = "none";

        // Si l'utilisateur a fait son choix, on affiche les bonnes options
        if (userChoice === "camera") {
            initialOptions.style.display = "none";
            options.style.display = "block";
            openCameraBtn.style.display = "inline-block";
            captureBtn.style.display = "inline-block";
        } else if (userChoice === "upload") {
            initialOptions.style.display = "none";
            options.style.display = "block";
            fileInput.click();
        }
    }

    // Gérer le choix de l'utilisateur - Caméra
    document.getElementById("chooseCamera").addEventListener("click", () => {
        var email = document.getElementById("email").value;
        var fname = document.getElementById("fname").value;
        var lname = document.getElementById("lname").value;
        var adress = document.getElementById("adress").value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Invalid Email"
            });
            return;
        }
        if(email == "" || fname == "" || lname == "" || adress == "" ){
                Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "All fields Should be filled"
        });
            return;
        }

        userChoice = "camera";
        initialOptions.style.display = "none";
        options.style.display = "block";
        openCameraBtn.style.display = "inline-block";
        captureBtn.style.display = "inline-block";
    });

    // Gérer le choix de l'utilisateur - Upload
    document.getElementById("chooseUpload").addEventListener("click", () => {

        var email = document.getElementById("email").value;
        var fname = document.getElementById("fname").value;
        var lname = document.getElementById("lname").value;
        var adress = document.getElementById("adress").value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Invalid Email"
            });
            return;
        }
        if(email == "" || fname == "" || lname == "" || adress == ""){
                Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "All fields Should be filled"
        });
            return;
        }

        userChoice = "upload";
        initialOptions.style.display = "none";
        options.style.display = "block";
        fileInput.click();
    });

    // Intégration PayPal
    paypal.Buttons({
    createOrder: (data, actions) =>
        actions.order.create({
            purchase_units: [{
                amount: {
                    value: "{{ env('PAYPAL_AMOUNT') }}",  // Vous pouvez le changer dynamiquement
                },
            }, ],
        }),
    onApprove: (data, actions) =>
        actions.order.capture().then((details) => {
            alert(`Transaction completed by ${details.payer.name.given_name}`);

            // Changer le mode de paiement et le montant dans le formulaire
            document.getElementById("mode_paiement").value = "en ligne"; // Mettre "paypal"
            document.getElementById("montant").value = "{{ env('PAYPAL_AMOUNT') }}"; // Mettre le montant payé

            // Soumettre le formulaire pour l'enregistrement en base de données
            document.querySelector('form').submit();
        }),
    onError: (err) => console.error("Transaction error:", err),
    
}).render("#paypal-button-container");


    // Gérer la caméra
    document.getElementById("openCameraBtn").addEventListener("click", () => {

        var email = document.getElementById("email").value;
        var fname = document.getElementById("fname").value;
        var lname = document.getElementById("lname").value;
        var adress = document.getElementById("adress").value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Invalid Email"
            });
            return;
        }
        if(email == "" || fname == "" || lname == "" || adress == "" ){
                Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "All fields Should be filled"
        });
            return;
        }



        cameraPrev = true;
        document.getElementById("cameraPreview").style.display = "block";
        navigator.mediaDevices.getUserMedia({
                video: true,
            })
            .then((s) => {
                stream = s;
                video.srcObject = stream;
            })
            .catch((error) => {
                console.error("Error accessing the camera: ", error);
            });
    });

    // Capture d'une photo avec la caméra
    captureBtn.addEventListener("click", () => {

        var email = document.getElementById("email").value;
        var fname = document.getElementById("fname").value;
        var lname = document.getElementById("lname").value;
        var adress = document.getElementById("adress").value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Invalid Email"
            });
            return;
        }
        if(email == "" || fname == "" || lname == "" || adress == "" || !cameraPrev){
                Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "All fields Should be filled and Camera should be opened"
        });
            return;
        }

        const context = canvas.getContext("2d");
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const photoDataUrl = canvas.toDataURL("image/png");

        capturedPhoto.src = photoDataUrl;
        capturedPhoto.style.display = "block";
        photoDataInput.value = photoDataUrl;

        // Afficher l'overlay de verrouillage et le message d'état
        photoUploaded = true;
        photoLockOverlay.style.display = "block";
        photoStatus.style.display = "block";

        

        // Fermer la caméra
        if (stream) {
            const tracks = stream.getTracks();
            tracks.forEach((track) => track.stop());
            video.srcObject = null;
            video.style.display = "none";
        }

        // Proposer le paiement
        showPaypalDiv();
    });

    // Téléchargement de la photo (activé seulement après paiement)
    downloadBtn.addEventListener("click", () => {
        if (capturedPhoto.src) {
            const link = document.createElement("a");
            link.href = capturedPhoto.src;
            link.download = "photo-professionnelle.png";
            link.click();
        }
    });

    // Gestion de l'upload de fichier
    fileInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                capturedPhoto.src = e.target.result;
                capturedPhoto.style.display = "block";
                photoDataInput.value = e.target.result;

                // Afficher l'overlay de verrouillage et le message d'état
                photoUploaded = true;
                photoLockOverlay.style.display = "block";
                photoStatus.style.display = "block";

                // Proposer le paiement
                showPaypalDiv();
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>

</html>