    <?php
  $baseUrl=base_url('resources/assets/');
?>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Gallery</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?=site_url('/Category/add_Category/');?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Select Category Name</label>
              <select>
                  <option></option>
              </select>
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
            <h1><?=$page;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$page?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<?php include_once('AddDiv.php');?>
    <!-- Main content -->
    <section class="content">
        
      <div class="row">
        <div class="col-12">
          <!-- /.card -->

          <div class="card">
            
            <!-- /.card-header -->
            <div class="card-body" style="overflow:hidden;position:relative;width:100%;display:block;overflow-x:scroll;">
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <?php 
                        /*print_r($galleryFields);
                        die();*/
                    foreach($Fields as $FieldsKey)
                    {?>
                        <th><?php echo $FieldsKey; ?></th>
                    <?php
                    }
                    ?>
                    </tr>
                </thead>
                <tbody>
            
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