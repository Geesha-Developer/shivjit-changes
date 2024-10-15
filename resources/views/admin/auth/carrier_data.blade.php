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
                    <h2><strong>Carrier</strong> Data </h2>

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
                                            <th style="background: #555555 !important;color: #fff !important;">Broker Case</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Carrier Name</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Carrier Contact Name</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Carrier Email</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Carrier Telephone</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Carrier Username</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Carrier Password</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Carrier Status</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Carrier Payment Terms</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Carrier Load Type</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($external as $externals)
                                        <tr>
                                            <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $externals->user->name }}</td>
                                            <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $externals->carrier_name }}</td>
                                            <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $externals->carrier_contact_name }}</td>
                                            <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $externals->carrier_email }}</td>
                                            <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $externals->carrier_telephone }}</td>
                                            <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $externals->carrier_username }}</td>
                                            <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $externals->carrier_password }}</td>
                                            <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $externals->carrier_status }}</td>
                                            <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $externals->carrier_payment_terms }}</td>
                                            <td style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $externals->carrier_load_type }}</td>
                                            <td style="padding: 9px 10px !important; vertical-align: middle !important;">
                                            <a href="{{ route('carrier.data', $externals->id) }}" onclick="deleteExternal({{ $externals->id }})">
                                            <i class="fas fa-trash" style="color: red;"></i></a>



                                            <a href="{{ route('edit.customer', ['id' => $externals->id]) }}"><i
                                                        class="fas fa-pen" style="color: #222222;"></i></a>
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
</section>
@endsection
