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
                <h3 class="card-title">Latest Orders</h3>

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
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Order Date</th>
                      <th>CustomerName</th>
                      <th>Status</th>
                      <th>Total Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                      //  $OrderData = json_decode(json_encode($OrderData)) ;
                        echo "<pre>";
                        print_r($OrderData);
                        for($i=0;$i<count($OrderData);$i++)
                        {   ?>
                                <tr>
                                    <td><?=$OrderData[$i]["OrderId"]?></td>
                                    <td><?=$OrderData[$i]["OrderDate"]?></td>
                                    <td><?=$OrderData[$i]["CustomerName"]?></td>
                                    <td><?php
                                        $className='';
                                        if(strcmp($OrderData[$i]["OrderStageDropDown"],"Cancel")==0)
                                            $className="badge-danger";
                                        else if(strcmp($OrderData[$i]["OrderStageDropDown"],"Processing")==0)
                                            $className="badge-info";
                                        else if(strcmp($OrderData[$i]["OrderStageDropDown"],"Delivered")==0)
                                            $className="badge-success";
                                        else if(strcmp($OrderData[$i]["OrderStageDropDown"],"other")==0)
                                            $className="badge-warning";
                                        
                                        ?>
                                        <span class="badge <?=$className?>"><?=$OrderData[$i]["OrderStageDropDown"]?></span>
                                    </td>
                                    <td><?=$OrderData[$i]["OrderTotal"]?></td>
                                </tr> 
                           <?php 
                        }
                        ?>
                
                    </tbody>
                  </table>
                </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>
        </div>
        
    </section>
    <!-- /.content -->
  </div>
 