<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'漏洞: 命令执行';
$page[ 'page_id' ] = 'exec';

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

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/exec/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'exec';
$page[ 'source_button' ] = 'exec';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>漏洞: 代码执行</h1>

	<div class=\"vulnerable_code_area\">

		<h2>ping测试</h2>

		<p>请在下面文本框中输入一个ip地址:</p>
		<form name=\"ping\" action=\"#\" method=\"post\">
			<input type=\"text\" name=\"ip\" size=\"30\">
			<input type=\"submit\" value=\"确定\" name=\"submit\">
		</form>

		{$html}

	</div>
	<h3><font color=\"red\">测试方法：</font></h3>
    <div class=\"vulnerable_code_area\">
    <font color=\"blue\">如果你使用IIS，请确保当前用户权限为administrator，并且未禁用php中相关命令执行扩展。<br /><br />
    请在上面框中输入127.0.0.1&&dir 点确定即可完成测试。linux下面测试请作相应更改。</font>
    </div>

	<h2>更多信息</h2>
	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://www.scribd.com/doc/2530476/Php-Endangers-Remote-Code-Execution')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.ss64.com/bash/')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.ss64.com/nt/')."</li>
	</ul>
</div>
";

dvwaHtmlEcho( $page );

?>