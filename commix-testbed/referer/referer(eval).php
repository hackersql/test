<?php
$referer = $_SERVER['HTTP_REFERER'];
if(isset($referer)){
eval("echo \"It's always good to remember where you came from! (".$referer.")\";");
}
?>