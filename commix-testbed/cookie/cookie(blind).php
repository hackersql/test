<?php
$cookie_name = "addr";
$cookie_value = $_SERVER['REMOTE_ADDR'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" .$cookie_name. "' is not set!";
} else {
  if( stristr(php_uname('s'), 'Windows NT')){ 
    # Windows-based command execution.
    exec("ping " . $_COOKIE[$cookie_name], $output, $return); 
  } else {
    # Unix-based command execution.
    exec("/bin/ping -c 4 " . $_COOKIE[$cookie_name], $output, $return);
  }
  if (!$return) {
      echo "Hey ".$cookie_value.", you are alive!";
  } else {
      echo "Oops ".$cookie_value.", you are dead beef :/";
  }
}
?>