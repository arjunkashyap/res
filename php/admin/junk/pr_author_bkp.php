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
				<li><a class="active" href="volumes.php">&nbsp;&nbsp;Admin&nbsp;&nbsp;</a>
					<ul>
						<li><a href="volumes.php">Update Articles</a></li>
						<li><a href="volumes.php">Update Authors</a></li>
					</ul>
				</li>
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
			<div class="archive_title">Edit Author details</div>
			<div class="archive_volume">


<?php

$authid = $_GET['authid'];
	
//echo "Author Page<br />";
//echo "Author ID: $authid<br />";

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$month_name = array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

$query = "select *  from author where authid='$authid'";
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);

if($num_rows)
{
	$row=mysql_fetch_assoc($result);
	$authorname = $row['authorname'];
	$fname = $row['fname'];
	$lname = $row['lname'];
	$isfellow = $row['isfellow'];
	$affiliation = $row['affiliation'];
}

mysql_free_result($result);

echo "<form method=\"POST\" action=\"update_author.php\">
		<input name=\"authid_up\" type=\"hidden\" value=\"$authid\" />
<table>
<tr>
	<td class=\"fcol\">Full Name:&nbsp;&nbsp;</td>
	<td class=\"scol\">
		<input class=\"txtbox\" id=\"auname\" name=\"authorname_up\" type=\"text\" value=\"$authorname\" size=\"60\"/><br />	
	</td>
</tr>
</tr>
<tr>
	<td class=\"fcol\">First Name:&nbsp;&nbsp;</td>
	<td class=\"scol\">
		<input class=\"txtbox\" id=\"fnid\" name=\"firstname_up\" type=\"text\" value=\"$fname\" size=\"30\"/><br />
	</td>
</tr>
<tr>
	<td class=\"fcol\">Last Name:&nbsp;&nbsp;</td>
	<td class=\"scol\">
		<input class=\"txtbox\" id=\"snid\" name=\"lastname_up\" type=\"text\" value=\"$lname\" size=\"30\"/><br />
	</td>
</tr>
<tr>
	<td class=\"fcol\">Affiliation:&nbsp;&nbsp;</td>
	<td class=\"scol\">
		<textarea class=\"txtbox\" id=\"affid\" name=\"affiliation_up\" type=\"text\"  rows=\"10\" cols=\"40\">
			$affiliation
		</textarea><br />
	</td>
</tr>
<tr>
	<td class=\"fcol\">Isfellow:&nbsp;&nbsp;</td>
	<td class=\"scol\">";

		if($isfellow == 1)
		{
			echo "<input name=\"fellow_up\" type=\"radio\" value=\"1\" id=\"isfy\" CHECKED/>&nbsp;&nbsp;Yes&nbsp;&nbsp;
			<input name=\"fellow_up\" type=\"radio\" value=\"0\" id=\"isfn\"/>&nbsp;&nbsp;No&nbsp;&nbsp;";
		}
		else
		{
			echo "<input name=\"fellow_up\" type=\"radio\" value=\"1\" id=\"isfy\"/>&nbsp;&nbsp;Yes&nbsp;&nbsp;
			<input name=\"fellow_up\" type=\"radio\" value=\"0\" id=\"isfn\" CHECKED/>&nbsp;&nbsp;No&nbsp;&nbsp;";			
		}


echo "</td>
</tr>
<tr>
	<td class=\"fcol\"></td>
	<td class=\"scol\"><input type=\"submit\" value=\"Update\"></td>
</tr>
</table>
</form>";
	
?>
			</div>
		</div>
		<div class="archive_area">
			<a href="../cissue.php" title="Current Issue"><img src="../images/cur_issue.png" alt="Current Issue"/></a><br />
<?php
include("../include_cissue.php");
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
