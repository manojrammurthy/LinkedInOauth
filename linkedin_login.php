<?php
require_once('Linkedin_Lib/linkedinConfig.php');
$url = "https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=".$config['client_id']."&redirect_uri=".$config['redirect_url']."&state=9844027600&scope=r_basicprofile";
header('location:$url');
?>