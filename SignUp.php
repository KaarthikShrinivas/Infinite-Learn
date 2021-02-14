<!DOCTYPE html>
<html>
<head>
  <title>Infinite Learn</title>
  <link rel="stylesheet" href="Login.css">
  <script type="text/javascript">
    function backOrginal()
    {
      window.location.href = "Login.php";
    }
  </script>

</head>
  <body>
    <img src="ProjectLogo.PNG" alt="JournalHub" class="Logo">
    <hr color="orange">
    <div class="containerMain">
      <div class="Login">
        <form action="" method="post">
            <h2>Sign Up</h2>
            <input type="text" name="Uusername" placeholder="Username" required> <br><br>
            <input type="email" name="Uemail" placeholder="Email" class="email" required> <br><br>
            <input type="password" name="Upassword"  placeholder="Password" required> <br> <br>
            <br><br>
            <input type="submit" name="Usubmit" value="SIGN UP" onclick="SignUpCheck()">
        </form>
      </div>
      <div class="SignupInfo">
        <h2>Welcome, Back</h2>
        <p>Enter your Details, to Continue your quest for knowledge</p>
        <input type="button" value="Sign In" onclick="backOrginal()">
      </div>
    </div>
    <?php
    if(isset($_POST['Usubmit']))
    {
        $link =  mysqli_connect("localhost","root","","login");
        if(!$link)
        {
          echo "Couldn't connect database Please check Your Connection.";
        }
        $Username = $_POST['Uusername'];
        $Password = $_POST['Upassword'];
        $Email = $_POST['Uemail'];
        //Checking if the Username already Exists
        $queryCheckUsername = mysqli_query($link,"select * from login where Username = '$Username' limit 1");
        $fetchCheckResult = mysqli_fetch_array($queryCheckUsername);
        if(!empty($fetchCheckResult))
        {
          echo "<script>alert('The Username Already Exists');</script>";
          echo '<script>window.location.href="SignUp.php"</script>';
        }
        else {
          mysqli_query($link,"insert into login(Username,Password,Email) values('$Username','$Password','$Email')");
          mysqli_query($link,"insert into banklogin(login_id,password) values('$Email','$Password')");
          header("Location: Login.php");
          exit();
        }
    }
     ?>
  </body>
</html>
