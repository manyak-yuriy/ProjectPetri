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

<script>
   


    onload = function()
	{
		load_access();
		setInterval(load_access, 3000);
				
			
		if (!XMLHttpRequest)
		{
			alert("You are using Internet Explorer! Go get a normal browser first.");
			return;
		}
		
		document.getElementById("img1").style.visibility = 'hidden';
		document.getElementById("img2").style.visibility = 'hidden';
		document.getElementById("next_image").style.visibility = 'hidden';
		document.getElementById("loader_gif").style.visibility = 'visible';
		loadimg();
	}
	
    var id = -1;
	
	function accept()
	{
		document.getElementById("img1").style.visibility = 'hidden';
		document.getElementById("img2").style.visibility = 'hidden';
		document.getElementById("next_image").style.visibility = 'hidden';
		document.getElementById("accepted_image").style.visibility = 'visible';
	}
	
	function load_next()
	{
		document.getElementById("img1").style.visibility = 'hidden';
		document.getElementById("img2").style.visibility = 'hidden';
		document.getElementById("loader_gif").style.visibility = 'visible';
		document.getElementById("question_text").innerHTML = "";
		loadimg();
	}
	
	function restore()
	{
		document.getElementById("accepted_image").style.visibility = 'hidden';
		document.getElementById("loader_gif").style.visibility = 'visible';
		loadimg();
	}
	
	
   function load_access()
   { 
        
	    var xmlhttp = new XMLHttpRequest();
		
	    xmlhttp.onreadystatechange = function() 
        {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
				var resp = xmlhttp.responseText;
				//alert(resp);
				var counterObj = JSON.parse(resp);
				var counter = counterObj['cnt'];
				
				if (document.getElementById('access_num').innerHTML != counter)
				{
					document.getElementById('access_num').innerHTML = counter;
				    document.getElementById('access_num').style.color = "red";
				}
				
				setTimeout(function()
								    {
					                   document.getElementById('access_num').style.color = "black";
									}
				           , 500);
			}
			
			
		}
		xmlhttp.open("GET", "accessCnt.php", true);
        xmlhttp.send();
   }
   
    function loadimg() 
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
           //alert("fired "+xmlhttp.readyState+" " + xmlhttp.status);
           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
           {
                //alert("inside " + xmlhttp.responseText);
				var resp = xmlhttp.responseText;
				//alert(resp);
				var str =  resp.slice(resp.indexOf("["), resp.lastIndexOf("]") + 1);
				//alert(str);
                var links = JSON.parse(str);
                
				// preload two images into memory
				var img1_preload = new Image();
				var img2_preload = new Image();
				
				img1_preload.onload = function()
				{
					document.getElementById("img1").src = this.src;
					document.getElementById("loader_gif").style.visibility = 'hidden';
					document.getElementById("img1").style.visibility = 'visible';
				}
				
				img2_preload.onload = function()
				{
					document.getElementById("img2").src = this.src;
					document.getElementById("loader_gif").style.visibility = 'hidden';
					document.getElementById("img2").style.visibility = 'visible';
				}
				
				img1_preload.src = links[0];
				img2_preload.src = links[1];
                
				id = links[2];
				
				var question = "Кто из пацанов";
				switch (links[3])
				{
					case "1":
					{
						question = question + "<span id = 'question_text-comp'> умнее</span>";
						break;
					}
					case "2":
					{
						question = question + "<span id = 'question_text-char'> сексуальнее</span>";
						break;
					}
					case "3":
				    {
						question = question + "<span id = 'question_text-mann'> придёт к упеху</span>";
						break;
					}
					default:
					{
						alert("Strange!" + links[3]);
						break;
					}
				}
				question = question + " ?</span>";
				document.getElementById("question_text").innerHTML = question;
				document.getElementById("next_image").style.visibility = 'visible';
           }
        };
        xmlhttp.open("GET", "loadimg.php", true);
        xmlhttp.send();
    }
	
	function send_vote(result)
	{
		if (id != -1)
		{
			var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                {
					var resp = xmlhttp.responseText;
					//alert(resp);
				}
		    };
			xmlhttp.open("GET", "vote.php?id=" + id + "&res=" + result, true);
            xmlhttp.send();
			id = -1;
			document.getElementById("question_text").innerHTML = "";
		}
		else
			alert("Images are not loaded yet!");
	}
	
	
	load_back();
</script>

</html>