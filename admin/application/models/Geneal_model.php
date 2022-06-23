<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Geneal_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct(); 
	}

	/***********************************************************************
	** Function name: getDataByMultipleAndCondition
	** Developed By: Manoj Kumar
	** Purpose: This function used for get data by query
	** Date : 29 JULY 2021
	************************************************************************/
	public function getDataByMultipleAndCondition($tbl_name='',$query='',$arrayfield=array())
	{  
		$resultData = array();
		$result 		= 		$this->mongo_db->aggregate($tbl_name,$query,array('batchSize'=>4)); 
		foreach($result as $results):
			foreach($results as $key=>$valye):
				if(is_array($results[$key])):
					$results[$key] 	=	$results[$key][0];
				endif;
			endforeach;
			array_push($resultData,$results);
		endforeach;		
		$groupedData 	= json_decode(json_encode($resultData), true);
		return $groupedData;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name: getOrderData
	** Developed By: Manoj Kumar
	** Purpose: This function used for get Property Data
	** Date : 29 JULY 2021
	************************************************************************/
	public function getOrderData($action='',$tbl_name='',$where_condition='',$short_field='',$page='',$per_page='')
	{  
		$filterArray 				=	array();

		if($where_condition['search']):
			array_push($filterArray,array($where_condition['search'][0]=>new MongoDB\BSON\Regex ($where_condition['search'][1],'i')));
		endif;
		if($where_condition['where']):
			foreach($where_condition['where'] as $where_key=>$where_value):
				array_push($filterArray,array($where_key=>$where_value));
			endforeach;
		endif;

		$selectFields 			=  	array(
							'$project' => array(
								'_id'=>0,
								'order_details_id'=>1,
								'order_id'=>1,
								'product_id'=>1,
								'users_id'=>1,
								'quantity'=>1,
								'subtotal'=>1,
								'quantity'=>1,
								'price'=>1,
								'is_donated'=>1,
								'created_at'=>1,

								'payment_mode'=>'$from_order.payment_mode',
								'order_status'=>'$from_order.order_status',

								'users_name'=>'$from_users.users_name',
								'users_email'=>'$from_users.users_email',
								'users_mobile'=>'$from_users.users_mobile',
								'product_name'=>'$from_product.title',
								'stock'=>'$from_product.stock'

								));

		$whereCondition					=	array();

		if($filterArray):
			foreach($filterArray as $filterInfo):
				array_push($whereCondition,$filterInfo);
			endforeach;
		endif;

		$currentQuery					=	array(array('$lookup'=>array('from'=>'da_users','localField'=>'user_id','foreignField'=>'users_id','as'=>'from_users')),
												  array('$lookup'=>array('from'=>'da_products','localField'=>'product_id','foreignField'=>'products_id','as'=>'from_product')),

												  array('$lookup'=>array('from'=>'da_orders','localField'=>'order_id','foreignField'=>'order_id','as'=>'from_order')),

												  $selectFields,
												  array('$match'=>array('$and'=>$whereCondition)),
												  array('$sort'=>$short_field));//echo '<pre>';print_r($currentQuery);die;

		if($action == 'count'):
			$totalDataCount				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
			if($totalDataCount):
				return count($totalDataCount);
			endif;
		elseif($action == 'single'):
			$currentData				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
			return $currentData[0];
		elseif($action == 'multiple'):	
			/*if($per_page):
				array_push($currentQuery,array('$skip'=>(int)$page));
				array_push($currentQuery,array('$limit'=>(int)$per_page));
			endif;*/ 
			$currentData				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
			return $currentData;
		endif;
	}	// END OF FUNCTION


	/***********************************************************************
	** Function name: getApointmentData
	** Developed By: Manoj Kumar
	** Purpose: This function used for get Property Data
	** Date : 29 JULY 2021
	************************************************************************/
	public function getApointmentData($action='',$tbl_name='',$where_condition='',$short_field='',$page='',$per_page='')
	{  
		$filterArray 				=	array();

		if($where_condition['search']):
			array_push($filterArray,array($where_condition['search'][0]=>new MongoDB\BSON\Regex ($where_condition['search'][1],'i')));
		endif;
		if($where_condition['where']):
			foreach($where_condition['where'] as $where_key=>$where_value):
				array_push($filterArray,array($where_key=>$where_value));
			endforeach;
		endif;

		$selectFields 					=  	array('$project' => array('_id'=>0,'appointment_id'=>1,'sequence_appointment_id'=>1,'doctor_id'=>1,'fees'=>1,'appointment_date'=>1,'appointment_time'=>1,'users_id'=>1,'appointment_status'=>1,'creation_date'=>1,'status'=>1,
			'doctor_name'=>'$from_doctor.doctor_name','specialization_name'=>'$from_doctor.specialization_name','city_name'=>'$from_doctor.city_name',
			'users_name'=>'$from_users.users_name','users_email'=>'$from_users.users_email','users_address'=>'$from_users.users_address','users_mobile'=>'$from_users.users_mobile'));

		$whereCondition					=	array();

		if($filterArray):
			foreach($filterArray as $filterInfo):
				array_push($whereCondition,$filterInfo);
			endforeach;
		endif;

		$currentQuery					=	array(array('$lookup'=>array('from'=>'hcap_users','localField'=>'users_id','foreignField'=>'users_id','as'=>'from_users')),
												  array('$lookup'=>array('from'=>'hcap_doctors','localField'=>'doctor_id','foreignField'=>'doctor_id','as'=>'from_doctor')),
												  $selectFields,
												  array('$match'=>array('$and'=>$whereCondition)),
												  array('$sort'=>$short_field));

		if($action == 'count'):
			$totalDataCount				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
			if($totalDataCount):
				return count($totalDataCount);
			endif;
		elseif($action == 'single'):
			$currentData				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
			return $currentData[0];
		elseif($action == 'multiple'):	
			if($per_page):
				array_push($currentQuery,array('$skip'=>(int)$page));
				array_push($currentQuery,array('$limit'=>(int)$per_page));
			endif; 
			$currentData				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
			return $currentData;
		endif;
	}	// END OF FUNCTION


	/***********************************************************************
	** Function name: getassignedUserdata
	** Developed By: Ravi Negi
	** Purpose: This function used for get assigned order data
	** Date : 30 SEP 2021
	************************************************************************/
	public function getassignedUserdata($action='',$tbl_name='',$where_condition='',$short_field='',$page='',$per_page='')
	{  
		$filterArray 				=	array();

		if($where_condition['search']):
			array_push($filterArray,array($where_condition['search'][0]=>new MongoDB\BSON\Regex ($where_condition['search'][1],'i')));
		endif;
		if($where_condition['where']):
			foreach($where_condition['where'] as $where_key=>$where_value):
				array_push($filterArray,array($where_key=>$where_value));
			endforeach;
		endif;

		$selectFields 					=  	array('$project' => array('_id'=>0,'assigned_order_id'=>1,'order_id'=>1,'provider_id'=>1,'assign_date'=>1,'creation_date'=>1,
																	  'address'=>1,'current_location'=>1,'status'=>1,
																	  'users_name'=>'$from_users.users_name','users_email'=>'$from_users.users_email','users_mobile'=>'$from_users.users_mobile'));

		$whereCondition					=	array();

		if($filterArray):
			foreach($filterArray as $filterInfo):
				array_push($whereCondition,$filterInfo);
			endforeach;
		endif;

		$currentQuery					=	array(array('$lookup'=>array('from'=>'hcap_users','localField'=>'provider_id','foreignField'=>'users_id','as'=>'from_users')),
												  $selectFields,
												  array('$match'=>array('$and'=>$whereCondition)),
												  array('$sort'=>$short_field));

		if($action == 'count'):
			$totalDataCount				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
			if($totalDataCount):
				return count($totalDataCount);
			endif;
		elseif($action == 'single'):
			$currentData				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
			return $currentData[0];
		elseif($action == 'multiple'):	
			if($per_page):
				array_push($currentQuery,array('$skip'=>(int)$page));
				array_push($currentQuery,array('$limit'=>(int)$per_page));
			endif; 
			$currentData				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
			return $currentData;
		endif;
	}	// END OF FUNCTION

/***********************************************************************
** Function name: getCouponData
** Developed By: Manoj Kumar
** Purpose: This function used for get Property Data
** Date : 29 JULY 2021
************************************************************************/
public function getCouponData($action='',$tbl_name='',$where_condition='',$short_field='',$page='',$per_page='')
{  
	//echo $action.'__'. $tbl_name.'__'. $where_condition; die();
	$filterArray 				=	array();

	if($where_condition['search']):
		array_push($filterArray,array($where_condition['search'][0]=>new MongoDB\BSON\Regex ($where_condition['search'][1],'i')));
	endif;
	if($where_condition['where']):
		foreach($where_condition['where'] as $where_key=>$where_value):
			array_push($filterArray,array($where_key=>$where_value));
		endforeach;
	endif;

	$selectFields 					=  	array('$project' => array('_id'=>0,'coupon_id'=>1,'users_id'=>1,'users_email'=>1,'order_id'=>1,'product_id'=>1,'product_title'=>1,'coupon_code'=>1,'created_at'=>1,
																  
																  'product_name'=>'$from_product.title','adepoints'=>'$from_product.adepoints',

																  'payment_mode'=>'$from_orders.payment_mode','dilivertAddress'=>'$from_orders.dilivertAddress',

																  'users_name'=>'$from_users.users_name','users_mobile'=>'$from_users.users_mobile'));

	$whereCondition					=	array();

	if($filterArray):
		foreach($filterArray as $filterInfo):
			array_push($whereCondition,$filterInfo);
		endforeach;
	endif;

	$currentQuery					=	array(array('$lookup'=>array('from'=>'da_users','localField'=>'users_id','foreignField'=>'users_id','as'=>'from_users')),
											  array('$lookup'=>array('from'=>'da_products','localField'=>'product_id','foreignField'=>'products_id','as'=>'from_product')),
											  array('$lookup'=>array('from'=>'da_orders','localField'=>'order_id','foreignField'=>'order_id','as'=>'from_orders')),
											  $selectFields,
											  array('$match'=>array('$and'=>$whereCondition)),
											  array('$sort'=>$short_field));

	
	if($action == 'count'):

		$totalDataCount				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
		//echo "<pre>"; print_r($totalDataCount); die();
		if($totalDataCount):
			return count($totalDataCount);
		endif;
	elseif($action == 'single'):
		$currentData				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
		return $currentData[0];
	elseif($action == 'multiple'):	
		/*if($per_page):
			array_push($currentQuery,array('$skip'=>(int)$page));
			array_push($currentQuery,array('$limit'=>(int)$per_page));
		endif; */
		$currentData				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
		return $currentData;
	endif;
}	// END OF FUNCTION

/***********************************************************************
** Function name: getloadbalence
** Developed By: Ravi Negi
** Purpose: This function used for get cart Data
** Date : 29 JULY 2021
************************************************************************/
public function getloadbalence($action='',$tbl_name='',$where_condition='',$short_field='',$page='',$per_page='')
{  
	//echo $action.'__'. $tbl_name.'__'. $where_condition; die();
	//print_r($where_condition); die();
	$filterArray 				=	array();

	/*if($where_condition['search']):
		array_push($filterArray,array($where_condition['search'][0]=>new MongoDB\BSON\Regex ($where_condition['search'][1],'i')));
	endif;*/
	if($where_condition['where']):
		foreach($where_condition['where'] as $where_key=>$where_value):
			array_push($filterArray,array($where_key=>$where_value));
		endforeach;
	endif;

	$selectFields 					=  	array('$project' => array(
											'_id'=>0,
											'load_balance_id'=>1,
											'user_id_cred'=>1,
											'user_id_deb'=>1,
											'arabian_points'=>1,
											'record_type'=>1,
											'arabian_points_from'=>1,
											'created_at'=>1,
											'created_by'=>1,

											'users_name'=>'$from_users.users_name',
											'users_email'=>'$from_users.users_email',
											'users_mobile'=>'$from_users.users_mobile',

											));								  

	$whereCondition					=	array();

	if($filterArray):
		foreach($filterArray as $filterInfo):
			array_push($whereCondition,$filterInfo);
		endforeach;
	endif;
	
	$currentQuery					=	array(array('$lookup'=>array(
											'from'=>'da_users',
											'localField'=>'user_id',
											'foreignField'=>'users_id',
											'as'=>'from_users'
											)),
											
											$selectFields,
											array('$match'=>array('$and'=>$whereCondition)),
											array('$sort'=>$short_field));
	//echo '<pre>';print_r($currentQuery);die;											  

	
	if($action == 'count'):

		$totalDataCount				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
		//echo "<pre>"; print_r($totalDataCount); die();
		if($totalDataCount):
			return count($totalDataCount);
		endif;
	elseif($action == 'single'):
		$currentData				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
		return $currentData[0];
	elseif($action == 'multiple'):	
		if($per_page):
			array_push($currentQuery,array('$skip'=>(int)$page));
			array_push($currentQuery,array('$limit'=>(int)$per_page));
		endif; 
		$currentData				=	$this->getDataByMultipleAndCondition($tbl_name,$currentQuery);
		return $currentData;
	endif;
}	// END OF FUNCTION

}