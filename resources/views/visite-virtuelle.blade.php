<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    /* Styles pour la sélection de fond */
    .bg-option {
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }

    .bg-option:hover {
        transform: scale(1.05);
        border-color: #0d6efd;
    }

    .bg-option.selected {
        border-color: #0d6efd;
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
    }

    #backgroundOptionsContainer {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
    }

    #processedPhoto {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        background-size: cover;
    }

    /* Section de confirmation */
    #confirmationSection {
        display: none;
    }

    #confirmationSection p {
        margin-bottom: 0.5rem;
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
    #displayPhoto {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    #displayPhoto:hover {
        transform: scale(1.02);
    }
 
/* Loading screen styles */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    color: white;
}

.loading-spinner {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
    margin-bottom: 15px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('navbar')
<!-- Loading Overlay -->
<div id="loadingOverlay" class="loading-overlay" style="display: none;">
    <div class="loading-spinner"></div>
    <p>Traitement de votre image en cours...</p>
</div>
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
                        <img id="finalPhotoPreview" src="{{ asset('360 Image/images/2.jpeg') }}" alt="Exemple de photo professionnelle"
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
                    <!-- Ajout d'une div pour afficher les résultats après paiement -->
                    <div id="paymentSuccessSection" class="bg-light p-4 rounded mb-4" style="display: none;">
                        <h4 class="text-center mb-4">Votre photo est prête !</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Nom :</strong> <span id="displayFname"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Prénom :</strong> <span id="displayLname"></span></p>
                            </div>
                        
                            <div class="col-md-12">
                                <p><strong>Email :</strong> <span id="displayEmail"></span></p>
                            </div>
                            <div class="col-md-12">
                                <p><strong>Adresse :</strong> <span id="displayAdress"></span></p>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-6 text-center">
                                <img id="displayPhoto" src="" class="img-fluid rounded" style="max-height: 300px; border: 2px solid #ddd;">
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button id="finalDownloadBtn" class="btn btn-success">
                                <i class="fas fa-download me-1"></i>Télécharger ma photo
                            </button>
                        </div>
                    </div>
                    <!-- Formulaire principal -->
                    <form id="photoForm" class="bg-light p-4 rounded" action="{{ route('save.payment') }}" method="POST">
                        @csrf
                        <h4 class="text-center mb-4">Soumettez votre photo</h4>
                        
                        <!-- Section des informations personnelles -->
                        <div id="personalInfoSection">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="fname" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Nom" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Prénom" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="exple@email.com" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="address" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" id="adress" name="adress" placeholder="Adresse" required>
                                </div>
                                <input type="hidden" id="mode_paiement" name="mode_paiement" value="">
                                <input type="hidden" id="montant" name="montant" value="">
                            </div>
                        </div>
<!-- Loading Overlay -->
<div id="loadingOverlay" class="loading-overlay" style="display: none;">
    <div class="loading-spinner"></div>
    <p>Traitement de votre image en cours...</p>
</div>
                        <!-- Section de la photo -->
                        <div class="col-md-12 mt-3">
                            <label for="capturedPhoto" class="form-label">Votre Photo</label>
                            <div class="image-container-locked" id="photoContainer">
                                <img id="capturedPhoto" class="img-fluid" />
                                <div class="lock-overlay" id="photoLockOverlay" style="display: none;">
                                    <i class="fas fa-lock fa-3x"></i>
                                </div>
                            </div>
                            
                            <!-- Conteneur pour les options de fond -->
                            <div id="backgroundOptionsContainer" class="mt-3" style="display: none;">
                                <h6>Choisissez un arrière-plan :</h6>
                                <div class="row" id="backgroundOptions">
                                    <!-- Les options seront ajoutées dynamiquement en JS -->
                                </div>
                            </div>
                            
                            <input type="hidden" id="img" name="img">
                            <div id="photoStatus" class="alert alert-warning mt-2" style="display: none;">
                                <i class="fas fa-info-circle me-2"></i>Pour télécharger cette photo en haute
                                qualité, veuillez compléter le paiement.
                                <button type="button" class="btn btn-sm btn-warning ms-2" onclick="showPaypalDiv()">Payer maintenant</button>
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
                            </button> <br><br>
                            <button type="button" id="payNowBtn" class="btn btn-primary" style="display:none;">
                                <i class="fas fa-credit-card me-1"></i>Payer maintenant
                            </button>
                        </div>

                        <!-- Prévisualisation caméra -->
                        <div class="text-center mt-3" id="prev">
                            <video id="cameraPreview" autoplay></video>
                            <canvas id="photoCanvas"></canvas>
                            <input type="file" id="fileInput" accept="image/*">
                        </div>
                    </form>

                    <!-- Section de confirmation après paiement -->
                    <div id="confirmationSection" class="bg-light p-4 rounded mt-4" style="display: none;">
                        <h4 class="text-center mb-4">Votre photo est prête !</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Nom :</strong> <span id="confirmationFname"></span></p>
                                <p><strong>Prénom :</strong> <span id="confirmationLname"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Email :</strong> <span id="confirmationEmail"></span></p>
                                <p><strong>Adresse :</strong> <span id="confirmationAdress"></span></p>
                            </div>
                            <label for="capturedPhoto" class="form-label">Votre Photo</label>
                            <div class="image-container-locked" id="photoContainer">
                                <img id="capturedPhoto" class="img-fluid" />
                                <div class="lock-overlay" id="photoLockOverlay" style="display: none;">
                                    <i class="fas fa-lock fa-3x"></i>
                                </div>
                            </div>
                            
                            <input type="hidden" id="img" name="img">
                        </div>
                        <div class="text-center">
                            <button type="button" id="finalDownloadBtn" class="btn btn-success">
                                <i class="fas fa-download me-1"></i>Télécharger votre photo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <!-- Footer -->
    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.sandbox.paypal.com/sdk/js?client-id=AasbLPWkh0JvC7XKJBIGn1a1CBLkbOOx8Uf0e0BIO1p1gZmIENBeOEn9wshTYV_QH7LFHr7P1FpNtg-B"></script>
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
    const backgroundOptionsContainer = document.getElementById("backgroundOptionsContainer");
    const payNowBtn = document.getElementById("payNowBtn");
    const backgrounds = [
    { id: 'bg7', name: 'Fond orange', image: '{{ asset("assets_casa_de_selfie/bg7.jpg") }}' },
    { id: 'white', name: 'Fond blanc', image: '{{ asset("assets_casa_de_selfie/white.jpg") }}' },
    { id: 'gris', name: 'Fond gris', image: '{{ asset("assets_casa_de_selfie/gris.jpg") }}' },
    { id: 'black', name: 'Fond noir', image: '{{ asset("assets_casa_de_selfie/black.jpg") }}' },
];
    let currentImageWithoutBg = null;

    // Afficher le modal PayPal
    function showPaypalDiv() {
        document.getElementById("paypal_div").style.display = "block";
        document.getElementById("finalPhotoPreview").src = capturedPhoto.src;
    }

    // Masquer le modal PayPal
    function hidePaypalDiv() {
        document.getElementById("paypal_div").style.display = "none";
    }

    // Fonction pour supprimer automatiquement le fond
    const autoRemoveBackground = async (imageUri) => {
    try {
        // Afficher le loading screen
        showLoadingOverlay();
        
        capturedPhoto.style.opacity = '0.5';
        
        const response = await fetch(imageUri);
        const blob = await response.blob();

        const formData = new FormData();
        formData.append('image_file', blob, 'image.jpg');
        formData.append('size', 'auto');

        const bgRemoveResponse = await fetch('https://api.remove.bg/v1.0/removebg', {
            method: 'POST',
            headers: {
                'X-Api-Key': 'nU5diUi4yggUn2UGkFTNbRYC',
            },
            body: formData,
        });

        if (!bgRemoveResponse.ok) {
            hideLoadingOverlay();
            throw new Error('Échec de la suppression du fond.');
        }

        const blobResponse = await bgRemoveResponse.blob();
        const reader = new FileReader();
        reader.onloadend = () => {
            currentImageWithoutBg = reader.result;
            capturedPhoto.src = reader.result;
            capturedPhoto.style.opacity = '1';
            photoDataInput.value = reader.result;
            
            // Afficher les options de fond
            showBackgroundOptions(reader.result);
            
            payNowBtn.style.display = "inline-block";
            
            // Masquer le loading screen
            hideLoadingOverlay();
            
            // Afficher un message de succès
            Swal.fire({
                icon: 'success',
                title: 'Fond supprimé avec succès!',
                text: 'Vous pouvez maintenant choisir un arrière-plan',
                timer: 2000
            });
        };
        reader.readAsDataURL(blobResponse);
    } catch (error) {
        console.error('Error:', error);
        capturedPhoto.src = imageUri;
        capturedPhoto.style.opacity = '1';
        photoDataInput.value = imageUri;
        currentImageWithoutBg = imageUri;
        showBackgroundOptions(imageUri);
        payNowBtn.style.display = "inline-block";
        
        // Masquer le loading screen
        hideLoadingOverlay();
        
        // Afficher un message d'erreur
        Swal.fire({
            icon: 'error',
            title: 'Erreur de traitement',
            text: "Nous n'avons pas pu supprimer automatiquement le fond. Vous pouvez toujours choisir un arrière-plan manuellement.",
            timer: 3000
        });
    }
};

// Fonctions pour gérer le loading screen
function showLoadingOverlay() {
    document.getElementById('loadingOverlay').style.display = 'flex';
    // Désactiver le contenu de la page
    document.querySelectorAll('button, input, select').forEach(element => {
        element.disabled = true;
    });
}

function hideLoadingOverlay() {
    document.getElementById('loadingOverlay').style.display = 'none';
    // Réactiver le contenu de la page
    document.querySelectorAll('button, input, select').forEach(element => {
        element.disabled = false;
    });
}

    // Afficher les options de fond sous l'image principale
    function showBackgroundOptions(imageWithoutBg) {
    backgroundOptionsContainer.style.display = 'block';
    const bgOptionsContainer = document.getElementById('backgroundOptions');
    bgOptionsContainer.innerHTML = '';
    
    backgrounds.forEach((bg, index) => {
        const bgElement = document.createElement('div');
        bgElement.className = 'col-3 mb-2';
        
        if (bg.id === 'none') {
            bgElement.innerHTML = `
                <button class="btn btn-outline-secondary w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-option" 
                        data-bg="none" style="height: 80px;">
                    <i class="fas fa-times mb-1"></i>
                    <small>Aucun</small>
                </button>
            `;
        } else {
            // Ajouter la classe 'selected' au premier élément (orange)
            const selectedClass = index === 0 ? 'selected' : '';
            bgElement.innerHTML = `
                <img src="${bg.image}" 
                     class="img-thumbnail bg-option ${selectedClass}" 
                     data-bg="${bg.id}"
                     style="cursor: pointer; height: 80px; object-fit: cover;"
                     title="${bg.name}">
            `;
        }
        
        bgOptionsContainer.appendChild(bgElement);
    });
    
    // Appliquer automatiquement le premier fond (orange)
    if (backgrounds.length > 0) {
        applyBackground(imageWithoutBg, backgrounds[0].id);
    }
    
    // Activer le clic sur les options de fond
    document.querySelectorAll('.bg-option').forEach(option => {
        option.addEventListener('click', () => {
            applyBackground(imageWithoutBg, option.dataset.bg);
        });
    });
}

    // Appliquer le fond sélectionné
    async function applyBackground(originalImage, bgId) {
    try {
        // Afficher le loading screen
        showLoadingOverlay();
        
        // Retirer la sélection précédente
        document.querySelectorAll('.bg-option').forEach(opt => {
            opt.classList.remove('selected');
        });
        
        // Ajouter la sélection à l'option cliquée
        const clickedOption = [...document.querySelectorAll('.bg-option')]
            .find(opt => opt.dataset.bg === bgId);
        if (clickedOption) {
            clickedOption.classList.add('selected');
        }
        
        if (bgId === 'none') {
            capturedPhoto.src = originalImage;
            photoDataInput.value = originalImage;
            hideLoadingOverlay();
            return;
        }
        
        const bg = backgrounds.find(b => b.id === bgId);
        if (!bg) {
            hideLoadingOverlay();
            return;
        }
        
        // Créer un canvas pour fusionner les images
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        
        // Charger l'image sans fond
        const fgImg = new Image();
        fgImg.src = originalImage;
        
        await new Promise(resolve => {
            fgImg.onload = resolve;
        });
        
        // Définir la taille du canvas
        canvas.width = fgImg.width;
        canvas.height = fgImg.height;
        
        // Si fond uni
        if (bgId === 'white' || bgId === 'black') {
            ctx.fillStyle = bgId === 'white' ? '#ffffff' : '#000000';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(fgImg, 0, 0);
        } 
        // Si fond image
        else {
            const bgImg = new Image();
            bgImg.src = bg.image;
            
            await new Promise(resolve => {
                bgImg.onload = resolve;
            });
            
            // Dessiner le fond redimensionné
            ctx.drawImage(bgImg, 0, 0, canvas.width, canvas.height);
            // Dessiner l'image sans fond par-dessus
            ctx.drawImage(fgImg, 0, 0);
        }
        
        // Mettre à jour l'image affichée
        capturedPhoto.src = canvas.toDataURL('image/png');
        photoDataInput.value = canvas.toDataURL('image/png');
        
        // Masquer le loading screen
        hideLoadingOverlay();
        
    } catch (error) {
        console.error("Erreur lors de l'application du fond:", error);
        // Masquer le loading screen en cas d'erreur
        hideLoadingOverlay();
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: "Une erreur est survenue lors de l'application du fond",
            timer: 2000
        });
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
        document.getElementById("openCameraBtn").style.display = "inline-block";
        document.getElementById("captureBtn").style.display = "inline-block";
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
        document.getElementById("fileInput").click();
    });

    // Intégration PayPal
    paypal.Buttons({
        createOrder: (data, actions) => {
            // Validation des champs avant paiement
            const email = document.getElementById("email").value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                Swal.fire({
                    icon: "error",
                    title: "Email invalide",
                    text: "Veuillez entrer une adresse email valide"
                });
                return false;
            }

            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: "{{ env('PAYPAL_AMOUNT') }}",
                    },
                }],
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then((details) => {
                // 1. Masquer le formulaire
                hidePaypalDiv();
                document.getElementById("photoForm").style.display = "none";
                
                // 2. Afficher la section de succès
                document.getElementById("paymentSuccessSection").style.display = "block";
                document.getElementById("displayPhoto").src = capturedPhoto.src;
                
                // 3. Remplir les informations dans la section de succès
                document.getElementById("displayFname").textContent = document.getElementById("fname").value;
                document.getElementById("displayLname").textContent = document.getElementById("lname").value;
                document.getElementById("displayEmail").textContent = document.getElementById("email").value;
                document.getElementById("displayAdress").textContent = document.getElementById("adress").value;
                
                // 4. Activer le bouton de téléchargement final
                document.getElementById("finalDownloadBtn").addEventListener("click", function() {
                    const link = document.createElement("a");
                    link.href = capturedPhoto.src;
                    link.download = "photo-professionnelle.png";
                    link.click();
                });

                // 5. Enregistrement en base de données (AJAX)
                const formData = new FormData();
                formData.append('fname', document.getElementById("fname").value);
                formData.append('lname', document.getElementById("lname").value);
                formData.append('email', document.getElementById("email").value);
                formData.append('adress', document.getElementById("adress").value);
                formData.append('img', capturedPhoto.src);
                formData.append('mode_paiement', 'en ligne');
                formData.append('montant', "{{ env('PAYPAL_AMOUNT') }}");
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                fetch("{{ route('save.payment') }}", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        console.error("Erreur lors de l'enregistrement:", data.message);
                    }
                })
                .catch(error => {
                    console.error("Erreur:", error);
                });
            });
        },
        onError: (err) => {
            console.error("Transaction error:", err);
            Swal.fire({
                icon: "error",
                title: "Erreur de paiement",
                text: "Une erreur est survenue lors du paiement. Veuillez réessayer."
            });
        },
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
    document.getElementById("captureBtn").addEventListener("click", () => {
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

        // Afficher la photo capturée
        capturedPhoto.src = photoDataUrl;
        capturedPhoto.style.display = "block";
        photoDataInput.value = photoDataUrl;
        
        // Appeler autoRemoveBackground automatiquement
        autoRemoveBackground(photoDataUrl);
        
        // Fermer la caméra
        if (stream) {
            const tracks = stream.getTracks();
            tracks.forEach((track) => track.stop());
            video.srcObject = null;
            video.style.display = "none";
        }
    });

    // Gestion de l'upload de fichier
    document.getElementById("fileInput").addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                capturedPhoto.src = e.target.result;
                capturedPhoto.style.display = "block";
                photoDataInput.value = e.target.result;
                
                // Appeler autoRemoveBackground automatiquement
                autoRemoveBackground(e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // Bouton pour payer directement
    payNowBtn.addEventListener("click", () => {
        // Afficher l'overlay de verrouillage et le message d'état
        photoUploaded = true;
        photoLockOverlay.style.display = "block";
        photoStatus.style.display = "block";
        
        // Proposer le paiement
        showPaypalDiv();
    });
    </script>
</body>
</html>