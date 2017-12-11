<div class="page-title">DNS Lookup</div><br /><br />
<form action="index.php?page=dns-lookup.php" method="post" enctype="application/x-www-form-urlencoded">
	<table style="margin-left:auto; margin-right:auto;">
		<tr id="id-bad-cred-tr" style="display: none;">
			<td colspan="2" class="error-message">
				Error: Invalid Input
			</td>
		</tr>
		<tr><td></td></tr>
		<tr>
			<td colspan="2" class="form-header">Who would you like to do a DNS lookup on?<br/>Enter IP or hostname</td>
		</tr>
		<tr><td></td></tr>
		<tr>
			<td class="label">Hostname/IP</td>
			<td><input type="text" name="target_host" size="20"></td>
		</tr>
		<tr><td></td></tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<input name="dns-lookup-php-submit-button" class="button" type="submit" value="Lookup DNS" />
			</td>
		</tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
	</table>
</form>

<?php
	if (isset($_POST["dns-lookup-php-submit-button"])){
		// Grab inputs
		$targethost = $_POST["target_host"];
		
		try {	    	
	    	switch ($_SESSION["security-level"]){
	    		case "0": // This code is insecure. No input validation is performed.
					$targethost_validated=true;
					$lTargetHostText = $targethost; //allow XSS by not encoding output
	    		break;
	    		
	    		case "5": // This code is fairly secure
	    			//We validate that an IP is 4 octets
	    			//We validate that domain name is IANA format
					// Credits: IP - Jeremy Druin
					// Credits : IANA - http://www.shauninman.com/archive/2006/05/08/validating_domain_names
	    			$ip_pattern = '/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/';
	    			$domain_name_pattern = '/^([a-z0-9]([-a-z0-9]*[a-z0-9])?\\.)+((a[cdefgilmnoqrstuwxz]|aero|arpa)|(b[abdefghijmnorstvwyz]|biz)|(c[acdfghiklmnorsuvxyz]|cat|com|coop)|d[ejkmoz]|(e[ceghrstu]|edu)|f[ijkmor]|(g[abdefghilmnpqrstuwy]|gov)|h[kmnrtu]|(i[delmnoqrst]|info|int)|(j[emop]|jobs)|k[eghimnprwyz]|l[abcikrstuvy]|(m[acdghklmnopqrstuvwxyz]|mil|mobi|museum)|(n[acefgilopruz]|name|net)|(om|org)|(p[aefghklmnrstwy]|pro)|qa|r[eouw]|s[abcdeghijklmnortvyz]|(t[cdfghjklmnoprtvwz]|travel)|u[agkmsyz]|v[aceginu]|w[fs]|y[etu]|z[amw])$/i';
	    			$targethost_validated = preg_match($ip_pattern, $targethost) || preg_match($domain_name_pattern, $targethost);
	    			$lTargetHostText = $Encoder->encodeForHTML($targethost);
	    		break;
	    	}// end switch
	    	
	    	if ($targethost_validated){
	    		echo '<p class="report-header">Results for '.$lTargetHostText.'<p>';
    			echo '<pre class="report-details">';
    			echo shell_exec("nslookup " . $targethost);
				echo '<pre>';
				$LogHandler->writeToLog("Executed operating system command: nslookup " . $targethost);
	    	}else{
	    		echo '<script>document.getElementById("id-bad-cred-tr").style.display=""</script>';
	    	}// end if ($targethost_validated){

    	} catch (Exception $e) {
			echo $CustomErrorHandler->FormatError($e, "Input: " . $targethost);
    	}// end try
    	
	}// end if (isset($_POST)) 
?>

<?php
	// Begin hints section
	if ($_SESSION["showhints"]) {
		echo '
			<table>
				<tr><td class="hint-header">Hints</td></tr>
				<tr>
					<td class="hint-body">
						<ul class="hints">
						  	<li><b>For Command Injection Flaws:</b> Directly building a command to use in a
								shell? Bad idea! Check out command separators like ; and && depending on if 
								you are using Linux or Windows respectively.
							</li>
						</ul>
					</td>
				</tr>
			</table>'; 
	}//end if ($_SESSION["showhints"])

	if ($_SESSION["showhints"] == 2) {
		include_once './includes/command-injection-tutorial.inc';
	}// end if
	
	if ($_SESSION["showhints"] == 2) {
		include_once './includes/cross-site-scripting-tutorial.inc';
	}// end if
?>