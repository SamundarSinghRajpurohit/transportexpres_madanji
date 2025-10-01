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
                     
                        <!--?php print_r($OrderData);?-->
                        <!--Date Format change -->
                        <?php
                        $date1 = strtotime($InvoiceDate['InvoiceDate']);
                        $newformat3 = date('d-F-Y',$date1);
                        
                   
                        $date1 = strtotime($Date['From']);
                        $newformat1 = date('d-F-Y',$date1);
                        
                        $date2 = strtotime($Date['To']);
                        $newformat2 = date('d-F-Y',$date2);
                        ?>
                      
                      <table class="table text-left table-bordered chota-table">
                          <thead>
                            <!--<tr>-->
                            <!--    <th>Sr No.</th>-->
                            <!--  <th>Lr No</th>-->
                            <!--  <th>Tempo</th>-->
                            <!--  <th>Lr Date</th>-->
                            <!--  <th>Product</th>-->
                            <!--  <th>Consignee</th>-->
                            <!--  <th>To</th>-->
                            <!--  <th>Box</th>-->
                            <!--  <th>Packing</th>-->
                            <!--  <th>Weight</th>-->
                            <!--  <th>Freight</th>-->
                            <!--  <th>Hamali</th>-->
                            <!--  <th>Rate</th>-->
                            <!--  <th>Total</th>-->
                            <!--</tr>-->
                         </thead>
                        <?php
                        //check_p($reportData);
                            $record = array();
                            $name = array();
                            $total=0;
                            $totalWeight=0;
                            $flag=0;
                            $cnt=0;
                            foreach($reportData as $key=>$value)
                            {
                              if(!in_array($value['OrderId'], $name))
                              {
                                  $name[] = $value['OrderId'];
                                  $record[$key] = $value;
                              }
                            }
                            $record = array_values($record);
                           // check_p($record);
                            
                
                            for($j=0;$j<count($dealerData);$j++)  
                            {
                                
                            ?>
                            
                            <?php
                            $tempcnt=0;
                            for($i=0;$i<(count($record));$i++)
                            { 
                            ?>
                                  
                                    <tr>
                                        <?php
                                        if($dealerData[$j]['DealerId']==$record[$i]['DealerId'])
                                        {
                                            if($flag==0)
                                            {  
                                            ?>
                                                    <tr>
                                                            <td colspan=3>
                                                                <img src="<?=base_url('resources/images/')?><?=$CompanyData[0]->CompanyLogo?>" style="height:75px; width:75px;" alt="AdminLTE Logo" class=" ">
                                                            </td>
                                                            <td colspan=5>
                                                                <h3><b><?=$CompanyData[0]->CompanyName?></b></h3>
                                                                <h5><?=$CompanyData[0]->CompanyAddress?></h5>
                                                                
                                                            </td>
                                                            <td class="text-right" colspan=6>
                                                                <h4>(Mo)<?=$CompanyData[0]->CompanyPhoneNo?></h4>
                                                                <b>Bank Name</b> :- <?=$CompanyData[0]->CompanyBankName?><br>
                                                                <b>A/C No</b> :- <?=$CompanyData[0]->CompanyAccountNo?><br>
                                                                <b>IFSC CODE</b> :- <?=$CompanyData[0]->CompanyIFSCCode?><br>
                                                                <b>A/C TYPE</b> :- <?=$CompanyData[0]->CompanyAccountType?><br>
                                                                <b>GST No.</b> :- <?=$CompanyData[0]->CompanyGSTno?><br>
                                                                <b>Pancard No.</b> :- <?=$CompanyData[0]->CompanyPanCartNo?>
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=5>Bill To:-<b><?=$dealerData[$j]['DealerName']?></b></td>
                                                        <td colspan=1>Tax Invoice No : <?=(int)$InvoiceNo['InvoiceNo'] + $cnt?></td>
                                                        <td colspan=3>Invoice Date :<?=$newformat3;?></td>
                                                        <td colspan=5><?=$newformat1?> to <?=$newformat2?></td>
                                                        <tr>
                                                          <th>Sr No.</th>
                                                          <th>Lr No</th>
                                                          <th>Tempo</th>
                                                          <th>Lr Date</th>
                                                          <th>Product</th>
                                                          <th>Consignee</th>
                                                          <th>To</th>
                                                          <th>Box</th>
                                                          <th>Packing</th>
                                                          <th>Weight</th>
                                                          <th>Freight</th>
                                                          <th>Hamali</th>
                                                          <th>Rate</th>
                                                          <th>Total</th>
                                                        </tr>
                                                    </tr>
                                                    <?php
                                                        $flag=1;
                                                        $cnt=$cnt+1;
                                                        $tempcnt=0;
                                            }
                                            ?>
                                                    <td><?=($tempcnt=$tempcnt+1)?></td>
                                                    <?php 
                                                    if($record[$i]['OrderCustomLRNO'] == " ")
                                                    {
                                                    ?>
                                                        <td><?=$record[$i]['OrderLRNO']?></td>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                        <td><?=$record[$i]['OrderCustomLRNO']?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td><?=$record[$i]['TempoName']?></td>
                                                    <td><?=$record[$i]['OrderDate']?></td>
                                                    <td><?=$record[$i]['OrderdetailProductName']?></td>
                                                    <td><?=$record[$i]['ConsigneeName']?></td>
                                                    <td><?=$record[$i]['OrderTo']?></td>
                                                    <td><?=$record[$i]['OrderTotalBoxes']?></td>
                                                    <td><?=$record[$i]['OrderdetailName']?></td>
                                                    <td><?=$record[$i]['OrderTotalWeight']?></td>
                                                    <td><?=$record[$i]['OrderFreight']?></td>
                                                    <td ><?=$record[$i]['OrderHamali']?></td>
                                                    <td ><?=$record[$i]['OrderRate']?></td>
                                                    <td ><?=round($record[$i]['OrderTotal'])?></td>
                                                </tr> 
                                           <?php 
                                           $total=$total+$record[$i]['OrderTotal'];
                                           $totalWeight=$totalWeight+$record[$i]['OrderTotalWeight'];
                                         }
                                        else
                                        {
                                             
                                            if($flag==1)
                                            {
                                             ?>
                                             <tr>
                                                <td colspan=9 class="table text-right border">
                                                    <!--<b>Total Amount</b>:-<b> <?=$total?></b>-->
                                                </td>
                                                 <td class="table text-right border">
                                                    <b><?=$totalWeight?></b>
                                                </td>
                                                <td colspan=3 class="table text-right border">
                                                    <!--<b>Total Amount</b>:-<b> <?=$total?></b>-->
                                                </td>
                                                 <td class="table text-right border">
                                                    <b><?=round($total)?></b>
                                                </td>
                                             </tr>
                                             <tr>
                                                 <td colspan=14>
                                                     <h2>Terms & Condition:</h2>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td colspan=14>
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
                                             <tr>
                                                 <td colspan=5>
                                                     <h5>Service Tax to be Born By</h5>
                                                     <!--<img src="http://transportexpert.idnmserver.com/resources/blanckImage.png" style="height:20px; width:20px;" alt="AdminLTE Logo">Consignor<br>-->
                                                     <!--<img src="http://transportexpert.idnmserver.com/resources/blanckImage.png" style="height:20px; width:20px;" alt="AdminLTE Logo">Consignee<br>-->
                                                     <!--<img src="http://transportexpert.idnmserver.com/resources/blanckImage.png" style="height:20px; width:20px;" alt="AdminLTE Logo">G.T.A -->
                                                 </td>
                                                <td colspan=3>
                                                    <h2>Receiver's Singnature <br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp With Stamp:</h2>
                                                </td>
                                                <td colspan=6>
                                                    <h5 class="text-right">Carriers are not responsible<br>&nbsp for brakage and leakage &nbsp&nbsp&nbsp&nbsp</h5>
                                                    <h5 class="text-right" ><b>FOR,<?=$CompanyData[0]->CompanyName?></b></h5>
                                                    <img src="<?=base_url('resources/sign.jpeg')?>" style="height:121px; width:248px;" alt="AdminLTE Logo" class=" ">
                                                </td>
                                            </tr>
                                              
                                                <!--custom line for next page-->
                                                <?php for($k=(($tempcnt+4)%26);$k<=26-6;$k++)
                                                { ?>
                                                    <tr style="border: 0;"> 
                                                        <td colspan=14><br><br></td>
                                                    </tr>
                                                    <?php
                                                }?>
                                             <?php
                                             }
                                             $flag=0;
                                             $total=0;
                                             $totalWeight=0;
                                        }
                            }
                        }
                        ?>
                        
                        <tbody>
                        
                        </tbody>
                      </table>
                      
                      
                      
                      <!--<table class="table text-left border">-->
                      <!--   <tr>-->
                      <!--       <td>-->
                      <!--           <h2>Terms & Condition:</h2>-->
                      <!--       </td>-->
                      <!--   </tr>-->
                      <!--   <tr>-->
                      <!--       <td>-->
                      <!--          <small> 1-)The consignment will not be Re-routed or Divered Without consignee's written permission.<br>-->
                      <!--           2-)<b>Notice</b>:-The consignment covered bt this set special lorry recepit from shall be stored at destination under control of transport opeator and shall be delivered-->
                      <!--           to or to the consignee's whose name is mentioned in the lorry receipt it will under no circumstancesdelivered to any one without the written authority from the consignee;s-->
                      <!--           or it's order endorsed on consignee's copy on separate letteror authority.<br>-->
                      <!--           3-)<b>Declaration For Cenvet Credit:</b>"we here by certify that we have not availed credit of duty paid on inputs on capital goods under the provision-->
                      <!--               of convert credit rule,2004 nor we have availed the benifit of notification no 12/2003-st Dated 20-06-2003"</br>-->
                      <!--           4-)The company has stated that has not insured the consignument or he has insured the consignment<br></small>-->
                                    <!--Company___________________<br>-->
                                    <!--Policy No.____________________-->
                      <!--       </td>-->
                      <!--   </tr>-->
                        
                      <!--</table>-->
                      <!--<table class="table text-left border">-->
                      <!--   <tr>-->
                      <!--       <td>-->
                      <!--           <h5>Service Tax to be Born By</h5>-->
                                 <!--<img src="http://transportexpert.idnmserver.com/resources/blanckImage.png" style="height:20px; width:20px;" alt="AdminLTE Logo">Consignor<br>-->
                                 <!--<img src="http://transportexpert.idnmserver.com/resources/blanckImage.png" style="height:20px; width:20px;" alt="AdminLTE Logo">Consignee<br>-->
                                 <!--<img src="http://transportexpert.idnmserver.com/resources/blanckImage.png" style="height:20px; width:20px;" alt="AdminLTE Logo">G.T.A -->
                      <!--       </td>-->
                      <!--      <td>-->
                      <!--          <h2>Receiver's Singnature <br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp With Stamp:</h2>-->
                      <!--      </td>-->
                      <!--      <td>-->
                      <!--          <h5 class="text-right">Carriers are not responsible<br>&nbsp for brakage and leakage &nbsp&nbsp&nbsp&nbsp</h5>-->
                      <!--      </td>-->
                      <!--  </tr>-->
                      <!--  <tr>-->
                      <!--      <td style="border: 0;" ></td>-->
                      <!--      <td style="border: 0;"></td>-->
                      <!--      <td style="border: 0;" class="float-right"><h5 class="text-right"><b>FOR,<?=$CompanyData[0]->CompanyName?></b></h5></td>-->
                      <!--  </tr>-->
                      <!--</table>-->
                      
                      
                      
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
