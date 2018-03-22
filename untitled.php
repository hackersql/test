<?php
//调试显错语句
ini_set('display_errors','On');

error_reporting(E_ALL);

system($_GET["cmd"]);

system("whois " . $_GET["domain"]);

include($_GET['page']);

include("includes/".$_GET['library'].".php"); 

include('includes/class_'.addslashes($_GET['class']).'.php');
?>

<?php
	$file = str_replace('../', '', $_GET['str_replace']);
	if(isset($file))
	{
		include("pages/$file");
	}
	else
	{
		include("index.php");
	}
?>

<?php
	if (substr($_GET['substr'], -4, 4) != '.php')
 		echo file_get_contents($_GET['substr']);
	else
 		echo 'You are not allowed to see source files!'."\n";
?>

<?php
if (preg_match('/^[-a-z0-9]+\.a[cdefgilmnoqrstuwxz]|b[abdefghijmnorstvwyz]|c[acdfghiklmnoruvxyz]|d[ejkmoz]|e[cegrstu]|f[ijkmor]|g[abdefghilmnpqrstuwy]|h[kmnrtu]|i[delmnoqrst]|j[emop]|k[eghimnprwyz]|l[abcikrstuvy]|m[acdeghklmnopqrstuvwxyz]|n[acefgilopruz]|om|p[aefghklmnrstwy]|qa|r[eosuw]|s[abcdeghijklmnortuvyz]|t[cdfghjklmnoprtvwz]|u[agksyz]|v[aceginu]|w[fs]|y[et]|z[amw]|biz|cat|com|edu|gov|int|mil|net|org|pro|tel|aero|arpa|asia|coop|info|jobs|mobi|name|museum|travel|arpa|xn--[a-z0-9]+$/', strtolower($_GET["domain"])))
        { system("whois -h " . $_GET["server"] . " " . $_GET["domain"]); } 
    else 
        {echo "malformed domain name";}
 ?>

<?php
   # Execute command!
   $addr = $_GET['addr'];
   if(isset($addr)){
     if( stristr(php_uname('s'), 'Windows NT')){
       # Windows-based command execution.
       echo exec('ping  '.$addr, $output, $return);
     } else {
       # Unix-based command execution.
       exec("/bin/ping -c 4 ".$addr, $output, $return);
     }
     if (!$return) {
       echo "The ip ".$addr." seems to be up and running!";
     } else {
       echo "The ip ".$addr." seems to be down!";
     }
   }
?>

<?php
if (isset($_GET["addr"])){
   if (base64_encode(base64_decode($_GET["addr"])) === $_GET["addr"]){
     if( stristr(php_uname('s'), 'Windows NT')){
       # Windows-based command execution.
<       echo exec('ping '.base64_decode($_GET["addr"]));
     } else {
       # Execute command!
       echo exec("/bin/ping -c 4 ".base64_decode($_GET["addr"]));
     }
   } else {
       echo 'Please, encode your input to Base64 format.';
   }
}
?>

<?php
   $addr = $_GET["addr"];
   # Blacklisting command injection separators.
   $blacklisting = array(
     ';' => '',
     '&&'=> '',
     '|' => '',
     '`' => ''
    );
   $addr = str_replace(array_keys($blacklisting),$blacklisting,$addr);
   if( stristr(php_uname('s'), 'Windows NT')){
     # Windows-based command execution.
     echo exec('ping '.$addr);
   } else {
     # Unix-based command execution.
     echo exec("/bin/ping -c 4 ".$addr);
   }
?>