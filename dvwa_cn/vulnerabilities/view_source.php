<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Source';

$id = $_GET[ 'id' ];
$security = $_GET[ 'security' ];


if ($id == 'fi'){
	$vuln = '文件包含';
}
elseif ($id == 'brute'){
	$vuln = '暴力破解';
}
elseif ($id == 'csrf'){
	$vuln = '跨站请求伪造';
}
elseif ($id == 'exec'){
	$vuln = '命令执行';
}
elseif ($id == 'sqli'){
	$vuln = 'SQL 注入';
}
elseif ($id == 'sqli_blind'){
	$vuln = 'SQL 盲注(Blind)';
}
elseif ($id == 'upload'){
	$vuln = '文件上传';
}
elseif ($id == 'xss_r'){
	$vuln = '反射型跨站';
}
elseif ($id == 'captcha'){
	$vuln = '不安全的验证码';
}
elseif ($id == 'ws-exec'){
	$vuln = 'WebServices代码执行';
}
else {
	$vuln = '存储型跨站';
}


$source = @file_get_contents( DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/{$id}/source/{$security}.php" );
$source = str_replace( array( '$html .=' ), array( 'echo' ), $source );

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>".$vuln." 源代码</h1>
	
	<div id=\"code\">
	<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
	<tr>
	<td><div id=\"code\">".highlight_string( $source, true )."</div></td>
	</tr>
	</table>
	
	</div>
	
	<br />
	<br />
	
	<FORM><INPUT TYPE=\"BUTTON\" VALUE=\"比较\" ONCLICK=\"window.location.href='view_source_all.php?id=$id'\">
</FORM>

</div>
";

dvwaSourceHtmlEcho( $page );

?>
