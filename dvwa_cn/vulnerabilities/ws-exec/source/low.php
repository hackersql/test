<?php 
/*  In the low level, neither the form nor the service do any validation.
 * 
 */

$html .= "
                <h2>Ping����</h2>
		<p>���������ı���������һ��ip��ַ:</p>
		<form name=\"ping\" action=\"javascript: beginPingLow()\">
			<input id=\"pingAddress\" type=\"text\" name=\"ip\" size=\"30\">
			<input id=\"pingButton\" type=\"Submit\" value=\"ȷ��\" name=\"submit\">
		</form>
                <div id=\"results\"></div>";
?>