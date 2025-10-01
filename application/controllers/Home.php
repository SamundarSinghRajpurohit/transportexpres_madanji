<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('custom_helper');
		$set['upload_path']='./resources/images/';
		$set['allowed_types']='png|jpg|gif|jpeg';
		$this->load->library('upload',$set);
		$this->load->model('MainModelUser','mm');
	//	$this->load->library('form_validation');
	
//		$this->load->library('session');
	}
	public function AboutUs()
	{
	    $data=$this->comman_header_help();
         $this->comman_view_YSH_NS($data);
	}
    public function ContactUs()
	{   
	    $data=$this->comman_header_help();
    	$this->comman_view_YSH_NS($data);
	}
	public function Careers()
	{   
	    $data=$this->comman_header_help();
	    $data['employee']=$this->mm->get_all_active_data_join('tblemployee');
        $data['bodycss']="rightsidebar";
    	$this->comman_view_YSH_NS($data);
	}
	public function CompanyOverview()
	{   
	    $data=$this->comman_header_help();
    	$data['bodycss']="rightsidebar";
    	$this->comman_view_YSH_NS($data);
	}
	public function CompanyHistory()
	{   
	    $data=$this->comman_header_help();
    	$data['bodycss']="rightsidebar";
    	$this->comman_view_YSH_NS($data);
	}
	public function MissionVision()
	{   
	    $data=$this->comman_header_help();
    	$data['bodycss']="rightsidebar";
    	$this->comman_view_YSH_NS($data);
	}
	public function CompanyApproach()
	{   
	    $data=$this->comman_header_help();
    	$data['bodycss']="rightsidebar";
    	$this->comman_view_YSH_NS($data);
	}
