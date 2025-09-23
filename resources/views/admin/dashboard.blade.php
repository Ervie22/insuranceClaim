@extends('layouts.app')

@section('content')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    body {
        /* background-color: #0f172a; */
        color: #0f172a;
    }

    .chart-card {
        background: #eee;
        border-radius: 15px;
        /* padding: 20px; */
        /* box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3); */
    }


    .card {
        /* background-color: #1e293b; */
        border: none;
        border-radius: 12px;
        padding: 15px;
        color: #1e293b;
    }

    .card h5 {
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .chart-sm {
        max-width: 120px;
        max-height: 120px;
        margin: auto;
    }
</style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <!-- Claims -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h6>Claims</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <p class="text-muted">Total</p>
                                <h5 class="card-title mb-0" style="color:#00A6D9;">
                                    329
                                </h5>
                            </div>
                            <div class="col-3">
                                <p class="text-muted">Pending</p>
                                <h5 class="card-title mb-0" style="color:#00A6D9;">
                                    78
                                </h5>
                            </div>
                            <div class="col-3">
                                <p class="text-muted">Denied</p>
                                <h5 class="card-title mb-0" style="color:#00A6D9;">
                                    45
                                </h5>
                            </div>
                            <div class="col-3">
                                <p class="text-muted">Paid</p>
                                <h5 class="card-title mb-0" style="color:#00A6D9;">
                                    206
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header p-0 bg-white">
                                        <p>Claims By Payer</p>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="claimsByPayer" class="chart-sm"></canvas>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header p-0 bg-white">
                                        <p>Balance Payones</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-card">
                                            <canvas id="balanceChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header p-0 bg-white">

                                    </div>
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

            <!-- Payments -->
            <div class="col-md-4">
                <div class="card">
                    <h5>Payments</h5>
                    <p>Total Payments: <strong>1,120,450</strong></p>
                    <canvas id="paymentsByMethod" class="chart-sm"></canvas>
                </div>
            </div>

            <!-- News & Updates -->
            <div class="col-md-3">
                <div class="card">
                    <h5>News & Updates</h5>
                    <ul>
                        <li>New billing guidelines effective Apr</li>
                        <li>Provider meeting scheduled May 10</li>
                        <li>Update on insurance agreements</li>
                    </ul>
                </div>
            </div>

            <!-- Providers -->
            <div class="col-md-3">
                <div class="card">
                    <h5>Provider</h5>
                    <p>47 Payments</p>
                    <p>Received: 332,600</p>
                    <canvas id="providerPayments" class="chart-sm"></canvas>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-2">
            <!-- Reports -->
            <div class="col-md-4">
                <div class="card">
                    <h5>Reports</h5>
                    <p>Total Revenue: 3055K</p>
                    <p>Claims Denial Rate: 14%</p>
                    <canvas id="reportsChart" class="chart-sm"></canvas>
                </div>
            </div>

            <!-- Users -->
            <div class="col-md-4">
                <div class="card">
                    <h5>Users</h5>
                    <p>Active Users: 5</p>
                    <ul>
                        <li>Janine - 06:05 AM</li>
                        <li>Processing Claim - 08:30 AM</li>
                        <li>Sarah Wilson - 07:45 AM</li>
                    </ul>
                </div>
            </div>

            <!-- Provider -->
            <div class="col-md-4">
                <div class="card">
                    <h5>Provider</h5>
                    <p>Payments: $22,000</p>
                    <p>Received</p>
                    <canvas id="providerChart" class="chart-sm"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- bar chart payones script balance payer starts-->
    <script>
        const ctx = document.getElementById('balanceChart').getContext('2d');
        const balanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Payments',
                    data: [35, 45, 69, 40, 12], // sample data
                    backgroundColor: [
                        '#4cc9f0',
                        '#4895ef',
                        '#4361ee',
                        '#3f37c9',
                        '#3a0ca3'
                    ],
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#ccc'
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        ticks: {
                            color: '#ccc'
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    }
                }
            }
        });
    </script>
    <!-- bar chart payones script balance payer ends-->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // ✅ Sample data (not from DB)
            const labels = ["18-09-2025", "19-09-2025", "20-09-2025", "21-09-2025", "22-09-2025"];
            const data = [5, 8, 3, 10, 6]; // number of logs each day

            const ctx = document.getElementById('logsChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Logs per Day',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    <script>
        // Sample Doughnut Chart - Claims
        new Chart(document.getElementById("claimsByPayer"), {
            type: "doughnut",
            data: {

                datasets: [{
                    data: [130, 28, 171],
                    backgroundColor: ["#3b82f6", "#6366f1", "#06b6d4"]
                }]
            }
        });

        // Payments by Method
        new Chart(document.getElementById("paymentsByMethod"), {
            type: "doughnut",
            data: {
                labels: ["EFT", "Checks", "Med"],
                datasets: [{
                    data: [500, 300, 320],
                    backgroundColor: ["#06b6d4", "#3b82f6", "#6366f1"]
                }]
            }
        });

        // Reports Pie
        new Chart(document.getElementById("reportsChart"), {
            type: "pie",
            data: {
                labels: ["Ceding Error", "Missing Info", "Other"],
                datasets: [{
                    data: [50, 30, 20],
                    backgroundColor: ["#3b82f6", "#6366f1", "#06b6d4"]
                }]
            }
        });

        // Provider Payments
        new Chart(document.getElementById("providerPayments"), {
            type: "bar",
            data: {
                labels: ["Payments", "Received"],
                datasets: [{
                    data: [47, 332600],
                    backgroundColor: ["#3b82f6", "#06b6d4"]
                }]
            }
        });

        // Provider Extra Chart
        new Chart(document.getElementById("providerChart"), {
            type: "bar",
            data: {
                labels: ["Payments", "Received"],
                datasets: [{
                    data: [22000, 18000],
                    backgroundColor: ["#6366f1", "#06b6d4"]
                }]
            }
        });
    </script>
    @endsection