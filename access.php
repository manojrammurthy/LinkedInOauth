<?php
session_start();
require_once('Linkedin_Lib/linkedinApi.php');
require_once('Linkedin_Lib/linkedinConfig.php');

$git = new linkedinApi($config);
$val = $git->getAccessToken();
var_dump($val);
var_dump($_SESSION);
?>