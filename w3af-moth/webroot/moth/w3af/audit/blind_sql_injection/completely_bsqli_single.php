<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />

<?

function errorHandler( $severity, $msg, $filename, $linenum){

#echo "error found" . $msg;

}

set_error_handler("errorHandler");

$link = mysql_connect("localhost", "root", "moth");

mysql_select_db("w3af_test", $link);

if ( $_GET['debug'] ) {
echo "SELECT * FROM users where email ='" . $_GET['email'] ."'";
echo "<br>";
}

$result = mysql_query("SELECT * FROM users where email ='" . $_GET['email'] ."'", $link);
mysql_result($result, 0, "name");

echo "<i>don't get fooled by the 'static' response, the email parameter <b>is</b> injectable</i>";

?>
