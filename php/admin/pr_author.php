<?php

include("connect.php");
$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">

<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>Current Science</title>
<link href=\"../style/admin.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"../style/reset.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
<script type=\"text/javascript\" src=\"../js/scripts.js\"></script>
</head>

<body>
<div class=\"page\">
	<div class=\"headertop\">
		<div class=\"logo\">
			<img src=\"../images/logo.png\" alt=\"IASy Logo\"/>
		</div>
		<a href=\"http://www.ias.ac.in\"><div class=\"left_title\">
			<span class=\"span2\">INDIAN ACADEMY OF SCIENCES</span>
			<span class=\"span1\">&nbsp;BANGALORE</span>
		</div></a>
		<div class=\"right_title\">
			<span class=\"span2\">CURRENT SCIENCE ASSOCIATION</span>
		</div>
	</div>
	<div class=\"header\">
		<div id=\"headnav\">
			<ul>
				<li><a href=\"../sitemap.php\">Site Map</a></li>
				<li>|</li>
				<li><a href=\"../terms.php\">Terms of Use</a></li>
				<li>|</li>
				<li><a href=\"../contact.php\">Contact us</a></li>
			</ul>
		</div>
		<div class=\"search_div\">
			<form method=\"POST\" action=\"../search-box-result.php\">
				<input id=\"search_term\" name=\"search_term\" type=\"text\" class=\"search_box\" value=\"Search for an article\" onclick=\"if(this.value=='Search for an article')this.value='';\" onblur=\"if(this.value=='')this.value='Search for an article';\"/>
				<input class=\"search_button\" type=\"submit\" value=\" \">
			</form>
		</div>
		<div class=\"title\"><img src=\"../images/title.png\" alt=\"Current Science\" /></div>
		<div class=\"subtitle\">A Fortnightly Journal of Research</div>
		<div class=\"nav\">
			<ul>
				<li><a href=\"../../index.php\">Home</a></li>
				<li><a href=\"../cissue.php\">Current Issue</a></li>
				<li><a href=\"../fcarticles.php\">Forthcoming Articles</a></li>
				<li><a href=\"../splissues.php\">Special Issues</a></li>
				<li><a href=\"../pdf/edboard.pdf\" target=\"_blank\">Editorial Board</a></li>
				<li><a href=\"../volumes.php\">Archive</a></li>
				<!--<li><a class=\"active\" href=\"volumes.php\">&nbsp;&nbsp;Admin&nbsp;&nbsp;</a>
					<ul>
						<li><a href=\"volumes.php\">Update Articles</a></li>
						<li><a href=\"authors.php?letter=A\">Update Authors</a></li>
					</ul>
				</li>
				-->
			</ul>
		</div>
	</div>
	<div class=\"mainpage_volume\">
		<div class=\"archive_nav\">
			<ul>
				<li><a href=\"../volumes.php\">Volumes</a></li>
				<li><a href=\"../articles.php?letter=A\">Articles</a></li>
				<li><a href=\"../authors.php?letter=A\">Authors</a></li>
				<li><a href=\"../features.php\">Categories</a></li>
				<li><a href=\"../search.php\">Search</a></li><br /><br />
				<li><a href=\"http://www.caminova.net/en/downloads/download.aspx?id=1\" target=\"_blank\">Get DjVu</a></li>
			</ul>
		</div>
		<div class=\"archive_holder\">
			<div class=\"archive_title\">Edit Author details</div>
			<div class=\"archive_volume\">";

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
	$authid = $_GET['authid'];
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

echo "<form name=\"frm1\" method=\"POST\" action=\"pr_author.php\" onsubmit=\"return validate()\">
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
		<textarea class=\"txtbox\" id=\"affid\" name=\"affiliation_up\" type=\"text\"  rows=\"10\" cols=\"40\">$affiliation</textarea><br />
	</td>
