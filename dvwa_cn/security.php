<?php
Header( 'Content-Type: text/html;charset=gb2312' );
define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'��ȫ����';
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
	dvwaMessagePush( "��ȫ��������Ϊ��{$securityLevel}" );
	dvwaPageReload();
}


if( isset( $_GET['phpids'] ) ) {
	switch( $_GET[ 'phpids' ] ) {
		case 'on':
			dvwaPhpIdsEnabledSet( true );
			dvwaMessagePush( "PHPIDS �Ѿ�����" );
			break;
		case 'off':
			dvwaPhpIdsEnabledSet( false );
			dvwaMessagePush( "PHPIDS �Ѿ�����" );
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
		$securityLevelHtml = "<p>Ŀǰ�İ�ȫ����<em>$securityLevel</em>.<p>";
	}
	$securityOptionsHtml .= "<option value=\"{$securityLevel}\"{$selected}>{$securityLevel}</option>";
}

$phpIdsHtml = 'PHPIDS ״̬�� ';
if( dvwaPhpIdsIsEnabled() ) {
	$phpIdsHtml .= '<em>����</em>. [<a href="?phpids=off">���� PHPIDS</a>]';
} else {
	$phpIdsHtml .= '<em>����</em>. [<a href="?phpids=on">���� PHPIDS</a>]';
}

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>��ȫ���� <img src=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/images/lock.png\"></h1>

	<br />
	
	<h2>�ű���ȫ����</h2>

	{$securityHtml}

	<form action=\"#\" method=\"POST\">
		{$securityLevelHtml}
		<p>��������ð�ȫ����Ϊ�ͣ��л��߸ߡ�</p>
		<p>��ȫ���𽫸ı�ű�©���ļ���</p>

		<select name=\"security\">
			{$securityOptionsHtml}
		</select>
		<input type=\"submit\" value=\"Submit\" name=\"seclev_submit\">
	</form>

	<br />
	<hr />
	<br />

	<h2>PHPIDS</h2>

	<p>".dvwaExternalLinkUrlGet( 'http://php-ids.org/', 'PHPIDS' )." v.".dvwaPhpIdsVersionGet()." (PHP���ּ��ϵͳ) �ǻ���phpӦ�õİ�ȫ������</p>
	<p>������ڴ˿��������ǽ���PHPIDS</p>

	<p>{$phpIdsHtml}</p>
	[<a href=\"?test=%22><script>eval(window.name)</script>\">ģ�⹥��</a>] -
	[<a href=\"ids_log.php\">�鿴IDS��־</a>]
	
</div>
";


dvwaHtmlEcho( $page );

?>
