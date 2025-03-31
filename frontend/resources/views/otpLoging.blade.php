@extends('layouts.userRegLayouts')
@section('content')
<section class="signin-form-main" id="signin-form-main">
            
    <div class="container-lg  mt-5">
        <div class="row justify-content-center align-item-center">
            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-8 ">
                
                <img src="{{URL('images/Select-bro.svg')}}" alt="signin-form-main" class="img-fluid ">
            </div>
            <div class="col-xl-5 col-lg-8 col-md-8  pt-3 ">
                <div class="container">
                    <h4 class="h4 m-0  mb-2">Enter an OTP Number</h4>
                    <p >Enter OTP number which is sent your mobile.</p>
                </div>


                <div class="container pt-5">
                    <form class="otpForm" id="otpForm">
                        <label for="user_id" type="hidden" value={{ $user_id }} id="user_id"></label>
                        <label for="otp" class="form-label">OTP Code</label>
                        <div class="col-lg-10 col-xl-11">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control py-2" class="otp" id="otp" placeholder="Enter OTP code here...">

                            </div>
                        </div>
                    {{-- <div class="row">
                    <!-- Create 5 input fields for OTP -->
                    <input type="text" class="form-control otp-input" maxlength="1" id="otp1" required>
                    <input type="text" class="form-control otp-input" maxlength="1" id="otp2" required>
                    <input type="text" class="form-control otp-input" maxlength="1" id="otp3" required>
                    <input type="text" class="form-control otp-input" maxlength="1" id="otp4" required>
                    <input type="text" class="form-control otp-input" maxlength="1" id="otp5" required>
                    </div> --}}
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <p id="timer" class="mt-2">Resend OTP in <span id="countdown">01:00</span></p>
                                <!-- <span class="input-group-text" id="basic-addon1">@</span> -->
                                <!-- <input type="email" class="form-control " placeholder="Enter your email Address" aria-label="email" aria-describedby="basic-addon1">-->
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <button class="btn user btn w-100 mb-2" type="submit">Verify Code</button>
                        <!-- <button type="button" class="btn w-100" data-bs-toggle="button">Cancel</button>-->
                        </div>

                        </form>
                        

            
                </div>
                
                
            </div>
        </div>
    </div>
</section>

<script src="" async defer></script>

<!-- Add Bootstrap JS and Popper.js scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";

$(document).ready(function(){
    
    $('#otpForm').submit(function(e){
        e.preventDefault();
        var formData = document.getElementById('otp').value;
        var formDataJson = {
            "otp": formData,
            "user_id": {{ $user_id }}
        };
        
        var data = $(this).serialize();
        //console.log(document.getElementById('user_id').value)
        console.log(formDataJson);

        $.ajax({
        url:baseUrl+'/api/otp/verify',
        type:'POST',
        data : formDataJson,
        success:function(response){
            if(response.status==200){
                // swal('Good',response.message,"success");
                // window.location.href = '/freeAd1';
                //console.log(response);
                sessionStorage.setItem('token',response.access_token);

                    
                    let timerInterval;
                        Swal.fire({
                        title: "Login Successfull!",
                        html: "Return to Home Page ",
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
                            window.location.href = "/";
                        }
                        });
                
            }else{
                
                Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response.message + "Error ggg",
                        });
            }
        },
        error:function(xhr, status, error,response){
            Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: xhr.responseText,
            });
        }
    })
    })

    
});
</script>
@endsection