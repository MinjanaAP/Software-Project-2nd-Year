@extends('layout')
        @section('header')
        @parent
        @endsection

        @section('content')

        <div class="container-lg">
                <div class="row d-flex justify-content-between">
                        <div class="col-d-block col-sm-4 col-md-7 col-lg-7">
                                <div id="carouselExampleIndicators" class="carousel slide mt-4">
                                        <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                        </div>
                                        <div class="carousel-inner rounded-5 shadow-4-strong">
                                        <div class="carousel-item active">
                                        <img src="{{$free_ad['image_1']}}" class="d-block w-100" alt="Edition-page" id="ad-image">
                                        </div>
                                        <div class="carousel-item">
                                        <img src="{{$free_ad['image_2']}}" class="d-block w-100" alt="Edition-page" id="ad-image" >
                                        </div>
                                        <div class="carousel-item">
                                        <img src="{{$free_ad['image_3']}}" class="d-block w-100" alt="Edition-page" id="ad-image">
                                        </div>
                                        <div class="carousel-item">
                                        <img src="{{$free_ad['image_4']}}" class="d-block w-100" alt="Edition-page" id="ad-image">
                                        </div>
                                        <div class="carousel-item">
                                        <img src="{{$free_ad['image_5']}}" class="d-block w-100" alt="Edition-page" id="ad-image">
                                        </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                        </button>
                                </div>
                                <div class="row m-2">
                                        <div class="col-12 col-sm-6 d-flex  justify-content-between">
                                                <div class="d-flex">
                                                        <h6 class="text-secondary d-flex"><i class="bi bi-clock-fill px-1"> </i>{{ \Carbon\Carbon::parse($free_ad['created_at'])->format('Y-m-d') }}</h6>
                                                        <h6 class="text-secondary px-2 d-flex"><i class="bi bi-geo-alt-fill px-1"></i>{{$free_ad['town']}}</h6>
                                                        <h6 class="text-secondary px-2 d-flex"><i class="bi bi-eye-fill px-1"></i>{{$free_ad['view_count']}}</h6>
                                                </div>
                                         </div>
                                        <div class="col-6 d-flex  justify-content-end">
                                        
                                        <button type="button" class="btn btn-favorite" data-ad-id="{{ $free_ad['id'] }}" aria-pressed="false" autocomplete="off">
                                                Add Favourite<i class="bi bi-heart px-2"></i>
                                        </button>
                                        <button type="button" class="btn btn-share" data-toggle="button" aria-pressed="false" autocomplete="off">
                                                Share<i class="bi bi-share-fill px-2"></i>
                                        </button>

                                        </div>
                                </div>
                                
                        </div>
                       

                        <div class="col-d-block col-sm-2 col-md-5 col-lg-4 ">
                                <div class="d-block productRightUp my-4 ">
                                        <h4 class="productTitle fw-bold"> {{$free_ad['brand']}} {{$free_ad['title']}}</h4>
                                        <h4 class="productPrice fw-bold py-1">Rs. {{ number_format($free_ad['price'], 0, '', ',') }}</h4>                                        <p class="text-success ">
                                                @if($free_ad['negotiable'] == 'true')
                                                        (Negotiable)
                                                
                                                @endif
                                        </p>
                                </div>


                                <div class="productRightDown d-block my-4 p-3 ">
                                        <h6 class="text-center fw-bold">Seller Information</h6>
                                        <hr>
                                        <div class="row">
                                                <div class="userImg col-3 d-flex justify-content-center align-items-center mb-2">
                                                        @if($free_ad['user']['profile_image'])
                                                                <img src="{{ $free_ad['user']['profile_image'] }}" height="75px" width="75px" id="profile-img" alt="mobile-free-ad" class="rounded-circle">
                                                        @else
                                                                <img src="{{URL('images/profile.png')}}" height="75px" width="75px" id="profile-img" alt="mobile-free-ad" class="rounded-circle">
                                                        @endif
                                                </div>
                                                <div class="user-details col-9 d-flex flex-column justify-content-start align-items-center">
                                                        <button class="btn btn-secondary w-100 py-2 d-flex justify-content-center align-items-center" id="user-details-btn">
                                                                <div class="col-8 d-flex align-items-center justify-content-start">
                                                                        <i class="bi bi-person-circle mx-2"></i>
                                                                        <h6 class="text-center  m-0">{{$free_ad['user']['first_name']}}</h6>
                                                                </div>
                                                        </button>
                                                        @if($free_ad['user']['status'] === 'verify')
                                                        <div class="col-12 verify-badge d-flex justify-content-center mt-2">
                                                                <div class="col-xl-8 col-lg-10 col-md-10 col-sm-8 col-8 d-flex align-items-center px-2">
                                                                        <span class="verify-badge-tag py-0"><img src="{{URL('image/verify-shield.png')}}" height="18px" width="18px" class="me-2" >Verified User</span>
                                                                </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                                                                <button class="btn btn-secondary w-100 my-2  d-flex justify-content-center" id="user-details-btn">
                                                                        <div class="col-8 d-flex align-items-center justify-content-start">
                                                                                <i class="bi bi-telephone-fill mx-2"></i><h6 class=" m-0">{{$free_ad['user']['telephone_no_1']}}</h6>
                                                                        </div>
                                                                </button>
                                                                @if($free_ad['user']['town'])
                                                                        <button class="btn btn-secondary w-100  d-flex justify-content-center" id="user-details-btn">
                                                                                <div class="col-8 d-flex align-items-center justify-content-start">
                                                                                        <i class="bi bi-geo-alt-fill mx-2"></i><h6 class=" m-0">{{$free_ad['user']['town']}}</h6>
                                                                                </div>
                                                                        </button>
                                                                @endif
                                                        </div>
                                                </div>
                                        </div>
                                        
                                        <!-- <div class="text-center">
                                                <button type="button" class="btn w-50 my-2 email" > <i class="bi bi-envelope-fill ms-2 mx-2"></i>Email to seller</button>
                                        </div> -->
                                </div>
                                
                                
                                <div class="d-flex justify-content-center m-0 ">
                                        <button type="button" class="btn w-100 my-2 bargain" onclick="bargainAdNavigate({{$free_ad['id']}})" id="addBargainBtn"> <i class="bi bi-bookmark-plus-fill ms-2 mx-2"></i>Add Bargain Price</button>
                                        <button type="button" class="btn w-100 my-2 bargain" onclick="viweInAdminPanel({{$free_ad['id']}})" id="viewInAdminPanelBtn"> <i class="bi bi-arrow-return-left  ms-2 mx-2"></i>View in Admin Panel</button>
                                </div>
                                <div id="alertPlaceholder" class="d-flex justify-content-center m-0"></div>

                        </div>
                </div>

                <div class="row d-flex justify-content-between">  
                        <div class="col-d-block col-sm-4 col-md-7 col-lg-7">
                                <h4 class="fw-bold ">Specification</h4>
                                <hr>
                                        
                                <div class="text-center">

                                                    <div class="row ">
                                                        @if($free_ad['sub_category'] == 'Mobile phones' || $free_ad['sub_category'] == 'Mobiles' || $free_ad['sub_category'] == 'Laptops' || $free_ad['sub_category'] == 'Computers' || $free_ad['sub_category'] == 'Laptops' || $free_ad['sub_category'] == 'Tvs' || $free_ad['sub_category'] == 'Home Appliances' || $free_ad['sub_category'] == 'Home security' || $free_ad['sub_category'] == 'Cameras' || $free_ad['sub_category'] == 'Sounds' )
                                                                @foreach($features as $key => $value)
                                                                        <div class="col-12 col-sm-6">
                                                                                <div class="pSpec py-2 px-2 m-2">  
                                                                                    <div class="row">
                                                                                            <div class="col d-flex justify-content-start mt-2">
                                                                                                    <p class="fw-bold text-start">{{ ucfirst(str_replace('_', ' ', $key)) }}</p>
                                                                                            </div>
                                                                                            <div class="col d-flex justify-content-end mt-2">
                                                                                                    <p class="text-end">{{ $value }}</p>
                                                                                            </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                @endforeach
                                                        

                                                        @endif

                                                                                                           
                                                    </div>
                                </div>

                                <h4 class="fw-bold mt-2">Description</h4>
                                <hr>
                                <p>{{$free_ad['description']}}</p>
                                
                                <div class="row mt-5">
                                        <div class="col-d-block col-lg-6">
                                                <h6 class="text-center fw-bold">Rate this Ad</h6>
                                                <hr>
                                                <div class="height-100 container d-flex justify-content-center align-items-center">
                                                        <div class="card p-3">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                        <!-- Ratiing function design -->
                                                                        <div class="rating-css">
                                                                                <div class="star-icon">
                                                                                <!-- <input type="radio" value="1" name="product_rating" id="rating1">
                                                                                <label for="rating1" class="fa fa-star"></label>
                                                                                <input type="radio" value="2" name="product_rating" id="rating2">
                                                                                <label for="rating2" class="fa fa-star"></label>
                                                                                <input type="radio" value="3" name="product_rating" id="rating3">
                                                                                <label for="rating3" class="fa fa-star"></label>
                                                                                <input type="radio" value="4" name="product_rating" id="rating4">
                                                                                <label for="rating4" class="fa fa-star"></label>
                                                                                <input type="radio" value="5" name="product_rating" id="rating5">
                                                                                <label for="rating5" class="fa fa-star"></label> -->

                                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                                                <input type="radio" value="{{ $i }}" name="product_rating" id="rating{{ $i }}">
                                                                                                <label for="rating{{ $i }}" class="fa fa-star" id="star{{ $i }}"></label>
                                                                                        @endfor
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <button id="submit-rating" class="btn btn-rating mt-3" data-ad-id="{{ $free_ad['id'] }}">Submit Rating</button>
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="col-d-block col-lg-6">
                                                <button type="button" class="btn w-100 btn-link" onclick="reportAd()"><i class="bi bi-slash-circle ms-2 mx-2"></i>Report this Ad</button>

                                            </div>
                                </div>           
                        </div> 
                        
                        <!-- <div class="verticalAdPP col-d-none col-lg-5">
                                <div class="verticalAdPP text-center my-2 ">
                                        <img src="{{URL('images/VBanAd.jpg')}}" class="verticalAdPPImg" height="600px" width="50%" class="" alt="signin-form-main">
                                </div>
                                <div class="verticalAd1 text-center my-2 ">
                                        <img src="{{URL('images/VBanAd.jpg')}}" height="600px" width="50%" class="" alt="signin-form-main">
                                </div> 
                        </div>      -->
                        
                        
                        <div class="d-none col-sm-2 col-md-5 col-lg-4 d-sm-block justify-content-center align-items-center ">
                                <div class="verticalAdPP " id="verticalAd">

                                        <div class="verticalAdPP1 ">
                                                <div id="data-container3" class="verticalAdPP1"> </div>
                                        </div>

                                        <!-- <div class="verticalAdPP2 mb-2">
                                                <div id="data-container4" class="verticalAdPP2"> </div>
                                        </div>  -->

                                </div>

                        </div>

                        <!-- <div class="container-lg">
                                <div class="horizonBanAdBottomPP m-0">
                                        <div id="data-container6" class=""> </div>
                                </div>
                        </div> -->


                </div>



                <div class="container-lg">
                        <h4 class="adTopic fw-bold mt-3">Similar Ads</h4>
                        <hr>
                        <div id="allad-container-alert" class=""></div>
                        <div id="allad-container" class="data-containerAd"></div>
                        <div id="pagination-container" class="pagination d-flex justify-content-center my-3"></div>
                </div>

                <div class="container-lg">
                        <h4 class="adTopic fw-bold mt-3">More Ads In This Category</h4>
                        <hr>
                        <div id="categoryad-container-alert" class=""></div>
                        <div id="categoryad-container" class="data-containerAd"> </div>
                        <div id="pagination-container-categoryad" class="pagination d-flex justify-content-center my-3"></div>

                </div>

                </div>

                
        </div>




    


