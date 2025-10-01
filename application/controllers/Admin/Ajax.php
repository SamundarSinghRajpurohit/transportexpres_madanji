<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		ini_set('memory_limit', '-1');
		$set['upload_path']='./resources/images/';
		$set['allowed_types']='png|jpg|gif|jpeg|csv';
		$this->load->library('upload',$set);
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('url');
	//	$this->load->model('Admin/dashboard_m','dm');
		$this->load->helper('custom_helper');
		$this->load->library('form_validation');
		$this->load->library('csvimport');
		$this->load->library('session');
       		$this->load->model('Admin/MainModel','mm');
	    	$this->load->library('excel');
	}
	public function getFilter() //inserting a data in table
	{      
	      try
	      {  
        		$data['Data']='';
        		$arrayValues["values"]=array("0-300","301-500","501-1000","1001-1500");
        		$arrayValuesFinal=array_merge($arrayValues,array("Type"=>"Checkbox"),array("Title"=>"Price"));
        		
        		$arrayAtttributes["values"]=array("Cotton","Chanderi");
        		$arrayAtttributesFinal=array_merge($arrayAtttributes,array("Type"=>"Checkbox"),array("Title"=>"Atttributes"));
        		
        	/*	$arrayColors["values"]=array("Red","Green");
        		$arrayColorsFinal=array_merge($arrayColors,array("Type"=>"Checkbox"),array("Title"=>"Colors"));
        		*/
        		$tblName="tblproductdetail";
        		$selectedCol="ProductdetailBrandname";
        		$productColorData=array();

        	/*	$productColorDataArray=$this->mm->get_selectCol($tblName,$selectedCol);
        		$arrayColors["values"]=array();
                foreach($productColorDataArray as $key)
                {
                    foreach($key as $value)
                    {
                        //print_r($value);
                        if(!in_array($value,$productColorData)&&$value!="")
                        {
                           // $array['connect'] = array_merge($array['connect'], $new_array);
                            array_push($productColorData,$value);
                            //$productColorData=array($productColorDataArray[$key]);
                        }
                    }        
                }
        		$arrayAtttributes["values"]=json_encode($productColorData);
        		$arrayColorsFinal=array_merge($productColorData,array("Type"=>"Checkbox"),array("Title"=>"Brand Name"));*/
        		$arrayColorsFinal=array();
        		//,array($arrayColorsFinal)
        		$arrayFinal=array_merge(array($arrayValuesFinal),array($arrayAtttributesFinal));
        		
        		$data['Data']=$arrayFinal;
        		$result = json_decode(json_encode($data['Data']), true);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Filter Found";    
        		    $data['Data']=(array)$result;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Filter not Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar add for employee login14-04-2021
	public function Employeelogin()
	{
		
		$data=array();
    	$getData=array(
    			'EmployeeEmailId'=>$this->input->post('EmployeeEmailId'),
    			'EmployeePassword'=>$this->input->post('EmployeePassword'),
    			'CompanyCode'=>$this->input->post('CompanyCode'),
    			'Year'=>$this->input->post('Year'),
		);
			
		if($getData['CompanyCode']!='')
		{
    		$tblName="tblcompany";
    	    $whereData=array("tblcompany.CompanyCode"=>$this->input->post('CompanyCode'));
    	    $data1=$this->mm->get_a_data_join($tblName,$whereData);
    	   
    	    if(count($data1)===1)
    	    {
    	        $companyId=$data1[0]->CompanyId;
    	       // echo $companyId;
    	        $ad=array(
					'EmployeeEmailId'=>$this->input->post('EmployeeEmailId'),
					'EmployeePassword'=>$this->input->post('EmployeePassword'),
					'CompanyId'=>$companyId,
				);
				$data=$this->mm->do_login($ad,'tblemployee');
				if(count($data)===1)
				{
					$this->session->set_userdata('EmployeeId',$data[0]->EmployeeId);
					$this->session->set_userdata('EmployeeEmailId',$data[0]->EmployeeEmailId);
					$this->session->set_userdata('EmployeeName',$data[0]->EmployeeName);
				$this->session->set_userdata('CompanyId',$companyId);
					$this->session->set_userdata('LoginYear',$this->input->post('Year'));
					//new update 4/17/2019 rajesh sir need level table
					/*$this->session->set_userdata('AdminLevelId',$data[0]->LevelId);
					$where['LevelId']=$data[0]->LevelId;
					$levelData=$this->mm->get_a_data('tbllevel',$where);
					//check_p($levelData[0]->LevelName);
					$this->session->set_userdata('AdminLevelName',$levelData[0]->LevelName);*/
					//$this->load->view('Admin/Dashboard');
					//redirect('Admin/Dashboard');
					$errorData["Message"]="";
					echo  json_encode($errorData);
				}
				else
				{
					$errorData["Message"]="Email And Password Is incorrect";
    		        echo  json_encode($errorData);
				}
    	    }
    	    else
    	    {
    	        //redirect('Admin/login');
    	        $errorData["Message"]="CompanyCode not Found <br> Please enter Name";
    		    echo  json_encode($errorData);
    	    }
		}
		else
		{   
		    $errorData["Message"]="CompanyCode Cannot be Empty";
		    echo  json_encode($errorData);
		}
			
	}
	
	public function login()
	{
		
		$data=array();
    	$getData=array(
    			'AdminEmail'=>$this->input->post('AdminEmailId'),
    			'AdminPassword'=>$this->input->post('AdminPassword'),
		);
			
		if($getData['AdminEmail']!='')
		{
    		
    	        $ad=array(
					'AdminEmailId'=>$this->input->post('AdminEmailId'),
					'AdminPassword'=>$this->input->post('AdminPassword'),
				);
				$data=$this->mm->do_login($ad,'tbladmin');
				if(count($data)===1)
				{
					$this->session->set_userdata('AdminId',$data[0]->AdminId);
					$this->session->set_userdata('AdminEmailId',$data[0]->AdminEmailId);
					$this->session->set_userdata('AdminName',$data[0]->AdminName);
					$errorData["Message"]="";
					echo  json_encode($errorData);
				}
				else
				{
					$errorData["Message"]="Email And Password Is incorrect";
    		        echo  json_encode($errorData);
				}
    	}
		else
		{   
		    $errorData["Message"]="EmailId Cannot be Empty";
		    echo  json_encode($errorData);
		}
		
	}
	//samundar end
	//search Get product 
	public function setFilter()
	{
	         try
	         {  
	            
	             $tblname="tblproduct";
                $whereData=array("ProductFeaturedYesNoRadio"=>0);
	            $suggestedData['SuggestedProduct']=$this->mm->get_a_data_join($tblname,$whereData);
	            
	            $arr=(array)($suggestedData['SuggestedProduct']);
	            $dataFilter=array();
        		$limit=10;
        		for($i=0;$i<count($arr)&&$i<$limit;$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        $productId=$value;
            		        $tblnameInner="tblproductdetail";
                            $whereDataInner=array("tblproductdetail.ProductIdReference"=>$value);
            	            $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $arr2=(array)($productDataDetail);
            	            $dataFilter[$i][$key]=$value;
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            for($j=0;$j<count($arr2);$j++)
                    		{
                        		foreach($arr2[$j] as $key2=>$value2)
                        		{    
                        		    if((strcmp($key2,"ProductdetailImages"))==0)
                        		    {       
                        		            $imageData=explode(",",$value2);
            		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
            		                }
            		                else
            		                        $dataFilter2[$j][$key2]=$value2;
                        		}
                    		}$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    		
            	            
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		}
        		}
    	        //$data['Data']=$dataFilter;
    	        $suggestedProductPackInfo["product"]=$dataFilter;
	            $suggestedDataFinal=array(json_decode(json_encode(($suggestedProductPackInfo)),true));
	           
        		$data['Data']=$dataFilter;
        		$arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Data found";    
        		    $data['Data']=$arr;    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Detail  Found";    
        		    $data['Data']=[];
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	//samundar 27-01-2021

	public function searchold()
	{
	         try
	         {  
        		$tblname="tblpurchasedetail";
                $whereData=array('tblproduct.ProductName'=>$this->input->post("ProductName"));
	            $getColumn="*";
        		$allData=$this->mm->search_join($tblname,$whereData,$getColumn);
	            $suggestedData['SuggestedProduct']=$allData;
	            $arr=(array)($suggestedData['SuggestedProduct']);
	            //$arr=(array)($productData);
	            $dataFilter=array();
        		$dataFilter2=array();
        		//$arr=(array)($productData);
	            $dataFilter=array();
        		/*for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        $productId=$value;
            		        /*$tblnameInner="tblproductdetail";
                            $whereDataInner=array("tblproductdetail.ProductIdReference"=>$value);
            	            $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $dataFilter[$i][$key]=$value;
            	            $arr2=(array)($productDataDetail);
            	            //$dataFilter[$i][$key]=$value;
            	            
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            for($j=0;$j<count($arr2);$j++)
                    		{
                        		foreach($arr2[$j] as $key2=>$value2)
                        		{    
                        		    if((strcmp($key2,"ProductdetailImages"))==0)
                        		    {       
                        		            $imageData=explode(",",$value2);
            		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
            		                }
            		                else
            		                        $dataFilter2[$j][$key2]=$value2;
                        		}
                    		}
                    		
                    		$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    		
            		    }
            		    else if((strcmp($key,"ProductImages"))==0)
            		    {   $imageData=explode(",",$value);
            		        $dataFilter[$i][$key]=$imageData;
            		    }
            		    else if((strcmp($key,"ProductName"))==0)
            		    {   $proName=str_replace("^","'",$value);
            		        $dataFilter[$i][$key]=$proName;
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		    
            		}
        		}*/
        		$limit=10;
        	//	print_r($arr);
        		$dataFilter=$this->fetch_packinfo($arr,$limit);
        	    
	            //$data['Data']=$dataFilter;
    	        $suggestedProductPackInfo=$dataFilter;
	            $suggestedDataFinal=(json_decode(json_encode(($suggestedProductPackInfo)),true));
	            
	        	//print_r($where);
	        	//$getColumn="*";
        		//$data['Data']=$this->mm->search($tblname,$where,$getColumn);
        		$data['Data']=$suggestedDataFinal;
        		$arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Data found";    
        		    $data['Data']=$arr;    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Detail  Found";    
        		    $data['Data']=[];
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	
	//samundar add search new api according purchasedetail 06-03-2021
	public function search()
	{
	         try
	         {  
        		//samundar 
        		$d=array();
        		$tblname="tblproduct";
                $whereData=array("tblproduct.ProductName"=>$this->input->post("ProductName"));
                $getColumn="*";
        		//$allData=$this->mm->search_join($tblname,$whereData,$getColumn);
	            $productData=$this->mm->search($tblname,$whereData);
	            /*print_r($productData);
	            die();*/
	             for($i=0;$i<count($productData);$i++)
	            {
	                $d[]=$productData[$i]['ProductId'];
	            }
	            //print_r($d);
	            $arrayFinal=array();
                $productData1=array();
	            for($i=0;$i<count($d);$i++)
	            {
    	            $tblname="tblpurchasedetail";
                    $whereData=array("tblpurchasedetail.ProductId"=>$d[$i]);
                   // print_r($whereData);
                   $tmp_data=$this->mm->get_a_data_join($tblname,$whereData);
                   if(!empty($tmp_data[0]))
                   {
    	            $productData1[]=$tmp_data[0];
                   }
                       
                }
	          //  print_r($productData1);
                $arr=$productData1;
        		//samundar end
        	/*	$tblname="tblpurchasedetail";
                $whereData=array('tblproduct.ProductName'=>$this->input->post("ProductName"));
	            $getColumn="*";
        		$allData=$this->mm->search_join($tblname,$whereData,$getColumn);
	            $suggestedData['SuggestedProduct']=$allData;
	            $arr=(array)($suggestedData['SuggestedProduct']);*/
	            //$arr=(array)($productData);
	            $dataFilter=array();
        		$dataFilter2=array();
        		//$arr=(array)($productData);
	            $dataFilter=array();
        		/*for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        $productId=$value;
            		        /*$tblnameInner="tblproductdetail";
                            $whereDataInner=array("tblproductdetail.ProductIdReference"=>$value);
            	            $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $dataFilter[$i][$key]=$value;
            	            $arr2=(array)($productDataDetail);
            	            //$dataFilter[$i][$key]=$value;
            	            
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            for($j=0;$j<count($arr2);$j++)
                    		{
                        		foreach($arr2[$j] as $key2=>$value2)
                        		{    
                        		    if((strcmp($key2,"ProductdetailImages"))==0)
                        		    {       
                        		            $imageData=explode(",",$value2);
            		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
            		                }
            		                else
            		                        $dataFilter2[$j][$key2]=$value2;
                        		}
                    		}
                    		
                    		$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    		
            		    }
            		    else if((strcmp($key,"ProductImages"))==0)
            		    {   $imageData=explode(",",$value);
            		        $dataFilter[$i][$key]=$imageData;
            		    }
            		    else if((strcmp($key,"ProductName"))==0)
            		    {   $proName=str_replace("^","'",$value);
            		        $dataFilter[$i][$key]=$proName;
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		    
            		}
        		}*/
        		$limit=10;
        	//	print_r($arr);
        		//$dataFilter=$this->fetch_packinfo($arr,$limit);
        	   $dataFilter=$arr;
        	    
	            //$data['Data']=$dataFilter;
    	        $suggestedProductPackInfo=$dataFilter;
    	        //kd old update for medi search  4/6/21
	            //$suggestedDataFinal=(json_decode(json_encode(($suggestedProductPackInfo)),true));
	            //new kd 
	            $suggestedDataFinal=(((($suggestedProductPackInfo))));
	        	//print_r($where);
	        	//$getColumn="*";
        		//$data['Data']=$this->mm->search($tblname,$where,$getColumn);
        		$data['Data']=$suggestedDataFinal;
        		$arr=$data['Data'];
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Data found";    
        		    $data['Data']=$arr;    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Detail  Found";    
        		    $data['Data']=[];
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	//samundar end
	//samundar add for call api on key press  15-04-2021
	public function searchOnKeyPress($tblname,$value='')
	{
		
		$tblname="tbl".$tblname;
		
		$comId=$this->session->CompanyId;
		$tableName1=$tblname;
		$tableName = preg_replace('/[0-9]+/', '', $tableName1);

		$key=ucfirst(str_replace("tbl","",$tableName));
		$keyname=$key."Name";
		$textBoxValue=$value;
		if($value=='')
		{
            $whereData=array($tableName.'.'.$keyname=>$value,$tableName.'.CompanyId'=>$comId);
            $getColumn="*";
    		$allData=$this->mm->search($tableName,$whereData,$getColumn);
		}
		else
		{
		    $getColumn="*";
		    $whereData=array($tableName.'.CompanyId'=>$comId);
    		$allData=$this->mm->get_a_data($tableName,$whereData);
		    
		}
		// check_p($allData);
        //$suggestedData['SuggestedProduct']=$allData;
       //$data[]="<datalist id='shop_ids'>";
       $data=array();
       for($i=0;$i<count($allData);$i++)
       {
           $data[]=($allData[$i][$key.'Id']."-".$allData[$i][$key."Name"]);
       }
        echo  json_encode($data);	
	}
	//end samundar

	//samundar add search new api for mediapp 17-03-2021
	public function searchNew()
	{
	         try
	         {  
        		$tblname="tblproduct";
                $whereData=array('ProductName'=>$this->input->post("ProductName"));
	            $getColumn="*";
        		$allData=$this->mm->search($tblname,$whereData,$getColumn);
	            $suggestedData['SuggestedProduct']=$allData;
	           
	            $arr=(array)($suggestedData['SuggestedProduct']);
	            //$arr=(array)($productData);
	            $dataFilter=array();
        		$dataFilter2=array();
        		//$arr=(array)($productData);
	            $dataFilter=array();
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    
            		    /*if((strcmp($key,"ProductId"))==0)
            		    {
            		        $productId=$value;
                    		$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    		
            		    }*/
            		    if((strcmp($key,"ProductImages"))==0)
            		    {   $imageData=explode(",",$value);
            		        $dataFilter[$i][$key]=$imageData;
            		    }
            		    else if((strcmp($key,"ProductName"))==0)
            		    {   $proName=str_replace("^","'",$value);
            		        $dataFilter[$i][$key]=$proName;
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		    
            		}
        		}
	            //$data['Data']=$dataFilter;
    	        $suggestedProductPackInfo=$dataFilter;
	            $suggestedDataFinal=(json_decode(json_encode(($suggestedProductPackInfo)),true));
	            
	        	//print_r($where);
	        	//$getColumn="*";
        		//$data['Data']=$this->mm->search($tblname,$where,$getColumn);
        		$data['Data']=$suggestedDataFinal;
        		$arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Data found";    
        		    $data['Data']=$arr;    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Detail  Found";    
        		    $data['Data']=[];
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	//samundar end
	//search Get product 
	public function search1()
	{
	         try
	         {  
        		$tblname="tblproduct";
                $whereData=array('ProductName'=>$this->input->post("ProductName"));
	            $getColumn="*";
        		$allData=$this->mm->search($tblname,$whereData,$getColumn);
	            $suggestedData['SuggestedProduct']=$allData;
	            
	            $arr=(array)($suggestedData['SuggestedProduct']);
	            $dataFilter=array();
        		$limit=10;
        		for($i=0;$i<count($arr)&&$i<$limit;$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        $productId=$value;
            		        $tblnameInner="tblproductdetail";
                            $whereDataInner=array("tblproductdetail.ProductIdReference"=>$value);
            	            //$productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $dataFilter[$i][$key]=$value;
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $arr2=(array)($productDataDetail);
            	            $dataFilter[$i][$key]=$value;
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            for($j=0;$j<count($arr2);$j++)
                    		{
                        		foreach($arr2[$j] as $key2=>$value2)
                        		{    
                        		    if((strcmp($key2,"ProductdetailImages"))==0)
                        		    {       
                        		            $imageData=explode(",",$value2);
            		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
            		                }
            		                else
            		                        $dataFilter2[$j][$key2]=$value2;
                        		}
                    		}$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    		
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		}
        		}
    	        //$data['Data']=$dataFilter;
    	        $suggestedProductPackInfo=$dataFilter;
	            $suggestedDataFinal=(json_decode(json_encode(($suggestedProductPackInfo)),true));
	            
	        	//print_r($where);
	        	//$getColumn="*";
        		//$data['Data']=$this->mm->search($tblname,$where,$getColumn);
        		$data['Data']=$suggestedDataFinal;
        		$arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Data found";    
        		    $data['Data']=$arr;    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Detail  Found";    
        		    $data['Data']=[];
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	public function print_a_bill($tblName,$id) // for printing a bill
	{
	        $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	        $data=array($tableIdName=>$id);
	        
	        $arrayData=array();
	        $tableDetailName=$tblName.'detail';
            $tablePresent=$this->mm->check_table_present($tableDetailName);
            
            if ($tablePresent)
            {
                $detailTableIdName=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
	            $detailData=array($tableDetailName.'.'.$detailTableIdName=>$id);
              //  $detailData=$this->mm->get_a_data_join($tableDetailName,$detailData);
                $detailData=convert_object_array($this->mm->get_main_data_join($tableDetailName,$detailData));
                $i=0;
                $str='';
                $strFinal='';
                //$tagName="<td>";
                
                $tblkey=ucfirst(remove("tbl",$tblName).DETAIL_TABLE);
                foreach($detailData as $data)
                {   $i++;
                    //removing first n last 2 elemnts
                    $data=array_slice($data, 1, -2, true);
                    $strStart="<tr id='tableRow$i'>";
                    $str='';
                    foreach($data as $key=>$value)
                    {
                            //echo $key."<br>";
                            $str=$str.get_input_field($key,$tblkey,'3','td',"update".$i,$value);
                            //echo $str;                            
                        
                    }
                    $strEnd="</tr>";
                
                    $strFinal=$strFinal.$strStart.$str.$strEnd;
                        //echo "<pre>";
                      //  echo "asd";
                  //  echo($strFinal);
                    
                }
               // check_p($strFinal);
                //print_r($strFinal);
                $arrayData['AppendString']=$strFinal;
                //$data[]=$strFinal;
                //check_p($strFinal);
            }
	        $jsonData=$this->mm->get_a_data_join($tblName,$data);
             echo json_encode($jsonData);
	}
	
	public function PreInvoiceDifferent($tblName,$id='',$tagName='') // for Print Pre Invoice
	{       
	        $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	        $data=array($tableIdName=>$id);
	        
	        $arrayData=array();
	        $tableDetailName=$tblName.'detail';
            $tableDetailName2=$tblName.'detail2';
            
            $detailTableIdName=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
            $detailTableIdName2=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
            //check_p($detailTableIdName2);
            $mainData=array($tblName.'.'.$tableIdName=>$id);
            
            //check_p($mainData);
            
            $detailData=array($tableDetailName.'.'.$detailTableIdName=>$id);
            $detailData2=array($tableDetailName2.'.'.$detailTableIdName2=>$id);
            //check_p($detailData2);
            
            //$detailData=convert_object_array($this->mm->get_main_data_join($tableDetailName,$detailData));
            $data['detailProduct']=convert_object_array($this->mm->get_a_data_join($tableDetailName,$detailData));
            $data['detailJobWork']=convert_object_array($this->mm->get_a_data_join($tableDetailName2,$detailData2));
            $data['hsn']=convert_object_array($this->mm->get_all_data('tblhsn'));
            $mainDataFilled=convert_object_array($this->mm->get_a_data_join($tblName,$mainData));
            
            
            $customerId=$mainDataFilled[0]['CustomerId'];
            $customerData=array('tblcustomer'.'.'.'CustomerId'=>$customerId);
            $customerDataFilled=convert_object_array($this->mm->get_a_data_join('tblcustomer',$customerData));
            $data['vehicleModelName']=$customerDataFilled[0]['VechileModelName'];
            
            $advisoryId=$mainDataFilled[0]['AdvisoryId'];
            //check_p($customerDataFilled);
            $advisoryData=array('tbladvisory'.'.'.'AdvisoryId'=>$advisoryId);
            $advisoryDataFilled=convert_object_array($this->mm->get_a_data('tbladvisory',$advisoryData));
              
            /*$VechilemodelId=$mainDataFilled[0]['VechilemodelId'];
           // check_p($advisoryId);
            $VechilemodelData=array('tblVechilemodel'.'.'.'VechilemodelId'=>$VechilemodelId);
            $VechilemodelFilled=convert_object_array($this->mm->get_a_data('tblVechilemodel',$VechilemodelData));
            *///all data in one array
            $data['mainData']=array_merge($mainDataFilled[0],$customerDataFilled[0],$advisoryDataFilled[0]);
            $data['tableHeading']=array('Srl.','Part Name/Desc','HSN/SAC','TAX','QTY','Rate','Taxable Amount','Tax Paid Amount','Labour Charges');
            $data['bankDetail']=array('AcName'=>'Devi Motors','AcNumber'=>'38914837484','IFSCCode'=>'SBIN0002636','BankName'=>'SBI');
            //check_p($data);
            $this->load->view('Admin/PreInvoiceFull',$data);
	        
	}
	//nilesh 11/2/2021 for purchase vill print 
	
	public function PurchaseInvoiceDifferent($tblName,$id='',$tagName='') // for Print Pre Invoice
	{       
	        $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	        $data=array($tableIdName=>$id);
	        
	        $arrayData=array();
	        $tableDetailName=$tblName.'detail';
            
            $detailTableIdName=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
            //check_p($detailTableIdName2);
            $mainData=array($tblName.'.'.$tableIdName=>$id);
            
           // check_p($mainData);
            
            $detailData=array($tableDetailName.'.'.$detailTableIdName=>$id);
            //check_p($detailTableIdName);
            
            //$detailData=convert_object_array($this->mm->get_main_data_join($tableDetailName,$detailData));
            $data['detailProduct']=convert_object_array($this->mm->get_a_data_join($tableDetailName,$detailData));
            $data['hsn']=convert_object_array($this->mm->get_all_data('tblhsn'));
             $data['productdetail']=convert_object_array($this->mm->get_all_data('tblproduct')); //nilesh 
            $mainDataFilled=convert_object_array($this->mm->get_a_data_join($tblName,$mainData));
           // check_p($mainDataFilled);
            
            $customerId=$mainDataFilled[0]['VendorId'];
            $customerData=array('tblvendor'.'.'.'VendorId'=>$customerId);
            $customerDataFilled=convert_object_array($this->mm->get_a_data_join('tblvendor',$customerData));
            //print_r($customerDataFilled);
              
            //all data in one array
           $data['mainData']=array_merge($mainDataFilled[0],$customerDataFilled[0]);
           //print_r($data['mainData']);
            $data['tableHeading']=array('Srl.','Product Name','Pack','Mfg','HSN Code','Batch No','ExpDt','TAX','QTY','FreeQty','Tax Amount','Discount','Mrp','Srp','Total Amount');
            $data['bankDetail']=array('AcName'=>'Krunal','AcNumber'=>'9999999','IFSCCode'=>'SBIN000000','BankName'=>'SBI');
            //check_p($data);
            $this->load->view('Admin/PreInvoiceFull',$data);
	        
	}
	//end
	public function EstimateDifferent($tblName,$id='',$tagName='') // for Print Pre Invoice
	{       
	        $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	        $data=array($tableIdName=>$id);
	        
	        $arrayData=array();
	        $tableDetailName=$tblName.'detail';
            $tableDetailName2=$tblName.'detail2';
            
            $detailTableIdName=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
            $detailTableIdName2=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
            //check_p($detailTableIdName2);
            $mainData=array($tblName.'.'.$tableIdName=>$id);
            
            //check_p($mainData);
            
            $detailData=array($tableDetailName.'.'.$detailTableIdName=>$id);
            $detailData2=array($tableDetailName2.'.'.$detailTableIdName2=>$id);
            //check_p($detailData2);
            
            //$detailData=convert_object_array($this->mm->get_main_data_join($tableDetailName,$detailData));
            $data['detailProduct']=convert_object_array($this->mm->get_a_data_join($tableDetailName,$detailData));
            $data['detailJobWork']=convert_object_array($this->mm->get_a_data_join($tableDetailName2,$detailData2));
            $data['hsn']=convert_object_array($this->mm->get_all_data('tblhsn'));
            $mainDataFilled=convert_object_array($this->mm->get_a_data_join($tblName,$mainData));
            
            
            $customerId=$mainDataFilled[0]['CustomerId'];
            $customerData=array('tblcustomer'.'.'.'CustomerId'=>$customerId);
            $customerDataFilled=convert_object_array($this->mm->get_a_data_join('tblcustomer',$customerData));
            $data['vehicleModelName']=$customerDataFilled[0]['VechileModelName'];
            
              
            /*$VechilemodelId=$mainDataFilled[0]['VechilemodelId'];
           // check_p($advisoryId);
            $VechilemodelData=array('tblVechilemodel'.'.'.'VechilemodelId'=>$VechilemodelId);
            $VechilemodelFilled=convert_object_array($this->mm->get_a_data('tblVechilemodel',$VechilemodelData));
            *///all data in one array
            $data['mainData']=array_merge($mainDataFilled[0],$customerDataFilled[0]);
            $data['tableHeading']=array('Srl.','Part Name/Desc','HSN/SAC','TAX','QTY','Rate','Taxable Amount','Tax Paid Amount','Labour Charges');
            $data['bankDetail']=array('AcName'=>'Devi Motors','AcNumber'=>'38914837484','IFSCCode'=>'SBIN0002636','BankName'=>'SBI');
            //check_p($data);
            $this->load->view('Admin/Estimate',$data);
	        
	}
	public function BillDifferent($tblName,$id='',$tagName='') // for Print Pre Invoice
	{   	        
	        $mainTblName=$tblName;
	        $mainId=$id;
	        $mainTableIdName=ucfirst(remove("tbl",$mainTblName)."Id");
	        $mainDataFinal=array($mainTableIdName=>$mainId);
	        $mainDataFinal=convert_object_array($this->mm->get_a_data_join($mainTblName,$mainDataFinal));
            
            //check_p($mainDataFinal);
	        
	        
	        $tblName='tblpreinvoice'; 
	        $jobCardId=$mainDataFinal[0]['JobCardId'];
	        $tableIdName='JobCardId';
	        $data=array($tableIdName=>$jobCardId);
	        $mainData=array($tblName.'.'.$tableIdName=>$jobCardId);
	        //print_r($mainDataFinal);
	        $mainJobCardData=convert_object_array($this->mm->get_a_data_join($tblName,$mainData));
	        $data['billDetail']=$mainDataFinal[0];
	        $data['Invoice']=$mainDataFinal[0];
	        
            //check_p($mainJobCardData[0]['PreInvoiceId']);
	        $id=$mainJobCardData[0]['PreInvoiceId'];
	        
	        $arrayData=array();
	        //$id=ucfirst(remove("tbl",$tblName)."Id");
	        $tableDetailName=$tblName.'detail';
            $tableDetailName2=$tblName.'detail2';
            
            $detailTableIdName=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
            $detailTableIdName2=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
            //check_p($detailTableIdName2);
            
            //check_p($mainData);
            
            $detailData=array($tableDetailName.'.'.$detailTableIdName=>$id);
            $detailData2=array($tableDetailName2.'.'.$detailTableIdName2=>$id);
            //check_p($detailData);
            
            //$detailData=convert_object_array($this->mm->get_main_data_join($tableDetailName,$detailData));
            $data['detailProduct']=convert_object_array($this->mm->get_a_data_join($tableDetailName,$detailData));
            $data['detailJobWork']=convert_object_array($this->mm->get_a_data_join($tableDetailName2,$detailData2));
            $data['hsn']=convert_object_array($this->mm->get_all_data('tblhsn'));
            $mainDataFilled=convert_object_array($this->mm->get_a_data_join($tblName,$mainData));
            //check_p($mainDataFilled);
            if(!empty($mainDataFilled))
            {
            $customerId=$mainDataFilled[0]['CustomerId'];
            $customerData=array('tblcustomer'.'.'.'CustomerId'=>$customerId);
            $customerDataFilled=convert_object_array($this->mm->get_a_data_join('tblcustomer',$customerData));
            $data['vehicleModelName']=$customerDataFilled[0]['VechileModelName'];
            
            $advisoryId=$mainDataFilled[0]['AdvisoryId'];
            //check_p($customerDataFilled);
            $advisoryData=array('tbladvisory'.'.'.'AdvisoryId'=>$advisoryId);
            $advisoryDataFilled=convert_object_array($this->mm->get_a_data('tbladvisory',$advisoryData));
              
            /*$VechilemodelId=$mainDataFilled[0]['VechilemodelId'];
           // check_p($advisoryId);
            $VechilemodelData=array('tblVechilemodel'.'.'.'VechilemodelId'=>$VechilemodelId);
            $VechilemodelFilled=convert_object_array($this->mm->get_a_data('tblVechilemodel',$VechilemodelData));
            *///all data in one array
            $data['mainData']=array_merge($mainDataFilled[0],$customerDataFilled[0],$advisoryDataFilled[0]);
            $data['tableHeading']=array('Srl.','Part Name/Desc','HSN/SAC','TAX','QTY','Rate','Taxable Amount','Tax Paid Amount','Labour Charges');
            $data['bankDetail']=array('AcName'=>'Devi Motors','AcNumber'=>'38914837484','IFSCCode'=>'SBIN0002636','BankName'=>'SBI');
            //check_p($data);
                $this->load->view('Admin/InvoiceFull',$data);
                
            }
            else
            {    $data['error']="No preinvoice found of this jobcard";
                $this->load->view('Admin/InvoiceError',$data);
            }
	        
	}
	public function InvoiceDifferent($tblName,$id='',$tagName='') // for Print Pre Invoice
	{       
	        $mainTblName=$tblName;
	        $mainId=$id;
	        $mainTableIdName=ucfirst(remove("tbl",$mainTblName)."Id");
	        $mainDataFinal=array($mainTableIdName=>$mainId);
	        $mainDataFinal=convert_object_array($this->mm->get_a_data_join($mainTblName,$mainDataFinal));
            
          
	        $tblName='tblpreinvoice'; 
	        $id=$mainDataFinal[0]['PreInvoiceId'];
	        $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	        $data=array($tableIdName=>$id);
	        
	        $arrayData=array();
	        $tableDetailName=$tblName.'detail';
            $tableDetailName2=$tblName.'detail2';
            
            $detailTableIdName=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
            $detailTableIdName2=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
            //check_p($detailTableIdName2);
            $mainData=array($tblName.'.'.$tableIdName=>$id);
            //check_p($mainData);
            
            $detailData=array($tableDetailName.'.'.$detailTableIdName=>$id);
            $detailData2=array($tableDetailName2.'.'.$detailTableIdName2=>$id);
            //check_p($detailData2);
            
            //$detailData=convert_object_array($this->mm->get_main_data_join($tableDetailName,$detailData));
            $data['detailProduct']=convert_object_array($this->mm->get_a_data_join($tableDetailName,$detailData));
            $data['detailJobWork']=convert_object_array($this->mm->get_a_data_join($tableDetailName2,$detailData2));
            $data['hsn']=convert_object_array($this->mm->get_all_data('tblhsn'));
            $mainDataFilled=convert_object_array($this->mm->get_a_data_join($tblName,$mainData));
            
            
            $customerId=$mainDataFilled[0]['CustomerId'];
            $customerData=array('tblcustomer'.'.'.'CustomerId'=>$customerId);
            $customerDataFilled=convert_object_array($this->mm->get_a_data_join('tblcustomer',$customerData));
            
             $customerDataFilled=convert_object_array($this->mm->get_a_data_join('tblcustomer',$customerData));
            $data['vehicleModelName']=$customerDataFilled[0]['VechileModelName'];
            $advisoryId=$mainDataFilled[0]['AdvisoryId'];
           // check_p($advisoryId);
            $advisoryData=array('tbladvisory'.'.'.'AdvisoryId'=>$advisoryId);
            $advisoryDataFilled=convert_object_array($this->mm->get_a_data('tbladvisory',$advisoryData));
            
            //all data in one array
            $data['mainData']=array_merge($mainDataFilled[0],$customerDataFilled[0],$advisoryDataFilled[0]);
            $data['tableHeading']=array('Srl.','Part Name/Desc','HSN/SAC','TAX','QTY','Rate','Taxable Amount','Tax Paid Amount','Labour Charges');
            $data['bankDetail']=array('AcName'=>'Devi Motors','AcNumber'=>'38914837484','IFSCCode'=>'SBIN0002636','BankName'=>'SBI');
            //check_p($data);
            $this->load->view('Admin/InvoiceFull',$data);
	        
	}
	public function SalarySlipDifferent($tblName,$id='',$tagName='') // for Print Pre Invoice
	{       
	        $mainTblName=$tblName;
	        $mainId=$id;
	        $mainTableIdName=ucfirst(remove("tbl",$mainTblName)."Id");
	        $mainDataFinal=array($mainTableIdName=>$mainId);
	        $mainDataFinal=convert_object_array($this->mm->get_a_data_join($mainTblName,$mainDataFinal));
            //check_p($mainDataFinal);
          
	        
	        $data['mainData']=$mainDataFinal[0];
           // $data['tableHeading']=array('Srl.','Part Name/Desc','HSN/SAC','TAX','QTY','Rate','Taxable Amount','Tax Paid Amount','Labour Charges');
            $data['bankDetail']=array('AcName'=>'Devi Motors','AcNumber'=>'38914837484','IFSCCode'=>'SBIN0002636','BankName'=>'SBI');
            //check_p($data);
            $this->load->view('Admin/SalarySlip',$data);
	        
	}
	public function add_heading($tblkey,$footer='',$no='') // for Adding heading and footer
	{       
	        //check_p($tblName.DETAIL_TABLE);
	        //before devi
	        //$tblName="tbl".$tblkey.DETAIL_TABLE;
	        //after
	        if (preg_match('~[0-9]+~', $tblkey)) 
	        {    $tblName=$tblkey;
            }else
	        $tblName=$tblkey.DETAIL_TABLE;
	        //check_p($tblName);
	        $tblkey=ucfirst($tblkey.DETAIL_TABLE);
	        $detailData=$this->mm->get_table_heading($tblName);
            
            //print_r($detailData);
            $detailData=remove_last_field($detailData,2);
            $detailData=remove_first_field($detailData);
            //array_push($detailData,'Remove');
            $detailData=replace_id_name($detailData);
            
            //for detail  Id refernce patiya method
            $detailData=remove_first_field($detailData);
            //$detailData=add_remove_clear_option($detailData);
            $inputStr="";
            //check_p($tblkey);
            if($footer)
            {
                $tagStart1="<td";
                $tagStart3=">";
                $tagEnd="</td>";
                $n=0;
                foreach($detailData as $detailDataValue)
                {
                    $n++;
                    $inputStr=$inputStr.'<td id=total'.$n.'><b>'.remove($tblkey,$detailDataValue).'</b>'.$tagEnd;
                }
            }
            else
            {
                $tagStart1="<th";
                $tagStart3=">";
                $tagEnd="</th>";
                foreach($detailData as $detailDataValue)
                {
                    $inputStr=$inputStr.$tagStart1.$tagStart3.remove($tblkey,$detailDataValue).$tagEnd;
                }
                
            }
                $inputStr="<tr>".$inputStr."</tr>";
            //$str="$('#DetailView').append($inputStr)"; 
           // echo htmlspecialchars($str);
           
            echo ($inputStr); 
	}
	public function custom_add_columns($tblkey='',$uniqueKey='',$disableField='') // for Adding columns a bill
	{       
	        $inputStr='';
        	$detailData=array("OrderdetailProductName","OrderdetailBox","OrderdetailName","OrderdetailWeight","OrderdetailDcpiNo");
			$tblkey="Orderdetail";
			/*$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
			$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
			$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
			$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
			$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
			*/
			if($uniqueKey=='')
			{
				for($i=0;$i<6;$i++)
				{
					
					//custom coe
					$uniqueKey=$i+1;
					foreach($detailData as $detailDataValue)
					{
						$inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'3','td',$uniqueKey,'',$disableField);
				
					}
					$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
				}
			}
			else{
				foreach($detailData as $detailDataValue)
				{
					$inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'3','td',$uniqueKey,'',$disableField);
			
				} 
				$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
			
			}
			//$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
            //$str="$('#DetailView').append($inputStr)"; 
           // echo htmlspecialchars($str);
            echo ($inputStr);
	}
	//samundar add for update lr form data 26-04-2021
	public function custom_add_columns_update($id='',$key='') // for Adding columns a bill
	{       
	    	$disableField='';
			$inputStr='';
			if($key=="Order")
        		$detailData=array(ucfirst($key)."detailId","OrderdetailProductName","OrderdetailBox","OrderdetailName","OrderdetailWeight","OrderdetailDcpiNo");
        	elseif($key=="Orderpalletdetail2")
        	    $detailData=array(ucfirst($key)."Id","Orderpalletdetail2Name","Orderpalletdetail2Qty","Orderpalletdetail2Rate","Orderpalletdetail2Total");
			else
				$detailData=array(ucfirst($key)."detailId","OrderpalletdetailQty","OrderpalletdetailRate");
			
			$value="samuda";
			if($key == "Orderpalletdetail2")
			{
			    $tblkey=ucfirst($key)."Id";
			}
			else
			{
			    $tblkey=ucfirst($key)."detailId";
			}
			//echo  $tblkey;
			/*$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
			$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
			$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
			$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
			$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
			*/
			if($key=="Orderpalletdetail2")
			{
			    $key1='Orderpallet';
			    $where=array(ucfirst($key1)."IdReference"=>$id);
			    $tblname='tbl'.strtolower($key);
			    $orderDetail=$this->mm->get_a_data_join($tblname,$where);    
			    //print_r($orderDetail);
			}
			else{
			$where=array(ucfirst($key)."IdReference"=>$id);
			$tblname='tbl'.strtolower($key).'detail';
			$orderDetail=$this->mm->get_a_data_join($tblname,$where);
			    
			}
			//print_r($orderDetail);
			//if($uniqueKey=='')
			{
				for($i=0;$i<count($orderDetail);$i++)
				{
					
					//custom coe
					$uniqueKey=$i+1;
					foreach($detailData as $detailDataValue)
					{
						//if($detailDataValue==)
						$value=$orderDetail[$i]->$detailDataValue;
						$inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'3','td',$uniqueKey,$value,$disableField);
				
					}
					$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
				}
			}
			/*else{
				foreach($detailData as $detailDataValue)
				{
					$inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'3','td',$uniqueKey,'',$disableField);
			
				}
				$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
			
			}*/
			//$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
            //$str="$('#DetailView').append($inputStr)"; 
           // echo htmlspecialchars($str);
            echo ($inputStr);
	}
	// public function custom_add_columns_update1($id='',$key='') // for Adding columns a bill
	// {       
	//     	$disableField='';
	// 		$inputStr='';
    //     	$detailData=array(ucfirst($key)."detailId","OrderpalletdetailQty","OrderpalletdetailRate");
	// 		$value="samuda";
	// 		$tblkey=ucfirst($key)."detailId";

	// 		/*$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
	// 		$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
	// 		$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
	// 		$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
	// 		$inputStr=$inputStr."<td id='".TABLE_ROW."$uniqueKey'><input type='text' class='form-control col-md-12' name='ProductName' id='productName' value='' placeholder='Enter Product Name'></td>";
	// 		*/
	// 		$where=array(ucfirst($key)."IdReference"=>$id);
	// 		$tblname='tbl'.strtolower($key).'detail';
	// 		$orderDetail=$this->mm->get_a_data_join($tblname,$where);
	// 		//print_r($orderDetail);
	// 		//if($uniqueKey=='')
	// 		{
	// 			for($i=0;$i<count($orderDetail);$i++)
	// 			{
					
	// 				//custom coe
	// 				$uniqueKey=$i+1;
	// 				foreach($detailData as $detailDataValue)
	// 				{
	// 					//if($detailDataValue==)
	// 					$value=$orderDetail[$i]->$detailDataValue;
	// 					$inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'3','td',$uniqueKey,$value,$disableField);
				
	// 				}
	// 				$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
	// 			}
	// 		}
	// 		/*else{
	// 			foreach($detailData as $detailDataValue)
	// 			{
	// 				$inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'3','td',$uniqueKey,'',$disableField);
			
	// 			}
	// 			$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
			
	// 		}*/
	// 		//$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
    //         //$str="$('#DetailView').append($inputStr)"; 
    //        // echo htmlspecialchars($str);
    //         echo ($inputStr);
	// }
	//samundar end
	//samundar add for pallet detail form 23-04-2021
	public function custom_add_columns_for_pallet($tblkey='',$uniqueKey='',$disableField='') // for Adding columns a bill
	{       
	        $inputStr='';
        	$detailData=array("OrderpalletdetailQty","OrderpalletdetailRate","OrderpalletdetailTotal");
			$tblkey="Orderdetail";
			
			if($uniqueKey=='')
			{
				for($i=0;$i<3;$i++)
				{
					
					//custom coe
					$uniqueKey=$i+1;
					foreach($detailData as $detailDataValue)
					{
						
						$inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'3','td',$uniqueKey,'',$disableField);
				
					}
					$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
				}
			}
			else{
				foreach($detailData as $detailDataValue)
				{
					$inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'3','td',$uniqueKey,'',$disableField);
			
				}
				$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
			
			}
			//$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
            //$str="$('#DetailView').append($inputStr)"; 
           // echo htmlspecialchars($str);
            echo ($inputStr);
	}
	//samundar end
	//samundar add for pallet detail form 02-06-2021
	public function custom_add_columns_for_pallet_detail2($tblkey='',$uniqueKey='',$disableField='') // for Adding columns a bill
	{       
	        $inputStr='';
        	$detailData=array("Orderpalletdetail2Name","Orderpalletdetail2Qty","Orderpalletdetail2Rate","Orderpalletdetail2Total");
			$tblkey="Orderdetail2";
			
			if($uniqueKey=='')
			{
				for($i=0;$i<5;$i++)
				{
					
					//custom coe
					$uniqueKey=$i+1;
					foreach($detailData as $detailDataValue)
					{
						
						$inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'3','td',$uniqueKey,'',$disableField);
				
					}
					$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
				}
			}
			else{
				foreach($detailData as $detailDataValue)
				{
					$inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'3','td',$uniqueKey,'',$disableField);
			
				}
				$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
			
			}
			//$inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
            //$str="$('#DetailView').append($inputStr)"; 
           // echo htmlspecialchars($str);
            echo ($inputStr);
	}
	//samundar end
	public function add_form($tblkey,$uniqueKey='',$disableField='') // for Adding columns a bill
	{       
	        //check_p($tblName.DETAIL_TABLE);
	        
			$tblName="tbl".$tblkey;
	        $tblkey=ucfirst($tblkey);
	        
	      //  check_p($tblName);
	               
	        $detailData=$this->mm->get_table_heading($tblName);
            $detailData=remove_last_field($detailData,2);
            $detailData=remove_first_field($detailData);
            $detailData=add_remove_clear_option($detailData);
            $inputStr="";
			
			array_splice($detailData,array_search('CompanyId', $detailData),1);
			//array_splice($detailData,array_search('AccountsId', $detailData),1);
			
           	// check_p($detailData);
               foreach($detailData as $detailDataValue)
                {
                    $inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'6','',$uniqueKey,'',$disableField);
            
                }
                    $inputStr="<div class='row' id='div$uniqueKey'>".$inputStr."</div>";
            //$str="$('#DetailView').append($inputStr)"; 
           // echo htmlspecialchars($str);
            echo ($inputStr);
	}
	
	//samundar add ajax for consignee id to fetch consignee address 15-05-2021
	public function getAddressById($id,$keyname) // for Adding columns a bill
	{       
	        //check_p($tblName.DETAIL_TABLE);
	        $data="";
	        $tblName="tbl".lcfirst($keyname);
	        $tblName=str_replace("Id", "",$tblName);
	       // echo $tblName;
	       // die();
	        //$tblkey=ucfirst($tblkey);
			$Id=$id;
			$strPosData=strpos($Id,'-');
        	$ConsigneeId=substr($Id,0,$strPosData);
        	
	   //         $whereData=array(  
    // 					'CustomerPhoneNo'=>$this->input->post('CustomerPhoneNo'),
				// );
        		$customerData=$this->mm->custom_query("select ConsigneeAddress from $tblName where $keyname=$ConsigneeId");
        		
 			$data=$customerData[0]['ConsigneeAddress']; 
 			echo $data;
 	    //    die();
 	        
	      
	}
	//samundra end
	public function add_columns($tblkey,$uniqueKey='',$disableField='') // for Adding columns a bill
	{       
	        //check_p($tblName.DETAIL_TABLE);
	        if(!check_substr($tblkey,"detail")){
	            $tblName="tbl".$tblkey.DETAIL_TABLE;
	            $tblkey=ucfirst($tblkey.DETAIL_TABLE);
	        }
	        else{ $tblName="tbl".$tblkey;
	        $tblkey=ucfirst($tblkey);
	        }
	      //  check_p($tblName);
	               
	        $detailData=$this->mm->get_table_heading($tblName);
            $detailData=remove_last_field($detailData,2);
            $detailData=remove_first_field($detailData);
            $detailData=add_remove_clear_option($detailData);
            $inputStr="";
           // check_p($detailData);
         
               foreach($detailData as $detailDataValue)
                {
                    $inputStr=$inputStr. get_input_field($detailDataValue,$tblkey,'3','td',$uniqueKey,'',$disableField);
            
                }
                    $inputStr="<tr id='".TABLE_ROW."$uniqueKey'>".$inputStr."</tr><br>";
            //$str="$('#DetailView').append($inputStr)"; 
           // echo htmlspecialchars($str);
            echo ($inputStr);
	}
	public function import_CSV_old($KeyName)
	{
	        $tblName="tbl".strtolower($KeyName);
	        $tableField=$this->mm->get_table_heading($tblName);
	        $tableField=remove_first_last_field($tableField);
	         $selectedCol='';
	        $data=array();
	        //check_p($tableField);
	                   //check_p($data['check_data']);
	    	$data['error'] = '';    //initialize image upload error array to empty
		    if (!$this->upload->do_upload("ImportCSV")) 
			{
			    $data['error'] = $this->upload->display_errors();
                echo json_encode($data);
			} 
			else
			{
			    foreach($tableField as $tableFieldData)
			    {
                        //if(check_substr($tableFieldData,"Id"))
                    if(stripos($tableFieldData,DETAIL_COLUMN_REFERNCE)!==false)
                    {
                              $data['check_data'][]=remove("Id".DETAIL_COLUMN_REFERNCE,$tableFieldData)."Name";
                    }
                    else if((strpos($tableFieldData,'Id')!==false)&&!(stripos($tableFieldData,'Email')!==false))
                    {
                            //$data['Join_table'][]="tbl".strtolower(remove("Id",$tableFieldData));
                              $data['check_data'][]=remove("Id",$tableFieldData)."Name";
                    }
			    }
			  
			    $file_data = $this->upload->data();
			    $file_path =  './resources/images/'.$file_data['file_name'];
			    
			    if ($this->csvimport->get_array($file_path)) 
			    {
			        $csv_array = $this->csvimport->get_array($file_path);
		          //echo "hello";
		          //check_p($csv_array);
		           //check_p($csv_array);
		            $filterCSV=array();
		            $i=0;
		            $dataId=array();
		            foreach($csv_array as $arrayData)
			           {
			               
			               $filterCSV[$i]=array();
                            
    			           foreach($arrayData as $key=>$value)
    			           {
    			               /*foreach($tableField as $tableFieldKey=>$tableFieldData)
    			               if(check_substr($key,$tableFieldKey))
    			               {
    			                   // $filterCSV[$i][$key]=;
    			               }*/  
                                    if(isset($data['check_data'])&&in_array($key,$data['check_data']))
                                    {
                                        //echo $arrayData[$key];
                                        //echo $key."=".$arrayData[$key];
                                        $innerTblName="tbl".strtolower(remove("Name",$key));
                                        $selectedCol=remove("Name",$key)."Id";
                                        $whereCol=$key;
                                        $whereData=$arrayData[$key];
                                        $dataId=$this->mm->get_id($innerTblName,$selectedCol,$whereCol,$whereData);
                                        if(empty($dataId))
                                        { 
                                          $insertData[$whereCol]=$whereData;
                                          $dataId=$this->mm->insert_get_id($innerTblName,$insertData);
                                          $dataId=$this->mm->get_id($innerTblName,$selectedCol,$whereCol,$whereData);
                                        }
                                        $dataId=convert_object_array($dataId);
                                            foreach($dataId as $dataIdKey=>$dataIdData)
                                            {
                                                if(is_array($dataIdData)) 
                                                {   foreach($dataIdData as $dataIdKeyDetail=>$dataIdDataDetail)
                                                    {      
                                                       if(isset($dataIdKeyDetail))
                                                       {
                                                              $filterCSV[$i][$dataIdKeyDetail]=$dataIdDataDetail;
                                                       }
                                                    }
                                                }
                                            }
                                    }
                                    else
                                    {   $filterCSV[$i][$key]=$value;
                                    }
                                  
    			           }
    			          $mainData=array();
    			          $j=0;
    			          foreach($filterCSV[$i] as $filterCSVKey=>$filterCSVvalue)
    			          {
    			              $mainData[$tableField[$j++]]=$filterCSVvalue;
    			          }
    			          //echo "<pre>";
    			          //print_r($mainData);
    			           $this->mm->insert_a_data($tblName,$mainData);
                             $i++;
    			         
                           //end of main foreach
			           }
                                    		        
			    }
			  
			}
			
	   echo 1;
	   //end of import_CSV
	}
	public function import_CSVkd($KeyName)
	{
	        $tblName="tbl".strtolower($KeyName);
	        $tableField=$this->mm->get_table_heading($tblName);
	        $tableField=remove_first_last_field($tableField);
	         $selectedCol='';
	        $data=array();
	        //check_p($tableField);
	                   //check_p($data['check_data']);
	    	$data['error'] = '';    //initialize image upload error array to empty
		    if (!$this->upload->do_upload("ImportCSV")) 
			{
			    $data['error'] = $this->upload->display_errors();
                echo json_encode($data);
			} 
			else
			{
			    foreach($tableField as $tableFieldData)
			    {
                        //if(check_substr($tableFieldData,"Id"))
                    if(stripos($tableFieldData,DETAIL_COLUMN_REFERNCE)!==false)
                    {
                              $data['check_data'][]=remove("Id".DETAIL_COLUMN_REFERNCE,$tableFieldData)."Name";
                              //for surti basket
                    }
                    else if((strpos($tableFieldData,'Id')!==false)&&!(stripos($tableFieldData,'Email')!==false))
                    {
                            //$data['Join_table'][]="tbl".strtolower(remove("Id",$tableFieldData));
                              $data['check_data'][]=remove("Id",$tableFieldData)."Name";
                    }
			    }
			  
			    $file_data = $this->upload->data();
			    $file_path =  './resources/images/'.$file_data['file_name'];
			    
			    if ($this->csvimport->get_array($file_path)) 
			    {
			        $csv_array = $this->csvimport->get_array($file_path);
		          //echo "hello";
		          //check_p($csv_array);
		           //check_p($csv_array);
		            $filterCSV=array();
		            $i=0;
		            $dataId=array();
		           // print_r($data['check_data']);
		            /*foreach($csv_array as $arrayData)
			           {
			               
			               $filterCSV[$i]=array();
                            
    			           foreach($arrayData as $key=>$value)
    			           {
    			           }
			           }*/
		            foreach($csv_array as $arrayData)
			           {
			               
			               $filterCSV[$i]=array();
                           $subcategoryId=53;
                           foreach($arrayData as $key=>$value)
    			           {
    			               if(strpos($key,'ProductdetailBrandname') !== false)
                                {
                                    $innerTblNameSub="tblsubcategory";
                                    $selectedColSub="SubcategoryId";
                                    $whereColSub="SubcategoryName";
                                    $whereDataSub=str_replace("@","&",$value);
                                    //echo ($whereDataSub);
                                    $dataId=$this->mm->get_id($innerTblNameSub,$selectedColSub,$whereColSub,$whereDataSub);
                                    if(empty($dataId))
                                    { 
                                      $insertDataSub[$whereColSub]=$whereDataSub;
                                      $insertDataSub["CategoryId"]="13";
                                      
                                      $dataId=$this->mm->insert_get_id($innerTblNameSub,$insertDataSub);
                                      $dataId=$this->mm->get_id($innerTblNameSub,$selectedColSub,$whereColSub,$whereDataSub);
                                      
                                    }
                                    $dataId=convert_object_array($dataId);
                                    $subcategoryId=$dataId[0]["SubcategoryId"];
                                }
                            }
                           foreach($arrayData as $key=>$value)
    			           {
    			               /*foreach($tableField as $tableFieldKey=>$tableFieldData)
    			               if(check_substr($key,$tableFieldKey))
    			               {
    			                   // $filterCSV[$i][$key]=;
    			               }*/  
    			                //
    			                    //for surti basket
    			                    if(isset($data['check_data'])&&in_array($key,$data['check_data']))
                                    {   
                                        {
                                        //echo $arrayData[$key];
                                        //echo $key."=".$arrayData[$key];
                                        $innerTblName="tbl".strtolower(remove("Name",$key));
                                        $selectedCol=remove("Name",$key)."Id";
                                        //customize for surti bakset 
                                        
                                        $whereCol=$key;
                                        $productFullName=$arrayData[$key];
                                        $whereData=(strpos($arrayData[$key],"-")==null)?$arrayData[$key]:substr($arrayData[$key],0,strpos($arrayData[$key],"-"));
                                        //print_r($whereCol."=".$whereData);
                                        $dataId=$this->mm->get_id($innerTblName,$selectedCol,$whereCol,$whereData);
                                        if(empty($dataId))
                                        { 
                                          $insertData[$whereCol]=$whereData;
                                          //only for surti Basket static Sub cat id 
                                          //if(strcmp($innerTblName,"tblproductdetail")==0)
                                          //{
                                            $insertData["HsnId"]=48;
                                            $insertData["SubcategoryId"]=$subcategoryId;
                                          //}
                                          //print_r($insertData);
                                          $dataId=$this->mm->insert_get_id($innerTblName,$insertData);
                                          $dataId=$this->mm->get_id($innerTblName,$selectedCol,$whereCol,$whereData);
                                        }
                                        $dataId=convert_object_array($dataId);
                                        
                                            foreach($dataId as $dataIdKey=>$dataIdData)
                                            {
                                                if(is_array($dataIdData)) 
                                                {   foreach($dataIdData as $dataIdKeyDetail=>$dataIdDataDetail)
                                                    {      
                                                       if(isset($dataIdKeyDetail))
                                                       {
                                                              $filterCSV[$i][$dataIdKeyDetail]=$dataIdDataDetail;
                                                       }        
                                                    }
                                                }
                                            }
                                        
                                    }
                                    }
                                    else if(strpos($key,'ProductdetailName') !== false)
                                    {
                                        //echo "<br>Product Detail Name : ".((strpos($productFullName,"-")==null)?$productFullName:substr($productFullName,strpos($productFullName,"-")+1))."<br>";
                                      //  $proName=((strpos($productFullName,"-")==null)?$productFullName:substr($productFullName,strpos($productFullName,"-")+1));
                                    //    $filterCSV[$i]["ProductdetailName"]=str_replace("^","'",$proName);
                                   // $proName1=((strpos($productFullName,"-")==null)?$productFullName:substr($productFullName,strpos($productFullName,"Loose1")+1));
                                    //$proName2=((strpos($productFullName,"-")==null)?$productFullName:substr($productFullName,strpos($productFullName,"Loose2")+1));
                                    //$proName3=((strpos($productFullName,"-")==null)?$productFullName:substr($productFullName,strpos($productFullName,"Loose3")+1));
                                       $flag = 0;
                                        if(strpos($value, 'LOOSE1') !== false)
                                        {
                                            //echo "if";
                                            $proName=((strpos($productFullName,"-")==null)?$productFullName:substr($productFullName,strpos($productFullName,"LOOSE1")+1));
                                          //  $filterCSV[$i]["ProductdetailName"]=str_replace("^","'",$proName);
                                            echo $proName;
                                            $flag = 1;
                                        }
                                        elseif(strpos($value,'LOOSE2') !== false)
                                        {
                                           // echo "elseif1";
                                            $proName=((strpos($productFullName,"-")==null)?$productFullName:substr($productFullName,strpos($productFullName,"LOOSE2")+1));
                                           // $filterCSV[$i]["ProductdetailName"]=str_replace("^","'",$proName);
                                           echo $proName;
                                            $flag = 2;
                                        }
                                        elseif(strpos($value,'LOOSE3') !== false)
                                        {
                                          //  echo "elseif2";
                                            $proName=((strpos($productFullName,"-")==null)?$productFullName:substr($productFullName,strpos($productFullName,"LOOSE3")+1));
                                          //  $filterCSV[$i]["ProductdetailName"]=str_replace("^","'",$proName);
                                            echo $proName;
                                            $flag = 3;
                                        }
                                        else
                                        {
                                            //echo "else";   
                                             $proName=((strpos($productFullName,"-")==null)?$productFullName:substr($productFullName,strpos($productFullName,"-")+1));
                                             $filterCSV[$i]["ProductdetailName"]=str_replace("^","'",$proName);
                                            echo $proName;
                                             $flag =4;
                                        }
                                        
                                        //$filterCSV[$i]["ProductdetailVaration"]=(strpos($productFullName,"-")==null)?$productFullName:substr($arrayData[$key],strpos($productFullName,"-"),strlen($productFullName));
                                    }
                                    else if(strpos($key,'ProductdetailBarcodeNo') !== false||strpos($key,'ProductdetailImages') !== false)
                                    {
                                        if(strpos($key,'ProductdetailBarcodeNo') !== false)
                                        {
                                              $filterCSV[$i]["ProductdetailBarcodeNo"]=$value;
                                          
                                            
                                        }else
                                        {
                                              $filterCSV[$i]["ProductdetailImages"]=$value."-F.jpg,".$value."-B.jpg,".$value."-S.jpg,".$value."-X.jpg";
                                          
                                        }
                                            
                                    }
                                    else
                                    {   $filterCSV[$i][$key]=$value;
                                    }
                                  
    			           }
    			          $mainData=array();
    			          $j=0;
    			          foreach($filterCSV[$i] as $filterCSVKey=>$filterCSVvalue)
    			          {
    			              $mainData[$tableField[$j++]]=$filterCSVvalue;
    			          }
    			         // echo "<pre>";
    			          //print_r($mainData);
    			          if($flag==1)
    			          {
    			              $a=array("1KG"=>"1KG","3KG"=>"3KG","5KG"=>"5KG","25KG"=>"25KG");
    			             // for($i=0;$i<5;$i++){
    			                // $this->mm->insert_a_data($tblName,$mainData);
    			               //    echo $a['1KG'];
    			             
    			          for($i=0;$i<5;$i++){
        			         foreach($filterCSV[$i] as $a)
    			                {
    			                    $mainData[$i][$a]=$a;
    			                    echo "<pre>";
    			                 print_r($a);
    			                    
    			                 }
    			              }
    			              
    			          }
    			          elseif($flag==2)
    			          {
    			                echo ("else if 1");
    			          }
    			          elseif($flag==3)
    			         {
    			             echo ("else if 2");
    			         }
    			         else
    			         {
    			             echo ("else if 0");
    			         }
                           //end of main foreach
			           }
                                    		        
			    }
			  
			}
			
	   echo 1;
	   //end of import_CSV
	}
	
	public function import_CSV($KeyName)
	{
	        $tblName="tbl".strtolower($KeyName);
	        $tableField=$this->mm->get_table_heading($tblName);
	        $tableField=remove_first_last_field($tableField);
	         $selectedCol='';
	        $data=array();
	        //check_p($tableField);
	                   //check_p($data['check_data']);
	    	$data['error'] = '';    //initialize image upload error array to empty
		    if (!$this->upload->do_upload("ImportCSV")) 
			{
			    $data['error'] = $this->upload->display_errors();
                echo json_encode($data);
			} 
			else
			{
			    foreach($tableField as $tableFieldData)
			    {
                        //if(check_substr($tableFieldData,"Id"))
                    if(stripos($tableFieldData,DETAIL_COLUMN_REFERNCE)!==false)
                    {
                              $data['check_data'][]=remove("Id".DETAIL_COLUMN_REFERNCE,$tableFieldData)."Name";
                              //for surti basket
                    }
                    else if((strpos($tableFieldData,'Id')!==false)&&!(stripos($tableFieldData,'Email')!==false))
                    {
                            //$data['Join_table'][]="tbl".strtolower(remove("Id",$tableFieldData));
                              $data['check_data'][]=remove("Id",$tableFieldData)."Name";
                    }
			    }
			  
			    $file_data = $this->upload->data();
			    $file_path =  './resources/images/'.$file_data['file_name'];
			    
			    if ($this->csvimport->get_array($file_path)) 
			    {
			        $csv_array = $this->csvimport->get_array($file_path);
		          //echo "hello";
		          //check_p($csv_array);
		           //check_p($csv_array);
		            $filterCSV=array();
		            $i=0;
		            $dataId=array();
		           // print_r($data['check_data']);
		            /*foreach($csv_array as $arrayData)
			           {
			               
			               $filterCSV[$i]=array();
                            
    			           foreach($arrayData as $key=>$value)
    			           {
    			           }
			           }*/
		            foreach($csv_array as $arrayData)
			           {
			               
			               $filterCSV[$i]=array();
                           $subcategoryId=53;
                           foreach($arrayData as $key=>$value)
    			           {
    			               if(strpos($key,'ProductdetailBrandname') !== false)
                                {
                                    $innerTblNameSub="tblsubcategory";
                                    $selectedColSub="SubcategoryId";
                                    $whereColSub="SubcategoryName";
                                    $whereDataSub=str_replace("@","&",$value);
                                    //echo ($whereDataSub);
                                    $dataId=$this->mm->get_id($innerTblNameSub,$selectedColSub,$whereColSub,$whereDataSub);
                                    if(empty($dataId))
                                    { 
                                      $insertDataSub[$whereColSub]=$whereDataSub;
                                      $insertDataSub["CategoryId"]="13";
                                      
                                      $dataId=$this->mm->insert_get_id($innerTblNameSub,$insertDataSub);
                                      $dataId=$this->mm->get_id($innerTblNameSub,$selectedColSub,$whereColSub,$whereDataSub);
                                      
                                    }
                                    $dataId=convert_object_array($dataId);
                                    $subcategoryId=$dataId[0]["SubcategoryId"];
                                }
                            }
                           foreach($arrayData as $key=>$value)
    			           {
    			               /*foreach($tableField as $tableFieldKey=>$tableFieldData)
    			               if(check_substr($key,$tableFieldKey))
    			               {
    			                   // $filterCSV[$i][$key]=;
    			               }*/  
    			                //
    			                    //for surti basket
    			                    if(isset($data['check_data'])&&in_array($key,$data['check_data']))
                                    {   
                                        {
                                        //echo $arrayData[$key];
                                        //echo $key."=".$arrayData[$key];
                                        $innerTblName="tbl".strtolower(remove("Name",$key));
                                        $selectedCol=remove("Name",$key)."Id";
                                        //customize for surti bakset 
                                        
                                        $whereCol=$key;
                                        $productFullName=$arrayData[$key];
                                        $whereData=(strpos($arrayData[$key],"-")==null)?$arrayData[$key]:substr($arrayData[$key],0,strpos($arrayData[$key],"-"));
                                        //print_r($whereCol."=".$whereData);
                                        $dataId=$this->mm->get_id($innerTblName,$selectedCol,$whereCol,$whereData);
                                        if(empty($dataId))
                                        { 
                                          $insertData[$whereCol]=$whereData;
                                          //only for surti Basket static Sub cat id 
                                          //if(strcmp($innerTblName,"tblproductdetail")==0)
                                          //{
                                            $insertData["HsnId"]=48;
                                            $insertData["SubcategoryId"]=$subcategoryId;
                                          //}
                                          //print_r($insertData);
                                          $dataId=$this->mm->insert_get_id($innerTblName,$insertData);
                                          $dataId=$this->mm->get_id($innerTblName,$selectedCol,$whereCol,$whereData);
                                        }
                                        $dataId=convert_object_array($dataId);
                                        
                                            foreach($dataId as $dataIdKey=>$dataIdData)
                                            {
                                                if(is_array($dataIdData)) 
                                                {   foreach($dataIdData as $dataIdKeyDetail=>$dataIdDataDetail)
                                                    {      
                                                       if(isset($dataIdKeyDetail))
                                                       {
                                                              $filterCSV[$i][$dataIdKeyDetail]=$dataIdDataDetail;
                                                       }
                                                    }
                                                }
                                            }
                                        
                                    }
                                    }
                                    else if(strpos($key,'ProductdetailName') !== false)
                                    {
                                        //echo "<br>Product Detail Name : ".((strpos($productFullName,"-")==null)?$productFullName:substr($productFullName,strpos($productFullName,"-")+1))."<br>";
                                        $proName=((strpos($productFullName,"-")==null)?$productFullName:substr($productFullName,strpos($productFullName,"-")+1));
                                        $filterCSV[$i]["ProductdetailName"]=str_replace("^","'",$proName);
                                        //$filterCSV[$i]["ProductdetailVaration"]=(strpos($productFullName,"-")==null)?$productFullName:substr($arrayData[$key],strpos($productFullName,"-"),strlen($productFullName));
                                    }
                                    else if(strpos($key,'ProductdetailBarcodeNo') !== false||strpos($key,'ProductdetailImages') !== false)
                                    {
                                        if(strpos($key,'ProductdetailBarcodeNo') !== false)
                                        {
                                              $filterCSV[$i]["ProductdetailBarcodeNo"]=$value;
                                          
                                            
                                        }else
                                        {
                                              $filterCSV[$i]["ProductdetailImages"]=$value."-F.jpg,".$value."-B.jpg,".$value."-S.jpg,".$value."-X.jpg";
                                          
                                        }
                                            
                                    }
                                    else
                                    {   $filterCSV[$i][$key]=$value;
                                    }
                                  
    			           }
    			          $mainData=array();
    			          $j=0;
    			          foreach($filterCSV[$i] as $filterCSVKey=>$filterCSVvalue)
    			          {
    			              $mainData[$tableField[$j++]]=$filterCSVvalue;
    			          }
    			         // echo "<pre>";
    			          //print_r($mainData);
    			           $this->mm->insert_a_data($tblName,$mainData);
                             $i++;
    			         
                           //end of main foreach
			           }
                                    		        
			    }
			  
			}
			
	   echo 1;
	   //end of import_CSV
	}
	public function get_all_data()
	{ //  echo "asd";
	   $tblName=$this->input->get('tblName');
	   //check_p($tblName);
	    if(isset($this->session->CompanyId))
	    {
	        $whereData=array("tblcompany.CompanyId"=>$this->session->CompanyId);
	              $data['datasource']=$this->mm->get_a_data_join($tblName,$whereData);
	  
	    }
	    else{
	        $data['datasource']=$this->mm->get_all_data_join($tblName);
	    }
	 //  $this->load->view('Bill',$data);
	    echo json_encode($data);
	}
	//mobile APP API start 
	//get api for APP
	public function get_all_data_api()
	{ //  echo "asd";
        $data['IsSuccess']=true;
	    $data['Message']="Success";        
	    try
	    {
	           $tblName=$this->input->get('tblName');
	           //check_p($tblName);
	           $data['Data']=$this->mm->get_all_data_join($tblName);
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
         header('Content-Type: application/json');
	
	 //  $this->load->view('Bill',$data);
	    echo json_encode($data);
	}
	// login with password
	public function login_api()
	{
		try
	    {   
	            //$tblName=$this->input->get('tblName');
	            $tblname='tblcustomer';
	            $where=array(  
    					'CustomerPhoneNo'=>$this->input->post('CustomerPhoneNo'),
					'CustomerPassword'=>$this->input->post('CustomerPassword')
        		);
        		//print_r($where);
        		$data['Data']=$this->mm->get_a_data_join($tblname,$where);
        		$arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Detail  Found";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
	   
	}
	public function addCustomer() //inserting a data in table
	{      
	      try
	      {  
	             if($this->input->post('version')>1.1)
                {
               	    $data['IsSuccess']=true;
	                $data['Message']="Please update your app ";    
        		    $data['Data']=1;    
    		        header('Content-Type: application/json');
    		    	echo json_encode($data);
	                return true;
        	
                }
                
	          $tblname='tblcustomer';
	            $whereData=array(  
    					'CustomerPhoneNo'=>$this->input->post('CustomerPhoneNo'),
				);
        		$customerData=$this->mm->get_a_data($tblname,$whereData);
        		if(empty($customerData))
        		{
    	            $insertData=array(  
        					'CustomerName'=>$this->input->post('CustomerName'),
    					    'CustomerEmailId'=>$this->input->post('CustomerEmailId'),
    					    'CustomerPhoneNo'=>$this->input->post('CustomerPhoneNo'),
    		/*			    'CustomerFCMToken'=>$this->input->post('CutomerFCMToken'),*/
    				
    				);
            		$data['Data']=  $this->mm->insert_data_api_return_data($tblname,$insertData);
    	            $arr=(array)($data['Data']);
        		    if(!empty($arr))        
        			{   $data['IsSuccess']=true;
    	                $data['Message']="Customer Data Found";    
        	            $data['Data']=array(json_decode(json_encode($arr)));
        		    }
            		else
            		{   $data['IsSuccess']=false;
    	                $data['Message']="Sign up  Un-Successfully "; 
    	                $data['Data']=[];
            		}
        		}
        		else
        		{
        		       $data['IsSuccess']=false;
    	               $data['Message']="Customer Already Register"; 
    	               $data['Data']=0;
            		
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//nilesh
		public function addMedicalstore() //inserting a data in table
	{      
	      try
	      {    $tblname='tblmedicalstore';
	            $whereData=array(  
    					'MedicalstorePhoneNo'=>$this->input->post('MedicalstorePhoneNo'),
				);
        		$customerData=$this->mm->get_a_data($tblname,$whereData);
        	//	print_r($customerData);
        		//die();
        		if(empty($customerData))
        		{
        		   // echo "if";
    	            $insertData=array(  
        					'MedicalstoreName'=>$this->input->post('MedicalstoreName'),
    					    'MedicalstoreEmailId'=>$this->input->post('MedicalstoreEmailId'),
    					    'MedicalstorePhoneNo'=>$this->input->post('MedicalstorePhoneNo'),
    				
    				);
            		$data['Data']=  $this->mm->insert_data_api_return_data_for_medical($tblname,$insertData);
            		//print_r($data['Data']);
    	            $arr=(array)($data['Data']);
        		    if(!empty($arr))        
        			{   $data['IsSuccess']=true;
    	                $data['Message']="Customer Data Found";    
        	            $data['Data']=array(json_decode(json_encode($arr)));
        		    }
            		else
            		{   $data['IsSuccess']=false;
    	                $data['Message']="Sign up  Un-Successfully "; 
    	                $data['Data']=[];
            		}
        		}
        		else
        		{
        		       $data['IsSuccess']=false;
    	               $data['Message']="Medicalstore Already Register"; 
    	               $data['Data']=0;
            		
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
//end
	// login with password
	//samundar
	/*public function signInd()
	{
		try
	    {
	         
	            //$tblName=$this->input->get('tblName');
	            $tblname='tblcustomer';
	            $where=array(  
    					'CustomerPhoneNo'=>$this->input->post('CustomerPhoneNo'),
        			
        		);
        		//print_r($where);
        		$data['Data']=$this->mm->get_a_data_join($tblname,$where);
        		
        		//samu 23-01-2021
        	//	if(isset($this->input->post('CustomerFCMToken')))
        	//	{
        		//update FCM token
    	            $updateData=array('CustomerFCMToken'=>$this->input->post('CustomerFCMToken'));
    	            //print_r($updateData);
    	            $updateState=$this->mm->update_data_api($tblname,$updateData,$where);
        		   
    	            $data['Data']=$this->mm->get_a_data_join($tblname,$where);
    	            //print_r($updateState);
    	            $arr=array();
            		if(!empty($data['Data']))
            	    {
            	        $dat['Type']='retailer';
                		$arr1=(array)$data['Data'][0];
                		$arr2['Type']=$dat['Type'];
                		$arr=array(json_decode(json_encode(array_merge($arr1,$arr2))));
            	    }
            	    else
            	    {
        		    $tblname='tblmanufacturer';
	                $where=array('ManufacturerPhoneNo'=>$this->input->post('PhoneNo'));
            		$data['Data']=$this->mm->get_a_data_join($tblname,$where);
            		$dat['Type']='manufacturer';
            	    	if(!empty($data['Data']))
                    	{    $arr1=(array)$data['Data'][0];
                    		$arr2['Type']=$dat['Type'];
            		    $arr=array(json_decode(json_encode(array_merge($arr1,$arr2))));;
                    	}
            	       
            	    }
        		
        	/*	else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Please send CustomerFCMToken";    
        		    $data['Data']=$arr;
        		}*/
        		//end
        		
        	//	$arr=(array)($data['Data']);
        	/*	if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Customer Data Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No User Found Please Sign Up First";   
	                $data['Data']=[];
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
	   
	}*/
	//end
	public function signIn()
	{
		try
	    {
	         
	            //$tblName=$this->input->get('tblName');
	            $tblname='tblcustomer';
	            $where=array(  
    					'CustomerPhoneNo'=>$this->input->post('CustomerPhoneNo'),
        			
        		);
        		//print_r($where);
        		$data['Data']=$this->mm->get_a_data_join($tblname,$where);
        		$arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Customer Data Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No User Found Please Sign Up First";   
	                $data['Data']=[];
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
	   
	}
	
	
	
	public function sendOTP()
	{
		try
	    {
	        $where=array(  
    					'PhoneNo'=>$this->input->post('PhoneNo'),
					'OTP'=>$this->input->post('OTP')
        		);
	        $url="http://promosms.itfuturz.com/vendorsms/pushsms.aspx?user=myjini&password=myjini&msisdn=".$where['PhoneNo']."&sid=MYJINI&msg=Please%20enter%20this%20OTP%20".$where['OTP']."%20to%20Login%20in%20APP&fl=0&gwid=2";
	        
	            $ch = curl_init($url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    $output = curl_exec($ch);
			//echo $output;
		    	curl_close($ch);
            if(!empty($output))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="OTP Send Successfully";    
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="OTP Not Send"; 
	                $data['Data']=0;
        		}
    			   header('Content-Type: application/json');
	
    			echo json_encode($data);
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
	   
	}
	//samu send notification 21-10-2021
	public function Push_Firebase_Notification_API_old($to='',$data=array())//old nilesh added
	{
	    //hear $to may add CutomerFCMToken value in customer table 
	    
	    $to  = "fGRA3ThfS7u6SlD-lesyHe:APA91bEzDjpbpMle5uXYSgecK4MU9WbdNmqRFZKeGmiTrJLbM4dFqe8tJtV5BohKxHsLG6eRvbaVxEVvM3-ufGiFJ2V8l7H3bW4qm2KSh0SeS9wlusylcS9Tfn-9lPM8CsH2_QCrYTnx";
	    $data = array(
	                  'title'=>$this->input->post('NotificationTitle'),
	                  'body'=>$this->input->post('NotificationMessage'),
	                  'image'=>$this->input->post('NotificationImage'),
	                  'icon'=>'http://webnappmaker.in/Balaji/resources/LOGO.png',
	                 // 'message'=>$this->input->post('title'),
	                  //'picture' => 'https://www.logodesign.net/images/abstract-logo.png',
	                 // 'picture' => $this->input->post('NotificationImage'),
	                  );
	   
	    $apiKey ='AAAAyAc0v8k:APA91bFfBZdDyJBIqglnwtVOqeRnrFOkzzyYifeOC4jKGFsOc2E3AoqQO6MZ6JjUv-rRDJ8LgUoP48GlWLs9ugzHDv-sZht1gSTPcDCzzzsFQjWyoNlq4pP_MTHulvhYVqATcAEqJVUt';
	    $fields = array('to' => $to, 'notification' =>$data);
	   
	    $headers = array('Authorization: key='.$apiKey,'Content-Type: application/json');
	  
	    $url='https://fcm.googleapis.com/fcm/send';
	   
	    $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	   
	   
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($fields));
	    $result = curl_exec($ch);
	    curl_close($ch);
	    $data=array("2");
	    //echo $data[0];
	    return json_decode($result,true);
	   
	}
	//end
	//nilesh
	public function Push_Firebase_Notification_API($to='',$data=array())
	{
	  //  $to  = "ce3ntVvESrSPuzpBrfCc6k:APA91bFRhVJAxOmnCTBoqeuRvKauVjfq6Q4H_1l-uDqbrvRtkDlcQpchuES-ZHu29QiGKxTv2UXLlVImiEC6hKzoH_fPYAllo54mY1ZGFuNanrMKoYwGyUjrbrWTkPXfpikndQuXpwN9";

        $tblname="tblcustomer";
        $customer=convert_object_array($this->mm->get_all_data($tblname));
        // echo "<pre>";
        // print_r($customer);
        // die();
        //check_p($customer);
       // $to= "cgJ1s2UXSKK0XIrZkIgA8c:APA91bH0uZSShEtZ34XpN-U7i2xKJiRxTcUdbxF12oidpp6c9LMsyLKdCF11DQvWgO9AmOX6x-BMrI87yanGY1yUUy_gGHHwPwwPyxkaOnc-l9D6xg80jQMC8k8EKW_CoB97lXFY1W0o";
	 //   $to= "cgJ1s2UXSKK0XIrZkIgA8c:APA91bH0uZSShEtZ34XpN-U7i2xKJiRxTcUdbxF12oidpp6c9LMsyLKdCF11DQvWgO9AmOX6x-BMrI87yanGY1yUUy_gGHHwPwwPyxkaOnc-l9D6xg80jQMC8k8EKW_CoB97lXFY1W0o";
        for($i=0;$i<count($customer);$i++)
        {
            echo $customer[$i]['CustomerFCMToken'];
        
	    $to= $customer[$i]['CustomerFCMToken'];
	    $data = array(
	                  'title'=>$this->input->post('NotificationTitle'),
	                  'body'=>$this->input->post('NotificationMessage'),
	                  'image'=>$this->input->post('NotificationImage'),
	                  'icon'=>'http://webnappmaker.in/Balaji/resources/LOGO.png',
	                 // 'message'=>$this->input->post('title'),
	                  //'picture' => 'https://www.logodesign.net/images/abstract-logo.png',
	                  );


	    $apiKey ='AAAAis-DhkA:APA91bE6_Ru2siISsfV8RFUqsFn2lm1H0Gun583y-R2z6rt_n03XutgFEQ-pE-jPYB0rLCQq6dHy-Ejn3aQlwNMMQQkVL0DuE8rXtCde-q2pZV3Kd14LkUHoTJ8iJxHZy-54bOiF1BJt';
	    $fields = array('to' => $to, 'notification' =>$data);
	    
	    $headers = array('Authorization: key='.$apiKey,'Content-Type: application/json');
	   
	    $url='https://fcm.googleapis.com/fcm/send';
	    
	    $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	    
	    
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($fields));
	    $result = curl_exec($ch);
	    curl_close($ch);
	    $data=array("2");
	    echo $data[0];
	    return json_decode($result,true);
	}
	}
	//end
	//update customer profile api
	public function update_profile()
	{
	    try
	    {
	            //  echo "customer Phone NO".$this->input->post('CustomerId');
	            //$tblName=$this->input->get('tblName');
	            $tblname='tblcustomer';
	            $updateData=array(  
    					'CustomerPhoneNo'=>$this->input->post('CustomerPhoneNo'),
					    'CustomerName'=>$this->input->post('CustomerName'),
					    'CustomerCompanyName'=>$this->input->post('CustomerCompanyName'),
					    'CustomerEmailId'=>$this->input->post('CustomerEmailId')
					
        		); 
        		$where=array(  
    					'CustomerId'=>$this->input->post('CustomerId')
					
        		); 
        		//echo "Customer Id ".$this->input->post('custId');
        		//print_r($updateData);
        		//print_r($where);
        		$data['Data']=$this->mm->update_data_api($tblname,$updateData,$where);
        		$arr=(array)($data['Data']);
        		//print_r($arr);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Profile Updated";    
        		    $data['Data']="1";   
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Profile Update Failed"; 
	                $data['Data']="0";
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
            $data['Data']="0";
        }
        header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function insert_data_api($name = '',$detailArray='')  //inserting a data in table
	{      
	      try
	      {
	         
	        $colName=strtolower($name);
	        $tblName="tbl".$colName; 
	        $tableField=$this->mm->get_table_heading($tblName);
	        $tableField=remove_last_field($tableField,2);
	        // $tableField=remove_first_field($tableField);
	        $dataTableField=array();
	        $lastInsertId;
	        $dataTableField=$this->insert_data_function($tableField);
	        $dataTableField[ucfirst($name."CDT")]=date('Y-m-d H:i:s');
	        $dataTableField[ucfirst($name."Status")]=0;
	       //check_p($this->input->post($tableField[0]));
	       if($this->input->post($tableField[0])!=NULL)
	       { //UPDATE DATA
              //  echo "Update Data";
              //check_p($this->input->post($tableField[0]));
                //check_p($dataTableField);
                $data=$this->mm->update_data($tblName,$dataTableField,$tableField[0],$this->input->post($tableField[0]));
	            $lastInsertId=$this->input->post($tableField[0]);
	            $tableDetailName='tbl'.$name.'detail';
                $tablePresent=$this->mm->check_table_present($tableDetailName);
                if ($tablePresent)
                {
                    //check_p($tableDetailName);
                    $detailArray=explode(',',($_POST['DetailArray']));
	                $tableField=$this->mm->get_table_heading($tableDetailName);
            	    //check_p($detailArray);
            	    $tableField=remove_last_field($tableField,2);
            	    $multiData=array();     
	                foreach($detailArray as $value)
	                {
	                    $dataTableField=array();
            	        $dataTableField=$this->insert_data_function($tableField,$value,$lastInsertId,$tableDetailName);
            	        $dataTableField[ucfirst($name."detail"."CDT")]=date('Y-m-d H:i:s');
            	        $dataTableField[ucfirst($name."detail"."Status")]=0;
            	        //$data=$this->mm->insert_data($tableDetailName,$dataTableField);
            	        //echo $data;
            	        array_push($multiData,$dataTableField);
	                }
	                //check_p($multiData);
	                $data=$this->mm->insert_multiple_data($tableDetailName,$multiData);
	           }
	           
	       }
	       else
	       {  //INSERT NEW DATA
              // echo "Insert Data";
             // check_p($dataTableField);
                $lastInsertId=$this->mm->insert_data($tblName,$dataTableField);
               // echo $lastInsertId;
                $tableDetailName='tbl'.$name.'detail';
                $tablePresent=$this->mm->check_table_present($tableDetailName);
                if ($tablePresent)
                {
                  //  check_p($lastInsertId);
                    $detailArray=explode(',',($_POST['DetailArray']));
	                $tableField=$this->mm->get_table_heading($tableDetailName);
            	    //check_p($tableField);
            	    $tableField=remove_last_field($tableField,2);
            	    $multiData=array();     
	                foreach($detailArray as $value)
	                {
	                    $dataTableField=array();
            	        $dataTableField=$this->insert_data_function($tableField,$value,$lastInsertId);
            	        $dataTableField[ucfirst($name."detail"."CDT")]=date('Y-m-d H:i:s');
            	        $dataTableField[ucfirst($name."detail"."Status")]=0;
            	        //$data=$this->mm->insert_data($tableDetailName,$dataTableField);
            	       ;
            	        array_push($multiData,$dataTableField);
	                  //   print_r($data)
	                    
	                }
	               
	               // check_p($multiData);
	                $data=$this->mm->insert_multiple_data($tableDetailName,$multiData);
	           }
	            $tableDetailName='tbl'.$name.'detail2';
                $tablePresent=$this->mm->check_table_present($tableDetailName);
                if ($tablePresent)
                {
                  //  check_p($lastInsertId);
                    $detailArray=explode(',',($_POST['DetailArray2']));
	                $tableField=$this->mm->get_table_heading($tableDetailName);
            	    //check_p($tableField);
            	    $tableField=remove_last_field($tableField,2);
            	    $multiData=array();     
	                foreach($detailArray as $value)
	                {
	                    $dataTableField=array();
            	        $dataTableField=$this->insert_data_function($tableField,$value,$lastInsertId);
            	        $dataTableField[ucfirst($name."detail2"."CDT")]=date('Y-m-d H:i:s');
            	        $dataTableField[ucfirst($name."detail2"."Status")]=0;
            	        //$data=$this->mm->insert_data($tableDetailName,$dataTableField);
            	       ;
            	        array_push($multiData,$dataTableField);
	                  //   print_r($data)
	                    
	                }
	               
	               // check_p($multiData);
	                $data=$this->mm->insert_multiple_data($tableDetailName,$multiData);
	           }
	           
	       }
	       
    	        if(!empty($lastInsertId))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Data Inserted Successfully  Data ";    
        		    if(strcmp($name,"customer")==0)
        		        $data['Data']=array(json_decode(json_encode($dataTableField)));
        		    else
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Data Inserted Un-Successfully"; 
	                $data['Data']=0;
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar 27-01-2021
	public function addToCartOld($name = '',$detailArray='')  //inserting a data in table
	{      
	      try
	      {  //samu
	            
	            $tblname='tblproductdetail';
	        //    $a=(int)$this->input->post('ProductDetailId');
	            //echo $a;
	           // $whereData=array("ProductDetailId"=>$this->input->post('ProductDetailId'));
	             //$Data['Product']=convert_object_array($this->mm->get_all_data($tblname,$whereData,'ProductdetailNo'));
	           // print_r($Data);
	            //echo "<pre>";
	            // print_r($Data['Product'][0]['ProductdetailNo']);
	          //  $a--;
	           //  $demo=$Data['Product'][$a]['ProductdetailNo'];
	            // print_r($demo);
	        //end
	          $tblname='tblcart';
	            $insertData=array(  
    					'CustomerId'=>$this->input->post('CustomerId'),
					    'ProductId'=>$this->input->post('ProductId'),
					    'CartQuantity'=>$this->input->post('CartQuantity'),
					 
					   // 'CartPackInfo'=>($this->input->post('ProductDetailId')),
				   //     'CartProductDetailNo'=>$demo,	    
        		);
        		$whereData=[];
        		$Data=[];
        		$data['Data']=$this->mm->insert_data_api($tblname,$insertData);
	            if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Product Added to Cart Successfully ";    
        		    if(strcmp($name,"customer")==0)
        		        $data['Data']=array(json_decode(json_encode($dataTableField)));
        		    else
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Product not Added to Cart"; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	
	public function addToCart($name = '',$detailArray='')  //inserting a data in table
	{      
	      try
	      {  
	           $tblname1='tblpurchasedetail';
	           $CartQty=(int)$this->input->post('CartQuantity');
	           $whereData=array("tblpurchasedetail.PurchasedetailId"=>$this->input->post('PurchasedetailId'));
	           $result=convert_object_array($this->mm->get_a_data($tblname1,$whereData));
	           $TotalPro=(int)$result[0]['PurchasedetailProductQty'];
	           $ProId=(int)$result[0]['ProductId'];
	           if($CartQty <= $TotalPro)
	           {
        	            $tblname='tblcart';
        	            $insertData=array(  
            					'CustomerId'=>$this->input->post('CustomerId'),
        					    'PurchasedetailId'=>$this->input->post('PurchasedetailId'),
        					    'CartQuantity'=>$this->input->post('CartQuantity'),
        					    'ProductId'=>$ProId,
                		);
                		$whereData=[];
                		$Data=[];
                		$data['Data']=$this->mm->insert_data_api($tblname,$insertData);
        	            if(!empty($data['Data']))
                		{
                		    $data['IsSuccess']=true;
        	                $data['Message']="Product Added to Cart Successfully ";    
                		    if(strcmp($name,"customer")==0)
                		        $data['Data']=array(json_decode(json_encode($dataTableField)));
                		    else
                		    $data['Data']=1;
                		}
                		else
                		{
                		    $data['IsSuccess']=true;
        	                $data['Message']="Product not Added to Cart"; 
        	                $data['Data']=0;
                		}
        	          
        	      }
	           else
	           {
                    $data['IsSuccess']=true;
	                $data['Message']="Please reduce cart qty"; 
	                $data['Data']=0;   
	           }
	    
	         }
	           
           catch(Exception $e) {
                $data['Message']=$e->getMessage();
                $data['IsSuccess']=false;
            }
          
       	    header('Content-Type: application/json');
    		echo json_encode($data);

	        
	}
	//end samundar

	//samundar create new addtocart api remove pack info 17-03-2021
	public function addToCartNew($name = '',$detailArray='')  //inserting a data in table
	{      
	      try
	      {  //samu
	            
	            
	          $tblname='tblcart';
	            $insertData=array(  
    					'CustomerId'=>$this->input->post('CustomerId'),
					    'ProductId'=>$this->input->post('ProductId'),
					    'CartQuantity'=>$this->input->post('CartQuantity'),
        		);
        		$Data=[];
        		$data['Data']=$this->mm->insert_data_api($tblname,$insertData);
	            if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Product Added to Cart Successfully ";    
        		    if(strcmp($name,"customer")==0)
        		        $data['Data']=array(json_decode(json_encode($dataTableField)));
        		    else
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Product not Added to Cart"; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar end
	
	//original name addToCart
	public function addToCart1($name = '',$detailArray='')  //inserting a data in table
	{      
	      try
	      {    
	          //samu
	     
	          /*  $tblname='tblproductdetail';
	            $whereData=array("ProductDetailId"=>$this->input->post('ProductDetailId'));
	             $Data['Product']=convert_object_array($this->mm->get_all_data($tblname,$whereData,'ProductdetailNo'));
	            //print_r($Data);
	            //echo "<pre>";
	            // print_r($Data['Product'][0]['ProductdetailNo']);
	             $demo=$Data['Product'][0]['ProductdetailNo'];
	          */   
	             
	         //end
	          $tblname='tblcart';
	            $insertData=array(  
    					'CustomerId'=>$this->input->post('CustomerId'),
					    'ProductId'=>$this->input->post('ProductId'),
					    'CartQuantity'=>$this->input->post('CartQuantity'),
					    'CartPackInfo'=>($this->input->post('ProductDetailId')),
					    //samundar add
				       // 'CartProductDetailNo'=>$demo, 
				        //samundar end
        		);
        		
        		$data['Data']=$this->mm->insert_data_api($tblname,$insertData);
	            if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Product Added to Cart Successfully ";    
        		    if(strcmp($name,"customer")==0)
        		        $data['Data']=array(json_decode(json_encode($dataTableField)));
        		    else
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Product not Added to Cart"; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function addAddressold() //inserting a data in table
	{      
	      try
	      {     
        	
        		        $tblname='tbladdress';
	                    $insertData=array(  
    					'CustomerId'=>$this->input->post('CustomerId'),
					    'AddressHouseNo'=>$this->input->post('AddressHouseNo'),
					    'AddressAppartmentName'=>$this->input->post('AddressAppartmentName'),
					    'AddressStreet'=>$this->input->post('AddressStreet'),
					    'AddressLandmark'=>$this->input->post('AddressLandmark'),
					    'AddressLat'=>$this->input->post('AddressLat'),
					    'AddressLong'=>$this->input->post('AddressLong'),
					    
					    'AddressCityName'=>$this->input->post('AddressCityName'),
					    'AddressArea'=>$this->input->post('AddressArea'),
					    'AddressType'=>$this->input->post('AddressType'),
					    'AddressPincode'=>$this->input->post('AddressPincode'),
					    );
            		$data['Data']=$this->mm->insert_data_api($tblname,$insertData);
    	            if(!empty($data['Data']))
            		{
            		    $data['IsSuccess']=true;
    	                $data['Message']="Address added Successfully ";    
            		    $data['Data']=1;
            		}
            		else
            		{
            		    $data['IsSuccess']=true;
    	                $data['Message']="Address not Added "; 
    	                $data['Data']=0;
            		}
    	             
        	
	             
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar add for add default address 07-04-2021
	public function addAddress() //inserting a data in table
	{      
	      try
	      {     
	            //samundar add this code for add default address 07-04-2021
        		$tblname='tbladdress';
        		$cstId=$this->input->post('CustomerId');
	            $where=array(  
        					'CustomerId'=>$cstId,
				);
				$chechAdd=$this->mm->get_a_data($tblname,$where);
				$cntAdd=count($chechAdd);
				if($cntAdd==0)
				{
				     $tblname='tbladdress';
	                    $insertData=array(  
    					'CustomerId'=>$this->input->post('CustomerId'),
					    'AddressHouseNo'=>$this->input->post('AddressHouseNo'),
					    'AddressAppartmentName'=>$this->input->post('AddressAppartmentName'),
					    'AddressStreet'=>$this->input->post('AddressStreet'),
					    'AddressLandmark'=>$this->input->post('AddressLandmark'),
					    'AddressLat'=>$this->input->post('AddressLat'),
					    'AddressLong'=>$this->input->post('AddressLong'),
					    'AddressDefault'=>1,
					    'AddressCityName'=>$this->input->post('AddressCityName'),
					    'AddressArea'=>$this->input->post('AddressArea'),
					    'AddressType'=>$this->input->post('AddressType'),
					    'AddressPincode'=>$this->input->post('AddressPincode'),
					    );
            		$data['Data']=$this->mm->insert_data_api($tblname,$insertData);
    	            if(!empty($data['Data']))
            		{
            		    $data['IsSuccess']=true;
    	                $data['Message']="Address added Successfully ";    
            		    $data['Data']=1;
            		}
            		else
            		{
            		    $data['IsSuccess']=true;
    	                $data['Message']="Address not Added "; 
    	                $data['Data']=0;
            		}
				}
				else
				{
				     $tblname='tbladdress';
	                    $insertData=array(  
    					'CustomerId'=>$this->input->post('CustomerId'),
					    'AddressHouseNo'=>$this->input->post('AddressHouseNo'),
					    'AddressAppartmentName'=>$this->input->post('AddressAppartmentName'),
					    'AddressStreet'=>$this->input->post('AddressStreet'),
					    'AddressLandmark'=>$this->input->post('AddressLandmark'),
					    'AddressLat'=>$this->input->post('AddressLat'),
					    'AddressLong'=>$this->input->post('AddressLong'),
					    'AddressDefault'=>0,
					    'AddressCityName'=>$this->input->post('AddressCityName'),
					    'AddressArea'=>$this->input->post('AddressArea'),
					    'AddressType'=>$this->input->post('AddressType'),
					    'AddressPincode'=>$this->input->post('AddressPincode'),
					    );
            		$data['Data']=$this->mm->insert_data_api($tblname,$insertData);
    	            if(!empty($data['Data']))
            		{
            		    $data['IsSuccess']=true;
    	                $data['Message']="Address added Successfully ";    
            		    $data['Data']=1;
            		}
            		else
            		{
            		    $data['IsSuccess']=true;
    	                $data['Message']="Address not Added "; 
    	                $data['Data']=0;
            		}
				}
			//samundar end
        	/*samundar comment this code for add default address new code 07-04-2021	
        	{
        		        $tblname='tbladdress';
	                    $insertData=array(  
    					'CustomerId'=>$this->input->post('CustomerId'),
					    'AddressHouseNo'=>$this->input->post('AddressHouseNo'),
					    'AddressAppartmentName'=>$this->input->post('AddressAppartmentName'),
					    'AddressStreet'=>$this->input->post('AddressStreet'),
					    'AddressLandmark'=>$this->input->post('AddressLandmark'),
					    'AddressLat'=>$this->input->post('AddressLat'),
					    'AddressLong'=>$this->input->post('AddressLong'),
					    
					    'AddressCityName'=>$this->input->post('AddressCityName'),
					    'AddressArea'=>$this->input->post('AddressArea'),
					    'AddressType'=>$this->input->post('AddressType'),
					    'AddressPincode'=>$this->input->post('AddressPincode'),
					    );
            		$data['Data']=$this->mm->insert_data_api($tblname,$insertData);
    	            if(!empty($data['Data']))
            		{
            		    $data['IsSuccess']=true;
    	                $data['Message']="Address added Successfully ";    
            		    $data['Data']=1;
            		}
            		else
            		{
            		    $data['IsSuccess']=true;
    	                $data['Message']="Address not Added "; 
    	                $data['Data']=0;
            		}
    	             
        		}*/
        	/*	else
        		{
        		        $data['IsSuccess']=true;
    	                $data['Message']="Sorry we can deliver on this address "; 
    	                $data['Data']=0;
            		
        		}*/
	             
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar end
	public function placeOrderMargApi() //inserting a data in table
	{      
	      try
	      {   
            $key='F1S80EM90JP3';
            $ch = curl_init( "https://wservices.margcompusoft.com/api/eOnlineData/MargMST2017");
            $payload = json_encode( array("CompanyCode" => "Bharat2","MargID" => 121921,"Datetime" => "", "index" => 0));
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            if ($err) {
              echo "cURL Error #:" . $err;
                die(); /* Stop execution when error */
            }
            $result = decrypt($key,$response);
            $data =  gzinflate(base64_decode($result));
            if ($data === false) 
                echo 'error'; 
            else 
                echo $data."\n";

	          //$data['Data']=$this->mm->insert_data_api($tblname,$insertData);
	            if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Order Placed Successfully ";    
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Order not Placed Successfully "; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	
	public function getCart() //inserting a data in table
	{      
	      try
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$data['Data']=$this->mm->get_a_data_join($tblname,$where);
        		
        		$arr=(array)($data['Data']);
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"CartPackInfo"))&&isset($value))
            		    {  
            		        $tblname='tblproductdetail';
            	            $where=array(  
                					'ProductdetailId'=>$arr[$i]->CartPackInfo,
            				);
            				$detailData=$this->mm->get_a_data($tblname,$where);
            				//print_r($detailData);
            				$dataFilter[$i]["ProductMRP"]=isset($detailData[0]->ProductdetailMRP)?$detailData[0]->ProductdetailMRP:"";
            			//	$data['Data'][$i]["ProductMRPs"]=isset($detailData[0]->ProductdetailMRP)?$detailData[0]->ProductdetailMRP:"";
                    	}
            		    else
            		         $dataFilter[$i][$key]=$value;
            		}
        		}
        		//$arr=(array)($data['Data']);
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	}
	
	//samu 20-01-2021
	public function getCart_samu() //inserting a data in table
	{      
	      try   
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$data['Data']=$this->mm->get_a_data_join($tblname,$where);
        		
        		$arr=(array)($data['Data']);
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    
                    	//samu
                    	if((strcmp($key,"CartPackInfo"))==0)
            		    {
            		        $productId=$value;
            		        $tblnameInner="tblproductdetail";
                            $whereDataInner=array("tblproductdetail.ProductIdReference"=>$value);
            	            //$productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $dataFilter[$i][$key]=$value;
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $arr2=(array)($productDataDetail);
            	            $dataFilter[$i][$key]=$value;
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            for($j=0;$j<count($arr2);$j++)
                    		{
                        		foreach($arr2[$j] as $key2=>$value2)
                        		{    
                        		    if((strcmp($key2,"ProductdetailImages"))==0)
                        		    {       
                        		            $imageData=explode(",",$value2);
            		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
            		                }
            		                else
            		                        $dataFilter2[$j][$key2]=$value2;
                        		}
                    		}$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    		
            		    }
            		    
                    	
            		}
            		
        		}
        		
        		$arr=(array)($dataFilter);
        		//$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//end
	public function beforePlaceOrder() //inserting a data in table
	{      
	      try
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
			//	$cartData["Cart"]=array();
        		$cartDataFinal=array(json_decode(json_encode(($cartData)),true));
	           
	            /*$tblname='tbl';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$cartData["Cart"]=$this->mm->get_a_data_join($tblname,$where);
        		*/
        		$cartTot= array("Applied"=>$this->input->post('Promocode'),"Message"=>"Promocode Applied Sucessfully");
	            $promoTotData["promocode"]=array(json_decode(json_encode(($cartTot)),true));
	            $promoTotal=array(json_decode(json_encode(($promoTotData)),true));
	           
	           	$cartTot= array("Applied"=>$this->input->post('Points'),"Message"=>"Promocode Applied Sucessfully");
	            $pointTotData["points"]=array(json_decode(json_encode(($cartTot)),true));
	            $pointsTotal=array(json_decode(json_encode(($pointTotData)),true));
	           
	            $cartTot= array("SubTotal","Prormo Code","Points");
	            $subTotDataLeft["subtotalleft"]=array(json_decode(json_encode(($cartTot)),true));
	            $subTotDataLeftFinal=array(json_decode(json_encode(($subTotDataLeft)),true));
	            
	            $cartTot= array("1000","-200","-100");
	            $subTotDataRight["subtotalright"]=array(json_decode(json_encode(($cartTot)),true));
	            $subTotDataRightFinal=array(json_decode(json_encode(($subTotDataRight)),true));
	            
	            $sub[]=array("Key"=>"Subtotal","Value"=>"100");
	            $points[]=array("Key"=>"Points","Value"=>"-10");
	            $total[]=array("Key"=>"Total","Value"=>"90");
	            $tot= array_merge($sub,$points,$total);
	            $totFinal["tot"]=(json_decode(json_encode(($tot)),true));
	            $totFinalF=(json_decode(json_encode(($totFinal)),true));
	            
	            
	            //$arrayFinal=array_merge(array($promoTotal[0]),array($pointsTotal[0]),array($subTotDataLeftFinal[0]),array($subTotDataRightFinal[0]));
	            
	           $arrayFinal=array_merge(array($promoTotal[0]),array($pointsTotal[0]),array($totFinalF));
	           
	            $arrayFinal=$arrayFinal;
	            $data['Data']=$arrayFinal;
	            $arr=($data['Data']);
        		
        	
        		//$arr=(array)($data['Data']);
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function beforePlaceOrderTest() //inserting a data in table
	{      
	      try
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$cartData["Cart"]=$this->mm->get_a_data_join($tblname,$where);
        		$cartDataFinal=array(json_decode(json_encode(($cartData)),true));
	            
	            $total=0;
	            $subTotal=0;
	            $save=0;
	            $arr=(array)($cartData["Cart"]);
        		$dataFilter=array();
        		$ProductSRP;
        		$ProductMRP;
        		$dataFilter["Cart"]=array();
        		//print_r($arr);
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    //kd product update for cart detail -pack info  removed  3/28/2021
            		         $dataFilter["Cart"][$i][$key]=$value;
            		  
                    }
                    $ProductSRP=$dataFilter["Cart"][$i]['PurchasedetailProductSrp'];
    		        $ProductMRP=$dataFilter["Cart"][$i]['PurchasedetailProductMrp'];
    		        $CartQty=$dataFilter["Cart"][$i]['CartQuantity'];
    		        
    		        $total=$total+(int)$ProductSRP*(int)$CartQty;
    		        $save=$save+((int)$ProductMRP-(int)$ProductSRP)*(int)$CartQty;
    	            
                }
        		
	            $cartTot= array("Total"=>$total,"Save"=>$save);
	            $totData["carttotal"]=array(json_decode(json_encode(($cartTot)),true));
	            $cartTotal=array(json_decode(json_encode(($totData)),true));
	           
	           
        		$cartTot= array("Applied"=>$this->input->post('Promocode'),"Message"=>"Promocode Applied Sucessfully");
	            $promoTotData["promocode"]=array(json_decode(json_encode(($cartTot)),true));
	            $promoTotal=array(json_decode(json_encode(($promoTotData)),true));
	           
	           	$cartTot= array("Applied"=>$this->input->post('Points'),"Message"=>"Promocode Applied Sucessfully");
	            $pointTotData["points"]=array(json_decode(json_encode(($cartTot)),true));
	            $pointsTotal=array(json_decode(json_encode(($pointTotData)),true));
	           
	            $cartTot= array("SubTotal","Prormo Code","Points");
	            $subTotDataLeft["subtotalleft"]=array(json_decode(json_encode(($cartTot)),true));
	            $subTotDataLeftFinal=array(json_decode(json_encode(($subTotDataLeft)),true));
	            
	            /*$cartTot= array("1000","-200","-100");
	            $subTotDataRight["subtotalright"]=array(json_decode(json_encode(($cartTot)),true));
	            $subTotDataRightFinal=array(json_decode(json_encode(($subTotDataRight)),true));
	            */
	           // SELECT `ShippingCharge` FROM `tbldeliverycharge` WHERE `ProductPriceRange` <= 1000 order by `ShippingCharge` ASC LIMIT 1 
                
                
	            $shippingData=convert_object_arraY($this->mm->custom_query("SELECT `DeliverychargeShippingCharge` FROM `tbldeliverycharge` WHERE `DeliverychargeProductPriceRange` <= $total order by `DeliverychargeShippingCharge` ASC LIMIT 1 "));
               // print_r($shippingData);
               for($i=0;$i<sizeof($shippingData);$i++)
               {
	             foreach($shippingData as $key=>$value)
	             {
	                $d_charge=$shippingData[$i]["DeliverychargeShippingCharge"];
	             }
	           }
	            $sub[]=array("Text1"=>"Subtotal","Text2"=>"","Text3"=>$total);
	            $deliveryCharge[]=array("Text1"=>"Shipping Charge","Text2"=>"","Text3"=>$d_charge);
	            $total=$total+$d_charge;
	            $totVal[]=array("Text1"=>"Totals","Text2"=>'',"Text3"=>$total);
	            
	            //$points[]=array("Key"=>"Points","Value"=>"-10");
	           // $points[]=array();
	            $tot= array_merge($sub,$deliveryCharge,$totVal);
	            
	            $totFinal["tot"]=(json_decode(json_encode(($tot)),true));
	            $totFinalF=(json_decode(json_encode(($totFinal)),true));
	            
	            //samudar 25-01-2021
	            
	            $Total[]=array("total"=>$total);
	            $totFinal["Total"]=(json_decode(json_encode(($Total)),true));
	            $totFinalF=(json_decode(json_encode(($totFinal)),true));
	            //end
	            //$arrayFinal=array_merge(array($promoTotal[0]),array($pointsTotal[0]),array($subTotDataLeftFinal[0]),array($subTotDataRightFinal[0]));
	            
	           $arrayFinal=array_merge(array($promoTotal[0]),array($pointsTotal[0]),array($totFinalF));
	           
	            $arrayFinal=$arrayFinal;
	            $data['Data']=$arrayFinal;
	            $arr=($data['Data']);
        		
        	
        		//$arr=(array)($data['Data']);
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	
	//samundar add API for remove packinfo for beforePlaceOrderTest 18-03-2021
	public function beforePlaceOrderTestNew() //inserting a data in table
	{      
	      try
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$cartData["Cart"]=$this->mm->get_a_data_join($tblname,$where);
        		$cartDataFinal=array(json_decode(json_encode(($cartData)),true));
	            
	            $total=0;
	            $subTotal=0;
	            $save=0;
	            $arr=(array)($cartData["Cart"]);
        		$dataFilter=array();
        		$ProductSRP;
        		$ProductMRP;
        		$dataFilter["Cart"]=array();
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        if(!empty($value))
            		        {
            		            $productId=$value;
                		        $tblnameInner="tblproduct";
                                $whereDataInner=array("tblproduct.ProductId"=>$value);
                	            $productDataDetail=$this->mm->get_a_data($tblnameInner,$whereDataInner);
                	            
                	            //print_r($productDataDetail[0]->ProductdetailSRP);
                	            $dataFilter["Cart"][$i][$key]=$value;
                	            $dataFilter["Cart"][$i]["PackInfo"]=($productDataDetail);
                	            $ProductSRP=$productDataDetail[0]->ProductSrp;
                	            $ProductMRP=$productDataDetail[0]->ProductMrp;
                	            
            		        }
            		    }
            		    else if((strcmp($key,"CartQuantity"))==0)
            		    { $dataFilter["Cart"][$i][$key]=$value;
            		      //  $total=$total+(int)$ProductSRP*(int)$value;
            		        $total=$total+(int)$ProductSRP*(int)$value;
            		        $save=$save+((int)$ProductMRP-(int)$ProductSRP)*(int)$value;
            		        $subTotal=$total+(int)$ProductMRP*(int)$value;
            		        
            		    }
            		    else
            		         $dataFilter["Cart"][$i][$key]=$value;
            		}
        		}
        		
	            $cartTot= array("Total"=>$total,"Save"=>$save);
	            $totData["carttotal"]=array(json_decode(json_encode(($cartTot)),true));
	            $cartTotal=array(json_decode(json_encode(($totData)),true));
	           
	           
        		$cartTot= array("Applied"=>$this->input->post('Promocode'),"Message"=>"Promocode Applied Sucessfully");
	            $promoTotData["promocode"]=array(json_decode(json_encode(($cartTot)),true));
	            $promoTotal=array(json_decode(json_encode(($promoTotData)),true));
	           
	           	$cartTot= array("Applied"=>$this->input->post('Points'),"Message"=>"Promocode Applied Sucessfully");
	            $pointTotData["points"]=array(json_decode(json_encode(($cartTot)),true));
	            $pointsTotal=array(json_decode(json_encode(($pointTotData)),true));
	           
	            $cartTot= array("SubTotal","Prormo Code","Points");
	            $subTotDataLeft["subtotalleft"]=array(json_decode(json_encode(($cartTot)),true));
	            $subTotDataLeftFinal=array(json_decode(json_encode(($subTotDataLeft)),true));
	            
	            /*$cartTot= array("1000","-200","-100");
	            $subTotDataRight["subtotalright"]=array(json_decode(json_encode(($cartTot)),true));
	            $subTotDataRightFinal=array(json_decode(json_encode(($subTotDataRight)),true));
	            */
	           // SELECT `ShippingCharge` FROM `tbldeliverycharge` WHERE `ProductPriceRange` <= 1000 order by `ShippingCharge` ASC LIMIT 1 
                
                
	            $shippingData=convert_object_arraY($this->mm->custom_query("SELECT `DeliverychargeShippingCharge` FROM `tbldeliverycharge` WHERE `DeliverychargeProductPriceRange` <= $total order by `DeliverychargeShippingCharge` ASC LIMIT 1 "));
               // print_r($shippingData);
               for($i=0;$i<sizeof($shippingData);$i++)
               {
	             foreach($shippingData as $key=>$value)
	             {
	                $d_charge=$shippingData[$i]["DeliverychargeShippingCharge"];
	             }
	           }
	            $sub[]=array("Text1"=>"Subtotal","Text2"=>"","Text3"=>$total);
	            $deliveryCharge[]=array("Text1"=>"Shipping Charge","Text2"=>"","Text3"=>$d_charge);
	            $total=$total+$d_charge;
	            $totVal[]=array("Text1"=>"Totals","Text2"=>'',"Text3"=>$total);
	            
	            //$points[]=array("Key"=>"Points","Value"=>"-10");
	           // $points[]=array();
	            $tot= array_merge($sub,$deliveryCharge,$totVal);
	            
	            $totFinal["tot"]=(json_decode(json_encode(($tot)),true));
	            $totFinalF=(json_decode(json_encode(($totFinal)),true));
	            
	            //samudar 25-01-2021
	            
	            $Total[]=array("total"=>$total);
	            $totFinal["Total"]=(json_decode(json_encode(($Total)),true));
	            $totFinalF=(json_decode(json_encode(($totFinal)),true));
	            //end
	            //$arrayFinal=array_merge(array($promoTotal[0]),array($pointsTotal[0]),array($subTotDataLeftFinal[0]),array($subTotDataRightFinal[0]));
	            
	           $arrayFinal=array_merge(array($promoTotal[0]),array($pointsTotal[0]),array($totFinalF));
	           
	            $arrayFinal=$arrayFinal;
	            $data['Data']=$arrayFinal;
	            $arr=($data['Data']);
        		
        	
        		//$arr=(array)($data['Data']);
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar end
    public function getCartTestOld() //inserting a data in table
	{      
	      try
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$cartData["Cart"]=$this->mm->get_a_data_join($tblname,$where);
        		$cartDataFinal=array(json_decode(json_encode(($cartData)),true));
	            
	            $total=0;
	            $arr=(array)($cartData["Cart"]);
        		$dataFilter=array();
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"ProductSrp"))==0)
            		    {   $total=$total+(int)$value;
            		        //$dataFilter[$i]['Data'][$key]=$imageData;
            		    }/*
            		    else
            		         $dataFilter[$i]['Data'][$key]=$value;*/
            		}
        		}
	            $cartTot= array("Total"=>$total,"Save"=>"");
	            $totData["carttotal"]=array(json_decode(json_encode(($cartTot)),true));
	            $cartTotal=array(json_decode(json_encode(($totData)),true));
	           
	            
	            $arrayFinal=array_merge(array($cartDataFinal[0]),array($cartTotal[0]));
	           
	           $arrayFinal=$arrayFinal;
	            $data['Data']=$arrayFinal;
	            $arr=($data['Data']);
        		if(!empty($arr))
        		
                
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		    $data['Data']=$arrayFinal;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
          catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
            }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function getCartTestOldsamu() //inserting a data in table
	{      
	      try
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$cartData["Cart"]=$this->mm->get_a_data_join($tblname,$where);
        		$cartDataFinal=array(json_decode(json_encode(($cartData)),true));
	            
	            $total=0;
	            $save=0;
	            $arr=(array)($cartData["Cart"]);
        		$dataFilter=array();
        		$ProductSRP=0;
        		$ProductMRP=0;
        		$dataFilter["Cart"]=array();
        	//	print_r($arr);
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    //kd product update for cart detail -pack info  removed  3/28/2021
            		    if((strcmp($key,"ProductImages"))==0)
            		    {       
            		            $imageData=explode(",",$value);
		                        $dataFilter['Cart'][$i][$key]=(json_decode(json_encode(($imageData)),true));
		                }
		                
            		    else
            		         $dataFilter["Cart"][$i][$key]=$value;
            		         
		              
                    }
                    $ProductSRP=$dataFilter["Cart"][$i]['ProductSrp'];
    		        $ProductMRP=$dataFilter["Cart"][$i]['ProductMrp'];
    		        $CartQty=$dataFilter["Cart"][$i]['CartQuantity'];
    		        
    		        $total=$total+(int)$ProductSRP*(int)$CartQty;
    		        $save=$save+((int)$ProductMRP-(int)$ProductSRP)*(int)$CartQty;
    	            
                }
                $cartTot= array("Total"=>$total,"Save"=>$save);
	            $totData["carttotal"]=array(json_decode(json_encode(($cartTot)),true));
	            $cartTotal=array(json_decode(json_encode(($totData)),true));
	           
	           $dataFilter=array(json_decode(json_encode(($dataFilter)),true));
	            //before
	            //$arrayFinal=array_merge(array($cartDataFinal[0]),array($cartTotal[0]));
	            //after 21/11/2020
	            $arrayFinal=array_merge(($dataFilter),array($cartTotal[0]));
	           
	           $arrayFinal=$arrayFinal;
	            $data['Data']=$arrayFinal;
	            $arr=($data['Data']);
        		if(!empty($arr))
        		
                
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		    $data['Data']=$arrayFinal;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	
	//samundar change this api for purachedetail data 06-04-2021
	public function getCartTest() //inserting a data in table
	{      
	      try
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$cartData["Cart"]=$this->mm->get_a_data_join($tblname,$where);
        		$cartDataFinal=array(json_decode(json_encode(($cartData)),true));
	           // print_r($cartData);
	            
	            $total=0;
	            $save=0;
	            $arr=(array)($cartData["Cart"]);
        		$dataFilter=array();
        		$ProductSRP=0;
        		$ProductMRP=0;
        		$dataFilter["Cart"]=array();
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    //kd product update for cart detail -pack info  removed  3/28/2021
            		    /*if((strcmp($key,"ProductImages"))==0)
            		    {       
            		            $imageData=explode(",",$value);
		                        $dataFilter['Cart'][$i][$key]=(json_decode(json_encode(($imageData)),true));
		                }
		                
            		    else*/
            		         $dataFilter["Cart"][$i][$key]=$value;
            		         
		              
                    }//print_r($dataFilter);
                    $ProductSRP=$dataFilter["Cart"][$i]['PurchasedetailProductSrp'];
    		        $ProductMRP=$dataFilter["Cart"][$i]['PurchasedetailProductMrp'];
    		        $CartQty=$dataFilter["Cart"][$i]['CartQuantity'];
    		        
    		        $total=$total+(int)$ProductSRP*(int)$CartQty;
    		        $save=$save+((int)$ProductMRP-(int)$ProductSRP)*(int)$CartQty;
    	            
                }
                $cartTot= array("Total"=>$total,"Save"=>$save);
	            $totData["carttotal"]=array(json_decode(json_encode(($cartTot)),true));
	            $cartTotal=array(json_decode(json_encode(($totData)),true));
	           
	           $dataFilter=array(json_decode(json_encode(($dataFilter)),true));
	            //before
	            //$arrayFinal=array_merge(array($cartDataFinal[0]),array($cartTotal[0]));
	            //after 21/11/2020
	            $arrayFinal=array_merge(($dataFilter),array($cartTotal[0]));
	           
	           $arrayFinal=$arrayFinal;
	            $data['Data']=$arrayFinal;
	            $arr=($data['Data']);
        		if(!empty($arr))
        		
                
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		    $data['Data']=$arrayFinal;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar end
	public function getCartTotal() //inserting a data in table
	{      
	      try
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$cartData["Cart"]=$this->mm->get_a_data_join($tblname,$where);
        		$cartDataFinal=array(json_decode(json_encode(($cartData)),true));
	            
	            $total=0;
	            $save=0;
	            $arr=(array)($cartData["Cart"]);
        		$dataFilter=array();
        		$ProductSRP=0;
        		$ProductMRP=0;
        		$dataFilter["Cart"]=array();
        	//	print_r($arr);
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    //kd product update for cart detail -pack info  removed  3/28/2021
            		         $dataFilter["Cart"][$i][$key]=$value;
            	    }
                    $ProductSRP=$dataFilter["Cart"][$i]['PurchasedetailProductSrp'];
    		        $ProductMRP=$dataFilter["Cart"][$i]['PurchasedetailProductMrp'];
    		        $CartQty=$dataFilter["Cart"][$i]['CartQuantity'];
    		        
    		        $total=$total+(int)$ProductSRP*(int)$CartQty;
    		        $save=$save+((int)$ProductMRP-(int)$ProductSRP)*(int)$CartQty;
    	            
                }
                $cartTot= array("Total"=>$total,"Save"=>$save);
	            $totData=array(json_decode(json_encode(($cartTot)),true));
	            $cartTotal=array(json_decode(json_encode(($totData)),true));
	           
	           $dataFilter=array(json_decode(json_encode(($dataFilter)),true));
	            //before
	            //$arrayFinal=array_merge(array($cartDataFinal[0]),array($cartTotal[0]));
	            //after 21/11/2020
	            $arrayFinal=($cartTotal[0]);
	           
	           $arrayFinal=$arrayFinal;
	            $data['Data']=$arrayFinal;
	            $arr=($data['Data']);
        		if(!empty($arr))
        		
                
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		    $data['Data']=$arrayFinal;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar add new api for getcart data 17-03-2021
	public function getCartTestNew() //inserting a data in table
	{      
	      try
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$cartData["Cart"]=$this->mm->get_a_data_join($tblname,$where);
        		$cartDataFinal=array(json_decode(json_encode(($cartData)),true));
	            
	            $total=0;
	            $save=0;
	            $arr=(array)($cartData["Cart"]);
        		$dataFilter=array();
        		$dataFilter2=array();
        		$ProductSRP;
        		$ProductMRP;
        		$dataFilter["Cart"]=array();
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        if(!empty($value))
            		        {
            		            $productId=$value;
            		           
                		        $tblname="tblproduct";
                		        $where=array(  
    					                    'tblproduct.ProductId'=>$value,
				                );
                	            $productDataDetail=$this->mm->get_a_data($tblname,$where);
                	            
                	            $dataFilter["Cart"][$i][$key]=$value;
                	           // $dataFilter["Cart"][$i]["PackInfo"]=($productDataDetail);
                    	        
                    	        $arr2=(array)($productDataDetail);
                	            /*for($j=0;$j<count($arr2);$j++)
                        		{
                            		foreach($arr2[$j] as $key2=>$value2)
                            		{    
                            		    if((strcmp($key2,"ProductImages"))==0)
                            		    {       
                            		            $imageData=explode(",",$value2);
                		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
                		                }
                		                else
                		                        $dataFilter2[$j][$key2]=$value2;
                            		}
                        		}
                        		$dataFilter["Cart"][$i]["PackInfo"]=($dataFilter2);*/
                    	        //print_r($dataFilter2);
                        		//$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    	       
                	            $ProductSRP=$productDataDetail[0]->ProductSrp;
                	            $ProductMRP=$productDataDetail[0]->ProductMrp;
            		        }
            		    }
            		    else if((strcmp($key,"CartQuantity"))==0)
            		    { $dataFilter["Cart"][$i][$key]=$value;
            		        $total=$total+(int)$ProductSRP*(int)$value;
            		        $save=$save+((int)$ProductMRP-(int)$ProductSRP)*(int)$value;
            		    }
            		    else
            		         $dataFilter["Cart"][$i][$key]=$value;
            		}
        		}
	            $cartTot= array("Total"=>$total,"Save"=>$save);
	            $totData["carttotal"]=array(json_decode(json_encode(($cartTot)),true));
	            $cartTotal=array(json_decode(json_encode(($totData)),true));
	           
	           $dataFilter=array(json_decode(json_encode(($dataFilter)),true));
	            //before
	            //$arrayFinal=array_merge(array($cartDataFinal[0]),array($cartTotal[0]));
	            //after 21/11/2020
	            $arrayFinal=array_merge(($dataFilter),array($cartTotal[0]));
	           
	           $arrayFinal=$arrayFinal;
	            $data['Data']=$arrayFinal;
	            $arr=($data['Data']);
        		if(!empty($arr))
        		
                
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		    $data['Data']=$arrayFinal;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar end
	//samundar add new api for getcartTotal data 18-03-2021
	public function getCartTotalNew() //inserting a data in table
	{      
	      try
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$cartData["Cart"]=$this->mm->get_a_data_join($tblname,$where);
        		$cartDataFinal=array(json_decode(json_encode(($cartData)),true));
	            //print_r($cartDataFinal);
	            $total=0;
	            $save=0;
	            $arr=(array)($cartData["Cart"]);
        		$dataFilter=array();
        		$ProductSRP=0;
        		$ProductMRP=0;
        		$dataFilter["Cart"]=array();
        	//	print_r($arr);
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        if(!empty($value))
            		        {
            		            $productId=$value;
            		           // print_r($productId);
                		        $tblnameInner="tblproduct";
                                $whereDataInner=array("tblproduct.ProductId"=>$value);
                	            $productDataDetail=$this->mm->get_a_data($tblnameInner,$whereDataInner);
                	           
                	            /*print_r($productDataDetail[0]->ProductSrp);
                	            print_r($productDataDetail[0]->ProductMrp);*/
                	            $dataFilter["Cart"][$i][$key]=$value;
                	            $dataFilter["Cart"][$i]["PackInfo"]=($productDataDetail);
                	            $ProductMRP=$productDataDetail[0]->ProductMrp;
                	            $ProductSRP=$productDataDetail[0]->ProductSrp;
                	            
            		        }
            		    }
            		    else if((strcmp($key,"CartQuantity"))==0)
            		    { $dataFilter["Cart"][$i][$key]=$value;
            		        $total=$total+(int)$ProductSRP*(int)$value;
            		       //$total=100;
            		        $save=$save+((int)$ProductMRP-(int)$ProductSRP)*(int)$value;
            		    }
            		    else
            		         $dataFilter["Cart"][$i][$key]=$value;
            		}
        		}
	            $cartTot= array("Total"=>$total,"Save"=>$save);
	            $totData=array(json_decode(json_encode(($cartTot)),true));
	            $cartTotal=array(json_decode(json_encode(($totData)),true));
	           
	           $dataFilter=array(json_decode(json_encode(($dataFilter)),true));
	            //before
	            //$arrayFinal=array_merge(array($cartDataFinal[0]),array($cartTotal[0]));
	            //after 21/11/2020
	            $arrayFinal=($cartTotal[0]);
	           
	           $arrayFinal=$arrayFinal;
	            $data['Data']=$arrayFinal;
	            $arr=($data['Data']);
        		if(!empty($arr))
        		
                
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		    $data['Data']=$arrayFinal;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar end
	
	/*public function getCartTotal() //inserting a data in table
	{      
	      try
	      {     $tblname='tblcart';
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				$cartData["Cart"]=$this->mm->get_a_data_join($tblname,$where);
        		$data['Data']= array("Total"=>"1000","Save"=>25);
	            
	            $arr=($data['Data']);
        		if(!empty($arr))
        		
                
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Cart Data Found";    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}*/
	public function getAddress() //inserting a data in table
	{      
	      try
	      {    $tblname='tbladdress';
	            $where=array(  
    					'CustomerId'=>$this->input->post('CustomerId'),
				);
				
				$data['Data']=$this->mm->get_a_data($tblname,$where);
        		$arr=(array)($data['Data']);
        		
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address not Added please add address firt "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function getOffer() //inserting a data in table
	{      
	      try
	      {     $tblname="tbloffer";
                $data['Data']=$this->mm->get_all_data_join($tblname);
	            $arr=(array)($data['Data']);
        		
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address not Added please add address firt "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function getCity() //inserting a data in table
	{      
	      try
	      {   
	          
	          $bannerData=array("Surat","Mumbai");
	          $data['Data']=(json_decode(json_encode(($bannerData)),true));
	             
	          $arr=(array)($data['Data']);
        		
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address not Added please add address firt "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function getAddressTest() //inserting a data in table
	{      
	      try
	      {    $tblname='tbladdress';
	            $where=array(  
    					'CustomerId'=>$this->input->post('CustomerId'),
				);
				$whereData=$this->mm->get_a_data($tblname,$where);
        		
        		$arr=(array)($data['Data']);
        		
        		$cityName="Surat,Mumbai";
        		foreach($arr[0] as $key=>$value)
        		{    
        		    if((strcmp($key,"AddressCity"))==0)
        		    {   $imageData=explode(",",$cityName);
        		        $dataFilter['Data'][$key]=$imageData;
        		    }
        		    else
        		         $dataFilter['Data'][$key]=$value;
        		}
        		//before
        	    //	$arrData=(array)($arr[0]);
        		//after
        		$arrData=(array)($dataFilter['Data']);
        		
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address not Added please add address firt "; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function getBonusPoint() //inserting a data in table
	{      
	      try
	      {     $tblname='tblbonus';
	            $where=array(  
    					'tblbonus.CustomerId'=>$this->input->post('CustomerId'),
				);
				$data['Data']=$this->mm->get_a_data_join($tblname,$where);
        		$arr=(array)($data['Data']);
        		
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Bonus Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Bonus Found"; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function getSetting() //inserting a data in table
	{      
	      try
	      {     $settingData=array(
                        /*"BaseUrl"=>"https://webnappmaker.in/Surti/resources/images/",
                        "SettingWhatsAppNumber"=>"0000000000",
				        "SettingPhoneNumber"=>"0000000000",
				        "SettingTermsKnowMore"=>"Hello",
				        "SettingShareLink"=>"https://webnappmaker.in/Balaji/resources/images/",
				        "SettingEmailId"=>"admin@balaji.com",
				        "SettingTermsKnowMore"=>"Balaji Wholesale Bazaar is very well known in wholesaling textile products to retailers. We get all the quality products at lower prices from good manufacturers from all across India and sell them with very low margins which benefit retailers.",
				        "SettingWhatsAppMessage"=>"hello",
				        "SettingAddress"=>"310-311 Raghuvir Symphony, Althan Canal Rd, opp. Green Victory, Surat, Gujarat 395007",
				        "SettingFAQ"=>"https://webnappmaker.in/Balaji/resources/html/terms.html",
                        "SettingShowReedemPoints"=>true,
                        "SettingShowPromocode"=>true,
                        "SettingShowOnlinePayment"=>false,
                        "SettingTermsConditionURL"=>"https://webnappmaker.in/Balaji/resources/html/terms.html",
				        "SettingAboutUsURL"=>"https://webnappmaker.in/Balaji/resources/html/aboutus.html",*/
				        
				        //samundar add new setting for medi app 12-03-2021
				        "BaseUrl"=>"https://webnappmaker.in/MediApp2/resources/images/",
                        "SettingWhatsAppNumber"=>"0000000000",
				        "SettingPhoneNumber"=>"0000000000",
				        "SettingTermsKnowMore"=>"Hello",
				        "SettingShareLink"=>"https://webnappmaker.in/MediApp2/resources/images/",
				        "SettingEmailId"=>"admin@mediapp2.com",
				        "SettingTermsKnowMore"=>"Mediapp is very well known in wholesaling medicine products to retailers and Doctor's. We get all the quality products at lower prices from good manufacturers from all across India and sell them with very low margins which benefit retailers.",
				        "SettingWhatsAppMessage"=>"hello",
				        "SettingAddress"=>"310-311 Raghuvir Symphony, Althan Canal Rd, opp. Green Victory, Surat, Gujarat 395007",
				        "SettingFAQ"=>"https://webnappmaker.in/MediApp2/resources/html/terms.html",
                        "SettingShowReedemPoints"=>true,
                        "SettingShowPromocode"=>true,
                        "SettingShowOnlinePayment"=>false,
                        "SettingTermsConditionURL"=>"https://webnappmaker.in/MediApp2/resources/html/terms.html",
				        "SettingAboutUsURL"=>"https://webnappmaker.in/MediApp2/html/aboutus.html",
				        //samundar end
			    );
        		$data['Data']=array(json_decode(json_encode(($settingData)),true));
        		$arr=(array)($data['Data']);
        		
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Setting Found";    
        		    $data['Data']=$arr;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Setting not found"; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function checkPincode() //inserting a data in table
	{      
	      try
	      {     $tblname='tblpincode';
	            $where=array(  
        					'PincodeNo'=>$this->input->post('PincodeNo'),
				);
				
				$data['Data']=$this->mm->get_a_data($tblname,$where);
        		$arr=(array)($data['Data']);
        		
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Data Found";    
        		    $data['Data']=$arr;
        		}   
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="We don't deliver "; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function checkPromocode() //inserting a data in table
	{      
	      try
	      {    $tblname='tblpromocode';
	            $where=array(  
        					'Promocode'=>$this->input->post('Promocode'),
				);
				
				$data['Data']=$this->mm->get_a_data($tblname,$where);
        		$arr=(array)($data['Data']);
        		
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Data Found";    
        		    $data['Data']=$arr;
        		}   
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Data not found "; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function updateAddress() //inserting a data in table
	{      
	      try
	      {    $tblname='tbladdress';
	            $where=array(  
    			  'AddressId'=>$this->input->post('AddressId'),
					    
				);
				$updateData=array(  
    				    'AddressHouseNo'=>$this->input->post('AddressHouseNo'),
					    'AddressAppartmentName'=>$this->input->post('AddressAppartmentName'),
					    'AddressStreet'=>$this->input->post('AddressStreet'),
					    'AddressLandmark'=>$this->input->post('AddressLandmark'),
					    'AddressCityName'=>$this->input->post('AddressCityName'),
					    'AddressLat'=>$this->input->post('AddressLat'),
					    'AddressLong'=>$this->input->post('AddressLong'),
					    'AddressArea'=>$this->input->post('AddressArea'),
					    'AddressType'=>$this->input->post('AddressType'),
					    'AddressPincode'=>$this->input->post('AddressPincode'),
					   
        		);
        		$data['Data']=$this->mm->update_data_api($tblname,$updateData,$where);
        		$arr=(array)($data['Data']);
				
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address Updated";    
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address not Updated "; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function deleteAddress()
	{      
	      try
	      {    $tblname='tbladdress';
	            $whereData=array(  
    					'AddressId'=>$this->input->post('AddressId')
					);
        		$data['Data']=$this->mm->delete_data_api($tblname,$whereData);
	            if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address Deleted Successfully ";
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address Deleted Cart Un-Successfully"; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	
	public function removeCart($name = '',$detailArray='')
	{      
	      try
	      {    $tblname='tblcart';
	            $whereData=array(  
    					'CartId'=>$this->input->post('CartId')
					);
        		$data['Data']=$this->mm->delete_data_api($tblname,$whereData);
	            if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Product Removed From Cart Successfully ";
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Product Removed From Cart Un-Successfully"; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function updateCartQty($name = '',$detailArray='')  //inserting a data in table
	{      
	      try
	      {    $tblname='tblcart';
	            $whereData=array(  
    					'CartId'=>$this->input->post('CartId'),
				);
				$mainData=array(
				       'CartQuantity'=>$this->input->post('CartQuantity'),
					 );
        		$data['Data']=$this->mm->update_data_api($tblname,$mainData,$whereData);    
	            if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Quantity Updated Successfully ";    
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Quantity Updated Un-Successfully "; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar add for update cart qty 07-04-2021
	public function updateCartQtysamu($name = '',$detailArray='')  //inserting a data in table
	{      
	      try
	      {    
	          $tblname='tblcart';
	          $cartqty=0;
	          $proTolQty=0;
	          $cartqty=$this->input->post('CartQuantity');
	            $where=array(  
    					'CartId'=>$this->input->post('CartId'),
				);
				$cartData=$this->mm->get_a_data_join($tblname,$where);
				/*print_r($cartData);
				die();*/
	            $proTolQty=$cartData[0]->PurchasedetailProductQty;
	            $cartoldqty=$cartData[0]->CartQuantity;
	            $tot=$proTolQty - $cartqty;
	            
	            if($cartoldqty==$proTolQty)
	            {
	                $btn='false';
	            }
	            else
	            {
	                $btn='ture';
	            }
	            $dataFilter=array();
	          $cartTot= array("Add More"=>$btn,"Qty Message"=>'only left '.$tot);
	         /* $totData=array(json_decode(json_encode(($cartTot)),true));
	          $cartTotal=array(json_decode(json_encode(($totData)),true));
	          $dataFilter=array(json_decode(json_encode(($cartTotal)),true));*/
	          print_r($dataFilter);
	          die();
	          $tblname='tblcart';
	            $whereData=array(  
    					'CartId'=>$this->input->post('CartId'),
				);
				$mainData=array(
				       'CartQuantity'=>$this->input->post('CartQuantity'),
					 );
        		$data['Data']=$this->mm->update_data_api($tblname,$mainData,$whereData);    
	            if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Quantity Updated Successfully ";    
        		    $data['Data']=1;
        		    $samu['message']=$dataFilter;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Quantity Updated Un-Successfully "; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar end
	//Mobile App API Stop
	public function get_a_data_api($tblName,$id,$tagName='',$key='',$uniqueId='')
	{
	        $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	        $whereData=array($tblName.".".$tableIdName=>$id);
	        $arrayData=array();
	        $jsonData=$this->mm->get_a_data_join($tblName,$whereData);
            echo $data=json_encode($jsonData);
	}
	public function get_company_detail()
	{
			$tblName="tblcompany";
			$id=$this->session->CompanyId;
			$tableIdName=ucfirst(remove("tbl",$tblName)."Id");
			$whereData=array($tblName.".".$tableIdName=>$id);
			$arrayData=array();
			$jsonData=$this->mm->get_a_data_join($tblName,$whereData);
			echo $data=json_encode($jsonData);
	}
	public function get_trending_product_api()
	{
	       //kd
            try
	         { 
	            $tblname='tblproduct';
	            $where=array(  
    					'ProductFeaturedYesNoRadio'=>0
        		);
        		//print_r($where);
        		
        		$data['Data']=$this->mm->get_a_data_join($tblname,$where);
        		$where=array(  
    					'tblcustomer.CustomerId'=>$this->input->post("CustomerId"),
    					'tblproduct.ProductId'=>$this->input->post("ProductId"),
        		);
        		$tblname="tblcart";
        		$dataPro['proData']['isCart']=$data['Data']['isCart']=empty($this->mm->get_a_data_join($tblname,$where))?false:true;
        		$tblname="tblwishlist";
        		$dataPro['proData']['isFav']=$data['Data']['isFav']=empty($this->mm->get_a_data_join($tblname,$where))?false:true;
        		
        		
        		
        		
        		$arr=(array)($data['Data']);
        		
        		foreach($arr[0] as $key=>$value)
        		{    
        		    if((strcmp($key,"ProductImages"))==0)
        		    {   $imageData=explode(",",$value);
        		        $dataFilter['Data'][$key]=$imageData;
        		    }
        		    else
        		         $dataFilter['Data'][$key]=$value;
        		}
        		//before
        	    //	$arrData=(array)($arr[0]);
        		//after
        		$arrData=(array)($dataFilter['Data']);
        		$arrData2['isFav']=array("isFav"=>$data['Data']['isFav']);
        		$arrData3=array("isCart"=>$data['Data']['isCart']);
        		$mainData=array_merge($arrData,$dataPro['proData']);
        		//$data['Data']=(object)$mainData;
        		
        		$data['Data']=array($mainData);
        		
        		/*foreach($arr as $key->$data)
        		{
        		    echo $key;
        		}*/
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Detail  Found";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	//get Get product detail by customer id
	public function getProductDetailByCustomerId()
	{
	       //kd
            try
	         {  
	            $tblname='tblproduct';
	        	$where=array(  
    					'ProductId'=>$this->input->post("ProductId")
        		);
	        	//print_r($where);
        		$data['Data']=$this->mm->get_a_data_join($tblname,$where);
        		$where=array(  
    					'tblcustomer.CustomerId'=>$this->input->post("CustomerId"),
    					'tblproduct.ProductId'=>$this->input->post("ProductId"),
        		);
        		$tblname="tblcart";
        		$dataPro['proData']['isCart']=$data['Data']['isCart']=empty($this->mm->get_a_data_join($tblname,$where))?false:true;
        		$tblname="tblwishlist";
        		$dataPro['proData']['isFav']=$data['Data']['isFav']=empty($this->mm->get_a_data_join($tblname,$where))?false:true;
        		
        		
        		
        		
        		$arr=(array)($data['Data']);
        		
        		foreach($arr[0] as $key=>$value)
        		{    
        		    if((strcmp($key,"ProductImages"))==0)
        		    {   $imageData=explode(",",$value);
        		        $dataFilter['Data'][$key]=$imageData;
        		    }
        		    else
        		         $dataFilter['Data'][$key]=$value;
        		}
        		//before
        	    //	$arrData=(array)($arr[0]);
        		//after
        		$arrData=(array)($dataFilter['Data']);
        		$arrData2['isFav']=array("isFav"=>$data['Data']['isFav']);
        		$arrData3=array("isCart"=>$data['Data']['isCart']);
        		$mainData=array_merge($arrData,$dataPro['proData']);
        		//$data['Data']=(object)$mainData;
        		
        		$data['Data']=array($mainData);
        		/*foreach($arr as $key->$data)
        		{
        		    echo $key;
        		}*/
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Detail  Found";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	
	//api
	public function getDashboardData()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblbanner";
                $whereData=array("TypeofbannerName"=>"Home");
	            $bannerData['Banner']=$this->mm->get_a_data_join($tblname,$whereData);
	            $bannerDataFinal=array(json_decode(json_encode(($bannerData)),true));
	            
	            $tblname="tblcategory";
                $categoryData['Category']=$this->mm->get_all_data_join($tblname);
	            $categoryDataFinal=array(json_decode(json_encode(($categoryData)),true));
	            
	            $tblname="tbloffer";
                $offerData['Offer']=$this->mm->get_all_data_join($tblname);
	            $offerDataFinal=array(json_decode(json_encode(($offerData)),true));
	            
	            $tblname="tblproduct";
                $whereData=array("ProductFeaturedYesNoRadio"=>0);
	            $suggestedData['SuggestedProduct']=$this->mm->get_a_data_join($tblname,$whereData);
	            
	            
	            $suggestedDataFinal=array(json_decode(json_encode(($suggestedData)),true));
	            
	            
	            $arrayFinal=array_merge(($bannerDataFinal),($categoryDataFinal),($offerDataFinal),($suggestedDataFinal));
	            
	            $data['Data']=$arrayFinal;
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	//samundar add 12-03-2021
	public function getDashboardDatasamu()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblbanner";
                $whereData=array("TypeofbannerName"=>"Home");
	            $bannerData['Banner']=$this->mm->get_a_data_join($tblname,$whereData);
	            $bannerDataFinal=array(json_decode(json_encode(($bannerData)),true));
	            
	            $tblname="tblcategory";
                $categoryData['Category']=$this->mm->get_all_data_join($tblname);
	            $categoryDataFinal=array(json_decode(json_encode(($categoryData)),true));
	            
	            $tblname="tbloffer";
                $offerData['Offer']=$this->mm->get_all_data_join($tblname);
	            $offerDataFinal=array(json_decode(json_encode(($offerData)),true));
	            
	            $tblname="tblproduct";
                $whereData=array("ProductFeaturedYesNoRadio"=>0);
	            $suggestedData['SuggestedProduct']=$this->mm->get_a_data_join($tblname,$whereData);
	            //
	            $arr=(array)($suggestedData['SuggestedProduct']);
	            $dataFilter=array();
        		$limit=10;
        		for($i=0;$i<count($arr)&&$i<$limit;$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"ProductImages"))==0)
            		    {   
            		        $imageData=explode(",",$value);
            		        $dataFilter[$i][$key]=$imageData;
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		    
            		}
        		}
    	        $suggestedProductPackInfo["product"]=$dataFilter;
	            //
	            $suggestedDataFinal=array(json_decode(json_encode(($suggestedProductPackInfo)),true));
	            
	            
	            $arrayFinal=array_merge(($bannerDataFinal),($categoryDataFinal),($offerDataFinal),($suggestedDataFinal));
	            
	            $data['Data']=$arrayFinal;
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	//samundar end
	
	//samu demo forcheck loose item 
	public function getDashboardDataTestkd()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblbanner";
                $whereData=array("TypeofbannerName"=>"Home");
	            $bannerData['Banner']=$this->mm->get_a_data_join($tblname,$whereData);
	            $bannerDataFinal=array(json_decode(json_encode(($bannerData)),true));
	            
	            $tblname="tblcategory";
                $categoryData['Category']=$this->mm->get_all_data_join($tblname);
	            $categoryDataFinal=array(json_decode(json_encode(($categoryData)),true));
	            
	            $tblname="tbloffer";
                $offerData['Offer']=$this->mm->get_all_data_join($tblname);
	            $offerDataFinal=array(json_decode(json_encode(($offerData)),true));
	            
	            $tblname="tblproduct";
                $whereData=array("ProductFeaturedYesNoRadio"=>0);
	            $suggestedData['SuggestedProduct']=$this->mm->get_a_data_join($tblname,$whereData);
	            
	            $arr=(array)($suggestedData['SuggestedProduct']);
	            $dataFilter=array();
        		$limit=10;
        		for($i=0;$i<count($arr)&&$i<$limit;$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        $productId=$value;
            		        $tblnameInner="tblproductdetail";
                            $whereDataInner=array("tblproductdetail.ProductIdReference"=>$value);
            	           $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $arr2=(array)($productDataDetail);
            	            $dataFilter[$i][$key]=$value;
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            $flag=0;
            	            //$a=array("1"=>"1kg","2"=>"2kg","3"=>"3kg","4"=>"4kg");
            	            $a=array("1kg","2kg","3kg","4kg","5kg");
            	            $a1=array("250gm","500gm","1kg","3kg","5kg");
            	            $a2=array("25gm","50gm","100gm","250gm","500gm","1kg");
            	            for($j=0;$j<count($arr2);$j++)
                    		{
                        		foreach($arr2[$j] as $key2=>$value2)
                        		{   
                        		    
                        		    if( ((strcmp($key2,"ProductdetailName"))==0) && ((strcmp($value2,"LOOSE1"))==0) )
                        		    {
                        		        $flag=1;
                        		        break;
                        		    }
                        		    //samundar 23-01-2021 
                        		    elseif( ((strcmp($key2,"ProductdetailName"))==0) && ((strcmp($value2,"LOOSE2"))==0) )
                        		    {
                        		        $flag=2;
                        		        break;
                        		    }
                        		    elseif( ((strcmp($key2,"ProductdetailName"))==0) && ((strcmp($value2,"LOOSE3"))==0) )
                        		    {
                        		        $flag=3;
                        		        break;
                        		    }
                        		    //end samundar
                        		    
                        		}
                        	//	echo  $flag." ".$key2." ".$alue;
                        	}
                    		if($flag==1)
                    		{   
                    		    $k=0;
                    		    $pro_d_n;
                    		    $demo;
                    		   
                    		    for($j=0;$j<count($a);$j++)
                    		    { 
                            		foreach($arr2[0] as $key2=>$value2)
                        		    { 
                            		    if((strcmp($key2,"ProductdetailName"))==0)
                            		    {         
                            		        $dataFilter2[$j][$key2]=$a[$k];
                            		        //samundar add 25-01-2021
                            		        $pro_d_n=$a[$k];
                            		        //end samundar
                            		            $k++;
                            		            
                            		        
                            		    }
                            		    else if((strcmp($key2,"ProductdetailImages"))==0)
                            		    {       
                            		            $imageData=explode(",",$value2);
                		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
                		                }
                		                //samundar 25-01-2021
                		                else if((strcmp($key2,"ProductdetailMRP"))==0 || strcmp($key2,"ProductdetailSRP")==0)
                		                {
                		                   // echo "samundar";
                		                    $demo=$value2;
                		                    //echo "samundar:-".$a;
                		                    $dataFilter2[$j][$key2]=strval($demo*($j+1));
                		                }
                		                //end samundar
                            		    else
                            		        $dataFilter2[$j][$key2]=$value2;
                            		}
                            	}
                    		   
                    		}
                    		//samundar 23-01-2021
                    		else if($flag==2)
                    		{   
                    		    $k=0;
                    		    $pro_d_n;
                    		    $demo;
                    		    for($j=0;$j<count($a1);$j++)
                    		    { 
                            		foreach($arr2[0] as $key2=>$value2)
                        		    { 
                            		    if((strcmp($key2,"ProductdetailName"))==0)
                            		    {         $dataFilter2[$j][$key2]=$a1[$k];
                            		                //samundar add 25-01-2021
                            		                $pro_d_n=$a1[$k];
                            		                //end
                            		                $k++;
                            		        
                            		    }
                            		    else if((strcmp($key2,"ProductdetailImages"))==0)
                            		    {       
                            		            $imageData=explode(",",$value2);
                		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
                		                }
                		                //samundar 25-01-2021
                		                else if((strcmp($key2,"ProductdetailMRP"))==0 || strcmp($key2,"ProductdetailSRP")==0)
                		                {
                		                   // echo "samundar";
                		                    $demo=$value2;
                		                    //echo "samundar:-".$a;
                		                    
                		                    if(strcmp($pro_d_n,'250gm')==0)
                		                    {
                		                        $dataFilter2[$j][$key2]=strval(round((int)$demo/4.0));
                		                    }
                		                    else if(strcmp($pro_d_n,'500gm')==0)
                		                    {
                		                        $dataFilter2[$j][$key2]=strval(round((int)$demo/2.0));
                		                    }
                		                    else if(strcmp($pro_d_n,'1kg')==0)
                		                    {
                		                        $dataFilter2[$j][$key2]=strval((int)$demo*1);
                		                    }
                		                    else if(strcmp($pro_d_n,'3kg')==0)
                		                    {
                		                        $dataFilter2[$j][$key2]=strval((int)$demo*3);
                		                    }
                		                    else if(strcmp($pro_d_n,'5kg')==0)
                		                    {
                		                        $dataFilter2[$j][$key2]=strval((int)$demo*5);
                		                    }
                		              
                		                   // $dataFilter2[$j][$key2]=$demo*($j+1);
                		              
                		              }
                		                //end samundar
                		                 
                            		    else
                            		        $dataFilter2[$j][$key2]=$value2;
                            		}
                            	}
                    		   
                    		}
                    		else if($flag==3)
                    		{   
                    		    $k=0;
                    		    $pro_d_n;
                    		    $demo;
                    		    for($j=0;$j<count($a2);$j++)
                    		    { 
                            		foreach($arr2[0] as $key2=>$value2)
                        		    { 
                            		    if((strcmp($key2,"ProductdetailName"))==0)
                            		    {         $dataFilter2[$j][$key2]=$a2[$k];
                            		                //samundar add 25-01-2021
                            		                $pro_d_n=$a2[$k];
                            		                //end
                            		            $k++;
                            		        
                            		    }
                            		    else if((strcmp($key2,"ProductdetailImages"))==0)
                            		    {       
                            		            $imageData=explode(",",$value2);
                		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
                		                }
                		                 //samundar 25-01-2021
                		                
                		                else if((strcmp($key2,"ProductdetailSRP"))==0||(strcmp($key2,"ProductdetailMRP"))==0)
                		                {
                		                   // echo "samundar";
                		                    $demo=$value2;
                		                    //echo "samundar:-".$a;
                		                    
                		                    if(strcmp($pro_d_n,'25gm')==0)
                		                    {
                		                        $dataFilter2[$j][$key2]=strval(round((int)$demo*0.025));
                		                    }
                		                    else if(strcmp($pro_d_n,'50gm')==0)
                		                    {
                		                        $dataFilter2[$j][$key2]=strval(round((int)$demo*0.050));
                		                    }
                		                    else if(strcmp($pro_d_n,'100gm')==0)
                		                    {
                		                        $dataFilter2[$j][$key2]=strval(round((int)$demo*0.1));
                		                    }
                		                    else if(strcmp($pro_d_n,'250gm')==0)
                		                    {
                		                        $dataFilter2[$j][$key2]=strval(round((int)$demo*0.25));
                		                    }
                		                    else if(strcmp($pro_d_n,'500gm')==0)
                		                    {
                		                        $dataFilter2[$j][$key2]=strval(round((int)$demo*0.5));
                		                    }
                		                    else if(strcmp($pro_d_n,'1kg')==0)
                		                    {
                		                        $dataFilter2[$j][$key2]=strval($demo);
                		                    }
                		              }
                		                //end samundar
                		                 //samundar 25-01-2021
                		              /*  */
                		                //end samundar
                            		    else
                            		    {
                            		        $dataFilter2[$j][$key2]=$value2;
                            		    }
                            		}
                            	}
                    		   
                    		}
                    		//end samundar
                    		else
                    		{
                    		    for($j=0;$j<count($arr2);$j++)
                    		    {
                        		    foreach($arr2[$j] as $key2=>$value2)
                            		{
                            		    if((strcmp($key2,"ProductdetailImages"))==0)
                            		    {       
                            		            $imageData=explode(",",$value2);
                		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
                		                }
                		                else{
                            		        $dataFilter2[$j][$key2]=$value2;
                		                }
                            		}
                    		    }
                    		}
                    		
                    		$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    		$dataFilter2=array();
                    		
                	    }
            		    else{
            		         $dataFilter[$i][$key]=$value;
            		    }
            		}
        		}
    	        //$data['Data']=$dataFilter;
    	        $suggestedProductPackInfo["product"]=$dataFilter;
	            $suggestedDataFinal=array(json_decode(json_encode(($suggestedProductPackInfo)),true));
	            
	            
	            $arrayFinal=array_merge(($bannerDataFinal),($categoryDataFinal),($offerDataFinal),($suggestedDataFinal));
	            
	            $data['Data']=$arrayFinal;
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
		    
	}
	function fetch_packinfo($arr,$limit)
    {   
        $dataFilter2=array();
        $resultPur='';
        $dataFilter=array();
        for($i=0;$i<count($arr)&&$i<$limit;$i++)
		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    
            		   /* if((strcmp($key,"ProductId"))==0)
            		    {
            		        $productId=$value;
            		        //samundar change table name  tblproductdetail to tblproduct 12-03-2021
            		        $tblnameInner="tblproduct";
            		        //samundar changetblproductdetail.ProductIdReference to tblproduct.ProductId 12-03-2021
                            $whereDataInner=array("tblproduct.ProductId"=>$value);
            	            $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $dataFilter[$i][$key]=$value;
            	            $arr2=(array)($productDataDetail);
            	            //$dataFilter[$i][$key]=$value;
            	            //samundar add 05-04-2021
            	            $tblnameInner1="tblpurchasedetail";
                            $whereDataInner1=array("tblpurchasedetail.ProductId"=>$value);
            	            $productDataDetail1=$this->mm->get_a_data_join($tblnameInner1,$whereDataInner1);
            	            $arr21=(array)($productDataDetail1);
            	            //print_r($arr21);
            	            if(isset($arr21[0]->PurchasedetailProductMrp))
            	            {
            	            $PurMrp=$arr21[0]->PurchasedetailProductMrp;
            	            $PurSrp=$arr21[0]->PurchasedetailProductSrp;
            	            $PurBatNo=$arr21[0]->PurchasedetailBatchNo;
            	            //print_r($PurMrp);
            	            }
            	            else
            	            {
            	                $resultPur="change";
            	            }
            	           // print_r($arr21);
            	           // die();
            	            //samundar end
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            for($j=0;$j<count($arr2);$j++)
                    		{
                        		foreach($arr2[$j] as $key2=>$value2)
                        		{    //samundar change ProductdetailImages to ProductImages 12-03-2021
                        		    if((strcmp($key2,"ProductImages"))==0)
                        		    {       
                        		            $imageData=explode(",",$value2);
            		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
            		                }
            		                //samundar add 05-04-2021
            		                else if((strcmp($key2,"ProductMrp"))==0)
                        		    {       
                        		            if($resultPur=='change')
                        		            {
                        		             $dataFilter2[$j]['PurchasedetailBatchNo']='';
                        		             $dataFilter2[$j][$key2]=$value2;   
                        		            }
                        		            else
                        		            {
                        		            $dataFilter2[$j]['PurchasedetailBatchNo']=$PurBatNo;
                        		            $dataFilter2[$j][$key2]=$PurMrp;
                        		            }
            		                }
            		                else if((strcmp($key2,"ProductSrp"))==0)
                        		    {       
                        		         if($resultPur=='change')
                        		            {
                        		             $dataFilter2[$j][$key2]=$value2;   
                        		            }
                        		            else
                        		            {
                        		            $dataFilter2[$j][$key2]=$PurSrp;
                        		            }
                        		            //$dataFilter2[$j][$key2]=$PurSrp;
            		                }
            		                //samundar end
            		                else
            		                        $dataFilter2[$j][$key2]=$value2;
                        		}
                    		}$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    		
            		    }
            		    else if((strcmp($key,"ProductImages"))==0)
            		    {   $imageData=explode(",",$value);
            		        $dataFilter[$i][$key]=$imageData;
            		    }
            		    else if((strcmp($key,"ProductMrp"))==0)
            		    {
            		        if($resultPur=='change')
        		            {
        		             $dataFilter[$i][$key]=$value;   
        		            }
        		            else
        		            {
        		            $dataFilter[$i][$key]=$PurMrp;
        		            }
            		       // $dataFilter[$i][$key]=$PurMrp;
            		    }
            		    else if((strcmp($key,"ProductSrp"))==0)
            		    {
            		        if($resultPur=='change')
        		            {
        		             $dataFilter[$i][$key]=$value;   
        		            }
        		            else
        		            {
        		            $dataFilter[$i][$key]=$PurSrp;
        		            }
            		        //$dataFilter[$i][$key]=$PurSrp;
            		    }
            		    else if((strcmp($key,"ProductName"))==0)
            		    {   $proName=str_replace("^","'",$value);
            		        $dataFilter[$i][$key]=$proName;
            		    }
            		    else */
            		         $dataFilter[$i][$key]=$value;
            		    
            		}
            		$resultPur='';
        		}
        return $dataFilter;
    }
    function fetch_purchase_packinfo($arr,$limit)
    {   
        $dataFilter2=array();
        for($i=0;$i<count($arr)&&$i<$limit;$i++)
		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        $productId=$value;
            		        //samundar change table name  tblproductdetail to tblproduct 12-03-2021
            		        $tblnameInner="tblproduct";
            		        //samundar changetblproductdetail.ProductIdReference to tblproduct.ProductId 12-03-2021
                            $whereDataInner=array("tblproduct.ProductId"=>$value);
            	            $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $dataFilter[$i][$key]=$value;
            	            $arr2=(array)($productDataDetail);
            	            //$dataFilter[$i][$key]=$value;
            	            
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            for($j=0;$j<count($arr2);$j++)
                    		{
                        		foreach($arr2[$j] as $key2=>$value2)
                        		{    //samundar change ProductdetailImages to ProductImages 12-03-2021
                        		    if((strcmp($key2,"ProductImages"))==0)
                        		    {       
                        		            $imageData=explode(",",$value2);
            		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
            		                }
            		                else
            		                        $dataFilter2[$j][$key2]=$value2;
                        		}
                    		}$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    		
            		    }
            		    else if((strcmp($key,"ProductImages"))==0)
            		    {   $imageData=explode(",",$value);
            		        $dataFilter[$i][$key]=$imageData;
            		    }
            		    else if((strcmp($key,"ProductName"))==0)
            		    {   $proName=str_replace("^","'",$value);
            		        $dataFilter[$i][$key]=$proName;
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		    
            		}
        		}
        return $dataFilter;
    }
	//end
	public function getDashboardDataTest()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblbanner";
                $whereData=array("TypeofbannerName"=>"Home");
	            $bannerData['Banner']=$this->mm->get_a_data_join($tblname,$whereData);
	            $bannerDataFinal=array(json_decode(json_encode(($bannerData)),true));
	            
	            $tblname="tblcategory";
                $categoryData['Category']=$this->mm->get_all_data_join($tblname);
	            $categoryDataFinal=array(json_decode(json_encode(($categoryData)),true));
	            
	            $tblname="tbloffer";
                $offerData['Offer']=$this->mm->get_all_data_join($tblname);
	            $offerDataFinal=array(json_decode(json_encode(($offerData)),true));
	            
	            //kd old medi 4/6/2021
	           /* $tblname="tblproduct";
                $whereData=array("ProductFeaturedYesNoRadio"=>0);
	            $suggestedData['SuggestedProduct']=$this->mm->get_a_data_join($tblname,$whereData);*/
	            
	            //new kd 4/6/2021
	            $tblname="tblpurchasedetail";
                $whereData=array("tblproduct.ProductFeaturedYesNoRadio"=>0);
	            $suggestedData['SuggestedProduct']=$this->mm->get_a_data_join($tblname,$whereData);
	           
	            $arr=(array)($suggestedData['SuggestedProduct']);
	            $dataFilter=array();
        		$limit=10;
        		//kd  28-01-2021
        		$arr=(array)($suggestedData['SuggestedProduct']);
	            $dataFilter=array();
        		$limit=10;
        	    
        	    $dataFilter=$this->fetch_packinfo($arr,$limit);
        	    
        		/*for($i=0;$i<count($arr)&&$i<$limit;$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        $productId=$value;
            		        //samundar change table name  tblproductdetail to tblproduct 12-03-2021
            		        $tblnameInner="tblproduct";
            		        //samundar changetblproductdetail.ProductIdReference to tblproduct.ProductId 12-03-2021
                            $whereDataInner=array("tblproduct.ProductId"=>$value);
            	            $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $dataFilter[$i][$key]=$value;
            	            $arr2=(array)($productDataDetail);
            	            //$dataFilter[$i][$key]=$value;
            	            
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            for($j=0;$j<count($arr2);$j++)
                    		{
                        		foreach($arr2[$j] as $key2=>$value2)
                        		{    //samundar change ProductdetailImages to ProductImages 12-03-2021
                        		    if((strcmp($key2,"ProductImages"))==0)
                        		    {       
                        		            $imageData=explode(",",$value2);
            		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
            		                }
            		                else
            		                        $dataFilter2[$j][$key2]=$value2;
                        		}
                    		}$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    		
            		    }
            		    else if((strcmp($key,"ProductImages"))==0)
            		    {   $imageData=explode(",",$value);
            		        $dataFilter[$i][$key]=$imageData;
            		    }
            		    else if((strcmp($key,"ProductName"))==0)
            		    {   $proName=str_replace("^","'",$value);
            		        $dataFilter[$i][$key]=$proName;
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		    
            		}
        		}*/
    	        //$data['Data']=$dataFilter;
    	        $suggestedProductPackInfo["product"]=$dataFilter;
	            $suggestedDataFinal=array(json_decode(json_encode(($suggestedProductPackInfo)),true));
	            
	            
	            $arrayFinal=array_merge(($bannerDataFinal),($categoryDataFinal),($offerDataFinal),($suggestedDataFinal));
	            
	            $data['Data']=$arrayFinal;
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
		    
	}
    	

	public function placeOrderOld()  //inserting a data in table
	{      
	      try
	      {     
	           
	            $tblname="tblcart";
	            $tableDetailName="tblorderdetail";
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				//$this->input->post('AddressId');
				
        		$dataMain=($this->mm->get_a_data_join($tblname,$where));
        	    //check_p($dataMain); 
        		$dataTableField=array();
	            $dataTableField["CustomerId"]=$this->input->post('CustomerId');
    	        $dataTableField["AddressId"]=$this->input->post('AddressId');
    	        $dataTableField["OrderPaymentMethod"]=$this->input->post('OrderPaymentMethod');
    	        $dataTableField["OrderTransactionNo"]=$this->input->post('OrderTransactionNo');
    	        $dataTableField["OrderPromoCode"]=$this->input->post('OrderPromoCode');
    	        $dataTableField["OrderBonusPoint"]=100;
    	        
    	        $date = new DateTime('now');
                $date->add(new DateInterval('P5D'));
                
    	        $dataTableField["OrderDeliveryDate"]=$date->format('Y-m-d');
    	        $dataTableField["OrderStageDropDown"]="Processing";
    	        $dataTableField["OrderDate"]=date('Y-m-d');
    	        $dataTableField["OrderStatus"]=0;
    	        $dataTableField["OrderCDT"]=date('Y-m-d H:i:s');
        	    $orderId=$this->mm->insert_data("tblorder",$dataTableField);
        	    
        	    $bonusData["OrderId"]=$orderId;
    	        $bonusData["CustomerId"]=$this->input->post('CustomerId');
    	        $bonusData["BonusPoints"]=1000;
    	        $bonusData["BonusType"]="Earned";
    	        $bonusData["BonusStatus"]=0;
    	        $bonusData["BonusCDT"]=date('Y-m-d H:i:s');
        	    $this->mm->insert_data("tblbonus",$bonusData);
    	        
    	        
        		$multiData=array();   
        
        		
        			//$arr=array(json_decode(json_encode(array_merge($arr1,$arr2))));;
        			$result = json_decode(json_encode($dataMain), true);
        		//$result = array(json_decode(json_encode($data['Data'])));
        		//check_p($result);
        		
        		//remove from cart
        		$tblname="tblcart";
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				($this->mm->delete_data_api($tblname,$where));
        	    
        		if(!empty($dataMain))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Place Order Sucessfully ";    
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Issue in placing Order"; 
	                $data['Data']=0;
        		}
	    }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//its taking too much time 
	//samundar create 19-01-21 
	public function placeOrder_samu()  //inserting a data in table
	{      
	    $total=0;
	      try
	      {     
	           
	            $tblname="tblcart";
	            $tableDetailName="tblorderdetail";
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				//$this->input->post('AddressId');
				
        		$dataMain=($this->mm->get_a_data_join($tblname,$where));
        	//	print_r($dataMain);
        		 for($i=0;$i<sizeof($dataMain);$i++)
            	    {
                	    foreach($dataMain[$i] as $key=>$value)
                	    {   //echo $value;
                	       if(strcmp($key,"CartPackInfo")==0)
                	       {
                	            $whereData=array("ProductdetailId"=>$value);
                	            $productDetail[]=$this->mm->get_a_data_join("tblproductdetail",$whereData);
                	       }
                	       
                	    }
                	    
            	    }
            	 
            	 //samu
            	// $shippingData=convert_object_arraY($this->mm->custom_query("SELECT * FROM `tblcart`as c join `tblorderdetail` as o  where c.`CustomerId` = 93"));
            	for($i=0;$i<sizeof($dataMain);$i++)
            	    {
            		 foreach($dataMain[$i] as $key=>$value)
                	    {    
            		    if((strcmp($key,"CartPackInfo"))==0)
            		    {
            		        if(!empty($value))
            		        {
            		            $productId=$value;
                		        $tblnameInner="tblproductdetail";
                                $whereDataInner=array("tblproductdetail.ProductdetailId"=>$value);
                	            $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
                	            //print_r($productDataDetail[0]->ProductdetailSRP);
                	         //   $dataFilter["Cart"][$i][$key]=$value;
                	           // $dataFilter["Cart"][$i]["PackInfo"]=($productDataDetail);
                	            $ProductSRP=$productDataDetail[0]->ProductdetailSRP;
                	            $ProductMRP=$productDataDetail[0]->ProductdetailMRP;
                	           // echo "samu";
                	          //  print_r($ProductSRP);
                	            
            		        }
            		    }
            		    else if((strcmp($key,"CartQuantity"))==0)
            		    { 
            		        //$dataFilter["Cart"][$i][$key]=$value;
            		        $total=$total+(int)$ProductSRP*(int)$value;
            		      //  echo "samu total=".$total;
            		        //$save=$save+((int)$ProductMRP-(int)$ProductSRP)*(int)$value;
            		        //$subTotal=$total+(int)$ProductMRP*(int)$value;
            		        
            		    }
            		    else
            		         $dataFilter["Cart"][$i][$key]=$value;
            		}
            		
        		}//echo "samu total final=".$total;
        		
        		 $shippingData=convert_object_arraY($this->mm->custom_query("SELECT `DeliverychargeShippingCharge` FROM `tbldeliverycharge` WHERE `DeliverychargeProductPriceRange` <= $total order by `DeliverychargeShippingCharge` ASC LIMIT 1 "));
               // print_r($shippingData);
               for($i=0;$i<sizeof($shippingData);$i++)
               {
	             foreach($shippingData as $key=>$value)
	             {
	                $d_charge=$shippingData[$i]["DeliverychargeShippingCharge"];
	             }
	           }
	         //  echo "shippinf".$a;
            	 //end
            	    for($i=0;$i<sizeof($dataMain);$i++)
            	    {
                	
            	        $productDetailData[]=array_merge(json_decode(json_encode($dataMain[$i]), true),json_decode(json_encode($productDetail[$i][0]), true));
            	    }
            	    $dataMain=$productDetailData;
        	    //check_p($dataMain); 
        		$dataTableField=array();
	            $dataTableField["CustomerId"]=$this->input->post('CustomerId');
    	        $dataTableField["AddressId"]=$this->input->post('AddressId');
    	        $dataTableField["OrderPaymentMethod"]=$this->input->post('OrderPaymentMethod');
    	        $dataTableField["OrderTransactionNo"]=$this->input->post('OrderTransactionNo');
    	        $dataTableField["OrderPromoCode"]=$this->input->post('OrderPromoCode');
    	        $dataTableField["OrderBonusPoint"]=100;
    	        //samu
    	        $dataTableField["ShippingCharge"]=$d_charge;
    	        //end
    	        $date = new DateTime('now');
                $date->add(new DateInterval('P5D'));
                
    	        $dataTableField["OrderDeliveryDate"]=$date->format('Y-m-d');
    	        $dataTableField["OrderStageDropDown"]="Processing";
    	        $dataTableField["OrderDate"]=date('Y-m-d');
    	        $dataTableField["OrderStatus"]=0;
    	        $dataTableField["OrderCDT"]=date('Y-m-d H:i:s');
        	    $orderId=$this->mm->insert_data("tblorder",$dataTableField);
        	    
        	    $bonusData["OrderId"]=$orderId;
    	        $bonusData["CustomerId"]=$this->input->post('CustomerId');
    	        $bonusData["BonusPoints"]=1000;
    	        $bonusData["BonusType"]="Earned";
    	        $bonusData["BonusStatus"]=0;
    	        $bonusData["BonusCDT"]=date('Y-m-d H:i:s');
        	    $this->mm->insert_data("tblbonus",$bonusData);
    	        
    	        
        		$multiData=array();   
        
        		
        			//$arr=array(json_decode(json_encode(array_merge($arr1,$arr2))));;
        			$result = json_decode(json_encode($dataMain), true);
        		//$result = array(json_decode(json_encode($data['Data'])));
        		//check_p($result);
        		$total=0;
        		$dataTableFieldDetail=array();
                $key='F1S80EM90JP3';
                $CompanyCode="Bharat2";
                $MargId= "121921";
                
                //$key = 'EGNUI4A3U1AK';
                //$key = 'JPLIQH6UMTP1';
                //$key = '3NAHP2Z6JBTC';
                $key='F1S80EM90JP3';
                $CompanyCode="Bharat2";
                $MargId= "121921";

                for($i=0;$i<sizeof($result);$i++)
                {
                    foreach($result[$i] as $key=>$value)
                    {
                    
                    $dataTableFieldDetail[$i]["OrderIdReference"]=strval($orderId);
                    $dataTableFieldDetail[$i]["ProductId"]=$result[$i]['ProductId'];
                    $dataTableFieldDetail[$i]["OrderdetailCartPackInfo"]=$result[$i]['CartPackInfo'];
                    $dataTableFieldDetail[$i]["OrderdetailProductSrp"]=$result[$i]['ProductdetailSRP'];
                    $dataTableFieldDetail[$i]["OrderdetailProductMrp"]=$result[$i]['ProductdetailMRP'];
                    $dataTableFieldDetail[$i]["OrderdetailBarcodeNo"]=$result[$i]['ProductdetailBarcodeNo'];
                    
                    $dataTableFieldDetail[$i]["OrderdetailQty"]=$result[$i]['CartQuantity'];
                    $dataTableFieldDetail[$i]["HsnId"]=$result[$i]['HsnId'];
        	        $dataTableFieldDetail[$i]["OrderdetailStatus"]=0;
        	        $dataTableFieldDetail[$i]["OrderdetailCDT"]=date('Y-m-d H:i:s');
        	        
        	        $whereData=array(  
    					'tblproductdetail.ProductdetailId'=>$result[$i]['CartPackInfo'],
				    );
        	        $productDetailData=$this->mm->get_a_data_join('tblproductdetail',$whereData);
        	        $prodcutCode=$productDetailData[0]->ProductdetailNo;
            	    echo "samundar=".$prodcutCode;
            	    $ch = curl_init( "https://wservices.margcompusoft.com/api/eOnlineData/InsertOrderDetail" );
                    $payload = json_encode( array( "OrderID" => "", "OrderNo" => '', "CustomerID" => "1681482", "MargID" => $MargId, "Type" => "S", "Sid" => "111289", "ProductCode" =>$prodcutCode , "Quantity" => (int)$result[$i]['CartQuantity'] , "Free" => "0", "Lat" => "", "Lng" => "", "Address" => "", "GpsID" => "0", "UserType" => "1", "Points" => "0.0", "Discounts" => "0.0", "Transport" => "", "Delivery" => "", "Bankname" => "", "BankAdd1" => "", "BankAdd2" => "", "shipname" => " ", "shipAdd1" => "", "shipAdd2" => "", "shipAdd3" => "", "paymentmode" => "razarpay", "paymentmodeAmount" => "0.00", "payment_remarks" => "", "order_remarks" => "", "CustMobile" => "", "CompanyCode" => $CompanyCode, "OrderFrom" => $CompanyCode ));
                    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
                    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
                    
                    $response = curl_exec($ch);
                    
                    $err = curl_error($ch);
                    curl_close($ch);
                    if ($err) {
                      echo "cURL Error #:" . $err;
                        die(); /* Stop execution when error */
                    }
                    
        	        }
        	        $total=$total+(int)$dataTableFieldDetail[$i]["OrderdetailProductSrp"]*(int)$result[$i]['CartQuantity'];
                }
                $this->mm->insert_multiple_data($tableDetailName,$dataTableFieldDetail);
        		$tableDetailName="tblorder";
	            $where=array(  
    					'OrderId'=>$orderId,
				);
				$updateData=array(  
    					'OrderTotal'=>$total,
				);
				//update kd 
				    $this->mm->update_data_api($tableDetailName,$updateData,$where);
        		
        		//remove from cart
        		$tblname="tblcart";
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				($this->mm->delete_data_api($tblname,$where));
        	    
        		if(!empty($dataMain))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Place Order Sucessfully ";    
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Issue in placing Order"; 
	                $data['Data']=0;
        		}
	    }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar end
	public function placeOrder()  //inserting a data in table
	{      
	      try
	      {     
	            if(empty($this->input->post('AddressId')))
                {
               	    $data['IsSuccess']=true;
	                $data['Message']="Please Add Address First ";    
        		    $data['Data']=1;    
    		        header('Content-Type: application/json');
    		    	echo json_encode($data);
	                return true;
        	
                }
	           
	            $tblname="tblcart";
	            $tableDetailName="tblorderdetail";
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				//$this->input->post('AddressId');
				
        		$dataMain=($this->mm->get_a_data_join($tblname,$where));
        		    //kd pack info removed
        		    /*for($i=0;$i<sizeof($dataMain);$i++)
            	    {
                	    foreach($dataMain[$i] as $key=>$value)
                	    {   //echo $value;
                	       if(strcmp($key,"CartPackInfo")==0)
                	       {
                	            $whereData=array("ProductdetailId"=>$value);
                	            $productDetail[]=$this->mm->get_a_data_join("tblproductdetail",$whereData);
                	       }
                	       
                	    }
            	    }*/
            	 //samu
    	            $ProductSRP=0;
        	        $ProductMRP=0;
        	        $total=0;
                    for($i=0;$i<sizeof($dataMain);$i++)
            	    {
            		 foreach($dataMain[$i] as $key=>$value)
                	    {  
                	        
            		   /* if((strcmp($key,"CartPackInfo"))==0)
            		    {
            		        if(!empty($value))
            		        {
            		            $productId=$value;
                		        $tblnameInner="tblproductdetail";
                                $whereDataInner=array("tblproductdetail.ProductdetailId"=>$value);
                	            $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
                	            //print_r($productDataDetail[0]->ProductdetailSRP);
                	         //   $dataFilter["Cart"][$i][$key]=$value;
                	           // $dataFilter["Cart"][$i]["PackInfo"]=($productDataDetail);
                	           $ProductSRP=$productDataDetail[0]->ProductdetailSRP;
                	               $ProductMRP=$productDataDetail[0]->ProductdetailMRP;
                	           // echo "samu";
                	          //  print_r($ProductSRP);
                	            
            		        }
            		    }*/
            		    if((strcmp($key,"CartQuantity"))==0)
            		    { 
            		        //$dataFilter["Cart"][$i][$key]=$value;
            		        $total=$total+(int)$ProductSRP*(int)$value;
            		      //  echo "samu total=".$total;
            		        //$save=$save+((int)$ProductMRP-(int)$ProductSRP)*(int)$value;
            		        //$subTotal=$total+(int)$ProductMRP*(int)$value;
            		        
            		    }
            		    else
            		         $dataFilter["Cart"][$i][$key]=$value;
            		}
            		
        		}//echo "samu total final=".$total;
        		
        		 $shippingData=convert_object_arraY($this->mm->custom_query("SELECT `DeliverychargeShippingCharge` FROM `tbldeliverycharge` WHERE `DeliverychargeProductPriceRange` <= $total order by `DeliverychargeShippingCharge` ASC LIMIT 1 "));
               // print_r($shippingData);
               for($i=0;$i<sizeof($shippingData);$i++)
               {
	             foreach($shippingData as $key=>$value)
	             {
	                $d_charge=$shippingData[$i]["DeliverychargeShippingCharge"];
	             }
	           }
            	 //end
            	    /*for($i=0;$i<sizeof($dataMain);$i++)
            	    {
                	
            	        //$productDetailData[]=array_merge(json_decode(json_encode($dataMain[$i]), true),json_decode(json_encode($productDetail[$i][0]), true));
            	    }*/
            	   /* $dataMain=$productDetailData;*/
        	    //check_p($dataMain); 
        		$dataTableField=array();
	            $dataTableField["CustomerId"]=$this->input->post('CustomerId');
    	        $dataTableField["AddressId"]=$this->input->post('AddressId');
    	        $dataTableField["OrderPaymentMethod"]=$this->input->post('OrderPaymentMethod');
    	        $dataTableField["OrderTransactionNo"]=$this->input->post('OrderTransactionNo');
    	        $dataTableField["OrderPromoCode"]=$this->input->post('OrderPromoCode');
    	        $dataTableField["OrderBonusPoint"]=100;
    	        //samu
    	        $dataTableField["ShippingCharge"]=$d_charge;
    	        //end
    	        $date = new DateTime('now');
                $date->add(new DateInterval('P5D'));
                
    	        $dataTableField["OrderDeliveryDate"]=$date->format('Y-m-d');
    	        $dataTableField["OrderStageDropDown"]="Processing";
    	        $dataTableField["OrderDate"]=date('Y-m-d');
    	        $dataTableField["OrderStatus"]=0;
    	        $dataTableField["OrderCDT"]=date('Y-m-d H:i:s');
        	    $orderId=$this->mm->insert_data("tblorder",$dataTableField);
        	    
        	    $bonusData["OrderId"]=$orderId;
    	        $bonusData["CustomerId"]=$this->input->post('CustomerId');
    	        $bonusData["BonusPoints"]=1000;
    	        $bonusData["BonusType"]="Earned";
    	        $bonusData["BonusStatus"]=0;
    	        $bonusData["BonusCDT"]=date('Y-m-d H:i:s');
        	    $this->mm->insert_data("tblbonus",$bonusData);
    	        
    	        
        		$multiData=array();   
        
        		
        			//$arr=array(json_decode(json_encode(array_merge($arr1,$arr2))));;
        			$result = json_decode(json_encode($dataMain), true);
        		//$result = array(json_decode(json_encode($data['Data'])));
        		//check_p($result);
        		$total=0;
        		$dataTableFieldDetail=array();
                /*print_r($result);
                die();*/
                for($i=0;$i<sizeof($result);$i++)
                {
                    foreach($result[$i] as $key=>$value)
                    {
                    
                    $dataTableFieldDetail[$i]["OrderIdReference"]=strval($orderId);
                    $dataTableFieldDetail[$i]["ProductId"]=$result[$i]['ProductId'];
                    $dataTableFieldDetail[$i]["PackingId"]=$result[$i]['PackingId'];
                    $dataTableFieldDetail[$i]["OrderdetailMfgName"]=$result[$i]['PurchasedetailMfgName'];
                    $dataTableFieldDetail[$i]["OrderdetailBatchNo"]=$result[$i]['PurchasedetailBatchNo'];
                    $dataTableFieldDetail[$i]["OrderdetailExpiryDate"]=$result[$i]['PurchasedetailExpiryDate'];
                    $dataTableFieldDetail[$i]["OrderdetailFreeDealQty"]=$result[$i]['PurchasedetailFreeDealQty'];
                    /*old code comment samundar 07-04-2021
                    $dataTableFieldDetail[$i]["OrderdetailProductSrp"]=$result[$i]['ProductSrp'];
                    $dataTableFieldDetail[$i]["OrderdetailProductMrp"]=$result[$i]['ProductMrp'];*/
                    //samundar add this code for purachase details mrp and srp 07-02-2021
                    $dataTableFieldDetail[$i]["OrderdetailProductSrp"]=$result[$i]['PurchasedetailProductSrp'];
                    $dataTableFieldDetail[$i]["OrderdetailProductMrp"]=$result[$i]['PurchasedetailProductMrp'];
                    //samundar end
                    /*$dataTableFieldDetail[$i]["OrderdetailCartPackInfo"]=$result[$i]['CartPackInfo'];
                    $dataTableFieldDetail[$i]["OrderdetailProductSrp"]=$result[$i]['ProductdetailSRP'];
                    $dataTableFieldDetail[$i]["OrderdetailProductMrp"]=$result[$i]['ProductdetailMRP'];
                    $dataTableFieldDetail[$i]["OrderdetailBarcodeNo"]=$result[$i]['ProductdetailBarcodeNo'];
                    */
                    $dataTableFieldDetail[$i]["OrderdetailQty"]=$result[$i]['CartQuantity'];
                    $dataTableFieldDetail[$i]["HsnId"]=$result[$i]['HsnId'];
        	        $dataTableFieldDetail[$i]["OrderdetailStatus"]=0;
        	        $dataTableFieldDetail[$i]["OrderdetailCDT"]=date('Y-m-d H:i:s');
        	        
        	       /* $prodcutCode=$result[$i]['CartProductDetailNo'];*/
        	        
            	    }
        	        $total=$total+(int)$dataTableFieldDetail[$i]["OrderdetailProductSrp"]*(int)$result[$i]['CartQuantity'];
                }
                $this->mm->insert_multiple_data($tableDetailName,$dataTableFieldDetail);
        		$tableDetailName="tblorder";
	            $where=array(  
    					'OrderId'=>$orderId,
				);
				$updateData=array(  
    					'OrderTotal'=>$total,
				);
				//update kd 
				    $this->mm->update_data_api($tableDetailName,$updateData,$where);
        		
        		//remove from cart
        		$tblname="tblcart";
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				($this->mm->delete_data_api($tblname,$where));
        	    
        		if(!empty($dataMain))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Place Order Sucessfully ";    
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Issue in placing Order"; 
	                $data['Data']=0;
        		}
	    }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	
	
	
	public function placeOrder_old()  //inserting a data in table
	{      
	      try
	      {     
	           
	            $tblname="tblcart";
	            $tableDetailName="tblorderdetail";
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				//$this->input->post('AddressId');
				
        		$dataMain=($this->mm->get_a_data_join($tblname,$where));
        		 for($i=0;$i<sizeof($dataMain);$i++)
            	    {
                	    foreach($dataMain[$i] as $key=>$value)
                	    {   //echo $value;
                	       if(strcmp($key,"CartPackInfo")==0)
                	       {
                	            $whereData=array("ProductdetailId"=>$value);
                	            $productDetail[]=$this->mm->get_a_data_join("tblproductdetail",$whereData);
                	       }
                	    }
            	    }
            	    for($i=0;$i<sizeof($dataMain);$i++)
            	    {
                	
            	        $productDetailData[]=array_merge(json_decode(json_encode($dataMain[$i]), true),json_decode(json_encode($productDetail[$i][0]), true));
            	    }
            	    $dataMain=$productDetailData;
        	    //check_p($dataMain); 
        		$dataTableField=array();
	            $dataTableField["CustomerId"]=$this->input->post('CustomerId');
    	        $dataTableField["AddressId"]=$this->input->post('AddressId');
    	        $dataTableField["OrderPaymentMethod"]=$this->input->post('OrderPaymentMethod');
    	        $dataTableField["OrderTransactionNo"]=$this->input->post('OrderTransactionNo');
    	        $dataTableField["OrderPromoCode"]=$this->input->post('OrderPromoCode');
    	        $dataTableField["OrderBonusPoint"]=100;
    	        
    	        $date = new DateTime('now');
                $date->add(new DateInterval('P5D'));
                
    	        $dataTableField["OrderDeliveryDate"]=$date->format('Y-m-d');
    	        $dataTableField["OrderStageDropDown"]="Processing";
    	        $dataTableField["OrderDate"]=date('Y-m-d');
    	        $dataTableField["OrderStatus"]=0;
    	        $dataTableField["OrderCDT"]=date('Y-m-d H:i:s');
        	    $orderId=$this->mm->insert_data("tblorder",$dataTableField);
        	    
        	    $bonusData["OrderId"]=$orderId;
    	        $bonusData["CustomerId"]=$this->input->post('CustomerId');
    	        $bonusData["BonusPoints"]=1000;
    	        $bonusData["BonusType"]="Earned";
    	        $bonusData["BonusStatus"]=0;
    	        $bonusData["BonusCDT"]=date('Y-m-d H:i:s');
        	    $this->mm->insert_data("tblbonus",$bonusData);
    	        
    	        
        		$multiData=array();   
        
        		
        			//$arr=array(json_decode(json_encode(array_merge($arr1,$arr2))));;
        			$result = json_decode(json_encode($dataMain), true);
        		//$result = array(json_decode(json_encode($data['Data'])));
        		//check_p($result);
        		$total=0;
        		$dataTableFieldDetail=array();
                $key='F1S80EM90JP3';
                $CompanyCode="Bharat2";
                $MargId= "121921";
                
                //$key = 'EGNUI4A3U1AK';
                //$key = 'JPLIQH6UMTP1';
                //$key = '3NAHP2Z6JBTC';
                $key='F1S80EM90JP3';
                $CompanyCode="Bharat2";
                $MargId= "121921";

                for($i=0;$i<sizeof($result);$i++)
                {
                    foreach($result[$i] as $key=>$value)
                    {
                    
                    $dataTableFieldDetail[$i]["OrderIdReference"]=strval($orderId);
                    $dataTableFieldDetail[$i]["ProductId"]=$result[$i]['ProductId'];
                    $dataTableFieldDetail[$i]["OrderdetailCartPackInfo"]=$result[$i]['CartPackInfo'];
                    $dataTableFieldDetail[$i]["OrderdetailProductSrp"]=$result[$i]['ProductdetailSRP'];
                    $dataTableFieldDetail[$i]["OrderdetailProductMrp"]=$result[$i]['ProductdetailMRP'];
                    $dataTableFieldDetail[$i]["OrderdetailBarcodeNo"]=$result[$i]['ProductdetailBarcodeNo'];
                    
                    $dataTableFieldDetail[$i]["OrderdetailQty"]=$result[$i]['CartQuantity'];
                    $dataTableFieldDetail[$i]["HsnId"]=$result[$i]['HsnId'];
        	        $dataTableFieldDetail[$i]["OrderdetailStatus"]=0;
        	        $dataTableFieldDetail[$i]["OrderdetailCDT"]=date('Y-m-d H:i:s');
        	        
        	        $whereData=array(  
    					'tblproductdetail.ProductdetailId'=>$result[$i]['CartPackInfo'],
				    );
        	        $productDetailData=$this->mm->get_a_data_join('tblproductdetail',$whereData);
        	        $prodcutCode=$productDetailData[0]->ProductdetailNo;
            	    /*
            	    $ch = curl_init( "https://wservices.margcompusoft.com/api/eOnlineData/InsertOrderDetail" );
                    $payload = json_encode( array( "OrderID" => "", "OrderNo" => strval($orderId), "CustomerID" => "1681482", "MargID" => $MargId, "Type" => "S", "Sid" => "111289", "ProductCode" =>$prodcutCode , "Quantity" => (int)$result[$i]['CartQuantity'] , "Free" => "0", "Lat" => "", "Lng" => "", "Address" => "", "GpsID" => "0", "UserType" => "1", "Points" => "0.0", "Discounts" => "0.0", "Transport" => "", "Delivery" => "", "Bankname" => "", "BankAdd1" => "", "BankAdd2" => "", "shipname" => " ", "shipAdd1" => "", "shipAdd2" => "", "shipAdd3" => "", "paymentmode" => "razarpay", "paymentmodeAmount" => "0.00", "payment_remarks" => "", "order_remarks" => "", "CustMobile" => "", "CompanyCode" => $CompanyCode, "OrderFrom" => $CompanyCode ));
                    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
                    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
                    
                    $response = curl_exec($ch);
                    
                    $err = curl_error($ch);
                    curl_close($ch);
                    if ($err) {
                      echo "cURL Error #:" . $err;
                        die(); 
                    }*/
                    
        	        }
        	        $total=$total+(int)$dataTableFieldDetail[$i]["OrderdetailProductSrp"]*(int)$result[$i]['CartQuantity'];
                }
                $this->mm->insert_multiple_data($tableDetailName,$dataTableFieldDetail);
        		$tableDetailName="tblorder";
	            $where=array(  
    					'OrderId'=>$orderId,
				);
				$updateData=array(  
    					'OrderTotal'=>$total,
				);
				//update kd 
				    $this->mm->update_data_api($tableDetailName,$updateData,$where);
        		
        		//remove from cart
        		$tblname="tblcart";
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				($this->mm->delete_data_api($tblname,$where));
        	    
        		if(!empty($dataMain))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Place Order Sucessfully ";    
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Issue in placing Order"; 
	                $data['Data']=0;
        		}
	    }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	
	//samundar add api remove pack info 18-03-2021
	public function placeOrderNew()  //inserting a data in table
	{      
	      try
	      {     
	            /*if(empty($this->input->post('AddressId')))
                {
               	    $data['IsSuccess']=true;
	                $data['Message']="Please Add Address First ";    
        		    $data['Data']=1;    
    		        header('Content-Type: application/json');
    		    	echo json_encode($data);
	                return true;
        	
                }*/
	           
	            $tblname="tblcart";
	            $tableDetailName="tblorderdetail";
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				//$this->input->post('AddressId');
				
        		$dataMain=($this->mm->get_a_data_join($tblname,$where));
        		//print_r($dataMain);
        		 for($i=0;$i<sizeof($dataMain);$i++)
            	    {
                	    foreach($dataMain[$i] as $key=>$value)
                	    {   //echo $value;
                	       if(strcmp($key,"ProductId")==0)
                	       {
                	            $whereData=array("ProductId"=>$value);
                	            $productDetail[]=$this->mm->get_a_data_join("tblproduct",$whereData);
                	       }
                	       
                	    }
            	    }
            	 //samu
    	            $ProductSRP=0;
        	        $ProductMRP=0;
        	        $total=0;
                    for($i=0;$i<sizeof($dataMain);$i++)
            	    {
            		 foreach($dataMain[$i] as $key=>$value)
                	    {  
                	        
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        if(!empty($value))
            		        {
            		            $productId=$value;
                		        $tblnameInner="tblproduct";
                                $whereDataInner=array("tblproduct.ProductId"=>$value);
                	            $productDataDetail=$this->mm->get_a_data($tblnameInner,$whereDataInner);
                	            //print_r($productDataDetail[0]->ProductdetailSRP);
                	         //   $dataFilter["Cart"][$i][$key]=$value;
                	           // $dataFilter["Cart"][$i]["PackInfo"]=($productDataDetail);
                	            $ProductSRP=$productDataDetail[0]->ProductSrp;
                	            $ProductMRP=$productDataDetail[0]->ProductMrp;
                	           // echo "samu";
                                // print_r($ProductSRP);
                	            
            		        }
            		    }
            		    else if((strcmp($key,"CartQuantity"))==0)
            		    { 
            		        //$dataFilter["Cart"][$i][$key]=$value;
            		        $total=$total+(int)$ProductSRP*(int)$value;
            		      //  echo "samu total=".$total;
            		        //$save=$save+((int)$ProductMRP-(int)$ProductSRP)*(int)$value;
            		        //$subTotal=$total+(int)$ProductMRP*(int)$value;
            		        
            		    }
            		    else
            		         $dataFilter["Cart"][$i][$key]=$value;
            		}
            		
        		}//echo "samu total final=".$total;
        		
        		 $shippingData=convert_object_arraY($this->mm->custom_query("SELECT `DeliverychargeShippingCharge` FROM `tbldeliverycharge` WHERE `DeliverychargeProductPriceRange` <= $total order by `DeliverychargeShippingCharge` ASC LIMIT 1 "));
               // print_r($shippingData);
               for($i=0;$i<sizeof($shippingData);$i++)
               {
	             foreach($shippingData as $key=>$value)
	             {
	                $d_charge=$shippingData[$i]["DeliverychargeShippingCharge"];
	             }
	           }
            	 //end
            	    for($i=0;$i<sizeof($dataMain);$i++)
            	    {
                	
            	        $productDetailData[]=array_merge(json_decode(json_encode($dataMain[$i]), true),json_decode(json_encode($productDetail[$i][0]), true));
            	    }
            	    $dataMain=$productDetailData;
        	    //check_p($dataMain); 
        		$dataTableField=array();
	            $dataTableField["CustomerId"]=$this->input->post('CustomerId');
    	      //  $dataTableField["AddressId"]=$this->input->post('AddressId');
    	        $dataTableField["OrderPaymentMethod"]=$this->input->post('OrderPaymentMethod');
    	        $dataTableField["OrderTransactionNo"]=$this->input->post('OrderTransactionNo');
    	        $dataTableField["OrderPromoCode"]=$this->input->post('OrderPromoCode');
    	        $dataTableField["OrderBonusPoint"]=100;
    	        //samu
    	        $dataTableField["ShippingCharge"]=$d_charge;
    	        //end
    	        $date = new DateTime('now');
                $date->add(new DateInterval('P5D'));
                
    	        $dataTableField["OrderDeliveryDate"]=$date->format('Y-m-d');
    	        $dataTableField["OrderStageDropDown"]="Processing";
    	        $dataTableField["OrderDate"]=date('Y-m-d');
    	        $dataTableField["OrderStatus"]=0;
    	        $dataTableField["OrderCDT"]=date('Y-m-d H:i:s');
        	    $orderId=$this->mm->insert_data("tblorder",$dataTableField);
        	    
        	    $bonusData["OrderId"]=$orderId;
    	        $bonusData["CustomerId"]=$this->input->post('CustomerId');
    	        $bonusData["BonusPoints"]=1000;
    	        $bonusData["BonusType"]="Earned";
    	        $bonusData["BonusStatus"]=0;
    	        $bonusData["BonusCDT"]=date('Y-m-d H:i:s');
        	    $this->mm->insert_data("tblbonus",$bonusData);
    	        
    	        
        		$multiData=array();   
        
        		
        			//$arr=array(json_decode(json_encode(array_merge($arr1,$arr2))));;
        			$result = json_decode(json_encode($dataMain), true);
        		//$result = array(json_decode(json_encode($data['Data'])));
        		//check_p($result);
        		$total=0;
        		$dataTableFieldDetail=array();
               // print_r($result);
               // die();
                
                for($i=0;$i<sizeof($result);$i++)
                {
                    foreach($result[$i] as $key=>$value)
                    {
                    
                    $dataTableFieldDetail[$i]["OrderIdReference"]=strval($orderId);
                    $dataTableFieldDetail[$i]["ProductId"]=$result[$i]['ProductId'];
                    $dataTableFieldDetail[$i]["OrderdetailCartPackInfo"]=$result[$i]['CartPackInfo'];
                    $dataTableFieldDetail[$i]["OrderdetailProductSrp"]=$result[$i]['ProductSrp'];
                    $dataTableFieldDetail[$i]["OrderdetailProductMrp"]=$result[$i]['ProductMrp'];
                   // $dataTableFieldDetail[$i]["OrderdetailBarcodeNo"]=$result[$i]['ProductdetailBarcodeNo'];
                    
                    $dataTableFieldDetail[$i]["OrderdetailQty"]=$result[$i]['CartQuantity'];
                    $dataTableFieldDetail[$i]["HsnId"]=$result[$i]['HsnId'];
        	        $dataTableFieldDetail[$i]["OrderdetailStatus"]=0;
        	        $dataTableFieldDetail[$i]["OrderdetailCDT"]=date('Y-m-d H:i:s');
        	        
        	        $prodcutCode=$result[$i]['CartProductDetailNo'];
        	        
            	    }
        	        $total=$total+(int)$dataTableFieldDetail[$i]["OrderdetailProductSrp"]*(int)$result[$i]['CartQuantity'];
                }
               // print_r($dataTableFieldDetail);
                $this->mm->insert_multiple_data($tableDetailName,$dataTableFieldDetail);
        		$tableDetailName="tblorder";
	            $where=array(  
    					'OrderId'=>$orderId,
				);
				$updateData=array(  
    					'OrderTotal'=>$total,
				);
				//update kd 
				    $this->mm->update_data_api($tableDetailName,$updateData,$where);
        		
        		//remove from cart
        		$tblname="tblcart";
	            $where=array(  
    					'tblcart.CustomerId'=>$this->input->post('CustomerId'),
				);
				($this->mm->delete_data_api($tblname,$where));
        	    
        		if(!empty($dataMain))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Place Order Sucessfully ";    
        		    $data['Data']=1;
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Issue in placing Order"; 
	                $data['Data']=0;
        		}
	    }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	//samundar end
	
	public function orderHistory() //inserting a data in table
	{      
	      try
	      {    
	            $tblname='tblorder';
	            $where=array(  
    				'tblcustomer.CustomerId'=>$this->input->post('CustomerId'),
				);
        		//print_r($where);
        		$data['Data']=$this->mm->get_a_data_join($tblname,$where);
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Order Found";    
        		   
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Order Found"; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function orderHistoryTest() //inserting a data in table
	{      
	      try
	      {    
	            $tblname='tblorder';
	            $where=array(  
    				'tblcustomer.CustomerId'=>$this->input->post('CustomerId'),
				);
				$orderData["Order"]=$this->mm->get_a_data_join($tblname,$where);
        		$arrayFinal=$orderDataFinal=array(json_decode(json_encode(($orderData)),true));
	           
	       /*     $cartTot= array("SubTotal"=>"1000","Deliver Charges"=>"200");
	            $totData["Payment"]=array(json_decode(json_encode(($cartTot)),true));
	            $cartTotal=array(json_decode(json_encode(($totData)),true));
	       */    
	            $cartTot= array("SubTotal"=>"1000","Deliver Charges"=>"200");
	            $totData=array(json_decode(json_encode(($cartTot)),true));
	            $totalPayment=(json_decode(json_encode(($totData)),true));
	           
	            $orderDataFinal[2]=$Tot= array("Total"=>"1200");
	            $totalData=array(json_decode(json_encode(($Tot)),true));
	            $totalTotal=(json_decode(json_encode(($totalData)),true));
	           
	            $data['Data']=$arrayFinal;
	            $arr=($data['Data']);
        		$dataFilter=array();
	            for($i=0;$i<count($arrayFinal[0]["Order"]);$i++)
        		{
            		foreach($arrayFinal[0]["Order"][$i] as $key=>$value)
            		{  // echo $key;
            		    if((strcmp($key,"OrderTotal"))==0)
            		    {   $dataFilter[$i]["OrderPayment"]=$totalPayment;
            		     $dataFilter[$i]["OrderTotal"]=$totalTotal;
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		}
        		}
	            //$arrayFinal=array_merge(array($orderDataFinal[0]["Order"]),array($totalPayment),array($totalTotal));
	           
	            //$arrayFinal=$arrayFinal;
	            //$data['Data']=$arrayFinal;
	            $data['Data']=$dataFilter;
	            $arr=($data['Data']);
        		
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Order Found";    
        		   
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Order Found"; 
	                $data['Data']=[];
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function orderHistoryDetail() //inserting a data in table
	{      
	      try
	      {    
	            $tblname='tblorderdetail';
	            $where=array(  
    				'tblorderdetail.OrderIdReference'=>$this->input->post('OrderId'),
				);
        		//print_r($where);
        		$data['Data']=$this->mm->get_a_data_join($tblname,$where);
        		$arr=(array)($data['Data']);
				if(!empty($data['Data']))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Order Found";    
        		   
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Address not Added please add address firt "; 
	                $data['Data']=0;
        		}
	          
	      }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
    	   	    header('Content-Type: application/json');
    			echo json_encode($data);
	
	        
	}
	public function getCategoryData()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblbanner";
                $whereData=array("tblbanner.CategoryId"=>$this->input->post("CategoryId"));
	            $bannerData['Banner']=$this->mm->get_a_data_join($tblname,$whereData);
	            $bannerDataFinal=array(json_decode(json_encode(($bannerData)),true));
	            
	            $tblname="tblsubcategory";
	            $whereData=array("tblsubcategory.CategoryId"=>$this->input->post("CategoryId"));
	            $categoryData['SubCategory']=$this->mm->get_a_data_join($tblname,$whereData);
	            $categoryDataFinal=array(json_decode(json_encode(($categoryData)),true));
	            
	            
	            
	            $arrayFinal=array_merge(($bannerDataFinal),($categoryDataFinal));
	            
	            $data['Data']=$arrayFinal;
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	public function getSubCategoryData()
	{
	       //kd
	       $data['Data']=null;
	       $d=array();
            try
	         { 
	            $tblname="tblproduct";
                $whereData=array("tblproduct.SubcategoryId"=>$this->input->post("SubcategoryId"));
	            $productData=$this->mm->get_a_data_inner_join($tblname,$whereData);
	            //samundar
	            for($i=0;$i<count($productData);$i++)
	            {
	                $d[]=$productData[$i]->ProductId;
	            }
                $arrayFinal=array();
                $productData1=array();
                
	            for($i=0;$i<count($d);$i++)
	            {
    	            $tblname="tblpurchasedetail";
                    $whereData=array("tblpurchasedetail.ProductId"=>$d[$i]);
                  //  print_r($whereData);
    	           $tmp_data=convert_object_array($this->mm->get_a_data_join($tblname,$whereData));
	             $productData1[]=$tmp_data[0];
	               // array_push($productData1,$tmp_data[0]);
	            }
                $arrayFinal=$productData1;
	            //print_r($productData1);
	            //samundar end
	            $arr=(array)($arrayFinal);
	            
	            $dataFilter=array();
	            $limit=10;
        	//	$dataFilter=$this->fetch_packinfo($arr,$limit);
        	    $dataFilter=$arr;
        		/*for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    
            		    if((strcmp($key,"ProductId"))==0)
            		    {
            		        $productId=$value;
            		        $tblnameInner="tblproductdetail";
                            $whereDataInner=array("tblproductdetail.ProductIdReference"=>$value);
            	            $productDataDetail=$this->mm->get_a_data_join($tblnameInner,$whereDataInner);
            	            $dataFilter[$i][$key]=$value;
            	            $arr2=(array)($productDataDetail);
            	            //$dataFilter[$i][$key]=$value;
            	            
            	            //$dataFilter[$i]["PackInfo"]=($productDataDetail);
            	            for($j=0;$j<count($arr2);$j++)
                    		{
                        		foreach($arr2[$j] as $key2=>$value2)
                        		{    
                        		    if((strcmp($key2,"ProductdetailImages"))==0)
                        		    {       
                        		            $imageData=explode(",",$value2);
            		                        $dataFilter2[$j][$key2]=(json_decode(json_encode(($imageData)),true));
            		                }
            		                else
            		                        $dataFilter2[$j][$key2]=$value2;
                        		}
                    		}$dataFilter[$i]["PackInfo"]=($dataFilter2);
                    		
            		    }
            		    else if((strcmp($key,"ProductImages"))==0)
            		    {   $imageData=explode(",",$value);
            		        $dataFilter[$i][$key]=$imageData;
            		    }
            		    else if((strcmp($key,"ProductName"))==0)
            		    {   $proName=str_replace("^","'",$value);
            		        $dataFilter[$i][$key]=$proName;
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		    
            		}
        		}*/
    	        $data['Data']=$dataFilter;
    	        
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	public function getProductData()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblproduct";
                $whereData=array("tblproduct.SubcategoryId"=>$this->input->post("SubcategoryId"));
	            $productData=$this->mm->get_a_data_join($tblname,$whereData);
	            $productDataFinal=$productData;
	            
	           /* $tblname="tblsubcategory";
	            $whereData=array("tblsubcategory.CategoryId"=>$this->input->post("CategoryId"));
	            $categoryData['SubCategory']=$this->mm->get_a_data_join($tblname,$whereData);
	            $categoryDataFinal=array(json_decode(json_encode(($categoryData)),true));
	           */ 
	            
	            
	           /* $arrayFinal=array_merge(($bannerDataFinal),($categoryDataFinal));
	           */
	           $arrayFinal=$productDataFinal;
	            $data['Data']=$arrayFinal;
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	public function getPromoCode()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblpromocode";
                //$whereData=array("tblproduct.SubcategoryId"=>$this->input->post("SubcategoryId"));
	            $promoData=$this->mm->get_all_data($tblname);
	            $data['Data']=$promoData;
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	public function getPoints()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblpoints";
                $whereData=array("customerId"=>$this->input->post("CustomerId"));
	            $promoData=$this->mm->get_a_data($tblname,$whereData);
	            $data['Data']=$promoData;
	            
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	public function getPointsTest()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblpoints";
                $whereData=array("customerId"=>$this->input->post("CustomerId"));
	            $promoData=$this->mm->get_a_data($tblname,$whereData);
	            $arr=(array)($promoData);
	            $dataFilter=array();
	            $totEarned=0;
	            $totRedeem=0;
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"PointsType"))==0)
            		    {  
            		        if((strcmp($value,"Earned"))==0)
            		        {   $totEarned=$totEarned+$promoData[$i]->Points;
            		            
            		        }
            		        elseif((strcmp($value,"Redeem"))==0)
            		        {
            		            $totRedeem=$totRedeem+$promoData[$i]->Points;
            		        }
            		        $dataFilter[$i][$key]=$value;
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		}
        		}
    	        //$data['Data']=$dataFilter;
    	        $pointsDetail["Points"]=$dataFilter;
    	       // $pointsTotal["PointsDetail"]=array(json_decode(json_encode("Total"=>$totEarned-$totRedeem),true); 
    	       $pointFinal=array("Total"=>$totEarned-$totRedeem);
    	         $pointsTotal["PointsDetail"]=array(json_decode(json_encode($pointFinal),true)); 
	           //print_r($dataFilter);
	            
	            $arrayFinal=array_merge(array($pointsTotal),array($pointsDetail));
	            $data['Data']=$arrayFinal;
	            
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
    public function getProductDetailData()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblpurchasedetail";
                $whereData=array("tblpurchasedetail.PurchasedetailId"=>$this->input->post("PurchasedetailId"));
	            $productData=$this->mm->get_a_data_join($tblname,$whereData);
	            $productDataFinal=$productData;
	            
	            /*$tblname="tblproductdetail";
                $whereData=array("tblproductdetail.ProductIdReference"=>$this->input->post("ProductId"));
	            $productDataDetail=$this->mm->get_a_data_join($tblname,$whereData);
	            $productDataDetailFinal["Packinfo"]=($productDataDetail);*/
	            
	          
	            $arrayFinal=array_merge(array($productDataFinal/*[0]*/)/*,array($productDataDetailFinal)*/);
	           
	           $arrayFinal=$arrayFinal;
	            $data['Data']=$arrayFinal;
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	//samundar change api for according purchasedetail 06-04-2021
	public function getProductDetailDataTest()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblpurchasedetail";
                $whereData=array("tblpurchasedetail.PurchasedetailId"=>$this->input->post("PurchasedetailId"));
	            $productData=$this->mm->get_a_data_inner_join($tblname,$whereData);
	            $productDataFinal=$productData;
	            
	            /*$tblname="tblproductdetail";
                $whereData=array("tblproductdetail.ProductIdReference"=>$this->input->post("ProductId"));
	            $productDataDetail=$this->mm->get_a_data_join($tblname,$whereData);
	            $productDataDetailFinal["Packinfo"]=($productDataDetail);*/
	            
	          
	           // $arrayFinal=array_merge(array($productDataFinal/*[0]*/)/*,array($productDataDetailFinal)*/);
	           
	           $arrayFinal=$productDataFinal;
	            $data['Data']=$arrayFinal;
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	//samundar end
	public function getProductDetailDataTestold()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblproduct";
                $whereData=array("tblproduct.ProductId"=>$this->input->post("ProductId"));
	            $productData=$this->mm->get_a_data_join($tblname,$whereData);
	            //print_r($whereData);
	            $arr1=(array)($productData);
	            /*$dataFilter1=array();
        		for($i1=0;$i1<count($arr1);$i1++)
        		{
            		foreach($arr1[$i1] as $key=>$value)
            		{    
            		    if((strcmp($key,"ProductImages"))==0)
            		    {   $imageData=explode(",",$value);
            		        $dataFilter1[$i1][$key]=$imageData;
            		        
            		    }
            		    else
            		         $dataFilter1[$i1][$key]=$value;
            		}
        		}
    	        $productDataFinal=$dataFilter1;*/
	            $productDataFinal=$arr1;
	            
	            /*$tblname="tblproductdetail";
                $whereData=array("tblproductdetail.ProductIdReference"=>$this->input->post("ProductId"));
	            $productDataDetail=$this->mm->get_a_data_join($tblname,$whereData);
	            */
	            $productDataDetail[]=array("ProductdetailId"=>13,"ProductIdReference"=>3,"ProductdetailImages"=>"crocin-500x500.jpg,crocin-500x500.jpg,crocin-500x500.jpg");
	            
	            $productDataDetailFinal["Packinfo"]=($productDataDetail);
	           // check_p($productDataDetailFinal);
	            $arr=(array)($productDataDetailFinal["Packinfo"]);
	            $dataFilter=array();
        		for($i=0;$i<count($arr);$i++)
        		{
            		foreach($arr[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"ProductdetailImages"))==0)
            		    {   $imageData=explode(",",$value);
            		        $dataFilter[$i][$key]=$imageData;
            		        
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		}
        		}
    	        //$data['Data']=$dataFilter;
    	        $productDataDetailFinalImages["PackInfo"]=$dataFilter;
	           //print_r($dataFilter);
	             if(isset($productDataFinal[0]))
	                $arrayFinal=array_merge(array($productDataFinal[0]),array($productDataDetailFinalImages));
	            else
	                $arrayFinal=array();    
	            //$arrayFinal=array_merge(array($productDataFinal[0]),array($productDataDetailFinalImages));
	           
	           //$arrayFinal=$arrayFinal;
	           
	           //temp variable
	            
	          //  $arrayFinal=json_decode(json_encode($arrayFinal));
	            
	            $data['Data']=$arrayFinal;
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	
	//samundar add for remove packinfo and productdetails 18-03-2021
	public function getProductDetailDataTestNew()
	{
	       //kd
	       $data['Data']=null;
            try
	         { 
	            $tblname="tblproduct";
                $whereData=array("tblproduct.ProductId"=>$this->input->post("ProductId"));
	            $productData=$this->mm->get_a_data_join($tblname,$whereData);
	            //print_r($whereData);
	            $arr1=(array)($productData);
	            $productDataFinal=$arr1;
	            /*print_r($arr1);
	            die();*/
	            $dataFilter=array();
        		for($i=0;$i<count($arr1);$i++)
        		{
            		foreach($arr1[$i] as $key=>$value)
            		{    
            		    if((strcmp($key,"ProductImages"))==0)
            		    {   $imageData=explode(",",$value);
            		        $dataFilter[$i][$key]=$imageData;
            		        
            		    }
            		    else
            		         $dataFilter[$i][$key]=$value;
            		}
        		}
	             if(isset($productDataFinal[0]))
	                $arrayFinal=array_merge(array($dataFilter[0]));
	            else
	                $arrayFinal=array();    
	            
	            
	            $data['Data']=$arrayFinal;
	            $arr=(array)($data['Data']);
        		if(!empty($arr))
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="Success Data Found";    
        		    
        		}
        		else
        		{
        		    $data['IsSuccess']=true;
	                $data['Message']="No Data Found ";    
        		}
	    
        }
        catch(Exception $e) {
            $data['Message']=$e->getMessage();
            $data['IsSuccess']=false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
		    
	}
	//samundar end
	//Mobile App API Stop
	
	//Mobile App API Stop
	//kd
	public function get_a_data_old($tblName,$id,$tagName='',$key='',$uniqueId='')
	{
	       
	        
            $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	        $whereData=array($tblName.".".$tableIdName=>$id);
	        $arrayData=array();
	      /*  $allTableDetail=$this->mm->get_custom_join_data($tblName,1);
	        check_p($allTableDetail);
	       */
	        //check_p($tblName);
	        $tableDetailName=$tblName.'detail';
            $tablePresent=$this->mm->check_table_present($tableDetailName);
              //check_p($tableDetailName);
           
            if ($tablePresent)
            {
                $detailTableIdName=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
	            $detailData=array($tableDetailName.'.'.$detailTableIdName=>$id);
              //  $detailData=$this->mm->get_a_data_join($tableDetailName,$detailData);
                $detailData=convert_object_array($this->mm->get_main_data_join($tableDetailName,$detailData));
                $i=0;
                $str='';
                $strFinal='';
                if(strcmp($tagName,"notag")==0)
                    $tagName="label";
                $tblkey=ucfirst(remove("tbl",$tblName).DETAIL_TABLE);
                //check_p($detailData);
                foreach($detailData as $data)
                {   $i++;
                    //removing first n last 2 elemnts
                    $data=array_slice($data, 1, -2, true);
                    $strStart="<tr id='tableRow$i'>";
                    $str='';
                    $label='';
                    foreach($data as $key=>$value)
                    {
                            //echo $key."<br>";
                            $str=$str.get_input_field($key,$tblkey,'3',$tagName,"update".$i,$value);
                           // echo $str;                            
                        
                    }
                    $strEnd="</tr>";
                
                    $strFinal=$strFinal.$strStart.$str.$strEnd;
                        //echo "<pre>";
                      //  echo "asd";
                  //  echo($strFinal);
                    
                }
                //check_p($strFinal);
                //print_r($strFinal);
                $arrayData['AppendString']=$strFinal;
                
                //$data[]=$strFinal;
                //check_p($strFinal);
            }
            //$jsonData[0]=$this->mm->get_a_data_join($tblName,$whereData);
	        $jsonData=$this->mm->get_a_data_join($tblName,$whereData);
            //for datalist 
            $jsonData[0]=get_array_for_datalist(convert_object_array($jsonData[0]),$tableIdName);
            //check_p($jsonData[0]);
           
            //$jsonData=$this->mm->get_a_data_join_datalist($tblName,$whereData);
             if($tagName=="notag")
                   $AjaxSucessData=ajax_success_data_with_key_innerHTML($jsonData[0],$key,$uniqueId);
             else if($tagName=="label")
                $AjaxSucessData=ajax_success_data_with_key_innerHTML($jsonData[0],$key,$uniqueId);
             else
                 $AjaxSucessData=ajax_success_data_with_key($jsonData[0],$key,$uniqueId);               
             //$AjaxSucessDataDemo="$('#PurchaseOrderno').val('asd');";
             $data['AjaxSucessData']=$AjaxSucessData;
              //check_p($AjaxSucessData);
        
                array_push($jsonData,$arrayData);
                array_push($jsonData,$AjaxSucessData);
            //check_p($jsonData);
         echo $data=json_encode($jsonData);
		    
	}
	//kd 2/9/2021 devi motors 
	public function get_a_data($tblName,$id,$tagName='',$key='',$uniqueId='')
	{
            $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
            $whereData=array($tblName.".".$tableIdName=>$id);
	        $arrayData=array();
	      /*  $allTableDetail=$this->mm->get_custom_join_data($tblName,1);
	        check_p($allTableDetail);
	       */
	        //check_p($tblName);
	        $tableDetailName=$tblName.'detail';
            $tablePresent=$this->mm->check_table_present($tableDetailName);
              //check_p($tableDetailName);
           
            if ($tablePresent)
            {
                $detailTableIdName=ucfirst(remove("tbl",$tblName)."Id".DETAIL_COLUMN_REFERNCE);
	            $detailData=array($tableDetailName.'.'.$detailTableIdName=>$id);
              //  $detailData=$this->mm->get_a_data_join($tableDetailName,$detailData);
                $detailData=convert_object_array($this->mm->get_main_data_join($tableDetailName,$detailData));
                $i=0;
                $str='';
                $strFinal='';
                if(strcmp($tagName,"notag")==0)
                    $tagName="label";
                $tblkey=ucfirst(remove("tbl",$tblName).DETAIL_TABLE);
                //check_p($detailData);
                foreach($detailData as $data)
                {   $i++;
                    //removing first n last 2 elemnts
                    $data=array_slice($data, 1, -2, true);
                    $strStart="<tr id='tableRow$i'>";
                    $str='';
                    $label='';
                    foreach($data as $key=>$value)
                    {
                            //echo $key."<br>";
                            $str=$str.get_input_field($key,$tblkey,'3',$tagName,"update".$i,$value);
                           // echo $str;                            
                        
                    }
                    $strEnd="</tr>";
                
                    $strFinal=$strFinal.$strStart.$str.$strEnd;
                        //echo "<pre>";
                      //  echo "asd";
                  //  echo($strFinal);
                    
                }
                //check_p($strFinal);
                //print_r($strFinal);
                $arrayData['AppendString']=$strFinal;
                
                //$data[]=$strFinal;
                //check_p($strFinal);
            }
            //$jsonData[0]=$this->mm->get_a_data_join($tblName,$whereData);
	        $jsonData=$this->mm->get_a_data_join($tblName,$whereData);
	       // print_r($jsonData);
            //for datalist 
            
               //kd 2/9/2021 update for key
            $key="Purchase";
	     
            $jsonData[0]=get_array_for_datalist(convert_object_array($jsonData[0]),$tableIdName);
           //print_r($jsonData[0]);
            //$jsonData=$this->mm->get_a_data_join_datalist($tblName,$whereData);
             if($tagName=="notag")
                   $AjaxSucessData=ajax_success_data_with_key_innerHTML($jsonData[0],$key,$uniqueId);
             else if($tagName=="label")
                $AjaxSucessData=ajax_success_data_with_key_innerHTML($jsonData[0],$key,$uniqueId);
             else
                //custom kd 2/9/2021 
                 $AjaxSucessData=ajax_success_data_with_key($jsonData[0],$key,$uniqueId);  
        
             $data['AjaxSucessData']=$AjaxSucessData;
              //check_p($AjaxSucessData);
        
                array_push($jsonData,$arrayData);
                array_push($jsonData,$AjaxSucessData);
            //check_p($jsonData);
         echo $data=json_encode($jsonData);
		    
	}
	public function get_accounts_data($tblName)
	{
	   
	        $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	        $whereData=array($tblName.'.'.$tableIdName=>$this->input->post($tableIdName));
	        $cashData;
	         //check_p();
            //if($this->input->post("LedgerAccountsDataRadio")=="")
            $fromDate=$this->input->post("LedgerFromDate");
            $toDate=$this->input->post("LedgerToDate");
            if($this->input->post("LedgerAccountsDataRadio")=="Master")
            {
                $bankData=$this->mm->get_a_data_join("tblbanktransaction",$whereData,$fromDate,$toDate);
                //print_r($bankData);
               /* $cashData=$this->mm->get_a_data_join("tblcashtransaction",$whereData,$fromDate,$toDate);
                $cashRetailData=$this->mm->get_a_data_join("tblcashretailtransaction",$whereData,$fromDate,$toDate);
                $salesData=$this->mm->get_a_data_join("tblsales",$whereData,$fromDate,$toDate);
                $purchaseData=$this->mm->get_a_data_join("tblpurchase",$whereData,$fromDate,$toDate);*/
                //check_p($cashRetailData);
            }
            else if($this->input->post("LedgerAccountsDataRadio")=="All")
            {
                $bankData=$this->mm->get_a_data_join("tblbanktransaction",$whereData,$fromDate,$toDate);
                /*$cashData=$this->mm->get_a_data_join("tblcashtransaction",$whereData,$fromDate,$toDate);
                $salesData=$this->mm->get_a_data_join("tblsales",$whereData,$fromDate,$toDate);
                $purchaseData=$this->mm->get_a_data_join("tblpurchase",$whereData,$fromDate,$toDate);*/
                
            }
            elseif($this->input->post("LedgerAccountsDataRadio")=="Cashretail")
            {
                $cashRetailData=$this->mm->get_a_data_join("tblcashretailtransaction",$whereData,$fromDate,$toDate);
            }
	        
            
            $data='';
    	    if(!empty($bankData))
    	    {   $bankData=convert_object_array($bankData);
	            $data=$data.convet_array_ledger($bankData,"Banktransaction");
    	    }
    	    if(!empty($cashData))
    	    {   $cashData=convert_object_array($cashData);
    	        $data=$data.convet_array_ledger($cashData,"Cashtransaction");
    	    }
    	    if(!empty($cashRetailData))
    	    {   $cashRetailData=convert_object_array($cashRetailData);
    	        $data=$data.convet_array_ledger($cashRetailData,"Cashretailtransaction");
    	    }
    	    echo ($data);
    }
    public function get_bank_data($tblName)
	{
	        $tblKey=ucfirst(remove("tbl",$tblName));
	        $tableIdName=$tblKey."Id";
	        $whereData=array($tblName.'.'."BankId"=>$this->input->post('BankId'));
	        $cashData;
	         //check_p();
            //if($this->input->post("LedgerAccountsDataRadio")=="")
            $fromDate=$this->input->post("BankLedgerFromDate");
            $toDate=$this->input->post("BankLedgerToDate");
            //check_p($whereData);   
            $bankData=$this->mm->get_a_data_join("tblbanktransaction",$whereData,$fromDate,$toDate);
                //check_p($bankData);
        /*        $cashData=$this->mm->get_a_data_join("tblcashtransaction",$whereData,$fromDate,$toDate);
                $salesData=$this->mm->get_a_data_join("tblsales",$whereData,$fromDate,$toDate);
                $purchaseData=$this->mm->get_a_data_join("tblpurchase",$whereData,$fromDate,$toDate);
            */
            $data='';
    	    if(!empty($bankData))
    	    {   $bankData=convert_object_array($bankData);
	            $data=$data.convet_array_ledger($bankData,"Banktransaction","AC");
    	    }
    	   /* if(!empty($cashData))
    	    {   $cashData=convert_object_array($cashData);
    	        $data=$data.convet_array_ledger($cashData,"Cashtransaction");
    	    }
    	    if(!empty($cashRetailData))
    	    {   $cashRetailData=convert_object_array($cashRetailData);
    	        $data=$data.convet_array_ledger($cashRetailData,"Cashretailtransaction");
    	    }*/
    	    echo ($data);
    }
    public function get_cash_data($tblName)
	{
	        $tblKey=ucfirst(remove("tbl",$tblName));
	        $tableIdName=$tblKey."Id";
	        $whereData=array();
	        $cashData;
	        $fromDate=$this->input->post("CashLedgerFromDate");
            $toDate=$this->input->post("CashLedgerToDate");
            $bankData=$this->mm->get_a_data_join("tblcashtransaction",$whereData,$fromDate,$toDate);
              
            $data='';
    	    if(!empty($bankData))
    	    {   $bankData=convert_object_array($bankData);
	            $data=$data.convet_array_ledger($bankData,"Cashtransaction","AC");
    	    }
    	   
    	    echo ($data);
    }
	public function delete_a_data($tblName,$id)
	{
	      //  check_p($tblName);
            $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	        $data=array($tableIdName=>$id);
	      /*  $allTableDetail=$this->mm->get_custom_join_data($tblName,1);
	        check_p($allTableDetail);
	       */ $jsonData=$this->mm->delete_a_data($tblName,$data);
        
         echo $data=json_encode($jsonData);
		    
	}
	
	public function get_a_data_purchase_custom($tblName,$id)
	{
	         $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	        // $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	        $data=array($tableIdName=>$id);
	        $data1=$this->mm->get_a_data_join($tblName,$data);
            $data1=convert_object_array($data1);
            $data2=$this->mm->get_a_data('tblhsn','HsnId',$data1[0]['HsnId']);
            $data2=convert_object_array($data2);
            $mainData=array_merge($data1[0],$data2[0]);
            
	        $jsonData=$mainData;
        
         echo json_encode($jsonData);
		    
	}
	
	public function update_status($tblName,$id) //updating status
	{
	    $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	    $data=array($tableIdName=>$id);
	   $jsonData=$this->mm->update_status($tblName,$data);
         echo json_encode($jsonData);
	 }
	public function get_active_data_name($tblName = '',$fieldName ='')
	{   
	    $tableField=array();
	       $tableField=$this->mm->get_active_data_name($tblName,$fieldName);
	     //   check_p($tableField);  
        return 	$tableField;
	}
	public function get_direct_data($name = '')
	{
	}
	public function get_data($name = '')
	{
	    $tblName="tbl".strtolower($name);
	    check_p($tblName);
	    $tableField=$this->mm->get_table_heading($tblName);
	    $tableField=remove_first_last_field($tableField);
	    $tableName=array();
        foreach($tableField as  $tableFieldcol)
	    {
	            if(check_exact_field($tableFieldcol,'Id')&&!check_exact_field($tableFieldcol,'Email'))
	            {
	              $tableName[]=array("tbl".strtolower(remove("Id",$tableFieldcol)),remove("Id",$tableFieldcol)."Name");
	            }
	    }
    	foreach($tableName as $tableNameData)
    	{  
    	    $tableWithField[$tableNameData[0]]=$this->get_active_data_name($tableNameData[0],$tableNameData[1]);
	    }
	   // check_p(json_encode($tableWithField));
	    if(!empty($tableWithField))
	   {    
	    echo json_encode($tableWithField);
	   }
	}
	public function CreateExcel($data)
	{  
	    //check_p($data);
	    //load our new PHPExcel library
          //  $this->load->library('excel');
            //activate worksheet number 1
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('test worksheet');
            //set cell A1 content with some text
            $this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
             
            $filename='just_some_random_name.xls'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
                        
            //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
            //if you want to save it as .XLSX Excel 2007 format
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            //force user to download the Excel file without writing it to server's HD
            $objWriter->save('php://output');
   	}
   	public function insert_data_function($tableField,$uniqueId='',$lastInsertId='',$tableName='')
	{
	            $dataTableField=array();
	            //check_p($tableField);
	            foreach($tableField as  $tableFieldcol)
	            {
    	            if(check_field($tableFieldcol,'Image')||check_field($tableFieldcol,'Logo')||(stripos($tableFieldcol,'Document')!==false)||(stripos($tableFieldcol,'Proof')!==false)||(stripos($tableFieldcol,'PDF')!==false))
    	            {
    	                 if($this->upload->do_upload($tableFieldcol.$uniqueId))
        		         {   
        		        	$udata=$this->upload->data();
        			        $dataTableField[$tableFieldcol]=$udata['file_name'];
        		         }
        		         else
        		         {
        		                if($this->input->post($tableFieldcol."Name"))
        		                {  //check_p($this->input->post($tableFieldcol."Name"));
        		                  
        		                        $dataTableField[$tableFieldcol]=$this->input->post($tableFieldcol."Name".$uniqueId);
        		                }
        		                else
        		                {  // check_p($this->input->post($tableFieldcol."Name"));
        		                    $dataTableField[$tableFieldcol]="no_img.jpg";
        		                }    		                
        		         }
    	            }
    	            else if(check_field($tableFieldcol,DETAIL_COLUMN_REFERNCE))
    	            {
    	                    //$dataTableField[$tableFieldcol]=$lastInsertId;
    	                    if($lastInsertId)
    	                        $dataTableField[$tableFieldcol]=$lastInsertId;
    	                    else
    	                      $dataTableField[$tableFieldcol]=($this->input->post($tableFieldcol.$uniqueId)==NULL)?'':$this->input->post($tableFieldcol.$uniqueId);
    	                
    	            }
    	           /* else if((strpos($tableFieldcol,'Id')!==false)&&!(stripos($tableFieldcol,'Email')!==false))
    	            {
    	               
    	                $dataTableField[$tableFieldcol]=($this->input->post($tableFieldcol.$uniqueId)==NULL)?'':substr($this->input->post($tableFieldcol.$uniqueId), 0, strpos($this->input->post($tableFieldcol.$uniqueId), '-'));
    	                  //echo $tableFieldcol.$dataTableField[$tableFieldcol];
    	                  //$dataId=$this->mm->get_id($tableName,$selectedCol,$whereCol,$whereData);
                       // echo $dataTableField[$tableFieldcol]."id wala";                      
    	                    //$dataTableField[$tableFieldcol]=$lastInsertId;
    	            }*/
    	            else if(check_exact_field($tableFieldcol,'MemberNo')&&!check_exact_field($tableFieldcol,'MemberNoOfMembers'))
    	            {
    	                //$dataTableField[$tableFieldcol]=($this->input->post($tableFieldcol.$uniqueId)==NULL)?'':$this->input->post($tableFieldcol.$uniqueId);
    	                
    	                $data=($this->input->post($tableFieldcol.$uniqueId)==NULL)?'':$this->input->post($tableFieldcol.$uniqueId);
    	                
    	                /*echo "Last";
    	                print_r($tableFieldcol.$data[0]);
    	                */$dataTableField[$tableFieldcol]=preg_replace("/[^0-9]/", '', $data);
    	                
    	            }
    	            else 
    	            {
    	            
    	                 $dataTableField[$tableFieldcol]=($this->input->post($tableFieldcol.$uniqueId)==NULL)?'':$this->input->post($tableFieldcol.$uniqueId);
    	                 //   echo $dataTableField[$tableFieldcol]."normal";  
    	            }
	           
	            }
	            return $dataTableField;
	        }
	public function insert_data($name = '',$detailArray='')  //inserting a data in table
	{
		$colName=strtolower($name);
		$tblName="tbl".$colName; 

		$tableField=$this->mm->get_table_heading($tblName);
		$tableField=remove_last_field($tableField,2);

		$dataTableField=array();
		$lastInsertId;
		$dataTableField=$this->insert_data_function($tableField);

		$dataTableField[ucfirst($name."CDT")]=date('Y-m-d H:i:s');
		$dataTableField[ucfirst($name."Status")]=0;
		if(isset($this->session->CompanyId)){
			$dataTableField["CompanyId"]=$this->session->CompanyId;
		}
		
		else{
		//	$dataTableField["CompanyId"]=$this->session->CompanyId;	
		}
		
		//samundar add code for company profile update 24-04-2021
		if($colName=='company' && empty($dataTableField["CompanyCode"]))
		{
			$a=$dataTableField['CompanyId'];
			$lrdata=$this->mm->custom_query("SELECT CompanyCode FROM tblcompany where CompanyId=$a");
			$dataTableField["CompanyCode"]=$lrdata[0]['CompanyCode'];
		}
		
		
		//kd  insert in  all going  wrong  please change 3/28/2021
		if($colName=='product')
		{
			$a=$dataTableField['CompanyId'];
			if(strpos($a,'-')!==false)
			{
				// echo "false".$a;
			}
			else
			{
				
				$tableField1=$this->mm->get_table_heading('tblcompany');
				$tableField1=remove_last_field($tableField,2);
				$dataTableField1["CompanyName"]=$a;
				$dataTableField1[ucfirst('Company'."CDT")]=date('Y-m-d H:i:s');
				$dataTableField1[ucfirst('Company'."Status")]=0;
				$lastInsertId1=$this->mm->insert_data('tblcompany',$dataTableField1);
				$demo=$lastInsertId1.'-'.$a;
				$dataTableField['CompanyId']=$demo;
			}
		}
		else if($colName=='order')
		{
			$dataTableField['Companies'] = strstr($_POST["CompaniesId"], '-', true);

			$cid=$dataTableField["CompanyId"];
			//echo "=============".$cid;
			$lrdata=$this->mm->custom_query("SELECT MAX(OrderLRNO) AS LastLrno FROM tblorder where CompanyId=$cid");
			//print_r($lrdata);
			if($lrdata[0]['LastLrno'] == NULL)
			{
				$dataTableField['OrderLRNO']=1;
			}
			else
			{
				$dataTableField['OrderLRNO']=$lrdata[0]['LastLrno'] + 1;
			}
		}
		else if($colName=='orderpallet')
		{
			$dataTableField['Companies'] = strstr($_POST["CompaniesId"], '-', true);
			$cid=$dataTableField["CompanyId"];
			//echo "=============".$cid;
			$lrdata=$this->mm->custom_query("SELECT MAX(OrderpalletLRNOauto) AS LastLrno FROM tblorderpallet where CompanyId=$cid");
			//print_r($lrdata);
			if($lrdata[0]['LastLrno'] == NULL)
			{
				$dataTableField['OrderpalletLRNOauto']=1;
			}
			else
			{
				$dataTableField['OrderpalletLRNOauto']=$lrdata[0]['LastLrno'] + 1;
			}
		}

		//samundar end
		if($this->input->post($tableField[0])!=NULL)
		{
			$data=$this->mm->update_data($tblName,$dataTableField,$tableField[0],$this->input->post($tableField[0]));
			$lastInsertId=$this->input->post($tableField[0]);
			$tableDetailName='tbl'.$name.'detail';
			$tablePresent=$this->mm->check_table_present($tableDetailName);

			if ($tablePresent)
			{

				$detailArray=explode(',',($_POST['DetailArray']));
				$tableField=$this->mm->get_table_heading($tableDetailName);

				$tableField=remove_last_field($tableField,2);
				$multiData=array();     
				$dataTableWhere=array();
				$dataTableNewField=array();
				$dataTableField=array();
				$insertNewData=array();
				
				foreach($detailArray as $value)
				{
					
					$dataTableField=$this->insert_data_function($tableField,$value,$lastInsertId,$tableDetailName);
					//samundra end
				
					if( $tableDetailName !='tblorderpalletdetail' && $dataTableField[ucfirst($name.'detailId')] == '' && $dataTableField[ucfirst($name.'detailProductName')] != '')
						array_push($insertNewData,$dataTableField);
					else
						array_push($multiData,$dataTableField);
				}
				//samundar add for order table update 02-06-2012
				$totalBox=0;
				$totalWeight=0;
				if($tableDetailName=='tblorderdetail')
				{	
					for($i=0;$i<count($multiData);$i++)
					{
						if(($multiData[$i]['OrderdetailProductName']==''))
						{
							unset($multiData[$i]);

						}
						else{
						
						if($multiData[$i]['OrderdetailBox'] == '')
						{
							$multiData[$i]['OrderdetailBox'] = 0;
						}
						if($multiData[$i]['OrderdetailWeight'] == '')
						{
							$multiData[$i]['OrderdetailWeight'] = 0;
						}

						$totalBox=$totalBox +((int)$multiData[$i]['OrderdetailBox']);
						$totalWeight=$totalWeight +($multiData[$i]['OrderdetailWeight']);
						
						$arr[$i]['OrderdetailId']=$multiData[$i]['OrderdetailId'];
						$arr[$i]['OrderIdReference']=$multiData[$i]['OrderIdReference'];
						$arr[$i]['OrderdetailProductName']=$multiData[$i]['OrderdetailProductName'];
						$arr[$i]['OrderdetailBox']=$multiData[$i]['OrderdetailBox'];
						$arr[$i]['OrderdetailName']=$multiData[$i]['OrderdetailName'];
						$arr[$i]['OrderdetailWeight']=$multiData[$i]['OrderdetailWeight'];
						$arr[$i]['OrderdetailDcpiNo']=$multiData[$i]['OrderdetailDcpiNo'];
						}
						
					}
					
					//samundar add for order table update
					$id=$multiData[0]['OrderIdReference'];
					$lrdata=$this->mm->custom_query("SELECT * FROM tblorder where OrderId=$id");

					$orderTotal=0;
					if($lrdata[0]['OrderRateDropDown']=='Weight')
					{
						$orderTotal=($totalWeight * $lrdata[0]['OrderRate']) +(int) $lrdata[0]['OrderHamali'] +(int) $lrdata[0]['OrderFreight']; 
					}
					else
					{
						$orderTotal=($totalBox * $lrdata[0]['OrderRate']) +(int) $lrdata[0]['OrderHamali'] +(int) $lrdata[0]['OrderFreight'];
					}

					$tblname1='tblorder';
					$whereData1=array(  
					'OrderId'=>$multiData[0]['OrderIdReference'],
					);
					$mainData1=array(
						'OrderTotalBoxes'=>$totalBox,
						'OrderTotalWeight'=>$totalWeight,
						'OrderTotal'=>$orderTotal,
						'OrderYear'=>$this->session->LoginYear,
					);
					$data1['Data']=$this->mm->update_data_api($tblname1,$mainData1,$whereData1);
				}
				
				if($tableDetailName=='tblorderpalletdetail')
				{	//$k=0;
					$totalPalletQty=0;
					for($i=0;$i<count($multiData);$i++)
					{
						if(($multiData[$i]['OrderpalletdetailId']==''))
						{
							unset($multiData[$i]);
						}
						else
						{
							$totalPalletAmount=0;
							//$data2['Data']=array();
							$totalPalletAmount=$totalPalletAmount +($multiData[$i]['OrderpalletdetailQty'] *  $multiData[$i]['OrderpalletdetailRate']);
							$totalPalletQty=$totalPalletQty +($multiData[$i]['OrderpalletdetailQty']);
							$multiData[$i]['OrderpalletdetailTotal']=$totalPalletAmount;
						}
					}
					$tblname='tblorderpallet';
					$updateData=array(  
					'OrderpalletTotalQty'=>$totalPalletQty,
					); 
					$where=array(  
						'OrderpalletId'=>$multiData[0]['OrderpalletIdReference']
					); 
					$OrderpalletInsertId1=$this->mm->update_data_api($tblname,$updateData,$where);
				}
				if(!empty($multiData))
					$data=$this->mm->update_multiple_data($tableDetailName,$multiData,ucfirst($name.'detailId'));
				if(!empty($insertNewData))
					$data=$this->mm->insert_multiple_data($tableDetailName,$insertNewData);
			}
			
			//samundar add for update detail2 table in orderpalletdetail2 02-06-2021\
			$tableDetailName1='tbl'.$name.'detail2';
			$tablePresent=$this->mm->check_table_present($tableDetailName1);
			// check_p($tablePresent);
			if ($tablePresent)
			{
				//check_p($tableDetailName);
				$detailArray=explode(',',($_POST['DetailArray2']));
				$tableField=$this->mm->get_table_heading($tableDetailName1);
				//check_p($detailArray);
				$tableField=remove_last_field($tableField,2);
				$multiData=array();     
				$dataTableWhere=array();
				$dataTableNewField=array();
				$dataTableField=array();
				$insertNewData=array();
				
				foreach($detailArray as $value)
				{
					$dataTableField=$this->insert_data_function($tableField,$value,$lastInsertId,$tableDetailName);
				
					if( $tableDetailName1 =='tblorderpalletdetail2' && $dataTableField[ucfirst($name.'detail2Name')] != '')
						array_push($multiData,$dataTableField);
					else
						array_push($insertNewData,$dataTableField);
				}
				if(!empty($multiData))
					$data=$this->mm->update_multiple_data($tableDetailName1,$multiData,ucfirst($name.'detail2Id'));
			}
			//samundar end
		}
		else
		{ 
			//kd double entery for accounts
			$accountsCrKey=array("dealer");
			// check_p($dataTableField);
			$lastInsertId=$this->mm->insert_data($tblName,$dataTableField);

			if((strcmp($tblName,"tblpurchase"))==0)
			{
				
				$inventoryData["InventorytransactionBillNo"]=$lastInsertId;
				$inventoryData["InventorytransactionTypeDropDown"]="Purchase";
				$inventoryData["InventorytransactionTag"]="Purchase Good";
				$inventoryData["InventorytransactionDate"]=date('Y-m-d H:i:s');
				$inventoryData["InventorytransactionStatus"]=0;
				$inventoryData["InventorytransactionCDT"]=date('Y-m-d H:i:s');
				//
				$detailArray=explode(',',($_POST['DetailArray']));
				$tableField=$this->mm->get_table_heading('tblpurchasedetail');
				//check_p($detailArray);
				$tableField=remove_last_field($tableField,2);
				$multiData=array();     
				foreach($detailArray as $value)
				{
					$dataTableField=array();
					$dataTableField=$this->insert_data_function($tableField,$value,$lastInsertId);
					$dataTableField[ucfirst($name."detail"."CDT")]=date('Y-m-d H:i:s');
					$dataTableField[ucfirst($name."detail"."Status")]=0;
					//$data=$this->mm->insert_data($tableDetailName,$dataTableField);
					
					array_push($multiData,$dataTableField);
					//   print_r($data)
					
				}
				foreach($multiData[0] as $key=>$value)
				{
					//print_r($key);
					if((strcmp($key,"ProductId"))==0)
					{
							$pos1=strpos($value,"-");
							$sub1=substr($value,0,$pos1);
						$inventoryData["ProductId"]=$sub1;
					}
					else if((strcmp($key,"PurchaseProductQty"))==0)
					{
						$inventoryData["InventorytransactionProductQty"]=$value;
					}
				}
				//check_p($inventoryData);
				
				//
				$AccountlastInsertId=$this->mm->insert_data("tblinventorytransaction",$inventoryData);
				
			}
			//samundar end
			
			
			// echo $lastInsertId;
			$tableDetailName='tbl'.$name.'detail';
			$tablePresent=$this->mm->check_table_present($tableDetailName);

			if ($tablePresent)
			{
				$detailArray=explode(',',($_POST['DetailArray']));
				$tableField=$this->mm->get_table_heading($tableDetailName);
				
				$tableField=remove_last_field($tableField,2);

				$multiData=array();     
				foreach($detailArray as $value)
				{
					$dataTableField=array();
					$dataTableField=$this->insert_data_function($tableField,$value,$lastInsertId);
					$dataTableField[ucfirst($name."detail"."CDT")]=date('Y-m-d H:i:s');
					$dataTableField[ucfirst($name."detail"."Status")]=0;

					array_push($multiData,$dataTableField);
					if(isset($dataTableField['ProductId']))
					{
					$productId=$dataTableField['ProductId'];
					}
					else{
					$productId='';
					}

					if($productId!='')
					{
						if(strpos($productId,'-')!==false)
						{
							// echo "false".$productId;
						}
						else
						{
							
							$tableField1=$this->mm->get_table_heading('tblproduct');
							$tableField1=remove_last_field($tableField,2);
							$dataTableField1["ProductName"]=$productId;
							$dataTableField1["CompanyId"]=$this->session->CompanyId;
							$dataTableField1[ucfirst('Product'."CDT")]=date('Y-m-d H:i:s');
							$dataTableField1[ucfirst('Product'."Status")]=0;
							$lastInsertId1=$this->mm->insert_data('tblproduct',$dataTableField1);
							$demo=$lastInsertId1.'-'.$productId;
							$dataTableField['ProductId']=$demo;
						}
					}
				} 
				$arr=array();
				//create array for store orderpalletqty 04-05-2021
				$pQty=array();
				if($tableDetailName=='tblorderpalletdetail')
				{	//$k=0;
					$totalPalletQty=0;
					for($i=0;$i<count($multiData);$i++)
					{
						if(($multiData[$i]['OrderpalletdetailQty']=='') || ($multiData[$i]['OrderpalletdetailRate']==''))
						{
							unset($multiData[$i]);
						}
						else{
						
						$totalPalletAmount=0;
						$totalPalletAmount=$totalPalletAmount +($multiData[$i]['OrderpalletdetailQty'] *  $multiData[$i]['OrderpalletdetailRate']);
						$totalPalletQty=$totalPalletQty +($multiData[$i]['OrderpalletdetailQty']);
						$multiData[$i]['OrderpalletdetailTotal']=$totalPalletAmount;
						//$k++;
						$arr[$i]['OrderpalletdetailId']=$multiData[$i]['OrderpalletdetailId'];
						$arr[$i]['OrderpalletIdReference']=$multiData[$i]['OrderpalletIdReference'];
						$arr[$i]['OrderpalletdetailQty']=$multiData[$i]['OrderpalletdetailQty'];
						$arr[$i]['OrderpalletdetailRate']=$multiData[$i]['OrderpalletdetailRate'];
						$arr[$i]['OrderpalletdetailTotal']=$multiData[$i]['OrderpalletdetailTotal'];
						$arr[$i]['OrderpalletdetailCDT']=$multiData[$i]['OrderpalletdetailCDT'];
						$arr[$i]['OrderpalletdetailStatus']=$multiData[$i]['OrderpalletdetailStatus'];
						}
						
					}
					$tblname='tblorderpallet';
					$updateData=array(  
					'OrderpalletTotalQty'=>$totalPalletQty,
					); 
					$where=array(  
						'OrderpalletId'=>$multiData[0]['OrderpalletIdReference']
					); 
					$OrderpalletInsertId1=$this->mm->update_data_api($tblname,$updateData,$where);
					
				}
				
				$totalBox=0;
				$totalWeight=0;
				if($tableDetailName=='tblorderdetail')
				{	
					for($i=0;$i<count($multiData);$i++)
					{
						if(($multiData[$i]['OrderdetailProductName']==''))
						{
							unset($multiData[$i]);

						}
						else{
						
						if($multiData[$i]['OrderdetailBox'] == '')
						{
							$multiData[$i]['OrderdetailBox'] = 0;
						}
						if($multiData[$i]['OrderdetailWeight'] == '')
						{
							$multiData[$i]['OrderdetailWeight'] = 0;
						}

						$totalBox=$totalBox +((int)$multiData[$i]['OrderdetailBox']);
						$totalWeight=$totalWeight +($multiData[$i]['OrderdetailWeight']);
						
						$arr[$i]['OrderdetailId']=$multiData[$i]['OrderdetailId'];
						$arr[$i]['OrderIdReference']=$multiData[$i]['OrderIdReference'];
						$arr[$i]['OrderdetailProductName']=$multiData[$i]['OrderdetailProductName'];
						$arr[$i]['OrderdetailBox']=$multiData[$i]['OrderdetailBox'];
						$arr[$i]['OrderdetailName']=$multiData[$i]['OrderdetailName'];
						$arr[$i]['OrderdetailWeight']=$multiData[$i]['OrderdetailWeight'];
						$arr[$i]['OrderdetailDcpiNo']=$multiData[$i]['OrderdetailDcpiNo'];
						$arr[$i]['OrderdetailCDT']=$multiData[$i]['OrderdetailCDT'];
						$arr[$i]['OrderdetailStatus']=$multiData[$i]['OrderdetailStatus'];
						}
						
					}
					
				}
				if($tableDetailName=='tblorderpalletdetail' || $tableDetailName=='tblorderdetail')
				{
					$data=$this->mm->insert_multiple_data($tableDetailName,$arr);
				}
				else{
					$data=$this->mm->insert_multiple_data($tableDetailName,$multiData);
				}
				
				
				if($tblName=='tblorder')
				{
					$lrdata=$this->mm->custom_query("SELECT * FROM tblorder where OrderId=$lastInsertId");

						$orderTotal=0;
					if($lrdata[0]['OrderRateDropDown']=='Weight')
					{
						$orderTotal=($totalWeight * $lrdata[0]['OrderRate']) +(int) $lrdata[0]['OrderHamali'] +(int) $lrdata[0]['OrderFreight']; 
					}
					else
					{
						$orderTotal=($totalBox * $lrdata[0]['OrderRate']) +(int) $lrdata[0]['OrderHamali'] +(int) $lrdata[0]['OrderFreight'];
					}

					$tblname1='tblorder';
					$whereData1=array(  
					'OrderId'=>$lastInsertId,
					);
					$mainData1=array(
						'OrderTotalBoxes'=>$totalBox,
						'OrderTotalWeight'=>$totalWeight,
						'OrderTotal'=>$orderTotal,
						'OrderYear'=>$this->session->LoginYear,
					);
					$data1['Data']=$this->mm->update_data_api($tblname1,$mainData1,$whereData1);
				}
				
			}
			$tableDetailName='tbl'.$name.'detail2';
			$tablePresent=$this->mm->check_table_present($tableDetailName);
			if ($tablePresent)
			{
				$detailArray=explode(',',($_POST['DetailArray2']));
				$tableField=$this->mm->get_table_heading($tableDetailName);
				$tableField=remove_last_field($tableField,2);
				$multiData=array();
				$multiData1=array();
				foreach($detailArray as $value)
				{
					$dataTableField=array();
					$dataTableField=$this->insert_data_function($tableField,$value,$lastInsertId);
					$dataTableField[ucfirst($name."detail2"."CDT")]=date('Y-m-d H:i:s');
					$dataTableField[ucfirst($name."detail2"."Status")]=0;

					if( $tableDetailName =='tblorderpalletdetail2' && $dataTableField[ucfirst($name.'detail2Name')] != '' && $dataTableField[ucfirst($name.'detail2Qty')] != '')
						array_push($multiData,$dataTableField);
					else
						array_push($multiData1,$dataTableField);
					
				}
				
				//check_p($multiData);
				if($tableDetailName =='tblorderpalletdetail2')
					$data=$this->mm->insert_multiple_data($tableDetailName,$multiData);
				else
					$data=$this->mm->insert_multiple_data($tableDetailName,$multiData1);
			}
			
		}
	    echo  $lastInsertId;
	}
	
	// samundar add 22-03-2021
	public function samu($name = '',$detailArray='')  //inserting a data in table
	{      
	        $tblname=strtolower($name);
	       // print_r($detailArray);
	        $productData = str_replace("%20"," ",$detailArray);
	       // print_r($productData);
	        $where=array('tblproduct.ProductName'=>$productData);
	        $data1=$this->mm->get_a_data($tblname,$where);
	       // echo count($data);
	        if(count($data1)>0)
	        {
	            echo $data=2;
	        }
	        else
	        {
	            echo  $data=0;
	        }
	}
	//samundar end
	public function insert_same_data($name = '',$detailArray='')  //inserting a data in table
	{       
	        $qry=$this->mm->get_last_query_executed();
	        //echo $qry."asd"; 
	        //check_p($qry);
	        
	        $colName=strtolower($name);
	        $tblName="tbl".$colName; 
	        $tableField=$this->mm->get_table_heading($tblName);
	        $tableField=remove_last_field($tableField,2);
	       // $tableField=remove_first_field($tableField);
	        $dataTableField=array();
	        $dataTableField=$this->insert_data_function($tableField);
	        $dataTableField[ucfirst($name."CDT")]=date('Y-m-d H:i:s');
	        $dataTableField[ucfirst($name."Status")]=0;
	       //check_p($this->input->post($tableField[0]));
	       if($this->input->post($tableField[0])!=NULL)
	       { //UPDATE DATA
              //  echo "Update Data";
              //check_p($this->input->post($tableField[0]));
                //check_p($dataTableField);
                $data=$this->mm->update_data($tblName,$dataTableField,$tableField[0],$this->input->post($tableField[0]));
	            $lastInsertId=$this->input->post($tableField[0]);
	            $tableDetailName='tbl'.$name.'detail';
                $tablePresent=$this->mm->check_table_present($tableDetailName);
                if ($tablePresent)
                {
                    //check_p($tableDetailName);
                    $detailArray=explode(',',($_POST['DetailArray']));
	                $tableField=$this->mm->get_table_heading($tableDetailName);
            	    //check_p($detailArray);
            	    $tableField=remove_last_field($tableField,2);
            	    $multiData=array();     
	                foreach($detailArray as $value)
	                {
	                    $dataTableField=array();
            	        $dataTableField=$this->insert_data_function($tableField,$value,$lastInsertId,$tableDetailName);
            	        $dataTableField[ucfirst($name."detail"."CDT")]=date('Y-m-d H:i:s');
            	        $dataTableField[ucfirst($name."detail"."Status")]=0;
            	        //$data=$this->mm->insert_data($tableDetailName,$dataTableField);
            	        //echo $data;
            	        array_push($multiData,$dataTableField);
	                }
	                //check_p($multiData);
	                $data=$this->mm->insert_multiple_data($tableDetailName,$multiData);
	           }
	           
	       }
	       else
	       {  //INSERT NEW DATA
              // echo "Insert Data";
             // check_p($dataTableField);
                $lastInsertId=$this->mm->insert_data($tblName,$dataTableField);
               // echo $lastInsertId;
                $tableDetailName='tbl'.$name.'detail';
                $tablePresent=$this->mm->check_table_present($tableDetailName);
                if ($tablePresent)
                {
                  //  check_p($lastInsertId);
                    $detailArray=explode(',',($_POST['DetailArray']));
	                $tableField=$this->mm->get_table_heading($tableDetailName);
            	    //check_p($tableField);
            	    $tableField=remove_last_field($tableField,2);
            	    $multiData=array();     
	                foreach($detailArray as $value)
	                {
	                    $dataTableField=array();
            	        $dataTableField=$this->insert_data_function($tableField,$value,$lastInsertId);
            	        $dataTableField[ucfirst($name."detail"."CDT")]=date('Y-m-d H:i:s');
            	        $dataTableField[ucfirst($name."detail"."Status")]=0;
            	        //$data=$this->mm->insert_data($tableDetailName,$dataTableField);
            	       ;
            	        array_push($multiData,$dataTableField);
	                  //   print_r($data)
	                    
	                }
	               // check_p($multiData);
	                $data=$this->mm->insert_multiple_data($tableDetailName,$multiData);
	           }
	       }
	       //check_p($data);
	        echo  1;
	}
	public function get_last_id($mainTblName,$tblName,$whereData)
	{   
	        $whereColumn=ucfirst(remove("tbl",$tblName)."Id");
	        $where=array($whereColumn=>$whereData);
	        $data=$this->mm->get_last_id($mainTblName,'MemberNo',$where);
            
            //check_p($data) ; 
            echo json_encode($data);
	        
	}
	
	public function deleteData($id,$keyname)
	{   
	       $id=$id;
	       $tableName="tbl".strtolower($keyname);
	       $keyName=ucfirst($keyname);
	        
	            $updateData=array(  
    					$keyName.'Status'=>1,
        		); 
        		$where=array(  
    					$keyName.'Id'=>$id,
        		); 
        		$data['Data']=$this->mm->update_data_api($tableName,$updateData,$where);
	       
            echo json_encode($data);
	        
	}
	
	public function GetAllDataForProductDetail()
	{
	  
	    $tblName='tblorder';
	    $where=array("OrderStatus"=>0);
	    $ProductDetaildata['datasource']=($this->mm->get_a_data_join_order_by($tblName,$where,"OrderId","DESC"));
	    //check_p($ProductDetaildata);
	    header('Content-Type: application/json');
		echo json_encode($ProductDetaildata);
	   //print_r(json_decode(json_encode($data), true));
	}

	// sjr add for gst invoice value update 28-12-2023
	public function GstInvoiceUpdate()
	{
		$sql = "UPDATE `tblorder` SET OrderGstInvoice='".$_POST['gstInvoiceNo']."',OrderFromDate='".$_POST['fromDate']."',OrderToDate='".$_POST['toDate']."',OrderBillDate='".$_POST['orderBillDate']."' WHERE OrderId IN (".$_POST['orderId'].")";
		$customerData = $this->mm->custom_query_no_return($sql);
		
		if($customerData > 0)
		{
			echo "1";
			return 1;
		}
		else
		{
			echo "1";
			return 1;
		}
	}
	// sjr end

	// sjr add for gst invoice value update 31-12-2023
	public function GstInvoiceUpdatePallet()
	{
		$sql = "UPDATE `tblorderpallet` SET OrderpalletGstInvoice='".$_POST['gstInvoiceNo']."',OrderpalletFromDate='".$_POST['fromDate']."',OrderpalletToDate='".$_POST['toDate']."',OrderpalletBillDate='".$_POST['orderBillDate']."' WHERE OrderpalletId IN (".$_POST['OrderpalletId'].")";
		$customerData = $this->mm->custom_query_no_return($sql);
		
		if($customerData > 0)
		{
			echo "1";
			return 1;
		}
		else
		{
			echo "1";
			return 1;
		}
	}
	// sjr end
}
