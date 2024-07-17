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
 <title>Production</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="css/style2.css">
</head> 
<style type ="text/css"> </style>


<body>
<center>
	
<div class="vl">


<div id='textbox'>
	<h1 class='left'>	 MES</h1>
	
	<h2 class='center' >ORBiT </h2>

	
<form  align="right" action ="logoutPage.php" style="margin-bottom: 11;" method="get">
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
 






</div>

<?php
		if (isset( $_GET['production'] )){
			if( $_GET['production']=='fail'){
	
		echo"<p style='    margin-bottom: 0;background-color: white;color:red; font-size:30;'>Production Entry Failed</p>";
			}
			else{
						echo"<p style='      margin-bottom: 0;  background-color: white; color: 57DE21; font-size:30;'>Production Data Entry Done Sucessfully</p>";

			}
}

echo "<br>";

include_once "getSleeveNO.php";


if (isset($_GET['sleeve_no']) and $_GET['sleeve_no']!= null){
	
$scanSleeveNo= $_GET['sleeve_no'];


echo' <br>';
echo'<table id="plan" class="production" style="width:98%">';

echo'<thead>';

echo'<tr>';
echo'<th> Sleeve No</th>';
echo'<th>Prd Order No</th>';
echo'<th>Size</th>';
echo'<th>Quantity</th>';
echo'<th> OC Value</th>';
echo'<th>Die</th>';
echo'<th>Total Die</th>';
echo'<th>Press or Pot</th>';
echo'<th>Actual Quantity</th>';
echo'<th>Submit</th>';


	
echo'</tr>';
echo'</thead>';

	
	


$query1=
"

exec Selectplan;2 @machine='".$_SESSION['machine']."' ,@sleeveNo='".$scanSleeveNo."' 

";
	$result1 = sqlsrv_query( $conn, $query1, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
	
	if($result1 == false){
		echo "<p style=' margin-top: 0; color : red;'> Please Check Sleeve Number </p>";
		echo "";
		exit;
		
	}
	
	if (sqlsrv_has_rows($result1) == false){
		echo "<p style=' margin-top: 0; color : red;'	> Production Already Done </p>";
		echo "";
		exit;
	}
	
	$i=0;
while($row1=sqlsrv_fetch_array($result1)){
	

	echo "<tr><td >".$row1['sleeve_no']."</td>";
	echo "<td>".$row1['prod_or_no']."</td>";
	echo "<td>".$row1['size']."</td>";
	echo "<td>".$row1['qty_sleeve']."</td>";
	echo "<td>".$row1['oc_value']."</td>";
	echo "<td>".$row1['die']."</td>";
	echo "<td>".$row1['total_die']."</td>";
	echo "<td>".$row1['prs_or_pt']."</td>";

	
						if($row1['op_no']=='10'){
							 echo " <td>
							 <input type ='button' onclick='increment()' class='plus' value='+' disabled>
							 <input type=number class='qty' id='qty' min=1 value='".$row1['qty_sleeve']."'  onchange='update()' name='actSleeve_qty' readonly>
							 <input type='button' onclick='decrement()' class='minus' value='-' disabled>
							 </td>
							  ";

						}
					else{
							 echo " <td><input type ='button' onclick='increment()' class='plus' value='+'>
							 <input type=number class='qty' id='qty' min=1 value='".$row1['qty_sleeve']."'  onchange='update()' name='actSleeve_qty' readonly> 
							 <input type='button' onclick='decrement()' class='minus' value='-'>
							 </td>
				";
					}
													
                  
           echo "<td><button formaction='production.php' type='submit' class='bnt 'id='select'  disabled>Submit</button>
		   
							</td></tr>";
							
           echo "<input type='Hidden'name='Sleeve_no'  value='".$row1['sleeve_no']."'> ";
           echo "<input type='Hidden'name='Sleeve_qty'  value='".$row1['qty_sleeve']."'> ";
				
				$opst=$row1['op_st'];
				
				
				
}

	
	

echo'</table>';


echo'<br>';
echo'<h3>Production steps!!!</h3>';
echo'<br>';


echo'<table   class="production" style="width:98%">';

echo'<thead>';

echo'<tr>';
echo'<th> Methods</th>';
echo'<th>Parameter</th>';
echo'<th>Unit</th>';

echo'</tr>';

echo'</thead>';


	
	
	$query=" 
	
		exec Getmethods;2 @opst='".$opst."', @opno='".$_SESSION["op"]."'
	";
	$result = sqlsrv_query( $conn, $query, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
	
	$num = sqlsrv_num_rows($result);
	
while($row=sqlsrv_fetch_array($result)){
	

	echo "<tr><td>".utf8_encode($row['op_md'])."</td>";
	echo "<td>".utf8_encode($row['parameter'])."</td>";

	echo "<td>".utf8_encode($row['unit'])."</td></tr>";

	/*
	echo "<tr><td>".htmlentities($row['op_md'],ENT_QUOTES)."</td>";
	echo "<td>".htmlentities($row['parameter'],ENT_QUOTES)."</td>";
	echo "<td>".htmlentities($row['unit'],ENT_QUOTES)."</td></tr>";

				*/

               
				
				
}

	
	
	
echo'</table>';







echo '<h4>Have You Gone Through The Above Process Methods?</h4>';
echo'
<br><br>
<label class="switch">
  <input type="checkbox" id="termsCheckBox">
  <span class="slider round"></span>
</label>
<br><br><br><br>';

}






?>


<br><br>
</form>


<script>

function update(){
    let updateValue = document.getElementById("sleeve_qty").value;
	
}
function submit()
{
					var url="production.php?sleeve_qty="+updateValue+"";

	parent.location=url;
}




var checkboxes = $("input[type='checkbox']");

checkboxes.click(function() {
        if(termsCheckBox.checked){
        //Set the disabled property to FALSE and enable the button.
        document.getElementById("select").disabled = false;
    } else{
        //Otherwise, disable the submit button.
        document.getElementById("select").disabled = true;
    }
});

function increment() {
document.getElementById('qty').stepUp();}

function decrement() {

document.getElementById('qty').stepDown(); }

</script> 

</center>
</body>
</html>