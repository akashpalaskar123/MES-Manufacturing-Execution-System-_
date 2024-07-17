<?php include 'dataConnection.php';  

echo "<table>";
echo "<tr>
<th>id</th>
<th>date&time</th>
</tr>";


$query1=
"select * from test

";
	$result1 = sqlsrv_query( $conn, $query1, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));
	
while($row1=sqlsrv_fetch_array($result1)){

	$phpdate = strtotime( $row1['date'] );
$mysqldate = date( 'd-m-Y ', $phpdate );

	echo "<tr><td >".$row1['id']."</td>";
	echo "<td >".$mysqldate."</td></tr>";

}


echo"</table>"
?>