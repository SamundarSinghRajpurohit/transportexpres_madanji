<script>
var tblName=<?=$tblName?>;
var ajaxPurchaseInvoiceUrl="<?=site_url('Admin/Ajax/PurchaseInvoiceDifferent/')?>"+tblName;

var ajaxPreInvoiceUrl="<?=site_url('Admin/Ajax/PreInvoiceDifferent/')?>"+tblName;
var ajaxInvoiceUrl="<?=site_url('Admin/Ajax/InvoiceDifferent/')?>"+tblName;
var ajaxPrintBillUrl="<?=site_url('Admin/Ajax/BillDifferent/')?>"+tblName;
var ajaxSalarySlipUrl="<?=site_url('Admin/Ajax/SalarySlipDifferent/')?>"+tblName;
var ajaxEstimateUrl="<?=site_url('Admin/Ajax/EstimateDifferent/')?>"+tblName;

var ajaxUrl="<?=site_url('Admin/Ajax/get_all_data/')?>"+"?tblName="+tblName;
var ajaxStatusUpdateUrl="<?=site_url('Admin/Ajax/update_status/')?>"+tblName;
var ajaxGetSingleUrl="<?=site_url('Admin/Ajax/get_a_data/')?>"+tblName;
var PrintBillUrl="<?=site_url('Admin/BillPrintDifferent/')?>"+tblName;
var ajaxDeleteSingleUrl="<?=site_url('Admin/Ajax/delete_a_data/')?>"+tblName;
var ajaxAddHeading="<?=site_url('Admin/Ajax/add_heading/')?>"+tblName;


