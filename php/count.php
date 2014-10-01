 <?php

include("connect_counter.php");

if(isset($_SESSION['visitor_number']))
{
	echo $_SESSION['visitor_number'];
}
else
{
	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
  
	$update_query= "update counter set count=count+1";
	$result = mysql_query($update_query);
 
	$pick = "select count from counter";
	$pick_result = mysql_query($pick);
	$num_results = mysql_num_rows($pick_result);
	
	if($num_results)
	{
		$row = mysql_fetch_assoc($pick_result);
		$_SESSION['visitor_number'] = $row['count'];
		echo $_SESSION['visitor_number'];
	}	
	mysql_close($db);
}
?>
