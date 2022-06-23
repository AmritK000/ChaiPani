<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Head extends CI_Controller {
public function  __construct() 
{ 
	parent:: __construct();
	if(empty($this->session->userdata('DZL_USERID'))):
		redirect('login');
	endif;
} 

}
?>