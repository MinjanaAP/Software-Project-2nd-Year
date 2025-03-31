@extends('layouts.userProfileLayouts')
@section('content')

<section class="my-profile mt-5 " id="my-profile">
    <div class="container-lg mt-3">
        <div class="row justify-content-center ">

            <!-- ----------left side------------>
            <div class="profile d-flex d-sm-none align-items-center ms-3">
                
            </div>
            
            <div class="col-sm-4 col-xl-3">
                
                @include('userProfilePages.sideNavBar')
                

            </div>

            <!-- ----------right side---------- -->
            <div class="col-sm-8 col-xl-8 col-12 d-sm-flex">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="card-header ">My Profile</div>
                        <div class="row g-0 mt-3">
                            <div class="col-md-4 d-none d-md-block">
                            <img src="{{URL('images/profile.png')}}" class="img-fluid rounded-start" id="profile-photo" alt="...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <small class="text-body-secondary">Username : </small>
                                <h6 class="card-title" id="user-name"></h6>

                                <small class="text-body-secondary">Email : </small>
                                <h6 class="card-title" id="user-email"></h6>

                                <small class="text-body-secondary">Phone : </small>
                                <h6 class="card-title" id="user-phone"></h6>
                                
                                <div class="container d-flex flex-column justify-content-center align-items-center">
                                    <button class="btn bg-warning  col-8 mb-2" id="logout-btn">log out</button>
                                    <button class="btn bg-danger col-8" id="delete-btn">delete account</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- ----------right side end---------- -->

        </div>
    </div>
</section>
<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
    $(document).ready(function(){
        $('#myProfile').addClass('activeTag');

        function isLoggedIn() {
    return sessionStorage.getItem('token') !== null;
}
        if (!isLoggedIn()) {
            Swal.fire({
            title: "You're not logged in!",
            text: "Please log in to view this page.",
            icon: "question"
            });
            setTimeout(() => {
                window.location.href = "/my/profile";
            }, 2000);
            
        }
        
        $('#logout-btn').click(function() {
            Swal.fire({
                title: "Are you sure you want to log out?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    const token = sessionStorage.getItem('token');
                    $.ajax({
                        url : baseUrl+'/api/auth/logout',
                        type : 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token 
                        },
                        success : function(){
                            sessionStorage.removeItem('token');
                            Swal.fire({
                        title: "Logged out successfully!",
                        icon: "success"
                        });
                        setTimeout(() => {
                            window.location.href = "/";
                        }, 2000);
                        },
                        error:function(xhr, status, error){
                            Swal.fire({
                                title: "Error",
                                text: xhr.responseText,
                                icon: "error"
                            });
                        }
                    })
                }
            });
        });

        $('#delete-btn').click(function() {
            Swal.fire({
                title: "Are you sure you want to delete your account?",
                text: "This action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    const token = sessionStorage.getItem('token');
                    $.ajax({
                        url : baseUrl+'/api/auth/delete',
                        type : 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + token 
                        },
                        success : function(){
                            sessionStorage.removeItem('token');
                            Swal.fire({
                            title: "Account deleted successfully!",
                            icon: "success"
                        });
                        setTimeout(() => {
                            window.location.href = "/";
                        }, 2000);
                        },
                        error:function(xhr, status, error){
                            Swal.fire({
                                title: "Error",
                                text: xhr.responseText,
                                icon: "error"
                            });
                        }
                    })
                }
                });
            }); 
    });


        

        
</script>
@endsection

