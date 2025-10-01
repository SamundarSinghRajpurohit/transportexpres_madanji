<div class="content-wrapper">
  
    <section class="content">
         <h5 class="mt-4 mb-2">Accouting</h5>
        <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <!--<h3 class="card-title p-3">Transaction in</h3>-->
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab"> <i class="fa fa-rupee  mr-2"></i>Cash Receipt / Payment</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab"><i class="fa fa-bank mr-2"></i>Bank Receipt/Payment</a></li>
                  <!--<li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab"><i class="fa fas fa-columns mr-2"></i>Jouranal</a></li>-->
                <!--  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                      Dropdown <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" tabindex="-1" href="#">Action</a>
                      <a class="dropdown-item" tabindex="-1" href="#">Another action</a>
                      <a class="dropdown-item" tabindex="-1" href="#">Something else here</a>
                      <div class="divider"></div>
                      <a class="dropdown-item" tabindex="-1" href="#">Separated link</a>
                    </div>
                  </li>-->
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <form method="post" enctype="multipart/form-data" id="CashTransactionForm">
                            <div class="modal-body row">
                                    <?php 
                                        $filterField=remove_CDT($OriginalFields);
                                        $filterField=remove_last_field($filterField,2);
                                    ?>
                                    <input type="hidden" name='<?=$filterField[0]?>'  id='<?=$filterField[0]?>'  >
                                    <?php
                                        $tblkey=ucfirst('cashtransaction');
                                        $filterField=remove_first_field($filterField);
                                        foreach($filterField as $data)
                                        {   
                                            echo get_input_field($data,$tblkey,'6');
                                        }  
                                    ?>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="btnsubmit" class="btn btn-dark">Submit</button>
                            </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                       <form method="post"  enctype="multipart/form-data">
                            <div class="modal-body row">
                                <?php 
                                        $bankFilterField=remove_CDT($BankOriginalFields);
                                        $bankFilterField=remove_last_field($bankFilterField,2);
                                    ?>
                                    <input type="hidden" name='<?=$bankFilterField[0]?>'  id='<?=$bankFilterField[0]?>'  >
                                    <?php
                                        $bankTblkey=ucfirst('banktransaction'); 
                                        $bankFilterField=remove_first_field($bankFilterField);
                                        foreach($bankFilterField as $data)
                                        {   
                                            echo get_input_field($data,$bankTblkey,'6');
                                        }  
                                    ?>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="btnsubmit" class="btn btn-dark">Submit</button>
                            </div>
                    </form>
                   
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                     <form method="post"  enctype="multipart/form-data">
                            <div class="modal-body row">
                            <div class="modal-footer">
                                <button type="submit" name="btnsubmit" class="btn btn-dark">Submit</button>
                            </div>
                            </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_4">
                     <form method="post"  enctype="multipart/form-data">
                            <div class="modal-body row">
                                
                                <div class="form-group col-md-6">
                                    <label>Accounts </label>
                                    <input type="text"  class="form-control" placeholder="Enter AccountsName" name="CategoryName" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Amount</label>
                                    <input type="text"  class="form-control" placeholder="Enter Amount" name="CategoryName" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Remarks</label>
                                    <input type="text"  class="form-control" placeholder="Enter Remarks" name="CategoryName" required="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="btnsubmit" class="btn btn-default admin-custom-color-sidebar">Submit</button>
                            </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_5">
                    
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->
       
</section>
</div>
