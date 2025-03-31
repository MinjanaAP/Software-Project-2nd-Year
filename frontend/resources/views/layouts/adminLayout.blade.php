<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom SCSS -->
    @vite(['resources/scss/adminDashboard.scss','resources/scss/productPage1.scss'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <style>
        #main-content {
            display: none;
        }
    </style>
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        
        <div class="d-flex align-items-center">
            <button class="btn visit-site" id="visit-site-btn" onclick="visiteSite()">visit site<i class="bi bi-arrow-up-right-circle-fill ms-2"></i></button>
            <div class="info mx-2"></div>
            <div class="header_img"> 
                <img src="/image/admin_avatar.png" onclick="adminSignout()" alt="profile_image">
            </div>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> 
                    <i class='bx bx-layer nav_logo-icon'></i> 
                    <span class="nav_logo-name">Admin Panel</span>
                </a>
                <div class="nav_list"> 
                    <a href="/admin/dashboard" class="nav_link active"> 
                        <i class='bx bx-grid-alt nav_icon'></i> 
                        <span class="nav_name">Dashboard</span> 
                    </a> 
                    <a href="/admin/users" class="nav_link"> 
                        <i class='bx bx-user nav_icon'></i> 
                        <span class="nav_name">Users</span> 
                    </a> 
                    <a href="/admin/freeAds" class="nav_link"> 
                        <i class='bx bx-message-square-detail nav_icon'></i> 
                        <span class="nav_name">Free Ads</span> 
                    </a> 
                    <a href="/admin/paidAds" class="nav_link"> 
                        <i class="bi bi-cash-stack"></i>
                        <span class="nav_name">Banner Ads</span> 
                    </a>
                    <a href="/admin/reports" class="nav_link"> 
                        <i class='bx bx-bookmark nav_icon'></i> 
                        <span class="nav_name">User Feedbacks</span> 
                    </a> 
                    <a href="/admin/addFeatures" class="nav_link"> 
                        <i class='bx bx-folder nav_icon'></i> 
                        <span class="nav_name">Add Features</span> 
                    </a> 
                    <a href="/admin/navBarAd" class="nav_link"> 
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i> 
                        <span class="nav_name">Nav Bar Ad</span> 
                    </a> 
                </div>
            </div> 
            <a href="#" class="nav_link" onclick="adminSignout()"> 
                <i class='bx bx-log-out nav_icon'></i> 
                <span class="nav_name" >SignOut</span> 
            </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div id="main-content" class="height-100 mt-5 pt-5">
        @yield('content')
    </div>
    <!--Container Main end-->
    <script>
        var baseUrl = "{{ env('APP_BASE_URL') }}";
        $(document).ready(function() {
            const token = sessionStorage.getItem('token');

            function validateToken() {

                var name = sessionStorage.getItem('first_name');
                var email = sessionStorage.getItem('email');
                var profile_img_link = sessionStorage.getItem('profile_pic');

                $('.info').html('<h6>Welcome</h6><h6><b>' + name + '</b></h6>');

                if (profile_img_link ) {
                    $('.profile-photo').attr('src',profile_img_link);
                    $('.profile-img-link').attr('href', '/my/profile/account');
                    $('.profile-photo').show();
                }

                return new Promise((resolve, reject) => {
                    if (token) {
                        $.ajax({
                            url: baseUrl + '/api/auth/validate_token',
                            type: 'GET',
                            headers: {
                                'Authorization': 'Bearer ' + token
                            },
                            success: function (response) {
                                if (response.user.role == 'admin' || response.user.role == 'superAdmin' || response.user.role == 'adminUser') {
                                    sessionStorage.setItem('role', response.user.role);
                                    sessionStorage.setItem('user_id',response.user.id);
                                    resolve(response);
                                } else {
                                    reject('Unauthorized');
                                }
                            },
                            error: function (xhr, status, error) {
                                sessionStorage.removeItem('token');
                                reject(xhr.responseText);
                            }
                        });
                    } else {
                        reject('No token found');
                    }
                });
            }

            validateToken()
                .then(response => {
                    $('#main-content').show(); 
                })
                .catch(error => {
                    Swal.fire({
                        title: "Unauthorized",
                        text: "You don't have permission to view this page. Redirecting to login...",
                        icon: "error",
                        didClose: () => {
                            window.location.href = "/login";
                        }
                    });
                });
        });

        document.addEventListener("DOMContentLoaded", function(event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId);
                
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        nav.classList.toggle('show');
                        toggle.classList.toggle('bx-x');
                        bodypd.classList.toggle('body-pd');
                        headerpd.classList.toggle('body-pd');
                    });
                }
            }
            
            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');
            
            const linkColor = document.querySelectorAll('.nav_link');
            
            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                }
            }
            
            linkColor.forEach(l => l.addEventListener('click', colorLink));
        });

        function adminSignout() {
            Swal.fire({
                title: "Are you sure you want to log out?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    const token = sessionStorage.getItem('token');
                    $.ajax({
                        url : baseUrl + '/api/auth/logout',
                        type : 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token 
                        },
                        success : function(){
                            sessionStorage.removeItem('token');
                            Swal.fire({
                        title: "Logged out successfully!",
                        icon: "success"
                        });
                        setTimeout(() => {
                            window.location.href = "/login";
                        }, 2000);
                        },
                        error:function(xhr, status, error){
                            Swal.fire({
                                title: "Error",
                                text: xhr.responseText,
                                icon: "error"
                            });
                        }
                    })
                }
            });
        }

        function visiteSite(){
            window.location.href = '/';
        }
    </script>
</body>
</html>
