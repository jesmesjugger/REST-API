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

    // function fetchLocalStorageData(){
    //     var pathArr = window.location.pathname.split("/");

    //     if(pathArr[pathArr.length-2] == "update"){
    //         if(localStorage.getItem("data")){
    //             //var row_obj = JSON.parse(localStorage.getItem('data'));

    //             $.ajax({
    //                 url:'../../../../include/admin_functions.php',
    //                 type: "POST",
    //                 data: {"data": "1234567890"},
    //                 success: function(res){
    //                     console.log(res);
    //                 },
    //                 error: function() {
    //                     console.log("Failed");
    //                 }
    //             });  

    //         }
    //     }
    // }
    
});