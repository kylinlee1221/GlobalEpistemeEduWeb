<?php
    session_start();
    //require("include/connector.php");
    $con=mysqli_connect("127.0.0.1:33065","root","","gesql");
    if(!$con){
        echo "<script>alert('sql connect error')</script>";
        die("error:".mysqli_connect_error());

    }
    function check_sql_inject($value=null){
        $str = 'select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile';
        if(eregi($str,$value)){
            exit("input not valid");
        }
        return true;
    }
    $user=$_POST['username'];
    $pass=$_POST['password'];
    if($user==null||$pass==null){
        echo "<script>alert('www！')</script>";
        die("not null exception!");
    }
    if(check_sql_inject($user)==true&&check_sql_inject($pass)==true){
        $sql='select * from user where username='."'{$user}'and password="."'$pass';";
        $res=mysqli_query($con,$sql);
        if($res->num_rows>0){
            while($row=$res->fetch_assoc()){
                //echo $row['id'];
                $_SESSION['login']=true;
                $fullname=$row['firstname'].' '.$row['lastname'];
                $_SESSION['fullname']=$fullname;
                $_SESSION['userid']=$row['id'];
                $_SESSION['role']=$row['role'];
                //echo $row['role'];
                if(eregi($row['role'],'student')){
                    echo 'login success '.$row['role'];
                    //echo '1';
                    echo "<meta http-equiv='refresh' content='1;url=/Student.php'>";
                }elseif (eregi($row['role'],'Tutor')){
                    echo 'login success '.$row['role'];
                    echo "<meta http-equiv='refresh' content='1;url=/Tutors.php'>";
                }
                //echo "login success! fname".$row['firstname']." ,lname: ".$row['lastname']." ,role: ".$row['role']." ,username: ".$row['username'];
            }
        }else{
            echo "<p><strong>You should <a href='Login.html'>login first!</a> </strong></p>";
            echo "<script>alert('login first！')</script>";
            echo "<meta http-equiv='refresh' content='0.5;url=/index.php'>";
        }
    }
    $con->close();
?>