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
            <div>
                <table id="example2" class="table table-bordered table-hover">
                <thead class="admin-custom-color">
                    <tr>
                      <th>Name</th>
                      <th>Shop Name</th>
                      <th>Email ID</th>
                      <th>GST No</th>
                      <th>Mobile No</th>
                      <th>Action</th>
                      
                    </tr>
                </thead>
                <tbody>
                     <?php
                      //  $OrderData = json_decode(json_encode($OrderData)) ;
                       // echo "<pre>";
                       // print_r($OrderData);
                        for($i=0;$i<count($CustomerData);$i++)
                        {   ?>
                                <tr>
                                    <td><?=$CustomerData[$i]["CustomerName"]?></td>
                                    <td><?=$CustomerData[$i]["CustomerCompanyName"]?></td>
                                    <td><?=$CustomerData[$i]["CustomerEmailId"]?></td>
                                    <td><?=$CustomerData[$i]["CustomerGSTNo"]?></td>
                                    <td><?=$CustomerData[$i]["CustomerPhoneNo"]?></td>
                                    <td><i class="fa fa-edit admin-custom-color-opp" ></i><i class="fa fa-trash admin-custom-color-opp"></i></td>
                                </tr> 
                           <?php 
                        }
                        ?>
                
                </tbody>
                </table>
                
            </div>
        </div>
    </section>
</div>
