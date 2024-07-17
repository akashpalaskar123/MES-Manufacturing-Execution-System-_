<?php
session_start();
?>
<!DOCTYPE=html>

<html style="background: #d3d3d3;">

<head>	
 <meta charset="UTF-8">
 <title>LogOut Page</title>
 <link rel="stylesheet" href="css/style2.css">
</head> 
<style type ="text/css"> </style>


<body>
<center>
<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();
setcookie("user",false);
?>
<h1 style="text-align: left;">&nbsp MES</h1>
	<br>  <br> <br> <br> <br>  

<h1>Thanks For Using MES</h1>
<h3>Go To Login</h3>

<form action ="login.php">
<button class="botton" type="submit" >Login</button>
</form>
</center>
</body>
