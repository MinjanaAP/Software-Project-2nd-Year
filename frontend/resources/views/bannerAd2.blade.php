@extends('layout')
@section('header')
@parent
@endsection

@section('content')

<section class="paidad-form" id="paidad">
    <div class="container justify-content-center">
        <div class="form-layout mt-3 col-12 justify-content-center">

            <p class="main-1" id="figureName"></p>
            <p class="main-2" id="figureDescription"></br></p>  
            <div class="col-12" id="figureAD">
                <img src="" id="contentImg" alt="Banner Image" class="banner-image mt-3 w-100">
            </div>
            <div class="col-4" id="figureBC">
                <img src="" id="contentImg" alt="Banner Image" class="banner-image mt-3">
            </div>
            <p class="main-3">RS.<span id="price"></span></p>
            <p class="main-4">Upload Banner</p>

            <form class="px-2" id="userLoginForm" enctype="multipart/form-data">
                <input type="hidden" id="paid_ad_type">
                <div class="row justify-content-center">
                    <div class="label-layout col-3 col-sm-3">
                        <label for="name">Name</label>
                    </div>
                    <input class="input-layout col-8" type="text" id="name" name="name" placeholder="Nimal Perera">
                </div>
                <div class="row mb-3">
                    <div class="col-3"></div>
                    <div class="spanrow col-8">
                        <span id="name-error" class="text-danger"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="label-layout col-3">
                        <label for="address">Address</label>
                    </div>
                    <input class="input-layout col-8" type="text" id="address" name="address" placeholder="Dialog PVT Ltd - Colombo 3">
                </div>
                <div class="row mb-3">
                    <div class="col-3"></div>
                    <div class="col-8">
                        <span id="address-error" class="text-danger"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="label-layout col-3">
                        <label for="number">Contact Number</label>
                    </div>
                    <input class="input-layout col-8" type="text" id="number" name="number" placeholder="0711234567">
                </div>
                <div class="row mb-3">
                    <div class="col-3"></div>
                    <div class="col-8">
                        <span id="number-error" class="text-danger"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="label-layout col-3">
                        <label for="email">Email Address</label>
                    </div>
                    <input class="input-layout col-8" type="email" id="email" name="email" placeholder="dialog@gmail.com">
                </div>
                <div class="row mb-3">
                    <div class="col-3"></div>
                    <div class="col-8">
                        <span id="email-error" class="text-danger"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="label-layout col-3">
                        <label for="url">URL Link Upload</label>
                    </div>
                    <input class="input-layout col-8" type="url" id="url" name="url" placeholder="https://dialog.lk/">
                </div>
                <div class="row mb-3">
                    <div class="col-3"></div>
                    <div class="col-8">
                        <span id="url-error" class="text-danger"></span>
                    </div>
                </div>

                <section class="bg-diffrent">
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div class="file-upload-contain">
                                <input name="image" id="image" type="file" accept=".jpg,.gif,.png,.jpeg" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <span id="image-error" class="span text-danger"></span>
                    </div>
                </section>

                <div class="d-flex col-lg-12 d-none d-sm-flex container-fluid justify-content-between pt-4">
                    <button class="btn btn-lg px-5" id="cancelButton" type="button">Cancel</button>
                    <button class="btn btn-lg px-5" type="submit">Next</button>
                </div>
                <div class="d-flex flex-column col-lg-12 d-sm-none container-fluid justify-content-between pt-4">
                    <button class="btn btn-lg mb-3 px-5" id="cancelButton" type="button">Cancel</button>
                    <button class="btn btn-lg px-5" type="submit">Next</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        const figureData = JSON.parse(localStorage.getItem('figureData'));
        console.log("Retrieved figure data:", figureData);
    
        if (figureData) {
            if (figureData.name === "Figure A" || figureData.name === "Figure D") {
                $('#figureAD').show();
                $('#figureBC').hide();
            } else {
                $('#figureBC').show();
                $('#figureAD').hide();
            }
            $('#figureName').text(figureData.name);
            $('#figureDescription').text(figureData.description);
            $('.banner-image').attr('src', figureData.image);
            $('#price').text(figureData.price);
        }

        $('#cancelButton').click(function() {
            window.location.href = 'bannerAd1';
        });

        $('#userLoginForm').submit(function(e) {
            e.preventDefault();
            let isValid = true;

            // Clear previous error messages
            $('#name-error').text('');
            $('#address-error').text('');
            $('#number-error').text('');
            $('#email-error').text('');
            $('#url-error').text('');
            $('#image-error').text('');

            // Validation checks
            const name = $('#name').val().trim();
            const address = $('#address').val().trim();
            const number = $('#number').val().trim();
            const email = $('#email').val().trim();
            const url = $('#url').val().trim();
            const image = $('#image')[0].files[0];

            if (!name) {
                $('#name-error').text('Name is required.');
                isValid = false;
            }
            if (!address) {
                $('#address-error').text('Address is required.');
                isValid = false;
            }
            if (!number) {
                $('#number-error').text('Contact number is required.');
                isValid = false;
            }else if (!validateNumber(number)) {
                $('#number-error').text('Invalid contact number format.');
                isValid = false;
            }
            if (!email) {
                $('#email-error').text('Email is required.');
                isValid = false;
            } else if (!validateEmail(email)) {
                $('#email-error').text('Invalid email format.');
                isValid = false;
            }
            // if (!url) {
            //     $('#url-error').text('URL is required.');
            //     isValid = false;
            // } else if (!validateURL(url)) {
            //     $('#url-error').text('Invalid URL format.');
            //     isValid = false;
            // }
            if (!image) {
                $('#image-error').text('Image is required.');
                isValid = false;
            } else if (!['image/jpeg', 'image/png', 'image/gif'].includes(image.type)) {
                $('#image-error').text('Invalid image format. Only JPG,JPEG, PNG, and GIF are allowed.');
                isValid = false;
            }

            if (!isValid) return;

            var formData = new FormData(this);

            //paid ad type checking
            if(figureData.name==='Figure A'){                
                figureData.name='figure_A';
            }

            else if(figureData.name==='Figure B'){
                figureData.name='figure_B';
            }

            else if(figureData.name==='Figure C'){
                figureData.name='figure_C';
            }

            else if(figureData.name==='Figure D'){
                figureData.name='figure_D';
                return;
            }
            

            //get the paid ad type
            formData.append('paid_ad_type', figureData.name);
            console.log(formData);

            var token = sessionStorage.getItem('token');
            if (!token) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "No authentication token found. Please login.",
                });
                return;
            }

            $.ajax({
                url: 'http://127.0.0.1:8008/api/paid_adCreate',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Your advertisement creation success.",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'bannerAd1';
                        }
                    });
                    
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 401) {
                        Swal.fire({
                            icon: "error",
                            title: "Unauthorized",
                            text: "Your session has expired or you are not authorized. Please login again.",
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: xhr.responseText,
                        });
                    }
                }
            });
        });

        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()[\]\\.,;:\s@"]+\.)+[^<>()[\]\\.,;:\s@"]{2,})$/i;
            return re.test(String(email).toLowerCase());
        }

        // function validateURL(url) {
        //     // const re = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([/\w .-])\/?$/;
        //     const re =/^(https?:\/\/)?((([a-z\d]([a-z\d-][a-z\d]))\.)+[a-z]{2,}|((\d{1,3}\.){3}\d{1,3}))(:\d+)?(\/[-a-z\d%.~+])(\?[;&a-z\d%.~+=-])?(\#[-a-z\d_])?$/i;

        //     return re.test(String(url).toLowerCase());
        // }

        function validateNumber(number) {
        // You can define your own validation logic for phone numbers here.
        // Example: Allow only digits and require specific length or format.
            const re = /^[0-9]{10}$/; // Example: 10-digit phone number
            return re.test(number);
        }

       

    });
</script>
@endsection