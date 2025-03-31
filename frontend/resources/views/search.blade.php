@extends('layout')
        @section('header')
        @parent
        @endsection

        @section('content')

        <div class="container">

        <div class="row justify-content-center align-item-center mb-5">
            <div class=" col-sm-4 col-md-4 col-lg-3 col-6">
                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{URL('images/new22.jpg')}}" class="d-block w-100" id="image_1" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{URL('images/new22.jpg')}}" class="d-block w-100" id="image_2" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{URL('images/new22.jpg')}}" class="d-block w-100" id="image_3" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>


        <div class="container-fluid text-center ">
        </div>

        <div class="row justify-content-center">
            <ul class="col-lg-8">
            <div id="data-container" class="data-container">
    </div>
                <!-- <li class="list-group-item m-2">
                        <div class="row">
                            <div class="col">
                                <h6>Title:</h6>
                            </div>
                            <div class="col">
                                <h6 class="text-success">Iphone</h6>
                            </div>
                            
                        </div>
                    </li>
                <li class="list-group-item m-2">
                    <div class="row">
                        <div class="col">
                            <h6>Price:</h6>
                        </div>
                        <div class="col">
                            <h6 class="text-success">Rs. 400,000</h6>
                        </div>
                        
                    </div>
                </li>

                <li class="list-group-item m-2">
                    <div class="row">
                        <div class="col">
                            <h6>Category:</h6>
                        </div>
                        <div class="col">
                            <h6 class="text-success">Rs. 400,000</h6>
                        </div>
                        
                    </div>
                </li>

                <li class="list-group-item m-2">
                    <div class="row">
                        <div class="col">
                            <h6>Sub Category:</h6>
                        </div>
                        <div class="col">
                            <h6 class="text-success">Rs. 400,000</h6>
                        </div>
                        
                    </div>
                </li>

                <li class="list-group-item m-2">
                    <div class="row">
                        <div class="col">
                            <h6>Negotiable:</h6>
                        </div>
                        <div class="col">
                            <h6 class="text-secondary">New</h6>
                        </div>
                    </div>
                </li>

                <li class="list-group-item m-2">
                    <div class="row">
                        <div class="col">
                            <h6>Location:</h6>
                        </div>
                        <div class="col">
                            <h6 class="text-secondary">New</h6>
                        </div>
                    </div>
                </li>


                <li class="list-group-item m-2">
                    <div class="row">
                        <div class="col">
                            <h6>Description:</h6>
                        </div>
                        <div class="col">
                            <h6 class="text-secondary">Good Condition</h6>
                        </div>
                       
                        </div>
                    </div>
                </li> -->

            </ul>
    
        </div>
    </div>
    <div id="data-container" class="data-container">
    </div>

    <div class="container-lg">
        <div class="imgs m-2">
            <img src="{{URL('images/pexels8.jpg')}}" height="250px" width="100%" class="" alt="signin-form-main">
        </div>
        <h4 class="m-2">More Ads</h4>
        <hr>

        <div id="data-container2" class="data-containerAd">
         </div>

    </div>


