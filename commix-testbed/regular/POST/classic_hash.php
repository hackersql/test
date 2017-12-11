<b>MD5 Hash:  </b>
<?php
  $string = $_POST['string'];
  if(stristr(php_uname('s'), 'Windows NT')){
die("Invalid operating system.");
  } else {  
echo exec('echo '.$string.' | md5sum');
  }
?>