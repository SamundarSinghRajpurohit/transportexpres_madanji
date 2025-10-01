<?php
  include_once('header.php');
  $baseUrl=base_url('resources/assets/');
?>
  <script type="text/javascript">
    
      function myFunc(id) {
    
        //var state = document.getElementById("stateid").value;
    
        // alert(id);
        var url="<?=site_url('/user_c/get_city/');?>"+id;
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
          document.getElementById("CityID").innerHTML=abc.responseText;
          }
        }
      }
  </script>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Client</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?=site_url('/user_c/add_user/');?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Clientname</label>
                  <input type="text" class="form-control" placeholder="Enter Username" name="Username" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>EmailID</label>
                  <input type="text" class="form-control" placeholder="Enter  EmailID" name="EmailID" required="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Pincode</label>
                  <input type="text" class="form-control" placeholder="Enter Pincode" maxlength="8" name="Pincode" required="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Contact No</label>
                  <input type="text" required="" maxlength="10"a class="form-control" placeholder="Enter ContactNo" name="ContactNo">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Gender</label>
                  <div class="form-group">
                    <label><input type="radio" name="Gender" value="male"> Male</label>
                    <label><input type="radio" name="Gender" value="female"> Female</label>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" required="" placeholder="Enter Address" name="Address"></textarea>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>State</label>
                  <select name="StateID" required="" class="form-control" onchange="myFunc(this.value);">
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
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>City</label>
                  <select name="CityID" required="" id="CityID" class="form-control">
                    <option value="null">Select City</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Profile Image</label>
                  <input type="file" class="form-control" name="Profile_Image">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ProductName</label>
                  <input type="text" class="form-control" placeholder="Enter ProductName" name="ProductName" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Price</label>
                  <input type="text" class="form-control" placeholder="Enter  Price" name="Price" required="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Payment Method</label>
                  <select class="form-control" name="PaymentMode" required="">
                    <option value="null">Select Paymentmode</option>
                    <option value="Cash">Cash</option>
                    <option value="Cheque">Cheque</option>
                    <option value="Cheque">Aangadiya</option>
                    <option value="Cheque">Creadit/Debit Card</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>SellingDate</label>
                  <input type="date" required="" class="form-control" placeholder="Enter SellingDate" name="SellingDate">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Product Image</label>
                  <input type="file" class="form-control" name="ProductImage">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Product_Description</label>
                  <textarea class="form-control" required="" placeholder="Enter Product_Description" name="Product_Description"></textarea>
                </div>
              </div>  
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
            <h1>Client</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Client</li>
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
            <!-- <div class="card-header"> -->
              <!-- <h3 class="card-title">Data Table With Full Features</h3> -->
              <!-- <button type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal">Add Client</button> -->
            <!-- </div> -->
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped" style="overflow:hidden;position:relative;width:100%;display:block;overflow-x:scroll;">
                <thead>
                <tr>
                  <th>UserName</th>
                  <th>Profile</th>
                  <th>EmailID</th>
                  <th>Address</th>
                  <th>Contact No</th>
                  <th>Gender</th>
                  <th>City</th>
                  <th>State</th>
                  <th>CreatedDate</th>
                  <!-- <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($UserData as $key) {
                      ?>
                        <tr>
                          <td><?=$key->Username?></td>
                          <td><img src="<?=base_url('resources/images/'.$key->ProfileImage)?>" style="height:30%;width:100%;"></td>
                          <td><?=$key->EmailID?></td>
                          <td><?=$key->Address?></td>
                          <td><?=$key->ContactNo?></td>
                          <td><?=$key->Gender;?></td>
                          <td><?=$key->CityName;?></td>
                          <td><?=$key->StateName;?></td>
                          <td><?=$key->CreatedDateTime?></td>
                          <!-- <td> -->
                            <!-- <ul class="list-unstyled"> -->
                              <!-- <li style="display: inline-block;padding-left: .5rem;">
                                <a href="<?=site_url('/user_c/del_user/'.$key->UserID);?>" style="font-size: 20px;"><i class="fa fa-trash"></i></a>
                              </li> -->
                              <!-- <li style="display: inline-block;padding-left: .5rem;">
                                <a href="<?=site_url('/user_c/complaint_book/'.$key->UserID.'/'.$key->ProductID);?>" style="font-size: 20px;"><i class="fa fa-edit"></i></a>
                              </li> -->
                            <!-- </ul>
                          </td>
                        </tr> -->
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

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php
  include_once('footer_view.php');
?>  

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
</script>
</body>
</html>
