<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/core/My_Head.php");
class Earning extends My_Head {

	public function  __construct() 
	{ 
		parent:: __construct();
		$this->load->model('geneal_model');
	} 
	/***********************************************************************
	** Function name 	: index
	** Developed By 	: AFSAR AlI
	** Purpose 			: This function used for index
	** Date 			: 13 APRIL 2022
	** Updated By		: Afsar Ali
	** Updated Date 	: 17 May 2022
	************************************************************************/ 	
	public function index()
	{  
		$data 					=	array();
		$data['page']			=	'My Earning';

		$data['signupBonus'] 	= 	0;
		$data['cashback'] 		= 	0;
		$data['topup'] 			= 	0;
		$data['referral'] 		= 	0;
		$data['totalEarned'] 	= 	0;

		// Get total signup bonus
		$where['where'] 		=	array('user_id_cred'=>(int)$this->session->userdata('DZL_USERID'),'record_type'=>'Credit','arabian_points_from'=>'Signup Bonus');	
		$signupBonusData 		= 	$this->geneal_model->getData2('multiple','da_loadBalance',$where);
		$signupBonus = 0;
		if(!empty($signupBonusData)){
			foreach ($signupBonusData as $key => $value) {
				$signupBonus += (float)$value['arabian_points'];
			}	
		}

		// Get total cashback
		$where1['where'] 		=	array('user_id_cred'=>(int)$this->session->userdata('DZL_USERID'),'record_type'=>'Credit','arabian_points_from'=>'Membership Cashback');	
		$cashbackData 			= 	$this->geneal_model->getData2('multiple','da_loadBalance',$where1);
		$cashback = 0;
		if(!empty($cashbackData)){
			foreach ($cashbackData as $key1 => $value1) {
				$cashback += (float)$value1['arabian_points'];
			}	
		}

		// Get total topup
		$where2['where'] 		=	array('user_id_cred'=>(int)$this->session->userdata('DZL_USERID'),'record_type'=>'Credit','arabian_points_from'=>'Recharge');	
		$topupData 				= 	$this->geneal_model->getData2('multiple','da_loadBalance',$where2);
		$topup = 0;
		if(!empty($topupData)){
			foreach ($topupData as $key2 => $value2) {
				$topup += (int)$value2['arabian_points'];
			}	
		}

		// Get total referral
		$where3['where'] 		=	array('user_id_cred'=>(int)$this->session->userdata('DZL_USERID'),'record_type'=>'Credit','arabian_points_from'=>'Referral');	
		$referalData 			= 	$this->geneal_model->getData2('multiple','da_loadBalance',$where3);
		$referral = 0;
		if(!empty($referalData)){
			foreach ($referalData as $key3 => $value3) {
				$referral += (float)$value3['arabian_points'];
			}	
		}

		$data['signupBonus'] 	= 	$signupBonus;
		$data['cashback'] 		= 	$cashback;
		$data['topup'] 			= 	$topup;
		$data['referral'] 		= 	$referral;
		$data['totalEarned'] 	= 	($signupBonus+$cashback+$topup+$referral);

		$this->load->view('earning',$data);
	} // END OF FUNCTION
}