<style>
.table td, .table th {
     padding: .25rem !important; 
}

/* Add this for print */
@media print {
    .table, .table th, .table td {
        font-size: 11px !important;
        padding: 2px !important;
        word-break: break-word;
    }
    .chota-table {
        table-layout: fixed;
        width: 100% !important;
    }
    .chota-table th, .chota-table td {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    body, html {
        margin: 0;
        padding: 0;
    }
}
@page {
    size: landscape;
}
</style>
<div class="content-wrapper">
    <section class="content">

        <div class="row">
          <div class="col-12">
               <div id="BillCard">
                <div class="card-body" id="BillBody">

                    <!-- sjr add form here 28-12-2023 -->
                    <div class="mb-5 no-print">
                        <div class="card-body invoice" id="BillBody11">
                            <form id="gstValueUpdate" name="gstValueUpdate" method="POST">
                                <?php 
                                $record = array();
                                $name = array();
                                $total=0;
                                $totalWeight=0;
                                $totalGSTAmount=0;
                                $mainTotal=0;
                                foreach($reportData as $key=>$value)
                                {
                                    if(!in_array($value['OrderId'], $name))
                                    {
                                        $name[] = $value['OrderId'];
                                        $record[$key] = $value;
                                    }
                                }
                                $record = array_values($record);

                                $OrderId="";
                                for($i=0;$i<(count($record));$i++)
                                {
                                    if($i == count($record) -1)
                                        $OrderId .=$record[$i]['OrderId'];
                                    else
                                        $OrderId .=$record[$i]['OrderId'].',';
                                } 
                                ?>
                                <input type="hidden" name="orderId" value='<?=$OrderId;?>'>
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

                        <!-- download pdf start -->
                        <!-- <div class="col-12 mb-2 row" style="margin-top: 17px;">
                            <div class="col-9"></div>
                            <div class="col-3">
                                <button onclick="sendMail('<-?=$pdfDealerId?>','<-?=$pdfToDate?>','<-?=$pdfFromDate?>')">Download PDF & Send Mail</button> -->
                                <!-- <button type="submit" class="form-control btn btn-primary" id="gstInvoiceUpdateButton">Download PDF</button> -->
                            <!-- <div> -->
                        <!-- </div></div> -->
                        <!-- end -->
                    </div>
                    <!-- sjr end -->

                    <div class="invoice p-3 mb-3">
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
                                        <th>Product</th>
                                        <th>Consignee</th>
                                        <th>To</th>
                                        <th>Box</th>
                                        <th>Packing</th>
                                        <th>Weight</th>
                                        <th>Freight</th>
                                        <th>Hamali</th>
                                        <th>Rate</th>
                                        <th>Sub Total</th>
                                        <th>GST %</th>
                                        <th>GST Amount</th>
                                        <th>Total</th>
                                        </tr>
                                    </thead>
                                    <?php
                                // check_p($reportData);
                                        
                                    // check_p($record);
                                        
                                        for($i=0;$i<(count($record));$i++)
                                        { 
                                        ?>
                                                <tr>
                                                    <td><?=($i+1)?></td>
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
                                                    <td><?=$record[$i]['OrderHsnCode']!=""?$record[$i]['OrderHsnCode']:'996511'?></td>
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
                                                    <?php 
                                                        $subTotal = 0;
                                                        $subTotal = round($record[$i]['OrderTotal']);
                                                    ?>
                                                    <td ><?=$subTotal?></td>
                                                    <td ><?=$record[$i]['OrderGSTPer']?></td>
                                                    <?php 
                                                        $gstAmount = 0 ;
                                                        $gstAmount = round(($subTotal * $record[$i]['OrderGSTPer']) / 100);
                                                    ?>
                                                    <td ><?=($gstAmount)?></td>
                                                    <td ><?=($subTotal + $gstAmount)?></td>
                                                </tr> 
                                        <?php 
                                        $total=$total+$subTotal;
                                        $totalWeight=$totalWeight+$record[$i]['OrderTotalWeight'];
                                        $totalGSTAmount = $totalGSTAmount + $gstAmount;
                                        }
                                    ?>
                                    <tr>
                                        <td colspan=10 class="table text-right border">
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
                                        <td class="table text-right border">

                                        </td>
                                        <td class="table text-right border">
                                            <b><?=round($totalGSTAmount)?></b>
                                        </td>
                                        <td class="table text-right border">
                                            <b><?=round($total + $totalGSTAmount)?></b>
                                        </td>
                                    </tr>
                                    <!-- <tr>-->
                                    <!--    <td colspan=13 class="table text-right border">-->
                                    <!--        <b>Total Weight </b>:-<b> <?=$totalWeight?></b>-->
                                    <!--    </td>-->
                                    <!--</tr>-->
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
                                        <img src="<?=base_url('resources/sign.jpeg')?>" style="height:121px; width:248px;" alt="AdminLTE Logo" class=" "></td>
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
          </div>
        </div>
    </section>
</div>

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
    var actionUrl = "<?=base_url('Admin/Ajax/GstInvoiceUpdate')?>";
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

function sendMail($id,$toDate,$fromDate) {
  var lrMailSendUrl="<?=base_url('Admin/Dashboard/Dealer_pdf_downloadDifferent/')?>";
  var id = $id;
  var toDate = $toDate;
  var fromDate = $fromDate;

  var formData = new FormData();
  formData.append('id', id);
  formData.append('toDate', toDate);
  formData.append('fromDate', fromDate);
  // loader start
  $('#loader').show();

  $.ajax({
      type: 'POST',
      url: lrMailSendUrl + id,
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: function(response) {
        alert(response.message);
        $('#loader').hide();
      },
      error: function(xhr, status, error) {
        alert(xhr.responseText);
        $('#loader').hide();
      }
  });
}
</script>
<!-- sjr end -->
