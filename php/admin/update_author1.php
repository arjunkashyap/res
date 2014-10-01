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
			<div class="archive_title">Edit Title and other details</div>
			<div class="archive_volume">

<?php


include("connect.php");
$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$oldauthid = $_POST['oldauthid'];
$authid = $_POST['authid_up'];
$authorname = $_POST['authorname_up'];
$fname = $_POST['firstname_up'];
$lname = $_POST['lastname_up'];
$affiliation = $_POST['affiliation_up'];
$isfellow = $_POST['fellow_up'];
$merge = $_POST['merge'];

echo "Old ID: $oldauthid<br />";
echo "New Auth ID: $authid<br />";
echo "Authorname: $authorname<br />";
echo "First name: $fname<br />";
echo "Last name: $lname<br />";
echo "Affiliation: $affiliation<br />";
echo "Isfellow: $isfellow<br />";
echo "Merge: $merge<br />";

if($merge)
{
	echo "Articles written by previous author will be merged with the new author<br />";
	//delete the author with oldauthid in author table
	$query = "delete from author where authid='$oldauthid'";
	$result = mysql_query($query);
	if(!($result))
	{
		echo "Can not delete author with authid = $oldauthid <br />";
		echo "Error" . mysql_error();
	}
	mysql_free_result($result);
	
	//update article table and search table with the new author id and author name.
	$query1 = "select authid, authorname, titleid from article where authid like '%$oldauthid%'";	
	$result1 = mysql_query($query1);
	$num_rows1 = mysql_num_rows($result1);
	for($i=0;$i<$num_rows1;$i++)
	{
		$row1=mysql_fetch_assoc($result1);
		$auid=$row1['authid'];			
		$auth=$row1['authorname'];
		$titleid=$row1['titleid'];	
		
		$authid_list = preg_split("/;/",$auid);		
		$auth_list = preg_split("/;/",$auth);

		for($j=0;$j<sizeof($authid_list);$j++)
		{
			if($oldauthid == $authid_list[$j])
			{
				$auth_list[$j] = $authorname;
				$authid_list[$j] = $authid;
				break;
			}		
		}
			
		//preparing new author ids with semicolon seperated
		$new_author_ids = "";		
		for($j=0;$j<sizeof($authid_list);$j++)
		{
			$new_author_ids = $new_author_ids . ";" . $authid_list[$j];
		}
   	    $new_author_ids = preg_replace('/^;/', '', $new_author_ids);
   	    		
		//preparing new author list with semicolon seperated
		$new_author_names = "";		
		for($j=0;$j<sizeof($auth_list);$j++)
		{
			$new_author_names = $new_author_names . ";" . $auth_list[$j];
		}
   	    $new_author_names = preg_replace('/^;/', '', $new_author_names);		

		//update article table with new authids and authornames
	   	$query2 = "update article set
		   authid='$new_author_ids',	
	   	   authorname='$new_author_names'
	   	   where titleid='$titleid'";
	   	$result2 = mysql_query($query2);
		if(!($result2))
		{
			echo "Can not update article table : <br />";
			echo "titleid : $titleid<br />";
			echo "author ids : $new_author_ids<br />";
			echo "Author names : $new_author_names<br />";
			echo "Mysql error : " . mysql_error();
		}
		mysql_free_result($result2);
		
		//update search table with new authids and authornames		
	   	$query3 = "update searchtable set
		   authid='$new_author_ids',	
	   	   authorname='$new_author_names'
	   	   where titleid='$titleid'";
	   	$result3 = mysql_query($query3);
		if(!($result3))
		{
			echo "Can not update article table : <br />";
			echo "titleid : $titleid<br />";
			echo "author ids : $new_author_ids<br />";
			echo "Author names : $new_author_names<br />";
			echo "Mysql error : " . mysql_error();
		}
		mysql_free_result($result3);

	}//for ends here
	mysql_free_result($result1);		
}//if ends here
else
{
	echo "No action will be taken";
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
