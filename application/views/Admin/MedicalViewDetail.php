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
    
    
    <!-- /.modal -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary ">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/768px-User_font_awesome.svg.png"
                       alt="User profile picture">
                </div>
                <tr>
                <b><center><?=$mainData[0]["MedicalstoreName"]?></center></b>
                </tr>                            
                <ul class="list-group list-group-unbordered mb-3">
                  
                  <li class="list-group-item">
                   <b>Total Bonus</b> 
                   <b class="float-right"><?=$bonus[0]["TotalBonus"]?></b>
                  </li>
                  <li class="list-group-item">
                    <b>Total Sales</b>
                    <b class="float-right"><?=$totalsales[0]["Totalsales"]?></b>
                  </li>
                </ul>

                <a href="<?=site_url('/Admin/MedicalDifferent')?>" class="btn btn-block admin-custom-color-g elevation-1"><b>View Detail</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Bonus History</a></li>
                  <!--<li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>-->
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Information</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="user-block">
                          <div class="col-md-12">
                            <div class="float-left col-md-10">
                              <img class="img-circle" src="<?=base_url('/resources/Icons/plus_black.png')?>" alt="User Image">
                              <span class="username">ORDNO-<a href="#"></a><?=$totalsales[0]["OrderId"]?></b></span>
                              <span class="description">Bonus Point -<b><?=$Allorder[0]["BonusPoint"]?></b></span>
                            </div>
                            <div class="float-right col-md-2">
                              <span class="username">₹<?=$totalsales[0]["Totalsales"]?></span>
                            </div>
                          </div>
                          <br>
                          <div class="col-md-12">
                            <div class="float-left col-md-10">
                              <img class="img-circle" src="<?=base_url('/resources/Icons/negative_black.png')?>" alt="User Image">
                              <span class="username">ORDNO-<a href="#"></a><?=$totalsales[0]["OrderId"]?></b></span>
                              <span class="description">Bonus Point -<b><?=$Allorder[0]["BonusPoint"]?></b></span>
                            </div>
                            <div class="float-right col-md-2">
                              <span class="username">₹500</span>
                            </div>
                          </div>
                          
                        </div>
                        <br>
                    </div>
                  <!-- /.tab-pane -->
                  <div>
                    <!-- The timeline -->
                    <div>
                      <!-- timeline time label -->
                      <div>
                          
                      <!--  <span class="bg-danger">
                          Bonus Point
                        </span>
                      --></div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <!--<i class="fas fa-envelope bg-primary"></i>
-->
                        <div>
                          <!--<span><i class="far fa-clock"></i> 12:05</span>-->

                          <!--<h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>-->
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                       <!-- <i class="fas fa-user bg-info"></i>
-->
                        <div>
                       <!--   <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                       --> </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
    <!--                    <i class="fas fa-comments bg-warning"></i>-->

                        <div>
        <!--                  <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
        -->                </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div>
                        <!--<span class="bg-success">
                          3 Jan. 2014
                        </span>-->
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <!--<i class="fas fa-camera bg-purple"></i>
-->
                        <div>
                        <!--  <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                          </div>
                        --></div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <!--<i class="far fa-clock bg-gray"></i>
                     --> </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" id="AddUpdateForm" name="AddUpdateForm" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Medical Name</label>
                        <input type="hidden" name="MedicalstoreId" class="form-control"  value="<?=$mainData[0]["MedicalstoreId"]?>">
                        <div class="col-sm-10">
                         <input type="text" name="MedicalstoreName" class="form-control"  value="<?=$mainData[0]["MedicalstoreName"]?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Propritor Name</label>
                        <div class="col-sm-10">
                         <input type="text" name="MedicalstorePropritorName" class="form-control"  value="<?=$mainData[0]["MedicalstorePropritorName"]?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Phone No</label>
                        <div class="col-sm-10">
                         <input type="text" name="MedicalstorePhoneNo" class="form-control" value="<?=$mainData[0]["MedicalstorePhoneNo"]?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Alternative Phone No</label>
                        <div class="col-sm-10">
                        <input type="text" name="MedicalstoreAlternativePhoneNo" class="form-control"  value="<?=$mainData[0]["MedicalstoreAlternativePhoneNo"]?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">GST NO</label>
                        <div class="col-sm-10">
                        <input type="text" name="MedicalstoreGSTNo" class="form-control"  value="<?=$mainData[0]["MedicalstoreGSTNo"]?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">PAN NO</label>
                        <div class="col-sm-10">
                         <input type="text" name="MedicalstorePANNo" class="form-control"  value="<?=$mainData[0]["MedicalstorePANNo"]?>">
                         </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Proof</label>
                        <div class="col-sm-10">
                             <input type="image" name="MedicalstoreProof" style="height:100px; width:100px" alt="No Proof"  src="<?=base_url('/resources/images/'.$mainData[0]["MedicalstoreProof"])?>">
                            <input type="file" name="MedicalstoreProof" value="<?=$mainData[0]["MedicalstoreProof"]?>">
                         </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Upload Document</label>
                        <div class="col-sm-10">
                            <input type="image" name="MedicalstoreUploadDocument" style="height:100px; width:100px" alt="No Upload"  src="<?=base_url('/resources/images/'.$mainData[0]["MedicalstoreUploadDocument"])?>"> 
                            <input type="file" name="MedicalstoreUploadDocument" value="<?=$mainData[0]["MedicalstoreUploadDocument"]?>">
                         </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Email-ID</label>
                        <div class="col-sm-10">
                          <input type="text" name="MedicalstoreEmailId" class="form-control" value="<?=$mainData[0]["MedicalstoreEmailId"]?>">
                         </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">DrugLisence NO</label>
                        <div class="col-sm-10">
                      <input type="text" name="MedicalstoreDrugLisenceNo" class="form-control" value="<?=$mainData[0]["MedicalstoreDrugLisenceNo"]?>">
                         </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                           <!-- <td class="custom-table-td"><a id="</?=$mainData[0]["MedicalstoreId"]?>" class="updatedata" data-toggle="modal" data-target="#insert-modal" ><i class="fa fa-edit admin-custom-color-opp" ></i></a>-->
                          <button type="submit" name="btnSubmit" id="btnSubmit"  data-target="#insert-modal"  class="btn btn-danger">Update</button>
                             
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  
      <!-- /.modal -->
</div>
            