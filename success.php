<?php 
    session_start();
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
        .btn{
            padding:10px;
            background-color: lightblue;
            font-weight: bolder;
            color:black;
            text-align: center;
            border-radius: 10px;
            border: 1px solid;
        }
        p{
            margin:100px;
            font-weight: bolder;
            font-size: larger;
        }
        a{
            text-decoration:none;
            color:black;
            font-weight: bolder;
        }
    </style>
    <script>
        function delivery()
        {
            var User = "<?php echo $_SESSION["Username"]?>";
            var QtyUser = User + "_Qty";
            localStorage.removeItem(User);
            localStorage.removeItem(QtyUser);
            window.location.href = "Delivery.php";
        }
    </script>
</head>
<body>
<div>
<center>
    <p>Your otp is valid !!!
    <br><br>
    Your Transaction has been processed <i class="fa fa-check-circle" style="font-size:36px; color:green"></i>    
    <br><br><br>
    <button class="btn" onclick = "delivery()">Click to go to Delivery</a></button><br>
    </p>
    </center>

</div>
</body>
</html>
