<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;
use PhpOffice\PhpSpreadsheet\Worksheet;

class Allrecharge extends CI_Controller {

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
	 + + Date 			: 02 MAY 2022
	 + + Updated Date 	: 
	 + + Updated By   	:
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function index()
	{	
		$this->admin_model->authCheck();
		$data['error'] 						= 	'';
		$data['activeMenu'] 				= 	'coupons';
		$data['activeSubMenu'] 				= 	'allcoupons';
		
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
				
		$whereCon['where']		 			= 	array('arabian_points_from'=>'Recharge');		
		$shortField 						= 	array('created_at'=> -1);
		
		$baseUrl 							= 	getCurrentControllerPath('index');
		$this->session->set_userdata('ALLRECHARGEDATA',currentFullUrl());
		$qStringdata						=	explode('?',currentFullUrl());
		$suffix								= 	$qStringdata[1]?'?'.$qStringdata[1]:'';
		$tblName 							= 	'da_loadBalance';
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

		//echo "<pre>"; print_r($data['ALLDATA']);die();

		$this->layouts->set_title('All Recharge | Recharge | Dealz Arabia');
		$this->layouts->admin_view('recharge/allrecharge/index',array(),$data);
	}	// END OF FUNCTION

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 + + Function name : addeditdata
	 + + Developed By  : AFSAR ALI
	 + + Purpose  	   : This function used for Add Edit data
	 + + Date 		   : 02 MAY 2022
	 + + Updated Date  : 18-05-2022
	 + + Updated By    : Afsar Ali
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function addeditdata($editId='')
	{		
		$data['error'] 						= 	'';
		$data['activeMenu'] 				= 	'recharge';
		$data['activeSubMenu'] 				= 	'allrecharge';

		if($editId):
			$this->admin_model->authCheck('edit_data');
			$data['EDITDATA']				=	$this->common_model->getDataByParticularField('da_loadBalance','load_balance_id',(int)$editId);
		else:
			$this->admin_model->authCheck('add_data');
		endif;
		if($this->input->post('SaveChanges')):
			$error					=	'NO';

			$this->form_validation->set_rules('user', 'Email ID / Mobile No.', 'trim');
			$this->form_validation->set_rules('userID', 'Error.', 'trim');
			$this->form_validation->set_rules('addArabianPoints', 'Add Arabian Points', 'trim');
			if($this->form_validation->run() && $error == 'NO'): 
				$user 		= 	$_POST['user'];
				$addpoints	=	(int)$_POST['addArabianPoints'];
				if (is_numeric($user)) {
					$user_data = $this->common_model->getDataByParticularField('da_users', 'users_mobile', (int)$user);
				}else{
					$user_data = $this->common_model->getDataByParticularField('da_users', 'users_email', $user);
				}
				if(!empty($user_data)){
					$param["user_id_cred"] 			=	(int)$user_data['users_id'];
					$param['user_id_deb']			=	(int)0;
					$param['arabian_points']		=	(float)$addpoints;
					$param["arabian_points_from"] 	=	'Recharge';
					$param['record_type']			=	'Credit';
				}
				if($this->input->post('CurrentDataID') ==''):
					$param['load_balance_id']			=	(int)$this->common_model->getNextSequence('da_loadBalance');
					$param['creation_ip']		=	currentIp();
					$param['created_at']		=	date('Y-m-d H:i');//currentDateTime();
					$param['created_by']		=	'ADMIN';
					$param['status']			=	'A';
					$alastInsertId				=	$this->common_model->addData('da_loadBalance',$param);
					if(!empty($alastInsertId)){
						$totalPoints  = $user_data['totalArabianPoints'] + $param['arabian_points'];
						$avlPoints 	 = $user_data['availableArabianPoints'] + $param['arabian_points'];
						$udateData = array(
							'totalArabianPoints'		=>	$totalPoints,
							'availableArabianPoints'	=>	$avlPoints
						);
						$isEdit = $this->common_model->editData('da_users', $udateData, 'users_id', $user_data['users_id']);
					}
					$this->session->set_flashdata('alert_success',lang('addsuccess'));
				endif;
				redirect(correctLink('MASTERDATARECHARGETYPE',getCurrentControllerPath('index')));
			endif;
		endif;
		$this->layouts->set_title('Add/Edit Recharge System');
		$this->layouts->admin_view('recharge/allrecharge/addeditdata',array(),$data);
	}	// END OF FUNCTION	

	/***********************************************************************
	** Function name 	: changestatus
	** Developed By 	: Afsar Ali
	** Purpose  		: This function used for change status
	** Date 			: 02 MAY 2022
	************************************************************************/
	function changestatus($changeStatusId='',$statusType='')
	{  
		$this->admin_model->authCheck('edit_data');
		$param['status']		=	$statusType;
		$this->common_model->editData('da_loadBalance',$param,'load_balance_id',(int)$changeStatusId);
		$this->session->set_flashdata('alert_success',lang('statussuccess'));
		
		redirect(correctLink('ALLRECHARGEDATA',getCurrentControllerPath('index')));
	}

