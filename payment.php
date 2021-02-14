<?php
session_start();
?>
<html>
<head> 
    <style>

        .mode{
            margin-top:100px;
            margin-left:200px;
            background-color:aqua;
            border-radius: 10px;
            border: 1px white solid;
            width: 900px;
            height: 500px;
            padding-top: 50px;
            text-align:center;
            color: black;
            font-weight: bolder;
            font-size:18pt;
        }

        .cdisp{
            border: none;
            margin:200px;
        }
        .bdisp{
            border: none;
            margin:200px;
        }
        img{
            margin-left:30px ;
            margin-top:30px;
        }
        .btn{
            margin-left:300px;
            padding:10px;
            background-color: lightblue;
            font-weight: bolder;
            color:black;
            text-align: center;
            border-radius: 10px;
            border: 1px solid;
        }
        .btn1{
            margin-left:100px;
            padding:10px;
            background-color: lightblue;
            font-weight: bolder;
            color:black;
            
            border-radius: 10px;
            border: 1px solid;
        }
        p{
            margin:50px;
            font-weight: bolder;
            font-size: 20;

        }
        center{
            font-size:20px;
            font-weight:bolder;
            color:aqua;
        }
    </style> 
</head>
<body style="background-color:#0c2326;">
    
        <div class="mode" id="mode1">
        
        <label style="font-size: 20pt;"> Select payment type </label><br><br>
        <input type="radio" name="pay" value = "card">Credit Card / Debit Card &nbsp;&nbsp;
        <img src="visacard.jpg" width=100" height="50"><br><br>
        <input type="radio" name="pay" value= "bank">Net Banking &nbsp;&nbsp;
        <img style="margin-left:120px;" src="bank.jpg" height="50" width="100"><br><br>
        <br>
        <br>
        <input type="button" class="btn" name="save" style="margin-left:100px;" onclick="setpayment()" value ="next">
        
   
</div>
<script>
   function setpayment()
   {
       var k=document.getElementsByName('pay');
       for(var i=0; i<k.length;i++)
       {
           if(k[i].checked==true)
           {
                document.getElementById("mode1").style.display="none";
               if(k[i].value=="card")
               {
                location.replace("card.php");
               }
               else if(k[i].value=="bank")
               {
                   location.replace("banklogin.php");
               }
           }
       }
   }
    
</script>
</body>    
</html>