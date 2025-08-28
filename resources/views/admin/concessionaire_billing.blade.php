@extends('layouts.master')
@section('APP-TITLE', 'Billing List')
@section('active-concessionaire-menu') <!-- Adjust based on your sidebar menu structure -->
    active active-menu
@endsection
@section('active-concessionaire-billing') <!-- Adjust based on your sidebar menu structure -->
    active active-menu
@endsection
@section('APP-CONTENT')
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Billing List</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div id="toolbar">
                </div>
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true"
                    data-show-refresh="true" data-show-toggle="true" data-show-export="true" data-filter-control="true"
                    data-sticky-header="true" data-show-jump-to="true" data-url="{{ route('billings.index') }}"
                    data-toolbar="#toolbar">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="bill_no">Bill No</th>
                            <th data-field="concessionaire.full_name">Concessionaire</th>
                            <th data-field="meter_reading.meter_number">Meter Number</th>
                            <th data-field="billing_month">Billing Month</th>
                            <th data-field="due_date">Due Date</th>
                            <th data-field="amount_due">Amount Due</th>
                            <th data-field="status">Status</th>
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
                <div class="modal-header bg-primary">
                    <h3 class="modal-title text-white">Payment</h3>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <!-- hidden fields -->
                    <input type="hidden" id="bill_id" name="bill_id">
                    <input type="hidden" id="payment_method" name="payment_method" value="Cash">
                    <input type="hidden" id="collected_by" name="collected_by" value="{{ auth()->user()->id }}">

                    <!-- Bill Information -->
                    <div class="mb-3">
                        <h5>Bill Information</h5>
                        <p><strong>Bill No:</strong> <span id="bill_no"></span></p>
                        <p><strong>Concessionaire:</strong> <span id="concessionaire_name"></span></p>
                        <p><strong>Account Number:</strong> <span id="account_number"></span></p>
                        <p><strong>Meter Number:</strong> <span id="meter_number"></span></p>
                        <p><strong>Consumption:</strong> <span id="consumption"></span> m³</p>
                        <p><strong>Due Date:</strong> <span id="due_date"></span></p>
                    </div>

                    <!-- Payment Inputs -->
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="payment_date">Payment Date:</label>
                            <input type="date" class="form-control" id="payment_date" name="payment_date"
                                value="{{ now()->format('Y-m-d') }}" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label for="amount_due">Amount Due:</label>
                            <input type="number" class="form-control" id="amount_due" name="amount_due" readonly>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="amount_paid">Amount Paid:</label>
                            <input type="number" step="0.01" class="form-control" id="amount_paid" name="amount_paid"
                                required min="0" value="0.00">
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="amount_change">Change:</label>
                            <input type="number" step="0.01" class="form-control" id="amount_change"
                                name="amount_change" readonly value="0.00" readonly>
                        </div>

                    </div>
                </div>

                <div class="modal-footer text-right">
                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Cancel</button>
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
                <button class="btn btn-sm btn-primary me-1"
                    onclick='paymentData(${JSON.stringify(row)})' title="Pay">
                    <i class="bi bi-receipt"></i>
                </button>
            `;
        }

        function paymentData(row) {
            let form = $('#addForm');

            // hidden fields
            form.find('#bill_id').val(row.id);
            form.find('#amount_due').val(row.amount_due);

            // display info
            $('#bill_no').text(row.bill_no);
            $('#concessionaire_name').text(row.concessionaire.full_name);
            $('#account_number').text(row.concessionaire.account_number);
            $('#meter_number').text(row.meter_reading.meter_number);
            $('#consumption').text(row.meter_reading.consumption);
            $('#due_date').text(row.due_date);

            // show modal
            $('#addModal').modal('show');
        }

        function deleteData(id) {
            $.ajax({
                method: 'DELETE',
                url: `/billings/${id}`,
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    $('#table').bootstrapTable('refresh');
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    let message = 'Error deleting billing.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    toastr.error(message);
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

            $('#amount_paid').on('input', function() {
                let amountDue = parseFloat($('#amount_due').val()) || 0;
                let amountPaid = parseFloat($(this).val()) || 0;
                let change = amountPaid - amountDue;

                $('#amount_change').val(change >= 0 ? change.toFixed(2) : '0.00');
            });

            $('#addForm').submit(function(event) {
                event.preventDefault();

                let amountDue = parseFloat($('#amount_due').val());
                let amountPaid = parseFloat($('#amount_paid').val());

                if (isNaN(amountPaid) || amountPaid < amountDue) {
                    toastr.error('Amount Paid must be equal to or greater than Amount Due.');
                    return; // stop form submission
                }

                $.ajax({
                    method: 'POST',
                    url: '{{ route('payments.store') }}',
                    data: $(this).serialize(),
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
                            toastr.error('Error adding payment: ' + (response.message ||
                                'An unknown error occurred.'));
                            if (response.errors) {
                                for (const field in response.errors) {
                                    const messages = response.errors[field];
                                    if (messages.length > 0) {
                                        const input = $(`#addForm [name="${field}"]`);
                                        input.addClass('is-invalid');
                                        input.closest('.form-group').find(
                                            'span.invalid-feedback').remove();
                                        const error = $(
                                            '<span class="invalid-feedback"></span>').text(
                                            messages[0]);
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
