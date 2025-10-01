<div class="content-wrapper" style="min-height: 496px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$pageName?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('/Admin/Dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active"><?=$pageName?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    
    <!-- /.modal -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Information</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
   
                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" id="AddUpdateForm" name="AddUpdateForm" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Vendor Name</label>
                        <input type="hidden" name="VendorId" class="form-control"  value="<?=$mainData[0]["VendorId"]?>">
                        <div class="col-sm-10">
                         <input type="text" name="VendorName" class="form-control"  value="<?=$mainData[0]["VendorName"]?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Vendor Type</label>
                        <div class="col-sm-10">
                         <input type="text" name="VendorType" class="form-control"  value="<?=$mainData[0]["VendorType"]?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                         <input type="text" name="VendorAddress" class="form-control"  value="<?=$mainData[0]["VendorAddress"]?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Phone No</label>
                        <div class="col-sm-10">
                         <input type="text" name="VendorPhoneNo" class="form-control" value="<?=$mainData[0]["VendorPhoneNo"]?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email Id</label>
                        <div class="col-sm-10">
                        <input type="text" name="VendorEmailId" class="form-control"  value="<?=$mainData[0]["VendorEmailId"]?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">GST NO</label>
                        <div class="col-sm-10">
                        <input type="text" name="VendorGSTNo" class="form-control"  value="<?=$mainData[0]["VendorGSTNO"]?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">PAN NO</label>
                        <div class="col-sm-10">
                         <input type="text" name="VendorPANNo" class="form-control"  value="<?=$mainData[0]["VendorPANNo"]?>">
                         </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Bank A/C Type</label>
                        <div class="col-sm-10">
                          <input type="text" name="VendorBankAccountType" class="form-control" value="<?=$mainData[0]["VendorBankAccountType"]?>">
                         </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Branch Name</label>
                        <div class="col-sm-10">
                      <input type="text" name="VendorBankName" class="form-control" value="<?=$mainData[0]["VendorBankName"]?>">
                         </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Bank A/C.No</label>
                        <div class="col-sm-10">
                      <input type="text" name="VendorBankAccount" class="form-control" value="<?=$mainData[0]["VendorBankAccount"]?>">
                         </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Bank IFSC Code</label>
                        <div class="col-sm-10">
                      <input type="text" name="VendorBankIFSCCode" class="form-control" value="<?=$mainData[0]["VendorBankIFSCCode"]?>">
                         </div>
                      </div>
                     <!-- <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Ledger Type</label>
                        <div class="col-sm-10">
                      <input type="text" name="VendorBankName" class="form-control" value="<?=$mainData[0]["VendorLedgerType"]?>">
                         </div>
                      </div>-->
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                           <!-- <td class="custom-table-td"><a id="</?=$mainData[0]["MedicalstoreId"]?>" class="updatedata" data-toggle="modal" data-target="#insert-modal" ><i class="fa fa-edit admin-custom-color-opp" ></i></a>-->
                          <button type="submit" name="btnSubmit" id="btnSubmit"  data-target="#insert-modal"  class="btn btn-danger">Update</button>
                             
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  
      <!-- /.modal -->
</div>
            