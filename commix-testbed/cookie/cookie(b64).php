<?php
$cookie_name = "user";
$cookie_value = base64_encode("guest");
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo exec("echo Hello, '".base64_decode($_COOKIE[($cookie_name)])."'!");
}
?>