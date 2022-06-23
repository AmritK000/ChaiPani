<?php
class Allcontact extends CI_Controller
{
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
 + + Developed By 	: AFSAR ALI
 + + Purpose  		: This function used for index
 + + Date 			: 19 APRIL 2022
 + + Updated Date 	: 
 + + Updated By   	:
 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
public function index()
{	
	$this->admin_model->authCheck();
	$data['error'] 						= 	'';
	$data['activeMenu'] 				= 	'contact';
	$data['activeSubMenu'] 				= 	'allcontact';
	
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
	$shortField 						= 	array('id'=> -1);
	
	$baseUrl 							= 	getCurrentControllerPath('index');
	$this->session->set_userdata('ALLCONTACTDATA',currentFullUrl());
	$qStringdata						=	explode('?',currentFullUrl());
	$suffix								= 	$qStringdata[1]?'?'.$qStringdata[1]:'';
	$tblName 							= 	'da_contacts';
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

   if($this->uri->segment(getUrlSegment())):
       $page = $this->uri->segment(getUrlSegment());
   else:
       $page = 0;
   endif;
	
	$data['forAction'] 					= 	$baseUrl; 
	if($totalRows):
		$first							=	(int)($page)+1;
		$data['first']					=	$first;
		
		if($data['perpage'] == 'All'):
			$pageData 					=	$totalRows;
		else:
			$pageData 					=	$data['perpage'];
		endif;
		
		$last							=	((int)($page)+$pageData)>$totalRows?$totalRows:((int)($page)+$pageData);
		$data['noOfContent']			=	'Showing '.$first.'-'.$last.' of '.$totalRows.' items';
	else:
		$data['first']					=	1;
		$data['noOfContent']			=	'';
	endif;
	
	$data['ALLDATA'] 					= 	$this->common_model->getData('multiple',$tblName,$whereCon,$shortField,$perPage,$page);

	$this->layouts->set_title('All Contact | Contact | Dealz Arabia');
	$this->layouts->admin_view('contact/allcontact/index',array(),$data);
}


/***********************************************************************
** Function name 	: deletedata
** Developed By 	: AFSAR ALI
** Purpose  		: This function used for delete data
** Date 			: 20 APRIL 2022
************************************************************************/
function deletedata($deleteId='')
{  
	$this->admin_model->authCheck('delete_data');
	$this->common_model->deleteData('da_contacts','id',(int)$deleteId);
	$this->session->set_flashdata('alert_success',lang('deletesuccess'));
	
	redirect(correctLink('ALLCONTACTDATA',getCurrentControllerPath('index')));
}

}

?>