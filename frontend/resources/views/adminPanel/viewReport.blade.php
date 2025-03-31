@extends('layouts.adminLayout')

@section('content')


<div class="container">
    <h3>Reports</h3>
    <div class="row d-flex justify-content-between">
        <div class="col-d-block col-sm-4 col-md-7 col-lg-7">
            <div id="carouselExampleIndicators" class="carousel slide mt-4">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                </div>
                <div class="carousel-inner rounded-5 shadow-4-strong">
                    <div class="carousel-item active">
                    <img src="{{$free_ad['image_1']}}" class="d-block w-100" alt="Edition-page">
                    </div>
                    <div class="carousel-item">
                    <img src="{{$free_ad['image_2']}}" class="d-block w-100" alt="Edition-page">
                    </div>
                    <div class="carousel-item">
                    <img src="{{$free_ad['image_3']}}" class="d-block w-100" alt="Edition-page">
                    </div>
                    <div class="carousel-item">
                    <img src="{{$free_ad['image_4']}}" class="d-block w-100" alt="Edition-page">
                    </div>
                    <div class="carousel-item">
                    <img src="{{$free_ad['image_5']}}" class="d-block w-100" alt="Edition-page">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="row m-2">
                <div class="col-12 col-sm-6 d-flex  justify-content-between">
                        <div class="d-flex">
                                <h6 class="text-secondary d-flex"><i class="bi bi-clock-fill px-1"> </i>{{ \Carbon\Carbon::parse($free_ad['created_at'])->format('Y-m-d') }}</h6>
                                <h6 class="text-secondary px-2 d-flex"><i class="bi bi-geo-alt-fill px-1"></i>{{$free_ad['town']}}</h6>
                                <h6 class="text-secondary px-2 d-flex"><i class="bi bi-eye-fill px-1"></i>{{$free_ad['view_count']}}</h6>
                        </div>
                </div>
                <div class="col-6 d-flex  justify-content-end">
                

                </div>
            </div>
        </div>
        <div class="col-d-block col-sm-2 col-md-5 col-lg-4">
            <div class="d-block productRightUp my-4 ">
                <h4 class="productPrice fw-bold ">Rs. {{$free_ad['price']}}</h4>
                <p class="text-success ">
                        @if($free_ad['negotiable'] == 'true')
                                Negotiable
                        
                        @endif
                </p>
                <h4 class="productTitle fw-bold"> {{$free_ad['brand']}} {{$free_ad['title']}}</h4>
            </div>
            <div class="productRightDown d-block my-4 p-3 ">
                <h6 class="text-center fw-bold">Seller Information</h6>
                <hr>
                <div class="row">
                        <div class="userImg col-3 d-flex justify-content-center align-items-center mb-2">
                                @if($free_ad['user']['profile_image'])
                                        <img src="{{ $free_ad['user']['profile_image'] }}" height="75px" width="75px" id="profile-img" alt="mobile-free-ad" class="rounded-circle">
                                @else
                                        <img src="{{URL('images/profile.png')}}" height="75px" width="75px" id="profile-img" alt="mobile-free-ad" class="rounded-circle">
                                @endif
                        </div>
                        <div class="user-details col-9 d-flex flex-column justify-content-start align-items-center">
                                <button class="btn btn-secondary w-100 py-2 d-flex justify-content-center align-items-center" id="user-details-btn">
                                        <div class="col-8 d-flex align-items-center justify-content-start">
                                                <i class="bi bi-person-circle mx-2"></i>
                                                <h6 class="text-center  m-0">{{$free_ad['user']['first_name']}}</h6>
                                        </div>
                                </button>
                                @if($free_ad['user']['status'] === 'verify')
                                <div class="col-12 verify-badge d-flex justify-content-center mt-2">
                                        <div class="col-xl-8 col-lg-10 col-md-10 col-sm-8 col-8 d-flex align-items-center px-2">
                                                <span class="verify-badge-tag py-0"><img src="{{URL('image/verify-shield.png')}}" height="18px" width="18px" class="me-2" >Verified User</span>
                                        </div>
                                </div>
                                @endif
                                <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                                        <button class="btn btn-secondary w-100 my-2  d-flex justify-content-center" id="user-details-btn">
                                                <div class="col-8 d-flex align-items-center justify-content-start">
                                                        <i class="bi bi-telephone-fill mx-2"></i><h6 class=" m-0">{{$free_ad['user']['telephone_no_1']}}</h6>
                                                </div>
                                        </button>
                                        @if($free_ad['user']['town'])
                                                <button class="btn btn-secondary w-100  d-flex justify-content-center" id="user-details-btn">
                                                        <div class="col-8 d-flex align-items-center justify-content-start">
                                                                <i class="bi bi-geo-alt-fill mx-2"></i><h6 class=" m-0">{{$free_ad['user']['town']}}</h6>
                                                        </div>
                                                </button>
                                        @endif
                                </div>
                        </div>
                </div>
                
                <!-- <div class="text-center">
                        <button type="button" class="btn w-50 my-2 email" > <i class="bi bi-envelope-fill ms-2 mx-2"></i>Email to seller</button>
                </div> -->
        </div>
            <div class="d-flex flex-column justify-content-center m-0 ">
                <button type="button" class="btn w-100 my-2 bargain"  onclick="previewAd({{$free_ad['id']}})">View Ad <i class="bi bi-arrow-up-right-circle ms-2"></i></button>
                <button type="button" class="btn w-100 my-2 bargain" id="editAd" onclick="editAd({{$free_ad['id']}})">Edit Ad <i class="bi bi-gear ms-2"></i></button>
            </div>
        </div>
    </div>
       

   

    <div class="row d-flex justify-content-between">  
        <div class="col-d-block col-sm-4 col-md-7 col-lg-7">
            <h4 class="fw-bold m-2">Specification</h4>
            <hr>
            <div class="text-center">
                <div class="row ">
                    @if($free_ad['sub_category'] == 'Mobile phones' || $free_ad['sub_category'] == 'Mobiles' || $free_ad['sub_category'] == 'Laptops' || $free_ad['sub_category'] == 'Computers' || $free_ad['sub_category'] == 'Laptops' || $free_ad['sub_category'] == 'Tvs' || $free_ad['sub_category'] == 'Home Appliances' || $free_ad['sub_category'] == 'Home security' || $free_ad['sub_category'] == 'Cameras' || $free_ad['sub_category'] == 'Sounds' )
                            @foreach($features as $key => $value)
                                    <div class="col-12 col-sm-6">
                                        <div class="pSpec py-2 px-2 m-2">  
                                            <div class="row">
                                                    <div class="col d-flex justify-content-start mt-2">
                                                            <p class="fw-bold ">{{ ucfirst(str_replace('_', ' ', $key)) }}</p>
                                                    </div>
                                                    <div class="col d-flex justify-content-end mt-2">
                                                            <p class="">{{ $value }}</p>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                    @endif
                </div>
            </div>

            <h4 class="fw-bold m-2">Description</h4>
            <hr>
            <p>{{$free_ad['description']}}</p>

                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Admin Action</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="status"> Change Report Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="to do" >to do</option>
                                    <option value="Inprogress" >Inprogress</option>
                                    <option value="Done">Done</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Admin FeedBack</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <button class="btn btn-primary" id="feedbackBtn">Submit a FeedBack</button>
                        </div>
                        
                    </div>
                    </div>
                </div>
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" id="getActionBtn">Get a Action</button>
                <div class="modal fade" id="superAdminRequest" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Send Request to Super Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="description">Request : </label>
                                <textarea class="form-control" id="SuperAdminRequestDescription" name="SuperAdminRequestDescription" required></textarea>
                            </div>
                            <button class="btn btn-primary" id="requestBtn">Submit a Request</button>
                        </div>
                        
                    </div>
                    </div>
                </div>
                <button class="btn btn-primary" data-bs-target="#superAdminRequest" data-bs-toggle="modal" id="getActionBtn2">Request to Super Admin</button>
            </div>
        <div class="col-d-block col-sm-2 col-md-5 col-lg-4">
            <div class="card text-start">
                <div class="card-header">
                Report Details
                </div>
                <div class="card-body">
                <h5 class="card-title"><b>Tittle : </b>{{$reportData['tittle']}}</h5>
                <p class="card-text"><b>Description : </b>{{$reportData['user_description']}}</p>
                <p class="card-text" id="report-status"><b>Status : </b>
                    @if($reportData['status']== 'to do')
                        <span class="badge text-bg-warning">to do</span>
                    @elseif($reportData['status']== 'done')
                        <span class="badge text-bg-success">Done</span>
                    @else
                        <span class="badge text-bg-info">{{$reportData['status']}}</span>
                    @endif
                </p>

                <span class="badge text-bg-secondary" id="assigned">assigned to you</span>
                @if($reportData['assignee']== null)
                <a  class="btn btn-outline-info" onclick="assignMe({{$reportData['id']}})" id="assignMeBtn"><i class="bi bi-folder-plus me-2"></i>Assign to me</a>
                @else
                    <p class="card-text" id="assigneeName"></p>
                    <p class="card-text" id="admin_report"></p>
                @endif
                </div>
                <div class="card-footer text-body-secondary">
                    <b>Reported Date :</b>{{ \Carbon\Carbon::parse($reportData['created_at'])->format('Y-m-d') }}
                </div>
            </div>
            <div class="card text-start">
                <div class="card-header">
                Reported User
                </div>
                <div class="card-body">
                    @if($reportedUser['profile_image'])
                        <img src="{{ $reportedUser['profile_image'] }}" height="75px" width="75px" id="profile-img" alt="mobile-free-ad" class="rounded-circle">
                    @endif
                <h5 class="card-title"><b>Name : </b>{{$reportedUser['first_name']}}</h5>
                <p class="card-text"><b>Email : </b>{{$reportedUser['email']}}</p>
                <p class="card-text"><b>Mobile : </b>{{$reportedUser['telephone_no_1']}}</p>
                </div>
                <div class="card-footer text-body-secondary">
                    <b>Reported Date :</b>{{ \Carbon\Carbon::parse($reportData['created_at'])->format('Y-m-d') }}
                    
                </div>
            </div>
        </div>
    </div>
