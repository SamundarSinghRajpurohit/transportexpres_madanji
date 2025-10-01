<script>
var cnt=0;
var tblName = '<?=$page?>';

var key=capitalizeFirstLetter(tblName.replace("tbl",''));
var key_normal=(tblName.replace("tbl",''));

var ajaxAddRow="<?=site_url('Admin/Ajax/add_columns/')?>"+tblName;
var ajaxAddHeading="<?=site_url('Admin/Ajax/add_heading/')?>"+"tbl"+tblName;

var ajaxAddHeadingDetail="<?=site_url('Admin/Ajax/add_heading/')?>"+"tbl"+tblName+"detail2";
var ajaxAddRowDetail="<?=site_url('Admin/Ajax/add_columns/')?>"+tblName+"detail2";

var ProductPrice,ProductQty,SubTotal,HsnTax;
var ajaxGetDataCustom="<?=site_url('Admin/Ajax/get_a_data/')?>";
var ajaxGetLastId="<?=site_url('Admin/Ajax/get_last_id/')?>";

var Box=null,Weight=null,Rate=null;
//custom code
var TypeofmemberShortcode;
var finalMemberNo=null;
var TotalNoOfDaysWork=null,WorkingDays=null,temp,NetSalary=null,Salary=null,SalaryAdvance=null;
//on focus lost ajax event 
$(document).on('blur',".form-control",function(){
    var IdName =$(this).attr("id");
    
    var IdNo = IdName.replace(/^\D+/g, '');
    
   /* if(IdName.includes("EmailId"))
    {
        var EmailId=$(this).val();
        var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if(EmailId.match(mailformat))
        {
          //  alert("Email is valid");    
        }
        else
        {
            alert("Email is Not valid");
        }
        
    }
    if(IdName.includes("PhoneNo"))
    {
        var PhoneNo=$(this).val();
       // alert(PhoneNo);
        var phoneno = /^\d{10}$/;
        if(PhoneNo.match(phoneno))
        {
            //alert("phoneno is valid");    
        }
        else
        {
            alert("Please Enter valid Phone No");
        }
        
    }
    */
    if(IdName.includes("Price"))
    {
        ProductPrice=$(this).val();
        //alert(ValidateEmail);
        
    }
    else  if(IdName.includes("OrderdetailBox"))
    {
        //console.log($(this).val());
        //console.log(Box);
        
        if(Box!=null)
            Box=Number(Box)+parseFloat($(this).val());
        else
            Box=parseFloat($(this).val());
            
            console.log(Box);
        //alert(Box);
    }
    else if(IdName.includes("ReceiptPayment"))
    {
        var Type=$(this).val();
        if(Type.localeCompare("Payment")==0)
        {
            $( "#"+key+"CreditAmount").prop( "disabled", true );
            $( "#"+key+"DebitAmount").prop( "disabled", false );
        
        }
        else
        {
            $( "#"+key+"DebitAmount").prop( "disabled", true );
            $( "#"+key+"CreditAmount").prop( "disabled", false );
            $( "#"+key+"DebitAmount"+IdNo).prop( "disabled", true );
            $( "#"+key+"CreditAmount"+IdNo).prop( "disabled", false );
            
        }
        
    }
     else if(IdName.includes("DrCr"))
    {   
        var Type=$(this).val();
        var perfectKey=IdName.replace("DrCr","");
        perfectKey=perfectKey.replace(/[0-9]/g, '');
        if(Type.localeCompare("Dr")==0)
        { 
            alert(IdName+"CreditAmount"+IdNo);
            $( "#"+key+"CreditAmount").prop( "disabled", true );
            $( "#"+key+"DebitAmount").prop( "disabled", false );
            $( "#"+perfectKey+"CreditAmount"+IdNo).prop( "disabled", true );
            $( "#"+perfectKey+"DebitAmount"+IdNo).prop( "disabled", false );
        }
        else
        {
            $( "#"+key+"DebitAmount").prop( "disabled", true );
            $( "#"+key+"CreditAmount").prop( "disabled", false );
            $( "#"+perfectKey+"DebitAmount"+IdNo).prop( "disabled", true );
            $( "#"+perfectKey+"CreditAmount"+IdNo).prop( "disabled", false );
            
        }
        
    }
    else if(IdName.includes("Qty"))
    {
        ProductQty=$(this).val();
    }
    else if(IdName.includes("MemberNo"))
    {
        finalMemberNo=$(this).val();
    }
    else if(IdName.includes("MemberdetailName"))
    {
        //alert("MemberdetailMembershipNo"+IdNo);
        if (finalMemberNo != null ){
             $("#MemberdetailMembershipNo"+IdNo).val(finalMemberNo);
        } 
    }
    else if(IdName.includes("WorkingDays"))
    {
        WorkingDays=$(this).val();
    }
    else if(IdName.includes("Leave"))
    {
        TotalNoOfDaysWork=(WorkingDays-$(this).val());
        //alert(TotalNoOfDaysWork);
    }
    else if(IdName.includes("SalaryNet"))
    {
        
     
        //$(this).val()=Number(SalaryNet)-Number(SalaryAdvance);
    }
    else if(IdName.includes("EmployeeSalary"))
    {
        Salary=$(this).val();
    }
    else if(IdName.includes("Advance"))
    {
        SalaryAdvance=$(this).val();
           SalaryNet=Number(TotalNoOfDaysWork)*Number(Salary);
        $('#SalaryNet').val(Number(SalaryNet)-Number(SalaryAdvance));
    }
    
    
    /*else if(IdName.includes("MemberdetailMembershipNo"))
    {
        $(this).val(finalMemberNo);
    
    }*/
    //call any ajax only if contains id 
     if(((IdName.includes("EmployeeId"))||(IdName.includes("MonthId"))||(IdName.includes("LabourId")))&&(!IdName.includes("EmailId"))&&$(this).val())
    {
        //alert()
        var TextBoxValue=$(this).val();
        var pos=TextBoxValue.indexOf("-");
        var Id=TextBoxValue.substring(0, pos);
        //alert(IdName);
        var MainIdName=IdName.replace(/[0-9]/g,'');
        var CustomTblKeyName=MainIdName.replace("Id",'');
        var CustomTblName="tbl"+CustomTblKeyName;
        CustomTblName=CustomTblName.toLowerCase();
        var TagName="td";
        //alert(CustomTblName);
        //ProductPrice=$(this).val();

                $.ajax({
                    url:ajaxGetDataCustom+CustomTblName+'/'+Id+'/'+TagName+'/'+key+'/'+IdNo,
                    dataType:"json",
                      async: false,
                    success:function(result)
                    {  
                        test(result);
                        var data=result[2];
                        //alert(result[0]['SupplierPhoneNo']);
                      //  $('#PurchaseOrderno').val('qweeqww');
                       // var test=$('#PurchaseSupplierPhoneNo').val(result[0]['SupplierPhoneNo']);
                    //    var alertTesting="$('#PurchaseSupplierPhoneNo').val("+result[0]['SupplierPhoneNo']+")";
                        var script = document.createElement('script');
                        script.type = 'text/javascript';
                        script.innerHTML =data; 
                        $("#jqueryData").append(script);
                        if(result[0]['TypeofmemberShortcode'])
                        {
                            TypeofmemberShortcode=result[0]['TypeofmemberShortcode'];
                         //alert(result[0]['TypeofmemberShortcode']);
                            
                        }
                       // if(TypeofmemberShortcode)
                      //  alert(abc);
                        //$('#'+FillIdName).val(result[0]['EmployeeSalary']);          
                        //$('#TaskEmployeesalary').val(result[0]['EmployeeSalary']);
                        
                    }      
                });
        
        //custom code start for aarya
        if(IdName.includes("TypeofmemberId"))
        {
            $.ajax({
                    url:ajaxGetLastId+tblName+'/'+CustomTblName+'/'+Id+'/'+key+'/'+IdNo,
                    dataType:"json",
                      async: false,
                    success:function(result)
                    {  
                       /* var data=result[2];
                        var script = document.createElement('script');
                        script.type = 'text/javascript';
                        script.innerHTML =data; 
                        $("#jq  ueryData").append(script);*/
                        result=+result + +1;
                        membershipNo=appendZero(result,5);
                        //alert(membershipNo);
                        $('#MemberNo').val('');
                        finalMemberNo=TypeofmemberShortcode+'/'+membershipNo;
                        $('#MemberNo').val(finalMemberNo);
                        
                      //  alert(abc);
                        //$('#'+FillIdName).val(result[0]['EmployeeSalary']);          
                        //$('#TaskEmployeesalary').val(result[0]['EmployeeSalary']);
                        
                    }      
                });
        }
        //custom code end for aarya
    }
    //custom code
});
/*$(document).on('keyup',".form-control",function(){
 var IdName =$(this).attr("id");
    if(IdName.includes("OrderdetailBox"))
    {
        //console.log($(this).val());
        //console.log(Box);
        
        if(Box!=null)
            Box=Number(Box)-parseFloat($(this).val());
            console.log(Box);
        //alert(Box);
    }
     
});*/

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}


