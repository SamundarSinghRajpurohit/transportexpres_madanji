<section class="content">
    <div class="row">
        <div class="col-12">
            <div id="PrintCard" class="card card-default collapsed-card card-warning" >
              <div class="card-header">
                <h3 class="card-title"><?=ucfirst($page)?></h3>
                <div class="card-tools" >
                  <button type="button" id="BillBtn"  class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
            <!-- Main content -->
                 <div class="card-body" id="PrintBody">
         
                  <div class="invoice p-3 mb-3">
                          <!-- title row -->
        <div class="row">
            <div class="col-12">
                <div  id="BillFirmName" class="custom-firm-name" style="text-align:center">Devi Motors</div>
                <div  style="text-align:center">ICHHAPORE BUS TOP NO-3 BESIDE BALAJI HERO,HAZIRA ROAD SURAT Ph .9712984111</div>
                <div  style="text-align:center">GST No 24ANWPP1633P1Z9 </div>
                <br>
                <div style="font-weight:bold; background-color: lightgrey;text-align:center;">JOB CARD</div>
            </div>
        </div>
        <hr>
        <!-- Customer row -->
        <div class="row">
            <div class="col-sm-5  float-left">
                <div><b>Customer Name:</b><span id="JobcardCustomerName">-</span></div>
                <div><b>Phone No:</b><span id="JobcardCutomerPhoneNo">-</span></div>
                <div><b>GST No:</b><span id="JobcardCustomerGSTno">-</span></div>
                <div><b>Customer Address:</b><span  id="JobcardCustomerAddress">-</span></div>    
            </div>
                
            
                
            <div class="col-sm-5  float-left">
                <div><b>Vechile No:</b><span id="JobcardCustomerVechileNo"></span></div> 
                <div><b>Engine No:</b><span id="JobcardCustomerEngineNo">-</span></div>
                <div><b>Chassis No:</b><span id="JobcardCustomerChassisNo">-</span></div>
                <div><b>Km :</b><span id="JobcardCustomerKm">-</span></div>
            </div>
            <!-- /.col -->
            <div class="col-sm-2 fload-left ">
                    <div><b>Vechile No:</b><span id="JobcardCustomerVechileNo"></span></div>
                    
                    
                     
                </div>
        
        </div>
        <hr>
        <!-- Service row -->
        <div class="row ">
        
        <div class="col-sm-3">
            <div><b>Service Type:</b></div> 
        </div>
        <div class="col-sm-3">
            <div id="JobcardJobCardServiceDropDown"></div>  
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
        <!-- /.row -->
        <!-- Main Box row -->
        <div class="row">
                
                    <div class="col-5 float-left invoice-col">
                        
                    </div>
                    <div class="col-5 float-left invoice-col">
                        
                    </div>
                    <div class="col-2 float-left " style="border:solid">
                        
                    </div>
                    
                    <div class="col-5 float-left invoice-col">
                        <span style="border:solid;">Suggested Jobs</span>
                        <table  id="JobCardPrintView" style="width:100%; text-align: left;">
                        </table>    
                    </div>
                    <div class="col-5 float-left invoice-col">
                        
                    </div>
                    
                    <div class="col-2 float-left ">
                        
                    </div>
                </div>
                    </div>
              <!-- /.row -->
                <hr>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-9">
                  
                    <div class="col-md-6 float-left"> 
                      <div ><b>BankName : </b></div>
                      <div ><b>AccountType : </b></div>
                      <div ><b>AccountNumber :</b></div>
                      <div ><b>IFSCCode :</b></div>
                      <div ><b>BankBranch :</b></div>
                    </div>
                    <div class="col-md-6 float-left"> 
                      <div id="BillFirmBankName">-</div>
                      <div id="BillFirmAccountType">-</div>
                      <div id="BillFirmAccountNumber">-</div>
                      <div id="BillFirmIFSCcode">-</div>
                      <div id="BillFirmBankBranch">-</div>
                    </div>
                    <p class="lead">Terms & Condition:-</p>
                      
                    <div class="col-md-12" id="BillFirmTermsCondition">
                      
                    </div>
                    
                </div>
                <hr>
                <!-- /.col -->
                <div class="col-3"><!--
                  <p class="lead">Amount Due 2/22/2014</p>-->

<!--                  <div class="table-responsive">
                   <table class="table float-left">
                      <tr>
                        <th style="width:50%">Gross Total:</th>
                        <td id="BillSalesGrossTotal"></td>
                      </tr>
                      <tr>
                        <th>Processing Charges</th>
                        <td id="BillSalesProcessingCharges"></td>
                      </tr>
                      <tr>
                        <th>CGST<span id=""></span>:</th>
                        <td id="BillSalesCGST"></td>
                      </tr>
                      <tr>
                        <th>SGST:</th>
                        <td id="BillSalesSGST"></td>
                      </tr>
                      <tr>
                        <th>IGST:</th>
                        <td id="BillSalesIGST"></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td id="BillSalesTotal"></td>
                      </tr>
                    </table>
                  </div>-->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button  class="btn btn-primary" onclick="printDiv('PrintBody')"><i class="fa fa-print" ></i> Print</button>
                    <div class="float-right lead">This is a prinited Bill So  no need of Signature.</div>
                    
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
            
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>