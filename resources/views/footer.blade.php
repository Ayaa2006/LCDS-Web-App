<!-- resources/views/footer.blade.php -->

<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Logo et réseaux sociaux -->
            <div class="col-md-4 text-center text-md-start">
                <div class="mb-4">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('image-removebg-preview.png') }}" alt="Logo" width="150" height="70">
                    </a>
                </div>
                <div class="d-flex justify-content-center justify-content-md-start gap-3">
                    <a href="https://facebook.com" class="text-white text-decoration-none">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="https://twitter.com" class="text-white text-decoration-none">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a href="https://instagram.com" class="text-white text-decoration-none">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="https://linkedin.com" class="text-white text-decoration-none">
                        <i class="fab fa-linkedin fa-lg"></i>
                    </a>
                    <a href="https://youtube.com" class="text-white text-decoration-none">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Liens rapides -->
            <div class="col-md-4 text-center text-md-start">
                <h5 class="mb-3">LA CASA DE SELFIE</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">Home</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">Services</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">Blog</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">Contact</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">About us</a>
                    </li>
                </ul>
            </div>

            <!-- Ressources -->
            <div class="col-md-4 text-center text-md-start">
                <h5 class="mb-3">Resources</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">Blog</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">Best practices</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">Colors</a>
                    </li>
                    <!-- Ajoutez d'autres liens si nécessaire -->
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-4 pt-3 border-top border-secondary">
            <p class="mb-0">
                &copy; {{ date('Y') }} La Casa de Selfie. Tous droits réservés.
            </p>
        </div>
    </div>
</footer>