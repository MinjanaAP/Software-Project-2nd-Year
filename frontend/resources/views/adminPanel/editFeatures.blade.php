@extends('layouts.adminLayout')

@section('content')
<h1 class="m-2 text-center fw-nor">Edit Features</h1>

<div class="d-flex justify-content-center align-items-center mt-3">
    <div class="card col-md-8">
        <h5 class="card-header">Edit/Delete Features in Category</h5>
        <div class="card-body">
            <form id="addBrandsForm" enctype="multipart/form-data">
                <div class="form-group">
                

                </div>
                <div class="form-group mt-3">
                    <select id="brandFeatures" name="brandFeatures" class="form-control">
                        <option value="">Existing Features</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button id="editFeaturesButton" type="button" class="btn btn-warning me-2">Edit</button>
                    <button id="deleteFeaturesButton" type="button" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <!-- modal... -->
    <div class="modal fade" id="editFeaturesModal" tabindex="-1" aria-labelledby="editFeaturesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFeaturesModalLabel">Edit Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editFeaturesForm" enctype="multipart/form-data">
                        <input id="editFeaturesName" name="editFeaturesName" class="form-control" placeholder="Edit New Feature Name Here">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="saveFeaturesButton" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-3">
    <div class="card col-md-8">
        <h5 class="card-header">Edit/Delete a Brand</h5>
        <div class="card-body">
            <form id="addFeaturesForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    


                    <input type="hidden" name="feature_table" id="feature_table">
                    <select id="brand1" name="brand1" class="form-control mt-3">
                        <option value="">Existing Brands</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button id="editBrandsButton" type="button" class="btn btn-warning me-2">Edit</button>
                    <button id="deleteBrandsButton" type="button" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <!-- modal.. -->
    <div class="modal fade" id="editBrandsModal" tabindex="-1" aria-labelledby="editBrandsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBrandsModalLabel">Edit Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBrandsForm" enctype="multipart/form-data">
                        <input id="editBrandsName" name="editBrandsName" class="form-control" placeholder="Edit New Brand Name Here">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="saveBrandsButton" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-3">
    <div class="card col-md-8">
        <h5 class="card-header">Edit/Delete a Version</h5>
        <div class="card-body">
            <form id="addVersionsForm" enctype="multipart/form-data">
                <div class="form-group">
                    


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
                
                <div class="d-flex justify-content-end mt-3">
                    <button id="editVersionsButton" type="button" class="btn btn-warning me-2">Edit</button>
                    <button id="deleteVersionsButton" type="button" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <!-- modal.. -->
    <div class="modal fade" id="editVersionsModal" tabindex="-1" aria-labelledby="editVersionsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVersionsModalLabel">Edit Versions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editVersionsForm" enctype="multipart/form-data">
                        <input id="editVersionsName" name="editVersionsName" class="form-control" placeholder="Edit New Versions Name Here">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="saveVersionsButton" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#editFeaturesButton').on('click', function() {
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
        });
    </script>
@endsection