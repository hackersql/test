<?php

if( isset( $_GET[ 'Login' ] ) ) {

	// Sanitise username input
	$user = $_GET[ 'username' ];
	$user = mysql_real_escape_string( $user );

	// Sanitise password input
	$pass = $_GET[ 'password' ];
	$pass = mysql_real_escape_string( $pass );
	$pass = md5( $pass );

	$qry = "SELECT * FROM `users` WHERE user='$user' AND password='$pass';";
	$result = mysql_query( $qry ) or die( '<pre>' . mysql_error() . '</pre>' );

	if( $result && mysql_num_rows($result) == 1 ) {
		// Get users details
		$i=0; // Bug fix.
		$avatar = mysql_result( $result, $i, "avatar" );

		// Login Successful
		$html .= "<p>登陆成功，您可以进行其它操作。" . $user . "</p>";
		$html .= '<img src="' . $avatar . '" />';
	} else {
		//Login failed
		$html .= "<pre><br>用户名或者密码错误。</pre>";
	}

	mysql_close();
}

?>