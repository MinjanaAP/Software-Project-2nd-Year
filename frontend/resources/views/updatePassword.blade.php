<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        @vite(['resources/scss/userLoging.scss'])
    </head>
    <body>


        <section class="navbar" id="navbar">
            <div class="container-fluid bg-wh-green p-0">
                <div class="container-fluid bg-wh-red">
                    <p>nav1</p>
                </div>
                <div class="container-fluid bg-wh-green">
                    <p>nav 2</p>
                </div>
                <div class="container-fluid bg-wh-bleach">
                    <p>nav-3</p>
                </div>
            </div>
        </section>


        <section class="signin-form-main" id="signin-form-main">
            <div class="container-lg  mt-5">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-5 col-md-6 col-10 ">
                    <img src="{{URL('images/Update-amico.svg')}}" class="img-fluid" alt="signin-form-main">      
                    </div>

                    <div class="col-xl-5 col-lg-8 col-md-8 pt-3 ">
                        <div class="container-fluid">
                            <h3 class="h4 m-0  mb-2">Password updated</h3>
                            <h6 class="mb-5" >Your password has been updated.</h6>
                        </div>

                        <div class="container pt-5">
                            <form action="submit" class="userRegistrationForm">

                                <div class="col-xl-8">
                                    <button class="btn user w-100 mb-2" type="submit">Log in</button>
                                    <button type="button" class="btn w-100" data-bs-toggle="button">Cancel</button>
                                </div>

                            </form>
                        </div>     
                    </div>
                </div>
            </div>
        </section>

        <script src="" async defer></script>
    </body>
</html>