@extends('layouts.app')

@section('content')
<style>
    /* Default red background when OFF */
    .form-check-input.red {
        background-color: red !important;
        border-color: red !important;
    }

    /* Green background when ON */
    .form-check-input.green {
        background-color: green !important;
        border-color: green !important;
    }
</style>
<div class="container-fluid">
    <div class="row p-2">
        <div class="col-12">
            <div class="card ">

                <div class="card-body position-relative">
                    <!-- <h6>User Management</h6>
                      -->
                    <h6 class="d-flex justify-content-between align-items-center">
                        User Management
                        <span id="enableMessage" class="text-success"></span>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            + Add User
                        </button>
                    </h6>
                    <div class="card-body">
                        <table id="userTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Name</th>
                                    <th style="text-align:center;">Email</th>
                                    <th style="text-align:center;">Mobile</th>
                                    <!-- <th style="text-align:center;">Role</th> -->
                                    <th style="text-align:center;">Action</th>
                                    <th style="text-align:center;">Enable/Disable</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getUsers as $key=>$val)
                                <tr>
                                    <td>{{$val['first_name']}} {{isset($val['last_name']) ? $val['last_name']:''}}</td>
                                    <td>{{isset($val['email']) ? $val['email']:''}}</td>
                                    <td>{{isset($val['mobile']) ? $val['mobile']:''}}</td>
                                    <!-- <td>{{$val['roles']}}</td> -->
                                    <td style="text-align:center;">
                                        <?php
                                        $uid = $val['id'];
                                        $isEnabled = $val['enabled'];
                                        ?>
                                        <button onclick="updateUser('{{$uid}}')" class="btn btn-sm btn-success ">
                                            Update
                                        </button>
                                        <button onclick="removeUser('{{$uid}}')" class="btn btn-sm btn-danger ">
                                            Delete
                                        </button>
                                        <button onclick="resetPassword('{{$uid}}')" class="btn btn-sm btn-primary ">
                                            Reset Password
                                        </button>
                                    </td>
                                    <td style="text-align:center;">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input 
                                                        @if($isEnabled==1) green @else red @endif"
                                                type="checkbox"
                                                role="switch"
                                                id="is_enabled"
                                                onchange="switchEnable(this, '{{ $uid }}')"
                                                data-user-id="{{ $uid }}"
                                                @if($isEnabled==1) checked @endif>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="register-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="password" name="password" value="User@123">
                        <div class="mb-3 col-6">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="new_first_name" name="first_name" required>
                        </div>

                        <div class="mb-3 col-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="mobile" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="mobile" name="mobile">
                        </div>
                        <!-- <div class="mb-3 col-6">
                            <label for="address1" class="form-label">Adress1</label>
                            <input type="text" class="form-control" id="address1" name="address1">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="address2" class="form-label">Adress2</label>
                            <input type="text" class="form-control" id="address2" name="address2">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="roles" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select" id="roles" name="roles" required>
                                <option value="">Select Role</option>
                                <option value="consumers">Consumers</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="register-button" class="btn btn-success">
                        <span id="loading-spinner" class="spinner-border spinner-border-sm d-none" role="status" style="margin-right: 10px;" aria-hidden="true"></span>
                        Save User
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Add User Modal end-->
<!-- update User Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="updateUserForm" method="POST" action="{{ route('update.user') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="update_user_id" name="user_id" value="">
                        <div class="mb-3 col-6">
                            <label for="update_first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="update_first_name" name="first_name" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="update_last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="update_last_name" name="last_name">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="update_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="update_email" name="email" readonly>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="update_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="update_phone" name="phone">
                        </div>
                        <!-- <div class="mb-3 col-6">
                            <label for="update_address1" class="form-label">Adress1</label>
                            <input type="text" class="form-control" id="update_address1" name="address1">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="update_address2" class="form-label">Adress2</label>
                            <input type="text" class="form-control" id="update_address2" name="address2">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="update_city" class="form-label">City</label>
                            <input type="text" class="form-control" id="update_city" name="city">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="update_state" class="form-label">State</label>
                            <input type="text" class="form-control" id="update_state" name="state">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="update_zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="update_zip" name="zip">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="update_country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="update_country" name="country">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="update_roles" class="form-label">Role</label>
                            <select class="form-select" id="update_roles" name="roles" required>
                                <option value="">Select Role</option>
                                <option value="consumers">Consumers</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save User</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- update User Modal end-->
