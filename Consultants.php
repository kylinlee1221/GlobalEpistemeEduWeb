<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="with=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>GEE - Consultants</title>
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
    echo "<script>alert('login first???')</script>";
    echo "<meta http-equiv='refresh' content='0.1;url=/index.php'>";
}elseif (strcmp($_SESSION['role'],'consultants')!=0&&strcmp($_SESSION['role'],'Consultants')!=0){
    echo "<div class='alert alert-danger'><strong>You are not consultants</strong></div>";
    echo "<script>alert('You are not consultants')</script>";
    echo "<meta http-equiv='refresh' content='0.1;url=/Client.php'>";
}
?>
<header>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        if(isset($_SESSION['login'])){
                            if(isset($_SESSION['fullname'])){
                                echo "<h1 class='text-center'> Welcome back ".$_SESSION['fullname']."</h1>";
                            }
                            $con=mysqli_connect("127.0.0.1:33065","root","","gesql");
                            if(!$con){
                                echo "<script>alert('sql connect error')</script>";
                                die("error:".mysqli_connect_error());
                            }
                            $userid=$_SESSION['userid'];
                            $sql='select * from user where id='."'{$userid}';";
                            $res=mysqli_query($con,$sql);
                            if($res->num_rows>0) {
                                while ($row = $res->fetch_assoc()) {
                                    echo "<p class='text-center'>Your account amount is: ".$row['amount']."</p>";
                                }
                            }
                        }
                    ?>
                    <p class="text-center"><a href="addNewclass.php" class="btn btn-primary btn-lg">Add new service</a></p>
                </div>
            </div>
        </div>
    </div>
</header>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4 text-center">
                <h2>My service</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>price</th>
                            <th>start time</th>
                            <th>end time</th>
                            <th>available</th>
                            <th>type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_SESSION['login'])){
                                $con=mysqli_connect("127.0.0.1:33065","root","","gesql");
                                if(!$con){
                                    echo "<script>alert('sql connect error')</script>";
                                    die("error:".mysqli_connect_error());
                                }
                                $userid=$_SESSION['userid'];
                                $sql='select * from tutor_class where tutorid='."'{$userid}';";
                                $res=mysqli_query($con,$sql);
                                if($res->num_rows>0) {
                                    while ($row = $res->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>".$row['classname']."</td>";
                                        echo "<td>".$row['classprice']."</td>";
                                        echo "<td>".$row['starttime']."</td>";
                                        echo "<td>".$row['endtime']."</td>";
                                        echo "<td>".$row['available']."</td>";
                                        echo "<td>".$row['classtype']."</td>";
                                        echo "<td><a href='#' class='btn btn-primary'>View Details</a><a href='deleteCAction.php?serviceId=".$row['id']."' class='btn btn-danger'>Drop Service</a></td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
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