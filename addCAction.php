<?php
    session_start();
    $con=mysqli_connect("127.0.0.1","gesql","li1221#xpk","gesql");
    if(!$con){
        echo "<script>alert('sql connect error')</script>";
        die("error:".mysqli_connect_error());
    }
    $userid=$_SESSION['userid'];
    $classname=$_POST['classname'];
    $classdetail=$_POST['classdes'];
    $classprice=$_POST['classprice'];
    $starttime=$_POST['startdate'];
    $endtime=$_POST['enddate'];
    $available=$_POST['available'];
    $classtype=$_POST['classtype'];
    //echo "userid: ".$userid." ,classname: ".$classname." ,class detail: ".$classdetail." ,class price: ".$classprice." ,start time: ".$starttime." ,end time: ".$endtime." ,available: ".$available." ,class type: ".$classtype." .";
    function check_sql_inject($value=null){
        $str = 'select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile';
        if(eregi($str,$value)){
            exit("input not valid");
        }
        return true;
    }
    if(check_sql_inject($classname)==true&&check_sql_inject($classdetail)==true&&check_sql_inject($classtype)){
        $sql_insert="INSERT INTO `tutor_class` (`id`,`classname`, `classdeatil`, `classprice`, `starttime`, `endtime`, `available`, `classtype`, `tutorid`) VALUES (null,'$classname','$classdetail','$classprice','$starttime','$endtime','$available','$classtype','$userid')";
        if(mysqli_query($con,$sql_insert)){
            exit("add success! <a href='Tutors.php'>back!</a>");
        }else{
            echo mysqli_query($con,$sql_insert);
            echo 'Sql error: '.mysqli_error($con).'<br />';
            echo '<a href="Tutors.php">back</a>';
        }
    }
?>
