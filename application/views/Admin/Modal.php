<?php	$this->load->helper('custom_helper');?>
<!-- category modal-->
  <div id="my<?=$page?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add <?=$page?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?=$page.'/Add'.$page?>" enctype="multipart/form-data">
          <div class="modal-body row">                                                                                                                  
                <?php   $filterField=remove_CDT($Fields);
                     //   check_p($filterField);
                        foreach($filterField as $data)
                        {   ?>
                            <div class="form-group col-md-12">
              
                          <?=check_input_field($data)?>
                              </div>    
                      
                <?php   }    ?>
                
                
            </div>
                      <div class="modal-footer">
                        <button type="submit" name="btnsubmit" class="btn btn-default">Submit</button>
                      </div>
        </form>
      </div>
    </div>
  </div>
