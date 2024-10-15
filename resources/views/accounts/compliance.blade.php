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
        <div class="block-header" style="padding: 16px 15px !important;">
            <h2>Compliance Data</h2>
        </div>
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="card">
                    <div class="container-fluid">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="myTab">
                            <li class="nav-item">
                                <a class="nav-link active" id="delivered-tab" data-bs-toggle="tab" role="tab"
                                    aria-controls="delivered" aria-selected="true" style="font-size:15px;"
                                    href="#home_with_icon_title">
                                    <i class="fas fa-shipping-fast"></i> MC Check
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="completed-tab" data-bs-toggle="tab" role="tab"
                                    aria-controls="completed" aria-selected="false"
                                    style="font-size:15px;" href="#profile_with_icon_title">
                                    <i class="fa fa-check"></i> CPR Check
                                </a>
                            </li>
                        </ul>



                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane in active col-12 p-0" id="home_with_icon_title">
                                <div class="body p-0">
                                   <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                                    <div class="table-responsive">
                                        <table class="custom-table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>MC NO</th>
                                                    <th>Carrier Name</th>
                                                    <th>Added By Agent</th>
                                                    <th>Added Date</th>
                                                    <th>MC Check</th>
                                                    <!-- <th>CPR</th> -->
                                                    <th>MC / CPR Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i = 1;
                                                // Get the latest created_at date from the collection
                                                $latestDate = $carrier->max('created_at');
                                                @endphp
                                                @foreach($carrier as $c)
                                                <tr style="background-color: {{ $c->created_at == $latestDate ? '#aae900' : 'transparent' }};">
                                                    <td class="dynamic-data"
                                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        {{ $i++ }}</td>
                                                    <td class="dynamic-data"
                                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        {{ $c->carrier_mc_ff_input }}</td>
                                                    <td class="dynamic-data"
                                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        {{ $c->carrier_name }}
                                                    </td>
                                                    <td class="dynamic-data"
                                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        {{ $c->user->name }}
                                                    </td>
                                                    <td class="dynamic-data"
                                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        {{ $c->created_at }}
                                                    </td>
                                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        <select name="mc_check" id="mc_check-{{ $c->id }}" data-load-id="{{ $c->id }}">
                                                            <option value="">Please Select MC</option>
                                                            <option value="Approved" {{ $c->mc_check == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="Not Approved" {{ $c->mc_check == 'Not Approved' ? 'selected' : '' }}>Not Approved</option>
                                                        </select>
                                                    </td>
                                                  
                                                    @if($c->mc_check == 'Approved')
                                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important; color: green;">
                                                        Approved</td>
                                                    @else
                                                    <td class="dynamic-data"
                                                        style="padding: 7px 10px !important; vertical-align: middle !important;    font-weight: 100 !important;">
                                                        Not Approved </td>
                                                    @endif

                                                </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile_with_icon_title">
                                <div class="body p-0">
                                <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                                    <div class="table-responsive">
                                    <table class="custom-table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Load #</th>
                                                    <th>Agent Name</th>
                                                    <th>W/O #</th>
                                                    <th>Customer #</th>
                                                    <th>Office</th>
                                                    <th>Manager</th>
                                                    <th>Team Leader</th>
                                                    <th>Load Create Date</th>
                                                    <th>Shipper Date</th>
                                                    <th>Delivery Date</th>
                                                    <th>Equipment Type</th>
                                                    <th>Carrier Name</th>
                                                    <th>Pickup Location</th>
                                                    <th>Unloading Location</th>
                                                    <th>Load Status</th>
                                                    <th>CPR</th>
                                                    <th>CPR Status</th>
                                                    <th>Documents</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i = 1;
                                                $latestDate = $loads->max('created_at');
                                                @endphp
                                                @foreach($loads as $delivered)
                                                <tr style="background-color: {{ $delivered->created_at == $latestDate ? '#aae900' : 'transparent' }};">
                                                    <td class="dynamic-data">{{ $i++ }}</td>
                                                    <td class="dynamic-data">
                                                        <a href="{{ route('accounting.load.edit', $delivered->id) }}" style="text-decoration: unset;">
                                                            {{ $delivered->load_number }}
                                                        </a>
                                                    </td>
                                                    <td class="dynamic-data">{{ $delivered->user->name }}</td>
                                                    <td class="dynamic-data">{{ $delivered->load_workorder }}</td>
                                                    <td class="dynamic-data">{{ $delivered->load_bill_to }}</td>
                                                    <td class="dynamic-data">{{ $delivered->user->office }}</td>
                                                    <td class="dynamic-data">{{ $delivered->user->manager }}</td>
                                                    <td class="dynamic-data">{{ $delivered->user->team_lead }}</td>
                                                    <td class="dynamic-data">{{ $delivered->created_at->format('Y-m-d') }}</td>
                                                    @php
                                                    $shipper_appointment =
                                                    json_decode($delivered->load_shipper_appointment,true);
                                                    @endphp
                                                    <td class="dynamic-data">{{ isset($shipper_appointment[0]['appointment']) ? \Carbon\Carbon::parse($shipper_appointment[0]['appointment'])->format('y-m-d') : '' }}
                                                    </td>
                                                    @php
                                                    $consignee_appointment =
                                                    json_decode($delivered->load_consignee_appointment,true);
                                                    @endphp
                                                    <td class="dynamic-data"> {{ isset($consignee_appointment[0]['appointment']) ? \Carbon\Carbon::parse($consignee_appointment[0]['appointment'])->format('y-m-d') : '' }}
                                                    </td>
                                                    <td class="dynamic-data">{{ $delivered->load_equipment_type }}</td>

                                                    <td class="dynamic-data">{{$delivered->load_carrier}}</td>

                                                    @php
                                                    $shipper_location = json_decode($delivered->load_shipper_location, true);
                                                    @endphp

                                                        <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                            {{ $shipper_location[0]['location'] ?? '' }}
                                                        </td>



                                                    @php
                                                    $consignee_location =
                                                    json_decode($delivered->load_consignee_location, true);
                                                    $last_consignee_location = end($consignee_location);
                                                    @endphp

                                                    <td class="dynamic-data"
                                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        {{ $last_consignee_location['location'] ?? '' }}
                                                    </td>

                                                    <td class="dynamic-data"
                                                        style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        {{ $delivered->load_status }}
                                                    </td>
                                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        <select name="cpr_check" id="cpr_check-{{ $delivered->id }}" data-load-id="{{ $delivered->id }}">
                                                            <option value="">Please Select CPR</option>
                                                            <option value="Verified" {{ $delivered->cpr_check == 'Verified' ? 'selected' : '' }}>Verified</option>
                                                            <option value="Not Verified" {{ $delivered->cpr_check == 'Not Verified' ? 'selected' : '' }}>Not Verified</option>
                                                            <option value="Not Received" {{ $delivered->cpr_check == 'Not Received' ? 'selected' : '' }}>Not Received</option>
                                                        </select>
                                                    </td>
                                                    @if($delivered->cpr_check == 'Verified')
                                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;color: green;">
                                                    Verified
                                                    </td>
                                                    @elseif($delivered->cpr_check == 'Not Verified')
                                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        Not Verified
                                                    </td>
                                                    @elseif($delivered->cpr_check == 'Not Received')
                                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        Not Received
                                                    </td>
                                                    @elseif($delivered->cpr_check != 'Verified')
                                                    <td class="dynamic-data" style="padding: 7px 10px !important; vertical-align: middle !important;">
                                                        Please Check CPR
                                                    </td>
                                                    @endif
                                                    <td class="dynamic-data">
                                                        @if (!empty($delivered->load_delivery_do_file))
                                                            @php
                                                                $fileUrl = asset('storage/' . $delivered->load_delivery_do_file);
                                                            @endphp
                                                            <a href="{{ $fileUrl }}" target="_blank"><i class="fa fa-eye" style="font-size: 15px;color: #000; margin-right: 6px;"></i></a> | 
                                                            <a href="{{ $fileUrl }}" download><i class="fa fa-download" style="font-size: 15px;color: #000; margin-left: 6px;"></i></a>
                                                        @else
                                                            No File Available
                                                        @endif
                                                    </td>


                                                </tr>
                                                @endforeach
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
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
    // Listen for changes on mc_check select elements
    $('select[id^="mc_check-"]').on('change', function () {
        var loadId = $(this).data('load-id');
        var mcCheck = $(`#mc_check-${loadId}`).val();

        $.ajax({
            url: '{{ route("saveCarrierChecks") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: loadId,
                mc_check: mcCheck
            },
            success: function (response) {
                alert('MC Check updated successfully.');
                location.reload();
            },
            error: function (response) {
                alert('An error occurred while updating the MC Check.');
            }
        });
    });

    // Listen for changes on cpr_check select elements
    $('select[id^="cpr_check-"]').on('change', function () {
        var loadId = $(this).data('load-id');
        var cprCheck = $(`#cpr_check-${loadId}`).val();

        $.ajax({
            url: '{{ route("savecprChecks") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: loadId,
                cpr_check: cprCheck
            },
            success: function (response) {
                alert('CPR Check updated successfully.');
                location.reload();
            },
            error: function (response) {
                alert('An error occurred while updating the CPR Check.');
            }
        });
    });

    // Check the initial state of mc_check fields
    $('select[id^="mc_check-"]').each(function () {
        var loadId = $(this).data('load-id');
        var mcCheck = $(this).val();
        if (mcCheck === 'Approved') {
            $(`#cpr_check-${loadId}`).prop('disabled', false);
        } else {
            $(`#cpr_check-${loadId}`).prop('disabled', true);
        }
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

    // Add event listeners to all buttons with the class 'toggleBlurButton'
    document.querySelectorAll('.toggleBlurButton').forEach(function (button) {
        button.addEventListener('click', function () {
            toggleBlur();
        });
    });
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JavaScript library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
</script>
@endsection