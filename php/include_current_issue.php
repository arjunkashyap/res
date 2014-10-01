<?php


include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$month_name = array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");



$query_aux1 = "select year, month from current_issue where volume='$volume' and issue='$issue'";
$result_aux1 = mysql_query($query_aux1);
$row_aux1=mysql_fetch_assoc($result_aux1);
$year=$row_aux1['year'];
$month=$row_aux1['month'];

$query_aux4 = "select title from current_issue where type='cv'";
$result_aux4 = mysql_query($query_aux4);
$row_aux4=mysql_fetch_assoc($result_aux4);


$title_cv=$row_aux4['title'];
$title_cv_display = preg_replace("/\<i\>/", "", $title_cv);
$title_cv_display = preg_replace("/\<\/i\>/", "", $title_cv_display);
$title_cv_display = preg_replace("/\<b\>/", "", $title_cv_display);
$title_cv_display = preg_replace("/\<\/b\>/", "", $title_cv_display);
$title_cv_display = preg_replace("/\<sup\>/", "", $title_cv_display);
$title_cv_display = preg_replace("/\<\/sup\>/", "", $title_cv_display);
$title_cv_display = preg_replace("/\<sub\>/", "", $title_cv_display);
$title_cv_display = preg_replace("/\<\/sub\>/", "", $title_cv_display);
echo "
		<div class=\"ci_holder\">
			<div class=\"cimage\">
				<span class=\"c_issue\"><a href=\"cissue.php\">CURRENT ISSUE</span></a></span><br />
				<a href=\"cissue.php\"><img src=\"images/issue.png\" alt=\"Current Issue\" title=\"$title_cv_display\"/></a><br />
				<span class=\"iname\"><a href=\"cissue.php\">Vol.&nbsp;".intval($volume).", No.&nbsp;$issue<br />".$month_name{intval($month)}."&nbsp;$year</a></span>
			</div>";

$query_aux2 = "select * from current_issue where type='fa'";
$result_aux2 = mysql_query($query_aux2);

$num_rows_aux2 = mysql_num_rows($result_aux2);

if($num_rows_aux2 > 0)
{
	echo "<div class=\"cpoints\">\n<ul>";
	
	for($i=1;$i<=$num_rows_aux2;$i++)
	{
		$row_aux2=mysql_fetch_assoc($result_aux2);

		$title_fa=$row_aux2['title'];
		$text_fa=$row_aux2['text'];
		$page_fa=$row_aux2['page'];
		
		if($i == 1)
		{
			echo "<li><a href=\"Volumes/$volume/$issue/$page_fa.pdf\" target=\"_blank\">$title_fa</a></li>\n";
		}
		else
		{
			echo "<div class=\"trule\">&nbsp;</div>\n<li><a href=\"Volumes/$volume/$issue/$page_fa.pdf\" target=\"_blank\">$title_fa</a></li>\n";
		}
		
	}
	echo "</ul>\n</div>";
	
}
$query_aux3 = "select * from current_issue where type='ed'";
$result_aux3 = mysql_query($query_aux3);
$row_aux3=mysql_fetch_assoc($result_aux3);

$title_ed=$row_aux3['title'];
$author_ed=$row_aux3['author'];
$text_ed=$row_aux3['text'];
$page_ed=$row_aux3['page'];

$query_aux5 = "select * from current_issue where type='bcv'";
$result_aux5 = mysql_query($query_aux5);
$row_aux5=mysql_fetch_assoc($result_aux5);

$title_bcv=$row_aux5['title'];
$text_bcv=$row_aux5['text'];

			echo "<div class=\"pi_holder\">
				<a href=\"images/back_full_size.png\" target=\"_blank\" title=\"Click to expand\"><img src=\"images/p_image.png\" alt=\"Back Cover\" /></a>
				<br /><span class=\"p_issue\">$title_bcv<br />($text_bcv)</span><br /><div class=\"trule\">&nbsp;</div>
				<span class=\"p_archive\"><a href=\"volumes.php\">ARCHIVE</a></span>
			</div>
		</div>";
?>
