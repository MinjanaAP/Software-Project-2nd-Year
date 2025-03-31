@extends('layouts.userProfileLayouts')
@section('content')

<section class="my-profile mt-5 " id="my-profile">
    <div class="container-lg mt-3">
        <div class="row justify-content-center align-items-start">

            <!-- ----------left side------------>
            <div class="profile d-flex d-sm-none align-items-center ms-3">
                <div class="profile-image me-3">
                </div>
                <div class="profile-info">
                    <p class="user-name m-0  d-sm-none">Welcome!!!</p>
                </div>
            </div>
            
            <div class="col-sm-4 col-xl-3">
                
                @include('userProfilePages.sideNavBar')
                

            </div>

            <!-- ----------right side---------- -->
            <div class="accordion-body col-sm-8 col-xl-8 col-12 mb-5" id="adsContainer" >
                <div class="container empty-ads mt-3">
                    <div class="heading d-flex flex-column justify-content-center align-items-center">
                        {{-- <h6 class="m-0">Welcome !!!</h6> --}}
                        <h4 class="emptyads-title web h4 m-0">You have not add any favourite Ad.</h4>
                        
                    </div>
                    <div class="container img col-12 col-md-8">
                        <img src="{{URL('image/userProfileImages/emptyAds.svg')}}"  class="img" alt="signin-form-main">
                    </div>
                </div>
                <div class="spinner-border text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                


                
            </div>
            <!-- ----------right side end---------- -->

        </div>
    </div>
</section>
<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
    $(document).ready(function(){
        $('#favouriteAds').addClass('activeTag');

        $('.empty-ads').hide();
        function isLoggedIn() {
            return sessionStorage.getItem('token') !== null;
        }

        
        function getAccessToken() {
            return sessionStorage.getItem('token');
        }

        function getmyAds(){
            if(isLoggedIn()){
                const token = getAccessToken();

            $.ajax({
                url:baseUrl + '/api/FavouriteAds',
                type:'GET',
                headers:{
                    'Authorization':'Bearer'+token
                },

                success:function(response){
                    console.log(response);
                    $('#adsContainer').empty();
                    
                    // Iterate over the response data and append ads
                    
                        // const adHTML = `
                        //     <div class="card">
                        //         <div class="card-body">
                        //             <h5 class="card-title">${ad.title}</h5>
                        //             <p class="card-text">Price: ${ad.price}</p>
                        //             <img src="${ad.image_1}" class="card-img-top" alt="Ad Image">
                        //         </div>
                        //     </div>
                        // `;
                        if (response && response.data && response.data.length > 0) {
            response.data.forEach(item => {
                if(item.negotiable == 'true'){
                    item.negotiable = 'Negotiable';
                } else {
                    item.negotiable = '';
                }
                var adHTML =  '<div class="viewAds p-2">' +
                                            '<div class="viewAd img">' +
                                            '<img class="rounded mx-auto d-block" width="200px" height="200px" src="' + item.image_1 + '" alt="jj">' +
                                            '</div>' +
                                                '<div class="adDetails my-2 p-2">' +
                                                    '<span class="badge text-bg-success mt-1 mb-2" id="status">'+ item.status +'</span>' +
                                                    '<div class="row mb-0">' +
                                                        '<div class="col-6 d-flex  justify-content-between ">' +
                                                            '<h4 class="itemPrice fw-bold" id="price"> LKR.' + item.price + '</h4>' +
                                                            '<div>' +
                                                                '<span class="badge text-bg-warning me-3 ms-1 ">' + item.negotiable +'</span>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>' +
                                                    '<div class="d-flex">'+
                                                    '<h4 class="itemTitle fw-bold me-2" id="title">' +item.brand+' '+ item.title + '</h4>' +
                                                    '<span class="badge text-bg-secondary mt-1 mb-2" id="status">'+ item.condition +'</span>' +
                                                    '</div>' +
                                                    '<p class="itemLocation text-secondary"><i class="bi bi-geo-alt-fill me-2"></i>' + item.town + '</p>' +
                                                    '<button type="button" class="btn w-100" onclick="viewAd(' + item.id + ', \'' + item.status + '\')"> View Ad <i class="bi bi-arrow-right-short ms-2"></i></button>' +
                                                '</div>' +
                                            '</div>';
                $('#adsContainer').append(adHTML);
            });
        } else {
            // No ads to display
            //!$('#adsContainer').html('<p>No ads found.</p>');
        }
                },
                error: function(xhr, status, error) {
                    console.error('Token validation failed');
                    console.error(xhr.responseText);

                    $('.empty-ads').show();
                    $('.spinner-border').hide();
                    //sessionStorage.removeItem('token');
                    // window.location.href = '/login'; 
                }
            })
            }else{
                Swal.fire({
                title: "You're not logged in!",
                text: "Please log in to view this page.",
                icon: "question"
                });
            setTimeout(() => {
                window.location.href = "/my/profile";
            }, 2000);
            }

        }
    getmyAds();
    });

    function viewAd(itemId, status) {
        if (status === 'pending') {
            Swal.fire({
                title: 'Ad is pending',
                text: 'This ad is currently pending approval.',
                footer: '<a href="#">Get Admin Support</a>',
                icon: 'info'
            });
        } else if (status === 'blocked') {
            Swal.fire({
                title: 'Ad is blocked',
                text: 'This ad has been blocked and cannot be viewed.',
                icon: 'error',
                footer: '<a href="#">Get Admin Support</a>',
            });
        } else {
            window.location.href = `/productPage1/${itemId}`;
        }
    }
</script>
@endsection

