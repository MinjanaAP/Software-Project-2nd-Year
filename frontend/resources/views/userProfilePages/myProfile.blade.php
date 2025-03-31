@extends('layouts.userProfileLayouts')
@section('content')

<section class="my-profile mt-5 " id="my-profile">
    <div class="container-lg mt-3">
        <div class="row justify-content-center align-items-center">

            <!-- ----------left side------------>
            {{-- Mobile view --}}
            <div class="profile d-flex d-sm-none align-items-center ms-3">
                <div class="profile-image me-3">
                </div>
                <div class="profile-info">
                    
                </div>
            </div>
            
            <div class="col-sm-4 col-xl-3">
                
                @include('userProfilePages.sideNavBar')
                

            </div>

            <!-- ----------right side---------- -->
            <div class="col-sm-8 col-xl-8 col-12 d-sm-flex">
                <div class="container mt-3 d-none d-md-block">
                    <div class="heading d-flex flex-column justify-content-center align-items-center">
                        {{-- <h6 class="m-0">Welcome !!!</h6> --}}
                        <h4 class="user-name web h4 m-0">Welcome!!!</h4>
                        <p class="redirect-login"></p>
                        <button class="btn btn-outline-info" onclick="verifyEmail()" id="verifyEmailBtn"><i class="bi bi-check-circle me-2" ></i>Verify Your Email</button>
                        
                        <div id="successMessage"></div>
                        <span class="badge text-bg-info" id="verifiedTag"><i class="bi bi-check-circle-fill me-2"></i>Verified User</span>

                    </div>
                    <div class="container img col-12 col-md-8">
                        <img src="{{URL('image/userProfileMainImg.svg')}}"  class="img" alt="signin-form-main">
                    </div>
                </div>
            </div>
            <!-- ----------right side end---------- -->

        </div>
    </div>
</section>
<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
    function verifyEmail(){
        const token = sessionStorage.getItem('token');

        $.ajax({
            url : baseUrl + '/api/auth/verify-email',
            type : 'POST',
            headers: {
                "Authorization": "Bearer " + token
            },
            success : function(response){
                console.log(response);
                if(response.status === 200){
                    $('#verifyEmailBtn').hide();
                    $('#successMessage').append(`<span class="text-success"><i class="bi bi-check2-circle me-2"></i>${response.message}</span>`);
                }
            },
            error : function(error){
                console.log(error);
            }
        })
    }

    $(document).ready(function() {
        $('#verifyEmailBtn').hide();
        $('#verifiedTag').hide();


        const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            const message = urlParams.get('message');

            if (status && message) {
                Swal.fire({
                    icon: status === 'success' ? 'success' : 'error',
                    title: status === 'success' ? 'Success' : 'Error',
                    text: message,
                    confirmButtonColor: '#007bff',
                    textColor: '#000'
                }).then((result) => {
                    
                });
            } 

        
        });
</script>    
@endsection