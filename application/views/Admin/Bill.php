<section class="content">
        <div class="row">
          <div class="col-12">
               <div id="PrintCard" class="card card-default collapsed-card card-warning" >
              <div class="card-header">
                <h3 class="card-title"><?=ucfirst($page)?> Bill </h3>
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
                    <div class="col-md-2 float-left">
                        <img id="BillFrimImage" class="custom-firm-logo">
                    </div>
                    <div class="col-md-8 float-left"  >
                        <div class="row">
                            <div  id="BillFirmGodName" class="col-md-4 custom-god-name">!!    Shree Gansheya !!</div>
                            <div   class="col-md-4 custom-god-name"><b>TAX INVOICE</b></div>
                            <div   class="col-md-4 custom-god-name"><b>INVOICE NO : </b><span id="BillSalesId">12</span></div>
                        </div>
                        <div  id="BillFirmName" class="custom-firm-name">Web N App Maker, Inc.</div>
                        <div class="float-left col-md-12">
                            <div class="float-left"><b>Address : </b></div>
                            <div class="float-left" id="BillFirmAddress">F-23,agrasen point, beside agarsen bhavan ,citylight road, surat,395007</div>
                        </div>
                        <div class="float-left col-md-12">
                            <div class="col-md-6 float-left">
                                <div class="float-left"><b>Email Id : </b></div>
                                <div class="float-left" id="BillFirmEmailId">-</div>
                            </div>
                        </div>
                        <div class="float-left col-md-12">
                        
                            <div class="col-md-6 float-center">
                                <div class="float-left"><b>GST No : </b></div>
                                <div class="float-left" id="BillFirmGSTno">-</div>
                            </div>
                                <div class="col-md-6 float-right">
                                <div class="float-left"><b>Phone No : </b></div>
                                <div class="float-left" id="BillFirmPhoneNo">8347766166</div>
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
                    <div id="BillCustomerName">(<span id="BillSalesPassenger"></span>)</div> 
                    <div id="BillCustomerPhoneNo">-</div>
                
                    <div id="BillCustomerGSTno">-</div>
                    <div id="BillCustomerAddress">-</div>
                    
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  <div><b>Customer Detail:</b></div>
                  <br>
                  <div></div>
                  <div></div>
                  <div><b>Date:</b></div>
                </div>
                <div class="col-sm-3 invoice-col">
                  <div id="BillPassengerDesc">-</div>
                  <br>
                  <div ></div>
                  <div ></div>
                  <div id="BillSalesDate">Date</div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped" id="BillDetailView">
                    
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
                <div class="col-6"><!--
                  <p class="lead">Amount Due 2/22/2014</p>-->

                  <div class="table-responsive">
                  <!--  <table class="table">
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
                    </table>-->
                  </div>
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
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</section>