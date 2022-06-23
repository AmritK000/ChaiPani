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
	//echo $this->session->userdata('DZL_USERID'); die();
	$data 					=	array();
	$data['page']			=	'My Earning';

	$data['topup'] 			= 	0;
	$data['cashback'] 		= 	0;
	//$data['totalSpend'] 	= 	0;
	//Get total topup recharge
	$where['where'] 		=	array(
		'user_id_cred'		=>	(int)$this->session->userdata('DZL_USERID'),
		'record_type'		=>	'Credit',
	);	
	$topup = $this->geneal_model->getData2('multiple','da_loadBalance',$where);
	$totalTopup = 0;
	if(!empty($topup)){
		foreach ($topup as $key => $value) {
			$totalTopup += (int)$value['arabian_points'];
		}	
	}
	// Get total cashback
	$where2['where'] = array('user_id_cred' => $this->session->userdata('DZL_USERID'));
	$cashback = $this->geneal_model->getData2('multiple','da_cashback',$where2);

	(float)$totalCashback = 0;
	if(!empty($cashback)){
		foreach ($cashback as $key => $items) {
			$totalCashback += (float)$items['cashback'];
		}	
	}

	//get total spend by order list
	/*$where3['where'] = array('user_id' => $this->session->userdata('DZL_USERID'));
	$spendOrder = $this->geneal_model->getData2('multiple','da_orders',$where3);
	(float)$totalSpendOrder = 0;
	if(!empty($spendOrder)){
		foreach ($spendOrder as $key => $item) {
			$totalSpendOrder += (float)$item['total_price'];
		}	
	}*/
	//get total spend by load balance
	/*$where4['where'] = array('user_id' => $this->session->userdata('DZL_USERID'));
	$spendOrder = $this->geneal_model->getData2('multiple','da_loadBalance',$where4);
	(float)$totalSpendloadBalance = 0;
	if(!empty($spendOrder)){
		foreach ($spendOrder as $key => $ball) {
			$totalSpendloadBalance += (float)$ball['arabian_points'];
		}	
	}*/
	//echo $totalSpendloadBalance; die();

	$data['topup'] 			= 	$totalTopup;
	$data['cashback'] 		= 	$totalCashback;
	//$data['totalSpend'] 	= 	$totalCashback + $totalSpendloadBalance;


	$this->load->view('earning',$data);
} // END OF FUNCTION

}
