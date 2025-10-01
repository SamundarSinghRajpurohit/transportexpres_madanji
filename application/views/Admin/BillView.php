<div class="content-wrapper">
  
    <section class="content">
        <div class="row">
          <div class="col-12">
               <div id="BillCard">
             <!-- Main content -->
                <div class="card-body" id="BillBody">
                                <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                  <div class="col-12">
                  <h4>
                   <center> <small><?=$mainData[0]->CompanyName?></small><br>
                   <?=$mainData[0]->CompanyAddress?>
                   </center>
                  </h4>
                </div>
                <div class="col-12">
                  <h4>
                    <small class="float-right">Date: <?=$mainData[0]->OrderDate?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 ">
                  From
                  <address>
                    <strong><?=$mainData[0]->DealerName?>,</strong><br>
                    <?=$mainData[0]->DealerAddress?><br>
                    
                    <strong>Phone : </strong><?=$mainData[0]->DealerPhoneNo?><br>
                    <strong>Email-Id : </strong><?=$mainData[0]->DealerEmailId?><br>
                    <strong>GST : </strong><?=$mainData[0]->DealerGSTNO?><br>
                    
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 ">
                  To
                  <address>
                    <strong><?=$mainData[0]->ConsigneeName?>,</strong><br>
                    <!--//?=$mainData[0]->AddressHouseNo.",".$mainData[0]->AddressName.",".$mainData[0]->AddressLandmark.",<br>".$mainData[0]->AddressCityName.",".$mainData[0]->AddressPincode.""?><br-->
                    <strong>Phone : </strong><?=$mainData[0]->ConsignorPhoneNo?><br>
                    <strong>Email-Id : </strong><?=$mainData[0]->ConsignorEmailId?><br>
                    
                    <strong>GST : </strong><?=$mainData[0]->ConsignorGSTNo?><br>
                    
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 ">
                  <b>Invoice No : </b><?=$mainData[0]->OrderLRNO?><br>
                  <b>Payment Mode : </b>COD<br>
                  <b>Date : </b> <?=$mainData[0]->OrderDate?><br>
                  
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
                      <th>Sr</th>
                      <th>Product</th>
                      <th>Box</th>
                      <th>Rate</th>
                      <th>Weight</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                     <?php
                      //  $OrderData = json_decode(json_encode($OrderData)) ;
                        /*echo "<pre>";
                        print_r($orderDetail);*/
                       // print_r($orderDetail);
                       $GST=0;
                       $total=0;
                        for($i=0;$i<count($orderDetail);$i++)
                        {
                            
                        ?>
                                <tr>
                                    <td><?=($i+1)?></td>
                                    <td><?=$orderDetail[$i]->ProductName?></td>
                                    <td><?=$orderDetail[$i]->OrderdetailBox?></td>
                                    <td><?=$orderDetail[$i]->OrderdetailRateOn?></td>
                                    <td><?=$orderDetail[$i]->OrderdetailWeight?></td>
                                    <?php $subtotal=($orderDetail[$i]->OrderdetailWeight * $orderDetail[$i]->OrderdetailRateOn)?>
                                    <td><?=$subtotal?></td>
                                </tr> 
                           <?php 
                          // $GST=$GST+$tax;
                          $total=$total + $subtotal;
                        }
                        ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
                <hr>
                <!-- /.col -->
                <div class="col-0">
                  <!--<p class="lead">Amount Due 2/22/2014</p>-->

                  <div class="table-responsive">
                    <table class="table">
                      <!--<tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>$250.30</td>
                      </tr>
                      <tr>
                        <th>Tax (9.3%)</th>
                        <td>$10.34</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>$5.80</td>
                      </tr>-->
                      
                      <!--samundar add for delivery charge 11-03-2021-->
                      <!---->
                      <!--samundar end-->
                      <tr>
                        <th>Total:</th>
                        <td id="BillSalesTotal"><?=round($total)?></td>
                      </tr>
                       <tr>
                        <td style="float:left;"><b>Total Invoice Amount in Words : </b> <span id="AmountInWords">Only</span></td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                </div>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Accepted Payments</p>
                 
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    <ul>
                        <li>Bank Account1:&nbsp;&nbsp; SBI A/C&nbsp;:&nbsp;9999999999 IFSC&nbsp;:&nbsp;9999999999</li>
                        <li>Bank Account2:&nbsp; UBI A/C&nbsp;:&nbsp;9999999999 IFSC&nbsp;:&nbsp;9999999999</li>
                        <li>Accountant Department &nbsp;9999999999</li>
                        <li>Logistics Department &nbsp;9999999999</li>
                    </ul>
                  </p>
                </div>
                <div class="col-6">
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="text-center">
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    <ul>
                        <th>Certified that the particulars given above are true and correct.</th>
                        <br>
                        <br>
                        <h5>Medi App</h5>
                        <br>
                        
                  <th><b>Authorised Signatory</b></th>
                    </ul>
                  </p>
                 </div>
                </div>
                </div>
                
                </div>
                <!-- /.col -->
                <div class="col-12">
                  <p class="lead">Terms and condition:</p>
                 
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    <ul>
                        <li>SUBJECT TO SURAT JURISDICTION ONLY</li>
                        <li>GOODS ONCE SOLD WILL NOT BE TAKEN BACK UNLESS IT IS DAMGED</li>
                        <li>GOODS DISPATCHED AT THE ENTIRE RISK OF PURCHASER</li>
                        <!--<li>If you use Deal then you can't get Cash Discount</li>-->
                        <li>YOU CAN'T AVAIL CASH DISCOUNT IF YOU USING A DEAL</li>
                    </ul>
                  </p>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                    <!--<a href="#" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>-->
                     <button onclick="printBill()" target="_blank" class="btn btn-pri"><i class="fa fa-print"></i> Print</button>
               
                 <!-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
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
</div>

<script>
function printBill() {
  window.print();
}
</script>

<script src="<?=site_url('resources/assets/custom.js')?>"></script>

<script >

   window.onload = function() { 
     var test=$('#BillSalesTotal').html();
     //alert(test);
     test=convertNumberToWords(test);
     $('#AmountInWords').html(test);
       window.print(); 
       }
</script>
