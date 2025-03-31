
@extends('layout')
        @section('header')
        @parent
        @endsection

        @section('content')

    <div class="container-lg">
        <div class="container col-12 ">
            <h4 class="adtype h5 m-0  mb-3 pt-5 pb-4"> Banner Advertising </h4>
            <h6 class="type_explain pb-3">
                Banners are the creative rectangular ad that are shown along the top, side, or bottom of a
                website in
                hopes that it will drive traffic to the advertiser's proprietary site, generate awareness, and
                overall brand consideration.
            </h6>
           
        </div>

        <div class="container">
            <h4 class="body_starting mb-5 mt-5"> Home Page </h4>
            <div class="row d-flex flex-column flex-sm-row align-items-start justify-content-between mb-5">
                <div class="col-xl-5 col-lg-5 col-md-6 col-12 justify-content-center align-items-center mb-5">
                    <img src="{{URL('images/figgertype.png')}}" class="d-block w-100 figure_type" alt="...">
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 ">
                    <div class="d-flex flex-column container-fluid">
                        <button class="btn btn-lg w-90 mb-5 mt-2 px-5 figureBtn" data-index="0">Figure A</button>
                        <button class="btn btn-lg w-90 mb-5 px-5 figureBtn" data-index="1">Figure B</button>
                        <button class="btn btn-lg w-90 mb-5 px-5 figureBtn" data-index="2">Figure C</button>
                        <button class="btn btn-lg w-90 px-5 figureBtn" data-index="3">Figure D</button>

                    </div>
                </div>
            </div>
        </div>
    </div>


<script>



$(document).ready(function(){
     //alert("hello")
     
     let res = [];

        // Fetch data using AJAX
        $.ajax({
            url: 'http://127.0.0.1:8008/api/paid_ad_typeCreate',
            type: 'GET',
            success: function(response) {
                res = response.data;
                console.log("Successful", response);
            },
            error: function(xhr, status, error) {
                swal("Oops!", "Something went wrong", "error");
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : "Unknown error occurred.";
                console.log("Error", errorMessage);
            }
        });


        // Add event listeners to the buttons
        document.querySelectorAll(".figureBtn").forEach(button => {
            button.addEventListener("click", function() {
                const index = this.getAttribute("data-index");
                const data = res[index];
                console.log("Figure data being stored:", data); // Log the data
                localStorage.setItem('figureData', JSON.stringify(data));

                // Navigate to the new HTML file
                window.location.href = 'bannerAd2';
            });
        });
        

})



  
</script>
@endsection