</body>
<script>
    
    $(document).ready(function(){
    $.ajax({
    url: 'http://127.0.0.1:8008/api/free_adCreate',
    type: 'GET',
    success: function(response) {
        
        console.log(response);
        if(response.message === 'success') {
            var firstFourItems = response.data.slice(0, 1); 
                        
            firstFourItems.forEach(function(item) {
            console.log(item);  
                           
                            var html =
        // '<div class="carousel-inner">' +
        // '<div class="carousel-item active">' +
        //     '<img src="data:image/png;base64,' + item.image_1 + '" class="d-block w-100" id="image_1" alt="...">' +
        // '</div>' +

                                    
                                '</div>' +
                                '<li class="list-group-item m-2">' +
                                '<div class="row">' +
                                '<div class="col">' +
                                '<h6>Title:</h6>' +
                                '</div>' +
                                '<div class="col">' +
                                '<h6 class="text-secondary">' + item.title + '</h6>' +
                                '</div> <hr>' +
                                '</div>' +
                                '</li>' +
                                '<li class="list-group-item m-2">' +
                                '<div class="row">' +
                                '<div class="col">' +
                                '<h6>Price:</h6>' +
                                '</div>' +
                                '<div class="col">' +
                                '<h6 class="text-secondary">Rs. ' + item.price + '</h6>' +
                                '</div> <hr>' +
                                '</div>' +
                                '</li>' +
                                '<li class="list-group-item m-2">' +
                                '<div class="row">' +
                                '<div class="col">' +
                                '<h6>Category:</h6>' +
                                '</div>' +
                                '<div class="col">' +
                                '<h6 class="text-secondary">' + item.category + '</h6>' +
                                '</div> <hr>' +
                                '</div>' +
                                '</li>' +
                                '<li class="list-group-item m-2">' +
                                '<div class="row">' +
                                '<div class="col">' +
                                '<h6>Sub Category:</h6>' +
                                '</div>' +
                                '<div class="col">' +
                                '<h6 class="text-secondary">' + item.subcategory + '</h6>' +
                                '</div> <hr>' +
                                '</div>' +
                                '</li>' +
                                '<li class="list-group-item m-2">' +
                                '<div class="row">' +
                                '<div class="col">' +
                                '<h6>Negotiable:</h6>' +
                                '</div>' +
                                '<div class="col">' +
                                '<h6 class="text-secondary">' + item.negotiable + '</h6>' +
                                '</div> <hr>' +
                                '</div>' +
                                '</li>' +
                                '<li class="list-group-item m-2">' +
                                '<div class="row">' +
                                '<div class="col">' +
                                '<h6>Location:</h6>' +
                                '</div>' +
                                '<div class="col">' +
                                '<h6 class="text-secondary">' + item.location + '</h6>' +
                                '</div> <hr>' +
                                '</div>' +
                                '</li>' +
                                '<li class="list-group-item m-2">' +
                                '<div class="row">' +
                                '<div class="col">' +
                                '<h6>Description:</h6>' +
                                '</div>' +
                                '<div class="col">' +
                                '<h6 class="text-secondary">' + item.description + '</h6>' +
                                '</div> <hr>' +
                                '</div>' +
                                '</li>';

                            $('#data-container').html(html);


                        }
                        
                        );
                        var firstSixItems = response.data.slice(0, 6);
                        firstSixItems.forEach(function(item) {
                            console.log(item);
                            
                            var html =
                                        '<div class="viewAds p-2">' +
                                            '<div class="img">' +
                                            '<img class="rounded mx-auto d-block" width="200px" height="200px" src="data:image/png;base64,' + item.image_1 + '" alt="jj">' +
                                            '</div>' +
                                            '<span class="badge text-bg-success">Latest</span>' +
                                            '<div class="row">' +
                                                '<div class="col-6 d-flex  justify-content-between ">' +
                                                    '<h4 class="m-0" id="price"> LKR.' + item.price + '</h4>' +
                                                    '<div>' +
                                                        '<span class="badge text-bg-warning mx-3">Below Avg. Price</span>' +
                                                    '</div>' +
                                                '</div>' +
                                                '<div class="col-6 d-flex  justify-content-end">' +
                                                    '<i class="bi bi-heart px-2"></i>' +
                                                    '<i class="bi bi-share px-2"></i>' +
                                                '</div>' +
                                            '</div>' +
                                            '<p class="text-success m-0">(' + item.negotiable + ')</p>' +
                                            '<h4 id="title">' + item.title + '</h4>' +
                                            '<p><i class="bi bi-geo-alt me-2"></i>' + item.location + '</p>' +
                                            '<button type="button" class="btn w-100 " > View Ad <i class="bi bi-arrow-right-short ms-2"></i></button>' +
                                        '</div>';

                          
                            $('#data-container2').append(html);
                            
                        });
                        
                    } 
                    else {
                        document.getElementById('data-container').textContent = 'Error: Unable to fetch data';
                    }
    },
    
    error: function(xhr) {
        console.log(xhr.responseText); 
    }
});
    })   


</script>

@endsection