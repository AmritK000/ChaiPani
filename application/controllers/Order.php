<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/core/My_Head.php");
class Order extends My_Head {
public function  __construct() 
	{ 
		parent:: __construct();
		$this->load->model('geneal_model');
		$this->lang->load('statictext','front');
	} 
/***********************************************************************
** Function name 	: index
** Developed By 	: RAVI NEGI
** Purpose 			: This function used for placed order
** Date 			: 04 MAY 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 		
public function index()
{  
	$data  = array();
	$data['page']			=	'Checkout';
	$finalPrice = 0;
	$data['sufficient_point_error'] =  '';
	$data['post_sufficient_point_error'] =  '';

	$where               =      ['users_id' => (int)$this->session->userdata('DZL_USERID') ];
	$user_data           =      $this->geneal_model->getOnlyOneData('da_users', $where);
	$where2              =      ['user_id' => (int)$this->session->userdata('DZL_USERID') ];
	$user_address        =      $this->geneal_model->getData('da_diliveryAddress', $where2,[]);
	$data['ToatlPoints'] =      $user_data['availableArabianPoints'];
	$data['dilivertAddress'] = 	$user_address;
	
	if($this->session->userdata('DZL_USERID')){
		$wcon['where']		=	[ 'user_id' => (int)$this->session->userdata('DZL_USERID') ];
		$cartItems          =	$this->geneal_model->getData2('multiple', 'da_cartItems', $wcon);
		foreach($cartItems as $CA):
			$finalPrice += $CA['qty'] * $CA['price'];

			//check Stock
			$stockCheck = $this->geneal_model->getStock($CA['id'], $CA['qty']);
		endforeach;
		$data['finalprice'] = $finalPrice;
		$data['shipping']   = 0;
		$data['finaltotal'] = $finalPrice + $data['shipping'];

		if($data['finaltotal'] > $data['ToatlPoints']){
		    $data['sufficient_point_error'] =  "You don't have sufficient Arabian points";
		}
	}else{
		redirect('login');
	}

	if($_POST){
		if($stockCheck == 0){
			$this->session->set_flashdata('error', lang('OUTOFSTOCK'));
	        redirect('user-cart');
		}elseif ($stockCheck <> 1) {
			$this->session->set_flashdata('error', lang('PRO_QTY'));
	        redirect('user-cart');
		}

		if($data['finaltotal'] > $data['ToatlPoints']){
		    //$this->session->set_flashdata('sufficient_point_error', 'You have not sufficient Arabian points');
		    //redirect('checkout');
		    $data['post_sufficient_point_error'] =  "You don't have sufficient Arabian points";
		}else{
			/* Order Place Table */
	        $ORparam["sequence_id"]		    	=	(int)$this->geneal_model->getNextSequence('da_orders');
	        $ORparam["order_id"]		        =	$this->geneal_model->getNextOrderId();
	        $ORparam["user_id"] 				=	(int)$this->session->userdata('DZL_USERID');
	        $ORparam["user_type"] 				=	$this->session->userdata('DZL_USERSTYPE');
	        $ORparam["user_email"] 				=	$this->session->userdata('DZL_USEREMAIL');
	        $ORparam["user_phone"] 				=	$this->session->userdata('DZL_USERMOBILE');
	        $ORparam["shipping_address"] 		=	$this->input->post('address');
	        $ORparam["shipping_charge"] 		=	(float)0;
	        $ORparam["total_price"] 			=	(float)$data['finaltotal'];
	        if($_POST['payment-method'] == 'arabianpoint'):
		    $ORparam["payment_mode"] 			=	'Arabian Points';
		    else:
		    $ORparam["payment_mode"] 			=	'Razorpay';
		    endif;
		    $ORparam["order_status"] 			=	"Process";
		    $ORparam["creation_ip"] 			=	$this->input->ip_address();
		    $ORparam["created_at"] 				=	date('Y-m-d H:i');
		    $this->geneal_model->addData('da_orders', $ORparam);

