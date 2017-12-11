<?php
$addr = $_POST['addr'];
if(isset($addr)){
  echo "<b>Ping Results:</b><br>".exec("/bin/ping -c 4 \"{$addr}\"");
}
?>