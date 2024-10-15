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
                <h2>Carrier And Customer Data</h2>
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
                                        <i class="fas fa-shipping-fast"></i> Carriers Data
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="completed-tab" data-bs-toggle="tab" role="tab"
                                       aria-controls="completed" aria-selected="false"
                                       style="font-size:15px;" href="#profile_with_icon_title">
                                        <i class="fa fa-check"></i> Customers Data
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active col-12 p-0" id="home_with_icon_title">
                                    <div class="body p-0">
                                        
                                        <div class="table-responsive">
                                            <table class="custom-table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sr No</th>
                                                        <th>Agent Name</th>
                                                        <th>MC NO</th>
                                                        <th>Carrier Name</th>
                                                        <th>DOT</th>
                                                        <th>Carrier Address</th>
                                                        <th>Carrier Contact Person</th>
                                                        <th>Carrier Email</th>
                                                        <th>Carrier Telephone</th>
                                                        <th>Carrier Payment Terms</th>
                                                        <th>Carrier Factoring Company</th>
                                                        <th>Carrier Notes</th>
                                                        <th>Carrier Status</th>
                                                        <th>MC Check Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1; @endphp
                                                    @foreach($carrier as $c)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $c->user->name }}</td> <!-- Access the user's name -->                                                            
                                                            <td>{{ $c->carrier_mc_ff_input }}</td>
                                                            <td>{{ $c->carrier_name }}</td>
                                                            <td>{{ $c->carrier_dot }}</td>
                                                            <td>{{ $c->carrier_address_two }} {{ $c->carrier_state }} {{ $c->carrier_city }}  {{ preg_replace('/^\d+\s*/', '', $c->carrier_country) }} {{ $c->carrier_zip }}</td>
                                                            <td>{{ $c->carrier_contact_name }}</td>
                                                            <td>{{ $c->carrier_email }}</td>
                                                            <td>{{ $c->carrier_telephone }}</td>
                                                            <td>{{ $c->carrier_payment_terms }}</td>
                                                            <td>{{ $c->carrier_factoring_company }}</td>
                                                            <td>{{ $c->carrier_notes }}</td>
                                                            <td>{{ $c->carrier_status }}</td>
                                                            <td>{{ $c->mc_check }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile_with_icon_title">
                                    <div class="body p-0">
                                       
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
                                                    <!-- Add dynamic data for customers here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End of tab-content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
