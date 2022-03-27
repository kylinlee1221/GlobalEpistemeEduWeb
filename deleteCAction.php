<?php
    session_start();
    $con=mysqli_connect("127.0.0.1:33065","root","","gesql");
    if(!$con){
        echo "<script>alert('sql connect error')</script>";
        die("error:".mysqli_connect_error());
    }
    $userid=$_SESSION['userid'];
    $serviceid=$_GET['serviceId'];
    //$classprice=$_GET['classprice'];
    //echo $serviceid;
    function check_email($email){
        if(empty($email)) return false;
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
        return false;
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="with=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>GEE - Consultants - Drop Action</title>
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
    }else{
        $query_con_sql='select * from tutor_class where id='."'{$serviceid}'";
        $query_cli_sql='select * from student_class where classid='."'{$serviceid}'";
        $res_query_con=mysqli_query($con,$query_con_sql);
        $res_query_cli=mysqli_query($con,$query_cli_sql);
        if($res_query_cli->num_rows>0){
            echo "<p>You have ".$res_query_cli->num_rows." client(s) in your service</p>";
            echo "<div class='alert alert-info'><strong>Note:</strong>You need to contact with your client(s) first!</div>";
            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'>Contact</button>";
            echo "<div class='modal' id='myModal'>";
            echo "<div class='modal-dialog'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header'>";
            echo "<h4 class='modal-title'>Client(s) list:</h4>";
            echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
            echo "</div>";
            echo "<div class='modal-body'>";
            while($row=$res_query_cli->fetch_assoc()){
                $query_sql='select * from user where id='."'{$row['studentid']}'";
                $res=mysqli_query($con,$query_sql);
                $row2=$res->fetch_assoc();
                if(check_email($row2['email'])){
                    echo "<p>".$row2['firstname']." ".$row2['lastname']."<a href='mailto:".$row2['email']."' class='btn btn-outline-primary'>Contact</a></p>";
                }else{
                    echo "<p>".$row2['firstname']." ".$row2['lastname']."<a href='#' class='btn btn-outline-primary'>Contact</a></p>";
                }
            }
            echo "</div>";
            echo "<div class='modal-footer'>";
            echo "<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }else{
            if($res_query_con->num_rows>0){
                $delete_sql="DELETE FROM `tutor_class` WHERE `tutor_class`.`id` = "."'{$serviceid}'";
                if(mysqli_query($con,$delete_sql)){
                    echo "<div class='alert alert-success'><strong>Delete success back to<a href='Consultants.php'>Consultants page</a></strong></div>";
                }else{
                    echo mysqli_error();
                }
            }
        }
    }
?>
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

