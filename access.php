<?php
session_start();
 if($_SESSION['val'] == $_GET['state']){

require_once('Linkedin_Lib/linkedinApi.php');
require_once('Linkedin_Lib/linkedinConfig.php');

$git = new linkedinApi($config);
$new = $git->access();
$accessT = $new['access_token'];
$expiresT = $new['expires_in'];
echo "access_token =".$accessT ."<br>";
echo "<br> expiry time = ".$expiresT."<br>";
  
}
 else 
  {
  	echo "CSRF attack ";
  }


?>