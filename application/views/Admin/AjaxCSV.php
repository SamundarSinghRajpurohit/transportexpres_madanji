<script type="text/javascript">
  
$(function(){
     $('#ExportCSV').on('click',function(){
      
        var tblName = '<?=$page?>';
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url:"<?=site_url('Admin/Dashboard/CreateExcel/');?>"+tblName,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
               if(data==1)
                {
                        $('#ImportCSVBody').css("display", "none");
                }   
            
            },
        });
     });
 });
</script>