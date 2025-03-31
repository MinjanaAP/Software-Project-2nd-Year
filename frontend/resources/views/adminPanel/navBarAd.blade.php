@extends('layouts.adminLayout')

@section('content')

    <div class="container-lg">
        

        <div class="container mt-4">
            <h2 class="navBarHeading1 text mb-3">Navigation Bar Ad</h2>
            <div class="form-container">
            <form id="adForm">
                <!-- <div class="form-group">
                <label for="adTitle">Title:</label>
                <input type="text" id="adTitle" class="form-control" placeholder="Enter title" required>
                </div> -->
                <div class="form-group">
                <label for="adDescription">Description:</label>
                <textarea id="adDescription" class="form-control" placeholder="Enter description" ></textarea>
                </div>
                <div class="form-group">
                <button type="submit" class="btn">Submit</button>
                </div>
            </form>
            </div>

            <h2 class="navBarHeading2 text mb-3 mt-3">Previous Ad Description</h2>
            <div class="previous-description" id="previousDescriptionArea">
                <textarea id="previousDescription" readonly> </textarea>
            </div>
        </div>


    </div>
    
    












<script>

    var baseUrl = "{{ env('APP_BASE_URL') }}";



    $(document).ready(function() {

      // AJAX GET request
      $.ajax({
        url: baseUrl + '/api/getNavBarAds',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          console.log(response);
          if (response.status === 200) {
            $('#previousDescription').empty();
            $('#previousDescription').append(response.data.description);
            localStorage.setItem('navBarAd', response.data.description);
            console.log('Nav bar ad retrieval successful:', response.data);
          } else {
            console.error('Nav bar ad retrieval failed:', response.message);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('AJAX Error:', textStatus, errorThrown);
        }
      });

      
      // AJAX POST request on form submit
      $('#adForm').on('submit', function(e) {
        e.preventDefault();
        var adDescription = $('#adDescription').val();
        if(!adDescription){
          const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: "error",
                title: "Please Enter a Description"
                });
        } else{
          $.ajax({
          url: baseUrl + '/api/nav_bar_ads',
          method: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({ description: adDescription }),
          success: function(response) {
            if(response.status == 200){
                Swal.fire({
                position: "top",
                icon: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 1500
                });
            }
            else{
                const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: "error",
                title: response.message
                });
            }
            // console.log('Ad description posted successfully:', response);
            $('#previousDescription').val(adDescription);
          },
          error: function(xhr,error) {
            // console.log(xhr.responseText + error);
            const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "error",
            title: xhr.responseText
            });
          }
        });
        }

      });
    });

</script>
@endsection