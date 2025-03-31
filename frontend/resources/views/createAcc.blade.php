@extends('layouts.userRegLayouts')
@section('content')
<section class="signin-form-main" id="signin-form-main">
    <div class="container-lg  mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-5 col-lg-5 col-md-6 col-10 ">
            <img src="{{URL('images/signup.svg')}}" class="img-fluid" alt="signin-form-main">
            </div>

            <div class="col-xl-5 col-lg-8 col-md-8  pt-3">
                <div class="container-fluid">
                    <h3 class="h4 m-0  mb-2">Create an Account</h3>
                    <h6 class="mb-2" >Start your journey!</h6>
                </div>

                <div class="container pt-5">
                    <form  class="userRegistrationForm" method="POST" id="userRegForm">
                            @csrf
                        <div class="col-lg-10 col-xl-11">
                            <label for="name" class="form-label"><h6>Name</h6></label>
                            <div class="input-group mb-3">
                                <div class="signin-form-button-container">
                                    <input type="text" class="form-control" name="first_name" id="name" placeholder="Enter your name" aria-label="" aria-describedby="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-10 col-xl-11">
                            <label for="email" class="form-label"><h6>Email</h6></label>
                            <div class="input-group mb-3">
                                <div class="signin-form-button-container">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" aria-label="" aria-describedby="">
                                </div>
                            </div>
                            <p class="emailError text-danger"></p>
                        </div>

                        <div class="col-lg-10 col-xl-11">
                            <label for="password" class="form-label"><h6>Password</h6></label>
                            <div class="input-group mb-3">
                                <div class="signin-form-button-container">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" >
                                </div>
                            </div>
                            <p class="passwordError text-danger"></p>
                        </div>

                        <div class="col-lg-10 col-xl-11">
                            <label for="password_confirmation" class="form-label"><h6>Re-enter Password</h6></label>
                            <div class="input-group mb-3">
                                <div class="signin-form-button-container">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re - Enter your password" aria-label="" aria-describedby="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-xl-11">
                            <label for="mobile" class="form-label"><h6>Mobile Number</h6></label>
                            <div class="input-group mb-3">
                                <div class="signin-form-button-container">
                                    <input type="text" class="form-control" id="mobile" name="telephone_no_1" placeholder="Enter your mobile number" aria-label="" aria-describedby="">
                                </div>
                            </div>
                            <p class="mobileNumberError text-danger"></p>
                        </div>
                        <div class="col-lg-10 col-xl-11" >
                            <button class="btn user w-100 mb-2" type="submit" id="submitBtn">Create Accounut  <i class="bi bi-arrow-right"></i></button>
                            <button type="button" class="btn w-100" data-bs-toggle="button" id="backBtn">Cancel</button>
                            <p class="mt-2">Already have an account ? <a href="/login" style="color: #A6212C;">Log in</a></p>
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
        $('#userRegForm').submit(function(e){
            $('#submitBtn').text('Please wait...');
            $('.emailError').text('');
            $('.mobileNumberError').text('');
            $('.passwordError').text('');
            e.preventDefault();

            var formData = $(this).serialize();

            var formDataArray = {};
            formData.split('&').forEach(function(key){
                var keyValue = key.split('=');
                formDataArray[keyValue[0]] = keyValue[1];
            })

            // console.log(formDataArray);

            //Name Validation
            if(!formDataArray['first_name']){
                console.log(formDataArray['first_name']);
                Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Name feild can't be empty",
                        });
                        $('#submitBtn').text('Create Account');
                return;
            }

            //email Validation
            var decodedEmail = decodeURIComponent(formDataArray['email']);
            var emailValidationPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!emailValidationPattern.test(decodedEmail)) {
                // console.log("Email is invalid");
                
                Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Email is invalid!",
                        });
                        $('#submitBtn').text('Create Account');
                return;
            }

            
            // password checking
            if(!formDataArray['password']){
                // console.log("Password is empty");
                Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Password can't be empty!",
                        });
                        $('#submitBtn').text('Create Account');
                return;
            } else{
                    if(formDataArray['password'] != formDataArray['password_confirmation']){
                    // console.log("Password mismatch");
                    
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Password mismatch!",
                        });
                        $('#submitBtn').text('Create Account');
                    return;
                    }
                }
            
            //? mobile number validation
            var mobileValidationPattern = /^(?:\+?94|0)(?:[1-9]\d?|7\d)\d{7}$/;
            if (!mobileValidationPattern.test(formDataArray['telephone_no_1'])) {
                console.log("Mobile number is invalid");
                
                Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Mobile number is invalid!",
                        });
                        $('#submitBtn').text('Create Account');
                return;
            }

            
            $.ajax({
                url : baseUrl+'/api/auth/register',
                type : 'POST',
                data : formData,
                success : function(response){
                    // console.log("Successfull" + response);
                    if(response.status == 201){
                        $('#userRegForm')[0].reset();
                        $('#submitBtn').text('Create Account');
                        
                        let timerInterval;
                        Swal.fire({
                        title: "Registration Successfull!",
                        html: "Return to Login Page ",
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                        }).then((result) => {
                        
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = "/emailLogin";
                        }
                        });
                    }
                },
                error : function(xhr, status, error){
                    var errorMessage =JSON.parse(xhr.responseText);
                    var errorJson = JSON.parse(errorMessage);
                    console.log(errorJson);
                    var emailError = errorJson.email;
                    var passwordError = errorJson.password;
                    var mobileNumberError = errorJson.telephone_no_1;

                    // if(emailError || passwordError || mobileNumberError){
                    //     swal("Oops!", emailError +"\n"+ passwordError +"\n" + mobileNumberError, "error");
                    //     console.log(emailError +"\n"+ passwordError +"\n" + mobileNumberError);
                    // }

                    if(emailError){
                        $('.emailError').text(emailError);

                    }

                    if(passwordError){
                        $('.passwordError').text(passwordError);
                    }

                    if(mobileNumberError){
                        $('.mobileNumberError').text(errorJson.telephone_no_1);
                    }
                    $('#submitBtn').text('Create Account');
                }
                
            })
        })
    })

    $('#backBtn').click(function(){
        window.history.back();
    });
</script>
@endsection