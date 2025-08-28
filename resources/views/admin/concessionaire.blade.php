@extends('layouts\master')
@section('APP-TITLE', 'Concessionaire List')
@section('active-concessionaire-menu')
    active active-menu
@endsection
@section('active-concessionaire-list')
    active active-menu
@endsection
@section('APP-CONTENT')
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Concessionaire List</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div id="toolbar">
                    <button class="btn btn-md btn-primary" id="add-new-btn"><i class="fa fa-plus"> Add New
                            Concessionaire</i></button>
                </div>
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true"
                    data-show-refresh="true" data-show-toggle="true" data-show-export="true" data-filter-control="true"
                    data-sticky-header="true" data-show-jump-to="true" data-url="{{ route('concessionaires.index') }}"
                    data-toolbar="#toolbar">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="account_number">Account Number</th>
                            <th data-field="fullname">Fullname</th>
                            <th data-field="address" data-formatter="getServiceFormatter">Address</th>
                            <th data-field="phone_number">Phone Number</th>
                            <th data-field="email">Email</th>
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
                    <h3 class="modal-title">Add New Concessionaire</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="account_number">Account Number: <span class="text-danger"></span></label>
                            <input type="text" class="form-control" id="account_number" name="account_number" disabled
                                value="Auto-Generated">
                        </div>
                        <div class="col-lg-6">
                            <label for="address">Address: <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="address" name="address">
                                <option value="Batug">Brgy. Batug, MacArthur, Leyte</option>
                                <option value="Burabod">Brgy. Burabod, MacArthur, Leyte</option>
                                <option value="Capudlosan">Brgy. Capudlosan, MacArthur, Leyte</option>
                                <option value="Casuntingan">Brgy. Casuntingan, MacArthur, Leyte</option>
                                <option value="Causwagan">Brgy. Causwagan, MacArthur, Leyte</option>
                                <option value="Danao">Brgy. Danao, MacArthur, Leyte</option>
                                <option value="Doña Josefa">Brgy. Doña Josefa, MacArthur, Leyte</option>
                                <option value="General Luna">Brgy. General Luna, MacArthur, Leyte</option>
                                <option value="Kiling">Brgy. Kiling, MacArthur, Leyte</option>
                                <option value="Lanawan">Brgy. Lanawan, MacArthur, Leyte</option>
                                <option value="Liwayway">Brgy. Liwayway, MacArthur, Leyte</option>
                                <option value="Maya">Brgy. Maya, MacArthur, Leyte</option>
                                <option value="Oguisan">Brgy. Oguisan, MacArthur, Leyte</option>
                                <option value="Osmeña">Brgy. Osmeña, MacArthur, Leyte</option>
                                <option value="Palale 1">Brgy. Palale 1, MacArthur, Leyte</option>
                                <option value="Palale 2">Brgy. Palale 2, MacArthur, Leyte</option>
                                <option value="Poblacion District 1">Brgy. Poblacion District 1, MacArthur, Leyte</option>
                                <option value="Poblacion District 2">Brgy. Poblacion District 2, MacArthur, Leyte</option>
                                <option value="Poblacion District 3">Brgy. Poblacion District 3, MacArthur, Leyte</option>
                                <option value="Pongon">Brgy. Pongon, MacArthur, Leyte</option>
                                <option value="Quezon">Brgy. Quezon, MacArthur, Leyte</option>
                                <option value="Romualdez">Brgy. Romualdez, MacArthur, Leyte</option>
                                <option value="Salvacion">Brgy. Salvacion, MacArthur, Leyte</option>
                                <option value="San Antonio">Brgy. San Antonio, MacArthur, Leyte</option>
                                <option value="San Isidro">Brgy. San Isidro, MacArthur, Leyte</option>
                                <option value="San Pedro">Brgy. San Pedro, MacArthur, Leyte</option>
                                <option value="San Vicente">Brgy. San Vicente, MacArthur, Leyte</option>
                                <option value="Santa Isabel">Brgy. Santa Isabel, MacArthur, Leyte</option>
                                <option value="Tinawan">Brgy. Tinawan, MacArthur, Leyte</option>
                                <option value="Tuyo">Brgy. Tuyo, MacArthur, Leyte</option>
                                <option value="Villa Imelda">Brgy. Villa Imelda, MacArthur, Leyte</option>
                            </select>
                        </div>
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
    <div id="updateModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <form id="updateForm" class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Update Concessionaire</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="account_number">Account Number: <span class="text-danger"></span></label>
                            <input type="text" class="form-control" id="account_number" name="account_number"
                                disabled value="Auto-Generated">
                        </div>
                        <div class="col-lg-6">
                            <label for="address">Address: <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="address" name="address">
                                <option value="Batug">Brgy. Batug, MacArthur, Leyte</option>
                                <option value="Burabod">Brgy. Burabod, MacArthur, Leyte</option>
                                <option value="Capudlosan">Brgy. Capudlosan, MacArthur, Leyte</option>
                                <option value="Casuntingan">Brgy. Casuntingan, MacArthur, Leyte</option>
                                <option value="Causwagan">Brgy. Causwagan, MacArthur, Leyte</option>
                                <option value="Danao">Brgy. Danao, MacArthur, Leyte</option>
                                <option value="Doña Josefa">Brgy. Doña Josefa, MacArthur, Leyte</option>
                                <option value="General Luna">Brgy. General Luna, MacArthur, Leyte</option>
                                <option value="Kiling">Brgy. Kiling, MacArthur, Leyte</option>
                                <option value="Lanawan">Brgy. Lanawan, MacArthur, Leyte</option>
                                <option value="Liwayway">Brgy. Liwayway, MacArthur, Leyte</option>
                                <option value="Maya">Brgy. Maya, MacArthur, Leyte</option>
                                <option value="Oguisan">Brgy. Oguisan, MacArthur, Leyte</option>
                                <option value="Osmeña">Brgy. Osmeña, MacArthur, Leyte</option>
                                <option value="Palale 1">Brgy. Palale 1, MacArthur, Leyte</option>
                                <option value="Palale 2">Brgy. Palale 2, MacArthur, Leyte</option>
                                <option value="Poblacion District 1">Brgy. Poblacion District 1, MacArthur, Leyte</option>
                                <option value="Poblacion District 2">Brgy. Poblacion District 2, MacArthur, Leyte</option>
                                <option value="Poblacion District 3">Brgy. Poblacion District 3, MacArthur, Leyte</option>
                                <option value="Pongon">Brgy. Pongon, MacArthur, Leyte</option>
                                <option value="Quezon">Brgy. Quezon, MacArthur, Leyte</option>
                                <option value="Romualdez">Brgy. Romualdez, MacArthur, Leyte</option>
                                <option value="Salvacion">Brgy. Salvacion, MacArthur, Leyte</option>
                                <option value="San Antonio">Brgy. San Antonio, MacArthur, Leyte</option>
                                <option value="San Isidro">Brgy. San Isidro, MacArthur, Leyte</option>
                                <option value="San Pedro">Brgy. San Pedro, MacArthur, Leyte</option>
                                <option value="San Vicente">Brgy. San Vicente, MacArthur, Leyte</option>
                                <option value="Santa Isabel">Brgy. Santa Isabel, MacArthur, Leyte</option>
                                <option value="Tinawan">Brgy. Tinawan, MacArthur, Leyte</option>
                                <option value="Tuyo">Brgy. Tuyo, MacArthur, Leyte</option>
                                <option value="Villa Imelda">Brgy. Villa Imelda, MacArthur, Leyte</option>
                            </select>
                        </div>
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

        function getServiceFormatter(value, row) {
            return `Brgy. ${value}, MacArthur, Leyte`;
        }

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
                <button class="btn btn-sm btn-danger me-1" onclick="deleteData(${row.id})" title="Delete">
                    <i class="bi bi-trash"></i>
                </button>
            `;
        }

        function editData(id) {
            $.ajax({
                method: 'GET',
                url: `/concessionaires/${id}`,
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    var data = response.content;
                    dataId = data.id;
                    $('#updateForm').find('input[id=account_number]').val(data.account_number);
                    $('#updateForm').find('input[id=address]').val(data.address);
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
                    toastr.error('Error fetching concessionaire data: ' + (xhr.responseText ||
                        'Unknown error'));
                }
            });
        }

        function deleteData(id) {
            $.ajax({
                method: 'DELETE',
                url: `/concessionaires/${id}`,
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    $('#table').bootstrapTable('refresh');
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    let message = 'Error deleting concessionaire.';
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

            $('#addForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    method: 'POST',
                    url: '{{ route('concessionaires.store') }}',
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
                            toastr.error('Error adding concessionaire: ' + (response
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
            });

            $('#updateForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    method: 'PUT',
                    url: `/concessionaires/${dataId}`,
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
                            toastr.error('Error updating concessionaire: ' + (response
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
            });

        });
    </script>
@endsection
