<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #1f2d3d; color: #fff;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex justify-content-center align-items-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('image-removebg-preview.png') }}" width="150" height="75" alt="Logo">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Section: Overview -->
    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <span>Accueil</span>
        </a>
    </li>

    <!-- Section: Content Management -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Gestion du Contenu</div>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('galeries.index') }}">
            <i class="fas fa-images"></i>
            <span>Galerie</span>
        </a>
    </li>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('blogs.index') }}">
            <i class="fas fa-blog"></i>
            <span>Blog</span>
        </a>
    </li>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('reservations.index') }}">
            <i class="fas fa-calendar-check"></i>
            <span>Réservations</span>
        </a>
    </li>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('photoget') }}">
            <i class="fas fa-camera"></i>
            <span>Photos</span>
        </a>
    </li>
    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('agenda-crm.index') }}">
        <i class="fas fa-address-book"></i>
            <span>Agenda CRM</span>
        </a>
    </li>
    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('prestations.index') }}">
        <i class="fas fa-handshake"></i>

            <span>Prestation</span>
        </a>
    </li>
    <!-- Section: Operations -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Opérations</div>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('livraisons.index') }}">
            <i class="fas fa-truck"></i>
            <span>Livraison</span>
        </a>
    </li>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('stock.index') }}">
            <i class="fas fa-truck"></i>
            <span>Stock</span>
        </a>
    </li>

    {{-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="stockDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-box"></i>
            <span>Stock</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="stockDropdown">
            <a class="dropdown-item" href="{{ route('stock.index') }}">Voir le Stock</a>
            <a class="dropdown-item" href="{{ route('stock.create') }}">Ajouter du Stock</a>
        </div>
    </li> --}}
    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('machines.create') }}">
        <i class="fas fa-industry"></i>
            <span>Machines</span>
        </a>
    </li>
    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('decors.index') }}">
        <i class="fas fa-theater-masks"></i>
            <span>Decors</span>
        </a>
    </li>
    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('ventes.index') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Ventes</span>
        </a>
    </li>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('utilisateurs.index') }}">
            <i class="fas fa-users"></i>
            <span>Utilisateurs</span>
        </a>
    </li>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('gamifications.index') }}">
            <i class="fas fa-gamepad"></i>
            <span>Gamification</span>
        </a>
    </li>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('tasks.index') }}">
            <i class="fas fa-tasks"></i>
            <span>Tasks</span>
        </a>
    </li>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('parrainages.index')}}">
            <i class="fas fa-share-alt"></i>
            <span>Parrainage</span>
        </a>
    </li>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="#">
            <i class="fas fa-history"></i>
            <span>Historique des Transactions</span>
        </a>
    </li>

    <!-- Section: Insights -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Analyse & Insights</div>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="#">
            <i class="fas fa-chart-line"></i>
            <span>Analyses</span>
        </a>
    </li>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="#">
            <i class="fas fa-bell"></i>
            <span>Notifications</span>
        </a>
    </li>

    <!-- Section: Support & Settings -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Support & Paramètres</div>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="#">
            <i class="fas fa-life-ring"></i>
            <span>Support</span>
        </a>
    </li>

    <li class="nav-item" id="hover-background">
        <a class="nav-link" href="{{ route('settings.indexss') }}">
            <i class="fas fa-cogs"></i>
            <span>Paramètres</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
</ul>

<!-- Style CSS -->
<style>
    .sidebar {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #1f2d3d;
        color: #fff;
        min-height: 100vh;
    }
    .nav-link {
        color: #d3d3d3;
        font-size: 16px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    .nav-link i {
        margin-right: 15px;
        font-size: 18px;
    }
    .nav-link:hover {
        background-color: #2c3e50;
        color: #fff;
        text-decoration: none;
    }
    .sidebar-heading {
        font-size: 14px;
        text-transform: uppercase;
        padding: 10px 20px;
        color: #b0b0b0;
        font-weight: bold;
    }
    .sidebar-divider {
        border-top: 1px solid #2c3e50;
    }
    .sidebar-brand-icon img {
        border-radius: 10px;
        transition: transform 0.3s ease;
    }
    .sidebar-brand-icon img:hover {
        transform: scale(1.05);
    }
    .dropdown-menu {
        background-color: #2c3e50;
        border: none;
    }
    .dropdown-item {
        color: #d3d3d3;
    }
    .dropdown-item:hover {
        background-color: #34495e;
    }
</style>
