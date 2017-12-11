<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'漏洞: 存储型跨站';
$page[ 'page_id' ] = 'xss_s';

dvwaDatabaseConnect();

$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;

	case 'medium':
		$vulnerabilityFile = 'medium.php';
		break;

	case 'high':
	default:
		$vulnerabilityFile = 'high.php';
		break;
}

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/xss_s/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'xss_s';
$page[ 'source_button' ] = 'xss_s';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>漏洞: 存储型跨站</h1>

	<div class=\"vulnerable_code_area\">

		<form method=\"post\" name=\"guestform\" onsubmit=\"return validate_form(this)\">
		<table width=\"550\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\">
		<tr>
		<td width=\"100\">用户名：</td> <td>
		<input name=\"txtName\" type=\"text\" size=\"30\" maxlength=\"10\"></td>
		</tr>
		<tr>
		<td width=\"100\">信  息：</td> <td>
		<textarea name=\"mtxMessage\" cols=\"50\" rows=\"3\" maxlength=\"50\"></textarea></td>
		</tr>
		<tr>
		<td width=\"100\">&nbsp;</td>
		<td>
		<input name=\"btnSign\" type=\"submit\" value=\"发送消息\" onClick=\"return checkForm();\"></td>
		</tr>
		</table>
		</form>

		{$html}
		
	</div>
	
	<br />
	<h3><font color=\"red\">测试方法：</font></h3>
	<div class=\"vulnerable_code_area\">
    <a href=\"../../vulnerabilities/xss_s/?txtName=anchiva&mtxMessage=<script>alert('存储型跨站测试')</script>&btnSign=%B7%A2%CB%CD%CF%FB%CF%A2\"><font color=\"blue\">点击进行存储型跨站测试</font></a><br />
    </div>
	".dvwaGuestbook()."
	<br />

	<h2>More info</h2>

	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://ha.ckers.org/xss.html')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://en.wikipedia.org/wiki/Cross-site_scripting')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.cgisecurity.com/xss-faq.html')."</li>
	</ul>
</div>
";


dvwaHtmlEcho( $page );
?>