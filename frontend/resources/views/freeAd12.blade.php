@extends('layout')
@section('header')
@parent
@endsection

@section('content')

<div class="container">
    <div class="container-fluid text-center">
        <h4 class="h5 m-0  mb-3"> Review </h4>
    </div>
    <form class="contactDetailsForm" method="POST" id="freeAdDetailsForm" action="">
        <div class="row justify-content-center align-item-center mb-1">
            <div class=" col-sm-4 col-md-4 col-lg-3 col-6">
                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3"
                            aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4"
                            aria-label="Slide 5"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img id="img1" src="" class="d-block w-100" alt="image 1">
                        </div>
                        <div class="carousel-item">
                            <img id="img2" src="" class="d-block w-100" alt="image 2">
                        </div>
                        <div class="carousel-item">
                            <img id="img3" src="" class="d-block w-100" alt="image 3">
                        </div>
                        <div class="carousel-item">
                            <img id="img4" src="" class="d-block w-100" alt="image 4">
                        </div>
                        <div class="carousel-item">
                            <img id="img5" src="" class="d-block w-100" alt="image 5">
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
            <p> <small> <a href="/freeAd8">Edit</a> </small> </p>
        </div>

        <div class="row justify-content-center">
            <ul class="col-lg-8">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col">
                            <h6>Price:</h6>
                        </div>
                        <div class="col">
                            <h6 class="text-success" id="displayPriceInput">Loading...</h6>
                            <h6 class="text-secondary " id="displayNegotiableValue">Loading...</h6>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a href="/freeAd7">Edit</a>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col">
                            <h6>Condition:</h6>
                        </div>
                        <div class="col">
                            <h6 class="text-secondary"id="displayCondition">Loading...</h6>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a href="/freeAd5">Edit</a>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col">
                            <h6>Model:</h6>
                        </div>
                        <div class="col">
                            <h6 class="text-secondary"id="displaySelectedBrand">Loading...</h6>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a href="/freeAd2">Edit</a>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col">
                            <h6>Version:</h6>
                        </div>
                        <div class="col">
                            <h6 class="text-secondary"id="displaySelectedTitle">Loading...</h6>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a href="/freeAd2">Edit</a>
                        </div>
                    </div>
                </li>
            
                <li class="list-group-item">
                    <div class="row">
                        <div class="col">
                            <h6>District:</h6>
                        </div>
                    <div class="col">
                            <h6 class="text-secondary"id="displayDistrict">Loading...</h6>
                        </div>
                        
                        <div class="col d-flex justify-content-end">
                            <a href="/freeAd10">Edit</a>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col">
                            <h6>Town:</h6>
                        </div>
                    <div class="col">
                            <h6 class="text-secondary"id="displayTown">Loading...</h6>
                        </div>
                        
                        <div class="col d-flex justify-content-end">
                            <a href="/freeAd10">Edit</a>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col">
                            <h6>Description:</h6>
                    </div>
                    <div class= "col text-truncate" >
                            <h6 class="text-secondary"id="displayDescriptionInput">Loading...</h6>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a id="editDiscription" href="/freeAd6/">Edit</a>
                        </div>
                    </div>
                </li>

            </ul>
        </div>

        <div class="d-flex col-lg-6 d-none d-sm-flex container-fluid justify-content-between pt-4 pb-4">
            <button class="btn btn-lg px-5" onclick="window.location.href='/freeAd10'">Cancel</button>
            <button class="btn btn-lg px-5" type="submit" id="postAdButton">Post ad</button>
        </div>

        <div class="d-flex flex-column col-lg-6 d-sm-none  container-fluid justify-content-between pt-4 pb-4">
            <button class="btn btn-lg mb-3 px-5" onclick="window.location.href='/freeAd10'">Cancel</button>
            <button class="btn btn-lg px-5" type="submit" id="postAdButton">Post ad</button>
        </div>

        <div class="progress" role="progressbar" aria-label="Success striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progressBar">
  <div class="progress-bar progress-bar-striped bg-success" style="width: 0%"></div>