$(document).ready(function(){
    //kd unnecssary added heading
    /*
    $.ajax({
        url:ajaxAddHeading,
            success:function(response)
            { 
                $('#DetailView').append(response);
                flag=1;
            },      
            
    
    });*/
   /* $.ajax({
        url:ajaxAddHeadingDetail,
            success:function(response)
            { 
                $('#DetailView2').append(response);
                flag=1;
            },      
            
    
    });
   */ 
//custom  code  end
  $("#AddBtn").click(function(){
    alert("call");
    $.ajax({
        url:"<?=site_url('Admin/Ajax/get_data/')?>"+tblName+'/'+cnt,
        dataType:"json",
         success:function(response)
             {  
                 for(test in response["tblcategory"])
                 { 
                 //alert(response["tblcategory"][test].CategoryName);
                  }// $('#StateName').append('<option value="'+response['tblstate']['StateName']+'"></option>');
            
             }      
        });
       
      });
    
});
var tableRowName="tableRow";
function Remove(str)
{
    var id = str.substr(str.length-1,str.length);
    $('#'+tableRowName+id).remove();
    //alert(id);
    DetailArray=removeArray(DetailArray,id);
    
/*    #(0el).remove();*/
}


var i=1;
var DetailArray = [];
var temp;
var flag=0;
$('#add').click(function(){
    i++;
    DetailArray.push(i);
     $.ajax({
        url:ajaxAddRow+'/'+i,
        /*dataType:"json",*/
            success:function(response)
            { 
                //temp="tableRow"+i;
                //alert(temp);
                if(flag==0)
                {
                    setInterval
                }
                $('#DetailView').append(response); 
              //custom  code  aarya start 
              
              // $( "#MemberdetailMembershipNo"+i ).prop( "disabled", true ); 
              //end
            },      
        });
});
var j=1;
var DetailArray2 = [];
var temp2;
$('#add2').click(function(){
    i++;
    DetailArray2.push(i);
     $.ajax({
        url:ajaxAddRowDetail+'/'+i+'/MembershipNo',
        /*dataType:"json",*/
            success:function(response)
            { 
                //temp="tableRow"+i;
                //alert(temp);
                if(flag==0)
                {
                    setInterval
                }
                $('#DetailView2').append(response); 
              //custom  code  aarya start 
              
              // $( "#MemberdetailMembershipNo"+i ).prop( "disabled", true ); 
              //end
            },      
        });
});

