@extends('layouts.adminLayout')

@section('content')
    
    <div class="container-lg">
        <h1 class="title mb-2">Users</h1>
        <div class="row">
            <div class="col-md-4 m-0">
                <div class="card">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row gap-0 gap-md-2">
                    <div class="card col-6 col-sm-3">
                        <i class="fas fa-users card-icon total-users"></i>
                        <div class="card-label">Total Users</div>
                        <div class="card-value" id="totalUsers">
                            {{$response['users'][0]['user_count'] + $response['users'][1]['user_count'] + $response['users'][2]['user_count']}}
                        </div>
                    </div>
                    <div class="card  col-6 col-sm-3">
                        <i class="fas fa-user-check card-icon active-users"></i>
                        <div class="card-label">Verify Users</div>
                        <div class="card-value" id="activeUsers">{{$response['users'][0]['user_count']}}</div>
                    </div>
                    <div class="card  col-6 col-sm-3">
                        <i class="fas fa-user-lock card-icon banned-users "></i>
                        <div class="card-label">Banned Users</div>
                        <div class="card-value" id="bannedUsers">{{$response['users'][2]['user_count']}}</div>
                    </div>
                    <div class="card  col-6 col-sm-3">
                        <i class="fas fa-user-tie card-icon verify-users "></i>
                        <div class="card-label">Active Users</div>
                        <div class="card-value" id="verifyUsers">{{$response['users'][1]['user_count']}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container adminUsers mt-5">
            <div class="row d-flex justify-content-between align-items-center">
                <h1 class="title mb-2 col-8 ">Admin Panel Users</h1>
                <button type="button" id="createAdminUserBtn" class="btn btn-info col-2" data-toggle="modal" data-target="#createAdminModal">Create User</button>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adminUsers as $adminUser)
                        @foreach($adminUser as $details)
                        <tr>
                            <td>{{ $details['id'] }}</td>
                            <td>{{ $details['first_name'] }}</td>
                            <td>{{ $details['email'] }}</td>
                            <td>
                                @if( $details['role'] =='superAdmin')
                                    <h4><span class="badge text-bg-info">Super Admin</span></h4>
                                @elseif( $details['role'] =='admin')
                                    <h4><span class="badge text-bg-warning">Admin</span></h4>
                                @else
                                    <h4><span class="badge text-bg-secondary">Admin User</span></h4>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-outline-danger" id="deleteAdminUserBtn" onclick="deleteUser({{ $details['id'] }})"><i class="bi bi-person-x me-2"></i>Delete User</button>
                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr class="m-5">
        <div class="container active-users">
            <div class="alert alert-dark" role="alert">
                EMPORIA - Site Users
            </div>
            
            <h1>Active Site Users</h1>
            <table id="activeUsersTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Telephone No</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            <nav id="activePaginationNav" class="d-flex justify-content-center">
                <ul class="pagination">
                    
                </ul>
            </nav>
            <hr class="m-5">
            
            <h1>Verified Site Users</h1>
            <table id="verifyUsersTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Telephone No</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            <nav id="verifyPaginationNav"  class="d-flex justify-content-center">
                <ul class="pagination">
                
                </ul>
            </nav>
            <hr class="m-5">
            <!-- Banned Users Table -->
            <h1>Banned Site Users</h1>
            <table id="bannedUsersTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Telephone No</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Banned Users Rows -->
                </tbody>
            </table>
            <nav id="bannedPaginationNav"  class="d-flex justify-content-center">
                <ul class="pagination">
                    <!-- Banned Users Pagination -->
                </ul>
            </nav>
        </div>

        //form model
        <div class="modal fade" id="createAdminModal" tabindex="-1" role="dialog" aria-labelledby="createAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form id="createAdminForm">
                    <div class="modal-header">
                    <h5 class="modal-title" id="createAdminModalLabel">Create New Admin User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" placeholder="Enter your first name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" required>
                        <option value="superAdmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        </select>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        const linkColor = document.querySelectorAll('.nav_link')
        linkColor.forEach(l=> l.classList.remove('active'))
        const userButton = document.querySelector('.nav_link:nth-child(2)');
        userButton.classList.add('active');

        // Dummy data for demonstration
        var userData = {
            totalUsers: document.getElementById('totalUsers').innerText,
            activeUsers: document.getElementById('activeUsers').innerText,
            bannedUsers: document.getElementById('bannedUsers').innerText,
            verifyUsers: document.getElementById('verifyUsers').innerText
        };



        // Pie chart data
        var pieData = {
            labels: ['Active Users', 'Banned Users', 'Verify Users'],
            datasets: [{
                data: [userData.activeUsers, userData.bannedUsers, userData.verifyUsers],
                backgroundColor: ['#007bff', '#dc3545','#ffc107']
            }]
        };

        // Pie chart options
        var pieOptions = {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        };

        // Create the pie chart
        var pieChart = new Chart(document.getElementById('userChart'), {
            type: 'pie',
            data: pieData,
            options: pieOptions
        });


    </script>
    <script>


        $(document).ready(function(){
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        const role = sessionStorage.getItem('role');
        if(role == 'superAdmin'){
            $('#createAdminUserBtn').show();
            $('#deleteAdminUserBtn').prop('disabled', false);
            $('#createUserBtn').show();
            $('#editUserBtn').show();
            $('#ReportUserBtn').hide();
        }else{
            $('#deleteAdminUserBtn').prop('disabled', true);
            $('#createAdminUserBtn').hide();
            $('#createUserBtn').hide();
            $('#editUserBtn').hide();
            $('#ReportUserBtn').show();
        }

        // Fetch users by status
        getUsersByStatus('active');
        getUsersByStatus('verify');
        getUsersByStatus('banned');

        //create admin users
        $('#createAdminForm').submit(function(event) {
        event.preventDefault(); 


        const first_name = $('#first_name').val();
        const email = $('#email').val();
        const password = $('#password').val();
        const role = $('#role').val();

        if (!email || !password || !role || !first_name) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all fields'
            });
            return;
        }

        const formData = {
            first_name: first_name,
            email: email,
            password: password,
            role: role
        };

        $.ajax({
            url: baseUrl + '/api/admin/createAdminUser',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#createAdminModal').modal('hide'); 
                Swal.fire({
                    title: response.message,
                    html: `Email: ${email}<br>Role: ${role}`,
                    icon: 'success'
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: xhr.responseText,
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
            }
        });
    });
        });

    function getUsersByStatus(status, page = 1) {
        $.ajax({
            url: `${baseUrl}/api/admin/getUserByStatus/${status}`,
            type: "GET",
            data: { page: page },
            success: function (response) {
                var user = response.data.data;
                var userTable = $(`#${status}UsersTable tbody`);
                userTable.empty();
                $.each(user, function (index, user) {
                    var row = "<tr>" +
                        "<td>" + user.id + "</td>" +
                        "<td>" + user.first_name + "</td>" +
                        "<td>" + user.email + "</td>" +
                        "<td>" + user.telephone_no_1 + "</td>" +
                        "<td><a class='btn btn-primary' onclick='viewUser(" + user.id + ")'>View user</a></td>" +
                        "</tr>";
                    userTable.append(row);
                });

                var paginationNav = $(`#${status}PaginationNav ul.pagination`);
                paginationNav.empty();
                $.each(response.data.links, function (index, link) {
                    var listItem = "<li class='page-item " + (link.active ? 'active' : '') + "'>" +
                        "<a class='page-link' href='" + (link.url ? link.url : '#') + "' data-status='" + status + "'>" + link.label + "</a>" +
                        "</li>";
                    paginationNav.append(listItem);
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var status = $(this).data('status');
        getUsersByStatus(status, page);
    });

   
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
                        <a class="dropdown-item" href="javascript:void(0);" onclick="viewBannerAd('${adId}')">${adName}</a>
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

        function formatDate(dateString) {
            var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }

        //todo: implement editUser function
        function alertAdId(adId) {
            //alert('Ad ID: ' + adId);
            window.location.href = `/admin/freeAdsEdit/${adId}`;
        }

        function viewBannerAd(adId){
            window.location.href = `/admin/editPaidAds/${adId}`
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
                    <select class="form-control" id="status" name="status" required>
                        <option value="active">Active</option>
                        <option value="banned">Banned</option>
                    </select>
                    ${textarea}
                `,
                showCancelButton: true,
                confirmButtonText: 'Update',
                preConfirm: () => {
                    return {
                        status: document.getElementById('status').value,
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
                                }).then(()=>{
                                    window.location.reload();
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

        function deleteUser(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                url : baseUrl + '/api/admin/deleteAdminUser',
                method : 'POST',
                data : {'id':id},
                success : function(response){
                    if(response.status == 200){
                        Swal.fire({
                                    title: 'Deleted!',
                                    text: response.message,
                                    icon: 'success'
                                }).then(()=>{
                                    window.location.reload();
                                });
                    }
                },
                error : function(xhr, status, error,response){
                    console.log(xhr.responseText);
                    console.log(error+ response);
                }
            })
                }
                });
            
        }


    </script>
@endsection