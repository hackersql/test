<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
echo exec("echo '".$user_agent."'");
?>