	        foreach($cartItems as $CA):	
				$ORDparam["order_details_id"] 	=	(int)$this->geneal_model->getNextSequence('da_orders_details');
				$ORDparam["order_sequence_id"]	=	(int)$ORparam["sequence_id"];
				$ORDparam["order_id"]			=	$ORparam["order_id"];
				$ORDparam["user_id"]			=	(int)$CA['user_id'];
				$ORDparam["product_id"] 		=	(int)$CA['id'];
				$ORDparam["product_name"] 		=	$CA['name'];
				$ORDparam["quantity"] 		    =	(int)$CA['qty'];
				$ORDparam["price"] 		        =	(float)$CA['price'];
				$ORDparam["tax"] 		        =	(float)0;
				$ORDparam["subtotal"] 		    =	(float)$CA['subtotal'];
				$ORDparam["is_donated"] 		=	$CA['is_donated'];
				$ORDparam["other"] 		        =	array(
															'image' 		=>	$CA['other']->image,
															'description' 	=>	$CA['other']->description,
															'aed'			=>	$CA['other']->aed
														);
				$this->geneal_model->addData('da_orders_details', $ORDparam);
			endforeach;
			redirect('order-success/'.$ORparam["order_id"]);
	    	/* End */
		}
	}

	$this->load->view('checkout', $data);
} // END OF FUNCTION
/***********************************************************************
** Function name 	: index
** Developed By 	: RAVI NEGI
** Purpose 			: This function used for placed order
** Date 			: 04 MAY 2022
** Updated By		: Afsar Ali
** Updated Date 	: 05 MAY 2022
************************************************************************/ 
public function success($oid='')
{  
	$data  = array();
	$data['finalPrice'] = 0;
	$data['order_id'] = $oid;
	$productIdPrice   = array();

	if(empty($this->cart->contents())):
		redirect('home');
	endif;

	//Get current order of user.
	$wcon							=	[ 'order_id' => $oid ];
	$data['orderData'] 				=	$this->geneal_model->getData2('single', 'da_orders', $wcon);
	
	//Get current order details of user.
	$wcon2['where']					=	[ 'order_id' => $oid ];
	$data['orderDetails']         	=	$this->geneal_model->getData2('multiple', 'da_orders_details', $wcon2);

	//update order status
	$updateStatus 					=	[ 'order_status' => 'Success' ];
	$updateorderstatus 				= 	$this->geneal_model->editData('da_orders', $updateStatus, 'order_id', $oid);

	//Generate coupon 
	foreach($data['orderDetails'] as $CA):
		$data['finalPrice'] += $CA['quantity'] * $CA['price'];
		$this->geneal_model->updateStock($CA['product_id'],$CA['quantity']);

		$productIdPrice[$CA['product_id']] 		=	($CA['quantity'] * $CA['price']);

		//Start Create Coupons for simple product
		for($i=0; $i < $CA['quantity']; $i++){
			A:
			$whereCon['coupon_code']	=	'';
			$whereCon['coupon_code']	=	strtoupper(uniqid(16));
			$check 	= 	$this->geneal_model->checkDuplicate('da_coupons',$whereCon);
			if($check == 0){
				$couponData['coupon_id']		= 	(int)$this->geneal_model->getNextSequence('da_coupons');
				$couponData['users_id']			= 	(int)$this->session->userdata('DZL_USERID');
				$couponData['users_email']		= 	$this->session->userdata('DZL_USEREMAIL');
				$couponData['order_id']			= 	$oid;
				$couponData['product_id']		= 	$CA['product_id'];
				$couponData['product_title']	= 	$CA['product_name'];
				$couponData['is_donated'] 		=	'N';
				$couponData['coupon_code'] 		= 	$whereCon['coupon_code'];
				$couponData['coupon_type'] 		= 	'Simple';
				$couponData['created_at']		=	date('Y-m-d H:i');

				$this->geneal_model->addData('da_coupons',$couponData);
			}else{
				goto A;
			}
		}
		//End Create Coupons

		//Start Create Coupons for donate product
		if($CA['is_donated'] == 'Y'):
			for($i=0; $i < $CA['quantity']; $i++){
				B:
				$whereCon['coupon_code']	=	'';
				$whereCon['coupon_code']	=	strtoupper(uniqid(16));
				$check 	= 	$this->geneal_model->checkDuplicate('da_coupons',$whereCon);
				if($check == 0){
					$couponData['coupon_id']		= 	(int)$this->geneal_model->getNextSequence('da_coupons');
					$couponData['users_id']			= 	(int)$this->session->userdata('DZL_USERID');
					$couponData['users_email']		= 	$this->session->userdata('DZL_USEREMAIL');
					$couponData['order_id']			= 	$oid;
					$couponData['product_id']		= 	$CA['product_id'];
					$couponData['product_title']	= 	$CA['product_name'];
					$couponData['is_donated'] 		=	'Y';
					$couponData['coupon_code'] 		= 	$whereCon['coupon_code'];
					$couponData['coupon_type'] 		= 	'Donated';
					$couponData['created_at']		=	date('Y-m-d H:i');

					$this->geneal_model->addData('da_coupons',$couponData);
				}else{
					goto B;
				}
			}
		endif;
		//End Create Coupons
	endforeach;

	$wcon['where'] 					=	array('order_id' => $oid);
	$data['couponDetails']			=	$this->geneal_model->getData2('multiple', 'da_coupons', $wcon);

	// Deduct the purchesed points and get available arabian points of user.
	$currentBal 					= 	$this->geneal_model->debitPoints($data['finalPrice']); 

	/* Load Balance Table -- after buy product*/
    $Buyparam["load_balance_id"]	=	(int)$this->geneal_model->getNextSequence('da_loadBalance');
	$Buyparam["user_id_cred"] 		=	(int)$this->session->userdata('DZL_USERID');
	$Buyparam["user_id_deb"]		=	(int)$this->session->userdata('DZL_USERID');
	$Buyparam["arabian_points"] 	=	(float)$data['finalPrice'];
    $Buyparam["record_type"] 		=	'Debit';
    $Buyparam["arabian_points_from"]=	'Purchase';
    $Buyparam["creation_ip"] 		=	$this->input->ip_address();
    $Buyparam["created_at"] 		=	date('Y-m-d H:i');
    $Buyparam["created_by"] 		=	(int)$this->session->userdata('DZL_USERSTYPE');
    $Buyparam["status"] 			=	"A";
    
    $this->geneal_model->addData('da_loadBalance', $Buyparam);
    /* End */
    
	$membershipData = $this->geneal_model->getMembership((int)$this->session->userdata('DZL_TOTALPOINTS'));
	if($membershipData):
		$cashback 			=	$data['finalPrice'] * $membershipData['benifit'] /100;
		$data['cashback'] 	= 	$cashback;
		if($cashback):
			$insertCashback = array(
				'cashback_id'	=>	(int)$this->geneal_model->getNextSequence('da_cashback'),
				'user_id'		=>	(int)$this->session->userdata('DZL_USERID'),
				'order_id'		=>	(int)$data['order_id'],
				'cashback'		=>	(float)$cashback,
				'created_at'	=>	date('Y-m-d H:i'),
			);
			$this->geneal_model->addData('da_cashback',$insertCashback);

			// Credit the purchesed points and get available arabian points of user.
			$this->geneal_model->creaditPoints($cashback); 

			/* Load Balance Table -- after buy product*/
		    $Cashbparam["load_balance_id"]		=	(int)$this->geneal_model->getNextSequence('da_loadBalance');
			$Cashbparam["user_id_cred"] 		=	(int)$this->session->userdata('DZL_USERID');
			$Cashbparam["user_id_deb"]			=	(int)$this->session->userdata('DZL_USERID');
			$Cashbparam["arabian_points"] 		=	(float)$cashback;
		    $Cashbparam["record_type"] 			=	'Credit';
		    $Cashbparam["arabian_points_from"] 	=	'Membership Cashback';
		    $Cashbparam["creation_ip"] 			=	$this->input->ip_address();
		    $Cashbparam["created_at"] 			=	date('Y-m-d H:i');
		    $Cashbparam["created_by"] 			=	(int)$this->session->userdata('DZL_USERSTYPE');
		    $Cashbparam["status"] 				=	"A";
		    
		    $this->geneal_model->addData('da_loadBalance', $Cashbparam);
		    /* End */
		endif;
	endif;

	if($this->session->userdata('SHARED_USER_ID') && $this->session->userdata('SHARED_USER_REFERRAL_CODE') && $this->session->userdata('SHARED_PRODUCT_ID')):
		if(isset($productIdPrice[$this->session->userdata('SHARED_PRODUCT_ID')])):
			$productCartAmount  		=	$productIdPrice[$this->session->userdata('SHARED_PRODUCT_ID')];

			//First label referal amount Credit
			$ref1tbl 					=	'referral_percentage';
			$ref1where 					=	['referral_lebel' => (int)1 ];
			$referal1Data				=	$this->geneal_model->getOnlyOneData($ref1tbl, $ref1where);
			if($referal1Data):
				$referal1Amount  		=	(($productCartAmount*$referal1Data['referral_percent'])/100);

				/* Referal Product Table -- after buy product*/
			    $ref1Amtparam["referral_id"]			=	(int)$this->geneal_model->getNextSequence('referral_product');
				$ref1Amtparam["referral_user_code"] 	=	(int)$this->session->userdata('SHARED_USER_REFERRAL_CODE');
				$ref1Amtparam["referral_from_id"] 		=	(int)$this->session->userdata('SHARED_USER_ID');
				$ref1Amtparam["referral_to_id"]			=	(int)$this->session->userdata('DZL_USERID');
			    $ref1Amtparam["referral_percent"] 		=	(int)$referal1Data['referral_percent'];
			    $ref1Amtparam["referral_amount"] 		=	(float)$referal1Amount;
			    $ref1Amtparam["referral_cart_amount"] 	=	(float)$productCartAmount;
			    $ref1Amtparam["referral_product_id"] 	=	(int)$this->session->userdata('SHARED_PRODUCT_ID');
			    $ref1Amtparam["creation_ip"] 			=	$this->input->ip_address();
			    $ref1Amtparam["created_at"] 			=	date('Y-m-d H:i');
			    $ref1Amtparam["created_by"] 			=	(int)$this->session->userdata('DZL_USERSTYPE');
			    $ref1Amtparam["status"] 				=	"A";
			    
			    $this->geneal_model->addData('referral_product', $ref1Amtparam);
			    /* End */

			    /* Load Balance Table -- after buy product*/
			    $ref1param["load_balance_id"]		=	(int)$this->geneal_model->getNextSequence('da_loadBalance');
				$ref1param["user_id_cred"] 			=	(int)$this->session->userdata('DZL_USERID');
				$ref1param["user_id_deb"]			=	(int)$this->session->userdata('DZL_USERID');
				$ref1param["arabian_points"] 		=	(float)$referal1Amount;
			    $ref1param["record_type"] 			=	'Credit';
			    $ref1param["arabian_points_from"] 	=	'Referral';
			    $ref1param["creation_ip"] 			=	$this->input->ip_address();
			    $ref1param["created_at"] 			=	date('Y-m-d H:i');
			    $ref1param["created_by"] 			=	(int)$this->session->userdata('DZL_USERSTYPE');
			    $ref1param["status"] 				=	"A";
			    
			    $this->geneal_model->addData('da_loadBalance', $ref1param);
			    /* End */
			endif;

			//Second label referal amount Credit
			$ref2checktbl 				=	'referral_product';
			$ref2checkwhere 			=	['referral_to_id' => (int)$this->session->userdata('SHARED_USER_ID'), 'referral_product_id' => (int)$this->session->userdata('SHARED_PRODUCT_ID')];
			$referal2checkData			=	$this->geneal_model->getOnlyOneData($ref2checktbl, $ref2checkwhere);
			if($referal2checkData):
				$ref2tbl 					=	'referral_percentage';
				$ref2where 					=	['referral_lebel' => (int)2 ];
				$referal2Data				=	$this->geneal_model->getOnlyOneData($ref2tbl, $ref2where);
				if($referal2Data):
					$referal2Amount  		=	(($productCartAmount*$referal2Data['referral_percent'])/100);

				    /* Load Balance Table -- after buy product*/
				    $ref1param["load_balance_id"]		=	(int)$this->geneal_model->getNextSequence('da_loadBalance');
					$ref1param["user_id_cred"] 			=	(int)$referal2Data['referral_from_id'];
					$ref1param["user_id_deb"]			=	(int)$referal2Data['referral_from_id'];
					$ref1param["arabian_points"] 		=	(float)$referal2Amount;
				    $ref1param["record_type"] 			=	'Credit';
				    $ref1param["arabian_points_from"] 	=	'Referral';
				    $ref1param["creation_ip"] 			=	$this->input->ip_address();
				    $ref1param["created_at"] 			=	date('Y-m-d H:i');
				    $ref1param["created_by"] 			=	(int)$this->session->userdata('DZL_USERSTYPE');
				    $ref1param["status"] 				=	"A";
				    
				    $this->geneal_model->addData('da_loadBalance', $ref1param);
				    /* End */
				endif;
			endif;
		endif;
	endif;

	//Delete cart items.
	$this->geneal_model->deleteData('da_cartItems', 'user_id', $this->session->userdata('DZL_USERID')); 
	$this->cart->destroy();
	$this->session->unset_userdata(array('SHARED_USER_ID','SHARED_USER_REFERRAL_CODE','SHARED_PRODUCT_ID',));

	$this->load->view('success', $data);
} // END OF FUNCTION

/***********************************************************************
** Function name 	: orderList
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for show order list
** Date 			: 10 MAY 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function orderList()
{  
	$data 					=	array();
	$data['page']			=	'My Order';
	$this->load->library("pagination");
	
	$tblName 				=	'da_orders';
	$shortField 			= 	array('_id'=> -1 );
	$whereCon['where']		= 	array('user_id'=>(int)$this->session->userdata('DZL_USERID'));

	$totalPage 				=	$this->geneal_model->getData2('count',$tblName,$whereCon,$shortField,'0','0');
	$config 				= 	['base_url'=>base_url('order-list'),'per_page'=>5,'total_rows'=> $totalPage];

	$this->pagination->initialize($config);
	$data['orderData']  =	$this->geneal_model->getData2('multiple', $tblName, $whereCon,$shortField,$this->uri->segment(2),$config['per_page']);

	$this->load->view('order_list',$data);
} 	//END OF FUNCTION

}
