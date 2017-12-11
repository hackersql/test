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
elseif ($id == 'xss_s'){
	$vuln = '�洢�Ϳ�վ';
}
elseif ($id == 'captcha'){
	$vuln = '����ȫ����֤��';
}
elseif ($id == 'ws-exec'){
	$vuln = 'WebServices����ִ��';
}



$page[ 'body' ] .= " 

	<div class=\"body_padded\">
	<h1>".$vuln."</h1>
	
	<br />
	
	<h3>�߰�ȫ���� ".$vuln." Դ����</h3>
	
	<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
	<tr>
	<td><div id=\"code\">".$highsrc."</div></td>
	</tr>
	</table>
	
	<br />
	
	<h3>�а�ȫ���� ".$vuln." Դ����</h3>
	
	<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
	<tr>
	<td><div id=\"code\">".$medsrc."</div></td>
	</tr>
	</table>
	
	<br />
	
	<h3>�Ͱ�ȫ���� ".$vuln." Դ����</h3>
	
	<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
	<tr>
	<td><div id=\"code\">".$lowsrc."</div></td>
	</tr>
	</table>
	
	<br />
	<br />
	
	<FORM><INPUT TYPE=\"button\" VALUE=\"<-- ����\" onClick=\"history.go(-1);return true;\"> </FORM> 
	
	</div>
	
";

dvwaSourceHtmlEcho( $page );
?>
