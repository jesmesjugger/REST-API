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

    $('.fa-trash-alt').on('click',function(){
        let row_id = $(this).closest("tr").find(".id").text();
        var selection = confirm("Are you sure you want to delete this user?");
        
        if(selection == true){
            $.ajax({
                url:"../../../include/ajax.php",
                data: {"deleteID": row_id},
                type: "POST",
                success:function(res){
                    alert(res);
                    window.location.reload();
                },
                error: function(){
                    console.log("failed to send");
                }
            });
    
        }
    });
    
});