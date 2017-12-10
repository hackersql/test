			<!-- End Content -->
		</blockquote>
			</td>
		</tr>
	</table>

<?php 
		   	switch ($_SESSION["security-level"]){
		   		case "0": // This code is insecure
		   			// DO NOTHING
		   			$lUserAgentString = $_SERVER['HTTP_USER_AGENT'];
					$lPHPVersion = "PHP Version: " . phpversion();
		   		break;
			    		
		   		case "5": // This code is fairly secure
		  			/* 
		  			 * All information coming to the server in HTTP requests is under the 
		  			 * complete control of the user. This includes any information normally
		  			 * being thought of as "sent by the browser". HTTP requests are simply
		  			 * streams of strings formatting according to HTTP specifications. Anyone
		  			 * can format a string properly. A browser is not required. Try reading the RFC
		  			 * for HTTP to see how to construct the strings. Check out user-agent switchers
		  			 * like the add-on for Firefox to change only the user-agent string without
		  			 * having to create the entire header. Try Tamper Data to get control of all
		  			 * the HTTP headers in the request. Try netcat to create your own HTTP header 
		  			 * from scratch. When you get really comfortable. Try sending HTTP requests 
		  			 * via Telnet.
		  			 * 
		  			 * This code is secure because we escape all output according to context. This
		  			 * information is being output to HTML so we HTML encode the information. If we
		  			 * were outputing into JavaScript we would not use HTML encoding. We would use
		  			 * JavaScript string encoding. There are 5 contexts to be particuarly careful about.
		  			 * HTML, HTML attributes, JavaScript, CSS, and URL query parameters.
		  			 */
		   			$lUserAgentString = $Encoder->encodeForHTML($_SERVER['HTTP_USER_AGENT']);
					$lPHPVersion = "PHP Version: Not Available (Secure mode doesn't blab the server version silly)";
		   		break;
		   	}// end switch
	echo '<div class="footer">Browser: '.$lUserAgentString.'</div>';
	echo '<div class="footer">'.$lPHPVersion.'</div>';
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
							<li>Any time dynamic output is displayed by the browser, think "Cross-Site Scripting". 
							Work backwards from that output to see if there is a way to influence 
							what is output. This could be as simple as entering "123" in the first field, 
							"456" in the second field, and so on. Repeat this for all input including HTTP 
							Headers, Cookie values, Hidden Fields etc. If those inputs show up anywhere in the output 
							investigate further. Dont look for visible output. That will miss most of the output. 
							Search the entire response stream including all the HTTP Headers. If you find 
							your test strings, send in more useful characters such as "&lt;". 
							Some developers sanitize input which may later be output. 
							Others encode (escape) the input. These are nice tries but can result in
							"FAIL" because the data could be changed after it is input encoded by
							someone with access to the database, a database corrupting script, or 
							any attempts to filter/sanitize can be flawed/bypassed. To defend against
							Cross-Site Scripting, encode all output per context.</li>
							<li>Any time the application uses the HTTP headers there are multiple 
							possibilities. If the HTTP header is output into the page, think XSS. 
							Output is output
							after all. Any data output by the application which can be influenced by 
							the user is fair game for XSS. But with HTTP Headers, also consider 
							HTTP Response Splitting. HTTP Headers are delimited (separated) by line-breaks. 
							Check out the RFC on HTTP to see the specification. 
							When an application included some type of input
							as output into the HTTP Header, it may be possible to inject a line-break.
							If this is possible, then an actor could also inject a new HTTP Header of 
							there choosing. These two situations are counterparts. XSS via HTTP Headers 
							may occur when HTTP Request Headers are output into the HTTP Response. 
							HTTP Response Splitting may occur when user/database input is output into 
							HTTP Headers. </li>
							<li>Just because the application sanitized/validated/filtered the input 
							when the user sent the input doesnt mean the application is safe. The 
							database could be altered by a rouge insider, a database attack such as 
							ASPROX, or a mallicious programmer. Developers should not have access to 
							production database data; ever. Developers should not be able to copy 
							their own code into production; ever. That is what change control is for.</li>
						  	<li>All information coming to the server in HTTP requests is under the 
							  	complete control of the user. This includes any information normally 
							  	being thought of as "sent by the browser". HTTP requests are simply
	  			 				streams of strings formatting according to HTTP specifications. Anyone 
	  			 				can format an HTTP string properly. A browser is not required. 
	  			 				Try reading the RFC for HTTP to see how to construct the strings.
				  			</li>
				  			<li>The HTTP header beign displayed here is the user-agent also know as the 
					  			browser. Check out user-agent switchers like the add-on for Firefox to 
					  			change only the user-agent string without  
					  			having to create the entire header.
				  			</li>
				  			<li>Try Tamper Data to get control of all the HTTP headers in the request. 
				  			You can start by changing the user-agent to see your input displayed here.</li>
				  			<li>Try netcat to create your own HTTP header from scratch.</li>
				  			<li>When you get really comfortable. Try sending HTTP requests via Telnet.</li>
				  			<li>Sites become vulnerable to HTTP header injection when they output the HTTP headers
				  			into the page without output encoding per context first.
				  			</li>
				  			<li>
				  				This code may not be secure secure because we may or may not escape  
				  				all output according to context. This browser information is being 
				  				output to HTML so we should HTML encode the information. If we 
				  				were outputing into JavaScript we would not use HTML encoding. We would use 
				  				JavaScript string encoding. There are 5 contexts to be particuarly careful 
				  				about. HTML, HTML attributes, JavaScript, CSS, and URL query parameters.
				  			</li>
				  		</ul>
					</td>
				</tr>
			</table>'; 
	}//end if ($_SESSION["showhints"])
?>

	<div class="footer">
		The newest version of <a href="http://www.irongeek.com/i.php?page=security/mutillidae-deliberately-vulnerable-php-owasp-top-10" target="_blank">Mutillidae</a> can downloaded from <a href="http://irongeek.com" target="_blank">Irongeek's Site</a><br>
		"Ate up with suck" ~ Seth Misenar and the Pauldotcom guys
	</div>
</body>
</html>

<?php
	include 'closedb.inc';
?>
