<?php
  if(stristr(php_uname('s'), 'Windows NT')){
    die("Invalid operating system.");
  } else {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    exec("echo '".$user_agent."' | grep Firefox", $output, $return);
    if (!$return) {
        echo "Viva La Mozilla Firefox!";
    } else {
        echo "Please, download Mozilla Firefox!";
    }
  }
?>