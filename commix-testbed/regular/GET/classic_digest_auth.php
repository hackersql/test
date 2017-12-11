<?php
$realm = 'Restricted area';
//user => password
$users = array('admin' => 'admin');

if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="'.$realm.'",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');
    die('Text to send if user hits Cancel button');
}


// analyze the PHP_AUTH_DIGEST variable
if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) || !isset($users[$data['username']])){
    header("HTTP/1.0 401 Unauthorized");
    print "Sorry - you need valid credentials to be granted access!\n";
    exit;  
}

// generate the valid response
$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);

if ($data['response'] != $valid_response){
    header("HTTP/1.0 401 Unauthorized");
    print "Sorry - you need valid credentials to be granted access!\n";
    exit;  
}

// function to parse the http auth header
function http_digest_parse($txt)
{
    // protect against missing data
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}
?>

<?php
  $addr = $_GET['addr'];
  if( stristr(php_uname('s'), 'Windows NT')){
    # Windows-based command execution.
    echo exec('ping '.$addr);
  } else {
    # Unix-based command execution.
    echo exec("/bin/ping -c 4 ".$addr);
  }
?>