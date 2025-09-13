@extends('layouts\master')
@section('APP-TITLE', 'User List')
@section('active-user-menu')
    active active-menu
@endsection
@section('active-user-list')
    active active-menu
@endsection
@section('APP-CONTENT')
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">User List</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div id="toolbar">
                    <button class="btn btn-md btn-primary" id="add-new-btn"><i class="fa fa-plus"> Add New User</i></button>
                </div>
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true"
                    data-show-refresh="true" data-show-toggle="true" data-show-export="true" data-filter-control="true"
                    data-sticky-header="true" data-show-jump-to="true" data-url="{{ route('users.index') }}"
                    data-toolbar="#toolbar">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="fullname">Fullname</th>
                            <th data-field="phone_number">Phone Number</th>
                            <th data-field="email">Email</th>
                            <th data-field="role">Role</th>
                            <th data-field="status" data-formatter="getStatusFormatter">Status</th>
                            <th data-field="action" data-formatter="getActionFormatter">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div id="addModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <form id="addForm" class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add New User</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="first_name">First Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="middle_name">Middle Name: <span class="text-danger"></span></label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="col-lg-6">
                            <label for="last_name">Last Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="extension_name">Extension Name: <span class="text-danger"></span></label>
                            <input type="text" class="form-control" id="extension_name" name="extension_name">
                        </div>
                        <div class="col-lg-6">
                            <label for="phone_number">Phone Number: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="email">Email Address: <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="role">Role: <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="role" name="role">
                                <option value="Meter Reader">Meter Reader</option>
                                <option value="Cashier">Cashier</option>
                                <option value="Head">Head</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="password">Password: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="confirm_password">Confirm Password: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="confirm_password" name="confirm_password"
                                required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-md btn-primary">Submit</button>
                    <button class="btn btn-md btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <div id="updateModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <form id="updateForm" class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Update User</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="first_name">First Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="middle_name">Middle Name: <span class="text-danger"></span></label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="col-lg-6">
                            <label for="last_name">Last Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="extension_name">Extension Name: <span class="text-danger"></span></label>
                            <input type="text" class="form-control" id="extension_name" name="extension_name">
                        </div>
                        <div class="col-lg-6">
                            <label for="phone_number">Phone Number: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="email">Email Address: <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-md btn-primary">Submit</button>
                    <button class="btn btn-md btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('APP-SCRIPT')
    <script type="text/javascript">
        let dataId;

        function getStatusFormatter(value, row) {
            if (value === 'Active') {
                return `<div class="bg bg-success text-center"><span class="text-dark" style="font-weight: 700;">${value}</span></div>`;
            }
            return `<div class="bg bg-danger text-center"><span class="text-white" style="font-weight: 700;">${value}</span></div>`;
        }

        function getActionFormatter(value, row) {
            // Ensure row is defined and has an id
            if (!row || row.id === undefined || row.id === null) {
                return '<span class="text-muted">No actions available</span>';
            }
            return `
                <button class="btn btn-sm btn-primary me-1" onclick="editData(${row.id})" title="Edit">
                    <i class="bi bi-pencil"></i>
                </button>
            `;
        }

        function editData(id) {
            $.ajax({
                method: 'GET',
                url: `/users/${id}`,
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    var data = response.content;
                    dataId = data.id;
                    $('#updateForm').find('input[id=first_name]').val(data.first_name);
                    $('#updateForm').find('input[id=middle_name]').val(data.middle_name);
                    $('#updateForm').find('input[id=last_name]').val(data.last_name);
                    $('#updateForm').find('input[id=extension_name]').val(data.extension_name);
                    $('#updateForm').find('input[id=phone_number]').val(data.phone_number);
                    $('#updateForm').find('input[id=email]').val(data.email);
                    $('#updateModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).modal('show');
                },
                error: function(xhr) {
                    toastr.error('Error fetching user data: ' + (xhr.responseText || 'Unknown error'));
                }
            });
        }

        function deleteData(id) {
            Swal.fire({
            title: 'Delete User?',
            text: "Are you sure you want to delete this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                method: 'DELETE',
                url: `/users/${id}`,
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    $('#table').bootstrapTable('refresh');
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    let message = 'Error deleting user.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                    }
                    toastr.error(message);
                }
                });
            }
            });
        }

        // Function to check if the device is mobile (based on screen width)
        function isMobile() {
            return window.innerWidth <= 576; // Bootstrap's 'sm' breakpoint
        }

        $(document).ready(function() {

            // Initialize Toastr
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 5000
            };

            // Initialize Bootstrap Table
            $('#table').bootstrapTable({
                exportDataType: 'all',
                exportTypes: ['json', 'csv', 'txt', 'excel'],
                filterControl: true,
                stickyHeader: true,
                pagination: true,
                pageSize: 10,
                pageList: [10, 25, 50, 100],
                search: true,
                showColumns: true,
                showRefresh: true,
                showToggle: true,
                sidePagination: 'server',
                pipeline: true,
                cache: true,
                cacheAmount: 100,
                showCustomView: isMobile(), // Enable custom view on mobile
                formatNoMatches: function() {
                    return '<div class="text-center p-4">No data found.</div>';
                },
                formatLoadingMessage: function() {
                    return '<div class="text-center"><span class="spinner-border spinner-border-sm"></span> Loading...</div>';
                }
            });

            // Toggle custom view on window resize
            $(window).on('resize', function() {
                $('#table').bootstrapTable('toggleCustomView', isMobile());
            });

            $('#add-new-btn').click(function() {
                $('#addModal').modal({
                    backdrop: 'static',
                    keyboard: false
                }).modal('show');
            });

            $('#addForm').submit(function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Add New User?',
                    text: "Are you sure you want to add this user?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'POST',
                            url: '{{ route('users.store') }}',
                            data: $('#addForm').serialize(),
                            dataType: 'JSON',
                            cache: false,
                            success: function(response) {
                                $('#addModal').modal('hide');
                                $('#table').bootstrapTable('refresh');
                                $('#addForm').trigger('reset');
                                toastr.success(response.message);
                            },
                            error: function(xhr) {
                                let response;
                                try {
                                    response = JSON.parse(xhr.responseText);
                                    toastr.error('Error adding user: ' + (response
                                        .message || 'An unknown error occurred.'));
                                    if (response.errors) {
                                        for (const field in response.errors) {
                                            const messages = response.errors[field];
                                            if (messages.length > 0) {
                                                const input = $(
                                                    `#addForm [name="${field}"]`
                                                );
                                                input.addClass('is-invalid');
                                                input.closest('.form-group').find(
                                                    'span.invalid-feedback').remove();
                                                const error = $(
                                                    '<span class="invalid-feedback"></span>'
                                                ).text(messages[0]);
                                                input.closest('.form-group').append(error);
                                            }
                                        }
                                    }
                                } catch (e) {
                                    toastr.error('Error parsing server response.');
                                }
                            }
                        });
                    }
                });
            });

            $('#updateForm').submit(function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Update User?',
                    text: "Are you sure you want to update this user?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'PUT',
                            url: `/users/${dataId}`,
                            data: $('#updateForm').serialize(),
                            dataType: 'JSON',
                            cache: false,
                            success: function(response) {
                                $('#updateModal').modal('hide');
                                $('#table').bootstrapTable('refresh');
                                $('#updateForm').trigger('reset');
                                toastr.success(response.message);
                            },
                            error: function(xhr) {
                                let response;
                                try {
                                    response = JSON.parse(xhr.responseText);
                                    toastr.error('Error updating user: ' + (response
                                        .message || 'An unknown error occurred.'));
                                    if (response.errors) {
                                        for (const field in response.errors) {
                                            const messages = response.errors[field];
                                            if (messages.length > 0) {
                                                const input = $(
                                                    `#updateForm [name="${field}"]`
                                                );
                                                input.addClass('is-invalid');
                                                input.closest('.form-group').find(
                                                    'span.invalid-feedback').remove();
                                                const error = $(
                                                    '<span class="invalid-feedback"></span>'
                                                ).text(messages[0]);
                                                input.closest('.form-group').append(error);
                                            }
                                        }
                                    }
                                } catch (e) {
                                    toastr.error('Error parsing server response.');
                                }
                            }
                        });
                    }
                });
            });

        });
    </script>
@endsection
