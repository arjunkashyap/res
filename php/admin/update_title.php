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


//updated values
$title_up = $_POST["title_up"];
$feature_up = $_POST["feature_up"];
$featid = get_featid($feature_up);
$pagestart_up = $_POST["pagestart_up"];
$pageend_up = $_POST["pageend_up"];
$abstract_up = $_POST["abstract"];
$retract = $_POST["retract"];
$auth_list = $_POST["auth"];

//Values which does not change
$titleid = $_POST['titleid_up'];
$authid  = $_POST['authid_up']; //old author ids (incase)
$volume  = $_POST['volume_up'];
$issue   = $_POST['issue_up'];


$fl = 0;

if($title_up == "")
{
	$error_msg = "Title should not be empty<br />";
	$fl = 1;
}
if( ((!(ctype_digit($pagestart_up))) && ($pagestart_up == "")) )
{
	$error_msg = $error_msg . "Page start should be a numerical value<br />";
	$fl = 1;
}
if( (!(ctype_digit($pageend_up))) && ($pageend_up == "") )
{
	$error_msg = $error_msg . "Page end should be a numerical value<br />";
	$fl = 1;
}
if($pagestart_up > $pageend_up) 
{
	$error_msg = $error_msg . "Page start should be less than page end<br />";
	$fl = 1;
}
if($fl)
{
	echo $error_msg . "<br />";
	echo "Go back and enter correct values<br />";
}
elseif($retract == "Y")
{
	//Article has been retracted
	//echo "Code for Article retract";
	$pagestart_up = str_pad($pagestart_up,4,"0",STR_PAD_LEFT);
	$pageend_up = str_pad($pageend_up,4,"0",STR_PAD_LEFT);
	
	$query4 = "insert into retract values('$title_up','$pagestart_up','$pageend_up','$volume','$issue')";
	$result4 = mysql_query($query4);
	if(!$result4)
	{
		echo "Error in inserting into retract table: " . mysql_error();
	}
	else
	{
		echo "Aarticle has been successfully retracted <br />";
	}
	mysql_free_result($result4);
}
else
{	
/*
	echo "Title ID-->" . $titleid . "<br />";
	echo "Title-->" . $title_up . "<br />";
	echo "Author ID-->" . $authid . "<br />";
	echo "Volume-->" . $volume . "<br />";
	echo "Issue-->" . $issue . "<br />";
	echo "Feature-->" . $feature_up . "<br />";
	echo "Page Start-->" . $pagestart_up . "<br />";
	echo "Page End-->" . $pageend_up . "<br />";
	echo "Abstract-->" . $abstract_up . "<br />";
	echo "Retract-->" . $retract . "<br />";
*/

$new_authids = "";
$new_author_names = "";

//Prepare authids
	for($i=0;$i<sizeof($auth_list);$i++)
	{
		if($auth_list[$i] != "")
		{
			$query = "select authid from author where authorname='$auth_list[$i]'";
			$result = mysql_query($query);
			$num_rows = mysql_num_rows($result);
			if($num_rows)
			{
				$row=mysql_fetch_assoc($result);
				if($new_authids == "")
				{
					$new_authids =  $row['authid'];
					$new_author_names = $auth_list[$i];
				}
				else
				{
					$new_authids = $new_authids . ";" . $row['authid'];
					$new_author_names = $new_author_names .";" . $auth_list[$i];					
				}	
			}
			else
			{
				//algorithm to add new author to author table
				//echo "New Author-->" . $auth_list[$i] . "<br />";

				$query1 = "insert into author values('$auth_list[$i]','','','','','')";
				$result1 = mysql_query($query1);
				if(!$result1)
				{
					echo "Can't insert new author $auth_list[$i] into auhor table: ". mysql_error();
				}
				else
				{
					//After successully inserting new author. 
					//Get the auhtid of new author to concatinate with $new_authids
					$query2 = "select authid from author where authorname='$auth_list[$i]'";
					$result2 = mysql_query($query2);
					$num_rows2 = mysql_num_rows($result2);
					if($num_rows2)
					{
						$row2=mysql_fetch_assoc($result2);
						if($new_authids == "")
						{
							$new_authids =  $row2['authid'];
							$new_author_names = $auth_list[$i];							
						}
						else
						{
							$new_authids = $new_authids . ";" . $row2['authid'];
							$new_author_names = $new_author_names . ";" . $auth_list[$i];
						}	
					}
					mysql_free_result($result2);		
				}
				mysql_free_result($result1);
			}
			mysql_free_result($result);
			echo $auth_list[$i] . "<br />";
		}
	}//for ends here
//echo $new_authids;

echo "Original author ids $authid <br />";
echo "New set of author ids $new_authids <br />";
if(($authid != "") && ($authid != "0"))
{
	$alist = preg_split('/;/',$new_authids);
	$blist = preg_split('/;/',$authid);

	for($i=0;$i<sizeof($blist);$i++)
	{
		$pattern = "/$blist[$i]/";
		if(!(preg_match($pattern,$new_authids)))
		{
			//echo $blist[$i] . " has been deleted <br />";
			$query7 = "select * from article where authid like '%$blist[$i]%'";
			$result7 = mysql_query($query7);
			$num_rows7 = mysql_num_rows($result7);
			if($num_rows7 == 1)
			{
				$query8 = "delete from author where authid='$blist[$i]'";
				$result8 = mysql_query($query8);
				if($result8)
				{
					echo  "Successfully deleted " . mysql_affected_rows() . " author from author table <br />";	
				}
				else
				{
					echo "Error in author deletion: " . mysql_error() . " <br />";
				}
				mysql_free_result($result8);
			}
			mysql_free_result($result7);		
		}
	}

}

//Query to update article table
$pagestart_up = str_pad($pagestart_up,4,"0",STR_PAD_LEFT);
$pageend_up = str_pad($pageend_up,4,"0",STR_PAD_LEFT);

$query5 = "update article set
title = '$title_up',
authid = '$new_authids',
authorname = '$new_author_names',
featid = '$featid',
page = '$pagestart_up',
page_end = '$pageend_up',
abstract = '$abstract_up'
where titleid='$titleid' and volume='$volume' and issue='$issue'";

$result5 = mysql_query($query5);
if(!$result5)
{
	echo "can not update article table: ".  mysql_error() . "<br />";
}
else
{
	echo "Article table has been updated <br />";
}
mysql_free_result($result5);

//Query to update both search table
$query6 = "update searchtable set
title = '$title_up',
authid = '$new_authids',
authorname = '$new_author_names',
featid = '$featid',
page = '$pagestart_up'
where titleid='$titleid' and volume='$volume' and issue='$issue'";

$result6 = mysql_query($query6);
if(!$result6)
{
	echo "can not update Search table: ".  mysql_error() . "<br />";
}
else
{
	echo "Search table has been updated <br />";
}
mysql_free_result($result6);

}//else ends here

function get_featid($feature_up)
{
	$query13 = "select featid from feature where feat_name='$feature_up'";
	$result13 = mysql_query($query13);
	$row13=mysql_fetch_assoc($result13);
	$featid = $row13['featid'];
	mysql_free_result($result13);
	return($featid);
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
