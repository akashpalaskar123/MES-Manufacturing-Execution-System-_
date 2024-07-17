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
 <title>All Plan</title>
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

	
<form  align="right" action ="logoutPage.php" style="margin-bottom: 11;" method="post">
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

 
  echo"
 <button  class='reprint' type='submit' 
 formaction='reprint.php ' > Reprint </button>&nbsp&nbsp   
 ";
 
 /*
echo"
 <button  class='botton' type='submit' 
 style='float: right;    height: 30px;     background-color: skyblue;    width: 100px;' 
 formaction='reprint.php '> Reprint </button>&nbsp&nbsp                            
 
";
*/

 ?>
</div>

<?php
		if (isset($_GET['production'])){
	
		echo"<p style='color:red; font-size:30;'>Production Entry Failed</p>";

}
?>

<h4>Production Plan</h4>

<table id="plan" class="display" style="width:98%">

<thead>
<tr>

<th>Date &nbsp & &nbsp Shift</th>
<th>Production Order No</th>
<th>Sleeve No</th>
<th>OC Value</th>
<th>Item  No</th>
<th>Tool Use</th>


<th>Select</th>

</tr>
</thead>

</table>

<script>
$(document).ready(function() {
  var table =  $('#plan').DataTable( {

		 "lengthChange": false,
			"ordering": false,
        "sAjaxSource": "planTable.php",
		"aoColumns": [
						
						
                         { "data": null , 
							"mRender" : function ( data, type, full ) 
							{ if(full['shift']=='1'){
								return full['date']+'&nbsp , &nbsp First';}

							 
							else if(full['shift']=='2'){
								return full['date']+'&nbsp , &nbsp Second';}
							

							 
								else {
								return full['date']+'&nbsp , &nbsp Third';}
							 
							}
						},
						
                        { mData: 'product_order_no' },
						{ mData: 'sleeve_no' },
						{ mData: 'oc_value'},
						{ mData: 'item_no' },
                        { mData: 'tool_use' },
				
						
						
						
						{	
						
						defaultContent: "<button class='bnt'>select</button>",
						},

						
					 ],		  
					 
					  "rowCallback": function( row, data, index  ) {
						if ( data.shift == '1' ) 
						{
							$(row).find('td:eq(0)').css('background-color', '9FEBE9');//blue
									
								}
						
						else if  (data.shift == '2' ) 
						{
							$(row).find('td:eq(0)').css('background-color', '8EEC92');//green
												
						}
						else{
							$(row).find('td:eq(0)').css('background-color', 'unset');
						}
						
						if(data.cost=="HV")
						{
								sessionStorage.setItem("cost", "HV");
							$(row).find('td').css('color', 'FF0000');
						}
						
									},
									
								} );
								
				
	
	/*		$('td', table.cell(0, 0)).css('background-color', 'Red');*/
	

	
 $('#plan tbody').on('click', 'button', function () 
{
	
	
	
		var cur_row=$(this).parents('tr');
        var data = table.row(cur_row).data();
		 var item =data.item_no;
		 var sleev =data.sleeve_no;

	 
		 document.cookie = "sleveeNo ="+sleev;
		
		
		
		if(data.shift=="1")
		{
				var url="selectPlan.php?shift=first&item="+item;

		}
		else if(data.shift=="2")
		{
				
				var url ="selectPlan.php?shift=second&item="+item;

		}
		else
		{
				var url="selectPlan.php?shift=third&item="+item;

		}
		 


		
		
		parent.location=url;
 });								
								
	
								
} );

</script>

<br><br>
</form>
</center>
</body>
</html>