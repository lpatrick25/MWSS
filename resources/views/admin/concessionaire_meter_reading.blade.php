@extends('layouts\master')
@section('APP-TITLE', 'Concessionaire Meter Reading')
@section('active-concessionaire-menu')
    active active-menu
@endsection
@section('active-concessionaire-bill')
    active active-menu
@endsection
@section('APP-CONTENT')
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between align-items-center">
                <div class="iq-header-title">
                    <h4 class="card-title mb-0">Concessionaire Meter Reading</h4>
                </div>
                @if ($meter->status === 'Active')
                    <button class="btn btn-md btn-primary" onclick="updateStatus({{ $meter->id }})">
                        <i class="bi bi-arrow-bar-up"></i> {{ $meter->status }}
                    </button>
                @else
                    <button class="btn btn-md btn-danger" onclick="updateStatus({{ $meter->id }})">
                        <i class="bi bi-arrow-bar-down"></i> {{ $meter->status }}
                    </button>
                @endif
            </div>
            <div class="iq-card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <h5>Account Number:</h5>
                        <p>{{ $meter->concessionaire->account_number }}</p>
                    </div>
                    <div class="col-lg-4">
                        <h5>Fullname:</h5>
                        <p>{{ $meter->concessionaire->fullname }}</p>
                    </div>
                    <div class="col-lg-4">
                        <h5>Service Address:</h5>
                        <p>Brgy. {{ $meter->concessionaire->service_address }}, MacArthur, Leyte</p>
                    </div>
                </div>
                <div id="toolbar">
                    <button class="btn btn-md btn-primary" id="add-new-btn"><i class="fa fa-plus"> New Water
                            Bill</i></button>
                </div>
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true"
                    data-show-refresh="true" data-show-toggle="true" data-show-export="true" data-filter-control="true"
                    data-sticky-header="true" data-show-jump-to="true"
                    data-url="/readingBilling?meter_id={{ $meter->id }}" data-toolbar="#toolbar">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="bill_no">Bill No</th>
                            <th data-field="previous_reading">Prev. Reading</th>
                            <th data-field="present_reading">Curr. Reading</th>
                            <th data-field="consumption">Consumption</th>
                            <th data-field="reading_date">Reading Date</th>
                            <th data-field="amount_due">Amount Due</th>
                            <th data-field="due_date">Due Date</th>
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
            <div class="modal-content">
                <form id="addForm">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add Meter Reading & Billing</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="status" id="status" value="Pending">
                        <input type="hidden" name="meter_id" id="meter_id" value="{{ $meter->id }}">
                        <input type="hidden" name="concessionaire_id" id="concessionaire_id"
                            value="{{ $meter->concessionaire_id }}">

                        <div class="form-group">
                            <label>Previous Reading</label>
                            <input type="number" class="form-control previous_reading" name="previous_reading"
                                id="previous_reading" value="{{ $previous }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Present Reading</label>
                            <input type="number" class="form-control present_reading" name="present_reading"
                                id="present_reading" required>
                        </div>

                        <div class="form-group">
                            <label>Reading Date</label>
                            <input type="date" class="form-control reading_date" name="reading_date" id="reading_date"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Billing Month</label>
                            <input type="month" class="form-control" name="billing_month" id="billing_month" required>
                        </div>

                        <div class="form-group">
                            <label>Due Date</label>
                            <input type="date" class="form-control" name="due_date" id="due_date" required>
                        </div>

                        <div class="form-group">
                            <label>Amount Due</label>
                            <input type="number" step="0.01" class="form-control amount_due" name="amount_due"
                                id="amount_due" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="updateModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="updateForm">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Update Meter Reading & Billing</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="status" id="status" value="Pending">
                        <input type="hidden" name="meter_id" id="meter_id" value="{{ $meter->id }}">
                        <input type="hidden" name="concessionaire_id" id="concessionaire_id"
                            value="{{ $meter->concessionaire_id }}">

                        <div class="form-group">
                            <label>Previous Reading</label>
                            <input type="number" class="form-control previous_reading" name="previous_reading"
                                id="previous_reading" value="{{ $previous }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Present Reading</label>
                            <input type="number" class="form-control present_reading" name="present_reading"
                                id="present_reading" required>
                        </div>

                        <div class="form-group">
                            <label>Reading Date</label>
                            <input type="date" class="form-control reading_date" name="reading_date"
                                id="reading_date" required>
                        </div>

                        <div class="form-group">
                            <label>Billing Month</label>
                            <input type="month" class="form-control" name="billing_month" id="billing_month" required>
                        </div>

                        <div class="form-group">
                            <label>Due Date</label>
                            <input type="date" class="form-control" name="due_date" id="due_date" required>
                        </div>

                        <div class="form-group">
                            <label>Amount Due</label>
                            <input type="number" step="0.01" class="form-control amount_due" name="amount_due"
                                id="amount_due" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
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
            switch (value) {
                case 'Paid':
                    return `<div class="bg bg-success text-center"><span class="text-white fw-bold">${value}</span></div>`;
                case 'Pending':
                    return `<div class="bg bg-warning text-center"><span class="text-dark fw-bold">${value}</span></div>`;
                case 'Overdue':
                    return `<div class="bg bg-danger text-center"><span class="text-white fw-bold">${value}</span></div>`;
                default:
                    return `<div class="bg bg-secondary text-center"><span class="text-white fw-bold">${value}</span></div>`;
            }
        }

        function getActionFormatter(value, row) {
            // Ensure row is defined and has an id
            if (!row || row.id === undefined || row.id === null) {
                return '<span class="text-muted">No actions available</span>';
            }
            return `
                <button class="btn btn-sm btn-primary me-1" onclick="editData('${row.id}')" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                </button>
            `;
        }

        function editData(id) {
            $.ajax({
                method: 'GET',
                url: `/readingBilling/${id}`,
                success: function(response) {
                    var data = response.content;
                    $('#updateForm [name="previous_reading"]').val(data.previous_reading);
                    $('#updateForm [name="present_reading"]').val(data.present_reading);
                    $('#updateForm [name="reading_date"]').val(data.reading_date);
                    $('#updateForm [name="billing_month"]').val(data.bill_no);
                    $('#updateForm [name="due_date"]').val(data.due_date);
                    $('#updateForm [name="amount_due"]').val(data.amount_due);
                    dataId = id;
                    $('#updateModal').modal('show');
                },
                error: function(xhr) {
                    toastr.error("Error fetching data: " + (xhr.responseText || "Unknown error"));
                }
            });
        }

        function updateStatus(meterID) {
            $.ajax({
                url: `/meters/${meterID}/status`,
                method: "PUT",
                success: function(res) {
                    toastr.success("Status updated successfully");
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                },
                error: function(xhr) {
                    toastr.error("Error updating status: " + (xhr.responseText || "Unknown error"));
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

            $("#add-new-btn").on("click", function() {
                $("#addModal").modal("show");
            });

            $(document).on("input change", ".present_reading, .reading_date", function() {
                let form = $(this).closest("form"); // scope to the form where change happened

                let prev = parseInt(form.find(".previous_reading").val());
                let present = parseInt(form.find(".present_reading").val());
                let date = form.find(".reading_date").val();

                if (!isNaN(prev) && !isNaN(present) && present >= prev && date) {
                    $.ajax({
                        url: "/admin/calculate-amount-due",
                        method: "POST",
                        data: {
                            previous_reading: prev,
                            present_reading: present,
                            reading_date: date,
                        },
                        success: function(res) {
                            form.find(".amount_due").val(res.amount_due);
                        },
                        error: function(xhr) {
                            toastr.error("Error calculating: " + (xhr.responseText ||
                                "Unknown error"));
                        }
                    });
                }
            });

            $('#addForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    method: 'POST',
                    url: '{{ route('readingBilling.store') }}',
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
                            toastr.error('Error adding reading & billing: ' + (response
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
                    url: '/readingBilling/{meterReading}'.replace('{meterReading}', dataId),
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
                            toastr.error('Error updating reading & billing: ' + (response
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
