<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resonance</title>
<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />
<link href="style/indexstyle.css" media="screen" rel="stylesheet" type="text/css" />
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
		<?php include("include_current_issue.php"); ?>
		<div class="about">
			<p class="title">Annual Subscription Rates</p>
			<div class="sub_left"><hr />
				<p class="p2">
					<span class="bld">Institutions: </span>Rs. 500/- per year<br /><br />
					<span class="bld">Individuals: </span>Rs. 400/- minimum for two years<br /><br />
					<span class="bld">Price per single copy: </span>Rs. 40/-
				</p>
			</div>
			<div class="sub_left">
				<hr />
				<p class="p2">All correspondence regarding subscription should be addressed to <span class="bld">The Circulation Department</span> of the Academy. E-mail: orders@ias.ernet.in</p>
				<p class="p2">Online orders for India are also accepted at <a href="http://www.swb.co.in" target="_blank">Scholars without Borders</a><br />E-mail: hello@swb.co.in</p>
			</div>
			<div class="sub_left">
				<hr />
				<p class="p2">
					International subscriptions are processed by <a href="http://www.springer.com">Springer</a><br />
					For details contact:<br /><br />
					The Americas (North, South, Central and Carribbean):<br />
					journals-ny@springer.com<br /><br />
					Outside the Americas:<br />subscriptions@springer.com
				</p>
			</div>
		</div>
	</div>
	<?php include("include_footer.php"); ?>
</div>
</body>

</html>
