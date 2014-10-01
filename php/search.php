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
			<div class="archive_title">Search</div>
			<div class="archive_search">
				<table>
					<form method="POST" action="search-result.php">
					<tr>
						<td class="left"><span class="titlespan">Author</span></td>
						<td class="right"><input name="author" type="text" class="titlespan" id="textfield1" /></td>
					</tr>
					<tr>
						<td class="left"><span class="titlespan">Title</span></td>
						<td class="right"><input name="title" type="text" class="titlespan" id="textfield2" /></td>
					</tr>
					<tr>
						<td class="left"><span class="titlespan">Category</span></td>
						<td class="right">
							<select name="featid" class="titlespan">
<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$query1 = "select * from feature order by feat_name";
$result1 = mysql_query($query1);

$num_rows1 = mysql_num_rows($result1);

if($num_rows1)
{
	for($i=1;$i<=$num_rows1;$i++)
	{
		$row1=mysql_fetch_assoc($result1);

		$feature=$row1['feat_name'];
		$featid=$row1['featid'];
		//echo "$feature";
		echo "<option value=\"$featid\">$feature</option>";
	}
}

?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="left"><span class="titlespan">Words</span></td>
						<td class="right"><input name="text" type="text" class="titlespan" id="textfield3" /></td>
					</tr>   
					<tr>
						<td class="left">&nbsp;</td>
						<td class="right">
							<input type="radio" name="bl" value="and" CHECKED /><span class="titlespan">&nbsp;All these words</span>
							<input type="radio" name="bl" value="or" /><span class="titlespan">&nbsp;Any of these words</span>
						</td>
					</tr>
					<tr>
						<td class="left">
							<span class="titlespan">Period</span>
						</td>
						<td class="right">
							<select name="year1" class="titlespan">
								<option value=""></option>


<?php

$query = "select distinct year from article order by year";
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

if($num_rows)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		$row=mysql_fetch_assoc($result);

		$year=$row['year'];
		echo "<option value=\"$year\">$year</option>";
	}
}

?>
							</select>
							<span class="titlespan" >&nbsp;to&nbsp;</span>
							<select name="year2" class="titlespan">
								<option value=""></option>

<?php
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

if($num_rows)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		$row=mysql_fetch_assoc($result);

		$year=$row['year'];
		echo "<option value=\"$year\">$year</option>";
	}
}

?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="left">&nbsp;</td>
						<td class="right">
							<input name="button1" type="submit" class="titlespan" id="button" value="Search"/>
							<input name="button2" type="reset" class="titlespan" id="button" value="Reset"/>
						</td>
					</tr>
					</form>
				</table>
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
