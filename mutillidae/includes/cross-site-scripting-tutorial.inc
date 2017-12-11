<?php
	/*
	 * @author: Jeremy Druin
	 */
?>

<div>&nbsp;</div>
<table class="tutorial">
	<tr class="tutorial-title">
		<td colspan="10">Cross-Site Scripting Tutorial</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
			Cross-Site Scripting occurs because a script is displayed in page output but is not properly encoded.
			Because of the lack of proper encoding, the browser will execute the script rather than display it as data.
			Pages that encode all dynamic output are generally immune. The page will simply display the script as text
			rather than execute the script as code.		 
		</td>
	</tr>
	<tr>
		<td>
			The first step to Cross-Site Scripting is to determine which of the sites input is displayed as output.
			Some input is immediately output on the same or next page. These pages are candidates for reflected 
			Cross-Site Scripting. Some input may be stored in a database and output later on the appropriate page.
			These situations may be ripe for the most dangerous type of XSS; persistent XSS.
			<br/><br/>
			Developers may treat input from forms carefully, while completely ignoring input passed via URL Query
			Parameters, Cookies, HTTP Headers, Logs, Emails, etc. The key is to encode ALL output and not just output
			that came into the site via forms/POST.
			<br/><br/>
			Methodology: For each page under scrutiny, enter a unique string into each form field, 
			url query parameter, cookie value, HTTP Header, etc., record which value has which unique string, 
			submit the page, then observe the resulting page to see if any of your unique strings appeared. 
			Upon finding a unique string, note which value had contained that string and record this on your map.
			<br/><br/>
			Unfortunately the input could end up as output on any page within the site, all pages within the site, 
			or none of them. If the values are not reflected immediately but presented on a later page (for example
			in search results) then it should be assumed the value is stored in a database.   
		</td>
	</tr>
	<tr>
		<td>
			The second step is to test all the input locations from step #1 with various scripts, css, html tags, etc. 
			and observe the resulting output. If the site fails to encode output, it is a candidate for XSS.
			<br/><br/>
			Methodology: Enter interesting characters such as angle brackets for HTMLi and XSS, Cascading style 
			sheet symbols, etc. to see if the site encodes this output. If the site does not encode output, try 
			inserting XSS, CSS, HTML, etc. and watch for execution. If the site has a WAF, this is likely the point
			at which you will detect the WAF presence.
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
			Examples
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>Many examples can be found at <a href="http://ha.ckers.org/xss.html">http://ha.ckers.org/xss.html</a></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>This example is of stealing a cookie. This could be reflected or persistent. 
		To make this persistent, try to get the script stored into
		a database field which is later output onto a web page.
	</td></tr>
	<tr>
		<td>
			<?php 
				$lOutput1 = "<script>alert('Cookies which do not have the HTTPOnly attribute set: ' + document.cookie);</script>";	
				echo $Encoder->encodeForHTML($lOutput1);
			?>
		</td>
	</tr>
	<tr>
		<td>
			Same example with the single-quotes escaped for databases such as MySQL.<br /><br />
			<?php 
				$lOutput2 = "<script>alert(\'Cookies which do not have the HTTPOnly attribute set: \' + document.cookie);</script>";	
				echo $Encoder->encodeForHTML($lOutput2);
			?>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>Cross site scripting will work in any unencoded output. It does not matter if the value being output
	initially came from a form field (usually POST) or URL parameteres (GET). If fact the value can come from any
	source. For example, if a web page outputs the user-agent string in whole or part, you can use a tool such 
	as User-Agent Switcher plug-in for Firefox to attempt XSS via the User-Agent HTTP Header. Any HTTP Header
	can be forged with or without tools. If you would like to forge an HTTP Header without tools, try Netcat. Other
	options include intercepting and changing the web request after the request leaves the browser. Burp Suite
	is an excellent tool to try on your own machine. Try changing the user-agent to the XSS examples on this page.
	Also, try this sample HTML injection.
	</td></tr>
	<tr><td>
			<?php 
				$lOutput1 = '<h1>Sorry. There has been a system error.<br /><br />Please login again</h1><br/>Username<input type="text"><br/>Password<input type="text"><br/><br/><input type="submit" value="Submit"><h1>&nbsp;</h1>';	
				echo $Encoder->encodeForHTML($lOutput1);
			?>	
	</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>