<script>
var baseUrl = "{{ env('APP_BASE_URL') }}";

        const role = sessionStorage.getItem('role');
        if(role != 'user'){
                $('#viewInAdminPanelBtn').show();
        }else{
                $('#viewInAdminPanelBtn').hide();
        }
//basuru
function bargainAdNavigate(itemId) {
    const token = sessionStorage.getItem('token');
    if(token){
        window.location.href = `/bargainAd/${itemId}`;
    } else {
        // Display the alert message below the button
        const alertPlaceholder = document.getElementById('alertPlaceholder');
        alertPlaceholder.innerHTML = `
            <div class="alert alert-danger w-100 my-2 position-relative" role="alert" style="position:relative; padding-right:40px;">
                <strong>Access Denied!</strong> You cannot access this. Please login to your account.
                <span onclick="this.parentElement.style.display='none';" style="position:absolute; top:10px; right:10px; color:#fff; cursor:pointer; font-size:20px;">&times;</span>
            </div>
        `;
    }
}

function viweInAdminPanel(itemId){
        window.location.href = `/admin/freeAdsEdit/${itemId}`;
}
        

$(document).ready(function(){
    
    var user_ids = @json($user_ids);
    var rated_users = @json($rated_users);
    
    console.log(rated_users);

    const role = sessionStorage.getItem('role');
    if(role && role != 'user'){
        $('#addBargainBtn').hide();
    }

    const token = sessionStorage.getItem('token');
    const favoriteButton = $('.btn-favorite'); // Select the favorite button

    $.ajax({
        url: baseUrl + '/api/auth/validate_token',
        type: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        success: function(response) {
            var logedUSerId = response.user.id;

            if (user_ids) {
                if (user_ids.includes(response.user.id)) {
                    console.log("Logged user is in the favourite list");
                    favoriteButton.css('background-color', 'yellow');
                } else {
                    console.log("Logged user is NOT in the favourite list");
                    favoriteButton.css('background-color', 'blue'); 
                }
            }

            if (rated_users) {
                var stars = isUserRated(rated_users, logedUSerId);
                if (stars !== null) {
                    console.log("User has already rated: " + stars);
                    for (var i = 1; i <= stars; i++) {
                        var star = document.getElementById('star' + i);
                        if (star) {
                                if(stars ){
                                        star.style.color = 'yellow';
                                }else{
                                        star.style.color = 'gray';
                                }
                        }
                    }
                } else {
                    console.log("User has not rated yet.");
                    for (var i = 1; i <= 5; i++) {
                        var star = document.getElementById('star' + i);
                        if (star) {
                            star.style.color = 'gray';
                        }
                    }
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('Token validation failed');
        }
    });

        function isUserRated(ratedUsers, userId) {
                for (var i = 0; i < ratedUsers.length; i++) {
                        if (ratedUsers[i].user_id == userId) {
                                return ratedUsers[i].stars;
                        }
                }
                return null; 
        }

        //------new

        $('.star-icon label').hover(
        function() {
            var onStar = parseInt($(this).attr('for').substr(6)); // The star currently hovered
            $(this).parent().children('label').each(function(e) {
                if (e < onStar) {
                    $(this).css('color', '#ffe400');
                } else {
                    $(this).css('color', 'gray');
                }
            });
        }, function() {
            $(this).parent().children('label').each(function(e) {
                var rating = $('input[name="product_rating"]:checked').val();
                if (rating) {
                    if (e < rating) {
                        $(this).css('color', '#ffe400');
                    } else {
                        $(this).css('color', 'gray');
                    }
                } else {
                    $(this).css('color', 'gray');
                }
            });
        }
    );
//----end



                //basuru
                var freeAdTitle = @json($free_ad['title']);
                //console.log(freeAdTitle);

                var freeAdBrand = @json($free_ad['brand']);
                //console.log(freeAdBrand);

                var subCategory = @json($free_ad['sub_category']);

                var freeAdId = @json($free_ad['id']);


                var data = {
                        title: freeAdTitle,
                        brand: freeAdBrand,
                        id: freeAdId,
                        sub_category: subCategory
                };

                var currentPage = 1;
                console.log(data);

                function fetchAds(page) {
                        $.ajax({
                        url: baseUrl + '/api/getAdsByTitleAndBrand?page=' + page,
                        type: 'GET',
                        contentType: 'application/json',
                        data: data, 
                        success: function(response) {
                                console.log(response);
                                if(response.status === 200) {
                                        if(response.data.data.length == 0){
                                        
                                                $('#allad-container-alert').empty();
                                                $('#allad-container-alert').append(`<div class="alert alert-secondary" role="alert"> Sorry, there are no similar ads available at the moment. </div>`);

                                        }
                                $('#allad-container').empty();
                                displayAds(response.data.data);
                                setupPagination(response.data);
                                } else {
                                $('#allad-container-alert').append(`<div class="alert alert-secondary" role="alert"> An Error Occurs While Retrieving Similiar ads </div>`);
                                }
                        },
                        error: function(xhr) {
                                console.log(xhr.responseText);
                        }
                        });
                }


                function displayAds(ads) {
                ads.forEach(function(item) {
                var itemDate = formatDate(item.created_at);
                if(item.negotiable == 'true'){
                    item.negotiable = 'Negotiable';
                } else {
                    item.negotiable = '';
                }
                var html =
                    '<div class="viewAds p-2">' +
                        '<div class="viewAd img">' +
                        '<img class="rounded mx-auto d-block" width="200px" height="200px" src="' + item.image_1 + '" alt="jj">' +
                        '</div>' +
                        '<div class="adDetails my-2 p-2">' +
                            '<span class="badge text-bg-success mt-1 mb-2">Latest</span>' +
                            '<div class="row mb-0">' +
                                '<div class="col-12 d-flex justify-content-start">' +
                                    '<h4 class="itemPrice fw-bold" id="price"> LKR.' + item.price + '</h4>' +
                                    '<div>' +
                                        '<span class="badge text-bg-warning me-3 ms-1">' + item.negotiable + '</span>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="d-flex">' +
                                '<h4 class="itemTitle fw-bold me-2" id="title">' + item.brand + ' ' + item.title + '</h4>' +
                                '<span class="badge text-bg-secondary mt-1 mb-2" id="status">' + item.condition + '</span>' +
                            '</div>' +
                            '<div class="row mb-0">' +
                                '<div class="d-flex justify-content-between">'+
                                        '<p class="itemLocation text-secondary"><i class="bi bi-geo-alt-fill me-1"></i>' + item.town + '</p>' +
                                        '<p class="itemLocation text-secondary">' + itemDate + '</p>' +
                                '</div>'+
                        '</div>'+
                            '<button type="button" class="btn w-100" onclick="viewAd(' + item.id + ')"> View Ad <i class="bi bi-arrow-right-short ms-2"></i></button>' +
                        '</div>' +
                    '</div>';

                $('#allad-container').append(html);
            });
        }

        function formatDate(date){
                return moment(date).fromNow();
        }

        function setupPagination(data) {
        $('#pagination-container').empty();

        if (data.total > 0) {
                // Add "First" page link
                if (data.current_page > 1) {
                $('#pagination-container').append('<a href="#" class="page-link first-page-link d-none d-md-inline" data-page="1">First</a>');
                } else {
                $('#pagination-container').append('<a href="#" class="page-link first-page-link d-none d-md-inline disabled" tabindex="-1" aria-disabled="true">First</a>');
                }

                // Add "Previous" page link
                if (data.current_page > 1) {
                $('#pagination-container').append('<a href="#" class="page-link" data-page="' + (data.current_page - 1) + '"><span class="d-none d-md-inline">&laquo; Previous</span><span class="d-inline d-md-none">&laquo;</span></a>');
                } else {
                $('#pagination-container').append('<a href="#" class="page-link disabled" tabindex="-1" aria-disabled="true"><span class="d-none d-md-inline">&laquo; Previous</span><span class="d-inline d-md-none">&laquo;</span></a>');
                }

                // Add page number links
                for (var i = 1; i <= data.last_page; i++) {
                var activeClass = (i === data.current_page) ? 'active' : '';
                $('#pagination-container').append('<a href="#" class="page-link ' + activeClass + '" data-page="' + i + '">' + i + '</a>');
                }

                // Add "Next" page link
                if (data.current_page < data.last_page) {
                $('#pagination-container').append('<a href="#" class="page-link" data-page="' + (data.current_page + 1) + '"><span class="d-none d-md-inline">Next &raquo;</span><span class="d-inline d-md-none">&raquo;</span></a>');
                } else {
                $('#pagination-container').append('<a href="#" class="page-link disabled" tabindex="-1" aria-disabled="true"><span class="d-none d-md-inline">Next &raquo;</span><span class="d-inline d-md-none">&raquo;</span></a>');
                }

                // Add "Last" page link
                if (data.current_page < data.last_page) {
                $('#pagination-container').append('<a href="#" class="page-link last-page-link d-none d-md-inline" data-page="' + data.last_page + '">Last</a>');
                } else {
                $('#pagination-container').append('<a href="#" class="page-link last-page-link d-none d-md-inline disabled" tabindex="-1" aria-disabled="true">Last</a>');
                }

                // Handle click event for page links
                $('.page-link').on('click', function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                if (!$(this).hasClass('disabled')) {
                        fetchAds(page);
                }
                });
        }
        }

      fetchAds(currentPage); 
      
      //basuru
      function selectCategory(pageNumber) {
                var category = @json($free_ad['sub_category']);
                var id = @json($free_ad['id']);
                $.ajax({
                        url: baseUrl +'/api/getSubCategoryAdsForProductPage/' + category + '?page=' + pageNumber,
                        type: 'GET',
                        data: {id:id}, 
                        success: function(response) {
                        console.log(response);
                        if(response.status === 200) {
                                $('#categoryad-container').empty();
                                var ads = response.data.data;
                                setupPaginationForCategory(response.data);
                                if(response.data.data.length == 0){
                                        
                                        $('#categoryad-container-alert').empty();
                                        $('#categoryad-container-alert').append(`<div class="alert alert-secondary" role="alert"> Sorry, there are no more ads available in this Category at the moment. </div>`);

                                }

                                ads.forEach(function(item) {
                                var itemDate = formatDate(item.created_at);
                                var negotiableText = item.negotiable === 'true' ? 'Negotiable' : '';
                                var html =
                                '<div class="viewAds p-2">' +
                                        '<div class="viewAd img">' +
                                        '<img class="rounded mx-auto d-block" width="200px" height="200px" src="' + item.image_1 + '" alt="jj">' +
                                        '</div>' +
                                                '<div class="adDetails my-2 p-2">' +
                                                '<div class="row mb-0">' +
                                                        '<div class="col-12 d-flex  justify-content-start ">' +
                                                                '<h4 class="itemPrice fw-bold" id="price"> LKR.' + item.price + '</h4>' +
                                                                '<div>' +
                                                                        '<span class="badge text-bg-warning me-3 ms-1 ">' + negotiableText + '</span>' + // Corrected negotiable text
                                                                '</div>' +
                                                        '</div>' +
                                                '</div>' +
                                                '<div class="d-flex">'+
                                                        '<h4 class="itemTitle fw-bold me-2" id="title">' + item.brand + ' ' + item.title + '</h4>' +
                                                        '<span class="badge text-bg-secondary mt-1 mb-2" id="status">' + item.condition + '</span>' +
                                                '</div>' +
                                                '<div class="row mb-0">' +
                                                        '<div class="d-flex justify-content-between">'+
                                                                '<p class="itemLocation text-secondary"><i class="bi bi-geo-alt-fill me-1"></i>' + item.town + '</p>' +
                                                                '<p class="itemLocation text-secondary">' + itemDate + '</p>' +
                                                        '</div>'+
                                                '</div>'+
                                                '<button type="button" class="btn w-100" onclick="viewAd(' + item.id + ')"> View Ad <i class="bi bi-arrow-right-short ms-2"></i></button>' +
                                                '</div>' +
                                        '</div>';

                                $('#categoryad-container').append(html);
                                });
                        } else {
                                $('#categoryad-container-alert').append(`<div class="alert alert-secondary" role="alert"> An Error Occurs While Retrieving  ads </div>`);
                        }
                        },
                        error: function(xhr) {
                        console.log(xhr.responseText);
                        }
                });
                }

                function formatDate(date){
                        return moment(date).fromNow();
                }

                function setupPaginationForCategory(data) {
                $('#pagination-container-categoryad').empty();

                
                if (data.total > 0) {
                        // Add "First" page link
                        if (data.current_page > 1) {
                        $('#pagination-container-categoryad').append('<a href="#" class="page-link first-page-link d-none d-md-inline" data-page="1">First</a>');
                        } else {
                        $('#pagination-container-categoryad').append('<a href="#" class="page-link first-page-link d-none d-md-inline disabled" tabindex="-1" aria-disabled="true">First</a>');
                        }

                        // Add "Previous" page link
                        if (data.current_page > 1) {
                        $('#pagination-container-categoryad').append('<a href="#" class="page-link" data-page="' + (data.current_page - 1) + '"><span class="d-none d-md-inline">&laquo; Previous</span><span class="d-inline d-md-none">&laquo;</span></a>');
                        } else {
                        $('#pagination-container-categoryad').append('<a href="#" class="page-link disabled" tabindex="-1" aria-disabled="true"><span class="d-none d-md-inline">&laquo; Previous</span><span class="d-inline d-md-none">&laquo;</span></a>');
                        }

                        // Add page number links
                        for (var i = 1; i <= data.last_page; i++) {
                        var activeClass = (i === data.current_page) ? 'active' : '';
                        $('#pagination-container-categoryad').append('<a href="#" class="page-link ' + activeClass + '" data-page="' + i + '">' + i + '</a>');
                        }

                        // Add "Next" page link
                        if (data.current_page < data.last_page) {
                        $('#pagination-container-categoryad').append('<a href="#" class="page-link" data-page="' + (data.current_page + 1) + '"><span class="d-none d-md-inline">Next &raquo;</span><span class="d-inline d-md-none">&raquo;</span></a>');
                        } else {
                        $('#pagination-container-categoryad').append('<a href="#" class="page-link disabled" tabindex="-1" aria-disabled="true"><span class="d-none d-md-inline">Next &raquo;</span><span class="d-inline d-md-none">&raquo;</span></a>');
                        }

                        // Add "Last" page link
                        if (data.current_page < data.last_page) {
                        $('#pagination-container-categoryad').append('<a href="#" class="page-link last-page-link d-none d-md-inline" data-page="' + data.last_page + '">Last</a>');
                        } else {
                        $('#pagination-container-categoryad').append('<a href="#" class="page-link last-page-link d-none d-md-inline disabled" tabindex="-1" aria-disabled="true">Last</a>');
                        }

                        // Handle click event for page links
                        $('.page-link').on('click', function(e) {
                        e.preventDefault();
                        var page = $(this).data('page');
                        if (!$(this).hasClass('disabled')) {
                                selectCategory(page);
                        }
                        });
                }
                }
                selectCategory(1);
        })   





//basuru
    $(document).ready(function() {
        $.ajax({
            url: 'http://127.0.0.1:8008/api/get_latest_paid_ads',  
            type: 'GET',
            success: function(response) {
                if (response.status === 200) {
                    console.log(response.data);
                    displayAds(response.data);
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + xhr.responseText);
            }
        });

        function displayAds(ads) {
            var adsContainer = $('#adsContainer');
            adsContainer.empty(); 
            
            ads.forEach(function(ad) {

            
                var imageUrl =  ad.image; 
                if (ad.paid_ad_type === "figure_A") {
                var html =
                    '<div class="horizonBanAdTop mt-2">' +
                    '<a href="' + ad.url + '" target="_blank">' + // Wrap the image in an anchor tag
                    '<img src="' + imageUrl + '" class="img d-block w-100 horizonBanAdTop" alt="ad-image">' +
                    '</a>' +
                    '</div>';
                $('#data-container5').append(html);
                 }

                if (ad.paid_ad_type === "figure_B") {
                var html =
                    '<div class="verticalAd1 mb-2">' +
                    '<a href="' + ad.url + '" target="_blank">' + // Wrap the image in an anchor tag
                    '<img src="' + imageUrl + '" class="img d-block w-100 h-100 verticalAd1" alt="ad-image">' +
                    '</a>' +
                    '</div>';
                $('#data-container3').append(html);
                 }

                if (ad.paid_ad_type === "figure_C") {
                var html =
                    '<div class="verticalAd2 mb-2">' +
                    '<a href="' + ad.url + '" target="_blank">' + // Wrap the image in an anchor tag
                    '<img src="' + imageUrl + '" class="img d-block w-100 h-100 verticalAd2" alt="ad-image">' +
                    '</a>' +
                    '</div>';
                $('#data-container4').append(html);
                }

                if (ad.paid_ad_type === "figure_D") {
                var html =
                    '<div class="horizonBanAdBottom mt-5">' +
                    '<a href="' + ad.url + '" target="_blank">' + // Wrap the image in an anchor tag
                    '<img src="' + imageUrl + '" class="img d-block w-100 horizonBanAdBottom" alt="ad-image">' +
                    '</a>' +
                    '</div>';
                $('#data-container6').append(html);
                }
            

            
            });
        }


    });


    
        //basuru
        async function reportAd() {
                 const token = sessionStorage.getItem("token");

                if(token){
                var ad_id = @json($free_ad['id']);
                Swal.fire({
                title: 'What Do You Want to Report? ',
                html: `
                        <label for="status1">Status</label>
                            <select class="form-control" id="status1" name="status1" required>
                                <option value="fakeAd">Fake Ad</option>
                                <option value="duplicate">Duplicate</option>
                                <option value="spam">Spam</option>
                                <option value="incorrectCategory">Incorrect Category</option>
                                <option value="offensive">Offensive</option>
                                <option value="other">Other</option>
                            </select>
                       

                    
                        <textarea class="form-control mt-3" id="reason" name="reason" required placeholder="Write a message."></textarea>

                `,
                showCancelButton: true,
                confirmButtonText: 'Update',
                preConfirm: () => {
                        var status = document.getElementById('status1').value;
                        var reason = document.getElementById('reason').value ;
                    return {
                        tittle :status,
                        user_description: reason ,
                        free_ad_id : ad_id

                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(result.value);
                    const token = sessionStorage.getItem('token');
                    var baseUrl = "{{ env('APP_BASE_URL') }}";
                    $.ajax({
                        url: baseUrl + '/api/user_reports',
                        method: 'POST',
                        headers: {
                          'Authorization': 'Bearer ' + token
                        },
                        data: result.value,
                        success: function(response) {
                            Swal.fire({
                                title: 'User status updated',
                                text: response.message,
                                icon: 'success'
                            })
                        },
                        error: function(xhr, status, error,response) {
                            Swal.fire({
                                title: 'Error',
                                text: xhr.responseText,
                                icon: 'error'
                            });
                        }
                    });
                }
        });
    }

    else{

        Swal.fire({
            icon: "error",
            title: "Oops...",
            html: `
                <p>You need to login to report an ad!</p>
            `,
            footer: `
                <div>
                    Return to <a href="/login">Login</a><br>
                    New user? <a href="/signup">Sign up here</a>
                </div>
            `
        });

    }        
                
 }
 

 function viewAd(itemId) {
            // Redirect to the product page
            console.log(itemId);
            window.location.href = `/productPage1/${itemId}`;
            
        }

 // Add event listener for Add Favourite button
        $('.btn-favorite').on('click', function() {
            var adId = $(this).data('ad-id');
            var button = $(this);

            $.ajax({
                url:'http://127.0.0.1:8008/api/FavouriteAds',
                type: 'POST',
                headers: {
                        'Authorization': 'Bearer ' + sessionStorage.getItem('token')
                },
                data: {
                        ad_id: adId
                },

                success: function(response) {
                    if(response.status === 201) {
                        button.addClass('favorite');
                        button.css('background-color', 'yellow');
                        alert('Ad added to favourites');
                    } else if(response.status === 200) {
                        button.removeClass('favorite');
                        button.css('background-color', 'blue');
                        alert('Ad removed from favourites');
                    }

                    $.ajax({
                        url:'http://127.0.0.1:8008/api/FavouriteAdsLoad',
                        type: 'POST',
                        headers: {
                                'Authorization': 'Bearer ' + sessionStorage.getItem('token')
                        },
                        data: {
                                ad_id: adId
                        },
                        success: function(response) {
                        if(response.status === 201) {
                                button.addClass('favorite');
                                button.css('background-color', 'yellow');
                                alert('Ad added to favourites');
                        } else if(response.status === 200) {
                                button.removeClass('favorite');
                                button.css('background-color', 'blue');
                                alert('Ad removed from favourites');
                        }
                        },
                        error: function(xhr) {
                                alert('Error adding ad to favourites');
                        }
                    })

                },
                error: function(xhr) {
                    alert('Error adding ad to favourites');
                }
            });
        });




        $('#submit-rating').on('click', function() {
            var adId = $(this).data('ad-id');
            var selectedRating = $('input[name="product_rating"]:checked').val();
                $.ajax({
                        url: baseUrl + '/api/Ratings',
                        type: 'POST',
                        headers: {
                                'Authorization': 'Bearer ' + sessionStorage.getItem('token')
                        },
                        data: JSON.stringify({
                                stars: selectedRating,
                                ad_id: adId
                        }),
                        contentType: 'application/json',
                        success: function(response) {
                                if (response.message === 'Rating saved successfully') {
                                alert('Thank you for your rating!');
                                $('#submit-rating').removeClass('btn-rating').addClass('btn-success');
                                } else {
                                alert('There was an error submitting your rating. Please try again.');
                                }
                        },
                        error: function(xhr) {
                                alert('There was an error submitting your rating. Please try again.');
                        }
                });
});

</script>       
@endsection



<!-- <div class="row d-flex justify-content-between">
                        <div class="col-d-block col-sm-4 col-md-7 col-lg-7">
                                <div id="carouselExampleIndicators" class="carousel slide mt-4">
                                        <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                        </div>
                                        <div class="carousel-inner rounded-5 shadow-4-strong">
                                        <div class="carousel-item active">
                                        <img src="{{$free_ad['image_1']}}" class="d-block w-100" alt="Edition-page">
                                        </div>
                                        <div class="carousel-item">
                                        <img src="{{$free_ad['image_2']}}" class="d-block w-100" alt="Edition-page">
                                        </div>
                                        <div class="carousel-item">
                                        <img src="{{$free_ad['image_3']}}" class="d-block w-100" alt="Edition-page">
                                        </div>
                                        <div class="carousel-item">
                                        <img src="{{$free_ad['image_4']}}" class="d-block w-100" alt="Edition-page">
                                        </div>
                                        <div class="carousel-item">
                                        <img src="{{$free_ad['image_5']}}" class="d-block w-100" alt="Edition-page">
                                        </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                        </button>
                                </div>
                                <div class="row m-2">
                                        <div class="col-12 col-sm-6 d-flex  justify-content-between">
                                                <div class="d-flex">
                                                        <h6 class="text-secondary d-flex"><i class="bi bi-clock-fill px-1"> </i>{{ \Carbon\Carbon::parse($free_ad['created_at'])->format('Y-m-d') }}</h6>
                                                        <h6 class="text-secondary px-2 d-flex"><i class="bi bi-geo-alt-fill px-1"></i>{{$free_ad['town']}}</h6>
                                                        <h6 class="text-secondary px-2 d-flex"><i class="bi bi-eye-fill px-1"></i>{{$free_ad['view_count']}}</h6>
                                                </div>
                                         </div>
                                        <div class="col-6 d-flex  justify-content-end">
                                        
                                        <button type="button" class="btn btn-favorite" data-ad-id="{{ $free_ad['id'] }}" aria-pressed="false" autocomplete="off">
                                                Add Favourite<i class="bi bi-heart px-2"></i>
                                        </button>
                                        <button type="button" class="btn btn-share" data-toggle="button" aria-pressed="false" autocomplete="off">
                                                Share<i class="bi bi-share-fill px-2"></i>
                                        </button>

                                        </div>
                                </div>
                                
                        </div>
                       

                        <div class="col-d-block col-sm-2 col-md-5 col-lg-4">
                                <div class="d-block productRightUp my-4 ">
                                        <h4 class="productPrice fw-bold ">Rs. {{$free_ad['price']}}</h4>
                                        <p class="text-success ">
                                                @if($free_ad['negotiable'] == 'true')
                                                        Negotiable
                                                
                                                @endif
                                        </p>
                                        <h4 class="productTitle fw-bold"> {{$free_ad['brand']}} {{$free_ad['title']}}</h4>
                                </div>


                                <div class="productRightDown d-block my-5 py-2 ">
                                        <h6 class="text-center fw-bold">Seller Information</h6>
                                        <hr>
                                        <div class="userImg d-flex justify-content-center">
                                        @if($free_ad['user']['profile_image'])
                                                <img src="{{ $free_ad['user']['profile_image'] }}" height="75px" width="75px" id="profile-img" alt="mobile-free-ad" class="rounded-circle">
                                        @endif
                                        </div>
                                        <h6 class="text-center fw-bold ">{{$free_ad['user']['first_name']}}</h6>
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                                <h6 class="fw-bold "><i class="bi bi-telephone-fill mx-2"></i>{{$free_ad['user']['telephone_no_1']}}</h6>
                                                <h6 class="fw-bold "><i class="bi bi-geo-alt-fill mx-2"></i>{{$free_ad['user']['town']}}</h6>
                                        </div>
                                        <div class="text-center">
                                                <button type="button" class="btn w-50 my-2 email" > <i class="bi bi-envelope-fill ms-2 mx-2"></i>Email to seller</button>
                                        </div>
                                </div>
                                
                                
                                <div class="d-flex justify-content-center m-0 ">
                                        <button type="button" class="btn w-100 my-2 bargain" onclick="bargainAdNavigate({{$free_ad['id']}})"> <i class="bi bi-bookmark-plus-fill ms-2 mx-2"></i>Add Bargain Price</button>
                                </div>
                        </div>
                </div> -->