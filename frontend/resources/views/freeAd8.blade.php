
@extends('layout')
@section('header')
@parent
@endsection

@section('content')
<section class="upload-images" id="upload-images">
    <div class="container-lg mt-3">
        <div class="row justify-content-center align-item-center">
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class="container-lg text-center">
                        <h1 class="heading-type-1">Add Photos at least 3</h1>
                        <p class="heading-type-2">Upload pictures of your device.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-item-center mb-1">
                <div class="col-sm-4 col-md-4 col-lg-5 col-6" style="width: 300px; height: 300px;">
                    <img src="{{ URL('images/Typingbro.svg') }}" alt="verified" class="img-fluid" >
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- Image Uploader Square -->
                @for ($i = 1; $i <= 5; $i++)
                <div style="width: 180px; height: 180px; border: 2px solid #ccc; border-radius: 8px; position: relative; overflow: hidden; margin: 5px; display: inline-block;">
                    <input type="file" id="imageInput{{$i}}" name="image{{$i}}" style="width: 100%; height: 100%; opacity: 0; position: absolute; top: 0; left: 0; cursor: pointer;">
                    <img id="imgPreview{{$i}}" src="" alt="preview" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                    <label for="imageInput{{$i}}" id="label{{$i}}" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; cursor: pointer; text-align: center; line-height: 180px; background-color: #f0f0f0; border-radius: 6px;">+</label>
                </div>
                @endfor
            </div>
        </div>
    </div>
    <div class="d-flex col-lg-6 d-none d-sm-flex container-fluid justify-content-between pt-4 pb-4">
        <button class="btn btn-lg px-5" onclick="window.location.href='/freeAd7'">Back</button>
        <button id="submit" class="btn btn-lg px-5" type="submit">Next</button>
    </div>
    <div class="d-flex flex-column col-lg-6 d-sm-none container-fluid justify-content-between pt-4 pb-4">
        <button class="btn btn-lg mb-3 px-5" onclick="window.location.href='/freeAd7'">Back</button>
        <button id="submit" class="btn btn-lg px-5" type="submit">Next</button>
    </div>
</section>

<script>
    $('#adPostBtn').prop('disabled', true);
    $('#adPostBtn').prop('disabled', true);
    // Function to handle file input change event and store image in local storage
    function handleFileInputChange(event, inputNumber) {
        const file = event.target.files[0];
        const imgPreview = document.querySelector("#imgPreview" + inputNumber);
        const label = document.querySelector("#label" + inputNumber);

        // Validate that the file is an image with .png or .jpg extension
        if (!file || !['image/png', 'image/jpeg'].includes(file.type)) {
            // swal("Oops!", "Please select a .png or .jpg image file.", "error");
            Swal.fire({
                        icon: "question",
                        title: "OOPs!",
                        text: "Please select a .png or .jpg image file.",
                });

            event.target.value = ''; // Clear the file input
            if (imgPreview) {
                imgPreview.src = ''; // Clear the image preview
                imgPreview.style.display = 'none'; // Hide the image preview
            }
            if (label) {
                label.style.display = 'block'; // Show the label
            }
            return;
        }

        // Store the image file in local storage
        const reader = new FileReader();
        reader.onload = function(event) {
            const imageData = event.target.result;
            if (imgPreview) {
                imgPreview.src = imageData; // Set the image preview
                imgPreview.style.display = 'block'; // Show the image preview
            }
            if (label) {
                label.style.display = 'none'; // Hide the label
            }
            localStorage.setItem("image" + inputNumber, imageData);
        };
        reader.readAsDataURL(file);
    }

    // Function to load images from local storage on page load
    function loadImages() {
        for (let i = 1; i <= 5; i++) {
            const imageData = localStorage.getItem("image" + i);
            const imgPreview = document.querySelector("#imgPreview" + i);
            const label = document.querySelector("#label" + i);

            if (imageData && imgPreview) {
                imgPreview.src = imageData;
                imgPreview.style.display = 'block';
                if (label) {
                    label.style.display = 'none';
                }
            }
        }
    }

    // Attach event listeners to each input field
    document.addEventListener("DOMContentLoaded", function() {
        loadImages();
        for (let i = 1; i <= 5; i++) {
            const inputNumber = i;
            const imageInput = document.querySelector("#imageInput" + i);
            if (imageInput) {
                imageInput.addEventListener("change", function(event) {
                    handleFileInputChange(event, inputNumber);
                });
            }
        }
        // Add event listeners for the Next buttons
        document.getElementById('submit').addEventListener('click', validateImages);
    });

     // Function to validate that exactly 5 images are uploaded
     function validateImages() {
        let valid = true;
        for (let i = 1; i <= 3; i++) {
            if (!localStorage.getItem("image" + i)) {
                valid = false;
                break;
            }
        }
        if (valid) {
            window.location.href = '/freeAd10';
        } else {
            Swal.fire({
                        icon: "question",
                        title: "OOPs!",
                        text: "Please select at least 3 images",
                });
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

@endsection
