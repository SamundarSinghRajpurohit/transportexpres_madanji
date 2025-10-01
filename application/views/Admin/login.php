<?php  $baseUrl=base_url('resources/assets/'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TransportExpert</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
 <link rel="stylesheet" href="<?=$baseUrl?>plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$baseUrl?>dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=$baseUrl?>plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <style type="text/css">
    .input-span{
      height: 50px;
      width:50px;
      background: blue;
      display: block;
      border-radius: 50%;
      text-align: center;
      color: white;
      position: absolute;
      right: 0;
      right:.5rem;
      box-shadow: 5px 0 10px rgba(0,0,0,.2);
    }
    .input{
      height: 3.2rem;
      border-radius: 10px;
      box-shadow: 0 0 5px rgba(0,0,0,.2);
    }
  </style>
</head>

<body class="hold-transition login-page">
<div class="login-box" style="margin:auto  !important;">
           
    <!--<a href="</?=COMPANY_LINK?>"><b></?php echo  COMPANY_NAME ?></b> </a>-->
  <!-- /.login-logo -->
  <div class="card">
    <div class="text-center">
      <h3>TRANPORT EXPERT</h3>
    </div>
    <div class="login-logo">
      <img src="<?=base_url('resources/LOGO.png')?>" style="height:30%; width:50%;" alt="AdminLTE Logo" class=" ">
    </div>
      
    <div class="card-body login-card-body ">
      <p class="login-box-msg">Employee Sign in</p>
      
      <form id="login_form_employee" method="post">
        <div class="form-group">
      </div>
        <div class="form-group has-feedback">
          <span class="fa fa-envelope form-control-feedback input-span" style="line-height: 50px;"></span>
          <input type="email" class="form-control input" name="EmployeeEmailId" placeholder="Email">
        </div>
        <div class="form-group has-feedback">
          <span class="fa fa-lock form-control-feedback input-span" style="line-height: 50px;"></span>
          <input type="password" class="form-control input" name="EmployeePassword" placeholder="Password">
        </div>
        <div class="form-group has-feedback">
          <span class="fa fa-building-o  form-control-feedback input-span" style="line-height: 50px;"></span>
          <input type="text" class="form-control input" name="CompanyCode" placeholder="Company Code">
        </div>
        <div class="form-group has-feedback">
           
          <select  class="form-control input" name="Year" id="Year">
            <option value="2021-2022">2021-2022</option>
          </select>
        </div>
        <diV class="col-md-12">
            <span id="error" style="color:red;"></span>
        </diV>
        <div class="row">
          <div class="col-6">
               <button type="button" class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#myModal" style="box-shadow: 0 0 10px rgba(0,0,0,.2);background: blue;border-radius: 5px;">Admin SingIn</button>     
          </div>
          <!-- /.col -->
          
          <div class="col-6">
            <button type="submit" name="btnsubmit" class="btn btn-primary btn-block btn-flat" style="box-shadow: 0 0 10px rgba(0,0,0,.2);background: blue;border-radius: 5px;">Employee SignIn</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog"  tabindex='-1'>
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="card-body login-card-body">
          <p class="login-box-msg">Admin Sign in</p>
          <form id="login_form_Admin" method="post">
            <div class="form-group has-feedback">
              <span class="fa fa-envelope form-control-feedback input-span" style="line-height: 50px;"></span>
              <input type="email" class="form-control input" name=AdminEmailId placeholder="Email">
            </div>
            <div class="form-group has-feedback">
              <span class="fa fa-lock form-control-feedback input-span" style="line-height: 50px;"></span>
              <input type="password" class="form-control input" name="AdminPassword" placeholder="Password">
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" name="btnsubmit" class="btn btn-primary btn-block btn-flat" style="box-shadow: 0 0 10px rgba(0,0,0,.2);background: blue;border-radius: 5px;">Admin SignIn</button>
              </div>
            </div>
          </form>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=$baseUrl?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=$baseUrl?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="<?=$baseUrl?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
<script>
    //add new excel csv  of ImportCSVForm
    $('#login_form_employee').on('submit',(function(e) {
        var formData = new FormData(this);
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:"<?=base_url('Admin/Ajax/Employeelogin')?>",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                var data1 = JSON.parse(data);
                //alert(data1.Message);
                if(data1.Message=='')
                {
                    window.location.href = "<?=base_url('Admin/Dashboard')?>";
                    //window.location.reload();
                }
                else{
                  document.getElementById('error').innerHTML = data1.Message;
                }   
        },
        });
    }));
    
    $('#login_form_Admin').on('submit',(function(e) {
        var formData = new FormData(this);
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:"<?=base_url('Admin/Ajax/login')?>",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                var data1 = JSON.parse(data);
                //alert(data1.Message);
                if(data1.Message=='')
                {
                    window.location.href = "<?=base_url('Admin/Dashboard')?>";
                    //window.location.reload();
                }
                else{
                  document.getElementById('error').innerHTML = data1.Message;
                }   
        },
        });
    }));
</script>
</body>
</html>
