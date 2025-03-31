
@extends('layout')
@section('header')
@parent
@endsection

@section('content')
<div class="container mt-5">
    <div class="container-lg text-center">
        <h1 class="heading-type-1">Welcome to FreeAd</h1>
        <p class="heading-type-2">Select the Feature of your mobile</p>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-4 col-md-4 col-lg-3 col-6">
                <img src="{{URL('images/select.svg')}}" alt="" class="img-fluid">
            </div>
        </div>
    </div>

    <form>
        <div class="container-lg">
            <fieldset>
                <div class="row justify-content-center"> 
                    <div class="row col-lg-8 justify-content-center">
                        @foreach((array) $data as $features)
                        <div class="col-8 col-sm-8 col-lg-5">
                            <div class="checkbutton">
                                <input class="form-check-input" type="checkbox" value="{{ $features }}" name="features[]" id="android" onclick="saveFeature(this)">
                                <label class="form-check-label" for="flexCheckDefault">
                                {{ $features }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </fieldset>
            <div class="d-flex col-lg-6 d-none d-sm-flex container-fluid justify-content-between pt-4 pb-4">
                    <button type="button" class="btn btn-lg px-5" onclick="window.location.href='/freeAd2'">Cancel</button>
                    <button type="button" class="btn btn-lg px-5" onclick="validateAndNavigate()">Next</button>
            </div>
            <div class="d-flex flex-column col-lg-6 d-sm-none container-fluid justify-content-between pt-4 pb-4">
                <button type="button" class="btn btn-lg mb-3 px-5" onclick="window.location.href='/freeAd2'">Cancel</button>
                <button type="button" class="btn btn-lg px-5" onclick="validateAndNavigate()">Next</button>
            </div>
        </div>
    </form>
</div>

<script>
    $('#adPostBtn').prop('disabled', true);
function saveFeature(checkbox) {
    // Retrieve the selected features from localStorage or initialize an empty string
    var selectedFeatures = localStorage.getItem('selectedFeatures') || '';

    // Split the string into an array of features
    var featureArray = selectedFeatures ? selectedFeatures.split(',') : [];

    if (checkbox.checked) {
        // If the checkbox is checked, add the feature to the array if it's not already present
        if (!featureArray.includes(checkbox.value)) {
            featureArray.push(checkbox.value);
        }
    } else {
        // If the checkbox is unchecked, remove the feature from the array
        var index = featureArray.indexOf(checkbox.value);
        if (index !== -1) {
            featureArray.splice(index, 1);
        }
    }

    // Update the localStorage with the modified selected features as a comma-separated string
    localStorage.setItem('selectedFeatures', featureArray.join(','));
}

function validateAndNavigate() {
    var selectedFeatures = localStorage.getItem('selectedFeatures') || '';

    // Split the string into an array of features
    var featureArray = selectedFeatures ? selectedFeatures.split(',') : [];

    if (featureArray.length === 0) {
        swal("Oops!", "Please select at least one feature!", "error");
    } else {
        window.location.href = '/freeAd5';
    }
}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>

@endsection
