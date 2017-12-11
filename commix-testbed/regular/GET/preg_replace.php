<?php
  $msg = 'Hello, World!';
  $replace = $_GET['replace'];
  $with = $_GET['with'];
  if (isset($replace, $with)){
    # Execute command!
    echo preg_replace($replace, $with, $msg);
  } else {
    echo $msg;
  }
?>