</tr>
<tr>
	<td class=\"fcol\">Isfellow:&nbsp;&nbsp;</td>
	<td class=\"scol\">";

		if($isfellow == 1)
		{
			echo "<input name=\"fellow_up\" type=\"radio\" value=\"1\" id=\"isfy\" CHECKED/>&nbsp;&nbsp; Yes &nbsp;&nbsp;
			<input name=\"fellow_up\" type=\"radio\" value=\"0\" id=\"isfn\"/>&nbsp;&nbsp; No &nbsp;&nbsp;";
		}
		else
		{
			echo "<input name=\"fellow_up\" type=\"radio\" value=\"1\" id=\"isfn\"/>&nbsp;&nbsp; Yes &nbsp;&nbsp;
			<input name=\"fellow_up\" type=\"radio\" value=\"0\" id=\"isfn\" CHECKED/>&nbsp;&nbsp; No &nbsp;&nbsp;";		
		}


echo "</td>
</tr>
<tr>
	<td class=\"fcol\"></td>
	<td class=\"scol\"><input type=\"submit\" value=\"Update\"></td>
</tr>
</table>
</form>";	
	
}
elseif($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$oldauthid = $_POST['authid_up'];
	$authorname = $_POST['authorname_up'];
	$fname = $_POST['firstname_up'];
	$lname = $_POST['lastname_up'];
	$affiliation = $_POST['affiliation_up'];
	$isfellow = $_POST['fellow_up'];

	if($authorname == "")
	{
		echo "Authorname should not be empty <br />Please go back and correct it";
	}
	else
	{
		$query = "select * from author where authorname='$authorname'";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		if($num_rows)
		{
			$row=mysql_fetch_assoc($result);
			$authid=$row['authid'];
			if($authid == $oldauthid)
			{
				//echo "update  author table, article table and search table <br />"; -> condition 1(authid == oldauthids)
				echo "Place 1: updating author table<br />";
				$query1 = "update author set
				authorname='$authorname',
				fname='$fname',
				lname='$lname',
				isfellow='$isfellow',
				affiliation='$affiliation' where authid='$oldauthid'";
				$result1 = mysql_query($query1);
				if($result1)
				{
					echo "Successfully updated author table <br />";
				}
				//$table1 = "article";
				//$table2 = "searchtable";
				
				//update authorname in article table and search table.
				//echo "updating article and seartch table";
				mysql_free_result($result1);				
				update_tables($oldauthid,$authorname);
			}
			else
			{
				//merging old author articles with new author
/*
				echo "Place 2: Authorname has been changed<br />
				Another author with this(changed) name exists.<br />
				So update this id and author name in<br />
				Article table and Search table<br />Authid is: $authid";
*/


echo "<form name=\"frm2\" method=\"POST\" action=\"update_author1.php\">
		<input name=\"authid_up\" type=\"hidden\" value=\"$authid\" />
		<input name=\"oldauthid\" type=\"hidden\" value=\"$oldauthid\" />
		<input id=\"auname\" name=\"authorname_up\" type=\"hidden\" value=\"$authorname\" size=\"60\"/>		
		<input id=\"fnid\" name=\"firstname_up\" type=\"hidden\" value=\"$fname\" size=\"30\"/>
		<input id=\"lnid\" name=\"lastname_up\" type=\"hidden\" value=\"$lname\" size=\"30\"/>
		<textarea id=\"affid\" name=\"affiliation_up\" type=\"hidden\"  rows=\"10\" cols=\"40\" style=\"display: none;\">$affiliation</textarea><br />";

		if($isfellow == 1)
		{
			echo "<input name=\"fellow_up\" type=\"hidden\" value=\"1\" id=\"isfy\" CHECKED/>&nbsp;&nbsp;Yes&nbsp;&nbsp;
			<input name=\"fellow_up\" type=\"hidden\" value=\"0\" id=\"isfn\"/>&nbsp;&nbsp;No&nbsp;&nbsp;";
		}
		else
		{
			echo "<input name=\"fellow_up\" type=\"hidden\" value=\"1\" id=\"isfy\"/>
			<input name=\"fellow_up\" type=\"hidden\" value=\"0\" id=\"isfn\" CHECKED/>";			
		}
echo "<table>
<tr>
	<td colspan=\"2\">
		Authorname has been changed. Another author with this(changed) name exists.
		Would you like to merge articles written by previous author with new author
	</td>
</tr>
<tr>	
	<td colspan=\"2\">
	  <input name=\"merge\" type=\"radio\" value=\"1\" id=\"mergey\"/>&nbsp;&nbsp;Yes&nbsp;&nbsp;
	  <input name=\"merge\" type=\"radio\" value=\"0\" id=\"mergen\" CHECKED/>&nbsp;&nbsp;No&nbsp;&nbsp;
	</td>
</tr>
<tr>
	<td></td>
	<td><input type=\"submit\" value=\"Update\"></td>
</tr>
</table>
</form>";
					
			}//else ends here
		}
		else
		{			
			//echo "Authorname has been changed and changed authorname does not exist in author table <br /> 
			//so use the same id.  Update authorname in article and search table<br />
			//and also update author table";
			//condition 2 (changed author name does not exist so use the same id and update tables)
			echo "Place 3: updating author table<br />";
			$query1 = "update author set
			authorname='$authorname',
			fname='$fname',
			lname='$lname',
			isfellow='$isfellow',
			affiliation='$affiliation' where authid='$oldauthid'";
			$result1 = mysql_query($query1);
			if($result1)
			{
				echo "Successfully updated author table <br />";
			}
			
			//update authorname in article table and search table.
			//echo "updating article and seartch table";
			mysql_free_result($result1);
			update_tables($oldauthid,$authorname);
		}
		mysql_free_result($result);
	}	
}


