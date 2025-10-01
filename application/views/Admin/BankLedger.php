    <?php
  $baseUrl=base_url('resources/assets/');
?>
    <script id="test"></script>
       <div id="canvasImg" class="thumbnail"></div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=ucfirst($page);?>
              
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('Admin/Dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active"><?=ucfirst($page)?></li>
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
            <!-- /.card-header -->
            <div class="card-body" >
                <form   id="BankLedgerForm" enctype="multipart/form-data">
                    <div class="card-body">  
                        <div class="row ">
                            <?php
                                        $filterField=remove_CDT($OriginalFields);
                                        $filterField=remove_last_field($filterField,2);
                                        $tblkey=ucfirst($page);
                                        $filterField=remove_first_field($filterField);
                                        foreach($filterField as $data)
                                        {   ?>
                                                <?= get_input_field($data,$tblkey,'3')?>
                                <?php   }  
                                
                            ?>
                            
                            <!--<div class=" form-group col-md-3  ">
                                <label class=" col-md-12" id="FromDate">From Date</label> 
                                <input type="date" class="form-control col-md-12" name="FromDate" placeholder="Enter From Date" id="FromDate" value="">
                            </div>     
                            <div class=" form-group col-md-3  ">
                                <label class=" col-md-12" id="FromDate">To Date</label> 
                                <input type="date" class="form-control col-md-12" name="ToDate" placeholder="Enter To Date" id="ToDate" value="">
                            </div>    
                            <div class=" form-group col-md-3  ">
                                <label class=" col-md-12" id="FromDate">Accounts</label> 
                                <input type="text" class="form-control col-md-12" name="Accounts"  id="Accounts" value="">
                            </div>    -->
                            <div class=" form-group col-md-3  ">
                                <label class=" col-md-12" id="FromDate"></label>
                                <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-dark">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <!--<h3 class="card-title p-3">Transaction in</h3>-->
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab"> <i class="fa fa-bank  mr-2"></i>Original Format</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab"><i class="fa fa-rupee mr-2"></i>Bank Format</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                            <div class="card-body table-responsive" >
                    <table  id="OriginalFormat" class="table table-bordered table-striped" >
                        <thead>
                        <tr>
                            <th>SrNo</th>
                            <th>Date</th>
                            <th>Particular</th>
                            <th>Amount</th>
                            <th>SrNo</th>
                            <th>Date</th>
                            <th>Particular</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        
                        
                    </table>
                </div>
      
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="card-body table-responsive" >
                    <table  id="BankFormat" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SrNo</th>
                            <th>Date</th>
                            <th>Particular</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Balance</th>
                        </tr>
                        </thead>
                    </table>
                </div>
      
                  </div>
                <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
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
