<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");


$volume = $_GET['volume'];
$nvolume = str_pad($volume,3,"0",STR_PAD_LEFT);

$month_name = array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

$query = "select distinct issue from article where volume='$nvolume'";
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);

if($num_rows)
{
	echo "<select name=\"issue\" id=\"issue\"><br />";

	for($i=0;$i<$num_rows;$i++)
	{
		$row=mysql_fetch_assoc($result);
		$issue = $row['issue'];
		echo "<option value=\"$issue\">$issue</option>";
	}
	echo "</select><br />";
}
else
{
	echo "There are no issues in this volume";
}

?>
