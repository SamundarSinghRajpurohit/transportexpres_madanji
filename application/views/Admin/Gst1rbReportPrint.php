<div class="content-wrapper" style="min-height: 496px;">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$pageName?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('/Admin/Dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active"><?=$pageName?></li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    
    
    <section class="content">
        <div class="container-fluid">
            <div class="card card-widget widget-user ">
                <div class="widget-user-header  admin-custom-color-g admin-table-header">
                </div>
                <div class="widget-user-image admin-custom-table-pos" >
                    <div class="row">
                        <div class="col-md-0">
                            
                        </div>
                        <div class="col-md-12 pt-3">
                            <div class="card custom-card">
                                <table class="table-bordered table custom-table m-0" cellspacing="0" id="reports" >
                                <thead class="custom-table-thead">
                                <tr class="custom-table-tr">
                                  <th class="custom-table-th">No. of Recipients</th>
                                  <th class="custom-table-th">No. of Invoices</th>
                                  <th class="custom-table-th"></th>
                                  <th class="custom-table-th">Total Invoice Value</th>
                                  <th class="custom-table-th"></th>
                                  <th class="custom-table-th"></th>
                                  <th class="custom-table-th"></th>
                                  <th class="custom-table-th"></th>
                                  <th class="custom-table-th"></th>
                                  <th class="custom-table-th">Total Taxable Value</th>
                                  <th class="custom-table-th">Total Cess</th>
                                </tr>
                            </thead>
                                <tbody class="custom-table-tbody">
                                    <?php
                                    $totalInvoice=0;
                                    $totalInvoiceValue=0;
                                    $totalTaxableValue=0;
                                    $dealerArray = array();
                                    $totalDealer = 0;
                                    for($i=0;$i<count($mainData);$i++)
                                    {
                                        array_push($dealerArray,$mainData[$i]['DealerId']);
                                        $totalInvoice++;
                                        $totalInvoiceValue = $totalInvoiceValue + $mainData[$i]['OrderTotal'];
                                        $totalTaxableValue = $totalTaxableValue + ($mainData[$i]['OrderTotal'] - (($mainData[$i]['OrderTotal']/100)*5));
                                    }
                                    $totalDealer = count(array_unique($dealerArray));
                                    ?>
                                    <tr class="custom-table-tr">
                                        <td class="custom-table-td"><?=$totalDealer;?></td>
                                        <td class="custom-table-td"><?=$totalInvoice;?></td>
                                        <td class="custom-table-td"></td>
                                        <td class="custom-table-td"><?=round($totalInvoiceValue,2);?></td>
                                        <td class="custom-table-td"></td>
                                        <td class="custom-table-td"></td>
                                        <td class="custom-table-td"></td>
                                        <td class="custom-table-td"></td>
                                        <td class="custom-table-td"></td>
                                        <td class="custom-table-td"><?=round($totalTaxableValue,2);?></td>
                                        <td class="custom-table-td">00</td>
                                    </tr>
                                <?php
                                for($i=0;$i<count($mainData);$i++)
                                // for($i=0;$i<10;$i++)
                                {
                                    ?>
                                        <?php if($i == 0){ ?>
                                        <tr class="custom-table-tr">
                                        <th class="custom-table-th">GSTIN/UIN of Recipient</th>
                                        <th class="custom-table-th">Invoice Number</th>
                                        <th class="custom-table-th">Invoice date</th>
                                        <th class="custom-table-th">Invoice Value</th>
                                        <th class="custom-table-th">Place Of Supply</th>
                                        <th class="custom-table-th">Reverse Charge</th>
                                        <th class="custom-table-th">Invoice Type</th>
                                        <th class="custom-table-th">E-Commerce GSTIN</th>
                                        <th class="custom-table-th">Rate</th>
                                        <th class="custom-table-th">Taxable Value</th>
                                        <th class="custom-table-th">Cess Amount</th>
                                        </tr>
                                        <?php }?>
                                        <tr class="custom-table-tr">
                                            <td class="custom-table-td"><?=$mainData[$i]['DealerGSTNO']; ?></td>
                                            <!-- <-?php
                                            if($mainData[$i]["OrderCustomLRNO"] == " ")
                                            {
                                            ?>
                                                <td class="custom-table-td"><?=$mainData[$i]['OrderLRNO']; ?></td>
                                             <-?php
                                            }
                                            else
                                            {
                                            ?>
                                                <td class="custom-table-td"><?=$mainData[$i]['OrderCustomLRNO']; ?></td>
                                            <-?php
                                            }
                                            ?> -->
                                            <td class="custom-table-td"><?=$mainData[$i]['OrderLRNO']; ?></td>
                                            <td class="custom-table-td"><?=date('d-M-Y',strtotime($mainData[$i]['OrderDate'])); ?></td>
                                            <td class="custom-table-td"><?=round($mainData[$i]['OrderTotal'],2); ?></td>
                                            <td class="custom-table-td">24-GUJARAT</td>
                                            <td class="custom-table-td">N</td>
                                            <td class="custom-table-td">Regular</td>
                                            <td class="custom-table-td"></td>
                                            <td class="custom-table-td">0</td>
                                            <!-- <td class="custom-table-td"><?=round(($mainData[$i]['OrderTotal'] - (($mainData[$i]['OrderTotal']/100)*5)),2); ?></td> -->
                                            <td class="custom-table-td"><?=round($mainData[$i]['OrderTotal'],2); ?></td>
                                            <td class="custom-table-td"></td>
                                        </tr> 
                                   <?php 
                                }
                                ?>
                        
                            </tbody>
                            </table>
                            </div>    
                        </div>
                        <div class="col-md-0">
                            
                        </div>
                    </div>
                </div>
            </div>
              
        </div>
    </section>
    <!-- /.modal -->

      <div class="modal fade" id="insert-modal">
            <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header admin-custom-color-g">
              <h4 class="modal-title">Add <?=$pageName?></h4>
              <button type="button" class="close " data-dismiss="modal"  style="color:white;" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form   id="AddUpdateForm" name="AddUpdateForm" enctype="multipart/form-data">
                  <div class="card-body">  
                        <div class="row ">
                                 
                                <?php 
                                $filterField=remove_CDT($OriginalFields);
                                    //  $filterField=remove_last_field($filterField,4);
                                    //update code after removing 2 column from last
                                     $filterField=remove_last_field($filterField,2);
                                       //  check_p($filterField);
                                
                                 ?>
                                 <input type="hidden" name='<?=$filterField[0]?>'  id='<?=$filterField[0]?>'  >
                                 <!--<input type="hidden" name='</?=$filterField[11]?>'  id='</?=$filterField[11]?>' value="20">-->
                                 <?php
                                    
                                        $tblkey=ucfirst($page);
                                         $filterField=remove_first_field($filterField);
                                        foreach($filterField as $data)
                                        {   ?>
                                                <?= get_input_field($data,$tblkey,'6')?>
                                <?php   }  
                                if(checK_table_present('tbl'.$page.'detail'))
                                {
                                ?>
                                
                                <div class='col-md-12'>
                                    <input type="button" id='add' class=' admin-custom-color-g col-md-12 ' value="Add" >
                                </div>
                                <div style="overflow-x:auto;">
                                    <table id="DetailView" >
                                    </table>
                                    <table id="UpdateDetailView" >
                                     </table>
                                </div>
                                
                                <?php
                                        }
                                    /* get_detail_view($page);*/
                                    ?>
                                <?php     
                                    if(checK_table_present('tbl'.$page.'detail2'))
                                    {?>
                                      <div class='col-md-12'>
                                    <input type="button" id='add2' class=' btn btn-primary col-md-12 ' value="Add Details" >
                                </div>
                                <div style="overflow-x:auto;">
                                    <table id="DetailView2" >
                                    </table>
                                    <table id="UpdateDetailView2" >
                                     </table>
                                </div>  
                                <?php }
                                ?>
                            
                        <div class="modal-footer ">
                                <button type="submit" name="btnSubmit" id="btnSubmit" class="btn admin-custom-color">Submit</button>
                                <span id="demo" style="display:none;color:red;">Product Allready Added</span>
                        </div>
                     </div> 
                </form>
              </div>
                </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
</script>