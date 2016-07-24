    load_back();
	load_votes();
	setInterval(load_votes, 5000);


	function load_votes()
	{
		var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() 
        {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
				var resp = xmlhttp.responseText;
				var str =  resp.slice(resp.indexOf("["), resp.lastIndexOf("]") + 1);
				//alert(resp);
				var countsObj = JSON.parse(str);
				
				
				if (document.getElementById('vv1').innerHTML != countsObj[0])
				{
					document.getElementById('vv1').innerHTML = countsObj[0];
				    document.getElementById('vv1').style.color = "red";
					document.getElementById('vv1').style.fontSize = "x-large";
				}
				
				if (document.getElementById('vv2').innerHTML != countsObj[1])
				{
				    document.getElementById('vv2').innerHTML = countsObj[1];
				    document.getElementById('vv2').style.color = "red";
					document.getElementById('vv2').style.fontSize = "x-large";
				}
				
				if (document.getElementById('vv3').innerHTML != countsObj[2])
				{
					document.getElementById('vv3').innerHTML = countsObj[2];
				    document.getElementById('vv3').style.color = "red";
					document.getElementById('vv3').style.fontSize = "x-large";
				}
				
				
				setTimeout(function()
								    {
					                   document.getElementById('vv1').style.color = "black";
									   document.getElementById('vv1').style.fontSize = "medium";
									   document.getElementById('vv2').style.color = "black";
									   document.getElementById('vv2').style.fontSize = "medium";
									   document.getElementById('vv3').style.color = "black";
									   document.getElementById('vv3').style.fontSize = "medium";
									}
				           , 500);
			}
			
			
		}
		xmlhttp.open("GET", "numVotes.php", true);
        xmlhttp.send();
	}