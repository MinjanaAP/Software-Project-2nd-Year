<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/scss/errorPages.scss'])
</head>
<body class="error404 d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <img src="{{ URL('images/503 Error.gif') }}" alt="404 Image" class="img-fluid">
             
        <div class="wrapper">
            <h1 class="error-topic">Service Unavailable</h1>
            <p class="message">
                Service temporarily unavailable. We are performing maintenance and will be back shortly.
            </p>
            <div class="button-wrap">
                <button type="button" class='custom-button' onclick="window.location.href='/login'">
                    <span class='button-text'> Login </span>
                </button>

                <button type="button" class='custom-button' onclick="window.location.href='/signup'">
                    <span class='button-text'> Sign Up </span>
                </button>
            </div>
            
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

