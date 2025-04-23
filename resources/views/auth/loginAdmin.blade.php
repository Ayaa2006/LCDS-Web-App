<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>LCDS - Login</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

{{-- */style CSS --}}
<style>
#bg-login-image {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  width: 250px; /* Taille réduite du logo */
  height: 250px; /* Taille réduite du logo */
}

.center {
  display: flex;
  justify-content: center;
  align-items: center;
}

#bg {
  background-image: url("{{ asset('imglcds.jpg') }}");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

#cardss {
  background-color: rgba(255, 255, 255, 0);
  border: none !important;
}

/* Ajout d'une marge en haut pour déplacer le contenu vers le bas */
.container {
  margin-top: 100px; /* Ajustez cette valeur selon vos besoins */
}
.light-blue-link {
    color: #000e38; /* Couleur bleue claire */
    text-decoration: none; /* Optionnel : pour enlever le soulignement */
  }

  .light-blue-link:hover {
    color: #000e38; /* Couleur bleue légèrement plus foncée au survol */
    text-decoration: underline; /* Optionnel : ajouter un soulignement au survol */
  }
</style>

<body id="bg">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5" id="cardss">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
             
              <div class="col-lg-6 d-none d-lg-block bg-login-image center">
               <!--  <img src="{{ asset('image-removebg-preview.png') }}" id="bg-login-image" width="350" height="350">
             --> </div> 
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 mb-4" style="color: white">Bienvenue !</h1>
                  </div>
                  <form action="{{ route('login.admin') }}" method="POST" class="user">
                    @csrf
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                    <div class="form-group">
                      <input name="Adminemail" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Entrez l'adresse e-mail...">
                    </div>
                    <div class="form-group">
                      <input name="Adminpassword" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Mot de passe">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input name="remember" type="checkbox" class="custom-control-input" id="remember">
                        <label class="custom-control-label" for="remember" style="color: white">Souviens-toi de moi</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-user">Se connecter</button>
                  </form>
                  <hr>
                  <div class="text-center">
                  <a class="small light-blue-link" href="{{ route('login') }}">Se Connecter au tant qu'utilisateur</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
</body>
</html>