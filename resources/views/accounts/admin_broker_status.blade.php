@extends('layouts.accounts.app')
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
        <div class="block-header">
            <h2>Status Data</h2>
        </div>

        <div class="container-fluid">
            <!-- Tab buttons -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab"
                        aria-controls="all" aria-selected="true" style="font-size: 15px;color: #000;font-weight:500">All
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

                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="delivered-tab">
                <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                    <!-- Delivered data table -->
                    <table class="custom-table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th style="display:none">Equipment Type</th>
                                <th>Load #</th>
                                <th>Agent Name</th>
                                <th>W/O #</th>
                                <th>Customer Name</th>
                                <th>Office</th>
                                <th>Manager</th>
                                <th>Team Leader</th>
                                <th>Load Create Date</th>
                                <th>Shipper Date</th>
                                <th>Delivery date</th>
                                <th>Actual Delivery date</th>
                                <th>Carrier Name</th>
                                <th>Pickup Location</th>
                                <th>Unloading Location</th>
                                <th>Load Status</th>
                                <th>Aging</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)

                            <tr>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $i++ }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important; display:none">{{ $s->load_equipment_type }}</td>
                                
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    <a href="{{ route('accounting.load.edit', $s->id) }}">{{ $s->load_number }}
                                    </a>
                                </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->name }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_workorder }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_bill_to }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->office }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->manager }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->team_lead }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->created_at }}</td>
                                    @php
                                        $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('y-m-d') : '' }}
                                    </td>

                               
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp

                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $consignee_appointment[0]['appointment'] ?? '' }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_actual_delivery_date }}</td>
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_carrier }}</td>

                                    @php
                                        $shipper_location = json_decode($s->load_shipper_location, true); 
                                    @endphp
                                    <td class="dynamic-data"
                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ $shipper_location[0]['location'] ?? '' }}
                                    </td>
                                    @php
                                        $consignee_loaction = json_decode($s->load_consignee_location, true);
                                    @endphp
                                    
                                    <td class="dynamic-data"
                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ $consignee_loaction[0]['location'] ?? '' }}

                                    </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_status }}</td>
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        @php
                                                        $deliveredDate = \Carbon\Carbon::parse($s->created_at);
                                                        $currentDate = \Carbon\Carbon::now();
                                                        $differenceInDays = $deliveredDate->diffInDays($currentDate);
                                                        @endphp
                                                        {{ $differenceInDays }} days
                                                    </td>
                                                    <td class="dynamic-data">
                                    <a href="{{ route('accounting.load.edit', ['id' => $s->id]) }}" title="Edit Load" style="color:#0DCAF0;text-align:center;display: block; font-size: 17px;font-size: 18px;">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </td>

                                <!-- <td style="padding: 7px 10px !important; vertical-align: middle !important;"><button class="btn btn-sm btn-danger">Delete</button></td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
                <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                    <!-- Delivered data table -->
                    
                    <table class="custom-table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Load #</th>
                                <th>Agent Name</th>
                                <th>W/O #</th>
                                <th>Customer Name</th>
                                <th>Office</th>
                                <th>Manager</th>
                                <th>Team Leader</th>
                                <th>Load Create Date</th>
                                <th>Shipper Date</th>
                                <th>Delivery date</th>
                                <th>Actual Delivery date</th>
                                <th>Carrier Name</th>
                                <th>Pickup Location</th>
                                <th>Unloading Location</th>
                                <th>Load Status</th>
                                <th>Aging</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)
                            @if($s->load_status == 'Delivered')
                            <tr>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $i++ }}
                                </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    <a href="{{ route('accounting.load.edit', $s->id) }}">{{ $s->load_number }}
                                    </a>
                                </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->name }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_workorder }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_bill_to }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->office }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->manager }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->team_lead }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->created_at }}</td>
                                    @php
                                        $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('y-m-d') : '' }}
                                    </td>

                               
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp

                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $consignee_appointment[0]['appointment'] ?? '' }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_actual_delivery_date }}</td>
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_carrier }}</td>

                                    @php
                                        $shipper_location = json_decode($s->load_shipper_location, true); 
                                    @endphp
                                    <td class="dynamic-data"
                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ $shipper_location[0]['location'] ?? '' }}
                                    </td>
                                    @php
                                        $consignee_loaction = json_decode($s->load_consignee_location, true);
                                    @endphp
                                    
                                    <td class="dynamic-data"
                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ $consignee_loaction[0]['location'] ?? '' }}

                                    </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_status }}</td>
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        @php
                                                        $deliveredDate = \Carbon\Carbon::parse($s->created_at);
                                                        $currentDate = \Carbon\Carbon::now();
                                                        $differenceInDays = $deliveredDate->diffInDays($currentDate);
                                                        @endphp
                                                        {{ $differenceInDays }} days
                                                    </td>
                                                    <td class="dynamic-data">
                                    <a href="{{ route('accounting.load.edit', ['id' => $s->id]) }}" title="Edit Load" style="color:#0DCAF0;text-align:center;display: block; font-size: 17px;">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </td>

                                <!-- <td style="padding: 7px 10px !important; vertical-align: middle !important;"><button class="btn btn-sm btn-danger">Delete</button></td> -->
                            </tr>
                            @endif

                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                    <!-- Completed data table -->
                    <table class="custom-table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Load #</th>
                                <th>Agent Name</th>
                                <th>W/O #</th>
                                <th>Customer Name</th>
                                <th>Office</th>
                                <th>Manager</th>
                                <th>Team Leader</th>
                                <th>Load Create Date</th>
                                <th>Shipper Date</th>
                                <th>Delivery date</th>
                                <th>Actual Delivery date</th>
                                <th>Carrier Name</th>
                                <th>Pickup Location</th>
                                <th>Unloading Location</th>
                                <th>Load Status</th>
                                <th>Aging</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)
                            @if($s->load_status == 'Completed')
                            <tr>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $i++ }}
                                </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    <a href="{{ route('accounting.load.edit', $s->id) }}">{{ $s->load_number }}
                                    </a>
                                </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->name }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_workorder }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_bill_to }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->office }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->manager }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->team_lead }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->created_at }}</td>
                                    @php
                                        $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('y-m-d') : '' }}
                                    </td>

                               
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp

                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $consignee_appointment[0]['appointment'] ?? '' }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_actual_delivery_date }}</td>
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_carrier }}</td>

                                    @php
                                        $shipper_location = json_decode($s->load_shipper_location, true); 
                                    @endphp
                                    <td class="dynamic-data"
                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ $shipper_location[0]['location'] ?? '' }}
                                    </td>
                                    @php
                                        $consignee_loaction = json_decode($s->load_consignee_location, true);
                                    @endphp
                                    
                                    <td class="dynamic-data"
                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ $consignee_loaction[0]['location'] ?? '' }}

                                    </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_status }}</td>
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        @php
                                                        $deliveredDate = \Carbon\Carbon::parse($s->created_at);
                                                        $currentDate = \Carbon\Carbon::now();
                                                        $differenceInDays = $deliveredDate->diffInDays($currentDate);
                                                        @endphp
                                                        {{ $differenceInDays }} days
                                                    </td>
                                                    <td class="dynamic-data">
                                    <a href="{{ route('accounting.load.edit', ['id' => $s->id]) }}" title="Edit Load" style="color:#0DCAF0;text-align:center;display: block; font-size: 17px;">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </td>

                                <!-- <td style="padding: 7px 10px !important; vertical-align: middle !important;"><button class="btn btn-sm btn-danger">Delete</button></td> -->
                            </tr>
                            @endif

                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="invoiced" role="tabpanel" aria-labelledby="invoiced-tab">
                <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                    <!-- Invoiced data table -->
                    <table class="custom-table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Load #</th>
                                <th>Agent Name</th>
                                <th>Invoice #</th>
                                <th>Invoice Date</th>
                                <th>W/O #</th>
                                <th>Customer Name</th>
                                <th>Office</th>
                                <th>Manager</th>
                                <th>Team Leader</th>
                                <th>Load Create Date</th>
                                <th>Shipper Date</th>
                                <th>Delivery date</th>
                                <th>Actual Delivery date</th>
                                <th>Carrier Name</th>
                                <th>Pickup Location</th>
                                <th>Unloading Location</th>
                                <th>Load Status</th>
                                <th>Aging</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)
                            @if($s->invoice_status == 'Paid' && $s->invoice_number)
                            <tr>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $i++ }}
                                </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    <a href="{{ route('accounting.load.edit', $s->id) }}">{{ $s->load_number }}
                                    </a>
                                </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->name }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->invoice_number }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ date('d-m-Y', strtotime($s->invoice_date)) }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_workorder }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_bill_to }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->office }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->manager }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->team_lead }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->created_at }}</td>
                                    @php
                                        $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('y-m-d') : '' }}
                                    </td>

                               
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp

                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $consignee_appointment[0]['appointment'] ?? '' }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_actual_delivery_date }}</td>
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_carrier }}</td>

                                    @php
                                        $shipper_location = json_decode($s->load_shipper_location, true); 
                                    @endphp
                                    <td class="dynamic-data"
                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ $shipper_location[0]['location'] ?? '' }}
                                    </td>
                                    @php
                                        $consignee_loaction = json_decode($s->load_consignee_location, true);
                                    @endphp
                                    
                                    <td class="dynamic-data"
                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ $consignee_loaction[0]['location'] ?? '' }}

                                    </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                @if($s->invoice_status)    
                                    Invoiced
                                @endif</td>
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        @php
                                                        $deliveredDate = \Carbon\Carbon::parse($s->created_at);
                                                        $currentDate = \Carbon\Carbon::now();
                                                        $differenceInDays = $deliveredDate->diffInDays($currentDate);
                                                        @endphp
                                                        {{ $differenceInDays }} days
                                                    </td>
                                                    <td class="dynamic-data">
                                    <a href="{{ route('accounting.load.edit', ['id' => $s->id]) }}" title="Edit Load" style="color:#0DCAF0;text-align:center;display: block; font-size: 17px;">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </td>

                                <!-- <td style="padding: 7px 10px !important; vertical-align: middle !important;"><button class="btn btn-sm btn-danger">Delete</button></td> -->
                            </tr>
                            @endif

                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                    <!-- Paid data table -->
                    <table class="custom-table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Load #</th>
                                <th>Agent Name</th>
                                <th>Invoice #</th>
                                <th>Invoice Date</th>
                                <th>W/O #</th>
                                <th>Customer Name</th>
                                <th>Office</th>
                                <th>Manager</th>
                                <th>Team Leader</th>
                                <th>Load Create Date</th>
                                <th>Shipper Date</th>
                                <th>Delivery date</th>
                                <th>Actual Delivery date</th>
                                <th>Carrier Name</th>
                                <th>Pickup Location</th>
                                <th>Unloading Location</th>
                                <th>Load Status</th>
                                <th>Aging</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($status as $s)
                            @if($s->invoice_status == 'Paid Record' && $s->invoice_number)
                            <tr>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $i++ }}
                                </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    <a href="{{ route('accounting.load.edit', $s->id) }}">{{ $s->load_number }}
                                    </a>
                                </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->name }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->invoice_number }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ date('d-m-Y', strtotime($s->invoice_date)) }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_workorder }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_bill_to }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->office }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->manager }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->user->team_lead }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->created_at }}</td>
                                    @php
                                        $shipper_appointment = json_decode($s->load_shipper_appointment,true);
                                    @endphp
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('y-m-d') : '' }}
                                    </td>

                               
                                    @php
                                        $consignee_appointment = json_decode($s->load_consignee_appointment,true);
                                    @endphp

                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $consignee_appointment[0]['appointment'] ?? '' }}</td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                    {{ $s->load_actual_delivery_date }}</td>
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">{{ $s->load_carrier }}</td>

                                    @php
                                        $shipper_location = json_decode($s->load_shipper_location, true); 
                                    @endphp
                                    <td class="dynamic-data"
                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ $shipper_location[0]['location'] ?? '' }}
                                    </td>
                                    @php
                                        $consignee_loaction = json_decode($s->load_consignee_location, true);
                                    @endphp
                                    
                                    <td class="dynamic-data"
                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                        {{ $consignee_loaction[0]['location'] ?? '' }}

                                    </td>
                                <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                @if($s->invoice_status)    
                                    Invoiced / Paid
                                @endif
                                </td>
                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        @php
                                                        $deliveredDate = \Carbon\Carbon::parse($s->created_at);
                                                        $currentDate = \Carbon\Carbon::now();
                                                        $differenceInDays = $deliveredDate->diffInDays($currentDate);
                                                        @endphp
                                                        {{ $differenceInDays }} days
                                                    </td>
                                                    <td class="dynamic-data">
                                    <a href="{{ route('accounting.load.edit', ['id' => $s->id]) }}" title="Edit Load" style="color:#0DCAF0;text-align:center;display: block; font-size: 17px;">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </td>

                                <!-- <td style="padding: 7px 10px !important; vertical-align: middle !important;"><button class="btn btn-sm btn-danger">Delete</button></td> -->
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
        function toggleBlur() {
            var dynamicCells = document.querySelectorAll('.dynamic-data');
            dynamicCells.forEach(function (cell) {
                var blurValue = cell.style.filter === 'blur(5px)' ? 'none' : 'blur(5px)';
                cell.style.filter = blurValue;
            });
        }

        document.getElementById('hideFormButton').addEventListener('click', function () {
            toggleBlur();
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