<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';
require_once DVWA_WEB_PAGE_TO_ROOT."external/recaptcha/recaptchalib.php";

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'©��: ����ȫ����֤��';
$page[ 'page_id' ] = 'captcha';

// ReCAPTCHA Key configuration
// Global Keys provided by 

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

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/captcha/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'captcha';
$page[ 'source_button' ] = 'captcha';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>©��: ����ȫ����֤��</h1>

	<div class=\"vulnerable_code_area\">

  	<h3>������������: </h3>
    	<br>
    	<form action=\"#\" method=\"POST\"";
if ($hide_form) $page[ 'body' ] .= "style=\"display:none;\"";


$page[ 'body' ] .= ">
		<input type=\"hidden\" name=\"step\" value=\"1\" />";

        if (dvwaSecurityLevelGet() == 'high'){
                $page[ 'body' ] .= "Current password:<br>
                <input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_current\"><br>";
        }

	$page[ 'body' ] .= "    ������������:<br>
		<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_new\"><br>
		��������һ��: <br>
	        <input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_conf\">
			" . recaptcha_get_html($_DVWA['recaptcha_public_key']) . "
			<br />
			<input type=\"submit\" value=\"����\" name=\"Change\">
	</form>

	{$html}

</div>

    <h3><font color=\"red\">���Է�����</font></h3>
    <div class=\"vulnerable_code_area\">
        <form action=\"#\" method=\"post\">
            <input type=\"hidden\" name=\"step\" value=\"2\">
            <input type=\"hidden\" name=\"password_new\" value=\"admin888\">
            <input type=\"hidden\" name=\"password_conf\" value=\"admin888\">
            <input type=\"submit\" name=\"Change\" value=\"�����Ҳ���\"><font color=\"blue\">�ύ���ƹ���֤�룬�����������Ϊ��admin888</font>
        </form>
    </div>

	<h2>������Ϣ</h2>
	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://www.captcha.net/')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.google.com/recaptcha/')."</li>
	</ul>
</div>
";

dvwaHtmlEcho( $page );

?>
