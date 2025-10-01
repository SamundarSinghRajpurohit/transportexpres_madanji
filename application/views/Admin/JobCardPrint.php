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
                    <div><b>Job Card No:</b>JC/<span id="JobcardJobCardId"></span></div>
                    
                    
                     
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
                        <span  class="box-heading">Sechulde Service</span>
                    </div>
                    <div class="col-5 float-left invoice-col">
                        <span  class="box-heading">Observations & Instrucations</span>
                    </div>
                    <div class="col-2 float-left ">
                        
                    </div>
                    
                    <div class="col-5 float-left invoice-col">
                        <span  class="box-heading">Suggested Jobs</span>
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
              <!-- Sub Job Card -->
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-12 float-left">
                    <table class="job-card-sub-footer" border="1">
                        <tr>
                            <td class="job-card-table">Advisory Name</td>
                            <td class="job-card-table"><span id="JobcardAdvisoryName">-</span></td>
                            <td class="job-card-table">Mechanic Name</td>
                            <td class="job-card-table"><span id="JobcardMechanicName">-</span></td>
                            <td class="job-card-table">Delivery Date</td>
                            <td class="job-card-table"><span id="JobcardJobCardDeliveryDate">-</span></td>
                            <td class="job-card-table">Delivery Time</td>
                            <td class="job-card-table"><span id="JobcardJobCardDeliveryTime">-</span></td>
                        </tr>
                    </table>
                    <p class="lead">Terms & Condition:-</p>
                    <div class="col-12" id="BillFirmTermsCondition">
                      
                    </div>
                </div>
                <hr>
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