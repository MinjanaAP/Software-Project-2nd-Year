@extends('layouts.userProfileLayouts')
@section('content')

<section class="my-profile mt-5 " id="my-profile">
    <div class="container-lg mt-3">
        <div class="row justify-content-center align-items-center">

            <!-- ----------left side------------>
            <div class="profile d-flex d-sm-none align-items-center ms-3">
               
            </div>
            
            <div class="col-sm-4 col-xl-3">
                
                @include('userProfilePages.sideNavBar')
                

            </div>

            <!-- ----------right side---------- -->
            <div class="col-sm-8 col-xl-8 col-12 d-sm-flex">
                <div class="card w-100">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        <form class="editProfileForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <p class="name">
                                    <div class="spinner-border text-secondary" role="status" id="spinner-name">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" >
                            </div>
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
                                <label for="town" id="town-label">Town</label>
                                    <div class="spinner-border text-secondary" role="status" id="spinner-town">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                <br>
                                <select id="town" name="town" class="form-control">
                                    <option value="">Select Town</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" class="form-control" id="profile_image" name="profile_image">
                            </div>
                            <button type="submit" class="btn btn-primary" id="updateBtn">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ----------right side end---------- -->

        </div>
    </div>
</section>
<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
    $(document).ready(function(){
        $('#setting').addClass('activeTag');

        $('#spinner-town').hide();
        $('#town').prop('disabled', true);
        function isLoggedIn() {
            return sessionStorage.getItem('token') !== null;
        }

        if (!isLoggedIn()) {
            Swal.fire({
            title: "You're not logged in!",
            text: "Please log in to view this page.",
            icon: "question"
            });
            setTimeout(() => {
                window.location.href = "/my/profile";
            }, 2000);
            
        }
        $('#district').on('change', function() {
            var selectedDistrict = $(this).val();
            $('#spinner-town').show();
            $.ajax({
                
                url: baseUrl + '/api/town/getSpecificTowns', // Route to your backend endpoint
                type: 'POST',
                data: { district: selectedDistrict },
                success: function(response) {
                    //console.log(response);
                    $('#town').prop('disabled', false);
                    var townsDropdown = $('#town'); 
                    $('#spinner-town').hide();

                    townsDropdown.empty(); 
                    townsDropdown.append($('<option>').text('Select Town').val(''));
                    $.each(response.data, function(index, town) { 
                        townsDropdown.append($('<option>').text(town).val(town)); 
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        $('.editProfileForm').submit(function(e){
        e.preventDefault();
        $('#updateBtn').text('Please wait...');

        var formData = new FormData(this);
        const token = sessionStorage.getItem('token');

        $.ajax({
            url:baseUrl +  '/api/my/profile/edit', 
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token 
            },
            data: formData,
            processData: false, // Important!
            contentType: false, // Important!
            success: function(response){
                Swal.fire({
                    icon: "success",
                    title: "SuccessFull",
                    text: response.message,
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
                $('#updateBtn').text('Save Changes');
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: xhr.responseText,
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
                $('#updateBtn').text('Save Changes');
            }
        });
    });
    });


        

        
</script>
@endsection

