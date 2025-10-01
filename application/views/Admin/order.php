<?php
  include_once('header.php');
  $baseUrl=base_url('resources/assets/');
?>
  <script type="text/javascript">
      function myFunc(id) {
        //var state = document.getElementById("stateid").value;
    
        // alert(id);
        var url="<?=site_url('/Order/get_city/');?>"+id;
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
            // alert(abc.responseText);
          document.getElementById("cityid").innerHTML=abc.responseText;
          }
        }
      }
  </script>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Order</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?=site_url('/Order/Assign_Employee/');?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Employee</label>
              <select class="form-control" name="EmployeeID" id="EmployeeID" required="">
                <option value="null">Select Employee</option>
                <?php
                  foreach($EmployeeData as $key) {
                    ?>
                      <option value="<?=$key->EmployeeID?>"><?=$key->Emp_Name;?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <input type="hidden" id="OrderIDText" class="form-control" name="OrderIDText">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="btnsubmit" class="btn btn-default">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <!-- <h3 class="card-title">Data Table With Full Features</h3> -->
              <!-- <button type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal">Add Order</button> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow: hidden;overflow-x: scroll;">
              <table id="example1" class="table table-bordered table-striped" >
                <thead>
                <tr>
                  <th>OrderID</th>
                  <th>OrderDate</th>
                  <th>ProductName</th>
                  <th>ClientName</th>
                  <th>ContactNo</th>
                  <th>EmailID</th>
                  <th>Address</th>
                  <th>ProductSpecification</th>
                  <th>State</th>
                  <th>City</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($OrderData as $key) {
                      ?>
                        <tr>
                          <td><?=$key->OrderID?></td>
                          <td><?=$key->OrderDate?></td>
                          <td><?=$key->ProductName?></td>
                          <td><?=$key->Username?></td>
                          <td><?=$key->ContactNo?></td>
                          <td><?=$key->EmailID?></td>
                          <td><?=$key->Address?></td>
                          <td><?=$key->Product_Description?></td>
                          <td><?=$key->StateName?></td>
                          <td><?=$key->CityName?></td>
                          <td>
                            <?php
                              if($key->Order_Status==0){
                                 echo "<span style='background-color:yellow;padding:10px;box-shadow:0 0 10px rgba(0,0,0,.24);border-radius:10px;'>Pending</span>";
                              }
                              else if($key->Order_Status==1){
                                 echo "<span style='background-color:lightblue;padding:10px;box-shadow:0 0 10px rgba(0,0,0,.24);border-radius:10px;'>Process</span>";
                              }else if($key->Order_Status==2){
                                 echo "<span style='background-color:green;color:#eee;padding:10px;box-shadow:0 0 10px rgba(0,0,0,.24);border-radius:10px;'>Complate</span>";
                              }else{
                                echo "<span style='background-color:green;color:#eee;padding:10px;box-shadow:0 0 10px rgba(0,0,0,.24);border-radius:10px;'>Left</span>";
                              }
                            ?>
                            <?php
                                if($key->Order_Status==3){
                            ?>
                            <button type="button" class="btn btn-info btn-sm pull-right Assign_Employee"  id="<?=$key->OrderID;?>" style="margin-top: 20px;">Assign To...</button>
                            <?php
                                }
                                else{
                                    ?>
                                         <a href="<?=site_url('Order/view_employee/'.$key->OrderID);?>" class="btn btn-primary" style="margin-top: 20px;">View Assigned Employee</a>
                                    <?php
                                }
                            ?>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
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
<!-- DataTables -->
<script src="<?=$baseUrl;?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=$baseUrl;?>plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- SlimScroll -->
<script src="<?=$baseUrl;?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=$baseUrl;?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=$baseUrl;?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=$baseUrl;?>dist/js/demo.js"></script>
<!-- page script -->
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
  $('#example1').on('click','tbody .Assign_Employee',function(){
      $('#OrderIDText').val(this.id);
      $('#myModal').modal('show');
  });
</script>
</body>
</html>
