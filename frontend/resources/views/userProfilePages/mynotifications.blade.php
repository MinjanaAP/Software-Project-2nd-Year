@extends('layouts.userProfileLayouts')
@section('content')

<section class="my-profile mt-5 " id="my-profile">
    <div class="container-lg mt-3">
        <div class="row justify-content-center align-items-start">

            <!-- ----------left side------------>
            {{-- Mobile view --}}
            <div class="profile d-flex d-sm-none align-items-start ms-3">
                <div class="profile-image me-3">
                </div>
                <div class="profile-info">
                    
                    <p class="user-name m-0 d-sm-none"></p>
                    <p class="redirect-login"></p>
                    
                </div>
            </div>
            
            <div class="col-sm-4 col-xl-3">
                
                @include('userProfilePages.sideNavBar')
                

            </div>

            <!-- ----------right side---------- -->
            <div class="col-sm-8 col-xl-8 col-12 d-sm-flex">
                {{-- <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                </div> --}}
                <div class="notifications" id="notifications"></div>
            </div>
            <!-- ----------right side end---------- -->

        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        
        $('#read').empty();
        $('#Notifications').addClass('activeTag');
        const token = sessionStorage.getItem('token');
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        $.ajax({
            url:baseUrl + '/api/my/getNotifications',
            type:'GET',
            headers:{
                "Authorization":"Bearer "+token
            },
            success:function(response){
                if (response.status == 200) {
                    if (response.data.length > 0) {
                        response.data.forEach((element, index) => {
                            var date = formatDate(element.created_at);
                            var showReportButton = element.status == 'danger';

                            var html = '<div class="alert alert-' + element.status + ' alert-dismissible fade show" role="alert">' +
                                        '<h6 class="alert-heading"><b>' + element.title + '</b></h6>' +
                                        '<p>' + element.message + '.</p>' +
                                        '<hr>' +
                                        '<div class="d-flex justify-content-between">' +
                                            '<p class="mb-0">' + date + '</p>' +
                                            '<button type="button" class="btn btn-outline-dark py-0 px-1" onclick="markAsRead('+element.id+')" id="markAsRead'+element.id+'">Mark as read</button>'+
                                        '</div>' +
                                        '<div class="read'+element.id+'" id="read"></div>'+
                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                    '</div>';

                            $('#notifications').append(html);
                        });

                        
                        
                    }

                    
                }else {
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error",
                        didClose: () => {
                            window.location.href = "/login";
                        }
                    });
                }
                
            },
            error:function(error){
                console.log(error);
            }

        }).then(()=>{
            if (sessionStorage.getItem('status') === 'banned') {
                            Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Your Account has been Banned."
                            });
                            sessionStorage.removeItem('token');
                        }
        })



        function formatDate(dateString) {
            // var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            // return new Date(dateString).toLocaleDateString(undefined, options);
            return new Date(dateString).toISOString().slice(0, 19).replace("T", " ") 
        }

        
    });

    function markAsRead(id){
            //alert(id);
            $('#markAsRead'+id).attr('disabled', true);
            $.ajax({
                url:baseUrl + '/api/my/report-mark-as-read',
                type:'POST',
                data:{
                    id:id
                },
                success:function(response){
                    if (response.status == 200) {
                        $('#markAsRead'+id).hide();
                        $('.read'+id).append('<p class="mb-0"><i class="bi bi-check2-all me-2"></i>Read</p>');
                    }else {
                        Swal.fire({
                            title: "Error",
                            text: response.message,
                            icon: "error",
                            didClose: () => {
                                location.reload();
                            }
                        });
                    }
                },
                error:function(error){
                    console.log(error);
                }
            })
        }
</script>
@endsection