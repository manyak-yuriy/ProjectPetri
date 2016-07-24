onload = function()
	{
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
	
	
	setTimeout(load_back, 2000);