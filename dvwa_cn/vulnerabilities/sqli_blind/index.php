<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'©��: SQL äע';
$page[ 'page_id' ] = 'sqli_blind';

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

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/sqli_blind/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'sqli_blind';
$page[ 'source_button' ] = 'sqli_blind';

$magicQuotesWarningHtml = '';

// Check if Magic Quotes are on or off
if( ini_get( 'magic_quotes_gpc' ) == true ) {
	$magicQuotesWarningHtml = "	<div class=\"warning\">Magic Quotes are on, you will not be able to inject SQL.</div>";
}

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>©��: SQL äע</h1>

	{$magicQuotesWarningHtml}

	<div class=\"vulnerable_code_area\">

		<h3>�û�ID:</h3>

		<form action=\"#\" method=\"GET\">
			<input type=\"text\" name=\"id\">
			<input type=\"submit\" name=\"Submit\" value=\"ȷ��\">
		</form>

		{$html}

	</div>
	<h3><font color=\"red\">���Է�����</font></h3>
    <div class=\"vulnerable_code_area\"><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and 1=1 and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�����Ƿ���ע��,�Ա�ҳ�淵��</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and 1=2 and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�����Ƿ���ע��,�Ա�ҳ�淵��</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and left(version(),1)=5 and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�������ݿ�汾,������˵�����ݿ�汾Ϊ5.0</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and length(database())=4 and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�������ݿⳤ��,������˵��������ȷ</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and left(database(),1)='d' and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�������ݿ����Ƶ�1���ַ�</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and left(database(),2)='dv' and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�������ݿ����Ƶ�2���ַ�</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and left(database(),3)='dvw' and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�������ݿ����Ƶ�3���ַ�</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and left(database(),4)='dvwa' and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�������ݿ����Ƶ�4���ַ�</font></a><br /><br />
    
    <h3><font color=\"red\">�������������뿴ϰ�����£�</font><a href=\"http://bbs.blackbap.org/thread-3309-1-1.html\" target=\"_blank\">MySQLäע��ȫ ʵ������ ���</a></h3>
    </div>

	<h2>������Ϣ</h2>
	<ul>
                <li>".dvwaExternalLinkUrlGet( 'http://bbs.blackbap.org/thread-3309-1-1.html')."</li>
                <li>".dvwaExternalLinkUrlGet( 'http://www.securiteam.com/securityreviews/5DP0N1P76E.html')."</li>
                <li>".dvwaExternalLinkUrlGet( 'http://en.wikipedia.org/wiki/SQL_injection')."</li>
                <li>".dvwaExternalLinkUrlGet( 'http://ferruh.mavituna.com/sql-injection-cheatsheet-oku/')."</li>
                <li>".dvwaExternalLinkUrlGet( 'http://pentestmonkey.net/cheat-sheet/sql-injection/mysql-sql-injection-cheat-sheet')."</li>
	</ul>
</div>
";

dvwaHtmlEcho( $page );

?>
