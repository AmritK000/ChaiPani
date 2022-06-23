<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generaldata extends CI_Controller {

	public function  __construct() 
	{ 
		parent:: __construct();
		error_reporting(E_ALL ^ E_NOTICE);  
		$this->load->model(array('admin_model','emailtemplate_model','sms_model','notification_model'));
		$this->lang->load('statictext', 'admin');
		$this->load->helper('common');
	} 

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 + + Function name 	: index
	 + + Developed By 	: Ashish Umrao
	 + + Purpose  		: This function used for index
	 + + Date 			: 31 MARCH 2022
	 + + Updated Date 	: 
	 + + Updated By   	: 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function index()
	{	
		$this->admin_model->authCheck();
		$data['error'] 						= 	'';
		$data['activeMenu'] 				= 	'cms';
		$data['activeSubMenu'] 				= 	'generaldata';
		
		if($this->input->get('searchField') && $this->input->get('searchValue')):
			$sField							=	$this->input->get('searchField');
			$sValue							=	$this->input->get('searchValue');
			$whereCon['like']			 	= 	array('0'=>trim($sField),'1'=>trim($sValue));
			$data['searchField'] 			= 	$sField;
			$data['searchValue'] 			= 	$sValue;
		else:
			$whereCon['like']		 		= 	"";
			$data['searchField'] 			= 	'';
			$data['searchValue'] 			= 	'';
		endif;
				
		$whereCon['where']		 			= 	'';		
		$shortField 						= 	array('testi_name'=>'ASC');
		
		$baseUrl 							= 	getCurrentControllerPath('index');
		$this->session->set_userdata('CMSGENERALDATA',currentFullUrl());
		$qStringdata						=	explode('?',currentFullUrl());
		$suffix								= 	$qStringdata[1]?'?'.$qStringdata[1]:'';
		$tblName 							= 	'da_general_data';
		$con 								= 	'';
		$totalRows 							= 	$this->common_model->getData('count',$tblName,$whereCon,$shortField,'0','0');
		
		if($this->input->get('showLength') == 'All'):
			$perPage	 					= 	$totalRows;
			$data['perpage'] 				= 	$this->input->get('showLength');  
		elseif($this->input->get('showLength')):
			$perPage	 					= 	$this->input->get('showLength'); 
			$data['perpage'] 				= 	$this->input->get('showLength'); 
		else:
			$perPage	 					= 	SHOW_NO_OF_DATA;
			$data['perpage'] 				= 	SHOW_NO_OF_DATA; 
		endif;
		$uriSegment 						= 	getUrlSegment();
	    $data['PAGINATION']					=	adminPagination($baseUrl,$suffix,$totalRows,$perPage,$uriSegment);
	    //echo "<pre>"; print_r($uriSegment); die;
       if ($this->uri->segment(getUrlSegment())):
           $page = $this->uri->segment(getUrlSegment());
       else:
           $page = 0;
       endif;
		
		$data['forAction'] 					= 	$baseUrl; 
		if($totalRows):
			$first							=	(int)($page)+1;
			$data['first']					=	$first;
			$last							=	((int)($page)+$data['perpage'])>$totalRows?$totalRows:((int)($page)+$data['perpage']);
			$data['noOfContent']			=	'Showing '.$first.'-'.$last.' of '.$totalRows.' items';
		else:
			$data['first']					=	1;
			$data['noOfContent']			=	'';
		endif;
		
		$data['ALLDATA'] 					= 	$this->common_model->getData('multiple',$tblName,$whereCon,$shortField,$perPage,$page);

		$this->layouts->set_title('General Data | CMS | Dealz Arabia');
		$this->layouts->admin_view('cms/generaldata/index',array(),$data);
	}	// END OF FUNCTION
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 + + Function name : addeditdata
	 + + Developed By  : Ashish Umrao
	 + + Purpose  	   : This function used for Add Edit data
	 + + Date 		   : 31 MARCH 2022
	 + + Updated Date  : 
	 + + Updated By    : 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function addeditdata($editId='')
	{		
		$data['error'] 						= 	'';
		$data['activeMenu'] 				= 	'cms';
		$data['activeSubMenu'] 				= 	'generaldata';
		
		if($editId):
			$this->admin_model->authCheck('edit_data');
			$data['EDITDATA']		=	$this->common_model->getDataByParticularField('da_general_data','general_data_id',(int)$editId);
		else:
			$this->admin_model->authCheck('add_data');
		endif;
		
		if($this->input->post('SaveChanges')): 
			$error					=	'NO';
			$this->form_validation->set_rules('image', 'Logo', 'trim');
			$this->form_validation->set_rules('alt_text', 'Alt Text', 'trim|required');
			$this->form_validation->set_rules('email_id', 'Name', 'trim|required');
			$this->form_validation->set_rules('contact_no', 'description', 'trim');
			$this->form_validation->set_rules('address', 'Name', 'trim|required');
			$this->form_validation->set_rules('facebook_link', 'description', 'trim');
			$this->form_validation->set_rules('linkedin_link', 'Name', 'trim|required');
			$this->form_validation->set_rules('twitter_link', 'description', 'trim');
			$this->form_validation->set_rules('insta_link', 'Name', 'trim|required');
			$this->form_validation->set_rules('you_tube', 'YouTube', 'trim|required');

			if($this->form_validation->run() && $error == 'NO'): 

				if($_FILES['image']['name']):
						$ufileName				= 	$_FILES['image']['name'];
						$utmpName				= 	$_FILES['image']['tmp_name'];
						$ufileExt         	= 	pathinfo($ufileName);
						$unewFileName 			= 	time().'.'.$ufileExt['extension'];
						$this->load->library("upload_crop_img");
						$uimageLink				=	$this->upload_crop_img->_upload_image_from_app($ufileName,$utmpName,$unewFileName,'generaldata','');
					$param['logo']				= 	$uimageLink;
				endif;

				
				//echo "<pre>";print_r($param);die;
				$param['alt_text']				= 	stripslashes($this->input->post('alt_text'));
				$param['email_id']				= 	stripslashes($this->input->post('email_id'));
				$param['contact_no']			= 	stripslashes($this->input->post('contact_no'));
				$param['address']				= 	stripslashes($this->input->post('address'));
				$param['facebook_link']			= 	stripslashes($this->input->post('facebook_link'));
				$param['linkedin_link']			= 	stripslashes($this->input->post('linkedin_link'));
				$param['twitter_link']			= 	stripslashes($this->input->post('twitter_link'));
				$param['insta_link']			= 	stripslashes($this->input->post('insta_link'));
				$param['you_tube']		    	= 	stripslashes($this->input->post('you_tube'));

			if($this->input->post('CurrentDataID') ==''):
					$param['general_data_id']		=	(int)$this->common_model->getNextSequence('da_general_data');
					$param['creation_ip']			=	currentIp();
					$param['creation_date']			=	(int)$this->timezone->utc_time();//currentDateTime();
					$param['created_by']				=	(int)$this->session->userdata('HCAP_ADMIN_ID');
					$param['status']					=	'A';
					$alastInsertId						=	$this->common_model->addData('da_general_data',$param);
					$this->session->set_flashdata('alert_success',lang('addsuccess'));
				else:
					$generaldataId					=	$this->input->post('CurrentDataID');
					$param['update_ip']			=	currentIp();
					$param['update_date']		=	(int)$this->timezone->utc_time();//currentDateTime();
					$param['updated_by']			=	(int)$this->session->userdata('HCAP_ADMIN_ID');
					$this->common_model->editData('da_general_data',$param,'general_data_id',(int)$generaldataId);
					$this->session->set_flashdata('alert_success',lang('updatesuccess'));
				endif;
				redirect(correctLink('CMSGENERALDATA',$this->session->userdata('HCAP_ADMIN_CURRENT_PATH').$this->router->fetch_class().'/index'));
			endif;
		endif;
		
		$this->layouts->set_title('Edit General Data | CMS | Dealz Arabia');
		$this->layouts->admin_view('cms/generaldata/addeditdata',array(),$data);
	}	// END OF FUNCTION	

	/***********************************************************************
	** Function name 	: ImageDelete
	** Developed By 	: Tejaswi
	** Purpose  		: This function used to delete image
	** Date 			: 31 MARCH 2022
	** Updated 			: 
	************************************************************************/
	function ImageDelete()
	{  
		$imageName			=	$this->input->post('imageName');
		$id 				=	$this->input->post('id');
		//echo $id;die;
		$param['logo']		=	''; 
		if($imageName):
			$this->load->library("upload_crop_img");
			$return	=	$this->upload_crop_img->_delete_image(trim($imageName)); 
			$this->common_model->editData('da_general_data',$param,'general_data_id',(int)$id);
		endif;
		$returnArray  		= 	array('status'=>1,'message'=>'Image deleted.');
		header('Content-type: application/json');
		echo json_encode($returnArray); die;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name 	: videoDelete
	** Developed By 	: Tejaswi
	** Purpose  		: This function used to delete image
	** Date 			: 31 MARCH 2022
	** Updated 			: 
	************************************************************************/
	function videoDelete()
	{  
		$imageName				=	$this->input->post('imageName');
		$id 					=	$this->input->post('id');
		//echo $id;die;
		$param['seller_tutorial']		=	''; 
		if($imageName):
			$this->load->library("upload_crop_img");
			$return	=	$this->upload_crop_img->_delete_image(trim($imageName)); 
			$this->common_model->editData('da_general_data',$param,'general_data_id',(int)$id);
		endif;
		$returnArray  		= 	array('status'=>1,'message'=>'Image deleted.');
		header('Content-type: application/json');
		echo json_encode($returnArray); die;
	}	// END OF FUNCTION
	
}