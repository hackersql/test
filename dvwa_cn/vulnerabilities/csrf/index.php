<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'漏洞: 跨站请求伪造';
$page[ 'page_id' ] = 'csrf';

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

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/csrf/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'csrf';
$page[ 'source_button' ] = 'csrf';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>漏洞: 跨站请求伪造 (CSRF)</h1>

	<div class=\"vulnerable_code_area\">
	
	<h3>修改管理员密码:</h3>
    <br>
    <form action=\"#\" method=\"GET\">";
	
	if (dvwaSecurityLevelGet() == 'high'){
		$page[ 'body' ] .= "Current password:<br>
		<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_current\"><br>";
	}
    
$page[ 'body' ] .= "    请输入新密码:<br>
    <input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_new\"><br>
    请再输入一次: <br>
    <input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_conf\">
    <br>
    <input type=\"submit\" value=\"更改\" name=\"Change\">
    </form>
	
	{$html}

	</div>
	<h3><font color=\"red\">测试方法：</font></h3>
    <div class=\"vulnerable_code_area\">
    <a href=\"".dvwaGetCurrentUrl()."?password_new=admin888&password_conf=admin888&Change=%B8%FC%B8%C4\"><font color=\"blue\">单击我测试，密码将被更改为admin888</font></a>
    </div>
	<h2>更多信息</h2>
	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://www.owasp.org/index.php/Cross-Site_Request_Forgery')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.cgisecurity.com/csrf-faq.html')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://en.wikipedia.org/wiki/Cross-site_request_forgery')."</li>
	</ul>
</div>
";

dvwaHtmlEcho( $page );

?>