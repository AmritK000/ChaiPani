<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct(); 
	}

	/***********************************************************************
	** Function name : sendNotificationToAllUsers
	** Developed By : Ravi Kumar
	** Purpose  : This is get send send Notification To All Users
	** Date : 08 APRIL 2021
	************************************************************************/
	public function sendNotificationToAllUsers($notificationIDs='',$message='',$data=array(),$legencyKey='')
	{
		if(!empty($notificationIDs) && !empty($message) && !empty($data) && !empty($legencyKey)):
			
			$fields 	= 	array('to'=>$notificationIDs,'notification'=>$message,'data'=>$data);
			$headers 	= 	array('Authorization: key='.$legencyKey,'Content-Type:application/json');
				
			#Send Reponse To FireBase Server	
    		$ch = curl_init();
    		curl_setopt( $ch,CURLOPT_URL,'https://fcm.googleapis.com/fcm/send');
    		curl_setopt( $ch,CURLOPT_POST,true);
    		curl_setopt( $ch,CURLOPT_HTTPHEADER,$headers);
    		curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
    		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,true);
    		curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode($fields));
    		$result = curl_exec($ch);
    		curl_close($ch);
    		//echo "<pre>";print_r($result);die;
			return $result;
		endif;
	}	// END OF FUNCTION

	/* * *********************************************************************
	 * * Function name : sendNotificationToMultipleUserFunction 
	 * * Developed By : Manoj Kumar
	 * * Purpose  : This function use for send Notification To Multiple User Function
	 * * Date : 26 NOVEMBER 2021
	 * * **********************************************************************/
	public function sendNotificationToMultipleUserFunction($registrationIds='',$message='',$data=array(),$deviceType='') {
		if(!empty($registrationIds) && !empty($message) && !empty($data) && !empty($deviceType)):
			$fields 		= 	array('registration_ids'=>$registrationIds,'notification'=>$message,'data'=>$data);
			//if($deviceType == 'Andriod'):
			//	$headers 	= 	array('Authorization: key='.BRAINTRAIN_USER_ANDRIOD_KEY,'Content-Type:application/json');
		//	elseif($deviceType == 'IOS'):
			//	$headers 	= 	array('Authorization: key='.BRAINTRAIN_USER_IOS_KEY,'Content-Type:application/json');
			//endif;

			$legency_key = 'AAAAPSbkqN0:APA91bG62sJBsMbByoglG7gU3KtBvYzILY9ElN7F5FOCDrgHpuciHlLDJXuflpu4NZlR31-DdWVGdXwM_QjM5VQtl4nHVhGpEWIvlyrZLY32DylZi-hzizY-JlF71kxEcluJo_r--u8v';
			$headers = array('Authorization: key='.$legency_key,'Content-Type: application/json');

			#Send Reponse To FireBase Server 	
			$ch = curl_init();
			curl_setopt( $ch,CURLOPT_URL,'https://fcm.googleapis.com/fcm/send');
			curl_setopt( $ch,CURLOPT_POST,true);
			curl_setopt( $ch,CURLOPT_HTTPHEADER,$headers);
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode($fields));
			$result = curl_exec($ch);
			curl_close($ch);
			#Echo Result Of FireBase Server 
			//echo "<pre>"; print_r($result); die;
			return $result;
		endif;
	}	// END OF FUNCTION	

	/***********************************************************************
	** Function name : sendBRConfirmationNotificationToMultipleUser
	** Developed By : Manoj Kumar
	** Purpose  : This is use for send Booking Request Confirmation Notification To Multiple User
	** Date : 26 NOVEMBER 2021
	************************************************************************/
	function sendBRConfirmationNotificationToMultipleUser($registrationIds='',$prodId='',$deviceType='',$title='',$message='') { 
		//echo $title.'  '.$message;die;
		if($registrationIds && $deviceType):
			$message 		= 	array('body'=>$message,
						 	 		  'title'=>$title,
             	         	 		  'icon'=>'myicon',
              	         	 		  'sound'=>'mySound'
          				 	 		  ); 
	
			//$data			=	array('notCatId'=>'1','prodId'=>$prodId);
			$data			=	array('notification'=>$title,'message'=>$message);
            $fields 	    = 	array('to'=>$registrationIds,'notification'=>$message,'data'=>$data);
			$returnMessage	=	$this->sendNotificationToMultipleUserFunction($registrationIds,$message,$data,$deviceType);
			return $returnMessage;
		endif;
	}
}	