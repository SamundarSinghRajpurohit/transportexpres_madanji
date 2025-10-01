<script type="text/javascript">
        
/*    $(function(){
    $('#example1').on('click','tbody .togglestatus',function(){
      $.ajax({
      url:"<?=site_url('Admin/Ajax/insert_data/');?>"++$(this).attr("id"),success:function(result){ $('#data_table').DataTable().ajax.reload(); }
      });
      
    });
  });*/

//on page load
    window.onload = function() { 
    var tblName = '<?=$page?>';
    /*if(tblName.localeCompare("customer")==0)
    {   alert("Customer");
        //memberNo=document.getElementById("MemberNo").value;
    }*/
}
function printDiv(divName) {
 //   customCard();
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
//customCard();
function  customCard()
{
  /*  $("#MemberdetailImage").css({'transform':'rotate(270deg)',
    '-o-transform': 'rotate(270deg)',
    '-ms-transform': 'rotate(270deg)',
    '-webkit-transform': 'rotate(270deg)'
});*/
$("#Memberdetail").css({'transform':'rotate(270deg)',
    '-o-transform': 'rotate(270deg)',
    '-ms-transform': 'rotate(270deg)',
    '-webkit-transform': 'rotate(270deg)'
});
  
  $("#Memberdetail").css("margin-top", "30px");
  $("#Memberdetail").css("margin-left", "-80px");
  
/*$("#MemberdetailMemberdetailName").css({'transform':'rotate(270deg)',
    '-o-transform': 'rotate(270deg)',
    '-ms-transform': 'rotate(270deg)',
    '-webkit-transform': 'rotate(270deg)'
});*/
}

function covertDivToImg(divName) {
  html2canvas($('#'+divName), {  
    onrendered: function (canvas) {
        var canvasImg = canvas.toDataURL("image/jpg");
        $('#canvasImg').html('<img src="'+canvasImg+'" alt="">');
    }
});
    
}

 $(function(){
     $('#DownloadExcel').on('click',function(){
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
                        $('#example1').DataTable().ajax.reload();
                        $('#AddUpdateForm')[0].reset();
                        $('#AddFormBody').css("display", "none");
                        
                    
                }   
            
            },
        });
     });
 });
 var table = $('#SidebarTable').DataTable();
 
// #myInput is a <input type="text"> element
$('#myInput').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
    
//add new data of AddUpdateForm
    $('#AddUpdateForm').on('submit',(function(e) {
        e.preventDefault();
        
        var r = confirm("All the Data Inserted/Updated is Perfect");
        if (r == true) 
        {
            var tblName = '<?=$page?>';
            var formData = new FormData(this);
            var DetailArrayString = DetailArray.toString();
            var DetailArrayString2 = DetailArray2.toString();
            formData.append("DetailArray",DetailArrayString);
            formData.append("DetailArray2",DetailArrayString2);
            //alert(DetailArray);  
            var memberNo,memberName,groupId,memberAmount,lastId,memberId;
            if(tblName.localeCompare("member")==0)
            {
                memberNo=document.getElementById("MemberNo").value;
                memberName=document.getElementById("MemberName").value;
                groupId=document.getElementById("GroupId").value;
                memberAmount=document.getElementById("MemberProductPrice").value;
                memberId=document.getElementById("MemberId").value;
            
            }
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
                            
                            $('#example1').DataTable().ajax.reload();
                            $('#AddUpdateForm')[0].reset();
                            $("input[type=hidden]").val('');
                            $('#AddFormBody').css("display", "none");
                            $('#AddFormCard').addClass("collapsed-card");
                           // $("#DetailView").find("tr:gt(0)").remove();
                              $("#DetailView").find("tr").remove();
                              $("#UpdateDetailView").find("tr").remove();
                             // alert("Data Inserted/Update Successfully");
                             DetailArray=[];
                                //customsales();
                                $("html, body").animate({ scrollTop: 0 }, "slow");
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
//add new excel csv  of ImportCSVForm
    $('#CSVForm').on('submit',(function(e) {
        var tblName = '<?=$page?>';
        var formData = new FormData(this);
        
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:"<?=site_url('Admin/Ajax/import_CSV/');?>"+tblName,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
               if(data==1)
                {
                        $('#example1').DataTable().ajax.reload();
                        $('#CSVForm')[0].reset();
                        $('#CSVBody').css("display", "none");
                }  
            },
        });
    }));    
</script>