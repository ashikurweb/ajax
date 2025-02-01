@extends('layouts.master')
@section('title', 'Students Created With Ajax')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow-sm border-light">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="card-title text-uppercase fw-bold text-dark">ALL STUDENTS</h2>
                        <button class="btn btn-primary btn-md rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#createModal">
                            <i data-feather="plus"></i> Add New Student
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>SN</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Reg</th>
                                    <th>Roll</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="showData">
                                <!-- Dynamic Data Rows will be added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Student Created -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLongScollableLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongScollableLabel">Add New Student</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createForm" class="createForm row">
                    <!-- Name -->
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control name" id="name" name="name" onkeyup="errorRemove(this)">
                        <span class="text-danger name_error"></span>
                    </div>

                    <!-- Email -->
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control email" id="email" name="email" onkeyup="errorRemove(this)">
                        <span class="text-danger email_error"></span>
                    </div>

                    <!-- Registration Number -->
                    <div class="mb-3 col-md-6">
                        <label for="reg" class="form-label">Registration Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control reg" id="reg" name="reg" onkeyup="errorRemove(this)">
                        <span class="text-danger reg_error"></span>
                    </div>

                    <!-- Roll Number -->
                    <div class="mb-3 col-md-6">
                        <label for="roll" class="form-label">Roll Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control roll" id="roll" name="roll" onkeyup="errorRemove(this)">
                        <span class="text-danger roll_error"></span>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3 col-md-6">
                        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control phone" id="phone" name="phone" onkeyup="errorRemove(this)">
                        <span class="text-danger phone_error"></span>
                    </div>

                    <!-- Address -->
                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control address" id="address" name="address" onkeyup="errorRemove(this)">
                        <span class="text-danger address_error"></span>
                    </div>

                    <!-- Gender -->
                    <div class="mb-3 col-md-6">
                        <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                        <select class="form-select gender" id="gender" onkeyup="errorRemove(this)" name="gender">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <span class="text-danger gender_error"></span>
                    </div>

                    <!-- Image -->
                    <div class="mb-3 col-md-6">
                        <label for="studentImage" class="form-label">Image</label>
                        <input type="file" class="form-control image" id="studentImage" name="image" onchange="loadImage(event, 'createImagePreview')" accept="image/*">
                        <span class="text-danger image_error"></span>

                        <div class="mb-3 col-md-6">
                            <img id="createImagePreview" class="mt-2 image" src="https://placehold.co/100x100" alt="Preview" style="width: 120px; height: 120px;">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_student">Created Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Student Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLongScollableLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongScollableLabel">Edit Student</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" class="editForm row">
                    <!-- Name -->
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control edit_name" id="name" name="name" onkeyup="errorRemove(this)">
                        <span class="text-danger name_error"></span>
                    </div>

                    <!-- Email -->
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control edit_email" id="email" name="email" onkeyup="errorRemove(this)">
                        <span class="text-danger email_error"></span>
                    </div>

                    <!-- Registration Number -->
                    <div class="mb-3 col-md-6">
                        <label for="reg" class="form-label">Registration Number</label>
                        <input type="text" class="form-control edit_reg" id="reg" name="reg" onkeyup="errorRemove(this)">
                        <span class="text-danger reg_error"></span>
                    </div>

                    <!-- Roll Number -->
                    <div class="mb-3 col-md-6">
                        <label for="roll" class="form-label">Roll Number</label>
                        <input type="text" class="form-control edit_roll" id="roll" name="roll" onkeyup="errorRemove(this)">
                        <span class="text-danger roll_error"></span>
                    </div>

                    <!-- Phone -->
                    <div class="mb-3 col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control edit_phone" id="phone" name="phone" onkeyup="errorRemove(this)">
                        <span class="text-danger phone_error"></span>
                    </div>

                    <!-- Address -->
                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control edit_address" id="address" name="address" onkeyup="errorRemove(this)">
                        <span class="text-danger address_error"></span>
                    </div>

                    <!-- Gender -->
                    <div class="mb-3 col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select edit-gender" id="gender" onkeyup="errorRemove(this)" name="gender">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <span class="text-danger gender_error"></span>
                    </div>

                    <!-- Image -->
                    <div class="mb-3 col-md-6">
                        <label for="studentImage" class="form-label">Image</label>
                        <input type="file" class="form-control error-image" id="studentImage" name="image" onchange="loadImage(event, 'editImagePreview')" accept="image/*">
                        <span class="text-danger image_error"></span>

                        <div class="mb-3 col-md-6">
                            <img id="editImagePreview" class="mt-2 image" src="https://placehold.co/100x100" alt="Preview" style="width: 120px; height: 120px;">
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary update_student">Update Student</button>
                    </div>
                    <input type="hidden" name="student_type" value="student" id="edit_id" class="student_type">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        function loadImage(event, previewId) {
            var output = document.getElementById(previewId);
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    output.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                output.src = "https://placehold.co/100x100";
            }
        }

        function errorRemove(e) {
            var tag = e.tagName.toLowerCase();
            if (e.value != "") {
                if (tag == 'select') {
                    $(e).closest('.mb-3').find('.text-danger').hide();
                } else {
                    $(e).siblings('.text-danger').hide();
                    $(e).css('border-color', 'blue');
                }
            }
        }

        $(document).ready(function () {

            function showError(name, message) {
                $(name).css('border-color', 'red');
                $(name).focus();
                $(`${name}_error`).show().text(message);
            }

            function studentView() {
                $.ajax({
                    url: "/students/view",
                    method: "GET",
                    success: function (res) {
                        const students  = res.data;
                        console.log(students);
                        $('.showData').empty();

                        if (students.length > 0) {
                            $.each(students, function (index, student) {
                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                                    <td>${index + 1}</td>
                                    <td><img src="${student.image ? '/students/' + student.image : 'https://placehold.co/100x100'}" alt="Image" style="width: 60px; height: 60px;"></td>
                                    <td>${student.name}</td>
                                    <td>${student.email}</td>
                                    <td>${student.reg}</td>
                                    <td>${student.roll}</td>
                                    <td>${student.phone}</td>
                                    <td>${student.gender}</td>
                                    <td>${student.address}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm student_edit" data-id="${student.id}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm student_delete" data-id="${student.id}"><i class="fa fa-trash"></i></a>
                                    </td>
                                `;
                                $('.showData').append(tr);
                            });
                        } else {
                            $('.showData').html(`
                                <tr>
                                    <td colspan='8'>
                                        <div class="text-center text-warning mb-2">Data Not Found</div>
                                        <div class="text-center">
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add New Student<i data-feather="plus"></i></button>
                                        </div>
                                    </td>
                            </tr>`);
                        }
                    }
                });
            }
            studentView();

            // Student Created
            $('.save_student').click(function (e) {
                e.preventDefault();

                let formData = new FormData($("#createForm")[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "/students/store",
                    method: "POST",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res.status == 200) {
                            console.log(res);
                            $('#createModal').modal('hide');
                            $('#createForm')[0].reset();
                            studentView();
                            toastr.success(res.message);
                        } else if (res.status == 400) {
                            if (res.errors.name) {
                                showError('.name', res.errors.name);
                            }
                            if (res.errors.email) {
                                showError('.email', res.errors.email);
                            }
                            if (res.errors.reg) {
                                showError('.reg', res.errors.reg);
                            }
                            if (res.errors.roll) {
                                showError('.roll', res.errors.roll);
                            }
                            if (res.errors.phone) {
                                showError('.phone', res.errors.phone);
                            }
                            if (res.errors.address) {
                                showError('.address', res.errors.address);
                            }
                            if (res.errors.gender) {
                                showError('.gender', res.errors.gender);
                            }
                            if (res.errors.image) {
                                showError('.image', res.errors.image);
                            }
                        } else {
                            toastr.error(res.message);
                        }
                    }
                });
            });

            // Student Edit

            $(document).on('click', '.student_edit', function (e) {
                e.preventDefault();
                let id = this.getAttribute('data-id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: `/students/edit/${id}`,
                    method: "GET",
                    success: function (res) {
                        if (res.status == 200) {
                            console.log(res);
                            $('.edit_name').val(res.student.name);
                            $('.edit_email').val(res.student.email);
                            $('.edit_reg').val(res.student.reg);
                            $('.edit_roll').val(res.student.roll);
                            $('.edit_phone').val(res.student.phone);
                            $('.edit_address').val(res.student.address);
                            if (res.student) {
                                if (res.student.gender) {
                                    $('.gender').val(res.student.gender);
                                }

                                if (res.student.image) {
                                    $('#editImagePreview').attr('src', '/students/' + res.student.image);
                                } else {
                                    $('#editImagePreview').attr('src', 'https://placehold.co/100x100');
                                }
                            }
                        } else if (res.status == 400) {
                            toastr.warning(res.message);
                        } else {
                            toastr.error(res.message);
                        }
                    }
                });
            });

            // Student Update

            $('.update_student').click(function (e) {
                e.preventDefault();
                let id = $(this).val();

                let formData = new FormData($("#editForm")[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: `/students/update/${id}`,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res.status == 200) {
                            $('#editModal').modal('hide');
                            $('#editForm')[0].reset();
                            studentView();
                            toastr.success(res.message);
                        } else if (res.status == 400) {
                            if (res.errors.name) {
                                showError('.edit_name', res.errors.name);
                            }
                            if (res.errors.email) {
                                showError('.edit_email', res.errors.email);
                            }
                            if (res.errors.reg) {
                                showError('.edit_reg', res.errors.reg);
                            }
                            if (res.errors.roll) {
                                showError('.edit_roll', res.errors.roll);
                            }
                            if (res.errors.phone) {
                                showError('.edit_phone', res.errors.phone);
                            }
                            if (res.errors.address) {
                                showError('.edit_address', res.errors.address);
                            }
                            if (res.errors.gender) {
                                showError('.gender', res.errors.gender);
                            }
                            if (res.errors.image) {
                                showError('.image', res.errors.image);
                            }
                        } else {
                            toastr.error(res.message);
                        }
                    }
                });
            });


            // Student Delete
            $(document).on('click', '.student_delete', function (e) {
                e.preventDefault();

                const id = $(this).data('id');
                const deleteUrl = `/students/delete/${id}`;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            method: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (res) {
                                if (res.status === 200) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Student has been deleted.',
                                        icon: 'success'
                                    });
                                    studentView();
                                } else {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "warning",
                                        title: 'Delete Unsuccessful!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            }
                        });
                    }
                });
            });

        });
    </script>
@endpush
