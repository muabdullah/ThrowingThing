<?php
	class appResponse
	{
		/*
		Call this function to return success
		@return array
		*/
		public static returnSuccess($responseData = null)
		{
			$responseObj = array
							(
							'isError' => false
							);
			if(empty($responseData))
			{
				$responseObj['hasData'] = false;
				return $responseObj;
			}
			
			$responseObj['hasData'] = true;
			$responseObj['data'] = $responseData;
			return $responseObj;
		}
		/*
		Call this function to return failure
		@return array
		*/
		public static returnFailure($errorCode,$errorMsg)
		{
			return array
					(
					'isError' => true,
					'errorCode' => $errorCode,
					'errorMsg' => $errorMsg
					);
		}
	}
?>