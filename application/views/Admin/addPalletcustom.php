<style>
    @media (min-width: 576px){
      .modal-dialog {
    
        max-width: 800px !important;
      }
    }
    </style>
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
                    <form  class="AddUpdateForm1" name="orderpallet" enctype="multipart/form-data">
                      <div class="card-body">  
                        <div class="row ">
                            
                            <input type="hidden" name='OrderpalletId'  id='OrderpalletId' value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderpalletId:''?>">
                            <!--input type="hidden" class="form-control col-md-12" name="OrderYear"  id="OrderYear"  value="<?=$this->session->Year?>"-->
                            <input type="hidden" class="form-control col-md-12" name="CompanyId" id="CompanyId"  value="<?=$this->session->CompanyId?>">
                            <!--input type="hidden" class="form-control col-md-12" name="OrderTotalBoxes" id="OrderTotalBoxes"  value="">
                            <input type="hidden" class="form-control col-md-12" name="OrderTotalWeight"  id="OrderTotalWeight"  value="">
                            <input type="hidden" class="form-control col-md-12" name="OrderTotal" id="OrderTotal"  value=""-->
                         
                        <div class=" form-group col-md-3" name="OrderpalletLRNO" id="OrderpalletLRNOdiv" >
                            <label class=" col-md-12"  >LR NO</label> 
                            <input type="text" class="form-control col-md-12" name="OrderpalletLRNO"  id="OrderpalletLRNO" value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderpalletLRNO:' ' ?>">
                        </div>                                                                                
                        <div class=" input-group form-group col-md-3 " name="DealerIddiv"  id="DealerIddiv" >
                            <label class=" col-md-12">Dealer</label> 
                            <input type="text" class="form-control  col-md-12 datalist dealerlist"  list="dealerlist" name="DealerId" value="<?=(isset($OrderData[0]))?$OrderData[0]->DealerId.'-'.$OrderData[0]->DealerName:' ' ?>">
                            <datalist id="dealerlist">
                            </datalist>
                            <div class="input-group-append">
                              <span class="input-group-text FormModal" data-toggle="modal" data-target="#FormModal" name="dealer" >+ Add</span>
                            </div>
                        </div>                                                                               
                        <div class=" form-group col-md-3" name="OrderpalletDate"  id="OrderpalletDatediv" >
                            <label class=" col-md-12"  >Date</label> 
                            <input type="date" class="form-control col-md-12" name="OrderpalletDate"  id="OrderpalletDate"  value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderpalletDate:date('Y-m-d');?>">
                        </div>
                        
                        <div class=" input-group form-group col-md-3" name="TempoId"  id="TempoIddiv" >
                            <label class=" col-md-12"  >Tempo No</label> 
                            <input type="text" class="form-control col-md-12 datalist" list="tempolist" name="TempoId"  id="tempo"  value="<?=(isset($OrderData[0]))?$OrderData[0]->TempoId.'-'.$OrderData[0]->TempoName:' ' ?>">
                            <datalist id="tempolist">
                            </datalist>
                            <div class="input-group-append">
                              <span class="input-group-text FormModal" data-toggle="modal" data-target="#FormModal" name="tempo">+ Add</span>
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

                        <div class=" input-group form-group col-md-3" name="OrderpalletPartycode"  id="OrderpalletPartycodediv" >
                        <label class=" col-md-12"  >Party Code</label> 
                            <input type="text" class="form-control col-md-12 " name="OrderpalletPartycode"  id="OrderpalletPartycode" value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderpalletPartycode:' ' ?>">
                        </div>

                        <!-- add for gst % -->
                        <div class=" input-group form-group col-md-3" id="OrderpalletGSTPerdiv" >
                              <label class=" col-md-12"  >GST %</label> 
                              <select class="form-control col-md-12" name="OrderpalletGSTPer" id="OrderpalletGSTPer">
                                  <option value="0" <?=(isset($OrderData[0]->OrderpalletGSTPer) && $OrderData[0]->OrderpalletGSTPer == 0)?'selected':'' ?>>0</option>
                                  <option value="5" <?=(isset($OrderData[0]->OrderpalletGSTPer) && $OrderData[0]->OrderpalletGSTPer == 5)?'selected':'' ?>>5</option>
                                  <option value="12" <?=(isset($OrderData[0]->OrderpalletGSTPer) && $OrderData[0]->OrderpalletGSTPer == 12)?'selected':'' ?>>12</option>
                                  <option value="18" <?=(isset($OrderData[0]->OrderpalletGSTPer) && $OrderData[0]->OrderpalletGSTPer == 18)?'selected':'' ?>>18</option>
                                  <option value="28" <?=(isset($OrderData[0]->OrderpalletGSTPer) && $OrderData[0]->OrderpalletGSTPer == 28)?'selected':'' ?>>28</option>
                              </select>
                          </div>
                          <!-- add for gst % -->

                          <div class="  input-group form-group col-md-3" name="OrderpalletHsnCode" id="OrderpalletHsnCodediv" >
                              <label class=" col-md-12"  >HSN Code</label> 
                              <input type="text" class="form-control col-md-12" name="OrderpalletHsnCode" id="OrderpalletHsnCode" value="<?=(isset($OrderData[0]))?$OrderData[0]->OrderpalletHsnCode:'996511' ?>">
                          </div>

                          <div class="col-md-12">
                              <table id="customTable "class="table table-bordered table-striped table-highlight text-left" >
                                <thead>
                                  <tr>
                                    <td>Qty</td>
                                    <td>Rate</td>
                                    <!-- <td>Total</td> -->
                                  </tr>
                                </thead>
                                <tbody id="CustomDetailView">
                                
                                </tbody>
                               
                              </table>
                          </div>
                          <div class="col-md-12">
                              <table id="customTable"class="table table-bordered table-striped table-highlight text-left" >
                                <thead>
                                  <tr>
                                    <td>Consignee</td>
                                    <td>Qty</td>
                                    <td>Rate</td>
                                    <!-- <td>Total</td> -->
                                  </tr>
                                </thead>
                                <tbody id="CustomDetailView1">
                                
                                </tbody>
                               
                              </table>
                          </div>
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

    <div class="modal fade" id="ModalForDealer" role="dialog" tabindex='-1'>
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <h3 class="login-box-msg">Add Dealer</h3><button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body login-card-body">
                    <form class="AddUpdateForm1" name="Dealer" enctype="multipart/form-data">
                    <div class="row">
                        <input type="Hidden" class="form-control input" name="CompanyId" Value="<?=$this->session->CompanyId?>">
                        
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >Name</label> 
                          <input type="text" class="form-control input" name="DealerName" placeholder="Dealer Name">
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >ShortName</label> 
                          <input type="text" class="form-control input" name="DealerShortName" placeholder="Dealer Short Name">
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >PersonName</label> 
                          <input type="text" class="form-control input" name="DealerPersonName" placeholder="DealerPersonName">
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >Address</label> 
                          <textarea class="form-control" id="DealerAddress" name="DealerAddress" rows="4" placeholder="DealerAddress"></textarea>
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >Pincode</label> 
                          <input type="text" class="form-control input" name="DealerPincode" placeholder="DealerPincode">
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >Area</label> 
                          <input type="text" class="form-control input" name="DealerArea" placeholder="DealerArea">
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12">Country</label> 
                          <select class=" form-control col-md-12" id="CountryId" name="CountryId">
                                <?php 
                                
                                for($i=0;$i<count($CountryData);$i++)
                                {
                                ?>
                                    <option value="<?=$CountryData[$i]->CountryId?>" name="CountryId" id="CityId"><?=$CountryData[$i]->CountryName?></option>
                                <?php
                                    
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >State</label> 
                          <select class=" form-control col-md-12" id="StateId" name="StateId">
                                <?php 
                                
                                for($i=0;$i<count($StateData);$i++)
                                {
                                ?>
                                    <option value="<?=$StateData[$i]->StateId?>" name="StateId" id="CityId"><?=$StateData[$i]->StateName?></option>
                                <?php
                                    
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >City</label> 
                          <select class=" form-control col-md-12" id="CityId" name="CityId">
                                <?php 
                                
                                for($i=0;$i<count($CityData);$i++)
                                {
                                ?>
                                    <option value="<?=$CityData[$i]->CityId?>" name="CityId" id="CityId"><?=$CityData[$i]->CityName?></option>
                                <?php
                                    
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >PhoneNo</label> 
                          <input type="text" class="form-control input" name="DealerPhoneNo" placeholder="DealerPhoneNo">
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >Email</label> 
                          <input type="email" class="form-control input" name="DealerEmailId" placeholder="DealerEmailId">
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >PANNo</label> 
                          <input type="text" class="form-control input" name="DealerPANNo" placeholder="DealerPANNo">
                        </div>
                        <div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >GSTNO</label> 
                          <input type="text" class="form-control input" name="DealerGSTNO" placeholder="DealerGSTNO">
                        </div><div class="form-group has-feedback col-md-6">
                          <label class=" col-md-12"  >TaxNo</label> 
                          <input type="text" class="form-control input" name="DealerSerTaxNo" placeholder="DealerSerTaxNo">
                        </div>
                        
                          <div class="col-md-6">
                            <button type="submit" name="btnSubmit" class="btn  btn-primary btn-block btn-flat" style="box-shadow: 0 0 10px rgba(0,0,0,.2);background: blue;border-radius: 5px;">Submit</button>
                          </div>
                        
                    </div>
              </form>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <!-- Modal For Consignor-->
    <div class="modal fade" id="ModalForConsignor" role="dialog" tabindex='-1'>
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="card-body login-card-body">
                <p class="login-box-msg">Add Consignor</p>
                
                <form  class="AddUpdateForm1" name="Consignor" enctype="multipart/form-data">
                
                <input type="Hidden" class="form-control input" name="CompanyId" Value="<?=$this->session->CompanyId?>">
                
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >Name</label> 
                  <input type="text" class="form-control input" name="ConsignorName" placeholder="Consignor Name">
                </div>
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >Address</label> 
                  <textarea class="form-control" id="ConsignorAddress" name="ConsignorAddress" rows="4" placeholder="Consignor Address"></textarea>
                </div>
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >Email</label> 
                  <input type="email" class="form-control input" name="ConsignorEmailId" placeholder="Consignor EmailId">
                </div>
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >PhoneNo</label> 
                  <input type="text" class="form-control input" name="ConsignorPhoneNo" placeholder="Consignor PhoneNo">
                </div>
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >GSTNO</label> 
                  <input type="text" class="form-control input" name="ConsignorGSTNo" placeholder="Consignor GSTNo">
                </div>
              <div class="form-group has-feedback">
                  <label class=" col-md-12"  >Image</label> 
                  <input type="file" class="form-control input" name="ConsignorImage" placeholder="Consignor Image">
                </div>
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >CompanyName</label> 
                  <input type="text" class="form-control input" name="ConsignorCompanyName" placeholder="CompanyName">
                </div>
                <div class="row">
                  <div class="col-12">
                    <button type="submit" name="btnSubmit" class="btn btn-primary btn-block btn-flat" style="box-shadow: 0 0 10px rgba(0,0,0,.2);background: blue;border-radius: 5px;">Submit</button>
                  </div>
                </div>
                
              </form>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <!-- Modal For Consignee-->
    <div class="modal fade" id="ModalForConsignee" role="dialog" tabindex='-1'>
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="card-body login-card-body">
                <p class="login-box-msg">Add Consignee</p>
                
                <form  class="AddUpdateForm1" name="Consignee" enctype="multipart/form-data">
                
                <input type="Hidden" class="form-control input" name="CompanyId" Value="<?=$this->session->CompanyId?>">
                
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >Name</label> 
                  <input type="text" class="form-control input" name="ConsigneeName" placeholder="Consignee Name">
                </div>
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >Address</label> 
                  <textarea class="form-control" id="ConsigneeAddress" name="ConsigneeAddress" rows="4" placeholder="Consignee Address"></textarea>
                </div>
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >Email</label> 
                  <input type="email" class="form-control input" name="ConsigneeEmailId" placeholder="Consignee EmailId">
                </div>
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >PhoneNo</label> 
                  <input type="text" class="form-control input" name="ConsigneePhoneNo" placeholder="Consignee PhoneNo">
                </div>
                <!--<div class="form-group has-feedback">
                  <label class=" col-md-12"  >GSTNO</label> 
                  <input type="text" class="form-control input" name="ConsignorGSTNo" placeholder="Consignor GSTNo">
                </div>-->
              <div class="form-group has-feedback">
                  <label class=" col-md-12"  >Image</label> 
                  <input type="file" class="form-control input" name="ConsigneeImage" placeholder="Consignee Image">
                </div>
                <!--<div class="form-group has-feedback">
                  <label class=" col-md-12"  >CompanyName</label> 
                  <input type="text" class="form-control input" name="ConsignorCompanyName" placeholder="CompanyName">
                </div>-->
                <div class="row">
                  <div class="col-12">
                    <button type="submit" name="btnSubmit" class="btn btn-primary btn-block btn-flat" style="box-shadow: 0 0 10px rgba(0,0,0,.2);background: blue;border-radius: 5px;">Submit</button>
                  </div>
                </div>
                
              </form>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <!-- Modal For Tempo-->
    <div class="modal fade" id="ModalForTempo" role="dialog" tabindex='-1'>
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="card-body login-card-body">
                <p class="login-box-msg">Add Tempo</p>
                
                <form  class="AddUpdateForm1" name="Tempo" enctype="multipart/form-data">
                
                <input type="Hidden" class="form-control input" name="CompanyId" Value="<?=$this->session->CompanyId?>">
                
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >Tempo No</label> 
                  <input type="text" class="form-control input" name="TempoName" placeholder="Tempo No">
                </div>
                <div class="form-group has-feedback">
                  <label class=" col-md-12"  >Driver Name</label> 
                  <input type="text" class="form-control input" name="TempoDriverName" placeholder="Driver Name">
                </div>
                
                <div class="row">
                  <div class="col-12">
                    <button type="submit" name="btnSubmit" class="btn btn-primary btn-block btn-flat" style="box-shadow: 0 0 10px rgba(0,0,0,.2);background: blue;border-radius: 5px;">Submit</button>
                  </div>
                </div>
                
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

    // var ajaxAddCustomRow="http://transportexpert.idnmserver.com/Admin/Ajax/custom_add_columns_for_pallet/";
    // var ajaxAddCustomRowUpdate="http://transportexpert.idnmserver.com/Admin/Ajax/custom_add_columns_update/";
    // var ajaxAddForm="http://transportexpert.idnmserver.com/Admin/Ajax/add_form/";
    // var billLink="http://transportexpert.idnmserver.com/Admin/BillPrintDifferentTransport/";
    //
    var ajaxAddCustomRow="<?=base_url('Admin/Ajax/custom_add_columns_for_pallet')?>";
    var ajaxAddCustomRow1="<?=base_url('Admin/Ajax/custom_add_columns_for_pallet_detail2')?>";
    var ajaxAddCustomRowUpdate="<?=base_url('Admin/Ajax/custom_add_columns_update/')?>";
    //var ajaxAddCustomRowUpdate1="<?=base_url('Admin/Ajax/custom_add_columns_update/')?>";
    var ajaxAddForm="<?=base_url('Admin/Ajax/add_form/')?>";
    //var ajaxFetchAddress="<?=base_url('Admin/Ajax/getAddressById/')?>";
    var billLink="<?=base_url('Admin/BillPrintDifferentTransport/')?>";
    //
    var fetchDetail="<?=base_url('Admin/Ajax/get_a_data/')?>";
    var customRow=11;
    var CustomDetailArray = "1,2,3,4,5,6,7,8,9,10";
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
                    //$('#'+name+'list').append("<option data-id='2' value='" + data[i] + "'>" + data[i] + "</option>");
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
    
      $('#customAdd').click(function(){
        
        DetailArray.push(i);
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
        var  orderId= <?=$OrderData[0]->OrderpalletId;?>;
        var keyName= '<?=$pageName;?>';
        var keyName1= 'Orderpalletdetail2';
        //alert(keyName);
        $.ajax({
            url:ajaxAddCustomRowUpdate+orderId+'/'+keyName, 
                success:function(response)
                { 
                    $('#CustomDetailView').append(response);
                    flag=1;
                },      
        });
        $.ajax({
            url:ajaxAddCustomRowUpdate+orderId+'/'+keyName1, 
                success:function(response)
                { 
                    $('#CustomDetailView1').append(response);
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
                    flag=1;
                },      
                
        
        });
      });
      $(document).ready(function(){
        //kd unnecssary added heading
        
        $.ajax({
            url:ajaxAddCustomRow1,
                success:function(response)
                { 
                    $('#CustomDetailView1').append(response);
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
                  /*alert(tblName);
                  die();*/
                  var formData = new FormData(this);
                  var CustomDetailArrayString = CustomDetailArray.toString();
                  formData.append("DetailArray",CustomDetailArrayString );
                   var CustomDetailArrayString1 = CustomDetailArray.toString();
                  formData.append("DetailArray2",CustomDetailArrayString1 );
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
                                  DetailArray2=[];
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
    </script>