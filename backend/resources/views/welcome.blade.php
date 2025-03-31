<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.28/sweetalert2.min.css">
</head>
<body>
    <h1>Database migrations and backend</h1>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.28/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            @if (session('success'))
                var successMessage = "{{ session('success') }}";
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: successMessage,
                    confirmButtonColor: '#007bff',
                    textColor: '#000'
                });
            @elseif (session('error'))
                var errorMessage = "{{ session('error') }}";
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    confirmButtonColor: '#007bff',
                    textColor: '#000'
                });
            @endif
        });
    </script>
</body>
</html>
