<?php
if( stristr(php_uname('s'), 'Windows NT')){
  die("Invalid operating system.");
} else {
  $server_name = $_SERVER["SERVER_NAME"];
  $referer = $_SERVER['HTTP_REFERER'];
  exec("echo '".$referer."' | grep '".$server_name."'", $output, $return);
}
if (!$return) {
    echo "Welcome to ".$server_name."!";
}else{
    echo "Hey, what are you trying to do?!";
}
?>