	/***********************************************************************
	** Function name 	: deletedata
	** Developed By 	: Afsar Ali
	** Purpose  		: This function used for delete data
	** Date 			: 08 APRIL 2022
	************************************************************************/
	function deletedata($deleteId='')
	{  
		$this->admin_model->authCheck('delete_data');
		$this->common_model->deleteData('da_loadBalance','load_balance_id',(int)$deleteId);
		$this->common_model->deleteData('da_coupon_code_only','load_balance_id',(int)$deleteId);
		$this->session->set_flashdata('alert_success',lang('deletesuccess'));
		
		redirect(correctLink('ALLRECHARGEDATA',getCurrentControllerPath('index')));
	}

	/***********************************************************************
	** Function name 	: exportexcel
	** Developed By 	: Afsar Ali
	** Purpose  		: This function used for export deleted users data
	** Date 			: 09 APRIL 2022
	** Updated Date 	: 
	** Updated By   	: 
	************************************************************************/
	function exportexcel($load_balance_id='')
	{  
		/* Export excel button code */
		//echo $load_balance_id; die();
		$wcon['load_balance_id']          =   $load_balance_id;
		$data        			=   $this->common_model->getData('multiple','da_coupon_code_only',$wcon);//echo '<pre>';print_r($data);die;

        $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Sl.No');
		$sheet->setCellValue('B1', 'COUPON ID');
		$sheet->setCellValue('C1', 'RECHARDE COUPON ID');
		$sheet->setCellValue('D1', 'COUPON CODE');
		$sheet->setCellValue('E1', 'STATUS');
		$sheet->setCellValue('F1', 'CREATION DATE');

		
	$slno = 1;
	$start = 2;
		foreach($data as $d){
			$sheet->setCellValue('A'.$start, $slno);
			$sheet->setCellValue('B'.$start, $d['couponID']);
			$sheet->setCellValue('C'.$start, $d['load_balance_id']);
			$sheet->setCellValue('D'.$start, $d['coupon_code']);
			$sheet->setCellValue('E'.$start, $d['status']);
			$sheet->setCellValue('F'.$start, date('d-m-Y H:i:s', $d['created_date']));
			
			
	$start = $start+1;
	$slno = $slno+1;
		}
	$styleThinBlackBorderOutline = [
					'borders' => [
						'allBorders' => [
							'borderStyle' => Border::BORDER_THIN,
							'color' => ['argb' => 'FF000000'],
						],
					],
				];
		//Font BOLD
		$sheet->getStyle('A1:E1')->getFont()->setBold(true);		
		$sheet->getStyle('A1:I1000')->applyFromArray($styleThinBlackBorderOutline);
		//Alignment
		//fONT SIZE
		$sheet->getStyle('A1:D10')->getFont()->setSize(12);
		$sheet->getStyle('A1:D2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$sheet->getStyle('A2:D100')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		//Custom width for Individual Columns
		$sheet->getColumnDimension('A')->setWidth(5);
		$sheet->getColumnDimension('B')->setWidth(30);
		$sheet->getColumnDimension('C')->setWidth(30);
		$sheet->getColumnDimension('D')->setWidth(30);
		$sheet->getColumnDimension('E')->setWidth(15);
		$sheet->getColumnDimension('F')->setWidth(15);
		/*$sheet->getColumnDimension('G')->setWidth(15);
		$sheet->getColumnDimension('H')->setWidth(30);
		$sheet->getColumnDimension('I')->setWidth(30);*/
		

		$curdate = date('d-m-Y H:i:s');
		$writer = new Xlsx($spreadsheet);
		$filename = 'Recharge-Coupon-list'.$curdate;
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
		//endif;
		/* Export excel END */
	}


public function checkDeplicacy(){
	//echo $_POST['user']; die();

	$user 	= $_POST['user'];

	if (is_numeric($user)) {
		//echo 'Numeric'; die();
		$user_data = $this->common_model->getDataByParticularField('da_users', 'users_mobile', (int)$user);
	}else{
		//echo 'String'; die();		
		$user_data = $this->common_model->getDataByParticularField('da_users', 'users_email', $user);
	}
	//print_r($user_data); die();

	if($user_data['availableArabianPoints']){
		echo 'Your ' .strtolower($user_data['users_type']). ' available arabian points is '.number_format($user_data['availableArabianPoints'],2).'__'.$user_data['users_id']; 
	}else{
		echo "Email ID / Mobile is not registered.";
	}

}


}