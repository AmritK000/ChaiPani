<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/core/My_Head.php"); 
class DiliveryAddress extends My_Head  {
public function  __construct() 
{ 
	parent:: __construct();
	$this->load->model('geneal_model','common_model');
	$this->lang->load('statictext','front');
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
	//echo $this->session->userdata('DZL_USERID'); die();
	$data 					=	array();
	$data['page']			=	'My Address';
	$tbl 					=	'da_diliveryAddress';
	$where 					= 	['user_id' => $this->session->userdata('DZL_USERID') ];
	$data['address']			=	$this->geneal_model->getData($tbl, $where,[]);
	//print_r($data['address']); die();
	$this->load->view('diliveryAddress',$data);
} //END OF FUNCTION

/***********************************************************************
** Function name 	: create
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for create new dilivery address
** Date 			: 19 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function create()
{  
	$data 					=	array();
	if($this->input->post($_POST)){

		$insert_data = array(
			'id'				=>	(int)$this->geneal_model->getNextSequence('da_diliveryAddress'),
			'user_id'			=>	$this->session->userdata('DZL_USERID'),
			'address_type'		=>	$this->input->post('address_type'),
			'name'				=>	$this->input->post('name'),
			'village'			=>	$this->input->post('village'),
			'street'			=>	$this->input->post('street'),
			'area'				=>	$this->input->post('area'),
			'city'				=>	$this->input->post('city'),
			'country'			=>	$this->input->post('country'),
			'mobile'			=>	$this->input->post('mobile'),
			'created_at'		=>	date('Y-m-d H:i'),
			'created_ip'		=>	$this->input->ip_address(),
		);
		$isInsert 	=	$this->geneal_model->addData('da_diliveryAddress', $insert_data);

		if ($isInsert) {
			$this->session->set_flashdata('success', lang('address_success'));
			redirect('dilivery-address');
		}
	}
	$this->load->view('addDiliveryAddress',$data);
} //END OF FUNCTION

/***********************************************************************
** Function name 	: create
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for create new dilivery address
** Date 			: 19 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function edit($id='')
{  
	$data 			=	array();
	$where 			=	$id;

	$data['address'] = $this->geneal_model->getOnlyOneData('da_diliveryAddress', $where);

	if($this->input->post($_POST)){

		$insert_data = array(
			'address_type'		=>	$this->input->post('address_type'),
			'name'				=>	$this->input->post('name'),
			'village'			=>	$this->input->post('village'),
			'street'			=>	$this->input->post('street'),
			'area'				=>	$this->input->post('area'),
			'city'				=>	$this->input->post('city'),
			'country'			=>	$this->input->post('country'),
			'mobile'			=>	$this->input->post('mobile'),
			'updated_at'		=>	date('Y-m-d H:i'),
			'updated_ip'		=>	$this->input->ip_address(),
		);
		$isInsert 	=	$this->geneal_model->editData('da_diliveryAddress', $insert_data, 'id', (int)$this->uri->segment(2));

		if ($isInsert) {
			$this->session->set_flashdata('success', lang('address_update'));
			redirect('dilivery-address');
		}
	}
	
	$this->load->view('editDiliveryAddress',$data);
} //END OF FUNCTION

/***********************************************************************
** Function name 	: create
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for create new dilivery address
** Date 			: 19 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function delete($id='')
{  

	$isDelete = $this->geneal_model->deleteData('da_diliveryAddress', 'id', (int)$this->uri->segment(2) );
		if ($isDelete) {
			$this->session->set_flashdata('success', lang('address_delete'));
			redirect('dilivery-address');
		}
	redirect('diliveryAddress');
} //END OF FUNCTION


}


