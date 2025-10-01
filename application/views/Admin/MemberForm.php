<section class="content">
        <div class="row">
          <div class="col-12">
               <div id="PrintCard" class="card card-default collapsed-card card-warning" >
              <div class="card-header">
                <h3 class="card-title"><?=ucfirst($page)?> Form </h3>
                <div class="card-tools" >
                  <button type="button" id="BillBtn"  class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
            <!-- Main content -->
                 <div class="card-body" id="PrintBody">
         
                   <div class="invoice p-3 mb-3">
             
              <div class="row invoice-col4 print1 col-md-12">
                    <div class="col-md-6  invoice-col print3">
                                    <div class="col-md-12">          
                                       <div class="col-md-2 float-left">
                                            <img src="<?=site_url('resources/images/logo.jpg')?>" class="logo-icon">    
                                       </div>
                                       <div class="col-md-10 float-left">
                                            <h6 style="text-align: center;" class=" print-title"><b><h1>Aarya Cub N Resort</h1></b></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12">          
                                      
                                        <div class="col-md-4 pull-left id-card-left-pic" id="id-card">
                                               <img  class="user-img" id="IDcardEmployeeImage">
                                        </div>  
                                        <div class="col-md-8 pull-left id-card-left-detail">
                       
                                            <strong>Name :</strong><label id="IDcardEmployeeName"></label>   <br>
                                            <strong>Post :</strong><label id="IDcardEmployeePost"></label>                        <br>
                                            <strong>IssueDate :</strong><label id="IDcardEmployeeCDT"></label>                        <br>
                                            
                                            <strong>Tower &amp; Flat No: </strong><label id="IDcardEmployeeTowerFlat">D3-801</label>                        <br>        
                                            <br>
                                            <strong>Approved by:__________</strong>
                                            <br>        
                                    
                                        </div>
                                    </div>
                                    <div class="col-md-12 pull-left id-footer">
                                                   <h6 style="text-align: center;" class=" col-md-12 print-title">
                                                    <b></b>
                                                    </h6>
                                    </div>
                                    
                            </div>
              </div>
              <hr>

              
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button  class="btn btn-primary" onclick="printDiv('PrintBody')"><i class="fa fa-print" ></i> Print</button>
                    <!--<div class="float-right lead">This is a prinited Bill So  no need of Signature.</div>-->
                    
                  <!--<button type="button" class="btn btn-success "><i class="fa fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                  </button>-->
                </div>
              </div>
            </div>
                </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</section>