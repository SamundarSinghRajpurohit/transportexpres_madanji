<script>
 $(document).ready( function() {
    //DUE DATE CODE START
    /*
    var date=$('#BillSalesDate').html();
    var mydate = new Date(date);
    var fulldate=addDays(mydate,7);
    
    var duemonth = fulldate.getMonth()+1;
    var dueday = fulldate.getDate();
    var dueyear=fulldate.getFullYear()
    var duedateoutput =  dueday+'/'+  duemonth +  '/' +dueyear;
    $('#AmountDueDate').html(duedateoutput);
    
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var output =   month + '/' + day+ '/' +d.getFullYear();
    $('#SalesDate').val(output);
   
    */
    //CONVERT AMT IN WORDS
    /*
    var test=$('#BillSalesTotal').html();
    test=convertNumberToWords(test);
    $('#AmountInWords').html(test);
    */
    
       //GST CODE
       if(GstNo)
       {
            GstNo=GstNo.substr(0,2);
            
            if(GstNo=="24")
            {  //in gujrat
                
                $('#SalesCGST').show();  
                $('#LabelSalesCGST').show();
                $('#SalesSGST').show();  
                $('#LabelSalesSGST').show();
                $('#SalesIGST').hide();  
                $('#LabelSalesIGST').hide();
                var newtax=(tax/2).toFixed(2);
                var CGST=newtax*parseFloat(SPC);
                var SGST=newtax*parseFloat(SPC);
                $('#SalesCGST').val(((Math.round(CGST))/100).toFixed(2));  
                $('#SalesSGST').val(((Math.round(SGST))/100).toFixed(2));  
                $('#SalesIGST').val(0);
                
            }
            else
            {   // not in gujarat
                $('#SalesIGST').show();  
                $('#LabelSalesIGST').show();
                $('#SalesCGST').hide();  
                $('#LabelSalesCGST').hide();
                $('#SalesSGST').hide();  
                $('#LabelSalesSGST').hide();
                $('#SalesCGST').val(0);
                $('#SalesSGST').val(0);
                //alert(tax);
                var IGST=tax*parseFloat(SPC);
                $('#SalesIGST').val(((Math.round(IGST))/100).toFixed(2));  
                //alert(IGST);
            }
       }
       else
       { // no gst
                $('#SalesCGST').show();  
                $('#LabelSalesCGST').show();
                $('#SalesSGST').show();  
                $('#LabelSalesSGST').show();
                $('#SalesIGST').hide();  
                $('#LabelSalesIGST').hide();
                var newtax=(tax/2).toFixed(2);
                var CGST=newtax*parseFloat(SPC);
                var SGST=newtax*parseFloat(SPC);
                $('#SalesCGST').val(((Math.round(CGST))/100).toFixed(2));  
                $('#SalesSGST').val(((Math.round(SGST))/100).toFixed(2));  
                $('#SalesIGST').val(0);
                
                
            
       }
   
});
        
 //append zero  in front start
function appendZero( num,n) {
    var numLen=num.toString().length,newNum="";
    for(i=numLen;i<n;i++) // Integer of less than two digits
        newNum=newNum+"0";
    newNum=newNum+num;
    return newNum.toString(); // return string for consistency
}
//append zero  in  last 
function check($var)
{
    if($var)
    {
        //alert("Nan hai");
        return $var;
    }
    else
    {   return 0;
    }
}

</script>