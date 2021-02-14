<?php
session_start();

$rno=$_SESSION['otp'];
$em=$_SESSION['email'];
//echo "the otp is ".$rno;
$to = $em;
$subject = "Payment Verification OTP";
$txt = "Hello Subscriber Your OTP is ".$rno;
mail($to,$subject,$txt);
echo "<h3>"."<center>"."verification mail has been sent"."</center>"."</h3>"; 
/*
$servername="localhost";
$username="root";
$password="";
$dbname="login";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn)
{
    die("connection failed: ".mysqli_connect_error());
}
*/

if(isset($_POST['otpsave']))
{
    $rno=$_SESSION['otp'];
    $urno=$_POST['otpvalue'];
    //$name=$_SESSION['name'];
    //$em=$_SESSION['email'];
    $d1=date("Y-m-d");
    //$r=$_SESSION['rec'];// session variable for recharge
    
    if(!strcmp($rno,$urno))
    {
        
        //$sql= "INSERT INTO transactionhistory(email_id, recharge_amount, mode,t_date,status)VALUES('$em', '200', 'card','$d1','success')";

        //$stmt = $mysqli->prepare($sql);
        //$stmt->bind_param("ss", $email);
        //$stmt->execute();
        //echo "<script>alert('Your OTP is valid');</script>";
        //if (mysqli_query($conn,$sql))
        //{ 
        //mysqli_close($conn);    
        header("Location: success.php");
        //echo "<p>"."your otp is valid ". $name."</p>";  
        //}  
    }
else
{
    //$sql= "INSERT INTO transactionhistory(email_id, recharge_amount, mode, t_date,status)VALUES('$em', '200','card','$d1', 'failed')";
    //if (mysqli_query($conn,$sql))
    //{
    //    echo"<script>alert('Sorry invalid otp');</script>";
     //   mysqli_close($conn);
        header("Location: failure.php");
    //}    

}

}
?>

<html>
<head>
    <style>
    .otpbox{
        margin:200px;
        padding:20px;
        background-color:whitesmoke;
        color:black;
        font-weight:bolder;
        line-height:17px;
        
    }
    .btn{
            padding:10px;
            background-color: lightblue;
            font-weight: bolder;
            color:black;
            border-radius: 10px;
            border: 1px solid;
        }
    </style>
</head>
<body>
    <div class="otpbox">
    <form method="post" action="otp.php">
        <br>
        <br>
        
        <label>Enter otp</label>
        <input type="text" placeholder="OTP" name="otpvalue">
        <br>
        <br>
        <button class="btn" name="otpsave">Validate otp</button>
</div>
</form>
</div>
</body>
</html>

