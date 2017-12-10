<?php

define('DVWA_WEB_PAGE_TO_ROOT', '../../');
// Pull in the NuSOAP code
require_once(DVWA_WEB_PAGE_TO_ROOT . 'external/nusoap/nusoap.php');
// Create the server instance
$server = new soap_server();
// Initialize WSDL support
$server->configureWSDL('pingaddresswsdl', 'urn:pingaddresswsdl');
// Register the method to expose
$server->register('pingAddressLow', // method name
        array('address' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:pingaddresswsdl', // namespace
        'urn:pingaddresswsdl#pingAddressLow', // soapaction
        'rpc', // style
        'encoded', // use
        'Returns the results of a ping to a remote host.'            // documentation
);
$server->register('pingAddressHigh', // method name
        array('address' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:pingaddresswsdl', // namespace
        'urn:pingaddresswsdl#pingAddressHigh', // soapaction
        'rpc', // style
        'encoded', // use
        'Returns the results of a ping to a remote host.'            // documentation
);

// Define the method as a PHP function
function pingAddressLow($address) {
    $command = "ping -n 2 " . $address;
//    $command = "ping -c 3 " . $address . " | sed 's/.*/&<br \/>/'";
    exec($command, $output);
    $results = "";
    while (list($key, $val) = each($output)):
        $results = $results . $val;
    endwhile;
    error_log($results);
    return $results;
}

// Code for the High Level.
// The application developer is validating input both client and server side.
function pingAddressHigh($address) {
    // Validate the address is a vali IP Address
    $validIPRegex = '/^\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}$/';
    if (preg_match($validIPRegex, $address)) {
        $command = "ping -n 2 " . $address;
//        $command = "ping -c 3 " . $address . " | sed 's/.*/&<br \/>/'";
        exec($command, $output);
        $results = "";
        while (list($key, $val) = each($output)):
            $results = $results . $val;
        endwhile;
        error_log($results);
        return $results;
    } else {
        error_log('错误: IP地址无效');
        return '错误: 请输入一个有效的ip地址';
    }
}

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
try {
    $server->service($HTTP_RAW_POST_DATA);
} catch (Exception $ex) {
    error_log("BOOM! " . $e->getMessage(), "\n");
}
?>
