// AUTH CLIENT SIDE VALIDATION
$(document).ready(function() {
    // phone number input form
    $('.auth-phone').keyup(function() {
        console.log('done');
        let value = $(this).val();
        let value_arr = value.split('');

        if (value_arr.length == 0) {
            $(this).parent().find('.auth-form-msg').html('Enter Phone number').css('color', 'red');
        } else if (value_arr[0] != '0' || value_arr[1] != '7') {
            $(this).parent().find('.auth-form-msg').html('Invalid format use(07...)').css('color', 'red');
        } else {
            if (value_arr.length == 10) {
                $(this).parent().find('.auth-form-msg').html('Verified <i class="fa fa-check"></i>').css('color', 'green');
            } else if (value_arr.length > 10) {
                $(this).parent().find('.auth-form-msg').html('Invalid(10 digits)').css('color', 'red');
            } else {
                $(this).parent().find('.auth-form-msg').html('incomplete number').css('color', 'red');
            }
        }
    });
    // password input form
    $('.auth-password').keyup(function() {
        let value = $(this).val();
        let value_arr = value.split('');

        if (value_arr.length < 8) {
            $(this).parent().find('.auth-form-msg').html('Minimum 8 characters').css('color', 'red');
        } else {
            $(this).parent().find('.auth-form-msg').html('Approved <i class="fas fa-check"></i>').css('color', 'green');
        }
    });
    // password confirm input form
    $('.auth-password-confirm').keyup(function() {
        let value = $(this).val();
        let password = $('.auth-password').val();

        if (value != password) {
            $(this).parent().find('.auth-form-msg').html('Not a match').css('color', 'red');
        } else {
            $(this).parent().find('.auth-form-msg').html('Approved <i class="fas fa-check"></i>').css('color', 'green');
        }
    });
});