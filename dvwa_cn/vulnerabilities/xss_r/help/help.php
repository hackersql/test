<div class="body_padded">
	<h1>帮助 - 反射型跨站</h1>
	
	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">

		<p>跨站脚本（Cross-site scripting，简称XSS），是一种迫使Web站点回显可执行代码的攻击技术，而这些可执行代码由攻击者提供、最终为用户浏览器加载。不同于大多数攻击（一般只涉及攻击者和受害者），XSS涉及到三方，即攻击者、客户端与网站。XSS的攻击目标是为了盗取客户端的cookie或者其他网站用于识别客户端身份的敏感信息。获取到合法用户的信息后，攻击者甚至可以假冒最终用户与网站进行交互。</P>

		<p>反射型跨站一般是攻击者构造好URL参数，给过加密后发送给受害者，一般通过IM工具或者是邮件发送。</p>
		
		<p>例如: http://127.0.0.1/dvwa/xss.php?name=javascript</p>
		
	</div></td>
	</tr>
	</table>
	
	</div>
	
	<br />
	
	<p>参考网址: http://www.owasp.org/index.php/Cross-site_Scripting_(XSS)</p>

</div>

		