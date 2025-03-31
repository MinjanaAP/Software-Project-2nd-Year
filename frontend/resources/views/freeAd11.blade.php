@extends('layout')

@section('header')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="container-fluid text-center">
            <h6 class="h5 m-0  mb-0"> Contact details </h6>
            <p> <small> Enter your contact details. </small> </p>
        </div>
        <form class="contactDetailsForm" method="POST" id="contactDeForm" action=>
         
            <div class="row justify-content-center">
                <ul class="col-lg-8">
                    <li class="list-group-item" id="telephone_no_1_display" >
                        <div class="row">
                            <div class="col">
                                <h6>Phone number(s):</h6>
                                <div class="row">
                                    <div class="col d-flex">
                                        <img src="{{ URL('images/verified-n.png') }}" alt="verified" class="image-fluid">
                                        <h6 class="text-secondary" id="user-phone"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item" id="telephone_no_1_container">
                        <div class="row">
                            <div class="col">
                                <label for="telephone_no_1" class="form-label"><h6>Add phone number</h6></label>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="telephone_no_1" name="telephone_no_1" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" id="addPhoneNumber1Btn" type="button">Add</button>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col">
                                <label for="telephone_no_2" class="form-label"><h6>Add additional phone number(optional)</h6></label>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="telephone_no_2" name="telephone_no_2" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" id="addPhoneNumber2Btn" type="button">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            This phone number will only be displayed on your ad. You cannot use it to log in.
                        </div>
                    </li>
                </ul>
            </div>
            <div class="row justify-content-center">
                <ul class="col-lg-8">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="form-group">
                                <label for="exampleFormControlInput1" class="form-label">Email address:</label>
                                <h6 class="text-secondary" id="user-email"></h6>
                                <!-- <input type="email" class="form-control w-100" id="exampleFormControlInput1" name="emailAddress" placeholder="name@example.com"> -->
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
    </div>
    <div class="d-flex col-lg-6 d-none d-sm-flex container-fluid justify-content-between pt-4 pb-4">
        <button class="btn btn-lg px-5"   onclick="window.location.href='/freeAd10'">Cancel</button>
        <button class="btn btn-lg px-5" type="submit" id="submitBtn">Next</button>
    </div>
    <div class="d-flex flex-column col-lg-6 d-sm-none container-fluid justify-content-between pt-4 pb-4">
             <button class="btn btn-lg mb-3 px-5"   onclick="window.location.href='/freeAd10'">Cancel</button>
                <button class="btn btn-lg px-5" type="submit" id="submitBtn">Next</button>
            </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        $(document).ready(function() {
            $('#adPostBtn').prop('disabled', true);
            const token = sessionStorage.getItem("token");
                $.ajax({
                    url: baseUrl+'/api/auth/validate_token',
                    type: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function(response) {
                        if (response.user.telephone_no_1) {
                            $('#user-phone').text(response.user.telephone_no_1);
                            $('#telephone_no_1_container').hide();
                        } else {
                            $('#telephone_no_1_display').hide();
                            $('#telephone_no_1_container').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });


            // Function to validate phone number
            function validatePhoneNumber(phoneNumber) {
                var mobileValidationPattern = /^(?:\+?94|0)(?:[1-9]\d?|7\d)\d{7}$/;
                return mobileValidationPattern.test(phoneNumber);
            }
            //send mobile number 1 to database
            $('#addPhoneNumber1Btn').click(function(){
                    var telephone_no_1 = $('#telephone_no_1').val();
                    if (!validatePhoneNumber(telephone_no_1)) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Please enter a valid phone number",
                        });
                        return;
                    }

                    $.ajax({
                        url: baseUrl + '/api/my/addMobileNumber',
                        type: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        data: { telephone_no_1: telephone_no_1 },
                        success: function(response) {
                            console.log("Mobile number_1 added. " + response);
                            $('#user-phone').text(telephone_no_1);
                            $('#telephone_no_1_container').hide();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: xhr.responseText,
                            });
                        }
                    });
                });

                $('#addPhoneNumber2Btn').click(function(){
                    var telephone_no_2 = $('#telephone_no_2').val();
                    if (!validatePhoneNumber(telephone_no_2)) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Please enter a valid phone number",
                        });
                        return;
                    }

                    $.ajax({
                        url: baseUrl + '/api/my/addMobileNumber',
                        type: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        data: { telephone_no_2: telephone_no_2 },
                        success: function(response) {
                            console.log("Mobile number_2 added. " + response);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: xhr.responseText,
                            });
                        }
                    });
                });


            // Attach form submission event handler
            $('#contactDeForm').submit(function(e) {
                e.preventDefault();

                // Get form data
                // var email = $('#exampleFormControlInput1').val();
                // var phoneNumber = $('#telephone_no_2').val();

                // // Validate phone number
                // if (!phoneNumber) {
                //     swal("Oops!", "Please enter a phone number.", "error");
                //     return;
                // }

                // if (!validatePhoneNumber(phoneNumber)) {
                //     swal("Oops!", "Please enter a valid phone number.", "error");
                //     return;
                // }

                // Navigate to freeAd12 page
                window.location.href = '/freeAd12';
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endsection