// print bill 
/*  $(function(){
      
    $('#example1').on('click','tbody .printbill',function(){
          //  window.location=(PrintBillUrl+"/"+$(this).attr("id"));
                          <?=$ajaxSucessJoinData?>
    
     });
  });*/
 //update data from  datatable
  $(function(){
    $('#example1').on('click','tbody .updatedata',function(){
      //$("#DetailView").find("tr").remove();
         $("#UpdateDetailView").find("tr").remove();
      var TagName="td";
      $.ajax({
                    dataType: "json",
                  
                  url:ajaxGetSingleUrl+"/"+$(this).attr("id")+"/"+TagName,
                  success:function(result)
                  {
                      //alert(result[0]['SalesId']);
                  //    $('#ProductName').val(result[0]['ProductName']);
                    //  $('#example1').DataTable().ajax.reload();
                              
                      
                   //  $("AddFormCard").removeClass("intro");
                     $('#AddFormCard').css("card card-default card-success");
                     $('#AddFormCard').removeClass("collapsed-card");
                     $('#AddFormBody').css("display", "block");
                     //alert(result[1]['AppendString']);
                    //   $("#DetailView").find("tr:gt(0)").remove();
                   
                   
                     //alert(result[1]['AppendString']);
                    $('#UpdateDetailView').append(result[1]['AppendString']);
                        <?= $ajaxSucessData ?>
                  },
            });
            $("html, body").animate({ scrollTop: 0 }, "slow");
     });
  });
 //delete data from  datatable
  $(function(){
    $('#example1').on('click','tbody .deletedata',function(){
        var deleteConfirm = confirm("Do you  want to delete this record");
        if(deleteConfirm==true)
        {
            $.ajax({
                        dataType: "json",
                      url:ajaxDeleteSingleUrl+"/"+$(this).attr("id"),
                      success:function(result)
                      {
                        alert("Data Deleted");
                            // $('#example1').DataTable().ajax.reload(); 
                             window.location.reload();
                      },
              
            });
            
        }
        });
  });

  $(function(){
    $('#example1').on('click','tbody .togglestatus',function(){
      $.ajax({
                   dataType: "json",
                  url:ajaxStatusUpdateUrl+"/"+$(this).attr("id"),
                  success:function(result)
                  {
                     // alert("asd");
                      $('#example1').DataTable().ajax.reload(); 
                  },
            });
     });
  });
  // print Job Card 
  $(function(){
      var flag=0,TagName="notag",empty='',Footer="true";;
    $('#example1').on('click','tbody .PrintJobCard',function(){
       $("#JobCardPrintView").find("tr").remove();
      //add heading
     
      //add data
      $.ajax({
                   dataType: "json",
                  url:ajaxGetSingleUrl+"/"+$(this).attr("id")+"/"+TagName,
                  async: false,
                  success:function(result)
                  {
                    $('#PrintCard').css("card card-default card-warning");
                    $('#PrintCard').removeClass("collapsed-card");
                    $('#PrintBody').css("display", "block");
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.innerHTML =result[2]; 
                    $("#jqueryData").append(script);
              
                     <?=$ajaxSucessJoinData?>
                    $('#JobCardPrintView').append(result[1]['AppendString']);
                    
                  },
            });
      //add footer
      $.ajax({
        url:ajaxAddHeading+'/'+Footer,
    
        async: false,
            success:function(response)
            {
                    $('#BillDetailView').append(response);
                
            },      
       });
       
        //table total 
            var table = document.getElementById("BillDetailView"), sumVal = 0;
                    
                    //alert(table.rows.length);
                    for(var i = 1; i < table.rows[0].cells.length; i++)
                    {
                        sumVal=0;
                        for(var j=1;j< table.rows.length-1;j++)
                        {
                            // alert(table.rows[i].cells[2].innerHTML);
                            //alert(table.rows[i].cells[j].innerHTML);
                            sumVal = sumVal + parseInt(table.rows[j].cells[i].innerHTML);
                        }
                        var TotalIdCounter="total"+(i+1);
                        if(!isNaN(sumVal))
                         document.getElementById(TotalIdCounter).innerHTML = sumVal;
                         $("#"+TotalIdCounter).css({ "font-weight": "bold"});
                    }
                    
                  //  document.getElementById("val").innerHTML = "Sum Value = " + sumVal;
            $("html, body").animate({ scrollTop: 0 }, "slow");
     });
  });
  //print Salary Slip
  $(function(){
      var flag=0,TagName="notag",empty='',Footer="true";;
    $('#example1').on('click','tbody .PrintSlip',function(){
        window.open(ajaxSalarySlipUrl+'/'+($(this).attr("id")));
     });
  });
  
  
  //print purchase invoice
  $(function(){
      var flag=0,TagName="notag",empty='',Footer="true";;
    $('#example1').on('click','tbody .Print',function(){
        window.open(ajaxPurchaseInvoiceUrl+'/'+($(this).attr("id")));
     });
  });
  
  
  //print pre Estimate
  $(function(){
      var flag=0,TagName="notag",empty='',Footer="true";;
    $('#example1').on('click','tbody .PrintEstimate',function(){
        window.open(ajaxEstimateUrl+'/'+($(this).attr("id")));
     });
  });
  
  //print pre Invoice
  $(function(){
      var flag=0,TagName="notag",empty='',Footer="true";;
    $('#example1').on('click','tbody .PrintPreInvoice',function(){
        window.open(ajaxPreInvoiceUrl+'/'+($(this).attr("id")));
     });
  });
  //print Invoice
  $(function(){
      var flag=0,TagName="notag",empty='',Footer="true";;
    $('#example1').on('click','tbody .PrintInvoice',function(){
        window.open(ajaxPrintBillUrl+'/'+($(this).attr("id")));
     });
  });
  
  //print Bill
  $(function(){
      var flag=0,TagName="notag",empty='',Footer="true";;
    $('#example1').on('click','tbody .printbill',function(){
        //alert("asd");
        window.open(ajaxPrintBillUrl+'/'+($(this).attr("id")));
     });
  });
  
  
  //print Bill
  $(function(){
      var flag=0,TagName="notag",empty='',Footer="true";;
    $('#example1').on('click','tbody .PrintEstimate',function(){
        //alert("asd");
        window.open(ajaxPrintBillUrl+'/'+($(this).attr("id")));
     });
  });
  
  
    // print MembershipForm 
  $(function(){
      var flag=0,TagName="notag",empty='',Footer="true";;
    $('#example1').on('click','tbody .PrintForm',function(){
       $("#BillDetailView").find("tr").remove();
      //add data
      $.ajax({
                   dataType: "json",
                  url:ajaxGetSingleUrl+"/"+$(this).attr("id")+"/"+TagName,
                  async: false,
                  success:function(result)
                  {
                    $('#PrintCard').css("card card-default card-warning");
                    $('#PrintCard').removeClass("collapsed-card");
                    $('#PrintBody').css("display", "block");
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.innerHTML =result[2]; 
                    $("#jqueryData").append(script);
                
                    //var test=result[0]['MemberId']
                    //document.getElementById('MemberdetailImageMemberId').innerHTML=test;
                     <?=$ajaxSucessJoinData?>
                    $('#BillDetailView').append(result[1]['AppendString']);
                    
                  },
            });
            $("html, body").animate({ scrollTop: 0 }, "slow");
     });
  });
    // print MembershipCard 
  $(function(){
      var flag=0,TagName="notag",empty='',Footer="true";;
    $('#example1').on('click','tbody .PrintCard',function(){
       $("#BillDetailView").find("tr").remove();
      //add data
      $.ajax({
                   dataType: "json",
                  url:ajaxGetSingleUrl+"/"+$(this).attr("id")+"/"+TagName,
                  async: false,
                  success:function(result)
                  {
                    $('#PrintCard').css("card card-default card-warning");
                    $('#PrintCard').removeClass("collapsed-card");
                    $('#PrintBody').css("display", "block");
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.innerHTML =result[2]; 
                    $("#jqueryData").append(script);
                    //alert(result[0]['MemberdetailCDT']);
                   // if($('#MemberdetailPhoneNo').length)document.getElementById('MemberdetailPhoneNo').innerHTML=result[0]['MemberdetailPhoneNo'];
                    //var test=result[0]['MemberId']
                    //document.getElementById('MemberdetailImageMemberId').innerHTML=test;
                     <?=$ajaxSucessJoinData?>
                    $('#BillDetailView').append(result[1]['AppendString']);
                    
                  },
            });
            $("html, body").animate({ scrollTop: 0 }, "slow");
     });
     
    $('#example1').on('click','tbody .PrintJobCard',function(){
       $("#BillDetailView").find("tr").remove();
     // alert("asd");
      //add data
      $.ajax({
          
                   dataType: "json",
                  url:ajaxGetSingleUrl+"/"+$(this).attr("id")+"/"+TagName,
                  async: false,
                  success:function(result)
                  {
                    $('#PrintCard').css("card card-default card-warning");
                    $('#PrintCard').removeClass("collapsed-card");
                    $('#PrintBody').css("display", "block");
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.innerHTML =result[2]; 
                    $("#jqueryData").append(script);
                 
                     <?=$ajaxSucessJoinData?>
                    $('#BillDetailView').append(result[1]['AppendString']);
                    
                  },
            });
            $("html, body").animate({ scrollTop: 0 }, "slow");
     });
  });
  //print Transaction detail
  $(function(){
      var flag=0,TagName="notag",empty='',Footer="true";;
    $('#example1').on('click','tbody .Print',function(){
       $("#BillDetailView").find("tr").remove();
      //add data
      $.ajax({
                   dataType: "json",
                  url:ajaxGetSingleUrl+"/"+$(this).attr("id")+"/"+TagName,
                  async: false,
                  success:function(result)
                  {
                    $('#PrintCard').css("card card-default card-warning");
                    $('#PrintCard').removeClass("collapsed-card");
                    $('#PrintBody').css("display", "block");
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.innerHTML =result[2]; 
                    $("#jqueryData").append(script);
                
                    //var test=result[0]['MemberId']
                    //document.getElementById('MemberdetailImageMemberId').innerHTML=test;
                     <?=$ajaxSucessJoinData?>
                    $('#BillDetailView').append(result[1]['AppendString']);
                    
                  },
            });
            $("html, body").animate({ scrollTop: 0 }, "slow");
     });
  });
 
