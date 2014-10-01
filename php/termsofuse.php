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
			<p class="title">Web Site Terms and Conditions of Use</p><hr />
			<p class="p2 bld">1. Terms</p>
			<p class="p3">By accessing this web site, you are agreeing to be bound by these web site Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this web site are protected by applicable copyright and trade mark law.</p>
			<p class="p2 bld">2. Use License</p>
			<ol>
				<li>Permission is granted to temporarily download one copy of the materials (information or software) on Resonance's web site for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
					<ol type="i">
						<li>modify or copy the materials;</li>
						<li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
						<li>attempt to decompile or reverse engineer any software contained on Resonance's web site;</li>
						<li>remove any copyright or other proprietary notations from the materials; or</li>
						<li>transfer the materials to another person or "mirror" the materials on any other server.</li>
					</ol>
				</li>
				<li>
					This license shall automatically terminate if you violate any of these restrictions and may be terminated by Resonance at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.
				</li>
			</ol>
			<p class="p2 bld">3. Disclaimer</p>
			<p class="p3">The materials on Resonance's web site are provided "as is". Resonance makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, Resonance does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.</p>
			<p class="p2 bld">4. Limitations</p>
			<p class="p3">In no event shall Resonance or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on Resonance's Internet site, even if Resonance or a Resonance authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.</p>
			<p class="p2 bld">5. Revisions and Errata</p>
			<p class="p3">The materials appearing on Resonance's web site could include technical, typographical, or photographic errors. Resonance does not warrant that any of the materials on its web site are accurate, complete, or current. Resonance may make changes to the materials contained on its web site at any time without notice. Resonance does not, however, make any commitment to update the materials.</p>
			<p class="p2 bld">6. Links</p>
			<p class="p3">Resonance has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Resonance of the site. Use of any such linked web site is at the user's own risk.</p>
			<p class="p2 bld">7. Site Terms of Use Modifications</p>
			<p class="p3">Resonance may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.</p>
			<p class="p2 bld">8. Governing Law</p>
			<p class="p3">Any claim relating to Resonance's web site shall be governed by the laws of India without regard to its conflict of law provisions.</p>
			<p class="p3">General Terms and Conditions applicable to Use of a Web Site.</p>
		</div>
	</div>
	<?php include("include_footer.php"); ?>
</div>
</body>

</html>
