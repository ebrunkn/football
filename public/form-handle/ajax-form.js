$(document).ready(function(){

    function showErrors(result){
        if( result.errors ){
            // console.log( result.errors );
            // Looping through each validation error response
            $.each(result.errors, function(general_key, general_value){
                /*==========
                Below lines just finding out the error field on DOM
                =============*/
                $targetField = $('[name="'+general_key+'"');
                /*==========
                Adding class for error field for invalid highlight
                =============*/
                $targetField.addClass('is-invalid');
                $('#form-error-'+general_key).addClass('d-inline').html(general_value);
            });
        }
    };

    function formSave(form, url, callback){

        form.find('.invalid-feedback').removeClass('d-inline').html('');
        form.find('.is-invalid').removeClass('is-invalid');
        sendData =  form.serializeArray();
        // console.log(sendData);
        $.ajax({
            type: "POST",
            url: url,
            data: sendData, // serializes the form's elements.
            dataType: 'json',
            success: function(result)
            {
                if( result.status == 'OK' ) {
                    toastr.success('Data saved', 'Done!')
                    window.location.href = callback;             
                }
                else {
                    toastr.error('Something went wrong!', 'Error!')
                    // console.log( result );
                }

                $('.form-submit-btn').prop('disabled', false);
                $('.form-submit-btn').find('.label').removeClass('d-none');
                $('.form-submit-btn').find('.preloader').addClass('d-none');

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                // console.log(XMLHttpRequest);
                $('.form-submit-btn').prop('disabled', false);
                $('.form-submit-btn').find('.label').removeClass('d-none');
                $('.form-submit-btn').find('.preloader').addClass('d-none');
                if(XMLHttpRequest.status == 422){
                    toastr.error(XMLHttpRequest.responseJSON.message, 'Error. Validation Error...!')
                    $('.form-submit-btn').prop('disabled', false);
                    $('.form-submit-btn').find('.label').removeClass('d-none');
                    $('.form-submit-btn').find('.preloader').addClass('d-none');
                }else if(XMLHttpRequest.status == 406){
                    toastr.warning(XMLHttpRequest.responseJSON.message, 'Not Accepatable')
                    $('.form-submit-btn').prop('disabled', false);
                    $('.form-submit-btn').find('.label').removeClass('d-none');
                    $('.form-submit-btn').find('.preloader').addClass('d-none');
                    showErrors(XMLHttpRequest.responseJSON);
                }else {
                    toastr.error('Something went wrong!', 'Error!')
                    $('.form-submit-btn').prop('disabled', false);
                    $('.form-submit-btn').find('.label').removeClass('d-none');
                    $('.form-submit-btn').find('.preloader').addClass('d-none');
                    console.log( errorThrown );
                }
             }
          });
    }

    $('.form').on('submit', function(e){
        e.preventDefault();
        $('.form-submit-btn').prop('disabled', true);
        $('.form-submit-btn').find('.label').addClass('d-none');
        $('.form-submit-btn').find('.preloader').removeClass('d-none');
        var form = $(this);
        var url = form.attr('action');
        var callback = form.attr('callback') ? form.attr('callback'): url;
        formSave(form, url, callback)
    });

});
