<?php
    //session_start();
    $con=mysqli_connect("127.0.0.1","gesql","li1221#xpk","gesql");
    if(!$con){
        echo "<script>alert('sql connect error')</script>";
        die("error:".mysqli_connect_error());
    }
    $username=$_POST['username'];
    $password=$_POST['password'];
    $roles=$_POST['roles'];
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $email=$_POST['email'];
    /*echo $username;
    echo $password;
    echo $roles;*/
    if($username==null||$password==null){
        echo "<script>alert('www！')</script>";
        die("not null exception!");
    }
    function check_sql_inject($value=null){
        $str = 'select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile';

        return true;
    }
    if(check_sql_inject($username)==true&&check_sql_inject($password)==true){
        $sql_query='select * from user where username='."'{$username}'";
        $res_query=mysqli_query($con,$sql_query);
        if($res_query->num_rows>0){
            echo 'Error',$username,' exists<a href="javascript:history.back(-1);">back</a>';
            exit;
        }
        if(strcmp($roles,'Select your Role here')==0){
            echo 'Error','please select role',' <a href="javascript:history.back(-1);">back</a>';
            exit;
        }
        $sql_insert="insert into user(`username`, `password`, `email`, `firstname`, `lastname`, `role`) VALUES ('$username','$password','$email','$fname','$lname','$roles')";
        if(mysqli_query($con,$sql_insert)){
            exit('register success!<a href="Login.html">Login</a>');
        }else{
            echo 'Sql error: '.mysql_error().'<br />';
            echo '<a href="javascript:history.back(-1);">back</a>';
        }
    }
?>
