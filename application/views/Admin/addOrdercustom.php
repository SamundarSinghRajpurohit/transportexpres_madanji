<style>
    @media (min-width: 576px){
      .modal-dialog {
    
        max-width: 800px !important;
      }
    }
    </style>
    <div class="content-wrapper" style="min-height: 496px;">
        <!-- Content Header (Page header) -->
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
                    <form  class="AddUpdateForm1" name="order" enctype="multipart/form-data">
                      <div class="card-body">  
                        <div class="row ">
                            
                            <input type="hidden" name="OrderId"  id="OrderId"  value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderId:''?>">
                            <input type="hidden" class="form-control col-md-12" name="OrderYear"  id="OrderYear"  value="<?=$this->session->Year?>">
                            <input type="hidden" class="form-control col-md-12" name="CompanyId" id="CompanyId"  value="<?=$this->session->CompanyId?>">
                            <input type="hidden" class="form-control col-md-12" name="OrderTotalBoxes" id="OrderTotalBoxes"  value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderTotalBoxes:' ' ?>">
                            <input type="hidden" class="form-control col-md-12" name="OrderTotalWeight"  id="OrderTotalWeight"  value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderTotalWeight:' ' ?>">
                            <input type="hidden" class="form-control col-md-12" name="OrderTotal" id="OrderTotal"  value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderTotal:' ' ?>">
                         
                        <div class=" form-group col-md-3" name="OrderLRNO" id="OrderLRNOdiv" >
                            <label class=" col-md-12"  >Custom LRNO</label> 
                            <input type="text" class="form-control col-md-12" name="OrderCustomLRNO"  id="OrderCustomLRNO"  value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderCustomLRNO:' ' ?>">
                        </div> 
                        <div class=" input-group form-group col-md-3 " name="DealerIddiv"  id="DealerIddiv" >
                            <label class=" col-md-12">Dealer</label> 
                            <input type="text" class="form-control  col-md-12 datalist dealerlist"  list="dealerlist" name="DealerId"  value="<?=(isset($OrderData[0]))?$OrderData[0]->DealerId.'-'.$OrderData[0]->DealerName:' ' ?>">
                            <datalist id="dealerlist">
                            </datalist>
                            <div class="input-group-append">
                              <span class="input-group-text FormModal" data-toggle="modal" data-target="#FormModal" name="dealer" >+ Add</span>
                            </div>
                        </div>                                                                               
                        <div class=" input-group form-group col-md-3" name="OrderEwayBillNoId" id="OrderEwayBillNodiv" >
                            <label class=" col-md-12"  >EwayBill No</label>
                            <input type="text" class="form-control col-md-12" name="OrderEwayBillNo"   value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderEwayBillNo:' ' ?>">
                            
                        </div>                                                                                
                        <div class=" input-group form-group col-md-3" name="ConsigneeId" id="ConsigneeIddiv" >
                            <label class=" col-md-12"  >Consignee</label> 
                            <input type="text" class="form-control col-md-12 datalist " list="consigneelist" name="ConsigneeId" id="ConsigneeId" value="<?=(isset($OrderData[0]))?$OrderData[0]->ConsigneeId.'-'.$OrderData[0]->ConsigneeName:' ' ?>">
                            <datalist id="consigneelist">
                            </datalist>
                            
                            <div class="input-group-append">
                              <span class="input-group-text FormModal" data-toggle="modal" data-target="#FormModal" name="consignee">+ Add</span>
                            </div>
                        </div>                                                                                

                        <!-- company name -->
                        <div class=" input-group form-group col-md-3" name="CompaniesId" id="Companiesdiv" >
                            <label class=" col-md-12"  >Companies Name</label>  
                            <?php
                                $CompaniesName="";
                                if(isset($OrderData[0]->Companies) && $OrderData[0]->Companies !=""){
                                  $CompaniesData = getCompaniesData($OrderData[0]->Companies);

                                  if(!empty($CompaniesData)){
                                    $CompaniesName = $OrderData[0]->Companies.'-'.$CompaniesData[0]->CompaniesName;
                                  }
                                }
                            ?>
                            <input type="text" class="form-control col-md-12 datalist" list="companieslist" name="CompaniesId" id="CompaniesId" value="<?=$CompaniesName ?>">
                            <datalist id="companieslist">
                            </datalist>
                        </div> 
                        <!--  -->
                        
                        <div class=" input-group form-group col-md-3" name="TempoId"  id="TempoIddiv" >
                            <label class=" col-md-12"  >Tempo No</label> 
                            <input type="text" class="form-control col-md-12 datalist" list="tempolist" name="TempoId"  id="tempo"  value="<?=(isset($OrderData[0]))?$OrderData[0]->TempoId.'-'.$OrderData[0]->TempoName:' ' ?>">
                            <datalist id="tempolist">
                            </datalist>
                            <div class="input-group-append">
                              <span class="input-group-text FormModal" data-toggle="modal" data-target="#FormModal" name="tempo">+ Add</span>
                            </div>
                        </div>
                        <div class=" input-group form-group col-md-6" name="OrderAddress"  id="OrderAddressdiv" >
                            <label class=" col-md-12"  >Address</label> 
                            <textarea  class="form-control col-md-12 " name="OrderAddress" id="OrderAddress"><?=(isset($OrderData[0]))?$OrderData[0]->OrderAddress:' '?></textarea>
                        </div>

                        <div class=" form-group col-md-3" name="OrderDate"  id="OrderDatediv" >
                            <label class=" col-md-12"  >Date</label> 
                            <input type="date" class="form-control col-md-12" name="OrderDate"  id="OrderDate"  value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderDate:date('Y-m-d');?>" >
                        </div>

                        <div class=" input-group form-group col-md-2" name="OrderFrom"  id="OrderFromdiv" >
                        <label class=" col-md-12"  >From</label> 
                            <input type="text" class="form-control col-md-12 " list="From" name="OrderFrom"  id="OrderFrom"  value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderFrom:' ' ?>">
                        </div>
                        <div class=" input-group form-group col-md-2" name="OrderTo"  id="OrderTodiv" >
                            <label class=" col-md-12"  >To</label> 
                            <input type="text" class="form-control col-md-12 "  name="OrderTo"  id="OrderTo" value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderTo:' ' ?>">
                        </div>
                        <!-- <div class=" input-group form-group col-md-2" name="check2"  id="check2div" >-->
                        <!--     <label class=" col-md-12"  > </label> -->
                        <!--     <div class="form-check">-->
                        <!--      <label class="form-check-label" for="check2">-->
                        <!--        <input type="checkbox" class="form-check-input" id="check2" name="check2" value="palletPrint">Pallet Print-->
                        <!--      </label>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class=" input-group form-group col-md-3" name="OrderFreight" id="OrderFreightdiv" >
                                <label class=" col-md-12"  >Freight</label> 
                                <input type="text" class="form-control col-md-12" name="OrderFreight" id="OrderFreight" value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderFreight:' ' ?>">
                            </div>
                            <div class="  input-group form-group col-md-3" name="OrderHamali" id="OrderHamalidiv" >
                                <label class=" col-md-12"  >Hamali</label> 
                                <input type="text" class="form-control col-md-12" name="OrderHamali" id="OrderHamali" value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderHamali:' ' ?>">
                            </div>
                             <div class=" input-group form-group col-md-3" name="OrderRateDropDown" id="OrderRateDropDowndiv" >
                                <label class=" col-md-12"  >Rate On</label> 
                                <!--<input type="text" class="form-control col-md-12" name="OrderRateDropDown" id="OrderRateDropDown"  value="">-->
                                <select class="form-control col-md-12" name="OrderRateDropDown" id="OrderRateDropDown">
                                    <?php
                                    if(isset($OrderData[0]->OrderRateDropDown)=='Weight')
                                    {
                                    ?>
                                    <option value="Box">Box</option>
                                    <option value="Weight" selected>Weight</option>
                                    <?php
                                    }
                                    else if(isset($OrderData[0]->OrderRateDropDown)=='Box')
                                    {
                                    ?>
                                    <option value="Box" selected>Box</option>
                                    <option value="Weight">Weight</option>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <option value="Box">Box</option>
                                    <option value="Weight">Weight</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="  input-group form-group col-md-3" name="OrderRate" id="OrderRatediv" >
                                <label class=" col-md-12"  >Rate</label> 
                                <input type="text" class="form-control col-md-12" name="OrderRate" id="OrderRate" value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderRate:' ' ?>">
                            </div>

                            <!-- add for gst % -->
                            <div class=" input-group form-group col-md-3" id="OrderGSTPerdiv" >
                                <label class=" col-md-12"  >GST %</label> 
                                <select class="form-control col-md-12" name="OrderGSTPer" id="OrderGSTPer">
                                    <option value="0" <?=(isset($OrderData[0]->OrderGSTPer) && $OrderData[0]->OrderGSTPer == 0)?'selected':'' ?>>0</option>
                                    <option value="5" <?=(isset($OrderData[0]->OrderGSTPer) && $OrderData[0]->OrderGSTPer == 5)?'selected':'' ?>>5</option>
                                    <option value="12" <?=(isset($OrderData[0]->OrderGSTPer) && $OrderData[0]->OrderGSTPer == 12)?'selected':'' ?>>12</option>
                                    <option value="18" <?=(isset($OrderData[0]->OrderGSTPer) && $OrderData[0]->OrderGSTPer == 18)?'selected':'' ?>>18</option>
                                    <option value="28" <?=(isset($OrderData[0]->OrderGSTPer) && $OrderData[0]->OrderGSTPer == 28)?'selected':'' ?>>28</option>
                                </select>
                            </div>
                            <!-- add for gst % -->

                            <div class="  input-group form-group col-md-3" name="OrderHsnCode" id="OrderHsnCodediv" >
                                <label class=" col-md-12"  >HSN Code</label> 
                                <input type="text" class="form-control col-md-12" name="OrderHsnCode" id="OrderHsnCode" value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderHsnCode:'996511' ?>">
                            </div>

                          <div class="col-md-12">
                              <table id="customTable "class="table table-bordered table-striped table-highlight text-left" >
                                <thead>
                                  <tr>
                                    <td>Product Name</td>
                                    <td>Box</td>
                                    <td>Packing</td>
                                    <td>Weight</td>
                                    <td>DCPI No</td>
                                  
                                  </tr>
                                </thead>
                                <tbody id="CustomDetailView">
                                
                                </tbody>
                                <!-- <tfoot>
                                  <tr class="text-right">
                                    <td colspan="2">Total : <span></span></td>
                                    <td><span id="BoxTotal">100</span></td>
                                    <td><span id="BoxWeight">100</span></td>
                                    <td class="text-left">
                                        <span >Box Total    :<span id="BoxRateTotal">100</span></span><br>
                                        <span >Weight Total :<span id="BoxWeightTotal">100</span></span>
                                    </td>
                                  </tr>
                                </tfoot> -->
                              </table>
                          </div>
                        <!--<div class=' form-group col-md-3'>-->
                        <!--    <input type="button" id='customAdd' class=' col-md-12  float-left' value="Add More Row" >-->
                        <!--</div>-->
                           
                      </div>
                      <div class="row float-right">
                        <div class=" form-group col-md-12">
                          <input type="submit" name="btnSubmit" class="btn admin-custom-color  col-md-12" />
                        </div>
                      </div>                        
                    </form>
                  </div>
                    </form>
                </div>
                
              </div>
            </section>
        <!-- /.modal -->

          <!-- /.modal -->
    </div>
    <!-- Modal For Dealer-->
    <div class="modal fade" id="FormModal" role="dialog" tabindex='-1'>
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <h3 class="login-box-msg">Add </h3><h3 id="FormName"></h3><button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body login-card-body">
                    <form class="DynamicForm "  name="dealer" enctype="multipart/form-data">
                      <div id="FormModalForm"></div>
                      <button type="submit" name="btnSubmit" class="btn  btn-primary btn-block btn-flat" style="box-shadow: 0 0 10px rgba(0,0,0,.2);background: blue;border-radius: 5px;">Submit</button>
                         
                    </form>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

    var ajaxAddCustomRow="<?=base_url('Admin/Ajax/custom_add_columns')?>";
    var ajaxAddCustomRowUpdate="<?=base_url('Admin/Ajax/custom_add_columns_update/')?>";
    var ajaxAddForm="<?=base_url('Admin/Ajax/add_form/')?>";
    var ajaxFetchAddress="<?=base_url('Admin/Ajax/getAddressById/')?>";
    var billLink="<?=base_url('Admin/BillPrintDifferentTransport/')?>";
    var fetchDetail="<?=base_url('Admin/Ajax/get_a_data/')?>";
    var customRow=11;
   // var CustomDetailArray = "1,2,3,4,5,6,7,8,9,10";
    var CustomDetailArray = [1,2,3,4,5,6];
    //var DetailArray = [];
    var temp='test';

    $(document).ready(function(){
    $( ".datalist" ).focus(function() {
        var name=$(this).attr('name');
        name = name.replace("Id", "");
        name= name.toLowerCase();
        $('#'+name+'list').empty();
        //alert(name);

        var tblname=name;
        var searchValue=$(this).val();
        $.ajax({ 
            type: "POST",
            dataType: "html",
            url: "<?=base_url('Admin/Ajax/searchOnKeyPress/')?>"+tblname,
            context: document.body,
            success: function(response){
                var data=JSON.parse(response);
                $('#'+name+'list').empty();
        
                for (var i = 0; i < data.length; i++) {
                    //alert("<option data-id='2' value=\"" + data[i] + "\">" + data[i] + "</option>");
                    $('#'+name+'list').append("<option data-id='2' value=\"" + data[i] + " \">" + data[i] + " </option>");
                }
              
        }});
        
    });
    // $( ".dealerlist" ).focusout(function() {
    //     var key="tbldealer";
    //     var searchValue=$(this).val();
    //     $.ajax({ 
    //         type: "POST",
    //         dataType: "html",
    //         url: fetchDetail+key+'/'+searchValue,
    //         context: document.body,
    //         success: function(response){
    //             var data=JSON.parse(response);
    //             $('#'+name+'list').empty();
        
    //             for (var i = 0; i < data.length; i++) {
    //                 $('#'+name+'list').append("<option data-id='2' value='" + data[i] + "'>" + data[i] + "</option>");
    //             }
              
    //     }});
        
    // });
        var j=7;
      $('#customAdd').click(function(){
        //CustomDetailArray.push(i);
        //i++;
        DetailArray.push(i);
        CustomDetailArray.push(j);
        j++;
        $.ajax({
            url:ajaxAddCustomRow+'/'+temp+'/'+customRow,
            /*dataType:"json",*/
                success:function(response)
                { 
                    //temp="tableRow"+i;
                    //alert(temp);
                    
                    $('#CustomDetailView').append(response); 
                },      
            });
      });

    }); 
    <?php
      if(isset($OrderData[0]))  
      {   
    ?>
      $(document).ready(function(){
        //kd unnecssary added heading
        var  orderId= <?=$OrderData[0]->OrderId;?>;
        var keyName= '<?=$pageName;?>';
        //alert(keyName);
        $.ajax({
            url:ajaxAddCustomRowUpdate+orderId+'/'+keyName, 
                success:function(response)
                { 
                    $('#CustomDetailView').append(response);
                    flag=1;
                },      
                
        
        });
      });
      <?php
      }
      else
      {
      ?>
      $(document).ready(function(){
        //kd unnecssary added heading
        
        $.ajax({
            url:ajaxAddCustomRow,
                success:function(response)
                { 
                    $('#CustomDetailView').append(response);
                    $('#OrderCustomLRNO').focus();
                    flag=1;
                },      
                
        
        });
      });
      <?php
      }
      ?>
    //samundar
    $('.AddUpdateForm1').on('submit',(function(e) {
            //alert("main Form");
            e.preventDefault();
            //if(e.which===32)
            {
              var r = confirm("All the Data Inserted/Updated is Perfect");
              if (r == true) 
              {
                  //var tblName ="<?=$tblName?>";
                  var tblName=$(this).attr('name');
                  /*alert(name);
                  die();*/
                  var formData = new FormData(this);
                  var CustomDetailArrayString = CustomDetailArray.toString();
                  formData.append("DetailArray",CustomDetailArrayString );
                  //alert(DetailArray);  
                  $.ajax({
                      
                      type:'POST',
                      url:"<?=site_url('Admin/Ajax/insert_data/');?>"+tblName,
                      data:formData,
                      cache:false,
                      async: false,
                      contentType: false,
                      processData: false,
                      success:function(data){
                        if(data>1)
                          {
                                  
                                //  $('#example1').DataTable().ajax.reload();
                                  $('.AddUpdateForm1')[0].reset();
                                  $("input[type=hidden]").val('');
                                //  $('#AddFormBody').css("display", "none");
                                //  $('#AddFormCard').addClass("collapsed-card");
                                // $("#DetailView").find("tr:gt(0)").remove();
                                  //  $("#DetailView").find("tr").remove();
                                  //  $("#UpdateDetailView").find("tr").remove();
                                  // alert("Data Inserted/Update Successfully");
                                  DetailArray=[];
                                  //window.location.replace(billLink+data);
                                      //customsales();
                                      $("html, body").animate({ scrollTop: 0 }, "slow");
                                      //$('#insert-modal').modal('hide');             //nilesh 8/2/2021
                                      //$('#example2').DataTable().reload();                //
                                      window.location.reload();                            //window added
                          }   
                          else
                          {
                              alert("Data  Inserted/Update Un-Successfully");
                          }
                      
                      },
                  });
                  //custom  code
                  //code for direct entry
                  //var tempTblName=capitalizeFirstLetter(tblName);
                  if(tblName.localeCompare("member")==0)
                  {
                      
                      {
                          var data = memberName+' - '+memberNo;
                          var AccountsId;
                          formData.append('AccountsName',data);
                          formData.append('GroupId',groupId);
                          $.ajax({
                              type:'POST',
                              url:"<?=site_url('Admin/Ajax/insert_data/');?>"+"accounts",
                              data:formData,
                              cache:false,
                              async: false,
                              contentType: false,
                              processData: false,
                              success:function(data){
                                if(data>0)
                                  {       
                                      alert("Accounts Data Inserted/Update Successfully");
                                      AccountsId=data;
                                    //  alert(AccountsId);
                                  }   
                                  else
                                  {
                                      alert("AccountsData  Inserted/Update Un-Successfully");
                                  }
                              
                                  },
                          });
                          //var formData2 = new FormData();
                          formData.append('AccountsId',AccountsId);
                          formData.append('GroupId',groupId);
                          $.ajax({
                              type:'POST',
                              url:"<?=site_url('Admin/Ajax/insert_data/');?>"+"sales",
                              data:formData,
                              cache:false,
                              async: false,
                              contentType: false,
                              processData: false,
                              success:function(data){
                                if(data>0)
                                  {       
                                      alert("Sales Data Inserted/Update Successfully");
                                      AccountsId=data;
                                  }   
                                  else
                                  {
                                      alert("AccountsData  Inserted/Update Un-Successfully");
                                  }
                              
                                  },
                          });
                    
                          
                      }
                      
                  }
              
              }
            }
    }));

    $('.DynamicForm').on('submit',(function(e) {
            //alert(" Dynamic Form Submit working ");
            e.preventDefault();
            var r = confirm("All the Data Inserted/Updated is Perfect");
            if (r == true) 
            {
              //var tblName ="<?=$tblName?>";
              //var tblName=$('#FormName').attr('name');
              var tblName=$('#FormName').html();
              
              /*alert(name);
              die();*/
              var formData = new FormData(this);
              var CustomDetailArrayString = CustomDetailArray.toString();
              formData.append("DetailArray",CustomDetailArrayString );
              //alert(DetailArray);  
              $.ajax({
                  
                  type:'POST',
                  url:"<?=site_url('Admin/Ajax/insert_data/');?>"+tblName,
                  data:formData,
                  cache:false,
                  async: false,
                  contentType: false,
                  processData: false,
                  success:function(data){
                    if(data>1)
                      {
                              
                        $('.DynamicForm')[0].reset();
                        $("input[type=hidden]").val('');
                        DetailArray=[];
                   
                      }   
                      else
                      {
                          alert("Data  Inserted/Update Un-Successfully");
                      }
                  
                  },
              });           
            } 
    }));
    
    $('.FormModal').click(function(){
      $('#FormModalForm').empty();
      var name=$(this).attr("name");
      $('#FormName').css('textTransform', 'capitalize');
      $('#FormName').html(name);
      
      $.ajax({
            url:ajaxAddForm+name,
            /*dataType:"json",*/
                success:function(response)
                { 
                    //temp="tableRow"+i;
                    //alert(temp);
                //    $('#FormModalForm').empty();
        
                    $('#FormModalForm').append(response); 
                    $('#DealerName').focus();
                    $('#ConsigneeName').focus();
                    $('#TempoName').focus();
                  //custom  code  aarya start 
                  
                  // $( "#MemberdetailMembershipNo"+i ).prop( "disabled", true ); 
                  //end
                },      
            });
    });
    /*$(document).ready(function(){
    $.ajax({ url: "<?=base_url('Admin/Ajax/add_columns/order/1')?>",
            context: document.body,
            success: function(response){
              $('#UpdateDetailView').append(response);
            }});
    });*/
//samundra add jquery for consignee select then that address autometic fetch 15-05-2021
$(document).ready(function(){
  $("#ConsigneeId").change(function(){
     var name=$(this).val();
     var Keyname=$(this).attr("name");
    //  alert(name);
    //  alert(Keyname); 
      $.ajax({
            url:ajaxFetchAddress+name+'/'+Keyname,
            /*dataType:"json",*/
                success:function(response)
                { 
                   // alert(response);
                    $('#OrderAddress').html(response); 
                },      
            });
    //alert("The text has been changed.");
    
    
  });
});
//samundar
    </script>