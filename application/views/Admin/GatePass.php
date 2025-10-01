<?php
   /* echo "<pre>";
    print_r($mainData)*/
?>
<div class="row" style="padding-top:35px;">
    <div class="col-12">
        <div class="pre-invoice-div" style="font-size:1em; font-weight:bold; background-color: lightgrey;text-align:center;">Gate Pass</div>
        <div class="col-6 float-left">
            <div class="col-6  float-left">       
                <div><b class="cust-detail-font">GP No. &nbsp; &nbsp; &nbsp; :</b><span class="cust-detail-font" id="JobcardCustomerName"><?="GP-".$Invoice['BillId']?></span></div>
                <div><b class="cust-detail-font">Cust Name:</b><span class="cust-detail-font" id="JobcardCutomerPhoneNo"><?= ($mainData['InsuranceCompanyId']==1)?$mainData['CustomerName']:$mainData['InsuranceCompanyName']; ?></span></div>
                <div><b class="cust-detail-font">Tech Name:</b><span class="cust-detail-font" id="JobcardCustomerAddress"><?=$mainData['AdvisoryName']; ?></span></div>
            </div>
            <div class="col-6  float-left">       
                <div><b class="cust-detail-font">Date &nbsp;&nbsp;&nbsp; :</b><span class="cust-detail-font" id="JobcardCustomerName"><?=$billDetail['BillCDT']?></span></div>
                <div><b class="cust-detail-font">Model  &nbsp;:</b><span class="cust-detail-font" id="JobcardCutomerPhoneNo"><?=$mainData['VechileModelName']; ?></span></div>
                <div><b class="cust-detail-font">Reg No :</b><span class="cust-detail-font" id="JobcardCustomerAddress"><?=$mainData['CustomerVechileNo']; ?></span></div>
            </div>
        </div>
        
        <div class="col-6 float-left" style="padding-top:5px;">
            <table style="width:100%">
                <tr class="pre-invoice-table-heading">
                    <td><b>Job Card No.</b></td>
                    <td><b>Bill No</b></td>
                    <td><b>Bill Date</b></td>
                    <td><b>Amount</b></td>
                </tr>
                <tr>
                    <td><?="JC/".$mainData['JobCardId']?></td>
                    <td><?="BR/".$Invoice['BillId']?></td>
                    <td><?=date('d-m-Y', strtotime($billDetail['BillCDT']));?></td>
                    <td><?=round($fullTotal)?></td>
                </tr>
            </table>    
        </div>
       
    </div>
    <div class="col-12 float-left" style="padding-top:15px;">
        <div class="col-6 float-left">
                <b>Customer Signature</b>
        </div>
        <div class="col-6 float-left">
                <b>Accountant  Signature</b>
        </div>
    </div>
</div>