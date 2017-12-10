<?php

   	switch ($_SESSION["security-level"]){
   		case "0": // This code is insecure
   			$lProtectCookies = FALSE;
   		break;
	    		
   		case "5": // This code is fairly secure
   			$lProtectCookies = TRUE;
   		break;
   	}// end switch

    /* Precondition: $_REQUEST["do"] is not NULL */
    switch ($_REQUEST["do"]) {
	    case "logout":
		    $_SESSION['loggedin'] = 'False';
		    $_SESSION['logged_in_user'] = '';
		    $_SESSION['logged_in_usersignature'] = '';   	
	    	setcookie("uid", "", time()-3600);
	    	header("Location: index.php?page=login.php", true, 302);
	    	exit();
		break;//case "logout"
	
		case "toggle-hints":
			// see if their even is a cookie
			if (isset($_COOKIE["showhints"])){
				$l_showhints = $_COOKIE["showhints"];
			}else{
				$l_showhints = 0;
			}// end if

			/* Make hints go up a level or roll over*/
			$l_showhints += 1;
			if ($l_showhints > $C_MAX_HINT_LEVEL){
				$l_showhints = 0;
			}// end if
			
			/* Syncronize session with cookie. User might have changed cookie. */
			$_SESSION["showhints"] = $l_showhints_cookie;
			
			switch ($l_showhints_cookie){
				case 0: $_SESSION["hints-enabled"] = "Disabled (".$l_showhints_cookie." - I try harder)"; break;
				case 1: $_SESSION["hints-enabled"] = "Enabled (".$l_showhints_cookie." - 5cr1pt K1dd1e)"; break;
				case 2: $_SESSION["hints-enabled"] = "Enabled (".$l_showhints_cookie." - Noob)"; break;
			}// end switch
			
			/*
			 * If in secure mode, we want the cookie to be protected
			 * with HTTPOnly flag. There is some irony here. In secure code,
			 * we are to ignore authorization cookies, so we are protecting
			 * a cookie we know we are going to ignore. But the point is to
			 * provide an example to developers of proper coding techniques.
			 */
			if ($lProtectCookies){
				setcookie('showhints', $l_showhints.";HTTPOnly");
			}else {
				setcookie('showhints', $l_showhints);
			}// end if
			
			$_COOKIE["showhints"] = $l_showhints;
		    header("Location: ".$_SERVER['SCRIPT_NAME'].'?'.str_ireplace('do=toggle-hints&', '', $_SERVER['QUERY_STRING']), true, 302);
			exit();
		break;//case "toggle-hints"
		
		case "toggle-security":
			if ($_SESSION["security-level"] == '0') {
				$_SESSION["security-level"] = '5';
		    } else {
				$_SESSION["security-level"] = '0';
		    }// end if

		    /* Disable hints unless we are on security level 0.
		     * There is a way to defeat this.
		     */
			if ($_SESSION['security-level'] != 0){
		    	$_SESSION['showhints'] = FALSE;
				$_SESSION["hints-enabled"] = "Disabled";
				setcookie('showhints', '0');
			}// end if		    

			// change how much information errors barf onto the page.
		    $CustomErrorHandler->setSecurityLevel($_SESSION["security-level"]);
		    $LogHandler->setSecurityLevel($_SESSION["security-level"]);

		    header("Location: ".$_SERVER['SCRIPT_NAME'].'?'.str_ireplace('do=toggle-security&', '', $_SERVER['QUERY_STRING']), true, 302);
		    exit();
		    break;//case "toggle-hints"		
		
		default: break;
    }// end switch
?>