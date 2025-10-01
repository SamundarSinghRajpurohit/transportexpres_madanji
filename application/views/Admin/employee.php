<?php
  include_once('header.php');
  $baseUrl=base_url('resources/assets/');
?>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Employee</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?=site_url('Admin/Employee/add_employee/');?>" enctype="multipart/form-data">
          <div class="modal-body row">
            <div class="form-group col-md-6">
              <label>Employee Name</label>
              <input type="text" class="form-control" placeholder="Enter EmployeenName" name="Emp_Name" required="">
            </div>
            <div class="form-group col-md-6">
              <label>Employee EmailID</label>
              <input type="text" class="form-control" placeholder="Enter Employeen EmailID" name="Emp_EmailID" required="">
            </div>
            <div class="form-group col-md-6">
              <label>Employee Password</label>
              <input type="password" class="form-control" placeholder="Enter Employeen Password" name="Emp_Password" required="">
            </div>
            <div class="form-group col-md-6">
              <label>Gender</label>
              <div class="form-group">
                <label><input type="radio" name="Emp_Gender" value="male"> Male</label>
                <label><input type="radio" name="Emp_Gender" value="female"> Female</label>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label>Contact No</label>
              <input type="text" required="" maxlength="10"a class="form-control" placeholder="Enter Employee ContactNo" name="Emp_contactNo">
            </div>
            <div class="form-group col-md-6">
              <label>Address</label>
              <textarea class="form-control" required="" placeholder="Enter Address" name="Emp_Address"></textarea>
            </div>
            <div class="form-group col-md-6">
              <label>State</label>
              <select name="StateID" id="StateID" required="" class="form-control" onchange="myFunc(this.value);">
                <option value="null">Select State</option>
                <?php
                  foreach ($State as $value) {
                    ?>
                      <option value="<?=$value->StateID;?>"><?=$value->StateName;?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>City</label>
              <select name="CityID" required="" id="CityID" class="form-control">
                <option value="null">Select City</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Employee Image</label>
              <input type="file" class="form-control" name="emp_image">
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
            <h1>Employees</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employees</li>
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
              <button type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal">Add Employee</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow:hidden;position:relative;width:100%;display:block;overflow-x:scroll;">
              <table id="example1" class="table table-bordered size table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>EmailID</th>
                  <th>Gender</th>
                  <th>Contact No</th>
                  <th>CreatedDate</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($EmployeeData as $key) {
                      ?>
                        <tr>
                          <td><?=$key->Emp_Name?></td>
                          <td><?=$key->Emp_EmailID?></td>
                          <td><?=$key->Emp_Gender?></td>
                          <td><?=$key->Emp_contactNo?></td>
                          <td><?=$key->Emp_CreatedDateTime?></td>
                          <td><?php echo $key->Emp_Status==0?'<button class="btn btn-success" type="button">Active</button>':'<button class="btn btn-danger" type="button">Blocked</button>'?>
                          </td>
                          <td>
                            <ul class="list-unstyled">
                              <li style="display: inline-block;padding-left: .5rem;">
                                <?php 
                                  if($key->Emp_Status==0){
                                    ?>
                                      <a href="<?=site_url('Admin/Employee/Employee_Status/1/'.$key->EmployeeID)?>" style="font-size: 20px;">
                                        <span data-toggle="tooltip" title="Block..?"><i class="fa fa-lock"></i></span>
                                      </a>
                                    <?php
                                  }
                                  else{
                                    ?>
                                      <a href="<?=site_url('Admin/Employee/Employee_Status/0/'.$key->EmployeeID)?>" style="font-size: 20px;">
                                        <span data-toggle="tooltip" title="Block..?"><i class="fa fa-unlock"></i></span>
                                      </a>
                                    <?php
                                  }
                                ?>
                              </li>
                              <!--<li style="display: inline-block;padding-left: .5rem;">
                                <a href="<?=site_url('Admin/Employee/del_employee/'.$key->EmployeeID);?>" style="font-size: 20px;"><i class="fa fa-trash"></i></a>
                              </li>-->
                              <li style="display: inline-block;padding-left: .5rem;">
                                <a href="<?=site_url('Admin/Employee/view_employee/'.$key->EmployeeID);?>" style="font-size: 17px;">More View</a>
                              </li>
                            </ul>
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
</div>
<!-- ./wrapper -->
<?php
  include_once('footer_view.php');
  include_once('footer.php');

?>  

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
  $(function(){
    $('#StateID').on('change',function(){
      $.ajax({
        url:"<?=site_url('Admin/Employee/get_city/')?>"+$(this).val(),
        success:function(result){
          $('#CityID').html(result);
        }
      });
    });
  })
</script>
</body>
</html>
