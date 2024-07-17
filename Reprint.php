<?php include 'dataConnection.php';  ?>
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
 <meta charset="UTF-8">
 <title>Plan </title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="css/style2.css">
 <style type ="text/css"> </style>

</head> 
<style type ="text/css"> </style>


<body>
<center>
	
<div class="vl">


<div id='textbox'>
	<h1 class='left'>	 MES</h1>
	
	<h2 class='center' >ORBiT </h2>

	
<form  align="right" action ="logoutPage.php" style="margin-bottom: 11;">
<button class="botton" type="submit" >LogOut <i class="fa fa-sign-out"></i></button>&nbsp&nbsp
</div>

<h3 align='left' style = "text-transform:capitalize";>
<?php 

session_start();

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
<br>
<input class='bnt' type=button onClick="parent.location='planFirst.php'"
 value='Go Back'>
<br><br>

<br>
<table id="plan" class='production' style="width:98%">

<thead>

<tr>
<th> Date</th>
<th> Shift</th>
<th>Prd_No</th>
<th>Sleeve No</th>
<th>OC vslue</th>
<th>Item No</th>
<th>Qty</th>
<th>Machine</th>
<th>Die</th>
<th>Total Die</th>
<th>Press or Pot</th>
<th>op_no</th>
<th>Submit</th>


	
</tr>
</thead>

	<?php

$query1="
exec Getreprint @name='".$_SESSION['name']."'

";
	$result1 = sqlsrv_query( $conn, $query1, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));
	
while($row1=sqlsrv_fetch_array($result1)){
	
	$phpdate = strtotime( $row1['date'] );
$mysqldate = date( 'd-m-Y ', $phpdate );



	echo "<tr><td >".$mysqldate."</td>";
	echo "<td >".$row1['shift']."</td>";
	echo "<td >".$row1['prod_or_no']."</td>";
	echo "<td >".$row1['sleeve_no']."</td>";
	echo "<td>".$row1['oc_value']."</td>";
	echo "<td>".$row1['item_no']."</td>";
	echo "<td>".$row1['qty_sleeve']."</td>";
	echo "<td>".$row1['mach_no']."</td>";
	echo "<td>".$row1['die']."</td>";
	echo "<td>".$row1['total_die']."</td>";
	echo "<td>".$row1['prs_or_pt']."</td>";
	echo "<td>".$row1['op_no']."</td>";

	
							
           echo "<input type='Hidden'name='sleeve_no'  value='".$row1['sleeve_no']."'> ";
           echo " <input type='Hidden'name='item'  value='".$row1['item_no']."'> ";	
													
      
           ?>
		   <td>    <input class='bnt' type=button onClick= "parent.location='barcode.php?sleeve_no=<?php echo $row1['sleeve_no']; ?>'"
 value='Print' style=' font-size: revert; height: 22px;  width: 70;'>
		   
							</td></tr>
<?php
				
				
				
}

	
	?>

</table>
</center>
</form>

</body>
</html>