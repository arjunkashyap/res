<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resonance</title>
<link href="php/style/reset.css" media="screen" rel="stylesheet" type="text/css" />
<link href="php/style/indexstyle.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="page">
	<div class="headertop">
		<div class="left_title">
			<span class="span2">ISSN</span>
			<span class="span1">&nbsp;0971-8044</span>
		</div>
		<div class="right_title">
			<span class="span2">INDIAN ACADEMY OF SCIENCES</span>
		</div>
	</div>
	<div class="header">
		<div id="headnav">
			<ul>
				<li><a href="php/siteindex.php">Site Index</a></li>
				<li>|</li>
				<li><a href="php/contact.php">Contact us</a></li>
			</ul>
		</div>
		<div class="search_div">
			<form method="POST" action="php/search-box-result.php">
				<input id="search_term" name="search_term" type="text" class="search_box" value="Search" onclick="if(this.value=='Search')this.value='';" onblur="if(this.value=='')this.value='Search';"/>
				<input class="search_button" type="submit" value=" ">
			</form>
		</div>
		<div class="title"><img src="php/images/title.png" alt="Resonance" /></div>
		<div class="subtitle">journal of science education</div>
		<nav>
			<div class="arrow_left"></div>
			<div class="arrow_right"></div>
			<ul class="menu">
				<li><a class="active" href="#">Home</a></li>
				<li>
					<a href="php/about.php">About</a>
					<ul>
						<li><a href="php/about.php">About the Journal</a></li>
						<li><a href="php/editorial_board.php">Editorial Board</a></li>
						<li><a href="php/subscribe.php">Subscribe</a></li>
						<li><a href="php/contact.php">Contact Us</a></li>
					</ul>
				</li>
				<li>
					<a href="php/cissue.php">Journal</a>
					<ul>
						<li><a href="php/cissue.php">Current Issue</a></li>
						<li><a href="php/special_issues.php">Special Issues</a></li>
					</ul>
				</li>
				<li><a href="php/volumes.php">Archive</a></li>
			</ul>
			<div class="clearfix"></div>
		</nav>
	</div>
	<div class="mainpage">
<?php


include("php/connect.php");

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
?>
		<div class="ci_holder_mask">
			<div class="ci_column1">
				<?php print_widget("General Article", 1); ?>
				<?php print_widget("Article-in-a-Box", 1); ?>
				<?php print_widget("Series Article", 1); ?>
                <?php print_widget("Feature Article", 1); ?>
				<?php print_widget("Personal Reflections", 1); ?>
			</div>
			<div class="ci_column2">
				<?php print_widget("General Editorial", 1); ?>
				<?php print_widget("Editorial", 1); ?>
				<?php print_widget("Classics", 1); ?>
				<?php print_widget("Face to Face", 1); ?>
				<?php print_widget("Science Smiles", 1); ?>
				<?php print_widget("Classroom", 1); ?>
				<?php print_widget("Book Review", 1); ?>
				<?php print_widget("Think It Over", 1); ?>
				<?php print_widget("Our Readers Write", 1); ?>
				<?php print_widget("Reflections", 1); ?>
				<?php print_widget("Information and Announcements", 1); ?>
			</div>
<?php
echo "
		<div class=\"ci_holder\">
			<div class=\"cimage\">
				<span class=\"c_issue\"><a href=\"php/cissue.php\">CURRENT ISSUE</span></a></span><br />
				<a href=\"php/cissue.php\"><img src=\"php/images/issue.png\" alt=\"Current Issue\" title=\"$title_cv_display\"/></a><br />
				<span class=\"iname\"><a href=\"php/cissue.php\">Vol.&nbsp;".intval($volume).", No.&nbsp;$issue<br />".$month_name{intval($month)}."&nbsp;$year</a></span>
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

			echo "
			<div class=\"pi_holder\">
				<a href=\"php/images/back_full_size.png\" target=\"_blank\" title=\"Click to expand\"><img src=\"php/images/p_image.png\" alt=\"Back Cover\" /></a>
				<br /><span class=\"p_issue\">$title_bcv";
                echo ($text_bcv == '') ? "" : "<br />($text_bcv)";
                echo "</span><br /><div class=\"trule\">&nbsp;</div>
				<span class=\"p_archive\"><a href=\"php/volumes.php\">ARCHIVE</a></span>
			</div>";
