@extends('layouts.broker.app')
@section('content')
<style>
.chart {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 10px;
    background: #f1f3f4;
    padding: 14px 14px;
    height: 340px;
}
</style>

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Broker Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a Class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab"
                            aria-controls="carriers" aria-selected="true"
                            style="font-size: 15px;color: #000;font-weight:500">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="all-tab" data-bs-toggle="tab" href="#all" role="tab"
                            aria-controls="carriers" aria-selected="true"
                            style="font-size: 15px;color: #000;font-weight:500">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="open-tab" data-bs-toggle="tab" href="#open" role="tab"
                            aria-controls="carriers" aria-selected="true"
                            style="font-size: 15px;color: #000;font-weight:500">Open</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="delivered-tab" data-bs-toggle="tab" href="#delivered" role="tab"
                            aria-controls="carriers" aria-selected="true"
                            style="font-size: 15px;color: #000;font-weight:500">Delivered</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab"
                            aria-controls="customers" aria-selected="false"
                            style="font-size: 15px;color: #000;font-weight:500">Completed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="invoice-tab" data-bs-toggle="tab" href="#invoice" role="tab"
                            aria-controls="customers" aria-selected="false"
                            style="font-size: 15px;color: #000;font-weight:500">Invoice</a>
                    </li>
                </ul>

                <div class="tab-content col-12" id="myTabContent">
                    <div class="tab-pane fade show active" id="dashboard" ole="tabpanel"
                        aria-labelledby="customers-tab">
                         <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                        <div class="row dynamic-data">
                            <div class="col-lg-4 col-md-4">
                                <div class="card">
                                    @php
                                    $userLoads = \App\Models\Load::where('user_id', auth()->id())
                                    ->count();
                                    @endphp

                                    <div class="body xl-purple">
                                        <p class="mb-0 ">Total Load</p>
                                        <h4 class="mt-0 mb-0">{{ $userLoads }}</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="card">
                                    @php
                                    $userLoadStatusCount = \App\Models\Load::where('user_id', auth()->id())
                                    ->where('load_status', 'Open')
                                    ->count();
                                    @endphp
                                    <div class="body xl-blue">

                                        <p class="mb-0">Open Loads</p>
                                        <h4 class="mt-0 mb-0">{{ $userLoadStatusCount }}</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="card">
                                    @php
                                    $completedLoad = \App\Models\Load::where('user_id', auth()->id())
                                    ->where('load_status', 'Completed')
                                    ->count();
                                    @endphp

                                    <div class="body xl-green">
                                        <p class="mb-0 ">Completed Loads</p>
                                        <h4 class="mt-0 mb-0">{{ $completedLoad }}</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix dynamic-data">
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="header" style="background: #c7c7c6;">
                                        <h2 style="color: #000;"><b>Broker Chart</b></h2>
                                    </div>
                                    <div class="body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="chart">
                                                        <canvas id="totalLoadsChart"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="chart">
                                                        <canvas id="openLoadsChart"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                     <div class="chart">
                                                         <canvas id="completedLoadsChart"></canvas>
                                                     </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="all" ole="tabpanel" aria-labelledby="customers-tab">
                      <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Load #</th>
                                    <th>W/O #</th>
                                    <th>Customer #</th>
                                    <th>Load Create Date</th>
                                    <th>Shipper Date</th>
                                    <th>Del Date</th>
                                    <th>Carrier</th>
                                    <th>Pickup Location</th>
                                    <th>Unloading Location</th>

                                    <!-- <th>Status & RC</th> -->
                                    <!-- <th>PDF View</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($load as $loads)
                                <tr>
                                    <td class="dynamic-data">{{ $i++ }}</td>
                                    <td class="dynamic-data">{{ $loads->load_number }}</td>
                                    <td class="dynamic-data">{{ $loads->load_workorder }}</td>
                                    <td class="dynamic-data">{{ $loads->load_bill_to }}</td>
                                    <td class="dynamic-data">{{ $loads->created_at->format('Y-m-d') }}</td>
                                    <td class="dynamic-data">{{ $loads->load_shipper_appointment }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee_appointment }}</td>
                                    <td class="dynamic-data">{{ $loads->load_carrier }}</td>
                                    <td class="dynamic-data">{{ $loads->load_shipper_location }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="open" ole="tabpanel" aria-labelledby="customers-tab">
                      <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                        <table id="dataTableOpen" class="table table-bordered table-striped display">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Load#</th>
                                    <th>W/O#</th>
                                    <th>Customer#</th>
                                    <th>Load Create Date</th>
                                    <th>Shipper Date</th>
                                    <th>Del Date</th>
                                    <th>Carrier</th>
                                    <th>Pickup Location</th>
                                    <th>Unloading Location</th>
                                    <th>Final Del</th>
                                    <th>Load Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($load as $loads)
                                @if($loads->load_status == 'Open')
                                <tr>
                                    <td class="dynamic-data">{{ $i++ }}</td>
                                    <td class="dynamic-data">{{ $loads->load_number }}</td>
                                    <td class="dynamic-data">{{ $loads->load_workorder }}</td>
                                    <td class="dynamic-data">{{ $loads->load_bill_to }}</td>
                                    <td class="dynamic-data">{{ $loads->created_at->format('Y-m-d') }}</td>
                                    <td class="dynamic-data">{{ $loads->load_shipper_appointment }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee_appointment }}</td>
                                    <td class="dynamic-data">{{ $loads->load_carrier }}</td>
                                    <td class="dynamic-data">{{ $loads->load_shipper_location }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee_1 }}</td>
                                    <td class="dynamic-data">{{ $loads->load_status }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="delivered" ole="tabpanel" aria-labelledby="customers-tab">
                      <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                        <table id="dataTableDelivered" class="table table-bordered table-striped display">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Load #</th>
                                    <th>W/O #</th>
                                    <th>Carrier</th>
                                    <th>Shipper Date</th>
                                    <th>Load Create Date</th>
                                    <th>Del Date</th>
                                    <th>Customer #</th>
                                    <th>Pickup Location</th>
                                    <th>Unloading Location</th>
                                    <th>Final Del</th>
                                    <th>Load Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($load as $loads)
                                @if($loads->load_status == 'Deliverd')
                                <tr>
                                    <td class="dynamic-data">{{ $i++ }}</td>
                                    <td class="dynamic-data">{{ $loads->load_number }}</td>
                                    <td class="dynamic-data">{{ $loads->load_workorder }}</td>
                                    <td class="dynamic-data">{{ $loads->load_carrier }}</td>
                                    <td class="dynamic-data">{{ $loads->load_shipper_appointment }}</td>
                                    <td class="dynamic-data">{{ $loads->created_at->format('Y-m-d') }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee_appointment }}</td>
                                    <td class="dynamic-data">{{ $loads->load_bill_to }}</td>
                                    <td class="dynamic-data">{{ $loads->load_shipper_location }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee_1 }}</td>
                                    <td class="dynamic-data">{{ $loads->load_status }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="completed" ole="tabpanel" aria-labelledby="customers-tab">
                      <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                        <table id="dataTableDelivered" class="table table-bordered table-striped display">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Load #</th>
                                    <th>W/O #</th>
                                    <th>Carrier</th>
                                    <th>Shipper Date</th>
                                    <th>Load Create Date</th>
                                    <th>Del Date</th>
                                    <th>Customer #</th>
                                    <th>Pickup Location</th>
                                    <th>Unloading Location</th>
                                    <th>Final Del</th>
                                    <th>Load Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($load as $loads)
                                @if($loads->load_status == 'Completed')
                                <tr>
                                    <td class="dynamic-data">{{ $i++ }}</td>
                                    <td class="dynamic-data">{{ $loads->load_number }}</td>
                                    <td class="dynamic-data">{{ $loads->load_workorder }}</td>
                                    <td class="dynamic-data">{{ $loads->load_carrier }}</td>
                                    <td class="dynamic-data">{{ $loads->load_shipper_appointment }}</td>
                                    <td class="dynamic-data">{{ $loads->created_at->format('Y-m-d') }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee_appointment }}</td>
                                    <td class="dynamic-data">{{ $loads->load_bill_to }}</td>
                                    <td class="dynamic-data">{{ $loads->load_shipper_location }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee_1 }}</td>
                                    <td class="dynamic-data">{{ $loads->load_status }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="invoice" ole="tabpanel" aria-labelledby="customers-tab">
                      <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                        <table id="dataTableDelivered" class="table table-bordered table-striped display">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Load #</th>
                                    <th>W/O #</th>
                                    <th>Carrier</th>
                                    <th>Shipper Date</th>
                                    <th>Load Create Date</th>
                                    <th>Del Date</th>
                                    <th>Customer #</th>
                                    <th>Pickup Location</th>
                                    <th>Unloading Location</th>
                                    <th>Final Del</th>
                                    <th>Load Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($load as $loads)
                                @if($loads->invoice_status == 'Paid Record')
                                <tr>
                                    <td class="dynamic-data">{{ $i++ }}</td>
                                    <td class="dynamic-data">{{ $loads->load_number }}</td>
                                    <td class="dynamic-data">{{ $loads->load_workorder }}</td>
                                    <td class="dynamic-data">{{ $loads->load_carrier }}</td>
                                    <td class="dynamic-data">{{ $loads->load_shipper_appointment }}</td>
                                    <td class="dynamic-data">{{ $loads->created_at->format('Y-m-d') }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee_appointment }}</td>
                                    <td class="dynamic-data">{{ $loads->load_bill_to }}</td>
                                    <td class="dynamic-data">{{ $loads->load_shipper_location }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee }}</td>
                                    <td class="dynamic-data">{{ $loads->load_consignee_1 }}</td>
                                    <td class="dynamic-data">{{ $loads->load_status }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function renderCharts() {
        fetch('/fetch-load-data')
            .then(response => response.json())
            .then(data => {
                const labels = ['Open Loads', 'Completed Loads'];
                const openLoadsData = data.openLoadsCount;
                const completedLoadsData = data.completedLoadsCount;

                new Chart(document.getElementById('totalLoadsChart'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Loads',
                            backgroundColor: [
                                'rgba(70, 182, 254, 0.5)',
                                'rgba(4, 190, 91, 0.5)',
                            ],
                            data: [openLoadsData + completedLoadsData, 1],
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Total Loads'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                new Chart(document.getElementById('openLoadsChart'), {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            backgroundColor: [
                                'rgba(70, 182, 254, 0.5)',
                                'rgba(4, 190, 91, 0.5)',
                            ],
                            data: [openLoadsData, completedLoadsData],
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Open Loads vs Completed Loads'
                        }
                    }
                });

                new Chart(document.getElementById('completedLoadsChart'), {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            backgroundColor: [
                                'rgba(70, 182, 254, 0.5)',
                                'rgba(4, 190, 91, 0.5)',
                            ],
                            data: [completedLoadsData, openLoadsData],
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Completed Loads vs Open Loads'
                        }
                    }
                });
            });
    }

    renderCharts();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Retrieve the last active tab from local storage
        var lastActiveTab = localStorage.getItem('lastActiveTab');

        // If a last active tab is found, set it as active
        if (lastActiveTab) {
            $('#myTab a[href="' + lastActiveTab + '"]').tab('show');
        }

        // Store the active tab in local storage when a tab is clicked
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            var targetTab = e.target.getAttribute('href');
            localStorage.setItem('lastActiveTab', targetTab);
        });

        // Initialize DataTables for both tables
        $('#dataTableOpen').DataTable();
        $('#dataTableDelivered').DataTable();
    });
</script>
<script>
    function toggleBlur() {
        var dynamicCells = document.querySelectorAll('.dynamic-data');
        dynamicCells.forEach(function (cell) {
            var blurValue = cell.style.filter === 'blur(5px)' ? 'none' : 'blur(5px)';
            cell.style.filter = blurValue;
        });
    }

    // Add event listeners to all buttons with the class 'toggleBlurButton'
    document.querySelectorAll('.toggleBlurButton').forEach(function (button) {
        button.addEventListener('click', function () {
            toggleBlur();
        });
    });
</script>
@endsection