<?php
define( 'DVWA_WEB_PAGE_TO_ROOT', '../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Source';

$id = $_GET[ 'id' ];

$lowsrc = @file_get_contents("./{$id}/source/low.php");
$lowsrc = str_replace( array( '$html .=' ), array( 'echo' ), $lowsrc);
$lowsrc = highlight_string($lowsrc, true);

$medsrc = @file_get_contents("./{$id}/source/medium.php");
$medsrc = str_replace( array( '$html .=' ), array( 'echo' ), $medsrc);
$medsrc = highlight_string($medsrc, true);

$highsrc = @file_get_contents("./{$id}/source/high.php");
$highsrc = str_replace( array( '$html .=' ), array( 'echo' ), $highsrc);
$highsrc = highlight_string($highsrc, true);

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
elseif ($id == 'xss_s'){
	$vuln = '存储型跨站';
}
elseif ($id == 'captcha'){
	$vuln = '不安全的验证码';
}
elseif ($id == 'ws-exec'){
	$vuln = 'WebServices命令执行';
}



$page[ 'body' ] .= " 

	<div class=\"body_padded\">
	<h1>".$vuln."</h1>
	
	<br />
	
	<h3>高安全级别 ".$vuln." 源代码</h3>
	
	<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
	<tr>
	<td><div id=\"code\">".$highsrc."</div></td>
	</tr>
	</table>
	
	<br />
	
	<h3>中安全级别 ".$vuln." 源代码</h3>
	
	<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
	<tr>
	<td><div id=\"code\">".$medsrc."</div></td>
	</tr>
	</table>
	
	<br />
	
	<h3>低安全级别 ".$vuln." 源代码</h3>
	
	<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
	<tr>
	<td><div id=\"code\">".$lowsrc."</div></td>
	</tr>
	</table>
	
	<br />
	<br />
	
	<FORM><INPUT TYPE=\"button\" VALUE=\"<-- 后退\" onClick=\"history.go(-1);return true;\"> </FORM> 
	
	</div>
	
";

dvwaSourceHtmlEcho( $page );
?>
