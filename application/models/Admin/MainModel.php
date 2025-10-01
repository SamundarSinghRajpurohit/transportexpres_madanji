<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class MainModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	    	$this->load->helper('custom_helper');
	    
	}
	public function do_login($ad,$tblName)
	{
		$this->db->where($ad);
		$data=$this->db->get($tblName);
		return $data->result();
	}
	public function total_data($tblName,$select='',$where='',$fromDate='',$toDate='')
	{
	    
	     $this->db->select_sum($select);
        $this->db->from($tblName);
	    if($where)
	        $this->db->where($where);
	    if($fromDate&&$toDate)
	    {    
	        $tableDateName=ucfirst(remove("tbl",$tblName)."Date");
	        $this->db->where($tableDateName.">=",$fromDate);
	        $this->db->where($tableDateName."<=",$toDate);
	    }
	    $query = $this->db->get()->result();
	    return $query;
	}
	public function customQuery($query)
	{
		$data=$this->db->simpleQuery($query);
		return $data->result();
	}
	
	
	public function get_selectCol($tblName,$selectedCol)
	{
	    $this->db->select($selectedCol);
	    $this->db->from($tblName);
	    $query = $this->db->get()->result();
	    return $query;
	}

	public function get_a_selectCol($tblName,$selectedCol,$where)
	{
	    $this->db->select($selectedCol);
	    $this->db->from($tblName);
		$this->db->where($where);
	    $query = $this->db->get()->result();
	    return $query;
	}
	public function check_table_present($tblName)
	{
	    if ($this->db->table_exists($tblName) )
        {
           return true;
        }
        else
        {
            return false;
            
        }
	}
	//samu
	
	public function custom_query($qry)
	{
	    $sql=$qry;
	    $query = $this->db->query($sql);
	    return $query->result_array();
	}

	// sjr add for update 28-12-2023
	public function custom_query_no_return($qry)
	{
	    $sql=$qry;
	    $query = $this->db->query($sql);
	    return $query;
	}
	//end
	
	//samundar add for select * from tabl name 16-04-2021
	public function get_all_data_for_table($mainTableName)
	{   
	    $this->db->select('*');
	    $this->db->from($mainTableName);
	    $query = $this->db->get()->result();
	    
	    return $query;	
	}
	//samundar end
	
	public function get_all_table_heading()
	{
	    $data=$this->db->list_tables();
		return $data;
	}
    
	public function update_status($tblName,$data)
	{
	    $colName=ucfirst(str_replace('tbl','',$tblName).STATUS_NAME);
	  //  check_p($colName);
	    //$this->db->set('Status','1-Status',FALSE);
	    $this->db->set($colName,'1-'.$colName,FALSE);
	    $this->db->where($data);
	    $this->db->select($data);
	    
	    $query=$this->db->update($tblName);
	   
	    return $query;
	}
	//samundar add $orderBy for asc and desc data 22-04-2021
	public function get_all_data_join_order_by($mainTableName,$orderColName,$orderBy)
	{   
	     $data['fields']=remove_first_field($this->get_table_heading($mainTableName));
	     $data['tblname']=check_join_table($data['fields'],$mainTableName);
	     $select=$mainTableName.'.*';
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select('*');
	    $this->db->from($mainTableName);
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       
	       // $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	         $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	    }
	    $this->db->order_by($mainTableName.'.'.$orderColName,$orderBy);
	   	$query = $this->db->get()->result();
	    return $query;	
	}
    //samundar end
    
    public function get_a_data_join_order_by($mainTableName,$whereData,$orderColName="",$orderBy="",$fromDate='',$toDate='')
	{   
	    $data['fields']=$this->get_table_heading($mainTableName);
	     //passing main table name beacuse we need id 
	     //$tblName=array();
	     $data['tblname']=check_join_table($data['fields'],$mainTableName);
	     //print_r($data['tblname']);
	      //  check_recursive_join_table($mainTableName);
	        
	     //$data['innerTblName']=        
	     //check_p($data);
	     $select=$mainTableName.'.*';
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select('*');
	    $this->db->from($mainTableName);
	    $this->db->where($whereData);
	   // check_p($data['tblname']);
	    
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       //echo  $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	         $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	    }
	    if($fromDate&&$toDate)
	    {   $tableDateName=ucfirst(remove("tbl",$mainTableName)."Date");
	        $this->db->where($tableDateName.">=",$fromDate);
	        $this->db->where($tableDateName."<=",$toDate);
	    }
	    $this->db->order_by($orderColName,$orderBy);
    	$query = $this->db->get()->result();
    //	print_r($query);
	    $queryExecuted=$this->db->last_query();
	    //print_r($queryExecuted);
	    //check_p($queryExecuted);
	    return $query;	
	}
    
    //samundra add model for get all data join with status 17-05-2021
    public function get_all_data_join_order_by_active_status($mainTableName,$orderColName,$orderBy)
	{   
	     $data['fields']=remove_first_field($this->get_table_heading($mainTableName));
	     $data['tblname']=check_join_table($data['fields'],$mainTableName);
	     $select=$mainTableName.'.*';
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select('*');
	     $key=str_replace("tbl","",$mainTableName);
	     $key=ucfirst($key).'Status';
	     $val=0;
	     $where=$mainTableName.".$key".'='.$val;
	     $this->db->where($where);
	     //$this->db->where($where1);
	    $this->db->from($mainTableName);
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       
	       // $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	         $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	    }
	    $this->db->order_by($mainTableName.'.'.$orderColName,$orderBy);
	   	$query = $this->db->get()->result();
	    return $query;	
	}
	
	public function get_all_data_join_order_by_active_status1($mainTableName,$orderColName,$where1,$orderBy)
	{   
	     $data['fields']=remove_first_field($this->get_table_heading($mainTableName));
	     $data['tblname']=check_join_table($data['fields'],$mainTableName);
	     $select=$mainTableName.'.*';
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select('*');
	     $key=str_replace("tbl","",$mainTableName);
	     $key=ucfirst($key).'Status';
	     $val=0;
	     $where=$mainTableName.".$key".'='.$val;
	     $this->db->where($where);
	     $this->db->where($where1);
	    $this->db->from($mainTableName);
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       
	       // $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	         $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	    }
		$this->db->limit(10);
	    $this->db->order_by($mainTableName.'.'.$orderColName,$orderBy);
	   	$query = $this->db->get()->result();
	    return $query;	
	}
    //samundra end
	public function get_total_no_of_data($tblName)
	{
	    if(is_array($tblName))
	    {
	        $data='';
	      foreach($tblName as $tblNameData)
	      {
	        $data[$tblNameData]=$this->db->count_all_results($tblNameData);   
	      }
	       return $data;
	    }
	   else
	   {   
	   //    $data=$this->db->count_all_results($tblName);
	       return $data;	
	
	   }
	}
	public function get_all_data($tblName)
	{
	    $data=$this->db->get($tblName)->result();
	    return $data;	
	}
	public function insert_data($tblName,$data)
	{   $data=$this->db->insert($tblName,$data);
    	$insert_id = $this->db->insert_id();  //  last  insert  id
	  //  $this->logsEntry($tblName,$insert_id,"Insert");
	    return $insert_id;
	}
	public function insert_data_api($tblName,$data)
	{   $data=$this->db->insert($tblName,$data);
    	return isset($data)?"1":"0";
    }
    public function insert_data_api_return_data($tblName,$data)
	{   $data=$this->db->insert($tblName,$data);
	    $insert_id = $this->db->insert_id();  //  last  insert  id
	    $q = $this->db->get_where($tblName, array('CustomerId' => $insert_id));
        return $q->row();
    //	return isset($data)?"1":"0";
    }
    public function insert_data_api_return_data_for_medical($tblName,$data)
	{   $data=$this->db->insert($tblName,$data);
	    $insert_id = $this->db->insert_id();  //  last  insert  id
	    $q = $this->db->get_where($tblName, array('MedicalstoreId' => $insert_id));
        return $q->row();
    //	return isset($data)?"1":"0";
    }
    
	public function delete_data_api($tblName,$data)
	{   $data=$this->db->delete($tblName,$data);
    	return isset($data)?"1":"0";
    }
	public function logsEntry($tblName,$insert_id,$transType)
	{
	    //log data
	        $logData['LogsTableName']=$tblName;
	        $logData['LogsTransactionid']=$insert_id;
	        $logData["LogsCDT"]=date('Y-m-d H:i:s');
	        $logData["LogsIP"]= $this->input->ip_address();
			if($this->session->AdminId)
			{
	        	$logData["AdminId"]=$this->session->AdminId;
	        	$logData["LogsType"]="Admin";

			}
			else{
				$logData["EmployeeId"]=$this->session->EmployeeId;
				$logData["LogsType"]="Employee";
				$logData["CompanyId"]=$this->session->CompanyId;
			}
			$logData['LogsTransactionType']=$transType;
            $this->db->insert("tbllogs",$logData);
	        return;   
	}
	public function insert_multiple_data($tblName,$multiData)
	{   
	    $data=$this->db->insert_batch($tblName,$multiData);
	    //  $queryExecuted=$this->db->last_query();
	    // print_r($queryExecuted);
		// die();
	    return $data;
	}
	public function update_multiple_data($tblName,$multiData,$whereData)
	{   
	   // print_r($multiData);
	    $data=$this->db->update_batch($tblName,$multiData,$whereData);
	    //  $queryExecuted=$this->db->last_query();
	    // print_r($queryExecuted);
		// die();
	    return $data;
	}
	public function update_data($tblName,$data,$whereCol,$whereData)
	{   
	    //check_p($whereData);
	    $this->db->where($whereCol,$whereData);
	    $data=$this->db->update($tblName,$data);
	    $this->logsEntry($tblName,$whereData,"Update");
	    return $data;
	}public function update_data_api($tblName,$data,$where)
	{   
	    //check_p($where);
	    $this->db->where($where);
	    $data=$this->db->update($tblName,$data);
	    $queryExecuted=$this->db->last_query();
	    //echo $queryExecuted;
	    //$this->logsEntry($tblName,$whereData,"Update");
	    return $data;
	}
	
    public function get_direct_data($tblName)// done directly  not by ajax
	{   
	    $colName=str_replace('tbl','',$tblName);
	    $this->db->where($colName.'Status=0');
	    $this->db->from($tblName);
	     $data= $this->db->get()->result();
	    return $data;
	}
	public function get_direct_data_final($tblName)// final
	{   
	    echo $tblName;
	    $this->db->from($tblName);
	     $data= $this->db->get()->result();
	    return $data;
	}
	public function get_active_data_name($tblName,$fieldName)
	{
	    $this->db->select($fieldName);
	   // $this->db->where('Status=0');
	    $this->db->from($tblName);
	     $data=array( $this->db->get()->result());
	       // check_p($data);
	     //$data=remove_multi_array($data);
	    return $data;
	}
	public function get_table_heading($tblName)
	{
	    $data=$this->db->list_fields($tblName);
	    return $data;	
	}
	public function get_id($tblName,$selectedCol,$whereCol,$whereData)
	{
	    $this->db->select($selectedCol);
	    $this->db->from($tblName);
	    $this->db->where($whereCol,$whereData);
	    $query = $this->db->get()->result();
	    return $query;
	}
	public function insert_get_id($tblName,$data)
	{
	    $data=$this->db->insert($tblName,$data);
    	$whereData = $this->db->insert_id(); 
	    
	   /* $this->db->select($selectedCol);
	    $this->db->from($tblName);
	    $this->db->where($whereCol,$whereData);
	    $query = $this->db->get()->result();
	    */
	    return $whereData;
	}
	public function get_a_data($tblName,$where,$fromDate='',$toDate='')
	{
	    $this->db->from($tblName);
	    $this->db->where($where);
	    if($fromDate&&$toDate)
	    {    
	        $tableDateName=ucfirst(remove("tbl",$tblName)."Date");
	        $this->db->where($tableDateName.">=",$fromDate);
	        $this->db->where($tableDateName."<=",$toDate);
	    }
	    $query = $this->db->get()->result();
	    return $query;
	}
	public function count_data($tblName,$where='',$fromDate='',$toDate='')
	{
	    $this->db->from($tblName);
	    if($where)
	        $this->db->where($where);
	    if($fromDate&&$toDate)
	    {    
	        $tableDateName=ucfirst(remove("tbl",$tblName)."Date");
	        $this->db->where($tableDateName.">=",$fromDate);
	        $this->db->where($tableDateName."<=",$toDate);
	    }
	    $query = $this->db->count_all_results();
	    return $query;
	}
	public function delete_a_data($tblName,$where)
	{
	    $this->db->from($tblName);
	    $this->db->where($where);
	    $query = $this->db->delete();
	    $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	    $this->logsEntry($tblName,$where[$tableIdName],"Delete");
	    return $query;
	}
	
	public function get_inner_join_data($mainTableName,$i)
	{
	    
	    $str="asd";
	    $newTableName=array();
	    $data['fields']=$this->get_table_heading($mainTableName);
	    $mainTableName_exact=str_replace('tbl','',$mainTableName);
       // echo empty($data['fields'])?"true":"false";
       // check_p($data['fields']);
        
        if(!empty($data))
        {   
            foreach($data['fields'] as $fieldsKey)
    	    {   
    	        
    	        if(strpos($fieldsKey,'Id')&&!(stripos($fieldsKey,'email')!==false)&&!(strcasecmp($fieldsKey,$mainTableName_exact."Id")==0))
                {
                    $tblName="tbl".strtolower(str_ireplace("id","",$fieldsKey));
                    //$tblName["tbl".strtolower(str_ireplace("id","",$fieldsKey))]=$fieldsKey;
                    
                    $str=$str.$tblName;   
                    $newTableName[$i++]="tbl".strtolower(str_ireplace("id","",$fieldsKey));
                     return $str=$this->get_inner_join_data($tblName,$i);
                    
                }
                else
                {   
                    return $str;
                }
               
    	    }
        }   
        
	}
	public function get_main_data_join($mainTableName,$whereData)
	{   
	    $data['fields']=$this->get_table_heading($mainTableName);
	     //passing main table name beacuse we need id 
	     $data['tblname']=check_join_table($data['fields'],$mainTableName);
	   //     check_recursive_join_table($mainTableName);
	        
	     //$data['innerTblName']=                      
	   //  check_p($data);
	     $select=$mainTableName.'.*';
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select($select);
	    $this->db->from($mainTableName);
	    $this->db->where($whereData);
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       // $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	         $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	    }
    	$query = $this->db->get()->result();
	    return $query;	
	}
	public function sidhu()
	{
	    $this->db->select('*');
	    $this->db->from('tblsales');
	    $this->db->join('tblcustomer','tblcustomer.CustomerId=tblsales.CustomerId');
	        $this->db->join('tblplaceofsupply','tblplaceofsupply.PlaceofsupplyId=tblcustomer.PlaceofsupplyId');
	    $this->db->join('tblfirm','tblfirm.FirmId=tblsales.FirmId');
	    $this->db->join('tblsalesdetail','tblcustomer.CustomerId=tblsales.CustomerId');
	            
	     $this->db->get()->result();
	    $queryExecuted=$this->db->last_query();
	    check_p($queryExecuted);
	}
	public function get_a_data_join($mainTableName,$whereData,$fromDate='',$toDate='')
	{   
	    $data['fields']=$this->get_table_heading($mainTableName);
	     //passing main table name beacuse we need id 
	     //$tblName=array();
	     $data['tblname']=check_join_table($data['fields'],$mainTableName);
	     //print_r($data['tblname']);
	      //  check_recursive_join_table($mainTableName);
	        
	     //$data['innerTblName']=        
	     //check_p($data);
	     $select=$mainTableName.'.*';
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select('*');
	    $this->db->from($mainTableName);
	    $this->db->where($whereData);
	   // check_p($data['tblname']);
	    
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       //echo  $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	         $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	    }
	    if($fromDate&&$toDate)
	    {   $tableDateName=ucfirst(remove("tbl",$mainTableName)."Date");
	        $this->db->where($tableDateName.">=",$fromDate);
	        $this->db->where($tableDateName."<=",$toDate);
	    }
    	$query = $this->db->get()->result();
    //	print_r($query);
	    $queryExecuted=$this->db->last_query();
	    //print_r($queryExecuted);
	    //check_p($queryExecuted);
	    return $query;	
	}
	public function get_a_data_inner_join($mainTableName,$whereData,$fromDate='',$toDate='')
	{   
    	    $data['fields']=$this->get_table_heading($mainTableName);
	     //passing main table name beacuse we need id 
	     //$tblName=array();
	     $data['tblname']=check_inner_join_table($data['fields'],$mainTableName);
	   //  print_r($data['tblname']);
	   //     check_recursive_join_table($mainTableName);
	        
	     //$data['innerTblName']=                      
	     //check_p($data);
	     $select=$mainTableName.'.*';
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select('*');
	    $this->db->from($mainTableName);
	    $this->db->where($whereData);
	    //check_p($data['tblname']);
	    
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       //echo  $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	         
	         if(!strpos($mainTableName,"tblpreinvoicedetail2")&&strpos($tblName,'tblhsn'))
	         {
	            $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	         }
	        /* else if(!strpos($mainTableName,"tblproductdetail"))
	         {
	            $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	         }*/
	         else if(!strpos($mainTableName,"tblpurchasedetail"))
	         {
	            $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	         //   $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.'tblcompany'.'.'.$tblColumn);
	        //  $this->db->join('tblcompany','tblcompany'.'.'.'CompanyId'.' = '.$tblName.'.'.$tblColumn);
	             
	         }
	         
	         else
	         {  $this->db->join('tbllabour','tbllabour'.'.'.'HsnId'.' = '.$tblName.'.'.$tblColumn);
	             
	         }
	         
	    }
	    if($fromDate&&$toDate)
	    {   $tableDateName=ucfirst(remove("tbl",$mainTableName)."Date");
	        $this->db->where($tableDateName.">=",$fromDate);
	        $this->db->where($tableDateName."<=",$toDate);
	    }
    	$query = $this->db->get()->result();
	    $queryExecuted=$this->db->last_query();
	    //check_p($queryExecuted);
	    return $query;	
	}
	public function get_a_data_join_a_column($mainTableName,$whereData,$column)
	{   
	    $data['fields']=$this->get_table_heading($mainTableName);
	     //passing main table name beacuse we need id 
	     $data['tblname']=check_join_table($data['fields'],$mainTableName);
	   //     check_recursive_join_table($mainTableName);
	        
	     //$data['innerTblName']=                      
	   //  check_p($data);
	     $select=$mainTableName.'.'.$column;
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select($select);
	    $this->db->from($mainTableName);
	    $this->db->where($whereData);
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       // $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	         $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	    }
    	$query = $this->db->get()->result();
	     //$queryExecuted=$this->db->last_query();
	   // print_r($queryExecuted);
	    return $query;	
	}
	public function get_a_data_join_a_column_direct($mainTableName,$whereData,$column)
	{   
	    $data['fields']=$this->get_table_heading($mainTableName);
	     //passing main table name beacuse we need id 
	     $data['tblname']=check_join_table($data['fields'],$mainTableName);
	   //     check_recursive_join_table($mainTableName);
	        
	     //$data['innerTblName']=                      
	   //  check_p($data);
	     $select=$mainTableName.'.'.$column;
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select($select);
	    $this->db->from($mainTableName);
	    $this->db->where($whereData);
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       // $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	         $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	    }
    	$query= $this->db->get()->result();
    	check_p($query);
	    return $query;	
	}
	
	public function get_all_data_join($mainTableName)
	{
	     $data['fields']=$this->get_table_heading($mainTableName);
	    
	     if(check_exact_field($mainTableName,'detail'))
 	     {
 	      $key=remove('detail',$mainTableName);
 	      $InnerTableName=$key=remove('detail',$mainTableName);
 	      $columnName=ucfirst(remove("tbl",$key))."Id".DETAIL_COLUMN;
 	      
 	      //echo ($columnName);
 	      $data['DetailFields']=$this->mm->get_table_heading($key);
 	      $data['DetailFields']=remove_last_field($data['DetailFields'],2);
 	      $columnIndex=array_search($columnName,$data['fields']);
 	      $data['fields'][$columnIndex]=ucfirst(remove("tbl",$key))."Id";
 	       $data['innserTblname']=check_join_table($data['DetailFields'],$InnerTableName);
 	     }
    
	      $data['tblname']=check_join_table($data['fields'],$mainTableName);

	     $select=$mainTableName.'.*';
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select('*');
	   // $fromTable=array($mainTableName,'tblta');
	    $this->db->from($mainTableName);
	    //echo "<pre>";
	    //print_r($data);
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       //echo $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	       $key=ucFirst(remove("detail",remove("tbl",$mainTableName)))."Id";
	       //echo( "Key = ".$key);
	        
	       if(check_exact_field($tblColumn,$key))
	       {    $this->db->join($tblName,$mainTableName.'.'.$tblColumn.DETAIL_COLUMN.' = '.$tblName.'.'.$tblColumn);
	       }
	      else
	       {    $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	       }
	    }
	     if(check_exact_field($mainTableName,'detail'))
 	     {
 	    
	         foreach($data['innserTblname'] as $tblName=>$tblColumn)
	        {
    	       //echo $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
    	       $key=ucFirst(remove("detail",remove("tbl",$InnerTableName)))."Id";
    	       //echo( "Key = ".$key);
    	      
    	       if(check_exact_field($tblColumn,$key))
    	       {    $this->db->join($tblName,$InnerTableName.'.'.$tblColumn.DETAIL_COLUMN.' = '.$tblName.'.'.$tblColumn);
    	       }
    	      else
    	       {    $this->db->join($tblName,$InnerTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
    	       }
	        }  
 	     }
		$this->db->where(ucFirst(remove("tbl",$mainTableName)).'Status', 0);
    	$query = $this->db->get()->result();
	  //  print_r($query);
	    return $query;	
	}
	public function insert_a_data($tblName,$data)
	{
	   $this->db->insert($tblName,$data);
	    return ;
	}
	
	public function get_name_data_join($mainTableName)//get join value name 
	{   
	    //before
	     //$data['fields']=remove_first_field($this->get_table_heading($mainTableName));
	     //after
	     $data['fields']=$this->get_table_heading($mainTableName);
	     //passing main table name beacuse we need id 
	      $data['tblname']=check_join_table($data['fields'],$mainTableName);
	     $select=$mainTableName.'.*';
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select('*');
	    $this->db->from($mainTableName);
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       
	       // $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	         $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	    }
    	$query = $this->db->get()->result();
	    return $query;	
	}public function search($tblName,$likeData,$fieldName='')
	{   $this->db->select($fieldName);
        $this->db->from($tblName);
        $this->db->like($likeData);
        return $this->db->get()->result_array();
        	
	    //return isset($data)?"1":"0";
    	
	}
	public function search_join($tblName,$likeData,$fieldName='')
	{    $data['fields']=$this->get_table_heading($tblName);
	     $data['tblname']=check_join_table($data['fields'],$tblName);
	     $select=$tblName.'.*';
	     $this->db->select('*');
	     $this->db->from($tblName);
	     //$this->db->where($whereData);
	     foreach($data['tblname'] as $tblName=>$tblColumn)
	     {	         
	         $this->db->join($tblName,$tblName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	     }
	    $this->db->like($likeData);
	    //print_r($this->db->get());
        return $this->db->get()->result_array();
        //return isset($data)?"1":"0";
    }
	public function get_last_query_executed()
	{   
	    //   return  $this->db->last_row('tblhsn');
	}
	public function get_last_id($mainTableName,$selectColumn,$where='')
	{
	    $this->db->select_max($selectColumn);
	    $this->db->from($mainTableName);
	    $this->db->where($where);
	    
	    $query = $this->db->get()->result_array();
	    // $queryExecuted=$this->db->last_query();
	    //check_p($queryExecuted);
	    if(empty($query[0][$selectColumn]))
	    {
	        $query[0][$selectColumn]=0;
	    }
	    return $query[0][$selectColumn];
	}
	public function get_column_tableName($colName)
	{
	$query="SELECT COLUMN_NAME AS 'ColumnName',TABLE_NAME AS  'TableName' FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME LIKE '%".$colName."%' ORDER BY TableName,ColumnName";
	return $this->db->query($query)->result_array();
	    
	}	

	/**
	*@wallets method to get list for datatable.
	*
	**/
	public function getList($table, $select = null, $type)
    {
        $columns = ['tblorder.OrderId','tblorder.OrderLRNO','tblorder.OrderCustomLRNO','tblorder.OrderDate','tbldealer.DealerName','tblconsignee.ConsigneeName','tblorder.OrderTotalWeight','tblorder.OrderTotalBoxes','tblorder.OrderTotal'];
        $this->db->select($select,FALSE);
        $keyword = $this->input->post('search');
        if (!empty($keyword['value'])) {
            $this->db->having('
            tblorder.OrderId LIKE "%'.$this->db->escape_str($keyword['value']).'%" 
			OR tblorder.OrderLRNO LIKE "%'.$this->db->escape_str($keyword['value']).'%" 
			OR tblorder.OrderCustomLRNO LIKE "%'.$this->db->escape_str($keyword['value']).'%" 
			OR tblorder.OrderDate LIKE "%'.$this->db->escape_str($keyword['value']).'%" 
            OR tbldealer.DealerName LIKE "%'.$this->db->escape_str($keyword['value']).'%"
            OR tblconsignee.ConsigneeName LIKE "%'.$this->db->escape_str($keyword['value']).'%"
            OR tblorder.OrderTotalWeight LIKE "%'.$this->db->escape_str($keyword['value']).'%"
			OR tblorder.OrderTotalBoxes LIKE "%'.$this->db->escape_str($keyword['value']).'%"
            OR tblorder.OrderTotal LIKE "%'.$this->db->escape_str($keyword['value']).'%"');
        }

        if($this->input->post('order')[0]['column'] !='' || $this->input->post('order')[0]['dir'] != ''){
            $this->db->order_by($columns[$this->input->post('order')[0]['column']],$this->input->post('order')[0]['dir']);
        }
        else
            $this->db->order_by('OrderId','DESC');

        $this->db->join('tbldealer', 'tbldealer.DealerId = tblorder.DealerId', 'left');
		$this->db->join('tblconsignee', 'tblconsignee.ConsigneeId = tblorder.ConsigneeId', 'left');
        $this->db->where('OrderStatus', 0);

		if($type == 'count'){
            $query = $this->db->get($table);
            return $query->num_rows();
        }else {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            $start = $this->input->post('start') + 1;
            $query = $this->db->get($table);
            $result = $query->result_array();

            return $result;
        }
    }

	public function getPalletList($table, $select = null, $type)
    {
        $columns = ['tblorderpallet.OrderpalletId','tblorderpallet.OrderpalletLRNOauto','tblorderpallet.OrderpalletLRNO','tblorderpallet.OrderpalletDate','tbldealer.DealerName','tblorderpallet.OrderpalletTotalQty','tbltempo.TempoName'];
        $this->db->select($select,FALSE);
        $keyword = $this->input->post('search');
        if (!empty($keyword['value'])) {
            $this->db->having('
            tblorderpallet.OrderpalletId LIKE "%'.$this->db->escape_str($keyword['value']).'%" 
			OR tblorderpallet.OrderpalletLRNOauto LIKE "%'.$this->db->escape_str($keyword['value']).'%" 
			OR tblorderpallet.OrderpalletLRNO LIKE "%'.$this->db->escape_str($keyword['value']).'%" 
			OR tblorderpallet.OrderpalletDate LIKE "%'.$this->db->escape_str($keyword['value']).'%" 
            OR tbldealer.DealerName LIKE "%'.$this->db->escape_str($keyword['value']).'%"
            OR tblorderpallet.OrderpalletTotalQty LIKE "%'.$this->db->escape_str($keyword['value']).'%"            
            OR tbltempo.TempoName LIKE "%'.$this->db->escape_str($keyword['value']).'%"');
        }

        if($this->input->post('order')[0]['column'] !='' || $this->input->post('order')[0]['dir'] != ''){
            $this->db->order_by($columns[$this->input->post('order')[0]['column']],$this->input->post('order')[0]['dir']);
        }
        else
            $this->db->order_by('OrderpalletId','DESC');

        $this->db->join('tbldealer', 'tbldealer.DealerId = tblorderpallet.DealerId', 'left');
		// $this->db->join('tblconsignee', 'tblconsignee.ConsigneeId = tblorderpallet.ConsigneeId', 'left');
		$this->db->join('tbltempo', 'tbltempo.TempoId = tblorderpallet.TempoId', 'left');
        $this->db->where('OrderpalletStatus', 0);

		if($type == 'count'){
            $query = $this->db->get($table);
            return $query->num_rows();
        }else {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            $start = $this->input->post('start') + 1;
            $query = $this->db->get($table);
            $result = $query->result_array();

            return $result;
        }
    }
}
?>