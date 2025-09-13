@extends('layouts.master')
@section('APP-TITLE', 'Tariff Rate List')
@section('active-tariff-menu') <!-- Adjust based on your sidebar menu structure -->
    active active-menu
@endsection
@section('active-tariff-list') <!-- Adjust based on your sidebar menu structure -->
    active active-menu
@endsection
@section('APP-CONTENT')
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Tariff Rate List</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div id="toolbar">
                    <button class="btn btn-md btn-primary" id="add-new-btn"><i class="fa fa-plus"></i> Add New Tariff
                        Rate</button>
                </div>
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true"
                    data-show-refresh="true" data-show-toggle="true" data-show-export="true" data-filter-control="true"
                    data-sticky-header="true" data-show-jump-to="true" data-url="{{ route('tariff-rates.index') }}"
                    data-toolbar="#toolbar">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="effective_date">Effective Date</th>
                            <th data-field="min_consumption">Min Consumption (m³)</th>
                            <th data-field="max_consumption">Max Consumption (m³)</th>
                            <th data-field="flat_amount">Flat Amount</th>
                            <th data-field="rate_per_cubic_meter">Rate per m³</th>
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
                    <h3 class="modal-title">Add New Tariff Rate</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="effective_date">Effective Date: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="effective_date" name="effective_date" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="min_consumption">Min Consumption (m³): <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="min_consumption" name="min_consumption" required
                                min="0">
                        </div>
                        <div class="col-lg-6">
                            <label for="max_consumption">Max Consumption (m³):</label>
                            <input type="number" class="form-control" id="max_consumption" name="max_consumption"
                                min="0">
                        </div>
                        <div class="col-lg-6">
                            <label for="flat_amount">Flat Amount: <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="flat_amount" name="flat_amount"
                                required min="0" value="0.00">
                        </div>
                        <div class="col-lg-6">
                            <label for="rate_per_cubic_meter">Rate per m³: <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="rate_per_cubic_meter"
                                name="rate_per_cubic_meter" required min="0" value="0.00">
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
                    <h3 class="modal-title">Update Tariff Rate</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="effective_date">Effective Date: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="effective_date" name="effective_date" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="min_consumption">Min Consumption (m³): <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="min_consumption" name="min_consumption"
                                required min="0">
                        </div>
                        <div class="col-lg-6">
                            <label for="max_consumption">Max Consumption (m³):</label>
                            <input type="number" class="form-control" id="max_consumption" name="max_consumption"
                                min="0">
                        </div>
                        <div class="col-lg-6">
                            <label for="flat_amount">Flat Amount: <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="flat_amount"
                                name="flat_amount" required min="0" value="0.00">
                        </div>
                        <div class="col-lg-6">
                            <label for="rate_per_cubic_meter">Rate per m³: <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="rate_per_cubic_meter"
                                name="rate_per_cubic_meter" required min="0" value="0.00">
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

        function getActionFormatter(value, row) {
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
                url: `/tariff-rates/${id}`,
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    var data = response.content;
                    dataId = data.id;
                    $('#updateForm').find('input[id=effective_date]').val(data.effective_date);
                    $('#updateForm').find('input[id=min_consumption]').val(data.min_consumption);
                    $('#updateForm').find('input[id=max_consumption]').val(data.max_consumption || '');
                    $('#updateForm').find('input[id=flat_amount]').val(data.flat_amount);
                    $('#updateForm').find('input[id=rate_per_cubic_meter]').val(data.rate_per_cubic_meter);
                    $('#updateModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).modal('show');
                },
                error: function(xhr) {
                    toastr.error('Error fetching tariff rate data: ' + (xhr.responseText || 'Unknown error'));
                }
            });
        }

        function deleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: `/tariff-rates/${id}`,
                        dataType: 'JSON',
                        cache: false,
                        success: function(response) {
                            $('#table').bootstrapTable('refresh');
                            toastr.success(response.message);
                        },
                        error: function(xhr) {
                            let message = 'Error deleting tariff rate.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }
                            toastr.error(message);
                        }
                    });
                }
            });
        }

        function isMobile() {
            return window.innerWidth <= 576;
        }

        $(document).ready(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 5000
            };

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
                showCustomView: isMobile(),
                formatNoMatches: function() {
                    return '<div class="text-center p-4">No data found.</div>';
                },
                formatLoadingMessage: function() {
                    return '<div class="text-center"><span class="spinner-border spinner-border-sm"></span> Loading...</div>';
                }
            });

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
                    title: 'Add New Tariff Rate?',
                    text: "Are you sure you want to add this tariff rate?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Save',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'POST',
                            url: '{{ route('tariff-rates.store') }}',
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
                                    toastr.error('Error adding tariff rate: ' + (
                                        response.message ||
                                        'An unknown error occurred.'));
                                    if (response.errors) {
                                        for (const field in response.errors) {
                                            const messages = response.errors[field];
                                            if (messages.length > 0) {
                                                const input = $(
                                                    `#addForm [name="${field}"]`);
                                                input.addClass('is-invalid');
                                                input.closest('.form-group').find(
                                                    'span.invalid-feedback')
                                                .remove();
                                                const error = $(
                                                    '<span class="invalid-feedback"></span>'
                                                    ).text(
                                                    messages[0]);
                                                input.closest('.form-group').append(
                                                    error);
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
                    title: 'Update Tariff Rate?',
                    text: "Are you sure you want to update this tariff rate?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'PUT',
                            url: `/tariff-rates/${dataId}`,
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
                                    toastr.error('Error updating tariff rate: ' + (
                                        response.message ||
                                        'An unknown error occurred.'));
                                    if (response.errors) {
                                        for (const field in response.errors) {
                                            const messages = response.errors[field];
                                            if (messages.length > 0) {
                                                const input = $(
                                                    `#updateForm [name="${field}"]`);
                                                input.addClass('is-invalid');
                                                input.closest('.form-group').find(
                                                    'span.invalid-feedback')
                                                .remove();
                                                const error = $(
                                                    '<span class="invalid-feedback"></span>'
                                                    ).text(
                                                    messages[0]);
                                                input.closest('.form-group').append(
                                                    error);
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
