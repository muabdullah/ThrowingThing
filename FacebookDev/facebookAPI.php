<?php
	// Config that contains Facebook Application Information
	require_once 'config.php';
	// Used to return response
	require_once 'responseSender.php';
	// Include Facebook's Graph API
	require_once FACEBOOK_API_PATH_NEW . 'facebook.php';
	
	class facebookAPI
	{
		// Contains Facebook Graph API Object
		$facebookObj = null;
		
		function __construct()
		{
			$this->facebookObj = new Facebook
											(
												array
												(
												'appId'  => APP_ID,
												'secret' => APP_SECRET
												)
											);
		}
		
		/*
		Returns Facebook UserID
		@return array
		*/
		public function getFacebookUserID()
		{
			try
			{
				$userID = $this->facebookObj->getUser();
			}
			catch(FacebookApiException $e)
			{
				return appResponse::returnFailure(1,$e->getMessage());
			}
			
			return appResponse::returnSuccess($userID);
		}	 
		
		/*
		Returns Facebook User's Access Token
		@return array
		*/
		public function getFacebookUserToken()
		{
			try
			{
				$token = $this->facebookObj->getAccessToken();
			}
			catch(FacebookApiException $e)
			{
				return appResponse::returnFailure(1,$e->getMessage());
			}
			
			return appResponse::returnSuccess($token);
		}
		
		/*
		Returns Login Link
		@return array
		*/
		public function getLoginLink()
		{
			$loginParams = array
							(
							'scope' => APP_REQUIRED_PERMS,
							'redirect_uri' => APP_REDIRECT_URL,
							'display' => APP_LOGIN_DIALOGUETYPE
							);
			return $this->facebookObj->getLoginUrl($loginParams);			
		}
		
		/*
		Returns Login Link
		@return array
		*/
		public function getLogoutLink()
		{
			return $this->facebookObj->getLogoutUrl();			
		}
		
		/*
		Returns Facebook User Object
		@return array
		*/	
		public function getFacebookUserInfo($facebookUserID)
		{
			try
			{
				$profileInfo = $this->facebookObj->api("/$facebookUserID");	
			}
			catch(FacebookApiException $e)
			{
				return appResponse::returnFailure(1,$e->getMessage());
			}
			
			if(empty($profileInfo) || !is_array($profileInfo) || count($profileInfo) < 1)
				return appResponse::returnSuccess();
			return appResponse::returnSuccess($profileInfo);
		}
		
		/*
		Returns User Connections
		@return array
		*/
		public function getFacebookUserConns($facebookUserID)
		{
			try
			{
				$userFriends = $this->facebookObj->api("/$facebookUserID/friends", 'get');
			}
			catch(FacebookApiException $e)
			{
				return appResponse::returnFailure(1,$e->getMessage());
			}
			
			if(empty($userFriends['data']) || !is_array($userFriends['data']) || count($userFriends['data']) < 1)
				return appResponse::returnSuccess();
				
			return appResponse::returnSuccess($userFriends['data']);
		}
		
		/*
		Returns User Connection Lists
		@return array
		*/
		public function getFacebookUserLists($facebookUserID)
		{
			try
			{
				$userLists = $this->facebookObj->api("/$facebookUserID/friendlists", 'get');
			}
			catch(FacebookApiException $e)
			{
				return appResponse::returnFailure(1,$e->getMessage());
			}
			
			if(empty($userLists['data']) || !is_array($userLists['data']) || count($userLists['data']) < 1)
				return appResponse::returnSuccess();
				
			return appResponse::returnSuccess($userLists['data']);
		}
		
		/*
		Returns Connections in User's List
		Note: $facebookUserID is not used right now, but we may use it for logging
		@return array
		*/
		public function getFacebookUserListConns($facebookUserID,$facebookListID)
		{
			try
			{
				$listConns = $this->facebookObj->api("/$facebookListID/members", 'get');
			}
			catch(FacebookApiException $e)
			{
				return appResponse::returnFailure(1,$e->getMessage());
			}
			
			if(empty($listConns['data']) || !is_array($listConns['data']) || count($listConns['data']) < 1)
				return appResponse::returnSuccess();
				
			return appResponse::returnSuccess($listConns['data']);
		}
		
		/*
		Posts Wall Feed on User's Wall
		@return array
		*/
		public function postFacebookWallFeed(
											$facebookUserID,
											$targetUserID,
											$feedName,
											$feedCaption,
											$feedDesc,
											$feedMsg,
											$feedLink,
											$feedImg,
											$feedIcon = null
											)
		{
			// Preparing Feed Parameters
			$postParams = array
					(
						'name' => $feedName,
						'caption' => $feedCaption,
						'description' => $feedDesc,
						'message'=> $feedMsg,
						'link' => $feedLink,
						'picture' => $feedImg,
						'type' => 'link'
					);
			if(!empty($feedIcon))
				$postParams['icon'] = $feedIcon;
			// If User is posting to his own wall
			if($facebookUserID == $targetUserID)
				$postParams['privacy'] = array('value' => 'ALL_FRIENDS');
				
			try
			{
				$postWallFeed = $this->facebookObj->api
												(
												"/$targetUserID/feed", 
												'post', 
												$postParams
												);
			}
			catch(FacebookApiException $e)
			{
				return appResponse::returnFailure(1,$e->getMessage());
			}
			
			if(is_array($postWallFeed) && isset($postWallFeed['id']))
				return appResponse::returnSuccess();
			return appResponse::returnFailure(1,'Unable to post content to profile');
		}
		
		/*
		Posts Status on User's Feed
		@return array
		*/
		public function postFacebookStatus($facebookUserID,$statusMsg)
		{
			try
			{
				// can also use me instead of $facebookUserID
				$postStatus = $this->facebookObj->api
													(
													"/$facebookUserID/feed", 
													'post', 
													array
														(
														'message' => $statusMsg,
														'privacy' => array('value' => 'ALL_FRIENDS')
														)
													);
			}
			catch(FacebookApiException $e)
			{
				return appResponse::returnFailure(1,$e->getMessage());
			}
			
			if(is_array($postStatus) && isset($postStatus['id']))
				return appResponse::returnSuccess();
			return appResponse::returnFailure(1,'Unable to post status to profile');
		}
	}
?>