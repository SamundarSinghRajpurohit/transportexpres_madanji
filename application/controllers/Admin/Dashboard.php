<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	public function __construct()
	{
		//die("asdasd");
		parent::__construct();
		ini_set('memory_limit', '-1');
		$this->load->helper('url');
		$this->load->helper('download');
        
		$this->load->helper('custom_helper');
		//check_p("asd");
		$set['upload_path']='./resources/images/';
		$set['allowed_types']='png|jpg|gif|jpeg';
		$this->load->library('upload',$set);    
		$this->load->model('Admin/MainModel','mm');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('excel');
		$this->load->library('Pdf');
		
		if(date('d-m-Y') == '20-04-2026')
		{
			echo "<center><h1>pay renewal charges</h1></center>";
			die();
		}

	}

	function pdf_downloadDifferent($id)
    {
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'mroadlines8@gmail.com',
			'smtp_pass' => 'qlhm whbq tkck akqs',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);

		$whereData=array("CompanyId"=>$this->session->CompanyId);
		$data['CompanyData']=$this->mm->get_a_data("tblcompany",$whereData);
		$where=array("OrderId"=>$id);
		$data['OrderData']=$this->mm->get_a_data_join("tblorder",$where);
		$where=array("OrderIdReference"=>$id);
		$data['orderDetail']=$this->mm->get_a_data_join("tblorderdetail",$where);
		// check_p($data['OrderData']);
		if(!empty($data['OrderData'])){

			if($data['OrderData'][0]->DealerEmailId !=""){
				$pdf_file = 'LR_'.$id.'.pdf';

				$pdf_directory = FCPATH . 'resources/pdf/';

				if (!is_dir($pdf_directory)) {
					mkdir($pdf_directory, 0777, true);
				}

				// if (!file_exists($pdf_directory . $pdf_file)) 
				// {
					$html = $this->load->view('Admin/GeneratePdfView', $data, true);
					$pdf_content = $this->pdf->generate($html, 'LR_'.$id, false);
					file_put_contents($pdf_directory . $pdf_file, $pdf_content);
				// }

				// mail send code
				$message = 'LR Invoice';
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('mroadlines8@gmail.com');
				$this->email->to($data['OrderData'][0]->DealerEmailId);
				$this->email->subject('LR Invoice from MAHENDRA ROADLINES');
				$this->email->message($message);
				$this->email->attach($pdf_directory . $pdf_file);

				if($this->email->send())
				{
					// echo 'Email sent.';
					$data = array(
						'message' => 'Email send successfully.',
						'status' => 'true',
						'data' => []
					);
				}
				else
				{
					// show_error($this->email->print_debugger());
					$data = array(
						'message' => 'Issue in email send,please try again.',
						'status' => 'false',
						'data' => []
					);
				}
			}
			else{
				$data = array(
					'message' => 'Please check dealer email id. Email id is blank.',
					'status' => 'false',
					'data' => []
				);
			}
		}
		else{
			$data = array(
				'message' => 'Lr bill data not found.',
				'status' => 'false',
				'data' => []
			);
		}

		header('Content-Type: application/json');
    	echo json_encode($data);
    }

	function pallet_pdf_downloadDifferent($id)
    {
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'mroadlines8@gmail.com',
			'smtp_pass' => 'qlhm whbq tkck akqs',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);

		$whereData=array("CompanyId"=>$this->session->CompanyId);
		$data['CompanyData']=$this->mm->get_a_data("tblcompany",$whereData);
		$where=array("OrderpalletId"=>$id);
		$data['OrderPalletData']=$this->mm->get_a_data_join("tblorderpallet",$where);
		$where=array("OrderpalletIdReference"=>$id);
		$data['OrderPalletDetail']=$this->mm->get_a_data_join("tblorderpalletdetail",$where);
		$data['OrderPalletDetail2']=$this->mm->get_a_data_join("tblorderpalletdetail2",$where);

		// //
		if(!empty($data['OrderPalletData'])){

			if($data['OrderPalletData'][0]->DealerEmailId !=""){
				$pdf_file = 'PL_'.$id.'.pdf';

				$pdf_directory = FCPATH . 'resources/pdf/pallet/';

				if (!is_dir($pdf_directory)) {
					mkdir($pdf_directory, 0777, true);
				}

				// if (!file_exists($pdf_directory . $pdf_file)) 
				// {
					$html = $this->load->view('Admin/PalletGeneratePdfView', $data, true);
					$pdf_content = $this->pdf->generate($html, 'PL_'.$id,false);
					file_put_contents($pdf_directory . $pdf_file, $pdf_content);
				// }

				// mail send code
				$message = 'Pallet Invoice';
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('mroadlines8@gmail.com');
				$this->email->to($data['OrderPalletData'][0]->DealerEmailId);
				$this->email->subject('Pallet Invoice from MAHENDRA ROADLINES');
				$this->email->message($message);
				$this->email->attach($pdf_directory . $pdf_file);

				if($this->email->send())
				{
					// echo 'Email sent.';
					$data = array(
						'message' => 'Email send successfully.',
						'status' => 'true',
						'data' => []
					);
				}
				else
				{
					// show_error($this->email->print_debugger());
					$data = array(
						'message' => 'Issue in email send,please try again.',
						'status' => 'false',
						'data' => []
					);
				}
			}
			else{
				$data = array(
					'message' => 'Please check dealer email id. Email id is blank.',
					'status' => 'false',
					'data' => []
				);
			}
		}
		else{
			$data = array(
				'message' => 'Lr bill data not found.',
				'status' => 'false',
				'data' => []
			);
		}

		header('Content-Type: application/json');
    	echo json_encode($data);
		// 
    }

	public function index()
	{
	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}

		else
		{
    	    $data=$this->index_header();
        	$tblName="tblorder";
  
			if(isset($this->session->EmployeeId))
			{
			    $comId=$this->session->CompanyId;
			    $whereData=array($tblName.'.CompanyId'=>$comId);
			    $whereData1=array('tblorderpallet.CompanyId'=>$comId);
        	    $data['Order']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status1($tblName,'OrderId',$whereData,"desc"));
        	    $data['OrderData']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status1($tblName,'OrderId',$whereData,"Desc"));
        	    $data['PalletData']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status1('tblorderpallet','OrderpalletId',$whereData1,"Desc"));
			}
			else
			{
			    $data['Order']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status($tblName,'OrderId',"desc"));
			}
        	
        	
			$data['Fields']=$this->mm->get_table_heading($tblName);
			$data['OriginalFields']=$data['Fields'];
			$data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);

			$this->index_view($data);
    	}
    }
    //nilesh
    public function  Dashboard()
    {
		$data=$this->index_header();
		$tblName="tblorder";
		$data['OrderData']=convert_object_arraY($this->mm->get_all_data_join_order_by($tblName,'OrderId',"desc"));
	
		$data['Order']=convert_object_arraY($this->mm->get_all_data_join_order_by($tblName,'OrderId',"desc"));
		$this->index_view($data);
    }
    //end
    //nilesh
    public function CategoryDifferent($id='')
   	{
   	     // check_p($tblName);
   	    	
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	    $tblName="tblcategory";
       	   
    	    $keyName="Sales";
    	    $data['tableName']="tblcategory";
    	    $data['tblName']="category";
    	   
    	    $data['pageLink']="Admin/CategoryView";
    	    $data['pageName']="Category";
    	    $data['page']="Category";
	   
	        $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	
       	    if($id)
        	{
        	    $data['pageLink']="Admin/CategoryViewDetail";
    	        $data['pageName']="Category";
                
        	    $whereData['CategoryId']=$id;
        	    $data['CategoryData']=convert_object_arraY($this->mm->get_a_data_join($tblName,$whereData));
                $whereInfo['InformationInfo']=0;
                $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	}
    	    else
        	{
                $data['pageLink']="Admin/CategoryView";
    	        $data['pageName']="Category";
                $data['CategoryData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
                $whereInfo['InformationInfo']=0;
                $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	}
	        $this->new_comman_view_different($data);
		}
   	}
   	
    //end
    //nilesh 15/2/2021 packing   right h bad me kam aayega
   	/* public function PackingDifferent($id='')
   	{
   	    if(!$this->session->AdminId)
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblpacking";
    	   $keyName="packing";
    	   $data['tableName']="tblpacking";
    	   $data['tblName']="Packing";
    	   $data['pageLink']="Admin/packingview";
    	   $data['pageName']="Packing";
    	   $data['page']="Packing";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	         	$data['tableNameData']=$this->mm->get_all_table_heading();
	        	$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
 	   
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
           	
        	$this->new_comman_view_different($data);
        }
   	}
   */
    //end
    public function OrderDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblorder";
    	   $keyName="Order";
    	   $data['tableName']="tblorder";
    	   $data['tblName']="order";
    	//    $data['pageLink']="Admin/OrderView2";
		   $data['pageLink']="Admin/OrderView2_samutest";
    	   $data['pageName']="Order";
    	   $data['page']="Order";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	        $data['tableNameData']=$this->mm->get_all_table_heading();
	        $data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
 	   
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
     	    if(isset($this->session->EmployeeId))
			{
			    $comId=$this->session->CompanyId;
			    $whereData=array($tblName.'.CompanyId'=>$comId);
			    // $data['mainData']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status1($tblName,'OrderId',$whereData,'desc'));
  
			}
			else
			{
			    // $data['mainData']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status($tblName,"OrderId",'ASC'));
			}
			$data['mainData']=array();
        	$this->new_comman_view_different($data);
        }
   	}
   	
	/**
	 *@uses function to getList
	 */
	public function getListDifferent()
	{
		$start = $this->input->post('start');
		$select = '*';
		$final['recordsTotal'] = $this->mm->getList("tblorder", $select, 'count');
		$keyword = $this->input->post('search');
		$final['redraw'] = 1;
		$final['recordsFiltered'] = $final['recordsTotal'];
		$final['data'] = $this->mm->getList("tblorder", $select, 'result');
		// echo $this->db->last_query();
		echo json_encode($final);exit;
	}

   	//samundar add for fast load 24-02-2022
   	public function OrderV2Different($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblorder";
    	   $keyName="Order";
    	   $data['tableName']="tblorder";
    	   $data['tblName']="order";
    	   $data['pageLink']="Admin/Order2View2";
    	   $data['pageName']="Order";
    	   $data['page']="Order";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	        $data['tableNameData']=$this->mm->get_all_table_heading();
	        $data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
 	   
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
     	     if(isset($this->session->EmployeeId))
			{
			    $comId=$this->session->CompanyId;
			    $whereData=array($tblName.'.CompanyId'=>$comId);
			   // $data['mainData']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status1($tblName,"DealerId",$whereData,'ASC'));
			    $data['mainData']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status1($tblName,'OrderId',$whereData,'desc'));
  
			}
			else
			{
			    $data['mainData']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status($tblName,"OrderId",'ASC'));
			}
       	    
           // $data['mainData']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status($tblName,'OrderId','desc'));
           	 
        	$this->new_comman_view_different($data);
        }
   	}
   	//samundar end
   	
   	//samundra add pallet differnt controller 19-05-2021
   	public function palletDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblorderpallet";
    	   $keyName="Orderpallet";
    	   $data['tableName']="tblorderpallet";
    	   $data['tblName']="orderpallet";
    	//    $data['pageLink']="Admin/PalletView";
		   $data['pageLink']="Admin/PalletView_samutest";
    	   $data['pageName']="Order Pallet";
    	   $data['page']="Order Pallet";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	        $data['tableNameData']=$this->mm->get_all_table_heading();
	        $data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
 	   
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
     	    if(isset($this->session->EmployeeId))
			{
			    $comId=$this->session->CompanyId;
			    $whereData=array($tblName.'.CompanyId'=>$comId);			   
			    // $data['mainData']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status1($tblName,'OrderpalletId',$whereData,'desc'));
  
			}
			else
			{
			    // $data['mainData']=convert_object_arraY($this->mm->get_all_data_join_order_by_active_status($tblName,"OrderpalletId",'ASC'));
			}
			$data['mainData'] = array();
           	 
        	$this->new_comman_view_different($data);
        }
   	}

	public function getListPalletDifferent()
	{
		$start = $this->input->post('start');
		$select = '*';
		$final['recordsTotal'] = $this->mm->getPalletList("tblorderpallet", $select, 'count');
		$keyword = $this->input->post('search');
		$final['redraw'] = 1;
		$final['recordsFiltered'] = $final['recordsTotal'];
		$final['data'] = $this->mm->getPalletList("tblorderpallet", $select, 'result');
		echo json_encode($final);exit;
	}
   	//samundra end
   	//samundar add for create custom form for order or lr form 15-04-2021
   	public function AddOrderCustomDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	   $tblName="tblorder";
    	   $keyName="Order";
    	   $data['tableName']="tblorder";
    	   $data['tblName']="order";
    	   $data['pageLink']="Admin/addOrdercustom";
    	   $data['pageName']="Order";
    	   $data['page']="order";
    	   
    	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	       $data['OriginalFields']=$data['Fields'];
 	       $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	       $data['tableNameData']=$this->mm->get_all_table_heading();
	       $data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
		
    	   $data['Fields']=$this->mm->get_table_heading($tblName);
     	   $data['OriginalFields']=$data['Fields'];
     	   $comId=$this->session->CompanyId;

     	   if(isset($id))
			{
				$where=array("OrderId"=>$id);
				$data['OrderData']=$this->mm->get_a_data_join("tblorder",$where);
				$where=array("OrderIdReference"=>$id);
				$data['orderDetail']=$this->mm->get_a_data_join("tblorderdetail",$where);
		
			}
			
           $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
           	
           $this->new_comman_view_different($data);
        }
   	}
   	//samundar end
   	//samundar add api for Pallet custom from 23-04-2021
   	public function AddPalletCustomDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	   $tblName="tblorderpallet";
    	   $keyName="Orderpallet";
    	   $data['tableName']="tblorderpallet";
    	   $data['tblName']="orderpallet";
    	   $data['pageLink']="Admin/addPalletcustom";
    	   $data['pageName']="Orderpallet";
    	   $data['page']="orderpallet";
    	   
    	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	       $data['OriginalFields']=$data['Fields'];
 	       $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	       $data['tableNameData']=$this->mm->get_all_table_heading();
	       $data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
		
    	   $data['Fields']=$this->mm->get_table_heading($tblName);
     	   $data['OriginalFields']=$data['Fields'];
     	
     	   $comId=$this->session->CompanyId;
     	   if(isset($id))
			{
				$where=array("OrderpalletId"=>$id);
				$data['OrderData']=$this->mm->get_a_data_join("tblorderpallet",$where);
				$where=array("OrderpalletdetailId"=>$id);
				$data['orderDetail']=$this->mm->get_a_data_join("tblorderpalletdetail",$where);
		
			}
			
           $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
           	
           $this->new_comman_view_different($data);
        }
   	}
   	//samundar end
   	//nilsh
   	public function OldOrderDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblorder";
    	   $keyName="Order";
    	   $data['tableName']="tblorder";
    	   $data['tblName']="order";
    	   $data['pageLink']="Admin/OldOrderView";
    	   $data['pageName']="Order";
    	   $data['page']="Order";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['OrderData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
            //$data['OrderData']=convert_object_arraY($this->mm->custom_query("SELECT * FROM tblorder INNER JOIN tblcustomer ON tblorder.CustomerId = tblcustomer.CustomerId WHERE OrderDate not like DATE(NOW())"));
            $data['OrderData']=convert_object_arraY($this->mm->custom_query("SELECT tblorder.OrderId,tblorder.OrderDate,tblorder.OrderTotal, tblconsignor.ConsignorName FROM((tblorder INNER JOIN tblconsignor  ON tblorder.ConsignorId = tblconsignor.ConsignorId)) WHERE OrderDate not like DATE(NOW())"));
            //print_r($data['OrderData']);
        	$this->new_comman_view_different($data);
        }
   	}
   	
   	
   	//end
   	public function OrderPrintDifferent($id)
	{
	    // check_p($tblName);
	    $tblName="tblorder";
	    //$data=$this->new_comman_header_different('tbl'.strtolower($tblName));
	    $data['pageLink']="Admin/OrderBill";
    	   
	    $whereData=array("tblorder.OrderId"=>$id);
	    $data['BillData']=$this->mm->get_all_data_join("tblfirm");
	    $data['mainData']=$this->mm->get_a_data_join($tblName,$whereData);
	    $where=array("tblorderdetail.OrderIdReference"=>$id);
	    $data['orderDetail']=$this->mm->get_a_data_join("tblorderdetail",$where);
	    
	    // $TypeData=$this->mm->get_a_data('tbltype','TypeId',$data['BillData'][0]->TypeId);
	    // $data['TypeData']=$TypeData;
        // $HSNData=$this->mm->get_a_data('tblhsn','HsnId',$data['TypeData'][0]->HsnId);
        // $data['HsnData']=$HSNData;
	   // check_p($data);
	    	$data['tableNameData']=$this->mm->get_all_table_heading();
 	    
 	 	$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
 	   
	   $this->new_comman_view_different($data);
	    
	}
	//nilesh
   	public function LowStockDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblproduct";
    	   $keyName="Product";
    	   $data['tableName']="tblproduct";
    	   $data['tblName']="order";
    	   $data['pageLink']="Admin/LowStockView";
    	   $data['pageName']="Product";
    	   $data['page']="Product";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['ProductData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	//$data['ProductData']=convert_object_arraY($this->mm->custom_query("SELECT *, `ProductQty`-`ProductLowstock` AS `difference` FROM tblproduct ORDER BY `difference`"));
           // $data['ProductData']=convert_object_arraY($this->mm->custom_query("SELECT *,`SubcategoryName`, `ProductQty`-`ProductLowstock` AS `difference` FROM tblproduct INNER JOIN tblsubcategory ON tblproduct.SubcategoryId = tblsubcategory.SubcategoryId ORDER BY `difference`"));
            //samundar add 26-02-2021
            //$data['ProductData']=convert_object_arraY($this->mm->custom_query("SELECT *,`SubcategoryName`, `ProductdetailQty`-`ProductdetailLowstock` AS `difference` FROM tblproduct INNER JOIN tblsubcategory ON tblproduct.SubcategoryId = tblsubcategory.SubcategoryId INNER JOIN tblproductdetail ON tblproduct.ProductId= tblproductdetail.ProductIdReference ORDER BY `difference`"));
            //samundar end
        	$this->new_comman_view_different($data);
        }
   	}
   	public function HighestDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblproduct";
    	   $keyName="Product";
    	   $data['tableName']="tblproduct";
    	   $data['tblName']="order";
    	   $data['pageLink']="Admin/HighestSellingView";
    	   $data['pageName']="Product";
    	   $data['page']="Product";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['$ProductHighestData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	//$data['ProductHighestData']=convert_object_arraY($this->mm->custom_query("select P.ProductId,P.ProductName,C.SubcategoryName,MAX(O.OrderdetailQty) from tblproduct as P,tblorderdetail as O,tblsubcategory as C where P.ProductId=O.productId AND P.SubcategoryId=C.SubcategoryId group by ProductId ORDER BY O.OrderdetailQty DESC"));
           
            
        	$this->new_comman_view_different($data);
        }
   	}
   	 	public function BannerDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblbanner";
    	   $keyName="Banner";
    	   $data['tableName']="tblbanner";
    	   $data['tblName']="banner";
    	   $data['pageLink']="Admin/Banner";
    	   $data['pageName']="Banner";
    	   $data['page']="Banner";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            //$data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $data['mainData']=$this->mm->get_all_data($tblName);
            /*echo"<pre>";
            print_r($data);
            die();*/
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}
  public function BonusDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblbonus";
    	   $keyName="Banner";
    	   $data['tableName']="tblbonus";
    	   $data['tblName']="Bonus";
    	   $data['pageLink']="Admin/Bonus";
    	   $data['pageName']="Bonus";
    	   $data['page']="Bonus";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data($tblName));
            //$data['mainData']=$this->mm->get_all_data($tblName);
            /*echo"<pre>";
            print_r($data);
            die();*/
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}
   
   	//end
   	
	public function BillPrintDifferent($id)  
	{
		$tblName="tblorder";
		//$data=$this->new_comman_header_different('tbl'.strtolower($tblName));
		$data['pageLink']="Admin/LRPrint";
		
		$whereData=array("CompanyId"=>$this->session->CompanyId);
		$data['CompanyData']=$this->mm->get_a_data("tblcompany",$whereData);
		$where=array("OrderId"=>$id);
		$data['OrderData']=$this->mm->get_a_data_join("tblorder",$where);
		$where=array("OrderIdReference"=>$id);
		$data['orderDetail']=$this->mm->get_a_data_join("tblorderdetail",$where);
		
		//print_r($data['orderDetail']);
		$data['tableNameData']=$this->mm->get_all_table_heading();
		$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
		$this->new_comman_view_different($data);
	    
	}

    //samundar add controller  for Tempo report data print 08-08-2021
    public function TempoReportDifferent($id='')  
	{

		$RadioValue=$this->input->post("exampleRadios");
		$data['pageLink']="Admin/TempoReportPrint";
	    //echo $RadioValue; 
		$todate=$this->input->post("ToDate");
		$fromdate=$this->input->post("FromDate");
		$InvoiceNo=$this->input->post("InvoiceNo");
		$InvoiceDate=$this->input->post("invoiceDate");
		$data['InvoiceNo']=array("InvoiceNo"=>$InvoiceNo);
		$data['InvoiceDate']=array("InvoiceDate"=>$InvoiceDate);
		$CompanyId=$this->session->CompanyId;
        $data['DealerData1']=array();
        //samundar add for all record data 08-08-2021
		if($RadioValue=='all')
		{
		    $sql="select * from (((tblorder join tblconsignee on tblorder.ConsigneeId=tblconsignee.ConsigneeId) join tbltempo ON tblorder.TempoId=tbltempo.TempoId)join tblorderdetail on  tblorder.OrderId=tblorderdetail.OrderIdReference)where  tblorder.CompanyId=$CompanyId And (tblorder.OrderDate >= '$fromdate' AND tblorder.OrderDate <= '$todate') And tblorder.OrderStatus=0 order by tblorder.OrderDate";   
		    $data['DealerData1']=array("TempoName"=>"All");
		}
		else
		{
		    $Id=$this->input->post("TempoId");
		    $strPosData=strpos($Id,'-');
            $tempoId=substr($Id,0,$strPosData);
            $sql="select * from (((tblorder join tblconsignee on tblorder.ConsigneeId=tblconsignee.ConsigneeId) join tbltempo ON tblorder.TempoId=tbltempo.TempoId)join tblorderdetail on  tblorder.OrderId=tblorderdetail.OrderIdReference)where tblorder.TempoId=$tempoId AND tblorder.CompanyId=$CompanyId And (tblorder.OrderDate >= '$fromdate' AND tblorder.OrderDate <= '$todate') And tblorder.OrderStatus=0 order by tblorder.OrderDate";
		
		    $whereData=array("TempoId"=>$tempoId);
		    $data['DealerData']=$this->mm->get_a_data("tbltempo",$whereData);
		}
        //samundar end
        
		//samundra end
		$data['Date']=array("To"=>$todate,"From"=>$fromdate);
		$tblName="tblorder";

		$data['reportData']=$this->mm->custom_query($sql);

        $sql="select count(OrderIdReference) as LRTotal,OrderIdReference as orderId from tblorderdetail GROUP BY OrderIdReference";
        $data['orderdetailData']=$this->mm->custom_query($sql);
        //check_p($data['orderdetailData']);
		$whereData=array("CompanyId"=>$this->session->CompanyId);
		$data['CompanyData']=$this->mm->get_a_data("tblcompany",$whereData);
		
		
		

		//print_r($data['orderDetail']);
		$data['tableNameData']=$this->mm->get_all_table_heading();
		$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
		$this->new_comman_view_different($data);
	    
	}
    //samundar end

	public function CompaniesReportDifferent($id='')  
	{
		$RadioValue=$this->input->post("exampleRadios");
		$data['pageLink']="Admin/CompaniesReportPrint";
		$todate=$this->input->post("ToDate");
		$fromdate=$this->input->post("FromDate");
		$InvoiceNo=$this->input->post("InvoiceNo");
		$InvoiceDate=$this->input->post("invoiceDate");
		$data['InvoiceNo']=array("InvoiceNo"=>$InvoiceNo);
		$data['InvoiceDate']=array("InvoiceDate"=>$InvoiceDate);
		$data['InvoiceType']=$this->input->post("lr");
		$CompanyId=$this->session->CompanyId;
        $data['DealerData1']=array();
		if($RadioValue=='all')
		{
			if($data['InvoiceType'] == 'lr'){
				$sql="select * from ((((tblorder join tblconsignee on tblorder.ConsigneeId=tblconsignee.ConsigneeId) join 
				tbltempo ON tblorder.TempoId=tbltempo.TempoId)join tblcompanies ON tblorder.Companies=tblcompanies.CompaniesId)join tblorderdetail on  tblorder.OrderId=tblorderdetail.
				OrderIdReference)where  tblorder.CompanyId=$CompanyId And (tblorder.OrderDate >= '$fromdate' AND tblorder.
				OrderDate <= '$todate') And tblorder.OrderStatus=0 order by tblorder.OrderDate";
			}
			else{
				$sql="select * from (((((tblorderpallet) join tblorderpalletdetail2 on tblorderpallet.OrderpalletId = tblorderpalletdetail2.OrderpalletIdReference)join 
				tbltempo ON tblorderpallet.TempoId=tbltempo.TempoId)join tblcompanies ON tblorderpallet.Companies=tblcompanies.CompaniesId)join tblorderpalletdetail on tblorderpallet.OrderpalletId=tblorderpalletdetail.
				OrderpalletIdReference)where tblorderpallet.CompanyId=$CompanyId And (tblorderpallet.OrderpalletDate >= '$fromdate' AND tblorderpallet.
				OrderpalletDate <= '$todate') And tblorderpallet.OrderpalletStatus=0 order by tblorderpallet.OrderpalletDate";
			}
		    $data['DealerData1']=array("CompaniesName"=>"All");
		}
		else
		{
		    $Id=$this->input->post("CompaniesId");
		    $strPosData=strpos($Id,'-');
            $tempoId=substr($Id,0,$strPosData);

			if($data['InvoiceType'] == 'lr'){
				$sql="select * from ((((tblorder join tblconsignee on tblorder.ConsigneeId=tblconsignee.ConsigneeId) join 
				tbltempo ON tblorder.TempoId=tbltempo.TempoId) join tblcompanies ON tblorder.Companies=tblcompanies.CompaniesId)join tblorderdetail on  tblorder.OrderId=tblorderdetail.
				OrderIdReference)where tblorder.Companies=$tempoId AND tblorder.CompanyId=$CompanyId And (tblorder.OrderDate 
				>= '$fromdate' AND tblorder.OrderDate <= '$todate') And tblorder.OrderStatus=0 order by tblorder.OrderDate";
			}
			else{
				$sql="select * from (((((tblorderpallet) join tblorderpalletdetail2 on tblorderpallet.OrderpalletId = tblorderpalletdetail2.OrderpalletIdReference)
				join tbltempo ON tblorderpallet.TempoId=tbltempo.TempoId) join tblcompanies ON tblorderpallet.Companies=tblcompanies.CompaniesId)join tblorderpalletdetail on tblorderpallet.OrderpalletId=tblorderpalletdetail.
				OrderpalletIdReference)where tblorderpallet.Companies=$tempoId AND tblorderpallet.CompanyId=$CompanyId And (tblorderpallet.OrderpalletDate 
				>= '$fromdate' AND tblorderpallet.OrderpalletDate <= '$todate') And tblorderpallet.OrderpalletStatus=0 order by tblorderpallet.OrderpalletDate";
			}
		    $whereData=array("CompaniesId"=>$tempoId);
		    $data['DealerData']=$this->mm->get_a_data("tblcompanies",$whereData);
		}

		$data['Date']=array("To"=>$todate,"From"=>$fromdate);
		$tblName="tblorder";

		$data['reportData']=$this->mm->custom_query($sql);

        $sql="select count(OrderIdReference) as LRTotal,OrderIdReference as orderId from tblorderdetail GROUP BY 
		OrderIdReference";
        $data['orderdetailData']=$this->mm->custom_query($sql);
		$whereData=array("CompanyId"=>$this->session->CompanyId);
		$data['CompanyData']=$this->mm->get_a_data("tblcompany",$whereData);

		$data['tableNameData']=$this->mm->get_all_table_heading();
		$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
		$this->new_comman_view_different($data);
	}
    
	//samundar add controller  for Dealer report data print 20-05-2021
	public function DealerReportDifferent($id='')  
	{
		$RadioValue=$this->input->post("exampleRadios");
		$todate=$this->input->post("ToDate");
		$fromdate=$this->input->post("FromDate");
		$InvoiceNo=$this->input->post("InvoiceNo");
		$InvoiceDate=$this->input->post("invoiceDate");
		$data['InvoiceNo']=array("InvoiceNo"=>$InvoiceNo);
		$data['InvoiceDate']=array("InvoiceDate"=>$InvoiceDate);
		$CompanyId=$this->session->CompanyId;
        $data['DealerData1']=array();
        //samundar add for all record data 08-08-2021
		if($RadioValue=='all')
		{
		    $sql="select * from ((((tblorder join tblconsignee on tblorder.ConsigneeId=tblconsignee.ConsigneeId) join tbltempo ON 
		         tblorder.TempoId=tbltempo.TempoId)join tblorderdetail on  tblorder.OrderId=tblorderdetail.OrderIdReference)join 
		         tbldealer on  tblorder.DealerId=tbldealer.DealerId) where 
		         tblorder.CompanyId=$CompanyId And (tblorder.OrderDate >= '$fromdate' AND tblorder.OrderDate <= '$todate') And 
		         tblorder.OrderStatus=0 order by tblorder.DealerId ";   
		    $data['DealerData1']=array("DealderName"=>"All");
		    $data['pageLink']="Admin/DealerReportPrintAll";
		}
		else
		{
		    $data['pageLink']="Admin/DealerReportPrint";
		    $Id=$this->input->post("DealerId");
		    $strPosData=strpos($Id,'-');
            $dealerId=substr($Id,0,$strPosData);
            $sql="select * from (((tblorder join tblconsignee on tblorder.ConsigneeId=tblconsignee.ConsigneeId) join tbltempo ON tblorder.TempoId=tbltempo.TempoId)join tblorderdetail on  tblorder.OrderId=tblorderdetail.OrderIdReference)where tblorder.DealerId=$dealerId AND tblorder.CompanyId=$CompanyId And (tblorder.OrderDate >= '$fromdate' AND tblorder.OrderDate <= '$todate') And tblorder.OrderStatus=0 order by tblorder.OrderDate";
		
		    $whereData=array("DealerId"=>$dealerId);
		    $data['DealerData']=$this->mm->get_a_data("tbldealer",$whereData);
		}
		//samundra end

		$data['Date']=array("To"=>$todate,"From"=>$fromdate);
		$tblName="tblorder";

        $data['dealerData']=$this->mm->custom_query("select * from tbldealer");
		$data['reportData']=$this->mm->custom_query($sql);
        $sql="select count(OrderIdReference) as LRTotal,OrderIdReference as orderId from tblorderdetail GROUP BY OrderIdReference";
        $data['orderdetailData']=$this->mm->custom_query($sql);

		$whereData=array("CompanyId"=>$this->session->CompanyId);
		$data['CompanyData']=$this->mm->get_a_data("tblcompany",$whereData);

		$data['tableNameData']=$this->mm->get_all_table_heading();
		$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
		$this->new_comman_view_different($data);
	}
	//samundar end
	
	//samundar add controller  for Pallet report data print 05-06-2021
	public function PalletReportDifferent($id='')  
	{
		//samundra ad
		$data['pageLink']="Admin/PalletReportPrint";
		$RadioValue=$this->input->post("exampleRadios");
		
		$todate=$this->input->post("ToDate");
		$fromdate=$this->input->post("FromDate");
		$InvoiceNo=$this->input->post("InvoiceNo");
		$InvoiceDate=$this->input->post("invoiceDate");
		$data['InvoiceNo']=array("InvoiceNo"=>$InvoiceNo);
		$data['InvoiceDate']=array("InvoiceDate"=>$InvoiceDate);
		$CompanyId=$this->session->CompanyId;

		//samundra end
		$data['Date']=array("To"=>$todate,"From"=>$fromdate);
		$tblName="tblorder";
		//$data=$this->new_comman_header_different('tbl'.strtolower($tblName));
		
		if($RadioValue=='all')
		{
		    $sql="select * from ((tblorderpallet  join tbltempo ON tblorderpallet.TempoId=tbltempo.TempoId)join tblorderpalletdetail2 on  tblorderpallet.OrderpalletId=tblorderpalletdetail2.OrderpalletIdReference)where tblorderpallet.CompanyId=$CompanyId And (tblorderpallet.OrderpalletDate >= '$fromdate' AND tblorderpallet.OrderpalletDate <= '$todate') And tblorderpallet.OrderpalletStatus=0 order by tblorderpallet.OrderpalletDate";
		    $data['DealerData1']=array("DealderName"=>"All");
		}
		else
		{
		    $Id=$this->input->post("DealerId");
		    $strPosData=strpos($Id,'-');
            $dealerId=substr($Id,0,$strPosData);
            
            $sql="select * from ((tblorderpallet  join tbltempo ON tblorderpallet.TempoId=tbltempo.TempoId)join tblorderpalletdetail2 on  tblorderpallet.OrderpalletId=tblorderpalletdetail2.OrderpalletIdReference)where tblorderpallet.DealerId=$dealerId AND tblorderpallet.CompanyId=$CompanyId And (tblorderpallet.OrderpalletDate >= '$fromdate' AND tblorderpallet.OrderpalletDate <= '$todate') And tblorderpallet.OrderpalletStatus=0 order by tblorderpallet.OrderpalletDate";
		    $whereData=array("DealerId"=>$dealerId);
		    $data['DealerData']=$this->mm->get_a_data("tbldealer",$whereData);
		    
		}
		$data['reportData']=$this->mm->custom_query($sql);
		// check_p($data['reportData']);
		$whereData=array("CompanyId"=>$this->session->CompanyId);
		$data['CompanyData']=$this->mm->get_a_data("tblcompany",$whereData);
		
		
		
		$data['tableNameData']=$this->mm->get_all_table_heading();
		$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
		$this->new_comman_view_different($data);
	    
	}
	//samundar end
	//samundar create for bill print 17-04-2021
	public function BillPrintDifferentTransport($id)
	{
		// check_p($tblName);
		$tblName="tblorder";
		//$data=$this->new_comman_header_different('tbl'.strtolower($tblName));
		$data['pageLink']="Admin/Bill_samu";
		
		$whereData=array("CompanyId"=>$this->session->CompanyId);
		$data['CompanyData']=$this->mm->get_a_data("tblcompany",$whereData);
		$where=array("OrderId"=>$id);
		$data['OrderData']=$this->mm->get_a_data_join("tblorder",$where);
		$where=array("OrderIdReference"=>$id);
		$data['orderDetail']=$this->mm->get_a_data_join("tblorderdetail",$where);
		
		//print_r($data['OrderData']);
		$data['tableNameData']=$this->mm->get_all_table_heading();
		$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
		$this->new_comman_view_different($data);
	    
	}
	//samundar end
	//samundar add controll for pallet bill 23-04-2021
	public function PalletBillPrintDifferentTransport($id)
	{
		// check_p($tblName);
		$tblName="tblorder";
		//$data=$this->new_comman_header_different('tbl'.strtolower($tblName));
		$data['pageLink']="Admin/PalletBillView"; 
		
		$whereData=array("CompanyId"=>$this->session->CompanyId);
		$data['CompanyData']=$this->mm->get_a_data("tblcompany",$whereData);
		$where=array("OrderpalletId"=>$id);
		$data['OrderPalletData']=$this->mm->get_a_data_join("tblorderpallet",$where);
		$where=array("OrderpalletIdReference"=>$id);
		$data['OrderPalletDetail']=$this->mm->get_a_data_join("tblorderpalletdetail",$where);
		$data['OrderPalletDetail2']=$this->mm->get_a_data_join("tblorderpalletdetail2",$where);
		 
		//print_r($data['OrderData']);
		$data['tableNameData']=$this->mm->get_all_table_heading();
		$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
		$this->new_comman_view_different($data);
	    
	}
	//samundar end
    public function logout()
	{
	    $this->session->sess_destroy();
	    $this->load->view('Admin/login');
	    
	}
	public function CreateCSVDifferent($data1='')
	{
	        $tblName="tbl".$data1;
	    
	}
	
	public function MemberCardDifferent($data1='')
	{
	
	  // $keyName="Sales";
	 
	   $data['pageLink']="Admin/MemberCardDetail";
	   $data['pageName']="MemberCardDetail";
	   $data['page']="MemberCardDetail";
	   $tblName="tblcashtransaction";
	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	   $data['OriginalFields']=$data['Fields'];
 	
	   //  check_p("asd");
	   
	  $data=$this->new_comman_header_different($data,'');
	 
	          //  check_p("asd");
	   $this->new_comman_view_different($data);
	    
	}
	public function AccountingDifferent($data1='')
	{
	
	  // $keyName="Sales";
	 
	   $data['pageLink']="Admin/Accounting";
	   $data['pageName']="Accounting";
	   $data['page']="Accounting";
	   $tblName="tblcashtransaction";
	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	   $data['OriginalFields']=$data['Fields'];
 	   $tblName1="tblbanktransaction";
 	   $data['BankFields']=$this->mm->get_table_heading($tblName1);
	   $data['BankOriginalFields']=$data['BankFields'];
	   //  check_p("asd");
	   
	  $data=$this->new_comman_header_different($data,'');
	 
	          //  check_p("asd");
	   $this->new_comman_view_different($data);
	    
	}
	
	/*public function LedgerDifferent($data1='')
	{
	
	   //$keyName="ledger";
	   $tblName="tblledger";
       $keyName="ledger";
	   $data['tableName']='tblledger'; 
	   $data['tblName']="ledger";
	   $data['pageLink']="Admin/Ledger";
	   $data['pageName']="Ledger";
	   $data['page']="Ledger";
	 
	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	   $data['OriginalFields']=$data['Fields'];
 	
	   //  check_p("asd");
	   
	  $data=$this->new_comman_header_different($data,'');
	 
	          //  check_p("asd");
	   $this->new_comman_view_different($data);
	    
	}*/
	public function BankLedgerDifferent($data1='')
	{
	
	  // $keyName="Sales";
	   $keyName="BankLedger";
	   $data['tableName']='tblbankledger';
	   $data['pageLink']="Admin/BankLedger";
	   $data['tblName']="BankLedger";
	   $data['pageName']="BankLedger";
	   $data['page']="Ledger";
	   $tblName="tblbankledger";
	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	   $data['OriginalFields']=$data['Fields'];
 	
	   //  check_p("asd");
	   
	  $data=$this->new_comman_header_different($data,'');
	          //  check_p("asd");
	   $this->new_comman_view_different($data);
	    
	}
	public function CashLedgerDifferent($data1='')
	{
	
	  // $keyName="Sales";
	   $keyName="CashLedger";
	   $data['tableName']='tblcashledger';
	   $data['pageLink']="Admin/CashLedger";
	   $data['tblName']="CashLedger";
	   $data['pageName']="CashLedger";
	   $data['page']="Ledger";
	   $tblName="tblcashledger";
	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	   $data['OriginalFields']=$data['Fields'];
 	
	   //  check_p("asd");
	   
	  $data=$this->new_comman_header_different($data,'');
	 
	          //  check_p("asd");
	   $this->new_comman_view_different($data);
	    
	}

	public function CreateCSVDemoDifferent($data1='')
	{       
	        $tblName="tbl".$data1;
	        $data[]=$this->mm->get_table_heading($tblName);
	        $data=replace_id_name($data[0]);
	        $data=remove_first_last_field($data);
	        //$data=remove_last_field()
	        $data=array($data);
	       
 	        $fileName=$data1.".csv";
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=".$fileName);
            header("Pragma: no-cache");
            header("Expires: 0");
           
            $handle = fopen('php://output', 'w');
                 
            foreach ($data as $data) {
                fputcsv($handle, $data);
            }
           // check_p($data);
            fclose($handle);
            exit;
   	}
   	
   	//samu send notification 21-01-2021
   	public function MobileNotification_old_Different($id='')//old nilesh added 
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	 //     check_p($tblName);
       	    	
       	   $tblName="tblmobilenotification";
    	   $keyName="mobileNotification";
    	   $data['tableName']="tblmobilenotification";
    	   $data['tblName']="mobileNotification";
    	   $data['pageLink']="Admin/MobileNotification";
    	   $data['pageName']="mobileNotification";
    	   $data['page']="mobileNotification";
    	  
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	        //samu
 	        
 	        $sideBarData=$this->get_sidebarData($this->session->AdminLevelId,$data['page'],'','yes');
    	    //check_p($sideBarData);
         	$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$sideBarData['tableNameData']));
         	
 	        //end
    	    
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	   
       	   
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
          //  $whereInfo['InformationInfo']=0;
        //    $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}
   	//kd  ledger diff  26/02/2021
   	public function LedgerDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblledger";
    	   $keyName="ledger";
    	   $data['tableName']=$tblName;
    	   $data['tblName']=$keyName;
    	   $data['pageLink']="Admin/Ledger";
    	   $data['pageName']=$keyName;
    	   $data['page']="Ledger";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}
   	//nilesh
   	
   		public function MobileNotificationDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	 //     check_p($tblName);
       	    	
       	   $tblName="tblmobilenotification";
    	   $keyName="mobileNotification";
    	   $data['tableName']="tblmobilenotification";
    	   $data['tblName']="mobileNotification";
    	   $data['pageLink']="Admin/MobileNotification";
    	   $data['pageName']="mobileNotification";
    	   $data['page']="mobileNotification";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}

   	//end
   	//nilesh
   	public function FAQDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblfaq";
    	   $keyName="FAQ";
    	   $data['tableName']="tblfaq";
    	   $data['tblName']="faq";
    	   $data['pageLink']="Admin/FAQView";
    	   $data['pageName']="Faq";
    	   $data['page']="Faq";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}
   	//end
   		public function NotificationDifferent()
   	{
   	     // check_p($tblName);
   	   $tblName="tblinformation";
	   $keyName="Sales";
	   
	   $data['pageLink']="Admin/NotificationView";
	   $data['pageName']="Notification";
	   $data['NotificationData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
	      
        $where=array();
		$updateData=array('InformationInfo'=>1);
		$this->mm->update_data_api("tblinformation",$updateData,$where);
        	
	   $whereInfo['InformationInfo']=0;
        $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
	   
	   $this->new_comman_view_different($data);
   	}
   	public function SMSDifferent()
   	{
   	     // check_p($tblName);
   	   $tblName="tblconsignor";
	   $keyName="Sales";
	   $data['pageLink']="Admin/SMSView";
	   $data['pageName']="SMS";
	   $data['CustomerData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
	     $data['page']="Category";
	    
        $where=array();
		$updateData=array('InformationInfo'=>1);
		$this->mm->update_data_api("tblinformation",$updateData,$where);
        	
	   $whereInfo['InformationInfo']=0;
        $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
	   
	   $this->new_comman_view_different($data);
   	}
   
   
   	//end
   	
   	public function ReportDifferent()
   	{
   	     // check_p($tblName);
	   $keyName="Sales";
	   $data=$this->new_comman_header_different('tbl'.strtolower($keyName));
	   $data['pageLink']="Admin/ReportView";
	   $data['pageName']="Report";
	   if($this->input->post('FromDate')&&$this->input->post('ToDate'))
	   {
	       
	   $fromDate=$this->input->post('FromDate');
	   $toDate=$this->input->post('ToDate');
	   $tblName='tblsales';
	   $tableIdName=ucfirst(remove("tbl",$tblName)."Id");
	   //$whereData=array($tableIdName=>$id);
	   $data['BillData']=$this->mm->get_all_data_join_order_by($tblName,'SalesAirInovice');
	  /* $TypeData=$this->mm->get_a_data('tbltype','TypeId',$data['BillData'][0]->TypeId);
	   check_p($TypeData);
	   $data['BillData']=array_merge($data['BillData'],$TypeData);
	   $HSNData=$this->mm->get_a_data('tblhsn','HsnId',$data['TypeData'][0]->HsnId);
	   $data['HsnData']=$HSNData;*/
	  
	    //check_p($HSNData);
	   $begin = new DateTime( $fromDate);
        $end   = new DateTime( $toDate );
        $FromToDate=array();
        $FromToDate2=array();
        
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
         
           $FromToDate[]=$i->format('d-m-Y');  //01-02-2019
          
           $FromToDate2[]=$i->format('j-n-y'); //1-5-19
           $FromToDate3[]=$i->format('d-m-y'); //01-05-19
           $FromToDate7[]=$i->format('j-n-Y'); //1-5-2019
           $FromToDate8[]=$i->format('m-d-Y');  //25-02-2019
           
           
          
           $FromToDate4[]=$i->format('j/n/Y'); //1/5/2019
           $FromToDate8[]=$i->format('j/n/y'); //1/5/19
           $FromToDate5[]=$i->format('d/m/Y'); //01/05/2019
           $FromToDate6[]=$i->format('d/m/y'); //05/05/19
           $FromToDate9[]=$i->format('m/d/Y'); //05/05/19
           $FromToDate10[]=$i->format('n/j/Y'); //2/13/19
           
           
           
        //   echo $i->format('d-m-Y')."<br>";
        }    
        
        //check_p($data['BillData']);
    
	    $excelColumn=array('SalesAirInovice','CustomerName','SalesDate','SalesPassenger','SalesGrossTotal','SalesProcessingCharges','SalesCGST','SalesSGST','SalesIGST','SalesPlaceOfSupply','CustomerGSTNo');
	    $whereDate='PurchaseTaxDate';
	    $whereGSTCol='CustomerGSTNo';
	    $i=0;
	    $reportData;
    	$customerHavingGST=array();
    	$customerNotHavingGST=array();
    	$customerDetail=array();
    	for($i=0;$i<sizeof($data['BillData']);$i++)
    	{
    	    foreach( $data['BillData'][$i] as $salesKey=>$salesData)
    	    {  
    	        if(in_array($salesKey,$excelColumn)&&
    	          ((in_array($data['BillData'][$i]->$whereDate,$FromToDate))
    	        ||((in_array($data['BillData'][$i]->$whereDate,$FromToDate2)))
    	        ||((in_array($data['BillData'][$i]->$whereDate,$FromToDate3)))
    	        ||((in_array($data['BillData'][$i]->$whereDate,$FromToDate4)))
    	        ||((in_array($data['BillData'][$i]->$whereDate,$FromToDate5)))
    	        ||((in_array($data['BillData'][$i]->$whereDate,$FromToDate6)))
    	        ||((in_array($data['BillData'][$i]->$whereDate,$FromToDate7)))
    	        ||((in_array($data['BillData'][$i]->$whereDate,$FromToDate8)))
    	        ||((in_array($data['BillData'][$i]->$whereDate,$FromToDate9)))
    	        ||((in_array($data['BillData'][$i]->$whereDate,$FromToDate10)))
    	        
    	        ))
    	        {   
    	            /*if($data['BillData'][$i]->$whereGSTCol)
    	            {
    	             $customerHavingGST[$i][$salesKey]= $salesData;
    	            }
    	            else
    	            {
    	             $customerNotHavingGST[$i][$salesKey]= $salesData;
    	            }*/
    	            $customerDetail[$i][$salesKey]=$salesData;
    	            
    	        }
    	   }
    	      //for new array report Data
    	}
        //	check_p( $customerDetail);
	    
	    $fileName=$fromDate."-".$toDate.".csv";
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=".$fileName);
        header("Pragma: no-cache");
        header("Expires: 0");
       
        $handle = fopen('php://output', 'w');
        $excelColumnHeading=array(array('InvoiceNo','CustomerName','SalesDate','SalesPlaceOfSupply','SalesGrossTotal','SalesProcessingCharges','SalesCGST','SalesSGST','SalesIGST','Passenger','CustomerGSTNo'));
	    //$excelColumnHeading=array(0=>'PurchaseId',1=>'PurchaseTaxDate',2=>'CustomerName',3=>'SalesPassenger',4=>'SalesGrossTotal',5=>'SalesProcessingCharges',6=>'SalesCGST',7=>'SalesSGST',8=>'SalesIGST',9=>'CustomerGSTNo');
        foreach ($excelColumnHeading as $data) {
                fputcsv($handle, $data);
            }
        //$allCustom =array_merge($customerHavingGST,$customerNotHavingGST);
        if($customerDetail)
        {
             
    
            foreach ($customerDetail as $data) {
                fputcsv($handle, $data);
            }
        }
        fclose($handle);
        exit;
   	
	   }
	   $this->new_comman_view_different($data);
   	}
   /* public function CompanyDifferent()
   	{
   	     // check_p($tblName);
	   //$keyName="Sales";
	   //$data=$this->new_comman_header_different('tbl'.strtolower($keyName));
	   $data['pageLink']="Admin/CompanyView";
	   $data['pageName']="Company Details";
	   
	   $this->new_comman_view_different($data);
   	}*/
   /* public function login()
	{
		$this->form_validation->set_rules('Admin_Email','EmailID','required');
		$this->form_validation->set_rules('Admin_Password','Password','required');
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('Admin/login');
		}
		else
		{
				$ad=array(
					'AdminEmailId'=>$this->input->post('Admin_Email'),
					'AdminPassword'=>$this->input->post('Admin_Password')
				);
				$data=$this->mm->do_login($ad,'tbladmin');
				if(count($data)===1)
				{
					$this->session->set_userdata('AdminId',$data[0]->AdminId);
					$this->session->set_userdata('AdminEmailId',$data[0]->AdminEmailId);
					$this->session->set_userdata('AdminName',$data[0]->AdminName);
					
					//new update 4/17/2019 rajesh sir need level table
					$this->session->set_userdata('AdminLevelId',$data[0]->LevelId);
					$where['LevelId']=$data[0]->LevelId;
					$levelData=$this->mm->get_a_data('tbllevel',$where);
					//check_p($levelData[0]->LevelName);
					$this->session->set_userdata('AdminLevelName',$levelData[0]->LevelName);
					redirect('Admin/Dashboard');
				}
				else
				{
					$data['error']="Invalid Email Or password";
					$this->load->view('Admin/login',$data);
				}
			
		
		}
	}*/
	
	
	//samundar
 	public function  comman_header($tblName) //comman header comman_header here
 	{
 	// $data['page']=$this->router->fetch_method();
 	 //  check_p($data);
 	 //before  update of data from data table
 	 
 	 //  $data['Fields']=remove_first_field($this->mm->get_table_heading($tblName));
 	  // after 
 	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	  $data['Fields']=
 	  ($data['Fields']);
 	   $data['OriginalFields']=$data['Fields'];
 	   $data['Fields']=replace_id_name($data['Fields']);
 	    	$data['tableNameData']=$this->mm->get_all_table_heading();
 	    
 	 	$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
 	    $data['aocolumns']=get_aocolumns_data($data['Fields']);
 	  //  check_p($data['Fields']);
 	    return $data;
 	}
 	public function  new_comman_header($tblName) //new comman header new_comman_header here
 	{
 	    $data['page']=str_replace('tbl','',$tblName);
 	     //check_p($data);
 	    //before  update of data from data table
 	 
 	    //  $data['Fields']=remove_first_field($this->mm->get_table_heading($tblName));
 	    // after 
 	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	    $data['OriginalFields']=$data['Fields'];
 	    /*if($data['page']=="member")
 	    {
 	        $data['Fields1']=replace_id_name($this->mm->get_table_heading('tblaccounts'));
 	        $data['OriginalFields1']=$data['Fields1'];
 	        
 	        $data['Fields2']=replace_id_name($this->mm->get_table_heading('tblaccounts'));
 	        $data['OriginalFields2']=$data['Fields2'];
 	    }*/
         	   
        // check_p($tblName);
 	   
 	  //for detail page
 	  if(check_exact_field($tblName,'detail'))
 	  {
 	      $key=remove('detail',$tblName);
 	      //remove number
 	      $key=preg_replace('/[0-9]+/', '', $key);
 	      //check_p($key);
 	      $data['DetailFields']=$this->mm->get_table_heading($key);
 	      $data['DetailFields']=remove_last_field($data['DetailFields'],2);
 	      $data['Fields']=array_merge($data['Fields'],$data['DetailFields']);
 	      //check_p($data);
 	  }
 	   
 	   
 	   // check_p($tblName);
 	   
 	  //update for multiple column search 
 	    $data['Fields']=add_fields($data['Fields']);
 	    $data['Fields']=replace_id_name($data['Fields']);
 	    //check_p($data);
 	   
 	   //updated code rajesh sir 4/18/2019
 	   
    	$sideBarData=$this->get_sidebarData($this->session->AdminLevelId,$data['page'],$data['Fields']);
    	//check_p($sideBarData);
    	$data['adminLevel']=$this->session->AdminLevelId;
 	 	$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$sideBarData['tableNameData']));
 	 	$data['Fields']=$sideBarData['Fields'];
 	 	//$data['adminRights']=$sideBarData['adminRights'];
 	 	//$data['adminRights']=array();
 	 	$data['adminRights']=1;
 	 	
        $data['aocolumns']=$sideBarData['aocolumns'];
 	 	
 	   // $data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$this->get_sidebarData($this->session->AdminLevelId,$data['page'])));
 	    $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
 	    $replaceData=str_replace("tbl","",$tblName);
 	    $capitalFirst=ucfirst($replaceData).'Id';
 	    $whereData=array("tblcompany.CompanyId"=>$this->session->CompanyId);
 	    
 	    $data['ajaxSucessJoinDataTest']=(convert_object_arraY($this->mm->get_a_data_join($tblName,$whereData)));
 	   // check_p($data['ajaxSucessJoinDataTest']);
 	   // check_p($data['page']);
 	    if($data['page']=="member")
 	        $printKey="member";
 	    else if($data['page']=="memberdetail")
 	        $printKey="memberdetail";
 	    else if($data['page']=="banktransaction")
 	        $printKey="banktransaction";
 	    else if($data['page']=="jobcard")
 	        $printKey="jobcard";
 	    else
 	        $printKey="bill";
 	  
 	    //check_p($data['ajaxSucessJoinDataTest']);
	    
	    if($data['ajaxSucessJoinDataTest'])
	        
	        $data['ajaxSucessJoinData']=ajax_success_data_with_key_innerHTML($data['ajaxSucessJoinDataTest'][0],ucfirst($printKey));
	    else
	        $data['ajaxSucessJoinData']='';
	    //check_p($data);
	 //   check_p($tblName);
 	 
	    return $data;
 	}
 	public function get_sidebarData($SessionId,$pageName,$fields='',$different='')
 	{
 	    //check_p($SessionId);
 	    
 	    if($SessionId)
    	{
    	    //new updated code 4/17/2019 rajesh sir
    	   $where['tblrights.LevelId']=$SessionId;
    	   //check_p($where);
    	   $column="RightsTabledropdown";
    	   //   $data['tableNameData']=$this->mm->get_all_table_heading();
    	   $data['Fields']=$fields;
    	   $data['tableNameData']=remove_multi_array_append_data_convert_lower(convert_object_arraY($this->mm->get_a_data_join_a_column('tblrights',$where,$column)),'tbl');
           $selectColumn='*';
           $whereAoColumn['tblrights.LevelId']=$SessionId;
           if(!$different)
                $whereAoColumn['tblrights.RightsTabledropdown']=ucfirst($pageName);
            
            if($fields)
            {
                $data['adminRights']=(convert_object_arraY($this->mm->get_a_data_join_a_column('tblrights',$whereAoColumn,$selectColumn)));
        	    if(!$data['adminRights'][0]['RightsUpdateYesNoRadio'])      //nilesh 17/2/2021 isset added Undefined offset: 0 error
                {
                    $data['Fields']=add_a_fields($data['Fields'],"Update");
                }
                if(!$data['adminRights'][0]['RightsDeleteYesNoRadio'])         //nilesh 17/2/2021 isset added Undefined offset: 0 error
                {
                    $data['Fields']=add_a_fields($data['Fields'],"Delete");
                }
                 $data['aocolumns']=get_aocolumns_data($data['Fields']);
            }
    	}
    	else
    	{   
    	   // check_p($pageName);
    	    $data['Fields']=$this->mm->get_table_heading("tbl".$pageName);
 	        $data['OriginalFields']=$data['Fields'];
 	  
    	    $data['tableNameData']=$this->mm->get_all_table_heading();
    	    $data['aocolumns']=get_aocolumns_data($data['Fields']);
 	    
    	}
    	//check_p($data);
    	return $data;
 	}
    public function  new_comman_header_different($data,$tblName='') //new comman header new_comman_header here
 	{
 	    //check_p($data);
        //$data=array();
 	    //$data['Fields']=add_fields($data['Fields']);
 	 
 	    $data['tableNameData']=$this->mm->get_all_table_heading();
 	    if($tblName)
 	         $data['Fields']=$this->mm->get_table_heading($tblName);
 	    else
 	        $data['Fields']=array();
 	    $sideBarData=$this->get_sidebarData($this->session->AdminLevelId,$data['page'],'','yes');
    	//check_p($sideBarData);
    	
 	 	$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$sideBarData['tableNameData']));
 	 	$data['Fields']=($sideBarData['Fields'])?$sideBarData['Fields']:'';
 	 	$data['adminRights']=(isset($sideBarData['adminRights']))?$sideBarData['adminRights']:'';
 	 	$data['aocolumns']=(isset($sideBarData['aocolumns']))?$sideBarData['aocolumns']:'';
 	 	//$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
 	    //$data['aocolumns']=get_aocolumns_data($data['Fields']);
	   //$data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
	    if($tblName)
	    {
	        $data['ajaxSucessJoinData']=ajax_success_join_data(convert_object_arraY($this->mm->get_all_data_join($tblName)),"Bill");
	    }
 	    //check_p($data);
	    return $data;
 	}
 	public function  AllMethod($tblName = '') //all method in one 
 	{
 	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
     	  
     	    $data=$this->new_comman_header('tbl'.strtolower($tblName));
     	  
    	    $this->new_comman_view($data);
    	}
 	}
 	public function AdminDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tbladmin";
    	   $keyName="admin";
    	   $data['tableName']="tbladmin";
    	   $data['tblName']="admin";
    	   $data['pageLink']="Admin/AdminView";
    	   $data['pageName']="Admin";
    	   $data['page']="Admin";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}
   	public function CustomerDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblconsignor";
    	   $keyName="customer";
    	   $data['tableName']="tblconsignor";
    	   $data['tblName']="customer";
    	   $data['pageLink']="Admin/CustomerView";
    	   $data['pageName']="Doctor";
    	   $data['page']="Doctor";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}
   	
   	
   	//nilesh
   	public function MedicalDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblmedicalstore";
    	   $keyName="medicalstore";
    	   $data['tableName']="tblmedicalstore";
    	   $data['tblName']="medicalstore";
    	   $data['pageLink']="Admin/MedicalView";
    	   $data['pageName']="Medical";
    	   $data['page']="Medical";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}
   	public function MedicalViewDifferent($id)
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    $id=$id	;
       	   $tblName="tblmedicalstore";
    	   $keyName="medicalstore";
    	   $data['tableName']="tblmedicalstore";
    	   $data['tblName']="medicalstore";
    	   $data['pageLink']="Admin/MedicalViewDetail";
    	   $data['pageName']="MedicalView";
    	   $data['page']="MedicalView";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    $where=array('tblmedicalstore.MedicalstoreId'=>$id);
            $data['mainData']=convert_object_arraY($this->mm->get_a_data($tblName,$where));
            /*echo "<pre>";
            print_r($data);
            echo "nilesh";
            */$whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
           // $data['totalsales']=convert_object_arraY($this->mm->custom_query("SELECT sum(OrderTotal) as Totalsales from tblorder where CustomerId='$id'"));
            $data['totalsales']=convert_object_arraY($this->mm->custom_query("SELECT sum(OrderTotal) as Totalsales ,tblorder.OrderId from tblorder where CustomerId='$id'"));
           //samundar query SELECT BonusPoints as TotalBonus ,tblbonus.BonusId from tblbonus where CustomerId=$id'
            //print_r($data['totalsales']);
            //$data['Allorder']=convert_object_arraY($this->mm->custom_query("SELECT COUNT(OrderTotal) as Allorder FROM tblorder where CustomerId='$id'"));
            $data['Allorder']=convert_object_arraY($this->mm->custom_query("SELECT COUNT(OrderTotal)as Allorder,SUM(OrderBonusPoint) as BonusPoint FROM tblorder where CustomerId='$id'"));
            $data['bonus']=convert_object_arraY($this->mm->custom_query("SELECT Bonustype as Bonustype,sum(BonusPoints) as TotalBonus FROM tblbonus where CustomerId='$id'"));
            /*echo "<pre>";
            echo $id;
            print_r($data['bonus']);
            die();
            */
            
        	$this->new_comman_view_different($data);
        }
   	}
   	
   	//end
   	public function SubcategoryDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblsubcategory";
    	   $keyName="Subcategory";
    	   $data['tableName']="tblsubcategory";
    	   $data['tblName']="subcategory";
    	   $data['pageLink']="Admin/SubcategoryView";
    	   $data['pageName']="Suncategory";
    	   $data['page']="Sub Category";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    if($id)
        	{
        	    $data['pageLink']="Admin/CategoryViewDetail";
    	        $data['pageName']="Subcategory";
                
        	    $whereData['CategoryId']=$id;
        	    $data['CategoryData']=convert_object_arraY($this->mm->get_a_data_join($tblName,$whereData));
                $whereInfo['InformationInfo']=0;
                $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	}
        	else
        	{
                $data['pageLink']="Admin/SubcategoryView";
    	        $data['pageName']="Subcategory";
                $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
                $whereInfo['InformationInfo']=0;
                $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	}
    	   $this->new_comman_view_different($data);
        }
   	}
   	//nilesh 8/2/2021
   	public function PurchaseDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName=" tblpurchase";
    	   $keyName="Purchase";
    	   $data['tableName']=" tblpurchase";
    	   $data['tblName']="purchase";
    	   $data['pageLink']="Admin/PurchaseView";
    	   $data['pageName']="Purchase";
    	   $data['page']="Purchase";
    	   
    	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}
   	public function HSNDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName=" tblhsn";
    	   $keyName="HSN";
    	   $data['tableName']=" tblhsn";
    	   $data['tblName']="HSN";
    	   $data['pageLink']="Admin/HSNView";
    	   $data['pageName']="HSN";
    	   $data['page']="HSN";
    	   
    	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}
   	public function VendorDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblvendor";
    	   $keyName="vendor";
    	   $data['tableName']="tblvendor";
    	   $data['tblName']="vendor";
    	   $data['pageLink']="Admin/vendorView";
    	   $data['pageName']="Vendor";
    	   $data['page']="Vendor";
    	   
    	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	//$data['Data']=convert_object_arraY($this->mm->custom_query("INSERT into tblaccounts(AccountsId,AccountsName) VALUES ($id,'')"));
        	$this->new_comman_view_different($data);
        }
   	}
   	//nilesh 10/2/2021 vendor detail view
   		public function VendorViewDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblvendor";
    	   $keyName="vendor";
    	   $data['tableName']="tblvendor";
    	   $data['tblName']="vendor";
    	   $data['pageLink']="Admin/vendorViewDetail";
    	   $data['pageName']="Vendor View";
    	   $data['page']="Vendor View";
    	   
    	   $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	//$data['Data']=convert_object_arraY($this->mm->custom_query("INSERT into tblaccounts(AccountsId,AccountsName) VALUES ($id,'')"));
        	$this->new_comman_view_different($data);
        }
   	}
   	//end
   	//samundra add controller for product page 15-05-2021
   	public function ProductDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblproduct";
    	   $keyName="Product";
    	   $data['tableName']="tblproduct";
    	   $data['tblName']="product";
    	   $data['pageLink']="Admin/ProductView";
    	   $data['pageName']="Product";
    	   $data['page']="product";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
    	   
    	    //$data['Fields']=$this->mm->get_table_heading($tblName);
     	    //$data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
           // print_r($data['mainData']);
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
           //$data['Data']=convert_object_arraY($this->mm->custom_query("SELECT SubcategoryName FROM tblsubcategory"));
        //	$data = $this->mm->custom_query('SELECT SubcategoryName FROM tblsubcategory');

        	$this->new_comman_view_different($data);
        }
   	}
   	//samundra end
   	//samundra add controller for product page 15-05-2021
   	public function ConsignorDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblconsignor";
    	   $keyName="Consignor";
    	   $data['tableName']="tblconsignor";
    	   $data['tblName']="consignor";
    	   $data['pageLink']="Admin/ConsignorView";
    	   $data['pageName']="Consignor";
    	   $data['page']="consignor";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
    	   
    	    //$data['Fields']=$this->mm->get_table_heading($tblName);
     	    //$data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
           // print_r($data['mainData']);
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
           //$data['Data']=convert_object_arraY($this->mm->custom_query("SELECT SubcategoryName FROM tblsubcategory"));
        //	$data = $this->mm->custom_query('SELECT SubcategoryName FROM tblsubcategory');

        	$this->new_comman_view_different($data);
        }
   	}
   	//samundra end
   	//samundra add controller for product page 15-05-2021
   	public function ConsigneeDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblconsignee";
    	   $keyName="Consignee";
    	   $data['tableName']="tblconsignee";
    	   $data['tblName']="consignee";
    	   $data['pageLink']="Admin/ConsigneeView";
    	   $data['pageName']="Consignee";
    	   $data['page']="consignee";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
    	   
    	    //$data['Fields']=$this->mm->get_table_heading($tblName);
     	    //$data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
           // print_r($data['mainData']);
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
           //$data['Data']=convert_object_arraY($this->mm->custom_query("SELECT SubcategoryName FROM tblsubcategory"));
        //	$data = $this->mm->custom_query('SELECT SubcategoryName FROM tblsubcategory');

        	$this->new_comman_view_different($data);
        }
   	}
   	//samundra end
   	//samundra add controller for product page 15-05-2021
   	public function DealerDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tbldealer";
    	   $keyName="Dealer";
    	   $data['tableName']="tbldealer";
    	   $data['tblName']="dealer";
    	   $data['pageLink']="Admin/DealerView";
    	   $data['pageName']="Dealer";
    	   $data['page']="dealer";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
    	   
    	    //$data['Fields']=$this->mm->get_table_heading($tblName);
     	    //$data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
           // print_r($data['mainData']);
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
           //$data['Data']=convert_object_arraY($this->mm->custom_query("SELECT SubcategoryName FROM tblsubcategory"));
        //	$data = $this->mm->custom_query('SELECT SubcategoryName FROM tblsubcategory');

        	$this->new_comman_view_different($data);
        }
   	}
   	//samundra end 
   	
   	// add for companies
	   public function CompaniesDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	   	$tblName="tblcompanies";
    	   	$keyName="Companies";
    	   	$data['tableName']="tblcompanies";
    	   	$data['tblName']="companies";
    	   	$data['pageLink']="Admin/CompaniesView";
    	   	$data['pageName']="Companies";
    	   	$data['page']="companies";

    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);

            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	$this->new_comman_view_different($data);
        }
   	}
	// 

   	//samundar add controller for Tempono wise report 08-08-2021
   	public function TempoReport($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tbltempo";
    	   $keyName="Tempo";
    	   $data['tableName']="tbltempo";
    	   $data['tblName']="tempo";
    	   $data['pageLink']="Admin/TempoReportView";
    	   $data['pageName']="Tempo";
    	   $data['page']="Tempo";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
    	   
    	    //$data['Fields']=$this->mm->get_table_heading($tblName);
     	    //$data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
           // print_r($data['mainData']);
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
           

        	$this->new_comman_view_different($data);
        }
   	}
   	//samundar end
   	
	public function CompanyReport($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	   	$tblName="tblcompanies";
    	   	$keyName="Companies";
    	   	$data['tableName']="tblcompanies";
    	   	$data['tblName']="companies";
    	   	$data['pageLink']="Admin/CompaniesReportView";
    	   	$data['pageName']="Companies";
    	   	$data['page']="Companies";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);

        	$this->new_comman_view_different($data);
        }
   	}
   	//samundra add controller for delare wise report 20-05-2021
   	public function DealerReport($id='') 
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tbldealer";
    	   $keyName="Dealer";
    	   $data['tableName']="tbldealer";
    	   $data['tblName']="dealer";
    	   $data['pageLink']="Admin/DealerReportView";
    	   $data['pageName']="Dealer";
    	   $data['page']="dealer";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
    	   
    	    //$data['Fields']=$this->mm->get_table_heading($tblName);
     	    //$data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
           // print_r($data['mainData']);
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
           //$data['Data']=convert_object_arraY($this->mm->custom_query("SELECT SubcategoryName FROM tblsubcategory"));
        //	$data = $this->mm->custom_query('SELECT SubcategoryName FROM tblsubcategory');

        	$this->new_comman_view_different($data);
        }
   	}
   	//samundra end

	// sjr add new report for gstr1 b 17-12-2023
	public function Gst1rbReportDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
			$tblName="tbldealer";
			$keyName="Dealer";
			$data['tableName']="tbldealer";
			$data['tblName']="dealer";
			$data['pageLink']="Admin/Gst1rbReportView";
			$data['pageName']="Dealer";
			$data['page']="dealer";

    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);

            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));

            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);

        	$this->new_comman_view_different($data);
        }
   	}

	public function Gst1rbReport2Different($id='')  
	{
		$todate=$this->input->post("ToDate");
		$fromdate=$this->input->post("FromDate");
		$CompanyId=$this->session->CompanyId;
		$data['mainData']=array();
		if($todate !="" && $fromdate !="")
		{
			$sql="SELECT *,SUM(tblorder.OrderTotal) FROM `tblorder` JOIN tbldealer ON tbldealer.DealerId = tblorder.DealerId WHERE tblorder.CompanyId=$CompanyId AND OrderBillDate >= '$fromdate' AND OrderBillDate<='$todate' GROUP BY OrderGstInvoice order BY OrderBillDate ASC";

			$data['orderData'] = $this->mm->custom_query($sql);

			$sql2="SELECT *,SUM(tblorderpalletdetail.OrderpalletdetailTotal) FROM `tblorderpallet` JOIN tbldealer ON tbldealer.DealerId = tblorderpallet.DealerId JOIN tblorderpalletdetail ON tblorderpalletdetail.OrderpalletIdReference = tblorderpallet.OrderpalletId WHERE tblorderpallet.CompanyId=$CompanyId AND  OrderpalletBillDate >= '$fromdate' AND OrderpalletBillDate<='$todate' GROUP BY OrderpalletGstInvoice order BY OrderpalletBillDate ASC";

			$data['palletData'] = $this->mm->custom_query($sql2);
		}

		$filterArray = array();
		$noCount = 0;
		for($i=0;$i<count($data['orderData']);$i++)
		{
			$filterArray[$i]['SUM(tblorder.OrderTotal)'] = $data['orderData'][$i]['SUM(tblorder.OrderTotal)'];
			$filterArray[$i]['DealerGSTNO'] = $data['orderData'][$i]['DealerGSTNO'];
			$filterArray[$i]['OrderGstInvoice'] = $data['orderData'][$i]['OrderGstInvoice'];
			$filterArray[$i]['OrderBillDate'] = $data['orderData'][$i]['OrderBillDate'];
			$filterArray[$i]['OrderGstPer'] = $data['orderData'][$i]['OrderGSTPer'];
			$noCount++;
		}

		for($i=0;$i<count($data['palletData']);$i++)
		{
			$filterArray[$noCount]['SUM(tblorder.OrderTotal)'] = $data['palletData'][$i]['SUM(tblorderpalletdetail.OrderpalletdetailTotal)'];
			$filterArray[$noCount]['DealerGSTNO'] = $data['palletData'][$i]['DealerGSTNO'];
			$filterArray[$noCount]['OrderGstInvoice'] = $data['palletData'][$i]['OrderpalletGstInvoice'];
			$filterArray[$noCount]['OrderBillDate'] = $data['palletData'][$i]['OrderpalletBillDate'];
			$filterArray[$noCount]['OrderGstPer'] = $data['palletData'][$i]['OrderpalletGSTPer'];
			$noCount++;
		}
		$price = array_column($filterArray, 'OrderBillDate');

		array_multisort($price, SORT_ASC, $filterArray);

		$data['filterArray'] = $filterArray;

		$data['Date']=array("To"=>$todate,"From"=>$fromdate);
		$this->CreateExcelDifferent($data);
		// $whereData=array("CompanyId"=>$this->session->CompanyId);
		// $data['CompanyData']=$this->mm->get_a_data("tblcompany",$whereData);

		// $tblName="tblorder";

		// $tblName="tblconsignee";
		// $keyName="Consignee";
		// $data['tableName']="tblconsignee";
		// $data['tblName']="consignee";
		// $data['pageLink']="Admin/Gst1rbReportPrint";
		// $data['pageName']="Gst1rb Report";
		// $data['page']="consignee";
		
		// $data['Fields']=$this->mm->get_table_heading($tblName);
		// $data['OriginalFields']=$data['Fields'];
		// $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);

		// $whereInfo['InformationInfo']=0;
		// $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
		// $this->new_comman_view_different($data);
	}
	// sjr end

	// sjr add for create gstr 1 excel 20-12-2023 && 02-01-2024
	public function CreateExcelDifferent($data)
	{
		$this->excel->setActiveSheetIndex(0);

		for ($col = 'A'; $col != 'L'; $col++) {
			$this->excel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
		
		// remove border
		$style = $this->excel->getActiveSheet()->getStyle('A1');
		$style->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_NONE);
		$style->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_NONE);
		$style->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_NONE);
		$style->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_NONE);
		// 

		$this->excel->getActiveSheet()->setTitle('Help Instruction');
		$this->excel->getActiveSheet()->mergeCells("B1:K1");
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('B1', 'Invoice & other  data  upload for creation of GSTR 1');
		$this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
		$this->excel->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B1:K1')->getFill()->getStartColor()->setARGB('29bb04');

		$this->excel->getActiveSheet()->mergeCells("B2:K2");
		$this->excel->getActiveSheet()->setCellValue('B2', 'Introduction to Excel based template for data upload in Java offline  tool');
		$this->excel->getActiveSheet()->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$this->excel->getActiveSheet()->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');

		$this->excel->getActiveSheet()->mergeCells("B3:K3");

		$this->excel->getActiveSheet()->setCellValue('B3', "The Offline tool comes bundled with MS Excel Template and a java  tool. This Excel workbook template has 11 data entry worksheets, 1 master sheet and 1 Help Instruction sheet i.e. total 13 worksheets. The 11 data entry worksheets are named: b2b, b2cl, b2cs, cdnr, cdnur exp, at, atadj, exemp, hsn and doc in which day-to-day business transaction required to be reported in GSTR 1 can be recorded or entered by the taxpayers.  At desired interval, the data entered in the MS-Excel worksheet can be uploaded on the GST Portal using the java offline tool which will import the data from excel workbook and convert the same into a Json file which is understood by GST portal. (www.gst.gov.in)
		It  has been designed to enable taxpayers to prepare GSTR 1  in  offline mode (without Internet). It can also be used to carry out bulk upload of invoice/other details to GST portal.
		The appearance and functionalities of the Offline  tool screens are similar to that  of the returns filing  screens on the GST Portal.
		Approximately 19,000 line items can be uploaded in one go using the java tool. In case a taxpayer has more invoice data, he can use the tool multiple times to upload the invoice data.
		\nData can be uploaded/entered to the offline tool in four ways:\n
		1.  Importing the entire excel workbook to the java  tool where data in all sections (worksheets) of the excel file will be imported in the tool in one go.
		2.  Line by line  data entry  by return preparer on the java offline tool.
		3.  Copy from the  excel  worksheets from the top row  including the summary and  header  and pasting it in the designated box in the import screen of the  java offline tool.  Precaution: All the columns including headers should be in the same format  and have the same header as of the java offline tool.
		4. Section by section of a particular return - using a .CSV file as per the format given along with the java tool. Many accounting software packages generate .CSV file in the specified format and the same can be imported in the tool.\n\n");

		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setWrapText(true);
		// $this->excel->getActiveSheet()->getStyle("B3")->getFont()->setSize(8);
		$this->excel->getActiveSheet()->getRowDimension(3)->setRowHeight(250);
		//
		$this->excel->getActiveSheet()->mergeCells("B5:K5");
		$this->excel->getActiveSheet()->setCellValue('B5', 'Understanding the Excel  Workbook Template');
		$this->excel->getActiveSheet()->getStyle('B5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$this->excel->getActiveSheet()->getStyle('B5')->getFill()->getStartColor()->setRGB('4472C4');
		$this->excel->getActiveSheet()->getStyle('B5')->getFont()->getColor()->setRGB('FFFFFF');

		$this->excel->getActiveSheet()->mergeCells("B6:K6");
		$this->excel->getActiveSheet()->setCellValue('B6', "a) It is always recommended to download the excel workbook template from the GST portal only.");

		$this->excel->getActiveSheet()->mergeCells("B7:K7");
		$this->excel->getActiveSheet()->setCellValue('B7', "b) The taxpayer can fill the excel workbook template with different worksheet for the applicable sections of the return and then import the excel file to the java tool. Data has to be filled in the sections (worksheets) applicable to him and the\n others may be left blank. ");

		$this->excel->getActiveSheet()->mergeCells("B8:K8");
		$this->excel->getActiveSheet()->setCellValue('B8', "c) The data in the excel file should be in the format specified below in respective sections.");

		$this->excel->getActiveSheet()->mergeCells("B9:K9");
		$this->excel->getActiveSheet()->setCellValue('B9', "d) In a case where the taxpayer does not have data applicable for all sections, those sections may be left blank and the java tool  will automatically take care of the data to be filled in the applicable sections only.");

		$this->excel->getActiveSheet()->mergeCells("B10:K10");
		$this->excel->getActiveSheet()->setCellValue('B10', "e) For Group import (all worksheets of workbook) taxpayer need to fill all the details into downloaded standard format GSTR1_Excel_Workbook_Template-V1.2.xlsx file");

		$this->excel->getActiveSheet()->mergeCells("B11:K11");
		$this->excel->getActiveSheet()->setCellValue('B11', "f) User can export  Data from local accounting software loaded in the above format as .CSV file and import it in the java tool to generate the file in  .Json\n  format  for bulk. Warning: Your accounting software should generate .CSV file in the format specified by GST Systems.");

		$this->excel->getActiveSheet()->mergeCells("B12:K12");
		$this->excel->getActiveSheet()->setCellValue('B12', "g) In all the worksheets except hsn, the central tax, integrated tax, and state tax are not required to be furnished in the excel worksheets but would be computed on the furnished rate and taxable value in the java offline tool. The taxpayer can\n edit the tax amounts calculated in the java tool if the tax collected values are different.  ");

		$this->excel->getActiveSheet()->mergeCells("B13:K13");
		$this->excel->getActiveSheet()->setCellValue('B13', "h) In the doc's worksheet, the net issued column has not been provided, this value will be computed in the java offline tool based on the total number of documents and the number of cancelled  documents furnished in this worksheet.");

		//
		$this->excel->getActiveSheet()->mergeCells("B15:K15");
		$this->excel->getActiveSheet()->setCellValue('B15', "The table below provides the name, full form and detailed description for each  field of the worksheets followed by a detailed instruction for filling the applicable worksheets. The fields marked with asterisk or star are mandatory.");

		// 
		$this->excel->getActiveSheet()->setCellValue('B16', "Worksheet Name");
		$this->excel->getActiveSheet()->setCellValue('C16', "Reference");
		$this->excel->getActiveSheet()->setCellValue('D16', "Field name");
		$this->excel->getActiveSheet()->setCellValue('E16', "Help Instruction");

		$this->excel->getActiveSheet()->mergeCells("B17:B28");
		$this->excel->getActiveSheet()->setCellValue('B17', "b2b");
		$this->excel->getActiveSheet()->getStyle('B17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("C17:C28");
		$this->excel->getActiveSheet()->setCellValue('C17', "B2B Supplies");
		$this->excel->getActiveSheet()->getStyle('C17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("D17:K17");
		$this->excel->getActiveSheet()->setCellValue('D17', "Details of invoices of Taxable supplies made to other registered taxpayers");
		// $this->excel->getActiveSheet()->getStyle('D17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('D18', "1. GSTIN/UIN of Recipient*");

		$this->excel->getActiveSheet()->mergeCells("E18:K18");
		$this->excel->getActiveSheet()->setCellValue('E18', "Enter the GSTIN or UIN of the receiver. E.g. 05AEJPP8087R1ZF. Check that the registration\n is active on the date of the invoice from GST portal");
		// $this->excel->getActiveSheet()->getStyle('E18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('D19', "2. Invoice  number *");

		$this->excel->getActiveSheet()->mergeCells("E19:K19");
		$this->excel->getActiveSheet()->setCellValue('E19', "Enter the Invoice number of invoices issued to  registered recipients. Ensure that the format\n is alpha-numeric with  allowed special characters of slash(/) and dash(-) .The total number of \ncharacters should not be more than 16.");
		// $this->excel->getActiveSheet()->getStyle('E19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('D20', "3. Invoice Date* ");

		$this->excel->getActiveSheet()->mergeCells("E20:K20");
		$this->excel->getActiveSheet()->setCellValue('E20', "Enter date of invoice in DD-MMM-YYYY. E.g. 24-May-2017.");
		// $this->excel->getActiveSheet()->getStyle('E20')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('D21', "4. Invoice value*");

		$this->excel->getActiveSheet()->mergeCells("E21:K21");
		$this->excel->getActiveSheet()->setCellValue('E21', "Enter the total value indicated in the invoice  of the supplied  goods or services- with 2 \ndecimal Digits.");
		// $this->excel->getActiveSheet()->getStyle('E21')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('D22', "5. Place of Supply(POS)*");

		$this->excel->getActiveSheet()->mergeCells("E22:K22");
		$this->excel->getActiveSheet()->setCellValue('E22', "Select the code of the state from drop down list for the place of supply.");
		// $this->excel->getActiveSheet()->getStyle('E22')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('D23', "6. Reverse Charge*");

		$this->excel->getActiveSheet()->mergeCells("E23:K23");
		$this->excel->getActiveSheet()->setCellValue('E23', "Please select Y or N , if the supplies/services are subject to tax as per reverse charge\n mechanism.");
		// $this->excel->getActiveSheet()->getStyle('E23')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('D24', "7. Invoice Type*");

		$this->excel->getActiveSheet()->mergeCells("E24:K24");
		$this->excel->getActiveSheet()->setCellValue('E24', "Select from the dropdown whether the supply is regular, or to a SEZ unit/developer with or\n without payment of tax or deemed export.");
		// $this->excel->getActiveSheet()->getStyle('E24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('D25', "8. E-Commerce GSTIN*");

		$this->excel->getActiveSheet()->mergeCells("E25:K25");
		$this->excel->getActiveSheet()->setCellValue('E25', "Enter the GSTIN of the e-commerce company if the supplies are made through an \ne-Commerce operator.");
		// $this->excel->getActiveSheet()->getStyle('E25')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('D26', "9. Rate*");

		$this->excel->getActiveSheet()->mergeCells("E26:K26");
		$this->excel->getActiveSheet()->setCellValue('E26', "Enter the combined  (State tax + Central tax) or the integrated tax, as applicable.");
		// $this->excel->getActiveSheet()->getStyle('E26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('D27', "10. Taxable Value*");

		$this->excel->getActiveSheet()->mergeCells("E27:K27");
		$this->excel->getActiveSheet()->setCellValue('E27', "Enter the taxable value of the supplied  goods or services for each rate line item - with 2\n decimal Digits, The taxable value has to be computed as per GST valuation provisions.");
		// $this->excel->getActiveSheet()->getStyle('E27')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('D28', "11. Cess Amount");

		$this->excel->getActiveSheet()->mergeCells("E28:K28");
		$this->excel->getActiveSheet()->setCellValue('E28', "Enter the total Cess amount collected/payable.");
		// $this->excel->getActiveSheet()->getStyle('E28')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		// section 2
		$this->excel->getActiveSheet()->mergeCells("B29:B37");
		$this->excel->getActiveSheet()->setCellValue('B29', "b2cl");
		$this->excel->getActiveSheet()->getStyle('B29')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("C29:C37");
		$this->excel->getActiveSheet()->setCellValue('C29', "B2C Large");
		$this->excel->getActiveSheet()->getStyle('C29')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("D29:K29");
		$this->excel->getActiveSheet()->setCellValue('D29', "Invoices for Taxable outward supplies to consumers where\na)The place of supply is outside the state where the supplier is registered and\nb)The total invoice value is more that Rs 2,50,000");

		$this->excel->getActiveSheet()->setCellValue('D30', "1. Invoice  number*");
		$this->excel->getActiveSheet()->mergeCells("E30:K30");
		$this->excel->getActiveSheet()->setCellValue('E30', "Enter the Invoice number of invoices issued  to Unregistered Recipient of the  other State  with\n invoice value more than 2.5 lakh. Ensure that the format is alpha-numeric with  allowed\n special characters of slash(/) and dash(-) with maximum length of 16 characters.");
		
		$this->excel->getActiveSheet()->setCellValue('D31', "2. Invoice Date");
		$this->excel->getActiveSheet()->mergeCells("E31:K31");
		$this->excel->getActiveSheet()->setCellValue('E31', "Enter date of invoice in DD-MMM-YYYY. E.g. 24-May-2017.");

		$this->excel->getActiveSheet()->setCellValue('D32', "3. Invoice value*");
		$this->excel->getActiveSheet()->mergeCells("E32:K32");
		$this->excel->getActiveSheet()->setCellValue('E32', "Invoice value should be more than Rs 250,000 and up to two decimal digits.");

		$this->excel->getActiveSheet()->setCellValue('D33', "4. Place of Supply(POS)*");
		$this->excel->getActiveSheet()->mergeCells("E33:K33");
		$this->excel->getActiveSheet()->setCellValue('E33', "Select the code of the state from drop down list for the applicable place of supply.");

		$this->excel->getActiveSheet()->setCellValue('D34', "5. Rate*");
		$this->excel->getActiveSheet()->mergeCells("E34:K34");
		$this->excel->getActiveSheet()->setCellValue('E34', "Enter the combined  (State tax + Central tax) or the integrated tax rate, as applicable.");

		$this->excel->getActiveSheet()->setCellValue('D35', "6. Taxable Value*");
		$this->excel->getActiveSheet()->mergeCells("E35:K35");
		$this->excel->getActiveSheet()->setCellValue('E35', "Enter the taxable value of the supplied  goods or services for each rate line item -2 decimal\n digits, The taxable value has to be computed as per GST valuation provisions. ");

		$this->excel->getActiveSheet()->setCellValue('D36', "7. Cess Amount");
		$this->excel->getActiveSheet()->mergeCells("E36:K36");
		$this->excel->getActiveSheet()->setCellValue('E36', "Enter the total  Cess amount collected/payable.");

		$this->excel->getActiveSheet()->setCellValue('D37', "8. E-Commerce GSTIN");
		$this->excel->getActiveSheet()->mergeCells("E37:K37");
		$this->excel->getActiveSheet()->setCellValue('E37', "Enter the GSTIN of the e-commerce company if the supplies are made through an e-\nCommerce operator.");

		// section 3
		$this->excel->getActiveSheet()->mergeCells("B38:B44");
		$this->excel->getActiveSheet()->setCellValue('B38', "b2cs");
		$this->excel->getActiveSheet()->getStyle('B38')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("C38:C44");
		$this->excel->getActiveSheet()->setCellValue('C38', "B2C Small");
		$this->excel->getActiveSheet()->getStyle('C38')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("D38:K38");
		$this->excel->getActiveSheet()->setCellValue('D38', "Supplies made to consumers and unregistered persons of the following nature\na) Intra-State: any value\nb) Inter-State: Invoice value Rs 2.5 lakh or less");

		$this->excel->getActiveSheet()->setCellValue('D39', "1. Type*");
		$this->excel->getActiveSheet()->mergeCells("E39:K39");
		$this->excel->getActiveSheet()->setCellValue('E39', "Enter the Invoice number of invoices issued  to Unregistered Recipient of the  other State  with\n invoice value more than 2.5 lakh. Ensure that the format is alpha-numeric with  allowed\n special characters of slash(/) and dash(-) with maximum length of 16 characters.");
		
		$this->excel->getActiveSheet()->setCellValue('D40', "2. Place of Supply(POS)*");
		$this->excel->getActiveSheet()->mergeCells("E40:K40");
		$this->excel->getActiveSheet()->setCellValue('E40', "Enter date of invoice in DD-MMM-YYYY. E.g. 24-May-2017.");

		$this->excel->getActiveSheet()->setCellValue('D41', "3. Rate*");
		$this->excel->getActiveSheet()->mergeCells("E41:K41");
		$this->excel->getActiveSheet()->setCellValue('E41', "Enter the combined  (State tax + Central tax) or the integrated tax rate. ");

		$this->excel->getActiveSheet()->setCellValue('D42', "4. Taxable Value*");
		$this->excel->getActiveSheet()->mergeCells("E42:K42");
		$this->excel->getActiveSheet()->setCellValue('E42', "Enter the taxable value of the supplied  goods or services for each rate line item -2 decimal\n Digits, The taxable value has to be computed as per GST valuation provisions.");

		$this->excel->getActiveSheet()->setCellValue('D43', "5. Cess Amount");
		$this->excel->getActiveSheet()->mergeCells("E43:K43");
		$this->excel->getActiveSheet()->setCellValue('E43', "Enter the total  Cess amount collected/payable.");

		$this->excel->getActiveSheet()->setCellValue('D44', "6. E-Commerce GSTIN");
		$this->excel->getActiveSheet()->mergeCells("E44:K44");
		$this->excel->getActiveSheet()->setCellValue('E44', "Enter the GSTIN of the e-commerce company if the supplies are made through an e-Commerce operator.");

		// section 4
		$this->excel->getActiveSheet()->mergeCells("B45:B58");
		$this->excel->getActiveSheet()->setCellValue('B45', "cdnr");
		$this->excel->getActiveSheet()->getStyle('B45')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("C45:C58");
		$this->excel->getActiveSheet()->setCellValue('C45', "Credit/ Debit Note");
		$this->excel->getActiveSheet()->getStyle('C45')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("D45:K45");
		$this->excel->getActiveSheet()->setCellValue('D45', "Credit/ Debit Notes/Refund vouchers issued to the registered taxpayers during the tax period. Debit or credit note issued against invoice will be\n reported here against original invoice, hence fill the details of original invoice also which was furnished in B2B,B2CL section of earlier/current \nperiod tax period.");

		$this->excel->getActiveSheet()->setCellValue('D46', "1. GSTIN/UIN*");
		$this->excel->getActiveSheet()->mergeCells("E46:K46");
		$this->excel->getActiveSheet()->setCellValue('E46', "Enter the GSTIN of the e-commerce company if the supplies are made through an e-\nCommerce operator.");

		$this->excel->getActiveSheet()->setCellValue('D47', "2. Invoice/Advance Receipt Number*");
		$this->excel->getActiveSheet()->mergeCells("E47:K47");
		$this->excel->getActiveSheet()->setCellValue('E47', "Enter original invoice number Reported  in B2B section of earlier period/current tax period  \nor pre-GST period against which credit/debit note is issued. Incase of refund voucher please \nenter the related advance receipt voucher number.");

		$this->excel->getActiveSheet()->setCellValue('D48', "3. Invoice/Advance Receipt date*");
		$this->excel->getActiveSheet()->mergeCells("E48:K48");
		$this->excel->getActiveSheet()->setCellValue('E48', "Enter the original invoice/advance receipt date in  DD-MMM-YYYY. E.g. 24-May-2017.");

		$this->excel->getActiveSheet()->setCellValue('D49', "4. Note/Refund Voucher Number*");
		$this->excel->getActiveSheet()->mergeCells("E49:K49");
		$this->excel->getActiveSheet()->setCellValue('E49', "Enter the credit/debit note number or the refund voucher number. Ensure that the format is \nalpha-numeric with  allowed special characters of slash(/) and dash(-) of maximum length of \n16 characters.");
		
		$this->excel->getActiveSheet()->setCellValue('D50', "5. Note/ Refund Voucher date*");
		$this->excel->getActiveSheet()->mergeCells("E50:K50");
		$this->excel->getActiveSheet()->setCellValue('E50', "Enter credit/debit note/Refund voucher date in  DD-MMM-YYYY. E.g. 24-May-2017.");

		$this->excel->getActiveSheet()->setCellValue('D51', "6. Document Type*");
		$this->excel->getActiveSheet()->mergeCells("E51:K51");
		$this->excel->getActiveSheet()->setCellValue('E51', "In the document Type column, enter 'D' if the note is Debit note, enter 'C' if note is credit \nnote or enter R' for refund voucher.");

		$this->excel->getActiveSheet()->setCellValue('D52', "7. Reason For Issuing document*");
		$this->excel->getActiveSheet()->mergeCells("E52:K52");
		$this->excel->getActiveSheet()->setCellValue('E52', "Select the applicable reason for issue of the document.");

		$this->excel->getActiveSheet()->setCellValue('D53', "8. Place of Supply*");
		$this->excel->getActiveSheet()->mergeCells("E53:K53");
		$this->excel->getActiveSheet()->setCellValue('E53', "Declare the place of supply based on the original document.");

		$this->excel->getActiveSheet()->setCellValue('D54', "9. Note/Refund Voucher value*");
		$this->excel->getActiveSheet()->mergeCells("E54:K54");
		$this->excel->getActiveSheet()->setCellValue('E54', "Amount should be with only up to 2 decimal digits.");

		$this->excel->getActiveSheet()->setCellValue('D55', "10. Rate*");
		$this->excel->getActiveSheet()->mergeCells("E55:K55");
		$this->excel->getActiveSheet()->setCellValue('E55', "Enter the combined  (State tax + Central tax) or the integrated tax.");

		$this->excel->getActiveSheet()->setCellValue('D56', "11.Taxable value*");
		$this->excel->getActiveSheet()->mergeCells("E56:K56");
		$this->excel->getActiveSheet()->setCellValue('E56', "Enter the taxable value of the supplied  goods or services for each rate line item -2 decimal \nDigits, The taxable value has to be computed as per GST valuation provisions.");

		$this->excel->getActiveSheet()->setCellValue('D57', "12. Cess Amount");
		$this->excel->getActiveSheet()->mergeCells("E57:K57");
		$this->excel->getActiveSheet()->setCellValue('E57', "Enter the total  Cess amount.");

		$this->excel->getActiveSheet()->setCellValue('D58', "13. Pre GST");
		$this->excel->getActiveSheet()->mergeCells("E58:K58");
		$this->excel->getActiveSheet()->setCellValue('E58', "Select whether the credit/debit note is related to pre-GST supplies.");
		
		// section 5
		$this->excel->getActiveSheet()->mergeCells("B59:B73");
		$this->excel->getActiveSheet()->setCellValue('B59', "cdnur");
		$this->excel->getActiveSheet()->getStyle('B59')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("C59:C73");
		$this->excel->getActiveSheet()->setCellValue('C59', "Credit/ Debit Note for unregistered Persons");
		$this->excel->getActiveSheet()->getStyle('C59')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("D59:K59");
		$this->excel->getActiveSheet()->setCellValue('D59', "Credit/ Debit Notes/Refund vouchers issued to the unregistered persons against interstate invoice value is  more than Rs 2.5 lakh");

		$this->excel->getActiveSheet()->setCellValue('D60', "1. UR Type*");
		$this->excel->getActiveSheet()->mergeCells("E60:K60");
		$this->excel->getActiveSheet()->setCellValue('E60', "Select the type of  supply to Unregistered Taxpayers (UR) against which the document has \nbeen issued.Select 'EXPWP' or 'EXPWOP' for export /'B2CL' for supplies to consumers\n for dropdown based on original invoice.
		\n'EXPWP' represents Export with payment and 'EXPWOP' represent Export without \npayment.");

		$this->excel->getActiveSheet()->setCellValue('D61', "2. Note/Refund Voucher Number*");
		$this->excel->getActiveSheet()->mergeCells("E61:K61");
		$this->excel->getActiveSheet()->setCellValue('E61', "Enter the credit/debit note number or the refund voucher number. Ensure that the format is\n alpha-numeric with  allowed special characters of slash(/) and dash(-) of maximum length of \n16 characters.");

		$this->excel->getActiveSheet()->setCellValue('D62', "3. Note/ Refund Voucher date*");
		$this->excel->getActiveSheet()->mergeCells("E62:K62");
		$this->excel->getActiveSheet()->setCellValue('E62', "Enter credit/debit note/Refund voucher date in  DD-MMM-YYYY. E.g. 24-May-2017.");

		$this->excel->getActiveSheet()->setCellValue('D63', "4. Document Type*");
		$this->excel->getActiveSheet()->mergeCells("E63:K63");
		$this->excel->getActiveSheet()->setCellValue('E63', "In the document Type column, enter 'D' if the note is Debit note, enter 'C' if note is credit\n note or enter 'R' for refund voucher.");
		
		$this->excel->getActiveSheet()->setCellValue('D64', "5. Invoice/Advance Receipt Number*");
		$this->excel->getActiveSheet()->mergeCells("E64:K64");
		$this->excel->getActiveSheet()->setCellValue('E64', "Enter original invoice number Reported  in B2B section of earlier period/current tax period \nor pre-GST Period against which credit/debit note is issued. Incase of refund voucher please\n enter the related advance receipt voucher number.");

		$this->excel->getActiveSheet()->setCellValue('D65', "6. Invoice/Advance Receipt date*");
		$this->excel->getActiveSheet()->mergeCells("E65:K65");
		$this->excel->getActiveSheet()->setCellValue('E65', "Enter the original invoice/advance receipt date in  DD-MMM-YYYY. E.g. 24-May-2017.");

		$this->excel->getActiveSheet()->setCellValue('D66', "7. Reason For Issuing document*");
		$this->excel->getActiveSheet()->mergeCells("E66:K66");
		$this->excel->getActiveSheet()->setCellValue('E66', "Select the applicable reason for issue of the document from the dropdown.");

		$this->excel->getActiveSheet()->setCellValue('D67', "8. Place of Supply");
		$this->excel->getActiveSheet()->mergeCells("E67:K67");
		$this->excel->getActiveSheet()->setCellValue('E67', "Declare the place of supply based on the original document.");

		$this->excel->getActiveSheet()->setCellValue('D68', "9. Note/Refund Voucher value*");
		$this->excel->getActiveSheet()->mergeCells("E68:K68");
		$this->excel->getActiveSheet()->setCellValue('E68', "Amount should be up to 2 decimal digits.");

		$this->excel->getActiveSheet()->setCellValue('D69', "10. Rate*");
		$this->excel->getActiveSheet()->mergeCells("E69:K69");
		$this->excel->getActiveSheet()->setCellValue('E69', "Enter the combined  (State tax + Central tax) or the integrated tax rate.");

		$this->excel->getActiveSheet()->setCellValue('D70', "11.Taxable value");
		$this->excel->getActiveSheet()->mergeCells("E70:K70");
		$this->excel->getActiveSheet()->setCellValue('E70', "Enter the taxable value of the supplied  goods or services for each rate line item -up to 2 \ndecimal Digits, The taxable value has to be computed as per GST valuation provisions. ");

		$this->excel->getActiveSheet()->setCellValue('D71', "12. Cess Amount");
		$this->excel->getActiveSheet()->mergeCells("E71:K71");
		$this->excel->getActiveSheet()->setCellValue('E71', "Enter the total  Cess amount.");

		$this->excel->getActiveSheet()->setCellValue('D72', "13. Pre GST");
		$this->excel->getActiveSheet()->mergeCells("E72:K72");
		$this->excel->getActiveSheet()->setCellValue('E72', "Select whether the credit/debit note is related to pre-GST supplies.");

		$this->excel->getActiveSheet()->mergeCells("D73:K73");

		// section 6
		$this->excel->getActiveSheet()->mergeCells("B74:B83");
		$this->excel->getActiveSheet()->setCellValue('B74', "exp");
		$this->excel->getActiveSheet()->getStyle('B74')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("C74:C83");
		$this->excel->getActiveSheet()->setCellValue('C74', "Export");
		$this->excel->getActiveSheet()->getStyle('C74')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("D74:K74");
		$this->excel->getActiveSheet()->setCellValue('D74', "Exports supplies including supplies to SEZ/SEZ Developer or deemed exports");

		$this->excel->getActiveSheet()->setCellValue('D75', "1.Export Type*");
		$this->excel->getActiveSheet()->mergeCells("E75:K75");
		$this->excel->getActiveSheet()->setCellValue('E75', "In the Type column, enter WPAY if the Export  is with payment of tax or else enter\n WOPAY.");

		$this->excel->getActiveSheet()->setCellValue('D76', "2. Invoice  number*");
		$this->excel->getActiveSheet()->mergeCells("E76:K76");
		$this->excel->getActiveSheet()->setCellValue('E76', "Enter the Invoice number issued to the registered receiver.  Ensure that the format is alpha-\nnumeric with  allowed special characters of slash(/) and dash(-) with maximum length of \nsixteen characters.");

		$this->excel->getActiveSheet()->setCellValue('D77', "3. Invoice Date*");
		$this->excel->getActiveSheet()->mergeCells("E77:K77");
		$this->excel->getActiveSheet()->setCellValue('E77', "Enter date of invoice in DD-MMM-YYYY. E.g. 24-May-2017.");

		$this->excel->getActiveSheet()->setCellValue('D78', "4. Invoice value*");
		$this->excel->getActiveSheet()->mergeCells("E78:K78");
		$this->excel->getActiveSheet()->setCellValue('E78', "Enter the invoice  value of the goods or services- up to 2 decimal Digits.");

		$this->excel->getActiveSheet()->setCellValue('D79', "5. Port Code");
		$this->excel->getActiveSheet()->mergeCells("E79:K79");
		$this->excel->getActiveSheet()->setCellValue('E79', "Enter the six digit code of port through which goods were exported. Please refer to the list of \nport codes available on the GST common portal. This is not required in case of export of \nservices.");

		$this->excel->getActiveSheet()->setCellValue('D80', "6. Shipping Bill Number");
		$this->excel->getActiveSheet()->mergeCells("E80:K80");
		$this->excel->getActiveSheet()->setCellValue('E80', "Enter the unique reference number of shipping bill. This information if not available at the \ntiming of submitting the return the same may be left blank and provided later.");

		$this->excel->getActiveSheet()->setCellValue('D81', "7. Shipping Bill Date");
		$this->excel->getActiveSheet()->mergeCells("E81:K81");
		$this->excel->getActiveSheet()->setCellValue('E81', "Enter the date of shipping bill. This information if not available at the timing of submitting\n the return the same may be left blank and provided later. This is not required in case of \nexport of services.");

		$this->excel->getActiveSheet()->setCellValue('D82', "9. Rate");
		$this->excel->getActiveSheet()->mergeCells("E82:K82");
		$this->excel->getActiveSheet()->setCellValue('E82', "Enter the applicable integrated tax rate.");

		$this->excel->getActiveSheet()->setCellValue('D83', "10. Taxable Value");
		$this->excel->getActiveSheet()->mergeCells("E83:K83");
		$this->excel->getActiveSheet()->setCellValue('E83', "Enter the taxable value of the supplied  goods or services for each rate line item -up to 2 decimal Digits, The taxable value has to be computed as per GST valuation provisions.");

		// section 7
		$this->excel->getActiveSheet()->mergeCells("B84:B88");
		$this->excel->getActiveSheet()->setCellValue('B84', "at");
		$this->excel->getActiveSheet()->getStyle('B84')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("C84:C88");
		$this->excel->getActiveSheet()->setCellValue('C84', "Tax liability on advances");
		$this->excel->getActiveSheet()->getStyle('C84')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("D84:K84");
		$this->excel->getActiveSheet()->setCellValue('D84', "Tax liability arising on account of receipt of consideration  for which  invoices have not been issued in the same tax period.");

		$this->excel->getActiveSheet()->setCellValue('D85', "1. Place of Supply(POS)*");
		$this->excel->getActiveSheet()->mergeCells("E85:K85");
		$this->excel->getActiveSheet()->setCellValue('E85', "Select the code of the state from drop down list for the place of supply.");

		$this->excel->getActiveSheet()->setCellValue('D86', "2. Rate*");
		$this->excel->getActiveSheet()->mergeCells("E86:K86");
		$this->excel->getActiveSheet()->setCellValue('E86', "Enter the combined  (State tax + Central tax) or the integrated tax rate.");

		$this->excel->getActiveSheet()->setCellValue('D87', "3. Gross advance received*");
		$this->excel->getActiveSheet()->mergeCells("E87:K87");
		$this->excel->getActiveSheet()->setCellValue('E87', "Enter the amount of advance received excluding the tax portion.");

		$this->excel->getActiveSheet()->setCellValue('D88', "4. Cess Amount");
		$this->excel->getActiveSheet()->mergeCells("E88:K88");
		$this->excel->getActiveSheet()->setCellValue('E88', "Enter the total  Cess amount collected/payable.");

		// section 8
		$this->excel->getActiveSheet()->mergeCells("B89:B93");
		$this->excel->getActiveSheet()->setCellValue('B89', "atadj");
		$this->excel->getActiveSheet()->getStyle('B89')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("C89:C93");
		$this->excel->getActiveSheet()->setCellValue('C89', "Advance adjustments");
		$this->excel->getActiveSheet()->getStyle('C89')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("D89:K89");
		$this->excel->getActiveSheet()->setCellValue('D89', "Adjustment of tax liability for tax already paid  on advance receipt of consideration and invoices issued in the current period for the supplies. ");

		$this->excel->getActiveSheet()->setCellValue('D90', "1. Place of Supply(POS)*");
		$this->excel->getActiveSheet()->mergeCells("E90:K90");
		$this->excel->getActiveSheet()->setCellValue('E90', "Select the code of the state from drop down list for the place of supply.");

		$this->excel->getActiveSheet()->setCellValue('D91', "2. Rate*");
		$this->excel->getActiveSheet()->mergeCells("E91:K91");
		$this->excel->getActiveSheet()->setCellValue('E91', "Enter the combined  (State tax + Central tax) or the integrated tax rate.");

		$this->excel->getActiveSheet()->setCellValue('D92', "3. Gross advance adjusted*");
		$this->excel->getActiveSheet()->mergeCells("E92:K92");
		$this->excel->getActiveSheet()->setCellValue('E92', "Enter the amount of advance on which has tax has already been paid in earlier tax period \n and invoices are declared during this tax period. This amount is excluding the tax portion");

		$this->excel->getActiveSheet()->setCellValue('D93', "4. Cess Amount");
		$this->excel->getActiveSheet()->mergeCells("E93:K93");
		$this->excel->getActiveSheet()->setCellValue('E93', "Enter the total  Cess amount to be adjusted");

		// section 9
		$this->excel->getActiveSheet()->mergeCells("B95:B99");
		$this->excel->getActiveSheet()->setCellValue('B95', "exemp");
		$this->excel->getActiveSheet()->getStyle('B95')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("C95:C99");
		$this->excel->getActiveSheet()->setCellValue('C95', "Nil Rated, Exempted and Non GST supplies");
		$this->excel->getActiveSheet()->getStyle('C95')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("D95:K95");
		$this->excel->getActiveSheet()->setCellValue('D95', "Details of Nil Rated, Exempted and Non GST Supplies made during the tax period");

		$this->excel->getActiveSheet()->setCellValue('D96', "1. Description");
		$this->excel->getActiveSheet()->mergeCells("E96:K96");
		$this->excel->getActiveSheet()->setCellValue('E96', "Indicates the type of supply. ");

		$this->excel->getActiveSheet()->setCellValue('D97', "2.Nil rated supplies");
		$this->excel->getActiveSheet()->mergeCells("E97:K97");
		$this->excel->getActiveSheet()->setCellValue('E97', "Declare the value of supplies made under the 'Nil rated' category for the supply type\n selected in  1. above. The amount to be declared here should exclude amount already\n declared in B2B and B2CL table as line items in tax invoice.");

		$this->excel->getActiveSheet()->setCellValue('D98', "3.Exempted\n(Other than Nil rated/non-GST\nsupply)");
		$this->excel->getActiveSheet()->mergeCells("E98:K98");
		$this->excel->getActiveSheet()->setCellValue('E98', "Declare the value of supplies made under the 'Exempted 'category for the supply type\n selected in  1. above.");

		$this->excel->getActiveSheet()->setCellValue('D99', "4.Non GST Supplies");
		$this->excel->getActiveSheet()->mergeCells("E99:K99");
		$this->excel->getActiveSheet()->setCellValue('E99', "Declare the value of supplies made under the 'Non GST' category for the supply type \nselected in  1. above. This column is to capture all the supplies made by the taxpayer which\n are out of the purview of GST");

		// section 10
		$this->excel->getActiveSheet()->mergeCells("B100:B110");
		$this->excel->getActiveSheet()->setCellValue('B100', "hsn");
		$this->excel->getActiveSheet()->getStyle('B100')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("C100:C110");
		$this->excel->getActiveSheet()->setCellValue('C100', "HSN Summary");
		$this->excel->getActiveSheet()->getStyle('C100')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("D100:K100");
		$this->excel->getActiveSheet()->setCellValue('D100', "HSN wise summary of goods /services supplied during the tax period");

		$this->excel->getActiveSheet()->setCellValue('D101', "1. HSN*");
		$this->excel->getActiveSheet()->mergeCells("E101:K101");
		$this->excel->getActiveSheet()->setCellValue('E101', "Enter the HSN Code  for the supplied goods or Services. Minimum digit required to be \nmentioned in the tax invoice and consequently to be reported is as follows.\n\n1. Up to rupees one crore fifty lakhs annual turnover - Nil digit \n2. more than rupees one crore fifty lakhs and up to rupees five crores annual turnover - 2 digit  \n3. more than rupees five crores annual turnover - 4  digit.");

		$this->excel->getActiveSheet()->setCellValue('D102', "2. Description*");
		$this->excel->getActiveSheet()->mergeCells("E102:K102");
		$this->excel->getActiveSheet()->setCellValue('E102', "Enter the description of the supplied goods or Services. Description becomes a mandatory\n field if HSN code is not provided above.");

		$this->excel->getActiveSheet()->setCellValue('D103', "3. UQC*");
		$this->excel->getActiveSheet()->mergeCells("E103:K103");
		$this->excel->getActiveSheet()->setCellValue('E103', "Select the applicable Unit Quantity Code  from the drop down.");

		$this->excel->getActiveSheet()->setCellValue('D104', "4. Total Quantity*");
		$this->excel->getActiveSheet()->mergeCells("E104:K104");
		$this->excel->getActiveSheet()->setCellValue('E104', "Enter the total quantity of the supplied goods or Services- up to 2 decimal Digits.");

		$this->excel->getActiveSheet()->setCellValue('D105', "5. Total Value*");
		$this->excel->getActiveSheet()->mergeCells("E105:K105");
		$this->excel->getActiveSheet()->setCellValue('E105', "Enter the invoice  value of the goods or services-up to 2 decimal Digits.");

		$this->excel->getActiveSheet()->setCellValue('D106', "6. Taxable Value*");
		$this->excel->getActiveSheet()->mergeCells("E106:K106");
		$this->excel->getActiveSheet()->setCellValue('E106', "Enter the total taxable value of the supplied goods or services- up to 2 decimal Digits.");

		$this->excel->getActiveSheet()->setCellValue('D107', "7. Integrated Tax Amount");
		$this->excel->getActiveSheet()->mergeCells("E107:K107");
		$this->excel->getActiveSheet()->setCellValue('E107', "Enter the total  Integrated tax amount collected/payable.");

		$this->excel->getActiveSheet()->setCellValue('D108', "8. Central Tax Amount");
		$this->excel->getActiveSheet()->mergeCells("E108:K108");
		$this->excel->getActiveSheet()->setCellValue('E108', "Enter the total  Central tax amount collected/payable.");

		$this->excel->getActiveSheet()->setCellValue('D109', "9. State/UT Tax Amount");
		$this->excel->getActiveSheet()->mergeCells("E109:K109");
		$this->excel->getActiveSheet()->setCellValue('E109', "Enter the total State/UT tax amount collected/payable.");

		$this->excel->getActiveSheet()->setCellValue('D110', "10. Cess Amount");
		$this->excel->getActiveSheet()->mergeCells("E110:K110");
		$this->excel->getActiveSheet()->setCellValue('E110', "Enter the total  Cess amount collected/payable.");

		// section 11
		$this->excel->getActiveSheet()->mergeCells("B111:B116");
		$this->excel->getActiveSheet()->setCellValue('B111', "docs");
		$this->excel->getActiveSheet()->getStyle('B111')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("C111:C116");
		$this->excel->getActiveSheet()->setCellValue('C111', "List of Documents issued");
		$this->excel->getActiveSheet()->getStyle('C111')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$this->excel->getActiveSheet()->mergeCells("D111:K111");
		$this->excel->getActiveSheet()->setCellValue('D111', "Details of various documents issued by the taxpayer during the tax period");

		$this->excel->getActiveSheet()->setCellValue('D112', "1. Nature of Document*");
		$this->excel->getActiveSheet()->mergeCells("E112:K112");
		$this->excel->getActiveSheet()->setCellValue('E112', "Select the applicable document type  from the drop down.");

		$this->excel->getActiveSheet()->setCellValue('D113', "2. Sr. No From*");
		$this->excel->getActiveSheet()->mergeCells("E113:K113");
		$this->excel->getActiveSheet()->setCellValue('E113', "Enter the invoice/document series start number.");

		$this->excel->getActiveSheet()->setCellValue('D114', "3. Sr. No To*");
		$this->excel->getActiveSheet()->mergeCells("E114:K114");
		$this->excel->getActiveSheet()->setCellValue('E114', "Enter the invoice/document series end number.");

		$this->excel->getActiveSheet()->setCellValue('D115', "5.Total Number*");
		$this->excel->getActiveSheet()->mergeCells("E115:K115");
		$this->excel->getActiveSheet()->setCellValue('E115', "Enter the total no of documents in this particular series.");

		$this->excel->getActiveSheet()->setCellValue('D116', "6.Cancelled");
		$this->excel->getActiveSheet()->mergeCells("E116:K116");
		$this->excel->getActiveSheet()->setCellValue('E116', "No of documents cancelled in the particular series.");

		// common mistake
		$this->excel->getActiveSheet()->mergeCells("B119:K119");
		$this->excel->getActiveSheet()->setCellValue('B119', "Common mistakes in filling Excel template");

		$this->excel->getActiveSheet()->mergeCells("B120:K120");
		$this->excel->getActiveSheet()->setCellValue('B120', "1. GSTIN of supplier/E-commerce  should be a valid one. State code of supplier GSTIN and E-Commerce GSTIN should be the same.");

		$this->excel->getActiveSheet()->mergeCells("B121:K121");
		$this->excel->getActiveSheet()->setCellValue('B121', "2. Duplication of invoices with the same tax rate shouldn’t be there-otherwise System throws error as 'Non duplicated invoices were added & these invoices are duplicated' at the time of import. ");

		$this->excel->getActiveSheet()->mergeCells("B122:K122");
		$this->excel->getActiveSheet()->setCellValue('B122', "3. Amount should be only up to  2 decimal digits");

		$this->excel->getActiveSheet()->mergeCells("B123:K123");
		$this->excel->getActiveSheet()->setCellValue('B123', "4  Ensure that filling of excel should be strictly as per sample data to avoid errors. ");

		$this->excel->getActiveSheet()->mergeCells("B124:K124");
		$this->excel->getActiveSheet()->setCellValue('B124', "5. Copy  paste data from the excel template not including the header rows 1 to 4 will throw an error. ");

		$this->excel->getActiveSheet()->mergeCells("B125:K125");
		$this->excel->getActiveSheet()->setCellValue('B125', "6. The work sheet name in the excel file of return data prepared by the return preparer should be the same as mentioned in the sample excel template.");

		$this->excel->getActiveSheet()->mergeCells("B126:K126");
		$this->excel->getActiveSheet()->setCellValue('B126', "7. Master data sheet provides the inputs allowed in the mentioned data field. Inputs in the master data sheet have been used for the drop down lists in the worksheets.");

		// Special Instructions
		$this->excel->getActiveSheet()->mergeCells("B128:K128");
		$this->excel->getActiveSheet()->setCellValue('B128', "Special Instructions");

		$this->excel->getActiveSheet()->mergeCells("B129:K129");
		$this->excel->getActiveSheet()->setCellValue('B129', "1) To facilitate the declaration of date in the specified format 'dd-mmm-yyyy',  ensure the system date format of your computer is 'dd/mm/yyyy or dd-mm-yyyy'.");

		$this->excel->getActiveSheet()->mergeCells("B130:K130");
		$this->excel->getActiveSheet()->setCellValue('B130', "2) For invoices containing multiple line items invoice level details like GSTIN/UIN, Invoice Number, Invoice Date and Place of Supply should be repeated for all the line items, in the absence of the same system will not accept those items");

		$this->excel->getActiveSheet()->mergeCells("B131:K131");
		$this->excel->getActiveSheet()->setCellValue('B131', "3) Taxable Value, Rate and cess amount as applicable to the line items may be different in the same invoice.");

		$this->excel->getActiveSheet()->mergeCells("B132:K132");
		$this->excel->getActiveSheet()->setCellValue('B132', "4) On successful import of the data from the excel file to the offline utility tool, the tool takes care of proper placement of the same in the return format");

		$this->excel->getActiveSheet()->mergeCells("B133:K133");
		$this->excel->getActiveSheet()->setCellValue('B133', "5) In the worksheets on the combined (central tax+state tax) tax  or integrated tax  rate has to be mentioned. The java tool will calculate the  central tax, state tax or integrated tax.  The tax payer can edit these amounts in the java tool if the \ncollected value is different.");

		$this->excel->getActiveSheet()->mergeCells("B134:K134");
		$this->excel->getActiveSheet()->setCellValue('B134', "6) In this first version worksheets are not being provided for uploading amendment details as these are not expected in the first GST return. Those will be provided in the next version.");

		$this->excel->getActiveSheet()->mergeCells("B135:K135");
		$this->excel->getActiveSheet()->setCellValue('B135', "7) In the top of  each excel worksheet , there is a summary row which gives the count or total of  the key columns to help in reconciliation.");

		$this->excel->getActiveSheet()->mergeCells("B136:K136");
		$this->excel->getActiveSheet()->setCellValue('B136', "8) The worksheets for furnishing exempt supplies details and issued documents details are being provided in this excel workbook template however the data cannot be imported from the excel to the java tool in this version. The tax\n payer can enter the few exempt supplies detail  values and details of documents issued directly in the screens available on GST portal .");

		$this->excel->getActiveSheet()->mergeCells("B137:K137");
		$this->excel->getActiveSheet()->setCellValue('B137', "9) The worksheets have some data as example. Please delete the data from all worksheets before use.");

		$this->excel->getActiveSheet()->mergeCells("B138:K138");
		$this->excel->getActiveSheet()->setCellValue('B138', "10) The number mentioned in bracket in the top most row in each data entry worksheet refer to the corresponding table number in the notified GSTR 1 format. For example in b2b worksheet 'Summary For B2B(4)' here '4' refers to the table\n number 4 of GSTR 1 format.");

		$this->excel->getActiveSheet()->mergeCells("B139:K139");
		$this->excel->getActiveSheet()->setCellValue('B139', "11) This excel workbook template works best with Microsoft Excel 2007 and above.");

		$this->excel->getActiveSheet()->mergeCells("B140:K140");
		$this->excel->getActiveSheet()->setCellValue('B140', "12) Ensure that there are no stray entries in any cell of the sheets other than return related declaration under the indicated column headers.");

		$this->excel->getActiveSheet()->mergeCells("B141:K141");
		$this->excel->getActiveSheet()->setCellValue('B141', "13) It is advisable that separate excel sheets be prepared for each month with the name having month name  as a part of it's name. In case of multiple uploads for a  month, the file name may be classified as Part A, Part B etc  to avoid\n confusion.");

		$this->excel->getActiveSheet()->mergeCells("B142:K142");
		$this->excel->getActiveSheet()->setCellValue('B142', "14) In case of JSON files  created by the offline tool , if the taxpayer is frequently importing  invoice data in a tax period, he should name the different created JSON file of a part of a month/tax period by including the name of month and the\n part number.");

		$this->excel->getActiveSheet()->mergeCells("B143:K143");
		$this->excel->getActiveSheet()->setCellValue('B143', "15)Before importing the excel file in the offline tool for a particular tax period, it is advisable that the taxpayer should delete if any existing data of that tax period by clicking 'Delete All Data'  tab in the  Java Offline Tool. If  any data\n remains in the tool will overwrite the existing data. ");

		$this->excel->getActiveSheet()->mergeCells("B144:K144");
		$this->excel->getActiveSheet()->setCellValue('B144', "16) If one uploads the JSON file for a tax period with  the same invoice number but differing  details again,  the later invoice details will overwrite the earlier details.");

		$this->excel->getActiveSheet()->mergeCells("B145:K145");
		$this->excel->getActiveSheet()->setCellValue('B145', "17) In case of other sections where the consolidated details have to be furnished, the details of whole section furnished earlier would be overwritten by the later uploaded details.");

		$this->excel->getActiveSheet()->mergeCells("B146:K146");
		$this->excel->getActiveSheet()->setCellValue('B146', "18) In case of b2b worksheet, if the invoice has been selected as subject to reverse charge, the top summary row excludes the value of cess amount as it is not collected by the supplier.");

		// sample excel
		$this->excel->getActiveSheet()->mergeCells("B148:L148");
		$this->excel->getActiveSheet()->setCellValue('B148', " Sample excel sheet with multiple line item in a single invoice is shown below:");

		$this->excel->getActiveSheet()->setCellValue('B149', "Summary For B2B(4)");
		$this->excel->getActiveSheet()->setCellValue('K149', "HELP");
		$this->excel->getActiveSheet()->setCellValue('B150', "No. of Recipients");
		$this->excel->getActiveSheet()->setCellValue('C150', "No. of Invoices");
		$this->excel->getActiveSheet()->setCellValue('E150', "Total Invoice Value");
		$this->excel->getActiveSheet()->setCellValue('K150', "Total Taxable Value");
		$this->excel->getActiveSheet()->setCellValue('L150', "Total Cess");

		$this->excel->getActiveSheet()->setCellValue('B151', "4");
		$this->excel->getActiveSheet()->setCellValue('C151', "15");
		$this->excel->getActiveSheet()->setCellValue('E151', "910000.00");
		$this->excel->getActiveSheet()->setCellValue('K151', "605000.00");
		$this->excel->getActiveSheet()->setCellValue('L151', "41456.00");

		$this->excel->getActiveSheet()->setCellValue('B152', "GSTIN/UIN of Recipient");
		$this->excel->getActiveSheet()->setCellValue('C152', "Invoice Number");
		$this->excel->getActiveSheet()->setCellValue('D152', "Invoice date");
		$this->excel->getActiveSheet()->setCellValue('E152', "Invoice Value");
		$this->excel->getActiveSheet()->setCellValue('F152', "Place Of Supply");
		$this->excel->getActiveSheet()->setCellValue('G152', "Reverse Charge");
		$this->excel->getActiveSheet()->setCellValue('H152', "Invoice Type");
		$this->excel->getActiveSheet()->setCellValue('I152', "E-Commerce GSTIN");
		$this->excel->getActiveSheet()->setCellValue('J152', "Rate");
		$this->excel->getActiveSheet()->setCellValue('K152', "Taxable Value");
		$this->excel->getActiveSheet()->setCellValue('L152', "Cess Amount");

		$this->excel->getActiveSheet()->setCellValue('B153', "24CDBPB4239A1ZE");
		$this->excel->getActiveSheet()->setCellValue('C153', "121");
		$this->excel->getActiveSheet()->setCellValue('D153', "'01-Aug-2023");
		$this->excel->getActiveSheet()->setCellValue('E153', "130363");
		$this->excel->getActiveSheet()->setCellValue('F153', "24-GUJARAT");
		$this->excel->getActiveSheet()->setCellValue('G153', "N");
		$this->excel->getActiveSheet()->setCellValue('H153', "Regular");
		$this->excel->getActiveSheet()->setCellValue('I153', "");
		$this->excel->getActiveSheet()->setCellValue('J153', "5");
		$this->excel->getActiveSheet()->setCellValue('K153', "124155");
		$this->excel->getActiveSheet()->setCellValue('L153', "");

		$this->excel->getActiveSheet()->setCellValue('B154', "24CDBPB4239A1ZE");
		$this->excel->getActiveSheet()->setCellValue('C154', "121");
		$this->excel->getActiveSheet()->setCellValue('D154', "'01-Aug-2023");
		$this->excel->getActiveSheet()->setCellValue('E154', "130363");
		$this->excel->getActiveSheet()->setCellValue('F154', "24-GUJARAT");
		$this->excel->getActiveSheet()->setCellValue('G154', "N");
		$this->excel->getActiveSheet()->setCellValue('H154', "Regular");
		$this->excel->getActiveSheet()->setCellValue('I154', "");
		$this->excel->getActiveSheet()->setCellValue('J154', "5");
		$this->excel->getActiveSheet()->setCellValue('K154', "124155");
		$this->excel->getActiveSheet()->setCellValue('L154', "");

		$this->excel->getActiveSheet()->setCellValue('B155', "24CDBPB4239A1ZE");
		$this->excel->getActiveSheet()->setCellValue('C155', "121");
		$this->excel->getActiveSheet()->setCellValue('D155', "'01-Aug-2023");
		$this->excel->getActiveSheet()->setCellValue('E155', "130363");
		$this->excel->getActiveSheet()->setCellValue('F155', "24-GUJARAT");
		$this->excel->getActiveSheet()->setCellValue('G155', "N");
		$this->excel->getActiveSheet()->setCellValue('H155', "Regular");
		$this->excel->getActiveSheet()->setCellValue('I155', "");
		$this->excel->getActiveSheet()->setCellValue('J155', "5");
		$this->excel->getActiveSheet()->setCellValue('K155', "124155");
		$this->excel->getActiveSheet()->setCellValue('L155', "");

		$this->excel->getActiveSheet()->setCellValue('B156', "24CDBPB4239A1ZE");
		$this->excel->getActiveSheet()->setCellValue('C156', "121");
		$this->excel->getActiveSheet()->setCellValue('D156', "'01-Aug-2023");
		$this->excel->getActiveSheet()->setCellValue('E156', "130363");
		$this->excel->getActiveSheet()->setCellValue('F156', "24-GUJARAT");
		$this->excel->getActiveSheet()->setCellValue('G156', "N");
		$this->excel->getActiveSheet()->setCellValue('H156', "Regular");
		$this->excel->getActiveSheet()->setCellValue('I156', "");
		$this->excel->getActiveSheet()->setCellValue('J156', "5");
		$this->excel->getActiveSheet()->setCellValue('K156', "124155");
		$this->excel->getActiveSheet()->setCellValue('L156', "");

		$this->excel->getActiveSheet()->setCellValue('B157', "24CDBPB4239A1ZE");
		$this->excel->getActiveSheet()->setCellValue('C157', "121");
		$this->excel->getActiveSheet()->setCellValue('D157', "'01-Aug-2023");
		$this->excel->getActiveSheet()->setCellValue('E157', "130363");
		$this->excel->getActiveSheet()->setCellValue('F157', "24-GUJARAT");
		$this->excel->getActiveSheet()->setCellValue('G157', "N");
		$this->excel->getActiveSheet()->setCellValue('H157', "Regular");
		$this->excel->getActiveSheet()->setCellValue('I157', "");
		$this->excel->getActiveSheet()->setCellValue('J157', "5");
		$this->excel->getActiveSheet()->setCellValue('K157', "124155");
		$this->excel->getActiveSheet()->setCellValue('L157', "");

		// term word
		$this->excel->getActiveSheet()->setCellValue('B158', "Term/ Acronym");
		$this->excel->getActiveSheet()->mergeCells("C158:D158");
		$this->excel->getActiveSheet()->setCellValue('C158', "Description");

		$this->excel->getActiveSheet()->setCellValue('B159', "GSTIN");
		$this->excel->getActiveSheet()->mergeCells("C159:D159");
		$this->excel->getActiveSheet()->setCellValue('C159', "Goods and Services Taxpayer Identification Number");

		$this->excel->getActiveSheet()->setCellValue('B160', "GSTN");
		$this->excel->getActiveSheet()->mergeCells("C160:D160");
		$this->excel->getActiveSheet()->setCellValue('C160', "Goods and Services Tax Network");

		$this->excel->getActiveSheet()->setCellValue('B161', "HSN");
		$this->excel->getActiveSheet()->mergeCells("C161:D161");
		$this->excel->getActiveSheet()->setCellValue('C161', "Harmonized System of Nomenclature");

		$this->excel->getActiveSheet()->setCellValue('B162', "B2B");
		$this->excel->getActiveSheet()->mergeCells("C162:D162");
		$this->excel->getActiveSheet()->setCellValue('C162', "Registered Business to Registered Business");

		$this->excel->getActiveSheet()->setCellValue('B163', "B2C");
		$this->excel->getActiveSheet()->mergeCells("C163:D163");
		$this->excel->getActiveSheet()->setCellValue('C163', "Registered Business to Unregistered Consumer");

		$this->excel->getActiveSheet()->setCellValue('B164', "POS");
		$this->excel->getActiveSheet()->mergeCells("C164:D164");
		$this->excel->getActiveSheet()->setCellValue('C164', "Place of Supply of Goods or Services – State code to be\n mentioned");

		$this->excel->getActiveSheet()->setCellValue('B165', "UIN");
		$this->excel->getActiveSheet()->mergeCells("C165:D165");
		$this->excel->getActiveSheet()->setCellValue('C165', "Unique Identity Number");

		$this->excel->getActiveSheet()->setCellValue('B166', "GSTR1");
		$this->excel->getActiveSheet()->mergeCells("C166:D166");
		$this->excel->getActiveSheet()->setCellValue('C166', "GST Return 1");

		$this->excel->getActiveSheet()->setCellValue('B167', "GST");
		$this->excel->getActiveSheet()->mergeCells("C167:D167");
		$this->excel->getActiveSheet()->setCellValue('C167', "Goods and Services Tax");
		
		$this->excel->getActiveSheet()->setCellValue('B168', "UQC");
		$this->excel->getActiveSheet()->mergeCells("C168:D168");
		$this->excel->getActiveSheet()->setCellValue('C168', "Unit Quantity Code");
		
		// sheet 2
		$sheet2 = $this->excel->createSheet();

		for ($col = 'A'; $col != 'L'; $col++) {
			$sheet2->getColumnDimension($col)->setAutoSize(true);
		}

        $sheet2->setTitle('b2b');
		$sheet2->setCellValue('A1', 'Summary For B2B(4)');
		// $sheet2->getRowDimension(1)->setRowHeight(100);
		$sheet2->setCellValue('K1', 'HELP');

		$sheet2->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('A1')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('A2', 'No. of Recipients');
		$sheet2->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('A2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('A2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('B2', 'No. of Invoices');
		$sheet2->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('C2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('C2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('D2', 'Total Invoice Value');
		$sheet2->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('D2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('D2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('E2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('E2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->getStyle('F2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('F2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('F2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->getStyle('G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('G2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('G2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->getStyle('H2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('H2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('H2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->getStyle('I2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('I2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('I2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('J2', 'Total Taxable Value');
		$sheet2->getStyle('J2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('J2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('J2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('K2', 'Total Cess');
		$sheet2->getStyle('K2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('K2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('K2')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$TotalInvoiceB2b = 0;
		$totalAmountB2b = 0;
		$totalAmountB2b12 = 0;
		$totalAmountB2b5 = 0;
		$totalRecipient = array();
		
		for ($i=0; $i < count($data['orderData']); $i++) {
			$totalAmountB2b = $totalAmountB2b + $data['orderData'][$i]['SUM(tblorder.OrderTotal)'];

			if($data['orderData'][$i]['OrderGSTPer'] == 12){
				$totalAmountB2b12 = $totalAmountB2b12 + $data['orderData'][$i]['SUM(tblorder.OrderTotal)'];
			}else{
				$totalAmountB2b5 = $totalAmountB2b5 + $data['orderData'][$i]['SUM(tblorder.OrderTotal)'];
			}

			array_push($totalRecipient,$data['orderData'][$i]['DealerGSTNO']);
			$TotalInvoiceB2b++;
		}

		for ($i=0; $i < count($data['palletData']); $i++) {
			$totalAmountB2b = $totalAmountB2b + $data['palletData'][$i]['SUM(tblorderpalletdetail.OrderpalletdetailTotal)'];

			if($data['palletData'][$i]['OrderpalletGSTPer'] == 12){
				$totalAmountB2b12 = $totalAmountB2b12 + $data['palletData'][$i]['SUM(tblorderpalletdetail.OrderpalletdetailTotal)'];
			}else{
				$totalAmountB2b5 = $totalAmountB2b5 + $data['palletData'][$i]['SUM(tblorderpalletdetail.OrderpalletdetailTotal)'];
			}

			array_push($totalRecipient,$data['palletData'][$i]['DealerGSTNO']);
			$TotalInvoiceB2b++;
		}

		$totalRecipientCount = count(array_unique($totalRecipient));

		$sheet2->setCellValue('A3', $totalRecipientCount);
		$sheet2->setCellValue('B3', $TotalInvoiceB2b);
		$sheet2->setCellValue('D3', round($totalAmountB2b,2));
		$sheet2->setCellValue('J3', round($totalAmountB2b,2));
		$sheet2->setCellValue('K3', '0.00');

		// label
		$sheet2->setCellValue('A4', 'GSTIN/UIN of Recipient');
		$sheet2->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('A4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('A4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('B4', 'Invoice Number');
		$sheet2->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('B4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('B4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('C4', 'Invoice date');
		$sheet2->getStyle('C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('C4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('C4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('D4', 'Invoice Value');
		$sheet2->getStyle('D4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('D4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('D4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('E4', 'Place Of Supply');
		$sheet2->getStyle('E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('E4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('E4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('F4', 'Reverse Charge');
		$sheet2->getStyle('F4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('F4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('F4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('G4', 'Invoice Type');
		$sheet2->getStyle('G4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('G4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('G4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('H4', 'E-Commerce GSTIN');
		$sheet2->getStyle('H4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('H4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('H4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('I4', 'Rate');
		$sheet2->getStyle('I4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('I4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('I4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('J4', 'Taxable Value');
		$sheet2->getStyle('J4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('J4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('J4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet2->setCellValue('K4', 'Cess Amount');
		$sheet2->getStyle('K4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet2->getStyle('K4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet2->getStyle('K4')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$colValue=5;$lastColCount=0;


		for ($i=0; $i < count($data['filterArray']); $i++) {

			if($i == count($data['filterArray'])-1){
				$lastColCount = $colValue+$i;
			}

			$sheet2->setCellValue('A'.($colValue+$i), $data['filterArray'][$i]['DealerGSTNO']);
			$sheet2->setCellValue('B'.($colValue+$i), $data['filterArray'][$i]['OrderGstInvoice']);
			$sheet2->setCellValue('C'.($colValue+$i), date("d-M-Y", strtotime($data['filterArray'][$i]['OrderBillDate'])));
			// $sheet2->setCellValue('D'.($colValue+$i), round($data['filterArray'][$i]['SUM(tblorder.OrderTotal)'],2));
			// 
			if($data['filterArray'][$i]['OrderGstPer'] == 12 || $data['filterArray'][$i]['OrderGstPer'] == 18){
				$gstAmount = ($data['filterArray'][$i]['SUM(tblorder.OrderTotal)'] * $data['filterArray'][$i]['OrderGstPer']) / 100;
				$sheet2->setCellValue('D'.($colValue+$i), round($data['filterArray'][$i]['SUM(tblorder.OrderTotal)'] + $gstAmount, 2));
			}else{
				$sheet2->setCellValue('D'.($colValue+$i), round($data['filterArray'][$i]['SUM(tblorder.OrderTotal)'],2));
			}
			// 
			$sheet2->setCellValue('E'.($colValue+$i), '24-GUJARAT');
			// $sheet2->setCellValue('F'.($colValue+$i), 'Y');
			$sheet2->setCellValue('G'.($colValue+$i), 'Regular');
			$sheet2->setCellValue('H'.($colValue+$i), '');
			if($data['filterArray'][$i]['OrderGstPer'] == 12 || $data['filterArray'][$i]['OrderGstPer'] == 18){
				$sheet2->setCellValue('I'.($colValue+$i), $data['filterArray'][$i]['OrderGstPer']);
				$sheet2->setCellValue('F'.($colValue+$i), 'N');
			}
			else{
				$sheet2->setCellValue('I'.($colValue+$i), '5.00');
				$sheet2->setCellValue('F'.($colValue+$i), 'Y');
			}
			$sheet2->setCellValue('J'.($colValue+$i), round($data['filterArray'][$i]['SUM(tblorder.OrderTotal)'],2));
			$sheet2->setCellValue('K'.($colValue+$i), '');
		}

		// for ($i=0; $i < count($data['orderData']); $i++) {

		// 	if($i == count($data['orderData'])-1){
		// 		$lastColCount = $colValue+$i;
		// 	}

		// 	$sheet2->setCellValue('A'.($colValue+$i), $data['orderData'][$i]['DealerGSTNO']);
		// 	$sheet2->setCellValue('B'.($colValue+$i), $data['orderData'][$i]['OrderGstInvoice']);
		// 	$sheet2->setCellValue('C'.($colValue+$i), date("d-M-Y", strtotime($data['orderData'][$i]['OrderBillDate'])));
		// 	$sheet2->setCellValue('D'.($colValue+$i), round($data['orderData'][$i]['SUM(tblorder.OrderTotal)'],2));
		// 	$sheet2->setCellValue('E'.($colValue+$i), '24-GUJARAT');
		// 	$sheet2->setCellValue('F'.($colValue+$i), 'Y');
		// 	$sheet2->setCellValue('G'.($colValue+$i), 'Regular');
		// 	$sheet2->setCellValue('H'.($colValue+$i), '');
		// 	$sheet2->setCellValue('I'.($colValue+$i), '5.00');
		// 	$sheet2->setCellValue('J'.($colValue+$i), round($data['orderData'][$i]['SUM(tblorder.OrderTotal)'],2));
		// 	$sheet2->setCellValue('K'.($colValue+$i), '');
		// }

		// $lastColCountNew=$lastColCount+1;
		// for ($i=0; $i < count($data['palletData']); $i++) { 
		// 	$sheet2->setCellValue('A'.($lastColCountNew+$i), $data['palletData'][$i]['DealerGSTNO']);
		// 	$sheet2->setCellValue('B'.($lastColCountNew+$i), $data['palletData'][$i]['OrderpalletGstInvoice']);
		// 	$sheet2->setCellValue('C'.($lastColCountNew+$i), date("d-M-Y", strtotime($data['palletData'][$i]['OrderpalletBillDate'])));
		// 	$sheet2->setCellValue('D'.($lastColCountNew+$i), round($data['palletData'][$i]['SUM(tblorderpalletdetail.OrderpalletdetailTotal)'],2));
		// 	$sheet2->setCellValue('E'.($lastColCountNew+$i), '24-GUJARAT');
		// 	$sheet2->setCellValue('F'.($lastColCountNew+$i), 'Y');
		// 	$sheet2->setCellValue('G'.($lastColCountNew+$i), 'Regular');
		// 	$sheet2->setCellValue('H'.($lastColCountNew+$i), '');
		// 	$sheet2->setCellValue('I'.($lastColCountNew+$i), '5.00');
		// 	$sheet2->setCellValue('J'.($lastColCountNew+$i), round($data['palletData'][$i]['SUM(tblorderpalletdetail.OrderpalletdetailTotal)'],2));
		// 	$sheet2->setCellValue('K'.($lastColCountNew+$i), '');
		// }

		// sheet 3
		$sheet3 = $this->excel->createSheet();
        $sheet3->setTitle('b2cl');
		$sheet3->setCellValue('A1', 'Summary For B2CL(5)');
		$sheet3->setCellValue('H1', 'HELP');

		$sheet3->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('A1')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->setCellValue('A2', 'No. of Invoices');
		$sheet3->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('A2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('A2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->setCellValue('C2', 'Total Inv Value');
		$sheet3->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('C2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('C2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('D2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('D2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('E2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('E2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->setCellValue('F2', 'Total Taxable Value');
		$sheet3->getStyle('F2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('F2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('F2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->setCellValue('G2', 'Total Cess');
		$sheet3->getStyle('G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('G2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('G2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->getStyle('H2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('H2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('H2')->getFont()->getColor()->setRGB('FFFFFF');


		// dynamic value
		$sheet3->setCellValue('A3', '0');
		$sheet3->setCellValue('C3', '0.00');
		$sheet3->setCellValue('F3', '00.00');
		$sheet3->setCellValue('G3', '0.00');

		// label
		$sheet3->setCellValue('A4', 'Invoice Number');
		$sheet3->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('A4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('A4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->setCellValue('B4', 'Invoice date');
		$sheet3->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('B4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('B4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->setCellValue('C4', 'Invoice Value');
		$sheet3->getStyle('C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('C4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('C4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->setCellValue('D4', 'Place Of Supply');
		$sheet3->getStyle('D4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('D4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('D4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->setCellValue('E4', 'Rate');
		$sheet3->getStyle('E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('E4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('E4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->setCellValue('F4', 'Taxable Value');
		$sheet3->getStyle('F4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('F4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('F4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->setCellValue('G4', 'Cess Amount');
		$sheet3->getStyle('G4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('G4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('G4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet3->setCellValue('H4', 'E-Commerce GSTIN');
		$sheet3->getStyle('H4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet3->getStyle('H4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet3->getStyle('H4')->getFont()->getColor()->setRGB('FFFFFF');

		// sheet 4
		$sheet4 = $this->excel->createSheet();
        $sheet4->setTitle('b2cs');
		$sheet4->setCellValue('A1', 'Summary For B2CS(7)');
		$sheet4->setCellValue('F1', 'HELP');

		$sheet4->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('A1')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet4->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('A2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('A2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet4->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet4->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('C2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('C2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet4->setCellValue('D2', 'Total Taxable  Value');
		$sheet4->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('D2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('D2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet4->setCellValue('E2', 'Total Cess');
		$sheet4->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('E2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('E2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet4->getStyle('F2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('F2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('F2')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$sheet4->setCellValue('D3', '0.00');
		$sheet4->setCellValue('E3', '00.00');

		// label
		$sheet4->setCellValue('A4', 'Type');
		$sheet4->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('A4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('A4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet4->setCellValue('B4', 'Place Of Supply');
		$sheet4->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('B4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('B4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet4->setCellValue('C4', 'Rate');
		$sheet4->getStyle('C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('C4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('C4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet4->setCellValue('D4', 'Taxable Value');
		$sheet4->getStyle('D4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('D4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('D4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet4->setCellValue('E4', 'Cess Amount');
		$sheet4->getStyle('E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('E4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('E4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet4->setCellValue('F4', 'E-Commerce GSTIN');
		$sheet4->getStyle('F4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet4->getStyle('F4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet4->getStyle('F4')->getFont()->getColor()->setRGB('FFFFFF');

		// sheet 5
		$sheet5 = $this->excel->createSheet();
        $sheet5->setTitle('cdnr');
		$sheet5->setCellValue('A1', 'Summary For CDNR(9B)');
		$sheet5->setCellValue('M1', 'HELP');

		$sheet5->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('A1')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('A2', 'No. of Recipients');
		$sheet5->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('A2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('A2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('A2', 'No. of Invoices');
		$sheet5->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('C2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('C2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('D2', 'No. of Notes/Vouchers');
		$sheet5->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('D2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('D2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('E2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('E2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->getStyle('F2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('F2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('F2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->getStyle('G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('G2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('G2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->getStyle('H2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('H2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('H2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('I2', 'Total Note/Refund Voucher Value');
		$sheet5->getStyle('I2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('I2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('I2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->getStyle('J2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('J2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('J2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('K2', 'Total Taxable Value');
		$sheet5->getStyle('K2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('K2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('K2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('L2', 'Total Cess');
		$sheet5->getStyle('L2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('L2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('L2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->getStyle('M2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('M2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('M2')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$sheet5->setCellValue('A3', '0.00');
		$sheet5->setCellValue('B3', '0.00');
		$sheet5->setCellValue('D3', '0.00');
		$sheet5->setCellValue('I3', '0.00');
		$sheet5->setCellValue('K3', '0.00');
		$sheet5->setCellValue('L3', '00.00');

		// label
		$sheet5->setCellValue('A4', 'GSTIN/UIN of Recipient');
		$sheet5->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('A4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('A4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('B4', 'Invoice/Advance Receipt Number');
		$sheet5->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('B4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('B4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('C4', 'Invoice/Advance Receipt date');
		$sheet5->getStyle('C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('C4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('C4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('D4', 'Note/Refund Voucher Number');
		$sheet5->getStyle('D4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('D4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('D4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('E4', 'Note/Refund Voucher date');
		$sheet5->getStyle('E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('E4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('E4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('F4', 'Document Type');
		$sheet5->getStyle('F4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('F4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('F4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('G4', 'Reason For Issuing document');
		$sheet5->getStyle('G4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('G4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('G4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('H4', 'Place Of Supply');
		$sheet5->getStyle('H4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('H4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('H4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('I4', 'Note/Refund Voucher Value');
		$sheet5->getStyle('I4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('I4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('I4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('J4', 'Rate');
		$sheet5->getStyle('J4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('J4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('J4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('K4', 'Taxable Value');
		$sheet5->getStyle('K4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('K4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('K4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('L4', 'Cess Amount');
		$sheet5->getStyle('L4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('L4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('L4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet5->setCellValue('M4', 'Pre GST');
		$sheet5->getStyle('M4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet5->getStyle('M4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet5->getStyle('M4')->getFont()->getColor()->setRGB('FFFFFF');


		// sheet 6
		$sheet6 = $this->excel->createSheet();
        $sheet6->setTitle('cdnur');
		$sheet6->setCellValue('A1', 'Summary For CDNUR(9B)');
		$sheet6->setCellValue('M1', 'HELP');

		$sheet6->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('A1')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('A2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('A2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('B2', 'No. of Notes/Vouchers');
		$sheet6->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('C2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('C2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('D2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('D2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet6->setCellValue('E2', 'No. of Invoices');
		$sheet6->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('E2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('E2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->getStyle('F2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('F2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('F2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->getStyle('G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('G2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('G2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->getStyle('H2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('H2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('H2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('I2', 'Total Note Value');
		$sheet6->getStyle('I2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('I2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('I2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->getStyle('J2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('J2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('J2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('K2', 'Total Taxable Value');
		$sheet6->getStyle('K2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('K2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('K2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('L2', 'Total Cess');
		$sheet6->getStyle('L2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('L2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('L2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->getStyle('M2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('M2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('M2')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$sheet6->setCellValue('B3', '0.00');
		$sheet6->setCellValue('E3', '0.00');
		$sheet6->setCellValue('I3', '0.00');
		$sheet6->setCellValue('K3', '0.00');
		$sheet6->setCellValue('L3', '00.00');

		// label
		$sheet6->setCellValue('A4', 'UR Type');
		$sheet6->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('A4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('A4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('B4', 'Note/Refund Voucher Number');
		$sheet6->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('B4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('B4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('C4', 'Note/Refund Voucher date');
		$sheet6->getStyle('C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('C4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('C4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('D4', 'Document Type');
		$sheet6->getStyle('D4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('D4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('D4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('E4', 'Invoice/Advance Receipt Number');
		$sheet6->getStyle('E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('E4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('E4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('F4', 'Invoice/Advance Receipt date');
		$sheet6->getStyle('F4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('F4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('F4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('G4', 'Reason For Issuing document');
		$sheet6->getStyle('G4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('G4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('G4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('H4', 'Place Place Of Supply Of Supply Supply');
		$sheet6->getStyle('H4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('H4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('H4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('I4', 'Note/Refund Voucher Value');
		$sheet6->getStyle('I4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('I4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('I4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('J4', 'Rate');
		$sheet6->getStyle('J4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('J4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('J4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('K4', 'Taxable Value');
		$sheet6->getStyle('K4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('K4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('K4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('L4', 'Cess Amount');
		$sheet6->getStyle('L4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('L4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('L4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet6->setCellValue('M4', 'Pre GST');
		$sheet6->getStyle('M4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet6->getStyle('M4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet6->getStyle('M4')->getFont()->getColor()->setRGB('FFFFFF');

		// sheet7
		$sheet7 = $this->excel->createSheet();
        $sheet7->setTitle('exp');
		$sheet7->setCellValue('A1', 'Summary For EXP(6)');
		$sheet7->setCellValue('I1', 'HELP');

		$sheet7->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('A1')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('A2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('A2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->setCellValue('B2', 'No. of Invoices');
		$sheet7->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('C2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('C2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet7->setCellValue('D2', 'Total Invoice Value');
		$sheet7->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('D2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('D2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet7->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('E2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('E2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->setCellValue('F2', 'No. of Shipping Bill');
		$sheet7->getStyle('F2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('F2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('F2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->getStyle('G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('G2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('G2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->getStyle('H2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('H2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('H2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->setCellValue('I2', 'Total Taxable Value');
		$sheet7->getStyle('I2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('I2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('I2')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$sheet7->setCellValue('B3', '0.00');
		$sheet7->setCellValue('D3', '0.00');
		$sheet7->setCellValue('F3', '0.00');
		$sheet7->setCellValue('I3', '0.00');

		// label
		$sheet7->setCellValue('A4', 'Export Type');
		$sheet7->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('A4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('A4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->setCellValue('B4', 'Invoice Number');
		$sheet7->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('B4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('B4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->setCellValue('C4', 'Invoice date');
		$sheet7->getStyle('C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('C4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('C4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->setCellValue('D4', 'Invoice Value');
		$sheet7->getStyle('D4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('D4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('D4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->setCellValue('E4', 'Port Code');
		$sheet7->getStyle('E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('E4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('E4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->setCellValue('F4', 'Shipping Bill Number');
		$sheet7->getStyle('F4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('F4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('F4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->setCellValue('G4', 'Shipping Bill Date');
		$sheet7->getStyle('G4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('G4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('G4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->setCellValue('H4', 'Rate');
		$sheet7->getStyle('H4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('H4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('H4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet7->setCellValue('I4', 'Taxable Value');
		$sheet7->getStyle('I4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet7->getStyle('I4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet7->getStyle('I4')->getFont()->getColor()->setRGB('FFFFFF');

		// sheet8
		$sheet8 = $this->excel->createSheet();
        $sheet8->setTitle('at');
		$sheet8->setCellValue('A1', "Summary For Advance Received \n(11B) ");
		$sheet8->setCellValue('D1', 'HELP');

		$sheet8->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet8->getStyle('A1')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet8->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet8->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet8->getStyle('A2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet8->getStyle('A2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet8->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet8->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet8->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet8->setCellValue('C2', 'Total Advance Received');
		$sheet8->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet8->getStyle('C2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet8->getStyle('C2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet8->setCellValue('D2', 'Total Cess');
		$sheet8->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet8->getStyle('D2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet8->getStyle('D2')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$sheet8->setCellValue('C3', '0.00');
		$sheet8->setCellValue('D3', '0.00');

		// label
		$sheet8->setCellValue('A4', 'Place Of Supply');
		$sheet8->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet8->getStyle('A4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet8->getStyle('A4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet8->setCellValue('B4', 'Rate');
		$sheet8->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet8->getStyle('B4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet8->getStyle('B4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet8->setCellValue('C4', 'Gross Advance Received');
		$sheet8->getStyle('C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet8->getStyle('C4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet8->getStyle('C4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet8->setCellValue('D4', 'Cess Amount');
		$sheet8->getStyle('D4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet8->getStyle('D4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet8->getStyle('D4')->getFont()->getColor()->setRGB('FFFFFF');

		// sheet 9
		$sheet9 = $this->excel->createSheet();
        $sheet9->setTitle('atadj');
		$sheet9->setCellValue('A1', "Summary For Advance Adjusted\n (11B) ");
		$sheet9->setCellValue('D1', 'HELP');

		$sheet9->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet9->getStyle('A1')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet9->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet9->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet9->getStyle('A2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet9->getStyle('A2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet9->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet9->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet9->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet9->setCellValue('C2', 'Total Advance Adjusted');
		$sheet9->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet9->getStyle('C2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet9->getStyle('C2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet9->setCellValue('D2', 'Total Cess');
		$sheet9->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet9->getStyle('D2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet9->getStyle('D2')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$sheet9->setCellValue('C3', '0.00');
		$sheet9->setCellValue('D3', '0.00');

		// label
		$sheet9->setCellValue('A4', 'Place Of Supply');
		$sheet9->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet9->getStyle('A4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet9->getStyle('A4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet9->setCellValue('B4', 'Rate');
		$sheet9->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet9->getStyle('B4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet9->getStyle('B4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet9->setCellValue('C4', 'Gross Advance Adjusted');
		$sheet9->getStyle('C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet9->getStyle('C4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet9->getStyle('C4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet9->setCellValue('D4', 'Cess Amount');
		$sheet9->getStyle('D4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet9->getStyle('D4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet9->getStyle('D4')->getFont()->getColor()->setRGB('FFFFFF');

		// sheet 10
		$sheet10 = $this->excel->createSheet();
        $sheet10->setTitle('exemp');
		$sheet10->setCellValue('A1', "Summary For Nil rated, exempted and non GST\n outward supplies (8)");
		$sheet10->setCellValue('D1', 'HELP');

		$sheet10->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet10->getStyle('A1')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet10->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet10->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet10->getStyle('A2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet10->getStyle('A2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet10->setCellValue('B2', 'Total Nil Rated Supplies');
		$sheet10->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet10->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet10->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet10->setCellValue('C2', 'Total Exempted Supplies');
		$sheet10->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet10->getStyle('C2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet10->getStyle('C2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet10->setCellValue('D2', 'Total Non-GST Supplies');
		$sheet10->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet10->getStyle('D2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet10->getStyle('D2')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$sheet10->setCellValue('B3', '0.00');
		$sheet10->setCellValue('C3', '0.00');
		$sheet10->setCellValue('D3', '0.00');

		// label
		$sheet10->setCellValue('A4', 'Description');
		$sheet10->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet10->getStyle('A4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet10->getStyle('A4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet10->setCellValue('B4', 'Nil Rated Supplies');
		$sheet10->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet10->getStyle('B4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet10->getStyle('B4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet10->setCellValue('C4', 'Exempted (other than nil rated/non\n GST supply )');
		$sheet10->getStyle('C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet10->getStyle('C4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet10->getStyle('C4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet10->setCellValue('D4', 'Non-GST supplies');
		$sheet10->getStyle('D4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet10->getStyle('D4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet10->getStyle('D4')->getFont()->getColor()->setRGB('FFFFFF');

		// sheet 11
		$sheet11 = $this->excel->createSheet();

		for ($col = 'A'; $col != 'L'; $col++) { 
			$sheet11->getColumnDimension($col)->setAutoSize(true); 
		}

        $sheet11->setTitle('hsn');
		$sheet11->setCellValue('A1', "Summary For HSN(12)");
		$sheet11->setCellValue('J1', 'HELP');

		$sheet11->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('A1')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet11->setCellValue('A2', 'No. of HSN');
		$sheet11->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('A2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('A2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet11->setCellValue('C2', 'Total Exempted Supplies');
		$sheet11->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('C2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('C2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet11->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('D2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('D2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('E2', 'Total Value');
		$sheet11->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('E2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('E2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('F2', 'Total Taxable Value');
		$sheet11->getStyle('F2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('F2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('F2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('G2', 'Total Integrated Tax');
		$sheet11->getStyle('G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('G2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('G2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('H2', 'Total Central Tax');
		$sheet11->getStyle('H2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('H2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('H2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('I2', 'Total State/UT Tax');
		$sheet11->getStyle('I2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('I2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('I2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('J2', 'Total Cess');
		$sheet11->getStyle('J2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('J2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('J2')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$sheet11->setCellValue('A3', '1');
		$sheet11->setCellValue('E3', round($totalAmountB2b,2));
		$sheet11->setCellValue('F3', round($totalAmountB2b,2));
		$sheet11->setCellValue('G3', '0.00');
		$sheet11->setCellValue('H3', '0.00');
		$sheet11->setCellValue('I3', '0.00');
		$sheet11->setCellValue('J3', '0.00');

		// label
		$sheet11->setCellValue('A4', 'HSN');
		$sheet11->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('A4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('A4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('B4', 'Description');
		$sheet11->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('B4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('B4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('C4', 'UQC');
		$sheet11->getStyle('C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('C4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('C4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('D4', 'Total Quantity');
		$sheet11->getStyle('D4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('D4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('D4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('E4', 'Total Value');
		$sheet11->getStyle('E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('E4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('E4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('F4', 'Taxable Value');
		$sheet11->getStyle('F4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('F4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('F4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('G4', 'Integrated Tax Amount');
		$sheet11->getStyle('G4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('G4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('G4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('H4', 'Central Tax Amount');
		$sheet11->getStyle('H4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('H4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('H4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('I4', 'State/UT Tax Amount');
		$sheet11->getStyle('I4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('I4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('I4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet11->setCellValue('J4', 'Cess Amount');
		$sheet11->getStyle('J4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet11->getStyle('J4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet11->getStyle('J4')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$sheet11->setCellValue('A5', '9965');
		$sheet11->setCellValue('B5', 'Goods Transport services');
		$sheet11->setCellValue('C5', 'NA');
		$sheet11->setCellValue('D5', '0');
		$sheet11->setCellValue('E5', round($totalAmountB2b5,2));
		$sheet11->setCellValue('F5', round($totalAmountB2b5,2));
		$sheet11->setCellValue('G5', '0');
		$sheet11->setCellValue('H5', '0');
		$sheet11->setCellValue('I5', '0');
		$sheet11->setCellValue('J5', '0');

		$sheet11->setCellValue('A6', '9965');
		$sheet11->setCellValue('B6', 'Goods Transport services');
		$sheet11->setCellValue('C6', 'NA');
		$sheet11->setCellValue('D6', '0');
		$sheet11->setCellValue('E6', round($totalAmountB2b12,2));
		$sheet11->setCellValue('F6', round($totalAmountB2b12,2));
		$sheet11->setCellValue('G6', '0');
		$sheet11->setCellValue('H6', '0');
		$sheet11->setCellValue('I6', '0');
		$sheet11->setCellValue('J6', '0');

		// sheet 12
		$sheet12 = $this->excel->createSheet();

		for ($col = 'A'; $col != 'L'; $col++) { 
			$sheet12->getColumnDimension($col)->setAutoSize(true); 
		}
        $sheet12->setTitle('docs');
		$sheet12->setCellValue('A1', "Summary of documents issued during the tax period (13)");
		$sheet12->setCellValue('E1', 'HELP');

		$sheet12->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet12->getStyle('A1')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet12->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');
		

		$sheet12->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet12->getStyle('A2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet12->getStyle('A2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet12->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet12->getStyle('B2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet12->getStyle('B2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet12->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet12->getStyle('C2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet12->getStyle('C2')->getFont()->getColor()->setRGB('FFFFFF');
		
		$sheet12->setCellValue('D2', 'Total Number');
		$sheet12->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet12->getStyle('D2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet12->getStyle('D2')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet12->setCellValue('E2', 'Total Cancelled');
		$sheet12->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet12->getStyle('E2')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet12->getStyle('E2')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$sheet12->setCellValue('D3', count($data['filterArray']));
		$sheet12->setCellValue('E3', '0.00');

		// label
		$sheet12->setCellValue('A4', 'Nature  of Document');
		$sheet12->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet12->getStyle('A4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet12->getStyle('A4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet12->setCellValue('B4', 'Sr. No. From');
		$sheet12->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet12->getStyle('B4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet12->getStyle('B4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet12->setCellValue('C4', 'Sr. No. To');
		$sheet12->getStyle('C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet12->getStyle('C4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet12->getStyle('C4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet12->setCellValue('D4', 'Total Number');
		$sheet12->getStyle('D4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet12->getStyle('D4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet12->getStyle('D4')->getFont()->getColor()->setRGB('FFFFFF');

		$sheet12->setCellValue('E4', 'Cancelled');
		$sheet12->getStyle('E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$sheet12->getStyle('E4')->getFill()->getStartColor()->setRGB('4472C4');
		$sheet12->getStyle('E4')->getFont()->getColor()->setRGB('FFFFFF');

		// dynamic value
		$colValueDocs = 5;

		for ($i=0; $i < count($data['filterArray']); $i++) {
			$sheet12->setCellValue('A'.($colValueDocs+$i), 'Invoices for outward supply');
			$sheet12->setCellValue('B'.($colValueDocs+$i), $data['filterArray'][$i]['OrderGstInvoice']);
			$sheet12->setCellValue('C'.($colValueDocs+$i), $data['filterArray'][$i]['OrderGstInvoice']);
			$sheet12->setCellValue('D'.($colValueDocs+$i), 1);
			$sheet12->setCellValue('E'.($colValueDocs+$i), 0);
		}


		$filename='gstrb1_report_'.time().'.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');

		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		$objWriter->save('php://output');
   	}
	// sjr end

   	//samundra add controller for pallet wise report 05-06-2021
   	public function PalletReport($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tbldealer";
    	   $keyName="Dealer";
    	   $data['tableName']="tbldealer";
    	   $data['tblName']="dealer";
    	   $data['pageLink']="Admin/PalletReportView";
    	   $data['pageName']="Dealer";
    	   $data['page']="dealer";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
    	   
    	    //$data['Fields']=$this->mm->get_table_heading($tblName);
     	    //$data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
           // print_r($data['mainData']);
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
           //$data['Data']=convert_object_arraY($this->mm->custom_query("SELECT SubcategoryName FROM tblsubcategory"));
        //	$data = $this->mm->custom_query('SELECT SubcategoryName FROM tblsubcategory');

        	$this->new_comman_view_different($data);
        }
   	}
   	//samundra end
   	//samundar add for company rougth 16-03-2021
   	public function CompanyDifferent($id='')
   	{
   	   
		if($this->session->AdminId)
		{
			$tblName="tblcompany";
			$keyName="Company";
			$data['tableName']="tblcompany";
			$data['tblName']="company";
			$data['pageLink']="Admin/CompanyView"; 
			$data['pageName']="Company";
			$data['page']="Company";
			// check_p($tblName);
       	    	
       	   	
			$data['Fields']=$this->mm->get_table_heading($tblName);
			$data['OriginalFields']=$data['Fields'];
			$data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
		
		
			$data['Fields']=$this->mm->get_table_heading($tblName);
			$data['OriginalFields']=$data['Fields'];
		
			
			$data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
			$whereInfo['InformationInfo']=0;
			$data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
			//$data['Data']=convert_object_arraY($this->mm->custom_query("SELECT SubcategoryName FROM tblsubcategory"));
        
        	$this->new_comman_view_different($data);
        }
		else if($this->session->EmployeeId)
		{
			$tblName="tblcompany";
			$keyName="Company";
			$Id='CompanyCode';
			$data['tableName']="tblcompany";
			$data['tblName']="company";
			$data['pageLink']="Admin/CompanyView";
			$data['pageName']="Company";
			$data['page']="Company";
			// check_p($tblName);
       		$data['Fields']=$this->mm->get_table_heading($tblName);
			//remove element from array
			unset($data['Fields'][2]);
			//check_p($data);

			$data['OriginalFields']=$data['Fields'];
			$data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
			//$data['Fields']=$this->mm->get_table_heading($tblName);
			//$data['OriginalFields']=$data['Fields'];
			$data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
			$whereInfo['InformationInfo']=0;
			$data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
			//$data['Data']=convert_object_arraY($this->mm->custom_query("SELECT SubcategoryName FROM tblsubcategory"));
        
        	$this->new_comman_view_different($data);
        
		}
		else{
			$this->load->view('Admin/login');
		}
		
   	}
   	//samundar
   	//nilesh 12/2/2021 productdetail view page
   		public function ProductdetailDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	     // check_p($tblName);
       	    	
       	   $tblName="tblproductdetail";
    	   $keyName="Productdetail";
    	   $data['tableName']="tblproductdetail";
    	   $data['tblName']="productdetail";
    	   $data['pageLink']="Admin/ProductdetailView";
    	   $data['pageName']="Product";
    	   $data['page']="product";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
            //nilesh 13/2/2021
          //  $data['ProductData']=convert_object_arraY($this->mm->custom_query("SELECT * FROM(( tblproductdetail INNER JOIN tblpacking ON tblproductdetail.PackingId = tblpacking.PackingId)INNER JOIN tblproduct ON tblproductdetail.ProductIdReference = tblproduct.ProductId)"));
        
           //$data['Data']=convert_object_arraY($this->mm->custom_query("SELECT SubcategoryName FROM tblsubcategory"));
        //	$data = $this->mm->custom_query('SELECT SubcategoryName FROM tblsubcategory');
           // check_p($data);
        	$this->new_comman_view_different($data);
        }
   	}
   	
   		public function AddProductDifferent($id='')
   	{
   	    if(!($this->session->AdminId or $this->session->EmployeeId))
		{
			$this->load->view('Admin/login');
		}
		else
		{
       	 //     check_p($tblName);
       	    	
       	   $tblName="tblproduct";
    	   $keyName="Product";
    	   $data['tableName']="tblproduct";
    	   $data['tblName']="product";
    	   $data['pageLink']="Admin/AddProductView";
    	   $data['pageName']="Product";
    	   $data['page']="Product";
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
 	        $data['OriginalFields']=$data['Fields'];
 	        $data['ajaxSucessData']=ajax_success_data($data['OriginalFields']);
 	    
    	   
    	    $data['Fields']=$this->mm->get_table_heading($tblName);
     	    $data['OriginalFields']=$data['Fields'];
     	    
       	    
            $data['mainData']=convert_object_arraY($this->mm->get_all_data_join($tblName));
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
        	
        	$this->new_comman_view_different($data);
        }
   	}
 /*	public function  index_header() //comman header comman_header here
 	{
    	$data['page']='Dashboard';
    	//check_p($this->session->AdminLevelId);
    	if($this->session->AdminLevelId)
    	{
    	    //new updated code 4/17/2019 rajesh sir
    	   $where['tblrights.LevelId']=$this->session->AdminLevelId;
    	   //check_p($where);
    	   $column="RightsTabledropdown";
    	   $data['tableNameData']=remove_multi_array_append_data_convert_lower(convert_object_arraY($this->mm->get_a_data_join_a_column('tblrights',$where,$column)),'tbl');
    	   //check_p($data['tableNameData']);
    	   //$data['countData']=$this->mm->get_total_no_of_data($data['tableNameData']);
 	 	   
    	   $data['NoOfcustomer']=$this->mm->count_data('tblcustomer');
            $data['NoOfOrder']=$this->mm->count_data('tblorder');
            $data['NoOfProduct']=$this->mm->count_data('tblproduct');
            $select="OrderTotal";
            $totSales=$this->mm->total_data('tblorder',$select);
            $data['TotalSales']=$totSales[0]->OrderTotal;
            
            $select="OrderTotal";
            $totSales=$this->mm->total_data('tblorder',$select);
            if($data['NoOfOrder']!=0)
            {   $data['TotalAVGSales']=(($totSales[0]->OrderTotal)/($data['NoOfOrder']));
            }
            else
            {   $data['TotalAVGSales']=0;
            }
            $select="OrderTotal";
            $whereData["OrderDate"]=date('Y-m-d');
            $totSales=$this->mm->total_data('tblorder',$select,$whereData);
            $data['TodayTotalSales']=$totSales[0]->OrderTotal;
            
            $whereData["OrderDate"]=date('Y-m-d');
            $totSalesOrder=$this->mm->count_data('tblorder',$whereData);
            $data['TodayTotalOrder']=$totSalesOrder;
    
            $whereInfo['InformationInfo']=0;
            $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
            return $data;
        
    	}
    	else
    	{
    	    $data['tableNameData']=$this->mm->get_all_table_heading();
    	}
 	 	$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
 	    return $data;
 	}*/
 	//nilesh
 	public function  index_header() //comman header comman_header here
 	{
    	$data['page']='Dashboard';
    	//check_p($this->session->AdminLevelId);
    	if($this->session->AdminLevelId)
    	{
    	    //new updated code 4/17/2019 rajesh sir
    	   $where['tblrights.LevelId']=$this->session->AdminLevelId;
    	   //check_p($where);
    	   $column="RightsTabledropdown";
    	   $data['tableNameData']=remove_multi_array_append_data_convert_lower(convert_object_arraY($this->mm->get_a_data_join_a_column('tblrights',$where,$column)),'tbl');
    	   //kd jenita custom sidebar
    	$sideBarMainData=convert_object_arraY($this->mm->get_all_data_join('tblsidebar'));
    	//new sidebar for jenita
 	 	$data['sidebarMainData']=$sideBarMainData;
 	 	
    	   //check_p($data['tableNameData']);
    	   //$data['countData']=$this->mm->get_total_no_of_data($data['tableNameData']);
 	 	   
    	   
    	}
    	else
    	{
    	    $data['tableNameData']=$this->mm->get_all_table_heading();
    	}
 	 	$data['sidebarData']=array_map('ucfirst',str_replace('tbl','',$data['tableNameData']));
 	 	// $data['NoOfcustomer']=$this->mm->count_data('tblconsignor');
        //$data['NoOfManufacturer']=$this->mm->count_data('tblmanufacturer');
        // $data['NoOfOrder']=$this->mm->count_data('tblorder');
        // $data['NoOfProduct']=$this->mm->count_data('tblproduct');
        ///$whereDataDOB["CustomerDateOfBirth"]=date('Y-m-d');
        
        //$data['CustomerData']=convert_object_arraY($this->mm->get_a_data_join('tblcustomer',$whereDataDOB));
            
        // $select="OrderTotal";
        // $totSales=$this->mm->total_data('tblorder',$select);
        // $data['TotalSales']=$totSales[0]->OrderTotal;
        
        // $select="OrderTotal";
        // $totSales=$this->mm->total_data('tblorder',$select);
        // if($data['NoOfOrder']!=0)
        // {   $data['TotalAVGSales']=(($totSales[0]->OrderTotal)/($data['NoOfOrder']));
        // }
        // else
        // {   $data['TotalAVGSales']=0;
        // }
        $select="OrderTotal";
        // $whereData["OrderDate"]=date('Y-m-d');
        // $totSales=$this->mm->total_data('tblorder',$select,$whereData);
        // $data['TodayTotalSales']=$totSales[0]->OrderTotal;
        //nilesh 
        //$data['ProductData']=convert_object_arraY($this->mm->custom_query("SELECT *,`SubcategoryName`, `ProductQty`-`ProductLowstock` AS `difference` FROM tblproduct INNER JOIN tblsubcategory ON tblproduct.SubcategoryId = tblsubcategory.SubcategoryId ORDER BY `difference`"));
       // $data['ProductHighestData']=convert_object_arraY($this->mm->custom_query("select P.ProductId,P.ProductName,C.SubcategoryName,MAX(O.OrderdetailQty) from tblproduct as P,tblorderdetail as O,tblsubcategory as C where P.ProductId=O.productId AND P.SubcategoryId=C.SubcategoryId group by ProductId ORDER BY O.OrderdetailQty DESC"));
       //samundar commit this 11-03-2021 $data['Data']=convert_object_arraY($this->mm->custom_query("SELECT tblorder.OrderId,tblorder.OrderCDT,tblorder.OrderStageDropDown,tblorder.OrderTotal, tblcustomer.CustomerName,tbladdress.AddressAppartmentName FROM((tblorder INNER JOIN tblcustomer  ON tblorder.CustomerId = tblcustomer.CustomerId)INNER JOIN tbladdress on tblorder.AddressId = tbladdress.AddressId) WHERE OrderDate not like DATE(NOW())"));
        // $data['Data']=convert_object_arraY($this->mm->custom_query("SELECT * FROM tblorder WHERE OrderDate not like DATE(NOW())"));  
      // $data['Data']=array();
        //check_p($data);
            
        // $whereData["OrderDate"]=date('Y-m-d');
        // $totSalesOrder=$this->mm->count_data('tblorder',$whereData);
        // $data['TodayTotalOrder']=$totSalesOrder;
        
        
        $whereInfo['InformationInfo']=0;
        $data['NoOfNotification']=$this->mm->count_data('tblinformation',$whereInfo);
 	    return $data;
 	}
 
 	//end
 	public function  index_view($data)
 	{
 	    $data['pageName']="Dashboard";
 	    $this->load->view('Admin/header',$data);
	  	$this->load->view('Admin/Sidebar',$data);
 	    $this->load->view('Admin/index1',$data);
 	    $this->load->view('Admin/footer',$data);
 	    $this->load->view('Admin/chart',$data);
	    $this->load->view('Admin/footer_view',$data);
	 
 	}
 	public function  comman_view($data) //comman view comman_view here
 	{   
 	   $data['tblName']="\"tbl".strtolower($data['page'])."\"";
 	  // check_p($data);
 	    $this->load->view('Admin/header',$data);
	  	$this->load->view('Admin/Sidebar',$data);
	  	//$this->load->view('Admin/Modal',$data);
	  	$this->load->view('Admin/'.$data['page'],$data);
 	    $this->load->view('Admin/footer',$data);    
	    $this->load->view('Admin/footer_view',$data);
	    $this->load->view('Admin/AjaxFooter',$data);
	    $this->load->view('Admin/AjaxFooterFormData',$data);
	    $this->load->view('Admin/dataTableFooter',$data);
 	}
    	public function  new_comman_view($data) //comman view comman_view here
 	{   
 	   $data['tblName']="\"tbl".strtolower($data['page'])."\"";
 	  // check_p($data);
 	    $this->load->view('Admin/header',$data);
	  	$this->load->view('Admin/Sidebar',$data);
//	  	$this->load->view('Admin/ExcelDiv',$data);
	  	//$this->load->view('Admin/Modal',$data);
	  	$this->load->view('Admin/Main',$data);
 	    $this->load->view('Admin/footer',$data);    
	    $this->load->view('Admin/AjaxFooter',$data);
	    $this->load->view('Admin/AjaxFooterFormData',$data);
	    $this->load->view('Admin/AjaxCSV',$data);
	    $this->load->view('Admin/CustomJs',$data);
	    $this->load->view('Admin/dataTableFooter',$data);
	    $this->load->view('Admin/DetailView',$data);
	
	 //   $this->load->view('Admin/footer_view',$data);
	   
 	}
 	public function  new_comman_view_different($data) //comman view comman_view here
 	{   
 	 //  $data['tblName']="\"tbl".strtolower($data['page'])."\"";
 	  // check_p($data);
 	    $this->load->view('Admin/header',$data);
	  	$this->load->view('Admin/Sidebar',$data);
        //$this->load->view('Admin/ExcelDiv',$data);
	  	//$this->load->view('Admin/Modal',$data);
	  	$this->load->view($data['pageLink'],$data);
 	    $this->load->view('Admin/footer',$data);    
	    $this->load->view('Admin/AjaxFooterDifferent',$data);
	    $this->load->view('Admin/AjaxFooterFormDataDifferent',$data);
	    //$this->load->view('Admin/AjaxCSV',$data);
	    //$this->load->view('Admin/CustomJs',$data);
	    //$this->load->view('Admin/dataTableFooter',$data);
	    $this->load->view('Admin/footer_view',$data);
	   
 	}

}
