<div class="body_padded">
	<h1>帮助 - 跨站请求伪造</h1>
	
	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">

		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;跨站请求伪造(cross-site request forgery)通常缩写为XSRF，直译为跨站请求伪造，即攻击者通过调用第三方网站的恶意脚本或者利用程序来伪造请求，当然并不需要向用户端伪装任何具有欺骗的内容，在用户不知情时攻击者直接利用用户的浏览器向攻击的应用程序提交一个已经预测好请求参数的操作数据包，利用的实质是劫持用户的会话状态，强行提交攻击者构造的具有“操作行为”的数据包。可以看出，最关键的是劫持用户的会话状态，所以说，导致XSRF漏洞的主要原因是会话状态的保持没有唯一时间特征的标识，即是说在使用HTTPCookie传送会话令牌的过程中，应该更谨慎的判断当前用户，而不是简单的通过操作数据包的Cookie值来鉴别，简单的说是每次数据交互时，对提交的数据包实行唯一性标识。</p>
		
	</div></td>
	</tr>
	</table>
	
	</div>
	
	<br />
	
	<p>参考网址: http://www.owasp.org/index.php/Cross-Site_Request_Forgery_(CSRF)</p>
	<p>参考网址: http://baike.baidu.com/view/1609487.htm</p>

</div>