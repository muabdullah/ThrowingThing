<?php
	
	// means the user is not logged in to the system
	$loginParams = array
					(
  					'scope' => 'offline_access,read_friendlists,publish_stream,publish_actions',
  					'redirect_uri' => 'http://local.fb.com',
					'display' => 'popup'
					);
	$loginUrl = $facebookObj->getLoginUrl($loginParams);
	
	print '<h1>Application Login Page</h1>';
	print 
	'  
	<div>     
		You are not logged in, please log in:      
		<a href="'.$loginUrl.'">
			<img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif">      
		</a>    
	</div>';		

?>