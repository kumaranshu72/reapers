<?php
session_start();

//Include Facebook SDK
require_once 'inc/facebook.php';

/*
 * Configuration and setup FB API
 */
$appId = '1363671087016283'; //Facebook App ID
$appSecret = '7498525c13478f47ea1be236d967533b'; // Facebook App Secret
$redirectURL = 'http://localhost/reap/login.php'; // Callback URL
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret
));
$fbUser = $facebook->getUser();
?>
