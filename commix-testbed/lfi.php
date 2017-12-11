<?php
system($_GET["cmd"]);

system("whois " . $_GET["domain"]);

include($_GET["page"]);

include($_GET['stylepath']);

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