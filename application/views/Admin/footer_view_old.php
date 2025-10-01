   <footer class="main-footer">
    <!--<strong>Copyright &copy; 2014-2018 <a href="<?=COMPANY_LINK?>"><?=COMPANY_NAME?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
     
    </div>-->
  </footer>
    <script type="text/javascript">
        function updateListing()
        {
                $.ajax({
                    type:'POST',
                    url:"<?=site_url('Admin/Ajax/updateData/');?>",
                    cache:false,
                    async: false,
                    contentType: false,
                    processData: false,
                    //dataSrc:"datasource",
                    success:function(data){
                    finalData=data;
                        alert(finalData.Message);
                    }
                });    
        }
    </script>
  </div>
</body>
</html>