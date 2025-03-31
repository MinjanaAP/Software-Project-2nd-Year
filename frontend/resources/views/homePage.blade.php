@extends('layouts.homePageLayout')
        @section('header')
        @parent
        @endsection

        @section('content')
   
<div class="container-lg">
    <div class="row">

        <div class="d-none col-sm-2 d-sm-block pt-3">

            <div class="verticalAd m-2 " id="verticalAd">

                <div class="verticalAd1 mb-2">
                    <div id="data-container3" class="verticalAd1Left">
                        <p class="placeholder-glow">
                            <span class="placeholder col-12" id="verticalAd1Placeholder"></span>
                        </p>
                    </div>
                </div>

                <div class="verticalAd2 mb-2">
                    <div id="data-container4" class="verticalAd2Left"> 
                        <p class="placeholder-glow">
                            <span class="placeholder col-12" id="verticalAd2Placeholder"></span>
                        </p>
                    </div>
                </div> 

            </div>

        </div>

        <div class="col-12 col-sm-10 pt-md-3 pt-sm-0">
            
                <div class="horizonBanAdTop mt-2 d-none d-md-block">
                    <div id="data-container5" class=""> 
                        <p class="placeholder-glow">
                            <span class="placeholder col-12" id="horizonBanAdTop"></span>
                        </p>
                    </div>
                </div>

                <div class="horizonBanAdTop mt-2 d-md-none">
                    <div id="data-container5Mobile" class=""> 
                        <p class="placeholder-glow">
                            <span class="placeholder col-12" id="horizonBanAdTopMobile"></span>
                        </p>
                    </div>
                </div>
            
            <h2 class="Main-Topic fw-bold mt-4 "> Explore By Categories </h2>
            <hr class="mb-4 mt-0">
            <div class="container mItemSlider mt-0 mx-0 px-0">
                <div class="slider-wrapper d-none d-sm-block">
                        <button id="prev-slide" class="slide-button material-symbols-rounded"> chevron_left </button>
                        <ul class="image-list mb-0 px-0">
                            @foreach($subCategories as $subCategory)
                            <a class="link-offset-2 link-underline link-underline-opacity-0" onclick="selectCategory('{{ $subCategory['Name'] }}')" href="javascript:void(0);">
                                <div class="carosel" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0.41) 100%),url({{$subCategory['image_url']}}) lightgray 50% / cover no-repeat">
                                    <h5 class="topicNames py-3">{{$subCategory['Name']}}</h5>
                                </div>
                            </a>
                            @endforeach
                        </ul>
                        <button id="next-slide" class="slide-button material-symbols-rounded"> chevron_right </button>
                </div>
                <div class="slider-wrapper d-sm-none">
                    <button id="prev-slide" class="slide-button material-symbols-rounded"> chevron_left </button>
                    <ul class="image-list px-0 m-0">
                        @foreach($subCategories as $subCategory)
                        <a class="link-offset-2 link-underline link-underline-opacity-0" onclick="selectCategory('{{ $subCategory['Name'] }}')" href="javascript:void(0);">
                            <div class="carosel" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0.41) 100%),url({{$subCategory['image_url']}}) lightgray 50% / cover no-repeat">
                                <h5 class="topicNames py-2">{{$subCategory['Name']}}</h5>
                            </div>
                        </a>
                        @endforeach
                    </ul>
                    <button id="next-slide" class="slide-button material-symbols-rounded"> chevron_right </button>
                </div>
                <div class="slider-scrollbar mt-4 d-none d-md-block">
                    <div class="scrollbar-track">
                        <div class="scrollbar-thumb"></div>
                    </div>
                </div>
            </div>

            <h4 class="adTopic fw-bold mt-3 mb-0" id="topic"> Latest Ads On Emporia  </h4>
            <hr class="mb-4 mt-2">

            <div class="container-lg">

                <div class="latestAds" id="latesAds">
                    <div id="data-container" class="data-containerAd">
                        @for($i = 0; $i < 6; $i++)
                            <div class="card" aria-hidden="true">
                                <img src="{{URL('/image/homePageGIFs/placeholder-image.PNG')}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                    <span class="placeholder col-4"></span>
                                    <span class="placeholder col-6"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <a class="btn btn-primary disabled placeholder col-12" aria-disabled="true"></a>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="paginationbtn-searchResult container d-flex justify-content-center mt-3" id="paginationbtn-searchResult">
                        <button id="prev-btn" class="btn active me-3" role="button" data-bs-toggle="button" aria-pressed="true">&laquo; Previous</button>
                        <button id="next-btn" class="btn active" role="button" data-bs-toggle="button" aria-pressed="true">Next &raquo;</button>
                    </div>
                </div>
            </div>



        </div>
        
    </div>


        <div class="horizonBanAdBottom mt-5">
            <div id="data-container6" class=""> </div>       
        </div>
    

        <div class="container-lg">
            <p class="adTopic fw-bold mt-3 " id="popularAds"> Most Popular ads on Emporia </p>
            <hr>
            <div id="popularad-container" class="data-containerAd"></div>
            <div id="popularad-pagination-container" class="pagination d-flex justify-content-center my-3"></div>
        </div>
    
   
        <div class="container-lg">
            <p class="adTopic fw-bold mt-3" id="allAds"> All ads in Electronics </p>
            <hr>
            <div class="recoAds"></div>
            <div id="allad-container" class="data-containerAd"></div>
            <div id="pagination-container" class="pagination d-flex justify-content-center my-3"></div>
        </div>
   
    
    
    <div class="container addAds mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    {{-- <img src="{{URL('images/Emails-bro.svg')}}" class="img-fluid" alt="Edition-page"> --}}
                    <img src="{{URL('image/homePageGIFs/freeAds.gif')}}" class="img-fluid" alt="Edition-page">
                </div>
                <div class="col-12 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <h6 class="text-center fw-bold"> Got Something to Advertise? Post It Here for Free! </h6>
                    <p class="text-center text-secondary">Post your electronic items for free on EMPORIA! Reach tech enthusiasts and showcase your latest gadgets effortlessly. Start advertising today and connect with potential buyers in no time!</p>
                    <button type="button" class="btn me-2 mt-2 click fw-bold" onclick="window.location.href='/freeAd1'"><i class="bi bi-plus-circle"></i> Free Ads </button>
                </div>
            </div>

            <div class="flex-sm-row d-flex flex-column-reverse justify-content-center m-2">
                <div class="col-12 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <h6 class="text-center fw-bold"> Boost your business by posting your Banner Ad now! </h6>
                    <p class="text-center text-secondary">Grow your business with EMPORIA! Place your banner ad today and expand your reach effortlessly. Drive traffic and increase visibility on our dynamic platform.</p>
                    <button type="button" class="btn me-2 mt-2 click fw-bold" onclick="window.location.href='/freeAd1'"><i class="bi bi-plus-circle"></i> Banner Ads </button>                
                </div>

                <div class="col-12 col-md-6">
                    {{-- <img src="{{URL('images/Newsletter-pana.svg')}}" class="img-fluid" alt="Edition-page"> --}}
                    <img src="{{URL('image/homePageGIFs/paidAds.gif')}}" class="img-fluid" alt="Edition-page">

                </div>
            </div>

            <div class="row justify-content-center m-2">
                <div class="col-12 col-md-6">
                    {{-- <img src="{{URL('images/Customer-Survey-bro.svg')}}" class="img-fluid" alt="Edition-page"> --}}
                    <img src="{{URL('image/homePageGIFs/bargainAds.gif')}}" class="img-fluid" alt="Edition-page">

                </div>
                <div class="col-12 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <h6 class="text-center fw-bold"> NEW! </h6>
                    <p class="text-center text-secondary">Introducing the new Bargain Price feature on EMPORIA! Now users can post discounted offers directly on our platform, attracting more attention and boosting sales. Don't miss out—start saving and selling with Bargain Price today!</p>
                    <h6 class="text-center fw-bold"> Add Bargain Prices To Our Most Popular Ads.</h6>
                    <button type="button" class="btn me-2 mt-2 click fw-bold" onclick="window.location.href='/homePage/#popularad-container'"> <i class="bi bi-plus-circle"></i> Add Prices </button>                
                </div>
            </div>
    </div>  
