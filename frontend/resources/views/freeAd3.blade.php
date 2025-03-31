
        @extends('layout')
        @section('header')
        @parent
        @endsection

        @section('content')

        <section class="freead-main" id="freead-main">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="container-lg text-center">
                        <h1 class="heading-type-1">Edition (Optional)</h1>
                        <p class="heading-type-2">Choose the edition of the Mobile</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="freead-image" id="freead-image">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-4 col-lg-3 col-6">
                    <img src="{{URL('image/freeAd4.svg')}}" class="img-fluid" alt="Edition-page">
                    </div>
                </div>
            </div>
        </section>

        
        <section class="version_inputs" >
            <div class="container">
                <form>
                    <div class="col-lg-6 mx-auto mt-4" id="content" >
                       
                    </div>
                </form>
            </div>
        </section>
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
        let selectedBrand = localStorage.getItem('selectedBrand');
        let selectedTitle = localStorage.getItem('selectedTitle');

        if (selectedBrand === null || selectedBrand === "null") {
            document.getElementById('content').innerHTML = `
                <input id="brand" type="text" class="form-control mt-4" placeholder="Brand Name">
                <input id="version" type="text" class="form-control mt-4" placeholder="Version">
            `;
        } else if (selectedTitle === null || selectedTitle === "null") {
            document.getElementById('content').innerHTML = `
                <input id="version" type="text" class="form-control" placeholder="Version">
            `;
        } else {
            document.getElementById('content').innerHTML = `
                <input id="version" type="text" class="form-control" placeholder="Version">
            `;
        }
    });
        </script>

       
        <section class="next_and_back_button">
            <div class="container">
                <div class="row mt-4">
                    <div class="d-flex col-lg-6  container-fluid justify-content-between pt-4 pb-4">
                        <button class="btn btn-lg px-5"
                            onclick="window.location.href='/freeAd2'"
                        >Back</button>
                        <button id="submit" class="btn btn-lg px-5" type="submit"
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
    var brandInput = document.getElementById('brand');
    var versionInput = document.getElementById('version');

    // Store  input in local storage
    if (brandInput) {
            var selectedBrand = brandInput.value;
            localStorage.setItem('selectedBrand', selectedBrand);
        }
        
        if (versionInput) {
            var selectedTitle = versionInput.value;
            localStorage.setItem('selectedTitle', selectedTitle);
        }

        var sub_category = localStorage.getItem('subCategory');
        if(sub_category === 'Mobile phones'){
            window.location.href = '/freeAd4';
        }else{
            window.location.href = '/freeAd5';
        }
}

</script>

        <script src="" async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
@endsection
  