<!DOCTYPE html>
<html>
<head>
    <title>Uploaded Images</title>
</head>
<body>
    <h1>Uploaded Images</h1>
    <div id="images"></div>
    <script>
        async function fetchImages() {
            try {
                let response = await fetch('http://127.0.0.1:8008/api/images');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                let images = await response.json();
                let imagesContainer = document.getElementById('images');
                imagesContainer.innerHTML = '';
                images.forEach(image => {
                    let imgElement = document.createElement('img');
                    imgElement.src = image.url;
                    imgElement.style.maxWidth = '100%';
                    imgElement.style.height = 'auto';
                    imagesContainer.appendChild(imgElement);
                });
            } catch (error) {
                console.error('Error fetching images:', error);
            }
        }

        window.onload = fetchImages;
    </script>
</body>
</html>
