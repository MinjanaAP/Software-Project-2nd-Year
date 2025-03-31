<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>     
@vite(['resources/scss/layout.scss', 'resources/scss/sideNavBar.scss', 'resources/scss/userProfile.scss'])
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

@section('header')
<section class="navbar p-0 m-0" id="navbar">

    <div class="container-fluid bg-wh-red">
      <p>nav1</p>
    </div>


    <div class="container-fluid bg-wh-green">
      <div class="container d-none d-lg-block">
        <div class="row ">
          <div class="col-xl-2 col-md-3 d-flex  justify-content-start">
            <div class="icon-header d-flex align-items-center justify-content-end">
              <img src="{{URL('images/logo emporia.png')}}" alt='' class="logo" id="logo" width="50px" height="50px" />
              <h5 class="tittle mb-0">emporia</h5>
            </div>
          </div>
          <div class="col-xl-8 col-md-6  d-flex align-item-center justify-content-center mt-2 mb-2">
            <form class="w-100" role="search">
              <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-search"></i></span>
                  <input class="layout form-control" name="search" type="search" placeholder="Search for anything...." aria-label="Search">
              </div>
          </form>
          </div>
          <div class="col-xl-2 col-md-3 d-flex align-items-center justify-content-end p-0 m-0">
            <div class="profile d-flex justify-content-center align-items-center ">

              
                <div class="info ms-2">
                  <div class="spinner-border text-secondary" id="spinner" role="status" style="display: none">
                    <span class="visually-hidden">Loading...</span>
                </div>
                  
                  {{-- <h6><b>{{ $userName }}</b></h6> <!-- Replace $userName with actual user's name --> --}}
                </div>
                <img src="{{URL('images/profile.png')}}" alt='' class="profile-photo" id="profile-photo" width="50px" height="50px" />
              
                <div class="login-signup-buttons " id="login-signup-buttons">
                  <button class="button-login" onclick="window.location.href='/login'" id="login-btn">Login</button>
                  <button class="button-signUp" onclick="window.location.href='/signup'" id="signup-btn">Sign Up</button>
                </div>
              

              {{-- <div className='info' ms-2>
                <h6>Welcome</h6>
                <h6><b>Jeniffer Lopez</b></h6>
              </div> --}}

            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="container-fluid bg-wh-bleach navbar-expand-lg navbar-light">
      <div class="container d-none d-lg-block">
        <div class="row">
          <div class="col-xl-2 col-md-2  d-flex align-items-center justify-content-center mt-2 mb-2">
            <div class="dropdown">
              <button class="btn btn-secondary-menu dropdown-toggle w-100 d-flex align-items-center" type="button"
                id="category-dropdown" data-bs-toggle="dropdown">
                <i class="bi bi-plus-square me-2"></i>
                <h6 class="h6 m-0">Categories</h6>
              </button>
              <ul class="dropdown-menu" id="category-select" area-labelledby="category-dropdown">
                <li><a class="dropdown-item" onclick="selectCategory('Mobile phones')" href="javascript:void(0);"><i class="bi bi-person-heart mr-3"></i> Mobiles</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Computers')" href="javascript:void(0);"><i class="bi bi-watch mr-3"></i> Computers</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Tvs')" href="javascript:void(0);"><i class="bi bi-person-workspace mr-3"></i> Tvs</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Home Appliances')" href="javascript:void(0);" ><i class="bi bi-mortarboard mr-3"></i> Home Applicances</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Home security')" href="javascript:void(0);" ><i class="bi bi-car-front-fill mr-3"></i> Home Security</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Sounds')" href="javascript:void(0);" ><i class="bi bi-tv mr-3"></i> Sounds</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Health Applicances')" href="javascript:void(0);"><i class="bi bi-house-door mr-3"></i> Health Applicances</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Laptops')" href="javascript:void(0);"><i class="bi bi-building-fill mr-3"></i> Cameras</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Health Applicances')" href="javascript:void(0);"><i class="bi bi-wrench mr-3"></i> Laptops</a></li>

              </ul>
            </div>
          </div>


          <!--navbar links-->
          <div class="col-xl-8 col-md-8 d-flex  collapse navbar-collapse align-items-center justify-content-center">
            <!-- <nav class="navbar navbar-expand-lg">-->
            <!--  <div class="container-fluid">-->



              <ul class="navbar-nav ">
                <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/#allAds">All Ads</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/#latesAds">Latest</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/#popularAds">Popular</a>
                </li>
                <li class="nav-item">
                  <div class="bargain d-flex align-items-center">
                    <a class="nav-link" href="/my/profile/bargainAds">Bargain</a>
                  </div>
                </li>
                <li class="nav-item">
                  <div class="account d-flex align-items-center">
                    <a class="nav-link" href="/my/profile">My Account</a>
                  </div>
                </li>
              </ul>
            <!--</div>-->
          </div>
          <!-- </nav>-->


          <div class="col-xl-2 col-md-2  d-flex align-items-center justify-content-end p-0 ">
            <button class="btn btn-wh-green py-2" onclick="postAd()">
              <h6 class="h6 m-0">Post your Ad</h6>
            </button>
          </div>

        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="container-fluid bg-wh-green ">
      <div class="container d-block d-lg-none">
        <div class="row d-flex justify-content-between align-items-center">
          <div class="col-3 col-sm-5 col-md-4 d-flex align-items-center justify-content-start p-0">
            <div class="dropdown">
              <button class="menu-button " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="{{URL('images/menu.svg')}}" alt='menu' className="menu" width="25px" height="25px" />
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" onclick="selectCategory('Mobile phones')" href="javascript:void(0);"><i class="bi bi-phone mr-3"></i> Mobiles</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Computers')" href="javascript:void(0);"><i class="bi bi-pc-display-horizontal mr-3"></i> Computers</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Tvs')" href="javascript:void(0);"><i class="bi bi-tv mr-3"></i> Tvs</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Home Appliances')" href="javascript:void(0);" ><i class="bi bi-mortarboard mr-3"></i> Home Applicances</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Home security')" href="javascript:void(0);" ><i class="bi bi-car-front-fill mr-3"></i> Home Security</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Sounds')" href="javascript:void(0);" ><i class="bi bi-headphones mr-3"></i> Sounds</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Health Applicances')" href="javascript:void(0);"><i class="bi bi-house-door mr-3"></i> Health Applicances</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Laptops')" href="javascript:void(0);"><i class="bi bi-camera mr-3"></i> Cameras</a></li>
                <li><a class="dropdown-item" onclick="selectCategory('Health Applicances')" href="javascript:void(0);"><i class="bi bi-laptop mr-3"></i> Laptops</a></li>
                <li><a class="dropdown-item" href="#">
                    <div class="col-xl-2 col-md-12  d-flex align-items-center justify-content-center p-0 ">
                      <button class="btn btn-wh-bleach py-2" type="submit" onclick="postAd()">
                        <h6 class="h6 m-0">Post your Ad</h6>
                      </button>
                    </div>
                  </a></li>
              </ul>
            </div>
          </div>

          <div class="col-4 col-sm-2 col-md-4 d-flex align-items-center justify-content-center">
            <div class="icon-header d-flex d-md-none align-items-center">
              {{-- <img src="{{URL('images/logo emporia.png')}}" alt='' class="logo" id="logo" width="25px" height="25px" /> --}}
              <h5 class="tittle-sm d-flex justify-content-center align-items-center ms-2 mb-0 text-center">Emporia</h5>
            </div>
            <div class="icon-header d-none d-md-flex align-items-center">
              <img src="{{URL('images/logo emporia.png')}}" alt='' class="logo" id="logo" width="25px" height="25px" />
              <h5 class="tittle d-flex justify-content-center align-items-center ms-2 mb-0 text-center">Emporia</h5>
            </div>
          </div>

          <div class="col-3 col-sm-3 col-md-4 d-flex align-items-center justify-content-end px-0 mt-2 mb-2">
            <!--This is small size dropdown-->
            <div class="dropdown d-block d-sm-none" id="dropdownLoginButton">
              <button class="menu-button " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="{{URL('images/profile.png')}}" alt='menu' className="menu" width="25px" height="25px" id="log-profile" />
              </button>
              <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenuButton1" id="loginBtnDropdown">
                <li><a class="dropdown-item" href="#">
                      <div class="d-flex align-items-end justify-content-center p-0 ">
                      <button class="button-login" onclick="window.location.href='/login'">Login</button>
                      </div>
                    </a></li>

                  <li><a class="dropdown-item" href="#">
                      <div class="col-xl-2 col-md-12  d-flex align-items-center justify-content-center p-0 ">
                      <button class="button-signUp" onclick="window.location.href='/signup'">Sign Up</button>
                      </div>
                    </a>
                </li>
              </ul>
            </div>

            <!--This is login sign up button-->
            <div class="info d-none d-lg-block ms-2">
              <div class="spinner-border text-secondary" id="spinner" role="status" style="display: none">
                    <span class="visually-hidden">Loading...</span>
                </div>
                  
                  {{-- <h6><b>{{ $userName }}</b></h6> <!-- Replace $userName with actual user's name --> --}}
                </div>
                <a href="" class="profile-img-link">
                  <img src="{{URL('images/profile.png')}}" alt='' class="profile-photo" id="profile-photo" width="50px" height="50px" />
                </a>              
                <div class="login-signup-button d-none d-sm-block" id="login-signup-buttons">
                  <button class="button-login" onclick="window.location.href='/login'" id="login-btn">Login</button>
                  <button class="button-signUp" onclick="window.location.href='/signup'" id="signup-btn">Sign Up</button>
                </div>
                {{-- <div className='info' ms-2>
                <h6>Welcome</h6>
                <h6><b>Jeniffer Lopez</b></h6>
              </div> --}}
          </div>

        </div>
      </div>
    </div>

  </section>
  <div class="bottom-scroll-bar col-10 mb-3 d-sm-none">
    <div class="row d-flex justify-content-between align-items-center">
      <div class="background-box col-2 d-flex justify-content-center align-items-center" id="background-box">
        <h5 class="p-0 m-0"><a href="/"><i class="bi bi-house-fill"></i></a></h5>      
      </div>
      <div class="background-box col-6 d-flex justify-content-center align-items-center">
          <h6 class="m-0 p-0"><a href="/freeAd1">Post an Ad<i class="bi bi-plus-circle ms-2"></i></a></h6>
      </div>
      <div class="background-box col-2 d-flex justify-content-center align-items-center">
        <h4 class="p-0 m-0"><a href="/my/profile"><i class="bi bi-person-fill"></i></a></h4>
      </div>

    </div>
  </div>

@show

@yield('content')
<script>
    var baseUrl = "{{ env('APP_BASE_URL') }}";
$(document).ready(function(){

  const urlParams = new URLSearchParams(window.location.search);
  const searchValue = urlParams.get('search');
  console.log(searchValue);

  if(searchValue){
    window.location.href = '/?search=' + searchValue;
  }


  const token = sessionStorage.getItem('token');
// console.log(token);
    
function isLoggedIn() {
    return sessionStorage.getItem('token') !== null;
}


function getAccessToken() {
    return sessionStorage.getItem('token');
}


function validateToken() {
    if (isLoggedIn()) {
        $('#login-btn').hide();
        $('#signup-btn').hide();
        $('#log-profile').hide();
        $('.login-signup-buttons').hide();
        const token = getAccessToken();

        var name = sessionStorage.getItem('first_name');
        var email = sessionStorage.getItem('email');
        var profile_img_link = sessionStorage.getItem('profile_pic');
        var number = sessionStorage.getItem('phone');
        var status = sessionStorage.getItem('status');


        // Show spinner
        $('#spinner').show();

        $('#spinner-name').hide();

        // If user is logged in
        $('#dropdownLoginButton').empty();
        $('.info').html('<h6>Welcome</h6><h6><b>' + name + '</b></h6>');
        $('.login-signup-buttons').hide();
        $('.user-name').html('<b>Welcome !!!</b> <br>' + name);
        $('.name').html(name);
        if (profile_img_link ) {
            $('.profile-photo').attr('src',profile_img_link);
            $('.profile-img-link').attr('href', '/my/profile/account');
            $('.profile-photo').show();
        }

        // My profile page details
        $('#user-name').html(name);
        $('#user-email').html(email);
        $('#user-phone').html(number);

        // My profile email verify btn
        if ((status != 'verify')) {
            $('#verifyEmailBtn').show();
        }else{
            $('#verifiedTag').show();
        }

        $.ajax({
            url: baseUrl + '/api/auth/validate_token', 
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token 
            },
            success: function(response) {
                console.log('Token is valid');
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('Token validation failed');
                console.error(xhr.responseText);

                // Hide spinner
                $('#spinner').hide();

                sessionStorage.removeItem('token');
                // window.location.href = '/login'; 
                Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Your Token is Expired.",
                        footer: '<a href="/login"> Please Login to Continue. </a>'
                        });
            }
        });
        return true;
    } else {
        $('.login-signup-buttons').show();
        $('.profile-photo').hide();
        $('.user-name').html('Welcome to findIt');
        $('.redirect-login').html('Please <a href="/login">Login</a> to continue....');
        console.log('User is not logged in');
        return false;
    }
}


// Example usage
validateToken();


})
</script>
</body>

</html>