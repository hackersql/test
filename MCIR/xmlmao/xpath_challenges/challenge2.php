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
	<title>XMLmao - XPath Challenge 2 - The Failure of Quote Filters</title>
<link rel="stylesheet" type="text/css" href="../../includes/mcir.css">
</head>
<body>
	<center><h1>XMLmao - XPath Challenge 2 - 过滤单引号失败</h1></center><br>

	<hr width="40%">
	<hr width="60%">
	<hr width="40%">
<div id="challenge">
	
您必须在数字字段中执行XPath注入攻击，而不使用单引号.<br>
<br>
您的目标是让查询返回整个XML文档.

<pre>
参数：
注入类型 - 条件为字符串值
过滤 - 删除单引号
输出 - 显示所有查询结果，详细错误.
</pre>

</div>
<form action="../xpath.php" method="get" name="challenge_form">
	<input type="hidden" name="query_results" value="all"/>
	<input type="hidden" name="show_query" value="on"/>
	<input type="hidden" name="location" value="condition_num"/>
	<input type="hidden" name="sanitization_level" value="high"/>
	<input type="hidden" name="sanitization_params" value="'">
	<input type="hidden" name="sanitization_type" value="keyword">
	<input type="hidden" name="error_level" value="verbose"/>
	注入字符串: <input type="text" name="inject_string"/><br>
	<input type="submit" name="submit" value="注入!"/>
</form>
<br>
</body>
</html>
