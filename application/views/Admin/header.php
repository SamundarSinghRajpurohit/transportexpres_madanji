<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Web N AppMaker</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/plugins/datatables/dataTables.bootstrap4.css')?>">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/plugins/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/dist/css/adminlte.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/plugins/iCheck/flat/blue.css')?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/plugins/morris/morris.css')?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css')?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/plugins/datepicker/datepicker3.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/plugins/daterangepicker/daterangepicker-bs3.css')?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')?>">
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/custom.css')?>">
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script id="jqueryData">
    var result;
    function test(PassResult)
    {
        result=PassResult;
      //  alert(result);
        
    }
    
    
  </script>
    <style>
        table{
            width:500px;
            overflow:scroll;
        }    
        table {
          text-align: right;
        }

        /* loader css start */
        #loader {
            position: fixed;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Ensure it's on top of other content */
        }
        /* loader css end */
    </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- loader -->
<div id="loader" style="font-size: xx-large;display: none;">Loading...</div>
<!-- end -->
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=site_url('Admin/Dashboard')?>" class="nav-link">Home</a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">-->
      <!--  <a href="<?=site_url('Admin/ReportDifferent')?>" class="nav-link">Report</a>-->
      <!--</li>-->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=site_url('Admin/CompanyDifferent')?>" class="nav-link">Company</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <!--  <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
      </li>-->
      <!-- Messages Dropdown Menu -->
         <!--<li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            
            <div class="media">
              <img src="<?=site_url('resources/assets/dist/img/user1-128x128.jpg')?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
          
            <div class="media">
              <img src="<?=site_url('resources/assets/dist/img/user8-128x128.jpg')?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="<?=site_url('resources/assets/dist/img/user3-128x128.jpg')?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>-->
      <!-- Notifications Dropdown Menu -->
      <!-- samu-->
      <a class="nav-link"  href="<?=site_url('/Admin/Dashboard/MobileNotificationDifferent')?>">
            <i class="fa fa-bell" aria-hidden="true"></i>
             
    </a>
      <!-- end -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-book "></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Reports</span>
          <div class="dropdown-divider"></div>
            <a href="<?=site_url('Admin/Dashboard/DealerReport')?>" class="dropdown-item">
                <i class="fa fa-user  mr-2"></i>Dealer Report
            </a>
             <a href="<?=site_url('Admin/Dashboard/PalletReport')?>" class="dropdown-item">
                <i class="fa fa-sticky-note  mr-2"></i>Pallet Report
            </a>
            <a href="<?=site_url('Admin/Dashboard/TempoReport')?>" class="dropdown-item">
                <i class="fa fa-sticky-note  mr-2"></i>Tempo Report
            </a>
            <!-- sjr add new report for gstrb-1 report 12-01-2024 -->
            <a href="<?=site_url('Admin/Dashboard/Gst1rbReportDifferent')?>" class="dropdown-item">
                <i class="fa fa-sticky-note  mr-2"></i>Gstrb-1 Report
            </a>
            <!-- sjr end -->
            <a href="<?=site_url('Admin/Dashboard/CompanyReport')?>" class="dropdown-item">
                <i class="fa fa-sticky-note  mr-2"></i>Companies Report
            </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Of the Above</a>
        </div>
      </li>
      
      <li class="nav-item">
            <a  class="nav-link" href="<?=site_url('Admin/Dashboard/logout')?>">Logout</a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->