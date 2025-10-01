<!-- <!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Create PDF from View in CodeIgniter Example</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
<h1 class="text-center bg-info">Generate PDF from View using DomPDF</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Book Name</th>
            <th>Author</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>PHP and MySQL for Dynamic Web Sites</td>
            <td>Larry Ullman</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Pro MEAN Stack Development</td>
            <td>Elad Elrom</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Restful API Design</td>
            <td>Matthias Biehl</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Pro PHP MVC</td>
            <td>Chris Pitt</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Mastering Spring MVC 4</td>
            <td>Geoffroy Warin</td>
        </tr>
        <tbody>
</table>
</body>
</html> -->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Web N AppMaker</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" /> -->
  <link rel="stylesheet" href="<?=site_url('resources/assets/dist/css/adminlte.min.css')?>">
  <link rel="stylesheet" href="<?=site_url('resources/assets/custom.css')?>">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
    <style>
        .table td, .table th {
                padding: .25rem !important; 
            }

        /* style="font-size: 5px !important;" */
        h5{
            font-size: 12px !important;
        }

        h4{
            font-size: 13px !important;
        }
        h3{
            font-size: 14px !important;
        }

        .fs-10{
            font-size: 12px;
        }

        .d-block{
            display: block !important;
        }
    </style>
</head>
<body>
        <section class="content">
            <div class="row">
                
                <div class="col-12">
                    
                    <div id="BillCard">
                        <div class="card-body" id="BillBody">
                            <div class="invoice p-3 mb-3">
                                <div class="row">
                                    <div class="col-12 table-responsive ">
                                        <table class="table text-left border">
                                            <tr>
                                                <td style="width: 15% !important;">
                                                    <img src="<?=base_url('resources/images/'.$CompanyData[0]->CompanyLogo);?>" style="height:75px; width:75px;" alt="AdminLTE Logo" class=" ">
                                                </td>
                                                <td style="width: 35% !important;">
                                                    <h3><b><?=$CompanyData[0]->CompanyName?></b></h3>
                                                    <h5><?=$CompanyData[0]->CompanyAddress?></h5>
                                                </td>
                                                <td class="text-right" style="width: 40% !important;">
                                                    <h4>(Mo)<?=$CompanyData[0]->CompanyPhoneNo?></h4>
                                                    <span class="fs-10 d-block"><b>Bank Name</b> :- <?=$CompanyData[0]->CompanyBankName?></span>
                                                    <span class="fs-10 d-block"><b>A/C No</b> :- <?=$CompanyData[0]->CompanyAccountNo?></span>
                                                    <span class="fs-10 d-block"><b>IFSC CODE</b> :- <?=$CompanyData[0]->CompanyIFSCCode?></span>
                                                    <span class="fs-10 d-block"><b>A/C TYPE</b> :- <?=$CompanyData[0]->CompanyAccountType?></span>
                                                    <span class="fs-10 d-block"><b>GST No</b> :- <?=$CompanyData[0]->CompanyGSTno?></span>
                                                    <span class="fs-10 d-block"><b>Pancard No.</b> :- <?=$CompanyData[0]->CompanyPanCartNo?></span>
                                                </td>
                                            </tr>
                                            </table>
                                        <table class="table text-left border">
                                            <tr>
                                                <td>
                                                    <h5 class="samu">Dealer's Name :<?=$OrderData[0]->DealerName?></h5>
                                                    <h5 class="samu">Dealer's GST No. :<?=$OrderData[0]->DealerGSTNO?></h5>
                                                    <h5 class="samu">Eway Bill No :-<?=$OrderData[0]->OrderEwayBillNo?>
                                                    <h5>Delivery From :<?=$OrderData[0]->OrderFrom?></h5>
                                                </td>
                                                <td>

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
                                                    <h5>To :-<?=$OrderData[0]->OrderTo?></h5>
                                                </td>
                                                <td> 
                                                    <h5>Consignee :<?=$OrderData[0]->ConsigneeName?></h5>
                                                    <h5>Delivery Add. : <?=$OrderData[0]->OrderAddress?></h5>
                                                    <h5>Vehicle No :<?=$OrderData[0]->TempoName?></h5>
                                                </td>
                                            </tr>
                                        
                                            </table>
                                        
                                        
                                        <table class="table text-left table-bordered chota-table">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Good</th>
                                                    <th>Box</th>
                                                    <th>Packing</th>
                                                    <th>Weight</th>
                                                    <th>DCPI No</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
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
                                                </td>
                                            </tr>
                                            
                                        </table>
                                        <table class="table text-left border">
                                            <tr>
                                                <td>
                                                    <h5>Service Tax to be Born By</h5>
                                                </td>
                                                <td>
                                                    <h2>Receiver's Singnature <br> With Stamp:</h2>
                                                </td>
                                                <td>
                                                    <h5 class="text-right">Carriers are not responsible<br> for brakage and leakage</h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 0;" ></td>
                                                <td style="border: 0;"></td>
                                                <td style="border: 0;" class="float-right"><h5 class="text-right"><b>FOR,<?=$CompanyData[0]->CompanyName?></b></h5></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</body>
</html>