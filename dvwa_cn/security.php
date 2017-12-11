<?php
Header( 'Content-Type: text/html;charset=gb2312' );
define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'安全级别';
$page[ 'page_id' ] = 'security';

$securityHtml = '';
if( isset( $_POST['seclev_submit'] ) ) {
	$securityLevel = 'high';

	switch( $_POST[ 'security' ] ) {
		case 'low':
			$securityLevel = 'low';
			break;
		case 'medium':
			$securityLevel = 'medium';
			break;
	}

	dvwaSecurityLevelSet( $securityLevel );
	dvwaMessagePush( "安全级别被设置为：{$securityLevel}" );
	dvwaPageReload();
}


if( isset( $_GET['phpids'] ) ) {
	switch( $_GET[ 'phpids' ] ) {
		case 'on':
			dvwaPhpIdsEnabledSet( true );
			dvwaMessagePush( "PHPIDS 已经开启" );
			break;
		case 'off':
			dvwaPhpIdsEnabledSet( false );
			dvwaMessagePush( "PHPIDS 已经禁用" );
			break;
	}

	dvwaPageReload();
}


$securityOptionsHtml = '';
$securityLevelHtml = '';
foreach( array( 'low', 'medium', 'high' ) as $securityLevel ) {
	$selected = '';
	if( $securityLevel == dvwaSecurityLevelGet() ) {
		$selected = ' selected="selected"';
		$securityLevelHtml = "<p>目前的安全级别：<em>$securityLevel</em>.<p>";
	}
	$securityOptionsHtml .= "<option value=\"{$securityLevel}\"{$selected}>{$securityLevel}</option>";
}

$phpIdsHtml = 'PHPIDS 状态： ';
if( dvwaPhpIdsIsEnabled() ) {
	$phpIdsHtml .= '<em>启用</em>. [<a href="?phpids=off">禁用 PHPIDS</a>]';
} else {
	$phpIdsHtml .= '<em>禁用</em>. [<a href="?phpids=on">开启 PHPIDS</a>]';
}

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>安全级别 <img src=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/images/lock.png\"></h1>

	<br />
	
	<h2>脚本安全级别</h2>

	{$securityHtml}

	<form action=\"#\" method=\"POST\">
		{$securityLevelHtml}
		<p>你可以设置安全级别为低，中或者高。</p>
		<p>安全级别将改变脚本漏洞的级别。</p>

		<select name=\"security\">
			{$securityOptionsHtml}
		</select>
		<input type=\"submit\" value=\"Submit\" name=\"seclev_submit\">
	</form>

	<br />
	<hr />
	<br />

	<h2>PHPIDS</h2>

	<p>".dvwaExternalLinkUrlGet( 'http://php-ids.org/', 'PHPIDS' )." v.".dvwaPhpIdsVersionGet()." (PHP入侵检测系统) 是基于php应用的安全检测程序</p>
	<p>你可以在此开启或者是禁用PHPIDS</p>

	<p>{$phpIdsHtml}</p>
	[<a href=\"?test=%22><script>eval(window.name)</script>\">模拟攻击</a>] -
	[<a href=\"ids_log.php\">查看IDS日志</a>]
	
</div>
";


dvwaHtmlEcho( $page );

?>
