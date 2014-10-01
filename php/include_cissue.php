<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$month_name = array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

$query = "select distinct month,year from article where volume='$volume' and issue='$issue'";
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

if($num_rows)
{
	$row=mysql_fetch_assoc($result);

	$year=$row['year'];
	$month=$row['month'];

	echo "<span class=\"titlespan\">\n
				<a href=\"cissue.php\">Current Issue<br />\n
				Vol.&nbsp;".intval($volume).",  No.&nbsp;".intval($issue)."<br />\n
				".$month_name{intval($month)}."&nbsp;$year</a><br /><br />\n
				<a href=\"images/issue_full_size.png\" target=\"_blank\">Cover page</a>
			</span>\n";
}

?>
