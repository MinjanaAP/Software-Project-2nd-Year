@extends('layouts.adminLayout')

@section('content')
    
    <div class="container-lg adminFreeAds">
        <h1 class="adminHeading-2 text mb-2">Free Advertisements</h1>
        <div class="row d-flex justify-content-around align-items-end">
            <div class="col-md-6 m-0 d-flex align-items-end ">
                <canvas id="adsChart"></canvas>
            </div>
            <div class="col-md-4 ">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
        <div class="ads container mt-5">
            <h1 class="adminHeading-2 text mb-5">Ads Management</h1>
            <div class="container-lg pb-5">
                <div class="col-12">
                    <div class="d-flex justify-content-between mb-3">
                        <h2 class="adminHeading-3">Live Ads</h2>
                        <button type="button" class="btn btn-outline-info" onclick="seeMoreAds('live')">See More <i class="bi bi-arrow-right-circle"></i></button>
                    </div>
                    <table class="table table-success table-striped table-bordered mb-5" id="liveAdsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created Date</th>
                                <th>View Ad</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-between mb-3">
                        <h2 class="adminHeading-3">Block Ads</h2>
                        <button type="button" class="btn btn-outline-info" onclick="seeMoreAds('blocked')">See More <i class="bi bi-arrow-right-circle"></i></button>
                    </div>
                    <table class="table table-danger table-striped table-bordered mb-5" id="blockedAdsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created Date</th>
                                <th>View Ad</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-between mb-3">
                        <h2 class="adminHeading-3">Pending Ads</h2>
                        <button type="button" class="btn btn-outline-info" onclick="seeMoreAds('pending')">See More <i class="bi bi-arrow-right-circle"></i></button>
                    </div>
                    <table class="table table-warning table-striped table-bordered mb-5" id="pendingAdsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created Date</th>
                                <th>View Ad</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <hr>
                <h2><b>Filter Ads</b></h2>
                <form id="filterForm" class="mb-4">
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="district">District</label>
                            <select id="district" class="form-control">
                                <option value="all">All</option>
                                @foreach ($data as $district)
                                        <option value="{{ $district }}">{{ $district }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="town">Town</label>
                            <select id="town" class="form-control">
                                <option value="all">All</option>
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="priceRange">Price Range</label>
                            <select id="priceRange" class="form-control">
                                <option value="all">All</option>
                                <option value="0-5000">0-5000</option>
                                <option value="5000-10000">5000-10000</option>
                                <option value="10000-15000">10000-15000</option>
                                <option value="15000-20000">15000-20000</option>
                                <option value="20000-25000">20000-25000</option>
                                <option value="500000-700000">500000-700000</option>
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="category">Category</label>
                            <select id="category" class="form-control">
                                <option value="all">All</option>
                                @foreach($subCategories as $subCategory)
                                <option value="{{$subCategory['Name']}}">{{$subCategory['Name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mt-3" id="filterButton">Filter</button>
                </form>
            
                <table class="table table-striped table-bordered mb-5" id="filterAds">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created Date</th>
                            <th>View Ad</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

    <script>
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        $(document).ready(function() {
            const linkColor = document.querySelectorAll('.nav_link')
            linkColor.forEach(l=> l.classList.remove('active'))
            const userButton = document.querySelector('.nav_link:nth-child(3)');
            userButton.classList.add('active');

            $.ajax({
                url:baseUrl + '/api/admin/getLast7DaysAds',
                method: 'GET',
                success: function(response) {
                    var ctx = document.getElementById('adsChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.dates,
                            datasets: [{
                                label: 'Number of Ads',
                                data: response.adsCount,
                                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
            $.ajax({
                url: baseUrl + '/api/admin/status-count',
                method: 'GET',
                success: function(response) {
                    var ctx = document.getElementById('statusChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: [
                                'Pending (' + response.pending + ')', 
                                'Blocked (' + response.blocked + ')', 
                                'Live (' + response.live + ')'
                            ],
                            datasets: [{
                                label: 'Ads Status',
                                data: [
                                    response.pending,
                                    response.blocked,
                                    response.live
                                ],
                                backgroundColor: [
                                    'rgba(255, 206, 86, 0.8)', // Pending
                                    'rgba(255, 99, 132, 0.8)', // Blocked
                                    'rgba(75, 192, 192, 0.8)'  // Live
                                ],
                                borderColor: [
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(75, 192, 192, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                },
                                title: {
                                    display: true,
                                    text: 'Ads Status Distribution'
                                }
                            }
                        }
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#filterButton').click(function() {
                filterAds();
            });
        });

        function formatDate(dateString) {
            var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }

        function loadAds(url, tableId) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        var tbody = $(tableId + ' tbody');
                        tbody.empty();
                        response.forEach(function(ad) {
                            var formattedDate = formatDate(ad.created_at);
                            tbody.append('<tr><td>' + ad.id + '</td><td>' + ad.title + '</td><td>' + ad.description + '</td><td>' + formattedDate + '</td><td><button class="btn btn-outline-info" onclick="ViewAd('+ad.id+')">View Ad</button></td></tr>');
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            loadAds(baseUrl + '/api/admin/ads/live', '#liveAdsTable');
            loadAds(baseUrl + '/api/admin/ads/blocked', '#blockedAdsTable');
            loadAds(baseUrl + '/api/admin/ads/pending', '#pendingAdsTable');

            function ViewAd(id){
                window.location.href = `/admin/freeAdsEdit/${id}`;
            }

            function seeMoreAds(status){
                
                window.location.href = `/admin/seeMoreAds/${status}`;
            }

        $('#town').prop('disabled', true);
        $('#district').on('change', function() {
            var selectedDistrict = $(this).val();
            $.ajax({
                
                url: baseUrl+'/api/town/getSpecificTowns', // Route to your backend endpoint
                type: 'POST',
                data: { district: selectedDistrict },
                success: function(response) {
                    //console.log(response);
                    $('#town').prop('disabled', false);
                    var townsDropdown = $('#town'); 
                    
                    townsDropdown.empty(); 
                    townsDropdown.append($('<option>').text('Select Town').val('all'));
                    $.each(response.data, function(index, town) { 
                        townsDropdown.append($('<option>').text(town).val(town)); 
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        function filterAds() {
            var district = $('#district').val();
            var town = $('#town').val();
            var priceRange = $('#priceRange').val();
            var category = $('#category').val();
            console.log(district,town,priceRange,category);

            $.ajax({
                url: baseUrl+`/api/filterAds/${district}/${town}/${priceRange}/${category}`,
                method: 'GET',
                data: {
                    district: district,
                    town: town,
                    priceRange: priceRange,
                    category: category
                },
                success: function(response) {
                    if (response.status === 200) {
                        var tbody = $('#filterAds tbody');
                        tbody.empty();
                        response.data.forEach(function(ad) {
                            var formattedDate = new Date(ad.created_at).toLocaleDateString();
                            tbody.append('<tr><td>' + ad.id + '</td><td>' + ad.title + '</td><td>' + ad.description + '</td><td>' + formattedDate + '</td><td><button class="btn btn-outline-info" onclick="ViewAd(' + ad.id + ')">View Ad</button></td></tr>');
                        });
                    } else {
                        console.error('Error fetching ads:', response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

       
    </script>
@endsection