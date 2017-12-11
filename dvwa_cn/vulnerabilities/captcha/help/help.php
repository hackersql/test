<div class="body_padded">
	<h1>帮助 - 不安全的验证码(逻辑缺陷)</h1>
	
	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">
	
	<p><a href="http://www.captcha.net">CAPTCHA</a> 是一种人机识别的程序，用来判断访问网站的是人还是机器，你应该看到过很多网站使用了扭曲的图片或者是文字来防止"机器人"或者其它自动化的程序，CAPTCHA可以保护网站免受垃圾信息的骚扰，因为没有计算机可以识别这种技术。</p>
	
	<p>CAPTCHAs通常用来保护敏感信息，防止被机器人(自动化程序)滥用，比如用户登陆，更改密码，发布内容等等。本例中CAPTCHAs保护更改管理员密码功能，它可以从一定限度上防止CSRF攻击和自动化猜解工具。</p>

	<p>本例中的CAPTCHA很容易绕过，开发人员假设所有人都可以通过第一关的认证进行下一关，其中的密码是实际的更改，提交新密码后将直接更新到数据库中。</p>
	<p>在低安全级别来完成此次挑战所需要的参数如下：</p>
	<p>step=2&password_new=password&password_conf=password&Change=Change</p>
        
        <p>在中安全级别，开发者试图保持会话状态并跟踪它是否完成之前提交的验证码，但是("passed_captcha")状态是在在客户端上提交，所以也可以很容易绕过：</p>
        <p>step=2&password_new=password&password_conf=password&passed_captcha=true&Change=Change</p>
        
        <p>在高安全级别，开发者移除了所有的攻击途径，处理过程得到简化，使数据和CAPTCHA验证发生在一个单一的步骤，另外开发者将状态变量存佬在服务器端。</p>

	</div></td>
	</tr>
	</table>
	
	</div>
	
	<br />
	
	<p>参考网址: http://www.captcha.net/</p>

</div>
