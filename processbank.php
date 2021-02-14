<?php
session_start();
$randomnum=rand(100000,999999);
    $_SESSION['otp']=$randomnum;
    header("Location: otpbank.php");
//}

?>