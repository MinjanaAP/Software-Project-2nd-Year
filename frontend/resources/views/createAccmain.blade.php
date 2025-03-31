@extends('layouts.userRegLayouts')
@section('content')
<section class="signin-form-main" id="signin-form-main">
    <div class="container-lg mt-5">
        <div class="row justify-content-center align-item-center">
            <div class="col-xl-5 col-lg-5 col-md-6 col-10">
                <img src="{{URL('images/secure-login.svg')}}" alt="verified" class="img-fluid">
            </div>
            <div class="col-xl-5 col-lg-8 col-md-8 pt-3">
                <form id="LoginForm">
                    <div class="container-fluid">
                        <h4 class="h4 m-0 mb-2">Login to Findit</h4>
                        <p>Please enter your phone number. You will receive an OTP to verify your account.</p>
                    </div>
                    <div class="container pt-1">
                        <label for="mobile_no" class="form-label">Phone number</label>
                        <div class="col-lg-10 col-xl-11">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control py-2" id="mobile_no" placeholder="Enter your phone number">
                            </div>
                            <span id="error_telephone_no_1" class="text-danger"></span>
                        </div>
                        <div class="col-lg-10 col-xl-11">
                            <button class="btn user btn-wh-green w-100 mb-2" id="continueBtn">Continue</button>
                        </div>
                        <div class="col-lg-10 col-xl-11 pt-1">
                            <div class="container-fluid">
                                <p class="text-center">OR</p>
                            </div>
                        </div>
                        <div class="col-lg-10 col-xl-11 mb-3">
                            <button type="button" class="signin-form-button2" id="google">
                                <div class="signin-form-button-container d-flex align-item-center justify-content-center">
                                    <img src="{{URL('images/google.png')}}" alt="verified" class="img-fluid">
                                    <small>Continue with Google</small>
                                </div>
                            </button>
                        </div>
                        <div class="col-lg-10 col-xl-11 mb-3">
                            <button type="button" class="signin-form-button2" onclick="window.location.href='/emailLogin'">
                                <div class="signin-form-button-container d-flex align-item-center justify-content-center">
                                    <img src="{{URL('images/email.png')}}" alt="verified" class="img-fluid">
                                    <small>Continue with Email</small>
                                </div>
                            </button>
                        </div>
                        <div class="col-lg-10 col-xl-11 mb-3">
                            <button type="button" class="signin-form-button2" id="facebook">
                                <div class="signin-form-button-container d-flex align-item-center justify-content-center">
                                    <img src="{{URL('images/facebook.png')}}" alt="verified" class="img-fluid">
                                    <small>Continue with Facebook</small>
                                </div>
                            </button>
                        </div>
                        <div class="col-lg-10 col-xl-11 pt-1">
                            <div class="container-fluid">
                                <p class="text-center">Don't have an account? <a href="/signup">Sign up</a></p>
                            </div>
                        </div>
                        <div class="col-lg-10 col-xl-11 pt-1">
                            <div class="container-fluid">
                                <p class="text-center">By signing up for an account you agree to our <a href="/aboutUs/#terms">Terms and Conditions.</a></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
    $(document).ready(function(){

        const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            const message = urlParams.get('message');

            if (status && message) {
                Swal.fire({
                    icon: status === 'success' ? 'success' : 'error',
                    title: status === 'success' ? 'Success' : 'Error',
                    text: message+ ' Please login to continue.',
                    confirmButtonColor: '#007bff',
                    textColor: '#000'
                }).then((result) => {
                    
                });
            } 

        $('#google').click(function() {
            window.location.href = baseUrl + '/api/login/google';
        });

        $('#facebook').click(function() {
            window.location.href = baseUrl + '/api/login/facebook';
        });

        $('#continueBtn').click(function(e){
            e.preventDefault();
            var formDataValue = $('#mobile_no').val();
            var formData = { "mobile_no": formDataValue };

            var regex = /^07\d{8}$/; // Regex for mobile number starting with 94 followed by 9 digits

            if (regex.test(formDataValue)) {
                $('#error_telephone_no_1').text(''); // Clear error message if valid
            } else {
                $('#error_telephone_no_1').text('Enter a valid mobile number like 0771234567');
                return;
            }

            console.log(formData);

            $.ajax({
                url: baseUrl + '/api/otp/generate',
                type : 'POST',
                data : formData,
                success : function(response){
                    console.log(response);
                    if(response.status == 200){
                        Swal.fire({
                        icon: 'success',
                        title: 'OTP Sent!',
                        text: 'A one-time password has been sent to your registered mobile number.',
                        confirmButtonText: 'OK'
                        });
                        var userId = response.data.user_id;
                        window.location.href = 'otpLoging/' + userId;
                    } else {
                        swal('Error', response.message, "error");
                    }
                },
                error: function(xhr){
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: xhr.responseText,
                        });
                
                }
            });
        });
    });
</script>
@endsection
