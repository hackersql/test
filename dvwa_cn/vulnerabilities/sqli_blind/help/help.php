<div class="body_padded">
	<h1>帮助 - SQL盲注</h1>
	
	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">

		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正常情况下，我们实施一次SQL注入攻击，服务器会返回SQL query error等等的信息，这样有助于我们从错误信息中判断数据库版本等信息，但是有时候会返回空白页面或者是一段自定义的错误信息，相对于前面的注入攻击来说这个就是盲注。</p>
		
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在本例中，id参数存在注入。</p>
		
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数据库中存在5个用户，ID分别为1~5，你的任务是获取密码即可。</p>
		
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如果遇到Magicquotes error，请在php.ini中关闭即可。</p>
		
	</div></td>
	</tr>
	</table>
	
	</div>
	
	<br />
	
	<p>参考连接: http://www.owasp.org/index.php/Blind_SQL_Injection</p>

</div>
		