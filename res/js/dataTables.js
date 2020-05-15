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

    var usersTable = $('#usersTable').DataTable();

    $('#usersTable tbody').on('click','tr',function(){
        let row_data = usersTable.row(this).data();
        var data = {
            "id": row_data[0],
            "field": row_data[1]
        }

        // $.ajax({
        //     url:'../../../include/admin_functions.php',
        //     type: 'POST',
        //     data: {"data": JSON.stringify(data)},
        //     success: function(data){
        //         //window.location.href = "../users/update/";
        //         console.log("echoed: "+data);
        //     },
        //     error: function() {
        //         console.log("failed to send obj");
        //     }
        // });

    });

});