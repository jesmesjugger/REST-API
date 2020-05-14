$(document).ready(function(){
    /**
     * Navbar Resize
     */
    $(window).bind("load resize", function () {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse')
            $('#navToggler').removeClass('hidden');
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
            $('#navToggler').addClass('hidden');
        }
    });

    /**
     * Hide & Show relevant forms
     */
    $('#detailsPill').click(function(){
        $('.list-group-item').removeClass('active');
        $('#detailsPill').addClass('active');
        toggleActiveForm();
    });
    $('#rolesPill').click(function(){
        $('.list-group-item').removeClass('active');
        $('#rolesPill').addClass('active');
        toggleActiveForm();
    });

    
    /**
     * Data-tables
     */
    $('#transactionTable').DataTable({
        "iDisplayLenth" :  5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        dom: 'lBfrtip',
        processing: true, //shows progress bar
        buttons: [
            {
                text: 'Export to Excel',
                extend: 'excel',
                className: "ml-2 py-1 px-1",
                title: `Transaction Records - ${new Date().getTime().toString()}`
            }
            
        ]
    });
    
    $('#inquiryTable').DataTable({
        "iDisplayLenth" :  5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        dom: 'lBfrtip',
        processing: true, //shows progress bar
        buttons: [
            {
                text: 'Export to Excel',
                extend: 'excel',
                className: 'ml-2 py-1 px-1',
                title: `Inquiry Records - ${new Date().getTime().toString()}`
            }
        ]
    });

    $('#usersTable').DataTable();

    // $('#transactionTable tbody').on('click','tr',function(){
    //     let row_data = transactTable.row(this).data();
    //     var obj = {
    //         "id": row_data[0],
    //         "field": row_data[1]
    //     }

    //     $.post("../../include/admin_functions.php",obj,function(data,status){
    //         console.log('data:  ',data);
    //         //TODO: redirect page to edit page.
    //     })

    // });

    /**
     * FUNCTIONS
     */
    function toggleActiveForm(){
        $('.form-content-div').addClass('hidden');

        if($('#detailsPill').hasClass('active')){
            $('#detailsForm').removeClass('hidden');
        }
        else if($('#rolesPill').hasClass('active')){
            $('#rolesForm').removeClass('hidden');
        }
    }
    
});