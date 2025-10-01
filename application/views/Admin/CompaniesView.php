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
                <div class="widget-user-header  admin-custom-color-g admin-table-header">
                    <button class="btn admin-custom-color-opp"><a class="nav-link active"  data-toggle="modal" data-target="#insert-modal">Add New</a></button>
                </div>
                <div class="widget-user-image admin-custom-table-pos" >
                    <div class="row">
                       
                        <div class="col-md-12 pt-3">
                            <div class="card custom-card">
                                <table class=" table-bordered   table custom-table m-0" cellspacing="0" id="example2" >
                                <thead class="custom-table-thead">
                                <tr class="custom-table-tr">
                                  <th class="custom-table-th">ID</th>
                                  <th class="custom-table-th">Name</th>
                                  <th class="custom-table-th">Company Name</th>
                                  <th class="custom-table-th">Address</th>
                                  <th class="custom-table-th">Pincode</th>
                                  <th class="custom-table-th">PhoneNo</th>
                                  <th class="custom-table-th">Email</th>
                                  <th class="custom-table-th">PanNO</th>
                                  <th class="custom-table-th">GstNo</th>
                                  <th class="custom-table-th">Action</th>
                                </tr>
                            </thead>
                                <tbody class="custom-table-tbody">
                                <?php
                               // print_r($mainData);
                                for($i=0;$i<count($mainData);$i++)
                                {   ?>
                                        <tr class="custom-table-tr">
                                            <td class="custom-table-td"><?=($i+1)?></td>
                                            <td class="custom-table-td"><?=$mainData[$i]["CompaniesName"]?></td>
                                            <td class="custom-table-td"><?=$mainData[$i]["CompanyName"]?></td>
                                            <td class="custom-table-td"><?=$mainData[$i]["CompaniesAddress"]?></td>
                                            <td class="custom-table-td"><?=$mainData[$i]["CompaniesPincode"]?></td>
                                            <td class="custom-table-td"><?=$mainData[$i]["CompaniesPhoneNo"]?></td>
                                            <td class="custom-table-td"><?=$mainData[$i]["CompaniesEmailId"]?></td>
                                            <td class="custom-table-td"><?=$mainData[$i]["CompaniesPANNo"]?></td>
                                            <td class="custom-table-td"><?=$mainData[$i]["CompaniesGSTNO"]?></td>
                                            <td class="custom-table-td"><a id="<?=$mainData[$i]["CompaniesId"]?>" class="updatedata" data-toggle="modal" data-target="#insert-modal" >
                                                <i class="fa fa-edit admin-custom-color-opp" ></i></a>
                                            <a id="<?=$mainData[$i]["CompaniesId"]?>" class="deletedata"><i class="fa fa-trash admin-custom-color-opp" ></i></a>
                                            </td>                                            
                                        </tr> 
                                   <?php 
                                }
                                ?>
                        
                            </tbody>
                            </table>
                            </div>    
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
removeElement("ProductLowstockdiv");
function removeElement(BoxName)
{
    var w = document.getElementById(BoxName);
    if (w.style.display === "none") {
    w.style.display = "block";
  } else {
    w.style.display = "none";
  }
    
}
</script>