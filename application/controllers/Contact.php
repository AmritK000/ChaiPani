<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
public function  __construct() 
	{ 
		parent:: __construct();
		$this->load->model('geneal_model');
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
	$data 					=	array();
	$data['page']			=	'Contact us';
	$tbl 					=	'da_general_data';
	$where 					=	['status' => 'A'];
	$data['general_details']=	$this->geneal_model->getData($tbl, $where,[]);

	$this->load->view('contact',$data);
} //END OF FUNCTION

/***********************************************************************
** Function name 	: index
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for index
** Date 			: 14 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function contact_detail()
{
	$this->form_validation->set_rules('name', 'Name', 'required');
	$this->form_validation->set_rules('mobile', 'Mobile', 'required');
	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	$this->form_validation->set_rules('message', 'Message', 'required');
	$this->form_validation->set_rules('message', 'Subject', 'required');
	$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");

	if ($this->form_validation->run())
	{
		//echo "working3"; die();
    	$post_data = $this->input->post();
		$insert_data = array(
			'id'			=> (int)$this->geneal_model->getNextSequence('da_contact'),
			"name"     		=> $post_data['name'],	
			"mobile"        => $post_data['mobile'],
			"email"         => $post_data['email'],
			"subject"       => $post_data['subject'],
			"message"     	=> $post_data['message'],
			'created_at'	=> date('Y-m-d h:i'),	
			'created_ip'	=> $this->input->ip_address(),
		);
		if($insert_data){
		$this->geneal_model->addData('da_contacts', $insert_data);
		$this->session->set_flashdata('success',lang('contact_success'));
		}
	}else{
		$this->session->set_flashdata('error',lang('contact_error'));
	}
	return redirect('contact-us');
} //END OF FUNCTION

}
