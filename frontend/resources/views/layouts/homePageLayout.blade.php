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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>

  @vite(['resources/scss/layout.scss', 'resources/scss/homePage.scss','resources/scss/footer.scss', 'resources/scss/freead.scss','resources/scss/app.scss', 'resources/scss/productPage1.scss'])
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

</head>

<body>

@section('header')
  <section class="navbar p-0 m-0" id="navbar">

    <div class="container-fluid bg-wh-red d-flex align-items-center justify-content-center">
      
       
      <div class="scrolling-text-container">
          <div class="scrolling-text d-flex align-items-center justify-content-center py-2 m-1">
              <p class="scrolling-text-content fw-bold m-0" id="typewriter"> </p>
          </div>
      </div>


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
            <form class="w-75" role="search">
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
              @foreach($subCategories as $subCategory)
              <li><a class="dropdown-item d-flex align-items-center" onclick="selectCategory('{{ $subCategory['Name'] }}')" href="javascript:void(0);" style="padding: 10px;"><img src="{{$subCategory['icon_url']}}" alt="icon-Image" class="icon-image" style="margin-right: 10px;">{{ $subCategory['Name'] }}</a></li>
              @endforeach

              </ul>
            </div>
          </div>


          <!--navbar links-->
          <div class="col-xl-8 col-md-7 d-flex  collapse navbar-collapse align-items-center justify-content-center">
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
                  <div class="bargain d-flex align-items-center" id="myBargain">
                    <a class="nav-link" href="/my/profile/bargainAds" >Bargain</a>
                  </div>
                </li>
                <li class="nav-item">
                  <div class="account d-flex align-items-center" id="myAccount">
                    <a class="nav-link" href="/my/profile" >My Account</a>
                  </div>
                </li>
              </ul>
            <!--</div>-->
          </div>
          <!-- </nav>-->


          <div class="col-xl-2 col-md-3  d-flex align-items-center justify-content-end p-0 ">

          <div class="dropdown-center">
  <button id="filterDropdownButton" type="button" class="btn btn-filter dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="inside">
  <img src="{{URL('images/filter.png')}}" alt='menu' className="menu" width="25px" height="25px" />
  </button>
  <form class="filterForm dropdown-menu dropdown-menu-end p-4">
  <div class="mb-3">
            <label for="district">District</label><br>
              <select name="district"  class="form-control district">
                <option value="">Select District</option>
                    @foreach ($data as $district)
                    <option value="{{ $district }}">{{ $district }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="town" class="form-label">Town</label>
                <select class="form-select town-dropdown" id="town" aria-label="Select Town">
                <option value="">Select Town</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="priceRange" class="form-label">Price Range</label><br>
                <select class="form-select priceRange" name="priceRange">
                  <option value="">Select a range</option>
                  <option value="0-5000">0-5000</option>
                  <option value="5000-10000">5000-10000</option>
                  <option value="10000-15000">10000-15000</option>
                  <option value="15000-20000">15000-20000</option>
                  <option value="20000-25000">20000-25000</option>
                  <option value="500000-700000">500000-700000</option>
              </select>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select category" aria-label="Select Category">
                    <option value="">Select Category</option>
                    @foreach($subCategories as $subCategory)
                    <option value="{{$subCategory['Name']}}">{{$subCategory['Name']}}</option>
                    @endforeach
                    
                </select>
            </div>
            <button type="submit" class="btn btn-primary"  href="javascript:void(0);">Apply Filters</button>
  </form>
</div>
            <button class="btn btn-wh-green py-2" id="adPostBtn" onclick="postAd()">
              <h6 class="h6 m-0" >Post your Ad</h6>
            </button>
            <button class="btn btn-wh-green py-2" id="retunrAdminPanelBtn" onclick="postAd()">
              <h6 class="h6 m-0" ><i class="bi bi-arrow-return-left me-2"></i> Admin Panel</h6>
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
          <div class="col-3 col-sm-5 col-md-4 d-flex align-items-center justify-content-start px-0">
            <div class="dropdown">
              <button class="menu-button " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="{{URL('images/menu.svg')}}" alt='menu' className="menu" width="25px" height="25px" />
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              @foreach($subCategories as $subCategory)
              <li><a class="dropdown-item d-flex align-items-center" onclick="selectCategory('{{ $subCategory['Name'] }}')" href="javascript:void(0);" style="padding: 10px;"><img src="{{$subCategory['icon_url']}}" alt="icon-Image" class="icon-image" style="margin-right: 10px;">{{ $subCategory['Name'] }}</a></li>
              @endforeach
                    <div class="col-xl-2 col-md-12  d-flex align-items-center justify-content-center p-0 ">
                      <button class="btn btn-wh-bleach py-2" type="submit" onclick="postAd()">
                        <h6 class="h6 m-0">Post your Ad</h6>
                      </button>
                    </div>
                  </a></li>
              </ul>
            </div>
            <button id="filterDropdownButton" type="button" class="btn btn-filter dropdown-toggle custom-padding" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="inside">
                <img src="{{URL('images/filter_icon.png')}}" alt='menu' className="menu" width="25px" height="25px" />
            </button>
            <form class="filterForm dropdown-menu dropdown-menu-custom p-4">
            <div class="mb-3">
            <label for="district">District</label><br>
              <select name="district" class="form-control district">
                <option value="">Select District</option>
                    @foreach ($data as $district)
                    <option value="{{ $district }}">{{ $district }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="town" class="form-label">Town</label>
                <select class="form-select town-dropdown" id="town" aria-label="Select Town">
                <option value="">Select Town</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="priceRange" class="form-label">Price Range</label><br>
                <select class="form-select priceRange" name="priceRange">
                  <option value="">Select a range</option>
                  <option value="0-5000">0-5000</option>
                  <option value="5000-10000">5000-10000</option>
                  <option value="10000-15000">10000-15000</option>
                  <option value="15000-20000">15000-20000</option>
                  <option value="20000-25000">20000-25000</option>
                  <option value="500000-700000">500000-700000</option>
              </select>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select category" aria-label="Select Category">
                    <option value="">Select Category</option>
                    @foreach($subCategories as $subCategory)
                    <option value="{{$subCategory['Name']}}">{{$subCategory['Name']}}</option>
                    @endforeach
                    
                </select>
            </div>
            <button type="submit" class="btn btn-primary"   href="javascript:void(0);">Apply Filters</button>
  </form>
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
            <button type="button" class="btn" data-bs-toggle="dropdown" id="dropdownMenuButton1" aria-expanded="false">
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
              
                <div class="login-signup-button-md d-none d-sm-block" id="login-signup-buttons-md">
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
    <div class="container align-items-center justify-content-center">
    <div class="row  ">
        <div class="col col-sm col-md d-flex d-block d-lg-none align-items-center justify-content-center mt-2 mb-2">
          <form class="w-100" role="search">
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-search"></i></span>
              <input class="layout form-control" name="search" id="search-sm" type="search" placeholder="Search for anything...." aria-label="Search">
              <button type="button" class="btn btn-dark" onclick="searchText()">Search</button>
            </div>
          </form>
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


@section('footer')
<body>
    <section class="footer mt-5" id="footer">
        <div class="container">
            <div class="row">

                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 footer-about">
                    <div class="footer-text pull-left">
                        <div class="d-flex footer-brand">
                            <h1 class="font-weight-bold mr-2 px-2" style="color: white; background: linear-gradient(90deg, #3F2E40, #6A4F6A);  border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); display: inline-block;">EMPORIA</h1>
                            <!-- <h1 style="color: #3F2E40">it</h1> -->
                        </div>
                        <p class="card-text mt-0">Connect with your audience and drive exceptional results with our customized ad solutions</p>
                        <div class="social mt-2 mb-3 footer-social">

                            <i class="bi bi-facebook"></i>
                            <i class="bi bi-instagram"></i>
                            <i class="bi bi-twitter"></i>
                            <i class="bi bi-linkedin"></i>
                            
                        </div>
                    </div>
                </div>

                <div class="col col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 footer-company">
                    <h4> Company </h4>
                    <ul>
                      <li> <a href="/aboutUs/#about">About Us</a></li>
                      <li> <a href="/aboutUs/#privacy">Privacy Policy</a></li>
                      <li> <a href="/aboutUs/#terms">Terms & Conditions</a></li>
                      <li> <a href="/aboutUs/#faq"> FAQ </a></li>
                    </ul>
                </div>

                <div class="col col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 footer-help-support">
                  <h4> My Account </h4>  
                  <ul>
                      <li> <a href="/my/profile/account"> My Profile </a></li>
                      <li> <a href="/my/ads"> My Advertisements </a></li>
                      <li> <a href="/my/favouriteAds"> Favourites </a></li>
                      <li> <a href="/my/profile/notifications"> Notifications </a></li>
                  </ul>
                </div>

                <div class="col col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 footer-account">
                  <h4> Help & Support </h4>
                    <ul>
                      <li> <a href="/my/profile/edit"> Settings </a></li>
                      <li> <a href="/my/adminSupport"> Admin Support </a></li>
                    </ul>
                </div>

                <div class="divider mb-2 footer-divider"> </div>
                <div class="row footer-copyright-row" style="font-size:10px;">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="col-copyright footer-copyright">
                            <p> &copy; 2024 Team White_hackz. All Rights Reserved. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
 </body> 




    @show


<script>
  var baseUrl = "{{ env('APP_BASE_URL') }}";

  function searchText(){
    var search_text = document.getElementById('search-sm').value;
    window.location.href = '?search=' + search_text;
  }

  $(document).ready(function(){
    document.getElementById('login-signup-buttons').style.display = 'none'
    const urlParams = new URLSearchParams(window.location.search);
    const providerToken = urlParams.get('token');

    $('#retunrAdminPanelBtn').hide();

    var status = sessionStorage.getItem('status');

    if(status && status === 'banned'){
      window.location.href = '/my/profile/notifications';
    }
    // Call validateToken and then getUserDetails
    validateToken().then((userId) => {
          getUserDetails(userId);
      }).catch((error) => {
          console.error(error);
      });

    if (providerToken) {
        console.log(providerToken);
        sessionStorage.setItem('token', providerToken);
    }
      let userId;
      const token = sessionStorage.getItem('token');

      function isLoggedIn() {
          return sessionStorage.getItem('token') !== null;
      }

      function getAccessToken() {
          return sessionStorage.getItem('token');
      }

      function validateToken() {
          return new Promise((resolve, reject) => {
              if (isLoggedIn()) {
                $('#login-btn').hide();
                $('#signup-btn').hide();
                $('#log-profile').hide();
                $('#login-signup-buttons').hide();
                $('#login-signup-buttons-md').hide();
                document.getElementById('login-signup-buttons').style.display = 'none';
                  const token = getAccessToken();
                  $('#spinner').show();

                  var name = sessionStorage.getItem('first_name');
                  var email = sessionStorage.getItem('email');
                  var profile_img_link = sessionStorage.getItem('profile_pic');
                  var number = sessionStorage.getItem('phone');
                  var status = sessionStorage.getItem('status');
                  var role = sessionStorage.getItem('role');

                  if(role != 'user'){
                    $('#myBargain').empty();
                    $('#myAccount').empty();
                    $('#adPostBtn').hide();
                    $('#retunrAdminPanelBtn').show();
                  }else{
                    $('#myBargain').show();
                    $('#myAccount').show();
                    $('#adPostBtn').show();
                    $('#retunrAdminPanelBtn').hide();
                  }

                  document.getElementById('login-signup-buttons').style.display = 'none';

                  
                  $('#spinner').hide();
                  $('#dropdownLoginButton').empty();
                  $('#login-signup-buttons').hide();

                  if(name){
                    $('.info').html('<h6>Welcome </h6><h6><b>' + name + '</b></h6>');
                    $('.user-name').html('Welcome ' + name);
                  }
                  if(profile_img_link != null) {
                      $('.profile-photo').attr('src', profile_img_link);
                      $('.profile-img-link').attr('href', '/my/profile/account');
                      $('.profile-photo').show();
                      $('#user-email').html(email);
                      $('#user-phone').html(number);
                  }
                  


                  $.ajax({
                      url: baseUrl+'/api/auth/validate_token',
                      type: 'GET',
                      headers: {
                          'Authorization': 'Bearer ' + token
                      },
                      success: function(response) {
                          console.log('Token is valid');
                          console.log(response)
                          if(email === null){
                            sessionStorage.setItem('role',response.user.role);
                            sessionStorage.setItem('user_id',response.user.id);
                            sessionStorage.setItem('email',response.user.email);
                            sessionStorage.setItem('first_name',response.user.first_name);
                            sessionStorage.setItem('last_name',response.user.last_name);
                            sessionStorage.setItem('phone',response.user.telephone_no_1);
                            // sessionStorage.setItem('profile_pic',response.user.profile_image);
                            sessionStorage.setItem('status',response.user.status);
                            window.location.reload();
                          }
                          
                      },
                      error: function(xhr, status, error) {
                          console.error('Token validation failed');
                          $('#spinner').hide();
                          console.error(xhr.responseText);
                          sessionStorage.removeItem('token');
                            Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text: "Your Token is Expired.",
                          footer: '<a href="/login"> Please Login to Continue. </a>'
                          });
                          reject(error);
                      }
                  });
              } else {
                $('.login-signup-buttons').show();
                $('#login-signup-buttons-md').hide();
                  $('.profile-photo').hide();
                  $('.user-name').html('Welcome to findIt');
                  console.log('User is not logged in');
                  reject('User is not logged in');
              }
          });
      }

      




      //basuru
      $.ajax({
        url: baseUrl + '/api/getNavBarAds',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          console.log(response); 
          if (response.status === 200) {

            localStorage.setItem('navBarAd',response.data.description);
            console.log('Nav bar ad retrieval successful:', response.data);
          } else {
            console.error('Nav bar ad retrieval failed:', response.message);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('AJAX Error:', textStatus, errorThrown);
        }
      });





      function getUserDetails(userId) {
          console.log(userId);
      }

      //get district and specific town
      $('.town-dropdown').prop('disabled', true);
        $('.district').on('change', function() {
            var selectedDistrict = $(this).val();
            $.ajax({
                
                url: baseUrl+'/api/town/getSpecificTowns', // Route to your backend endpoint
                type: 'POST',
                data: { district: selectedDistrict },
                success: function(response) {
                    //console.log(response);
                    $('.town-dropdown').prop('disabled', false);
                    var townsDropdown = $('.town-dropdown'); 
                    
                    townsDropdown.empty(); 
                    townsDropdown.append($('<option>').text('Select Town').val(''));
                    $.each(response.data, function(index, town) { 
                        townsDropdown.append($('<option>').text(town).val(town)); 
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

      // search function...
      function search(search_text) {
      $.ajax({
        url: 'http://127.0.0.1:8008/api/free_adCreate/' + search_text,
        type: 'GET',
        success: function(response) {
            console.log(response);
            if(response.status === 200) {
                var ads = response.data;
                $('#data-container').empty(); // Clear existing ads
                $('#data-container2').empty(); // Clear existing ads in second container
                ads.forEach(function(item) {
                    var negotiableText = item.negotiable === 'true' ? 'Negotiable' : '';
                    var html =
                        '<div class="viewAds p-2">' +
                            '<div class="viewAd img">' +
                                '<img class="rounded mx-auto d-block" width="200px" height="200px" src="' + item.image_1 + '" alt="Ad Image">' +
                            '</div>' +
                            '<div class="adDetails my-2 p-2">' +
                                '<span class="badge text-bg-success mt-1 mb-2">Latest</span>' +
                                '<div class="row mb-0">' +
                                    '<div class="col-6 d-flex justify-content-between ">' +
                                        '<h4 class="itemPrice fw-bold" id="price">LKR. ' + item.price + '</h4>' +
                                        '<div>' +
                                            '<span class="badge text-bg-warning me-3 ms-1 ">' + negotiableText + '</span>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-6 d-flex justify-content-end">' +
                                        '<i class="bi bi-heart px-2"></i>' +
                                        '<i class="bi bi-share-fill px-2"></i>' +
                                    '</div>' +
                                '</div>' +
                                '<h4 class="itemTitle fw-bold" id="title">' + item.title + '</h4>' +
                                '<p class="itemLocation text-secondary"><i class="bi bi-geo-alt-fill me-2"></i>' + item.town + '</p>' +
                                '<button type="button" class="btn w-100" onclick="viewAd(' + item.id + ')">View Ad <i class="bi bi-arrow-right-short ms-2"></i></button>' +
                            '</div>' +
                        '</div>';
                    $('#data-container').append(html);
                    $('#data-container2').append(html);
                });
            } else {
                $('#data-container').text('Error: Unable to fetch data');
                $('#data-container2').text('Error: Unable to fetch data');
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
      });
      }

      // function for filtering

      function applyFilters(form) {
        var district = $(form).find('.district').val();
        var town = $(form).find('.town-dropdown').val();
        var priceRange = $(form).find('.priceRange').val();
        var category = $(form).find('.category').val();
        

        console.log("Selected District:", district);
        console.log("Selected Town:", town);
        console.log("Selected Price Range:", priceRange);
        console.log("Selected Category:", category);

        filterAds(district, town, priceRange, category);

        form.reset();
}

function filterAds(district, town, priceRange, category) {
    var url = baseUrl+'/api/filterAds';
    $('#data-container').empty(); 
    $('#topic').empty();
      $('#topic').append(`
      <div>
          <h2 class="adTopic">Filtered Ads By</h2>
          <p style="font-size:16px; font-weight:lighter">
              Category: ${category} &nbsp;&nbsp;
              District: ${district} &nbsp;&nbsp;
              Town: ${town} &nbsp;&nbsp;
              Price-Range: ${priceRange}
          </p>
      </div>
    `);
    var params = {
        district: district || 'all',
        town: town || 'all',
        priceRange: priceRange || 'all',
        category: category || 'all'
    };

    // Build the URL with the parameters
    url += '/' + encodeURIComponent(params.district)
        + '/' + encodeURIComponent(params.town)
        + '/' + encodeURIComponent(params.priceRange)
        + '/' + encodeURIComponent(params.category);
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            console.log(response);
            if (response.status === 200) {

              if(response.data.length === 0){
                    $('#topic').text('No results found for: ' + category + ' in ' + district + ' - ' + town + ' - ' + priceRange);
                    $('#data-container').empty(); 
                    $('#paginationbtn-searchResult').empty();
                    $('#latesAds').append(`
                        <h3 class="text-center">Ups!... No results found.</h3>
                        <h6 class="text-center">Please try another search.</h6>
                        <div class="col-12 d-flex justify-content-center">
                            <img src="{{URL('image/homePageGIFs/empty-search.gif')}}" class="img-fluid" alt="Edition-page">
                        </div>
                    `)
                }
                var ads = response.data;
                $('#data-container').empty(); 
                $('#data-container2').empty(); 
                ads.forEach(function(item) {
                    var negotiableText = item.negotiable === 'true' ? 'Negotiable' : '';
                    var html =
                        '<div class="viewAds p-2">' +
                            '<div class="viewAd img">' +
                                '<img class="rounded mx-auto d-block" width="200px" height="200px" src="' + item.image_1 + '" alt="Ad Image">' +
                            '</div>' +
                            '<div class="adDetails my-2 p-2">' +
                                '<span class="badge text-bg-success mt-1 mb-2">Latest</span>' +
                                '<div class="row mb-0">' +
                                    '<div class="col-6 d-flex justify-content-between ">' +
                                        '<h4 class="itemPrice fw-bold" id="price">LKR. ' + item.price + '</h4>' +
                                        '<div>' +
                                            '<span class="badge text-bg-warning me-3 ms-1 ">' + negotiableText + '</span>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-6 d-flex justify-content-end">' +
                                        '<i class="bi bi-heart px-2"></i>' +
                                        '<i class="bi bi-share-fill px-2"></i>' +
                                    '</div>' +
                                '</div>' +
                                '<h4 class="itemTitle fw-bold" id="title">' + item.title + '</h4>' +
                                '<p class="itemLocation text-secondary"><i class="bi bi-geo-alt-fill me-2"></i>' + item.town + '</p>' +
                                '<button type="button" class="btn w-100" onclick="viewAd(' + item.id + ')">View Ad <i class="bi bi-arrow-right-short ms-2"></i></button>' +
                            '</div>' +
                        '</div>';
                    $('#data-container').append(html);
                    $('#data-container2').append(html);
                });
            } else {
                $('#data-container').text('Error: Unable to fetch data');
                $('#data-container2').text('Error: Unable to fetch data');
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}

// Prevent form submission
$('.filterForm').on('submit', function(event) {
    event.preventDefault();
    applyFilters(this);
});

  });

  

  

  function postAd(){ 
      if(sessionStorage.getItem('token')) {
          window.location.href = '/freeAd1';
      } else {
        Swal.fire({
        icon: "question",
        title: "Oops...",
        text: "You need to login to post an ad!",
        footer: 'Return to <a href="/login">Login</a>',
        showDenyButton: false,
        showCancelButton: false,
      });
      }
  }




    //basuru
    document.addEventListener("DOMContentLoaded", function() {
      const text = localStorage.getItem("navBarAd") // Replace with your desired text
      const typewriterElement = document.getElementById("typewriter");
      let index = 0;
      
      function typeWriter() {
          if (index < text.length) {
              typewriterElement.innerHTML += text.charAt(index);
              index++;
              setTimeout(typeWriter, 100); // Adjust the speed as needed (in milliseconds)
          } else {
              typewriterElement.classList.add("finished"); // Remove cursor after text is complete
          }
      }

      typeWriter();
    });




</script>
</body>

</html>