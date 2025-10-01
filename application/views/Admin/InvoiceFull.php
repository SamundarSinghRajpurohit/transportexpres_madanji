    		<?=$GSTTOTAL=0;?>
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
                <div  id="BillFirmName" class="custom-firm-name" style="text-align:center">Devi Motors</div>
                <div  style="text-align:center">ICHHAPORE BUS TOP NO-3 BESIDE BALAJI HERO,HAZIRA ROAD SURAT Ph .9712984111</div>
                <div  style="text-align:center">GST No 24ANWPP1633P1Z9 </div>
                <br>
                <div style="font-size:2em; font-weight:bold; background-color: lightgrey;text-align:center;"> Invoice</div>
            </div>
        </div>
        <hr>
        <!-- Customer row -->
        <div class="row">
            <div class="col-sm-5  float-left"><?php
           /* echo "<pre>";
            print_r($mainData)*/
            ?>
                <div><b class="cust-detail-font">Customer Name:</b><span class="cust-detail-font" id="JobcardCustomerName"><?= ($mainData['InsuranceCompanyId']==1)?$mainData['CustomerName']:$mainData['InsuranceCompanyName']; ?></span></div>
                <div><b class="cust-detail-font">Phone No:</b><span class="cust-detail-font" id="JobcardCutomerPhoneNo"><?= ($mainData['InsuranceCompanyId']==1)?$mainData['CustomerPhoneNo']:''; ?></span></div>
                
                <div><b class="cust-detail-font">Address:</b><span class="cust-detail-font" id="JobcardCustomerAddress"><?= ($mainData['InsuranceCompanyId']==1)?$mainData['CustomerAddress']:$mainData['InsuranceCompanyAddress']; ?></span></div>
                <div><b class="cust-detail-font">Vechile Owner Name:</b><span class="cust-detail-font" id="JobcardCustomerAddres"><?=$mainData['CustomerName']?></span></div>
            <div><b class="cust-detail-font">GST No:</b><span class="cust-detail-font" id="JobcardCustomerGSTno"><?= ($mainData['InsuranceCompanyId']==1)?$mainData['CustomerGSTno']:$mainData['InsuranceCompanyGSTNo']; ?></span></div>
            </div>	
                
            
                
            <div class="col-sm-3  float-left">
                <div><b class="cust-detail-font">Vechile No:</b><span class="cust-detail-font" id="JobcardCustomerVechileNo"><?=$mainData['CustomerVechileNo']?></span></div> 
                <div><b class="cust-detail-font">Engine No:</b><span class="cust-detail-font" id="JobcardCustomerEngineNo"><?=$mainData['CustomerEngineNo']?></span></div>
                <div><b class="cust-detail-font">Chassis No:</b><span class="cust-detail-font" id="JobcardCustomerChassisNo"><?=$mainData['CustomerChassisNo']?></span></div>
                <div><b class="cust-detail-font">Km :</b><span class="cust-detail-font" id="JobcardCustomerKm"><?=$mainData['CustomerKm']?></span></div>
                <div><b class="cust-detail-font">Vehicle Model Name:</b><span class="cust-detail-font" id="JobcardCustomerVechile"><?=$vehicleModelName?></span></div>
                <br>
                <div><b>Service Type :</b><span id="JobcardCustomerKm"><?=$mainData['JobCardServiceDropDown']?></span></div>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 fload-left ">
    
                <div><b class="cust-detail-font">Bill No:</b><span class="cust-detail-font" ><?=$Invoice['BillId'];?></span></div>
                    <div><b class="cust-detail-font">Job Card No:</b>JC/<span class="cust-detail-font" id="JobcardJobCardId"><?=$mainData['JobCardId']?></span></div>
                    <br>
                    <div><b class="cust-detail-font">Date/Time:</b><span class="cust-detail-font"><?=$Invoice['BillCDT']?></span></div>
                    <div><b class="cust-detail-font">Job Card Date/Time:</b><span class="cust-detail-font" id="JobcardJobCardId"><?=$mainData['JobCardCDT']?></span></div>
                   	<br>
                    <div><b class="cust-detail-font">Mechanic Name:</b><span class="cust-detail-font" id="JobcardMechanic"><?=$mainData['MechanicName']?></span></div>
                    <div><b class="cust-detail-font">Advisory Name:</b><span class="cust-detail-font" id="JobcardAdvisory"><?=$mainData['AdvisoryName']?></span></div>
            </div>
        
        </div>
        <hr>
        <!-- Service row -->
        <div class="row ">
        
        </div>
        <!-- /.row -->
        <!-- Main Box row -->
            <div class="row">
                <div class="col-12 float-left  pre-invoice-div">
                    
                    <table class="pre-invoice-table" >
                    
                        <!--<tr class="pre-invoice-table-heading">-->
                        <tr class="">
                        
                            <?php
                            foreach($tableHeading as $tableHeadingData)
                            {?>
                            
                            <th ><?=$tableHeadingData?></th>
                            <?php
                            }?>
                        </tr><span><b>Parts</b></span>
                        
                            <?php $i=1;
                            $GSTTotal5=0;
                            $GSTTotal12=0;
                            $GSTTotal18=0;
                            $GSTTotal28=0;
                            $Total=0;
                            $SubTotal=0;
                          //  print_r($detailProduct);

                            foreach($detailProduct as $detailProductData)
                            {   foreach($hsn as $hsnData)
                                {
                                    if($detailProductData['HsnId']==$hsnData['HsnId'])
                                    { $HsnCode=$hsnData['HsnName'];
                                      $HsnTax=$hsnData['HsnTax'];
                                      break;
                                    }
                                }
                            ?>
                            <tr >
                                <td class="pre-invoice-table-td"><?=$i++;?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData['ProductName']?></td>
                                <td class="pre-invoice-table-td"><?=$HsnCode?></td>
                                <td class="pre-invoice-table-td"><?=$HsnTax?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData['PreInvoiceProductQty']?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData['PreinvoiceProductPrice']?></td>
                                <td class="pre-invoice-table-td"><?=$detailProductData['PreinvoiceProductPrice']*$detailProductData['PreInvoiceProductQty']?></td>
                                <td class="pre-invoice-table-td">0.00</td>
                                <td class="pre-invoice-table-td"></td>
                            </tr>
                            <?php
                            $sub=$detailProductData['PreinvoiceProductPrice']*$detailProductData['PreInvoiceProductQty'];
                            $SubTotal=$SubTotal+$sub;
                            if($HsnTax==5)
                                $GSTTotal5=$GSTTotal5+$sub*0.05;
                            elseif($HsnTax==12)
                                $GSTTotal12=$GSTTotal12+$sub*0.12;
                            elseif($HsnTax==18)
                                $GSTTotal18=$GSTTotal18+$sub*0.18;
                            elseif($HsnTax==28)
                                $GSTTotal28=$GSTTotal28+($sub*0.28);
                            
                             $Total=$Total+$detailProductData['PreinvoiceProductPrice']*$detailProductData['PreInvoiceProductQty'];    
                            //$Total=$Total+$detailProductData['PreInvoiceTotal'];
                            
                            }
                            ?>
                        
                    </table>
                    <span><b>Labour</b></span>
                    <table class="pre-invoice-table  " >
                            <?php 
                            $JobTotal=0;
                            $JobGST=0;
                            $i=1;
                            //check_p($detailJobWork);
                            foreach($detailJobWork as $detailJobWorkData)
                            { ?>
                            <tr >
                                <td class="pre-invoice-table-td" ><?=$i++;?></td>
                                <td class="pre-invoice-table-td"  style="float:left; width:200px"><?=$detailJobWorkData['LabourName']?></td>
                                <td class="pre-invoice-table-td" style="float:left;">998729</td>
                                <td class="pre-invoice-table-td"></td>
                                <td class="pre-invoice-table-td"></td>
                                <td class="pre-invoice-table-td"></td>
                                <td class="pre-invoice-table-td"></td>
                                <td class="pre-invoice-table-td"></td>
                                <td class="pre-invoice-table-td" style="text-align:right"><?=$detailJobWorkData['PreinvoiceLabourPrice']?></td>
                            </tr>
                            <?php
                            //check_p($detailJobWork);
                            //$CGSTTotal=$CGSTTotal+;
                            
                            $JobTotal=(int)$JobTotal+round($detailJobWorkData['PreinvoiceLabourPrice']);
                            $JobGST=(int)$JobGST+round(((int)$detailJobWorkData['PreinvoiceLabourPrice']*0.18),2);
                            }$JobFinalTotal=$JobTotal+$JobGST;
                            
                            ?>
                        
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
                                <div class="col-2 text-right"><?=$JobTotal?></div>
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
                                <div class="col-2 text-right"><?=$GSTTotal5/2?></div>
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
                                if($mainData['PlaceofsupplyId']==24)//FOR GUJ GST
                                {
                                    ?>
                                    <div class="row">
                                        <div class="col-6">CGST(9%)</div>
                                        <div class="col-2 text-right"><?=$GSTTotal18/2?></div>
                                        <div class="col-2 text-right"></div>
                                        <div class="col-2 text-right"><?=$JobGST/2?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">SGST(9%)</div>
                                        <div class="col-2 text-right"><?=$GSTTotal18/2?></div>
                                        <div class="col-2 text-right"></div>
                                        <div class="col-2 text-right"><?=$JobGST/2?></div>
                                    </div>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <div class="row">
                                        <div class="col-6">IGST(18%)</div>
                                        <div class="col-2 text-right"><?=$GSTTotal18?></div>
                                        <div class="col-2 text-right"></div>
                                        <div class="col-2 text-right"><?=$JobGST?></div>
                                    </div>
                                    
                                    <?php
                                }
                            }else
                            {
                                if($mainData['PlaceofsupplyId']==24)//FOR GUJ GST
                                {
                                    ?>
                                    <div class="row">
                                        <div class="col-6">CGST(9%)</div>
                                        <div class="col-2 text-right"></div>
                                        <div class="col-2 text-right"></div>
                                        <div class="col-2 text-right"><?=$JobGST/2?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">SGST(9%)</div>
                                        <div class="col-2 text-right"></div>
                                        <div class="col-2 text-right"></div>
                                        <div class="col-2 text-right"><?=$JobGST/2?></div>
                                    </div>
                                    <?php
                                }
                                else
                                {  
                                    ?>
                                    
                                    <div class="row">
                                        <div class="col-6">IGST(18%)</div>
                                        <div class="col-2 text-right"></div>
                                        <div class="col-2 text-right"></div>
                                        <div class="col-2 text-right"><?=$JobGST?></div>
                                    </div>
                                    
                                    <?php
                                }
                            
                            }
                            if($GSTTotal28!==0)
                            {
                                if($mainData['PlaceofsupplyId']==24)//FOR GUJ GST
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
                                else
                                {
                                    ?>
                                    <div class="row">
                                        <div class="col-6">IGST(28%)</div>
                                        <div class="col-2 text-right"><?=$GSTTotal28?></div>
                                        <div class="col-2 text-right"></div>
                                        <div class="col-2 text-right"></div>
                                    </div>
                                        
                                    <?php
                                }
                            
                           
                            }
                            ?>
                           <?php
                            $GSTTOTAL=0;
                            $GSTTOTAL=($Total+$GSTTotal28+$GSTTotal18+$GSTTotal5);
                           ?> 
                            <br>
                            <div class="row sub-total-bill">
                                <div class="col-6">Sub Total Amount</div>
                                <div class="col-2 text-right"><?=($GSTTOTAL)?></div>
                                <div class="col-2 text-right">0.00</div>
                                <div class="col-2 text-right"><?=$JobFinalTotal?></div>
                            </div>
                            <div class="row" class="">
                                <div class="col-6">Net Bill Amount(Rounded)</div>
                                <div class="col-2 text-right"></div>
                                <div class="col-2 text-right"></div>
                                <div class="col-2 text-right"><b><span id="BillSalesTotal"><?=$fullTotal=round($JobFinalTotal+(isset($GSTTOTAL)?$GSTTOTAL:0)); ?></span></b></div>
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
                        <br>
                        <table border="1" style="width:100%; padding-top:10px;" > 
                            <tr>
                                <td><b>Bank Name</b></td>
                                <td><?=$bankDetail['BankName']?></td>
                        
                                <td><b>Account Name</b></td>
                                <td><b><?=$bankDetail['AcName']?></b></td>
                                <td><b>Account No.</b></td>
                                <td><b><?=$bankDetail['AcNumber']?></b></td>
                                <td><b>IFSC Code.</b></td>
                                <td><b><?=$bankDetail['IFSCCode']?></b></td>
                            </tr>
                            
                        </table>
                    <hr>
                  </div>
                    <!--Gate Pass Start-->  
                        <?php include_once('GatePass.php'); ?> 
                    <!--Gate Pass Stop-->
                    <div class="row ">
                    <!-- accepted payments column -->
                        <div class="col-8 float-left" >
                        
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
                </div>
            
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- Theme style -->
<!-- jQuery -->
<script src="http://ticketbooking.webnappmaker.in/resources/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?=site_url('resources/assets/custom.js')?>"></script>

<script >
$(document).ready( function() {
    
     var test=$('#BillSalesTotal').html();
     test=convertNumberToWords(test);
     $('#AmountInWords').html(test);
});

   window.onload = function() { 
       window.print(); 
       }
</script>