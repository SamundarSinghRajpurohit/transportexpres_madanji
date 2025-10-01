<?php
  include_once('header.php');
  $baseUrl=base_url('resources/assets/');
?>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Service</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?=site_url('Admin/Service/add_Product/');?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Service Name</label>
              <input type="text" class="form-control" placeholder="Enter ServiceName" name="ServiceName" required="">
            </div>
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" id="CatData" name="CategoryID" required="">
                <option value="null">Select Category</option>
                <?php
                  foreach ($CategoryData as $key) {
                    ?>
                      <option value="<?=$key->CategoryID;?>"><?=$key->CategoryName;?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="text" class="form-control" placeholder="Enter Price" name="Price" required="">
            </div>
            <div class="form-group">
              <label>Discount Price</label>
              <input type="text" class="form-control" placeholder="Enter DiscPrice" name="DiscPrice" required="">
            </div>
            <div class="form-group">
              <label>Service Image</label>
              <input type="file" class="form-control" name="ServiceImg" required="">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" placeholder="Enter Description" name="Description" required=""></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="btnsubmit" class="btn btn-default">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Update Service</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?=site_url('/Service/update_Product/');?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Service Name</label>
              <input type="text" class="form-control" id="ServiceName" placeholder="Enter ServiceName" name="ServiceName" required="">
              <input type="hidden" name="proIdText" id="proIdText" class="form-control">
            </div>
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="CategoryID" id="CategoryID" required="">
                <option value="null" id="CatText">Select Category</option>
                <?php
                  foreach ($CategoryData as $key) {
                    ?>
                      <option value="<?=$key->CategoryID;?>"><?=$key->CategoryName;?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="text" class="form-control" id="Price" placeholder="Enter Price" name="Price" required="">
            </div>
            <div class="form-group">
              <label>Discount Price</label>
              <input type="text" class="form-control" id="DiscPrice" placeholder="Enter DiscPrice" name="DiscPrice" required="">
            </div>
            <div class="form-group">
              <label>Service Image</label>
              <input type="file" class="form-control" id="ServiceImg" name="ServiceImg">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" placeholder="Enter Description" id="Description" name="Description" required=""></textarea>
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
            <h1>Service</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Service</li>
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
              <button type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal">Add Service</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow:hidden;position:relative;width:100%;display:block;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ProductName</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Discount Price</th>
                  <th>Product_Description</th>
                  <th>Product_CreatedDateTime</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($ProductData as $key) {
                      ?>
                        <tr>
                          <td><?=$key->ProductName?></td>
                          <td><?=$key->CategoryName?></td>
                          <td><img src="<?=base_url('resources/images/'.$key->Product_Image)?>" style="height: 10%;width: 100%;"></td>
                          <td><?=$key->Price?></td>
                          <td><?=$key->DiscountPrice?></td>
                          <td><?=$key->Product_Description?></td>
                          <td><?=$key->Product_CreatedDateTime?></td>
                          <td><?php echo $key->Status==0?'<button class="btn btn-success" type="button">Active</button>':'<button class="btn btn-danger" type="button">Blocked</button>'?>
                          </td>
                          <td>
                            <ul class="list-unstyled">
                              <li style="display: inline-block;padding-left: .5rem;">
                                <?php 
                                  if($key->Status==0){
                                    ?>
                                      <a href="<?=site_url('/Service/Service_Status/1/'.$key->ProductID)?>" style="font-size: 20px;">
                                        <span data-toggle="tooltip" title="Block..?"><i class="fa fa-lock"></i></span>
                                      </a>
                                    <?php
                                  }
                                  else{
                                    ?>
                                      <a href="<?=site_url('/Service/Service_Status/0/'.$key->ProductID)?>" style="font-size: 20px;">
                                        <span data-toggle="tooltip" title="Block..?"><i class="fa fa-unlock"></i></span>
                                      </a>
                                    <?php
                                  }
                                ?>
                              </li>
                              <li style="display: inline-block;padding-left: .5rem;">
                                <a id="<?=$key->ProductID?>" class="update_product" style="font-size: 20px;"><i class="fa fa-edit"></i></a>
                              </li>
                              <!-- <li style="display: inline-block;padding-left: .5rem;">
                                <a href="<?=site_url('/Service/del_Service/'.$key->ProductID);?>" style="font-size: 20px;"><i class="fa fa-edit"></i></a>
                              </li> -->
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
  $(function(){
    $('#example1').on('click','tbody .update_product',function(){
      $('#proIdText').val(this.id);
      $('#myModal1').modal('show');
      $.ajax({
        url:"<?=site_url('Service/Service_Data/')?>"+this.id,
        success:function(result){
          var res = JSON.parse(result);
          $('#ServiceName').val(res.ProductName);
          $('#Price').val(res.Price);
          $('#DiscPrice').val(res.DiscountPrice);
          $('#Description').val(res.Product_Description);
          $('#ServiceImg').val(res.Product_Image);
        }
      });
      $.ajax({
        url:"<?=site_url('Service/Cat_data/')?>"+this.id,
        success:function(result){
            $('#CategoryID').html(result);
        }
      })
    });
  })
</script>
</body>
</html>
