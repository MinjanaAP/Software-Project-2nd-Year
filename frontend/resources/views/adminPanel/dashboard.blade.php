@extends('layouts.adminLayout')

@section('content')
    
    {{-- <h6 class="text-muted fw-lighter">Here’s what’s going on at Findit.</h6> --}}
    <div class="container">
        <h1 class="mb-3">Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-card card-users">
                    <div class="card-title">Total Users</div>
                    <div class="card-number">{{$response['users']}}</div>
                    <div class="d-grid">
                        <button class="btn btn-secondary d-flex gap-2 align-items-center justify-content-center" type="button">
                            <a href="/admin/users" class="navigation-btn">More info</a>
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card card-free-ads">
                    <div class="card-title">Free Ads</div>
                    <div class="card-number">{{$response['free_ads']}}</div>
                    <div class="d-grid">
                        <button class="btn btn-secondary d-flex gap-2 align-items-center justify-content-center" type="button">
                            <a href="/admin/freeAds" class="navigation-btn">More info</a>
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card card-paid-ads">
                    <div class="card-title">Paid Ads</div>
                    <div class="card-number">{{$response['paid_ads']}}</div>
                    <div class="d-grid">
                        <button class="btn btn-secondary d-flex gap-2 align-items-center justify-content-center" type="button">
                            <a href="/admin/paidAds" class="navigation-btn">More info</a>
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card card-bargain-ads">
                    <div class="card-title">Bargain Ads</div>
                    <div class="card-number">{{$response['bargain_ads']}}</div>
                    <div class="d-grid">
                        <button class="btn btn-secondary d-flex gap-2 align-items-center justify-content-center" type="button">
                            <a href="" class="navigation-btn">More info</a>
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-12" id="chartDiv">
            <div class="col-sm-10 col-md-6 col-12">
                <h1 class="mt-5 text-center">User Growth Chart</h1>
                <canvas class="col-lg-6" id="userChart" ></canvas>
            </div>
            <div class="col-sm-10 col-md-6 col-12">
                <h1 class="mt-5 text-center">Free Ads Growth Chart</h1>
                <canvas class="col-lg-6" id="freeAdChart" ></canvas>
            </div>
        </div>
    </div>
    <div class="container">
        <h3>Today's Banner Ads</h3>
        <hr>
        <div class="row" id="todaysPaidAds">
            
        </div>
    </div>
    <div class="container mt-3">
        <h3>Your Tasks</h3>
        <hr>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="statusFilter" class="form-label">Filter by Status:</label>
                <select class="form-control" id="statusFilter">
                    <option value="">All</option>
                    <option value="to do">To Do</option>
                    <option value="Inprogress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>
        </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered" id="reportsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Admin Report</th>
                        <th>Super Admin Request</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
    </div>
    
    












    <script>
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        $(document).ready(function() {

            $.ajax({
                url: baseUrl + '/api/admin/getLatestAccountCreationDates',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    
                    //console.log(response);
                    //user chart
                    if(response['dates'] && response['counts']){
                        const data = {
                            labels: response['dates'],
                            datasets: [{
                                label: 'Number of Users',
                                data: response['counts'],
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 2,
                                fill: false
                            }]
                        };
                    
                        const config = {
                            type: 'line',
                            data: data,
                            options: {
                                responsive: true,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Number of Users Over Time'
                                    },
                                    legend: {
                                        display: true,
                                        position: 'bottom'
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Date'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Number of Users'
                                        },
                                        beginAtZero: true
                                    }
                                }
                            },
                        };
                    
                        var ctx = document.getElementById('userChart').getContext('2d');
                        var userChart = new Chart(ctx, config);
                    }else{
                        console.log('No data for user chart');
                    }
                    //free ad chart
                    if(response['freeAdCounts'] && response['freeAdDates']){
                        const data = {
                            labels: response['freeAdDates'],
                            datasets: [{
                                label: 'Number of Free Ads',
                                data: response['freeAdCounts'],
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 2,
                                fill: false
                            }]
                        };
                    
                        const config = {
                            type: 'line',
                            data: data,
                            options: {
                                responsive: true,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Number of Free Ads Over Time'
                                    },
                                    legend: {
                                        display: true,
                                        position: 'bottom'
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Date'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Number of Free Ads'
                                        },
                                        beginAtZero: true
                                    }
                                }
                            },
                        };
                    
                        var ctx = document.getElementById('freeAdChart').getContext('2d');
                        var freeAdChart = new Chart(ctx, config);
                    }else{
                        console.log('No data for free ad chart');
                    }


                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            

        });
        $(document).ready(function() {
            var baseUrl = "{{ env('APP_BASE_URL') }}";
            getTodaysPaidAds();
            var token = sessionStorage.getItem('token');
            var role = sessionStorage.getItem('role');
            if(role === 'superAdmin'){
                fetchSuperAdminReports();
            }else{
                fetchReports();
            }

        function fetchReports() {
            $.ajax({
                url: baseUrl + '/api/admin/getAdminTasks',
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function(response) {
                    if (response.status === 200) {
                        var reports = response.data.data;
                        populateTable(reports);
                        $('#statusFilter').change(function() {
                            var selectedStatus = $(this).val();
                            var filteredReports = selectedStatus ? reports.filter(function(report) {
                                return report.status === selectedStatus;
                            }) : reports;
                            populateTable(filteredReports);
                        });
                    } else {
                        console.error('Error fetching reports:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching reports:', xhr, status, error);
                    Swal.fire({
                        title: "Error",
                        text: xhr.responseText,
                        icon: "error",
                    });
                }
            });
        }

        function fetchSuperAdminReports() {
            $.ajax({
                url: baseUrl + '/api/admin/getSuperAdminTasks',
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function(response) {
                    if (response.status === 200) {
                        var reports = response.data;
                        populateTable(reports);
                        $('#statusFilter').change(function() {
                            var selectedStatus = $(this).val();
                            var filteredReports = selectedStatus ? reports.filter(function(report) {
                                return report.status === selectedStatus;
                            }) : reports;
                            populateTable(filteredReports);
                        });
                    } else {
                        console.error('Error fetching super admin reports:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching super admin reports:', xhr, status, error);
                    Swal.fire({
                        title: "Error",
                        text: xhr.responseText,
                        icon: "error",
                    });
                }
            });
        }

        function populateTable(data) {
            var $tableBody = $('#reportsTable tbody');
            $tableBody.empty();
            data.forEach(function(report) {
                let button = '';

                if(report.type == 'free ad report'){
                    button = '<button class="btn btn-outline-info" onclick="viewReport(' + report.free_ad_id + ',' + report.id + ')" id=""><i class="bi bi-pencil me-2"></i>Edit Report</button>';
                }if(report.type == 'support request'){
                    button = '<a class="btn btn-outline-info" id="editReportBtn" onclick="editReport('+report.id+')"><i class="bi bi-pencil me-2"></i>Edit Report</a>'
                }
                var statusBadge = getStatusBadge(report.status);
                var row = '<tr>' +
                    '<td>' + report.id + '</td>' +
                    '<td>' + report.tittle + '</td>' +
                    '<td>' + report.user_description + '</td>' +
                    '<td>' + statusBadge + '</td>' +
                    '<td>' + report.admin_report + '</td>' +
                    '<td>' + report.superAdmin_request + '</td>' +
                    '<td>'+ button +'</td>' +
                    '</tr>';
                $tableBody.append(row);
            });
        }

        function getTodaysPaidAds() {
            $.ajax({
                url: baseUrl + '/api/admin/getTodaysPaidAds',
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    $.each(response.data, function(adType, ads) {
                        let adToday = ads.today_ad;
                        let nextAd = ads.next_ad;

                        $('#todaysPaidAds').append(`
                            <div class="col-md-3">
                                <div class="dashboard-card card-todays-paid-ads">
                                    <div class="card-title">${adType}</div>
                                    ${adToday ? `
                                    <div class=""><p>Post by : ${adToday.name}</p></div>
                                    <div class="card-img mb-2">
                                        <img src="${adToday.image}">
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-secondary d-flex gap-2 align-items-center justify-content-center" type="button">
                                            <a href="/admin/editPaidAds/${adToday.id}" class="navigation-btn">View Ad</a>
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </button>
                                    </div>
                                    <div class="card-footer">
                                        <p class="text-muted">Expire date : ${adToday.expire_date}</p>    
                                    </div>
                                    ` : `<div class="card-title">No Ad for Today</div>`}
                                    <div class="next-ad-div">
                                        ${nextAd ? `
                                        <button class="btn btn-secondary d-flex gap-2 align-items-center justify-content-center w-100" id="nextAdBtn" type="button">
                                            <a href="/admin/editPaidAds/${nextAd.id}" class="navigation-btn">Next Ad</a>
                                            <i class="bi bi-arrow-up-right-circle"></i>
                                        </button>
                                        <span class="badge text-bg-secondary">Next Ad status : ${nextAd.status}</span>
                                        ` : `<div class=""><p class="text-danger">No Next Ad Available</p></div>`}
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }


    
});

        function getStatusBadge(status) {
                    if(status == 'to do') return '<span class="badge text-bg-danger">to do</span>';
                    if(status == 'Done') return '<span class="badge text-bg-success">Done</span>';
                    if(status == 'Inprogress') return '<span class="badge text-bg-warning">Inprogress</span>';
                    return '<span class="badge text-bg-secondary">Unknown</span>';
                }

    function viewReport(adId, id) {
            window.location.href = `/admin/viewReport/${id}/${adId}`;
        }

        function editReport(id){
        window.location.href = `/admin/editUserReport/${id}`;
    }
    </script>
@endsection