</div>
</div>
    </form> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#adPostBtn').prop('disabled', true);
        const subCategory = encodeURIComponent(localStorage.getItem('subCategory'));
        const editDiscription = document.getElementById('editDiscription');
        editDiscription.href = `/freeAd6/${subCategory}`;

        const dataFields = ['priceInput', 'district', 'town', 'condition', 'selectedFeatures', 'descriptionInput', 'negotiableValue', 'selectedBrand', 'selectedTitle'];

        dataFields.forEach(field => {
            const value = localStorage.getItem(field);
            const element = document.getElementById(`display${field.charAt(0).toUpperCase() + field.slice(1)}`);
            
            if (element) {
                element.textContent = value ? value : `No ${field} available.`;
            }
        });

        for (let i = 1; i <= 5; i++) {
            const base64Image = localStorage.getItem(`image${i}`);
            if (base64Image) {
                document.getElementById(`img${i}`).setAttribute('src', base64Image);
            }
        }

        const negotiableValue = localStorage.getItem('negotiableValue') === 'true';
        const negotiableElement = document.getElementById('displayNegotiableValue');

        if (negotiableElement) {
            if (negotiableValue) {
                negotiableElement.textContent = 'Negotiable';
            } else {
                negotiableElement.textContent = '';
            }
        }
    });

    function base64ToFile(base64, filename, mimeType) {
        let byteString = atob(base64.split(',')[1]);
        let ab = new ArrayBuffer(byteString.length);
        let ia = new Uint8Array(ab);
        for (let i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new File([ab], filename, { type: mimeType });
    }

    $(document).ready(function() {
        const description = localStorage.getItem('descriptionInput');
        const sub_category = localStorage.getItem('subCategory');
        const category = localStorage.getItem('category');
        const condition = localStorage.getItem('condition');
        const brand = localStorage.getItem('selectedBrand');
        const title = localStorage.getItem('selectedTitle');
        const price = localStorage.getItem('priceInput');
        const district = localStorage.getItem('district');
        const town = localStorage.getItem('town');
        const negotiable = localStorage.getItem('negotiableValue');

        async function getSubCategoryData(sub_category) {
            const data = new FormData();
            try {
                const response = await fetch(`http://127.0.0.1:8008/api/getFeatureTableColumns?subCategory=${sub_category}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                });

                const result = await response.json();

                if (response.ok) {
                    const featureColumns = result.data;
                    featureColumns.forEach(column => {
                        data.append(column, localStorage.getItem(column) || '');
                    });
                } else {
                    console.error(result.message);
                }
            } catch (error) {
                console.error('Error fetching feature columns:', error);
            }
            return data;
        }

        async function getFeatureTableName(sub_category) {
            try {
                const response = await fetch(`http://127.0.0.1:8008/api/getFeatureTableName?subCategory=${sub_category}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                       'Content-Type': 'application/json',
                    },
                });

                const result = await response.json();
                if (response.ok) {
                    return result.data;
                } else {
                    console.error(result.message);
                    return null;
                }
            } catch (error) {
                console.error('Error fetching feature table name:', error);
                return null;
            }
        }

        async function postSubCategoryData(sub_category, response) {
            const subcategoryData = await getSubCategoryData(sub_category);
            subcategoryData.append('freeAd_id', response.id);
            subcategoryData.append('subCategory', sub_category);

            const featureTableName = await getFeatureTableName(sub_category);
            if (!featureTableName) {
                console.error('Failed to get feature table name');
                return;
            }

            const endpoint = `http://127.0.0.1:8008/api/storeSubCategoryFeatures`;

            $.ajax({
                url: endpoint,
                type: 'POST',
                data: subcategoryData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log("Second request successful: " + response);
                    localStorage.clear();
                    updateProgressBar(100);
                    if (response.status == 201) {
                        swal("Good job!", "FreeAd posting is successful!", "success");
                    }
                    console.log("Local storage cleared");
                    setTimeout(() => {
                        window.location.href = "/my/ads";
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    console.error("Second request failed: " + xhr.responseText);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: xhr.responseText,
                    });

                    $.ajax({
                        url: 'http://127.0.0.1:8008/api/free_adCreate',
                        type: 'DELETE',
                        data: { id: response.id },
                        success: function(deleteResponse) {
                            console.log("First record deleted: " + deleteResponse);
                        },
                        error: function(deleteXhr, deleteStatus, deleteError) {
                            console.error("Failed to delete first record: " + deleteXhr.responseText);
                        }
                    });
                }
            });
        }

        function sendImagesToServer() {
            const formData = new FormData();

            for (let i = 1; i <= 5; i++) {
                const base64Image = localStorage.getItem(`image${i}`);
                if (base64Image) {
                    const file = base64ToFile(base64Image, `image${i}.jpg`, 'image/jpeg');
                    formData.append(`image_${i}`, file);
                }
            }

            formData.append('description', description);
            formData.append('sub_category', sub_category);
            formData.append('category', category);
            formData.append('brand', brand);
            formData.append('condition', condition);
            formData.append('title', title);
            formData.append('price', price);
            formData.append('district', district);
            formData.append('town', town);
            formData.append('negotiable', negotiable);

            const token = sessionStorage.getItem('token');

            $.ajax({
                url: 'http://127.0.0.1:8008/api/free_adCreate',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log("Successful: " + response);
                    updateProgressBar(50);
                    console.log("id - " + response.id);

                    postSubCategoryData(sub_category, response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    swal("Oops!", "An error occurred while processing your request.", "error");
                }
            });
        }

        $('#freeAdDetailsForm').submit(function(e) {
            updateProgressBar(10);
            e.preventDefault();
            sendImagesToServer();
        });
    });

    function updateProgressBar(progress) {
        const progressBar = document.getElementById('progressBar').children[0];
        progressBar.style.width = `${progress}%`;
        progressBar.setAttribute('aria-valuenow', progress);
    }
</script>

@endsection
