@extends('layout')

@section('header')
    @parent
@endsection

@section('content')
<div class="container mt-5" id="bargainContent">
    <div class="row justify-content-center align-items-center">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mb-4">
            <div class="card text-center">
                <img src="{{ $free_ad['image_1'] }}" class="card-img-top mx-auto rounded" alt="Ad Image" style="width: 100%; max-width: 375px; height: auto;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;">{{ $free_ad['title'] }}</h5>
                    <p class="card-text" style="font-weight: bold;">Price: Rs. <span id="ownerPrice">{{ $free_ad['price'] }}</span></p>
                </div>
            </div>
        </div>

        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">
            <div class="container">
                <h1 class="heading-type-1 text-center">Make your bargain!</h1>
            </div>
            <div class="container pt-3">
                <form id="bargainingForm">
                    <div class="mb-3">
                        <label for="bargain_price" class="form-label">Bargain Price</label>
                        <input type="number" class="form-control py-3" id="bargainPrice" name="bargain_price" placeholder="Enter your bargain price" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control py-3" name="description" placeholder="Add details" required>
                    </div>

                    <div class="pt-3 text-start">
                        <button type="submit" id="submitBtn" class="btn btn-primary button-gap">Add Bargain Price</button>
                        <input type="hidden" name="free_ad_id" value="{{ $free_ad['id'] }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";

    $(document).ready(function() {
        $('#bargainingForm').on('submit', function(event) {
            event.preventDefault();

            var ownerPrice = parseFloat($('#ownerPrice').text());
            var bargainPrice = parseFloat($('#bargainPrice').val());

            if (isNaN(bargainPrice) || bargainPrice <= 0) {
                swal("Error!", "Bargain price must be a positive number.", "error");
                return;
            }

            if (bargainPrice >= ownerPrice) {
                swal("Error!", "Bargain price must be less than the owner's price.", "error");
                return;
            }

            // Clear previous errors
            $('.descriptionError').text('');
            $('.freeAdIdError').text('');

            // Change button text to indicate processing
            $('#submitBtn').text('Please wait...');

            // Serialize form data
            var formData = $(this).serialize();
            const token = sessionStorage.getItem('token');

            // AJAX request
            $.ajax({
                url: baseUrl+'/api/bargain_ads',
                type: 'POST',
                headers: {'Authorization': 'Bearer ' + token},
                data: formData,
                success: function(response) {
                    swal("Success!", response.message, "success");
                    $('#bargainingForm')[0].reset(); // Clear the form
                    $('#submitBtn').text('Submit');
                },
                error: function(xhr) {
                    console.log("Error", xhr);
                    let errorMessage;
                    try {
                        errorMessage = JSON.parse(xhr.responseText);
                    } catch (e) {
                        errorMessage = { message: 'Unexpected error occurred' };
                    }
                    
                    if (errorMessage.errors) {
                        var errors = errorMessage.errors;
                        if (errors.bargain_price) {
                            swal("Error!", errors.bargain_price[0], "error");
                        }
                        if (errors.description) {
                            swal("Error!", errors.description[0], "error");
                        }

                        if (errors.free_ad_id) {
                            swal("Error!", errors.free_ad_id[0], "error");
                        }
                    } else {
                        swal("Error!", xhr.responseText, "error");
                    }
                    $('#submitBtn').text('Submit');
                }
            });
        });
    });
</script>
@endsection
