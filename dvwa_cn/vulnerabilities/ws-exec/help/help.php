<div class="body_padded">
	<h1>帮助 - Web Services命令执行</h1>
	
	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">

	<p>Webservice是提供给网络上两个设备之间通信的一种方法.这种特殊的服务使用AJAX调用的客户端，并使用SOAP的XML消息通过HTTP进行通信。 本例演示的是ping攻击测试.</p>
        <p>低安全级别存在命令注入漏洞，主要是开发者未对用户的输入进行严格过滤导致。</p>
	
	<p>针对linux我们可以使用 ; 针对windows使用 &&  例如: 127.0.0.1 && dir</p>
        
        <p>中等级别增加了客户端验证。</p>
        
        <p>高级别增加了服务器验证.</p>

	</div></td>
	</tr>
	</table>
	
	</div>
	
	<br />
	
	<p>参考网址: http://www.owasp.org/index.php/Command_Injection</p>

</div>
