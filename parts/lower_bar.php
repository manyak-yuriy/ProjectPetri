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