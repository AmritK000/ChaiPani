<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
public function  __construct() 
	{ 
		parent:: __construct();
		$this->load->model(array('geneal_model','emailtemplate_model','common_model'));
		$this->lang->load('statictext','front');
		
	} 
/***********************************************************************
** Function name 	: index
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for login
** Date 			: 14 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function index()
{  
	$data 					=	array();
	$data['page']			=	'Login';

	if($this->session->userdata('DZL_USERID')):
		redirect('my-profile');
	endif;
	if($this->input->get('referenceUrl')):
		$this->session->set_userdata('referenceUrl',$this->input->get('referenceUrl'));
		redirect('login');
	endif;

	/*--------------------Start Login--------------------*/
	if($this->input->post($_POST)):
		//print_r($_POST); die();
		$this->form_validation->set_rules('userid', 'Credential', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");

		if($this->form_validation->run()):
			$loginID 			=	$this->input->post('userid');
			$password 			=	md5($this->input->post('password'));
			$userDetails = array();
			if(is_numeric($loginID)):
				$where 			=	[ 'users_mobile' => (int)$loginID ];
				$tblName 		=	'da_users';
				$userDetails 	=	$this->geneal_model->getOnlyOneData($tblName, $where);
				if(!empty($userDetails)): $data = $userDetails; endif;
				
			else:
				$where 			=	[ 'users_email' => $loginID ];
				$tblName 		=	'da_users';
				$userDetails 	=	$this->geneal_model->getOnlyOneData($tblName, $where);
				if(!empty($userDetails)): $data = $userDetails; endif;
			endif;
			if(!empty($data) && $password == $data['password']):
				if($data['status'] == 'A'){
					$this->session->set_userdata('DZL_USERID', $data['users_id']);
					$this->session->set_userdata('DZL_USERNAME', $data['users_name']);
					$this->session->set_userdata('DZL_USEREMAIL', $data['users_email']);
					//$this->session->set_userdata('DZL_SEQID', $data['users_sequence_id']);
					$this->session->set_userdata('DZL_USERMOBILE', $data['users_mobile']);
					$this->session->set_userdata('DZL_TOTALPOINTS', $data['totalArabianPoints']);
					$this->session->set_userdata('DZL_AVLPOINTS', $data['availableArabianPoints']);
					$this->session->set_userdata('DZL_USERSTYPE', $data['users_type']);

					$this->session->set_userdata('DZL_USERS_REFERRAL_CODE', $data['referral_code']);
					
					$expIN = date('Y-m-d', strtotime($data['created_at']. ' +12 months'));
					$today = strtotime(date('Y-m-d'));
					$dat = strtotime($expIN) - $today;
					$Tdate =  round($dat / (60 * 60 * 24));


					$this->session->set_userdata('DZL_EXPIRINGIN', $Tdate);

					$this->updateUserIdInCartData($data['users_id']);

					if(!empty($this->session->userdata('REDIRECT'))){
						redirect('home');						
					}

					if($this->session->userdata('referenceUrl')):
						$referenceUrl =	$this->session->userdata('referenceUrl');
						$this->session->unset_userdata(array('referenceUrl'));
						redirect($referenceUrl);
					else:
						redirect('my-profile');
					endif;
				}else{
					$this->session->set_flashdata('error', lang('INACTIVE'));	
					redirect('login');
				}
			else:
				$this->session->set_flashdata('error', lang('ERROR'));
			endif;
		else:	
		endif;
	endif;
	/*--------------------End Login--------------------*/
	$this->load->view('login',$data);
} //FND OF FUNCTION

public function updateUserIdInCartData($users_id=''){
	if($this->cart->contents()){
		foreach ($this->cart->contents() as $items) {
			$totalAmt =  $totalAmt + $items['qty'] * $items['other']['aed'];
			$data = array('rowid' =>$items['rowid'],'user_id' =>	(int)$users_id);
			$this->cart->update($data);

			$this->geneal_model->deleteData('da_cartItems', 'rowid', $items['rowid']);
			$Ctabledata = array(
							'user_id'	=>	(int)$users_id,
							'id'		=>	$items['id'],
							'name'		=>	$items['name'],
							'qty'		=>	$items['qty'],
							'price' 	=>	$items['price'],
							'other' 	=>	array(
												'image' 		=>	$items['price']['image'],
												'description' 	=>	$items['price']['description'],
												'aed'			=>	$items['price']['aed'],
											),
							'is_donated'=>  $items['is_donated'],
							'rowid'		=>	$items['rowid'],
							'subtotal'	=>	$items['subtotal']
						);
			$Ctbl 		=	'da_cartItems';
			$this->geneal_model->addData($Ctbl, $Ctabledata);
		}
	}
}

