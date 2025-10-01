		 <!-- Theme style -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/dist/css/adminlte.min.css')?>">
 <!-- Theme style -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/custom.css')?>">
 
<section class="content">
    <div class="row">
        <div class="col-12">
            <!-- Main content -->
                 <div class="card-body" id="PrintBody">
         
                  <div class="invoice p-3 mb-3">
                          <!-- title row -->
        <div class="row">
            <div class="col-12">
            	<div   style="text-align:center"><!--<img style="height:100px; width:100px;" src='<?=base_url('resources/admin/uploads/LOGO.png')?>'>-->
            	    <div style="height:100px; width:100px;"></div>
            	</div>
                <div  id="BillFirmName" class="custom-firm-name" style="text-align:center"><?=$mainData['FirmName']?></div>
                <div  style="text-align:center"><?=$mainData['FirmAddress']?></div>
                <div  style="text-align:center"><?=$mainData['FirmGSTno']?></div>
                <br>
                <div style="font-size:2em; font-weight:bold; background-color: lightgrey;text-align:center;">Purchase Bill</div>
            </div>
        </div>
        <hr>
        <!-- Customer row -->
        <div class="row">
            <div class="col-sm-5  float-left"><?php
           /* echo "<pre>";
            print_r($mainData)*/
            ?>
                <div><b class="cust-detail-font">Customer Name:</b><span class="cust-detail-font"><?=$mainData['VendorName']?></span></div>
                <div><b class="cust-detail-font">Phone No:</b><span class="cust-detail-font"><?=$mainData['VendorPhoneNo']?></span></div>
                
                <div><b class="cust-detail-font">Address:</b><span class="cust-detail-font"><?=$mainData['VendorAddress']?></span></div>
                <div><b class="cust-detail-font">Email Id:</b><span class="cust-detail-font"><?=$mainData['VendorEmailId']?></span></div>
                
                <div><b class="cust-detail-font">PAN No:</b><span class="cust-detail-font"><?=$mainData['VendorPANNo']?></span></div>
            <div><b class="cust-detail-font">GST No:</b><span class="cust-detail-font"><?=$mainData['VendorGSTNO']?></span></div>
            </div>	
                
            
                
            <div class="col-sm-3  float-left">
           <!--     <div><b class="cust-detail-font">Vechile No:</b><span class="cust-detail-font" id="JobcardCustomerVechileNo"><?=$mainData['CustomerVechileNo']?></span></div> 
                <div><b class="cust-detail-font">Engine No:</b><span class="cust-detail-font" id="JobcardCustomerEngineNo"><?=$mainData['CustomerEngineNo']?></span></div>
                <div><b class="cust-detail-font">Chassis No:</b><span class="cust-detail-font" id="JobcardCustomerChassisNo"><?=$mainData['CustomerChassisNo']?></span></div>
                <div><b class="cust-detail-font">Km :</b><span class="cust-detail-font" id="JobcardCustomerKm"><?=$mainData['CustomerKm']?></span></div>
                <div><b class="cust-detail-font">Vehicle Model Name:</b><span class="cust-detail-font" id="JobcardCustomerVechile"><?=$vehicleModelName?></span></div>
                <br>
                <div><b>Service Type :</b><span id="JobcardCustomerKm"><?=$mainData['JobCardServiceDropDown']?></span></div>
           --> </div>
            
            <!-- /.col -->
           <div class="col-sm-4 fload-left ">
           <!--         <div><b class="cust-detail-font">Job Card No:</b>JC/<span class="cust-detail-font" id="JobcardJobCardId"><?=$mainData['JobCardId']?></span></div>
                    <br>-->
                    <!--<div><b class="cust-detail-font">Date/Time:</b><span class="cust-detail-font"><?=$detailProductData["PurchasedetailCDT"]?></span></div>-->
                <!--    <div><b class="cust-detail-font">Job Card Date/Time:</b><span class="cust-detail-font" id="JobcardJobCardId"><?=$mainData['JobCardCDT']?></span></div>
                   	<br>
                    <div><b class="cust-detail-font">Mechanic Name:</b><span class="cust-detail-font" id="JobcardMechanic"><?=$mainData['MechanicName']?></span></div>
                    <div><b class="cust-detail-font">Advisory Name:</b><span class="cust-detail-font" id="JobcardAdvisory"><?=$mainData['AdvisoryName']?></span></div>-->
            </div>
        
        </div>
        <hr>
        <!-- Service row -->
        <div class="row ">
        
        <!-- /.col -->
        
        <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main Box row -->
            <div class="row">
                <div class="col-12 float-left  pre-invoice-div">
                    
                    <table class="pre-invoice-table" style="border: none !important">
                    
                        <tr>
                            <?php
                            foreach($tableHeading as $tableHeadingData)
                            {?>
                            
                            <th ><?=$tableHeadingData?></th>
                            <?php
                            }?>
                        </tr>
                    
                            <?php $i=0;
                            $GSTTotal5=0;
                            $GSTTotal12=0;
                            $GSTTotal18=0;
                            $GSTTotal28=0;
                            $Total=0;
                            $SubTotal=0;
                            $sub=0;
                            /*echo "<pre>";
                            print_r($detailProduct);*/
                            foreach($detailProduct as $detailProductData)
                            {   foreach($hsn as $hsnData)
                                {
                                    if($detailProductData['HsnId']==$hsnData['HsnId'])
                                    { $HsnCode=$hsnData['HsnName'];
                                      $HsnTax=$hsnData['HsnTax'];
                                      break;
                                    }
                                }
                                 /*foreach($productdetail as $productdetailData) //Nilesh 16/2/2021
                                {
                                    if($detailProductData['$ProductdetailId']==$productdetailData['$ProductdetailId'])
                                    { $ProductIdReference=$productdetailData['$ProductIdReference'];
                                      $ProductdetailName=$productdetailData['$ProductdetailName'];
                                      $ProductdetailImages=$productdetailData['$ProductdetailImages'];
                                      $ProductdetailBarcodeNo=$productdetailData['$ProductdetailBarcodeNo'];
                                      $ProductdetailNo=$productdetailData['$ProductdetailNo'];
                                      $ProductdetailExpiryDate=$productdetailData['$ProductdetailExpiryDate'];
                                      $ProductdetailSRP=$productdetailData['$ProductdetailSRP'];
                                      $ProductdetailMRP=$productdetailData['$ProductdetailMRP'];
                                      $ProductdetailPacking=$productdetailData['$ProductdetailPacking'];
                                      $ProductdetailQty=$productdetailData['$ProductdetailQty'];
                                      $ProductdetailLowStock=$productdetailData['$ProductdetailLowStock'];
                                     
                                      break;
                                    }
                                }*/
                            ?>
                            <tr>
                                <td class="pre-invoice-table-td"><?=$i+1;?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData["ProductName"]?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData["PackingName"]?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData["PurchasedetailMfgName"]?></td>
                                <td class="pre-invoice-table-td"><?=$HsnCode?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData["PurchasedetailBatchNo"]?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData["PurchasedetailExpiryDate"]?></td>
                                <td class="pre-invoice-table-td"><?=$HsnTax?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData["PurchasedetailProductQty"]?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData["PurchasedetailFreeDealQty"]?></td>
                               <!-- <td class="pre-invoice-table-td"><?=$detailProductData["PurchasedetailExpiryDate"]?></td>-->
                                <td class="pre-invoice-table-td">0.00</td>
                                 <td class="pre-invoice-table-td">0.00</td>
                               <!-- <td class="pre-invoice-table-td"><?=$detailProductData["PurchaseDiscount"]?></td>-->
                                <td class="pre-invoice-table-td"><?=$detailProductData["PurchasedetailProductMrp"]?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData["PurchasedetailProductSrp"]?></td>
                               
                            
                            <?php
                            $i++;
                            $sub=(int)($detailProductData["PurchasedetailProductSrp"] * (int)$detailProductData["PurchasedetailProductQty"]) /*- (int)$detailProductData["PurchaseDiscount"]*/;
                           //echo $sub;
                           ?><td class="pre-invoice-table-td"><?=$sub?></td>
                           <?php
                            $SubTotal=$SubTotal+$sub;
                            if($HsnTax==5)
                                $GSTTotal5=$GSTTotal5+$sub*0.05;
                            elseif($HsnTax==12)
                                $GSTTotal12=$GSTTotal12+$sub*0.12;
                            elseif($HsnTax==18)
                                $GSTTotal18=$GSTTotal18+$sub*0.18;
                            elseif($HsnTax==28)
                                $GSTTotal28=$GSTTotal28+($sub*0.28);
                                
                                          $Total=$Total+(int)($detailProductData["PurchasedetailProductSrp"]*(int)$detailProductData["PurchasedetailProductQty"]) /*- (int)$detailProductData["PurchaseDiscount"]*/;    
        
                            //$Total=$Total+$detailProductData['PreInvoiceTotal'];
                            
                            }
                            ?>
                            
                       
                        </tr>     
                    </table>
                   
                </div>
            </div>
                </div>
              <!-- /.row -->
              <!-- Sub Job Card -->
              <div class="footer-print">
                  <div class="row ">
                        <div class="col-3 pre-invoice-sub-footer-left">
                           <span>Recommendations:</span><br>
                          <span>Dealer GSTIN: 24ANWPP1633P1Z9 </span>
                            <span class="stick-to-bottom" style=" text-align:center">Authorised Signatory</span>
                            
                        </div>
                        <div class="col-9 pre-invoice-sub-footer-right">
                            <div class="row">
                                <div class="col-6">Sub Total Amount</div>
                                <div class="col-2 text-right"><?=$SubTotal?></div>
                                <div class="col-2 text-right">0.00</div>
                                <div class="col-2 text-right"><?=$Total?></div>
                            </div>
                            <br>
                            <?php 
                            if($GSTTotal5!==0)
                            {
                            ?>
                            <div class="row">
                                <div class="col-6">CGST(5%)</div>
                                <div class="col-2 text-right"><?=$GSTTotal5?></div>
                                <div class="col-2 text-right"></div>
                                <!--<div class="col-2 text-right"><?=$GSTTotal5/2?></div>-->
                            </div>
                            <div class="row">
                                <div class="col-6">SGST(5%)</div>
                                <div class="col-2 text-right"><?=$GSTTotal5?></div>
                                <div class="col-2 text-right"></div>
                                <div class="col-2 text-right"><?=$GSTTotal5/2?></div>
                            </div>
                            
                            <?php
                            }
                            if($GSTTotal12!==0)
                            {
                            ?>
                            <div class="row">
                                <div class="col-6">CGST(12%)</div>
                                <div class="col-2 text-right"><?=$GSTTotal12?></div>
                                <div class="col-2 text-right"></div>
                                <div class="col-2 text-right"><?=$GSTTotal12/2?></div>
                            </div>
                            <div class="row">
                                <div class="col-6">SGST(12%)</div>
                                <div class="col-2 text-right"><?=$GSTTotal12?></div>
                                <div class="col-2 text-right"></div>
                                <div class="col-2 text-right"><?=$GSTTotal12/2?></div>
                            </div>
                            
                            <?php
                            }
                            if($GSTTotal18!==0)
                            {
                            ?>
                            <div class="row">
                                <div class="col-6">CGST(9%)</div>
                                <div class="col-2 text-right"><?=$GSTTotal18/2?></div>
                                <div class="col-2 text-right"></div>
                                <!--<div class="col-2 text-right"><?=$GST/2?></div>-->
                            </div>
                            <div class="row">
                                <div class="col-6">SGST(9%)</div>
                                <div class="col-2 text-right"><?=$GSTTotal18/2?></div>
                                <div class="col-2 text-right"></div>
                                <!--<div class="col-2 text-right"><?=$GST/2?></div>-->
                            </div>
                            
                            <?php
                            }else
                            {
                            ?>
                            <div class="row">
                                <div class="col-6">CGST(9%)</div>
                                <div class="col-2 text-right"></div>
                                <div class="col-2 text-right"></div>
                                <!--<div class="col-2 text-right"><?=$GST/2?></div>-->
                            </div>
                            <div class="row">
                                <div class="col-6">SGST(9%)</div>
                                <div class="col-2 text-right"></div>
                                <div class="col-2 text-right"></div>
                              <!--  <div class="col-2 text-right"><?=$GST/2?></div>-->
                            </div>
                            
                            <?php
                            }
                            if($GSTTotal28!==0)
                            {
                            ?>
                            <div class="row">
                                <div class="col-6">CGST(14%)</div>
                                <div class="col-2 text-right"><?=$GSTTotal28/2?></div>
                                <div class="col-2 text-right"></div>
                                <div class="col-2 text-right"></div>
                            </div>
                            <div class="row">
                                <div class="col-6">SGST(14%)</div>
                                <div class="col-2 text-right"><?=$GSTTotal28/2?></div>
                                <div class="col-2 text-right"></div>
                                <div class="col-2 text-right"></div>
                            </div>
                            
                            <?php
                            }
                            ?>
                            <?php
                            $GSTTOTAL=0;
                            $GSTTOTAL=($Total+$GSTTotal28+$GSTTotal18+$GSTTotal5);
                           ?>
                            <br>
                            <div class="row sub-total-bill">
                                <div class="col-6">Sub Total Amount</div>
                                <div class="col-2 text-right"><?=$GSTTOTAL?></div>
                                <div class="col-2 text-right">0.00</div>
                                <div class="col-2 text-right"><?=$Total?></div>
                            </div>
                            <div class="row" class="">
                                <div class="col-6">Net Bill Amount(Rounded)</div>
                                <div class="col-2 text-right"></div>
                                <div class="col-2 text-right"></div>
                                <div class="col-2 text-right"><span id="BillSalesTotal"><?=$fullTotal=round($Total+(isset($GSTTOTAL)?$GSTTOTAL:0));?></span></div>
                            </div>
                            <div class="row" class="">
                                <div class="col-12">Amount In Words : <span id="AmountInWords"></span></div>
                                
                            </div>
                        </div>
                            
                            
                      </div>
                  </div>
                  <div class="row ">
                    <!-- accepted payments column -->
                        <div class="col-8 float-left BillFirmTermsCondition" id="BillFirmTermsCondition" >
                          I acknowledge that the jobs/repairs/service/ carried out in  my vehicle and the respective cost estimate were explained to me .
                          I have recived my vehicle after cmopletion of all repairs being carried out to my satisfaction and
                          I confirm that my vehicle is in good condition.I further authorize this workshop to contact me by call or sms 
                          to inform me with any other information in relation to my vehicle.
                        </div>
                        <div class="col-2 float-left">
                            <span  style="position:absolute;bottom:0;">Customer Signature</span>
                        </div>
                        <div class="col-2 float-left">
                                <span  style="position:absolute;bottom:0;">Mobile No.</span>
                        </div>
                    <hr>
                  </div>
                <div class="row ">
                    <!-- accepted payments column -->
                        <div class="col-8 float-left" >
                        <table border="1"> 
                            <tr>
                                <td>Bank Name</td>
                                <td><?=$bankDetail['BankName']?></td>
                            </tr>
                            <tr>
                                <td>Account Name</td>
                                <td><?=$bankDetail['AcName']?></td>
                            </tr>
                            <tr>
                                <td>Account No.</td>
                                <td><?=$bankDetail['AcNumber']?></td>
                            </tr>
                            <tr>
                                <td>IFSC Code.</td>
                                <td><?=$bankDetail['IFSCCode']?></td>
                            </tr>
                            
                        </table>
                        </div>
                        <div class="col-2 float-left">
                        </div>
                        <div class="col-2 float-left">
                        </div>
                    <hr>
                  </div>
    
                  <!-- /.row -->
    
                  <!-- this row will not appear when printing -->
                  <div class="row no-print ">
                    <div class="col-12">
                     <!--<button onclick="printBill()" target="_blank" class="btn btn-pri"><i class="fa fa-print"></i> Print</button>-->
                     <button  class="btn btn-primary" onclick="printBill()"><i class="fa fa-print" ></i> Print</button>
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
                </div>
            
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- Theme style -->
<!-- jQuery -->
<!--<script src="http://ticketbooking.webnappmaker.in/resources/assets/plugins/jquery/jquery.min.js"></script>-->
<!-- jQuery UI 1.11.4 -->
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>-->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?=site_url('resources/assets/custom.js')?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function printBill() {
  window.print();
}
</script>
<script >
$(document).ready( function() {
     var test=$('#BillSalesTotal').html();
     test=convertNumberToWords(test);
     $('#AmountInWords').html(test);
});

 
 
</script>