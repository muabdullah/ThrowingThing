<?php 
	// path constants
	define('WEBROOT',$_SERVER['DOCUMENT_ROOT']);
	define('FACEBOOK_API_PATH',WEBROOT . '/facebook-php-sdk-5ba36bc/src/facebook.php');
	define('FACEBOOK_API_PATH_NEW',WEBROOT . '/facebook-php-sdk-5ba36bc/src/');
	
	// application constants, provided by facebook
	define('APP_ID','');
	define('APP_NAME','');
	define('APP_SECRET','');
	
	// facebook integration constants
	define('APP_REQUIRED_PERMS','offline_access,read_friendlists,publish_stream,publish_actions');
	define('APP_REDIRECT_URL','http://local.fb.com');
	define('APP_LOGIN_DIALOGUETYPE','popup');	
?>