<?php
/*
Magical Code Injection Rainbow - A set of configurable injection testbeds 
Daniel "unicornFurnace" Crowley
Copyright (C) 2014 Trustwave Holdings, Inc.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.
*/
?>
<html>
<head>
	<title>XSSmh - Challenge 2 - Basic Persistent Threat</title>
<link rel="stylesheet" type="text/css" href="../../includes/mcir.css">
</head>
<body>
	<center><h1>XSSmh - Challenge 2 - Basic Persistent Threat</h1></center><br>

	<hr width="40%">
	<hr width="60%">
	<hr width="40%">
<div id="challenge">
	
You must perform the simplest of persistent XSS attacks.<br>
<br>
Your objective is to cause an alert box to pop up on the resulting page.<br>
(Note: Use any browser you like for this, browser based anti-XSS protections do not apply to persistent flaws.)

<pre>
参数:
注入类型: - Injection into HTML body
过滤: - None
</pre>

</div>
<form action="../xss.php" method="get" name="challenge_form">
	<input type="hidden" name="location" value="body"/>
	<input type="hidden" name="persistent" value="on"/>
	注入字符串: <input type="text" name="inject_string"/><br>
	<input type="submit" name="submit" value="注入!"/>
</form>
<br>
</body>
</html>
