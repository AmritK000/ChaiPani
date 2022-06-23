<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Winners extends CI_Controller {
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
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function index()
{  
	$data 					=	array();
	$data['page'] 			=	'Our Lucky Winners';
	
	$tbl 					=	'da_winners';
	$order 					=	['creation_date' => 'desc'];
	$data['winners']		=	$this->geneal_model->getData($tbl, [],$order);

	$this->load->view('winners_list',$data);
} // END OF FUNCTION

}
