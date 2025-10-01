  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Gallery</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?=site_url('Admin//Category/add_Category/');?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Select Category Name</label>
              <select>
                  <option></option>
              </select>
              <input type="text" class="form-control" placeholder="Enter CategoryName" name="CategoryName" required="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="btnsubmit" class="btn btn-default">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>