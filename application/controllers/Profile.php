<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/core/My_Head.php");
class Profile extends My_Head {
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
	$data['page'] 			=	'My Profile';
	$data['oldPassError']	=	'';
	$data['error'] 			=	'NO';

	$tbl 					=	'da_users';
	$where 					=	['users_id' => $this->session->userdata('DZL_USERID')];
	$data['profileDetails']			=	$this->geneal_model->getOnlyOneData($tbl, $where);

	if($this->input->post('SaveChanges')):
		$this->form_validation->set_error_delimiters('', '');
		$error						=	'NO';
		$data['error'] 				=	'YES';
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[8]');
		if($data['profileDetails']['password'] != md5($this->input->post('old_password'))):
			$error					=	'YES';
			$data['oldPassError']	=	lang('CHANGE_PASS_ERROR');
		endif;

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[8]|max_length[25]');			
		$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|min_length[8]|matches[new_password]');

		if($this->form_validation->run() && $error == 'NO'):
			$data['error'] 				=	'NO';

			$update_data = array("password" => md5($this->input->post('new_password')));
     		$update =  $this->geneal_model->editData('da_users',$update_data,'users_id',(int)$data['profileDetails']['users_id']);
	        if($update):
	            $this->session->set_flashdata('success', lang('CHANGE_PASS'));
	            redirect('my-profile');
	        else:
	            $this->session->set_flashdata('Error', lang('CHANGE_PASS_ERROR'));
	            redirect('my-profile');
	        endif;
		endif;
	endif;

	$this->load->view('myprofile',$data);
} //END OF FUNCTION

