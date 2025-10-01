
<section class="content">
  <div class="row">
    <div class="col-md-12"> 
            <div id="ImportCSVForm" class="card card-default collapsed-card card-primary" >
              <div class="card-header">
                <h3 class="card-title">Bulk Import/Export <?=ucfirst($page)?></h3>
                <div class="card-tools" >
                  <button type="button" id="AddBtn"  class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="CSVBody">
                <form   id="CSVForm" enctype="multipart/form-data">
                  <div class="card-body">  
                        <div class="row ">
                           <!-- <div class="col-md-4 form-group">
                                <label class="col-md-6" >Export CSV</label>
                                   <a href="<?=site_url('/Admin/CreateCSVDemoDifferent/').$page?>"><button  type="button" name="ExportCSV" id="ExportCSV" class="btn btn-primary col-md-12">Download <?=$page?> CSV</button></a>
                            </div>-->
                            <div class="col-md-6 form-group">
                                <label class="col-md-6" >Export Demo CSV</label>
                                <a href="<?=site_url('/Admin/CreateCSVDemoDifferent/').$page?>"  > <button  type="button" name="ExportDemoCSV" id="ExportDemoCSV" class="btn btn-primary col-md-12">Download Demo <?=$page?> CSV</button></a>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="col-md-6" >Import CSV</label>
                                <input type="file" class="form-control col-md-12" name="ImportCSV"   id='ImportCSV' >
                            </div>
                        </div>
                      <div class="modal-footer ">
                            <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary">Submit</button>
                      </div>
                     </div> 
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          </div>
</section>
