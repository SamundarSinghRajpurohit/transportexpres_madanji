
<section class="content" id="PrintTotalContent">
        <div class="row">
          <div class="col-12">
               <div id="PrintCard" class="card card-default collapsed-card card-warning" >
              <div class="card-header">
                <h3 class="card-title"><?=ucfirst($page)?> Form </h3>
                <div class="card-tools" >
                  <button type="button" id="BillBtn"  class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
                 <!-- Main content -->
                 <div class="card-body" id="PrintBody" >
                    <table id="Memberdetail" class="member-card-table" text-align="right" style="bottom: 0;">  
                        <tr>    
                            <td>
                                &nbsp;
                            </td>
                            <td rowspan="8">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
                            </td>
                            <td rowspan="8">&nbsp;
                                     <img id="MemberdetailImage" class="member-card-image pull-right " >
                            </td>
                        </tr>
                        <tr>    
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>    
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>    
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>    
                            <td>
                                &nbsp;
                            </td>
                        </tr><tr>    
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                           
                            <td>
                                <span id="MemberdetailMemberdetailName"  class="member-card-text  ">Name</span>
                            </td>
                            
                        </tr>
                        
                        <tr>
                            <td>
                                
                                <span id="MemberdetailMemberdetailMembershipNo" class="member-card-text ">Phone NO</span>
                    
                            </td>
                        </tr>
                        
                         
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                                <div class="col-md-1 pull-left">
                                </div>
                                 <div class="col-md-4 pull-left">
                                        <!--img-->
                                </div>
                                <div class="col-md-7 pull-left">
                                 
                                </div>
                                
                                
                                
                                
                               
                        </div>
                        
                    </div>
                    <div  class="member-card-detail-space" >
                        
                    </div>
                    <div class="row " id="MemberCardDetail">
                        <div class="col-md-1 pull-left">
                        </div>
                        <div class="col-md-2 pull-left" >
                                    </div>
                    </div>
                     <!-- this row will not appear when printing -->
                    <div class="row no-print">
                <div class="col-12">
                  <button  class="btn btn-primary" onclick="printDiv('PrintBody')"><i class="fa fa-print" ></i> Print</button>
                    <!--<div class="float-right lead">This is a prinited Bill So  no need of Signature.</div>-->
                  <a href="<?=site_url('/Admin/MemberCardDifferent')?>"> 
                  <button type="button" class="btn btn-success " ><i class="fa fa-file-image-o "></i> Image 
                  </button>
                  </a>
                  <!--
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                  </button>-->
                </div>
              </div>
            
                </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</section>