</div>

 <!-- <div class="container">
        <div class="col-6">
            <div class="img" style="background-color:red">
                <img src="" alt="">
            </div>
            <span class="badge text-bg-success">Primary</span>
            <div class="row">
                <div class="col-6 d-flex  justify-content-between ">
                        <h4 class="m-0" id="price">price</h4>
                        <div>
                        <span class="badge text-bg-success">Primary</span>
                        </div>
                </div>
                <div class="col-6 d-flex  justify-content-end">
                <i class="bi bi-heart px-3"></i>
                <i class="bi bi-share px-3"></i>
                </div>
            </div>
            <h5>negotiable</h5>
            <h2 id="title">title</h2>
            <h4><i class="bi bi-geo-alt me-3"></i>location</h4>
            <button type="button" class="btn btn-primary w-100">Primary <i class="bi bi-arrow-right-short ms-3"></i></button>
        </div>
    </div> -->
    <!-- <div class="container-lg"> -->









    <script>

        //basuru
        const initSlider = () => {
            const imageList = document.querySelector(".slider-wrapper .image-list");
            const slideButtons = document.querySelectorAll(".slider-wrapper .slide-button");
            const sliderScrollbar = document.querySelector(".container .slider-scrollbar");
            const scrollbarThumb = sliderScrollbar.querySelector(".scrollbar-thumb");
            const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;
            
                // Handle scrollbar thumb drag
                scrollbarThumb.addEventListener("mousedown", (e) => {
                const startX = e.clientX;
                const thumbPosition = scrollbarThumb.offsetLeft;
                const maxThumbPosition = sliderScrollbar.getBoundingClientRect().width - scrollbarThumb.offsetWidth;
                
                // Update thumb position on mouse move
                const handleMouseMove = (e) => {
                    const deltaX = e.clientX - startX;
                    const newThumbPosition = thumbPosition + deltaX;

                    // Ensure the scrollbar thumb stays within bounds
                    const boundedPosition = Math.max(0, Math.min(maxThumbPosition, newThumbPosition));
                    const scrollPosition = (boundedPosition / maxThumbPosition) * maxScrollLeft;
                    
                    scrollbarThumb.style.left = `${boundedPosition}px`;
                    imageList.scrollLeft = scrollPosition;
                }

                // Remove event listeners on mouse up
                const handleMouseUp = () => {
                    document.removeEventListener("mousemove", handleMouseMove);
                    document.removeEventListener("mouseup", handleMouseUp);
                }

                // Add event listeners for drag interaction
                document.addEventListener("mousemove", handleMouseMove);
                document.addEventListener("mouseup", handleMouseUp);
            });

            // Slide images according to the slide button clicks
            slideButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const direction = button.id === "prev-slide" ? -1 : 1;
                    const scrollAmount = imageList.clientWidth * direction;
                    imageList.scrollBy({ left: scrollAmount, behavior: "smooth" });
                });
            });

            // Show or hide slide buttons based on scroll position
            const handleSlideButtons = () => {
                slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "flex";
                slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "flex";
            }

            // Update scrollbar thumb position based on image scroll
            const updateScrollThumbPosition = () => {
                const scrollPosition = imageList.scrollLeft;
                const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
                scrollbarThumb.style.left = `${thumbPosition}px`;
            }

            // Call these two functions when image list scrolls
            imageList.addEventListener("scroll", () => {
                updateScrollThumbPosition();
                handleSlideButtons();
            });
        }

        window.addEventListener("resize", initSlider);
        window.addEventListener("load", initSlider);