/***********************************************************************
** Function name 	: editUsers
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for edit profile data
** Date 			: 30 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 
public function editprofile($id)
{
    $data 			        =	array();
    $data['page'] 			=	'Edit Profile';
	$tbl 					=	'da_users';
	$where 					=	['users_id' => $this->session->userdata('DZL_USERID')];
	$data['profileDetails']	=	$this->geneal_model->getOnlyOneData($tbl, $where);
 
	if($this->input->post('SaveChanges')):
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_message('is_unique', 'The %s is already taken');
		$data['error']			=	'NO';
		$this->form_validation->set_rules('users_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('users_email', 'Email', 'trim|required|valid_email|max_length[64]|is_unique[da_users.users_email.string]');
		$this->form_validation->set_rules('users_mobile', 'Mobile', 'trim|required|min_length[10]|max_length[15]|is_unique[da_users.users_mobile.integer]');

		if($this->form_validation->run() && $data['error'] == 'NO'):

			$update_data = array(
									'users_name'	=>	$this->input->post('users_name'),
									'users_mobile'	=>	$this->input->post('users_mobile'),
									'users_email'	=>	$this->input->post('users_email'),
									'updated_at'	=>	date('Y-m-d H:i'),
									'updated_ip'	=>	$this->input->ip_address(),
								);

			$isUpdate 	=	$this->geneal_model->editData('da_users', $update_data, 'users_id', (int)$this->session->userdata('DZL_USERID'));
			if($isUpdate):
				$this->session->set_userdata('DZL_USERNAME', $update_data['users_name']);
				$this->session->set_userdata('DZL_USEREMAIL', $update_data['users_email']);
				$this->session->set_userdata('DZL_USERMOBILE', $update_data['users_mobile']);
				$this->session->set_flashdata('success', lang('UPDATED'));
				redirect('my-profile');
			endif;
		endif;
	endif;
	
	$this->load->view('editmyprofile',$data);
}

/***********************************************************************
** Function name 	: recharge
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for cart list
** Date 			: 15 APRIL 2022
** Updated By		: 17 MAY 2022
** Updated Date 	: Afsar Ali
************************************************************************/ 	
public function recharge()
{   
	$data 						=	array();
	$data['emailError']			=	'';
	$data['amountError']		=	'';
	$date['page']				=	'Topup Recharge';

	if($this->input->post('SaveChanges')):
		$this->form_validation->set_error_delimiters('', '');
		$error					=	'NO';
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('recharge_amt', 'Recharge Amount', 'trim|required');

		$where 					= 	[];
		if(is_numeric($this->input->post('email'))){ 
			if($this->session->userdata('DZL_USERSTYPE') == 'Sales Person'){
				$where 			= 	['users_type'=>'Retailer','users_mobile'=>(int)$this->input->post('email'),'status'=>'A'];
			}elseif ($this->session->userdata('DZL_USERSTYPE') == 'Retailer') {
				$where 			= 	['users_type'=>'Users','users_mobile'=>(int)$this->input->post('email'),'status'=>'A'];
			}
	    }else{ 
	    	if($this->session->userdata('DZL_USERSTYPE') == 'Sales Person'){
				$where 			= 	['users_type'=>'Retailer','users_email'=>$this->input->post('email'),'status'=>'A'];
			}elseif ($this->session->userdata('DZL_USERSTYPE') == 'Retailer') {
				$where 			= 	['users_type'=>'Users','users_email'=>$this->input->post('email'),'status'=>'A'];
			}
	    }
	    $chkUser = $this->geneal_model->getOnlyOneData('da_users', $where );
	    if(empty($chkUser)):
	    	$error	 			=	'YES';
	    	$data['emailError'] =	lang('INVALID_EMAIL');
	    endif;

		/* Check sales person and retailser available points */
        $whereCon 				 =	['users_id' => (int)$this->session->userdata('DZL_USERID')];
        $availableArabianPoints  =  $this->geneal_model->getOnlyOneData('da_users', $whereCon );
        if($availableArabianPoints):
        	if($this->input->post('recharge_amt') > $availableArabianPoints['availableArabianPoints']):
        		$error	 			=	'YES';
        		$data['amountError']=	lang('LOW_BALANCE');
        	endif;
        else:
        	$error		 			=	'YES';
        	$data['amountError']	=	lang('LOW_BALANCE');
        endif;

		if($this->form_validation->run() && $error == 'NO'):

			// From user update arabian points
			$availableArabianPoints 	= 	((int)$availableArabianPoints['availableArabianPoints'] - (int)$this->input->post('recharge_amt'));
	        $updatefield        		= 	array( 'availableArabianPoints' => (float)$availableArabianPoints );
	        $this->geneal_model->editData('da_users', $updatefield, 'users_id', (int)$this->session->userdata('DZL_USERID'));
	        $this->session->set_userdata('DZL_AVLPOINTS',$availableArabianPoints);

	        /* Load Balance Table -- from user*/
		    $fromuserparam["load_balance_id"]	=	(int)$this->geneal_model->getNextSequence('da_loadBalance');
			$fromuserparam["user_id_cred"] 		=	(int)$this->session->userdata('DZL_USERID');
			$fromuserparam["user_id_deb"]		=	(int)0;
			$fromuserparam["user_id_to"]		=	(int)$chkUser["users_id"];
			$fromuserparam["arabian_points"] 	=	(float)$this->input->post('recharge_amt');
		    $fromuserparam["record_type"] 		=	'Debit';
		    $fromuserparam["arabian_points_from"]=	'Recharge';
		    $fromuserparam["creation_ip"] 		=	$this->input->ip_address();
		    $fromuserparam["created_at"] 		=	date('Y-m-d H:i');
		    $fromuserparam["created_by"] 		=	(int)$this->session->userdata('DZL_USERSTYPE');
		    $fromuserparam["status"] 			=	"A";
		    
		    $this->geneal_model->addData('da_loadBalance', $fromuserparam);
		    /* End */

			// To user update arabian points
			$updatedTAP 	= 	((int)$chkUser['totalArabianPoints'] + (int)$this->input->post('recharge_amt')); 
		    $updateAAP 		= 	((int)$chkUser['availableArabianPoints'] + (int)$this->input->post('recharge_amt'));
			$update_data 	= 	array('totalArabianPoints' =>	(float)$updatedTAP, 'availableArabianPoints'=>	(float)$updateAAP);
			$this->geneal_model->editData('da_users', $update_data, 'users_id', (int)$chkUser['users_id']);

	        /* Load Balance Table -- to user*/
		    $touserparam["load_balance_id"]		=	(int)$this->geneal_model->getNextSequence('da_loadBalance');
			$touserparam["user_id_cred"] 		=	(int)$chkUser["users_id"];
			$touserparam["user_id_deb"]			=	(int)$this->session->userdata('DZL_USERID');
			$touserparam["arabian_points"] 		=	(float)$this->input->post('recharge_amt');
		    $touserparam["record_type"] 		=	'Credit';
		    $touserparam["arabian_points_from"] =	'Recharge';
		    $touserparam["creation_ip"] 		=	$this->input->ip_address();
		    $touserparam["created_at"] 			=	date('Y-m-d H:i');
		    $touserparam["created_by"] 			=	(int)$this->session->userdata('DZL_USERSTYPE');
		    $touserparam["status"] 				=	"A";
		    
		    $this->geneal_model->addData('da_loadBalance', $touserparam);
		    /* End */

			$this->session->set_flashdata('success', lang('RECHARGE_SUCCESS').' '.(int)$this->input->post('recharge_amt'));
			redirect('top-up-recharge');
		endif;
	endif;

	$this->load->library("pagination");

	$tblName 				=	'da_loadBalance';
	$shortField 			= 	array('_id'=> -1 );
	$whereCon2['where']		= 	array('user_id_deb'=>(int)$this->session->userdata('DZL_USERID'), "record_type" => "Credit", "arabian_points_from" => "Recharge");

	$totalPage 				=	$this->geneal_model->getData2('count',$tblName,$whereCon2,$shortField,'0','0');
	$config 				= 	['base_url'=>base_url('top-up-recharge'),'per_page'=>5,'total_rows'=>$totalPage];

	$this->pagination->initialize($config);
	$data['users']  		=	$this->geneal_model->getData2('multiple', $tblName, $whereCon2,$shortField,$this->uri->segment(2),$config['per_page']);

	$this->load->view('recharge',$data);
} //END OF FUNCTION

