<?php 
/*  In the low level, neither the form nor the service do any validation.
 * 
 */

$html .= "
                <h2>Ping测试</h2>
		<p>请在下面文本框中输入一个ip地址:</p>
		<form name=\"ping\" action=\"javascript: beginPingLow()\">
			<input id=\"pingAddress\" type=\"text\" name=\"ip\" size=\"30\">
			<input id=\"pingButton\" type=\"Submit\" value=\"确定\" name=\"submit\">
		</form>
                <div id=\"results\"></div>";
?>