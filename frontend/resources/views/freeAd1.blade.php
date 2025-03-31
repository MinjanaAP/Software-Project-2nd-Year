
@extends('layout')

@section('header')
@parent
@endsection

@section('content')
<div class="container col-lg-8 mt-2">
    <h5 class="h5">Free Advertisement</h5>
</div>
<div class="container col-lg-8 mt-3">
    <h4 class="user-name h4 m-0"></h4>
    <p class="p">Choose an option below to post an ad.</p>
</div>


<div class="container">
    @foreach($subCategories['data'] as $index => $subCategory)
        @if($index % 3 == 0)
            <div class="container col-lg-8 mt-2 mb-2">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
        @endif

        <div class="col-lg-4 col-md-4 col-sm-4 col-4 d-flex justify-content-center">
            <div class="profile-box text-center mt-2 mb-2">
                <a onclick="saveCategory('{{ $subCategory['Name'] }}')" href="javascript:void(0);">
                    <img src="{{$subCategory['icon_url']}}" alt="Profile Image" class="profile-image mb-3">
                </a>
                <p class="subCategory">{{ $subCategory['Name'] }}</p>
            </div>
        </div>

        @if($index % 3 == 2 || $index == count($subCategories['data']) - 1)
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>



<script>
    $(document).ready(function(){
        $('#adPostBtn').prop('disabled', true);
        function isLoggedIn(){
            if(!sessionStorage.getItem('token')){
                Swal.fire({
                        title: "Unauthorized",
                        text: "You are not authorized to access this page. Please login.",
                        icon: "error",
                        didClose: () => {
                            window.location.href = "/login";
                        }
                    });
            }else{
                const role = sessionStorage.getItem('role');
                if(role != 'user'){
                    Swal.fire({
                        title: "Unauthorized",
                        text: "You are not authorized to access this page. Please login as a user.",
                        icon: "error",
                        didClose: () => {
                            window.location.href = "/login";
                        }
                    });
                }
            }
        }
        isLoggedIn();
    })
    function saveCategory(subCategory) {
        // Retrieve the category
        var category = 'Electronics';

        // Store category and subCategory in local storage
        localStorage.setItem('category', category);
        localStorage.setItem('subCategory', subCategory);

        // Debugging output
        console.log('Category:', localStorage.getItem('category'));
        console.log('SubCategory:', localStorage.getItem('subCategory'));

        // Redirect to freeAd2 page with subCategory as parameter
        window.location.href = `/freeAd2/${encodeURIComponent(localStorage.getItem('subCategory'))}`;
    }
</script>
@endsection
