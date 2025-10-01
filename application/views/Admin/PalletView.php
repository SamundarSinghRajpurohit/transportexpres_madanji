<div class="content-wrapper" style="min-height: 496px;">
    <!-- Content Header (Page header) -->
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
      </div><!-- /.container-fluid -->
    </section>
    
    
    <section class="content">
        <div class="container-fluid">
            <div class="card card-widget widget-user ">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header  admin-custom-color-g admin-table-header">
                    
                    <!--    <h3 class="widget-user-username">Alexander Pierce</h3>
                        <h5 class="widget-user-desc">Founder &amp; CEO</h5>-->
                </div>
                <div class="widget-user-image admin-custom-table-pos" >
                    <div class="row">
                        <!--<div class="col-md-2">-->
                            
                        <!--</div>-->
                        <div class="col-md-12">
                            <div class="card custom-card">
                                <table class=" table-bordered   table custom-table m-0" cellspacing="0" id="example2" >
                                <thead class="custom-table-thead">
                                    <tr class="custom-table-tr">
                                        <th>Sr No.</th>
                                        <th>Lr No</th>
                                        <th>Pallet Date</th>
                                        <th>Dealer Name</th>
                                        <th>Total Qty</th>
                                        <th>Tempo No</th>
                                        <th>Action</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody class="custom-table-tbody">
                                <?php
                                //  "<pre>";
                                // print_r($mainData);
                                for($i=0;$i<count($mainData);$i++)
                                {   ?>
                                        <tr class="custom-table-tr">
                                            <td><?=$i+1?></td>
                                            <td><?=$mainData[$i]["OrderpalletLRNO"]?></td>   
                                            <td><?=$mainData[$i]["OrderpalletDate"]?></td>
                                            <td><?=$mainData[$i]["DealerName"]?></td>
                                            <td><?=$mainData[$i]["OrderpalletTotalQty"]?></td>
                                            <td><?=$mainData[$i]["TempoName"]?></td>
                                            <td class="custom-table-td">
                                                <!--<a id="<?=$mainData[$i]["OrderpalletId"]?>" class="updatedata" data-toggle="modal" data-target="#insert-modal" ><i class="fa fa-edit admin-custom-color-opp" ></i></a>-->
                                                <a href="<?=base_url('/Admin/AddPalletCustomDifferent/'.$mainData[$i]["OrderpalletId"])?>" id="<?=$mainData[$i]["OrderpalletId"]?>"><i class="fa fa-edit admin-custom-color-opp" ></i></a>
                                               <!-- <a id="<?=$mainData[$i]["OrderpalletId"]?>" class="deletedata"><i class="fa fa-trash admin-custom-color-opp" ></i></a>-->
                                                <a href="<?=site_url('Admin/PalletBillPrintDifferentTransport/'.$mainData[$i]["OrderpalletId"])?>" ><i class="fa fa-print admin-custom-color-opp" ></i></a>
                                                 <!--<a href="<?=site_url('/Admin/BillPrintDifferent/'.$mainData[$i]["OrderpalletId"])?>"><i class="fa fa-print admin-custom-color-opp" ></i></a>-->
                                               <!-- <a id="<?=$mainData[$i]["OrderpalletId"]?>" class="smsdata" data-toggle="modal" data-target="#sms-modal" ><i class="fa fa-envelope admin-custom-color-opp" ></i></a>-->
                                            </td>
                                            <td>
                                                <!--<button value="<?=$mainData[$i]["OrderpalletId"]?>" name="orderpallet" class="deletedata1"><i class="fa fa-trash admin-custom-color-opp" ></i></button>-->
                                                <button onclick="myFunction('orderpallet','<?=$mainData[$i]["OrderpalletId"]?>')"><i class="fa fa-trash admin-custom-color-opp" ></i></button>
                                            </td>
                                        </tr> 
                                   <?php 
                                }
                                ?>
                        
                            </tbody>
                            </table>
                            </div>    
                        </div>
                        <!--<div class="col-md-2">-->
                            
                        <!--</div>-->
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
      
      <div class="modal fade" id="sms-modal">
            <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header admin-custom-color-g">
              <h4 class="modal-title">Send SMS</h4>
              <button type="button" class="close " data-dismiss="modal"  style="color:white;" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form    enctype="multipart/form-data">
                    <div class="card-body">  
                        <div class="row ">
                            <div class='col-md-12'>
                            </div>
                            <div style="overflow-x:auto;">
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" name="btnSubmit" id="btnSubmit" class="btn admin-custom-color">Submit</button>
                           </div>
                        </div>
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

<script type="text/javascript">
    var deleteData="<?=base_url('Admin/Ajax/deleteData/')?>";

    $(document).ready(function(){
        $(".deletedata1").click(function(){
        var r=confirm("Do you  want to delete this record");
        if(r == true)
        {
        var id=$(this).val();
        var Keyname=$(this).attr("name");
       // alert(id);
        //alert(Keyname);
        //die();
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
   });
});

function myFunction($name,$id) {
   var r=confirm("Do you  want to delete this record");
        if(r == true)
        {
        var id=$id;
        var Keyname=$name;
        // alert(id);
        // alert(Keyname);
        // die();
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
</script>