<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
public function  __construct() 
{ 
	parent:: __construct();
	$this->load->model(array('geneal_model','common_model'));
	$this->lang->load('statictext','front');
} 
/***********************************************************************
** Function name 	: index
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for index
** Date 			: 13 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function index()
{  
	$data 					=	array();
	$data['page']			=	'My Coupons';
	//Home Page Slider
	$tbl 					=	'da_homepage_slider';
	//$where 					=	['page' => 'Homeslider'];
	$wcon1['where']          =  array('page'=> array('$ne'=> 'Homebanner') );
	$order 					=	['page' => 'asc'];

	$data['homeSlider']		=	$this->geneal_model->getData2('multiple', $tbl, $wcon1,$order);

	$tbl 					=	'da_homepage_slider';
	$where 					=	['page' => 'Homebanner'];
	$data['homeBanner']		=	$this->geneal_model->getData($tbl, $where,[]);

	$tbl 					=	'da_products';
	$wcon['where']          =  array('stock'=> array('$ne'=> 0),
									 'clossingSoon' => 'Y',
									 'status' => 'A',
									);
	$order 					=	['creation_date' => 'desc'];
	$data['closing_soon']	=	$this->geneal_model->getData2('multiple', $tbl, $wcon);

	$tbl 					=	'da_products';
	$wheres					=	[ 'stock' 	=> 0,
								  'status'	=> 'A'];
	$order 					=	['creation_date' => 'desc'];
	$data['outOfStock']		=	$this->geneal_model->getData($tbl, $wheres,[]);

	$tbl 					=	'da_winners';
	$order 					=	['creation_date' => 'desc'];
	$data['winners']		=	$this->geneal_model->getData($tbl, [], $order);

	$tbl 					=	'da_products';
	$wcon['where']          =  	array( 'stock'=> array('$ne'=> 0,),
									  'clossingSoon' => 'N',
									  'status' => 'A'	
									);
	$order 					=	['creation_date' => 'desc'];
	$data['products']		=	$this->geneal_model->getData2('multiple', $tbl, $wcon);

	/*echo "<pre>";
	print_r($data['products']); die();*/

	$data['cartItems']		=	$this->cart->contents();


	$this->load->view('index',$data);
} // END OF FUNCTION

/***********************************************************************
** Function name 	: check
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for check participation
** Date 			: 20 MAY 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/
public function check($check=''){
	//echo $check; die();

	$value = base64_decode($check);
	$this->session->set_userdata('REDIRECT',$check);
	redirect('login');
}
public function order_details(){
	//echo $check; die();

		$this->load->view('order_details');
}

}
