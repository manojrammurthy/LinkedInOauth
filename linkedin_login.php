<?php
session_start();
require_once('Linkedin_Lib/linkedinConfig.php');
$_SESSION['val'] = mt_rand();
$url = "https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=".$config['client_id']."&redirect_uri=".$config['redirect_url']."&state=".$_SESSION['val']."&scope=r_basicprofile";
header("location: $url");


?>