</div>

   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
   

    const linkColor = document.querySelectorAll('.nav_link')
            linkColor.forEach(l=> l.classList.remove('active'))
            const userButton = document.querySelector('.nav_link:nth-child(5)');
            userButton.classList.add('active');

    $(document).ready(function(){
        const params = new URLSearchParams(window.location.search);
        const assigneeName = params.get('assignee');
        const admin_report = params.get('admin-report');
        console.log(assigneeName);
        console.log(admin_report);
        // if(assigneeName != null){
        //     document.getElementById('assigneeName').textContent = 'Assignee Name: ' + assigneeName;
        // }
        // if(admin_report != null){
        //     document.getElementById('admin_report').textContent = 'Admin Report:' + admin_report;
        // }

        $('#editAd').hide();
        $('#assigned').hide();
        $('#getActionBtn').hide();
        $('#getActionBtn2').hide();
        var assignee = @json($reportData['assignee']);
        const userId = sessionStorage.getItem('user_id');
        var adminRole = sessionStorage.getItem('role');
        console.log(adminRole)
        console.log("Assignee: ", assignee);
        console.log("User ID: ", userId);
        if (assignee.toString() === userId.toString()) {
            $('#editAd').show();
            $('#assigned').show();
            $('#getActionBtn').show();
            $('#getActionBtn2').show();
        }
        if(adminRole === 'superAdmin'){
           
            $('#getActionBtn2').hide();
            $('#editAd').show();
        }else{
            $('#getActionBtn2').show();
        }
    })
    
    
    function assignMe(id){
        const token =  sessionStorage.getItem('token');
        console.log(id);
        $.ajax({
            url: baseUrl + '/api/admin/assignMe',
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            data: {
                'id': id
            },
            success: function(response) {
                if (response.status == 200) {
                    console.log("Assigned to you.");
                    $('#editAd').show();
                    $('#assignMeBtn').hide();
                    $('#assigned').show();
                    $('#getActionBtn').show();
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function editAd(id){
                window.location.href = `/admin/freeAdsEdit/${id}`;
    }
    $('#feedbackBtn').click(function() {
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        const token = sessionStorage.getItem('token');
        const status = $('#status').val();
        const description = $('#description').val();
        const reportId = {{ $reportData['id'] }}; 

        console.log(reportId, status, description);

        $.ajax({
            url: baseUrl + '/api/admin/feedback',
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            data: {
                'id': reportId,
                'status': status,
                'description': description
            },
            success: function(response) {
                if (response.status === 200) {
                    console.log(response);
                    console.log("Feedback submitted.");
                    let statusBadge = '';
                    if (response.data.status === 'to do') {
                        statusBadge = '<span class="badge text-bg-warning">to do</span>';
                    } else if (response.data.status === 'done') {
                        statusBadge = '<span class="badge text-bg-success">Done</span>';
                    } else {
                        statusBadge = '<span class="badge text-bg-info">' + response.data.status+ '</span>';
                    }

                    $('#report-status').empty();
                    $('#report-status').append(statusBadge);

                    Swal.fire({
                    title: "Report Updated",
                    text: response.message,
                    icon: "success",
                    });

                } else {
                    console.log(response);
                    Swal.fire({
                    title: response.status,
                    text: response.message,
                    icon: "success",
                })
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                Swal.fire({
                    title: "Error",
                    text: xhr.responseText,
                    icon: "error",
                })
            }
        });
    });

    $('#requestBtn').click(function(){
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        const token = sessionStorage.getItem('token');
        const reportId = {{ $reportData['id'] }};
        const description = $('#SuperAdminRequestDescription').val();
        console.log(reportId);
        $.ajax({
            url : baseUrl + '/api/admin/report/superAdminRequest',
            type : 'POST',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            data: {
                'id':reportId,
                'superAdmin_request' : description
            },
            success:function(response){
                if(response.status==200){
                    Swal.fire({
                    title: "Request send.",
                    text: "Send Request to Super Admin",
                    icon: "success",
                })
            }
                else{
                    Swal.fire({
                    title: response.status,
                    text: response.message,
                    icon: "success",
                })
                }
                },
            error:function(xhr){
                Swal.fire({
                    title: "Error",
                    text: xhr.responseText,
                    icon: "error",
                })
            }
        })
    })

    function previewAd(id){
        window.location.href = `/productPage1/${id}`;
    }

</script>

@endsection