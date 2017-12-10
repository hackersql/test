<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'介绍';
$page[ 'page_id' ] = 'instructions';

$docs = array(
	'readme' => array( 'legend' => '使用说明', 'file' => 'README.txt' ),
	'changelog' => array( 'legend' => '更新日志', 'file' => 'CHANGELOG.txt' ),
	'copying' => array( 'legend' => '版权协议', 'file' => 'COPYING.txt' ),
	'PHPIDS-license' => array( 'legend' => 'PHPIDS 证书', 'file' => DVWA_WEB_PAGE_TO_PHPIDS.'LICENSE' ),
);

$selectedDocId = isset( $_GET[ 'doc' ] ) ? $_GET[ 'doc' ] : '';
if( !array_key_exists( $selectedDocId, $docs ) ) {
	$selectedDocId = 'readme';
}
$readFile = $docs[ $selectedDocId ][ 'file' ];

$instructions = file_get_contents( DVWA_WEB_PAGE_TO_ROOT.$readFile );

function urlReplace( $matches ) {
	return dvwaExternalLinkUrlGet( $matches[1] );
}

// Make links and obfuscate the referer...
$instructions = preg_replace_callback(
	'/((http|https|ftp):\/\/([[:alnum:]|.|\/|?|=]+))/',
	'urlReplace',
	$instructions
);

$instructions = nl2br( $instructions );

$docMenuHtml = '';
foreach( array_keys( $docs ) as $docId ) {
	$selectedClass = ( $docId == $selectedDocId ) ? ' selected' : '';
	$docMenuHtml .= "<span class=\"submenu_item{$selectedClass}\"><a href=\"?doc={$docId}\">{$docs[$docId]['legend']}</a></span>";
}
$docMenuHtml = "<div class=\"submenu\">{$docMenuHtml}</div>";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>系统介绍</h2>

	{$docMenuHtml}

	<span class=\"fixed\">
	{$instructions}
	</span>
</div>
";

dvwaHtmlEcho( $page );

?>
