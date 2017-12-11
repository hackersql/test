<?php
header('Content-Type:text/html; charset=gb2312');
define( 'DVWA_WEB_PAGE_TO_ROOT', '' );

require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'phpids' ) );

dvwaDatabaseConnect();

if( isset( $_POST[ 'Login' ] ) ) {


	$user = $_POST[ 'username' ];
	$user = stripslashes( $user );
	$user = mysql_real_escape_string( $user );

	$pass = $_POST[ 'password' ];
	$pass = stripslashes( $pass );
	$pass = mysql_real_escape_string( $pass );
	$pass = md5( $pass );

	$qry = "SELECT * FROM `users` WHERE user='$user' AND password='$pass';";

	$result = @mysql_query($qry) or die('<pre>' . mysql_error() . '</pre>' );

	if( $result && mysql_num_rows( $result ) == 1 ) {	// Login Successful...

		dvwaMessagePush( "You have logged in as '".$user."'" );
		dvwaLogin( $user );
		dvwaRedirect( 'index.php' );

	}

	// Login failed
	dvwaMessagePush( "登陆失败,新重新输入密码!" );
	dvwaRedirect( 'login.php' );
}

$messagesHtml = messagesPopAllToHtml();

Header( 'Cache-Control: no-cache, must-revalidate');		// HTTP/1.1
Header( 'Content-Type: text/html;charset=UTF-8' );		// TODO- proper XHTML headers...
Header( "Expires: Tue, 23 Jun 2009 12:00:00 GMT");		// Date in the past

echo "

<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />

		<title>安信华Web弱点测试系统2012 - 登陆</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/css/login.css\" />

	</head>

	<body onLoad=\"document.loginForm.username.focus();\">

	<div align=\"center\">
	
	<br />
	<br />
	<br />
	<br />

	<p><img src=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/images/login_logo.png\" height=\"40\" width=\"268\"/></p>

	<br />
	<br />
	
	<form action=\"login.php\" method=\"post\" name=\"loginForm\">
	
	<fieldset>

			<label for=\"username\">用户名</label> <input type=\"text\" class=\"loginInput\" size=\"20\" name=\"username\"><br />
	
			
			<label for=\"password\">密 码</label> <input type=\"password\" class=\"loginInput\" AUTOCOMPLETE=\"off\" size=\"20\" name=\"password\"><br />
			
			
			<p class=\"submit\"><input type=\"submit\" value=\"登陆\" name=\"Login\"></p>

	</fieldset>

	</form>

	
	<br />

	{$messagesHtml}

	<br />
	<br />
	<br />
	<br />


	<!-- <img src=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/images/RandomStorm.png\" /> -->

	<a href=\"http://www.anchiva.com/\" target=\"_blank\">安信华Web弱点演示系统2012</a>
	
	</div> <!-- end align div -->

	</body>

</html>
";

?>
