<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>


<style>

table.datatable
{
    width:50% !important;
}
</style>
<script type="text/javascript">
    var tblName="<?=$tableName?>";
    var ajaxGetSingleUrl="<?=site_url('Admin/Ajax/get_a_data/')?>"+tblName;     
    var ajaxDeleteSingleUrl="<?=site_url('Admin/Ajax/delete_a_data/')?>"+tblName;

    // sjr add for report datatable 17-10-2023
    $('#reports').DataTable({
      "paging": true,
      'dom': 'Bfrtip',
      'buttons': [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "scrollX": true,
      //"scrollY": true,
      "responsive": true,
    });
    // sjr end  
  
    $('#example2').DataTable({
      "paging": true,
      'dom': 'Bfrtip',
      'buttons': [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "scrollX": true,
      //"scrollY": true,
      "responsive": true,
    });
 //samundar add 26-02-20
  var formData; 
    var finalData;
    $('#SearchForm').on('submit',(function(e) {
        
        e.preventDefault();
            var tblName = 'tblaccounts';
            formData = new FormData(this);
           // test();
                $.ajax({
                    type:'POST',
                    url:"<?=site_url('Admin/Ajax/get_accounts_data/');?>"+tblName,
                    data:formData,
                    cache:false,
                    async: false,
                    contentType: false,
                    processData: false,
                    //dataSrc:"datasource",
                    success:function(data){
                    finalData=data;
                    $('#OriginalFormat').find("tr:gt(0)").remove();
                     $('#OriginalFormat').append(data);
                    }
                });    
    }));
    $('#BankLedgerForm').on('submit',(function(e) {
        e.preventDefault();
            var tblName = 'tblbanktransaction';
            formData = new FormData(this);
           // test();
                $.ajax({
                    type:'POST',
                    url:"<?=site_url('Admin/Ajax/get_bank_data/');?>"+tblName,
                    data:formData,
                    cache:false,
                    async: false,
                    contentType: false,
                    processData: false,
                    //dataSrc:"datasource",
                    success:function(data){
                    finalData=data;
                    $('#OriginalFormat').find("tr:gt(0)").remove();
                     $('#OriginalFormat').append(data);
                    }
                });    
    }));
    $('#CashLedgerForm').on('submit',(function(e) {
        e.preventDefault();
            var tblName = 'tblcashtransaction';
            formData = new FormData(this);
           // test();
                $.ajax({
                    type:'POST',
                    url:"<?=site_url('Admin/Ajax/get_cash_data/');?>"+tblName,
                    data:formData,
                    cache:false,
                    async: false,
                    contentType: false,
                    processData: false,
                    //dataSrc:"datasource",
                    success:function(data){
                    finalData=data;
                    $('#OriginalFormat').find("tr:gt(0)").remove();
                     $('#OriginalFormat').append(data);
                    }
                });    
    }));
 //samundar end
//nilesh
 $('#MobileNotification').on('submit',(function(e) {
        e.preventDefault();
        
        var r = confirm("All the Data Inserted/Updated is Perfect");
        if (r == true) 
        {
            var tblName ="<?=$tblName?>";
           // alert("Data  Inserted/Update Successfully");
            var formData = new FormData(this);
            $.ajax({
                 
                type:'POST',
                url:"<?=site_url('Admin/Ajax/Push_Firebase_Notification_API/');?>"+tblName,
                data:formData,
                cache:false,
                async: false,
                contentType: false,
                processData: false,
                success:function(data){
                   if(data>1)
                    {
                            
                            $('#MobileNotification')[0].reset();
                            alert("Data  Inserted/Update Successfully");
                    
                    }   
                    else
                    {
                        alert("Data  Inserted/Update Un-Successfully");
                    }
                
                },
            });
            //custom  code
            //code for direct entry
            //var tempTblName=capitalizeFirstLetter(tblName);
            if(tblName.localeCompare("member")==0)
            {
                if(memberId)
                {
                }
                else
                {
                    var data = memberName+' - '+memberNo;
                    var AccountsId;
                    formData.append('AccountsName',data);
                    formData.append('GroupId',groupId);
                    $.ajax({
                        type:'POST',
                        url:"<?=site_url('Admin/Ajax/Push_Firebase_Notification_API/');?>"+"accounts",
                        data:formData,
                        cache:false,
                        async: false,
                        contentType: false,
                        processData: false,
                        success:function(data){
                           if(data>0)
                            {       
                                alert("Accounts Data Inserted/Update Successfully");
                                AccountsId=data;
                              //  alert(AccountsId);
                            }   
                            else
                            {
                                alert("AccountsData  Inserted/Update Un-Successfully");
                            }
                        
                            },
                    });
                    //var formData2 = new FormData();
                    formData.append('AccountsId',AccountsId);
                    formData.append('GroupId',groupId);
                    $.ajax({
                        type:'POST',
                        url:"<?=site_url('Admin/Ajax/Push_Firebase_Notification_API/');?>",
                        data:formData,
                        cache:false,
                        async: false,
                        contentType: false,
                        processData: false,
                        success:function(data){
                           if(data>0)
                            {       
                                alert("Sales Data Inserted/Update Successfully");
                                AccountsId=data;
                            }   
                            else
                            {
                                alert("AccountsData  Inserted/Update Un-Successfully");
                            }
                        
                            },
                    });
               
                    
                }
                
            }
         
        }
    }));
   
//end
//add new data of AddUpdateForm
    $('#AddUpdateForm').on('submit',(function(e) {
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
                   if(data)
                    {
                            
                            $('#example1').DataTable().ajax.reload();
                            $('#AddUpdateForm')[0].reset();
                            $("input[type=hidden]").val('');
                            //$('#AddFormBody').css("display", "none");
                            //$('#AddFormCard').addClass("collapsed-card");
                           // $("#DetailView").find("tr:gt(0)").remove();
                              $("#DetailView").find("tr").remove();
                              $("#UpdateDetailView").find("tr").remove();
                             // alert("Data Inserted/Update Successfully");
                             DetailArray=[];
                                //customsales();
                                $("html, body").animate({ scrollTop: 0 }, "slow");
                                //$('#insert-modal').modal('hide');             //nilesh 8/2/2021
                                //$('#example2').DataTable().reload();                //
                                window.location.reload();                            //window added
                    }   
                    else
                    {
                        alert("Data  Inserted/Update Un-Successfully");
                    }
                
                },
            });
            //custom  code
            //code for direct entry
            //var tempTblName=capitalizeFirstLetter(tblName);
            if(tblName.localeCompare("member")==0)
            {
                if(memberId)
                {
                }
                else
                {
                    var data = memberName+' - '+memberNo;
                    var AccountsId;
                    formData.append('AccountsName',data);
                    formData.append('GroupId',groupId);
                    $.ajax({
                        type:'POST',
                        url:"<?=site_url('Admin/Ajax/insert_data/');?>"+"accounts",
                        data:formData,
                        cache:false,
                        async: false,
                        contentType: false,
                        processData: false,
                        success:function(data){
                           if(data>0)
                            {       
                                alert("Accounts Data Inserted/Update Successfully");
                                AccountsId=data;
                              //  alert(AccountsId);
                            }   
                            else
                            {
                                alert("AccountsData  Inserted/Update Un-Successfully");
                            }
                        
                            },
                    });
                    //var formData2 = new FormData();
                    formData.append('AccountsId',AccountsId);
                    formData.append('GroupId',groupId);
                    $.ajax({
                        type:'POST',
                        url:"<?=site_url('Admin/Ajax/insert_data/');?>"+"sales",
                        data:formData,
                        cache:false,
                        async: false,
                        contentType: false,
                        processData: false,
                        success:function(data){
                           if(data>0)
                            {       
                                alert("Sales Data Inserted/Update Successfully");
                                AccountsId=data;
                            }   
                            else
                            {
                                alert("AccountsData  Inserted/Update Un-Successfully");
                            }
                        
                            },
                    });
               
                    
                }
                
            }
         
        }
    }));
    
   
    //samundar
    $(function(){
        $('#example2').on('click','tbody .updatedata',function(){
      //$("#DetailView").find("tr").remove();
         $("#UpdateDetailView").find("tr").remove();
      var TagName="td";
      $.ajax({
                    dataType: "json",
                  
                  url:ajaxGetSingleUrl+"/"+$(this).attr("id")+"/"+TagName,
                  success:function(result)
                  {
                     $('#AddFormCard').css("card card-default card-success");
                     $('#AddFormCard').removeClass("collapsed-card");
                     $('#AddFormBody').css("display", "block");
                   
                     //alert(result[1]['AppendString']);
                    $('#UpdateDetailView').append(result[1]['AppendString']);
                         <?= $ajaxSucessData ?>
                         },
            });
            $("html, body").animate({ scrollTop: 0 }, "slow");
     });
     
        $('#example2').on('click','tbody .deletedata',function(){
            var deleteConfirm = confirm("Do you  want to delete this record");
            if(deleteConfirm==true)
            {
                $.ajax({
                        dataType: "json",
                        url:ajaxDeleteSingleUrl+"/"+$(this).attr("id"),
                        success:function(result)
                        {
                            alert("Data Deleted");
                            window.location.reload();
                        },
                  
                });
                
            }
        });
    });
    
    $(document).ready(function() {
    
        $('#smstable').DataTable( {
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0
            } ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },
            order: [[ 1, 'asc' ]]
        } );
    });
    
      $(function(){
    $('#example2').on('click','tbody .updatedata',function(){
        $('#insert-modal').modal();
       // $('#insert-modal').modal('show');
                var TagName="td";
                $.ajax({
                            dataType: "json",
                            url:ajaxGetSingleUrl+"/"+$(this).attr("id")+"/"+TagName,
                            success:function(result)
                            {
                                $('#AddFormCard').css("card card-default card-success");
                                $('#AddFormCard').removeClass("collapsed-card");
                                $('#AddFormBody').css("display", "block");
                                $('#UpdateDetailView').append(result[1]['AppendString']);
                                $('#CategoryId').val(result[0]['CategoryId']);$('#CategoryName').val(result[0]['CategoryName']);$('#CategoryImageName').val(result[0]['CategoryImage']);$('#CategoryStatus').val(result[0]['CategoryStatus']);$('#CategoryCDT').val(result[0]['CategoryCDT']);
                            },
                        });
                
            });
  });
</script>