<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 class MainModelUser extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('custom_helper');
		
	}
	public function get_total_no_of_data($tblName)
	{
	    $data=$this->db->count_all_results($tblName);
	    return $data;	
	}
	/* get  all data*/
	public function get_all_data($tblName)
	{
	    $data=$this->db->get($tblName)->result();
	    return $data;	
	}
	/*get  all active data*/
	public function get_all_active_data($tblName)
	{
	     
	    $data=$this->db->get_where($tblName,array('Status'=>0))->result();
	    return $data;	
	}
	public function get_all_active_data_join($mainTableName)
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
	    
    	$query = $this->db->get()->result();
	    return $query;	
	}
	
	public function get_all_data_join($mainTableName)
	{   
	     $data['fields']=remove_first_field($this->get_table_heading($mainTableName));
	     $data['tblname']=check_join_table($data['fields']);
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
	}
	public function get_all_data_join_order_by($mainTableName,$orderColName)
	{   
	     $data['fields']=remove_first_field($this->get_table_heading($mainTableName));
	     $data['tblname']=check_join_table($data['fields']);
	     $select=$mainTableName.'.*';
	    // $this->db->select($mainTableName.'.*');
	     $this->db->select('*');
	    $this->db->from($mainTableName);
	    foreach($data['tblname'] as $tblName=>$tblColumn)
	    {
	       
	       // $mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn;
	         $this->db->join($tblName,$mainTableName.'.'.$tblColumn.' = '.$tblName.'.'.$tblColumn);
	    }
	    $this->db->order_by($mainTableName.$orderColName,'asc');
	    
    	$query = $this->db->get()->result();
	    return $query;	
	}
	/*get name active data*/
	public function get_name_active_data($tblName)
	{   
	    $selectDataTblName=str_replace("tbl",'',$tblName);
	    $selectData=$selectDataTblName."Name";
	    $this->db->select($selectData); 
	    $data=$this->db->get_where($tblName,array($selectDataTblName.'Status'=>0))->result();
	 //   check_p($data);
	    return $data;	
	}
	public function get_table_heading($tblName)
	{
	    $data=$this->db->list_fields($tblName);
	 //   $data=" ";
	    
	    return $data;	
	}
}
?>