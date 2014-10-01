<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/jquery-1.6.1.min.js"></script>
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
			<div class="archive_title">Adding a New Article</div>
			<div class="archive_volume">

<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$month_name = array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

echo "<form method=\"post\" action=\"new_article.php\" id=\"frm2\" onsubmit=\"return validate1()\">";

$query1 = "select distinct volume from article";
$result1 = mysql_query($query1);
$num_rows1 = mysql_num_rows($result1);

$query2 = "select * from feature order by feat_name";
$result2 = mysql_query($query2);
$num_rows2 = mysql_num_rows($result2);
$features = "";

for($i=0;$i<=$num_rows2;$i++)
{
	$row2=mysql_fetch_assoc($result2);
	$features = $features . "<option>" . $row2['feat_name'] . "</option>\n";
}

echo "<table>
<tr>
	<td class=\"fcol\">Volume:&nbsp;&nbsp;</td>
	<td class=\"scol\">";

if($num_rows1)
{

echo "<select name=\"volume\" id=\"vol\">";
	for($i=0;$i<$num_rows1;$i++)
	{
		$row1=mysql_fetch_assoc($result1);
		$volume = $row1['volume'];
		echo "<option value=\"$volume\">$volume</option>";
	}
echo "</select>";
}


echo "</td>
</tr>
<tr>
	<td class=\"fcol\">Issue:&nbsp;&nbsp;</td>
	<td class=\"scol\">
		<div id=\"issue_div\">
			<select name=\"issue\" id=\"issue\">
				<option value=\"\"></option>
				<option value=\"\">01</option>
			</select>
		</div>
	</td>
</tr>
<tr>
	<td class=\"fcol\">Title:&nbsp;&nbsp;</td>
	<td class=\"scol\">
		<input class=\"txtbox\" id=\"tid\" name=\"title\" type=\"text\" value=\"$title\" size=\"55\"/>
	</td>
</tr>
<tr>
	<td class=\"fcol\">Feature:&nbsp;&nbsp;</td>
	<td class=\"scol\"><select class=\"txtbox\" name=\"feature\" id=\"fid\">";
	echo $features;
	echo"</select><br />
</td>
</tr>
<tr>
	<td class=\"fcol\">Starting Page:&nbsp;&nbsp;</td>
	<td class=\"scol\">
		<input class=\"txtbox\" id=\"psid\" name=\"pagestart\" type=\"text\" value=\"$page\" size=\"5\" onkeypress=\"return isNumberKey(event)\"/><br />
	</td>
</tr>
<tr>
	<td class=\"fcol\">Ending Page:&nbsp;&nbsp;</td>
	<td class=\"scol\">
		<input class=\"txtbox\" id=\"peid\" name=\"pageend\" type=\"text\" value=\"$page_end\" size=\"5\" onkeypress=\"return isNumberKey(event)\"/><br />
	</td>
</tr>
<tr>
	<td class=\"fcol\">Abstract:&nbsp;&nbsp;</td>
	<td class=\"scol\">
		<textarea class=\"txtbox\" id=\"absid\" name=\"abstract\" type=\"text\"  rows=\"10\" cols=\"40\">$abstract</textarea><br />
	</td>
</tr>
<tr>
	<td colspan=\"2\" style=\"text-align: center;\">Authors</td>
</tr>
<tr>
	<td></td>
	<td class=\"scol\">
		<input class=\"button\" type=\"button\" value=\"Add\" onclick=\"addRow('mytable')\" />&nbsp;
		<input class=\"button\" type=\"button\" value=\"Delete\" onclick=\"deleteRow('mytable')\"/>&nbsp;
	</td>
</tr>
<tr>
	<td></td>
	<td class=\"scol\">
		<table  id=\"mytable\" class=\"fcol\">";
		
echo"</table>
	<tr>
	<td class=\"fcol\"></td>
	<td><input type=\"submit\" value=\"Add\"></td>
</tr>
</table>
</form>";
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
