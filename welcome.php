<?php include 'dataConnection.php'; 
session_start();
 ?>
<!-- jQuery -->
  <script type="text/javascript" 
          src="https://code.jquery.com/jquery-3.5.1.js">
  </script>
  
  <!-- DataTables CSS -->
  <link rel="stylesheet" 
        href=
"https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <!-- DataTables JS -->
  <script src=
"https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js">
  </script>
  
<!DOCTYPE=html>

<html style="background: #d3d3d3;">

<head>	
 <meta charset="UTF-8" >
 <title>Welcome Page</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="css/style2.css">
</head> 
<style type ="text/css"> 
.box
{
 position: relative; 
 width: 100%;
 height: 520px;
   <?php echo" background-image: url('".$_SESSION['image']."');";?>
   background-repeat: no-repeat;
   
     background-size: 80% 100%;

 border-radius: 8px;
 overflow: hidden;
}

</style>


<body>


<center>
	
<div class="vl">


<div id='textbox'>
	<h1 class='left'>	 MES</h1>
	
	<h2 class='center' >ORBiT </h2>

	
<form  align="right" action ="logoutPage.php" style="margin-bottom: 11;" method="post">
<button class="botton" type="submit" >LogOut <i class="fa fa-sign-out"></i></button>&nbsp&nbsp

 </div>

<h3 align='left' style = "text-transform:capitalize";>
<?php 


if(isset($_SESSION["name"])){
echo '&nbsp Name: '. $_SESSION["name"] .'<br>';}
else{
	header("location:login.php");
}
echo "&nbsp Date: ".$_SESSION["date"];
echo "&nbsp|&nbsp Shift: ".$_SESSION["shift"];


echo "<br>";

echo "&nbsp Machine No: ".$_SESSION['machine'];

echo "<br>";

if($_SESSION["op"]==10){
	echo "&nbsp Operation: 10 Double Drum";
}
else
{
		echo "&nbsp Operation: 20 CURING";

}
 ?> 
 

 <br> 



</div>


<div class='box'>
<br><br><br><br><br><br><br><br><br><br><br>
<div style='float:right;'>
<button class="proceed" type="submit" formaction='<?php echo $_SESSION['url']?>' >PROCEED </button>&nbsp&nbsp
</div>
</div>
</center>
</form>
</body>
</html>