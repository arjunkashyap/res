<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$month_name = array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

$query = "select distinct month,year from article where volume='$cvolume' and issue='$cissue'";
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

if($num_rows)
{
	$row=mysql_fetch_assoc($result);

	$year=$row['year'];
	$month=$row['month'];

	echo "<span class=\"titlespan\">\n
				<a href=\"cissue.php\">Current Issue<br />\n
				Vol.&nbsp;".intval($cvolume).",  No.&nbsp;".intval($cissue)."<br />\n
				$dt&nbsp;".$month_name{intval($month)}."&nbsp;$year</a><br /><br />\n
				<a href=\"images/issue.png\" target=\"_blank\">Cover page</a>
			</span>\n";
}

?>
