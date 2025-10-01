<?php
  include_once('header.php');
  $baseUrl=base_url('resources/assets/');
?>
  <script type="text/javascript">
      function myFunc(id) {
        //var state = document.getElementById("stateid").value;
    
        // alert(id);
        var url="<?=site_url('/product_c/get_city/');?>"+id;
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
              <button type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal">Add Order</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="<?=site_url('/product_c/update_product/'.$Orders[0]->OrderID);?>" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label>ProductName</label>
                    <input type="text" class="form-control" value="<?=$Orders[0]->ProductName?>" name="ProductName" required="">
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" value="<?=$Orders[0]->Username?>" name="Username" required="">
                  </div>
                  <div class="form-group">
                    <label>ContactNo</label>
                    <input type="text" class="form-control" value="<?=$Orders[0]->ContactNo?>"  name="ContactNo" required="">
                  </div>
                  <div class="form-group">
                    <label>EmailID</label>
                    <input type="text" class="form-control" value="<?=$Orders[0]->EmailID?>"  name="EmailID" required="">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="Address" required=""><?=$Orders[0]->Address?></textarea>
                  </div>
                   <div class="form-group">
                    <label>TrackingNumber</label>
                    <input type="text" class="form-control" value="<?php if($Orders[0]->TrackingNumber!=0){ echo $Orders[0]->TrackingNumber;}?>" name="TrackingNumber" required="">
                  </div>
                  <div class="form-group">
                    <label>ProductSpecification</label>
                    <textarea class="form-control" name="ProductSpecification" required=""><?=$Orders[0]->ProductSpecification?></textarea>
                  </div>
                  <div class="form-group">
                    <label>State</label>
                    <select class="form-control" name="StateID" onchange="myFunc(this.value)">
                      <option value="<?=$Orders[0]->StateID?>">Select State</option>
                      <?php
                        foreach ($StateData as $key) {
                          ?>
                            <option value="<?=$key->StateID?>"><?=$key->StateName;?></option>
                          <?php
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>City</label>
                    <select class="form-control" name="CityID" id="cityid">
                      <option value="<?=$Orders[0]->CityID?>">Select City</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="btnsubmit" class="btn btn-default pull-right">Submit</button>
                </div>
              </form>
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
</script>
</body>
</html>
