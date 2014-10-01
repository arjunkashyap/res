<?php
include("../php/connect.php");

$titleid=$_GET['titleid'];

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$query = "select * from article where titleid='$titleid'";
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

if($num_rows)
{
		$row=mysql_fetch_assoc($result);
		$page=$row['page'];
		$page_end=$row['page_end'];
		$volume = $row['volume'];
		$issue = $row['issue'];

		
		$cmd = "djvm -c article_" . $titleid . ".djvu ";

		$query1 = "select * from testocr where volume='$volume' and issue='$issue' and cur_page between '$page' and '$page_end' order by cur_page";
		$result1 = mysql_query($query1);

		$num_rows1 = mysql_num_rows($result1);

		if($num_rows1)
		{
			for($i=1;$i<=$num_rows1;$i++)
			{	
				$row1=mysql_fetch_assoc($result1);
				$cur_page=$row1['cur_page'];		
				$cmd = $cmd . "../Volumes/$volume/$issue/" . $cur_page . ".djvu ";
			}
			system("$cmd");			
			system("chmod -R 777 ../Downloads");
			echo "<html>";
			echo "<head>";
			echo "</head>";
			echo "<body><a href=\"article_$titleid.djvu?djvuopts&toolbar=always-+save\">Click here to download the article</a></body>";
			echo "</html>";

		}	
}

?>
