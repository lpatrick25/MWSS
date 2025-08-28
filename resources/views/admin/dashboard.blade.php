@extends('layouts.master')
@section('APP-TITLE', 'Dashboard')
@section('active-dashboard-menu')
    active active-menu
@endsection
@section('APP-CONTENT')
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Water Utility Dashboard</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <!-- Summary Cards -->
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <h4 class="mb-2">Concessionaires</h4>
                                <h3 class="mb-2">{{ $totalConcessionaires ?? 'N/A' }}</h3>
                                <p class="mb-0"><span class="text-success"><i class="ri-arrow-up-fill"></i>
                                        {{ $concessionaireGrowth ?? '0' }}%</span> vs last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <h4 class="mb-2">Active Meters</h4>
                                <h3 class="mb-2">{{ $activeMeters ?? 'N/A' }}</h3>
                                <p class="mb-0"><span class="text-success"><i class="ri-arrow-up-fill"></i>
                                        {{ $meterGrowth ?? '0' }}%</span> vs last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <h4 class="mb-2">Total Billings</h4>
                                <h3 class="mb-2">₱{{ number_format($totalBillings ?? 0, 2) }}</h3>
                                <p class="mb-0"><span class="text-danger"><i class="ri-arrow-down-fill"></i>
                                        {{ $billingChange ?? '0' }}%</span> vs last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <h4 class="mb-2">Overdue Bills</h4>
                                <h3 class="mb-2">{{ $overdueBills ?? 'N/A' }}</h3>
                                <p class="mb-0"><span class="text-danger"><i class="ri-arrow-up-fill"></i>
                                        {{ $overdueChange ?? '0' }}%</span> vs last month</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Monthly Consumption Trend</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <canvas id="consumptionChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Payment Status Distribution</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <canvas id="paymentStatusChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Payments Table -->
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Recent Payments</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Bill No</th>
                                                <th>Concessionaire</th>
                                                <th>Payment Date</th>
                                                <th>Amount Paid</th>
                                                <th>Payment Method</th>
                                                <th>Collected By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recentPayments as $payment)
                                                <tr>
                                                    <td>{{ $payment->bill->bill_no }}</td>
                                                    <td>{{ $payment->bill->concessionaire->full_name  }}</td>
                                                    <td>{{ $payment->payment_date }}</td>
                                                    <td>${{ number_format($payment->amount_paid, 2) }}</td>
                                                    <td>{{ $payment->payment_method }}</td>
                                                    <td>{{ $payment->collectedBy ? $payment->collectedBy->full_name : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-primary">View</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No recent payments found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('APP-SCRIPT')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Consumption Chart
            const consumptionChart = new Chart(document.getElementById('consumptionChart'), {
                type: 'line',
                data: {
                    labels: [
                        @foreach ($monthlyConsumption as $month)
                            '{{ $month->month }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Water Consumption (cu.m.)',
                        data: [
                            @foreach ($monthlyConsumption as $month)
                                {{ $month->total_consumption }},
                            @endforeach
                        ],
                        borderColor: '#4e73df',
                        fill: false,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Consumption (cu.m.)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });

            // Payment Status Chart
            const paymentStatusChart = new Chart(document.getElementById('paymentStatusChart'), {
                type: 'pie',
                data: {
                    labels: ['Paid', 'Pending', 'Overdue'],
                    datasets: [{
                        data: [{{ $paymentStatus['paid'] ?? 0 }},
                            {{ $paymentStatus['pending'] ?? 0 }},
                            {{ $paymentStatus['overdue'] ?? 0 }}
                        ],
                        backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
@endsection
