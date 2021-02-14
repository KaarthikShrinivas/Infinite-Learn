<?php
session_start();
$randomnum=rand(100000,999999);
//$to=$_POST['email'];
//$txt="Hello Subscriber! Your OTP : ".$randomnum;

//if(isset($_POST['save']))
//{
    /*if(preg_match("/[0-9]{12}$/",$_POST['cno'])==0)
    {
        echo"<script>window.alert('enter valid card number');</script>";
        $t=1;
    }    

    if(preg_match("/([a-zA-Z])+$/",$_POST['cname'])==0)
    {
        echo"<script>window.alert('enter valid card name');</script>";
        $t=1;
    }*/
    //$_SESSION['name']=$_POST['cname'];
    //$_SESSION['email']=$_POST['cemail'];
    $_SESSION['otp']=$randomnum;
    header("Location:otp.php");
//}

?>