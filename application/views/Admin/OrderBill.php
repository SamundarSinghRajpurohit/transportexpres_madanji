<div class="content-wrapper">
  
    <section class="content">
        <div class="row">
          <div class="col-12">
               <div id="BillCard"  >
             <!-- Main content -->
                <div class="card-body" id="BillBody">
                                <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img src="http://surti.amohatrendz.in/resources/LOGO.png" style="height:100px; width:200px;" > 
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
                    <strong><?=$BillData[0]->FirmName?>,</strong><br>
                    <?=$BillData[0]->FirmAddress?><br>
                    
                    <strong>Phone : </strong><?=$BillData[0]->FirmPhoneNo?><br>
                    <strong>Email-Id : </strong><?=$BillData[0]->FirmEmailId?><br>
                    
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 ">
                  To
                  <address>
                    <strong><?=$mainData[0]->CustomerName?>,</strong><br>
                    <?=$mainData[0]->AddressHouseNo.",".$mainData[0]->AddressName.",".$mainData[0]->AddressLandmark.",<br>,".$mainData[0]->AddressPincode.""?><br>
                    <strong>Phone : </strong><?=$mainData[0]->CustomerPhoneNo?><br>
                    <strong>Email-Id : </strong><?=$mainData[0]->CustomerEmailId?><br>
                    
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 ">
                  <b>Invoice No : </b><?=$mainData[0]->OrderId?><br>
                  <b>Payment Mode : </b>COD<br>
                  <b>Delivery Date : </b> <?=$mainData[0]->OrderDeliveryDate?><br>
                  
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
                      <th>QTY</th>
                    </tr>
                    </thead>
                    <tbody>
                     <?php
                      //  $OrderData = json_decode(json_encode($OrderData)) ;
                       // echo "<pre>";
                       // print_r($orderDetail);
                        for($i=0;$i<count($orderDetail);$i++)
                        {   ?>
                                <tr>
                                    <td><?=($i+1)?></td>
                                    <td><?=$orderDetail[$i]->ProductName?></td>
                                    <td><?=$orderDetail[$i]->OrderdetailQty?></td>
                                </tr> 
                           <?php 
                        }
                        ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
                <hr>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Terms and condition:</p>
                 
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    <ul>
                        <li>Once product sold can't return.</li>
                    </ul>
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <!--<p class="lead">Amount Due 2/22/2014</p>-->

                  <div class="table-responsive">
                    
                  </div>
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
