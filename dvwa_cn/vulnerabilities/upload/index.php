<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'漏洞: 文件上传';
$page[ 'page_id' ] = 'upload';

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

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/upload/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'upload';
$page[ 'source_button' ] = 'upload';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>漏洞: 文件上传</h1>

	<div class=\"vulnerable_code_area\">

		<form enctype=\"multipart/form-data\" action=\"#\" method=\"POST\" />
			<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"100000\" />
			请选择一个要上传的图片:
			<br />
			<input name=\"uploaded\" type=\"file\" /><br />
			<br />
			<input type=\"submit\" name=\"Upload\" value=\"上传\" />
		</form>

		{$html}

	</div>
	<h3><font color=\"red\">测试方法：</font></h3>
    <div class=\"vulnerable_code_area\"><br />
        <h4><font color=\"blue\">请直接上传webshell即可。</font></h4>
    </div>
	<h2>更多信息</h2>
	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://www.owasp.org/index.php/Unrestricted_File_Upload')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://blogs.securiteam.com/index.php/archives/1268')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.acunetix.com/websitesecurity/upload-forms-threat.htm')."</li>
	</ul>

</div>

";

dvwaHtmlEcho( $page );

?>