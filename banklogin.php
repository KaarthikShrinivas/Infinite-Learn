<?php
session_start();
?>

<html>
<head>
    <style>
         .mode
         {
            margin-top:100px;
            margin-left:80px;
            background-color:aqua;
            border-radius: 10px;
            border: 1px white solid;
            width: 400px;
            height: 200px;
            padding: 20px;
            color: black;
            font-weight: bolder;
        }
    </style>

</head>
<body>
<div class="mode">
    <form method="POST" action="banklogin.php">
<label>Login id :</label>
<input type="text" id="cname" name="uid" ><br><br>
<label>Password :</label>
<input type="password" id="cno" name="pwd" ><br><br>    
<label>Account Number :</label>
<input type="text" id="caccount" name="acc"><br><br>
<label>IFSC code :</label>
<input type="text" id="ifsc" name="ifsc"><br><br> 

    <center>
        <button class="btn" name="save">Next</button>
    </center>    
</form>
</div>
<?php
            if(isset($_POST["save"]))    
            {
                define('DB_SERVER','localhost');
                define('DB_USERNAME', 'root');
                define('DB_PASSWORD', '');
                define('DB_DATABASE', 'login');
                $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
                if($db)
                {
                    $userid=$_POST['uid'];
                    //real_escape_string() adds escape chracter '\' for certain char like ' or " which can give error while connecting
                    $userid = mysqli_real_escape_string($db,trim($_POST['uid']));
                    $password = mysqli_real_escape_string($db,trim($_POST['pwd'])); 
                    $sql = "select login_id, password from banklogin where login_id = '$userid' LIMIT 1";  
                    if($result=mysqli_query($db,$sql))
                    {
                        if($row=mysqli_fetch_row($result))
                            {
                                if($row[1]!=$password)
                                    echo "<script>window.alert('Invalid Password');</script>";
                                else
                                {
                                    //$_SESSION["user"]=$username;
                                    //header("Location:.php");
                                    echo "<script>window.alert('Success');</script>";
                                    $_SESSION['logid']=$_POST['uid'];
                                    header("Location:processbank.php");
                                    mysqli_close($db);
                                }
                            }
                        else
                        echo "<script>window.alert('Invalid login credential');</script>";
                    }
                }
                else
                    die("Connection failed: " . mysqli_connect_error());
            }
        ?>
</body>
</html>
