<div class="content-wrapper" style="min-height: 496px;">
    
    <!-- Content Header (Page header) -->
    <form method="post" name="">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$pageName?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('Admin/Dashbaord')?>">Home</a></li>
              <li class="breadcrumb-item active"><?=$pageName?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    </form>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card" id="AddFormBody">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active " href="#Company" data-toggle="tab">Company</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Setting" data-toggle="tab">Setting</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="Company">
                                <form   class="AddUpdateForm" name="AddUpdateForm" enctype="multipart/form-data">
                                    
                                    <div class="row ">
                                        <?php 
                                        $filterField=remove_CDT($OriginalFields);
                                        //print_r($filterField);
                                            //  $filterField=remove_last_field($filterField,4);
                                            //update code after removing 2 column from last
                                                $filterField=remove_last_field($filterField,1);
                                                //  check_p($filterField);
                                        
                                            ?>
                                            <input type="hidden" name='<?=$filterField[0]?>'  id='<?=$filterField[0]?>'  >
                                        
                                            <?php
                                                $tblkey=ucfirst($page);
                                                    $filterField=remove_first_field($filterField);
                                                foreach($filterField as $data)
                                                {   ?>
                                                        <?= get_input_field($data,$tblkey,'6')?>
                                        <?php   }  
                                        if(checK_table_present('tbl'.$page.'detail'))
                                        {
                                        ?>
                                        
                                        <div class='col-md-12'>
                                            <input type="button" id='add' class=' btn btn-dark col-md-12 ' value="Add" >
                                        </div>
                                        <div style="overflow-x:auto;">
                                            <table id="DetailView" >
                                            </table>
                                            <table id="UpdateDetailView" >
                                                </table>
                                        </div>
                                        
                                        <?php
                                                }
                                            /* get_detail_view($page);*/
                                            ?>
                                        <?php     
                                            if(checK_table_present('tbl'.$page.'detail2'))
                                            {?>
                                        <div class='col-md-12'>
                                            <input type="button" id='add2' class=' btn btn-primary col-md-12 ' value="Add Details" >
                                        </div>
                                        <?php }
                                        ?>
                                    </div>
                                    <div class="modal-footer ">
                                            <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-dark">Submit</button>
                                    </div>
                    
                                </form>
                            </div>
                            <div class="tab-pane" id="Setting">
                                <div class="row ">
                                </div>     
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                    
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
<script>
    var fetchCompanyDetail="<?=base_url('Admin/Ajax/get_company_detail/')?>";
    
    $(document).ready(function(){
        $.ajax({
                    dataType: "json",
                    url:fetchCompanyDetail,
                    success:function(result)
                    {
                        
                         <?= $ajaxSucessData ?>
                    },
        });
    });
    $('.AddUpdateForm').on('submit',(function(e) {
        e.preventDefault();
        
        var r = confirm("All the Data Inserted/Updated is Perfect");
        if (r == true) 
        {
            var tblName ="<?=$tblName?>";
           /* alert(tblName);
            die();*/
            var formData = new FormData(this);
            var DetailArrayString = DetailArray.toString();
            formData.append("DetailArray",DetailArrayString);
            //alert(DetailArray);  
            $.ajax({
                 
                type:'POST',
                url:"<?=site_url('Admin/Ajax/insert_data/');?>"+tblName,
                data:formData,
                cache:false,
                async: false,
                contentType: false,
                processData: false,
                success:function(data){
                   if(data>1)
                    {
                            alert("Data Updates Sucessfully");         
                    }   
                    else
                    {
                        alert("Data  Inserted/Update Un-Successfully");
                    }
                
                },
            });
            
         
        }
    }));  
</script>
  