echo "</div>
		</div>
		<div class=\"archive_area\">
			<a href=\"../cissue.php\" title=\"Current Issue\"><img src=\"../images/cur_issue.png\" alt=\"Current Issue\"/></a><br />
<?php
include(\"include_cissue.php\");
?>
		</div>
	</div>
	<div class=\"footer\">
		<div class=\"foot_box\">
			<div class=\"left\">
				&copy;2011 Indian Academy of Sciences, Bangalore. All Rights Reserved
			</div>
			<div class=\"right\">
				<ul>
					<li><a href=\"../terms.php\">Terms of Use</a></li>
					<li>|</li>
					<li><a href=\"../policy.php\">Privacy Policy</a></li>
					<li>|</li>
					<li><a href=\"../contact.php\">Contact us</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>
</html>";

function update_tables($oldauthid,$authorname)
{
	//echo "$oldauthid-->$authorname<br />";
	$query2 = "select authid, authorname, titleid from article where authid like '%$oldauthid%'";
	$result2 = mysql_query($query2);
	$num_rows2 = mysql_num_rows($result2);

	for($i=0;$i<$num_rows2;$i++)
	{
		$row2=mysql_fetch_assoc($result2);
		$authid=$row2['authid'];			
		$auth=$row2['authorname'];
		$titleid=$row2['titleid'];

		$authid_list = preg_split("/;/",$authid);		
		$auth_list = preg_split("/;/",$auth);

		for($j=0;$j<sizeof($authid_list);$j++)
		{
			if($oldauthid == $authid_list[$j])
			{
				$auth_list[$j] = $authorname;
				break;
			}		
		}
			
		//preparing new author list with semicolon seperated
		$new_author_names = "";		
		for($j=0;$j<sizeof($auth_list);$j++)
		{
			$new_author_names = $new_author_names . ";" . $auth_list[$j];
		}
   	    $new_author_names = preg_replace('/^;/', '', $new_author_names);

   	    //update article table with this new author names;
   	    $query3 = "update article set
   	    authorname='$new_author_names' where titleid='$titleid'";
   	    $result3 = mysql_query($query3);
		if(!($result3))
		{
			echo "Can not update article table : <br />";
			echo "titleid : $titleid<br />";
			echo "author ids : $oldauthid<br />";
			echo "Author names : $new_author_names<br />";
			echo "Mysql error : " . mysql_error();
		}
		mysql_free_result($result3);
		
		//update search table with this new author names;
   	    $query4 = "update searchtable set
   	    authorname='$new_author_names' where titleid='$titleid'";
   	    $result4 = mysql_query($query4);
		if(!($result4))
		{
			echo "Can not update article table : <br />";
			echo "titleid : $titleid<br />";
			echo "author ids : $oldauthid<br />";
			echo "Author names : $new_author_names<br />";
			echo "Mysql error : " . mysql_error();
		}	   	    
		mysql_free_result($result4);					
	   	    
	}//for ends here
	mysql_free_result($result2);
}

?>
