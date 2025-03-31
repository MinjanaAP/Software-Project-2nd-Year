@extends('layouts.adminLayout')

@section('content')
<h1 class="m-2 text-center fw-nor">Add Features</h1>
    <div class="d-flex justify-content-center align-items-center mt-3">
        <div class="card col-md-8">
        <h5 class="card-header">Add a Location</h5>
            <div class="card-body">
                <form id="addLocationForm">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Select District
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <select name="district" id="district" class="form-control">
                                    <option value="">Select District</option>
                                    @foreach ($data as $district)
                                        <option value="{{ $district }}">{{ $district }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Existing Towns
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <select id="town" name="town" class="form-control" disabled>
                                    <option value="">Existing Towns</option>
                                </select>
                                <div id="spinner-town" class="spinner-border text-primary mt-2" role="status" style="display: none;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Add New Town
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <input id="addTown" name="addTown" class="form-control" placeholder="Add Town">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-3">
    <div class="card col-md-8">
        <h5 class="card-header">Add a New Category</h5>
        <div class="card-body">
            <form id="addSubcategoryForm" enctype="multipart/form-data">
                <div class="form-group mt-3">
                    <select name="category_list" id="category_list" class="form-control">
                        <option value="">Existing Categories</option>
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory['Name'] }}">{{ $subCategory['Name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <input id="new_category" name="new_category" class="form-control" placeholder="Enter New Category Here">
                </div>

                <div class="form-group mt-3">
                    <input id="columnsOfFeatureTable" name="columnsOfFeatureTable" class="form-control" placeholder="Columns of Feature Table">
                </div>

                <div class="form-group mt-3">
                    <label for="subcategoryImage">Sub Category Image</label>
                    <input type="file" id="subcategoryImage" name="subcategoryImage" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <label for="subcategoryIcon">Sub Category Icon</label>
                    <input type="file" id="subcategoryIcon" name="subcategoryIcon" class="form-control">
                </div>
                    
                <div class="d-flex justify-content-end mt-3">
                    <button id="addSubcategoryButton" type="button" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <!-- New "Edit/Delete a Sub Category" Form -->
    <div class="d-flex justify-content-center align-items-center mt-3">
        <div class="card col-md-8">
            <h5 class="card-header">Edit or Delete a Category</h5>
            <div class="card-body">
                <form id="editDeleteSubcategoryForm">
                    <select name="editDeleteSubcategory" id="editDeleteSubcategory" class="form-control">
                        <option value="">Select a Category</option>
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory['Name'] }}">{{ $subCategory['Name'] }}</option>
                        @endforeach
                    </select>
                    <div class="d-flex justify-content-end mt-3">
                        <button id="editSubcategoryButton" type="button" class="btn btn-warning me-2">Edit</button>
                        <button id="deleteSubcategoryButton" type="button" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Sub Category Modal -->
    <div class="modal fade" id="editSubcategoryModal" tabindex="-1" aria-labelledby="editSubcategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubcategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editSubcategoryForm" enctype="multipart/form-data">
                        <input id="editSubcategoryName" name="editSubcategoryName" class="form-control" placeholder="Edit category name">
                        <input type="file" id="editSubcategoryImage" name="editSubcategoryImage" class="form-control mt-3">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="saveEditSubcategoryButton" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-3">
    <div class="card col-md-8">
        <h5 class="card-header">Add Features to a Category</h5>
        <div class="card-body">
            <form id="addBrandsForm" enctype="multipart/form-data">
                <div class="form-group">
                    <select name="sub_categoryFeature" id="sub_categoryFeature" class="form-control">
                        <option value="">Select a Category</option>
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory['Name'] }}">{{ $subCategory['Name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <select id="brandFeatures" name="brandFeatures" class="form-control">
                        <option value="">Existing Features</option>
                    </select>
                    <div class="form-group mt-3">
                        <input type="text" name="new_feature" id="new_feature" class="form-control" placeholder="Enter New Feature Here">
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button id="addFeaturesButton" type="button" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    
    <div class="d-flex justify-content-center align-items-center mt-3">
    <div class="card col-md-8">
        <h5 class="card-header">Add a New Brand</h5>
        <div class="card-body">
            <form id="addFeaturesForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <select name="sub_category" id="sub_category" class="form-control">
                        <option value="">Select a Category</option>
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory['Name'] }}">{{ $subCategory['Name'] }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="feature_table" id="feature_table">
                    <select id="brand1" name="brand1" class="form-control mt-3">
                        <option value="">Existing Brands</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <input type="text" name="new_brnad" id="new_brnad" class="form-control" placeholder="Enter New Brand Here">
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button id="addBrandsButton" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-3">
    <div class="card col-md-8">
        <h5 class="card-header">Add a New Version</h5>
        <div class="card-body">
            <form id="addVersionsForm" enctype="multipart/form-data">
                <div class="form-group">
                    <select name="sub_categoryVersion" id="sub_categoryVersion" class="form-control">
                        <option value="">Select a Category</option>
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory['Name'] }}">{{ $subCategory['Name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <select id="brandsVersion" name="brandsVersion" class="form-control">
                        <option value="">Select a Brand Name</option>
                    </select>
                </div>
                <div class="form-gruop mt-3">
                    <select id="existsVersions" name="existsVersions" class="form-control">
                        <option value="">Existing Versions</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <input type="text" name="newVersion" id="newVersion" class="form-control" placeholder="Enter New Version Here">
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button id="addVersionsButton" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var baseUrl = "{{ env('APP_BASE_URL') }}";
            const existingSubCategories = @json($subCategories);

            const linkColor = document.querySelectorAll('.nav_link');
            linkColor.forEach(l => l.classList.remove('active'));
            const userButton = document.querySelector('.nav_link:nth-child(5)');
            userButton.classList.add('active');

            $('#district').on('change', function() {
                var selectedDistrict = $(this).val();
                $('#spinner-town').show();
                $.ajax({
                    url: baseUrl + '/api/town/getSpecificTowns', 
                    type: 'POST',
                    data: { district: selectedDistrict },
                    success: function(response) {
                        $('#town').prop('disabled', false);
                        var townsDropdown = $('#town');
                        $('#spinner-town').hide();

                        townsDropdown.empty();
                        townsDropdown.append($('<option>').text('Select Town').val(''));
                        $.each(response.data, function(index, town) {
                            townsDropdown.append($('<option>').text(town).val(town));
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });

            $('#addLocationForm').on('submit', function(e) {
                e.preventDefault();
                var formData = {
                    district: $('#district').val(),
                    town: $('#addTown').val()
                };

                $.ajax({
                    url: 'http://127.0.0.1:8008/api/town/add', // Route to your backend endpoint
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Location added successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to add location.',
                            text: 'Please try again.',
                        });
                    }
                });
            });

            //add a category..
            
            $('#subcategory').on('mouseenter', function() {
                $('#subcategoryList').show();
            }).on('mouseleave', function() {
                setTimeout(() => {
                    if (!$('#subcategoryList').is(':hover')) {
                        $('#subcategoryList').hide();
                    }
                }, 200);
            });

            $('#subcategoryList').on('mouseenter', function() {
                $(this).show();
            }).on('mouseleave', function() {
                $(this).hide();
            });

            $('#addSubcategoryButton').on('click', function() {
                const subcategory = document.getElementById('new_category').value;
                const columnsOfFeatureTable = $('#columnsOfFeatureTable').val();
                const subcategoryImage = $('#subcategoryImage').prop('files')[0];
                const subcategoryIcon = $('#subcategoryIcon').prop('files')[0];

                if (subcategory === '' || columnsOfFeatureTable === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Subcategory, Feature Table Name, and Columns of Feature Table cannot be empty.',
                    });
                    return;
                }

                if (existingSubCategories.includes(subcategory)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'This subcategory already exists.',
                    });
                    return;
                }

                

                let formData = new FormData();
                formData.append('name', subcategory);
                // formData.append('featureTableName', featureTableName);
                formData.append('features', columnsOfFeatureTable);

                if (subcategoryImage) {
                    formData.append('image', subcategoryImage);
                }

                if (subcategoryIcon) {
                    formData.append('icon', subcategoryIcon);
                }

                $.ajax({
                    url: baseUrl + '/api/admin/add-sub-category', // API endpoint for adding subcategories
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                $('#subcategory').val('');
                                $('#featureTableName').val('');
                                $('#columnsOfFeatureTable').val('');
                                $('#subcategoryImage').val('');
                                $('#subcategoryIcon').val('');
                                existingSubCategories.push(subcategory);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to add subcategory.',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to add subcategory.',
                            text: xhr.responseText,
                        });
                    }
                });
            });

            //edit..
            $('#editSubcategoryButton').on('click', function() {
                const subcategoryToEdit = $('#editDeleteSubcategory').val();
                if (subcategoryToEdit === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please select a subcategory to edit.',
                    });
                    return;
                }

                $('#editSubcategoryName').val(subcategoryToEdit);
                $('#editSubcategoryModal').modal('show');
            });

            $('#saveEditSubcategoryButton').on('click', function() {
                const subcategoryToEdit = $('#editDeleteSubcategory').val();
                const newSubcategoryName = $('#editSubcategoryName').val().trim();
                const newSubcategoryImage = $('#editSubcategoryImage').prop('files')[0];

                if (newSubcategoryName === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please enter a new name for the subcategory.',
                    });
                    return;
                }

                const formData = new FormData();
                formData.append('Name', newSubcategoryName);
                if (newSubcategoryImage) {
                    formData.append('image', newSubcategoryImage);
                }

                $.ajax({
                    url: baseUrl + '/api/sub_categories/edit/' + subcategoryToEdit, // API endpoint for editing subcategories
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Subcategory updated successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                $('#editSubcategoryModal').modal('hide');
                                const option = $('#editDeleteSubcategory option[value="' + subcategoryToEdit + '"]');
                                option.text(newSubcategoryName);
                                $('#subcategoryList li:contains("' + subcategoryToEdit + '")').text(newSubcategoryName);
                                const index = existingSubCategories.indexOf(subcategoryToEdit);
                                if (index !== -1) {
                                    existingSubCategories[index] = newSubcategoryName;
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseText,
                        });
                    }
                });
            });

            //delete..
            $('#deleteSubcategoryButton').on('click', function() {
                const subcategoryToDelete = $('#editDeleteSubcategory').val();
                if (subcategoryToDelete === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please select a subcategory to delete.',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You won't be able to revert this!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: baseUrl + '/api/sub_categories/' + subcategoryToDelete, // API endpoint for deleting subcategories
                            type: 'DELETE',
                            success: function(response) {
                                if (response.status === 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Subcategory deleted successfully!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        $('#editDeleteSubcategory option[value="' + subcategoryToDelete + '"]').remove();
                                        $('#subcategoryList li:contains("' + subcategoryToDelete + '")').remove();
                                        const index = existingSubCategories.indexOf(subcategoryToDelete);
                                        if (index !== -1) {
                                            existingSubCategories.splice(index, 1);
                                        }
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: xhr.responseText,
                                });
                            }
                        });
                    }
                });
            });

            //Add a New Brand Name..
            $('#addBrandsButton').on('click', function() {
                const subcategory = $('#sub_category').val();
                const brandName = $('#new_brnad').val();
                // const brandName = document.getElementById('new_brand').val();
                console.log(subcategory + brandName);

                if (subcategory === '' || brandName === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please select a subcategory and enter a brand name.',
                    });
                    return;
                }

                $.ajax({
                    url:baseUrl+ '/api/newBrandAdding', 
                    type: 'POST',
                    data: {
                        subcategory: subcategory,
                        brandName: brandName
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Brand added successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                $('#subcategorySelectForBrands').val('');
                                $('#brandName').val('');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to add brand.',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to add brand.',
                            text: xhr.responseText,
                        });
                    }
                });
            });

            // AJAX call to get existing brands
            $('#sub_category').change(function() {
                var subcategory = $(this).val();
                console.log(subcategory);
                if(subcategory) {
                    $.ajax({
                        url: baseUrl+'/api/getExistingBrands',
                        type: 'GET',
                        data: { Name: subcategory },
                        success: function(response) {
                            $('#brand1').empty();
                            $('#brand1').append('<option value="">Existing Brand</option>');
                            if(response.status === 200) {
                                console.log(response);
                                $.each(response.data, function(index, brand) {
                                    $('#brand1').append('<option value="'+ brand.brandName +'">'+ brand.brandName +'</option>');
                                });
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('An error occurred while fetching the brands.');
                        }
                    });
                } else {
                    $('#brand').empty();
                    $('#brand').append('<option value="">Select a Brand</option>');
                }
            });

            //Ajax call for get exisiting feature
            $('#sub_categoryFeature').change(function() {
                var subcategory = document.getElementById('sub_categoryFeature').value;
                console.log(subcategory);
                if(subcategory) {
                    $.ajax({
                        url: baseUrl+'/api/getExistingFeature',
                        type: 'POST',
                        data: { subcategory: subcategory },
                        success: function(response) {
                            $('#brandFeatures').empty();
                            $('#brandFeatures').append('<option value="">Existing Features</option>');
                            if(response.status === 200) {
                                console.log(response);
                                $.each(response.data, function(index, brand) {
                                    $('#brandFeatures').append('<option value="'+ brand +'">'+ brand +'</option>');
                                });
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('An error occurred while fetching the Exsisting Features.');
                            $('#brandFeatures').empty();
                            $('#brandFeatures').append('<option value="">No Exsisting Features</option>');
                        }
                    });
                } else {
                    $('#brandFeatures').empty();
                    $('#brandFeatures').append('<option value="">Select a Brand</option>');
                }
            });

            //Add a Feature
            $('#addFeaturesButton').on('click', function() {
                const subcategory = $('#sub_categoryFeature').val();
                const feature = $('#new_feature').val();
                console.log(subcategory + feature);

                if (subcategory === '' || feature === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please select a subcategory and enter new feature.',
                    });
                    return;
                }

                $.ajax({
                    url:baseUrl+ '/api/addNewFeature', 
                    type: 'POST',
                    data: {
                        subcategory: subcategory,
                        feature: feature
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Feature added successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                $('#sub_categoryFeature').val('');
                                $('#new_feature').val('');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to add Feature.',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to add Feature.',
                            text: xhr.responseText,
                        });
                    }
                });
            });

            //Ajax call for get exisiting brands versiions
            $('#sub_categoryVersion').change(function() {
                var subcategory = $(this).val();
                console.log(subcategory);
                if(subcategory) {
                    $.ajax({
                        url: baseUrl+'/api/getExistingBrands',
                        type: 'GET',
                        data: { Name: subcategory },
                        success: function(response) {
                            $('#brandsVersion').empty();
                            $('#brandsVersion').append('<option value="">Existing Brand</option>');
                            if(response.status === 200) {
                                console.log(response);
                                $.each(response.data, function(index, brand) {
                                    $('#brandsVersion').append('<option value="'+ brand.brandName +'">'+ brand.brandName +'</option>');
                                });
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('An error occurred while fetching the brands.');
                        }
                    });
                } else {
                    $('#brandsVersion').empty();
                    $('#brandsVersion').append('<option value="">Select a Brand</option>');
                }
            });

            //fetch exists version
            $('#brandsVersion').change(function() {
                var subcategory =document.getElementById('sub_categoryVersion').value;
                var brandName = $('#brandsVersion').val();
                console.log(subcategory +brandName );
                if(subcategory) {
                    $.ajax({
                        url: baseUrl+'/api/getExistingVersions',
                        type: 'POST',
                        data: { subcategory: subcategory ,brandName:brandName },
                        success: function(response) {
                            $('#existsVersions').empty();
                            $('#existsVersions').append('<option value="">Existing Versions</option>');
                            if(response.status === 200) {
                                console.log(response);
                                $.each(response.data, function(index,data) {
                                    $('#existsVersions').append('<option value="'+ data +'">'+ data+'</option>');
                                });
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('An error occurred while fetching the brands.');
                        }
                    });
                } else {
                    $('#existsVersions').empty();
                    $('#existsVersions').append('<option value="">Existing Versions</option>');
                }
            });

            //add new version
            $('#addVersionsButton').on('click', function() {
                const subcategory = document.getElementById('sub_categoryVersion').value;
                const brandName = document.getElementById('brandsVersion').value;
                const version = document.getElementById('newVersion').value;
                // console.log(subcategory + brandName);

                if (subcategory === '' || brandName === '' || version === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please select a subcategory, Brand and enter new version of selected Brand.',
                    });
                    return;
                }

                $.ajax({
                    url:baseUrl+ '/api/addNewVersion', 
                    type: 'POST',
                    data: {
                        subcategory: subcategory,
                        brandName: brandName,
                        version : version
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Version added successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                $('#subcategorySelectForBrands').val('');
                                $('#brandName').val('');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to add brand.',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to add brand.',
                            text: xhr.responseText,
                        });
                    }
                });
            });
        });
    </script>
@endsection
