<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_list extends CI_Controller{
public function  __construct() 
{ 
    parent:: __construct();
    $this->load->model(array('geneal_model','common_model'));
    $this->lang->load('statictext','front');
} 
/***********************************************************************
** Function name    : index
** Developed By     : AFSAR AlI
** Purpose          : This function used for index
** Date             : 21 APRIL 2022
** Updated By       :
** Updated Date     : 
************************************************************************/   
public function index()
{
    $data                    =   array();
    $data['page']           =   'Product List';

    $tbl                    =   'da_products';
    $wcon['where']          =  array('stock'=> array('$ne'=> 0),
                                     'clossingSoon' => 'Y',
                                    );
    $order                  =   ['creation_date' => 'desc'];
    $data['closing_soon']   =   $this->geneal_model->getData2('multiple', $tbl, $wcon);

    $tbl                    =   'da_products';
    $wcon['where']          =  array( 'stock'=> array('$ne'=> 0),
                                      'clossingSoon' => 'N',    
                                    );
    $order                  =   ['creation_date' => 'desc'];
    $data['products']       =   $this->geneal_model->getData2('multiple', $tbl, $wcon);

    /*echo "<pre>";
    print_r($data['products']); die();*/


    $this->load->view('product_list',$data);
} //END OF FUNCTION

   
}

?>
