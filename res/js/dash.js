$(document).ready(function(){
    $(window).bind("load resize", function () {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse')
            $('#navToggler').removeClass('hidden');
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
            $('#navToggler').addClass('hidden');
        }
    });


    $('table.data-table').DataTable({
        "iDisplayLenth" :  5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
    });
    
    
});