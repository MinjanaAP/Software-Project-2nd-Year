@extends('layouts.adminLayout')

@section('content')


<div class="container">
    <h1>{{$status}} Ads Listing</h1>
    <table id="adsTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <nav id="paginationNav">
        <ul class="pagination"></ul>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const status = @json($status);
    var baseUrl = "{{ env('APP_BASE_URL') }}";
    $(document).ready(function () {
        loadAds();
    });

    function loadAds(page = 1) {
        $.ajax({
            url: baseUrl + '/api/admin/getAllAdsByStatus/'+ status,
            type: "GET",
            data: { page: page },
            success: function (response) {
                var ads = response.data.data;
                var adsTable = $("#adsTable tbody");
                adsTable.empty();
                $.each(ads, function (index, ad) {
                    var row = "<tr>" +
                        "<td>" + ad.id + "</td>" +
                        "<td>" + ad.title + "</td>" +
                        "<td>" + ad.description + "</td>" +
                        "<td>" + new Date(ad.created_at).toISOString().slice(0, 19).replace("T", " ") + "</td>" +
                        "<td><a class='btn btn-primary' onclick = 'ViewAd("+ad.id+")'>View Ad</a></td>" +
                        "</tr>";
                    adsTable.append(row);
                });

                var paginationNav = $("#paginationNav ul.pagination");
                paginationNav.empty();
                $.each(response.data.links, function (index, link) {
                    var listItem = "<li class='page-item " + (link.active ? 'active' : '') + "'>" +
                        "<a class='page-link' href='" + (link.url ? link.url : '#') + "'>" + link.label + "</a>" +
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
        loadAds(page);
    });

    function ViewAd(id){
                window.location.href = `/admin/freeAdsEdit/${id}`;
            }

</script>

@endsection