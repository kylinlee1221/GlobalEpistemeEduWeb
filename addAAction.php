<?php
    session_start();
    $con=mysqli_connect("127.0.0.1","gesql","li1221#xpk","gesql");
    if(!$con){
        echo "<script>alert('sql connect error')</script>";
        die("error:".mysqli_connect_error());
    }
    $userid=$_SESSION['userid'];
    $amount=$_POST['amountprice'];
    //echo $amount;
    if(!isset($_SESSION['login'])){
        echo "<div class='alert alert-danger'><strong>You should <a href='Login.html'>login first!</a> </strong></div>";
        echo "<script>alert('login first！')</script>";
        echo "<meta http-equiv='refresh' content='0.5;url=/index.php'>";
    }else{
        $query_sql='select * from user where id='."'{$userid}'";
        $res_query=mysqli_query($con,$query_sql);
        if($res_query->num_rows>0) {
            while ($row = $res_query->fetch_assoc()) {
                $res_amount=$amount+$row['amount'];
                $update_info_sql="UPDATE `user` SET `amount` = ".$res_amount." WHERE `id` = "."'{$userid}'";
                if(mysqli_query($con,$update_info_sql)){
                    echo "<p><strong>Add success <a href='Student.php'>back!</a> </strong></p>";
                    echo "<script>alert('Add success！')</script>";
                    echo "<meta http-equiv='refresh' content='0.5;url=/Student.php'>";
                }
            }
        }else{
            echo "<p><strong>You should <a href='Login.html'>login first!</a> </strong></p>";
            echo "<script>alert('login first！')</script>";
            echo "<meta http-equiv='refresh' content='0.5;url=/index.php'>";
        }
    }
    ?>