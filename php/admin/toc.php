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
				<li><a href="../volumes.php">Volumes</a></li>
				<li><a href="../articles.php?letter=A">Articles</a></li>
				<li><a href="../authors.php?letter=A">Authors</a></li>
				<li><a href="../features.php">Categories</a></li>
				<li><a href="../search.php">Search</a></li><br /><br />
				<li><a href="http://www.caminova.net/en/downloads/download.aspx?id=1" target="_blank">Get DjVu</a></li>
			</ul>
		</div>
		<div class="archive_holder">
<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$volume=$_GET['vol'];
$issue=$_GET['issue'];

$month_name = array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

$query = "select distinct year,month from article where volume='$volume' and issue='$issue'";
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

if($num_rows)
{
	$row=mysql_fetch_assoc($result);
	$month=$row['month'];
	$year=$row['year'];

	echo "<div class=\"archive_title\">Choose Article<br />Volume&nbsp;".intval($volume)."&nbsp;- Issue&nbsp;".$issue."&nbsp;:&nbsp;".$month_name{intval($month)}."&nbsp;".$year."</div>";
	echo "<div class=\"archive\">";
	echo "<ul>";
}

$query1 = "select * from article where volume='$volume' and issue='$issue' order by page";
$result1 = mysql_query($query1);

$num_rows1 = mysql_num_rows($result1);

if($num_rows1)
{
	for($i=1;$i<=$num_rows1;$i++)
	{
		$row1=mysql_fetch_assoc($result1);

		$title=$row1['title'];
		$titleid=$row1['titleid'];
		$featid=$row1['featid'];
		$feature = get_feature($featid);
		$page=$row1['page'];
		$page_end=$row1['page_end'];
		$authid=$row1['authid'];
		$authorname=$row1['authorname'];
		$abstract=$row1['abstract'];

		if($abstract != "")
		{
			$abstract = preg_replace('/&/','%26',$abstract);
			//echo $abstract . "<br />";
		}
		
		$title1=addslashes($title);
		
		$query11 = "select * from retract where volume='$volume' and issue='$issue' and title='$title1' and page='$page'";
		$result11 = mysql_query($query11);

		$num_rows11 = mysql_num_rows($result11);
	
		if($num_rows11)
		{
			echo "<li>";
			echo "<span class=\"titlespan\"><span class=\"retract\">*$title</span></span><span class=\"authorspan\"> (".intval($page).")</span>";
			if($feature != "")
			{
				echo "<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span><span class=\"featurespan\"><a href=\"feat.php?feature=$feature\">$feature</a></span>";
			}
			
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

						if($fl == 0)
						{
							echo "<span class=\"authorspan\"><a href=\"auth.php?authid=$aid&author=$authorname\">$authorname</a></span>";
							$fl = 1;
						}
						else
						{
							echo "<span class=\"titlespan\">;&nbsp;</span><span class=\"authorspan\"><a href=\"auth.php?authid=$aid&author=$authorname\">$authorname</a></span>";
						}
					}

				}
			}
			echo "<br /><span class=\"titlespan\"><span class=\"retract\">*This paper has been withdrawn from Current Science as the Editors have determined that a significant proportion of the article has been reproduced from the articles published elsewhere by different authors</span></span>";
			echo "</li>";
		}
		else
		{
			echo "<li>";
			//echo "<span class=\"titlespan\"><a href=\"../Volumes/$volume/$issue/index.djvu?djvuopts&page=$page.djvu&zoom=page\" target=\"_blank\">$title</a></span><span class=\"authorspan\"> (".intval($page).")</span>";
			echo "<span class=\"titlespan\"><a href=\"pr_title.php?titleid=$titleid&title=$title&authid=$authid&authorname=$authorname&feature=$feature&featid=$featid&volume=$volume&issue=$issue&year=$year&month=$month&page=$page&page_end=$page_end&abstract=$abstract\">$title</a>";
			if($feature != "")
			{
				echo "<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span><span class=\"featurespan\"><a href=\"feat.php?feature=$feature\">$feature</a></span>";
			}
			
			if(intval($volume) > 99)
			{
				echo "<span class=\"downloadspan\">&nbsp;&nbsp;&nbsp;&nbsp;<a title=\"Download Article\" href=\"../Downloads/download_djvu.php?titleid=$titleid\" target=\"_blank\">DjVu</a>&nbsp;|&nbsp;<a title=\"Download Article\" href=\"../Volumes/$volume/$issue/$page.pdf\" target=\"_blank\">PDF</a></span>";
			}
			else
			{
				echo "<span class=\"downloadspan\">&nbsp;&nbsp;&nbsp;&nbsp;<a title=\"Download Article\" href=\"../Downloads/download_djvu.php?titleid=$titleid\" target=\"_blank\">DjVu</a>&nbsp;|&nbsp;<a title=\"Download Article\" href=\"../Downloads/download_pdf.php?titleid=$titleid\" target=\"_blank\">PDF</a></span>";
			}
			
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

						if($fl == 0)
						{
							echo "<span class=\"authorspan\"><a href=\"pr_author.php?authid=$aid\">$authorname</a></span>";
							$fl = 1;
						}
						else
						{
							echo "<span class=\"titlespan\">;&nbsp;</span><span class=\"authorspan\"><a href=\"pr_author.php?authid=$aid\">$authorname</a></span>";
						}
					}

				}
			}
			echo "</li>";
		}
	}
}

function get_feature($featid)
{
	$query13 = "select feat_name from feature where featid='$featid'";
	$result13 = mysql_query($query13);
	$row13=mysql_fetch_assoc($result13);

	$feature = $row13['feat_name'];
	mysql_free_result($result13);
	return($feature);
}

?>
				</ul>
			</div>
		</div>
		<div class="archive_area">
			<a href="../cissue.php" title="Current Issue"><img src="../images/cur_issue.png" alt="Current Issue"/></a><br />
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
