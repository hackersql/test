<?php 
/*  In the medium level, form performs some strict validation before sending to the
 *      service which does no validation. Here the developer is relying on the client side
 *      code to do all validation, and we know what that means. 
 */

$html .= "
                <h2>Ping测试</h2>
		<p>请在下面文本框中输入一个ip地址:</p>
		<form name=\"ping\" action=\"javascript: beginPingHigh()\">
			<input id=\"pingAddress\" type=\"text\" name=\"ip\" size=\"30\">
			<input id=\"pingButton\" type=\"Submit\" value=\"确定\" name=\"submit\">
		</form>
                <div id=\"results\"></div>";
?>