<?php
include 'dataConnection.php';  

session_start();
$_SESSION['sleeve']=$_COOKIE['sleveeNo'];


$query1=
"
select plann.date, plann.shift, plann.prod_or_no, plann.sleeve_no, plann.oc_value, plann.item_no, plann.qty_sleeve, plann.tool_use, 
plann.pl_status ,plann.mach_no, plann.op_no, plann.pl_start_dt, plann.pl_end_dt,plann.size,plann.die,plann.total_die,plann.prs_or_pt, cost.cost
from plann
join cost on (cost.item_no = plann.item_no)
where plann.pl_end_dt>getdate() and plann.sleeve_no = '".$_SESSION['sleeve']."'

";


$res = sqlsrv_query( $conn, $query1, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));

      

while($row=sqlsrv_fetch_array($res)){
	

  $results[]= array(
               
                "product_order_no" => $row['prod_or_no'],
                "sleeve_no" => $row['sleeve_no'],
				"size"=>$row['size'],
				"qty"=>$row['qty_sleeve'],
				"op_no"=>$row['op_no'],
				"oc"=>$row['oc_value'],
				"die"=>$row['die'],
				"total_die"=>$row['total_die'],
				"prs_or_pt"=>$row['prs_or_pt'],
				
        
            );
		

}
		
$data =array("sEcho" => 1,
        "iTotalRecords" => sqlsrv_num_rows($res),
        "iTotalDisplayRecords" => sqlsrv_num_rows($res),
          "aaData"=>$results);
		  

echo json_encode($data);

?>