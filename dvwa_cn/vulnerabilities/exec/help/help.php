<div class="body_padded">
	<h1>帮助 - 命令执行</h1>
	
	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">

	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;命令执行(命令注入)攻击的目的，是在易受攻击的应用程序中执行攻击者指定的命令，在这样的情况下应用程序执行了不必要的命令就相当于是攻击者得到了一个系统的Shell，攻击者可以利用它绕过系统授权，基于权限继承原则，Shell将具有和应用程序一样的权限。<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;命令执行是由于开发人员对用户的输入未进行严格的过滤导致，通常可以通过表单,cookie,以及http头进行操作。</p>
	
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;针对linux系统，我们可以使用;来实行命令执行,针对windows系统，我们可以使用&&来实行命令执行。例如: 127.0.0.1 && dir</p>

	</div></td>
	</tr>
	</table>
	
	</div>
	
	<br />
	
	<p>参考网址: http://www.owasp.org/index.php/Command_Injection</p>

</div>
