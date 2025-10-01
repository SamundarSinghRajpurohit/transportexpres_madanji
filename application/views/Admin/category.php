    <?php
  $baseUrl=base_url('resources/assets/');
?>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?=site_url('Admin/Category/add_Category/');?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Category Name</label>
              <input type="text" class="form-control" placeholder="Enter CategoryName" name="CategoryName" required="">
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
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
              <button type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal">Add Category</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow:hidden;position:relative;width:100%;display:block;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>CategoryName</th>
                  <th>CreatedDate</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($CategoryData as $key) {
                      ?>
                        <tr>
                          <td><?=$key->CategoryName?></td>
                          <td><?=$key->CreatedDateTime?></td>
                          <td><?php echo $key->Status==0?'<button class="btn btn-success" type="button">Active</button>':'<button class="btn btn-danger" type="button">Blocked</button>'?>
                          </td>
                          <td>
                            <ul class="list-unstyled">
                              <li style="display: inline-block;padding-left: .5rem;">
                                <?php 
                                  if($key->Status==0){
                                    ?>
                                      <a href="<?=site_url('Admin/Category/Category_Status/1/'.$key->CategoryID)?>" style="font-size: 20px;">
                                        <span data-toggle="tooltip" title="Block..?"><i class="fa fa-lock"></i></span>
                                      </a>
                                    <?php
                                  }
                                  else{
                                    ?>
                                      <a href="<?=site_url('Admin/Category/Category_Status/0/'.$key->CategoryID)?>" style="font-size: 20px;">
                                        <span data-toggle="tooltip" title="Block..?"><i class="fa fa-unlock"></i></span>
                                      </a>
                                    <?php
                                  }
                                ?>
                              </li>
                            <!--  <li style="display: inline-block;padding-left: .5rem;">
                                <a href="<?=site_url('Admin/Category/del_Category/'.$key->CategoryID);?>" style="font-size: 20px;"><i class="fa fa-trash"></i></a>
                              </li>
                            --></ul>
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
<?php
    include_once('footer.php');
?>
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
        url:"<?=site_url('Category/get_city/')?>"+$(this).val(),
        success:function(result){
          $('#CityID').html(result);
        }
      });
    });
  })
</script>
</body>
</html>