/***********************************************************************
** Function name 	: logout
** Developed By 	: AFSAR AlI
** Purpose 			: This function used for logout users
** Date 			: 14 APRIL 2022
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function logout()
{
	$this->session->unset_userdata(array('DZL_USERID',
										 'DZL_USERNAME',
										 'DZL_USEREMAIL',
										 'DZL_SEQID',));
	redirect('login');
}//FND OF FUNCTION


/***********************************************************************
** Function name 	: forgotpassword
** Developed By 	: Ritu Mishra
** Purpose 			: This function used for logout users forgot password
** Date 			: 
** Updated By		:
** Updated Date 	: 
************************************************************************/ 	
public function forgotpassword()
{
    $data['page'] = 'Forgot Password';

	//if($this->session->userdata('HCAP_ADMIN_ID')) redirect($this->session->userdata('HCAP_ADMIN_CURRENT_PATH').'maindashboard');
	//	$data['error'] 						= 	'';

		/*-----------------------------------Forgot password ---------------*/
		if($this->input->post('formSubmit')):	
			//Set rules
			
			$this->form_validation->set_rules('useremail', 'Email', 'trim|required');
			
			if($this->form_validation->run()):	
				//echo"working";die;
				$result		=	$this->geneal_model->getDataByParticularField('da_users','users_email',$this->input->post('useremail'));
		  	    $this->session->set_userdata('recoveryemail',$this->input->post('useremail'));
			
				if($result):
					if($result['status'] != 'A'):	
						$data['forgoterror'] = lang('accountblock');	
					else:
						$param['users_otp']		= (int)'4321';	//(int)generateRandomString(4,'n'); 
						$this->geneal_model->editData('da_users',$param,'users_id',(int)$result['users_id']);
						$finalres = $this->geneal_model->getDataByParticularField('da_users','users_email',$this->input->post('useremail'));
                         // echo($this->session->userdata('recoveryemail'));die; 
                        // print_r($finalres);die;
						$this->emailtemplate_model->sendForgotpasswordMailToUser($finalres);
						
				//	$this->emailtemplate_model->get_email_template_by_mail_type($finalres);
						
			//	print_r($result);die;

					$this->session->set_userdata(array('otpType'=>'Forgot Password','otpUserId'=>$result['users_id'],'otpUserEmail'=>$result['users_email']));

						$this->session->set_flashdata('success',lang('OTP_SENT').$result['users_email']);
					//	redirect(getCurrentBasePath().'password-recover');
					redirect('password-recover');
					endif;
				else:
					$data['forgoterror'] = lang('Invalid_Email');
				endif;
			endif;
		endif;
		
	$this->load->view('profileforgotpassword',$data);

}

/***********************************************************************
** Function name 	: passwordrecover
** Developed By 	: Ritu Mishra
** Purpose 			: This function used for logout users update password
** Date 			: 
** Updated By		:
** Updated Date 	: 
************************************************************************/ 
public function passwordrecover()
	{	
		$data['page'] = 'Reset Password';
		

		/*-----------------------------------recover pin ---------------*/
		if($this->input->post('RecoverFormSubmit')):	
			//Set rules
			
		
			$this->form_validation->set_rules('userotp', 'otp', 'trim|required|min_length[4]|max_length[4]');
			$this->form_validation->set_rules('new_password', 'New password', 'trim|required|min_length[6]|max_length[25]');
			$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|min_length[6]|matches[new_password]');
			
			if($this->form_validation->run()):
					
			$result		=	$this->geneal_model->getDataByParticularField('da_users','users_email',$this->session->userdata('recoveryemail'));
		   
	        if($result):
		        $checkOTP =	$this->geneal_model->checkOTP((int)$this->input->post('userotp'));
                if($checkOTP):
                	$param['password']		=	md5($this->input->post('new_password'));
					
					$this->common_model->editData('da_users',$param,'users_id',(int)$result['users_id']);
		
					$this->session->set_flashdata('successA',lang('PASS_CHANGE_SUCCESS'));
				
					redirect('login');
				else:
					$data['recovererror'] = lang('invalidotp');
				endif;
			endif;
		endif;
		endif;
		$this->layouts->set_title('Password Recover | DealzAribia');
	
		$this->load->view('password_recovery',$data);
	}	// END OF FUNCTION
}
