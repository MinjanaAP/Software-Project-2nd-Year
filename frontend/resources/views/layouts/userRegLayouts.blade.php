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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>

    @vite(['resources/scss/layout.scss', 'resources/scss/freead.scss'])
    @vite(['resources/scss/userLoging.scss'])

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>

    @section('header')
    <section class="navbar m-0 p-0" id="navbar">

    <div class="container-fluid bg-wh-red">
        <p>nav1</p>
    </div>


    <div class="container-fluid bg-wh-green d-none d-lg-block" style="height: 16px">
        <div class="container-lg d-none d-lg-flex justify-content-center align-items-center">
        </div>
        </div>
    </div>



    <div class="container-fluid bg-wh-bleach navbar-expand-lg navbar-light">
        <div class="container d-none d-lg-block">
            <div class="row">
                <div class="col-xl-2 col-md-2  d-flex align-items-center justify-content-center mt-2 mb-2">
                    <img src="{{URL('images/logo emporia.png')}}" alt='' class="logo" id="logo" width="50px" height="50px" />
                    <h5 class="tittle mb-0">emporia</h5>
                </div>


                <!--navbar links-->
                <div class="col-xl-8 col-md-8 d-flex  collapse navbar-collapse align-items-center justify-content-center">
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
                </div>


                <div class="col-xl-2 col-md-2  d-flex align-items-center justify-content-center p-0 ">
                    <button class="btn btn-wh-green py-2" type="submit">
                        <h6 class="h6 m-0">Post your Ad</h6>
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid bg-wh-green d-none d-lg-block" style="height: 2px">
        <div class="container-lg d-none d-lg-flex justify-content-center align-items-center">
        </div>
        </div>
    </div>

    <div class="container-fluid bg-wh-green ">
        <div class="container d-block d-lg-none my-2">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-2 d-flex align-items-center justify-content-start ">
                    <a href="/"> <img src="{{URL('image/home (6).png')}}" alt='' class="logo" id="logo" width="20px" height="20px"/>                    </a>
                </div>

            <div class="col-6 d-flex align-items-center justify-content-center">
            <div class="icon-header d-flex align-items-center">
                <img src="{{URL('images/logo emporia.png')}}" alt='' class="logo" id="logo" width="25px" height="25px" />
                <h1 class="tittle-e d-flex justify-content-center align-items-center ms-2 mb-0 text-center">Emporia</h1>
            </div>
            </div>

            <div class="col-2 d-flex align-items-center justify-content-end">
                <h5 class="m-0 p-0"><a href="/aboutUs/#terms"><i class="bi bi-question-circle"></i>  </a></h5>
            </div>

        </div>
        </div>
    </div>

    </section>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NniksUx2Tjy0J6Z9RlG3Qr" crossorigin="anonymous"></script> -->

    @show

    @yield('content')
    </body>

    </html>