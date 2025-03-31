@extends('layouts.adminLayout')

@section('content')
<div class="container mt-5">
    <h3>Edit Banner Ad</h3>
    <hr>
    <div class="row d-flex justify-content-between align-items-start">
        <div class="col-5">
            <h3 class="mt-5">Advertisement Details</h3>
            <form  method="POST" id="editBannerAd">
                @csrf
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $ad['id'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $ad['name'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $ad['address'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="number" class="form-label">Number</label>
                    <input type="text" class="form-control" id="number" name="number" value="{{ $ad['number'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $ad['email'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="text" class="form-control" id="url" name="url" value="{{ $ad['url'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <img src="{{ $ad['image'] }}" class="img-fluid" alt="Ad Image">
                </div>
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $ad['user_id'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" class="form-control" id="type" name="type" value="{{ $ad['paid_ad_type'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="pending" {{ $ad['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="live" {{ $ad['status'] == 'live' ? 'selected' : '' }}>Live</option>
                        <option value="banned" {{ $ad['status'] == 'banned' ? 'selected' : '' }}>Banned</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="created_at" class="form-label">Created At</label>
                    <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $ad['created_at'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="updated_at" class="form-label text-warning">Display Date</label>
                    <input type="text" class="form-control" id="display_date" name="display_date" value="{{ $ad['display_date'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="updated_at" class="form-label text-danger">Expire Date</label>
                    <input type="text" class="form-control" id="expire_date" name="expire_date" value="{{ $ad['expire_date'] }}" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Update Status</button>
            </form>
        </div>
        <div class="col-5">
            <h3 class="mt-5">User Details</h3>
            <!-- User Details Form -->
            <form>
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $user['id'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="user_email" name="user_email" value="{{ $user['email'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user['first_name'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user['last_name'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="town" class="form-label">Town</label>
                    <input type="text" class="form-control" id="town" name="town" value="{{ $user['town'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="district" class="form-label">District</label>
                    <input type="text" class="form-control" id="district" name="district" value="{{ $user['district'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="telephone_no_1" class="form-label">Telephone No. 1</label>
                    <input type="text" class="form-control" id="telephone_no_1" name="telephone_no_1" value="{{ $user['telephone_no_1'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="telephone_no_2" class="form-label">Telephone No. 2</label>
                    <input type="text" class="form-control" id="telephone_no_2" name="telephone_no_2" value="{{ $user['telephone_no_2'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" name="role" value="{{ $user['role'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="user_status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="user_status" name="user_status" value="{{ $user['status'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="profile_image" class="form-label">Profile Image</label>
                    <img src="{{ $user['profile_image'] }}" class="img-fluid" alt="User Profile Image">
                </div>
                <div class="mb-3">
                    <label for="created_at" class="form-label">Created At</label>
                    <input type="text" class="form-control" id="user_created_at" name="created_at" value="{{ $user['created_at'] }}" readonly>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
    $(document).ready(function() {
        $('#editBannerAd').submit(function(e) {
            e.preventDefault();
            var id = $('#id').val();
            var status = $('#status').val();
            $.ajax({
                url: baseUrl + '/api/admin/updateBannerAd',
                type: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });
        });
    });
</script>
@endsection

