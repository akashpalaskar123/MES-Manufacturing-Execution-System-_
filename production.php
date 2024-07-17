<?php

include 'dataConnection.php';  

session_start();

$actSleeve_qty = trim(strip_tags($_GET['actSleeve_qty']));
$Sleeve_qty = trim(strip_tags($_GET['Sleeve_qty']));

$Sleeve_no = trim(strip_tags($_GET['Sleeve_no']));


$_SESSION['qty']=$actSleeve_qty;

echo "S-qty= ".$Sleeve_qty;

$rejSleeve_qty=$Sleeve_qty - $actSleeve_qty;

echo '<BR>actS-qty= '.$actSleeve_qty;
echo "<br> S-no= ".$Sleeve_no."<br>";



$query= "select * from plann where sleeve_no='".$Sleeve_no."'and mach_no='".$_SESSION['machine']."';";

echo $query;
$res = sqlsrv_query( $conn, $query, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));



      

while($row=sqlsrv_fetch_array($res)){
	

 
                $date =$row['date'];
               $shift = $row['shift'];
                $product_order_no = $row['prod_or_no'];
                $sleeve_no = $row['sleeve_no'];
				$oc_value = $row['oc_value'];
				$item_no =$row['item_no'];
				$qty_sleeve = $row['qty_sleeve'];
				$tool_use = $row['tool_use'];
				$pl_status = 2;
				$mach_no = $row['mach_no'];
				$op_no = $row['op_no'];
				$pl_start_dt = $row['pl_start_dt'];
				$pl_end_dt = $row['pl_end_dt'];
				$size = $row['size'];
				$prod_type =$row['prod_type'];
				$die =$row['die'];
				$total_die = $row['total_die'];
				$prs_or_pt= $row['prs_or_pt'];
				$norms_type = $row['op_st'];
}

echo "<br>".$_SESSION['shift']."<br>";

if ($_SESSION['shift']=='First'){	 
   $shift=1;

}
else if (  $_SESSION['shift']=='Second'  ){
	$shift=2;
}
else{
		$shift=3;

}



echo"<br>";
echo "Opeation no ; ".$op_no."<br>";

if ($op_no==20){

$query3 = "select * from plann where sleeve_no ='".$sleeve_no."' ";

$res3 = sqlsrv_query( $conn, $query3, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));
	while($row3=sqlsrv_fetch_array($res3)){
		if($row3['op_no']=='10')
		{
			echo"save status 10 ".$row3['pl_status']."<br>";
			$plStatus10 = $row3['pl_status'];
		}
		else{
						echo"save status 20 ".$row3['pl_status']."<br>";

			$plStatus20 = $row3['pl_status'];
		}
		
		
	}
	

	if ( $plStatus20 > $plStatus10 ){
	$plStatus = $plStatus20;	//save 20 pl_status is greater then save it 
	}
	else{
		$plStatus=$plStatus10;
	}
	
	if ($plStatus=='1'){



$query2 = "insert into production values ( convert(varchar, getdate(), 0),'".$shift."' ,'".$product_order_no."','".$sleeve_no."',".$oc_value.",'".$item_no."'
,'".$Sleeve_qty."','".$actSleeve_qty."','".$rejSleeve_qty."','".$tool_use."','".$mach_no."','".$size."','".$prod_type."',".$die.",".$total_die.",'".$prs_or_pt."','".$op_no."' ,'".$_SESSION["name"]."') ;
";

echo $query2;
$res2 = sqlsrv_query( $conn, $query2, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));


$query3 = "update  plann set pl_status='2' where sleeve_no='".$Sleeve_no."';";

echo $query3;

$res3 = sqlsrv_query( $conn, $query3, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));


if( $res2 == false){

	header("location:planSecond.php?production=fail");
	exit;

}
	
echo"<br>Barcode done of sleeve number = ".$sleeve_no;

	
echo "<br>".$query3;

	header("location:PlanSecond.php?production=pass");
	exit;

	}
	else{
	header("location:planSecond.php?production=fail");
	exit;
	}
}

else{

		$query1="select * from production where sleeve_no ='".$Sleeve_no."' and op_no='10'";
	echo $query1;
	$res1 = sqlsrv_query( $conn, $query1, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));
if (sqlsrv_has_rows($res1) == false){

$query2= "insert into production values ( convert(varchar, getdate(), 0),'".$shift."' ,'".$product_order_no."','".$sleeve_no."',".$oc_value.",'".$item_no."'
,'".$Sleeve_qty."','".$actSleeve_qty."','".$rejSleeve_qty."','".$tool_use."','".$mach_no."','".$size."','".$prod_type."',".$die.",".$total_die.",'".$prs_or_pt."','".$op_no."','".$_SESSION["name"]."' ) ;
";

echo $query2;

$res2 = sqlsrv_query( $conn, $query2, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));
}
else{
	
	header("location:PlanFirst.php?production=fail");
	exit;
}
	


/*
$query2= "insert into production values ( '".$_SESSION['date']."','".$shift."' ,'".$product_order_no."','".$sleeve_no."',".$oc_value.",'".$item_no."'
,'".$Sleeve_qty."','".$actSleeve_qty."','".$rejSleeve_qty."','".$tool_use."','".$mach_no."','".$size."','".$prod_type."',".$die.",".$total_die.",'".$prs_or_pt."','".$op_no."' ) ;
";

echo $query2;

$res2 = sqlsrv_query( $conn, $query2, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));
*/

	

	$query3= "update  plann set pl_status='1' where sleeve_no='".$Sleeve_no."'and mach_no='".$_SESSION['machine']."';";

echo "<br>".$query3;
$res3 = sqlsrv_query( $conn, $query3, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));



if($res2 == false ){

	header("location:PlanFirst.php?production=fail");
	exit;

}

	
	



}

			header("location:barcode.php?sleeve_no=".$sleeve_no);




	



    ?>