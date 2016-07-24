<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="default.css">
	<link rel="icon" href="http://binjiesun.com/images/voteIcon.png">
	
	<meta charset="UTF-8">
	
    <title>Vote</title>
	
</head>

<body>

    <div id="menu">
	    <img id="logo" alt="atom" src="http://animations.fg-a.com/atom_004rd.gif"> 
	    <a class="menu-item" href="rating.php"><img width="25px" src="http://icons.iconarchive.com/icons/double-j-design/diagram-free/128/bar-chart-icon.png">&nbspRating</a>
		<a class="menu-item" style="background-color: #6C2DC7;"><img width="32px" src="http://binjiesun.com/images/voteIcon.png">&nbspVote</a>
		<a class="menu-item" href="about.php"><img width="25px" src="http://findicons.com/files/icons/1676/primo/128/info_black.png">&nbspAbout</a>
		<a class="menu-item" href="feedback.php"><img width="25px" src="http://myexpressions.in/images/contact-icon.png">&nbspFeedback</a>
	</div>
 
    <div id="qarea">
          <h3 id="question_text">  </h3>
          <img id="next_image" alt = "Next->" src="http://i.imgur.com/ekOT9KX.png" onclick = "load_next()"> <br\>
  
          <img id="img1" alt = "Wait..." onclick="send_vote(1); accept(); setTimeout(restore, 1000);">
          <img id="img2" alt = "Wait..." onclick="send_vote(2); accept(); setTimeout(restore, 1000);">
          
		  <img id="accepted_image" alt = "Accepted!" src="http://www.livinglifeonthevine.com/wp-content/uploads/2014/09/Accept.png">
		  <img id="loader_gif" alt = "Loading..." src="http://i.imgur.com/r3XJYzU.gif">

    </div>
	
	</br>
	</br>
	
	<div id = "access">
	   <span id="access_caption"> Total accesses: </span>
	   <span id="access_num"> </span>
	</div>
	
	<?php
	    require 'parts/lower_bar.php';
	?>

</body>

<script scr="js/default.js" type="text/javascript"> </script>

</html>