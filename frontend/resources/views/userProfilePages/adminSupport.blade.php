@extends('layouts.userProfileLayouts')
@section('content')

<section class="my-profile mt-5 " id="my-profile">
    <div class="container-lg mt-3">
        <div class="row justify-content-center align-items-start">

            <!-- ----------left side------------>
            {{-- Mobile view --}}
            <div class="profile d-flex d-sm-none align-items-center ms-3">
                <div class="profile-image me-3">
                    <img src="data:image/jpeg;base64,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" alt="Profile Picture" class="avatar">                </div>
                <div class="profile-info">
                    
                    <p class="user-name m-0 d-sm-none"></p>
                    <p class="redirect-login"></p>
                    
                </div>
            </div>
            
            <div class="col-sm-4 col-xl-3">
                
                @include('userProfilePages.sideNavBar')
                

            </div>

            <!-- ----------right side---------- -->
            <div class="col-sm-8 col-xl-8 col-12 d-sm-flex">
                <div class="container-lg d-flex flex-column justify-content-start align-items-start">
                    <h4>Submit a Support Request</h4>
                    <hr class="mt-3">
                    <form id="adminSupportForm" class="col-12">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <select name="title" id="title" class="form-control">
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Technical Issue">Technical Issue</option>
                                <option value="Billing">Billing</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
            <!-- ----------right side end---------- -->

        </div>
    </div>
</section>
<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
    $('#admin').addClass('activeTag');

    $('#adminSupportForm').submit(function(e){
        e.preventDefault();
        var tittle = $('#title').val();
        const token = sessionStorage.getItem('token');
        var description = $('#description').val();
        console.log(title , description);
        $.ajax({
            url: baseUrl + '/api/my/submitSupportRequest',
            type: 'POST',
            headers :{
                'Authorization': 'Bearer ' + token
            },
            data: {
                tittle: tittle,
                description: description
            },
            success: function(response) {
                if(response.status == 200){
                    alert('Support request submitted successfully');
                    $('#title').val('');
                    $('#description').val('');
                }else{
                    alert('Failed to submit support request');
                }
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        })
    })
</script>
@endsection