?>
		
			</div>		
			<div class="counter">
				<span class="ititle">Visitors</span><br />
				<span class="ititle"><?php include("php/count.php"); ?></span>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="foot_links">
			<div class="foot_links1">
				<span class="foot_link_span"><a href="#">Home</a></span><span class="delim"> | </span>
				<span class="foot_link_span"><a href="php/about.php">About the Journal</a></span><span class="delim"> | </span>
				<span class="foot_link_span"><a href="php/cissue.php">Current Issue</a></span><span class="delim"> | </span>
				<span class="foot_link_span"><a href="php/volumes.php">Archive</a></span>
			</div>
			<div class="foot_links2">
				<span class="foot_link_span"><a href="php/editorial_board.php">Editorial Board</a></span><span class="delim"> | </span>
				<span class="foot_link_span"><a href="php/subscribe.php">Subscribe</a></span><span class="delim"> | </span>
				<span class="foot_link_span"><a href="php/inst_authors.php">Instructions to Authors</a></span>
			</div>
		</div>
	</div>
	<div class="foot_box">
		<div class="left">
			&copy;2013 Indian Academy of Sciences, Bangalore. All Rights Reserved
		</div>
		<div class="right">
			<ul>
				<li><a href="php/termsofuse.php">Terms of Use</a></li>
				<li>|</li>
				<li><a href="php/privacypolicy.php">Privacy Policy</a></li>
				<li>|</li>
				<li><a href="php/contact.php">Contact us</a></li>
			</ul>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</body>

</html>

<?php

function print_widget($feature, $type)
{
include("php/connect.php");

$query_aux = "select featid from feature where feat_name='$feature'";
$result_aux = mysql_query($query_aux);
$row_aux=mysql_fetch_assoc($result_aux);
$featid=$row_aux['featid'];

$query = "select * from article where volume='$volume' and issue='$issue' and featid='$featid' order by page";

$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

if($num_rows > 0)
{
	if($type == 1)
	{
		echo "<div class=\"ci_display\">";
	}
	elseif($type == 2)
	{
		echo "<div class=\"ci_display_news\">";
	}
	echo "		<div class=\"widget_title\">".$feature."</div>
					<div class=\"widget_list\">
						<ul>";

	for($i=1;$i<=$num_rows;$i++)
	{
		$row=mysql_fetch_assoc($result);

		$titleid=$row['titleid'];
		$title=$row['title'];
		$page=$row['page'];
		$page_end=$row['page_end'];
		$authid=$row['authid'];
		$abstract=$row['abstract'];
		
		echo "<li>";
		
		$flnm = "Volumes/$volume/$issue/images/$page.jpg";
		if(file_exists($flnm))
		{
			echo "<img class=\"dimage\" src=\"Volumes/$volume/$issue/images/$page.jpg\" />";
		}
		
		echo "<span class=\"ititle\"><a href=\"php/show_article.php?volume=$volume&issue=$issue&titleid=$titleid&page=$page\">$title</a></span>";
				get_authors($authid);
				echo "<br />";
				echo "<span class=\"idownload\"><a href=\"Volumes/$volume/$issue/".$page."-".$page_end.".pdf\" target=\"_blank\">Full Text(PDF)</a>&nbsp;|&nbsp;<a href=\"Downloads/download_djvu.php?titleid=$titleid\" target=\"_blank\">Full Text(DjVu)</a></span>
			</li>";
	}
	echo "</ul>\n</div>\n</div>";
}

}

function print_cover($title_cv)
{
include("php/connect.php");

echo "<div class=\"ci_display_news\">";
echo "<div class=\"widget_title\">Cover Page</div>
		<div class=\"widget_list\">
			<ul>";

		echo "<li><span class=\"ititle\">$title_cv</span><br /><span class=\"iauthor\"><a href=\"php/images/issue_full_size.png\" target=\"_blank\">Click here to view the cover page</a></span></li>";
echo "</ul>\n</div>\n</div>";
}

function get_authors($authid)
{

if($authid != 0)
{
	echo "<br />&nbsp;&mdash;&nbsp;";
	$aut = preg_split('/;/',$authid);

	echo "<span class=\"iauthor\">";
	$fl = 0;
	foreach ($aut as $aid)
	{
		$query2 = "select * from author where authid=$aid";
		$result2 = mysql_query($query2);
		$num_rows2 = mysql_num_rows($result2);
		if($num_rows2)
		{
			$row2=mysql_fetch_assoc($result2);
			$authorname = $row2['authorname'];
			$fname=$row2['fname'];
			$lname=$row2['lname'];
			$dname = $fname . " " . $lname;
			
			if($fl == 0)
			{
				echo "<a href=\"php/auth.php?authid=$aid&author=$dname\">$dname</a>";
				$fl = 1;
			}
			else
			{
				echo "&nbsp;;&nbsp;<a href=\"php/auth.php?authid=$aid&author=$dname\">$dname</a>";
			}
		}
	}
	echo "</span>";
}

}
?>
