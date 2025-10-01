<?php
  include_once('header.php');
  $baseUrl=base_url('resources/assets/');
?>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Complaint</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?=site_url('/user_c/add_complaint/'.$UID.'/'.$PID);?>">
          <div class="modal-body">
            <div class="form-group">
              <label>Complaint</label>
              <textarea class="form-control" required="" placeholder="Enter Complaint" name="Complaint"></textarea>
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
            <h1>Complaint</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Complaint</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal">Add complaint</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="card-body">
                    <div class="card-title" style="border-bottom:1px solid #eee;">
                      <h3>Client Information</h3>
                    </div>
                    <div class="card" style="margin-top: 1rem;">
                      <div class="user-image" style="background:#212529;width:100%;height:auto;">
                        <img src="<?=base_url('resources/images/'.$userComplaint[0]->ProfileImage);?>" style="height:100px;width:100px;position: relative;border-radius: 50%;top:2rem;left:.5rem;">
                      </div>
                      <div class="text-content" style="position: relative;left:.5rem;">
                        <p style="position: relative;left:8rem;font-size:1.5rem;"><?=$userComplaint[0]->Username;?></p>
                        <p><span><i class="fa fa-envelope"></i></span>&nbsp;&nbsp; <?=$userComplaint[0]->EmailID;?></p>
                        <p><span><i class="fa fa-phone"></i></span>&nbsp;&nbsp; <?=$userComplaint[0]->ContactNo;?></p>
                        <p><span><i class="fa fa-map-marker"></i></span>&nbsp;&nbsp; <?=$userComplaint[0]->Address;?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-8">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card-title" style="border-bottom:1px solid #eee;">
                          <h3>Product Information</h3>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="margin-top:1rem;">
                      <div class="col-md-5">
                        <img src="<?=base_url('resources/images/'.$userComplaint[0]->Product_Image);?>" style="width:100%;height:auto;">
                      </div>
                      <div class="col-sm-7">
                        <address>
                          <h4><strong><?=$userComplaint[0]->ProductName;?></strong></h4>
                          <?=$userComplaint[0]->Product_Description;?><br>
                          Selling Date: <?=$userComplaint[0]->SellingDate;?><br>
                          Price: <?=$userComplaint[0]->Price;?><br>
                          paymentMode: <?=$userComplaint[0]->PaymentMode;?>
                        </address>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <!-- <h3 class="card-title">Data Table With Full Features</h3> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table">
                      <thead>
                      <tr>
                        <th><label><h3>Complaints</h3></label></th>
                        
                      </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach ($userComplaint as $key) {
                            ?>
                              <tr>
                                <td>
                                  <div class="card" style="margin: 0;padding: 1rem;">
                                   <div class="row invoice-info">
                                      <!-- <div class="col-sm-4 invoice-col">
                                        <address>
                                          <strong>Username: <?=$key->Username;?>.</strong><br>
                                          <?=$key->Address;?>, <?=$key->Pincode?><br>
                                          Phone: (804) <?=$key->ContactNo?><br>
                                          Email: <?=$key->EmailID;?>
                                        </address>
                                      </div> -->
                                      <!-- /.col -->
                                      <!-- <div class="col-sm-4 invoice-col">
                                        <address>
                                          <strong><?=$key->ProductName;?></strong><br>
                                          <?=substr($key->Product_Description, 0, 100);?>....<br>
                                          Selling Date: <?=$key->SellingDate;?><br>
                                          Price: <?=$key->Price;?><br>
                                          paymentMode: <?=$key->PaymentMode;?>
                                        </address>
                                      </div> -->
                                      <!-- /.col -->
                                      <div class="col-sm-9 invoice-col">
                                        <b>Complaint ID:</b> <?=$key->ComplaintID;?><br>
                                        <b>ComplaintDate:</b> <?=$key->ComplaintDate;?><br>
                                      </div>
                                      <div class="col-md-3 invoice-col">
                                        <div style="" class="pull-right">
                                            <?php
                                            if($key->Status==0){
                                              echo '<span style="color:orange;background:white;font-weight:bold;padding:10px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,.2);">Pending</span>';
                                            }
                                            else if($key->Status==1){
                                              echo '<span style="color:blue;background:white;font-weight:bold;padding:10px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,.2);">Process</span>';
                                            }
                                            else{
                                              echo '<span style="color:green;background:white;font-weight:bold;padding:10px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,.2);">Complated</span>';
                                            }
                                          ?>
                                        </div>

                                      </div>
                                      <div class="col-md-12">
                                        <div class="heading"  style="margin-top: 2rem;">
                                          <h4>Complaint</h4>
                                        </div>
                                        <p><?=$key->Complaint?></p>
                                      </div>
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
