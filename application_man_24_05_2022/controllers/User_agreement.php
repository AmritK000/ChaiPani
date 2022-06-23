<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_agreement extends CI_Controller {
public function  __construct() 
	{ 
		parent:: __construct();
		$this->load->model('geneal_model');
	} 
/***********************************************************************
** Function name 	: index
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for index
** Date 			: 14 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function index()
{  
	$data 					=	array();
	$data['page'] 			=	'Users Agreement';

	$tbl 					=	'da_cms';
	$where 					=	['page_name' => 'User Agreement'];
	$data['Agreement']		=	$this->geneal_model->getData($tbl, $where,[]);

	//print_r($data);
	//die();

	$this->load->view('useragreement',$data);
}

}
