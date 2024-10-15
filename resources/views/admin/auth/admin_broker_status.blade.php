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
<style>
        table.dataTable thead>tr>th.sorting_asc,
    table.dataTable thead>tr>th.sorting_desc,
    table.dataTable thead>tr>th.sorting,
    table.dataTable thead>tr>td.sorting_asc,
    table.dataTable thead>tr>td.sorting_desc,
    table.dataTable thead>tr>td.sorting {
        padding: 13px 00 13px 6px;
    font-size: 13px;
    text-align: center;
    background-image: unset !important;
    }
</style>
<section class="content">
    <div class="body_scroll">
        <div class="block-header" style="padding: 16px 15px !important">
                    <h2>Account Manager</h2>
        </div>

        <div class="container-fluid p-0">
            <!-- Tab buttons -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab"
                        aria-controls="all" aria-selected="true" style="font-size: 15px;color: #000;font-weight:500">All Loads Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="delivered-tab" data-bs-toggle="tab" href="#delivered" role="tab"
                        aria-controls="delivered" aria-selected="false" style="font-size: 15px;color: #000;font-weight:500">Delivered</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab"
                        aria-controls="completed" aria-selected="false" style="font-size: 15px;color: #000;font-weight:500">Completed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="invoiced-tab" data-bs-toggle="tab" href="#invoiced" role="tab"
                        aria-controls="invoiced" aria-selected="false" style="font-size: 15px;color: #000;font-weight:500">Invoiced</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="paid-tab" data-bs-toggle="tab" href="#paid" role="tab" aria-controls="paid"
                        aria-selected="false" style="font-size: 15px;color: #000;font-weight:500">Invoiced / Paid</a>
                </li>
            </ul>

            <!-- Tab content -->
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="delivered-tab">
                <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
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
                                <td class="dynamic-data">{{ $i++ }}</td>
                                <td class="dynamic-data">{{ $s->load_number }}</td>
                                <td class="dynamic-data">{{ $s->user->name }}</td>
                                <td class="dynamic-data">{{ $s->invoice_number }}</td>
                                <td class="dynamic-data">{{ $s->invoice_date }}</td>
                                <td class="dynamic-data">{{ $s->load_workorder }}</td>
                                <td class="dynamic-data">{{ $s->load_bill_to }}</td>
                                <td class="dynamic-data">{{ $s->user->office }}</td>
                                <td class="dynamic-data">{{ $s->user->manager }}</td>
                                <td class="dynamic-data">{{ $s->user->team_lead }}</td>
                                <td class="dynamic-data">{{ $s->created_at->format('Y-m-d') }}</td>
                                    @php
                                       $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                <td class="dynamic-data">{{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('Y-m-d') : '' }}</td>
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp
                                <td class="dynamic-data"> {{ isset($consignee_appointment[0]['appointment']) ? \Carbon\Carbon::parse($consignee_appointment[0]['appointment'])->format('Y-m-d') : '' }}
                                </td>
                                <td class="dynamic-data">
                                    {{ $s->load_actual_delivery_date }}</td>
                                <td class="dynamic-data">
                                    {{ $s->load_carrier }}</td>
                                @php
                                    $shipper_location = json_decode($s->load_shipper_location,true);
                                @endphp
                                <td class="dynamic-data">
                                    {{ $shipper_location[0]['location'] ?? '' }}
                                </td>
                                @php
                                    $consignee_loaction = json_decode($s->load_consignee_location,
                                true);
                                @endphp

                                <td class="dynamic-data">
                                    {{ $consignee_loaction[0]['location'] ?? '' }}
                                </td>
                                <td class="dynamic-data">
                                    {{ $s->load_status }}
                                </td>
                                <td class="dynamic-data">
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
                <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
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
                            @if($s->load_status == 'Delivered')
                            <tr>
                                <td class="dynamic-data">{{ $i++ }}</td>
                                <td class="dynamic-data">{{ $s->load_number }}</td>
                                <td class="dynamic-data">{{ $s->user->name }}</td>
                                <td class="dynamic-data">{{ $s->invoice_number }}</td>
                                <td class="dynamic-data">{{ $s->invoice_date }}</td>
                                <td class="dynamic-data">{{ $s->load_workorder }}</td>
                                <td class="dynamic-data">{{ $s->load_bill_to }}</td>
                                <td class="dynamic-data">{{ $s->user->office }}</td>
                                <td class="dynamic-data">{{ $s->user->manager }}</td>
                                <td class="dynamic-data">{{ $s->user->team_lead }}</td>
                                <td class="dynamic-data">{{ $s->created_at->format('Y-m-d') }}</td>
                                    @php
                                       $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                <td class="dynamic-data">{{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('Y-m-d') : '' }}</td>
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp
                                <td class="dynamic-data"> {{ isset($consignee_appointment[0]['appointment']) ? \Carbon\Carbon::parse($consignee_appointment[0]['appointment'])->format('Y-m-d') : '' }}
                                </td>
                                <td class="dynamic-data">
                                    {{ $s->load_actual_delivery_date }}</td>
                                <td class="dynamic-data">
                                    {{ $s->load_carrier }}</td>
                                @php
                                    $shipper_location = json_decode($s->load_shipper_location,true);
                                @endphp
                                <td class="dynamic-data">
                                    {{ $shipper_location[0]['location'] ?? '' }}
                                </td>
                                @php
                                    $consignee_loaction = json_decode($s->load_consignee_location,
                                true);
                                @endphp

                                <td class="dynamic-data">
                                    {{ $consignee_loaction[0]['location'] ?? '' }}
                                </td>
                                <td class="dynamic-data">
                                    {{ $s->load_status }}
                                </td>
                                <td class="dynamic-data">
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
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                    <!-- Completed data table -->
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
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)
                            @if($s->load_status == 'Completed')
                            <tr>
                                <td class="dynamic-data">{{ $i++ }}</td>
                                <td class="dynamic-data">{{ $s->load_number }}</td>
                                <td class="dynamic-data">{{ $s->user->name }}</td>
                                <td class="dynamic-data">{{ $s->invoice_number }}</td>
                                <td class="dynamic-data">{{ $s->invoice_date }}</td>
                                <td class="dynamic-data">{{ $s->load_workorder }}</td>
                                <td class="dynamic-data">{{ $s->load_bill_to }}</td>
                                <td class="dynamic-data">{{ $s->user->office }}</td>
                                <td class="dynamic-data">{{ $s->user->manager }}</td>
                                <td class="dynamic-data">{{ $s->user->team_lead }}</td>
                                <td class="dynamic-data">{{ $s->created_at->format('Y-m-d') }}</td>
                                    @php
                                       $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                <td class="dynamic-data">{{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('Y-m-d') : '' }}</td>
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp
                                <td class="dynamic-data"> {{ isset($consignee_appointment[0]['appointment']) ? \Carbon\Carbon::parse($consignee_appointment[0]['appointment'])->format('Y-m-d') : '' }}
                                </td>
                                <td class="dynamic-data">
                                    {{ $s->load_actual_delivery_date }}</td>
                                <td class="dynamic-data">
                                    {{ $s->load_carrier }}</td>
                                @php
                                    $shipper_location = json_decode($s->load_shipper_location,true);
                                @endphp
                                <td class="dynamic-data">
                                    {{ $shipper_location[0]['location'] ?? '' }}
                                </td>
                                @php
                                    $consignee_loaction = json_decode($s->load_consignee_location,
                                true);
                                @endphp

                                <td class="dynamic-data">
                                    {{ $consignee_loaction[0]['location'] ?? '' }}
                                </td>
                                <td class="dynamic-data">
                                    {{ $s->load_status }}
                                </td>
                                <!-- <td><button class="btn btn-sm btn-danger">Delete</button></td> -->
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="invoiced" role="tabpanel" aria-labelledby="invoiced-tab">
                <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                    <!-- Invoiced data table -->
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
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)
                            @if($s->invoice_status == 'Paid')
                            <tr>
                                <td class="dynamic-data">{{ $i++ }}</td>
                                <td class="dynamic-data">{{ $s->load_number }}</td>
                                <td class="dynamic-data">{{ $s->user->name }}</td>
                                <td class="dynamic-data">{{ $s->invoice_number }}</td>
                                <td class="dynamic-data">{{ $s->invoice_date }}</td>
                                <td class="dynamic-data">{{ $s->load_workorder }}</td>
                                <td class="dynamic-data">{{ $s->load_bill_to }}</td>
                                <td class="dynamic-data">{{ $s->user->office }}</td>
                                <td class="dynamic-data">{{ $s->user->manager }}</td>
                                <td class="dynamic-data">{{ $s->user->team_lead }}</td>
                                <td class="dynamic-data">{{ $s->created_at->format('Y-m-d') }}</td>
                                    @php
                                       $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                <td class="dynamic-data">{{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('Y-m-d') : '' }}</td>
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp
                                <td class="dynamic-data"> {{ isset($consignee_appointment[0]['appointment']) ? \Carbon\Carbon::parse($consignee_appointment[0]['appointment'])->format('Y-m-d') : '' }}
                                </td>
                                <td class="dynamic-data">
                                    {{ $s->load_actual_delivery_date }}</td>
                                <td class="dynamic-data">
                                    {{ $s->load_carrier }}</td>
                                @php
                                    $shipper_location = json_decode($s->load_shipper_location,true);
                                @endphp
                                <td class="dynamic-data">
                                    {{ $shipper_location[0]['location'] ?? '' }}
                                </td>
                                @php
                                    $consignee_loaction = json_decode($s->load_consignee_location,
                                true);
                                @endphp

                                <td class="dynamic-data">
                                    {{ $consignee_loaction[0]['location'] ?? '' }}
                                </td>
                                <td class="dynamic-data">
                                    @if($s->invoice_status == 'Paid') 
                                        Invoiced
                                    @endif
                                </td>
                                <!-- <td><button class="btn btn-sm btn-danger">Delete</button></td> -->
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                    <!-- Paid data table -->
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
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)
                            @if($s->invoice_status == 'Paid Record')
                            <tr>
                                <td class="dynamic-data">{{ $i++ }}</td>
                                <td class="dynamic-data">{{ $s->load_number }}</td>
                                <td class="dynamic-data">{{ $s->user->name }}</td>
                                <td class="dynamic-data">{{ $s->invoice_number }}</td>
                                <td class="dynamic-data">{{ $s->invoice_date }}</td>
                                <td class="dynamic-data">{{ $s->load_workorder }}</td>
                                <td class="dynamic-data">{{ $s->load_bill_to }}</td>
                                <td class="dynamic-data">{{ $s->user->office }}</td>
                                <td class="dynamic-data">{{ $s->user->manager }}</td>
                                <td class="dynamic-data">{{ $s->user->team_lead }}</td>
                                <td class="dynamic-data">{{ $s->created_at->format('Y-m-d') }}</td>
                                    @php
                                       $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                <td class="dynamic-data">{{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('Y-m-d') : '' }}</td>
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp
                                <td class="dynamic-data"> {{ isset($consignee_appointment[0]['appointment']) ? \Carbon\Carbon::parse($consignee_appointment[0]['appointment'])->format('Y-m-d') : '' }}
                                </td>
                                <td class="dynamic-data">
                                    {{ $s->load_actual_delivery_date }}</td>
                                <td class="dynamic-data">
                                    {{ $s->load_carrier }}</td>
                                @php
                                    $shipper_location = json_decode($s->load_shipper_location,true);
                                @endphp
                                <td class="dynamic-data">
                                    {{ $shipper_location[0]['location'] ?? '' }}
                                </td>
                                @php
                                    $consignee_loaction = json_decode($s->load_consignee_location,
                                true);
                                @endphp

                                <td class="dynamic-data">
                                    {{ $consignee_loaction[0]['location'] ?? '' }}
                                </td>
                                <td class="dynamic-data">
                                    @if($s->invoice_status == 'Paid Record') 
                                     Invoiced / Paid
                                    @endif
                                </td>
                                <!-- <td><button class="btn btn-sm btn-danger">Delete</button></td> -->
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section> <!-- Bootstrap CSS -->
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
    // Wait for the document to be fully loaded
    document.addEventListener("DOMContentLoaded", function () {
        // Get all anchor tags in the document
        var anchorTags = document.querySelectorAll("a");

        // Loop through each anchor tag
        anchorTags.forEach(function (anchor) {
            // Set text decoration to unset
            anchor.style.textDecoration = "unset";
        });
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