<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="with=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>GEE - Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="js/translator.js"></script>
    <script>
        // Disable form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src="assets/GEE%20Logo.png" alt="Logo" style="width:40px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"> <a class="nav-link" href="index.php">Home <span class="sr-only">(Current)</span></a> </li>
            <li class="nav-item"><a class="nav-link" href="show_consultant.php">Consultants</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false"> Menu </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">aaa</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">bbb</a>
                </div>
            </li>
        </ul>
        <a href="#" id="zhBtn">????????????</a> <a href="#" id="enBtn">English</a>
        <form class="form-check-inline my-2 my-lg-0">
            <a href="Register.html" class="btn btn-outline-primary my-2 my-lg-0">Sign up</a>
            <a href="Login.html" class="btn btn-outline-success my-2 my-sm-0">Login</a>
        </form>
    </div>
</nav>
<?php
if(isset($_SESSION['login'])&&!$_SESSION['login']){
    echo "<div class='alert alert-danger'><strong>You should <a href='Login.html'>login first!</a> </strong></div>";
}else{
    session_unset();
    session_destroy();
    echo "<div class='alert alert-success'><strong>log out success. back to <a href='index.php'>homepage</a></strong></div>";
}
?>
<footer>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">Copyright 2022 Global Episteme Exousia.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</body>
