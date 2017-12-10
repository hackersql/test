<?php
	// Grab username and password from URL query parameters
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];

    try {
	   	switch ($_SESSION["security-level"]){
	   		case "0": // This code is insecure
	   			$query  = "SELECT * FROM accounts WHERE username='". $username ."' AND password='" . ($password) . "'";		
	   			$lProtectCookies = FALSE;
	   		break;
		    		
	   		case "5": // This code is fairly secure
	  			/* 
	  			 * Note: While escaping works ok in some case, it is not the best defense.
	  			 * Using stored procedures is a much stronger defense.
	  			 */ 
	   			$query  = "SELECT * FROM accounts WHERE username='". mysql_real_escape_string($username) ."' AND password='" . mysql_real_escape_string($password) . "'";
	   			$lProtectCookies = TRUE;
	   		break;
	   	}// end switch

		$LogHandler->writeToLog("Attempt to log in by user: " . $username);
	   	
		$result = mysql_query($query);
		if (mysql_errno()>0) {
	    	throw (new Exception('Error: '.mysql_error($conn), mysql_errno()));
	    }// end if

	    if (mysql_num_rows($result) > 0) {
		    $row = mysql_fetch_array($result, MYSQL_ASSOC);
			$failedloginflag=0;
			$_SESSION['loggedin'] = 'True';
			$_SESSION['uid'] = $row['cid'];
			$_SESSION['logged_in_user'] = $row['username'];
			$_SESSION['logged_in_usersignature'] = $row['mysignature'];
			
			/*
			 * If in secure mode, we want the cookie to be protected
			 * with HTTPOnly flag. There is some irony here. In secure code,
			 * we are to ignore authorization cookies, so we are protecting
			 * a cookie we know we are going to ignore. But the point is to
			 * provide an example to developers of proper coding techniques.
			 * 
			 * Note: Ideally this cookie must be protected with SSL also but
			 * again this is just a demo. Once your in SSL mode, maintain SSL
			 * and escalate any requests for HTTP to HTTPS.
			 */
			if ($lProtectCookies){
				$lUserID = $row['cid'] . ";HTTPOnly";
			}else {
				$lUserID = $row['cid'];
			}// end if
			
			$LogHandler->writeToLog("Logged in user: " . $row['username']);
			
			/* Set client-side auth token. if we are in insecure mode, we will
			 * pay attention to client-side authorization tokens. If we are secure,
			 * we dont use client-side authortization tokens and we ignore any
			 * attempts to use them. */
			setcookie("uid", $lUserID);
			header('Location: index.php', true, 302);
		} else {
			$failedloginflag=1;
    	}// end if (mysql_num_rows($result) > 0)
	    
	} catch (Exception $e) {
		echo $CustomErrorHandler->FormatError($e, $query);
	}// end try
?>