<style>
#button{
	position: absolute;
	 top: 50%;
	 left: 50%;
	 margin-left: -(X/2)px;
	 margin-top: -(Y/2)px;
}
</style>
<?php
//Include FB config file && User class
require_once 'fbConfig.php';
require_once 'User.php';

if(!$fbUser){
	$fbUser = NULL;
	$loginURL = $facebook->getLoginUrl(array('redirect_uri'=>$redirectURL,'scope'=>$fbPermissions));
	$output = '<a href="'.$loginURL.'">
	<img src="images/fblogin-btn.png" id="button"></a>';
}else{
	//Get user profile data from facebook
	$fbUserProfile = $facebook->api('/me?fields=id,first_name,last_name,email,link,gender,locale,picture');

	//Initialize User class
	$user = new User();

	//Insert or update user data to the database
	$fbUserData = array(
		'oauth_provider'=> 'facebook',
		'oauth_uid' 	=> $fbUserProfile['id'],
		'first_name' 	=> $fbUserProfile['first_name'],
		'last_name' 	=> $fbUserProfile['last_name'],
		'email' 		=> $fbUserProfile['email'],
		'gender' 		=> $fbUserProfile['gender'],
		'locale' 		=> $fbUserProfile['locale'],
		'picture' 		=> $fbUserProfile['picture']['data']['url'],
		'link' 			=> $fbUserProfile['link']
	);
	$userData = $user->checkUser($fbUserData);

	//Put user data into session
	$_SESSION['userData'] = $userData;

	if (isset($_SESSION['userData']) && !empty($_SESSION['userData']))
	{
		include 'dashboard.php';
	}
else{
		$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reapers</title>
<style type="text/css">
h1{font-family:Arial, Helvetica, sans-serif;color:#999999;}
body{
	background-repeat: no-repeat;
	background-size: 100% 100%;
}
</style>
</head>
<body background="images/project-1.jpg">
<div><?php echo $output; ?></div>
</body>
</html>
