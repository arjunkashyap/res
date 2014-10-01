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
			<p class="p1"><span class="itl">Resonance</span> is a journal of science education, published monthly by the Indian Academy of Sciences, Bangalore, entering its second decade of publication. The journal is primarily directed at students and teachers at the undergraduate level, though some of the articles may go beyond this range. <span class="itl">Resonance</span> has a council of editors drawn from institutions all over in India, with a Chief Editor and several Associate Editors located in Bangalore.</p>
			<p class="p1">Each issue of <span class="itl">Resonance</span> contains articles on physics, chemistry, biology, mathematics, computer science and engineering. The format is attractive and easy to read, with photographs, illustrations, margin notes, boxes and space for comments provided. The articles are of various categories: individual general articles, series made up of several parts, concise article-in-boxes, classroom pieces, nature-watch pieces, research news, book reviews, and information and announcements useful to students and teachers. Each issue of <span class="itl">Resonance</span> also highlights the contributions of a chosen scientist, engineer or mathematician, with a portrait on the back cover and articles describing his or her life and work. In some cases, an article written by the scientist on a general theme is included as a Classic or a Reflections item. Some of the personalities featured so far are - Einstein, Schroedinger, Pauli, Chandrasekhar, Raman, S N Bose, von Neumann, Turing, Darwin, McClintock, Haldane, Fisher, Lorenz, Mendel, Dobhzansky, Pauling, the Bernoullis, Fermat, Harish-Chandra, Ramanujan and Weil.</p>
			<p class="p1"><span class="itl">Resonance</span> invites original contributions in various branches of science and engineering and emphasizes a lucid style that will attract readers from diverse backgrounds. A helpful general rule is that at least the first one third of the article should be readily understood by a general audience. Articles may be submitted to any of the editors or directly to the editorial office. All submissions are refereed. Students and teachers are particularly encouraged to submit articles. Comments and suggestions about articles are also welcome.</p>
		</div>
	</div>
	<?php include("include_footer.php"); ?>
</div>
</body>

</html>
