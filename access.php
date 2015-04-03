<?php
session_start();
 if($_SESSION['val'] == $_GET['state']){

require_once('Linkedin_Lib/linkedinApi.php');
require_once('Linkedin_Lib/linkedinConfig.php');

$git = new linkedinApi($config);
$new = $git->access();
$accessT = $new['access_token'];
$expiresT = $new['expires_in'];
$_SESSION['access_token']= $accessT;
// echo "access_token =".$accessT ."<br>";
// echo "<br> expiry time = ".$expiresT."<br>";
  
}
 else 
  {
  	echo "CSRF attack ";
  	exit;
  }
$user = fetch('GET', '/v1/people/~:(firstName,lastName)');
print "Hello $user->firstName $user->lastName.";
exit;

function fetch($method, $resource, $body = '') {
    //print $_SESSION['access_token'];
 
    $opts = array(
        'http'=>array(
            'method' => $method,
            'header' => "Authorization: Bearer " . $_SESSION['access_token'] . "\r\n" . "x-li-format: json\r\n"
        )
    );
 
    // Need to use HTTPS
    $url = 'https://api.linkedin.com' . $resource;
 
    // Append query parameters (if there are any)
    if (count($params)) { $url .= '?' . http_build_query($params); }
 
    // Tell streams to make a (GET, POST, PUT, or DELETE) request
    // And use OAuth 2 access token as Authorization
    $context = stream_context_create($opts);
 
    // Hocus Pocus
    $response = file_get_contents($url, false, $context);
 
    // Native PHP object, please
    return json_decode($response);
}
?>