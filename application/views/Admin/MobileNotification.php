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
            <div class="row">
            <div class="card card-widget widget-user col-md-4">
                    <div class="modal-body">
                <form   id="MobileNotification" name="MobileNotification" enctype="multipart/form-data">
                    <div class="card-body">  
                        <div class="row ">
                        <input type="hidden" name='NotificationId'  id='NotificationId'  >
                        
                        <div class=" form-group col-md-12"   >
                        <label class=" col-md-12"  > Notification Title</label> 
                        <input type="text" class="form-control col-md-12" name="NotificationTitle"  placeholder ="Enter NotificationTitle" id="NotificationTitle"  value=""></div>                                                                               
                        
                        <div class="col-md-12 form-group">
                            <label class="col-md-12" > Notification Image</label> 
                            <input type="file" class="form-control col-md-12" name="NotificationImage"  placeholder ="Enter NotificationImage" id=NotificationImage >
                            <input type="hidden" class="form-control col-md-12" name="NotificationImageName"  id="NotificationImageName" >                                                                               
                        </div>    
                        <div class=" form-group col-md-12"  >
                            <label class=" col-md-12"  > Notification Message</label> 
                            <input type="text" class="form-control col-md-12" name="NotificationMessage"  placeholder ="Enter NotificationMessage" id="NotificationMessage"  value="">
                        </div>  
                        <div class=" form-group col-md-12">
                            <label class=" col-md-6" >SMS</label>
                            <input type="checkbox"  name="NotificationType[]" id="NotificationType[]" value="SMS">
                            
                            <label class=" col-md-6" >Notification</label>
                            <input type="checkbox"  name="NotificationType[]" id="NotificationType[]" value="Notification">
                        </div>
                    <div class="modal-footer ">
                        <button type="submit" name="btnSubmit" id="btnSubmit" class="btn admin-custom-color">Submit</button>
                           
                        </div>
                     </div> 
                </form>
              </div>
            </div>
        </div>
            <!--div class=" col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">listData</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" style="margin-top:20px;">
                            <table class="mydab table table-bordered bordered table-striped table-condensed" datatable="ng" dt-options="vm.dtOptions">
                                <thead>
                                    <tr>
                                        <th width="15%"><input type="checkbox" ng-model="checkall"
                                                ng-click="ToogleCheck()"> Check all</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div-->
            </div>
        </div>

    </section>
</div>
            
                <div class="widget-user-image admin-custom-table-pos" >
                    <div class="row">
                        <div class="col-md-2">
                            
                        </div>
                        <div class="col-md-2">
                            
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
            
          </div>
          <!-- /.modal-content -->
        </div>
        
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
</div>