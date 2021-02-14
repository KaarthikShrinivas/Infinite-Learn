<?php
session_start();
$rno=$_SESSION['otp'];
$em=$_SESSION['logid'];
//echo "the otp is ".$rno;
$to = $em;
$subject = "Payment Account Verification OTP";
$txt = " Your OTP for Net banking is ".$rno;
mail($to,$subject,$txt);
echo "Verification mail has been sent"; 
$servername="localhost";
$username="root";
$password="";
$dbname="login";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn)
{
    die("connection failed: ".mysqli_connect_error());
}

if(isset($_POST['otpsave']))
{
    $rno=$_SESSION['otp'];
    $urno=$_POST['otpvalue'];
    //$name=$_SESSION['name'];
    $em=$_SESSION['logid'];
    $d1=date("Y-m-d");
    //$r=$_SESSION['rec'];
    
    if(!strcmp($rno,$urno))
    {
        //$sql= "INSERT INTO transactionhistory(email_id, recharge_amount, mode,t_date,status)VALUES('$em', '$r', 'Net Banking','$d1','success')";
        

        //$stmt = $mysqli->prepare($sql);
        //$stmt->bind_param("ss", $email);
        //$stmt->execute();
        //echo "<script>alert('your otp is valid');</script>";
        //if (mysqli_query($conn,$sql))
        //{ 
        //mysqli_close($conn);    
        header("Location: success.php");
        //echo "<p>"."your otp is valid ". $name."</p>";  
        //}  
    }
else
    {
    //$sql= "INSERT INTO transactionhistory(email_id, recharge_amount, mode, t_date,status)VALUES('$em', '$r','Net Banking','$d1', 'failed')";
    //if (mysqli_query($conn,$sql))
    //{
        //echo"<p>Sorry invalid otp</p>";
      //  mysqli_close($conn);
        header("Location: failure.php");
    //}    

    }

}
?>

<html>
<head>
</head>
<body>
    <div>
    <form method="post" action="otpbank.php">
        <br>
        <br>
        <center>
        <label>Enter otp</label>
        <input type="text" placeholder="OTP" name="otpvalue">
        <br>
        <br>
        <button name="otpsave">Validate Otp</button>
</center>
</form>
</div>
</body>
</html>