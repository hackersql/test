<?php
	try {
		$conn = mysql_connect($dbhost, $dbuser, $dbpass);// or die('Error connecting to mysql');		
		mysql_select_db($dbname);// or die('Did you <a href="setupreset.php">setup/reset the DB</a>? <p><b>SQL Error:</b>' . mysql_error($conn) . '<p><b>SQL Statement:</b>' . $query);
		if (mysql_errno()>0) {
	    	throw (new Exception('Error: '.mysql_error($conn), mysql_errno()));
	    }// end if
	}catch(Exception $e){
		$lLine = $e->getLine();
		$lCode = $e->getCode();
		$lFile = $e->getFile();
		$lMessage = $e->getMessage();
		$lTrace = $e->getTraceAsString();
		
		echo 	
		'<table>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr>
				<td colspan="2" class="error-header">Error: Failure is always an option and this situation proves it</td>
			</tr>
			<tr>
				<td class="error-label">Line</td><td class="error-detail">' . $lLine . '</td>
			</tr>
			<tr>
				<td class="error-label">Code</td><td class="error-detail">' . $lCode . '</td>
			</tr>
			<tr>
				<td class="error-label">File</td><td class="error-detail">' . $lFile . '</td>
			</tr>
			<tr>
				<td class="error-label">Message</td><td class="error-detail">' . $lMessage . '</td>
			</tr>
			<tr>
				<td class="error-label">Trace</td><td class="error-detail">' . $lTrace . '</td>
			</tr>
			<tr>
				<td colspan="2" class="error-header" style="text-align: center;">Did you <a href="setupreset.php">setup/reset the DB</a>?</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
		</table>';
		
		exit();
	}// end try/catch
?>