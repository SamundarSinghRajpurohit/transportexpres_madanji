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

                    <!-- sjr add form here 31-12-2023 -->
                    <div class="mb-5 no-print">
                        <div class="card-body invoice" id="BillBody11">
                            <form id="gstValueUpdate" name="gstValueUpdate" method="POST">
                                <?php
                                $record = array();
                                $name = array();
                                $other = array();
                                $total=0;
                                $totalWeight=0;
                                $totalGSTAmount=0;
                                $mainTotal=0;
                                foreach($reportData as $key=>$value)
                                {
                                if(!in_array($value['OrderpalletId'], $name))
                                {
                                    $name[] = $value['OrderpalletId'];
                                    $record[$key] = $value;
                                }
                                else
                                {
                                    $other[$key] = $value;
                                }
                                }
                                $other = array_values($other);
                                $record = array_values($record);


                                $OrderId="";
                                for($i=0;$i<(count($record));$i++)
                                {
                                    if($i == count($record) -1)
                                        $OrderId .=$record[$i]['OrderpalletId'];
                                    else
                                        $OrderId .=$record[$i]['OrderpalletId'].',';
                                } 
                                ?>
                                <input type="hidden" name="OrderpalletId" value='<?=$OrderId;?>'>
                                <input type="hidden" name="orderBillDate" value='<?=$InvoiceDate['InvoiceDate'];?>'>
                                <div class="form-row col-12">
                                    <div class="form-group col-md-3 col-12">
                                        <label for="inputEmail4">Gst Invoice No.</label>
                                        <input type="text" class="form-control" name="gstInvoiceNo" id="gstInvoiceNo" value="<?=$_POST['InvoiceNo']; ?>" placeholder="Enter Gst Invoice No">
                                    </div>
                                    <div class="form-group col-md-3 col-12">
                                        <label for="inputPassword4">Date From</label>
                                        <input type="date" class="form-control" id="fromDate" name="fromDate" value="<?=$_POST['FromDate']?>">
                                    </div>
                                    <div class="form-group col-md-3 col-12">
                                        <label for="inputPassword4">Date To</label>
                                        <input type="date" class="form-control" id="toDate" name="toDate" value="<?=$_POST['ToDate']?>">
                                    </div>
                                    <div class="form-group col-md-3 col-12">
                                        <label for="inputPassword4"></label>
                                        <button type="submit" class="form-control btn btn-primary" id="gstInvoiceUpdateButton">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- sjr end -->

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
                                            <h5><?=$CompanyData[0]->CompanyEmailId?></h5>
                                        </td>
                                        <td class="text-right">
                                            <h4>(Mo)<?=$CompanyData[0]->CompanyPhoneNo?></h4>
                                            <b>Bank Name</b> :- <?=$CompanyData[0]->CompanyBankName?><br>
                                            <b>A/C No</b> :- <?=$CompanyData[0]->CompanyAccountNo?><br>
                                            <b>IFSC CODE</b> :- <?=$CompanyData[0]->CompanyIFSCCode?><br>
                                            <b>A/C TYPE</b> :- <?=$CompanyData[0]->CompanyAccountType?><br>
                                            <b>GST No.</b> :- <?=$CompanyData[0]->CompanyGSTno?><br>
                                            <b>Pancard No.</b> :- <?=$CompanyData[0]->CompanyPanCartNo?>
                                        </td>
                                    </tr>
                                    </table>
                                    <!--?php print_r($OrderData);?-->
                                <table class="table text-left border">
                                    <tr>
                                    
                                        <td>
                                            <?php
                                                
                                            ?><?php
                                                if(empty($DealerData1))
                                                {
                                            ?>
                                            <h5 class="samu">Billed to :-<?=$DealerData[0]->DealerName?></h5>
                                            <h5 class="samu">GST No. :-<?=$DealerData[0]->DealerGSTNO?></h5>
                                            <h5><?=$DealerData[0]->DealerAddress?></h5>
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <h5 class="samu">Billed to :<?=$DealerData1['DealderName']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                        
                                        </td>
                                        <td class="border"> 
                                            <!--<h5>Dealer's Name :<?=$OrderData[0]->DealerName?></h5>-->
                                            <!--<h5>Delivery Add. : <?=$OrderData[0]->OrderAddress?></h5>-->
                                            <!--<h5>Invoice No:<?=$OrderData[0]->OrderId?></h5>-->
                                            <!--<h5>Vehicle No :<?=$OrderData[0]->TempoName?></h5>-->
                                            <h5>Invoice</h5>
                                            <h5>Tax Invoice No:<?=$InvoiceNo['InvoiceNo']?></h5>
                                            <?php
                                                $date1 = strtotime($InvoiceDate['InvoiceDate']);
                                                $newformat3 = date('d-F-Y',$date1);
                                                
                                            ?>
                                            <h5>Invoice Date:<?=$newformat3;?></h5>
                                            <?php
                                                $date1 = strtotime($Date['From']);
                                                $newformat1 = date('d-F-Y',$date1);
                                                
                                                $date2 = strtotime($Date['To']);
                                                $newformat2 = date('d-F-Y',$date2);
                                                
                                            ?>
                                            <h5><?=$newformat1?> to <?=$newformat2?></h5>
                                        </td>
                                    </tr>
                                
                                    </table>
                                
                                
                                <table class="table text-left table-bordered chota-table">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                        <th>Lr No</th>
                                        <th>HSN Code</th>
                                        <th>Tempo</th>
                                        <th>Lr Date</th>
                                        
                                        <th>Consignee</th>
                                        <th>Total Pallet</th>
                                        <th>Rate</th>
                                        <th>Sub Total</th>
                                        <th>GST %</th>
                                        <th>GST Amount</th>
                                        <th>Total</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        for($i=0;$i<count($record);$i++)
                                        {
                                            $name='';
                                            for($j=0;$j<count($other);$j++)
                                            {
                                                if($record[$i]['OrderpalletId']==$other[$j]['OrderpalletId'])
                                                {
                                                    $name=$name.$other[$j]['Orderpalletdetail2Name'] .' - ';
                                                    $record[$i]['secondname']=$name;    
                                                }
                                            }
                                        }

                                        $maintotal=0;
                                        $subtotal=0;
                                        $subPalletTotal=0;
                                        for($i=0;$i<(count($record));$i++)
                                        { 
                                            $total=0;
                                        
                                        ?>
                                                <tr>
                                                    <td><?=($i+1)?></td>
                                                    
                                                    <?php 
                                                    if($record[$i]['OrderpalletLRNO'] == "")
                                                    {
                                                    ?>
                                                        <td><?=$record[$i]['OrderpalletLRNOauto']?></td>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                        <td><?=$record[$i]['OrderpalletLRNO']?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td><?=$record[$i]['OrderpalletHsnCode']!=""?$record[$i]['OrderpalletHsnCode']:'996511'?></td>
                                                    <td><?=$record[$i]['TempoName']?></td>
                                                    <td><?=$record[$i]['OrderpalletDate']?></td>
                                                    <td><?=$record[$i]['Orderpalletdetail2Name'].'-'?><?=(isset($record[$i]['secondname']))?$record[$i]['secondname']:'' ?></td>
                                                    <td><?=$record[$i]['OrderpalletTotalQty']?></td>
                                                    <td><?=$record[$i]['Orderpalletdetail2Rate']?></td>
                                                    <!-- <td><?=$total=$total+($record[$i]['OrderpalletTotalQty'] * $record[$i]['Orderpalletdetail2Rate'])?></td> -->

                                                    <!--  -->
                                                    <?php 
                                                        $subTotalPallet = 0;
                                                        $subTotalPallet = round($record[$i]['OrderpalletTotalQty'] * $record[$i]['Orderpalletdetail2Rate']);
                                                    ?>
                                                    <td ><?=$subTotalPallet?></td>
                                                    <td ><?=$record[$i]['OrderpalletGSTPer']?></td>
                                                    <?php 
                                                        $gstAmount = 0 ;
                                                        $gstAmount = round(($subTotalPallet * $record[$i]['OrderpalletGSTPer']) / 100);
                                                    ?>
                                                    <td ><?=($gstAmount)?></td>
                                                    <td ><?=($subTotalPallet + $gstAmount)?></td>
                                                    <!--  -->
                                                </tr> 
                                        <?php 
                                        $subtotal=$subtotal+$subTotalPallet;
                                        $subPalletTotal=$subPalletTotal+$record[$i]['OrderpalletTotalQty'];
                                        $totalGSTAmount = $totalGSTAmount + $gstAmount;
                                        //$total=$total+$record[$i]['OrderTotal'];
                                        //   $totalWeight=$totalWeight+$record[$i]['OrderTotalWeight'];
                                        }
                                    ?>
                                    <tr>
                                        <td colspan=6 class="table text-right border">
                                            
                                        </td>
                                        <td  class="table text-right border">
                                        <b><?=$subPalletTotal?></b>
                                        </td>
                                        <td  class="table text-right border">
                                        </td>
                                        <td  class="table text-right border">
                                        <b><?=$subtotal?></b>
                                        </td>
                                        <td  class="table text-right border">
                                        </td>
                                        <td  class="table text-right border">
                                        <b><?=round($totalGSTAmount)?></b>
                                        </td>
                                        <td  class="table text-right border">
                                        <b><?=round($subtotal + $totalGSTAmount)?></b>
                                        </td>
                                    </tr>

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
                                        <td style="border: 0;" class="float-right"><h5 class="text-right"><b>FOR,<?=$CompanyData[0]->CompanyName?></b></h5>
                                        <img src="<?=base_url('resources/sign.jpeg')?>" style="height:121px; width:248px;" alt="AdminLTE Logo" class=" ">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row no-print">
                            <div class="col-12">
                                    <button onclick="printBill()" target="_blank" class="btn btn-pri"><i class="fa fa-print"></i> Print</button>
                            </div>
                            </div>
                        </div>
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

<!-- <script src="<?=site_url('resources/assets/custom.js')?>"></script> -->

<!-- sjr add 31-12-2023 -->
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script>
function printBill() {
  window.print();
}

$("#gstValueUpdate").submit(function(e) {
    e.preventDefault();
    $('#gstInvoiceUpdateButton').html("<i class='fa fa-spinner' aria-hidden='true'></i>");
    var form = $(this);
    var actionUrl = "<?=base_url('Admin/Ajax/GstInvoiceUpdatePallet')?>";
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
        success: function(data)
        {
            if(data == 1)
            {
                alert('Gst invoice number updated successfully');
                $('#gstInvoiceUpdateButton').html("Update");
            }
            else
            {
                alert('Gst invoice number not updated');
                $('#gstInvoiceUpdateButton').html("Update");
            }
        }
    });
});
</script>
<!-- sjr end -->