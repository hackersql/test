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

<form method="get">
<table>
<tr><td><b>输入处理:</b></td></tr>
<tr><td><small><i>操纵，转义或拒绝攻击字符串的标准</i></small></td></tr>
	<tr><td>双重单引号:</td><td><input type="checkbox" name="quotes_double" <?php if(isset($_REQUEST["quotes_double"])) echo "checked"; ?> ></td></tr>
	<tr><td>过滤等级:</td><td><select name="sanitization_level">
		<option value="none">不过滤</option>
		<option value="whitelist" <?php if(isset($_REQUEST["sanitization_level"]) and $_REQUEST["sanitization_level"]=="whitelist") echo "selected"; ?>>只接受白名单的项目</option>
		<option value="reject_low" <?php if(isset($_REQUEST["sanitization_level"]) and $_REQUEST["sanitization_level"]=="reject_low") echo "selected"; ?>>区分大小写拒绝列入黑名单的项目</option>
		<option value="reject_high" <?php if(isset($_REQUEST["sanitization_level"]) and $_REQUEST["sanitization_level"]=="reject_high") echo "selected"; ?>>不区分大小写拒绝列入黑名单的项目</option>
		<option value="escape" <?php if(isset($_REQUEST["sanitization_level"]) and $_REQUEST["sanitization_level"]=="escape") echo "selected"; ?>>反斜杠 - 逃避黑名单项目</option>
		<option value="low" <?php if(isset($_REQUEST["sanitization_level"]) and $_REQUEST["sanitization_level"]=="low") echo "selected"; ?>>区分大小写删除黑名单项目</option>
		<option value="medium" <?php if(isset($_REQUEST["sanitization_level"]) and $_REQUEST["sanitization_level"]=="medium") echo "selected"; ?>>不区分大小写删除黑名单项目</option>
		<option value="high" <?php if(isset($_REQUEST["sanitization_level"]) and $_REQUEST["sanitization_level"]=="high") echo "selected"; ?>>不区分大小写且重复删除黑名单项目</option>
	</select></td></tr>
	<tr><td>模式匹配风格</td><td>关键词 <input type="radio" value="keyword" name="sanitization_type" <?php if(!isset($_REQUEST['sanitization_type']) or $_REQUEST["sanitization_type"]=="keyword") echo "checked"; ?>>
		正则表达式 <input type="radio" value="regex" name="sanitization_type" <?php if(isset($_REQUEST["sanitization_type"]) and $_REQUEST["sanitization_type"]=="regex") echo "checked"; ?>></td></tr>
	<tr><td>在下面输入逗号分隔的关键字<br>或正则表达式到白名单或黑名单</td></tr>
	<tr><td>过滤参数:</td><td><textarea name="sanitization_params"><?php if(isset($_REQUEST["sanitization_params"])) echo $_REQUEST["sanitization_params"]; ?></textarea></td></tr>
<tr><td><br/></td><td></td></tr>
<tr><td><b>环境设置:</b></td></tr>
<tr><td><small><i>模拟短暂的应用程序问题</i></small></td></tr>
	<tr><td>随机失败?</td><td><input type="checkbox" name="random_failure"<?php echo isset($_REQUEST['random_failure']) ? ' checked' : '' ?>>
	<tr><td>随机时间延迟?</td><td><input type="checkbox" name="random_delay"<?php echo isset($_REQUEST['random_delay']) ? ' checked' : '' ?>>
<tr><td><br/></td><td></td></tr>
<tr><td><b>输出等级:</b></td></tr>
<tr><td><small><i>配置回显输出的详细程度</i></small></td></tr>
	<tr><td>输出结果:</td><td><select name="query_results">
		<option value="all_rows">所有结果</option>
		<option value="one_row" <?php if(isset($_REQUEST["query_results"]) and $_REQUEST["query_results"]=="one_row") echo "selected"; ?>>一个结果</option>
		<option value="bool" <?php if(isset($_REQUEST["query_results"]) and $_REQUEST["query_results"]=="bool") echo "selected"; ?>>布尔（结果vs无结果）</option>
		<option value="none" <?php if(isset($_REQUEST["query_results"]) and $_REQUEST["query_results"]=="none") echo "selected"; ?>>无结果</option>
	</select></td></tr>
	<tr><td>错误详情:</td><td><select name="error_level">
		<option value="verbose">详细的错误消息</option>
		<option value="generic" <?php if(isset($_REQUEST["error_level"]) and $_REQUEST["error_level"]=="generic") echo "selected"; ?>>一般错误消息</option>
		<option value="none" <?php if(isset($_REQUEST["error_level"]) and $_REQUEST["error_level"]=="none") echo "selected"; ?>>不显示错误消息</option>
	</select></td></tr>
	<tr><td>在上下文中显示payload?:</td><td><input type="checkbox" name="show_query" value="on" <?php if(isset($_REQUEST["show_query"])) echo "checked"; ?> ></td></tr>
<tr><td><br/></td><td></td></tr>
<tr><td><b>注入参数:</b></td></tr>
<tr><td><small><i>输入你的攻击字符串和注入点</i></small></td></tr>
<tr><td>注入字符串:</td><td><textarea name="inject_string"><?php if(isset($_REQUEST["inject_string"])) echo htmlentities($_REQUEST["inject_string"]); ?></textarea></td></tr>
