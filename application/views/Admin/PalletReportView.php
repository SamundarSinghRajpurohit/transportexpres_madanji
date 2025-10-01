<div class="content-wrapper" style="min-height: 496px;">
    
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pallet Report</h1>
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
          <div class="col-md-6">
            <div class="card ">
              <div class="card-header admin-custom-color-g">
                <h3 class="card-title">Pallet Rerport From</h3>
              </div>
              <form name="DealerReport" method="POST" action="<?=base_url('/Admin/PalletReportDifferent')?>"autocomplete="off" autocomplete="off">
                <div class="card-body">
                    <div class="form-group">
                      <label>Invoice No/Gst Invoice No.</label>
    
                      <div class="input-group">
                        <div class="input-group ">
                            <input type="text" class="form-control" autocomplete="false" name="InvoiceNo"  id="InvoiceNo">
                            <div class="input-group-addon">
                            </div>
                        </div>
                      <!-- /.input group -->
                    </div>
                    <div class="form-group">
                      <label>Invoice Date</label>
    
                      <div class="input-group">
                        <div class="input-group date">
                            <input type="date" class="form-control" name="invoiceDate" id="invoiceDate" required>
                            <div class="input-group-addon">
                            </div>
                        </div>
                      <!-- /.input group -->
                    </div>
                    
                    <!--samundar add for set option single or all 08-08-2021 -->
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="single" checked>
                      <label class="form-check-label" for="exampleRadios1">
                        Single
                      </label>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="all">
                      <label class="form-check-label" for="exampleRadios2">
                        All
                      </label>
                     </div>
                    <!--samundar end-->
                    
                    <div class="form-group">
                      <label>Dealer</label>
                        <input type="text" class="form-control box all" name="DealerAll" id="DealerAll" Value="All" readonly>
                      <div class="input-group">
                        <div class="input-group ">
                            <input type="text" class="form-control datalist dealerlist box single" autocomplete="false" list="dealerlist" name="DealerId"  id="DealerId" >
                            <datalist id="dealerlist">
                            </datalist>
                            <div class="input-group-addon">
                            </div>
                        </div>
                      <!-- /.input group -->
                    </div>
                    <!-- Date range -->
                    <div class="form-group">
                      <label>Date From:</label>
    
                      <div class="input-group">
                        <div class="input-group date">
                            <input type="date" class="form-control" name="FromDate" id="FromDate" required>
                            <div class="input-group-addon">
                            </div>
                        </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                      <label>Date To:</label>
    
                        <div class="input-group">
                            <div class="input-group date">
                                <input type="date" class="form-control" name="ToDate" id="ToDate" required>
                                <div class="input-group-addon">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" name="btnsubmit" class="btn btn-default">Submit</button>
                    </div>   
                      <!-- /.input group -->
                </div>
                <!-- /.card-body -->
                
              </form>
              
            </div>
            <!-- /.card -->

           
            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script>
$(document).ready(function(){
    $(".box").hide();
    $( ".datalist" ).focus(function() {
        var name=$(this).attr('name');
        name = name.replace("Id", "");
        name= name.toLowerCase();
        $('#'+name+'list').empty();
        //alert(name);

        var tblname=name;
        var searchValue=$(this).val();
        $.ajax({ 
            type: "POST",
            dataType: "html",
            url: "<?=base_url('Admin/Ajax/searchOnKeyPress/')?>"+tblname,
            context: document.body,
            success: function(response){
                var data=JSON.parse(response);
                $('#'+name+'list').empty();
        
                for (var i = 0; i < data.length; i++) {
                    //alert("<option data-id='2' value=\"" + data[i] + "\">" + data[i] + "</option>");
                    $('#'+name+'list').append("<option data-id='2' value=\"" + data[i] + " \">" + data[i] + " </option>");
                }
              
        }});
        
    });
});

$(document).ready(function(){
    $(".single").show();
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});
 </script>