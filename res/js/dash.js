$(document).ready(function(){
    /**
     * Navbar Resize
     */
    $(window).bind("load resize", function () {
        if ($(this).width() > 750) {
            $('div.sidebar-collapse').removeClass('collapse')
            $('#navToggler').addClass('hidden');
        } else {
            $('div.sidebar-collapse').addClass('collapse')
            $('#navToggler').removeClass('hidden');
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
    
});