<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'安装';
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
	<h1>数据库安装 <img src=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/images/spanner.png\"></h1>

	<p>请单击下面的安装/重置数据库安装，如果程序报错请检查/config/config.inc.php中root密码是否正确。</p>

	<p>如果数据库已经存在，程序将重置为清空原有数据并写入默认数据。</p>

	<br />

	数据库类型: <b>".$DBMS."</b>

	<br /><br /><br />
	
	<!-- Create db button -->
	<form action=\"#\" method=\"post\">
		<input name=\"create_db\" type=\"submit\" value=\"创建/重置 数据库\">
	</form>
</div>
";


dvwaHtmlEcho( $page );

?>
