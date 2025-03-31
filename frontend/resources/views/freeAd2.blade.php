
@extends('layout')
        @section('header')
        @parent
        @endsection

        @section('content')
   
    <div class="container mt-5">
        <div class="container-lg text-center">
            <h1 class="heading-type-1">Brands</h1>
            <p class="heading-type-2">Choose the Brand and Version</p>
        </div>
        <section class="freead-image" id="freead-image">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-4 col-lg-3 col-6">
                    <img src="{{URL('image/freeAd2.svg')}}" class="img-fluid" alt="Edition-page">
                    </div>
                </div>
            </div>
        </section>
        <form >
            @csrf
            <div class="container-lg">
                <fieldset>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                    <div class="row justify-content-center">
            @foreach ($data as $brand)
                <div class="col-8 col-sm-8 col-lg-5">
                    <div class="dropdown">
                        <button id="brand" class="brand btn btn-second dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $brand['brandName'] }}
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($brand['versions'] as $version)
                                <li><a class="dropdown-item" id="featureDropdown" href="#" onclick="saveTitleAndNavigate('{{ $brand['brandName'] }}','{{ $version }}')">{{ $version }}</a></li>
                            @endforeach
                            <li><a class="dropdown-item" id="featureDropdown" href="#" onclick="saveVersionAndNavigate('{{ $brand['brandName'] }}',null)" >Others</a></li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
</div>

<div class="container-lg text-center">
<button type="button" class="btn btn-outline-dark" onclick="saveBrandAndNavigate(null,null)">Others</button>
</div>
                </fieldset>
           
        </form>
    </div>
            

      

        
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $('#adPostBtn').prop('disabled', true);
    function saveTitleAndNavigate(brandName, version) {
        localStorage.setItem('selectedBrand', brandName);
        localStorage.setItem('selectedTitle', version);
        var sub_category = localStorage.getItem('subCategory');
        if(sub_category === 'Mobile phones'){
            window.location.href = '/freeAd4';
        }else{
            window.location.href = '/freeAd5';
        }
    }

    function navigateToNext() {
        const selectedTitle = localStorage.getItem('selectedTitle');
        if (selectedTitle) {
            window.location.href = '/freeAd4';
        } else {
            alert('Please select a version before proceeding.');
        }
    }
    function saveBrandAndNavigate(brandName,version){
        localStorage.setItem('selectedBrand', brandName);
        localStorage.setItem('selectedTitle', version);
        window.location.href = '/freeAd3';

    }
    function saveVersionAndNavigate(brandName,version){
        localStorage.setItem('selectedBrand', brandName);
        localStorage.setItem('selectedTitle', version);
        window.location.href = '/freeAd3';

    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    @endsection