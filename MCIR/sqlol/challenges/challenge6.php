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
	<title>SQLol - Challenge 6 - Stack the Deck</title>
<link rel="stylesheet" type="text/css" href="../../includes/mcir.css">
</head>
<body>
	<center><h1>SQLol - Challenge 6 - Stack the Deck</h1></center><br>

	<hr width="40%">
	<hr width="60%">
	<hr width="40%">
<div id="challenge">
	
In this challenge, you must utilize stacked queries due to the difficulty of extraction in the SQLi scenario.<br>
<br>
Your objective is to create a new table called "ipwntyourdb" using stacked queries.

<pre>
参数:
Query Type - SELECT query
注入类型: - String value in WHERE clause
Method - POST
过滤: - None
输出 - 所有结果, verbose error messages, query shown
</pre>

</div>
<form action="../select.php" method="post" name="challenge_form">
	<input type="hidden" name="query_results" value="none"/>
	<input type="hidden" name="error_level" value="none"/>
	<input type="hidden" name="show_query" value="off"/>
	<input type="hidden" name="location" value="where_string"/>
	注入字符串: <input type="text" name="inject_string"/><br>
	<input type="submit" name="submit" value="注入!"/>
</form>
<br>
</body>
</html>
