<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Source';

$id = $_GET[ 'id' ];
$security = $_GET[ 'security' ];


if ($id == 'fi'){
	$vuln = '�ļ�����';
}
elseif ($id == 'brute'){
	$vuln = '�����ƽ�';
}
elseif ($id == 'csrf'){
	$vuln = '��վ����α��';
}
elseif ($id == 'exec'){
	$vuln = '����ִ��';
}
elseif ($id == 'sqli'){
	$vuln = 'SQL ע��';
}
elseif ($id == 'sqli_blind'){
	$vuln = 'SQL äע(Blind)';
}
elseif ($id == 'upload'){
	$vuln = '�ļ��ϴ�';
}
elseif ($id == 'xss_r'){
	$vuln = '�����Ϳ�վ';
}
elseif ($id == 'captcha'){
	$vuln = '����ȫ����֤��';
}
elseif ($id == 'ws-exec'){
	$vuln = 'WebServices����ִ��';
}
else {
	$vuln = '�洢�Ϳ�վ';
}


$source = @file_get_contents( DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/{$id}/source/{$security}.php" );
$source = str_replace( array( '$html .=' ), array( 'echo' ), $source );

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>".$vuln." Դ����</h1>
	
	<div id=\"code\">
	<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
	<tr>
	<td><div id=\"code\">".highlight_string( $source, true )."</div></td>
	</tr>
	</table>
	
	</div>
	
	<br />
	<br />
	
	<FORM><INPUT TYPE=\"BUTTON\" VALUE=\"�Ƚ�\" ONCLICK=\"window.location.href='view_source_all.php?id=$id'\">
</FORM>

</div>
";

dvwaSourceHtmlEcho( $page );

?>
