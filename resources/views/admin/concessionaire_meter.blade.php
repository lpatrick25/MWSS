@extends('layouts\master')
@section('APP-TITLE', 'Concessionaire Meter List')
@section('active-concessionaire-menu')
    active active-menu
@endsection
@section('active-concessionaire-meter')
    active active-menu
@endsection
@section('APP-CONTENT')
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Concessionaire Meter List</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div id="toolbar">
                    <button class="btn btn-md btn-primary" id="add-new-btn"><i class="fa fa-plus"> Add New Meter</i></button>
                </div>
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true"
                    data-show-refresh="true" data-show-toggle="true" data-show-export="true" data-filter-control="true"
                    data-sticky-header="true" data-show-jump-to="true" data-url="{{ route('meters.index') }}"
                    data-toolbar="#toolbar">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="meter_number">Meter Number</th>
                            <th data-field="concessionaire.account_number">Account Number</th>
                            <th data-field="concessionaire.full_name">Concessionaire</th>
                            <th data-field="installation_date">Installation Date</th>
                            <th data-field="service_address" data-formatter="getServiceFormatter">Service Address</th>
                            <th data-field="status" data-formatter="getStatusFormatter">Status</th>
                            <th data-field="action" data-formatter="getActionFormatter">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div id="addModal" class="modal fade">
        <div class="modal-dialog">
            <form id="addForm" class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add New Concessionaire</h3>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <label for="meter_number">Meter Number: <span class="text-danger"></span></label>
                            <input type="text" class="form-control" id="meter_number" name="meter_number" required>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <label for="concessionaire_id">Consumer Name: <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="concessionaire_id" name="concessionaire_id">
                                @foreach ($concessionaires as $concessionaire)
                                    <option value="{{ $concessionaire->id }}">{{ $concessionaire->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <label for="installation_date">Installation Date: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="installation_date" name="installation_date"
                                required>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <label for="service_address">Service Address: <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="service_address" name="service_address">
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
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-md btn-primary">Save</button>
                    <button class="btn btn-md btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <div id="updateModal" class="modal fade">
        <div class="modal-dialog">
            <form id="updateForm" class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Update Concessionaire</h3>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <label for="meter_number">Meter Number: <span class="text-danger"></span></label>
                            <input type="text" class="form-control" id="meter_number" name="meter_number" required>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <label for="concessionaire_id">Consumer Name: <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="concessionaire_id" name="concessionaire_id">
                                @foreach ($concessionaires as $concessionaire)
                                    <option value="{{ $concessionaire->id }}">{{ $concessionaire->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <label for="installation_date">Installation Date: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="installation_date" name="installation_date"
                                required>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <label for="service_address">Service Address: <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="service_address" name="service_address">
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
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-md btn-primary">Save</button>
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
                <button class="btn btn-sm btn-success me-1" onclick="viewMeterReading('${row.id}')" title="View Meter">
                    <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-sm btn-danger me-1" onclick="statusData(${row.id})" title="Status">
                    <i class="bi bi-person-x"></i>
                </button>
            `;
        }

        function editData(id) {
            $.ajax({
                method: 'GET',
                url: `/meters/${id}`,
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    var data = response.content;
                    dataId = data.id;
                    $('#updateForm').find('input[id=concessionaire_id]').val(data.concessionaire_id);
                    $('#updateForm').find('input[id=meter_number]').val(data.meter_number);
                    $('#updateForm').find('input[id=installation_date]').val(data.installation_date);
                    $('#updateForm').find('select[id=service_address]').val(data.service_address);
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

        function viewMeterReading(meterId)
        {
            location.href = `/admin/concessionaireMeterBill/${meterId}/reading`;
        }

        function statusData(id) {
            Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to change the status of this meter?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                method: 'PUT',
                url: `/meters/${id}/changeStatus`,
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    $('#table').bootstrapTable('refresh');
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    let message = 'Error changing status.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                    }
                    toastr.error(message);
                }
                });
            }
            });
        }

        function deleteData(id) {
            Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                method: 'DELETE',
                url: `/meters/${id}`,
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
                    title: 'Add New Meter?',
                    text: "Are you sure you want to add this meter?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Save'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'POST',
                            url: '{{ route('meters.store') }}',
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
                    }
                });
            });

            $('#updateForm').submit(function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Update Meter?',
                    text: "Are you sure you want to update this meter?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Update'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'PUT',
                            url: `/meters/${dataId}`,
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
                    }
                });
            });

        });
    </script>
@endsection
