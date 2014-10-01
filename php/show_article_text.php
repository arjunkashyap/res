<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

//get the article titleid
$volume = $_GET['volume'];
$issue = $_GET['issue'];
$titleid = $_GET['titleid'];
$page = $_GET['page'];
$text = $_GET['text'];

//update visited count in article table (titleid)
$query1 = "update article set visited=visited+1 where titleid='$titleid'";
$result1 = mysql_query($query1);
if($result1)
{

	//insert new demographic details in demographic_details table
	//Example: Country: INDIA (IN) City: (Unknown city) IP: 59.90.166.158 
	$ip = $_SERVER['REMOTE_ADDR'];
	if($ip != "127.0.0.1")
	{
		$list = file_get_contents("http://api.hostip.info/get_html.php?ip=$ip");
		//echo "<br />" . $list . "<br />";
		$country = "";
		$city = "";
		$locationcode = "";
		
		preg_match_all("/Country:\s(.*)\sCity:\s(.*)\sIP:\s(.*)/",$list,$out,PREG_PATTERN_ORDER);

		if($out[1][0] != "")
		{
			$country = $out[1][0];
		}
		if($out[2][0] != "")
		{
			$city = $out[2][0];
		}
		
		$query2 = "insert into demographic_details values('$ip','$country','$city','$locationcode')";
		$result2 = mysql_query($query2);
		if(!($result2))
		{
			echo "Error in updating demographic_details table <br />";
		}
	}
	
}

//redirect the link to actual article

@header("Location:../Volumes/$volume/$issue/index.djvu?djvuopts&page=$page.djvu&zoom=page&find=$text");

?>
