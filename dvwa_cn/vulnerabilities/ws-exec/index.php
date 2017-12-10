<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'漏洞: WebServices 命令执行';
$page[ 'page_id' ] = 'ws-exec';

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

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/ws-exec/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'ws-exec';
$page[ 'source_button' ] = 'ws-exec';

// TODO: Create JS to submit request to WS and return data to form.
// TODO: Modify form to submit to WebService
$page[ 'body' ] .= "
<script type=\"text/javascript\" src=\"" .  DVWA_WEB_PAGE_TO_ROOT . "external/jquery/jquery-1.6.4.min.js\"></script>
<script type=\"text/javascript\" src=\"./ws-exec.js\"></script>
<script type=\"text/javascript\" src=\"./js/jquery-1.7.2.min.js\"></script>
<script type=\"text/javascript\" src=\"./js/lightbox.js\"></script>

<div class=\"body_padded\">
	<h1>漏洞: WebServices 命令执行</h1>
	<div class=\"vulnerable_code_area\">
		{$html}
	</div>
	<h3><font color=\"red\">测试方法：</font></h3>
    <div class=\"vulnerable_code_area\">
        <font color=\"blue\">请使用BurpSuite配合测试<a href=\"http://www.waitalone.cn/post/Burpsuite_pro_v1.5.01.html\" target=\"_blank\">Burpsuite_pro_v1.5.01多平台破解版下载</a></font><br /><br />
        <a href=\"".dvwaGetCurrentUrl()."/webservice_exec.jpg\" rel=\"lightbox\" title=\"WebService命令执行\"><img src=\"".dvwaGetCurrentUrl()."/webservice_exec.jpg#1\" width=\"620\" height=\"360\"/></a>
    </div>

	<h2>更多信息</h2>
	<ul>
                <li>".dvwaExternalLinkUrlGet( 'http://en.wikipedia.org/wiki/Web_service')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.scribd.com/doc/2530476/Php-Endangers-Remote-Code-Execution')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.ss64.com/bash/')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.ss64.com/nt/')."</li>
	</ul>
</div>
";

dvwaHtmlEcho( $page );

?>