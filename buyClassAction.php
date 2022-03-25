<?php
    session_start();
    $con=mysqli_connect("127.0.0.1","gesql","li1221#xpk","gesql");
    if(!$con){
        echo "<script>alert('sql connect error')</script>";
        die("error:".mysqli_connect_error());
    }
    $userid=$_SESSION['userid'];
    $classid=$_GET['classid'];
    $classprice=$_GET['classprice'];
    function check_sql_inject($value=null){
        $str = 'select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile';
        if(eregi($str,$value)){
            exit("input not valid");
        }
        return true;
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="with=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>GEE - Student - Buy class</title>
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
                <li class="nav-item"><a class="nav-link" href="#">Tutors</a></li>
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
            $insert_class_sql="INSERT INTO `student_class` (`id`, `studentid`, `classid`) VALUES (null ,$userid,$classid)";
            $query_sql='select * from user where id='."'{$userid}'";
            $query2_sql='select * from tutor_class where id='."'{$classid}'";
            $res_query=mysqli_query($con,$query_sql);
            $res_query2=mysqli_query($con,$query2_sql);
            if($res_query->num_rows>0){
                while($row=$res_query->fetch_assoc()){
                    if($row['amount']>$classprice){
                        if($res_query2->num_rows>0){
                            while($row2=$res_query2->fetch_assoc()){
                                if($row2['available']>0){
                                    if(mysqli_query($con,$insert_class_sql)){
                                        $tutorid=$row2['tutorid'];
                                        $query_sql3='select * from user where id='."'{$tutorid}'";
                                        $res_query3=mysqli_query($con,$query_sql3);
                                        if($res_query3->num_rows>0){
                                            while($row3=$res_query3->fetch_assoc()){
                                                $res_amount=$row['amount']-$classprice;
                                                $tutor_amount=$row3['amount']+$classprice;
                                                $res_available=$row2['available']-1;
                                                $update_info_sql="UPDATE `user` SET `amount` = ".$res_amount." WHERE `id` = "."'{$userid}'";
                                                $update_info_sql3="UPDATE `user` SET `amount` = ".$tutor_amount." WHERE `id` = "."'{$tutorid}'";
                                                $update_info_sql2="UPDATE `tutor_class` SET `available` = ".$res_available." WHERE `id` = "."'{$classid}'";
                                                if(mysqli_query($con,$update_info_sql)&&mysqli_query($con,$update_info_sql2)&&mysqli_query($con,$update_info_sql3)){
                                                    echo "<div class='alert alert-success'><strong>Buy success back to<a href='Student.php'>Student page</a></strong></div>";
                                                }
                                            }
                                        }

                                    }else{
                                        echo mysqli_error($con);
                                    }
                                }
                            }
                        }
                        //echo "success!";

                    }else{
                        echo "<div class='alert alert-danger'><strong>You should <a href='#'>Add amount</a> first! </strong></div>";
                    }
                }
            }
        }
    ?>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">Copyright 2022 Global Episteme Edu.</p>
                </div>
            </div>
        </div>
    </footer>
</body>