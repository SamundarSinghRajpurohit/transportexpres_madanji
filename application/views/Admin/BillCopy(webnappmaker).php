<section class="content">
        <div class="row">
          <div class="col-12">
               <div id="BillCard" class="card card-default collapsed-card card-warning" >
              <div class="card-header">
                <h3 class="card-title"><?=ucfirst($page)?> Bill </h3>
                <div class="card-tools" >
                  <button type="button" id="BillBtn"  class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
            <!-- Main content -->
                 <div class="card-body" id="BillBody">
         
                   <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                    <div class="col-md-2 float-left">
                        <img id="BillFrimImage" class="custom-firm-logo">
                    </div>
                    <div class="col-md-8 float-left"  >
                        <div  id="BillFirmGodName" class="custom-god-name">!!    Shree Gansheya !!</div>
                        <div  id="BillFirmName" class="custom-firm-name">Web N App Maker, Inc.</div>
                        <div class="float-left col-md-12">
                            <div class="float-left"><b>Address : </b></div>
                            <div class="float-left" id="BillFirmAddress">F-23,agrasen point, beside agarsen bhavan ,citylight road, surat,395007</div>
                        </div>
                        <div class="float-left col-md-12">
                            <div class="col-md-6 float-left">
                                <div class="float-left"><b>Email Id : </b></div>
                                <div class="float-left" id="BillFirmEmailId">admin@webnappmaker.in</div>
                            </div>
                        </div>
                        <div class="float-left col-md-12">
                        
                            <div class="col-md-6 float-center">
                                <div class="float-left"><b>GST No : </b></div>
                                <div class="float-left" id="BillFrimGSTNo">24COEPD909ZN1ZD</div>
                            </div>
                                <div class="col-md-6 float-right">
                                <div class="float-left"><b>Phone No : </b></div>
                                <div class="float-left" id="BillFrimPhoneNo">8347766166</div>
                            </div>
                         </div>
                    </div>
                </div>
                <!-- /.col -->
              </div>
              <hr>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col float-right">
                    <div><b>Customer Name:</b></div> 
                    <div><b>Phone No:</b></div>
                    <div><b>GST No:</b></div>
                    <div><b>Customer Address:</b></div>
                
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                    <div id="BillSalesCustomerName">krunal danej</div> 
                    <div id="BillPassengerPhoneNo">8347766166</div>
                
                    <div id="BillPassengerGSTNumber">24COEPD9097NIZD</div>
                    <div id="BillPassengerAddress">F-23,agrasen point, beside agarsen bhavan ,citylight road, surat,395007</div>
                    
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  <div><b>Customer Detail:</b></div>
                  <br>
                  <div><b>Reverse Charge:</b></div>
                  <div><b>AIR INVOICE:</b></div>
                  <div><b>Date:</b></div>
                </div>
                <div class="col-sm-3 invoice-col">
                  <div id="BillPassengerDesc">Extra Info Of Customer</div>
                  <br>
                  <div id="BillSalesReverseCharge">Reverse Charge</div>
                  <div id="BillSalesAirInovice">AIR INVOICE</div>
                  <div id="BillSalesDate">Date</div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>SrNo</th>
                      <th>Passenger Name</th>
                      <th>Sector</th>
                      <th>Travel Type</th>
                      <th>Travel Desc</th>
                      <th>HSN Code</th>
                      <th>Travel On</th>
                      <th>Basic</th>
                      <th>Yq</th>
                      <th>Other</th>
                      <th>K3 Tax</th>
                      <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td id="BillPassengerName">Mr Danej</td>
                            <td id="BillPurchaseSector">STV-VCS</td>
                            <td id="BillPurchaseTypeId">Flight</td>
                            <td id="BillPurchaseCarrier">Carrier</td>
                            <td id="BillPurchaseCarrier">HSN Code</td>
                            <td id="BillSalesTravelDate">Travel Date</td>
                            <td id="BillSalesBasic">105</td>
                            <td id="BillSalesYq">105</td>
                            <td id="BillSalesOther">105</td>
                            <td id="BillSalesK3Tax">105</td>
                            <td id="BillSalesGrossTotal">5000</td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Bank Details:-</p>
                  <!--<img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
-->
                <!--  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                -->
                    <div class="col-md-6 float-left"> 
                      <div ><b>BankName : </b></div>
                      <div ><b>AccountType : </b></div>
                      <div ><b>AccountNumber :</b></div>
                      <div ><b>IFSCCode :</b></div>
                      <div ><b>BankBranch :</b></div>
                    </div>
                    <div class="col-md-6 float-left"> 
                      <div id="BillFirmBankName">KVB</div>
                      <div id="BillFirmBankAccountType">Savings</div>
                      <div id="BillFirmBankAccountNumber">2215170000000550</div>
                      <div id="BillFirmBankIFSCCode">KVBL220</div>
                      <div id="BillFirmBankBranch">UM-Road</div>
                    </div>
                    <p class="lead">Terms & Condition:-</p>
                      
                    <div class="col-md-12" id="BillFirmTermsCondition">
                      hello world
                    </div>
                    
                </div>
                
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due 2/22/2014</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Gross Total:</th>
                        <td id="BillSalesGrossTotal"></td>
                      </tr>
                      <tr>
                        <th>Processing Charges</th>
                        <td id="BillSalesProcessingChrages"></td>
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
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="#" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                  <!--<button type="button" class="btn btn-success float-right"><i class="fa fa-credit-card"></i> Submit
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