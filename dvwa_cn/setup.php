<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'��װ';
$page[ 'page_id' ] = 'setup';

if( isset( $_POST[ 'create_db' ] ) ) {

	if ($DBMS == 'MySQL') {
		include_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/DBMS/MySQL.php';
	}
	elseif ($DBMS == 'PGSQL') {
		include_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/DBMS/PGSQL.php';
	}
	else {
		dvwaMessagePush( "ERROR: Invalid database selected. Please review the config file syntax." );
		dvwaPageReload();
	}

}


$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>���ݿⰲװ <img src=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/images/spanner.png\"></h1>

	<p>�뵥������İ�װ/�������ݿⰲװ��������򱨴�����/config/config.inc.php��root�����Ƿ���ȷ��</p>

	<p>������ݿ��Ѿ����ڣ���������Ϊ���ԭ�����ݲ�д��Ĭ�����ݡ�</p>

	<br />

	���ݿ�����: <b>".$DBMS."</b>

	<br /><br /><br />
	
	<!-- Create db button -->
	<form action=\"#\" method=\"post\">
		<input name=\"create_db\" type=\"submit\" value=\"����/���� ���ݿ�\">
	</form>
</div>
";


dvwaHtmlEcho( $page );

?>
