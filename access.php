<?php
session_start();
echo $_SESSION['val'];
if($_SESSION['val'] == $_GET['state']){

require_once('Linkedin_Lib/linkedinApi.php');
require_once('Linkedin_Lib/linkedinConfig.php');

$git = new linkedinApi($config);

$str = $git->result;
$delimiter = 'Path=/';
$c = substr_count($git->result,'Path=/');
$a = explode('Path=/',$git->result);

  $j = json_decode($a[$c]);
  echo $j->access_token;
  echo "<br>".$j->expires_in;
}
else 
{
	echo "CSRF attack ";
}
?>