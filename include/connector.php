<?php
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
?>