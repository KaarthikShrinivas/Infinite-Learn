<!DOCTYPE html>
<html>
<head>
  <title>Infinite Learn</title>
  <link rel="stylesheet" href="Login.css">
  <script type="text/javascript">
    function changeContent()
    {
        window.location.href = "SignUp.php";
    }
  </script>

</head>
  <body>
    <img src="ProjectLogo.PNG" alt="JournalHub" class="Logo">
    <hr color="orange">
    <div class="containerMain">
      <div class="Login" >
        <form action="" method="post">
            <h2>Sign In</h2>
            <input type="text" name="Iusername" placeholder="Username"  required> <br><br>
            <input type="password" name="Ipassword" placeholder="Password" required> <br> <br>
            <a href="#">Forgot Your Password?</a>
            <br><br>
            <input type="submit" name="Lsubmit" value="SIGN IN" onclick="SigninCheck()">
        </form>
      </div>
      <div class="SignupInfo">
        <h2>Hello, Friend!</h2>
        <p>Enter Your Details and join our quest for knowledge</p>
        <input type="button" value="Sign Up" onclick="changeContent()">
      </div>
    </div>
    <?php
    if(isset($_POST['Lsubmit']))
    {
        $link = mysqli_connect("localhost","root","","login");
        if(!$link)
        {
          echo "Couldn't connect Database Please check the Connection.";
        }
        $Username = $_POST['Iusername'];
        $Password = $_POST['Ipassword'];
        $queryFirst = mysqli_query($link,"select * from login where Username = '$Username'");
        $resultFirst = mysqli_fetch_array($queryFirst);
        $query = mysqli_query($link,"select * from login where Username = '$Username' and Password='$Password'");
        $result = mysqli_fetch_array($query);

        if(empty($resultFirst))
        {
          echo "<script>alert('Username Doesnot Exists')</script>";
        }
        elseif((empty($result)) && (strcmp($resultFirst['Username'],$Username)==0))
        {
          echo "<script>alert('Username and Password Donot Match')</script>";
        }
        elseif((strcmp($result['Username'],$Username)==0) && (strcmp($result['Password'],$Password)==0)) {
          session_start();
          $_SESSION['Username'] = $Username;
          header("Location: Ha.php");
          exit();
        }
    }
     ?>
  </body>
</html>
