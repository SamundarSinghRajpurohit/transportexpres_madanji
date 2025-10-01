
<section class="content">
    <div class="row">
        <div class="col-md-12"> 
            <div id="AddFormCard" class="card card-default collapsed-card " >
              <div class="card-header">
                <h3 class="card-title">Add <?=ucfirst($page)?></h3>
                <div class="card-tools" >
                  <button type="button" id="AddBtn"  class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="AddFormBody">
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
                                    <input type="button" id='add' class=' btn btn-dark col-md-12 ' value="Add" >
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
                            <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-dark">Submit</button>
                      </div>
                     </div> 
                </form>
              </div>
                </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    
</section>
