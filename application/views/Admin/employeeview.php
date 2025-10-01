<?php
  include_once('header.php');
  $baseUrl=base_url('resources/assets/');
?>

  <script type="text/javascript">
    function upadate_status(id,value) {
    
        // var compID = document.getElementById("comid").value;
    
        // alert(id);
        var url="<?=site_url('/employee_c/update/');?>"+id+'/'+value;
        // alert(url);
        var abc;
    
        if(window.XMLHttpRequest)
        {
        abc=new XMLHttpRequest();
        }
        else
        {
        abc=new ActiveXObject("Microsoft.XMLHTTP");
        }
        // alert(countryid);
        abc.open("GET",url,true);
        abc.send();
    
        abc.onreadystatechange=function() {
          if(abc.readyState==4)
          {
            // alert('Work Updated Successfully');
            // alert(abc.responseText);
          document.getElementById("complaintStatus"+value).innerHTML=abc.responseText;
          }
        }
      }
  </script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Service Department</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Service Dept</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <?php
                if(!$this->session->EmployeeID){
              ?>
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fa fa-globe"></i> Employee Information.
                      <small class="float-right">Joining Date: <?=$empData[0]->Emp_CreatedDateTime;?></small>
                    </h4>
                  </div>
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  <img src="<?=base_url('resources/images/'.$empData[0]->Emp_profile);?>" style="width:100%;height:200px;">
                </div>
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong><?=$empData[0]->Emp_Name;?></strong><br>
                    <?=$empData[0]->Emp_Address;?> , <?=$empData[0]->CityName;?>, <?=$empData[0]->StateName;?>.<br>
                    Phone: (+91)<?=$empData[0]->Emp_contactNo;?><br>
                    Email: <?=$empData[0]->Emp_EmailID;?><br>
                    Gender: <?=$empData[0]->Emp_Gender;?><br>
                  </address>
                </div>
                <div class="col-md-12">
                  <button class="btn btn-default pull-right"><?=$empData[0]->Emp_Status==0?'Active':'Blocked';?></button>
                </div>
                </div>
              <?php
              }
              ?>
              <div class="row invoice-info">
                <div class="col-md-12">
                  <div class="complaint" style="margin-top: 2rem;"> 
                    <table id="example1" class="table table-bordered">
                      <thead>
                      <tr>
                        <th>Orders</th>
                        
                      </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach ($empComplaint as $key) {
                            ?>
                              <tr>
                                <td>
                                  <div class="card" style="margin: 0;padding: 1rem;">
                                    <div class="row">
                                      <div class="heading" style="margin-bottom: 1rem;" id="complaintStatus<?=$key->OrderID?>">
                                            <?php
                                            if($key->Order_Status==0){
                                              echo '<span style="color:orange;background:white;font-weight:bold;padding:10px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,.2);">Pending</span>';
                                            }
                                            else if($key->Order_Status==1){
                                              echo '<span style="color:blue;background:white;font-weight:bold;padding:10px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,.2);">Process</span>';
                                            }
                                            else if($key->Order_Status==2){
                                              echo '<span style="color:green;background:white;font-weight:bold;padding:10px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,.2);">Complated</span>';
                                            }else if($key->Order_Status==3){
                                              echo '<span style="color:green;background:white;font-weight:bold;padding:10px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,.2);">Left</span>';
                                            }
                                          ?>
                                      </div>
                                    </div>
                                   <div class="row invoice-info">
                                      <div class="col-sm-4 invoice-col">
                                        <address>
                                          <strong>Username: <?=$key->Username;?>.</strong><br>
                                          <?=$key->Address;?>, <?=$key->Pincode?><br>
                                          Phone: (+91) <?=$key->ContactNo?><br>
                                          Email: <?=$key->EmailID;?>
                                        </address>
                                      </div>
                                      <!-- /.col -->
                                      <div class="col-sm-4 invoice-col">
                                        <address>
                                          <strong><?=$key->ProductName;?></strong><br>
                                          <?=substr($key->Product_Description, 0, 100);?>....<br>
                                          <span style="font-size: 20px;font-weight:600;">Price : <?=$key->DiscountPrice;?></span>&nbsp;<span style="text-decoration:line-through;font-size: 15px;"><?=$key->Price;?></span><br>
                                        </address>
                                      </div>
                                      <!-- /.col -->
                                      <div class="col-sm-4 invoice-col">
                                        <b>Order ID:</b> <?=$key->OrderID;?><br>
                                        <b>Order Date:</b> <?=$key->OrderDate;?><br>
                                        <?php
                                          if($this->session->EmployeeID){
                                        ?>
                                        <div style="margin-top: 2rem;">
                                          <label>Work Update</label>
                                          <select class="form-control" id="<?=$key->OrderID;?>" name="upadate_status" onchange="upadate_status(this.value,this.id);">
                                            <option value="null">Select Work Process</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Process</option>
                                            <option value="2">Complated</option>
                                          </select>
                                          <!-- <input type="text" style="display: none;" id="comid" name="comid" value="<?=$key->OrderID;?>"> -->
                                        </div>
                                        <?php
                                        }
                                        ?>
                                      </div>
                                      <!-- <div class="col-md-12">
                                        <div class="heading">
                                          <h4>Compalaint</h4>
                                        </div>
                                        <p><?=$key->Complaint?></p>
                                      </div> -->
                                      <!-- /.col -->
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            <?php
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer no-print">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-alpha
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=$baseUrl;?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=$baseUrl;?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="<?=$baseUrl;?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=$baseUrl;?>plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?=$baseUrl;?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=$baseUrl;?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=$baseUrl;?>dist/js/demo.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
