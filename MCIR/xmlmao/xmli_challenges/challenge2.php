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
	<title>XMLmao - XML Injection Challenge 2 - Anti-Anti-XSS</title>
<link rel="stylesheet" type="text/css" href="../../includes/mcir.css">
</head>
<body>
	<center><h1>XMLmao - XML Injection Challenge 2 - Anti-Anti-XSS</h1></center><br>

	<hr width="40%">
	<hr width="60%">
	<hr width="40%">
<div id="challenge">
	
基于浏览器的反XSS措施涉及比较输入和输出。 如果输入包含脚本并在结果响应中用作脚本的一部分，则脚本不会执行。 如果你能打破比较，你可以打败反XSS措施。
<br>
您的目标是使用XML注入来执行绕过浏览器反XSS比较的跨站脚本。
(注意：Firefox[没有NoScript]，Safari和旧版本的IE没有反XSS保护，请尝试使用具有反XSS措施的浏览器，如Chrome。)
<pre>
参数:
注入类型: - CDATA-包装的值
过滤: - 空
输出 - 所有结果, 详细错误信息, 显示XML
</pre>

</div>
<form action="../xmlinjection.php" method="get" name="challenge_form">
	<input type="hidden" name="query_results" value="all_rows"/>
	<input type="hidden" name="show_query" value="on"/>
	<input type="hidden" name="location" value="cdatavalue"/>
	<input type="hidden" name="error_level" value="verbose"/>
	注入字符串: <input type="text" name="inject_string"/><br>
	<input type="submit" name="submit" value="注入!"/>
</form>
<br>
</body>
</html>
