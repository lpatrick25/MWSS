@extends('layouts\master')
@section('APP-TITLE', 'User Management')
@section('active-user-menu')
    active active-menu
@endsection
@section('active-user-management')
    active active-menu
@endsection
@section('APP-CONTENT')
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">User Management</h4>
                </div>
            </div>
            <div class="iq-card-body">
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
    <div class="modal fade" id="changePasswordModal">
        <div class="modal-dialog">
            <form class="modal-content" id="changePasswordForm">
                <div class="modal-header">
                    <h3 class="modal-title">Change Password</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-md btn-primary"><i class="fa fa-save"></i> Update</button>
                    <button class="btn btn-md btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('APP-SCRIPT')
    <script type="text/javascript">
        let dataId;

        function getStatusFormatter(value, row) {
            // Ensure row is defined and has an id
            if (!row || row.id === undefined || row.id === null) {
                return '<span class="text-muted">No actions available</span>';
            }
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
        <button class="btn btn-sm btn-primary me-1" onclick="changeData(${row.id})" title="Change Password">
            <i class="bi bi-key"></i>
        </button>
        <button class="btn btn-sm btn-danger me-1" onclick="disableData(${row.id})" title="Disable Account">
            <i class="bi bi-person-x"></i>
        </button>
    `;
        }

        function changeData(id) {
            $.ajax({
                method: 'GET',
                url: `/users/${id}`,
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    var data = response.content;
                    dataId = data.id;
                    $('#changePasswordModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).modal('show');
                },
                error: function(xhr) {
                    toastr.error('Error fetching user data: ' + (xhr.responseText || 'Unknown error'));
                }
            });
        }

        function disableData(id) {
            $.ajax({
                method: 'PUT',
                url: `/users/${id}/changeStatus`,
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

            $('#changePasswordForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    method: 'PUT',
                    url: `/users/${dataId}/changePassword`,
                    data: $('#changePasswordForm').serialize(),
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        $('#changePasswordModal').modal('hide');
                        $('#table').bootstrapTable('refresh');
                        $('#addForm').trigger('reset');
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
                                            `#changePasswordForm [name="${field}"]`
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
            });

        });
    </script>
@endsection
