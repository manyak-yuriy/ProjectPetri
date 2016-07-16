<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" type="text/css" href="style.css">
	
	<link rel="stylesheet" type="text/css" href="about.css">
	
	<link rel="icon" href="http://nhtheatreawards.org/Data/Sites/1/aaImages/graphics/aboutIcon.jpg">
	<meta charset="UTF-8">
    <title>About</title>
	
</head>

<body>

    <div id="menu">
	    <img id="logo" alt="atom" src="http://animations.fg-a.com/atom_004rd.gif"> 
	    <a class="menu-item" href="rating.php"><img width="25px" src="http://icons.iconarchive.com/icons/double-j-design/diagram-free/128/bar-chart-icon.png">&nbspRating</a>
		<a class="menu-item" href="default.php"><img width="25px" src="http://binjiesun.com/images/voteIcon.png">&nbspVote</a>
		<a class="menu-item" style="background-color: #6C2DC7;"><img width="25px" src="http://www.iconarchive.com/download/i22783/kyo-tux/phuzion/Sign-Info.ico">&nbspAbout</a>
		<a class="menu-item" href="feedback.php"><img width="25px" src="http://myexpressions.in/images/contact-icon.png">&nbspFeedback</a>
	</div>
	
	<div id="descr">
	     <h1>Inner workings</h1>
	     <p>
		      This site uses an algorithm which identifies the best alternative based on a number of fuzzy relations and predefined priorities.
		 </p>
	</div>
	
	<?php
	    require 'parts/lower_bar.php';
	?>
</body>

</html>