<!-- reset password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="resetPasswordForm" method="POST" action="{{ route('update.user') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="reset_user_id" name="user_id" value="">
                        <div class="row mb-1 text-center mx-auto" style="width:70%">
                            <div class="col-12">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control password-input" id="reset_password" name="password" placeholder="Password" required>
                                <div class="text-danger error-message" id="password-error"></div>
                            </div>
                        </div>
                        <div class="row mb-1 text-center mx-auto" style="width:70%">
                            <div class="col-12">
                                <label for="confirm_password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control password-input" id="reset_confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                                <div class="text-danger error-message" id="confirm-password-error"></div>
                            </div>
                            <!-- <div class="col-2 d-flex align-items-end">
                                <i class="fa fa-eye toggle-password" style="cursor:pointer; font-size: 20px;"></i>
                            </div> -->
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Reset Password</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- reset password Modal end-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true, // Optional: enable column sorting
            "info": true
        });
    });
    $('#register-form').on('submit', function(e) {
        e.preventDefault();

        let formData = {
            firstname: $('#new_first_name').val(),
            lastname: $('#last_name').val(),
            email: $('#email').val(),
            mobile: $('#mobile').val(),
            address_line_1: $('#address1').val(),
            address_line_2: $('#address2').val(),
            city: $('#city').val(),
            state: $('#state').val(),
            zip: $('#zip').val(),
            country: $('#country').val(),
            password: $('#password').val(),
            _token: $('input[name="_token"]').val()
        };

        $('#register-button').prop('disabled', true);
        $('#loading-spinner').removeClass('d-none');

        $.ajax({
            type: 'POST',
            url: '{{ route("create-user") }}',
            data: formData,
            success: function(response) {

                alert('User Added Successfully!');
                window.location.reload();

            },
            error: function(xhr) {
                alert('Please check the form for errors.');

            }
        });

    });
    $('#resetPasswordForm').on('submit', function(e) {
        e.preventDefault();
        $('#password-error').text('');
        $('#confirm-password-error').text('');
        var password = $('#reset_password').val();
        var confirmPassword = $('#reset_confirm_password').val();
        // alert(password.length);
        // alert(password + ' ' + confirmPassword);
        if (password.length < 8) {
            $('#password-error').text('Password must be at least 8 characters.');
            return;
            // valid = false;
        }

        if (password !== confirmPassword) {
            $('#confirm-password-error').text('Passwords does not match.');
            // valid = false;
            return;
        }

        // if (!valid) return;
        let formData = {

            user_id: $('#reset_user_id').val(),
            password: $('#reset_password').val(),
            _token: $('input[name="_token"]').val()
        };

        $.ajax({
            type: 'POST',
            url: '{{ route("reset-password") }}',
            data: formData,
            success: function(response) {

                alert('Password Changed Successfully!');
                window.location.reload();

            },
            error: function(xhr) {
                alert('Please check the form for errors.');

            }
        });

    });

    function resetPassword(id) {
        $('#reset_user_id').val(id);
        $('#resetPasswordModal').modal('show');
    }

    function removeUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to remove this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, remove user',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("remove-user") }}',
                    data: {
                        uid: id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire(
                            'Removed!',
                            'User has been removed successfully.',
                            'success'
                        ).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Please check the form for errors.',
                            'error'
                        );
                    }
                });
            }
            // Else: user clicked cancel, so do nothing
        });
    }



    function updateUser(id) {
        $.ajax({
            url: '/get-update-user', // Laravel route
            method: 'GET',
            data: {
                uid: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: res => {
                $('#update_first_name').val(res.first_name);
                $('#update_last_name').val(res.last_name);
                $('#update_email').val(res.email);
                $('#update_phone').val(res.mobile);
                // $('#update_address1').val(res.address1);
                // $('#update_address2').val(res.address2);
                // $('#update_city').val(res.city);
                // $('#update_state').val(res.state);
                // $('#update_zip').val(res.zip);
                // $('#update_country').val(res.country);
                // $('#update_roles').val(res.roles);
                $('#update_user_id').val(res.id);
                $('#updateUserModal').modal('show');
            },
            error: err => {
                alert('data failed!');
                console.error(err);
            }
        });

    }

    function switchEnable(el, userid) {
        let status = $(el).is(':checked') ? 1 : 0;
        // alert(userid);
        // alert(status);
        $.ajax({
            url: '/update-enable',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                user_id: userid,
                enabled: status
            },
            success: function(res) {
                if (!res.success) {
                    alert("Error updating status");
                }
                if (status === 1) {
                    $("#enableMessage").text("User Enabled Successfully");
                    setTimeout(() => {
                        $("#enableMessage").text("");
                    }, 5000); // Clear after 5 seconds
                }
                if (status === 0) {
                    $("#enableMessage").text("User Disabled Successfully");
                    setTimeout(() => {
                        $("#enableMessage").text("");
                    }, 5000); // Clear after 5 seconds
                }
                window.location.reload();
            },
            error: function() {
                alert("AJAX error");
            }
        });
    }
</script>
@endsection