/***********************************************************************
** Function name 	: addUsers
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for cart list
** Date 			: 30 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function addUsers()
{  
	$data 						=	array();
	$data['error']				=	'';
	if($this->session->userdata('DZL_USERSTYPE') == 'Sales Person'){
		$data['page']			=	'Retailer';
	}elseif ($this->session->userdata('DZL_USERSTYPE') == 'Retailer') {
		$data['page']			=	'Users';
	}

	if($this->input->post('SaveChanges')):
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_message('is_unique', 'The %s is already taken');
		$data['error']			=	'NO';
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[64]|is_unique[da_users.users_email.string]');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|min_length[10]|max_length[15]|is_unique[da_users.users_mobile.integer]');
		$this->form_validation->set_rules('arabianPoints', 'Arabian Points', 'trim|required');
		if($this->input->post('page') == 'Retailer'):
			$this->form_validation->set_rules('store', 'Store Name', 'trim|required');
		endif;
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[25]');			
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|min_length[8]|matches[password]');

		/* Check sales person and retailser available points */
        $whereCon 				 =	['users_id' => (int)$this->session->userdata('DZL_USERID')];
        $availableArabianPoints  =  $this->geneal_model->getOnlyOneData('da_users', $whereCon );
        if($availableArabianPoints):
        	if($this->input->post('arabianPoints') > $availableArabianPoints['availableArabianPoints']):
        		$data['error']	 =	'YES';
        	endif;
        else:
        	$data['error']		 =	'YES';
        endif;

		if($this->form_validation->run() && $data['error'] == 'NO'):
			if($this->input->post('page') == 'Retailer'){
				$param["users_seq_id"]		=	$this->geneal_model->getNextIdSequence('users_seq_id', 'Retailer');
				$param["store_name"]		=	$this->input->post('store');
			}elseif ($this->input->post('page') == 'Users') {
				$param["users_seq_id"]		=	$this->geneal_model->getNextIdSequence('users_seq_id', 'Users');
				$param['referral_code']		=	strtoupper(uniqid(16));
			}	

			$param["users_id"]				=	(int)$this->geneal_model->getNextSequence('da_users');
			$param["users_type"] 			=	$this->input->post('page');
			$param["users_name"]			=	$this->input->post('name');
		    $param["users_email"] 			=	$this->input->post('email');
		    $param["users_mobile"]			=	(int)$this->input->post('mobile');
		    $param["password"]				=	md5($this->input->post('password'));
		    $param["totalArabianPoints"]	=	(float)$this->input->post('arabianPoints');
		    $param["availableArabianPoints"]=	(float)$this->input->post('arabianPoints');
		    $param["creation_ip"] 			=	$this->input->ip_address();
		    $param["created_at"] 			=	date('Y-m-d H:i');
		    $param["created_by"] 			=	$this->session->userdata('DZL_USERID');
		    $param["status"] 				=	"A";

		    $isInsert 	=	$this->geneal_model->addData('da_users', $param);
			if ($isInsert):
			    $availableArabianPoints 		= 	((int)$availableArabianPoints['availableArabianPoints'] - (int)$this->input->post('arabianPoints'));
		        $updatefield        		= 	array( 'availableArabianPoints' => (float)$availableArabianPoints );
		        $this->geneal_model->editData('da_users', $updatefield, 'users_id', (int)$this->session->userdata('DZL_USERID'));
		        $this->session->set_userdata('DZL_AVLPOINTS',$availableArabianPoints);

		        /* Load Balance Table -- from user*/
			    $fromuserparam["load_balance_id"]	=	(int)$this->geneal_model->getNextSequence('da_loadBalance');
				$fromuserparam["user_id_cred"] 		=	(int)$this->session->userdata('DZL_USERID');
				$fromuserparam["user_id_deb"]		=	(int)0;
				$fromuserparam["user_id_to"]		=	(int)$param["users_id"];
				$fromuserparam["arabian_points"] 	=	(float)$this->input->post('arabianPoints');
			    $fromuserparam["record_type"] 		=	'Debit';
			    $fromuserparam["arabian_points_from"]=	'Recharge';
			    $fromuserparam["creation_ip"] 		=	$this->input->ip_address();
			    $fromuserparam["created_at"] 		=	date('Y-m-d H:i');
			    $fromuserparam["created_by"] 		=	(int)$this->session->userdata('DZL_USERSTYPE');
			    $fromuserparam["status"] 			=	"A";
			    
			    $this->geneal_model->addData('da_loadBalance', $fromuserparam);
			    /* End */

		        /* Load Balance Table -- to user*/
			    $touserparam["load_balance_id"]		=	(int)$this->geneal_model->getNextSequence('da_loadBalance');
				$touserparam["user_id_cred"] 		=	(int)$param["users_id"];
				$touserparam["user_id_deb"]			=	(int)$this->session->userdata('DZL_USERID');
				$touserparam["arabian_points"] 		=	(float)$this->input->post('arabianPoints');
			    $touserparam["record_type"] 		=	'Credit';
			    $touserparam["arabian_points_from"] =	'Recharge';
			    $touserparam["creation_ip"] 		=	$this->input->ip_address();
			    $touserparam["created_at"] 			=	date('Y-m-d H:i');
			    $touserparam["created_by"] 			=	(int)$this->session->userdata('DZL_USERSTYPE');
			    $touserparam["status"] 				=	"A";
			    
			    $this->geneal_model->addData('da_loadBalance', $touserparam);
			    /* End */

		        $this->session->set_flashdata('success', 'New User created');
		        redirect('add-user');
		    endif;
		endif;
	endif;

	$this->load->library("pagination");

	$tblName 				=	'da_users';
	$shortField 			= 	array('users_id'=> -1 );
	$whereCon2['where']		= 	array('created_by'=>(int)$this->session->userdata('DZL_USERID'));

	$totalPage 				=	$this->geneal_model->getData2('count',$tblName,$whereCon2,$shortField,'0','0');
	$config 				= 	['base_url'=>base_url('add-user'),'per_page'=>5,'total_rows'=>$totalPage];

	$this->pagination->initialize($config);
	$data['users']  		=	$this->geneal_model->getData2('multiple', $tblName, $whereCon2,$shortField,$this->uri->segment(2),$config['per_page']);

	$this->load->view('addUsers',$data);
} //END OF FUNCTION