var ajaxUrl="<?=site_url('Admin/Ajax/get_all_data/')?>"+"?tblName="+tblName;
  $(function () {
    /* $('#example1 thead tr').clone(true).appendTo( '#example1 thead' );              //1985-52
     $('#example1 thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)  
                    .search( this.value )
                    .draw();
            }
        } );                                                                        //1785-65
    } );*/
    
    $('.table-heading-print').on( 'click', function (e) {                           //1786-66
        e.preventDefault();
 
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );                                                                            //1875-45
    var sumCol=3;                                                                   //1555-23
    var sumCol1=3;
    var table =$('#example1').DataTable({
        /* "footerCallback": function ( row, data, start, end, display ) {        
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( sumCol )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            total1 = api
                .column( sumCol1 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            // Total over this page
            pageTotal = api
                .column( sumCol, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            pageTotal1 = api
                .column( sumCol1, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            //$( api.column( sumCol ).footer() ).html(
              //  'Total here:'+pageTotal +' ( '+ total +' total)'
            //);
            //$( api.column( sumCol1 ).footer() ).html(
             //   'Total here:'+pageTotal1 +' ( '+ total1 +' total)'
            //);
        },*/
        orderCellsTop: true,    // 1024
        fixedHeader: true,      // 1024

        dom: 'lBfrtip',                                                              //1978-1
        buttons: [
            {
                exportOptions: {
                    columns: ':visible'
                },
                footer: true 
                
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                footer: true 
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                footer: true 
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                footer: true 
            },
            
            'colvis'
        ],                                                                          //1874-85
        /* "columnDefs": 
        [{ //   "name": "AdminId",
            "visible": false,
            "targets": 0,
          "searchable": false,
        }] ,*/
      "paging": true,           //1086-1
        "lengthMenu": [10,20, 40, 60, 80, 100,1000,5000],
       "pageLength": 10,
      "lengthChange": true,
     // "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
        "scrollX": true,
        "scrollY": true,        //1086-10
        //"scrollY": "200px",*/
        "ajax":{
            
        url :ajaxUrl,
        dataSrc:"datasource",
        },
        
        aoColumns:
        <?= $aocolumns?>
    });
  });
  $(function(){
    $('#StateID').on('change',function(){
      $.ajax({
        url:"<?=site_url('Category/get_city/')?>"+$(this).val(),
        success:function(result){
          $('#CityID').html(result);
        }
      });
    });
    
  });
  // Setup - add a text input to each footer cell
 
</script>

