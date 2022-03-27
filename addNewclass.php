<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="with=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>GEE - Consultants - Add class</title>
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
    <a class="navbar-brand" href="#">Logo</a>
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
        <a href="#" id="zhBtn">简体中文</a> <a href="#" id="enBtn">English</a>
        <form class="form-check-inline my-2 my-lg-0">
            <?php
            if(isset($_SESSION['fullname'])){
                echo "<div class='dropdown'>";
                echo "<button type='button' class='btn btn-outline-primary dropdown-toggle my-2 my-lg-2' data-toggle='dropdown'>".$_SESSION['fullname']."</button>";
                echo "<div class='dropdown-menu'>";
                echo "<a class='dropdown-item' href='useredit.php'>Settings</a>";
                echo "<a class='dropdown-item' href='logout.php'>Logout</a>";
                echo "</div>";
                echo "</div>";
                echo "<a href='logout.php' class='btn btn-danger my-2 my-sm-0'>logout</a>";
            }
            ?>
        </form>
    </div>
</nav>
<?php
if(!isset($_SESSION['login'])){
    echo "<div class='alert alert-danger'><strong>You should <a href='Login.html'>login first!</a> </strong></div>";
    echo "<script>alert('login first！')</script>";
    echo "<meta http-equiv='refresh' content='0.5;url=/index.php'>";
}
?>
<header>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="addCAction.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="input-group mb-3">
                            <input class="form-control" name="classname" maxlength="25" type="text" placeholder="servicename" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="classdes">service description:</label>
                            <p>&nbsp;</p>
                            <textarea class="form-control" rows="5" id="classdes" name="classdes" maxlength="255"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                                <input class="form-control" name="classprice" type="text" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,2})?).*$/g, '$1')" placeholder="service price" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="startdate">Start date:</label>
                            <p>&nbsp;</p>
                            <input class="form-control" id="startdate" name="startdate" type="date" placeholder="2022-03-23" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="enddate">Start date:</label>
                            <p>&nbsp;</p>
                            <input class="form-control" id="enddate" name="enddate" type="date" placeholder="2022-03-23" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="input-group mb-3">
                            <input class="form-control" name="available" type="number" placeholder="enter available seats here" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="input-group mb-3">
                            <input class="form-control" name="classtype" type="text" placeholder="Enter service type here" maxlength="15" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="industry">service industry:</label>
                            <p>&nbsp;</p>
                            <textarea class="form-control" rows="5" id="industry" name="industry" maxlength="255"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <label for="industry">service comment:</label>
                            <p>&nbsp;</p>
                            <textarea class="form-control" rows="5" id="comment" name="comment" maxlength="255"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="add_class">Add service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">Copyright 2022 Global Episteme Exousia.</p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>