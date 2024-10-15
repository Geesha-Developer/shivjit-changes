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
        <div class="block-header" style="padding: 16px 15px !important">
                    <h2>Load Data </h2>
        </div>

        <div class="container-fluid p-0">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive dataTable no-footer">
                                    <thead>
                                    <tr>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Number</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Broker Name</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Bill TO</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Load Status</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Payment Type</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Shipper Rate</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Other Change</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Final Rate</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Billing Type</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Advance Payment</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Equipment Type</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Carrier Fee</th>
                                            <th style="background: #555555 !important;color: #fff !important;">load Billing FSC Rate</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Load Other Charge</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Shipper Load Other Charge </th>
                                            <th style="background: #555555 !important;color: #fff !important;">RC</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($loads as $load)
                                        <tr>
                                            <td>{{ $load->load_number }}</td>
                                            <td>{{ $load->user->name }}</td>
                                            <td>{{ $load->load_bill_to }}</td>
                                            <td>{{ $load->load_status }}</td>
                                            <td>{{ $load->load_payment_type }}</td>
                                            <td>{{ $load->load_shipper_rate }}</td>
                                            <td>{{ $load->load_other_change }}</td>
                                            <td>{{ $load->load_final_rate }}</td>
                                            <td>{{ $load->load_advance_payment }}</td>
                                            <td>{{ $load->load_billing_type }}</td>
                                            <td>{{ $load->load_mc_no }}</td>
                                            <td>{{ $load->load_equipment_type }}</td>
                                            <td>{{ $load->load_carrier_fee }}</td>
                                            <td>{{ $load->load_billing_fsc_rate }}</td>
                                            <td>{{ $load->load_other_charge }}</td>
                                            <td>
                                            <a href="{{ route('download.pdf', ['id' => $load->id]) }}"
                                                    target="_blank"><i class="fas fa-file-pdf text-danger"
                                                        aria-hidden="true" style="font-size: 24px;"></i>
                                            </a>
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
