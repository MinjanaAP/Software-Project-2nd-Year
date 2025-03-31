@extends('layouts.adminLayout')

@section('content')

<div class="container">
    <h3>Reports</h3>

    <div class="container-lg freeAdsReports mt-5">
        <h4>Feedbacks about Free Ads</h4>
        <hr>
        <div class="container">
            <div class="form-group">
                <label for="statusFilterFreeAds">Filter by Status:</label>
                <select class="form-control" id="statusFilterFreeAds">
                    <option value="">All</option>
                    <option value="to do">To Do</option>
                    <option value="Inprogress">Inprogress</option>
                    <option value="Done">Done</option>
                </select>
            </div>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Assignee</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="reportsTableBodyFreeAds">
                    
                </tbody>
            </table>
            <nav>
                <ul class="pagination" id="paginationFreeAds">
                </ul>
            </nav>
        </div>
    </div>

    <div class="container-lg userReports mt-5">
        <h4>User Feedbacks</h4>
        <hr>
        <div class="container">
            <div class="form-group">
                <label for="statusFilterUser">Filter by Status:</label>
                <select class="form-control" id="statusFilterUser">
                    <option value="">All</option>
                    <option value="to do">To Do</option>
                    <option value="Inprogress">Inprogress</option>
                    <option value="Done">Done</option>
                </select>
            </div>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Assignee</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="reportsTableBodyUser">
                    
                </tbody>
            </table>
            <nav>
                <ul class="pagination" id="paginationUser">
                </ul>
            </nav>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="userReportId"></p>
                <div class="assignMediv">

                </div>
                <div class="editReport">

                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
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
    $(document).ready(function() {
        var currentPageFreeAds = 1;
        var currentPageUser = 1;
        var statusFilterFreeAds = '';
        var statusFilterUser = '';

        function fetchReportsFreeAds(page = 1, status = '') {
            $.ajax({
                url: baseUrl+'/api/getReports?page=' + page + '&status=' + status,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var reports = response.data.data;
                    var html = '';
                    for (var i = 0; i < reports.length; i++) {
                        var assignee = reports[i].assignee_info;
                        var assigneeName =  assignee ? assignee.first_name : '';
                        var assigneeEmail = assignee ? assignee.email : 'Not Assigned';
                        var assigneeDescription = reports[i].admin_report;
                        var assigneeRole = assignee ? assignee.role : '';
                        var statusBadge = getStatusBadge(reports[i].status);
                        
                        html += '<tr>';
                        html += '<td>' + reports[i].id + '</td>';
                        html += '<td>' + (reports[i].tittle || 'N/A') + '</td>';
                        html += '<td>' + reports[i].user_description + '</td>';
                        html += '<td>' + new Date(reports[i].created_at).toLocaleDateString() + '</td>';
                        html += '<td>' + assigneeEmail + '<br><span class="badge text-bg-info">' + assigneeRole + '</span></td>';
                        html += '<td>' + statusBadge + '</td>';
                        html += '<td> <button class="btn btn-outline-info" onclick="viewReport(' + reports[i].free_ad_id + ',' + reports[i].id + ',\'' + encodeURIComponent(assigneeName) + '\',\'' + encodeURIComponent(assigneeDescription) + '\')" id="">View Reports<i class="bi bi-gear ms-2"></i></button></td>';
                        html += '</tr>';
                    }
                    $('#reportsTableBodyFreeAds').html(html);

                    generatePagination(response.data, '#paginationFreeAds', fetchReportsFreeAds);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching reports:', xhr, status, error);
                }
            });
        }

        function fetchReportsUser(page = 1, status = '') {
            $.ajax({
                url: baseUrl+'/api/getUserReports?page=' + page + '&status=' + status,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var reports = response.data.data;
                    var html = '';
                    for (var i = 0; i < reports.length; i++) {
                        var assignee = reports[i].assignee_info;
                        var assigneeEmail = assignee ? assignee.email : 'Not Assigned';
                        var assigneeRole = assignee ? assignee.role : '';
                        var assigneeId = assignee ? assignee.id : '';
                        var statusBadge = getStatusBadge(reports[i].status);

                        html += '<tr>';
                        html += '<td>' + reports[i].id + '</td>';
                        html += '<td>' + (reports[i].tittle || 'N/A') + '</td>';
                        html += '<td>' + reports[i].user_description + '</td>';
                        html += '<td>' + new Date(reports[i].created_at).toLocaleDateString() + '</td>';
                        html += '<td>' + assigneeEmail + '<br><span class="badge text-bg-info">' + assigneeRole + '</span></td>';
                        html += '<td>' + statusBadge + '</td>';
                        html += '<td> <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="viewUserReport(' + reports[i].id + ',\'' + reports[i].tittle + '\',\'' + reports[i].user_description + '\',\'' + assigneeEmail + '\',\'' + reports[i].status + '\',\'' + assigneeId+ '\')">View Reports<i class="bi bi-gear ms-2"></i></button></td>';
                        html += '</tr>';
                    }
                    $('#reportsTableBodyUser').html(html);

                    generatePagination(response.data, '#paginationUser', fetchReportsUser);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching reports:', xhr, status, error);
                }
            });
        }

        function getStatusBadge(status) {
            if(status == 'to do') return '<span class="badge text-bg-danger">to do</span>';
            if(status == 'Done') return '<span class="badge text-bg-success">Done</span>';
            if(status == 'Inprogress') return '<span class="badge text-bg-warning">Inprogress</span>';
            return '<span class="badge text-bg-secondary">Unknown</span>';
        }

        function generatePagination(data, paginationSelector, fetchFunction) {
            var paginationHtml = '';
            for (var page = 1; page <= data.last_page; page++) {
                paginationHtml += '<li class="page-item ' + (page === data.current_page ? 'active' : '') + '">';
                paginationHtml += '<a class="page-link" href="#" data-page="' + page + '">' + page + '</a>';
                paginationHtml += '</li>';
            }
            $(paginationSelector).html(paginationHtml);
            $(paginationSelector).find('.page-link').click(function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                fetchFunction(page, statusFilterFreeAds);
            });
        }

        $('#statusFilterFreeAds').change(function() {
            statusFilterFreeAds = $(this).val();
            fetchReportsFreeAds(1, statusFilterFreeAds);
        });

        $('#statusFilterUser').change(function() {
            statusFilterUser = $(this).val();
            fetchReportsUser(1, statusFilterUser);
        });

        fetchReportsFreeAds();
        fetchReportsUser();
    });

    function viewReport(adId, id, assigneeName,assigneeDescription) {
    assigneeName = decodeURIComponent(assigneeName);
    assigneeDescription = decodeURIComponent(assigneeDescription);
    window.location.href = `/admin/viewReport/${id}/${adId}?assignee=${assigneeName}&admin-report=${assigneeDescription}`;
}

    function viewUserReport(id,title,description,assignee,status,assigneeId) {
        console.log(id,title,description,assignee,status,assigneeId);
        var loggedUserId = sessionStorage.getItem('user_id');
        $('#userReportId').html(`ID: ${id} <br> Title: ${title} <br> Description: ${description} <br> Assignee: ${assignee} <br> Status: ${status}`);
        if(assignee == 'Not Assigned'){
            $('.assignMediv').append(`<a class="btn btn-outline-info" id="assignMeBtn" onclick="assignMe(${id})"><i class="bi bi-folder-plus me-2"></i>Assign to me</a>`);
        }else{
            $('.assignMediv').empty();
            if(assigneeId == loggedUserId){
                $('.editReport').append(`<a class="btn btn-outline-info" id="editReportBtn" onclick="editReport(${id})"><i class="bi bi-pencil me-2"></i>Edit Report</a>`);
            }else{
                $('.editReport').empty();
            }
        }
    }

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
                    $('#assignMeBtn').hide();
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    function editReport(id){
        window.location.href = `/admin/editUserReport/${id}`;
    }
</script>

@endsection
