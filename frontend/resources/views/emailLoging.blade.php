@extends('layouts.userRegLayouts')
@section('content')
<section class="signin-form-main" id="signin-form-main">
    <div class="container-lg mt-5">
        <div class="row justify-content-center align-item-center">
            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-8 ">
                <img src="{{URL('images/login.svg')}}" class="img-fluid" alt="signin-form-main">
            </div>
            <div class="col-xl-5 col-lg-8 col-md-8  pt-3 ">
                <div class="container">
                    <h4 class="h4 m-0  mb-2">SIGN IN</h4>
                </div>
                <div class="container pt-5">
                    <form  class="userRegistrationForm" method="POST" id="userLoginForm" >
                        <label for="email" class="form-label">Email Address</label>
                        <div class="signin-form-button-container">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control py-3 " name="email" placeholder="Enter your email Address" aria-label="email" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <p class="emailError text-danger"></p>

                        <label for="Password" class="form-label">Password</label>
                        <div class="signin-form-button-container">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control py-3 " name="password" placeholder="Enter your password" >
                            </div>
                        </div>
                        <p class="passwordError text-danger"></p>

                        <div class=" pt-4 ">
                            <button class="btn user btn w-100" type="submit" id="signbtn">Sign In</button>
                            <div class="mt-2" style="display: flex; align-items: center;">
                                {{-- <label style="display: flex; align-items: center; margin-right: 10px;">
                                    <input type="checkbox" style="margin-right: 5px;">
                                    Remember me
                                </label> --}}
                                <a href="/signup" style="margin-right: auto;  text-decoration: none;">Create An Account</a>

                                <a href="/forgetPassword" target="_blank" style="margin-left: auto;  text-decoration: none; color : rgb(250, 50, 5)">Forgot Password?</a>
                            </div>
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
        $('#userLoginForm').submit(function(e){
            $('#signbtn').text('Please wait...');
            e.preventDefault();
            // $('#signbtn').text('Please wait...');
            $('.emailError').text('');
            $('.passwordError').text('');
            
            var formData = $(this).serialize();
            var formDataArray = $(this).serializeArray();
            console.log(formDataArray);

            //input validation
            if(formDataArray[0]['value'] == '' || formDataArray[1]['value'] == ''){
                Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Email or password can't be empty",
                        });
                
                return;
            }

            //email validation
            var email = formDataArray[0]['value'];
            var emailValidationPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if(!emailValidationPattern.test(email)){
                
                $('.emailError').text('Invalid email');
                return;
            }


            $.ajax({
                url : baseUrl + '/api/auth/login',
                type : 'POST',
                data : formData,
                success : function(response){
                    console.log("Successfull",response);
                    console.log("Token",response.access_token);
                    //save token in session
                    sessionStorage.setItem('token',response.access_token);
                    sessionStorage.setItem('role',response.user.role);
                    sessionStorage.setItem('user_id',response.user.id);
                    sessionStorage.setItem('email',response.user.email);
                    sessionStorage.setItem('first_name',response.user.first_name);
                    sessionStorage.setItem('last_name',response.user.last_name);
                    sessionStorage.setItem('phone',response.user.telephone_no_1);
                    if(response.user.profile_image){
                        sessionStorage.setItem('profile_image',response.user.profile_image);
                    }
                    sessionStorage.setItem('status',response.user.status);
                    

                    // if(response){
                    //     swal("Good job!", "You are Logged IN", "success");
                    //     window.location.href = '/freeAd1'
                    // }
                    
                    if(response.user.role == 'user'){
                        window.location.href = '/homePage'
                    }else if(response.user.role == 'adminUser' || response.user.role == 'superAdmin' || response.user.role == 'admin' ){
                        window.location.href = '/admin/dashboard';
                    }else{
                        swal("Error !!", "User role is undefined", "error");
                        window.location.href = '/login'
                    }
                },
                error : function(xhr, status, error,response){
                    

                    if(xhr.status == 401){
                        Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Invalid email or password",
                        });
                        $('#userLoginForm')[0].reset();
                        $('#signbtn').text('Sign In');
                    }else{
                        
                        var errorMessage = JSON.parse(xhr.responseText);
                        var errorJson = JSON.parse(errorMessage);

                        console.log("Error",errorJson);
                        Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: errorMessage,
                        });

                        var emailError = errorJson.email;
                        var passwordError = errorJson.password;
                        if(errorJson.email){
                            $('.emailError').text(emailError)
                            $('#signbtn').text('Sign In');  
                        }
                        if(errorJson.password){
                            $('.passwordError').text(passwordError)
                            $('#signbtn').text('Sign In');
                    }
                }
            }
            })
        })
    })
</script>
@endsection