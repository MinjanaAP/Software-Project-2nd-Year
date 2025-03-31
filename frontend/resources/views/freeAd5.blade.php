

    @extends('layout')
        @section('header')
        @parent
        @endsection

        @section('content')
    <div class="container">
        <div class="container-fluid text-center">
            <h4 class="h5 m-0  mb-0"> Condition </h4>
            <p> Choose the condition. </p>
        </div>

        <div class="row justify-content-center align-item-center mb-3">
            <div class="col-sm-4 col-md-4 col-lg-3 col-6 ">
                <img src="{{URL('images/free-ad-mobile.png')}}" alt="mobile-free-ad" class="img-fluid">
            </div>
        </div>


        <div class="d-grid col-6 mx-auto mb-3">
            <button type="button"  class="btn btn-outline-secondary btn-lg btn-block"
            onclick="storeCondition('New')">
                <div class="button_container">
                    <div class="button_container_text">
                        <h4 class="text-start text-primary mb-0">New</h4>
                        <p class="text-start mb-0 d-none d-sm-block"> <small>Select only if your item is new and never
                                used before</small></p>
                    </div>
                    <img src="{{URL('images/chevron-right.svg')}}" alt="" class="img-fluid rounded float-right">

                </div>
            </button>
        </div>

        <div class="d-grid col-6 mx-auto mb-3">
            <button type="button" class="btn btn-outline-secondary btn-lg btn-block" onclick="storeCondition('Used')">
                <div class="button_container">
                    <div class="button_container_text">
                        <h4 class="text-start text-danger  mb-0">Used</h4>
                        <p class="text-start mb-0 d-none d-sm-block"> <small>Select only if your item has been used
                                before</small></p>
                    </div>
                    <img src="{{URL('images/chevron-right.svg')}}" alt="" class="img-fluid rounded float-right">
                </div>
            </button>
        </div>

        <div class="d-grid col-6 mx-auto mb-3">
            <button type="button" class="btn btn-outline-secondary btn-lg btn-block" onclick="storeCondition('Reconditioned')">
                <div class="button_container">
                    <div class="button_container_text">
                        <h4 class="text-start text-success mb-0">Reconditioned</h4>
                        <p class="text-start mb-0 d-none d-sm-block"> <small>Select only if your item is
                                reconditioned</small></p>
                    </div>
                    <img src="{{URL('images/chevron-right.svg')}}" alt="" class="img-fluid rounded float-right">
                </div>
            </button>
        </div>



    </div>


    </div>
    <script>
        $('#adPostBtn').prop('disabled', true);
        function storeCondition(condition) {
    // Store the condition in local storage
    localStorage.setItem('condition', condition);
    // Redirect to the next page
    window.location.href = `/freeAd6/${encodeURIComponent(localStorage.getItem('subCategory'))}`;
}

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   

    <script src="" async defer></script>
    @endsection
