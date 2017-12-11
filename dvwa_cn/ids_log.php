<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

define( 'DVWA_WEB_ROOT_TO_PHPIDS_LOG', 'external/phpids/'.dvwaPhpIdsVersionGet().'/lib/IDS/tmp/phpids_log.txt' );
define( 'DVWA_WEB_PAGE_TO_PHPIDS_LOG', DVWA_WEB_PAGE_TO_ROOT.DVWA_WEB_ROOT_TO_PHPIDS_LOG );

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'PHPIDS 日志';
$page[ 'page_id' ] = 'log';
//$page[ 'clear_log' ]; <- Was showing error.

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>PHPIDS 日志</h1>
	
	<p>". dvwaReadIdsLog() ."</p>
	
	<br />
	<br />
	
	<form action=\"#\" method=\"GET\">
    <input type=\"submit\" value=\"清理日志\" name=\"clear_log\">
    </form>
	
	".dvwaClearIdsLog()."
	
</div>
";


dvwaHtmlEcho( $page );

?>
