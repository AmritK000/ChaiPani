<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
public function  __construct() 
{ 
	parent:: __construct();
	$this->load->model(array('geneal_model','common_model'));
} 
/***********************************************************************
** Function name 	: index
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for index
** Date 			: 13 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
/*public function index()
{  
	$data 					=	array();


	$this->load->view('productDetails',$data);
}*/ // END OF FUNCTION

/***********************************************************************
** Function name 	: productDetails
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for index
** Date 			: 13 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function productDetails($id='')
{  

	$data 					=	array();


	$tbl 					=	'da_products';
	$where 					=	['products_id' => (int)base64_decode($id) ];
	$data['products']		=	$this->geneal_model->getOnlyOneData($tbl, $where);

	$data['page']			=	$data['products']['title'];

	$tbl 					=	'da_prize';
	$where 					=	['product_id' => (int)base64_decode($id) ];
	$data['prize']			=	$this->geneal_model->getOnlyOneData($tbl, $where);
	//print_r($where); die();
	//print_r($data['prize']); die();

	$prowhere['where']						=	array('users_id'=>(int)$this->session->userdata('DZL_USERID'),'product_id'=>(int)base64_decode($id));
	$data['prodData']								=	$this->common_model->getData('single','da_wishlist',$prowhere);

	$this->load->view('productDetails',$data);
} // END OF FUNCTION

/* * *********************************************************************
	 * * Function name : addtowishlist
	 * * Developed By : Ravi Negi
	 * * Purpose  : This function use for wishlist adding
	 * * Date : 08 SEP 2021
	 * * **********************************************************************/
	public function addtowishlist()
	{	
		$users_id								=	$this->session->userdata('DZL_USERID');
		$product_id                				=   $this->input->post('product_id');

		$prowhere['where']						=	array('users_id'=>(int)$users_id,'product_id'=>(int)$product_id);
		$prodData								=	$this->common_model->getData('single','da_wishlist',$prowhere);
		//echo '<pre>';print_r($product_id);die;
		$param['users_id']						=	(int)$users_id;
		$param['product_id']					=	(int)$product_id;
		$param['creation_date']					=   date('Y-m-d H:i');
		$param['creation_ip']					=   $this->input->ip_address();

		if($prodData == ""):
			$param['wishlist_id']				=	(int)$this->common_model->getNextSequence('da_wishlist');
			$param['wishlist_product']        	=   'Y';
			$result['wishlistData']				=	$param;
			$this->common_model->addData('da_wishlist',$param);
			echo "addedtowishlist";die;
		else:
			$this->common_model->deleteData('da_wishlist','product_id',(int)$product_id);
			echo "removedfromwishlist";die;
		endif;
	}

}
