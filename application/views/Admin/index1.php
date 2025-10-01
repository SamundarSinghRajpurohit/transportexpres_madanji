 <!-- Main view-->
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=$pageName?></h1>
          </div><!-- /.col -->
         <!-- /.col -->
          <div class="col-md-6">
              <a href="<?=site_url('/Admin/AddOrderCustomDifferent')?>">
               <button class="btn admin-custom-color-opp float-right">ADD LRNO</button>
           </a>
            <!--<button type="submit" name="btnSubmit" id="btnSubmit" class="btn admin-custom-color-g float-right">ADD BOOKING</button>-->
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
        <!--<div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon admin-custom-color-g elevation-1"><img src="<?=base_url('/resources/Icons/shopping-cart_white.png')?>" class="icon-style" style="padding:18px !important;"></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Orders</span>
                       
                        <span class="info-box-number"><?=$NoOfOrder?></span>
                        
                        <a href="<?=site_url('/Admin/OrderDifferent')?>" class="small-box-footer admin-custom-color-opp">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon admin-custom-color-g elevation-1"><img src="<?=base_url('/resources/Icons/user1_white.png')?>" class="icon-style" style="padding:20px !important;"></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Customer</span>
                        <span class="info-box-number"><?=$NoOfcustomer?></span>
                        <a href="<?=site_url('/Admin/CustomerDifferent')?>" class="small-box-footer admin-custom-color-opp">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon admin-custom-color-g elevation-1"><img src="<?=base_url('/resources/Icons/stock_white.png')?>" class="icon-style" style="padding:15px !important;"></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Products </span>
                        <span class="info-box-number"><?=$NoOfProduct?></span>
                        <a href="<?=site_url('/Admin/ProductDifferent')?>" class="small-box-footer admin-custom-color-opp">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon admin-custom-color-g elevation-1"><img src="<?=base_url('/resources/Icons/rupee_white.png')?>" class="icon-style" style="padding:25px !important;"></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Sales </span>
                        <span class="info-box-number"><?=($TotalSales)?></span>
                        <a href="<?=site_url('/Admin/ProductDifferent')?>" class="small-box-footer admin-custom-color-opp">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon admin-custom-color-g elevation-1"><img src="<?=base_url('/resources/Icons/rupee_white.png')?>" class="icon-style" style="padding:25px !important;"></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total AVG Sales on <strong><?=($NoOfOrder)?> Bill</strong> </span>
                        <span class="info-box-number"><?=($TotalAVGSales)?></span>
                        <a href="<?=site_url('/Admin/ProductDifferent')?>" class="small-box-footer admin-custom-color-opp">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
            </div>
            
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon admin-custom-color-g elevation-1"><img src="<?=base_url('/resources/Icons/rupee_white.png')?>" class="icon-style" style="padding:25px !important;"></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Today Total Sales / <strong><?=$TodayTotalOrder?> Inovice</strong> </span>
                        <span class="info-box-number"><?=$TodayTotalSales?></span>
                        <a href="<?=site_url('/Admin/ProductDifferent')?>" class="small-box-footer admin-custom-color-opp">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
          
        </div>
             
                    </div>
                </div>
                
                <div class="col-md-12">
                <div class="card ">
                    <div class="card-header admin-custom-color-g">
                        <h3 class="card-title" style="text-align:center">Old Order </h3>
                    </div>
                    <div class="card-body p-0">
                    
                    <div class="table-responsive">
                      <table class="table m-0"  style="border-top-left-radius: .25rem !important; border-top-right-radius: .25rem !important;">
                        <thead>
                        <tr class="admin-custom-color-g">
                          <th>Order ID</th>
                          <th>Order Date</th>
                          <th>Consignor Name</th>
                          <th>Total Amount</th>
                         
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                          
                            for($i=0;$i<count($Data);$i++)
                            {   ?>
                                    <tr>
                                        <td><?=$Data[$i]["OrderId"]?></td>
                                        <td><?=$Data[$i]["OrderCDT"]?></td>
                                        <td><?=$Data[$i]["ConsignorName"]?></td>
                                        <td><?=$Data[$i]["OrderTotal"]?></td>
                                         <td><a href="</?=site_url('/Admin/BillPrintDifferent/'.$OrderData[$i]["OrderId"])?>">View Detail</a></td>
                                    
                                        <td><a href="</?=site_url('/Admin/BillPrintDifferent/'.$Data[$i]["OrderId"])?>">View Detail</a></td>                            
                                        </tr> 
                               <?php 
                            }
                            ?>
                    
                        </tbody>
                      </table>
                    </div>
                    <div class="card-footer clearfix">
                        <a href="<//?=site_url('/Admin/OrderDownloadCSV')?>" class="btn btn-sm admin-custom-color-g float-left" style="padding-right:20px;">Download CSV</a>
                        <a href="<?=site_url('/Admin/OldOrderDifferent')?>" class="btn btn-sm admin-custom-color-g float-right">View All Orders</a>
                    </div>
                    </div>
                    
                </div>
            
              </div>
            </div>-->
            <div class="col-md-6"> 
                <div class="card ">
                    <div class="card-header admin-custom-color-g">
                        <h3 class="card-title" style="text-align:center">Today LR</h3>
                    </div>
                    <div class="card-body p-0">
                    
                    <div class="table-responsive">
                      <table class="table m-0"  style="border-top-left-radius: .25rem !important; border-top-right-radius: .25rem !important;">
                        <thead>
                        <tr class="admin-custom-color-g">
                          <th>Order ID</th>
                          <th>Lr No</th>
                          <th>Order Date</th>
                          <th>Total Weight</th>
                          <th>LR Receipt</th>
                          <th>LR Print</th>
                          <th>Update</th>
                          <th>Delete</th>
                          <th>Email Send</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                           $OrderCount=count($OrderData);
                           $limit=5;
                            for($i=0;$i<count($OrderData) && $i<$limit;$i++)
                            {   ?>
                                    <tr>
                                        <td><?=$i+1?></td>
                        
                                            <?php
                                            if($OrderData[$i]["OrderCustomLRNO"] == " ")
                                            {
                                            ?>
                                                <td><?=$OrderData[$i]["OrderLRNO"]?></td>   
                                             <?php
                                            }
                                            else
                                            {
                                            ?>
                                             <td><?=$OrderData[$i]["OrderCustomLRNO"]?></td>   
                                            <?php
                                            }
                                            ?>
                                        <td><?=$OrderData[$i]["OrderDate"]?></td>
                                        <!--<td><?=$OrderData[$i]["ConsignorName"]?></td>-->
                                        <td><?=$OrderData[$i]["OrderTotalWeight"]?></td>
                                        <td><a href="<?=site_url('/Admin/BillPrintDifferentTransport/'.$OrderData[$i]["OrderId"])?>"><i class="fa fa-print admin-custom-color-opp" ></i></a></td>
                                        <td><a href="<?=site_url('/Admin/BillPrintDifferent/'.$OrderData[$i]["OrderId"])?>"><i class="fa fa-print admin-custom-color-opp" ></i></a></td>
                                        <td><a href="<?=base_url('/Admin/AddOrderCustomDifferent/'.$OrderData[$i]["OrderId"])?>" id="<?=$OrderData[$i]["OrderId"]?>"><i class="fa fa-edit admin-custom-color-opp" ></i></a></td>
                                        <!--<td><button value="<?=$OrderData[$i]["OrderId"]?>" name="order" class="deletedata"><i class="fa fa-trash admin-custom-color-opp" ></i></button></td>-->
                                        <td>
                                          <button onclick="myFunction('order','<?=$OrderData[$i]["OrderId"]?>')"><i class="fa fa-trash admin-custom-color-opp" ></i></button>
                                        </td>

                                        <td>
                                          <button onclick="sendMail('lr','<?=$OrderData[$i]["OrderId"]?>')"><i class="fa fa-envelope-o admin-custom-color-opp" ></i></button>
                                        </td>
                                   </tr> 
                               <?php 
                            }
                            ?>
                     
                        </tbody>
                      </table>
                    </div>
                        <div class="card-footer clearfix">
                        <!--a href="<//?=site_url('/Admin/OrderDownloadCSV')?>" class="btn btn-sm admin-custom-color-g float-left" style="padding-right:20px;">Download CSV</a-->
                        <?php if($OrderCount>=1)
                        {
                           
                        ?>
                        <a href="<?=site_url('/Admin/OrderDifferent')?>" class="btn btn-sm admin-custom-color-g float-right">View All Orders</a>
                        <?php 
                       }
                       else
                       {
                           ?>
                       <?php
                       }
                       ?>
                  </div>
                  </div>
                    
                </div>
                <div class="card ">
                    <div class="card-header admin-custom-color-g">
                        <h3 class="card-title" style="text-align:center">Today Pallet</h3>
                    </div>
                    <div class="card-body p-0">
                    
                    <div class="table-responsive">
                      <table class="table m-0"  style="border-top-left-radius: .25rem !important; border-top-right-radius: .25rem !important;">
                        <thead>
                        <tr class="admin-custom-color-g">
                          <th>Sr. No</th>
                          <th>LR No.</th>
                          <th>Pallet Date</th>
                          <th>Pallet Qty</th>
                          <th>Dealer Name</th>
                         <th>Pallet Print</th>
                         <th>Update</th>
                         <th>Delete</th>
                         <th>Email Send</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                           $OrderCount=count($PalletData);
                           $limit=5;
                            for($i=0;$i<count($PalletData) && $i < $limit;$i++)
                            {   ?>
                                    <tr>
                                        <td><?=$i+1?></td>
                                         <?php
                                            if($PalletData[$i]["OrderpalletLRNO"] == " ")
                                            {
                                            ?>
                                                <td><?=$PalletData[$i]["OrderpalletLRNOauto"]?></td>   
                                             <?php
                                            }
                                            else
                                            {
                                            ?>
                                             <td><?=$PalletData[$i]["OrderpalletLRNO"]?></td>   
                                            <?php
                                            }
                                            ?>
                                       
                                        <td><?=$PalletData[$i]["OrderpalletDate"]?></td>
                                        <td><?=$PalletData[$i]["OrderpalletTotalQty"]?></td>
                                        <td><?=$PalletData[$i]["DealerName"]?></td>
                                        <!-- <td><?=$PalletData[$i]["OrderpalletTotal"]?></td> -->
                                        <td><a href="<?=site_url('/Admin/PalletBillPrintDifferentTransport/'.$PalletData[$i]["OrderpalletId"])?>"><i class="fa fa-print admin-custom-color-opp" ></i></a></td>
                                        <td><a href="<?=base_url('/Admin/AddPalletCustomDifferent/'.$PalletData[$i]["OrderpalletId"])?>" id="<?=$PalletData[$i]["OrderpalletId"]?>"><i class="fa fa-edit admin-custom-color-opp" ></i></a></td>
                                        <!--<td><button value="<?=$PalletData[$i]["OrderpalletId"]?>" name="orderpallet" class="deletedata"><i class="fa fa-trash admin-custom-color-opp" ></i></button></td>-->
                                        <td><button onclick="myFunction('orderpallet','<?=$PalletData[$i]["OrderpalletId"]?>')"><i class="fa fa-trash admin-custom-color-opp" ></i></button></td>
                                        <td>
                                          <button onclick="sendMail('pallet','<?=$PalletData[$i]["OrderpalletId"]?>')"><i class="fa fa-envelope-o admin-custom-color-opp" ></i></button>
                                        </td>
                                   </tr> 
                               <?php 
                            }
                            ?>
                    
                        </tbody>
                      </table>
                    </div>
                        <div class="card-footer clearfix">
                        <!--a href="<//?=site_url('/Admin/OrderDownloadCSV')?>" class="btn btn-sm admin-custom-color-g float-left" style="padding-right:20px;">Download CSV</a-->
                        <?php if($OrderCount>=1)
                        {
                           
                        ?>
                        <a href="<?=site_url('/Admin/palletDifferent')?>" class="btn btn-sm admin-custom-color-g float-right">View All Orders</a>
                        <?php 
                       }
                       else
                       {
                           ?>
                       <?php
                       }
                       ?>
                  </div>
                  </div>
                    
                </div>
            <!--    <div class="card ">
                    <div class="card-header admin-custom-color-g">
                        <h3 class="card-title" style="text-align:center">LowStock Reminder </h3>
                    </div>
                    <div class="card-body p-0">
                    
                        <div class="table-responsive">
                      <table class="table m-0"  style="border-top-left-radius: .25rem !important; border-top-right-radius: .25rem !important;">
                        <thead>
                        <tr class="admin-custom-color-g">
                          <th>ProductId</th>
                          <th>ProductName</th>
                          <th>ProductCategoryName</th>
                          <th>ProductQuantity</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                          //  $OrderData = json_decode(json_encode($OrderData)) ;
                          // echo "<pre>";
                          //print_r($ProductData);
                            $color = "yellow";
                            //for($i=0;$i<count($ProductData);$i++)
                            for($i=0;$i<5;$i++)
                            //echo "<span style=\"color: $color\">Text</span>";
                            {  
                            $var=$ProductData[$i]["difference"];
                            
                            if ($var < 20){
                               $color = "red";}
                            else{
                               $color = "green";
                            }
                            ?>
                                    <tr>
                                        <td><?=$ProductData[$i]["ProductId"]?></td>
                                        <td><?=$ProductData[$i]["ProductName"]?></td>
                                        <td><?=$ProductData[$i]["SubcategoryName"]?></td>
                        
                                        <?php echo  "<td style=\"color:$color\">"?><?=$ProductData[$i]["difference"]?><?php "</td>"?>
                                        
                                    </tr> 
                               <?php 
                            }
                            ?>
                    
                        </tbody>
                      </table>
                    </div>
                        <div class="card-footer clearfix">
                        <a href="<?=site_url('/Admin/LowstockDifferent')?>" class="btn btn-sm admin-custom-color-g float-right">View All Stock</a>
                  </div>
                    </div>
                    
                   <div class="card ">
                    <div class="card-header admin-custom-color-g">
                        <h3 class="card-title" style="text-align:center">Highest Selling Order </h3>
                    </div>
                    <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table m-0"  style="border-top-left-radius: .25rem !important; border-top-right-radius: .25rem !important;">
                        <thead>
                        <tr class="admin-custom-color-g">
                          <th>ProductId</th>
                          <th>ProductName</th>
                          <th>ProductCategoryName</th>
                          <th>ProductQuantity</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                          //  $OrderData = json_decode(json_encode($OrderData)) ;
                          // echo "<pre>";
                          // print_r($ProductData);
                            //for($i=0;$i<count($ProductHighestData);$i++)
                            for($i=0;$i<count($ProductHighestData);$i++)
                            {   ?>
                                    <tr>
                                        <td><?=$ProductHighestData[$i]["ProductId"]?></td>
                                        <td><?=$ProductHighestData[$i]["ProductName"]?></td>
                                        <td><?=$ProductHighestData[$i]["SubcategoryName"]?></td>
                                        <td><?=$ProductHighestData[$i]["MAX(O.OrderdetailQty)"]?></td>
                                    </tr> 
                               <?php 
                            }
                            ?>
                    
                        </tbody>
                      </table>
                    </div>
                        <div class="card-footer clearfix">
                       <a href="<?=site_url('/Admin/HighestDifferent')?>" class="btn btn-sm admin-custom-color-g float-right">View All</a>
                  </div>
                    </div>
                    
                </div>
               <!-- <div class="card ">
                    <div class="card-header admin-custom-color-g">
                        <h3 class="card-title" style="text-align:center"> Customer Annivarsary and DOB</h3>
                    </div>
                    <div class="card-body p-0">
                    
                        <div class="table-responsive">
                      <table class="table m-0"  style="border-top-left-radius: .25rem !important; border-top-right-radius: .25rem !important;">
                        <thead>
                        <tr class="admin-custom-color-g">
                          <th>Sr No</th>
                          <th>CustomerName</th>
                          <th>DOB</th>
                          <th>Annivarsary</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                          //  $OrderData = json_decode(json_encode($OrderData)) ;
                           // echo "<pre>";
                           // print_r($OrderData);
                            for($i=0;$i<count($CustomerData);$i++)
                            {   ?>
                                    <tr>
                                        <td><?=($i+1)?></td>
                                        <td><?=$CustomerData[$i]["CustomerName"]?></td>
                                        <td><?=$CustomerData[$i]["CustomerDateOfBirth"]?></td>
                                        <td><?=$CustomerData[$i]["CustomerDateOfAnnivarsary"]?></td>
                                    </tr> 
                               <?php 
                            }
                            ?>
                    
                        </tbody>
                      </table>
                    </div>
                    </div>
                    
                </div>
            
            </div>-->
            <div class="col-md-6">
            
            </div>
            
    </section>
    <!-- /.content -->
  </div>
            </div>
            
