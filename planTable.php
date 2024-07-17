<?php
include 'dataConnection.php';  

session_start();


$query = "select * from plann where pl_end_dt>getdate() ";

if($_SESSION["op"]==10){

$query1=
"

exec Getplan;1 @machine='".$_SESSION['machine']."'

";


}
else
{
$query1=
"

exec Getplan;2 @machine='".$_SESSION['machine']."'


";

}
$res = sqlsrv_query( $conn, $query1, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));

      

while($row=sqlsrv_fetch_array($res)){
	

  $results[]= array(
                "date" =>$row['date'],
                "shift" => $row['shift'],
                "product_order_no" => $row['prod_or_no'],
                "sleeve_no" => $row['sleeve_no'],
				"oc_value"=>$row['oc_value'],
				"item_no"=>$row['item_no'],
				"qty_sleeve"=>$row['qty_sleeve'],
				"tool_use"=>$row['tool_use'],
				"pl_status"=>$row['pl_status'],
				"mach_no"=>$row['mach_no'],
				"op_no"=>$row['op_no'],
				"pl_start_dt"=>$row['pl_start_dt'],
				"pl_end_dt"=>$row['pl_end_dt'],
				"cost"=>$row['cost']
				
               
            );
	
	
				 
				

}

$data =array("sEcho" => 1,
        "iTotalRecords" => sqlsrv_num_rows($res),
        "iTotalDisplayRecords" => sqlsrv_num_rows($res),
          "aaData"=>$results);
		  
		  

		  
		  
/*
  $results=array(
      "sEcho" => 1,
        "iTotalRecords" => sqlsrv_num_rows($res),
        "iTotalDisplayRecords" => sqlsrv_num_rows($res),
          "aaData"=>$data);*/
		  

echo json_encode($data);

?>