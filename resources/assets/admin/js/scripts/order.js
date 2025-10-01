$(function() {
    if($('#example2111').length > 0){
        getList();        
    }

    if($('#palletTable').length > 0){
        getpalletList();        
    }
});


/* code of display Waiver details in the table. */
var getList = function(){
    $('#example2111').dataTable({
        "autoWidth": false,
        "Processing": true,
        "serverSide": true,
        "destroy"   : true,
        "serverSide": true,
        "stateSave" : true,  
        "dom": '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        "language": {
            "search": '<span>Filter:</span> _INPUT_',
            "searchPlaceholder": 'Type to filter...',
            "lengthMenu": '<span>Show:</span> _MENU_',
            "paginate": { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' },
        },
        "ajax": {
            "url": BASE_URL+'Admin/getListDifferent',
            "type": "POST",
        },
        "columnDefs": [        
            { className: "text-center switchery-sm", "targets": [6] }
        ],

        aaSorting: [[0, 'desc']],
        columns: [
            {   
                data: "OrderId",
                visible: false,
                sortable:true,
            },
            {                
                data: "",
                visible: true,
                searchable:true,
                sortable: true,
                render: function (data, type, full, meta){
                    var button = '';
                    if(full.OrderCustomLRNO == "")
                    {
                        button = full.OrderLRNO;
                    }
                    else
                    {
                        button = full.OrderCustomLRNO;
                    }
                    return button;
                }
            },
            {
                data: "OrderGstInvoice",
                visible: true,
            },
            {
                data: "OrderDate",
                visible: true,
            },
            {
                data: "DealerName",
                visible: true,
            },
            {
                data: "ConsigneeName",
                visible: true,
            },
            {
                data: "OrderTotalWeight",
                visible: true,
            },
            {
                data: "OrderTotalBoxes",
                visible: true,
            },
            {
                data: "OrderTotal",
                visible: true,
            },
            {
                data: "",
                visible: true,
                sortable:false,
                searchable:false,
                render: function (data, type, full, meta){
                    var btn = '';

                    btn += '<a data-popup="tooltip" data-placement="top" title="" href="'+BASE_URL+'/Admin/AddOrderCustomDifferent/'+(full.OrderId)+'" class="text-info" id="'+full.OrderId+'" data-original-title="Delete"><i class="fa fa-edit admin-custom-color-opp" ></i></a>&nbsp;&nbsp;';
                    btn += '<a data-popup="tooltip" data-placement="top" title="" href="'+BASE_URL+'/Admin/BillPrintDifferentTransport/'+(full.OrderId)+'" class="text-info" id="'+full.OrderId+'" data-original-title="Delete"><i class="fa fa-print admin-custom-color-opp" ></i></a>&nbsp;&nbsp;';
                    btn += '<a data-popup="tooltip" data-placement="top" title="" href="'+BASE_URL+'/Admin/BillPrintDifferent/'+(full.OrderId)+'" class="text-info" id="'+full.OrderId+'" data-original-title="Delete"><i class="fa fa-print admin-custom-color-opp" ></i></a>&nbsp;&nbsp;';
                    
                    return btn;
                }
            },
            {
                data: "",
                visible: true,
                sortable:false,
                searchable:false,
                render: function (data, type, full, meta){
                    var btn = '';

                    btn += '<button onclick=myFunction("order",'+(full.OrderId)+')><i class="fa fa-trash admin-custom-color-opp" ></i></button>';
                    
                    return btn;
                }
            },
            {
                data: "",
                visible: true,
                sortable:false,
                searchable:false,
                render: function (data, type, full, meta){
                    var btn = '';

                    btn += '<button onclick=sendMail("lr",'+(full.OrderId)+')><i class="fa fa-envelope-o admin-custom-color-opp" ></i></button>';
                    
                    return btn;
                }
            }                     
        ],
        "drawCallback": function(settings) {
            var switches = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
            switches.forEach(function(html) {
                var switchery = new Switchery(html);
            });
        },

    });
}

var getpalletList = function(){
    $('#palletTable').dataTable({
        "autoWidth": false,
        "Processing": true,
        "serverSide": true,
        "destroy"   : true,
        "serverSide": true,
        "stateSave" : true,  
        "dom": '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        "language": {
            "search": '<span>Filter:</span> _INPUT_',
            "searchPlaceholder": 'Type to filter...',
            "lengthMenu": '<span>Show:</span> _MENU_',
            "paginate": { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' },
        },
        "ajax": {
            "url": BASE_URL+'Admin/getListPalletDifferent',
            "type": "POST",
        },
        "columnDefs": [        
            { className: "text-center switchery-sm", "targets": [6] }
        ],

        aaSorting: [[0, 'desc']],
        columns: [
            {   
                data: "OrderpalletId",
                visible: true,
                sortable:true,
            },
            {                
                data: "OrderpalletLRNO",
                visible: true,
                sortable:true,
            },
            {
                data: "OrderpalletGstInvoice",
                visible: true,
            },
            {
                data: "OrderpalletDate",
                visible: true,
            },
            {
                data: "DealerName",
                visible: true,
            },
            {
                data: "OrderpalletTotalQty",
                visible: true,
            },
            {
                data: "TempoName",
                visible: true,
            },            
            {
                data: "",
                visible: true,
                sortable:false,
                searchable:false,
                render: function (data, type, full, meta){
                    var btn = '';

                    btn += '<a data-popup="tooltip" data-placement="top" title="" href="'+BASE_URL+'Admin/AddPalletCustomDifferent/'+(full.OrderpalletId)+'" class="text-info" id="'+full.OrderpalletId+'" data-original-title="Delete"><i class="fa fa-edit admin-custom-color-opp" ></i></a>&nbsp;&nbsp;';
                    btn += '<a data-popup="tooltip" data-placement="top" title="" href="'+BASE_URL+'Admin/PalletBillPrintDifferentTransport/'+(full.OrderpalletId)+'" class="text-info" id="'+full.OrderpalletId+'" data-original-title="Delete"><i class="fa fa-print admin-custom-color-opp" ></i></a>&nbsp;&nbsp;';
                    
                    return btn;
                }
            },
            {
                data: "",
                visible: true,
                sortable:false,
                searchable:false,
                render: function (data, type, full, meta){
                    var btn = '';

                    btn += '<button onclick=myFunction("orderpallet",'+(full.OrderpalletId)+')><i class="fa fa-trash admin-custom-color-opp" ></i></button>';
                    
                    return btn;
                }
            },
            {
                data: "",
                visible: true,
                sortable:false,
                searchable:false,
                render: function (data, type, full, meta){
                    var btn = '';

                    btn += '<button onclick=sendMail("pallet",'+(full.OrderpalletId)+')><i class="fa fa-envelope-o admin-custom-color-opp" ></i></button>';
                    
                    return btn;
                }
            }                       
        ],
        "drawCallback": function(settings) {
            var switches = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
            switches.forEach(function(html) {
                var switchery = new Switchery(html);
            });
        },

    });
}