
        @extends('layout')
        @section('header')
        @parent
        @endsection

        @section('content')
        <section class="freead-main" id="freead-main">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="container-lg text-center">
                        <h1 class="heading-type-1">Price</h1>
                        <p class="heading-type-2">Pick a good price</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="freead-image" id="freead-image">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-4 col-lg-3 col-6">
                        <img src="{{URL('image/freeAd7.svg')}}" class="img-fluid" alt="Edition-page"> 
                    </div>
                </div>
            </div>
        </section>

        <section class="Price_inputs">
            <div class="container">
                <form>
                    <div class="col-lg-6 mx-auto">
                        <input id=price type="text" class="form-control" placeholder="Rs." style="margin-bottom: 10px;">
                        <label style="display: flex; align-items: center; margin-right: 10px; margin-left: 2px;">
                     <input type="checkbox" id="negotiable" style="margin-right: 5px;">
                        Negotiable
                 </label>
                    </div>
                   
                </form>
            </div>
        </section>

        <section class="next_and_back_button">
            <div class="container">
                <div class="row mt-4">
                    <div class="d-flex col-lg-6  container-fluid justify-content-between pt-4 pb-4">
                        <button class="btn btn-lg px-5"
                            onclick="window.location.href=`/freeAd6/${encodeURIComponent(localStorage.getItem('subCategory'))}`">Back
                        </button>
                        <button id=submit class="submit btn btn-lg px-5" type="submit"
                            onclick="saveAndNavigate()"
                        >Next</button>
                    </div>        
                </div>
            </div>
        </section>
        <script>
            $('#adPostBtn').prop('disabled', true);
function saveAndNavigate() {
    // Retrieve price input
    var priceInput = document.getElementById('price').value;

 // Retrieve checkbox state
 var negotiableCheckbox = document.querySelector('input[type="checkbox"]');
    var negotiableValue = negotiableCheckbox.checked;

    // Validate the presence of price input
    if (!priceInput) {
        // Display an error message if the price input is empty
        // swal("Oops!", "Price should be included!", "error");
        Swal.fire({
                        icon: "question",
                        title: "OOPs!",
                        text: "Price should be included!",
                });
        return;
    }

    // Validate the format of the price input
    if (!isValidPrice(priceInput)) {
        // Display an error message if the price is not numeric
        //swal("Oops!", "Price must be a numeric value!", "error");
        Swal.fire({
                        icon: "question",
                        title: "OOPs!",
                        text: "Please enter a valid price.",
                });
        return;
    }

    // Store price input in local storage
    localStorage.setItem('priceInput', priceInput);
    localStorage.setItem('negotiableValue', negotiableValue);
    // Navigate to the next page
    window.location.href = '/freeAd8';
}

// Function to validate the price
function isValidPrice(price) {
    // Ensure the price is a number and greater than zero
    if (isNaN(price) || price <= 0) {
        return false;
    }
    // price can be a positive integer or floating point number with up to two decimal places
    var priceRegex = /^\d+(\.\d{1,2})?$/;
    return priceRegex.test(price);
}
// Function to load stored values on page load
function loadStoredValues() {
    var storedPrice = localStorage.getItem('priceInput');
    var storedNegotiable = localStorage.getItem('negotiableValue') === 'true';

    if (storedPrice) {
        document.getElementById('price').value = storedPrice;
    }

    if (storedNegotiable) {
        document.getElementById('negotiable').checked = storedNegotiable;
    }
}

// Attach event listeners and load stored values on page load
document.addEventListener('DOMContentLoaded', function() {
    loadStoredValues();
});
</script>



        <script src="" async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
        @endsection
    