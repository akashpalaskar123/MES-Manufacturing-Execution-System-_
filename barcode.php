
	
	<html>
    <head>
	 <title>Barcode</title>
<style >
body{font-size: 15;}
@font-face {
		font-family: 'Free 3 of 9';
		src:  url('font\fre3of9x.ttf') format('ttf'),
        url('font\free3of9.ttf') format('ttf');
       
}

table {
	margin-left:30;


}

.barcode {
	
	font-size: 50;
	margin: 1;
	font-family: 'Free 3 of 9';
  
}
table.Tborder{
	text-transform:capitalize;
	   height: 50px;
	width:400px;
	margin-left:30;
	font-size: smaller;

}

.inline {margin: 1;
display: inline-block;}

button{
	width:100;
}


</style>   
    </head>

	<!-- onload='window.doPrint()' -->
    <body onload='window.doPrint()' >
	
		<?php
		session_start();
	date_default_timezone_set('Asia/Kolkata');

		$SleeveNo ="*".strtoupper($_GET['sleeve_no'])."*";
	//	$rate =strtoupper($_POST['price']); 
		//$qnt=$_POST['quantity'];
	$_SESSION['printed']=	1;

 echo date('d-m-y').",&nbsp ".date('H:i:a');
 echo "<br>";

include 'dataConnection.php';
$query3 = "	

exec Getprint;1 @sleeveNo='".$_GET['sleeve_no']."'

";

$res3 = sqlsrv_query( $conn, $query3, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));

	if (sqlsrv_has_rows($res3) == false || $res3==false){
		echo "<p style=' margin-top: 0; color : red;'	> Something Is Wrong in HV query</p>";
		echo "";
		
	}


$row3=sqlsrv_fetch_array($res3);



echo"<table style='height:70px;width:400px;	text-align: center;
' >";
 for($x=1;$x<=1;$x++) {
	 if ($row3['op_no'==10]){
		 $query5="select  DATEDIFF(day,'".$row3['plann_date']."','".$row3['date']."') as PD";
		 $res5 = sqlsrv_query( $conn, $query5, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));
		 $row5=sqlsrv_fetch_array($res5);
		 
		 $pd=$row5['PD'];
		

	 }
	 $cost=$row3['cost'];

			

			

 }			
if ($pd>0){
				echo "  <tr >
			<td width='25%'>PD-".$pd."</td>
			<td width='50%' class='barcode'>".$SleeveNo." </td>
			<td width='25%'>".$cost."</td>
			</tr>";
}
else{
				echo "  <tr >
			<td width='25%'></td>
			<td width='50%' class='barcode'>".$SleeveNo." </td>
			<td width='25%'>".$cost."</td>
			</tr>";
}

echo"</table>";




	/*
	select production.date , production.shift,production.prod_or_no , production.sleeve_no,production.oc_value,production.item_no,
production.qty_sleeve , production.act_sleeve, production.rej_sleeve, production.mach_no, production.size
, production.die, production.total_die,production.prs_or_pt,plann.mach_no,plann.op_no,production.tool_use,plann.op_st
from production
join plann on (plann.sleeve_no = production.sleeve_no)
where  production.sleeve_no='".$_GET['sleeve_no']."'

	
*/	
			
	include 'dataConnection.php';  
	$query= "

exec Getprint;1 @sleeveNo='".$_GET['sleeve_no']."'


";

echo "<table class='Tborder'>";
	$res = sqlsrv_query( $conn, $query, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));
		if ($res == false){
		echo "<p style=' margin-top: 0; color : red;'	> Query not running</p>";
		echo "";
		exit;
	}
		if (sqlsrv_has_rows($res) == false){
		echo "<p style=' margin-top: 0; color : red;'	> Something is wrong</p>";
		echo "";
		exit;
	}
	
	$i = 1;
	
	while($row=sqlsrv_fetch_array($res) and $i <= 1){
		if($row['op_no']==10){
		$op_st_10=$row['op_st'];
		$mach_10=$row['mach_no'];

			
		echo"<tr> 
		<td><b>Date-Shift:</b></td>
		<td>".$row['date'].",&nbsp&nbsp".$row['shift']."</td>
		<td></td><td></td>
		</tr>";
		
		echo"<tr>
		<td><b>Order NO:</b></td>
		<td>".$row['prod_or_no']."</td>
		<td><b>Drum to use:</b></td>
		<td>".$row['tool_use']."</td>
		</tr>";
		
		echo"<tr>
		<td><b>Sleeve No:</b></td>
		<td><b><u>".$row['sleeve_no']."</u></b></td>
		<td><b>Press/Pot:</b></td>
		<td>".$row['prs_or_pt']."</td>
		</tr>";
		
		echo"<tr>
		<td><b>Quantity:</b></td>
		<td>".$row['qty_sleeve']."</td>
		<td><b>Norms OC:</b></td>
		<td>".$row['oc_value']."</td>
		</tr>";
		
		
		
		
		
		}
		
		if($row['op_no']==20){
			$mach_20=$row['mach_no'];
			$op_st_20=$row['op_st'];

		}
	
	}
	
	echo"<tr>
	<td><b>CURING M/C:</b></td>
	<td>".$mach_20."</td>
	<td></td>
	<td></td>
	</tr>";
	
		
		
		
		
		echo "</table>";
		
			
		
		
			
	echo "<table style='width:400px;height:200px;font-size: small;'>";
	
	$query2="
	exec Getmethods;1 @opst='".$op_st_20."' 
	";
	
	
	$result2 = sqlsrv_query( $conn, $query2, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
	
	$num = sqlsrv_num_rows($result2);
	
while($row2=sqlsrv_fetch_array($result2)){
	

	echo "<tr>
	<td><b>".utf8_encode($row2['op_md'])."</b></td>";
	
	echo "<td><b>".utf8_encode($row2['parameter'])."</td>";

	echo "<td><b>".utf8_encode($row2['unit'])."</td>
	</tr>";

   
				
				
}

	
	echo "</table>";
		
		
		
		?>

		<br><br><br>	
		
	<button id="printpagebutton" onclick='doPrint()'>print</button>

		
    </body>
	
</html>
<script>
function doPrint() {
	var printButton = document.getElementById("printpagebutton");
	printButton.style.visibility = 'hidden';
	
	window.print();  
setTimeout(function() {
 document.location.href = "planFirst.php"; 
}, 1000);


//function definition


window.close();	

	
	}


</script>
<?php
		//header("location:welcome.php");

	?>
