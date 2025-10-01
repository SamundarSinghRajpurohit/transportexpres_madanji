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
                <div style="font-size:2em; font-weight:bold; background-color: lightgrey;text-align:center;"> Salary Slip</div>
            </div>
        </div>
        <hr>
        <!-- Customer row -->
        <div class="row">
            <div class="col-sm-5  float-left">
                <div><b class="cust-detail-font">Employee Name:</b><span class="cust-detail-font" id="JobcardCustomerName"><?=$mainData['EmployeeName'] ?></span></div>
                <div><b class="cust-detail-font">Department:</b><span class="cust-detail-font" id="JobcardCutomerPhoneNo"><?= $mainData['EmployeeDepartment'];?></span></div>
                <div><b class="cust-detail-font">Designation:</b><span class="cust-detail-font" id="JobcardCustomerAddress"><?=$mainData['EmployeeDesignation']; ?></span></div>
            </div>	
                
                
            <div class="col-sm-3  float-left">
                <div><b class="cust-detail-font">Employee Code:</b><span class="cust-detail-font" id="JobcardCustomerVechileNo"><?=$mainData['EmployeeId']?></span></div> 
            </div>
            <!-- /.col -->
            <div class="col-sm-4 float-left  text-left">
                <div class=" col-6" ><b class="cust-detail-font">Daily Salary:</b><span class=" col-6 cust-detail-font" ><?=$mainData['SalaryEmployeeSalary'];?></span></div>
                <br>
            </div>
        
        </div>
        <hr>
        <!-- /.row -->
                </div>
              <!-- /.row -->
              
              <!-- Sub Job Card -->
              <div class="footer-print">
                  <div class="row ">
                        <div class="col-3 pre-invoice-sub-footer-left">
                            <div class="row float-left">
                                <div class="col-6"><b class="cust-detail-font">Total Month Days :</b></div><div class="col-6"><span class="cust-detail-font" id="JobcardCustomerName"><?=$mainData['MonthTotalDays'] ?></span></div>
                                <div class="col-6"><b class="cust-detail-font">Holidays:</b></div><div class="col-6"><span class="cust-detail-font" id="JobcardCustomerName"><?=$mainData['MonthHolidays'] ?></span></div>
                                <div class="col-6"><b class="cust-detail-font">Working Days:</b></div><div class="col-6"><span class="cust-detail-font" id="JobcardCustomerName"><?=$mainData['MonthWorkingDays'] ?></span></div>
                                <div class="col-6"><b class="cust-detail-font">Leave Without Pay:</b></div><div class="col-6"><span class="cust-detail-font" id="JobcardCustomerName"><?=$mainData['SalaryNumberOfLeave'] ?></span></div>
                                <div class="col-12">----------------------------</div>
                                <div class="col-6"><b class="cust-detail-font"><b>Salary Payable  Days:</b></b></div><div class="col-6"><span class="cust-detail-font" id="JobcardCustomerAddress"><?=$TotalNoofDays=(intval($mainData['MonthWorkingDays'])-intval($mainData['SalaryNumberOfLeave'])); ?></span></div>
                            </div>
                        </div>
                        <div class="col-9 pre-invoice-sub-footer-right">
                            <div class="row">
                                <div class="col-10">Total Salary</div>
                                <div class="col-2 text-right"><span id="BillSalesTotal"><?=$totalSalary=($mainData['MonthWorkingDays']*$mainData['SalaryEmployeeSalary'])?></span></div>
                                <div class="col-10">Total Leaves(-)</div>
                                <div class="col-2 text-right"><span id="BillSalesTotal"><?=$totalLeaveSalary=($mainData['SalaryNumberOfLeave']*$mainData['SalaryEmployeeSalary'])?></span></div>
                                <div class="col-10">Advance (-)</div>
                                <div class="col-2 text-right"><span id="BillSalesTotal"><?=$mainData['SalaryAdvance']?></span></div>
                            </div>
                            <div class="row" class="">
                                
                            </div>
                        </div>
                      </div>
                  </div>
                  <hr>
                    <div class="row">
                        <div class="col-10">Net Salary</div>
                        <div class="col-2 text-right"><span id="BillSalesTotal"><?=$mainData['SalaryNet']?></span></div>
                            
                    </div>
                    <hr>
                    <div class="row ">
                    <!-- accepted payments column -->
                        <div class="col-12 float-left" >
                              <div class="float-right lead">Checked By</div>
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