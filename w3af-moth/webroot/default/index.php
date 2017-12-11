<h3>/etc/hosts</h3>
<p>The following should be configured in your /etc/hosts in order to access the applications correctly:</p>
<hr>
<?
$server_ip = $_SERVER['SERVER_ADDR'];

if ($handle = opendir('../')) {

    while (false !== ($entry = readdir($handle))) {
        if ( strpos($entry, '.') === false ){
            echo "$server_ip    <a href='http://$entry/'>$entry</a><br />\n";
        }
    }

    closedir($handle);
}

?>
<hr>
