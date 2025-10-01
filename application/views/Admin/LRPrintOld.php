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
                     <table class="table text-left border">
                        <tr>
                            <td>
                                <img src="<?=base_url('resources/images/')?><?=$CompanyData[0]->CompanyLogo?>" style="height:75px; width:75px;" alt="AdminLTE Logo" class=" ">
                            </td>
                            <td>
                                <h3><b><?=$CompanyData[0]->CompanyName?></b></h3>
                                <h5><?=$CompanyData[0]->CompanyAddress?></h5>
                            </td>
                            <td class="text-right">
                                <h4>(Mo)<?=$CompanyData[0]->CompanyPhoneNo?></h4>
                                <b>Bank Name</b> :- <?=$CompanyData[0]->CompanyBankName?><br>
                                <b>A/C No</b> :- <?=$CompanyData[0]->CompanyAccountNo?><br>
                                <b>IFSC CODE</b> :- <?=$CompanyData[0]->CompanyIFSCCode?><br>
                                <b>A/C TYPE</b> :- <?=$CompanyData[0]->CompanyAccountType?>
                            </td>
                        </tr>
                        </table>
                        <!--?php print_r($OrderData);?-->
                    <table class="table text-left border">
                        <tr>
                           
                            <td>
                                 <!--<h5>Consignor : <?=$OrderData[0]->ConsignorName?></h5>-->
                                 <h5 class="samu">Eway Bill No :-<?=$OrderData[0]->OrderEwayBillNo?></h5>
                                 <h5>Delivery From :<?=$OrderData[0]->OrderTo?></h5>
                                 <h5>Consignee :<?=$OrderData[0]->ConsigneeName?></h5></td>
                            </td>
                            <td>
                                <!--<h5>Gst No: <?=$CompanyData[0]->CompanyGSTno?></h5>-->
                                <h5>Date : <?=$OrderData[0]->OrderDate?></h5>
                                 <?php
                                    if($OrderData[0]->OrderCustomLRNO == " ")
                                    {
                                ?>
                                <h5 class="samu">LRNO : <?=$OrderData[0]->OrderLRNO?></h5>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                <h5 class="samu">LRNO : <?=$OrderData[0]->OrderCustomLRNO?></h5>
                                <?php
                                    }
                                ?>
                                <h5>From : <?=$OrderData[0]->OrderFrom?> &nbsp To :-<?=$OrderData[0]->OrderTo?></h5>
                            </td>
                            <td> 
                                <h5>Dealer's Name :<?=$OrderData[0]->DealerName?></h5>
                                <h5>Delivery Add. : <?=$OrderData[0]->OrderAddress?></h5>
                                <!--<h5>Invoice No:<?=$OrderData[0]->OrderId?></h5>-->
                                <h5>Vehicle No :<?=$OrderData[0]->TempoName?></h5>
                            </td>
                        </tr>
                       
                        </table>
                      
                      
                      <table class="table text-left table-bordered chota-table">
                          <thead>
                            <tr>
                              <th>Sr.</th>
                              <th>Good</th>
                              <!--<th>Rate No</th>
                              <th>Rate</th>-->
                              <th>Box</th>
                              <th>Packing</th>
                              <th>Weight</th>
                              <th>DCPI No</th>
                            </tr>
                         </thead>
                        <?php
                           // print_r($orderDetail);
                            for($i=0;$i<count($orderDetail);$i++)
                            {
                            ?>
                                    <tr>
                                        <td><?=($i+1)?></td>
                                        <td><?=$orderDetail[$i]->OrderdetailProductName?></td>
                                        <td><?=$orderDetail[$i]->OrderdetailBox?></td>
                                        <td><?=$orderDetail[$i]->OrderdetailName?></td>
                                        <td><?=$orderDetail[$i]->OrderdetailWeight?></td>
                                        <td><?=$orderDetail[$i]->OrderdetailDcpiNo?></td>
                                       
                                    </tr> 
                               <?php 
                            }
                        ?>
                        
                        <tbody>
                        
                        </tbody>
                      </table>
                      
                      
                      
                      <table class="table text-left border">
                         <tr>
                             <td>
                                 <h2>Terms & Condition:</h2>
                             </td>
                         </tr>
                         <tr>
                             <td>
                                <small> 1-)The consignment will not be Re-routed or Divered Without consignee's written permission.<br>
                                 2-)<b>Notice</b>:-The consignment covered bt this set special lorry recepit from shall be stored at destination under control of transport opeator and shall be delivered
                                 to or to the consignee's whose name is mentioned in the lorry receipt it will under no circumstancesdelivered to any one without the written authority from the consignee;s
                                 or it's order endorsed on consignee's copy on separate letteror authority.<br>
                                 3-)<b>Declaration For Cenvet Credit:</b>"we here by certify that we have not availed credit of duty paid on inputs on capital goods under the provision
                                     of convert credit rule,2004 nor we have availed the benifit of notification no 12/2003-st Dated 20-06-2003"</br>
                                 4-)The company has stated that has not insured the consignument or he has insured the consignment<br></small>
                                    <!--Company___________________<br>-->
                                    <!--Policy No.____________________-->
                             </td>
                         </tr>
                        
                      </table>
                      <table class="table text-left border">
                         <tr>
                             <td>
                                 <h5>Service Tax to be Born By</h5>
                                 <!--<img src="http://transportexpert.idnmserver.com/resources/blanckImage.png" style="height:20px; width:20px;" alt="AdminLTE Logo">Consignor<br>-->
                                 <!--<img src="http://transportexpert.idnmserver.com/resources/blanckImage.png" style="height:20px; width:20px;" alt="AdminLTE Logo">Consignee<br>-->
                                 <!--<img src="http://transportexpert.idnmserver.com/resources/blanckImage.png" style="height:20px; width:20px;" alt="AdminLTE Logo">G.T.A -->
                             </td>
                            <td>
                                <h2>Receiver's Singnature <br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp With Stamp:</h2>
                            </td>
                            <td>
                                <h5 class="text-right">Carriers are not responsible<br>&nbsp for brakage and leakage &nbsp&nbsp&nbsp&nbsp</h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0;" ></td>
                            <td style="border: 0;"></td>
                            <td style="border: 0;" class="float-right"><h5 class="text-right"><b>FOR,<?=$CompanyData[0]->CompanyName?></b></h5></td>
                        </tr>
                      </table>
                </div>
                <div class="row no-print">
                   <div class="col-12">
                        <button onclick="printBill()" target="_blank" class="btn btn-pri"><i class="fa fa-print"></i> Print</button>
                   </div>
                </div>
              </div>
              <!--<div class="row no-print">
                <div class="col-12">
                     <button onclick="printBill()" target="_blank" class="btn btn-pri"><i class="fa fa-print"></i> Print</button>
                </div>
              </div>-->
            </div>

                </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
          
        </div><!-- /.row -->
       

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
       //window.print(); 
       }
</script>
