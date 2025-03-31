@extends('layouts.adminLayout')

@section('content')
    
    <div class="container-lg adminFreeAds">
        <h1 class="adminHeading-2 text mb-2">Free Advertisements edit</h1>
        <div class="container col-6 mt-5">
            <h1 class="text-center">Edit Ad</h1>
    
            {{-- @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
    
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif --}}
    
            <form id="freeAdsEditForm" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $ad['id'] }}">
    
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $ad['title'] }}" required>
                </div>
    
                <div class="form-group mb-3">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $ad['price'] }}" required readonly>
                </div>
    
                <div class="form-group mb-3">
                    <label for="sub_category">Sub Category</label>
                    <input type="text" class="form-control" id="sub_category" name="sub_category" value="{{ $ad['sub_category'] }}" required>
                </div>
    
                <div class="form-group mb-3">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ $ad['category'] }}" required>
                </div>
    
                <div class="form-group mb-3">
                    <label for="condition">Condition</label>
                    <input type="text" class="form-control" id="condition" name="condition" value="{{ $ad['condition']}}" required>
                </div>
    
                <div class="form-group mb-3">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" id="brand" name="brand" value="{{ $ad['brand'] }}" required>
                </div>
    
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" required>{{ $ad['description'] }}</textarea>
                </div>
    
                <div class="form-group mb-3">
                    <label for="district">District</label>
                    <input type="text" class="form-control" id="district" name="district" value="{{ $ad['district'] }}" required>
                </div>
    
                <div class="form-group mb-3">
                    <label for="town">Town</label>
                    <input type="text" class="form-control" id="town" name="town" value="{{ $ad['town'] }}" required>
                </div>
    
                <div class="form-group mb-3">
                    <label for="negotiable">Negotiable</label>
                    <input type="text" class="form-control" id="negotiable" name="negotiable" value="{{ $ad['negotiable'] }}" required>
                </div>

                <p >Created At : <span id="date"></span></p>

                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="pending" {{ $ad['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="live" {{ $ad['status'] == 'live' ? 'selected' : '' }}>Live</option>
                        <option value="blocked" {{ $ad['status'] == 'blocked' ? 'selected' : '' }} id='blockOption'>Blocked</option>
                    </select>
                </div>

                @for ($i = 1; $i <= 5; $i++)
                <div class="form-group">
                    <label for="image_{{ $i }}">Image {{ $i }}</label>
                    @if($ad['image_' . $i])
                        <div class="mt-2">
                            <img src="{{ $ad['image_' . $i] }}" alt="Image {{ $i }}" class="img-thumbnail">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="image_{{ $i }}" name="image_{{ $i }}" value="{{ $ad['image_' . $i] }}" checked>
                                <label class="form-check-label" for="image_{{ $i }}">Keep Image</label>
                            </div>
                        </div>
                    @endif
                    {{-- <input type="file" class="form-control-file mt-2" id="image_{{ $i }}" name="image_{{ $i }}"> --}}
                </div>
            @endfor
                <p><b>First Name:</b> {{$user['first_name']}}</p>
                <p><b>Email:</b> {{$user['email']}}</p>
                <p><b>Telephone No:</b> {{$user['telephone_no_1']}}</p>
                <p><b>Sign up at:</b><span id="signupdate"></span></p>
                <p><b>Role:</b> {{$user['role']}}</p>
                <p><b>Town:</b> {{$user['town']}}</p>
                <p><b>District:</b> {{$user['district']}}</p>
                <p><b>Status:</b> {{$user['status']}}</p>
                <p><b>Profile Image:</b> <img src="{{$user['profile_image']}}" alt="Profile Image" style="max-width: 100px;"></p>
                <button class="btn btn-outline-info" id='viewUserBtn' type="button" onclick="viewUser({{$user['id']}})">View User<i class="bi bi-gear ms-2"></i></button>
                <hr>

                <div class="progress mb-2" role="progressbar" aria-label="Example 10px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 10px">
                    <div class="progress-bar" style="width:10%"></div>
                </div>
    
                <button type="submit" class="btn btn-primary mb-5">Update Ad</button>
            </form>
            
        </div>
    </div>

    <script>
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        $(document).ready(function() {
            $('.progress-bar').hide();
            const role = sessionStorage.getItem('role');
            if(role == 'superAdmin'){
                $('#blockOption').show();
            }else{
                $('#blockOption').hide();
            }
        });

        var userId = @json($user['id']);
        var adId = @json($ad['id']);
        $('#freeAdsEditForm').on('submit', function(event) {
            event.preventDefault();
            $('.progress-bar').show();
            var formData = $(this).serializeArray();
            console.log(formData);

            $.ajax({
                url: baseUrl + '/api/admin/editFreeAds',
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    if(response.status == 201) {
                        $('.progress-bar').css('width', '50%');
                            var status = formData.find(item => item.name === 'status').value;
                            var title = formData.find(item => item.name === 'title').value;
                            $.ajax({
                            url: baseUrl + '/api/admin/editFreeAdsStatus',  
                            method: 'POST',
                            headers:{
                                'Authorization': 'Bearer ' + sessionStorage.getItem('token')
                            },
                            data: {
                            user_id: userId,
                            status: status,
                            title: title,
                            free_ad_id: adId
                            },
                            success: function(response){
                                console.log(response);
                                if(response.status == 200){
                                    $('.progress-bar').css('width', '100%');
                                    Swal.fire({
                                        title: "Update the Status!",
                                        text: "Update the Ad Status & Send Notification to User.",
                                        icon: "success",
                                    }).then(()=>{
                                        window.location.href='/admin/freeAds'
                                    })
                                }else{
                                    Swal.fire({
                                        title: "Error",
                                        text: response.message,
                                        icon: "error",
                                    })
                                }
                            },
                            error: function(error,xhr,status){
                                console.log(xhr.responseText);
                                console.log(error);
                                console.log(status);
                            }
                            })
                        
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
           
        });

        var date = @json($ad['created_at']);
        var usersignupdate = @json($user['created_at']);
        var formattedDate = formatDate(date);
        

        function formatDate(dateString) {
            // var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            // return new Date(dateString).toLocaleDateString(undefined, options);
            return new Date(dateString).toISOString().slice(0, 19).replace("T", " ") 
        }

        var createdDate = document.getElementById('date');
        createdDate.innerHTML = formattedDate;

        var signupDate = document.getElementById('signupdate');
        signupDate.innerHTML = formatDate(usersignupdate);

        function viewUser(id) {
            const role = sessionStorage.getItem('role');
            $.ajax({
                url: baseUrl + '/api/admin/getUserById/' + id,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    let user = response.data;
                    let date = formatDate(user.created_at);

                    let freeAdsDropdown = Object.entries(response.freeAds).map(([adName, adId]) => `
                        <a class="dropdown-item" href="javascript:void(0);" onclick="alertAdId('${adId}')">${adName}</a>
                    `).join('');
                    let bannerAdsDropdown = Object.entries(response.bannerAds).map(([adName, adId]) => `
                        <a class="dropdown-item" href="javascript:void(0);" onclick="alertAdId('${adId}')">${adName}</a>
                    `).join('');
                    let bargainAdsDropdown = Object.entries(response.bargainAds).map(([adName, adId]) => `
                        <a class="dropdown-item" href="javascript:void(0);" onclick="alertAdId('${adId}')">Bargain for free ad id:${adId}</a>
                    `).join('');

                    let adminButtons = '';
                    if(role == 'superAdmin'){
                        adminButtons = `
                            <button class="btn btn-outline-info" onclick="editUser(${user.id},'${user.first_name}','${user.email}','${user.status}')" id='editUserBtn'>Edit User status<i class="bi bi-gear ms-2"></i></button>`
                    }else{
                        adminButtons = `
                            <button class="btn btn-outline-danger" onclick="editUser(${user.id},'${user.first_name}','${user.email}','${user.status}')" id='ReportUserBtn'>Report to Super admin<i class="bi bi-gear ms-2"></i></button>`
                    }

                    Swal.fire({
                        title: 'User Details',
                        html: `
                            <p><b>First Name:</b> ${user.first_name}</p>
                            <p><b>Last Name:</b> ${user.last_name}</p>
                            <p><b>Email:</b> ${user.email}</p>
                            <p><b>Telephone No:</b> ${user.telephone_no_1}</p>
                            <p><b>Sign up at:</b> ${date}</p>
                            <p><b>Role:</b> ${user.role}</p>
                            <p><b>Town:</b> ${user.town}</p>
                            <p><b>District:</b> ${user.district}</p>
                            <p><b>Status:</b> ${user.status}</p>
                            <p><b>Profile Image:</b> <img src="${user.profile_image}" alt="Profile Image" style="max-width: 100px;"></p>
                            <hr>
                            <p><b>Free Ads (${Object.keys(response.freeAds).length}):</b></p>
                            <div class="btn-group dropend">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    View Free Ads
                                </button>
                                <div class="dropdown-menu">
                                    ${freeAdsDropdown}
                                </div>
                            </div>
                            <hr>
                            <p><b>Banner Ads (${Object.keys(response.bannerAds).length}):</b></p>
                            <div class="btn-group dropend">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    View Banner Ads
                                </button>
                                <div class="dropdown-menu">
                                    ${bannerAdsDropdown}
                                </div>
                            </div>
                            <hr>
                            <p><b>Bargain Ads (${Object.keys(response.bargainAds).length}):</b></p>
                            <div class="btn-group dropend">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    View Bargain Ads
                                </button>
                                <div class="dropdown-menu">
                                    ${bargainAdsDropdown}
                                </div>
                            </div>
                            <hr>
                            ${adminButtons}
                        `,
                        icon: 'info',
                        customClass: {
                            popup: 'swal-wide'
                        },
                        allowOutsideClick: false
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function editUser(id,name,email,status) {
            let textarea = '';
            if(status != 'banned'){
                textarea = `
                    <label for="reason">Reason</label>
                    <textarea class="form-control" id="reason" name="reason" required></textarea>
                `;
            }else{
                textarea = `
                    <label for="reason">Reason</label>
                    <textarea class="form-control" id="reason" name="reason" required placeholder="Reason is not required to add active stage."></textarea>
                `;
            
            }
            Swal.fire({
                title: 'Edit User',
                html: `
                    <p><b>ID:</b> ${id}</p>
                    <p><b>Name:</b> ${name}</p>
                    <p><b>Email:</b> ${email}</p>
                    <p><b>Current Status:${status}</b></p>
                    <hr>
                    <label for="status">Status</label>
                    <select class="form-control" id="Userstatus" name="status" required>
                        <option value="active">Active</option>
                        <option value="banned">Banned</option>
                    </select>
                    ${textarea}
                `,
                showCancelButton: true,
                confirmButtonText: 'Update',
                preConfirm: () => {
                    return {
                        status: document.getElementById('Userstatus').value,
                        reason: document.getElementById('reason').value
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(result.value);
                    const token = sessionStorage.getItem('token');
                    $.ajax({
                        url: baseUrl + '/api/admin/editUserStatus/' + id,
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        data: result.value,
                        success: function(response) {
                            if(response.status == 200) {
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: response.message,
                                    icon: 'error'
                                });
                            }
                        },
                        error: function(xhr, status, error,response) {
                            Swal.fire({
                                title: 'Error',
                                text: xhr.responseText,
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection