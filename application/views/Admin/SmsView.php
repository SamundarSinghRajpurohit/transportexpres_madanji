<div class="content-wrapper" style="min-height: 496px;">
    
    <!-- Content Header (Page header) -->
    <form method="post" name="">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Advanced Form</h1>
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
        

        <div class="row float-left">
          <div class="col-md-4 ">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">SMS / Notification From</h3>
              </div>
                  <form name="ReportDateForm" method="POST" id="ReportDateForm">
                    <div class="card-body">
                        <div class="form-group">
                          <label>Date From:</label>
        
                          <div class="input-group">
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" name="FromDate" id="FromDate" required>
                                <div class="input-group-addon">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label>Date To:</label>
        
                            <div class="input-group">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" class="form-control" name="ToDate" id="ToDate" required>
                                    <div class="input-group-addon">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label>Report Of:</label>
        
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fa fa-report"></i>
                              </span>
                            </div>
                            <select id="ReportSelect" name="ReportSelect" >
                                <option value="GST">GST</option>
                            </select>
                          </div>
                           
                        </div>
                        <div class="form-group">
                          <button type="submit" name="btnsubmit" class="btn btn-default">Submit</button>
                        </div>   
                          <!-- /.input group -->
                    </div>
                    </div>       
                  </form>
              
                </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Rerport From</h3>
              </div>
                  <form name="ReportDateForm" method="POST" id="ReportDateForm">
                    <div class="card-body">
                        <div class="form-group">
                          <label>Date From:</label>
        
                          <div class="input-group">
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" name="FromDate" id="FromDate" required>
                                <div class="input-group-addon">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label>Date To:</label>
        
                            <div class="input-group">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" class="form-control" name="ToDate" id="ToDate" required>
                                    <div class="input-group-addon">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label>Report Of:</label>
        
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fa fa-report"></i>
                              </span>
                            </div>
                            <select id="ReportSelect" name="ReportSelect" >
                                <option value="GST">GST</option>
                            </select>
                          </div>
                           
                        </div>
                        <div class="form-group">
                          <button type="submit" name="btnsubmit" class="btn btn-default">Submit</button>
                        </div>   
                          <!-- /.input group -->
                    </div>
                    </div>       
                  </form>
              
                </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>