<!--samundar add for update-->
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
                                    <input type="button" id='add' class=' btn btn-primary col-md-12 ' value="Add" >
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
      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    var deleteData="<?=base_url('Admin/Ajax/deleteData/')?>";
    var lrMailSendUrl="<?=base_url('Admin/Dashboard/pdf_downloadDifferent/')?>";
    var palletMailSendUrl="<?=base_url('Admin/Dashboard/pallet_pdf_downloadDifferent/')?>";

    $(document).ready(function(){
        $(".deletedata").click(function(){
        var r=confirm("Do you  want to delete this record");
        if(r == true)
        {
        var id=$(this).val();
        var Keyname=$(this).attr("name");
            $.ajax({
                type: 'POST',
                url: deleteData + id + '/' + Keyname,
                success: function(data) {
                    alert("Data Deleted Successfully");
                     window.location.reload();
                }
            });
        }
   });
        
});

function myFunction($name,$id) {
   var r=confirm("Do you  want to delete this record");
        if(r == true)
        {
        var id=$id;
        var Keyname=$name;
            $.ajax({
                type: 'POST',
                url: deleteData + id + '/' + Keyname,
                success: function(data) {
                    alert("Data Deleted Successfully");
                     window.location.reload();
                    //$("p").text(data);
                }
            });
        }
}

function sendMail($name,$id) {
  var id = $id;
  var Keyname = $name;

  if(Keyname == 'lr'){
    var main_url= lrMailSendUrl;
  }
  else
  {
    var main_url= palletMailSendUrl;
  }
  // loader start
  $('#loader').show();

  $.ajax({
      type: 'POST',
      url: main_url + id,
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