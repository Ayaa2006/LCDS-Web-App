<!DOCTYPE html>
<html>
<head>
    <title>Registration Réussi</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <td class="align-middle">
                            <img src="https://i.imgur.com/cXk030R.png" width="200" height="200" alt="Logo">
                        </td>
                        <td class="align-middle">

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h1 class="display-4">Merci pour votre photo !</h1>
                            <p class="lead">Votre email : {{ $upload->email }} </p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional, for enhanced functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
