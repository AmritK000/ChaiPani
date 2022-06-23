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
	$data  					= array();
	$data['page']			=	'Checkout';

	$finalPrice = 0;
	
	$where               =      ['users_id' => (int)$this->session->userdata('DZL_USERID') ];
	$user_data           =      $this->geneal_model->getOnlyOneData('da_users', $where);
	$where2               =      ['user_id' => (int)$this->session->userdata('DZL_USERID') ];
	$user_address        =      $this->geneal_model->getData('da_diliveryAddress', $where2,[]);
	$data['ToatlPoints'] =      $user_data['availableArabianPoints'];
	$data['dilivertAddress'] = 	$user_address;
	//print_r($data['dilivertAddress']); die();

	
	
	if($this->session->userdata('DZL_USERID')){
		$wcon['where']		=	[ 'user_id' => (int)$this->session->userdata('DZL_USERID') ];
		$cartItems          =	$this->geneal_model->getData2('multiple', 'da_cartItems', $wcon);//echo '<pre>';print_r($cartItems);die;
		foreach($cartItems as $CA):
		$finalPrice += $CA['qty'] * $CA['price'];

		//check Stock
		$stockCheck = $this->geneal_model->getStock($CA['id'], $CA['qty']);
		endforeach;
		$data['finalprice'] = $finalPrice;
		$data['shipping']   = 0;
		$data['finaltotal'] = $finalPrice + $data['shipping'];
		
		//echo $stockCheck;die();
		
	}else{
		redirect('login');
	}

	
	if($_POST){//print_r($_POST);die;

		if($stockCheck == 0){
			$this->session->set_flashdata('error', lang('OUTOFSTOCK'));
	        redirect('user-cart');

		}elseif ($stockCheck <> 1) {
			//echo $stockCheck.'ddd '; die();
			$this->session->set_flashdata('error', lang('PRO_QTY'));
	        redirect('user-cart');
		}

	if($finalPrice > $data['ToatlPoints']){
	    $this->session->set_flashdata('error', lang('LOW_BALANCE'));
	        redirect('checkout');
	}else{
	
	/* Order Place Table */
	        $param["order_id"]		        =	(int)$this->geneal_model->getNextSequence('da_orders');
	        if($_POST['payment-method'] == 'arabianpoint'):
		    $param["payment_mode"] 			=	'Arabian Points';
		    else:
		    $param["payment_mode"] 			=	'Razorpay';
		    endif;
		    $param["creation_ip"] 			=	$this->input->ip_address();
		    $param["dilivertAddress"] 		=	$this->input->post('address');
		    $param["created_at"] 			=	date('Y-m-d H:i');
		    $param["created_by"] 			=	$this->session->userdata('DZL_USERSTYPE');
		    $param["order_status"] 			=	"P";
	        foreach($cartItems as $CA):
			$param["user_id"] 			    =	(int)$CA['user_id'];
			$param["product_id"]			=	(int)$CA['id'];
			$param["cart_id"]			    =	(int)$CA['rowid'];
			$param["total_price"] 		    =	(int)$CA['price'];
			$param["quantity"] 		        =	(int)$CA['qty'];
			//print_r($param); die();
			$this->geneal_model->addData('da_orders', $param);
			endforeach;
			redirect('order-success/'.$param["order_id"]);
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
	//Get current order details of user.
	$wcon['where']		=	[ 'order_id' => (int)$oid ];
	$data['orderData']  =	$this->geneal_model->getcartDataQuery('multiple', 'da_orders', $wcon);
	
	//Get all cart items of user
	$wcon2['where']		=	[ 'user_id' => (int)$this->session->userdata('DZL_USERID') ];
	$cartItems          =	$this->geneal_model->getData2('multiple', 'da_cartItems', $wcon2);

	$updateStatus 	=	[ 'order_status' => 'S' ];
	$updateorderstatus = $this->geneal_model->editData('da_orders', $updateStatus, 'order_id', (int)$oid);



	//Get subtotal amount 
	foreach($cartItems as $CA):
		$data['finalPrice'] += $CA['qty'] * $CA['price'];
		$this->geneal_model->updateStock($CA['id'],$CA['qty']);
		//Start Create Coupons
		for($i=0; $i < $CA['qty']; $i++){
			A:
			$whereCon['coupon_code']	=	'';
			$whereCon['coupon_code']	=	strtoupper(uniqid(16));
			$check 	= 	$this->geneal_model->checkDuplicate('da_coupons',$whereCon);
			if($check == 0){
				$couponData['coupon_id']		= 	(int)$this->geneal_model->getNextSequence('da_coupons');
				$couponData['users_id']			= 	(int)$this->session->userdata('DZL_USERID');
				$couponData['users_email']		= 	$this->session->userdata('DZL_USEREMAIL');
				$couponData['order_id']			= 	$oid;
				$couponData['product_id']		= 	$CA['id'];
				$couponData['product_title']	= 	$CA['name'];
				$couponData['coupon_code'] 		= 	$whereCon['coupon_code'];
				$couponData['created_at']		=	date('Y-m-d H:i');

				$this->geneal_model->addData('da_coupons',$couponData);
			}else{
				goto A;
			}
		}
		//End Create Coupons
	endforeach;
	$wcon['where'] =	array('order_id' => $oid);
	$data['couponDetails']	=	$this->geneal_model->getData2('multiple', 'da_coupons', $wcon);
	/*echo "<pre>";
	print_r($data['couponDetails']); die();*/
	$membershipData = $this->geneal_model->getMembership((int)$this->session->userdata('DZL_TOTALPOINTS'));

	//print_r($membershipData); die();

	$cashback =	$data['finalPrice'] * $membershipData['benifit'] /100;
	$data['cashback'] = $cashback;

	//echo $cashback; die();

	$insertCashback = array(
		'cashback_id'	=>	(int)$this->geneal_model->getNextSequence('da_cashback'),
		'user_id'		=>	(int)$this->session->userdata('DZL_USERID'),
		'order_id'		=>	(int)$data['order_id'],
		'cashback'		=>	$cashback,
		'created_at'	=>	date('Y-m-d H:i'),
	);

	$this->geneal_model->addData('da_cashback',$insertCashback);



	$this->geneal_model->deleteData('da_cartItems', 'user_id', $this->session->userdata('DZL_USERID')); //Delete cart items.
	$currentBal = $this->geneal_model->debitPoints($data['finalPrice']); // Deduct the purchesed points and get available arabian points of user.

	//$data['finalPrice']

	$this->geneal_model->creaditPoints($cashback); // Credit the purchesed points and get available arabian points of user.

	

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
	$shortField 			= 	array('order_id'=> -1 );
	$whereCon['where']		= 	array('user_id'=>(int)$this->session->userdata('DZL_USERID'));

	$totalPage 				=	$this->geneal_model->getData2('count',$tblName,$whereCon,$shortField,'0','0');
	$config = [
			'base_url'   =>   base_url('order-list'),
			'per_page'   =>    5,
			'total_rows' =>    $totalPage, 

		];

	$this->pagination->initialize($config);
	$data['orderData']  =	$this->geneal_model->getOrderDetails('multiple', $tblName, $whereCon,$shortField,$this->uri->segment(2),$config['per_page']);

	$this->load->view('order_list',$data);
} 	//END OF FUNCTION

}