/***********************************************************************
** Function name 	: changepassword
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for change password
** Date 			: 30 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 
    public function changepassword($editId='')
	{	
        $date 				=	array();
        $data['page'] 		=	'Change Password';
		 $data['profileDetails']	=	$this->geneal_model->getOnlyOneData('da_users', ['users_id' => $this->session->userdata('DZL_USERID')]);
       
       if($this->input->post('savechanges')):
        $error							=	'NO';
       
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[6]|matches[old_password]');
      
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|max_length[25]');
			$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|min_length[6]|matches[new_password]');
		
			if($this->form_validation->run() && $error == 'NO'  && $data['profileDetails']['password'] == md5($this->input->post('old_password'))):  
          
              	$post_data   =   $this->input->post();
				$insert_data = array("password" => md5($post_data['new_password']));
      
         		$update =  $this->geneal_model->editData('da_users',$insert_data,'users_id',(int)$data['profileDetails']['users_id']);
         
       			 // print_r($update);die;
           
		         if($update)
		         {
		            // echo"working";die;
		            $this->session->set_flashdata('success', lang('CHANGE_PASS'));
		            redirect('my-profile');
		         }
		         else{
		             $this->session->set_flashdata('Error', lang('CHANGE_PASS_ERROR'));
		              redirect('my-profile');
		         }
					
			endif;
		endif;
		
		$this->layouts->set_title('Change password');
		
        $this->load->view('myprofile',$data);
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name 	: refreshpoint
	** Developed By 	: Manoj Kumar
	** Purpose 			: This function used for refresh point
	** Date 			: 16 MAY 2022
	** Updated By		:
	** Updated Date 	: 
	************************************************************************/ 
	public function refreshpoint()
	{
	    $where 			=	['users_id' => $this->session->userdata('DZL_USERID')];
		$tblName 		=	'da_users';
		$userDetails 	=	$this->geneal_model->getOnlyOneData($tblName, $where);
		if(!empty($userDetails) && $userDetails['status'] == 'A'):
			$this->session->set_userdata('DZL_USERID', $userDetails['users_id']);
			$this->session->set_userdata('DZL_USERNAME', $userDetails['users_name']);
			$this->session->set_userdata('DZL_USEREMAIL', $userDetails['users_email']);
			//$this->session->set_userdata('DZL_SEQID', $userDetails['users_sequence_id']);
			$this->session->set_userdata('DZL_USERMOBILE', $userDetails['users_mobile']);
			$this->session->set_userdata('DZL_TOTALPOINTS', $userDetails['totalArabianPoints']);
			$this->session->set_userdata('DZL_AVLPOINTS', $userDetails['availableArabianPoints']);
			$this->session->set_userdata('DZL_USERSTYPE', $userDetails['users_type']);

			$this->session->set_userdata('DZL_USERS_REFERRAL_CODE', $userDetails['referral_code']);

			$this->session->set_userdata('DZL_USERS_IMAGE', $userDetails['users_image']);
			
			$expIN = date('Y-m-d', strtotime($userDetails['created_at']. ' +12 months'));
			$today = strtotime(date('Y-m-d'));
			$dat = strtotime($expIN) - $today;
			$Tdate =  round($dat / (60 * 60 * 24));

			$this->session->set_userdata('DZL_EXPIRINGIN', $Tdate);

			redirect($_SERVER['HTTP_REFERER']);
		endif;
	}

