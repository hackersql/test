<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'©��: ��վ����α��';
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
	<h1>©��: ��վ����α�� (CSRF)</h1>

	<div class=\"vulnerable_code_area\">
	
	<h3>�޸Ĺ���Ա����:</h3>
    <br>
    <form action=\"#\" method=\"GET\">";
	
	if (dvwaSecurityLevelGet() == 'high'){
		$page[ 'body' ] .= "Current password:<br>
		<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_current\"><br>";
	}
    
$page[ 'body' ] .= "    ������������:<br>
    <input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_new\"><br>
    ��������һ��: <br>
    <input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_conf\">
    <br>
    <input type=\"submit\" value=\"����\" name=\"Change\">
    </form>
	
	{$html}

	</div>
	<h3><font color=\"red\">���Է�����</font></h3>
    <div class=\"vulnerable_code_area\">
    <a href=\"".dvwaGetCurrentUrl()."?password_new=admin888&password_conf=admin888&Change=%B8%FC%B8%C4\"><font color=\"blue\">�����Ҳ��ԣ����뽫������Ϊadmin888</font></a>
    </div>
	<h2>������Ϣ</h2>
	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://www.owasp.org/index.php/Cross-Site_Request_Forgery')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.cgisecurity.com/csrf-faq.html')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://en.wikipedia.org/wiki/Cross-site_request_forgery')."</li>
	</ul>
</div>
";

dvwaHtmlEcho( $page );

?>