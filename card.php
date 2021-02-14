<?php
session_start();
?>
<html>
<head>
    <style>
         .mode{
            margin-top:200px;
            margin-left:400px;
            background-color:aqua;
            border-radius: 10px;
            border: 1px white solid;
            width: 400px;
            height: 300px;
            padding: 20px;
            color: black;
            font-weight: bolder;
            text-align:center;
        }
        .input-box{
            margin-left:60px;
            
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
<body style="background-color:#0c2326;" >
<div class="mode">
    <form method="POST" action="card.php">
<label>Name on card :</label>
<input class="input-box" type="text" id="cname" name="cname" ><br><br>
<label>Card Number :</label>
<input class="input-box" type="text" id="cno" name="cno" ><br><br>
<label>CVV Number :</label>
<input class="input-box" type="text" id="cvv" name="cvv" ><br><br>
<label>Card Expiry date :</label>
    <input class="input-box" type="date" id="cdate" min="<?php echo date("Y-m-d"); ?>"><br><br>
<label>Email Id</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input class="input-box" type="email" id="em" name="cemail"><br><br>    
    <center>
        <button class="btn" onclick="check()" name="save">Next</button>
    </center>    
</form>
</div>
<?php
if(isset($_POST['save']))
{$t=0;
if(preg_match("/[0-9]{12}$/",$_POST['cno'])==0)
    {
        echo"<script>window.alert('enter valid card number');</script>";
        $t=1;
    }    

    if(preg_match("/([a-zA-Z])+$/",$_POST['cname'])==0)
    {
        echo"<script>window.alert('enter valid card name');</script>";
        $t=1;
    }
if($t==0)
{
    $_SESSION['name']=$_POST['cname'];
    $_SESSION['email']=$_POST['cemail'];
    header("Location: process.php");
}

}
?>
    
<script>
   /*
function check()
{    
    var s=/[0-9]{12}/;
    var c=/[0-9]{3}/;
    var n=/([a-zA-Z])+/;
    var x=document.getElementById("cno").value;
    if(!x.match(s))
    {
        alert("Please Enter a valid card number");
    }
    var x1=document.getElementById("cname").value;
    if(!x1.match(n))
    {
        alert("Please enter a valid name");
    }
    var c1=document.getElementById("cvv").value;
    if(!c1.match(c))
    {
        alert("Please enter a valid CVV Number");
    }

}*/   
</script>
</body>
</html>
