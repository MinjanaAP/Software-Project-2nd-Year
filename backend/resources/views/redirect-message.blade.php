<!-- resources/views/redirect-message.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect Message</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.28/sweetalert2.min.css">
</head>
<body>
    <h1>Redirecting...</h1>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.28/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            const status = urlParams.get('status');
            const message = urlParams.get('message');

            if (status && message) {
                Swal.fire({
                    icon: status === 'success' ? 'success' : 'error',
                    title: status === 'success' ? 'Success' : 'Error',
                    text: message,
                    confirmButtonColor: '#007bff',
                    textColor: '#000'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ env('FRONTEND_URL') }}';
                    }
                });
            } else {
                window.location.href = '{{ env('FRONTEND_URL') }}';
            }
        });
    </script>
</body>
</html>
