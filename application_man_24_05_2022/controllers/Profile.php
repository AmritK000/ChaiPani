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

	$tbl 					=	'da_users';
	$where 					=	['users_id' => $this->session->userdata('DZL_USERID')];
	$data['profileDetails']			=	$this->geneal_model->getOnlyOneData($tbl, $where);

	$this->load->view('myprofile',$data);
} //END OF FUNCTION

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
	$data 					=	array();
	$date['page']			=	'Topup Recharge';

	if($_POST){

		$request = $_POST['email'];

		$this->form_validation->set_rules('email', 'Email ID / Mobile No.', 'trim');
		$this->form_validation->set_rules('recharge_amt', 'Arabian Points', 'trim');

		if ($this->form_validation->run()) {
		

			if(is_numeric($request)){ 
				if($this->session->userdata('DZL_USERSTYPE') == 'Sales Person'){
					$where = [ 	'users_type'	=> 'Retailer',
								'users_mobile'	=>	(int)$request,
								'status'		=>	'A' ];
				}elseif ($this->session->userdata('DZL_USERSTYPE') == 'Retailer') {
					$where = [ 	'users_type'	=> 'Users',
								'users_mobile'	=>	(int)$request,
								'status'		=>	'A' ];
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
		$chkUser = $this->geneal_model->getOnlyOneData('da_users', $where );
		
		$whereCon 	 =	['users_id' => (int)$this->session->userdata('DZL_USERID')];
	    $salesArray  =  $this->geneal_model->getOnlyOneData('da_users', $whereCon );

		if(!empty($chkUser)){
		    if($_POST['recharge_amt'] > $salesArray['totalArabianPoints']){
		        $this->session->set_flashdata('error', lang('LOW_BALANCE'));
		        redirect('top-up-recharge');
	        }else{
	           
		        /* Load Balance Table */
		        $param["load_balance_id"]		=	(int)$this->geneal_model->getNextSequence('da_loadBalance');
				$param["user_id_cred"] 			=	(int)$chkUser['users_id'];
				$param["user_id_deb"]			=	(int)$this->session->userdata('DZL_USERID');
				$param["arabian_points"] 		=	(int)$_POST['recharge_amt'];
				$param["arabian_points_from"] 	=	'Recharge';
			    $param["record_type"] 			=	'Credit';
			    $param["creation_ip"] 			=	$this->input->ip_address();
			    $param["created_at"] 			=	date('Y-m-d H:i');
			    $param["created_by"] 			=	$this->session->userdata('DZL_USERSTYPE');
			    $param["status"] 				=	"A";
			    
			    $this->geneal_model->addData('da_loadBalance', $param);
		        /* End */
		        //print_r($param); die();

		        //update available arabian points from login users

		        $updatedArabianPoints = (int)$salesArray['availableArabianPoints'] - (int)$_POST['recharge_amt'];
		        /*echo $salesArray['totalArabianPoints']; echo "<br>";
		        echo $_POST['recharge_amt']; echo "<br>";
		        echo $updatedArabianPoints; die();*/

		        $field        = array( 'availableArabianPoints' => $updatedArabianPoints );

	            $this->geneal_model->editData('da_users', $field, 'users_id', (int)$this->session->userdata('DZL_USERID'));

	            $this->session->set_userdata('DZL_AVLPOINTS',$updatedArabianPoints);
	            // END

	            // Update total and available arabian points to given recharge user

			    $updatedTAP = (int)$chkUser['totalArabianPoints'] + (int)$_POST['recharge_amt']; // Total Arabian Points

			    $updateAAP = (int)$chkUser['availableArabianPoints'] + (int)$_POST['recharge_amt'];

				$insert_data = array(
						'totalArabianPoints' 	=>	(int)$updatedTAP,
						'availableArabianPoints'=>	(int)$updateAAP
					);

				$this->geneal_model->editData('da_users', $insert_data, 'users_id', (int)$chkUser['users_id']);

				$this->session->set_flashdata('success', printf(lang('RECHARGE_SUCCESS'),$_POST['recharge_amt']));
				redirect('top-up-recharge');
	        }
		}else{
			$this->session->set_flashdata('error', lang('INVALID_EMAIL'));
			redirect('top-up-recharge');
		}

		}else{
			$this->session->set_flashdata('error', lang('INVALID'));
			redirect('top-up-recharge');
		}
	}
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
	$data 					=	array();
	if($this->session->userdata('DZL_USERSTYPE') == 'Sales Person'){
		$data['page']			=	'Add Retailer';
	}elseif ($this->session->userdata('DZL_USERSTYPE') == 'Retailer') {
		$data['page']			=	'Add Users';
	}
	
	if($this->input->post()){
	//	print_r($_POST); die();
		if($_POST['page'] == 'Retailer'){
			$param["users_seq_id"]	=	$this->geneal_model->getNextIdSequence('users_seq_id', 'Retailer');
			$param["store_name"]	=	$_POST['store'];
		}elseif ($_POST['page'] == 'Users') {
			$param["users_seq_id"]	=	$this->geneal_model->getNextIdSequence('users_seq_id', 'Users');
			$param['referral_code']	=	strtoupper(uniqid(16));
		}	

		$param["users_id"]				=	(int)$this->geneal_model->getNextSequence('da_users');
		$param["users_type"] 			=	$_POST['page'];
		$param["users_name"]			=	$_POST['name'];
	    $param["users_email"] 			=	$_POST['email'];
	    $param["users_mobile"]			=	(int)$_POST['mobile'];
	    $param["password"]				=	md5($_POST['password']);
	    $param["totalArabianPoints"]	=	(int)$_POST['arabianPoints'];
	    $param["availableArabianPoints"]=	(int)$_POST['arabianPoints'];
	    $param["creation_ip"] 			=	$this->input->ip_address();
	    $param["created_at"] 			=	date('Y-m-d H:i');
	    $param["created_by"] 			=	$this->session->userdata('DZL_USERID');
	    $param["status"] 				=	"A";
        
        /* Update Sales person Arabian Points */
        $whereCon 	 =	['users_id' => (int)$this->session->userdata('DZL_USERID')];
        $salesArray  =  $this->geneal_model->getOnlyOneData('da_users', $whereCon );
        
        if($_POST['arabianPoints'] > $salesArray['totalArabianPoints']):
	        $this->session->set_flashdata('error', lang('LOW_BALANCE'));
	        redirect('add-user');
        else:
	        $updatedArabianPoints = (int)$salesArray['totalArabianPoints'] - (int)$_POST['arabianPoints'];
	        $field        = array( 'totalArabianPoints' => $updatedArabianPoints );
	        $this->geneal_model->editData('da_users', $field, 'users_id', (int)$this->session->userdata('DZL_USERID'));
	        $this->session->set_userdata('DZL_AVLPOINTS',$updatedArabianPoints);
	        $this->geneal_model->addData('da_users', $param);
	        $this->session->set_flashdata('success', 'New User created');
	        redirect('add-user');
        endif;
	        /* End */
	}

	$this->load->library("pagination");

	$tblName 				=	'da_users';
	$shortField 			= 	array('users_id'=> -1 );
	$whereCon2['where']		= 	array('created_by'=>(int)$this->session->userdata('DZL_USERID'));

	$totalPage 				=	$this->geneal_model->getData2('count',$tblName,$whereCon2,$shortField,'0','0');
	//echo $totalPage; die();
	$config = [
			'base_url'   =>   base_url('add-user'),
			'per_page'   =>    5,
			'total_rows' =>    $totalPage, 
		];

	$this->pagination->initialize($config);

	$data['users']  =	$this->geneal_model->getData2('multiple', $tblName, $whereCon2,$shortField,$this->uri->segment(2),$config['per_page']);

	$this->load->view('addUsers',$data);
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
 
	if($this->input->post($_POST)){//print_r($_POST);die;

		$insert_data = array(
			'users_name'	=>	$this->input->post('users_name'),
			'user_mobile'	=>	$this->input->post('user_mobile'),
			'users_email'	=>	$this->input->post('users_email'),
			//'Gender'        =>  $this->input->post('Gender'), 
			'updated_at'	=>	date('Y-m-d H:i'),
			'updated_ip'	=>	$this->input->ip_address(),
		);
		$isInsert 	=	$this->geneal_model->editData('da_users', $insert_data, 'users_id', (int)$this->session->userdata('DZL_USERID'));

		if ($isInsert) {
			$this->session->set_flashdata('success', lang('UPDATED'));
			redirect('my-profile');
		}
	}
	
	$this->load->view('editmyprofile',$data);
}

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
      //print_r($data);die;
       
       if($this->input->post('savechanges')):
        $error							=	'NO';
       
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[6]|matches[old_password]');
      
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|max_length[25]');
			$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|min_length[6]|matches[new_password]');
		
			if($this->form_validation->run() && $error == 'NO'  && $data['profileDetails']['password'] == md5($this->input->post('old_password'))):  
                 
              // echo"working";die;
             
              $post_data   =   $this->input->post();
  
		$insert_data = array(
            
            "password" => md5($post_data['new_password']),
         
        );
      
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
    if ((int)$rechargeAB > $query['availableArabianPoints']){ $valid = 'false';}
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
	//echo "string";die();
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

}
