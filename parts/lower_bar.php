<div id="menu-footer">
</div>

<script>

    f = function()
	{
		var d = new Date();
	    document.getElementById("menu-footer").innerHTML = 
		"<div style='float: left; display: inline; margin-left: 15px;'>" + "<strong>&copy ProjectPetri&nbsp" + d.getFullYear()  + "</strong> </div>"
		+ "<div style = 'float: right; display: inline; margin-right: 15px;'>" + "<em>petri_peter@hotmail.com</em>"  + "</div>";
	}
	
	f();
</script>

    

<script>
    
	function load_back()
	{
				var elm = document.body;
                url = 'http://i532.photobucket.com/albums/ee322/Marathongman/SCRAPBOOK%20BACKGROUNDS%20AND%20PAGES/semi-transparent-white-background-overlay.png';
				elm.style.backgroundImage = "none";
				var tmp = new Image();
				tmp.onload = function() 
				{
					elm.style.backgroundImage = 'url("' + url + '")';
				};
				tmp.src = url;
	}
	</script>