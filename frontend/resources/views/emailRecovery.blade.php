@extends('layouts.userRegLayouts')
@section('content')
<section class="signin-form-main" id="signin-form-main">
    <div class="container-lg  mt-5">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-8">
                <img src="{{URL('images/Secure data-cuate.svg')}}" class="img-fluid" alt="signin-form-main"> 
            </div>
            <div class="col-xl-5 col-lg-8 col-md-8  pt-3 ">
                <div class="container mb-3">
                    <h4 class="h4 ">NEW CREDENTIALS</h4>
                    <div class="row justify-content-start" id="validate-1">
                        <div class="col-sm-1 col-1">
                            <i class="bi bi-cursor-fill"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must be at least 6 characters long.</p>
                        </div>
                    </div>  
                    <div class="row justify-content-start" id="validate-2">
                        <div class="col-sm-1 col-1">
                            <i class="bi bi-cursor-fill"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must contain at least one upper case.</p>
                        </div>
                    </div>  

                    <div class="row justify-content-start" id="validate-3">
                        <div class="col-sm-1 col-1">
                            <i class="bi bi-cursor-fill"></i>
                        </div>
                        <div class="col">
                            <p class="">One lower case letter.</p>
                        </div>
                    </div>  

                    <div class="row justify-content-start" id="validate-4">
                        <div class="col-sm-1 col-1">
                            <i class="bi bi-cursor-fill"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must contain at least one number or special character.</p>
                        </div>
                    </div>
                </div>
                {{-- <p>email : {{$email}}</p> --}}
                <div class="container pt-4">
                    <form class="userRegistrationForm" id="resetPasswordForm">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="hidden" name="token" value="{{$token}}">
                        <label for="new_password" class="form-label"><h6>New Password</h6></label>
                        <div class="col-lg-10 col-xl-11">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control p-3" placeholder="Enter new Password" id="new_password" name="new_password" >
                            </div>
                        </div>
                        <label for="confirm_password" class="form-label"><h6>Re-type Password</h6></label>
                        <div class="col-lg-10 col-xl-11">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control p-3" placeholder="Confirm Password" id="confirm_password" name="confirm_password" >
                            </div>
                            <span class="passwordError text-danger"></span>
                        </div>
                        <div class="col-lg-10 col-xl-11 pt-4">
                            <button class="btn user btn-wh-green w-100 mb-2" type="submit" id="passwordResetBtn" >Reset Password</button>
                            <button type="reset" class="btn w-100" data-bs-toggle="button" id="backBtn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
    $(document).ready(function(){
        
        $('#resetPasswordForm').submit(function(e){
            e.preventDefault();
            $('#passwordResetBtn').text('Please wait...');
            $('.passwordError').text('');
            var formData = $(this).serialize();
            var formDataArray = $(this).serializeArray();
            console.log(formData);
            // validatePassword(formDataArray[0].value);
            console.log(formDataArray);

            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_password').val();
            var passwordError = validatePassword(new_password, confirm_password);

            if (passwordError) {
                $('.passwordError').text(passwordError);
                $('#resetBtn').text('Submit');
                return;
            }

            $.ajax({
                url : baseUrl + '/api/auth/reset',
                type : 'POST',
                data : formData,

                success : function(response){
                    console.log(response);
                    if(response.status == 200){
                        Swal.fire({
                        icon: "success",
                        title: "success",
                        text: response.messages,
                        }).then(()=>{

                            window.location.href = '/login';
                        
                        });
                        $('#passwordResetBtn').text('Reset Password');
                }else if(response.status == 401){
                        Swal.fire({
                            title: "Error",
                            text: response.messages,
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Return to Login",
                            }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/login';
                            }
                            });
                    $('#passwordResetBtn').text('Reset Password');
                }else{
                    Swal.fire({
                            title: "Error",
                            text: response.messages,
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Return to Login",
                            }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/login';
                            }
                            });
                    $('#passwordResetBtn').text('Reset Password');
                }
                },
                error: function(error,xhr){
                    Swal.fire({
                            title: "Error",
                            text: xhr.responseText,
                            icon: "error",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Return to Login",
                            }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/login';
                            }
                            });
                    $('#passwordResetBtn').text('Reset Password');
                }
            })
        })
    })

    function validatePassword(password, confirmPassword) {
    if (password !== confirmPassword) {
        return 'Passwords do not match.';
    }
    if (password.length < 6) {
        
        $('#validate-1').empty();
        $('#validate-1').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must be at least 6 characters long.</p>
                        </div>`);
                        $('#validate-1').css('color', 'red');
        return 'Enter a password  is at least 6 characters lon';
    }
    if (!/[A-Z]/.test(password)) {

        $('#validate-2').empty();
        $('#validate-2').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must contain at least one upper case.</p>
                        </div>`);
                        $('#validate-2').css('color', 'red');
        
    $('#validate-1').empty();
    $('#validate-1').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must be at least 6 characters long.</p>
                        </div>`);
                        $('#validate-1').css('color', 'green');
        return 'Enter a password that contains at least one upper case letter.';
    }
    if (!/[a-z]/.test(password)) {

        $('#validate-3').empty();
        $('#validate-3').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <div class="col">
                            <p class="">One lower case letter.</p>
                        </div>`);
                        $('#validate-3').css('color', 'red');
                        $('#validate-1').empty();
    $('#validate-1').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must be at least 6 characters long.</p>
                        </div>`);
                        $('#validate-1').css('color', 'green');
                        $('#validate-2').empty();
    $('#validate-2').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must contain at least one upper case.</p>
                        </div>`);
                        $('#validate-2').css('color', 'green');
    
        return 'Enter a password that contains at least one lower case letter.';
    }
    if (!/[0-9!@#$%^&*]/.test(password)) {

        $('#validate-4').empty();
        $('#validate-4').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must contain at least one number or special character.</p>
                        </div>`);
                        $('#validate-4').css('color', 'red');

                        $('#validate-1').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must be at least 6 characters long.</p>
                        </div>`);
                        $('#validate-1').css('color', 'green');
                        $('#validate-2').empty();
    $('#validate-2').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must contain at least one upper case.</p>
                        </div>`);
                        $('#validate-2').css('color', 'green');
                        $('#validate-3').empty();
    $('#validate-3').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="col">
                            <p class="">One lower case letter.</p>
                        </div>`);
                        $('#validate-3').css('color', 'green');

        return 'Enter a password that contains at least one number or special character.';
    }
    $('#validate-1').empty();
    $('#validate-1').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must be at least 6 characters long.</p>
                        </div>`);
                        $('#validate-1').css('color', 'green');
    $('#validate-2').empty();
    $('#validate-2').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must contain at least one upper case.</p>
                        </div>`);
                        $('#validate-2').css('color', 'green');
    $('#validate-3').empty();
    $('#validate-3').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="col">
                            <p class="">One lower case letter.</p>
                        </div>`);
                        $('#validate-3').css('color', 'green');
    $('#validate-4').empty();
    $('#validate-4').append(`<div class="col-sm-1 col-1">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="col">
                            <p class="">Password must contain at least one number or special character.</p>
                        </div>`);
                        $('#validate-4').css('color', 'green');

    return '';
}

$('#backBtn').click(function(){
        window.location.href = '/forgetPassword';
    });
</script>
@endsection