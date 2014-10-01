<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$volume = $_POST['volume'];
$issue = $_POST['issue'];
$title = $_POST['title'];
$feature = $_POST['feature'];
$page = $_POST['pagestart'];
$pageend = $_POST['pageend'];
$abstract = $_POST['abstract'];
$auth_list = $_POST['auth'];

$page = str_pad($page,4,"0",STR_PAD_LEFT);
$pageend = str_pad($pageend,4,"0",STR_PAD_LEFT);

/*
echo "Volume-->" . $volume . "<br />";
echo "Issue-->" . $issue . "<br />";
echo "Title-->" . $title . "<br />";
echo "Authors-->" . $auth_list[0] . "<br />";
echo "Feature-->" . $feature . "<br />";
echo "Page Start-->" . $page . "<br />";
echo "Page End-->" . $pageend . "<br />";
echo "Abstract-->" . $abstract . "<br />";
*/


$authids = "";
$author_names = "";

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
				if($authids == "")
				{
					$authids =  $row['authid'];
					$author_names = $auth_list[$i];
				}
				else
				{
					$authids = $authids . ";" . $row['authid'];
					$author_names = $author_names .";" . $auth_list[$i];					
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
						if($authids == "")
						{
							$authids =  $row2['authid'];
							$author_names = $auth_list[$i];							
						}
						else
						{
							$authids = $authids . ";" . $row2['authid'];
							$author_names = $author_names . ";" . $auth_list[$i];
						}	
					}
					//mysql_free_result($result2);		
				}
				//mysql_free_result($result1);
			}
			//mysql_free_result($result);
			//echo $auth_list[$i] . "<br />";
		}
	}//for ends here
//echo $new_authids;

echo "Author IDs " . $authids . "<br />";
echo "Author names " . $author_names . "<br />";

if($feature == "")
{
	$featid = "10001";
	echo "Feature ID " . $featid . "<br />"; 
}
else
{
	$query3 = "select featid from feature where feat_name='$feature'";
	$result3 = mysql_query($query3);
	$row3=mysql_fetch_assoc($result3);
	$featid =  $row3['featid'];
	echo "Feature " . $feature . "<br />"; 
	echo "Feature ID " . $featid . "<br />"; 
}

	$query5 = "select distinct year, month from article where volume='$volume' and issue='$issue'";
	$result5 = mysql_query($query5);
	$row5 = mysql_fetch_assoc($result5);
	$year  = $row5['year'];
	$month = $row5['month'];

if(!(checkarticle($volume,$issue,$year,$month,$title,$authids,$featid,$page,$pageend)))
{

	//code calculate new titleid for this new article
	$id = "id_" . $volume . "_" . $issue . "_" . $page . "_" . $pageend;
	$query10 = "select count(*) from article where volume='$volume' and issue='$issue' and page='$page' and page_end='$pageend'";
	$result10 = mysql_query($query10);
	$row10 = mysql_fetch_assoc($result10);
	$idnum = $row10['count(*)'];
	$id = $id . "_" . $idnum;		

	
	//code to insert new article into article table
	//also insert into searchtable
	$query6 = "insert into article values('$title','$authids','$author_names','$featid','$page','$pageend','$volume','$issue','$year','$month','$abstract','0','$id')";
	$result6 = mysql_query($query6);
	if($result6)
	{
		$query7 = "select titleid from article
		where volume='$volume' and issue='$issue' and
		year='$year' and month='$month' and
		title='$title' and authid='$authids' and
		featid='$featid'";
		$result7 = mysql_query($query7);
		$row7 = mysql_fetch_assoc($result7);
		$titleid = $row7['titleid'];
		
		for($i=$page;$i<=$pageend;$i++)
		{
			$query8 = "select text from testocr where volume='$volume' and issue='$issue' and cur_page='$i'";
			$result8 = mysql_query($query8);
			$row8 = mysql_fetch_assoc($result8);
			$text = $row8['text'];

			$query9 = "insert into searchtable values('$title','$authids','$author_names','$featid','$text','$page','$i','$volume','$issue','$year','$month','$titleid')";
			$result9 = mysql_query($query9);
			if(!($result9))
			{
				echo "Error in inserting into searchtable: " . mysql_error();
			}
		}
	}
	else
	{
		echo "Error in inserting new article: " . mysql_error();
	}
}

function checkarticle($volume,$issue,$year,$month,$title,$authids,$featid,$page,$pageend)
{
	$query4 = "select * from article where volume='$volume' and issue='$issue' and
	year='$year' and month='$month' and
	title='$title' and authids='$authids' and
	featid='$featid' and page='$page' and page_end='$pageend'";
	$result4 = mysql_query($query4);
	$num_rows4 = mysql_num_rows($result4);
	if($num_row4)
	{
		echo "Already there is an article with similar details <br />";
		return 1;
	}
	return 0;
}

?>

