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
        // var bactToUrl;
        // if(callback){
        //     bactToUrl = callback;
        // }else{
        //     bactToUrl = url;
        // }

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

    // ===========================Delete Items=============================


    $('.ajax-call-btn').on('click', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            type: "GET",
            url: url,
            // data: sendData, // serializes the form's elements.
            dataType: 'json',
            success: function(result)
            {
                // console.log(result); // show response from the php script.
                if( result.status == 'OK' ) {
                    // showAlert('success', 'core.loading.saved');
                    toastr.success('Saved');
                    // window.location.href = bactToUrl;
                    
                }
                else if ( result.status == 'INVALID_DATA' ) {
                    // console.log(result);
                    // showAlert('danger', $trans.get( 'core.loading.invalid_data' ));
                    toastr.error('Error. Inavlid Data...!', 'Validation Error!')
                    showErrors(result);
                }
                else {
                    toastr.error('Something went wrong!', 'Error!')
                    showAlert('danger', 'Error');
                    // toastr.error($trans.get( 'core.loading.error' ));
                    console.log( result );
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                // console.log(url);
                // console.log(sendData);
                // console.log(XMLHttpRequest);
                // console.log(textStatus);
                console.error(errorThrown);
                // showAlert('danger', 'core.loading.error');
                toastr.error('Error');
                // showAlert('danger', 'Error');
             }
          });
    });
});
