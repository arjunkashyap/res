<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Current Science</title>
<link href="../style/reset.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../style/indexstyle.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="page">
	<div class="headertop">
		<div class="logo">
			<img src="../images/logo.png" alt="IAS Logo"/>
		</div>
		<a href="http://www.ias.ac.in">
		<div class="left_title">
			<span class="span2">INDIAN ACADEMY OF SCIENCES</span>
			<span class="span1">&nbsp;BANGALORE</span>
		</div>
		</a>
		<div class="right_title">
			<span class="span2">CURRENT SCIENCE ASSOCIATION</span>
		</div>
	</div>
	<div class="header">
		<div id="headnav">
			<ul>
				<li><a href="../sitemap.php">Site Map</a></li>
				<li>|</li>
				<li><a href="../terms.php">Terms of Use</a></li>
				<li>|</li>
				<li><a href="../contact.php">Contact us</a></li>
			</ul>
		</div>
		<div class="search_div">
			<form method="POST" action="../search-box-result.php">
				<input id="search_term" name="search_term" type="text" class="search_box" value="Search for an article" onclick="if(this.value=='Search for an article')this.value='';" onblur="if(this.value=='')this.value='Search for an article';"/>
				<input class="search_button" type="submit" value=" ">
			</form>
		</div>
		<div class="title"><img src="../images/title.png" alt="Current Science" /></div>
		<div class="subtitle">A Fortnightly Journal of Research</div>
		<div class="nav">
			<ul>
				<li><a href="../../index.php">Home</a></li>
				<li><a href="../cissue.php">Current Issue</a></li>
				<li><a href="../fcarticles.php">Forthcoming Articles</a></li>
				<li><a href="../splissues.php">Special Issues</a></li>
				<li><a href="../pdf/edboard.pdf" target="_blank">Editorial Board</a></li>
				<li><a href="../volumes.php">Archive</a></li>
				<!--<li><a href="../admin/volumes.php">&nbsp;&nbsp;Admin&nbsp;&nbsp;</a>
					<ul>
						<li><a href="php/admin/volumes.php">Update Articles</a></li>
						<li><a href="php/admin/authors.php?letter=A">Update Authors</a></li>
					</ul>
				</li>
				-->
			</ul>
		</div>
	</div>
	<div class="mainpage">
		<div class="archive_nav">
			<ul>
				<li><a href="../pdf/publish2011.pdf" target="_blank">Instructions to Authors</a></li>
				<li><a href="../advertisement.php" target="_blank">Advertisements</a></li>
				<li><a href="../subscribe.php" target="_blank">Subscribe</a></li>
				<li><a href="../pdf/im2011.pdf" target="_blank">Institutional Members</a></li>
				<li><a href="../reprints.php" target="_blank">Reprints</a></li>
				<li><a href="../reproduce.php" target="_blank">Reproduction Permission</a></li><br /><br />
				<li><a href="http://www.caminova.net/en/downloads/download.aspx?id=1" target="_blank"><img src="php/images/djvu.gif" /></a><br /><a href="http://www.caminova.net/en/downloads/download.aspx?id=1" target="_blank"><span class="djvu_text">Install DjVu plugin</span></a></li><br /><br />
			</ul>
		</div>
		<div class="archive_holder">
			<div class="archive_title1">Archive Management</div>
			<div class="arch_mng">
				<ul>
					<li>Articles:
						<ol>
							<li><a href="volumes.php">Edit an Article</a></li>
							<li><a href="add_article.php">Add a new Article</a></li>
							<li><a href="delete_article.php">Delete an existing Article</a></li>
						</ol>	
					</li>
					<li>Authors:
						<ol>
							<li><a href="authors.php?letter=A">Edit Author Information</a></li>
						</ol>
					</li>
					<li>Categories:
						<ol>
							<li><a href="add_category.php">Add a new Category</a></li>
							<li><a href="del_category.php">Delete an existing Category</a></li>
							<li><a href="merge_cat.php">Merge existing Category</a></li>
						</ol>
					</li>
				</ul>
			</div>
		</div>
		<div class="archive_area">
			<a href="../cissue.php" title="Current Issue"><img src="../images/cur_issue.png" alt="Current Issue"/></a><br />
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
				<a href=\"../images/issue.png\" target=\"_blank\">Cover page</a>
			</span><br /><br /><br />\n";
}

?>
			<div class="counter">
				<span class="titlespan">Visitors</span><br />
				<span class="titlespan">
<?php
include("php/count.php");
?>				
				</span>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="foot_box">
			<div class="left">
				&copy;2011 Indian Academy of Sciences, Bangalore. All Rights Reserved
			</div>
			<div class="right">
				<ul>
					<li><a href="../terms.php">Terms of Use</a></li>
					<li>|</li>
					<li><a href="../policy.php">Privacy Policy</a></li>
					<li>|</li>
					<li><a href="../contact.php">Contact us</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>

</html>
