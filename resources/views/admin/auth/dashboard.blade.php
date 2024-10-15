@extends('layouts.admin.app')

@section('content')
@if(session('success'))
<div class="alert alert-success" id="successMessage">
    {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger" id="errorMessage">
    <script>
        alert("{{ session('error') }}");
    </script>
    {{ session('error') }}
</div>
@endif
<section class="content">
    <div class="body_scroll">
        <div class="block-header" style="padding: 16px 15px !important;">
            <h2>Dashboard </h2>
        </div>
        <div class="container-fluid p-0">
            <!-- Tab buttons -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab"
                        aria-controls="true" aria-selected="true"
                        style="font-size: 15px;color: #000;font-weight:500">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="all-tab" data-bs-toggle="tab" href="#all" role="tab" aria-controls="all"
                        aria-selected="false" style="font-size: 15px;color: #000;font-weight:500">All
                        Loads Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="delivered-tab" data-bs-toggle="tab" href="#delivered" role="tab"
                        aria-controls="delivered" aria-selected="false"
                        style="font-size: 15px;color: #000;font-weight:500">Delivered</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab"
                        aria-controls="completed" aria-selected="false"
                        style="font-size: 15px;color: #000;font-weight:500">Completed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="invoiced-tab" data-bs-toggle="tab" href="#invoiced" role="tab"
                        aria-controls="invoiced" aria-selected="false"
                        style="font-size: 15px;color: #000;font-weight:500">Invoiced</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="paid-tab" data-bs-toggle="tab" href="#paid" role="tab" aria-controls="paid"
                        aria-selected="false" style="font-size: 15px;color: #000;font-weight:500">Invoiced / Paid</a>
                </li>
            </ul>

            <!-- Tab content -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="body xl-blue">
                                    <h4 class="mt-0 mb-0">{{ $usersCount }}</h4>
                                    <p class="mb-0">Total Users</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="body xl-purple">
                                    <h4 class="mt-0 mb-0">{{ $loadCount }}</h4>
                                    <p class="mb-0 ">Total Loads</p>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Popular</strong> Categories</h2>
                                    <ul class="header-dropdown">
                                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                                data-toggle="dropdown" role="button" aria-haspopup="true"
                                                aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-right slideUp">
                                                <li><a href="javascript:void(0);">Edit</a></li>
                                                <li><a href="javascript:void(0);">Delete</a></li>
                                                <li><a href="javascript:void(0);">Report</a></li>
                                            </ul>
                                        </li>
                                        <li class="remove">
                                            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <canvas id="user_chart"></canvas>
                                            </div>
                                            <div class="col-sm-6">
                                                <canvas id="load_chart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="delivered-tab">
                    <!-- Delivered data table -->
                    <table class="table table-bordered table-responsive dataTable no-footer">
                        <thead>
                            <tr>
                                <th style="background: #555555 !important;color: #fff !important;">Sr No</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Agent Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Invoice #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Invoice Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">W/O #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Customer Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Office</th>
                                <th style="background: #555555 !important;color: #fff !important;">Manager</th>
                                <th style="background: #555555 !important;color: #fff !important;">Team Leader</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load Create Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Shipper Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Delivery date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Actual Delivery date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Carrier Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Pickup Location</th>
                                <th style="background: #555555 !important;color: #fff !important;">Unloading Location</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load Status</th>
                                <th style="background: #555555 !important;color: #fff !important;">Aging</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)

                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $s->load_number }}</td>
                                <td>{{ $s->user->name }}</td>
                                <td>{{ $s->invoice_number }}</td>
                                <td>{{ $s->invoice_date }}</td>
                                <td>{{ $s->load_workorder }}</td>
                                <td>{{ $s->load_bill_to }}</td>
                                <td>{{ $s->user->office }}</td>
                                <td>{{ $s->user->manager }}</td>
                                <td>{{ $s->user->team_lead }}</td>
                                <td>{{ $s->created_at->format('Y-m-d') }}</td>
                                    @php
                                       $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                <td>{{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('Y-m-d') : '' }}</td>
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp
                                <td> {{ isset($consignee_appointment[0]['appointment']) ? \Carbon\Carbon::parse($consignee_appointment[0]['appointment'])->format('Y-m-d') : '' }}
                                </td>
                                <td>
                                    {{ $s->load_actual_delivery_date }}</td>
                                <td>
                                    {{ $s->load_carrier }}</td>
                                @php
                                    $shipper_location = json_decode($s->load_shipper_location,true);
                                @endphp
                                <td>
                                    {{ $shipper_location[0]['location'] ?? '' }}
                                </td>
                                @php
                                    $consignee_loaction = json_decode($s->load_consignee_location,
                                true);
                                @endphp

                                <td>
                                    {{ $consignee_loaction[0]['location'] ?? '' }}
                                </td>
                                <td>
                                    {{ $s->load_status }}
                                </td>
                                <td>
                                    @if($s->load_status == 'Delivered' ||
                                    $s->invoice_status == 'Completed' )
                                    @php
                                    $deliveredDate = \Carbon\Carbon::parse($s->created_at);
                                    $currentDate = \Carbon\Carbon::now();
                                    $differenceInDays = $deliveredDate->diffInDays($currentDate);
                                    @endphp
                                    {{ $differenceInDays }} days
                                    @elseif($s->invoice_status == 'Completed' ||
                                    $s->load_status == 'Delivered')
                                    Aging Complete
                                    @endif
                                </td>


                                <!-- <td><button class="btn btn-sm btn-danger">Delete</button></td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
                    <!-- Delivered data table -->
                    <table id="dataTable" class="table table-bordered table-responsive dataTable no-footer">
                        <thead>
                            <tr>
                                <th style="background: #555555 !important;color: #fff !important;">Sr No</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Agent Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Invoice #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Invoice Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">W/O #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Customer Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Office</th>
                                <th style="background: #555555 !important;color: #fff !important;">Manager</th>
                                <th style="background: #555555 !important;color: #fff !important;">Team Leader</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load Create Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Shipper Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Delivery date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Actual Delivery date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Carrier Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Pickup Location</th>
                                <th style="background: #555555 !important;color: #fff !important;">Unloading Location</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load Status</th>
                                <th style="background: #555555 !important;color: #fff !important;">Aging</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)
                            @if($s->load_status == 'Delivered')

                            <tr>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $i++ }}
                                </td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_number }}</td>
                              
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->user->name }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->invoice_number }}</td> 
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->invoice_date }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->load_workorder }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->load_bill_to }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->office }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->manager }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->team_lead }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->created_at->format('Y-m-d') }}</td>
                                    @php
                                       $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('Y-m-d') : '' }}</td>
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;"> {{ isset($consignee_appointment[0]['appointment']) ? \Carbon\Carbon::parse($consignee_appointment[0]['appointment'])->format('Y-m-d') : '' }}
                                </td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_actual_delivery_date }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_carrier }}</td>
                                @php
                                    $shipper_location = json_decode($s->load_shipper_location,true);
                                @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $shipper_location[0]['location'] ?? '' }}
                                </td>
                                @php
                                    $consignee_loaction = json_decode($s->load_consignee_location,
                                true);
                                @endphp

                                <td style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $consignee_loaction[0]['location'] ?? '' }}

                                </td>

                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_status }}</td>

                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    @if($s->load_status == 'Delivered' || $s->invoice_status == 'Completed' )
                                    @php
                                    $deliveredDate = \Carbon\Carbon::parse($s->created_at);
                                    $currentDate = \Carbon\Carbon::now();
                                    $differenceInDays = $deliveredDate->diffInDays($currentDate);
                                    @endphp
                                    {{ $differenceInDays }} days
                                    @elseif($s->invoice_status == 'Completed' || $s->load_status == 'Delivered')
                                    Aging Complete
                                    @endif
                                </td>
                                
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    <!-- Completed data table -->
                    <table id="dataTable" class="table table-bordered table-responsive dataTable no-footer">
                        <thead>
                            <tr>
                                <th style="background: #555555 !important;color: #fff !important;">Sr No</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Agent Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Invoice #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Invoice Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">W/O #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Customer Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Office</th>
                                <th style="background: #555555 !important;color: #fff !important;">Manager</th>
                                <th style="background: #555555 !important;color: #fff !important;">Team Leader</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load Create Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Shipper Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Delivery date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Actual Delivery date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Carrier Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Pickup Location</th>
                                <th style="background: #555555 !important;color: #fff !important;">Unloading Location</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load Status</th>
                                <th style="background: #555555 !important;color: #fff !important;">Aging</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)
                            @if($s->load_status == 'Completed')

                            <tr>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $i++ }}
                                </td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_number }}</td>
                              
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->user->name }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->invoice_number }}</td> 
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->invoice_date }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->load_workorder }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->load_bill_to }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->office }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->manager }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->team_lead }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->created_at->format('Y-m-d') }}</td>
                                    @php
                                       $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('Y-m-d') : '' }}</td>
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;"> {{ isset($consignee_appointment[0]['appointment']) ? \Carbon\Carbon::parse($consignee_appointment[0]['appointment'])->format('Y-m-d') : '' }}
                                </td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_actual_delivery_date }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_carrier }}</td>
                                @php
                                    $shipper_location = json_decode($s->load_shipper_location,true);
                                @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $shipper_location[0]['location'] ?? '' }}
                                </td>
                                @php
                                    $consignee_loaction = json_decode($s->load_consignee_location,
                                true);
                                @endphp

                                <td style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $consignee_loaction[0]['location'] ?? '' }}

                                </td>

                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_status }}</td>

                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    @if($s->load_status == 'Delivered' || $s->invoice_status == 'Completed' )
                                    @php
                                    $deliveredDate = \Carbon\Carbon::parse($s->created_at);
                                    $currentDate = \Carbon\Carbon::now();
                                    $differenceInDays = $deliveredDate->diffInDays($currentDate);
                                    @endphp
                                    {{ $differenceInDays }} days
                                    @elseif($s->invoice_status == 'Completed' || $s->load_status == 'Delivered')
                                    Aging Complete
                                    @endif
                                </td>
                                
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="invoiced" role="tabpanel" aria-labelledby="invoiced-tab">
                    <!-- Invoiced data table -->
                    <table id="dataTable" class="table table-bordered table-responsive dataTable no-footer">
                        <thead>
                            <tr>
                                <th style="background: #555555 !important;color: #fff !important;">Sr No</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Agent Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Invoice #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Invoice Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">W/O #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Customer Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Office</th>
                                <th style="background: #555555 !important;color: #fff !important;">Manager</th>
                                <th style="background: #555555 !important;color: #fff !important;">Team Leader</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load Create Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Shipper Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Delivery date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Actual Delivery date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Carrier Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Pickup Location</th>
                                <th style="background: #555555 !important;color: #fff !important;">Unloading Location</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load Status</th>
                                <th style="background: #555555 !important;color: #fff !important;">Aging</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)
                            @if($s->invoice_status == 'Paid')

                            <tr>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $i++ }}
                                </td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_number }}</td>
                              
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->user->name }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->invoice_number }}</td> 
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->invoice_date }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->load_workorder }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->load_bill_to }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->office }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->manager }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->team_lead }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->created_at->format('Y-m-d') }}</td>
                                    @php
                                       $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('Y-m-d') : '' }}</td>
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;"> {{ isset($consignee_appointment[0]['appointment']) ? \Carbon\Carbon::parse($consignee_appointment[0]['appointment'])->format('Y-m-d') : '' }}
                                </td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_actual_delivery_date }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_carrier }}</td>
                                @php
                                    $shipper_location = json_decode($s->load_shipper_location,true);
                                @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $shipper_location[0]['location'] ?? '' }}
                                </td>
                                @php
                                    $consignee_loaction = json_decode($s->load_consignee_location,
                                true);
                                @endphp

                                <td style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $consignee_loaction[0]['location'] ?? '' }}

                                </td>

                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                @if($s->invoice_status == 'Paid')
                                    Invoiced
                                @endif
                                </td>

                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    @if($s->load_status == 'Delivered' || $s->invoice_status == 'Completed' )
                                    @php
                                    $deliveredDate = \Carbon\Carbon::parse($s->created_at);
                                    $currentDate = \Carbon\Carbon::now();
                                    $differenceInDays = $deliveredDate->diffInDays($currentDate);
                                    @endphp
                                    {{ $differenceInDays }} days
                                    @elseif($s->invoice_status == 'Completed' || $s->load_status == 'Delivered')
                                    Aging Complete
                                    @endif
                                </td>
                                
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                    <!-- Paid data table -->
                    <table id="dataTable" class="table table-bordered table-responsive dataTable no-footer">
                        <thead>
                            <tr>
                                <th style="background: #555555 !important;color: #fff !important;">Sr No</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Agent Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Invoice #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Invoice Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">W/O #</th>
                                <th style="background: #555555 !important;color: #fff !important;">Customer Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Office</th>
                                <th style="background: #555555 !important;color: #fff !important;">Manager</th>
                                <th style="background: #555555 !important;color: #fff !important;">Team Leader</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load Create Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Shipper Date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Delivery date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Actual Delivery date</th>
                                <th style="background: #555555 !important;color: #fff !important;">Carrier Name</th>
                                <th style="background: #555555 !important;color: #fff !important;">Pickup Location</th>
                                <th style="background: #555555 !important;color: #fff !important;">Unloading Location</th>
                                <th style="background: #555555 !important;color: #fff !important;">Load Status</th>
                                <th style="background: #555555 !important;color: #fff !important;">Aging</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)
                            @if($s->invoice_status == 'Paid Record')

                            <tr>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $i++ }}
                                </td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_number }}</td>
                              
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->user->name }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->invoice_number }}</td> 
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->invoice_date }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->load_workorder }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                {{ $s->load_bill_to }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->office }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->manager }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->user->team_lead }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->created_at->format('Y-m-d') }}</td>
                                    @php
                                       $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('Y-m-d') : '' }}</td>
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;"> {{ isset($consignee_appointment[0]['appointment']) ? \Carbon\Carbon::parse($consignee_appointment[0]['appointment'])->format('Y-m-d') : '' }}
                                </td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_actual_delivery_date }}</td>
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_carrier }}</td>
                                @php
                                    $shipper_location = json_decode($s->load_shipper_location,true);
                                @endphp
                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    {{ $shipper_location[0]['location'] ?? '' }}
                                </td>
                                @php
                                    $consignee_loaction = json_decode($s->load_consignee_location,
                                true);
                                @endphp

                                <td style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $consignee_loaction[0]['location'] ?? '' }}

                                </td>

                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    @if($s->invoice_status)
                                        Invoiced / Paid
                                    @endif
                                </td>

                                <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                    @if($s->load_status == 'Delivered' || $s->invoice_status == 'Completed' )
                                    @php
                                    $deliveredDate = \Carbon\Carbon::parse($s->created_at);
                                    $currentDate = \Carbon\Carbon::now();
                                    $differenceInDays = $deliveredDate->diffInDays($currentDate);
                                    @endphp
                                    {{ $differenceInDays }} days
                                    @elseif($s->invoice_status == 'Completed' || $s->load_status == 'Delivered')
                                    Aging Complete
                                    @endif
                                </td>
                                
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('user_chart').getContext('2d');
    var userChart = new Chart(ctx, {
        type: 'bar',

        data: {
            labels: {
                !!json_encode($labels) !!
            },
            datasets: {
                !!json_encode($datasets) !!
            },
        },
    });
</script>
<script>
    var ctx = document.getElementById('load_chart').getContext('2d');
    var userChart = new Chart(ctx, {
        type: 'bar',

        data: {
            labels: {
                !!json_encode($labels2) !!
            },
            datasets: {
                !!json_encode($datasets2) !!
            },
        },
    });
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JavaScript library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
</script>

<script>
    $(document).ready(function () {
        // Initialize Bootstrap tabs
        var tabTriggerEl = document.getElementById('myTab');
        var tab = new bootstrap.Tab(tabTriggerEl);
        tab.show();
    });
</script>

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
@endsection