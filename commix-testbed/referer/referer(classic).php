<?php
$referer = $_SERVER['HTTP_REFERER'];
if(isset($referer)){
echo exec("echo It is always good to remember where you came from... \(Referer: '".$referer."'\)");
}
?>