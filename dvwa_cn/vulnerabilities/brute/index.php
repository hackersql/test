<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'漏洞: 暴力破解';
$page[ 'page_id' ] = 'brute';

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

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/brute/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'brute';
$page[ 'source_button' ] = 'brute';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>漏洞: 暴力破解</h1>

	<div class=\"vulnerable_code_area\">

		<h2>登陆</h2>

		<form action=\"#\" method=\"GET\">
			用户名:<br><input type=\"text\" name=\"username\"><br>
			密  码:<br><input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password\"><br>
			<input type=\"submit\" value=\"登陆\" name=\"Login\">
		</form>

		{$html}

	</div>
    <h3><font color=\"red\">测试方法：</font></h3>
    <div class=\"vulnerable_code_area\">
    请使用BurpSuite进行测试
    <a href=\"http://www.waitalone.cn/post/Burpsuite_pro_v1.5.01.html\" target=\"_blank\"><font color=\"blue\">
Burpsuite_pro_v1.5.01多平台破解版下载</font></a><br /><br />
    <iframe class=\"tscplayer_inline\" name=\"tsc_player\" src=\"Bruteforce/Bruteforce_player.html\" scrolling=\"no\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe><br /><br />
    </div>
    
	<h2>更多信息</h2>
	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://www.owasp.org/index.php/Testing_for_Brute_Force_%28OWASP-AT-004%29')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.securityfocus.com/infocus/1192')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.sillychicken.co.nz/Security/how-to-brute-force-http-forms-in-windows.html')."</li>
	</ul>
</div>
";

dvwaHtmlEcho( $page );

?>