<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Current Science</title>
<link href="../style/admin.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../style/reset.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/scripts.js"></script>
</head>

<body>
<div class="page">
	<div class="headertop">
		<div class="logo">
			<img src="../images/logo.png" alt="IASy Logo"/>
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
	<div class="mainpage_volume">
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
			<div class="archive_title">Merge Category</div>
			<div class="archive_volume">

<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$category = $_POST['features'];
$new_category = trim($_POST['newcategory']);

$query1 = "select featid from feature where feat_name='$new_category'";
$result1 = mysql_query($query1);
if($result1)
{
	$row1 = mysql_fetch_assoc($result1);
	$featid = $row1['featid']; 
}
else
{
	$query2 = "insert into feature values('$new_category','')";
	$result2 = mysql_query($query2);
	if($result2)
	{
		$query3 = "select featid from feature where feat_name='$new_category'";
		$result3 = mysql_query($query3);
		$row3 = mysql_fetch_assoc($result3);
		$featid = $row3['featid'];
	}
}


echo "feat id for new category is: $featid";

for($i=0;$i<sizeof($category);$i++)
{

	$query4 = "select featid from feature where feat_name='$category[$i]'";
	$result4 = mysql_query($query4);
	$row4 = mysql_fetch_assoc($result4);
	$feat_id = $row4['featid'];

	if($feat_id != $featid)
	{
		$query5 = "update article set featid='$featid' where featid='$feat_id'";
		$result5 = mysql_query($query5);
		if($result5)
		{
			echo "Updated " . mysql_affected_rows() . " rows in article table <br />";
		}
		else
		{
			echo "Error in updation of article table: " . mysql_error();
		}
		
		$query6 = "update searchtable set featid='$featid' where featid='$feat_id'";
		$result6 = mysql_query($query6);
		if($result6)
		{
			echo "Updated " . mysql_affected_rows() . " rows in search table <br />";
		}
		else
		{
			echo "Error in updation of search table: " . mysql_error();
		}

		$query7 = "delete from feature where featid='$feat_id'";
		$result7 = mysql_query($query7);
		if(!($result7))
		{
			echo "Error in deleting a feature :" . mysql_error() . "<br />";
		}
	}
}



?>
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
