<?php
	
	set_time_limit (0);	
	require_once 'config.php';
	require_once FACEBOOK_API_PATH;
	
	// CREATE FACEBOOK INSTANCE
	$facebookObj = new Facebook(array(
									  'appId'  => APP_ID,
									  'secret' => APP_SECRET
										)
								);
	
	// GET THE FACEBOOK USER-ID
	try 
	{    
		$userID = $facebookObj->getUser();    
		
	} 
	catch (FacebookApiException $e) 
	{    
		print '<br/>Exception ==> ' . $e->getMessage();
	}
	
	print '<br/>USER ID ==> ' . $userID;
	
	print '<br/>Session Data: <br/><pre>';
		print_r($_SESSION);
	print '</pre>';
	
	print 
	'
	<!DOCTYPE html>
	<html xmlns:fb="http://www.facebook.com/2008/fbml">
	<body>
	';
	
	// IF THE USERID EXISTS, GET THE USER INFORMATION
	if(!empty($userID))
	{
		try
		{
			$profileInfo = $facebookObj->api('/me');	
		}
		catch(FacebookApiException $e)
		{
			$userID = null;
			print '<br/>Exception ==> ' . $e->getMessage();
		}
	}

	if(!empty($userID))
		require_once 'loggedinView.php';
	else
		require_once 'loggedoutView.php';

	print 
	"
		<div id=\"fb-root\"></div>
		<script>
		window.fbAsyncInit = function() {
		FB.init({
		appId: '".$facebookObj->getAppID()."',
		cookie: true,
		xfbml: true,
		oauth: true
		});
		FB.Event.subscribe('auth.login', function(response) {
		window.location.reload();
		});
		FB.Event.subscribe('auth.logout', function(response) {
		window.location.reload();
		});
		};
		(function() {
		var e = document.createElement('script'); e.async = true;
		e.src = document.location.protocol +
		'//connect.facebook.net/en_US/all.js';
		document.getElementById('fb-root').appendChild(e);
		}());
		</script>
	</body>
	</html>
	";
?>