@extends('layouts.userRegLayouts')
@section('content')
<section class="signin-form-main" id="signin-form-main">
    <div class="container-lg  mt-5">
        <div class="row justify-content-center align-item-center">
            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-8 ">
                <img src="{{URL('images/Work time-pana.svg')}}" alt="signin-form-main" class="img-fluid ">
            </div>

            <div class="col-xl-5 col-lg-8 col-md-8  pt-3 ">
                <div class="container">
                    <h4 class="h4 m-0  mb-2">FORGOT PASSWORD</h4>
                    <p >Provide your account's email  for which you want to reset your password.</p>
                </div>
                <div class="container pt-5">
                    <form class="userRegistrationForm" id="resetForm">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="col-lg-10 col-xl-11">
                            <div class="input-group mb-3">
                                <!-- <span class="input-group-text" id="basic-addon1">@</span> -->
                                <input type="email" class="form-control py-3 " placeholder="Enter your email Address" name="email" aria-label="email" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <p class="emailError text text-danger"></p>
                        <p class="successResponse text text-success"></p>
                        <div class="col-lg-10 col-xl-11 pt-4 d-flex justify-content-around align-items-center" id="btnContainer">
                            <button class="btn user w-100 mb-2" type="submit" id="resetBtn">Request reset password link</button>
                            
                        </div>
                        <div class="col-lg-10 col-xl-11">
                            <button type="button" class="btn btn w-100"  id="backBtn" >Cancel</button>
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
        $('#resetForm').submit(function(e){
            $('#resetBtn').text('Please wait...');
            $('.emailError').text('');
            $('.successResponse').text('');
            e.preventDefault();
            var formData = $(this).serialize();
            var formDataArray = $(this).serializeArray();
            console.log(formDataArray);

            //email validation
            var email = formDataArray[0].value;
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if(email == ''){
                $('.emailError').text('Email is required');
                $('#resetBtn').text('Request reset password link');
                return;
            }else if(!emailPattern.test(email)){
                $('.emailError').text('Invalid email address');
                $('#resetBtn').text('Request reset password link');
                return;
            }

            $.ajax({
                url : baseUrl + '/api/auth/forgotPassword',
                type : 'POST',
                data : formData,
                
                // dataType : 'json',
                success : function(response){
                    console.log(response);
                    if(response.status == 200){
                        //swal("Good job!", response.messages, "success");
                        
                        $('.successResponse').append(`<i class="bi bi-check2-circle"></i> ${response.messages}`);
                            $('#btnContainer').empty();
                            $('#btnContainer').append(`
                                <button type="button" class="btn button-33 w-40 mb-3" id="checkEmailBtn" onclick="checkEmail('${email}')" >Check email</button>
                                <button type="submit" class="btn button-33 w-40 mb-3" id="resetBtn" >Resend reset password link</button>
                            `);
                        
                    
                    }else if(response.status == 400){
                        // swal("Error!", response.messages, "error");
                        $('.emailError').text("Email not found in our database. Please try again.");
                        $('#resetBtn').text('Request reset password link');
                    }else{
                        // swal("Error!", response.messages, "error");
                        $('.emailError').text(response.messages);
                        $('#resetBtn').text('Request reset password link');
                    }
                },
                error : function(error,xhr){
                    console.log(error);
                    // swal("Error!", "Something went wrong", "error");
                    Swal.fire({
                        icon: "error",
                        title: "Error to send email",
                        text: xhr.responseText,
                        });

                    $('#resetBtn').text('Request reset password link');
                }
            })
        })

       

    });

   
    $('#backBtn').click(function(){
        window.location.href = '/login';
    });

    function checkEmail(email){
        window.location.href = 'mailto:' + email;
        }
</script>
@endsection