$(document).ready(function(){
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

    $('#usersTable').DataTable({
        "columnDefs": [
          { "orderable": false, "targets": 7 }
        ]
    });

});