var baseUrl = "{{ env('APP_BASE_URL') }}";

//basuru
$(document).ready(function(){
    const urlParams = new URLSearchParams(window.location.search);
    const searchValue = urlParams.get('search');
    // const token = urlParams.get('token');

    // if (token) {
    //     console.log(token);
    //     sessionStorage.setItem('token', token);
    // }

    if(searchValue) {
        console.log(searchValue);
        $('#topic').text('Search Results for: ' + searchValue);
        search(searchValue);
        
    

        
    }else{
        $('#paginationbtn-searchResult').empty();
        $.ajax({
            url: baseUrl + '/api/getLatestAdsBasedOnSubCategory',
            type: 'GET',
            success: function(response) {
                
                console.log(response);
                if(response.status === 200) {
                    $('#data-container').empty(); 
                    var firstSixItems = response.data.slice(0, 12); // to terate over each item in the data array
                                firstSixItems.forEach(function(item) {
                                var itemDate = formatDate(item.created_at);
                                // console.log(item); // to create a new element to display each item's property
                                    if(item.negotiable == 'true'){
                                        item.negotiable = 'Negotiable';
                                    } else {
                                        item.negotiable = '';
                                    }
                                    var price = item.price.toLocaleString('en-US', { maximumFractionDigits: 2 });
                                    var html =
                                                '<div class="viewAds p-2">' +
                                                    '<div class="viewAd img">' +
                                                    '<img class="rounded mx-auto d-block" width="200px" height="200px" src="' + item.image_1 + '" alt="jj">' +
                                                    '</div>' +
                                                        '<div class="adDetails my-2 p-2">' +
                                                            '<span class="badge text-bg-success mt-1 mb-2">Latest</span>' +
                                                            '<div class="row mb-0">' +
                                                                '<div class="col-12 d-flex  justify-content-start ">' +
                                                                    '<h4 class="itemPrice fw-bold" id="price"> Rs.' + price + '</h4>' +
                                                                    '<div>' +
                                                                        '<span class="badge text-bg-warning me-3 ms-1 ">' + item.negotiable +'</span>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<div class="d-flex">'+
                                                            '<h4 class="itemTitle fw-bold me-2" id="title">' +item.brand+' '+ item.title + '</h4>' +
                                                            '<span class="badge text-bg-secondary mt-1 mb-2" id="status">'+ item.condition +'</span>' +
                                                            '</div>' +
                                                            '<div class="row mb-0">' +
                                                                '<div class="d-flex justify-content-between">'+
                                                                    '<p class="itemLocation text-secondary"><i class="bi bi-geo-alt-fill me-1"></i>' + item.town + '</p>' +
                                                                    
                                                                '</div>'+
                                                            '</div>'+
                                                            '<button type="button" class="btn w-100" onclick="viewAd('+ item.id +')"> View Ad <i class="bi bi-arrow-right-short ms-2"></i></button>' +
                                                        '</div>' +
                                                    '</div>';

                                    $('#data-container').append(html);
                                    $('#data-container2').append(html);

                                    var verticalAd = document.getElementById('verticalAd');
                                    verticalAd.style.height='100%';

                                    

                                });
                            } else {
                                document.getElementById('data-container').textContent = 'Error: Unable to fetch data';
                            }
            },
            error: function(xhr) {
                console.log(xhr.responseText); 
        }});
    }

    function formatDate(date){
        return moment(date).fromNow();
    }

var currentPage = 1; // Keep track of the current page
var totalPages = 1;  // Total number of pages

function search(search_text, page = 1) {
    $.ajax({
        url: baseUrl + '/api/search',
        type: 'GET',
        data: { "search_text": search_text, "page": page },
        success: function(response) {
            console.log(response);
            if(response.status === 200) {
                if(response.data.data.length === 0){
                    $('#topic').text('No results found for: ' + search_text);
                    $('#data-container').empty(); 
                    $('#paginationbtn-searchResult').empty();
                    $('#latesAds').append(`
                        <h3 class="text-center">Ups!... No results found.</h3>
                        <h6 class="text-center">Please try another search.</h6>
                        <div class="col-12 d-flex justify-content-center">
                            <img src="{{URL('image/homePageGIFs/empty-search.gif')}}" class="img-fluid" alt="Edition-page">
                        </div>
                    `)
                }
                var ads = response.data.data;
                $('#data-container').empty(); 
                ads.forEach(function(item) {
                    var negotiableText = item.negotiable === 'true' ? 'Negotiable' : '';
                    var html =
                        '<div class="viewAds p-2">' +
                            '<div class="viewAd img">' +
                                '<img class="rounded mx-auto d-block" width="200px" height="200px" src="' + item.image_1 + '" alt="Ad Image">' +
                            '</div>' +
                            '<div class="adDetails my-2 p-2">' +
                                '<div class="row mb-0">' +
                                    '<div class="col-6 d-flex justify-content-between ">' +
                                        '<h4 class="itemPrice fw-bold" id="price">LKR. ' + item.price + '</h4>' +
                                        '<div>' +
                                            '<span class="badge text-bg-warning me-3 ms-1 ">' + negotiableText + '</span>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-6 d-flex justify-content-end">' +
                                        '<i class="bi bi-heart px-2"></i>' +
                                        '<i class="bi bi-share-fill px-2"></i>' +
                                    '</div>' +
                                '</div>' +
                                '<h4 class="itemTitle fw-bold" id="title">' + item.title + '</h4>' +
                                '<p class="itemLocation text-secondary"><i class="bi bi-geo-alt-fill me-2"></i>' + item.town + '</p>' +
                                '<button type="button" class="btn w-100" onclick="viewAd(' + item.id + ')">View Ad <i class="bi bi-arrow-right-short ms-2"></i></button>' +
                            '</div>' +
                        '</div>';
                    $('#data-container').append(html);
                });
                
                // Update pagination info
                currentPage = response.data.current_page;
                totalPages = response.data.last_page;

                // Enable/Disable pagination buttons
                $('#prev-btn').prop('disabled', currentPage <= 1);
                $('#next-btn').prop('disabled', currentPage >= totalPages);
                document.getElementById('topic').scrollIntoView({ behavior: 'smooth' });
            } else {
                $('#data-container').text('Error: Unable to fetch data search');
                
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}

// Event listeners for pagination buttons
$(document).ready(function() {
    $('#prev-btn').on('click', function() {
        if (currentPage > 1) {
            search($('#search-input').val(), currentPage - 1);
        }
    });

    $('#next-btn').on('click', function() {
        if (currentPage < totalPages) {
            search($('#search-input').val(), currentPage + 1);
        }
    });
});
       
    })   

    
    //basuru
    //get popular ads
    $(document).ready(function() {
    var currentPage = 1;

    function fetchAdss(page) {
        $.ajax({
            url: baseUrl + '/api/getpopularAdsByViewCount?page=' + page,
            type: 'GET',
            success: function(response) {
                console.log('view'+response);
                if (response.message === 'Records retrieved successfully') {
                    $('#popularad-container').empty();
                    displayAds(response.data.data);
                    setupPagination(response.data);
                } else {
                    $('#popularad-container').text('Error: Unable to fetch data');
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
            var negotiable = item.negotiable === 'true' ? 'Negotiable' : '';
            var price = item.price.toLocaleString('en-US', { maximumFractionDigits: 2 });
            var html =
                '<div class="viewAds p-2">' +
                    '<div class="viewAd img">' +
                        '<img class="rounded mx-auto d-block" width="200px" height="200px" src="' + item.image_1 + '" alt="Ad Image">' +
                    '</div>' +
                    '<div class="adDetails my-2 p-2">' +
                        '<div class="row mb-0">' +
                            '<div class="col-12 d-flex justify-content-start">' +
                                '<h4 class="itemPrice fw-bold" id="price">Rs. ' + price + '</h4>' +
                                '<div>' +
                                    '<span class="badge text-bg-warning me-3 ms-1">' + negotiable + '</span>' +
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
                        '<button type="button" class="btn w-100" onclick="viewAd(' + item.id + ')">View Ad <i class="bi bi-arrow-right-short ms-2"></i></button>' +
                    '</div>' +
                '</div>';

            $('#popularad-container').append(html);
        });
    }

    function formatDate(date){
        return moment(date).fromNow();
    }

    function setupPagination(data) {
        $('#popularad-pagination-container').empty();

        // Add "First" page link
        if (data.current_page > 1) {
            $('#popularad-pagination-container').append('<a href="#" class="page-link first-page-link d-none d-md-inline" data-page="1">First</a>');
        } else {
            $('#popularad-pagination-container').append('<a href="#" class="page-link first-page-link d-none d-md-inline disabled" tabindex="-1" aria-disabled="true">First</a>');
        }

        // Add "Previous" page link
        if (data.current_page > 1) {
            $('#popularad-pagination-container').append('<a href="#" class="page-link" data-page="' + (data.current_page - 1) + '"><span class="d-none d-md-inline">&laquo; Previous</span><span class="d-inline d-md-none">&laquo;</span></a>');
        } else {
            $('#popularad-pagination-container').append('<a href="#" class="page-link disabled" tabindex="-1" aria-disabled="true"><span class="d-none d-md-inline">&laquo; Previous</span><span class="d-inline d-md-none">&laquo;</span></a>');
        }

        // Add page number links
        for (var i = 1; i <= data.last_page; i++) {
            var activeClass = (i === data.current_page) ? 'active' : '';
            $('#popularad-pagination-container').append('<a href="#" class="page-link ' + activeClass + '" data-page="' + i + '">' + i + '</a>');
        }

        // Add "Next" page link
        if (data.current_page < data.last_page) {
            $('#popularad-pagination-container').append('<a href="#" class="page-link" data-page="' + (data.current_page + 1) + '"><span class="d-none d-md-inline">Next &raquo;</span><span class="d-inline d-md-none">&raquo;</span></a>');
        } else {
            $('#popularad-pagination-container').append('<a href="#" class="page-link disabled" tabindex="-1" aria-disabled="true"><span class="d-none d-md-inline">Next &raquo;</span><span class="d-inline d-md-none">&raquo;</span></a>');
        }

        // Add "Last" page link
        if (data.current_page < data.last_page) {
            $('#popularad-pagination-container').append('<a href="#" class="page-link last-page-link d-none d-md-inline" data-page="' + data.last_page + '">Last</a>');
        } else {
            $('#popularad-pagination-container').append('<a href="#" class="page-link last-page-link d-none d-md-inline disabled" tabindex="-1" aria-disabled="true">Last</a>');
        }

        // Handle click event for page links
        $('.page-link').on('click', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            if (!$(this).hasClass('disabled')) {
                fetchAdss(page);
            }
        });
    }

        function viewAd(adId) {
            console.log('View ad:', adId);
        }

        fetchAdss(currentPage);
    });




    //basuru
    //get all ads
    $(document).ready(function() {
        
        var currentPage = 1;
        
        function fetchAds(page) {
            $.ajax({
                url: baseUrl + '/api/getPaginationAds?page=' + page,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    if(response.message === 'success') {
                        $('#allad-container').empty();
                        displayAds(response.data.data);
                        setupPagination(response.data);
                    } else {
                        $('#allad-container').text('Error: Unable to fetch data');
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
                var price = item.price.toLocaleString('en-US', { maximumFractionDigits: 2 });
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
                            '<div class="row mb-0">' +
                                '<div class="col-12 d-flex justify-content-start">' +
                                    '<h4 class="itemPrice fw-bold" id="price"> Rs. ' + price + '</h4>' +
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


        // function viewAd(adId) {
        //     // Add your view ad functionality here
        //     console.log('View ad:', adId);
        // }

        fetchAds(currentPage);
    });

    

    function selectCategory(categoryName) {
    $.ajax({
        url: baseUrl +'/api/sub_category_ads/' + categoryName,
        type: 'GET',
        success: function(response) {
            console.log(response);
            if(response.status === 200) {
                $('#data-container').empty();
                $('#topic').empty();
                $('#topic').append(`
                <div>
                    <h3 class="adTopic">${categoryName} Advertisements</h3>
                </div>
                `);
                var ads = response.data;
                $('#data-container').empty(); // Clear existing ads
                $('#data-container2').empty(); // Clear existing ads in second container

                if(response.data.length === 0){
                    $('#topic').text('No results found for: '+ categoryName +' category.');
                    $('#data-container').empty(); 
                    $('#paginationbtn-searchResult').empty();
                    $('#data-container').append(`
                        <div>
                            <h3 class="text-center">Ups!... No results found.</h3>
                        <h6 class="text-center">Please try another category.</h6>
                        <div class="col-12 d-flex justify-content-center">
                            <img src="{{URL('image/homePageGIFs/empty-search.gif')}}" class="img-fluid" alt="Edition-page">
                        </div>
                        </div>
                        
                    `)
                }

                ads.forEach(function(item) {
                    var negotiableText = item.negotiable === 'true' ? 'Negotiable' : '';
                    var html =
                    '<div class="viewAds p-2">' +
                            '<div class="viewAd img">' +
                            '<img class="rounded mx-auto d-block" width="200px" height="200px" src="' + item.image_1 + '" alt="jj">' +
                            '</div>' +
                                '<div class="adDetails my-2 p-2">' +
                                    '<div class="row mb-0">' +
                                        '<div class="col-6 d-flex  justify-content-between ">' +
                                            '<h4 class="itemPrice fw-bold" id="price"> LKR.' + item.price + '</h4>' +
                                            '<div>' +
                                                '<span class="badge text-bg-warning me-3 ms-1 ">' + negotiableText + '</span>' + // Corrected negotiable text
                                            '</div>' +
                                        '</div>' +
                                        '<div class="col-6 d-flex  justify-content-end">' +
                                            '<i class="bi bi-heart px-2"></i>' +
                                            '<i class="bi bi-share-fill px-2"></i>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="d-flex">'+
                                    '<h4 class="itemTitle fw-bold me-2" id="title">' + item.brand + ' ' + item.title + '</h4>' +
                                    '<span class="badge text-bg-secondary mt-1 mb-2" id="status">' + item.condition + '</span>' +
                                    '</div>' +
                                    '<p class="itemLocation text-secondary"><i class="bi bi-geo-alt-fill me-2"></i>' + item.town + '</p>' +
                                    '<button type="button" class="btn w-100" onclick="viewAd(' + item.id + ')"> View Ad <i class="bi bi-arrow-right-short ms-2"></i></button>' +
                                '</div>' +
                            '</div>';

                    $('#data-container').append(html);
                });
            } else {
                $('#data-container').text('Error: Unable to fetch data');
                $('#data-container2').text('Error: Unable to fetch data');
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}

function viewAd(itemId) {
            // Redirect to the product page
            console.log(itemId);
            window.location.href = `/productPage1/${itemId}`;
            
        }

       
    



    //basuru
    $(document).ready(function() {
    $.ajax({
        url: baseUrl + '/api/get_latest_paid_ads',  
        type: 'GET',
        success: function(response) {
            if (response.message === 'Record retrieval successful') {
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
            $('#data-container5').empty(); 
            $('#data-container3').empty();
            $('#data-container4').empty();
            $('#data-container5Mobile').empty();
            adsContainer.empty(); 
            
            ads.forEach(function(ad) {

            
                var imageUrl =  ad.image; 
                if (ad.paid_ad_type === "figure_A") {
                var html =
                    '<div class="horizonBanAdTop mt-2 d-none d-md-block">' +
                    '<a href="' + ad.url + '" target="_blank">' + // Wrap the image in an anchor tag
                    '<img src="' + imageUrl + '" class="img d-block w-100 horizonBanAdTop" alt="ad-image">' +
                    '</a>' +
                    '</div>';
                $('#data-container5').append(html);

                var html2 =
                    '<div class="horizonBanAdTop mt-2  d-block">' +
                    '<a href="' + ad.url + '" target="_blank">' + // Wrap the image in an anchor tag
                    '<img src="' + imageUrl + '" class="img d-block w-100 horizonBanAdTopMobile" alt="ad-image">' +
                    '</a>' +
                    '</div>';
                $('#data-container5Mobile').append(html2);
                 }

                 if (ad.paid_ad_type === "figure_A") {
                
                 }

                 if (ad.paid_ad_type === "figure_B") {
                var html =
                    '<div class="verticalAd1 mb-2">' +
                    '<a href="' + ad.url + '" target="_blank">' + // Wrap the image in an anchor tag
                    '<img src="' + imageUrl + '" class="img d-block w-100 verticalAd1"  alt="ad-image">' +
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

   







</script>
@endsection