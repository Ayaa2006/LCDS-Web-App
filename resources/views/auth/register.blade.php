<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>GDF - Register</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

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
    <div class="card o-hidden border-0 shadow-lg my-5" id="cardss">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image center">
           <!-- <img src="{{ asset('image-removebg-preview.png') }}" id="bg-login-image" width="350" height="350">
--> </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 mb-4" style="color: white">Créez un compte !</h1>
              </div>
              <form action="{{ route('register.save') }}" method="POST" class="user">
                @csrf
                <div class="form-group">
                  <input name="name" type="text" class="form-control form-control-user @error('name')is-invalid @enderror" id="exampleInputName" placeholder="Nom">
                  @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <input name="email" type="email" class="form-control form-control-user @error('email')is-invalid @enderror" id="exampleInputEmail" placeholder="Adresse email">
                  @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name="password" type="password" class="form-control form-control-user @error('password')is-invalid @enderror" id="exampleInputPassword" placeholder="Mot de passe">
                    @error('password')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <input name="password_confirmation" type="password" class="form-control form-control-user @error('password_confirmation')is-invalid @enderror" id="exampleRepeatPassword" placeholder="Répéter le mot de passe">
                    @error('password_confirmation')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-user btn-block">Créer un compte</button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small light-blue-link" href="{{ route('login') }}">Vous avez déjà un compte ? Connectez-vous !</a>
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