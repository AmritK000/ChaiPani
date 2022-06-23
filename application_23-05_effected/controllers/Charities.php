<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charities extends CI_Controller {
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
	$data['page']			=	'Charities';

	$tbl 					=	'da_cms';
	$where 					=	['page_name' => 'Charities'];
	$data['charities']		=	$this->geneal_model->getData($tbl, $where,[]);

	//print_r($data);
	//die();

	$this->load->view('charities',$data);
}

}
