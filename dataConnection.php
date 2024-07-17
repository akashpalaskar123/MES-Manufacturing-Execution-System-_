<?php


$serverName = "DESKTOP-EQOF7KT\SQLEXPRESS";
$database = "MES";
$uid = "sa";
$pass = "admin@1234";


$connection = [
	'Database'=>$database,
	'Uid'=>$uid,
	'PWD'=>$pass];


// Create connection
$conn = sqlsrv_connect($serverName,$connection);


// Check connection
if (!$conn) {
	echo"connection failed  <br>" ;
	die(print_r(sqlsrv_errors(),true));
	
}


?>