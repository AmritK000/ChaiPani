<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {
public function  __construct() 
{ 
    parent:: __construct();
    $this->load->model('geneal_model');
    $this->lang->load('statictext','front');
} 
/***********************************************************************
** Function name    : index
** Developed By     : AFSAR ALI
** Purpose          : This function used for index
** Date             : 18 APRIL 2022
** Updated By       :
** Updated Date     : 
************************************************************************/   
public function index()
{
    $data   =   array();
    $data['page']           =   'Sign up';

    if($this->input->post($_POST)){
        $this->form_validation->set_rules('fname', 'Username', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");

         if($this->form_validation->run())
         {
           $post_data   =   $this->input->post();
           $insert_data = array(
                "users_type"        =>  'Users',
                "users_id"          =>  (int)$this->geneal_model->getNextSequence('da_users'),
                "users_seq_id" =>  $this->geneal_model->getNextIdSequence('users_seq_id', 'Users'),
                "users_name"        =>  $post_data['fname'],
                "users_mobile"      =>  (int)$post_data['mobile'],
                "users_email"       =>  $post_data['email'],
                "password"          =>  md5($post_data['password']),
                "status"            =>  'A',
                'created_at'        =>  date('Y-m-d h:i'),   
                'created_ip'        =>  $this->input->ip_address(),
                'created_by'        =>  'Self',
                'totalArabianPoints' =>  5,
                'availableArabianPoints' => 5
           );
           if($insert_data){
            $this->geneal_model->addData('da_users', $insert_data);
            $cartItems  =   $this->cart->contents();
            foreach ($cartItems as $key => $items) {
                $insertCart = array(
                    'user_id'   =>   (int)$insert_data['users_id'],
                    'rowid'     =>  $this->geneal_model->getNextSequence('da_cartItems'),
                    'id'        =>  $items['id'],
                    'name'      =>  $items['name'],
                    'qty'       =>  (int)$items['qty'],
                    'price'     =>  (int)$items['price'],
                    'other'     =>  array(
                                    'image' =>  $items['other']['image'],
                                    'description' => $items['other']['description'],
                                    'aed' => $items['other']['aed'],
                                    ),
                    );
                $this->geneal_model->addData('da_cartItems', $insertCart);
                $data = array(
                    'rowid' =>  $items['rowid'],
                    'qty'   =>  0,
                    );
                $this->cart->update($data);
            }
            $this->session->set_flashdata('success',lang('U_CREATED'));
            redirect('login');
            }
        }else{
            $this->session->set_flashdata('error',lang('ERROR002'));
        }

    }

    $this->load->view('signup', $data);
} //END OF FUNCTION

/***********************************************************************
** Function name    : checkDuplicateMobile
** Developed By     : AFSAR ALI
** Purpose          : This function used for check already exist mobile no.
** Date             : 18 APRIL 2022
** Updated By       :
** Updated Date     : 
************************************************************************/ 
public function checkDuplicateMobile()
{
    header('Content-type: application/json');
    $request = $_GET['mobile'];
    //echo $request; die();

    $where = ['users_mobile' => (int)$request ];
    $query = $this->geneal_model->checkDuplicate('da_users',$where);

    if (!empty($query)){ $valid = 'false';}
    else{ $valid = 'true';  }
    echo $valid;
    exit;       
}

/***********************************************************************
** Function name    : checkDuplicateEmail
** Developed By     : AFSAR ALI
** Purpose          : This function used for check already exist email.
** Date             : 18 APRIL 2022
** Updated By       :
** Updated Date     : 
************************************************************************/ 
public function checkDuplicateEmail()
{
    header('Content-type: application/json');
    $request = $_GET['email'];
    //echo $request; die();

    $where = ['users_email' => $request ];
    $query = $this->geneal_model->checkDuplicate('da_users',$where);

    if (!empty($query)){ $valid = 'false';}
    else{ $valid = 'true';  }
    echo $valid;
    exit;       
}


} 


?>