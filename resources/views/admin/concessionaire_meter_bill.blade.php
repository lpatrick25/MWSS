@extends('layouts\master')
@section('APP-TITLE', 'Concessionaire Meter Bill')
@section('active-concessionaire-menu')
    active active-menu
@endsection
@section('active-concessionaire-bill')
    active active-menu
@endsection
@section('APP-CONTENT')
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Concessionaire Meter Bill</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <div id="toolbar">
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
    <div id="viewMeters" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">List of Meters</h3>
                </div>
                <div class="modal-body">
                    <div id="meters-view"></div>
                </div>
                <div class="modal-footer text-right">
                    <button class="btn btn-danger btn-md" data-dismiss="modal">Close</button>
                </div>
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
                <button class="btn btn-sm btn-primary me-1" onclick="viewData('${row.id}')" title="View Meter">
                    <i class="bi bi-eye"></i>
                </button>
            `;
        }

        function viewData(id) {
            $.ajax({
                method: 'GET',
                url: `/admin/concessionaireMeterBill/${id}/meters`,
                success: function(data) {
                    let html = "";

                    if (data.length === 0) {
                        html =
                        `<div class="alert alert-warning">No meters found for this concessionaire.</div>`;
                    } else {
                        html += `<div class="row">`;
                        data.forEach(meter => {
                            html += `
                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0 text-white">Meter #${meter.meter_number}</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Service Address:</strong><br> Brgy. ${meter.service_address}, MacArthur, Leyte</p>
                                    <p><strong>Installed:</strong> ${new Date(meter.installation_date).toLocaleDateString()}</p>
                                    <p><strong>Status:</strong>
                                        <span class="badge ${meter.status === 'Active' ? 'badge-success' : 'badge-secondary'}">
                                            ${meter.status}
                                        </span>
                                    </p>
                                </div>
                                <div class="card-footer text-muted small text-right">
                                    <button type="button" class="btn btn-sm btn-primary" onclick="viewMeterReading(${meter.id})">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                        });
                        html += `</div>`;
                    }

                    $("#meters-view").html(html);
                    $("#viewMeters").modal("show");
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

        });
    </script>
@endsection
