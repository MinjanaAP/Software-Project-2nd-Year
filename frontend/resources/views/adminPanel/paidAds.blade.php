@extends('layouts.adminLayout')

@section('content')
<div class="container mt-5">
    <h3>Paid Ads</h3>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="typeFilter" class="form-label">Filter by Ad Type:</label>
            <select class="form-control" id="typeFilter">
                <option value="">All</option>
                <option value="figure_A">Figure A</option>
                <option value="figure_B">Figure B</option>
                <option value="figure_C">Figure C</option>
                <option value="figure_D">Figure D</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered" id="adsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <nav aria-label="Page navigation">
                <ul class="pagination" id="pagination">
                    <!-- Pagination links will be populated here by JavaScript -->
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
        const linkColor = document.querySelectorAll('.nav_link')
        linkColor.forEach(l=> l.classList.remove('active'))
        const userButton = document.querySelector('.nav_link:nth-child(4)');
        userButton.classList.add('active');
$(document).ready(function() {
    var baseUrl = "{{ env('APP_BASE_URL') }}";
    var token = sessionStorage.getItem('token');

    function fetchPaidAds(page = 1, filterType = '') {
        $.ajax({
            url: baseUrl + '/api/admin/getPaidAds',
            type: 'GET',
            data: {
                page: page,
                paid_ad_type: filterType
            },
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                if (response.status === 200) {
                    var ads = response.data.data;
                    populateTable(ads);
                    populatePagination(response.data);
                } else {
                    console.error('Error fetching ads:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching ads:', xhr, status, error);
                Swal.fire({
                    title: "Error",
                    text: xhr.responseText,
                    icon: "error",
                });
            }
        });
    }

    function populateTable(data) {
        var $tableBody = $('#adsTable tbody');
        $tableBody.empty();
        data.forEach(function(ad) {
            var row = '<tr>' +
                '<td>' + ad.id + '</td>' +
                '<td>' + ad.name + '</td>' +
                '<td>' + ad.email + '</td>' +
                '<td>' + ad.paid_ad_type + '</td>' +
                '<td>' + getStatusBadge(ad.status ) + '</td>' +
                '<td>' +new Date(ad.created_at).toLocaleDateString() + '</td>' +
                '<td><a class="btn btn-outline-info" id="editReportBtn" onclick="editPaidAds('+ad.id+')"><i class="bi bi-pencil me-2"></i>View Banner Ad</a></td>' +
                '</tr>';
            $tableBody.append(row);
        });
    }

    function getStatusBadge(status) {
            if(status == 'banned') return '<span class="badge text-bg-danger">banned</span>';
            if(status == 'live') return '<span class="badge text-bg-success">live</span>';
            if(status == 'pending') return '<span class="badge text-bg-warning">pending</span>';
            return '<span class="badge text-bg-secondary">Unknown</span>';
        }

    function populatePagination(data) {
        var $pagination = $('#pagination');
        $pagination.empty();
        var previousPage = data.current_page - 1;
        var nextPage = data.current_page + 1;
        
        if (data.current_page > 1) {
            $pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="' + previousPage + '">&laquo; Previous</a></li>');
        }

        for (var i = 1; i <= data.last_page; i++) {
            var activeClass = i === data.current_page ? 'active' : '';
            $pagination.append('<li class="page-item ' + activeClass + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
        }

        if (data.current_page < data.last_page) {
            $pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="' + nextPage + '">Next &raquo;</a></li>');
        }
    }

    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        var filterType = $('#typeFilter').val();
        fetchPaidAds(page, filterType);
    });

    $('#typeFilter').change(function() {
        var filterType = $(this).val();
        fetchPaidAds(1, filterType);
    });

    fetchPaidAds();
});

    function editPaidAds(adId) {
        window.location.href = "/admin/editPaidAds/" + adId;
    }
</script>

@endsection
