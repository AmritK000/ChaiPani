<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Termconditions extends CI_Controller {
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
	$data['page'] 			=	'Terms & Conditions';

	$tbl 					=	'da_cms';
	$where 					=	['page_name' => 'Terms and conditions'];
	$data['termconditions']	=	$this->geneal_model->getData($tbl, $where,[]);

	$this->load->view('termconditions',$data);
} //END OF FUNCTION

}
