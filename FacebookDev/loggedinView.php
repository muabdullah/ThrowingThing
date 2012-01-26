<?php
	// GET THE ACCESS TOKEN
	$accessToken = $facebookObj->getAccessToken();	
	// GET THE LOGOUT URL
	$logoutURL = $facebookObj->getLogoutUrl();
	
	print '<br/>Your Access Token is ==> ' . $accessToken;
	print '<br/>To LogOut click here ==> <a href="'.$logoutURL.'">Logout</a>';
	
	// this is user general information returned
	print '<br/><br/><u>Below is your user object:</u><br/>';
	print '<pre>';
		print_r($profileInfo);
	print '</pre>';
		
	// get user friend list
	$userList = $facebookObj->api('/me/friendlists', 'get');
	print '<br/>Below are your friend list ';
	if(is_array($userList['data']) && count($userList['data']) > 0)
	{
		print '(Total Friend List Count ' . count($userList['data']) . ')';
		
		print '<pre>';
			print_r($userList);
		print '</pre>';
	}
	else
	{
		if(count($userList['data']) <= 0)
			print '(You have no friends list)';
		else
			print '(Unable to grasp your friend list)';
	}	

	// get user friend list
	$userListConns = $facebookObj->api('/10150548727675712/members', 'get');
	print '<br/>Below are your friend list connections';
	if(is_array($userListConns['data']) && count($userListConns['data']) > 0)
	{
		print '(Total Friend List Connections Count ' . count($userListConns['data']) . ')';
		
		print '<pre>';
			print_r($userListConns);
		print '</pre>';
	}
	else
	{
		if(count($userListConns['data']) <= 0)
			print '(You have no friends list connections)';
		else
			print '(Unable to grasp your friend list connections)';
	}
	
	// get user friends
	// note: for profile pic ==> https://graph.facebook.com/USERID/picture
	$userFriends = $facebookObj->api('/me/friends', 'get');
	print '<br/>Below are your friend ';
	if(is_array($userFriends['data']) && count($userFriends['data']) > 0)
	{
		print '(Total Friend Count ' . count($userFriends['data']) . ')';
		
		print '<pre>';
			print_r($userFriends);
		print '</pre>';
	}
	else
	{
		if(count($userFriends['data']) <= 0)
			print '(You have no friends)';
		else
			print '(Unable to grasp your friends)';
	}
		
	/*
	// to change status message
	try 
	{
		$statusUpdate = $facebookObj->api(
										'/me/feed', 
										'post', 
										array('message'=> '=)', 'cb' => '')
										);	
		print '<pre>';
			print_r($statusUpdate);
		print '</pre>';
	} 
	catch (FacebookApiException  $e) 
	{
		print '<pre>';
			print_r($e);
		print '</pre>';
	}
	*/
		
	/*
	$postParams = array
					(
						'message'=> 'Hey I am using ThrowTest', 
						'picture' => 'http://findicons.com/files/icons/575/pleasant/128/e_mail.png',
						'link' => 'http://www.thethrowapp.com',
						'name' => 'ThrowApp',
						'caption' => 'This is ThrowApp Caption',
						'description' => 'Ah the description',
						'icon' => 'http://findicons.com/files/icons/575/pleasant/128/e_mail.png',
						'privacy' => array('value' => 'ALL_FRIENDS'),
						'type' => 'link'
					);
	
	// to post promotion on my wall
	// https://developers.facebook.com/docs/reference/api/post/
	try 
	{
		$postUpdate = $facebookObj->api(
										'/me/feed', 
										'post', 
										$postParams
										);	
		print '<pre>';
			print_r($postUpdate);
		print '</pre>';
	} 
	catch (FacebookApiException  $e) 
	{
		print '<pre>';
			print_r($e);
		print '</pre>';
	}
	*/
		
	/*
	$frdPostParams = array
					(
						'message'=> 'Hey I am using ThrowTest', 
						'picture' => 'http://findicons.com/files/icons/575/pleasant/128/e_mail.png',
						'link' => 'http://www.thethrowapp.com',
						'name' => 'ThrowApp',
						'caption' => 'This is ThrowApp Caption',
						'description' => 'Ah the description',
						'icon' => 'http://findicons.com/files/icons/575/pleasant/128/e_mail.png',
						'type' => 'link'
					);
	// to post on friends wall
	// https://developers.facebook.com/docs/reference/api/post/
	try 
	{
		$frdPostUpdate = $facebookObj->api(
										'/squadron9/feed', 
										'post', 
										$frdPostParams
										);	
		print '<pre>';
			print_r($frdPostUpdate);
		print '</pre>';
	} 
	catch (FacebookApiException  $e) 
	{
		print '<pre>';
			print_r($e);
		print '</pre>';
	}
	*/

?>