$(document).on('focus',".form-control",function(){
    var IdName=$(this).attr("id");
    var IdNo = IdName[IdName.length -1];
    if(IdName.includes("SubTotal"))
    {   //alert(ProductQty);
        if((ProductPrice && ProductQty))
            $(this).val(parseFloat(ProductPrice)*parseFloat(ProductQty));
            SubTotal=parseFloat(ProductPrice)*parseFloat(ProductQty);
            
    }
   
    else if(IdName.includes("HsnTax"))
    {
        HsnTax=$(this).val();
        //alert(ProductPrice);
    }
    else if(IdName.includes("CGST")||IdName.includes("SGST"))
    {   //alert(ProductQty);
        if((SubTotal && HsnTax))
            $(this).val(parseFloat(SubTotal)*parseFloat(HsnTax/200.0));
    }
    else if(IdName.includes("IGST"))
    {   //alert(ProductQty);
        if((SubTotal && HsnTax))
            $(this).val(parseFloat(SubTotal)*parseFloat(HsnTax/100.0));
    }
    else if(IdName.includes("Total"))
    {
           if((SubTotal && HsnTax))
            $(this).val(parseFloat(SubTotal)+parseFloat(SubTotal)*parseFloat(HsnTax/100.0));
    }
    
});
function removeArray(array,no) {
  var n =array.indexOf(parseInt(no))+parseInt(1); 
  //alert(n);
  var arr1 = array.slice(0, n-1);
  var arr2 = array.slice(n, array.length);
  var finalArray = arr1.concat(arr2);
  return finalArray;
  //document.getElementById("demo").innerHTML = finalArray;
}
//$(this).remove();
</script>