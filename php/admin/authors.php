<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Current Science</title>
<link href="../style/admin.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../style/reset.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="page">
	<div class="headertop">
		<div class="logo">
			<img src="../images/logo.png" alt="IAS Logo"/>
		</div>
		<a href="http://www.ias.ac.in"><div class="left_title">
			<span class="span2">INDIAN ACADEMY OF SCIENCES</span>
			<span class="span1">&nbsp;BANGALORE</span>
		</div></a>
		<div class="right_title">
			<span class="span2">CURRENT SCIENCE ASSOCIATION</span>
		</div>
	</div>
	<div class="header">
		<div id="headnav">
			<ul>
				<li><a href="sitemap.php">Site Map</a></li>
				<li>|</li>
				<li><a href="terms.php">Terms of Use</a></li>
				<li>|</li>
				<li><a href="contact.php">Contact us</a></li>
			</ul>
		</div>
		<div class="search_div">
			<form method="POST" action="search-box-result.php">
				<input id="search_term" name="search_term" type="text" class="search_box" value="Search for an article" onclick="if(this.value=='Search for an article')this.value='';" onblur="if(this.value=='')this.value='Search for an article';"/>
				<input class="search_button" type="submit" value=" ">
			</form>
		</div>
		<div class="title"><img src="../images/title.png" alt="Current Science" /></div>
		<div class="subtitle">A Fortnightly Journal of Research</div>
		<div class="nav">
			<ul>
				<li><a href="../../index.php">Home</a></li>
				<li><a href="cissue.php">Current Issue</a></li>
				<li><a href="fcarticles.php">Forthcoming Articles</a></li>
				<li><a href="splissues.php">Special Issues</a></li>
				<li><a href="pdf/edboard.pdf" target="_blank">Editorial Board</a></li>
				<li><a href="volumes.php">Archive</a></li>
				<!--<li><a class="active" href="volumes.php">&nbsp;&nbsp;Admin&nbsp;&nbsp;</a>
					<ul>
						<li><a href="volumes.php">Update Articles</a></li>
						<li><a href="authors.php?letter=A">Update Authors</a></li>
					</ul>
				</li>
				-->				
			</ul>
		</div>
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
			<div class="archive_title">Choose Author</div>
			<div class="alphabet">
				<span class="letter"><a href="authors.php?letter=A">A</a></span>
				<span class="letter"><a href="authors.php?letter=B">B</a></span>
				<span class="letter"><a href="authors.php?letter=C">C</a></span>
				<span class="letter"><a href="authors.php?letter=D">D</a></span>
				<span class="letter"><a href="authors.php?letter=E">E</a></span>
				<span class="letter"><a href="authors.php?letter=F">F</a></span>
				<span class="letter"><a href="authors.php?letter=G">G</a></span>
				<span class="letter"><a href="authors.php?letter=H">H</a></span>
				<span class="letter"><a href="authors.php?letter=I">I</a></span>
				<span class="letter"><a href="authors.php?letter=J">J</a></span>
				<span class="letter"><a href="authors.php?letter=K">K</a></span>
				<span class="letter"><a href="authors.php?letter=L">L</a></span>
				<span class="letter"><a href="authors.php?letter=M">M</a></span>
				<span class="letter"><a href="authors.php?letter=N">N</a></span>
				<span class="letter"><a href="authors.php?letter=O">O</a></span>
				<span class="letter"><a href="authors.php?letter=P">P</a></span>
				<span class="letter"><a href="authors.php?letter=Q">Q</a></span>
				<span class="letter"><a href="authors.php?letter=R">R</a></span>
				<span class="letter"><a href="authors.php?letter=S">S</a></span>
				<span class="letter"><a href="authors.php?letter=T">T</a></span>
				<span class="letter"><a href="authors.php?letter=U">U</a></span>
				<span class="letter"><a href="authors.php?letter=V">V</a></span>
				<span class="letter"><a href="authors.php?letter=W">W</a></span>
				<span class="letter"><a href="authors.php?letter=X">X</a></span>
				<span class="letter"><a href="authors.php?letter=Y">Y</a></span>
				<span class="letter"><a href="authors.php?letter=Z">Z</a></span>
			</div>
			<div class="archive">
				<ul>
<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$letter=$_GET['letter'];

$query = "select * from author where authorname like '$letter%' order by authorname";
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

if($num_rows)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		$row=mysql_fetch_assoc($result);

		$authid=$row['authid'];
		$authorname=$row['authorname'];
		$isfellow=$row['isfellow'];

		echo "<li>";
		echo "<span class=\"authorspan\"><a href=\"pr_author.php?authid=$authid\">$authorname</a></span>";

		if($isfellow == 1)
		{
			echo"&nbsp;&nbsp;<span class=\"titlespan\"><a href=\"fellow.php\">(Fellow of the Indian Academy of Sciences)</a></span>";
		}
		echo "</li>";
	}
}

?>
				</ul>
			</div>
		</div>
		<div class="archive_area">
			<a href="cissue.php" title="Current Issue"><img src="../images/cur_issue.png" alt="Current Issue"/></a><br />
<?php
include("include_cissue.php");
?>
		</div>
	</div>
	<div class="footer">
		<div class="foot_box">
			<div class="left">
				&copy;2011 Indian Academy of Sciences, Bangalore. All Rights Reserved
			</div>
			<div class="right">
				<ul>
					<li><a href="terms.php">Terms of Use</a></li>
					<li>|</li>
					<li><a href="policy.php">Privacy Policy</a></li>
					<li>|</li>
					<li><a href="contact.php">Contact us</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>

</html>
