<style>
    
.table td, .table th {
     padding: .25rem !important; 
}
</style>
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
                
                
                <div class="col-12 table-responsive ">
                    <table class="table  table-bordered solid text-left">
                      <tr>
                          <td>
                              <h4><b>
                              <?=$CompanyData[0]->CompanyName?></b></h4>
                              <?=$CompanyData[0]->CompanyAddress?><br><br>
                              <b>Email Id</b> :- <?=$CompanyData[0]->CompanyEmailId?><br>
                              <b>Bank Name</b> :- <?=$CompanyData[0]->CompanyBankName?><br>
                              <b>A/C No</b> :- <?=$CompanyData[0]->CompanyAccountNo?><br>
                              <b>IFSC CODE</b> :- <?=$CompanyData[0]->CompanyIFSCCode?><br>
                              <b>A/C TYPE</b> :- <?=$CompanyData[0]->CompanyAccountType?><br>
                              <b>GST No</b> :- <?=$CompanyData[0]->CompanyGSTno?><br>
                              <b>Pancard No.</b> :- <?=$CompanyData[0]->CompanyPanCartNo?>
                          </td>
                          <td rowspan="2">
                              <h3>Dealer :-<b><?=$OrderPalletData[0]->DealerName;?></b></h3>
                              Dealer GST No.:- <?=$OrderPalletData[0]->DealerGSTNO;?><br>
                              <?=$OrderPalletData[0]->DealerAddress;?>
                              <br><br><br><br><br><br>
                              <span >5.Delivery Challan No :- <b>
                                  
                                  <?php
                                  //print_r($OrderPalletData);
                                  if($OrderPalletData[0]->OrderpalletLRNO == "")
                                  {
                                      echo $OrderPalletData[0]->OrderpalletLRNOauto;
                                  }
                                  else
                                  {
                                      echo $OrderPalletData[0]->OrderpalletLRNO;
                                  }
                                  ?>
                                  
                                  </b></span> <span class="float-right">6. Delivery Challan Date :-<b><?=$OrderPalletData[0]->OrderpalletDate?></b></span>
                          </td>
                      </tr>
                      <tr>
                          <td>Original For Consignee</td>
                      </tr> 
                      
                      </table>
                    
                    <table class="table text-left border">
                        <tr>
                          <td>
                              <h5>Detail Of Consignee</h5>
                              <b>RELIANCE INDUSTRIES</b><br>
                              Block No.A,Servey No.<br>Plot No.88,Behind sabargam Hindi School,<br>
                              Niyol,Tal.Palsana,Post-Surat-394315<br>
                              GST No :24AAACR5055K1ZD<br>
                              Pan No :AAACR5055K
                          </td>
                          <td>
                              <h5>Shipped To- Address Of Delivery</h5>
                              <b>RELIANCE INDUSTRIES</b><br>
                              Block No.A,Servey No.<br>Plot No.88,Behind sabargam Hindi School,<br>
                              Niyol,Tal.Palsana,Post-Surat-394315<br>
                              GST No :24AAACR5055K1ZD<br>
                              Pan No :AAACR5055K
                          </td>
                      </tr>
                      
                      <tbody>
                      
                      </tbody>
                    </table>
                    
                    <table class="table text-left table-bordered">
                        <thead>
                          <tr>
                            <th>Sr.No/Description Of Goods</th>
                            <th>Code</th>
                            <th>Hsn No.</th>
                            <th>Qty.</th>
                            <th>UOM</th>
                            <th>Rate(Rs.)UOM</th>
                            <th>Total(Rs.)</th>
                          </tr>
                        </thead>  
                        <tr>
                          <td>RECUCLED FDY WOODEN UNIT-PG</td>
                          <td>9500025943</td>
                          <td>44152000</td>
                          
                          <td><?=(isset($OrderPalletDetail[0]->OrderpalletdetailQty))?$OrderPalletDetail[0]->OrderpalletdetailQty:0?></td>
                          <td>UNIT</td>
                          <td><?=(isset($OrderPalletDetail[0]->OrderpalletdetailRate))?$OrderPalletDetail[0]->OrderpalletdetailRate:0?></td>
                          <td><?=(isset($OrderPalletDetail[0]->OrderpalletdetailTotal))?$OrderPalletDetail[0]->OrderpalletdetailTotal:0?></td>
                      </tr>
                        <tr>
                          <td>RECUCLED FDY WOODEN UNIT-SMD</td>
                          <td>9500062937</td>
                          <td>44152000</td>
                          <td><?=(isset($OrderPalletDetail[1]->OrderpalletdetailQty))?$OrderPalletDetail[1]->OrderpalletdetailQty:0?></td>
                          <td>UNIT</td>
                          <td><?=(isset($OrderPalletDetail[1]->OrderpalletdetailRate))?$OrderPalletDetail[1]->OrderpalletdetailRate:0?></td>
                          <td><?=(isset($OrderPalletDetail[1]->OrderpalletdetailTotal))?$OrderPalletDetail[1]->OrderpalletdetailTotal:0?></td>
                      </tr>
                        <tr>
                          <td>RECUCLED PALLET & TUBE-FDY 1151*800MM</td>
                          <td>9500031672</td>
                          <td>44152000</td>
                          <td><?=(isset($OrderPalletDetail[2]->OrderpalletdetailQty))?$OrderPalletDetail[2]->OrderpalletdetailQty:0?></td>
                          <td>UNIT</td>
                          <td><?=(isset($OrderPalletDetail[2]->OrderpalletdetailRate))?$OrderPalletDetail[2]->OrderpalletdetailRate:0?></td>
                          <td><?=(isset($OrderPalletDetail[2]->OrderpalletdetailTotal))?$OrderPalletDetail[2]->OrderpalletdetailTotal:0?></td>
                      </tr>
                      
                      <!-- <tr class="text-right">
                          <td colspan="6" >Total</td>
                          <td></td>
                      </tr>-->
                      <tbody>
                      
                      </tbody>
                    </table>
                    
                    <table class="table text-left border">
                        <tr>
                          <td>
                              <h2 >Total Challan Value In Rs.(In Figures) :-<b id="BillSalesTotal"> <?php echo $total=((isset($OrderPalletDetail[0]->OrderpalletdetailTotal))?$OrderPalletDetail[0]->OrderpalletdetailTotal:0)+((isset($OrderPalletDetail[1]->OrderpalletdetailTotal))?$OrderPalletDetail[1]->OrderpalletdetailTotal:0)+((isset($OrderPalletDetail[2]->OrderpalletdetailTotal))?$OrderPalletDetail[2]->OrderpalletdetailTotal:0);?></b></h2>
                              Total Invoice Amount in Words :<b><span id="AmountInWords">Only</span></b>
                              <br>
                              <h2>Return Of returnable packing matearial</h2>
                          </td>
                      
                      </tr>
                      
                    </table>
                      
                      <table class="table text-left border">
                            <thead>
                          <tr>
                            <th>consigneeName</th>
                            <th>HSN Code</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Total(Rs.)</th>
                          </tr>
                        </thead>  
                        <?php
                          for($i=0;$i<count($OrderPalletDetail2);$i++)
                          {
                      ?>
                        <tr>
                              <td><?=$OrderPalletDetail2[$i]->Orderpalletdetail2Name?></td>
                              <td><?=isset($OrderPalletData[0]->OrderpalletHsnCode)?$OrderPalletData[0]->OrderpalletHsnCode:'996511'?></td>
                              <td><?=$OrderPalletDetail2[$i]->Orderpalletdetail2Qty?></td>
                              <td> <?=$OrderPalletDetail2[$i]->Orderpalletdetail2Rate?></td>
                              <td> <?=($OrderPalletDetail2[$i]->Orderpalletdetail2Rate * $OrderPalletDetail2[$i]->Orderpalletdetail2Qty)?></td>
                      </tr>
                      <?php
                          }
                      ?>
                    </table>
                    <table class="table text-left border">
                        <tr>
                          <td>
                              <h2>Recipient's Order No:-</h2>
                              <h2>Mode Of transport: By road</h2>
                              <h2>Transporter Name:</h2>
                              <h2>Consignment Note No/Date:</h2>
                              <h2>Vehical No :- <b><?=$OrderPalletData[0]->TempoName?></b></h2>
                          </td>
                          <td>
                              <h3 class="text-right">Party Code :- <b><?=$OrderPalletData[0]->OrderpalletPartycode;?></b></h3>
                          </td>
                      </tr>
                      
                    </table> 
                    
                    <table class="table text-left border">
                        <tr>
                          <td>
                              <h2>Receiver Singnature:</h2>
                              
                          </td>
                          <td>
                              <h4 class="text-right">FOR,MAHENDRA ROADLINES</h4>
                          </td>
                      </tr>
                      <tr>
                          <td style="border: 0;"></td>
                          <td style="border: 0;" class="float-right">Authorised Signature &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>
                      </tr>
                    </table>
                    
                    <!--<table class="table text-left border">-->
                    <!--   <tr>-->
                    <!--       <td>-->
                    <!--           <h2>Principal Place Of Business(Suppller)</h2>-->
                    <!--       </td>-->
                    <!--   </tr>-->
                    <!--</table>-->
                    
                    <table class="table text-left border">
                        <tr>
                            <td>
                                <h2>Principal Place Of Business(Suppller)</h2>
                            </td>
                      </tr>
                      <tr>
                            <td>
                                <h2>Regd. Office:</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                1-)Certified that all the particulers given above are ture and correct.This amounts indicate representes the price actually charged<br>
                                and there is no flow of additional considaration directly of indirectly from the Reciplent.<br>
                                The normal terms governing the above sale are printed overleaf. &nbsp &nbsp
                                E&O<br>
                                -The above document to be generated in triplicate:<br>
                                -the original copy so be marked as "DUPLICATE FOR TRANSPORTER"<br>
                                -the triplicate copy to be marked as "TRIPLICATE FOR CONSIGNOR"
                            </td>
                        </tr>
                        <!--<tr>-->
                        <!--    <td>-->
                        <!--        The above document to be generated in triplicate:<br>-->
                        <!--        the original copy so be marked as "DUPLICATE FOR TRANSPORTER"<br>-->
                        <!--        the triplicate copy to be marked as "TRIPLICATE FOR CONSIGNOR"-->
                        <!--    </td>-->
                        <!--</tr>-->
                    </table>
              </div>
                
                
              <!-- old bill coding start     ==========================================================-->                 
                
              <!-- /.col -->
            </div>
            
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