/***********************************************************************
** Function name    : checkEmail
** Developed By     : AFSAR ALI
** Purpose          : This function used for check user.
** Date             : 17 MAY 2022
** Updated By       :
** Updated Date     : 
************************************************************************/ 
public function checkEmail()
{
    header('Content-type: application/json');
    $request = $_GET['email'];

    if(is_numeric($request)){ 
		if($this->session->userdata('DZL_USERSTYPE') == 'Sales Person'){
			$where = [ 	'users_type'	=> 'Retailer',
						'users_mobile'	=>	(int)$request ];
		}elseif ($this->session->userdata('DZL_USERSTYPE') == 'Retailer') {
			$where = [ 	'users_type'	=> 'Users',
						'users_mobile'	=>	(int)$request ];
		}
    }else{ 
    	if($this->session->userdata('DZL_USERSTYPE') == 'Sales Person'){
			$where = [ 	'users_type'	=> 'Retailer',
						'users_email'	=>	$request,
						'status'		=>	'A' ];
		}elseif ($this->session->userdata('DZL_USERSTYPE') == 'Retailer') {
			$where = [ 	'users_type'	=> 'Users',
						'users_email'	=>	$request,
						'status'		=>	'A' ];
		}
    }
    //print_r($where); die();
    $query = $this->geneal_model->checkDuplicate('da_users',$where);
    //print_r($query); die();
    if ($query == 0){ $valid = 'false';}
    else{ $valid = 'true';  }
    echo $valid;
    exit;       
} //END OF FUNCTION


/***********************************************************************
** Function name    : checkarAbianPoints
** Developed By     : AFSAR ALI
** Purpose          : This function used for check arabian points.
** Date             : 17 MAY 2022
** Updated By       :
** Updated Date     : 
************************************************************************/ 
public function checkarAbianPoints()
{
    header('Content-type: application/json');
    $rechargeAB = $_GET['recharge_amt'];
    $where 	=	[ 'users_id' => (int)$this->session->userdata('DZL_USERID') ];
    $query = $this->geneal_model->getOnlyOneData('da_users',$where);
    if ((int)$rechargeAB > (int)$query['availableArabianPoints']){ $valid = 'false';}
    else{ $valid = 'true';  }
    echo $valid;
    exit;       
} //END OF FUNCTION

