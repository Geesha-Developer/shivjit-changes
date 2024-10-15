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
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2><strong>Shipper</strong> Data </h2>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <!-- <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div> -->
            </div>
        </div>

        <div class="container-fluid p-0">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <!-- <table class="table table-bordered table-responsive dataTable no-footer"> -->
                                <table class="table table-bordered table-responsive dataTable no-footer" id="dataTable">

                                    <thead>
                                        <tr>
                                            <th style="background: #555555 !important;color: #fff !important;">Sr No.</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Broker Name</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Shipper Name</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Shipper Address</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Shipper Contact Name</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Shipper Contact Email</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Shipper Telephone</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Shipper Hours</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Shipper Appointment</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Shipper Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach($shipper as $shippers)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $shippers->user->name }}</td>
                                            <td>{{ $shippers->shipper_name }}</td>
                                            <td>{{ $shippers->shipper_address}}</td>
                                            <td>{{ $shippers->shipper_contact_name}}</td>
                                            <td>{{ $shippers->shipper_contact_email }}</td>
                                            <td>{{ $shippers->shipper_telephone }}</td>
                                            <td>{{ $shippers->shipper_hours }}</td>
                                            <td>{{ $shippers->shipper_appointments }}</td>
                                            <td>{{ $shippers->shipper_status }}</td>
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
</section>
@endsection