/*	public function Mission()
	{   
	    $data=$this->comman_header_help();
    	$data['bodycss']="rightsidebar";
    	$this->comman_view_YSH_NS($data);
	}
*/
	public function OurTeamList()
	{   
	    $data=$this->comman_header_help();
    	$data['bodycss']="rightsidebar";
    	$this->comman_view_YSH_NS($data);
	}
	public function Blog()
	{   
	    $data=$this->comman_header_help();
	    $data['article']=$this->mm->get_all_active_data_join('tblarticle');
        $data['bodycss']="rightsidebar";
    	$this->comman_view_YSH_NS($data);
	}
	public function OurExpertise()
	{   
	    $data=$this->comman_header_help();
    	$this->comman_view_YSH_NS($data);
	}
	
	public function Service()
	{   
	    $data=$this->comman_header_help();
    	$this->comman_view_YSH_NS($data);
	}


	public function Test($data='')
	{   
	    check_p($data);
	    $data=$this->comman_header_help();
    	$this->comman_view_YSH_NS($data);
	}
	public function index($indexData='')
	{
	 //   check_p($indexData);
	    
	    $data=$this->comman_header_help();
    /*	$data['slider']=$this->mm->get_all_active_data('tblslider');
    	$data['article']=$this->mm->get_all_active_data_join('tblarticle');
        $data['gallery']=$this->mm->get_all_active_data_join('tblgallery');
     */  
     // $this->load->view('headerscript',$data);
/*	    $this->load->view('topbar',$data);
	    $this->load->view('header',$data);
		$this->load->view('slider',$data);
		$this->load->view('index',$data);
	    $this->load->view('footer',$data);
		$this->load->view('footerscript',$data);*/
 	}
 	public function Product($searchData = '')
	{
	
	    $data=$this->comman_header_help();
    	 $data['bodycss']="rightsidebar";
    	 
    	$data['product']=$this->mm->get_all_active_data_join('tblproduct');
        $this->comman_view_YSH_NS($data);
	}
 	public function gallery()
	{
	    $data=$this->comman_header_help();
    	$this->comman_view_YSH_NS($data);
 	}
    public function  NewsAndEvents()
	{
	    $data=$this->comman_header_help();
	    $data['article']=$this->mm->get_all_active_data_join('tblarticle');
        $data['bodycss']="rightsidebar";
    	
    	$this->comman_view_YSH_NS($data);
 	}
   public function  GlobalPresense()
	{
	    $data=$this->comman_header_help();
	    $data['article']=$this->mm->get_all_active_data_join('tblarticle');
        $data['bodycss']="rightsidebar";
    	
    	$this->comman_view_YSH_NS($data);
 	}
 	public function  comman_header_help() //  comman_header_help here comman header help
 	{ 
 	    $data= contact_us();
 	    $data['pageName']=$this->router->fetch_method().detail_page_name();
 	   // check($data);
 	    $data['quickLinks']=array('APIs'=>'#',
 	                        'Intermediates'=>'#',
 	                        'Formulations'=>'',
 	                         'Global Presence'=>'',
 	                         'Career'=>'');
 	    $data['link']=array('FaceBook'=>'https://www.facebook.com/onpharno/',
 	                        'Instagram'=>'#',
 	                        'Linked In'=>'https://www.linkedin.com/in/onpharno-lifesciences-783223b9?trk=hp-identity-name',
 	                        'Twitter'=>'#',
 	                        'Whatsapp'=>'#',
 	                        'Gmail'=>' onpharno.lifesciences@gmail.com',
 	                        'Blog'=>'#');
 	    
 	    $data['mainSidebar']=array('AboutUs'=>'Company Overview',
                                   'CompanyHistory'=>'Company History',
                                    'MissionVision'=>'Mission & Vission',
                                   // 'Vision'=>'Vision',
                                    'CompanyApproach'=>'Our Approach',
                                    'GlobalPresense'=>'Global Presense',
                                    'OurTeamList'=>'Our Team List');
        $aboutUs=array('AboutUs'=>'Company Overview',
                                   'CompanyHistory'=>'Company History',
                                    'MissionVision'=>'Mission & Vission',
                                   // 'Vision'=>'Vision',
                                    'CompanyApproach'=>'Our Approach',
                                    'GlobalPresense'=>'Global Presense',
                                    'OurTeamList'=>'Our Team List');
        
 	    $data['header']=array(  'Home'=>"Home",
                         	    'AboutUs'=>'About Us',
                         //	    'Our Expertise'=>$this->get_active_data_name_array('tblcategory','categoryName','OurExpertise'),
                         //	    'Product'=>$this->get_active_data_name_array('tblproduct','productName','Product'),
                         	    'News And Events'=>"News And Events",
                         	    'Careers'=>"Careers",
                         	    'ContactUs'=>"Contact Us",
                         	  );
        
 	    return $data;	
 	}
 	
 	public function  get_active_data_name_array($tblName,$fieldName,$arrayKey) // get active data name array
 	{
 	  $d=$this->mm->get_name_active_data($tblName);
 	  foreach ($d as $arrayKey=>$value) 
      {   $array[] = $value->$fieldName;
      }
   //   check_p($array);
        return  $array;
 	}
 	public function comman_view_YSH_NS($data) // with sub-header but no slider comman view YSH NS here comman_view_YSH_NS
 	{   
 	    $data['category']=$this->mm->get_name_active_data('tblcategory');
 	    $this->load->view('headerscript',$data);
	    $this->load->view('topbar',$data);
	    $this->load->view('header',$data);
		$this->load->view('subheader',$data);
		$this->load->view($data['pageName'],$data);
	    $this->load->view('footer',$data);
		$this->load->view('footerscript',$data);
 	}
 	
 	/*Admin  controllers*/
	
    public function gallery1()
	{ 
	    $name="Gallery";
        $data['page']=$name;
	    $data['gallery']=$this->mm->get_all_data('tblgallery');
	    $data['Fields']=remove_first_field($this->mm->get_table_heading('tblgallery'));
	    $data['aocolumns']=get_aocolumns_data($data['Fields']);
	    $data['category']=$this->mm->get_all_data('tblcategory');
	    /*print_r($data);
	    die();*/
		$this->load->view('Admin/gallery',$data);
 	}
}
