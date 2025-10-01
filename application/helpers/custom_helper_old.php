<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /*new updte start 3/13/2019 GST
    */
    function get_customer_detail_with_GST($data,$whereGSTCol)
    {
        check_p($data);
        foreach( $data as $salesKey=>$salesData)
    	    {  
    	        $reportData[$salesKey]= $salesData;
    	   }
    }
    /*new updte end 3/13/2019
    */
    function check_p($var)
    {
        echo "<pre>";
        print_r($var);
        die();
    }
    function decrypt($key,$encrypted)
    {
        $rawdata = base64_decode($encrypted);
        $iv = $key. "\0\0\0\0";
        $decrypted =  rtrim(openssl_decrypt($rawdata, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv), "\0");
        return $decrypted;
    }  
    function remove_str($str1,$str2)
    {
        return str_replace($str1,"",$str2);   
    }
    function convert_object_array($object)
    {
      return json_decode(json_encode($object), true);
    }
    function check_substr($str1,$str2)
    {
        if(strpos($str1,$str2)!==false)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function check($var)
    {
        if(isset($var))
            return $var;
        else
            return '';
        
    }
    function  is_data($value)
    {
        if(isset($value))
            return $value;
        else
            return '';
    }
    function remove_s($str) //remove space 
    {
        return str_ireplace(" ",'',$str);
    }
    
    function remove($str1,$str2)
    {
    /*    if (substr($str2, 0, strlen($str1)) == $str1) {
          //$str = substr($str, strlen($prefix));
        //return str_ireplace($str1,'',$str2);
          return substr($str2, strlen($str1));  
        }*/ 
        return preg_replace('/'.$str1.'/', '', $str2, 1);;
        //return str_ireplace($str1,'',$str2);
        
        
    }
    function remove_exact($str1,$str2)
    {
        return str_replace($str1,'',$str2);
        
    }
    function replace($str)
    {
        return str_ireplace(' ','-',$str);
        
    }
    
    function header_help($header,$className)
    {
      // check_p($header);
        foreach($header as $headerKey => $headerValue)
				               
				                {   
				                    if(!is_array($headerValue))
				                    {     ?>
				                        	<li><a href="<?=site_url(remove_s($headerKey))?>"><?=$headerValue;?></a></li>
				          <?php     } 
				                    else
				                    {    ?>
                                    	<li><a href="<?=site_url(remove_s($headerKey))?>"><?=remove('home/',$headerKey);?> <?php if(isset($className['forSub'])) echo $className['forSub'];?>
				                          </a>
                                    	  <ul class="<?php if(isset($className['subUl'])) echo $className['subUl'];?>">  
				                        <?php   foreach($headerValue as $headerValueSubKey=>$headerValueSub)
				                                {  ?>
				                                        <li><a href="<?=site_url($headerKey.'/'.replace($headerValueSub))?>"><?=$headerValueSub;?></a></li>
                                                    
				                        <?php   }   ?>
				                        
				                             </ul>
				                       </li>
				                <?php
				                    }
				                }
    }
    function remove_object($object)
    {
        foreach ($object as $key=>$value) 
            $array[$key] = $value;
        return $array;
    }
    function remove_multi_array_append_data_convert_lower($array,$appendData)
    {
        $newArray = array();
        foreach($array as $elements) {
            foreach($elements as $data)
            {
                $newArray[] = $appendData.lcfirst($data);
            }
       
        }
         return $newArray;

    }
    
    
    function remove_multi_array($array)
    {
        $newArray = array();
        foreach($array as $elements) {
            if(is_array($elements))
            {
                foreach($elements as $data)
                {
                    $newArray[] = $data;
                }
            }
        }
         return $newArray;

    }
    function contact_us()
    {
        $data=company_info();
        $data['businessInfo']="Best for project training (BCA,BSC IT,MCA.MSC-IT,MSC ICT)";
        $data['phoneNo']="+918347766166";
        $data['whatsAppNo']="+918347766166";
        $data['mailTo']="admin@webnapmaker.in";
        $data['address']="F-23,agrasen point,near agrasen bhavan, City Light Rd, Surat, Gujarat 395007";
        $data['website']="http://www.doctor.webnappmaker.in";
        $data['mapLink']="https://goo.gl/maps/duZ9jjwXsa82";
        $data['googleMap']="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3720.715169760961!2d72.79220841361952!3d21.163730588535817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04d9f3d348431%3A0xc96b006253d673eb!2sCODE4CODE+(Best+for+BCA+%2F+BSC-IT+%2F+project+training+in+surat)!5e0!3m2!1sen!2sin!4v1548589914814";
        
        return $data;
    }
    function  header_data()
    {
        $data['Home']="Home";
        $data['Home/AboutUs']="About Us";
        $data['Home/Product']="Product";
        $data['Home/Gallery']="Gallery";
        $data['Home/ContactUs']="Contact Us";
        return $data;
    }
    
    
    function  company_info()
    {
        $data['companyName']="Web N App Maker";
        $data['companyWebsite']="https://www.webnappmaker.in";
        
        return $data;
    }
    function detail_page_name()
    {
        
		get_instance()->load->helper('url');
        $string=((get_instance()->uri->segment(3)))?"Detail":'';
        return $string;
    }
    function check_data($searchData)
    {
        if($searchData!=NULL)
        {
            return "Data is Present";
        }
        else
        {
            return "Data is Not Present";
        }
    }
    function check_css($leftData,$rightData,$css)
    {
        if($leftData==$rightData)
        {
            return $css;
        }
        else
        {
             return;
        }
    }
    function get_table_name()
    {
        get_instance()->load->helper('url');
        
        $tblName="tbl".get_instance()->router->fetch_method();
        return $tblName;
    }
    function  more_info($hrefName,$conName)
    {   
        $conName=($conName)?'/'.$conName:'';
        $hrefName=($hrefName)?'/'.$hrefName:'';
        $hrefName= replace($hrefName);
         $string=site_url(uri_string()).$conName.$hrefName;
         return $string;
    }
    function  get_table_name_ajax()
    {   
        get_instance()->load->helper('url');
        return get_instance()->uri->segment(4);
    }
    
    function  check_uri()
    {   
        get_instance()->load->helper('url');
               $str='';
        for($i=1;$i<5;$i++)
        {
            if(get_instance()->uri->segment($i))
            {
             $str=$str+get_instance()->uri->segment($i);
            }
            	
        }
        return $str;
    }
    //check recursive join function to retrie all data 
    function check_recursive_join_table($mainTableName)
    {
        $mainTableName_exact=str_replace('tbl','',$mainTableName);
	    //check_p($mainTableName);
	    $CI1 = get_instance();
                        $CI1->load->model('Admin/MainModel','mm');
                        
	    $fields=$CI1->mm->get_table_heading($mainTableName);
	    check_p($fields);
	    foreach($fields as $fieldsKey)
	    { 
	        if(strpos($fieldsKey,'Id')&&!(stripos($fieldsKey,'email')!==false)&&!(strcasecmp($fieldsKey,$mainTableName_exact."Id")==0))
            {
                $tblName["tbl".strtolower(str_ireplace("id","",$fieldsKey))]=$fieldsKey;
            }
	    }
	    return $tblName;
        
    }
    //start check join  table
    function check_join_table($fields,$mainTableName)
    {   
        $tblName = array();
    //    check_p($fields);
    
        $mainTableName_exact=str_replace('tbl','',$mainTableName);
	    foreach($fields as $fieldsKey)
	    { 
	            //update for rajesh sir
                //removeing  fileds key
                //$fieldsKey=preg_replace('/[0-9]+/', '', $fieldsKey);
	        //before
	        //if(strpos($fieldsKey,'Id')&&!(stripos($fieldsKey,'email')!==false))
            //after
            if(strpos($fieldsKey,'Id')&&!(stripos($fieldsKey,'email')!==false)&&!(strcasecmp($fieldsKey,$mainTableName_exact."Id")==0)&&!(check_field($fieldsKey,DETAIL_COLUMN_REFERNCE)))
            {
                $tblName["tbl".strtolower(str_ireplace("id","",$fieldsKey))]=$fieldsKey;
            }
	    }
	    
/*	    if(strcasecmp($fields[0],$mainTableName_exact."Id")==0)
	    {
	        echo "hai".$fields[0]." ".$mainTableName_exact."Id"; 
	    }
	    else
	    {
	        echo "nhai".$fields[0]." ".$mainTableName_exact."Id";
	    }
*/	   // check_p($tblName);
        return $tblName;
    }
    function check_inner_join_table($fields,$mainTableName)
    {   
        $tblName = array();
        $mainTableName_exact=str_replace('tbl','',$mainTableName);
	    //print_r($fields);
	    foreach($fields as $fieldsKey)
	    { 
	            //update for rajesh sir
                //removeing  fileds key
                //$fieldsKey=preg_replace('/[0-9]+/', '', $fieldsKey);
	        //before
	        //if(strpos($fieldsKey,'Id')&&!(stripos($fieldsKey,'email')!==false))
            //after
            if(strpos($fieldsKey,'Labour'))
            {  $tblName["tblhsn"]="HsnId";}
            else if(strpos($fieldsKey,'Id')&&!(stripos($fieldsKey,'email')!==false)&&!(strcasecmp($fieldsKey,$mainTableName_exact."Id")==0)&&!(check_field($fieldsKey,DETAIL_COLUMN_REFERNCE)))
            {    $tblName["tbl".strtolower(str_ireplace("id","",$fieldsKey))]=$fieldsKey;
            }
	    }
        
        
/*	    if(strcasecmp($fields[0],$mainTableName_exact."Id")==0)
	    {
	        echo "hai".$fields[0]." ".$mainTableName_exact."Id"; 
	    }
	    else
	    {
	        echo "nhai".$fields[0]." ".$mainTableName_exact."Id";
	    }
*/	   // check_p($tblName);
        return $tblName;
    }
    function remove_CDT($fields)
    {
        $data =array();
        $filterData =array();
        $j=0;
     //   $data=array_diff($fields,["CreatedDateTime","Status"]);
        $size= sizeof($fields);
        for($i=0;$i<$size;$i++)
        {
                if(!($fields[$i]=="CreatedDateTime"||$fields[$i]=="Status"))
                {
                    $filterData[$j]=$fields[$i];
                    $j++;
                }
                
        }
       // check_p($filterData);
        return $filterData;   
    }
    //
    function check_exact_field($fields,$where) //check field same
    {
        if((strpos($fields,$where)!==false))
        {
            return true;
        }
        else return false;
    }
    function check_field($fields,$where) //check field
    {
        if((stripos($fields,$where)!==false))
        {
            return true;
        }
        else return false;
    }
    function remove_last_field($field,$no)
    {  // $field;
        $data=array();
        for($i=0;$i<(sizeof($field)-$no);$i++)
        {
         $data[$i]=$field[$i];
         //echo  $data[$i]." asd ";
        }
        //check_p($data);
        return $data;
    }
    function get_before_id_data($data)
    {
        $data=strstr($data,"Id",true);
        return $data;
    }
    function get_after_id_data($data)
    {
        $data=substr($data,strpos($data,"Id")+2);
        return $data;
    }
    function get_detail_view($data)
    {   
        $tableName='tbl'.$data.'detail';
       // check_p($tableName);
    
        $str="";
        $inputStr="";
        if (check_table_present($tableName))
        {       
                    $detailData=$CI->mm->get_table_heading($tableName);
                    $detailData=remove_last_field($detailData,2);
                    $detailData=remove_first_field($detailData);
                //    $detailData=remove_last_field($detailData,1);
                    foreach($detailData as $detailDataValue)
                    {
                        $inputStr=$inputStr. get_input_field($detailDataValue,'3','td',1);
                    }
                    $inputStr="<tr id='".TABLE_ROW."1'>".$inputStr."</tr>";                
        }
        return $inputStr;
    }
    function checK_table_present($tableName)
    {
        $CI = get_instance();
        $CI->load->model('Admin/MainModel','mm');
        $tablePresent=$CI->mm->check_table_present($tableName);
        return $tablePresent;
    }
    function update_detail_view($data)
    {   
        
                    $detailData=$CI->mm->get_table_heading($tableName);
                    $detailData=remove_last_field($detailData,2);
                    $detailData=remove_first_field($detailData);
                //    $detailData=remove_last_field($detailData,1);
                    foreach($detailData as $detailDataValue)
                    {
                        $inputStr=$inputStr. get_input_field($detailDataValue,'3','td',1);
                    }
                    $inputStr="<tr id='".TABLE_ROW."1'>".$inputStr."</tr>";                
        
        return $inputStr;
    }
    function add_remove_clear_option($array)
    {
        array_push($array,"Remove","Clear");
        return $array;
    }
    function get_input_field($field,$tblkey='',$class='',$tagName='',$UniqueId='',$value='',$readonlyField='') // get input field
    {   
        //echo $field;
        //$readonlyValue="readonly";
        //mart n cart changes 08/09/2020 
        $readonlyValue="";
        //check_p($UniqueId);
        ////echo($field.$class.$key);
        //echo $tagName;
        //remove number from filed
        $field=preg_replace('/[0-9]+/', '', $field);
        //$field=remove_first_field($field);
        
        if((stripos($field,'PrintBill')!==false)||(stripos($field,'Print')!==false))  //blank
        {
            $str="";
        }
        else if((stripos($field,'Remove')!==false))
        {
            if($tagName=="td")
            {
            $str='<td ><span  class="fa  fa-times " name='.$field.$UniqueId.' class="Remove" onclick="Remove(this.id)" id='.$field.$UniqueId.'  ></span></td>';
            }
            else if($tagName=="label")
            {
                $str='<div class=" form-group col-md-1 "><span  class="fa  fa-times" name='.$field.'  id='.$field.'  ></span></div>';
            }
        }
        
        else if((stripos($field,'Clear')!==false))
        {
            //$str='<div class=" form-group col-md-1 "><span  class="fa  fa-trash" name='.$field.'  id='.$field.'  ></span></div>';
            $str="";
        }
        else if((stripos($field,'Password')!==false))
        {
            if($tagName)    
            {
            $str='<td class="desciption-table table-width">
                <input type="password" class="description-column" name='.$field.'  placeholder ="'.$field.$UniqueId.'" id='.$field.$UniqueId.' value="'.$value.'" >
                </td>';
            }
            else
            {
            $str='<div class=" form-group col-md-'.$class.' "><label class=" col-md-12" id="Label'.$field.'" >'.$field.'</label>'.' 
            <input type="password" class="form-control col-md-12" name='.$field.'  placeholder ="Enter '.$field.'" id='.$field.'  value="'.$value.'" ></div>';
            }
            //label left
        }
        else if((strpos($field,'Id')!==false)&&!(stripos($field,'Email')!==false))
        {
           // echo $field;
            if(check_exact_field($field,DETAIL_COLUMN))
            {
              //  $str="";
                $str='<input type="hidden" class="form-control  col-md-'.$class.'" name='.$field.$UniqueId.'  value="'.$value.'" id='.$field.$UniqueId.' >';
            }
            else if(strcmp(ADMIN_COLUMN_NAME,$field)==0)
            {
                $CI = get_instance();
                $CI->load->library('session');
                $str='<input type="hidden" class="form-control col-md-'.$class.'" name='.$field.$UniqueId.'  value="'.$CI->session->userdata[SESSION_ID].'" id='.$field.$UniqueId.' >';
            }
              
            else
            {
                //check_p($field);
                $datalist="datalist";
                $beforeId=get_before_id_data($field);
                $afterId=get_after_id_data($field);
                $fieldName=str_replace("Id","Name",$field);
                //echo $beforeId;
                //echo $afterId;
                if($tagName=="td")
                {
                    $strfirst='<td class="table-width">';
                    $strlast='</datalist></td>';
                }
                else if($tagName=="label")
                {
                    $strfirst='<td class="table-width">';
                    $strlast='</td>';
                }
                else if($tagName=="notag")
                {
                    $strfirst='<td class="table-width">';
                    $strlast='</td>';
                }
                else
                {
                    $strfirst='<div class="col-md-'.$class.' form-group"><label class="col-md-12" >'.label($fieldName).'</label>'; 
                    $strlast='</datalist></div>';
                }
             
                  //$strSecond='<input list="browsers"    name="'.$field.$UniqueId.'" id="'.$field.$UniqueId.'" ><datalist id="browsers">';
                        //$strSecond='<input type="text" class=" form-control col-md-12 "  list="'.$field.$UniqueId.$datalist.'"   name="'.$field.$UniqueId.'" id="'.$field.$UniqueId.'" ><datalist id="'.$field.$UniqueId.$datalist.'">';
                        $strmid="";
                        $strSecondValue='';
                        $strSecondValueNoTag='';
                        $selected="selected";
                        $CI = get_instance();
                        $CI->load->model('Admin/MainModel','mm');
                        $AllData=$CI->mm->get_all_data_join("tbl".strtolower(remove_exact("Id",$field)));
                        //check_p($AllData);
                        foreach($AllData as $AllDataFieldkey)
                        {       $flag=0;
                                //$strSecondValue='';
                        
                                //custom coding for rajesh bhau wala 4/18/2019
                                /*if(strcmp($fieldName,"CustomerName")==0)
                                {
                                   //$strmid=$strmid.'<option data-id='.$AllDataFieldkey->$field.'  value="'.$AllDataFieldkey->$fieldName."-".$AllDataFieldkey->CustomerCode.'" '.((strcmp($AllDataFieldkey->$field,$value)==0)?$selected:'').'>'.$AllDataFieldkey->$fieldName."-".$AllDataFieldkey->CustomerCode.'</option>';
                                    $strmid=$strmid.'<option data-id="'.$AllDataFieldkey->$field.'"  value="'.$AllDataFieldkey->$field.'-'.$AllDataFieldkey->$fieldName."-".$AllDataFieldkey->CustomerCode.'-'.$AllDataFieldkey->TypeofworkName.' '.((strcmp($AllDataFieldkey->$field,$value)==0)?$selected:'').'"></option>';
                                    //if(check_field($UniqueId,"update"))
                                    //{
                                       // check_p($UniqueId);
                                        //echo $UniqueId;
                                        $strSecondValue=(strcmp($AllDataFieldkey->$field,$value)==0)?$AllDataFieldkey->$field.'-'.$AllDataFieldkey->$fieldName."-".$AllDataFieldkey->CustomerCode.'-'.$AllDataFieldkey->TypeofworkName:'';
                                
                                    //}        
                                }*/
                                /*else if(strcmp($fieldName,"C")==0)
                                {
                                    
                                }*/
                                //else
                                {
                                    //$strmid=$strmid.'<option data-id="'.$UniqueId.'" value="'.$AllDataFieldkey->$field.'" '.((strcmp($AllDataFieldkey->$field,$value)==0)?$selected:'').'>'.$AllDataFieldkey->$fieldName.'</option>';
                                   /* if(strpos($field,"JobCard")!=false)
                                        $strmid=$strmid.'<option data-id="'.$AllDataFieldkey->$field.'"  value="'.$AllDataFieldkey->$field.'-'.$AllDataFieldkey->$fieldName.'asd" '.((strcmp($AllDataFieldkey->$field,$value)==0)?$selected:'').'></option>';*/
                                    //else
                                       // $strmid=$strmid.'<option data-id="'.$AllDataFieldkey->$field.'"  value="'.$AllDataFieldkey->$field.'-'.$AllDataFieldkey->$fieldName.'"$field '.((strcmp($AllDataFieldkey->$field,$value)==0)?$selected:'').'></option>';
                                                                        
                                    //echo $UniqueId;
                                    //if(check_field($UniqueId,"update"))
                                    //{
                                        //$strSecondValue="asd";
                                        //echo  (strcmp($AllDataFieldkey->$field,$value)==0)?$AllDataFieldkey->$field.'-'.$AllDataFieldkey->$fieldName:'';
                                     
                                        if($strSecondValue=='')
                                        {   
                                            $strSecondValueNoTag=(strcmp($AllDataFieldkey->$field,$value)==0)?$AllDataFieldkey->$fieldName:'';
                                            $strSecondValue=(strcmp($AllDataFieldkey->$field,$value)==0)?$AllDataFieldkey->$field.'-'.$AllDataFieldkey->$fieldName:'';
                                        }
                                       //echo $strSecondValue;
                                        //if($flag)
                                    //}   
                                }
                        }
                        if($tagName=="label")
                        {
                            $strSecond='<label  name="'.$field.$UniqueId.'" id="'.$field.$UniqueId.'"  >'.label($strSecondValue).'</label>';
                            $strmid='';
                        }
                        else if($tagName=="notag")
                        {
                            $strSecond="$strSecondValueNoTag";
                            $strmid='';
                            
                        }
                        else
                        {
                                $strSecond='<input type="text" class=" form-control col-md-12 "  list="'.$field.$UniqueId.$datalist.'"   name="'.$field.$UniqueId.'" id="'.$field.$UniqueId.'" value="'.$strSecondValue.'" required ><datalist id="'.$field.$UniqueId.$datalist.'" >';    
                        }
                        $str=$strfirst.$strSecond.$strmid.$strlast;
                   // check_p($str);
                
            }
        }
        else if((stripos($field,'Tabledropdown')!==false))
        {   
            if($tagName=="td")
            {
                $strfirst='<td class="table-width">';
                $strlast='</select></td>';
                
            }
            else
            {
                $strfirst='<div class="col-md-'.$class.' form-group"><label class="col-md-12" >'.label($field).'</label>'; 
                $strlast='</select></div>';
            }
            $strSecond='<select class="form-control col-md-12" name="'.$field.$UniqueId.'" id="'.$field.$UniqueId.'">';
                        $strmid="";
                        $CI = get_instance();
                        $selected="selected";
                        $CI->load->model('Admin/MainModel','mm');
                        $AllTableName=$CI->mm->get_all_table_heading();
                        //check_p($AllTableName);
                        foreach($AllTableName as $AllDataFieldkey)
                        {       
                            $strmid=$strmid.'<option value="'.ucfirst(remove('tbl',$AllDataFieldkey)).'">'.ucfirst(remove('tbl',$AllDataFieldkey)).'</option>';
                        }
                    $str=$strfirst.$strSecond.$strmid.$strlast;
        }
        else if((stripos($field,'ServiceDropDown')!==false))
        {   
            if($tagName=="td")
            {
                $strfirst='<td class="table-width">';
                $strlast='</select></td>';
                
            }
            else
            {
                $strfirst='<div class="col-md-'.$class.' form-group"><label class="col-md-12" >'.label($field).'</label>'; 
                $strlast='</select></div>';
            }
            $strSecond='<select class="form-control col-md-12" name="'.$field.$UniqueId.'" id="'.$field.$UniqueId.'">';
                        $selected="selected";
                        $strmid="";
                        //check_p($AllTableName);
                        $data=array("Accidental","Paid Service","Running","Repairing","Others");
                        foreach($data as $AllDataFieldkey)
                        {       
                            $strmid=$strmid.'<option value="'.ucfirst(remove('tbl',$AllDataFieldkey)).'">'.ucfirst(remove('tbl',$AllDataFieldkey)).'</option>';
                        }
                    $str=$strfirst.$strSecond.$strmid.$strlast;
        }
        else if((stripos($field,'ConditionDropDown')!==false))
        {   
            if($tagName=="td")
            {
                $strfirst='<td class="table-width">';
                $strlast='</select></td>';
                
            }
            else
            {
                $strfirst='<div class="col-md-'.$class.' form-group"><label class="col-md-12" >'.remove_exact('DropDown',label($field)).'</label>'; 
                $strlast='</select></div>';
            }
            $strSecond='<select class="form-control col-md-12" name="'.$field.$UniqueId.'" id="'.$field.$UniqueId.'">';
                        $selected="selected";
                        $strmid="";
                        //check_p($AllTableName);
                        $data=array("Open","Close","Reopen");
                        foreach($data as $AllDataFieldkey)
                        {       
                            $strmid=$strmid.'<option value="'.ucfirst(remove('tbl',$AllDataFieldkey)).'">'.ucfirst(remove('tbl',$AllDataFieldkey)).'</option>';
                        }
                    $str=$strfirst.$strSecond.$strmid.$strlast;
        }
        else if((stripos($field,'JoinTableCheckbox')!==false))
        {   
            if($tagName=="td")
            {
                $strfirst='<td class="table-width">';
                $strlast='</select></td>';
                
            }
            else
            {
                $strfirst='<div class="col-md-'.$class.' form-group"><label class="col-md-12" >From</label>'; 
                $strlast='</select></div>';
            }
            $strSecond='<select class="form-control col-md-12" name="'.$field.$UniqueId.'" id="'.$field.$UniqueId.'" multiple="multiple">';
                        $strmid="";
                        $CI = get_instance();
                        $selected="selected";
                        $CI->load->model('Admin/MainModel','mm');
                        $AllTableName=$CI->mm->get_column_tableName('AccountsId');
                        
                        foreach($AllTableName as $AllDataFieldkey)
                        { 
                            //print_r($AllDataFieldkey['TableName']);
                            $strmid=$strmid.'<option value="'.ucfirst(remove('tbl',$AllDataFieldkey['TableName'])).'">'.ucfirst(remove('tbl',$AllDataFieldkey['TableName'])).'</option>';
                        }
                        //check_p($AllTableName);
                        
                    $str=$strfirst.$strSecond.$strmid.$strlast;
        }
        else if((stripos($field,'AccountsDataRadio')!==false))
        {   
            if($tagName=="td")
            {
                $strfirst='<td class="table-width">';
                $strlast='</td>';
                
            }
            else
            {
                $strfirst='<div class="col-md-'.$class.' form-group"><label class="col-md-12" >From</label>'; 
                $strlast='</div>';
            }
            $strSecond='<input  type="radio"  name="'.$field.$UniqueId.'"  id="'.$field.$UniqueId.'1" value="Master" checked>Master
                        <input  type="radio"  name="'.$field.$UniqueId.'"  id="'.$field.$UniqueId.'2" value="All">All
                        <input  type="radio"  name="'.$field.$UniqueId.'"   id="'.$field.$UniqueId.'3" value="Cashretail">Cash Retail    ';
            //$strmid=$strmid.'<option value="'.ucfirst(remove('tbl',$AllDataFieldkey['TableName'])).'">'.ucfirst(remove('tbl',$AllDataFieldkey['TableName'])).'</option>';
                        
                    $str=$strfirst.$strSecond.$strlast;
        }
        //accounts 
        else if((stripos($field,'ReceiptPayment')!==false))
        {   
            if($tagName=="td")
            {
                $strfirst='<td class="table-width">';
                $strlast='</select></td>';
                
            }
            else
            {
                $strfirst='<div class="col-md-'.$class.' form-group"><label class="col-md-12" >'.remove($tblkey,label($field)).'</label>'; 
                $strlast='</select></div>';
            }
            $strSecond='<select class="form-control col-md-12" name="'.$field.$UniqueId.'" id="'.$field.$UniqueId.'">';
                        $strmid="";
                        $selected="selected";
                        //check_p($AllTableName);
                        $strmid=$strmid.'<option value="Receipt">Receipt</option><option value="Payment">Payment</option>';
                        $str=$strfirst.$strSecond.$strmid.$strlast;
        }
        else if((stripos($field,'DrCr')!==false))
        {   
            if($tagName=="td")
            {
                $strfirst='<td class="table-width">';
                $strlast='</select></td>';
                
            }
            else
            {
                $strfirst='<div class="col-md-'.$class.' form-group"><label class="col-md-12" >'.remove($tblkey,label($field)).'</label>'; 
                $strlast='</select></div>';
            }
            $strSecond='<select class="form-control col-md-12" name="'.$field.$UniqueId.'" id="'.$field.$UniqueId.'">';
                        $strmid="";
                        $selected="selected";
                        //check_p($AllTableName);
                        $strmid=$strmid.'<option value="Dr">Debit</option><option value="Cr">Credit</option>';
                        $str=$strfirst.$strSecond.$strmid.$strlast;
        }
        else if((stripos($field,'AcRadio')!==false))
        {
            $str='  
                <div class="form-group col-md-'.$class.'">
                 <label>
                       '.remove("Radio",label($field)).'     
                  </label>
                  <br>
                  <label>
                  Credit         <input type="radio" name='.$field.' class="minimal" value="0" checked>
                  </label>
                  <label>
                    Debit<input type="radio" name='.$field.' class="minimal" value="1">
                  </label>
                  </div>';
        }
        //nilesh Radio button in front
        else if((stripos($field,'YesNoRadio')!==false))
        {
            $str='  
                <div class="form-group col-md-'.$class.'">
                 <label>
                       '.remove("YesNoRadio",label($field)).'     
                  </label>
                  <br>
                  <label>
                           <input type="radio" name='.$field.' class="minimal '.$field.'Yes'.'" value="0" checked>Yes  
                  </label>
                  <label>
                    <input type="radio" name='.$field.' class="minimal '.$field.'No'.'" value="1">No
                  </label>
                  </div>';
        }
        else if((stripos($field,'NewOld')!==false))
        {
            $str='  
                <div class="form-group col-md-'.$class.'">
                    <label>
                           '.remove("YesNoRadio",label($field)).'
                    </label>
                    
                    <select class="form-control col-md-'.$class.'" name='.$field.' id='.$field.'>
                        <option value="New" selected>New</option>
                        <option value="Old">Old</option>
                    </select>
                </div>';
        }
        else if((stripos($field,'Image')!==false)||(stripos($field,'PDF')!==false)||(stripos($field,'Document')!==false)||(stripos($field,'Proof')!==false)||(stripos($field,'Logo')!==false))
        {
            if($tagName=="td")
            {
                $str='<td class="table-width"><input type="file" class="form-control col-md-12" name="'.$field.$UniqueId.'"  placeholder ="Enter '.$field.'" id='.$field.$UniqueId.' ><input type="hidden" class="form-control col-md-12" name="'.$field.$UniqueId.'Name"  id="'.$field.$UniqueId.'Name" ></td>';
            }
            else
            {
            $str='<div class="col-md-'.$class.' form-group"><label class="col-md-12" >'.label($field).'</label>'.' 
            <input type="file" class="form-control col-md-12" name="'.$field.'"  placeholder ="Enter '.$field.'" id='.$field.' ></div>'.
            '<input type="hidden" class="form-control col-md-12" name="'.$field.'Name"  id="'.$field.'Name" >';
            }
        }
        
    /*    else if((stripos($field,'Status')!==false))
        {
            $str='<div class="col-md-6 form-group"><label class="col-md-12" >'.$field.'</label>'.' 
            <select class="form-control col-md-12" name='.$field.' id='.$field.'>
                <option value="0" selected>Active</option>
                <option value="1">Block</option>
            </select></div>';
            
        }*/
        
        else if((stripos($field,'Gender')!==false))
        {
            $str='  
                <div class="form-group col-md-'.$class.'">
                 <label>
                    '.label($field).'        
                  </label>
                  <br>
                  <label>
                  Male         <input type="radio" name='.$field.' class="minimal" value="Male" checked>
                  </label>
                  <label>
                    FeMale<input type="radio" name='.$field.' class="minimal" value="FeMale">
                  </label>
                  </div>';
        }
        else if((stripos($field,'Correspondence')!==false))
        {
            $str='  
                <div class="form-group col-md-'.$class.'">
                 <label>
                     '.label($field).'      
                  </label>
                  <br>
                  <label>
                  Residence         <input type="radio" name='.$field.' class="minimal" value="Residence" checked>
                  </label>
                  <label>
                    Office<input type="radio" name='.$field.' class="minimal" value="Office">
                  </label>
                  </div>';
        }
        else if((stripos($field,'Marital')!==false))
        {
            $str='  
                <div class="form-group col-md-'.$class.'">
                 <label>
                    '.label($field).'    
                  </label>
                  <br>
                  <label>
                    Married         <input type="radio" name='.$field.' class="minimal" value="Married" checked>
                  </label>
                     <label>
                    Single<input type="radio" name='.$field.' class="minimal" value="Single" >
                  </label>
                  </div>';
        }
        else if((stripos($field,'Desc')!==false)||(stripos($field,'Address')!==false)||(stripos($field,'Remarks')!==false))
        {
            if($tagName=="td")
            {
                $str='<td class="table-width"><textarea class="form-control col-md-12" rows="3" placeholder='.$field.' name='.$field.$UniqueId.' id='.$field.$UniqueId.'  value="'.$value.'"></textarea></td>';
            }
            else
            {
            
                $str='<div class="col-md-12 pull-left"><label class="col-md-12" >'.label($field).'</label><textarea class="form-control col-md-12" rows="3" placeholder="Enter ..." name='.$field.' id='.$field.'  value="'.$value.'"></textarea></div>';       
        
            }        
        }
        else if(stripos($field,'Date')!==false)
        {
            if($tagName=="td")
            {
                $str='<td class="table-width"><input type="date" class="form-control col-md-12" name="'.$field.$UniqueId.'"  placeholder ="'.$field.'" id="'.$field.$UniqueId.'"  value="'.$value.'" ></td>';
            }
            else if($tagName=="label")
            {
                $str='<td><label  name="'.$field.$UniqueId.'"   id="'.$field.$UniqueId.'"  >'.$value.'</label></td>';
            }
            else
            {
            $str='<div class=" form-group col-md-'.$class.'  " ><label class=" col-md-12" id="Label'.$field.'" >'.remove($tblkey,label($field)).'</label>'.' 
            <input type="date" class="form-control col-md-12" name="'.$field.'"  placeholder ="Enter '.$field.'" id="'.$field.'"  value="'.$value.'" ></div>';
            //   check_p($str);
            }
        }
        //    if((stripos($field,'ContactNo')!==false)||(stripos($field,'Email')!==false)||(stripos($field,'Name')!==false)||(stripos($field,'Title')!==false)||(stripos($field,'Price')!==false))
        
        else
        {
            if($tagName=="td")
            {
               // echo  "td k andar".$tagName;
                //$str='';
                if($readonlyField)
                    $readonlyValue=check_exact_field($field,$readonlyField)?"readonly":'';
                
                //$str='<td><input type="text" class="form-control col-md-12" name="'.$field.$UniqueId.'"  placeholder ="'.$field.'" id="'.$field.$UniqueId.'"  value="'.$value.'" "'.check_exact_field($field,$disableField)?$disableValue:"".'"></td>';
                $str='<td class="table-width"><input type="text" class="form-control col-md-12" name="'.$field.$UniqueId.'"  placeholder ="'.$field.'" id="'.$field.$UniqueId.'"  value="'.$value.'" '.$readonlyValue.'></td>';
                
            }
            else if($tagName=="label")
            {
            $str='<td><label class="" name="'.str_replace("customer","Doctor",$field).$UniqueId.'"   id="'.$field.$UniqueId.'"  >'.$value.'</label></td>';
            }
            else if($tagName=="notag")
            {
                    $str='<td class="table-width">'.round($value).'</td>';
            }
            else
            {
                //echo  "else k andar".$tagName;
                //code before Devi Motors
                //$str='<div class=" form-group col-md-'.$class.' "><label class=" col-md-12"  >'.label($field).'</label>'.' 
                //<input type="text" class="form-control col-md-12" name="'.$field.'"  placeholder ="Enter '.$field.'" id="'.$field.'"  value="'.$value.'"></div>';
                //code for Devi Motors
                    $str='<div class=" form-group col-md-'.$class.'" name="'.$field.'" id="'.$field."div".'" ><label class=" col-md-12"  >'.label($field).'</label>'.' 
                    <input type="text" class="form-control col-md-12" name="'.$field.'"  placeholder ="Enter '.$field.'" id="'.$field.'"  value="'.$value.'"></div>';
            
            }
                
        }
        
        return $str;
    }
    function  remove_first_last_field($fields)
    {   
       // check_p($fields);
        $data =array();
        $size= sizeof($fields);
        for($i=0;$i<$size-1;$i++)
        {
            $editedFields[$i]=$fields[$i+1];
        }
       //$data=array_diff($editedFields,["CreatedDateTime","Status"]);
       $size= sizeof($editedFields);
        $j=0;   
        for($i=0;$i<$size;$i++)
        {
                if(!(strpos($editedFields[$i],"CDT")||strpos($editedFields[$i],"Status")))
                {
                    $data[$j]=$editedFields[$i];
                    $j++;
                }
                
        }
      //  check_p($data);
        return $data;
        
    }
    /*function  remove_first_last_field($fields = '')
    {   
        
        $data =array();
        $size= sizeof($fields);
        for($i=0;$i<$size-1;$i++)
        {
            $editedFields[$i]=$fields[$i+1];
        }
       $data=array_diff($editedFields,["CreatedDateTime","Status"]);
        return $data;
        
    }*/
    function get_array_for_datalist($array,$tableIdName)
    {
        //$array=json_decode(json_encode($object), true);
        //check_p($array['CustomerName']);
        //check_p($array);
        foreach($array as $key=>$data)
        {
            $newKey=str_replace("Id","Name",$key);
            $mainTableColumn=str_replace("Id","Name",$tableIdName);
            //check_p($mainTableColumn);
            if(check_id($key)&&$newKey!=$mainTableColumn&&$newKey!="PlaceofsupplyName"&&$newKey!="HsnName"&&$newKey!="GroupName"&&$newKey!="VechileModelName"&&$newKey!="VechileModelName"&&$newKey!="CustomerName"&&$newKey!="AdvisoryName"&&$newKey!="InsuranceCompanyName"&&$newKey!="MechanicName"&&$newKey!="PreInvoicedetailName"&&$newKey!="CategoryName"&&$newKey!="AddressName")
            {
                
                //patia static for rajesh bhauv wala
                //if($newKey!="TypeofworkName"&&$newKey!="TaskDetailName")
                //{
                    //echo($newKey); 
                    //echo($array[$newKey]);
                    $newArray[$key]=$data."-".$array[$newKey];//($key->$newKey);
            
                //}        
            }
            else
            {
                    $newArray[$key]=$data;
                    //$newArray[$key]="asd";
            }
                
        }
        return $newArray;
    }
    function check_Id($field)
    {
        if(strpos($field,'Id')&&!((stripos($field,'email')!==false)||(stripos($field,DETAIL_COLUMN_REFERNCE)!==false)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function remove_first_field($fields)
    {
        $size= sizeof($fields);
      //  check_p($fields);
        for($i=0;$i<$size-1;$i++)
        {
            $editedFields[$i]=$fields[$i+1];
        }
        return $editedFields;
    }
    function  admin_sidebar()
    {
        $sidebar=array("Gallery",
 	                          "Article",
 	                          "Product",
 	                          "Category",
 	          //                "Employee",
 	            //              "User",
 	                          "Slider");
 	                          
        return $sidebar;
        
    }
    
    //function  remove_password()
    function check_email_id($field) 
    {
            //if(strpos($field,'Id')&&!((stripos($field,'email')!==false)||(stripos($field,DETAIL_COLUMN_REFERNCE)!==false)))
                if(stripos($field,DETAIL_COLUMN_REFERNCE)!==false)
                {
                        return str_ireplace("Id".DETAIL_COLUMN_REFERNCE,'Name',$field);
                }
                else if(strpos($field,'Id')&&!((stripos($field,'email')!==false)))
                {           
                    return str_ireplace('id','Name',$field);
                }
                else
                {
                    return $field;
                }
    }
    function replace_id_name($fields)
    {       $len=sizeof($fields);
            //it  should not replace main id so we are using this process
            //bcoz datatable needs id for update data n status
            $fields[0]=$fields[0];
            for($i=1;$i<$len;$i++)
            {
                    $fields[$i]=check_email_id($fields[$i]);
            }
            //  check_p($fields);
            
            return   $fields;
    }
    function add_fields($field)
    {
        array_push($field,"Action","Update");
        return $field;
        
        
    }
    function add_a_fields($field,$fieldName)
    {
        array_push($field,$fieldName);
        return $field;
        
        
    }
    function get_aocolumns_data($fields = '')
    {
        $aocolumns = array();
	    $fields=replace_id_name($fields);
	  // check_p($fields);  
	   $firstField=$fields[0];
	   $mainKey=remove('Id',$firstField);
        $status=$mainKey."Status";
	    foreach($fields as $fieldsKey){
            if(stripos($fieldsKey,'Image')||stripos($fieldsKey,'Logo')||strpos($fieldsKey, 'Status') !== false||stripos($fieldsKey,'Action')===0||stripos($fieldsKey,'Update')===0||stripos($fieldsKey,'Delete')===0||stripos($fieldsKey,'Print')||stripos($fieldsKey,'YesNoRadio')||stripos($fieldsKey,'SMS'))
            {
                    if(stripos($fieldsKey,'PrintBill'))
                    {   
                        $BillUrl=site_url('admin');
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                           var toggle_switch;
                                 return '<a   id='+data.$firstField+' class=\"printbill\" ><span class=\"fa fa-file\" style=\"font-size:25px; \"></span></a>';
                         }}";
                    }
                    else if(stripos($fieldsKey,'PrintPreInvoice'))
                    {   
                        $BillUrl=site_url('admin');
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                           var toggle_switch;
                                 return '<a   id='+data.$firstField+' class=\"PrintPreInvoice\" ><span class=\"fa fa-file\" style=\"font-size:25px; \"></span></a>';
                         }}";
                    }
                    else if(stripos($fieldsKey,'PrintEstimate'))
                    {   
                        $BillUrl=site_url('admin');
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                           var toggle_switch;
                                 return '<a   id='+data.$firstField+' class=\"PrintEstimate\" ><span class=\"fa fa-file\" style=\"font-size:25px; \"></span></a>';
                         }}";
                    }
                    else if(stripos($fieldsKey,'PrintInvoice'))
                    {   
                        $BillUrl=site_url('admin');
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                           var toggle_switch;
                                 return '<a   id='+data.$firstField+' class=\"PrintInvoice\" ><span class=\"fa fa-file\" style=\"font-size:25px; \"></span></a>';
                         }}";
                    }
                    else if(stripos($fieldsKey,'PrintForm'))
                    {   
                        $BillUrl=site_url('admin');
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                           var toggle_switch;
                                 return '<a   id='+data.$firstField+' class=\"PrintForm\" ><span class=\"fa fa-file\" style=\"font-size:25px; \"></span></a>';
                         }}";
                    }
                    else if(stripos($fieldsKey,'PrintCard'))
                    {   
                        $BillUrl=site_url('admin');
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                           var toggle_switch;
                                 return '<a   id='+data.$firstField+' class=\"PrintCard\" ><span class=\"fa fa-file\" style=\"font-size:25px; \"></span></a>';
                         }}";
                    }
                    else if(stripos($fieldsKey,'PrintPreInvoice'))
                    {   
                        $BillUrl=site_url('admin');
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                           var toggle_switch;
                                 return '<a   id='+data.$firstField+' class=\"PreInvoice\" ><span class=\"fa fa-file\" style=\"font-size:25px; \"></span></a>';
                         }}";
                    }
                    else if(stripos($fieldsKey,'PrintJobCard'))
                    {   
                        $BillUrl=site_url('admin');
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                           var toggle_switch;
                                 return '<a   id='+data.$firstField+' class=\"PrintJobCard\" ><span class=\"fa fa-file\" style=\"font-size:25px; \"></span></a>';
                         }}";
                    }
                    else if(stripos($fieldsKey,'PrintSlip'))
                    {   
                        $BillUrl=site_url('admin');
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                           var toggle_switch;
                                 return '<a   id='+data.$firstField+' class=\"PrintSlip\" ><span class=\"fa fa-file\" style=\"font-size:25px; \"></span></a>';
                         }}";
                    }
                    else if(stripos($fieldsKey,'Print'))
                    {   
                        $BillUrl=site_url('admin');
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                           var toggle_switch;
                                 return '<a   id='+data.$firstField+' class=\"Print\" ><span class=\"fa fa-file\" style=\"font-size:25px; \"></span></a>';
                         }}";
                    }
                    else if(stripos($fieldsKey,'SMS'))
                    {   
                        $BillUrl=site_url('admin');
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                           var toggle_switch;
                                 return '<a   id='+data.$firstField+' class=\"SMS\" ><span class=\"fa fa-envelope\" style=\"font-size:25px; \"></span></a>';
                         }}";
                    }
                   /* else if(stripos($fieldsKey,'Gender')===0)
                    {
                                       $aocolumns[] = "
                                            { data   :null,render:function(data,type,row){
                                            var toggle_switch;
                                            if(data.$fieldsKey==0)
                                            {
                                                 return '<span class=\"btn btn-text medium green flat\" >Male</span>';
                                            }
                                            else
                                            {
                                                return '<span class=\"btn btn-text medium red flat\" >Female</span>';
                                            }
                                        }}";
                    }*/
                    else if(stripos($fieldsKey,'Action')===0)
                    {
                                          $aocolumns[] = "
                             { data   :null,render:function(data,type,row){
                               var toggle_switch;
                                if(data.$status==0)
                                {
                                     return '<a  id='+data.$firstField+' class=\"togglestatus\" ><span class=\"fa fa-toggle-on\" style=\"font-size:25px; color:green; \"></span></a>';
                                }
                                else
                                {
                                    return '<a  id='+data.$firstField+'  class=\"togglestatus\" ><span class=\"fa fa-toggle-off\" style=\"font-size:25px; \" ></span></a>';
                                }
                             }}";
                    }
                    else if(stripos($fieldsKey,'Update')===0)
                        {
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                                 return '<a  id='+data.$firstField+' class=\"updatedata\" ><span class=\"fa fa-edit\"   style=\"font-size:25px; \"></span></a>';
                        
                         }}";
                      }
                      else if(stripos($fieldsKey,'Delete')===0)
                        {
                                      $aocolumns[] = "
                         { data   :null,render:function(data,type,row){
                                 return '<a  id='+data.$firstField+' class=\"deletedata\" ><span class=\"fa fa-times\"   style=\"font-size:25px; \"></span></a>';
                        
                         }}";
                      }
                    
                
                else if(stripos($fieldsKey,'Image')||stripos($fieldsKey,'Logo'))
                {
            
    	        $image_url=site_url('resources/images/').'\'+'.'data'.'.'.$fieldsKey.'+\'';
               //  $image_url=site_url('resources/images/').$fieldsKey[0]->Product_Image;
                 $aocolumns[] = "
                  { data   : null,render:function(data,type,row){
                      return '<img  style=\"height:100px;width:100px;\" src=\"$image_url\">'
                  }}";
                   
                }
                
                else if (strpos($fieldsKey, 'Status') !== false) // matching field
                {
                    $aocolumns[] = "
             { data   :null,render:function(data,type,row){
               var toggle_switch;
                if(data.$fieldsKey==0)
                {
                     return '<span class=\"btn btn-text medium green flat\" style=\"color:green\">Active</span>';
                }
                else
                {
                    return '<span class=\"btn btn-text medium red flat\" style=\"color:red \">Block</span>';
                }
                     }}";
             //   if(sass!=3){return '<a id=\"'+data.ProductID+'\" class=\"togglestatus\">'+toggle_switch+'</a>';}else{return '<a> - </a>';}
                    
                }
                
                else if (strpos($fieldsKey, 'YesNoRadio') !== false) // matching field
                {
                    $aocolumns[] = "
             { data   :null,render:function(data,type,row){
               var toggle_switch;
                if(data.$fieldsKey==0)
                {
                     return '<span class=\"btn btn-text medium green flat\" style=\"color:green\">Yes</span>';
                }
                else
                {
                    return '<span class=\"btn btn-text medium red flat\" style=\"color:red \">No</span>';
                }
                     }}";
             //   if(sass!=3){return '<a id=\"'+data.ProductID+'\" class=\"togglestatus\">'+toggle_switch+'</a>';}else{return '<a> - </a>';}
                    
                }
            }
            else
            {
              $aocolumns[] = '
              { mData  :\''.$fieldsKey.'\'}';
            }
                
            }
        $aocolumns = join(",",$aocolumns);
        return $aocolumns = '[' . $aocolumns . ']';
       /* print_r($aocolumns);
        die();*/
    }
    //ajax success join data
    function ajax_success_join_data($arrayData,$CommanKey='')
    {   $str="";
        if(!sizeof($arrayData)==0)
        {
         $arrayData=$arrayData[0];
       //$arrayData=remove_last_field($arrayData,4);
            foreach($arrayData as $arrayDataKey)
                                      
                 {  
                            if(stripos($arrayDataKey,'Gender'))
                            {
                            //     $str=$str."$('#$arrayDataKey').val(result[0]['$arrayDataKey']);";
                            } 
                            elseif(stripos($arrayDataKey,'Image')||stripos($arrayDataKey,'Logo'))
                            {    $keyName=$CommanKey.$arrayDataKey;
                                 $src=site_url('/resources/images/');
                                 $str=$str."$('#$keyName').attr('src','$src'+result[0]['$arrayDataKey']);";
                                
                            }
                           /* elseif(stripos($arrayDataKey,'Cat'))
                            {
                                $str=$str."$('#$arrayDataKey' option[value='2']).attr('selected',true);";
    //                            $str=$str."$('#$arrayDataKey').val(optionValue).find('option[value=' + optionValue +"]").attr('selected', true);"
                                
                            }  */
                            else
                            {
                                 $keyName=$CommanKey.$arrayDataKey;
                               $str=$str."$('#$keyName').html(result[0]['$arrayDataKey']);";
                            }
                 } return $str;
    
        }    
    }
    //ajax success a data
    function ajax_success_data($arrayData)
    {   $str="";
        //    update for new frame work to multiple search 14/4/2019
            //  $arrayData=remove_last_field($arrayData,4);
                                 
            foreach($arrayData as $arrayDataKey)
                 {  
                            if(stripos($arrayDataKey,'Gender'))
                            {
                            //     $str=$str."$('#$arrayDataKey').val(result[0]['$arrayDataKey']);";
                            }  
                            elseif(stripos($arrayDataKey,'YesNoRadio'))
                            {
                                //check_p($arrayDataKey);
                              //  "$('$arrayDataKey' option[value['0']]).attr('selected',true)";
                                $ifYes=$arrayDataKey."Yes";
                                $ifNo=$arrayDataKey."No";
                               $str=$str."if(result[0]['$arrayDataKey'])
                               {    if(result[0]['$arrayDataKey']==0)
                                    { 
                                        $('.$ifYes').prop('checked', true);
                                     }
                                    else
                                    {
                                        $('.$ifNo').prop('checked', true);
                                    
                                    }
                                   $('#$arrayDataKey').val(result[0]['$arrayDataKey']);
                                  }";
                            }
                            elseif(stripos($arrayDataKey,'Image')||stripos($arrayDataKey,'Logo'))
                            {    $keyName=$arrayDataKey."Name";
                                 $str=$str."$('#$keyName').val(result[0]['$arrayDataKey']);";
                                
                            }
                           /* elseif(stripos($arrayDataKey,'Cat'))
                            {
                                $str=$str."$('#$arrayDataKey' option[value='2']).attr('selected',true);";
    //                            $str=$str."$('#$arrayDataKey').val(optionValue).find('option[value=' + optionValue +"]").attr('selected', true);"
                                
                            }  */
                            else
                            {
                               $str=$str."$('#$arrayDataKey').val(result[0]['$arrayDataKey']);";
                            }
                 } return $str;
    }
    //ajax success a data with key
    function ajax_success_data_with_key($arrayData,$key='',$uniqueId='')
    {   $str="";
        //    update for new frame work to multiple search 14/4/2019
            //  $arrayData=remove_last_field($arrayData,4);
            foreach($arrayData as $arrayDataKey=>$arrayDataData)
                 {  
                            if(stripos($arrayDataKey,'Gender'))
                            {
                            //     $str=$str."$('#$arrayDataKey').val(result[0]['$arrayDataKey']);";
                            }  
                            elseif(stripos($arrayDataKey,'YesNoRadio'))
                            {
                                //check_p($arrayDataKey);
                              //  "$('$arrayDataKey' option[value['0']]).attr('selected',true)";
                                $ifYes=$arrayDataKey."Yes";
                                $ifNo=$arrayDataKey."No";
                               $str=$str."if(result[0]['$arrayDataKey'])
                               {    if(result[0]['$arrayDataKey']==0)
                                    { 
                                        $('.$key$ifYes$uniqueId').prop('checked', true);
                                     }
                                    else
                                    {
                                        $('.$key$ifNo$uniqueId').prop('checked', true);
                                    
                                    }
                                   $('#$arrayDataKey').val(result[0]['$arrayDataKey']);
                                  }";
                            }
                            elseif(stripos($arrayDataKey,'Image'))
                            {    $keyName=$arrayDataKey."Name";
                                 $str=$str."$('#$key$keyName$uniqueId').val(result[0]['$arrayDataKey']);";
                                
                            }
                           /* elseif(stripos($arrayDataKey,'Cat'))
                            {
                                $str=$str."$('#$arrayDataKey' option[value='2']).attr('selected',true);";
    //                            $str=$str."$('#$arrayDataKey').val(optionValue).find('option[value=' + optionValue +"]").attr('selected', true);"
                                
                            }  */
                            else
                            {
                               $str=$str."$('#$key$arrayDataKey$uniqueId').val(result[0]['$arrayDataKey']);";
                            }
                 } return $str;
    }
    //ajax success a data with key innerHTML
        function ajax_success_data_with_key_innerHTML($arrayData,$key='',$uniqueId='')
    {   $str="";
        //    update for new frame work to multiple search 14/4/2019
            //  $arrayData=remove_last_field($arrayData,4);
            foreach($arrayData as $arrayDataKey=>$arrayDataData)
                 {  
                            if(stripos($arrayDataKey,'Gender'))
                            {
                            //     $str=$str."$('#$arrayDataKey').val(result[0]['$arrayDataKey']);";
                            }  
                            elseif(stripos($arrayDataKey,'YesNoRadio'))
                            {
                                //check_p($arrayDataKey);
                              //  "$('$arrayDataKey' option[value['0']]).attr('selected',true)";
                                $ifYes=$arrayDataKey."Yes";
                                $ifNo=$arrayDataKey."No";
                               $str=$str."if(result[0]['$arrayDataKey'])
                               {    if(result[0]['$arrayDataKey']==0)
                                    { 
                                        $('.$key$ifYes$uniqueId').prop('checked', true);
                                     }
                                    else
                                    {
                                        $('.$key$ifNo$uniqueId').prop('checked', true);
                                    
                                    }
                                   $('#$arrayDataKey').val(result[0]['$arrayDataKey']);
                                  }";
                            }
                            /*elseif(stripos($arrayDataKey,'Image'))
                            {    $keyName=$arrayDataKey."Name";
                                 $str=$str."$('#$key$keyName$uniqueId').val(result[0]['$arrayDataKey']);";
                                
                            }*/
                            else if(stripos($arrayDataKey,'Image')||stripos($arrayDataKey,'Logo'))
                            {    $keyName=$arrayDataKey;
                                 $src=site_url('/resources/images/');
                                 $str=$str."$('#$keyName').attr('src','$src'+result[0]['$arrayDataKey']);";
                                
                               // $str='';
                            }                    
                            else
                            {
                               //$str=$str."document.getElementById('$key$arrayDataKey$uniqueId').innerHTML= result[0]['$arrayDataKey'];";
                               
                               $str=$str."if($('#$key$arrayDataKey$uniqueId').length)document.getElementById('$key$arrayDataKey$uniqueId').innerHTML=result[0]['$arrayDataKey'];";
                            }
                 } return $str;
    }
    function  label($field) 
    {
        $field=str_replace("Customer","Doctor",$field);
        
        return preg_replace('/(?<!\ )[A-Z]/', ' $0',$field);
    }
    //for accounts ledger
    function convet_array_ledger($data,$key='',$type='')
    {
        $strFirst='<tr>';
        $str2='';
        $strLast='</tr>';
        $cntDr=1;
        $cntCr=1;
        $strMid='';
        $str='';
        $empty='<td></td><td></td><td></td><td></td>';
        //check_p($type);
        //check_p($data);
        foreach($data as $dataKey)
        { 
                if($dataKey[$key.'DebitAmount']!='')
                {
                    $str2='<td>'.$cntDr.'</td>';
                    $str3='<td>'.$dataKey[$key.'Date'].'</td>';
                    $str4='<td>'.(($type=="AC")?$dataKey['AccountsName']:$key).'<br>('.$dataKey[$key.'Remark'].')'.'</td>';
                    //  $str4="";
                    $str5='<td>'.$dataKey[$key.'DebitAmount'].'</td>';
                    $strMid=$empty.$str2.$str3.$str4.$str5;
                }
                else
                {
                    $str2='<td>'.$cntCr.'</td>';
                    $str3='<td>'.$dataKey[$key.'Date'].'</td>';
                    $str4='<td>'.(($type=="AC")?$dataKey['AccountsName']:$key).'<br>('.$dataKey[$key.'Remark'].')'.'</td>';
                    //  $str4="";
                    $str5='<td>'.$dataKey[$key.'CreditAmount'].'</td>';
                    $strMid=$str2.$str3.$str4.$str5.$empty;
                }
                $str=$str.$strFirst.$strMid.$strLast;
                $cntDr++;
                $cntCr++;
        }
        return $str;
    }
    
    function convet_array_ledger_bankformat($data,$key='')
    {
        $strFirst='<tr>';
        $str2='';
        $strLast='</tr>';
        $cnt=1;
        $str='';
       // check_p($data);
        foreach($data as $dataKey)
        { 
                $str2='<td>'.$cnt.'</td>';
                $str3='<td>'.$dataKey['BanktransactionDate'].'</td>';
                $str4='<td>'.$key.'</td>';
                //  $str4="";
                $str5='<td>'.$dataKey['BanktransactionDebitAmount'].'</td>';
                $str=$str.$strFirst.$str2.$str3.$str4.$str5.$strLast;
                $cnt++;
                
        }
        
        return $str;
    }
?>