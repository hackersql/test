<?php 
/*  In the medium level, form performs some strict validation before sending to the
 *      service which does no validation. Here the developer is relying on the client side
 *      code to do all validation, and we know what that means. 
 */

$html .= "
                <h2>Ping����</h2>
		<p>���������ı���������һ��ip��ַ:</p>
		<form name=\"ping\" action=\"javascript: beginPingHigh()\">
			<input id=\"pingAddress\" type=\"text\" name=\"ip\" size=\"30\">
			<input id=\"pingButton\" type=\"Submit\" value=\"ȷ��\" name=\"submit\">
		</form>
                <div id=\"results\"></div>";
?>