
<script src="./javascript/follow-mouse.js"></script>
<div class="page-title">Page Viewer</div>
<br />
<br />
<table style="margin-left:auto; margin-right:auto;">
	<tr>
		<td colspan="2" class="form-header">Click on portion of picture to enlarge</td>
	</tr>
	<tr><td></td></tr>
	<tr><td>Starting with the mouse off of the picture, move the mouse over the picture, then click to enlarge a portion of the picture.</td></tr>
</table>

<iframe
	id="id-iframe" 
	frameborder="0"
	scrolling="no" 
	width="500px" 
	height="600px" 
	src="index.php?page=rene-magritte.php" 
	style="margin-left:auto; margin-right:auto;"
	>
</iframe>

<div id="id-hover-div" class="click-jacking-button"
onclick="window.alert('This page has been hijacked by the Mutillidae development team.');document.location.href='http://www.irongeek.com';"
>
Giant Invisible Click-Jacking Button 
</div>

<script>
	objHoverDiv = document.getElementById('id-hover-div');
</script>
	