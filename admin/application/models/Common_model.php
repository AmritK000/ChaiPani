<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct(); 
	}

	function milliseconds() {
	    $mt = explode(' ', microtime());
	    return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
	}

	function microseconds() {
	    $mt = explode(' ', microtime());
	    return ((int)$mt[1]) * 1000000 + ((int)round($mt[0] * 1000000));
	}

	/***********************************************************************
	** Function Name returnIntegerEncryptValue
	** Developed By : Manoj Kumar
	** Input Parameters 
	** 1. inputInteger = The integer value which need to encrypted
	** 2. returnLength = THe number of digit which need to be return from functon.
	** Function Process :- The function will take integr input and multiply it with current unixtimestamp.
	** The new value will be encrypt using md5 which return 32 bit string, The encrypt string convert to ASCII
	** value and then the desire lenght sub string will be return by function.
	** Date : 14 JUNE 2021
	************************************************************************/
	public function returnIntegerEncryptValue($inputInteger, $returnLength = 16)
	{
		$returnEncryptInterValue = '';
		$lenghtCounter = 0;
		$currentTimeStamp = $this->microseconds();//$this->milliseconds();//time();
		$vauleToBeEncrypted = $inputInteger * $currentTimeStamp;
		$encryptedString = md5($vauleToBeEncrypted);
		$encryptedStringCharArray = str_split($encryptedString);
		foreach($encryptedStringCharArray as $charValue):
			$asciiValue = ord($charValue);
			$asciiValueLength = strlen($asciiValue);
			$lenghtCounter = $lenghtCounter + $asciiValueLength;
			if($lenghtCounter < $returnLength):	
				$returnEncryptInterValue = $returnEncryptInterValue.$asciiValue;
				$returnEncryptInterValue.' rln '.strlen($returnEncryptInterValue);
			else:
				break;
			endif;
		endforeach;
		$remaingNumberOfDigits = $returnLength - strlen($returnEncryptInterValue);
		if($remaingNumberOfDigits > 0):
			for($remaingDigitsCounter = 0; $remaingDigitsCounter < $remaingNumberOfDigits; $remaingDigitsCounter++):
				$returnEncryptInterValue = $returnEncryptInterValue .rand ( 0 , 9);
			endfor;
		endif;
		return $returnEncryptInterValue;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name : getNextSequence
	** Developed By : Manoj Kumar
	** Purpose  : This function used for get Next Sequence
	** Date : 14 JUNE 2021
	************************************************************************/
	public function getNextSequence($tableName='')
	{
		$this->mongo_db->select(array('seq'));
		$this->mongo_db->where(array('_id'=>$tableName));	
		$result = $this->mongo_db->find_one('hcap_counters');
		if($result):  
			$newId				=	$result['seq']+1; 
			$encryptValue 		=	$newId;//$this->returnIntegerEncryptValue($newId,16);
			$this->mongo_db->where(array('_id'=>$tableName));
			$this->mongo_db->set(array('seq'=>(int)$newId,'encrypted'=>(int)$encryptValue));
			$this->mongo_db->update('hcap_counters');
		else:
			$newId				=	100000000000001;
			$encryptValue 		=	$newId;//$this->returnIntegerEncryptValue($newId,16);
			$this->mongo_db->insert('hcap_counters',array('_id'=>$tableName,'seq'=>(int)$newId,'encrypted'=>(int)$encryptValue));
		endif;
		return $encryptValue;//$newId;
	}	// END OF FUNCTION


	/***********************************************************************
	** Function name : getNextIdSequence
	** Developed By : Manoj Kumar
	** Purpose  : This function used for get Next Id Sequence
	** Date : 29 JULY 2021
	************************************************************************/
	public function getNextIdSequence($sequenceType='',$type='')
	{
		$this->mongo_db->select(array('seq'));
		$this->mongo_db->where(array('_id'=>$sequenceType));	
		$result = $this->mongo_db->find_one('hcap_id_sequence');
		if($result):  
			$newId				=	$result['seq']+1; 
			$this->mongo_db->where(array('_id'=>$sequenceType));
			$this->mongo_db->set(array('seq'=>(int)$newId,'encrypted'=>(int)$newId));
			$this->mongo_db->update('hcap_id_sequence');
		else:
			$newId				=	1;
			$this->mongo_db->insert('hcap_id_sequence',array('_id'=>$sequenceType,'seq'=>(int)$newId,'encrypted'=>(int)$newId));
		endif;  
		
		if($type=='Sales Person'):  
		$constant 		=	array('users_seq_id'=>'SR');
		endif;

		if($type=='Retailer'):  
		$constant 		=	array('users_seq_id'=>'RT');
		endif;

		if($type=='Users'):  
		$constant 		=	array('users_seq_id'=>'CS');
		endif;

		
		$cueNewId 	 	= 	$newId<10?'0000'.$newId:($newId<100?'000'.$newId:($newId<1000?'00'.$newId:($newId<10000?'0'.$newId:$newId)));
		return $constant[$sequenceType].$cueNewId;
	}	// END OF FUNCTION


	/***********************************************************************
	** Function name : getNextInspectorIdSequence
	** Developed By : Manoj Kumar
	** Purpose  : This function used for get Inspector Next Id Sequence
	** Date : 03 AUGUST 2021
	************************************************************************/
	public function getNextInspectorIdSequence()
	{
		$sequenceType		=	'inspector_sequence_id';
		$this->mongo_db->select(array('seq'));
		$this->mongo_db->where(array('_id'=>$sequenceType));	
		$result = $this->mongo_db->find_one('hcap_id_sequence');
		if($result):  
			$newId				=	$result['seq']+1; 
			$this->mongo_db->where(array('_id'=>$sequenceType));
			$this->mongo_db->set(array('seq'=>(int)$newId,'encrypted'=>(int)$newId));
			$this->mongo_db->update('hcap_id_sequence');
		else:
			$newId				=	1;
			$this->mongo_db->insert('hcap_id_sequence',array('_id'=>$sequenceType,'seq'=>(int)$newId,'encrypted'=>(int)$newId));
		endif;  
		$constant 		=	array('inspector_sequence_id'=>'CMPI');
		$cueNewId 	 	= 	$newId<10?'000'.$newId:($newId<100?'00'.$newId:($newId<1000?'0'.$newId:$newId));
		return $constant[$sequenceType].$cueNewId;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name : addData
	** Developed By : Manoj Kumar
	** Purpose  : This function used for add data
	** Date : 14 JUNE 2021
	************************************************************************/
	public function addData($tableName='',$param=array())
	{
		$last_insert_id 		=	$this->mongo_db->insert($tableName,$param);
		return $last_insert_id;
	}	// END OF FUNCTION
	
	/* * *********************************************************************
	 * * Function name : editData
	 * * Developed By : Manoj Kumar
	 * * Purpose  : This function used for edit data
	 * * Date : 14 JUNE 2021
	 * * **********************************************************************/
	function editData($tableName='',$param='',$fieldName='',$fieldValue='')
	{ 
		$this->mongo_db->where(array($fieldName=>$fieldValue));
		$this->mongo_db->set($param);
		$this->mongo_db->update($tableName);
		return true;
	}	// END OF FUNCTION
	
	/***********************************************************************
	** Function name : editDataByMultipleCondition
	** Developed By : Manoj Kumar
	** Purpose  : This function used for edit data by multiple condition
	** Date : 14 JUNE 2021
	************************************************************************/
	function editDataByMultipleCondition($tableName='',$param=array(),$whereCondition=array())
	{
		$this->mongo_db->where($whereCondition);
		$this->mongo_db->set($param);
		$this->mongo_db->update($tableName);
		return true;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name : editMultipleDataByMultipleCondition
	** Developed By : Manoj Kumar
	** Purpose  : This function used for edit data by multiple condition
	** Date : 14 JUNE 2021
	************************************************************************/
	function editMultipleDataByMultipleCondition($tableName='',$param=array(),$whereCondition=array())
	{
		$this->mongo_db->where($whereCondition);
		$this->mongo_db->set($param);
		$this->mongo_db->update_all($tableName);
		return true;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name : editMultipleDataByMultipleCondition
	** Developed By : Manoj Kumar
	** Purpose  : This function used for edit data by multiple condition
	** Date : 14 JUNE 2021
	************************************************************************/
	function editMultipleDataBySingleCondition($tableName='',$param='',$fieldName='',$fieldValue='')
	{ 
		$this->mongo_db->where(array($fieldName=>$fieldValue));
		$this->mongo_db->set($param);
		$this->mongo_db->update_all($tableName);
		return true;
	}	// END OF FUNCTION
	
	/***********************************************************************
	** Function name : deleteData
	** Developed By : Manoj Kumar
	** Purpose  : This function used for delete data
	** Date : 14 JUNE 2021
	************************************************************************/
	function deleteData($tableName='',$fieldName='',$fieldValue='')
	{
		$this->mongo_db->where(array($fieldName=>$fieldValue));
		$this->mongo_db->delete_all($tableName);
		return true;
	}	// END OF FUNCTION
	
	/***********************************************************************
	** Function name : deleteParticularData
	** Developed By : Manoj Kumar
	** Purpose  : This function used for delete particular data
	** Date : 14 JUNE 2021
	************************************************************************/
	function deleteParticularData($tableName='',$fieldName='',$fieldValue='')
	{ 
		$this->mongo_db->where(array($fieldName=>$fieldValue));
		$this->mongo_db->delete_all($tableName);
		return true;
	}	// END OF FUNCTION
	
	/***********************************************************************
	** Function name : deleteByMultipleCondition
	** Developed By : Manoj Kumar
	** Purpose  : This function used for delete by multiple condition
	** Date : 14 JUNE 2021
	************************************************************************/
	function deleteByMultipleCondition($tableName='',$whereCondition=array())
	{
		$this->mongo_db->where($whereCondition);
		$this->mongo_db->delete_all($tableName);
		return true;
	}	// END OF FUNCTION
	
	/***********************************************************************
	** Function name: getDataByParticularField
	** Developed By: Manoj Kumar
	** Purpose: This function used for get data by encryptId
	** Date : 14 JUNE 2021
	************************************************************************/
	public function getDataByParticularField($tableName='',$fieldName='',$fieldValue='')
	{  
	    
		$this->mongo_db->select('*');
		$this->mongo_db->where(array($fieldName=>$fieldValue));
		$result = $this->mongo_db->find_one($tableName);
		
		if($result):
		  // print_r($result);die;
			return $result;
		else:
			return false;
		endif;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name: getSingleDataByParticularField
	** Developed By: Manoj Kumar
	** Purpose: This function used for get Single Data By Particular Field
	** Date : 14 JUNE 2021
	************************************************************************/
	public function getSingleDataByParticularField($fields=array(),$tableName='',$fieldName='',$fieldValue='')
	{  
		if(empty($fields)): $fields 	=	'*'; endif; 
		$this->mongo_db->select($fields);
		if($fieldName && $fieldValue):
			$this->mongo_db->where(array($fieldName=>$fieldValue));
		endif;
		$result = $this->mongo_db->find_one($tableName);
		if($result):
			return json_decode(json_encode($result),true);
		else:
			return false;
		endif;
	}	// END OF FUNCTION
	
	/***********************************************************************
	** Function name: getDataByQuery
	** Developed By: Manoj Kumar
	** Purpose: This function used for get data by query
	** Date : 14 JUNE 2021
	************************************************************************/
	public function getData($action='',$tbl_name='',$wcon='',$shortField='',$num_page='',$cnt='')
	{  
		
		$this->mongo_db->select('*');		
		if(isset($wcon['where']) && $wcon['where'])	$this->mongo_db->where($wcon['where']);	
		if(isset($wcon['where_or']) && $wcon['where_or'])	$this->mongo_db->where_or($wcon['where_or']);	
		if(isset($wcon['where_ne']) && $wcon['where_ne'])	$this->mongo_db->where_ne($wcon['where_ne'][0],$wcon['where_ne'][1]);	
		if(isset($wcon['where_in']) && $wcon['where_in'])	$this->mongo_db->where_in($wcon['where_in'][0],$wcon['where_in'][1]);	
		if(isset($wcon['where_between']) && $wcon['where_between'])	$this->mongo_db->where_between($wcon['where_between'][0],$wcon['where_between'][1],$wcon['where_between'][2]);	
		if(isset($wcon['like']) && $wcon['like'])	$this->mongo_db->like($wcon['like'][0],$wcon['like'][1],'i',TRUE,TRUE);
		if($shortField)				$this->mongo_db->order_by($shortField);				
		if($num_page):				$this->mongo_db->limit($num_page);
									$this->mongo_db->offset($cnt);						
		endif;
		if($action == 'count'):	
			return $this->mongo_db->count($tbl_name);
		elseif($action == 'single'):	
			$result = $this->mongo_db->find_one($tbl_name);
			if($result):
				return $result;
			else:
				return false;
			endif;
		elseif($action == 'multiple'):	
			$result = $this->mongo_db->get($tbl_name);
			if($result):	
				return $result;
			else:		
				return false;
			endif;
		else:
			return false;
		endif;
	}	// END OF FUNCTION
	
	/***********************************************************************
	** Function name: getFieldInArray
	** Developed By: Manoj Kumar
	** Purpose: This function used for get data by condition
	** Date : 14 JUNE 2021
	************************************************************************/
	public function getFieldInArray($field='',$tbl_name='',$wcon='')
	{  
		$returnarray			=	array();
		$this->mongo_db->select(array($field));	
		if(isset($wcon['where']))	$this->mongo_db->where($wcon['where']);	
		if(isset($wcon['where_ne']) && $wcon['where_ne'])	$this->mongo_db->where_ne($wcon['where_ne'][0],$wcon['where_ne'][1]);	
		if(isset($wcon['where_in']) && $wcon['where_in'])	$this->mongo_db->where_in($wcon['where_in'][0],$wcon['where_in'][1]);	
		if(isset($wcon['where_or']) && $wcon['where_or'])	$this->mongo_db->where_or($wcon['where_or']);	
		if(isset($wcon['where_between']) && $wcon['where_between'])	$this->mongo_db->where_between($wcon['where_between'][0],$wcon['where_between'][1],$wcon['where_between'][2]);	
		if(isset($wcon['like']))	$this->mongo_db->like($wcon['like'][0],$wcon['like'][1],'i',TRUE,TRUE);
		$result = $this->mongo_db->get($tbl_name);
		if($result):	
			foreach($result as $info):
				array_push($returnarray,$info[$field]);
			endforeach;
		endif;
		return $returnarray;
	}	// END OF FUNCTION
	
	/***********************************************************************
	** Function name: getLastOrderByFields
	** Developed By: Manoj Kumar
	** Purpose: This function used for get Last Order By Fields
	** Date : 14 JUNE 2021
	************************************************************************/ 
	public function getLastOrderByFields($field='',$tbl_name='',$fieldName='',$fieldValue='')
	{  
		$this->mongo_db->select(array($field));	
		if(isset($fieldName) && isset($fieldValue)):
			$this->mongo_db->where(array($fieldName=>$fieldValue));
		endif;
		$this->mongo_db->order_by(array($field=>'DESC'));	
		$this->mongo_db->limit(1);
		$result = $this->mongo_db->find_one($tbl_name);  
		if($result):	
			return $result[$field];
		else:
			return 0;
		endif;
	}	// END OF FUNCTION

	/* * *********************************************************************
	 * * Function name : setAttributeInUse
	 * * Developed By : Manoj Kumar
	 * * Purpose  : This function used for set Attribute In Use
	 * * Date : 14 JUNE 2021
	 * * **********************************************************************/
	function setAttributeInUse($tableName='',$param='',$fieldName='',$fieldValue='')
	{ 
		$paramarray[$param]	=	'Y';
		$this->mongo_db->where(array($fieldName=>$fieldValue));
		$this->mongo_db->set($paramarray);
		$this->mongo_db->update($tableName);
		return true;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name: getPaticularFieldByFields
	** Developed By: Manoj Kumar
	** Purpose: This function used for get Paticular Field By Fields
	** Date : 14 JUNE 2021
	************************************************************************/ 
	public function getPaticularFieldByFields($field='',$tbl_name='',$fieldName='',$fieldValue='')
	{  
		$this->mongo_db->select(array($field));	
		$this->mongo_db->where(array($fieldName=>$fieldValue));
		$this->mongo_db->limit(1);
		$result = $this->mongo_db->find_one($tbl_name);  
		if($result):	
			return $result[$field];
		else:
			return 0;
		endif;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name: getParticularFieldByMultipleCondition
	** Developed By: Manoj Kumar
	** Purpose: This function used for get Particular Field By Multiple Condition
	** Date : 14 JUNE 2021
	************************************************************************/
	public function getParticularFieldByMultipleCondition($fields=array(),$tableName='',$wcon='')
	{  
		if(empty($fields)): $fields 	=	'*'; endif; 
		$this->mongo_db->select($fields);
		if(isset($wcon['where']))	$this->mongo_db->where($wcon['where']);	
		if(isset($wcon['where_ne']) && $wcon['where_ne'])	$this->mongo_db->where_ne($wcon['where_ne'][0],$wcon['where_ne'][1]);	
		if(isset($wcon['where_in']) && $wcon['where_in'])	$this->mongo_db->where_in($wcon['where_in'][0],$wcon['where_in'][1]);	
		if(isset($wcon['where_or']) && $wcon['where_or'])	$this->mongo_db->where_or($wcon['where_or']);	
		if(isset($wcon['where_between']) && $wcon['where_between'])	$this->mongo_db->where_between($wcon['where_between'][0],$wcon['where_between'][1],$wcon['where_between'][2]);	
		if(isset($wcon['like']))	$this->mongo_db->like($wcon['like'][0],$wcon['like'][1],'i',TRUE,TRUE);
		$result = $this->mongo_db->find_one($tableName);
		if($result):
			return json_decode(json_encode($result),true);
		else:
			return false;
		endif;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name: getDataByNewQuery
	** Developed By: Manoj Kumar
	** Purpose: This function used for get data by query
	** Date : 14 JUNE 2021
	************************************************************************/
	public function getDataByNewQuery($fields=array(),$action='',$tbl_name='',$wcon='',$shortField='',$num_page='',$cnt='')
	{  
		if(empty($fields)): $fields 	=	'*'; endif; 
		$this->mongo_db->select($fields);	
		if(isset($wcon['where']) && $wcon['where'])	$this->mongo_db->where($wcon['where']);	
		if(isset($wcon['where_ne']) && $wcon['where_ne'])	$this->mongo_db->where_ne($wcon['where_ne'][0],$wcon['where_ne'][1]);	
		if(isset($wcon['where_or']) && $wcon['where_or'])	$this->mongo_db->where_or($wcon['where_or']);	
		if(isset($wcon['where_between']) && $wcon['where_between'])	$this->mongo_db->where_between($wcon['where_between'][0],$wcon['where_between'][1],$wcon['where_between'][2]);	
		if(isset($wcon['like']) && $wcon['like']):	
			$this->mongo_db->like($wcon['like'][0],$wcon['like'][1],'i',TRUE,TRUE);
		endif;
		if(isset($wcon['where_in']) && $wcon['where_in']):	
			foreach($wcon['where_in'] as $whereInData):
				$this->mongo_db->where_in($whereInData[0],$whereInData[1]);
			endforeach;
		endif;
		if(isset($wcon['where_gte']) && $wcon['where_gte']):	
			foreach($wcon['where_gte'] as $whereGteData):
				$this->mongo_db->where_gte($whereGteData[0],$whereGteData[1]);
			endforeach;
		endif;
		if($shortField)				$this->mongo_db->order_by($shortField);				
		if($num_page):				
			$this->mongo_db->limit($num_page);
			$this->mongo_db->offset($cnt);						
		endif;
		if($action == 'count'):	
			return $this->mongo_db->count($tbl_name);
		elseif($action == 'single'):	
			$result = $this->mongo_db->find_one($tbl_name);
			if($result):
				return json_decode(json_encode($result),true);
			else:
				return false;
			endif;
		elseif($action == 'multiple'):	
			$result = $this->mongo_db->get($tbl_name);
			if($result):	
				return json_decode(json_encode($result),true);
			else:		
				return false;
			endif;
		else:
			return false;
		endif;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name: getDataByMultipleAndCondition
	** Developed By: Manoj Kumar
	** Purpose: This function used for get data by query
	** Date : 14 JUNE 2021
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
	** Function name: getDataByGroupBy
	** Developed By: Manoj Kumar
	** Purpose: This function used for get Data By Group By
	** Date : 14 JUNE 2021
	************************************************************************/
	public function getDataByGroupBy($tbl_name='',$wcon1='',$wcon2='',$wcon3='',$wcon4='')
	{  
		$resultData = array();
		$Query 		=		array($wcon1,$wcon2,$wcon3,$wcon4);
		$result 	= 		$this->mongo_db->aggregate($tbl_name,$Query,array('batchSize'=>4));
		foreach($result as $result){
			$returnData = $result['result'];
			array_push($resultData,$returnData);
		}			
		$groupedData 	= json_decode(json_encode($resultData[0]), true);
		return $groupedData;
	}	// END OF FUNCTION
	/***********************************************************************
	** Function name: getMultipleDataByParticularField
	** Developed By: Ashish
	** Purpose: This function used for getMultipleDataByParticularField
	** Date : 14 JUNE 2021
	************************************************************************/
	public function getMultipleDataByParticularField($tableName='',$fieldName='',$fieldValue='')
	{  
		$this->mongo_db->select('*');
		if($fieldName && $fieldValue):
			$this->mongo_db->where(array($fieldName=>$fieldValue));
		endif;
		$result = $this->mongo_db->get($tableName);
		if($result):
			return $result;
		else:
			return false;
		endif;
		
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name : fetch_common_data_type
	** Developed By : Ashish UMrao
	** Purpose  : This function used for fetch common data type
	** Date : 14 JUNE 2021
	************************************************************************/
	function fetch_common_data_type($tableName='',$fieldName='',$fieldValue='')
	{
		$this->mongo_db->select('id,astrologer_id');
		$this->mongo_db->where(array($fieldName=>$fieldValue));
		$result = $this->mongo_db->get($tableName);
		if($result):
			return $result;
		else:
			return false;
		endif;
	}
	/***********************************************************************
	** Function name : delete_image_by_image_name
	** Developed By : Ashish UMrao
	** Purpose  : This function used for delete image by image name
	** Date : 14 JUNE 2021
	************************************************************************/
	function delete_image_by_image_name($tableName='',$fieldName='',$fieldValue='')
	{	//echo $tableName.'---'.$fieldName.'---'.$fieldValue; die;
		$this->mongo_db->where(array($fieldName => $fieldValue));
		$this->mongo_db->delete($tableName);
		return true;
	}

	/***********************************************************************
	** Function name: getTitleSlug
	** Developed By: Manoj Kumar
	** Purpose: This function used for get Title Slug
	** Date : 14 JUNE 2021
	************************************************************************/ 
	public function getTitleSlug($title='',$tbl_name='')
	{  
		$this->mongo_db->select('count');	
		$this->mongo_db->where(array('title'=>$title));
		$this->mongo_db->where(array('table_name'=>$tbl_name));
		$this->mongo_db->limit(1);
		$result = $this->mongo_db->find_one('hcap_title_count');
		$data 	= $result['count']?$result['count']:0;
		if($data == 0):	
			$param['title']					=	$title;
			$param['table_name']			=	$tbl_name;
			$param['count']					=	(int)$data+1;
			$alastInsertId					=	$this->addData('hcap_title_count',$param);
			$titleSlug 						=	url_title(strtolower($title));
		else:
			$count							=	(int)$data+1;
			$this->mongo_db->where(array('title'=>$title));
			$this->mongo_db->where(array('table_name'=>$tbl_name));
			$this->mongo_db->set(array('count'=>(int)$count));
			$this->mongo_db->update('hcap_title_count');
			$titleSlug 						=	url_title(strtolower($title.'-'.$count));
		endif;
		return $titleSlug;//$newId;
	}	// END OF FUNCTION

	/***********************************************************************
	** Function name 	: checkDuplicate
	** Developed By 	: AFSAR ALI
	** Purpose 			: This function used for check duplicate entry
	** Date 			: 05 APRIL 2022
	************************************************************************/ 
	public function checkDuplicate($tbl_name, $whereCon){
		$this->mongo_db->where($whereCon);
		return $this->mongo_db->count($tbl_name, $whereCon);
	} // END OF FUNCTION


}	