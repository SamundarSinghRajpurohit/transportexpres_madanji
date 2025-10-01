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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title"><b>All Notitification</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0" style="text-align:left;">
                    <thead>
                        <tr>
                            <th> All Notification</th>
                            <th> Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                      //  $OrderData = json_decode(json_encode($OrderData)) ;
                       // echo "<pre>";
                       // print_r($OrderData);
                        for($i=0;$i<count($NotificationData);$i++)
                        {   ?>
                                <tr>
                                    <td><?=$NotificationData[$i]["InformationDesc"]?></td>
                                    <td><a href="<?=site_url('/Admin/OrderDifferent')?>" >View</a></td>
                                </tr> 
                           <?php 
                        }
                        ?>
                
                    </tbody>
                  </table>
                </div>
              <!-- /.card-body -->
              
              
              <!-- /.card-footer -->
            </div>
        </div>
        
    </section>
    <!-- /.content -->
  </div>
 