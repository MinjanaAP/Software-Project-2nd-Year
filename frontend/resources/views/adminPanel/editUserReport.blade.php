@extends('layouts.adminLayout')

@section('content')
<div class="container mt-5">
    <h3>Edit User Report</h3>
    <div class="row d-flex justify-content-around align-items-start">
        <div class="card col-12 col-lg-5">
            <div class="card-header">
                <h4>Report Details</h4>
            </div>
            <div class="card-body">
                <form id="updateUserReport">
                    @csrf
                    <div class="mb-3">
                        <label for="reportId" class="form-label">Report ID:</label>
                        <input type="text" class="form-control" id="reportId" value="{{ $report['id'] }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="reportTitle" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="reportTitle" value="{{ $report['tittle'] }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="reportDescription" class="form-label">Description:</label>
                        <textarea class="form-control" id="reportDescription" rows="3" disabled>{{ $report['user_description'] }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="reportStatus" class="form-label">Status:</label>
                        <select class="form-control" id="reportStatus" name="status">
                            <option value="to do" {{ $report['status'] == 'to do' ? 'selected' : '' }}>To Do</option>
                            <option value="Inprogress" {{ $report['status'] == 'inprogress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Done" {{ $report['status'] == 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="adminDescription" class="form-label">Admin Description:</label>
                        <textarea class="form-control" id="adminDescription" name="admin_description" rows="3">{{ $report['admin_report'] }}</textarea>
                    </div>
                    <button type="button" class="btn btn-primary" id="editUserReportBtn">Update Report</button>
                </form>
                <button type="button" class="btn btn-outline-info mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="requestBtn">
                    <i class="bi bi-file-earmark-arrow-up"></i> Request to Super Admin
                </button>
            </div>
        </div>

        <div class="card col-12 col-lg-5">
            <div class="card-header">
                <h4>User Details</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="userId" class="form-label">User ID:</label>
                    <input type="text" class="form-control" id="userId" value="{{ $user['id'] }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="userName" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="userName" value="{{ $user['first_name'] }} {{ $user['last_name'] }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="userEmail" value="{{ $user['email'] }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="userTelephone" class="form-label">Telephone:</label>
                    <input type="text" class="form-control" id="userTelephone" value="{{ $user['telephone_no_1'] }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="userAddress" class="form-label">Address:</label>
                    <input type="text" class="form-control" id="userAddress" value="{{ $user['town'] }}, {{ $user['district'] }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="userStatus" class="form-label">Status:</label>
                    <input type="text" class="form-control" id="userStatus" value="{{ $user['status'] }}" disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Request to Super Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="superAdminRequest">Admin FeedBack</label>
                        <textarea class="form-control" id="superAdminRequest" name="superAdminRequest" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="superAdminRequestBtn">Send a Request</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
    const linkColor = document.querySelectorAll('.nav_link');
    linkColor.forEach(l => l.classList.remove('active'));
    const userButton = document.querySelector('.nav_link:nth-child(4)');
    userButton.classList.add('active');

    const role = sessionStorage.getItem('role');
    if(role === 'superAdmin') {
        $('#requestBtn').hide();
    }else{
        $('#requestBtn').show();
    }

    $('#superAdminRequestBtn').click(function() {
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        const token = sessionStorage.getItem('token');
        const reportId = {{ $report['id'] }};
        const description = $('#superAdminRequest').val();
        console.log(reportId);
        $.ajax({
            url: baseUrl + '/api/admin/report/superAdminRequest',
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            data: {
                'id': reportId,
                'superAdmin_request': description
            },
            success: function(response) {
                if(response.status == 200) {
                    Swal.fire({
                        title: "Request sent.",
                        text: "Request has been sent to Super Admin.",
                        icon: "success",
                    });
                } else {
                    Swal.fire({
                        title: response.status,
                        text: response.message,
                        icon: "error",
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    title: "Error",
                    text: xhr.responseText,
                    icon: "error",
                });
            }
        });
    });

    $('#editUserReportBtn').click(function() {
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        const token = sessionStorage.getItem('token');
        const status = $('#reportStatus').val();
        const description = $('#adminDescription').val();
        const reportId = {{ $report['id'] }}; 

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
                    let statusBadge = '';
                    if (response.data.status === 'to do') {
                        statusBadge = '<span class="badge text-bg-warning">to do</span>';
                    } else if (response.data.status === 'done') {
                        statusBadge = '<span class="badge text-bg-success">Done</span>';
                    } else {
                        statusBadge = '<span class="badge text-bg-info">' + response.data.status + '</span>';
                    }

                    $('#report-status').empty();
                    $('#report-status').append(statusBadge);

                    Swal.fire({
                        title: "Report Updated",
                        text: response.message,
                        icon: "success",
                    });
                } else {
                    Swal.fire({
                        title: response.status,
                        text: response.message,
                        icon: "error",
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    title: "Error",
                    text: xhr.responseText,
                    icon: "error",
                });
            }
        });
    });
</script>

@endsection
