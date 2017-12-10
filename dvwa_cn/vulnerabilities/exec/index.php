<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'©��: ����ִ��';
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
	<h1>©��: ����ִ��</h1>

	<div class=\"vulnerable_code_area\">

		<h2>ping����</h2>

		<p>���������ı���������һ��ip��ַ:</p>
		<form name=\"ping\" action=\"#\" method=\"post\">
			<input type=\"text\" name=\"ip\" size=\"30\">
			<input type=\"submit\" value=\"ȷ��\" name=\"submit\">
		</form>

		{$html}

	</div>
	<h3><font color=\"red\">���Է�����</font></h3>
    <div class=\"vulnerable_code_area\">
    <font color=\"blue\">�����ʹ��IIS����ȷ����ǰ�û�Ȩ��Ϊadministrator������δ����php���������ִ����չ��<br /><br />
    ���������������127.0.0.1&&dir ��ȷ��������ɲ��ԡ�linux�������������Ӧ���ġ�</font>
    </div>

	<h2>������Ϣ</h2>
	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://www.scribd.com/doc/2530476/Php-Endangers-Remote-Code-Execution')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.ss64.com/bash/')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.ss64.com/nt/')."</li>
	</ul>
</div>
";

dvwaHtmlEcho( $page );

?>