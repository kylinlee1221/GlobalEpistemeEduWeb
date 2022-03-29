<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="with=device-width, initial-scale=1">
    <title>GEE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="js/translator.js"></script>
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
                }else{
                    echo "<a href='Register.html' class='btn btn-outline-primary my-2 my-lg-0'>Sign up</a>";
                    echo "<a href='Login.html' class='btn btn-outline-success my-2 my-sm-0'>Login</a>";
                }
            ?>
        </form>
    </div>
</nav>
<header>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>&nbsp;</p>
                    <p class="text-center"><a href="Consultants.php"><img src="assets/Consultant.PNG" class="rounded" style="max-width:40%;"></a>  <a href="Client.php"><img src="assets/Clinet.PNG" class="rounded" style="max-width: 40%;"></a></p>
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
</header>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 id="aboutUs" class="text-center">About us</h2>
                <p class="text-center">Global Episteme Exousia aims to be an online platform that matches academic and industrial experts in the fields of cutting edge technologies such as artificial intelligence, aerospace and aeronautics, biomedicine and genetic engineering, with corporations, media institutions and students with educational needs for decision making. We hope to bridge the information gap between academia and industries across the Asia-pacific and make technological innovations more ethical and accountable. </p>
            </div>
        </div>
    </div>
</section>
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
</html>