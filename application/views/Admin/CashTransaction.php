
<section class="content" id="PrintTotalContent">
        <div class="row">
          <div class="col-12">
               <div id="PrintCard" class="card card-default collapsed-card card-warning" >
              <div class="card-header">
                <h3 class="card-title"><?=ucfirst($page)?> Receipt </h3>
                <div class="card-tools" >
                  <button type="button" id="BillBtn"  class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
                 <!-- Main content -->
                <div class="card-body" id="PrintBody" >
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                        <button  class="btn btn-primary" onclick="printDiv('PrintBody')"><i class="fa fa-print" ></i> Print</button>
                        <!--<div class="float-right lead">This is a prinited Bill So  no need of Signature.</div>-->
                        <a href="<?=site_url('/Admin/MemberCardDifferent')?>"> 
                        <button type="button" class="btn btn-success " ><i class="fa fa-file-image-o "></i> Image </button></a>
                  
                    </div>
              </div>
                </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</section>