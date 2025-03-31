
        @extends('layout')
        @section('header')
        @parent
        @endsection

        @section('content')
        <section class="freead-main" id="freead-main">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="container-lg text-center">
                        <h1 class="heading-type-1">Description</h1>
                        <p class="heading-type-2">Enter more details about your product</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="freead-image" id="freead-image">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-4 col-lg-3 col-6"> 
                        <img src="{{URL('image/freeAd6.svg')}}" class="img-fluid" alt="Edition-page">  
                    </div>
                </div>
            </div>
        </section>

        <section class="description_inputs">
            <div class="container">

                <form>
              
                    <div class="col-lg-6 mx-auto">
                        <div class="row">
                                @foreach($data as $index => $detail)
                                    <div class="col-lg-6 mx-auto pb-4" id="detail-container-{{ $index }}">
                                        <label for="detail{{ $index }} ">{{ $detail }}</label>
                                        <input id="detail{{ $index }}" type="text" class="form-control" placeholder="{{ $detail }}">
                                    </div>
                                    
                                    @if(($index + 1) % 2 == 0)
                                        </div><div class="row">
                                    @endif
                                @endforeach
                        </div>
                    </div>

                    <div class="col-lg-6 mx-auto">
                        <label for="description" >Description</label>
                        <textarea id="description" class="form-control" placeholder="Type something..." style="height: 100px"></textarea>
                    </div>
                </form>
            </div>
        </section>

        <section class="next_and_back_button">
            <div class="container">
                <div class="row mt-4">
                    <div class="d-flex col-lg-6  container-fluid justify-content-between pt-4 pb-4">
                        <button class="btn btn-lg px-5"
                            onclick="window.location.href='/freeAd5'"
                        >Back</button>
                        <button class="btn btn-lg px-5" type="submit"
                            onclick="saveAndNavigate()"
                        >Next</button>
                    </div>        
                </div>
            </div>
        </section>
        <script>
            $('#adPostBtn').prop('disabled', true);
function saveAndNavigate() {
    // Retrieve description input
    var descriptionInput = document.getElementById('description').value;
    
    @foreach($data as $index => $detail)
        var detailValue{{ $index }} = document.getElementById('detail{{ $index }}').value;
        localStorage.setItem('{{ $detail }}', detailValue{{ $index }});
    @endforeach

   
     //Validate details field
   let valid = true;
//    @foreach($data as $index => $detail)
//             if (!localStorage.getItem("{{ $detail }}")) {
//                 valid = false;
//             }
//             @endforeach        
        if (valid) {
            window.location.href = '/freeAd7';
        } else {
            Swal.fire({
                        icon: "question",
                        title: "OOPs!",
                        text: "All details should be included!",
                });
        }

    
     


    // Validate the description input
    if (!descriptionInput) {
        // Display an error message if the description is empty
        // swal("Oops!", "Description should be included!", "error");
        Swal.fire({
                        icon: "question",
                        title: "OOPs!",
                        text: "Description field is required!",
                });
        return;
    }

    // Validate the length of the description input
    if (descriptionInput.length < 10 || descriptionInput.length > 500) {
        Swal.fire({
                        icon: "question",
                        title: "OOPs!",
                        text: "Description should be between 10 and 500 characters!",
                });
        return;
    }

    // Store description input in local storage
    localStorage.setItem('descriptionInput', descriptionInput);

  

}
// Function to load stored values on page load
function loadStoredValues() {
    var storedDescription = localStorage.getItem('descriptionInput');

    if (storedDescription) {
        document.getElementById('description').value = storedDescription;
    }

    @foreach($data as $index => $detail)
    var storedDetailValue{{ $index }} = localStorage.getItem('{{ $detail }}');
    if (storedDetailValue{{ $index }}) {
        document.getElementById('detail{{ $index }}').value = storedDetailValue{{ $index }};
    }
    @endforeach
}

// Function to conditionally hide used time period input
function checkConditionAndHide() {
    var condition = localStorage.getItem('condition');
    if (condition === 'New') {
        @foreach($data as $index => $detail)
            @if($detail == 'Used_time_period')
            document.getElementById('detail{{ $index }}').value = 'Not used';
            @endif
        @endforeach
    }
}


// Attach event listeners and load stored values on page load
document.addEventListener('DOMContentLoaded', function() {
    loadStoredValues();
    checkConditionAndHide();
});
</script>

       
        <script src="" async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
        @endsection
   