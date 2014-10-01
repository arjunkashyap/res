<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resonance</title>
<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />
<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
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
				<li><a href="siteindex.php">Site Index</a></li>
				<li>|</li>
				<li><a href="contact.php">Contact us</a></li>
			</ul>
		</div>
		<div class="search_div">
			<form method="POST" action="search-box-result.php">
				<input id="search_term" name="search_term" type="text" class="search_box" value="Search" onclick="if(this.value=='Search')this.value='';" onblur="if(this.value=='')this.value='Search';"/>
				<input class="search_button" type="submit" value=" ">
			</form>
		</div>
		<div class="title"><img src="images/title.png" alt="Resonance" /></div>
		<div class="subtitle">journal of science education</div>
		<nav>
			<div class="arrow_left"></div>
			<div class="arrow_right"></div>
			<ul class="menu">
				<li><a class="active" href="../index.php">Home</a></li>
				<li>
					<a href="about.php">About</a>
					<ul>
						<li><a href="about.php">About the Journal</a></li>
						<li><a href="editorial_board.php">Editorial Board</a></li>
						<li><a href="subscribe.php">Subscribe</a></li>
						<li><a href="contact.php">Contact Us</a></li>
					</ul>
				</li>
				<li>
					<a href="cissue.php">Journal</a>
					<ul>
						<li><a href="cissue.php">Current Issue</a></li>
						<li><a href="special_issues.php">Special Issues</a></li>
					</ul>
				</li>
				<li><a href="volumes.php">Archive</a></li>
			</ul>
			<div class="clearfix"></div>
		</nav>
	</div>
	<div class="mainpage">
		<div class="archive_nav">
			<ul>
				<li><a href="volumes.php">Volumes</a></li>
				<li><a href="articles.php?letter=A">Articles</a></li>
				<li><a href="authors.php?letter=A">Authors</a></li>
				<li><a href="features.php">Categories</a></li>
				<li><a href="search.php">Search</a></li><br /><br />
				<li><a href="http://www.caminova.net/en/downloads/download.aspx?id=1" target="_blank">Get DjVu</a></li>
			</ul>
		</div>
		<div class="archive_holder">
<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$feat_name=$_GET['feature'];
$featid=$_GET['featid'];

$month_name = array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

echo "<div class=\"archive_title\">Category&nbsp;:&nbsp;$feat_name</div>";
echo "<div class=\"archive\">";
echo "<ul>";


$query1 = "select * from article where featid='$featid' order by volume, issue, page";
$result1 = mysql_query($query1);

$num_rows1 = mysql_num_rows($result1);

if($num_rows1)
{
	for($i=1;$i<=$num_rows1;$i++)
	{
		$row1=mysql_fetch_assoc($result1);

		$title=$row1['title'];
		$titleid=$row1['titleid'];
		$page=$row1['page'];
		$authid=$row1['authid'];
		$volume=$row1['volume'];
		$issue=$row1['issue'];
		$year=$row1['year'];
		$month=$row1['month'];
		$page_end=$row1['page_end'];
		
		$title1=addslashes($title);
				
		echo "<li>";

		//echo "<span class=\"titlespan\"><a href=\"../Volumes/$volume/$issue/index.djvu?djvuopts&page=$page.djvu&zoom=page\" target=\"_blank\">$title</a></span>";

		echo "<span class=\"titlespan\"><a target=\"_blank\" href=\"show_article.php?volume=$volume&issue=$issue&titleid=$titleid&page=$page\">$title</a></span>";
		echo "<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span><span class=\"yearspan\"><a href=\"toc.php?vol=$volume&issue=$issue\">" . $month_name{intval($month)}."&nbsp;".$year.",&nbsp;".intval($volume)."&nbsp;(".$issue.")</a></span>";
		
		echo "<span class=\"downloadspan\">&nbsp;&nbsp;&nbsp;&nbsp;<a title=\"Download Article\" href=\"../Downloads/download_djvu.php?titleid=$titleid\" target=\"_blank\">DjVu</a>&nbsp;|&nbsp;<a title=\"Download Article\" href=\"../Volumes/$volume/$issue/".$page."-".$page_end.".pdf\" target=\"_blank\">PDF</a></span>";
				
		if($authid != 0)
		{

			echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;";
			$aut = preg_split('/;/',$authid);

			$fl = 0;
			foreach ($aut as $aid)
			{
				$query2 = "select * from author where authid=$aid";
				$result2 = mysql_query($query2);

				$num_rows2 = mysql_num_rows($result2);

				if($num_rows2)
				{
					$row2=mysql_fetch_assoc($result2);

					$authorname=$row2['authorname'];
					$isfellow=$row2['isfellow'];
					$fname=$row2['fname'];
					$lname=$row2['lname'];
					$dname = $fname . " " . $lname;

					if($fl == 0)
					{
						echo "<span class=\"authorspan\"><a href=\"auth.php?authid=$aid&author=$dname\">$dname</a></span>";
						$fl = 1;
					}
					else
					{
						echo "<span class=\"titlespan\">;&nbsp;</span><span class=\"authorspan\"><a href=\"auth.php?authid=$aid&author=$dname\">$dname</a></span>";
					}
				}

			}
		}
		echo "</li>\n";
	}
}

?>
				</ul>
			</div>
		</div>
		<div class="archive_area">
			<a href="cissue.php" title="Current Issue"><img src="images/cur_issue.png" alt="Current Issue"/></a><br />
<?php
include("include_cissue.php");
?>
		</div>
	</div>
	<?php include("include_footer.php"); ?>
</div>
</body>

</html>