/***********************************************************************
** Function name    : couponList
** Developed By     : AFSAR ALI
** Purpose          : This function used for Coupon List
** Date             : 18 MAY 2022
** Updated By       :
** Updated Date     : 
************************************************************************/ 
public function couponList()
{
	$data = array();
	
	$data = array();
	$this->load->library("pagination");

	$tblName 				=	'da_coupons';
	$shortField 			= 	array('created_at'=> -1 );
	$whereCon['where']		= 	array('users_id'=>(int)$this->session->userdata('DZL_USERID'));

	$totalPage 				=	$this->geneal_model->getData2('count',$tblName,$whereCon,$shortField,'0','0');
	$config = [
			'base_url'   =>   base_url('my-coupon'),
			'per_page'   =>    5,
			'total_rows' =>    $totalPage, 
		];
	$this->pagination->initialize($config);
	$data['coupons']  =	$this->geneal_model->getCouponData('multiple', $tblName, $whereCon,$shortField,$this->uri->segment(2),$config['per_page']);

	/*	$short_field		=	array('created_at' => -1);
	$where['where'] 	=	array( 'users_id' => (int)$this->session->userdata('DZL_USERID'));	
	$data['coupons']	=	$this->geneal_model->getCouponData('multiple', 'da_coupons',$where,$short_field );*/
	/*echo "<pre>";
	print_r($data['coupons']); die();*/
	$data['page'] 			=	'Coupon List';

    $this->load->view('coupon_list',$data);
} //END OF FUNCTION

	/***********************************************************************
	** Function name 	: mywishlist
	** Developed By 	: MANOJ KUMAR
	** Purpose 			: This function used for my wishlist
	** Date 			: 23 MAY 2022
	** Updated By		:
	** Updated Date 	: 
	************************************************************************/ 	
	public function mywishlist()
	{  
		$data 						=	array();
		$data['error']				=	'';

		$this->load->library("pagination");

		$tblName 				=	'da_wishlist';
		$shortField 			= 	array('_id'=> -1 );
		$whereCon2['where']		= 	array('users_id'=>(int)$this->session->userdata('DZL_USERID'));

		$totalPage 				=	$this->geneal_model->getData2('count',$tblName,$whereCon2,$shortField,'0','0');
		$config 				= 	['base_url'=>base_url('my-wishlist'),'per_page'=>5,'total_rows'=>$totalPage];

		$this->pagination->initialize($config);
		$data['wishlistData']  	=	$this->geneal_model->getData2('multiple', $tblName, $whereCon2,$shortField,$this->uri->segment(2),$config['per_page']);

		$this->load->view('wishlist',$data);
	} //END OF FUNCTION

	/***********************************************************************
	** Function name 	: uploadProfilePic
	** Developed By 	: MANOJ KUMAR
	** Purpose 			: This function used for upload Profile Pic
	** Date 			: 14 APRIL 2022
	** Updated By		:
	** Updated Date 	: 
	************************************************************************/ 	
	public function uploadProfilePic()
	{  
		$json = array();

		if (!empty($_FILES['file']['name']) && is_file($_FILES['file']['tmp_name'])) {

			// Sanitize the filename
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($_FILES['file']['name'], ENT_QUOTES, 'UTF-8')));
			$filename = time().$filename;

			// Allowed file extension types
			$allowed = array('jpeg','png','jpg');
			if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
				$json['error'] = "This files type not allowed";
			}

			// // Check to see if any PHP files are trying to be uploaded
			// $content = file_get_contents($_FILES['file']['tmp_name']);
			// if (preg_match('/\<\?php/i', $content)) {
			// 	$json['error'] = "This files type not allowed";
			// }

		} else {
			$json['error'] = "Error in upload. Please try again";
		}

		if (!$json) {

			// Sanitize the filename
			$uploadfilename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($_FILES['file']['name'], ENT_QUOTES, 'UTF-8')));
			$newfilename 	= time().$uploadfilename;

			$uploadtmpname	= 	$_FILES['file']['tmp_name'];

			$this->load->library("upload_crop_img");
			$uimageLink						=	$this->upload_crop_img->_upload_image($uploadfilename,$uploadtmpname,'profileimage',$newfilename,'');
			if($uimageLink == 'UPLODEERROR'):
				$json['error'] = "Error in upload. Please try again";
			else:
				$update_data = array('users_image'	=>	$uimageLink);
				$this->geneal_model->editData('da_users', $update_data, 'users_id', (int)$this->session->userdata('DZL_USERID'));
				$this->session->set_userdata('DZL_USERS_IMAGE', $uimageLink);
				$json['code'] = 200;
				$json['success'] = "Files uploaded";
			endif;
		}
		header('Content-type: application/json');
		echo json_encode($json);
	} //END OF FUNCTION
}