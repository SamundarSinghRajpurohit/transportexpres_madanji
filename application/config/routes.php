<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once( APPPATH .'helpers/custom_helper.php');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['Admin']='Admin/index_c';
//require_once( APPPATH .'helpers/custom_helper.php');
//through requrie once we     
     //  die();
        
    
$route['default_controller'] = 'home';
if($this->uri->segment(1)=="hello")
{
 $route["hello"]="Admin/Admin/index_c";
    
}

if($this->uri->segment(1)=="Admin")
{    
    if(check_substr($this->uri->segment(2),"Different"))
    {
        if($this->uri->segment(4))
        {
            $route["Admin/".$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4)]="Admin/Dashboard/".$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4);
        }
        else if($this->uri->segment(3))
        {
            $route["Admin/".$this->uri->segment(2).'/'.$this->uri->segment(3)]="Admin/Dashboard/".$this->uri->segment(2).'/'.$this->uri->segment(3);
        }
        else
        {
            $route["Admin/".$this->uri->segment(2)]="Admin/Dashboard/".$this->uri->segment(2);
            
        }
        
        
    }
 /*   elseif(!($this->uri->segment(2)=="Report")) 
    {
        
        $route["Admin/".$this->uri->segment(2)]="Admin/Dashboard/".$this->uri->segment(2);
    }*/
    elseif(!($this->uri->segment(2)=="Dashboard")) 
    {
        
        $route["Admin/".$this->uri->segment(2)]="Admin/Dashboard/AllMethod/".$this->uri->segment(2);
    }
    else
    {
     //   $route["Admin"]="/Admin/Dashboard/";
        
    }
   
 
}  
$route[$this->uri->segment(1)]="Home/".$this->uri->segment(1);

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*$route['AboutUs'] = "Home/AboutUs";
$route['OurExpertise'] = "Home/OurExpertise";
$route['NewsAndEvents'] = "Home/NewsAndEvents";
$route['Careers'] = "Home/Careers";
$route['Product'] = "Home/Product";
$route['ContactUs'] = "Home/ContactUs";
$route['CompanyOverview'] = "Home/CompanyOverview";
$route['OurTeamList'] = "Home/OurTeamList";
$route['CompanyHistory'] = "Home/CompanyHistory";
$route['Mission'] = "Home/Mission";
$route['Vision'] ='Home/Visionn';
//$route['Vision'] = 'Home/Vision';
$route['MissionVision'] = 'Home/MissionVision';
*/