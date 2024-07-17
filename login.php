<!DOCTYPE=html>
<html lang="en"  >
<head>	
 <meta charset="UTF-8">
 <title>MES</title>
 
 <link rel="stylesheet" href="css/style.css">
</head> 
<body>

<div class ="box">
 <span class="borderLine"></span>
 
 <form class="form-login" action=auth.php name=login method="post"> 		

 
 <h1>MES</h1><br>
 <h2>Sign in</h2>
 
 <br>
<?php
if( isset($_GET['login'])){
	echo"<p style='color:crimson; margin-bottom:-30'>";
 echo"&nbsp Invalid Username/Password <br><br>";
 echo"</p>";
}

if( isset($_GET['machineNo'])){
	echo"<p style='color:crimson; margin-bottom:-30'>";
 echo"&nbsp Invalid Machine Number <br><br>";
 echo"</p>";
}
 
?>
  
	<div class ="inputBox">
	<input type="text" name="user" autocomplete='off' id='user' onchange='BarcodeOnTextChange()' required >

	<span>User-ID</span>
	<i></i>
	</div>
	
		<div class ="inputBox">
	<input type="text" name="machine" id='machine' autocomplete='off' required>

	<span>Machine Number</span>
	<i></i>
	</div>
	
 
	<div class ="inputBox">
	<input type="password" name="pass" id="pass" autocomplete='off' required>
	<span>Password</span>
	<i></i>
	
	
	</div> 

	<br><p style="color :black;">
	<input type="checkbox" onclick="showPass()" style=" align-self: self-start;"> Show Password 
<!-- <div onclick="showPass()" style='cursor: pointer;'>	 		</div> -->

 </p>
 <br>
 
 
 <input type="submit" >
 
<script>
function showPass() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

 
 <?php
if( isset($_GET['login'])){
?>
<div class ="popup" align="right" onclick="forgetpass()">Forget Password ?
  <span class="popuptext" id="myPopup">Contact IT <br> it.mes@gmail.com</span>
</div>
<?php }?>

<script>

// When the user clicks on div, open the popup
function forgetpass() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}

 function BarcodeOnTextChange()
 {
    var barc;
    var uname;
    barc  = document.getElementById("user").value;
    uname = barc.substr(0,4);
    document.getElementById("user").value = uname;
    document.getElementById("pass").value = barc.substr(4);
	document.login.machine.focus();
 }
</script>

 </form>
 </div>
 </body>
</html>