
<?php

include 'dataConnection.php';  

session_start();

$user = trim(strip_tags($_POST["user"]));
$pass = trim(strip_tags($_POST["pass"]));
$machine = trim(strip_tags($_POST["machine"]));

$_SESSION["machine"] =$machine;

if(str_starts_with($machine, 'DB') || str_starts_with($machine, 'db')){
	$_SESSION["op"]=10;
}
else{
	$_SESSION["op"]=20;
}

$query = "select *,convert(nvarchar(11), getdate(),103) as date,
 case when left(convert(time, getdate()),2) >= '07' and left(convert(time, getdate()),2) < '15' then 'First' 
 else case when left(convert(time, getdate()),2) >= '15' and left(convert(time, getdate()),2) < '23' then 'Second'
 else 'Third' end end as shift 
 from login where empId = '".$user."';";

echo "<br>";
echo $query;

$result = sqlsrv_query( $conn, $query, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));


$query2="select * from mach_master where machine='".$machine."'";
$result2 = sqlsrv_query( $conn, $query2, array(), array( "Scrollable" =>SQLSRV_CURSOR_KEYSET));

if (sqlsrv_has_rows($result2) == false){
	sqlsrv_close($conn) ; 
	echo"invaid machine no";
	 header ("Location: login.php?machineNo=fail");
	exit;
}
	$row2=sqlsrv_fetch_array($result2);
		$_SESSION['url']=$row2['url'];
		$_SESSION['image']=$row2['image'];
echo "<br><br>".$_SESSION['image']."<br><br>";



$num = sqlsrv_num_rows($result);

echo "11111111111";
		
if (sqlsrv_has_rows($result) == false){
	sqlsrv_close($conn) ; 
	echo"login fail";
	 header ("Location: login.php?login=fail");
	exit;
}
else
{
	$row=sqlsrv_fetch_array($result);
	$name=$row["empName"];
	$date=$row['date'];
	$shift=$row['shift'];
	
		$dbpass=$row["password"];
		echo "55555 <br>".$dbpass;
		echo "<br>4444444 <br>".$pass;

		$verify=password_verify($pass, $dbpass);
		
	if($verify)
		{		
echo "22222222222222";
	
			$_SESSION["name"]=$name;
			$_SESSION["date"]=$date;
			$_SESSION["shift"]=$shift;
			
	
			
			header("location:welcome.php");
		
		}
		else{
			sqlsrv_close($conn) ; 
			echo "<br>3333333";

			header ("Location: login.php?login=fail");
			exit;
		}
}
	
?>