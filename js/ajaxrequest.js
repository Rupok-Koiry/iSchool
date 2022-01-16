var email_error = '';
var username_error = '';
var password_error = '';

$(document).ready(function () {
    //Checking Username is not null
    $('#registration_username').on('keypress keyup keydown', function () {
        var student_name = $('#registration_username').val();
        if (student_name == '') {
            $('#registration-user-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Username field is mandatory!');
            $('#registration_username').removeClass('is-valid').addClass('is-invalid');
            username_error = 0;
        } else {
            $('#registration-user-error').removeClass('invalid-feedback').addClass('valid-feedback').html('Looks good !');
            $('#registration_username').removeClass('is-invalid').addClass('is-valid')
            username_error = 1;
        }
    })
})
$(document).ready(function () {
    //Checking Email is already Exist
    $('#registration_email').on('keypress keyup keydown', function () {
        var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var student_email = $('#registration_email').val();
        $.ajax({
            url: "student/add_student.php",
            method: 'POST',
            data: {
                checkmail: 'checkmail',
                stuemail: student_email
            },
            success: function (data) {
                //Showing Error || Success Message
                if (student_email == "") {

                    $('#registration-email-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Email field is mandatory !');
                    $('#registration_email').removeClass('is-valid').addClass('is-invalid');
                    email_error = 0;
                    $('#registration_email').focus();
                    return false;
                } else if (data > 0) {

                    $('#registration-email-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Email already exist !');
                    $('#registration_email').removeClass('is-valid').addClass('is-invalid');
                    email_error = 0;
                    $('#registration_email').focus();
                    return false;

                } else if (!reg.test(student_email)) {
                    $('#registration-email-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Plaese enter a valid email !');
                    $('#registration_email').removeClass('is-valid').addClass('is-invalid');
                    email_error = 0;
                    $('#registration_email').focus();
                    return false;
                } else if (data == 0 && reg.test(student_email)) {
                    $('#registration-email-error').removeClass('invalid-feedback').addClass('valid-feedback').html('There you go !');
                    $('#registration_email').removeClass('is-invalid').addClass('is-valid');
                    email_error = 1;

                }
            }
        })
    })
})

$(document).ready(function () {
    //Checking Password is not null or less then 8 character
    $('#registration_password').on('keypress keyup keydown', function () {
        var student_password = $('#registration_password').val();
        if (student_password == '') {
            $('#registration-password-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Password field is mandatory.');
            $('#registration_password').removeClass('is-valid').addClass('is-invalid')
            password_error = 0;
        } else {
            if (student_password.length >= 8) {
                $('#registration-password-error').removeClass('invalid-feedback').addClass('valid-feedback').html('Looks Good');
                $('#registration_password').removeClass('is-invalid').addClass('is-valid');
                password_error = 1;
            } else {
                $('#registration-password-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Password must be 8 character or long.');
                $('#registration_password').removeClass('is-valid').addClass('is-invalid');
                password_error = 0;
            }
        }
    })
})




$('#registration_submit').click(function (e) {
    e.preventDefault();
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i; //Email Format
    //Getting all value from the input
    var student_name = $('#registration_username').val();
    var student_email = $('#registration_email').val();
    var student_password = $('#registration_password').val();
    //Checking Form Fields on From Submission
    if (student_name.trim() == "") {
        $('#registration-user-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Username Field is Mandatory !');
        $('#registration_username').removeClass('is-valid').addClass('is-invalid');
        $('#registration_username').focus();
        return false;
    } else if (student_email.trim() == "") {
        $('#registration-email-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Email Field is Mandatory !');
        $('#registration_email').removeClass('is-valid').addClass('is-invalid');
        $('#registration_email').focus();
        return false;

    } else if (student_email.trim() != "" && !reg.test(student_email)) {

        $('#registration-email-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Please enter a  valid email');
        $('#registration_email').removeClass('is-valid').addClass('is-invalid');
        $('#registration_email').focus();
        return false;

    } else if (student_password.trim() == "") {

        $('#registration-password-error').removeClass('valid-feedback').addClass('invalid-feedback').html('*Passoerd field is mandatory.');
        $('#registration_password').removeClass('is-valid').addClass('is-invalid');
        $('#registration_password').focus();
        return false;

    } else {
        //Sending Value to the database
        if (username_error == 0) {
            $('#registration_username').focus();
            return false;
        } else if (password_error == 0) {
            $('#registration_password').focus();
            return false;
        } else if (email_error == 0) {
            $('#registration_email').focus();
            return false;
        } else if (email_error == 1 && username_error == 1 && password_error == 1) {

            $.ajax({
                url: "student/add_student.php",
                method: 'POST',
                dataType: "json",
                data: {
                    stusignup: "stusignup",
                    stuname: student_name,
                    stuemail: student_email,
                    stupass: student_password
                },
                success: function (data) {
                    if (data == "OK") {
                        $('#registration_submit').html('<span class="spinner-grow spinner-grow-sm" style="width: 1.5rem; height: 1.5rem;" role="status" aria-hidden="true"></span> Loading...').attr('disabled', true);
                        setTimeout(() => {
                            $('#registration_submit').html('Register').attr('disabled', false);
                            $('#alert-message').fadeIn().removeClass('alert-danger').addClass('alert-success').html('Registration Successful !');
                            clearStuRegField();
                        }, 2000);
                    } else if (data == "Failed") {
                        $('#alert-message').fadeIn().removeClass('alert-success').addClass('alert-danger').html('Unable to Register !');
                    }
                }
            })
        }
    }
})
//Empty All Fields
function clearStuRegField() {
    $('#registration_form').trigger("reset");
    $('#registration-user-error').removeClass('is-valid is-invalid').html("");
    $('#registration-email-error').removeClass('is-valid is-invalid').html("");
    $('#registration-password-error').removeClass('is-valid is-invalid').html("");
    $('#registration_username').removeClass('is-valid is-invalid')
    $('#registration_email').removeClass('is-valid is-invalid')
    $('#registration_password').removeClass('is-valid is-invalid')
}
$('#registration-close-btn').click(function () {
    clearStuRegField();
    $('#alert-message').fadeOut();
})
$('#registration_modal').parent().click(function () {
    $('#alert-message').fadeOut();
})
//ajax call Student Login verification
$('#login_submit').click(function (e) {
    e.preventDefault();
    var stuLogEmail = $('#login_email').val();
    var stuLogPass = $('#login_password').val();
    $.ajax({
        url: "student/add_student.php",
        method: 'POST',
        data: {
            checkLogemail: "checklogemail",
            stuLogEmail: stuLogEmail,
            stuLogPass: stuLogPass
        },
        success: function (data) {
            if (data == 0) {
                $('#alert-message-login').fadeIn().removeClass('alert-success').addClass('alert-danger').html('Invalid Email ID or Password !');
            } else if (data == 1) {
                $('#alert-message-login').fadeIn().removeClass('alert-danger').addClass('alert-success').html('Log in successfully !');
                $('#login_submit').html('<span class="spinner-border spinner-border-sm" style="width: 1.5rem; height: 1.5rem;" role="status" aria-hidden="true"></span> Loading...').attr('disabled', true);
                setTimeout(() => {
                    window.location.href = 'index.php'
                }, 1000);
            }
        }
    })
})
$('#log_close_btn').click(function () {
    $('#alert-message-admin').fadeOut();
})
$('#admin_modal').parent().click(function () {
    $('#alert-message-admin').fadeOut();
})
