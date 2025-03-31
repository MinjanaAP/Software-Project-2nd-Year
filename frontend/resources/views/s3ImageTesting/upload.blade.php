<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form id="uploadForm">
        <input type="file" id="image" name="image" required>
        <button type="submit">Upload</button>
    </form>
    <div id="success-message"></div>
    <div id="error-message"></div>

    <script>
        $(document).ready(function () {
            $('#uploadForm').on('submit', function (event) {
                event.preventDefault();

                let formData = new FormData();
                formData.append('image', $('#image')[0].files[0]);

                $.ajax({
                    url: 'http://127.0.0.1:8008/api/upload',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#success-message').text('Image uploaded successfully: ' + data.url);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('#error-message').text('Image upload failed: ' + errorThrown);
                    }
                });
            });
        });
    </script>
</body>
</html>
