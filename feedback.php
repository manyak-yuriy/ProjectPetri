<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" type="text/css" href="style.css">
	
	<link rel="stylesheet" type="text/css" href="feedback.css">
	
	<link rel="icon" href="http://myexpressions.in/images/contact-icon.png">
	<meta charset="UTF-8">
    <title>Feedback</title>
	
	
	<style>
		p
		{
		   color: black;
		   font-family: "Comic Sans MS", cursive, sans-serif;
		   font-size: 120%;
		   text-indent: 30px;
		   line-height: 160%;
		   
		   background: rgba(255,255,240,0.5);
	       border-radius: 5px;
	       padding: 10px;
		   
		   margin-left: 70px;
		   margin-right: 70px;
		}
	</style>
</head>

<body>

    <div id="menu">
	    <img id="logo" alt="atom" src="http://animations.fg-a.com/atom_004rd.gif"> 
	    <a class="menu-item" href="rating.php"><img width="25px" src="http://icons.iconarchive.com/icons/double-j-design/diagram-free/128/bar-chart-icon.png">&nbspRating</a>
		<a class="menu-item" href="default.php"><img width="25px" src="http://binjiesun.com/images/voteIcon.png">&nbspVote</a>
		<a class="menu-item" href="about.php"><img width="25px" src="http://www.iconarchive.com/download/i22783/kyo-tux/phuzion/Sign-Info.ico">&nbspAbout</a>
		<a class="menu-item" style="background-color: #6C2DC7;"><img width="25px" src="http://myexpressions.in/images/contact-icon.png">&nbspFeedback</a>
	</div>
	
	<p>
	    You'd better contact us at e-mail <em>petri_peter@hotmail.com</em>
	</p>
	<hr/>
	
	<div id = "form_block">
	<form action="receive_feedback.php" method="POST">
	    <input type="text" name="firstname" class = "field" placeholder="first name" onkeyup="check_valid(this)" required><br>
        <input type="text" name="lastname" class = "field" placeholder="second name" onkeyup="check_valid(this)" required><br>
		<input type="text" name="e-mail" class = "field" placeholder="e-mail" onkeyup="check_valid(this)" required><br>
	    <textarea name="message" rows="5" cols="35" class = "field" placeholder="comment" onkeyup="check_valid(this)" required></textarea><br>
		<input type="submit" value="Submit">
	</form>
	</div>
	
	<?php
	    require 'parts/lower_bar.php';
	?>

</body>

</html>