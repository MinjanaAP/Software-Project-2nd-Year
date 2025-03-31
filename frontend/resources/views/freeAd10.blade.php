
        @extends('layout')
        @section('header')
        @parent
        @endsection

        @section('content')

        <section class="freead-main" id="freead-main">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="container-lg text-center">
                        <h1 class="heading-type-1">Location</h1>
                        <p class="heading-type-2">Where are you selling this item?</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="freead-image" id="freead-image">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-4 col-lg-3 col-6">
                        <img src="{{URL('image/freeAd10.svg')}}" class="img-fluid" alt="Edition-page"> 
                    </div>
                </div>
            </div>
        </section>

        <section class="location_inputs">
            <div class="container">
                <form>
                    <div class="col-lg-6 mx-auto">
                        <!-- <input id ="location" type="text" class="form-control" placeholder="Enter the location">
                        -->
                        <div class="form-group">
                                <label for="district">District</label><br>
                                
                                <select name="district" id="district" class="form-control">
                                    <option value="">Select District</option>
                                    @foreach ($data as $district)
                                        <option value="{{ $district }}">{{ $district }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="town" id="town-label">Town</label><br>
                                <select id="town" name="town" class="form-control">
                                    <option value="">Select Town</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                    </div>
                </form>
            </div>
        </section>
       

        <section class="next_and_back_button">
            <div class="container">
                <div class="row mt-4">
                    <div class="d-flex col-lg-6  container-fluid justify-content-between pt-4 pb-4">
                        <button class="btn btn-lg px-5"
                            onclick="window.location.href='/freeAd8'"
                        >Back</button>
                        <button id="submit" class="submit btn btn-lg px-5" type="submit"
                            onclick="saveAndNavigate()"
                        >Next</button>
                    </div>        
                </div>
            </div>
        </section>
        <script>
            var baseUrl = "{{ env('APP_BASE_URL') }}";
            $(document).ready(function(){
                $('#adPostBtn').prop('disabled', true);
        $('#town').prop('disabled', true);
        $('#district').on('change', function() {
            var selectedDistrict = $(this).val();
            $.ajax({
                
                url: baseUrl+'/api/town/getSpecificTowns', // Route to your backend endpoint
                type: 'POST',
                data: { district: selectedDistrict },
                success: function(response) {
                    //console.log(response);
                    $('#town').prop('disabled', false);
                    var townsDropdown = $('#town'); 
                    
                    townsDropdown.empty(); 
                    townsDropdown.append($('<option>').text('Select Town').val(''));
                    townsDropdown.append($('<option>').text('other').val('other'));
                    $.each(response.data, function(index, town) { 
                        townsDropdown.append($('<option>').text(town).val(town)); 
                    });
                    
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

    });
            
function saveAndNavigate() {
    // Retrieve location input
    var districtInput = document.getElementById('district').value.trim(); // trim remove white spaces in user inputs
    var townInput = document.getElementById('town').value.trim();
    
    // Store location input in local storage
    localStorage.setItem('district', districtInput);
    localStorage.setItem('town', townInput);

    validateInputFields();
    
}

// Function to load stored values on page load
function loadStoredValues() {
    var storedDistrict = localStorage.getItem('district');
    var storedTown = localStorage.getItem('town');

    if (storedDistrict) {
        document.getElementById('district').value = storedDistrict;
    }

    if (storedTown) {
        document.getElementById('town').value = storedTown;
    }
}

function validateInputFields() {
        let valid = true;
            if (!localStorage.getItem("district") || !localStorage.getItem("town")) {
                valid = false;
            }
        if (valid) {
            window.location.href = '/freeAd11';
        } else {
            Swal.fire({
                        icon: "question",
                        title: "OOPs!",
                        text: "Please select District and town",
                });
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
   