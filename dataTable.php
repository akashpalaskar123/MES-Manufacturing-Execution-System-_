<?php
include 'dataConnection.php';  

session_start();


$query = "select * from login  where empName='" . $_SESSION["name"] ."'";


$res = sqlsrv_query( $conn, $query, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));

      

while($row=sqlsrv_fetch_array($res)){
	

  $results[]= array(
                "id" =>$row['empId'],
                "name" => $row['empName'],
                "age" => $row['age'],
                "email" => $row['email'],
				"status"=>$row['activeStatus']
               
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