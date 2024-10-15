@extends('layouts.broker.app')
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
    button.close {
        top: 25px !important;
        color: #000 !important;
    }

    input {
        font-size: 11px !important;
    }

    .modal {
        overflow-y: scroll !important;
    }

    .card-body1 .form-group label {
        margin-bottom: 4px;
        font-weight: 600;
        font-size: 11px;
        text-align: left;
        color: #4a4a4a;
    }

    .dataTables_wrapper select {
        border: 1px solid #ddd;
    }

    #consigneeSections .nav li a {
        color: #000 !important;
        background: unset;
        border: unset !important;
        font-size: 12px;

    }


    #consigneeSections .nav li {
        border: 1px solid #ccc;
        padding: 3px 4px;
        border-radius: 10px;
        background: #fff;
        margin-right: 10px;
        margin-top: 2px;
    }

    #consigneeSections .nav {
        justify-content: left;
        background: #c7c7c6 !important;
        padding: 4px 0 7px 4px;
    }



    #shipperForms .nav li a {
        color: #000 !important;
        background: unset;
        border: unset !important;
        font-size: 12px;

    }

    #shipperForms .nav li {
        border: 1px solid #ccc;
        padding: 3px 4px;
        border-radius: 10px;
        background: #fff;
        margin-right: 10px;
        margin-top: 2px;
    }

    #shipperForms .nav {
        justify-content: left;
        background: #c7c7c6 !important;
        padding: 4px 0 7px 4px;
        margin: -8px 0 0 0;
    }

    .card-header h3 {
        font-size: 12px;
        margin-left: 20px;
        text-align: left;
        font-weight: 500;
    }

    input#load_delivery_do_file {
        font-size: 7px;
    }

    .hover-text {
        display: none;
        margin-left: 5px;
        color: #0096a6;
        font-size: 12px;
    }

    .clone-link:hover .hover-text {
        display: inline;
    }

    .item {
        padding: 3px;
        margin: 5px 0 0 0px;
    }

    .upload-docs input[type="file"] {
        position: absolute;
        right: -9999px;
        visibility: hidden;
        opacity: 0;
    }

    .files ul li .fa-trash {
        position: absolute;
        right: 32px;
    }

    .files ul li {
        font-size: 17px;
        text-align: left;
    }

    .upload-docs {
        background: #aeaeae;
        padding: 11px 0;
        margin-bottom: 22px;
        border-radius: 10px;
        font-size: 26px;
        color: #27310c;
    }

    .upload-docs label {
        width: 100%;
    }

    .files {
        background: #eeeeee;
        border-radius: 0;
        padding: 4px 0 0px 0;
        margin-bottom: 14px;
        font-size: 10px;
    }

    input#submit {
        background: #0c8fda;
        color: #fff;
        font-size: 19px;
        border: none;
        border-radius: 10px;
        width: 100%;
        padding: 6px 21px;
    }

    li {
        list-style: none;
    }

    #myFormLoad .modal-footer .btn {
        padding: 6px 27px;
        font-size: 14px;
    }

    #save-buttons {
        margin-top: 14px;
    }

    tr:nth-child(1) .closebtn {
        display: none;
    }

    .modal .modal-header .close {
        text-shadow: none;
    }

    .blur {
        filter: blur(5px);
    }


    #myForm {
        display: none;
    }

    #showFormLink {
        text-decoration: none;
        color: #000;
        border-radius: 2px;
    }

    .tab .remove {
        background: #9ea3a3;
        font-size: 15px;
        padding: 5px 7px;
        border-radius: 4px;
        cursor: pointer;
        color: #fff;
    }

    .tab {
        border: 1px solid #ccc;
        padding: 3px 4px;
        background: #f3f3f3;
        border-radius: 4px;
        margin: 8px 0;
        cursor: pointer;
        margin-right: 9px;
    }

    .dropdown-menu.show {
        right: 0;
    }

</style>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Load List</h2>
                </div>
            </div>
        </div>

       <div class="d-flex justify-content-space-around" style="    padding: 0 0 4px 0;margin-bottom: 9px;background: #c7c7c6;">
       <div class="broker">
            <select class="broker-user-id" id="broker-user-id" style="margin-top: 16px;" >
            <option value="" selected>Select Broker</option>
            @foreach($brokers as $broker)
            <option value="{{$broker->id}}">{{$broker->name}}</option>
            @endforeach
            </select>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link" id="all-tab"  data-bs-toggle="tab"  role="tab"
                    aria-controls="carriers" aria-selected="true"
                    style="font-size: 15px;color: #000;font-weight:500">All</button>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="open-tab" data-bs-toggle="tab" href="#open" role="tab" aria-controls="open"
                    aria-selected="true" style="font-size: 15px;color: #000;font-weight:500">Customer</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="delivered-tab" data-bs-toggle="tab" href="#delivered" role="tab"
                    aria-controls="delivered" aria-selected="false"
                    style="font-size: 15px;color: #000;font-weight:500">Carrier</a>

            </li>

            <li class="nav-item">
                <a class="nav-link" id="customers-tab" data-bs-toggle="tab" href="#completed" role="tab"
                    aria-controls="completed" aria-selected="false"
                    style="font-size: 15px;color: #000;font-weight:500">Shipper</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="invoice-tab" data-bs-toggle="tab" href="#invoice" role="tab"
                    aria-controls="customers" aria-selected="false"
                    style="font-size: 15px;color: #000;font-weight:500">consignee</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="agent-tab" data-bs-toggle="tab" href="#agent_data" role="tab"
                    aria-controls="customers" aria-selected="false"
                    style="font-size: 15px;color: #000;font-weight:500">Load</a>
            </li>
        </ul>
       </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="all" ole="tabpanel" aria-labelledby="customers-tab">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" style="padding: 5px 10px;"
                            data-target="#exampleModal">Create Load</button>
                        <button type="button" class="btn btn-primary" style="padding: 5px 10px;">Generate
                            Invoice#</button>
                        <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;"
                            class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                    </div>
                    <div class="col-md-6 text-center date-time">
                        <div class="date" style="margin-top: 0;">
                            <label for="start">Start Date</label>
                            <input id="start" style="height: 30px;color: #3e3e40;" type="date" />
                        </div>
                        <div class="date" style="margin-top: 0;margin-left: 14px;">
                            <label for="end">End Date</label>
                            <input id="end" style="height: 30px;color: #3e3e40;" type="date" />
                        </div>

                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('load_insert') }}" id="myFormLoad"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h3 class="card-title">Add Load</h3>
                                </div>
                                <div class="card-body text-left">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Load Number
                                                    <code>*</code></label>
                                                <input class="form-control" name="load_number" disabled
                                                    style="width: 100%;">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bill To <code>*</code>
                                                    <a href="{{ route('customer') }}" target="blank"
                                                        style="background: none; border: none;">
                                                        <i class="fa fa-plus"></i>Add New
                                                    </a>
                                                </label>
                                                <input type="text" id="load_bill_to" name="load_bill_to"
                                                    class="form-control" required
                                                    placeholder="Search Customer names...">
                                                <textarea id="customerList" class="form-control" style="display: none;"
                                                    readonly></textarea>
                                                <input type="hidden" id="customer_id" name="customer_id">
                                                <input type="hidden" id="customer_credit_limit"
                                                    name="customer_credit_limit">
                                                <input type="hidden" id="remaining_credit" name="remaining_credit">

                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Dispatcher <code>*</code></label>
                                                <input class="form-control" name="load_dispatcher"
                                                    value="{{ $user->name }}" required readonly
                                                    style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control select2" name="load_status"
                                                    style="width: 100%;">
                                                    <option selected="selected" value="Open">Open
                                                    </option>
                                                    <option value="Covered">Covered
                                                    </option>
                                                    <option value="Dispatched">
                                                        Dispatched</option>
                                                    <option value="Loading">Loading
                                                    </option>
                                                    <option value="On Route">On Route
                                                    </option>
                                                    <option value="Un loading">Un
                                                        loading</option>
                                                    <option value="completed">Delivered
                                                    </option>
                                                    <option value="completed">completed
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>W/O # </label>
                                                <input class="form-control" name="load_workorder" style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Customer r/f# </label>
                                                <input class="form-control" name="customer_refrence_number"
                                                    style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Payment Type
                                                    <code>*</code></label>
                                                <select class="form-control select2" required name="load_payment_type"
                                                    style="width: 100%;">
                                                    <option value="">Select Status</option>
                                                    <option>Prepaid</option>
                                                    <option>Postpaid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Load type<code>*</code></label>
                                                <div class="select2-purple">
                                                    <select class="form-control select2" required name="load_type_two"
                                                        style="width: 100%;">
                                                        <option value="">
                                                            Select Status
                                                        </option>
                                                        <option>OTR</option>
                                                        <option>DRAYAGE</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <input class="form-control" name="load_type" style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Shipper Rate
                                                    <code>*</code></label>
                                                <input type="number" class="form-control number value"
                                                    name="load_shipper_rate" id="load_shipper_rate" required
                                                    style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>F.S.C Rate % <input hidden type="checkbox"
                                                        name="calculate_fsc_percentage"
                                                        id="calculate_fsc_percentage"></label>
                                                <input class="form-control number percent" name="load_fsc_rate"
                                                    id="load_fsc_rate" style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="other_charge">Other Charge &nbsp; <i class="fa fa-plus"
                                                        style="color: #0c7ce6;" data-toggle="modal"
                                                        data-target="#myModal" id="load_shipper_other_charges"></i>
                                                </label>
                                                <input class="form-control number percent" style="width: 100%;">
                                            </div>

                                            <div class="modal close_shipper_other_charges_form" id="myModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="margin-left: -16px;">

                                                        <!-- Modal Header -->
                                                        <h4 class="card-header"
                                                            style="font-size: 17px;text-align: left;margin-left: 38px;font-weight: 700;">
                                                            Other Charges</h4>
                                                        <!-- Modal Body -->
                                                        <div class="modal-body pt-0">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label for="shipperchargeType"> Charge
                                                                                Type:</label>
                                                                            <input type="text" class="form-control"
                                                                                name="shipperchargeType[]"
                                                                                placeholder="Enter charge type">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label> Charge Amount:</label>
                                                                            <input type="number" class="form-control"
                                                                                name="shipperchargeAmount[]"
                                                                                placeholder="Enter charge amount">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 d-flex justify-content-start"
                                                                        style="margin-top: 27px;">
                                                                        <a type="button" class="remove-charge"
                                                                            name="shipperchargeAmountdelete[]">
                                                                            <i class="fa fa-trash"
                                                                                style="margin-top: 19px;"
                                                                                aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                                <div class="row" id="chargeRowTemplate"
                                                                    style="display: none;">
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label for="shipperchargeType"> Charge
                                                                                Type:</label>
                                                                            <input type="text" class="form-control"
                                                                                name="shipperchargeType[]"
                                                                                placeholder="Enter charge type">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label>Charge Amount:</label>
                                                                            <input type="number" class="form-control"
                                                                                name="shipperchargeAmount[]"
                                                                                placeholder="Enter charge amount">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 d-flex justify-content-start"
                                                                        style="margin-top: 27px;">
                                                                        <a type="button" class="remove-charge"
                                                                            name="shipperchargeAmountdelete[]">
                                                                            <i class="fa fa-trash"
                                                                                style="margin-top: 19px;"
                                                                                aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer mt-2">
                                                            <button type="button" class="btn btn-success"
                                                                id="addChargeBtn">Add More Charges</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Final Shipper Rate</label>
                                                <!-- <input type="text" class="form-control" name="shipper_load_final_rate" id="shipper_load_final_rate" style="width: 100%;"> -->
                                                <!-- <input type="text" class="form-control" name="shipper_load_final_rate" readonly id="shipper_load_final_rate" > -->
                                                <input type="text" class="readonly form-control"
                                                    name="shipper_load_final_rate" id="shipper_load_final_rate"
                                                    required />

                                                <p id="creditlimitcheck"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>MC No <code>*</code></label>
                                                <input class="form-control" required name="load_mc_no"
                                                    id="carrier_mc_ff_input" style="width: 100%;"
                                                    placeholder="Enter MC Number">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Carrier <code>*</code></label>
                                                <input type="text" id="load_carrier" name="load_carrier" required
                                                    class="form-control" style="width: 100%;" readonly
                                                    placeholder="Search carrier names...">
                                                <div id="carrierList"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Carrier Phone<code>*</code></label>
                                                <input type="number" id="load_carrier_phone" name="load_carrier_phone"
                                                    required class="form-control" readonly style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Advance Payment</label>
                                                <input type="number" class="form-control" name="load_advance_payment"
                                                    style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Billing Type</label>
                                                <select class="form-control select2" name="load_billing_type"
                                                    style="width: 100%;">
                                                    <option selected="selected">Select
                                                        Billing
                                                    </option>
                                                    <option>Factoring</option>
                                                    <option>Direct Billing</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Carrier Fee
                                                    <code>*</code></label>
                                                <input class="form-control" type="number" name="load_carrier_fee"
                                                    id="load_carrier_fee" required style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>FSC Rate %</label>
                                                <input type="number" name="load_billing_fsc_rate"
                                                    id="load_billing_fsc_rate" class="form-control"
                                                    style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="other_charge">Other
                                                    Charges <i class="fa fa-plus" style="color: #0c7ce6;"
                                                        id="openModalIcon"></i></label>
                                                <input class="form-control" type="number" name="load_other_charge"
                                                    style="width: 100%;">
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="otherChargesModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content" style="margin-left: -16px;"
                                                        id="model_content">
                                                        <h4 class="modal-header mb-0"
                                                            style="font-size: 17px;text-align: left;font-weight: 700;">
                                                            Other Charges</h4>
                                                        <div class="modal-body pt-0">
                                                            <div id="inputs">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label for="shipperchargeType">Charge
                                                                                Type:</label>
                                                                            <input class="w-100" type="text"
                                                                                name="shipper_type_charge[]"
                                                                                placeholder="Type Of Charge">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label>Charge Amount:</label>
                                                                            <input class="w-100" type="number"
                                                                                name="shipper_other_charge[]"
                                                                                placeholder="Price" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 d-flex justify-content-start"
                                                                        style="margin-top: 27px;">
                                                                        <a type="button" class="remove-charge"
                                                                            name="shipperchargeAmountdelete[]">
                                                                            <i class="fa fa-trash"
                                                                                style="margin-top: 19px;"
                                                                                aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer mt-2">
                                                                <button class='create-input btn btn-success'>Add More
                                                                    Charges</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Final Carrier Fee</label>
                                                <input class="form-control" readonly name="load_final_carrier_fee"
                                                    id="load_final_carrier_fee" style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Currency</label>
                                                <select class="form-control select2" name="load_currency"
                                                    style="width: 100%;">
                                                    <option selected="selected">Select
                                                        Currency
                                                    </option>
                                                    <option>$</option>
                                                    <option>CAD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Equipment Type
                                                    <code>*</code></label>
                                                <!-- <select class="form-control select2" required name="load_equipment_type" style="width: 100%;"> -->
                                                <select class="form-control select2" name="load_equipment_type"
                                                    id="load_equipment_type" style="width: 100%;" required>

                                                    <option value="">Select Equipment </option>
                                                    <option value="Container Trailer">
                                                        Container
                                                        Trailer</option>
                                                    <option value="22' VAN">22' VAN
                                                    </option>
                                                    <option value="48' Reefer">48'
                                                        Reefer</option>
                                                    <option value="53' Reefer">53'
                                                        Reefer</option>
                                                    <option value="53' VAN">53' VAN
                                                    </option>
                                                    <option value="Air Freight">Air
                                                        Freight</option>
                                                    <option value="Anhydros Ammonia">
                                                        Anhydros
                                                        Ammonia</option>
                                                    <option value="Animal Carrier">
                                                        Animal Carrier
                                                    </option>
                                                    <option value="Any Equipment">Any
                                                        Equipment
                                                    </option>
                                                    <option value="Searching Services only">
                                                        Any
                                                        Equipment (Searching Services
                                                        only)</option>
                                                    <option value="Auto Carrier">Auto
                                                        Carrier
                                                    </option>
                                                    <option value="B-Train/Supertrain">
                                                        B-Train/Supertrain</option>
                                                    <option value="Canada Only">
                                                        B-Train/Supertrain(Canada Only)
                                                    </option>
                                                    <option value="Beam">Beam</option>
                                                    <option value="Belly Dump">Belly
                                                        Dump</option>
                                                    <option value="Blanket Wrap Van">
                                                        Blanket Wrap
                                                        Van</option>
                                                    <option value="Boat Hauling Trailer">
                                                        Boat
                                                        Hauling Trailer</option>
                                                    <option value="Cargo Van (1 Ton)">
                                                        Cargo Van (1
                                                        Ton)</option>
                                                    <option value="Cargo Vans (1 Ton capacity)">
                                                        Cargo Vans (1 Ton capacity)
                                                    </option>
                                                    <option value="Cargo/Small/Sprinter Van">
                                                        Cargo/Small/Sprinter Van
                                                    </option>
                                                    <option value="Conestoga">Conestoga
                                                    </option>
                                                    <option value="Convertible Hopper">
                                                        Convertible
                                                        Hopper</option>
                                                    <option value="Conveyor Belt">
                                                        Conveyor Belt
                                                    </option>
                                                    <option value="Crane Truck">Crane
                                                        Truck</option>
                                                    <option value="Curtain Siders">
                                                        Curtain Siders
                                                    </option>
                                                    <option value="Curtain Van">Curtain
                                                        Van</option>
                                                    <option value="Double Drop">Double
                                                        Drop</option>
                                                    <option value="Double Drop Extendable">
                                                        Double
                                                        Drop Extendable</option>
                                                    <option value="Drive Away">Drive
                                                        Away</option>
                                                    <option value="Dump Trucks">Dump
                                                        Trucks</option>
                                                    <option value="End Dump">End Dump
                                                    </option>
                                                    <option value="Flat Intermodal">Flat
                                                        Intermodal
                                                    </option>
                                                    <option value="Flat with Traps">Flat
                                                        with Traps
                                                    </option>
                                                    <option value="FlatBed">FlatBed
                                                    </option>
                                                    <option value="FlatBed - Air-ride">
                                                        FlatBed -
                                                        Air-ride</option>
                                                    <option value="Flatbed Blanket Wrapped">
                                                        Flatbed
                                                        Blanket Wrapped</option>
                                                    <option value="Flatbed Intermodal">
                                                        Flatbed
                                                        Intermodal</option>
                                                    <option value="Flatbed or Step Deck">
                                                        Flatbed or
                                                        Step Deck</option>
                                                    <option value="Flatbed or Van">
                                                        Flatbed or Van
                                                    </option>
                                                    <option value="Flatbed or Vented Van">
                                                        Flatbed or
                                                        Vented Van</option>
                                                    <option value="Flatbed Over-Dimension Loads">
                                                        Flatbed Over-Dimension Loads
                                                    </option>
                                                    <option value="Flatbed With Sides">
                                                        Flatbed With
                                                        Sides</option>
                                                    <option value="Flatbed, Step Deck or Van">
                                                        Flatbed, Step Deck or Van
                                                    </option>
                                                    <option value="Flatbed, Van or Reefer">
                                                        Flatbed,
                                                        Van or Reefer</option>
                                                    <option value="Flatbed, Vented Van or Reefer">
                                                        Flatbed, Vented Van or Reefer
                                                    </option>
                                                    <option value="Haul and Tow Unit">
                                                        Haul and Tow
                                                        Unit</option>
                                                    <option value="Hazardous Material Load">
                                                        Hazardous Material Load</option>
                                                    <option value="Hopper Bottom">Hopper
                                                        Bottom
                                                    </option>
                                                    <option value="Hot Shot">Hot Shot
                                                    </option>
                                                    <option value="Labour">Labour
                                                    </option>
                                                    <option value="Landoll Flatbed">
                                                        Landoll Flatbed
                                                    </option>
                                                    <option value="Live Bottom Trailer">
                                                        Live
                                                        BottomTrailer</option>
                                                    <option value="Load-Out">Load-Out
                                                    </option>
                                                    <option value="Load-Out are empty trailers you load and haul">
                                                        Load-Out are empty trailers you
                                                        load and
                                                        haul</option>
                                                    <option value="Lowboy">Lowboy
                                                    </option>
                                                    <option value="Lowboy Over-Dimension Loads">
                                                        Lowboy Over-Dimension Loads
                                                    </option>
                                                    <option value="Maxi or Double Flat Trailers">
                                                        Maxi or Double Flat Trailers
                                                    </option>
                                                    <option value="Mobile Home">Mobile
                                                        Home</option>
                                                    <option value="Moving Van">Moving
                                                        Van</option>
                                                    <option value="Multi-Axle Heavy Hauler">
                                                        Multi-Axle Heavy Hauler</option>
                                                    <option value="Ocean Freight">Ocean
                                                        Freight
                                                    </option>
                                                    <option value="Open Top">Open Top
                                                    </option>
                                                    <option value="Open Top Van">Open
                                                        Top Van
                                                    </option>
                                                    <option value="Pneumatic">Pneumatic
                                                    </option>
                                                    <option value="Power Only">Power
                                                        Only</option>
                                                    <option value="Power Only (Tow-Away)">
                                                        Power Only
                                                        (Tow-Away)</option>
                                                    <option value="Rail">Rail</option>
                                                    <option value="Reefer Pallet Exchange">
                                                        Reefer
                                                        Pallet Exchange</option>
                                                    <option value="Refrigerated (Reefer)">
                                                        Refrigerated (Reefer)</option>
                                                    <option value="Refrigerated Carrier with Plant Decking">
                                                        Refrigerated Carrier with Plant
                                                        Decking
                                                    </option>
                                                    <option value="Refrigerated Intermodal">
                                                        Refrigerated Intermodal</option>
                                                    <option value="Removable Goose Neck">
                                                        Removable
                                                        Goose Neck</option>
                                                    <option value="Multi-Axle Heavy Haulers">
                                                        Removable Goose Neck &amp;
                                                        Multi-Axle Heavy
                                                        Haulers</option>
                                                    <option value="GN Extendable">RGN
                                                        Extendable
                                                    </option>
                                                    <option value="Roll Top Conestoga">
                                                        Roll Top
                                                        Conestoga</option>
                                                    <option value="Roller Bed">Roller
                                                        Bed</option>
                                                    <option value="Specialized Trailers">
                                                        Specialized
                                                        Trailers</option>
                                                    <option value="Step Deck">Step Deck
                                                    </option>
                                                    <option value="Step Deck Conestoga">
                                                        Step Deck
                                                        Conestoga</option>
                                                    <option value="Step Deck Extendable">
                                                        Step Deck
                                                        Extendable</option>
                                                    <option value="Step Deck or Flat">
                                                        Step Deck or
                                                        Flat</option>
                                                    <option value="Step Deck or Removable Gooseneck">
                                                        Step Deck or Removable
                                                        Gooseneck</option>
                                                    <option value="Step Deck Over-Dimension Loads">
                                                        Step Deck Over-Dimension
                                                        Loads</option>
                                                    <option value="Step Deck with Loading Ramps">
                                                        Step Deck with Loading
                                                        Ramps
                                                    </option>
                                                    <option value="Straight Van">
                                                        Straight Van
                                                    </option>
                                                    <option value="Stretch Trailer or Ext. Flat">
                                                        Stretch Trailer or Ext.
                                                        Flat
                                                    </option>
                                                    <option value="Stretch Trailer or Extendable Flatbed">
                                                        Stretch Trailer or
                                                        Extendable Flatbed</option>
                                                    <option value="Supplies">Supplies
                                                    </option>
                                                    <option value="Tandem Van">Tandem
                                                        Van</option>
                                                    <option value="Tanker">Tanker
                                                    </option>
                                                    <option value="Tanker (Food grade, liquid, bulk, etc.)">
                                                        Tanker (Food
                                                        grade,
                                                        liquid, bulk, etc.)</option>
                                                    <option value="Team Driver Needed">
                                                        Team Driver
                                                        Needed</option>
                                                    <option value="Tridem">Tridem
                                                    </option>
                                                    <option value="Two 24 or 28 Foot Flatbeds">
                                                        Two
                                                        24 or 28 Foot Flatbeds
                                                    </option>
                                                    <option value="Unspecified Specialized Trailers">
                                                        Unspecified Specialized
                                                        Trailers</option>
                                                    <option value="Van">Van</option>
                                                    <option value="Van - Air-Ride">Van -
                                                        Air-Ride
                                                    </option>
                                                    <option value="Van Intermodal">Van
                                                        Intermodal
                                                    </option>
                                                    <option value="Van or Flatbed">Van
                                                        or Flatbed
                                                    </option>
                                                    <option value="Van or Reefer">Van or
                                                        Reefer
                                                    </option>
                                                    <option value="Van Pallet Exchange">
                                                        Van Pallet
                                                        Exchange</option>
                                                    <option value="Van with Liftgate">
                                                        Van with
                                                        Liftgate</option>
                                                    <option value="Van, Reefer or Double Drop">
                                                        Van,
                                                        Reefer or Double Drop
                                                    </option>
                                                    <option value="Vented Insulated Van">
                                                        Vented
                                                        Insulated Van</option>
                                                    <option value="Vented Insulated Van or Refrigerated">
                                                        Vented Insulated
                                                        Van or
                                                        Refrigerated</option>
                                                    <option value="Vented Van">Vented
                                                        Van</option>
                                                    <option value="Vented Van or Refrigerated">
                                                        Vented Van or Refrigerated
                                                    </option>
                                                    <option value="Walking Floor">
                                                        Walking Floor
                                                    </option>
                                                    <option value="BOX Truck">BOX Truck
                                                    </option>
                                                    <option value="Reefer Container">
                                                        Reefer
                                                        Container</option>
                                                    <option value="Tandem">Tandem
                                                    </option>
                                                    <option value="B Train">B Train
                                                    </option>
                                                    <option value="Flatbed with Tarps">
                                                        Flatbed with
                                                        Tarps</option>
                                                    <option value="Flatbed with straps">
                                                        Flatbed with
                                                        straps</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Delivery Order</label>
                                                <input class="form-control" type="file" name="load_delivery_do_file"
                                                    id="load_delivery_do_file" style="width: 100%; font-size:9px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3 class="card-title">Shipper <i id="addBtn" class="fa fa-plus"></i></h3>
                                </div>
                                <div class="card-body" id="shipperForms">
                                    <ul class="nav nav-tabs" id="navTabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" style="padding: 1px 11px;" id="formTab1"
                                                data-bs-toggle="tab" href="#shipperForm1" role="tab"
                                                aria-controls="shipperForm1" aria-selected="true">Shipper 1</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="tabContent">
                                        <div class="tab-pane fade show active" id="shipperForm1" role="tabpanel"
                                            aria-labelledby="formTab1">
                                            <div class="row shipper-form">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Shipper <code>*</code>
                                                            <a href="{{ route('shipper') }}" target="blank"
                                                                style="background: none; border: none;">
                                                                <i class="fa fa-plus"></i>Add New
                                                            </a>
                                                        </label>
                                                        <input class="form-control" name="load_shipper"
                                                            id="load_shipper" required autocomplete="off"
                                                            style="width: 100%;">
                                                        <div id="shipperList" class="form-control"
                                                            style="height: auto !important;width: 100% !important; position:absolute; z-index:9;"
                                                            style="display: none;" readonly></div>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Shipper Location</label>
                                                        <input class="form-control" name="load_shipper_location"
                                                            id="load_shipper_location" style="width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Appointment</label>
                                                        <input class="form-control" type="datetime-local"
                                                            name="load_shipper_appointment" style="width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <input class="form-control" name="load_shipper_description"
                                                            style="width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Commodity Type</label>
                                                        <input class="form-control select2"
                                                            name="load_shipper_commodity_type" style="width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Commodity Name <code>*</code></label>
                                                        <input class="form-control" name="load_shipper_commodity"
                                                            type="text" required style="width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Qty</label>
                                                        <input type="number" class="form-control"
                                                            name="load_shipper_qty" style="width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Weight (lbs)</label>
                                                        <input class="form-control" type="number"
                                                            name="load_shipper_weight" style="width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Value($)<code>*</code></label>
                                                        <input type="number" class="form-control"
                                                            name="load_shipper_value" required style="width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Shipping Notes</label>
                                                        <input class="form-control" name="load_shipper_shipping_notes"
                                                            style="width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>PO Numbers</label>
                                                        <input class="form-control" name="load_shipper_po_numbers"
                                                            style="width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Contact Number</label>
                                                        <input class="form-control" type="number"
                                                            name="load_shipper_contact" style="width: 100%;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3 class="card-title">Consignee <i id="addBtnconsignee" class="fa fa-plus"></i>
                                    </h3>
                                </div>
                                <div class="card-body1" id="consigneeSections" style="padding: 0 20px;">
                                    <ul class="nav nav-tabs" id="navTabs1">
                                        <li class="nav-item">
                                            <a class="nav-link active" style="padding: 1px 11px;" id="formTab1"
                                                data-bs-toggle="tab" href="#consigneeSections1" role="tab"
                                                aria-controls="consigneeSections1" aria-selected="true">Consignee 1</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="tabContent1">
                                        <div class="tab-pane fade show active" id="consigneeSections1" role="tabpanel"
                                            aria-labelledby="formTab1">
                                            <div class="consignee-section">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Consignee <code>*</code>
                                                                <a href="{{ route('consignee') }}" target="blank"
                                                                    style="background: none; border: none; font-size:13px;">
                                                                    <i class="fa fa-plus"></i>Add New
                                                                </a>
                                                            </label>
                                                            <input class="form-control" name="load_consignee"
                                                                id="load_consignee" required style="width: 100%;">
                                                            <div id="consigneeList" class="form-control"
                                                                style="height: auto !important;width: 100% !important; font-size: 11px;position:absolute; z-index:9;"
                                                                style="display: none;" readonly></div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Consignee Location</label>
                                                            <input class="form-control" name="load_consignee_location"
                                                                id="load_consignee_location" style="width: 100%;"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Appointment</label>
                                                            <input class="form-control" type="datetime-local"
                                                                name="load_consignee_appointment" style="width: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input class="form-control"
                                                                name="load_consignee_description" style="width: 100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Commodity Type </label>
                                                            <input class="form-control select2"
                                                                name="load_consignee_type" style="width: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Commodity Name <code>*</code></label>
                                                            <input class="form-control" name="load_consignee_commodity"
                                                                type="text" required style="width: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Qty</label>
                                                            <input type="number" class="form-control"
                                                                name="load_consignee_qty" style="width: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Weight (lbs)</label>
                                                            <input class="form-control" type="number"
                                                                name="load_consignee_weight" style="width: 100%;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Value($)<code>*</code></label>
                                                            <input type="number" class="form-control"
                                                                name="load_consignee_value" required
                                                                style="width: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Consignee
                                                                Notes</label>
                                                            <textarea class="form-control" name="load_consignee_notes"
                                                                style="width: 100%; height: 31px !important;font-size: 12px;"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>PO Numbers</label>
                                                            <input class="form-control" name="load_consignee_po_numbers"
                                                                style="width: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Contact Number</label>
                                                            <input class="form-control" type="number"
                                                                name="load_consignee_contact" style="width: 100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-info" value="Save">
                                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="load-table">
    <thead>
    <tr>
                            <!-- <th><input type="checkbox" id="select-invoice"></th> -->
                            <th>Load #</th>
                            <th>W/O #</th>
                            <th>Customer Refrence #</th>
                            <th>Customer #</th>
                            <th>Load Create Date</th>
                            <th>Shipper Date</th>
                            <th>Deliver date</th>
                            <th>Carrier</th>
                            <th>Pickup Location</th>
                            <th>Unloading Location</th>
                            <th>Actual Del Date</th>
                            <th>Load Status</th>
                            <th>Margin</th>
                            <th>Aging</th>
                             <th>CPR Status</th>
                            <th>Action</th>

                        </tr>
    </thead>
    <tbody>
        <!-- DataTables will populate this -->
    </tbody>
</table>
            </div>
            <div class="tab-pane fade" id="open" role="tabpanel" aria-labelledby="open-tab">
                <table class="table table-bordered table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-invoice"></th>
                            <th>Load #</th>
                            <th>W/O #</th>
                            <th>Customer Refrence #</th>
                            <th>Customer #</th>
                            <th>Load Create Date</th>
                            <th>Shipper Date</th>
                            <th>Deliver date</th>
                            <th>Carrier</th>
                            <th>Pickup Location</th>
                            <th>Unloading Location</th>
                            <th>Actual Del Date</th>
                            <th>Load Status</th>
                            <th>Margin</th>
                            <!-- <th>Aging</th> -->
                            <th>CPR Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr>


                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="customers-tab">

                <table class="table table-bordered table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-invoice"></th>
                            <th>Load #</th>
                            <th>W/O #</th>
                            <th>Customer Refrence #</th>
                            <th>Customer #</th>
                            <th>Load Create Date</th>
                            <th>Shipper Date</th>
                            <th>Deliver date</th>
                            <th>Carrier</th>
                            <th>Pickup Location</th>
                            <th>Unloading Location</th>
                            <th>Actual Del Date</th>
                            <th>Load Status</th>
                            <th>Margin</th>
                            <th>Aging</th>
                            <th>CPR Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                           
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="customers-tab">
                <table class="table table-bordered table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-invoice"></th>
                            <th>Load #</th>
                            <th>W/O #</th>
                            <th>Customer #</th>
                            <th>Load Create Date</th>
                            <th>Shipper Date</th>
                            <th>Deliver date</th>
                            <th>Carrier</th>
                            <th>Pickup Location</th>
                            <th>Unloading Location</th>
                            <th>Actual Del Date</th>
                            <th>Load Status</th>
                            <th>Aging</th>
                            <!-- <th>File Upload</th> -->
                            <!-- <th>Comments</th> -->
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                           
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="invoice" ole="tabpanel" aria-labelledby="customers-tab">
                <table class="table table-bordered table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-invoice"></th>
                            <th>Load #</th>
                            <th>W/O #</th>
                            <th>Customer #</th>
                            <th>Load Create Date</th>
                            <th>Shipper Date</th>
                            <th>Deliver date</th>
                            <th>Carrier</th>
                            <th>Pickup Location</th>
                            <th>Unloading Location</th>
                            <th>Actual Del Date</th>
                            <th>Load Status</th>
                            <th>Aging</th>
                            <!-- <th>File Upload</th> -->
                            <!-- <th>Comments</th> -->
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr>

                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="agent_data" role="tabpanel" aria-labelledby="customers-tab">
   Agent data
            </div>
    </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>
    // alert('fuck off everone');
    $(document).ready(function () {
        var consigneeCount = 1;

        $('#add_consignee').on('click', function (e) {
            e.preventDefault();

            var newConsigneeSection = $('#consigneeSections .consignee-section:first').clone();

            newConsigneeSection.find('[name^="load_consignee"]').each(function () {
                var currentName = $(this).attr('name');
                $(this).attr('name', currentName.replace('load_consignee', 'load_consignee_' +
                    consigneeCount));
            });

            $('#consigneeSections').append(newConsigneeSection);

            consigneeCount++;
        });
    });

</script>


<script>
    $(document).ready(function () {
        // Add a click event listener to the "Add Charge" button
        $('#addChargeBtn').click(function () {
            // Close the modal with the specified ID
            $('#myModal').modal('hide');
        });
    });

</script>


<script>
    $(function () {
        function fetchCarrierNames(query) {
            if (query.trim() !== '') {
                $.ajax({
                    url: "{{ route('fetch.carrier.names') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    dataType: "json",
                    success: function (response) {
                        var html = '';
                        response.forEach(function (carrierName) {
                            html += '<div class="item" data-value="' + carrierName + '">' +
                                carrierName + '</div>';
                        });
                        $('#carrierList').html(html);
                    }
                });
            } else {
                $('#carrierList').html('');
            }
        }

        $('#load_carrier').keyup(function () {
            var query = $(this).val();
            fetchCarrierNames(query);
        });

        // Listen for click event on carrier list items
        $(document).on('click', '#carrierList .item', function () {
            var selectedCarrier = $(this).text();
            $('#load_carrier').val(selectedCarrier);
            $('#carrierList').html(''); // Clear the list
        });
    });

</script>


<script>
    $(document).ready(function () {
        $('#carrier_mc_ff_input').on('input', function () {
            var mcNumber = $(this).val();
            if (mcNumber.trim() !== '') {
                $.ajax({
                    url: "{{ route('fetch.carrier.details') }}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        mcNumber: mcNumber
                    },
                    success: function (response) {
                        if (response) {
                            $('#load_carrier').val(response.carrier_name ? response
                                .carrier_name : 'No data found in database');
                            $('#load_carrier_phone').val(response.carrier_telephone ?
                                response.carrier_telephone : 'No data found in database'
                            );
                        } else {
                            $('#load_carrier').val('No data found in database');
                            $('#load_carrier_phone').val('No data found in database');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error if needed
                    }
                });
            } else {
                $('#load_carrier').val('');
                $('#load_carrier_phone').val('');
            }
        });
    });

</script>



<script>
    $(function () {
        let customers = [];
        let previousFinalRate = ''; // Store the previous value of shipper_load_final_rate

        // Function to fetch customer names based on the query
        function fetchCustomerNames(query) {
            if (query.trim().length >= 3) {
                $.ajax({
                    url: "{{ route('fetch.customer.details') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    dataType: "json",
                    success: function (response) {
                        customers = response; // Store response data in the customers variable
                        let customerList = response.map(customer => customer.customer_name).join(
                            '\n'); // Generate customer list

                        $('#customerList').val(customerList.trim()); // Set the textarea content
                        $('#customerList').show(); // Show the textarea
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching customer details:', error);
                    }
                });
            } else {
                $('#customerList').val(
                    ''); // Clear the content of the textarea if query length is less than three
                $('#customerList').hide(); // Hide the textarea
            }
        }

        // Handle click event on customer names inside the textarea
        $(document).on('click', '#customerList', function () {
            var selectedCustomerName = $(this).val().split('\n')[
                0]; // Get the first selected customer name
            var selectedCustomer = customers.find(customer => customer.customer_name ===
                selectedCustomerName);
            if (selectedCustomer) {
                $('#load_bill_to').val(selectedCustomer
                    .customer_name); // Fill the input with the selected customer name
                $('#customer_id').val(selectedCustomer
                    .id); // Fill the hidden input with the customer id
                $('#customer_credit_limit').val(selectedCustomer
                    .adv_customer_credit_limit); // Fill the hidden input with the credit limit
                $('#remaining_credit').val(selectedCustomer
                    .remaining_credit); // Fill the hidden input with remaining credit
            }
            $('#customerList').hide(); // Hide the textarea after selection
        });

        // Trigger customer fetching on keyup event
        $('#load_bill_to').keyup(function () {
            var query = $(this).val();
            fetchCustomerNames(query);
            if (query.trim() === '') {
                $('#customer_credit_limit').val(''); // Clear the credit limit if load_bill_to is empty
                $('#customer_id').val(''); // Clear the customer id if load_bill_to is empty
                $('#remaining_credit').val(''); // Clear remaining credit if load_bill_to is empty
            }
        });

        // Function to check if shipper_load_final_rate exceeds the remaining credit
        function checkFinalRate() {
            var finalRate = parseFloat($('#shipper_load_final_rate').val());
            var remainingCredit = parseFloat($('#remaining_credit').val());

            if (!isNaN(finalRate) && !isNaN(remainingCredit) && finalRate > remainingCredit) {
                alert('Limit Exceeded');
                $('#shipper_load_final_rate').val(''); // Optionally clear the value if the limit is exceeded
            }
        }

        // Use setInterval to periodically check for changes in shipper_load_final_rate
        setInterval(function () {
            var currentFinalRate = $('#shipper_load_final_rate').val();
            if (currentFinalRate !== previousFinalRate) {
                previousFinalRate = currentFinalRate;
                checkFinalRate();
            }
        }, 1000); // Check every second
    });

</script>






<!--  -->

<script>
    $(function () {
        function fetchConsigneeNames(query) {
            if (query.trim() !== '') {
                $.ajax({
                    url: "{{ route('fetch.consignee.details') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    dataType: "json",
                    success: function (response) {
                        var html = '';
                        response.forEach(function (consignee) {
                            html +=
                                '<div class="item dropdown-item" style="border: none;padding: 4px 0;" data-name="' +
                                consignee.consignee_name + '" data-address="' + consignee
                                .consignee_address + '" data-city="' + consignee
                                .consignee_city + '" data-state="' + consignee
                                .consignee_state + '" data-country="' + consignee
                                .consignee_country + '" data-zip="' + consignee
                                .consignee_zip + '">' + consignee.consignee_name + '</div>';
                        });
                        $('#consigneeList').html(html).show();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $('#consigneeList').html('').hide();
            }
        }

        $('input[name="load_consignee"]').on('keyup', function () {
            var query = $(this).val();
            fetchConsigneeNames(query);

            // Clear the location field if consignee name is empty
            if (query.trim() === '') {
                $('input[name="load_consignee_location"]').val('');
            }
        });

        // Listen for click event on consignee list items
        $(document).on('click', '#consigneeList .item', function () {
            var selectedConsigneeName = $(this).data('name');
            var selectedConsigneeAddress = $(this).data('address');
            var selectedConsigneeCity = $(this).data('city');
            var selectedConsigneeState = $(this).data('state');
            var selectedConsigneeCountry = $(this).data('country');
            var selectedConsigneeZip = $(this).data('zip');

            // Extract only the country name from the 'selectedConsigneeCountry' attribute
            var countryParts = selectedConsigneeCountry.split(' ');
            var countryName = countryParts.slice(1).join(' ');

            var fullAddress = selectedConsigneeAddress + ', ' + selectedConsigneeCity + ', ' +
                selectedConsigneeState + ', ' + selectedConsigneeZip + ', ' + countryName;

            $('input[name="load_consignee"]').val(selectedConsigneeName);
            $('input[name="load_consignee_location"]').val(fullAddress);
            $('#consigneeList').html('').hide(); // Clear the list
        });


        // Hide the dropdown when clicking outside
        $(document).on('click', function (event) {
            if (!$(event.target).closest('#consigneeList, input[name="load_consignee"]').length) {
                $('#consigneeList').html('').hide();
            }
        });
    });

</script>



<script>
    $(document).ready(function () {
        $('select[name="load_status"]').change(function () {
            var loadId = $(this).data('load-id');
            var selectedOption = $(this).val();

            $.ajax({
                type: 'POST',
                url: '/update-load-status/' + loadId,
                data: {
                    load_status: selectedOption,
                    _token: '{{ csrf_token() }}' // Include CSRF token
                },
                success: function (response) {
                    if (response.success) {
                        console.log('Load status updated successfully:', response.message);
                        location.reload();
                    } else {
                        console.error('Failed to update load status:', response.message);
                        alert('Failed to update load status: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error updating load status:', error);
                    alert('Failed to update load status.');
                }
            });
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script>
    $(document).ready(function () {
        // Initialize FilePond
        FilePond.create(document.querySelector('.filepond'), {
            allowMultiple: true,
            maxFiles: 10,
            maxFileSize: '5MB'
        });
    });

    $('#fileUploadModal').on('hidden.bs.modal', function (e) {
        // Reset FilePond
        FilePond.create(document.querySelector('.filepond'), {
            allowMultiple: true,
            maxFiles: 10,
            maxFileSize: '5MB'
        });
    });

    $('#fileUploadModal').on('show.bs.modal', function (e) {
        // Clear any previous uploaded files
        $('.filepond').filepond('removeFiles');
    });

    // Submit form on FilePond upload
    $('.filepond').on('FilePond:processfile', function (e) {
        $('#fileUploadForm').submit();
    });

    // Handle form submission
    $('#fileUploadForm').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '{{ url("ajaxupload") }}',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    $('#fileUploadModal').modal('hide');
                    alert('Files uploaded successfully');
                    // Redirect to the /load route
                    window.location.href = '/load';
                } else {
                    alert('File upload failed: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                alert('File Uploded successfully please refresh the page: ' + error);
            }
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

<!-- <script>
    $(document).ready(function () {
        // Function to add input row
        $('.create-input').click(function () {
            var inputRow = $('<div class="row">' +
                '<div class="col-md-5"><input style="width:100%;margin-bottom: 29px;" type="text" name="shipper_type_charge[]" placeholder="Type Of Charge"></div>' +
                '<div class="col-md-5"><input style="width:100%;margin-bottom: 29px;" type="number" name="shipper_other_charge[]" placeholder="Price" /></div>' +
                '<div class="col-md-2"><button closebtn" style="border: none;background: unset;"><i class="fa fa-trash"></i></button></div>' +
                '</div>');
            $('#inputs').append(inputRow);
        });

        // Function to remove input row
        $(document).on('click', '.closebtn', function () {
            $(this).parent().remove();
        });
    });
</script> -->

<script>
    $(document).ready(function () {
        // Function to add input row
        $('.create-input').click(function (e) {
            e.preventDefault(); // Prevent the default form submission

            var inputRow = $('<div class="row">' +
                '<div class="col-md-5"><input style="width:100%;margin-bottom: 29px;" type="text" name="shipper_type_charge[]" placeholder="Type Of Charge"></div>' +
                '<div class="col-md-5"><input style="width:100%;margin-bottom: 29px;" type="number" name="shipper_other_charge[]" placeholder="Price" /></div>' +
                '<div class="col-md-2"><button class="closebtn" style="border: none;background: unset;"><i class="fa fa-trash"></i></button></div>' +
                '</div>');
            $('#inputs').append(inputRow);
        });

        // Function to remove input row
        $(document).on('click', '.closebtn', function () {
            $(this).closest('.row').remove();
        });
    });

</script>



<script>
    FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginFileValidateSize,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview
    );
    FilePond.create(
        document.querySelector('input')
    );

</script>



<script>
    function addNewShipperTab() {
        var newForm = $('.shipper-form').first().clone(); // Clone the first shipper form

        // Clear input values of the cloned form
        newForm.find('input').val('');

        // Append the cloned form to the container
        $('#shipperForms').append(newForm);
    }

</script>

<script>
    // Function to add a new shipper form
    function addNewShipperForm() {
        var newForm = $('#shipperForms').children('.shipper-form').first().clone(); // Clone the first shipper form

        // Clear input values of the cloned form
        newForm.find('input').val('');

        // Append the remove button or trash icon to the cloned form
        var removeButton = $(
            '<button class="btn btn-danger remove-btn" onclick="removeShipperForm(this)"><i class="fa fa-trash"></i> Remove</button>'
        );
        newForm.append($('<div class="text-right"></div>').append(removeButton));

        // Append the cloned form to the container
        $('#shipperForms').append(newForm);

        // Show the remove icon for cloned forms
        removeButton.show();
    }

    // Function to remove a shipper form
    function removeShipperForm(button) {
        $(button).closest('.shipper-form').remove(); // Remove the parent shipper form
    }

</script>




<script>
    document.getElementById('hideFormButtonOpen').addEventListener('click', function () {
        var tableRows = document.querySelectorAll('#dataTableOpen tbody tr');
        tableRows.forEach(function (row) {
            row.classList.toggle('blur');
        });
    });

    window.onload = function () {
        var tableRows = document.querySelectorAll('#dataTableOpen tbody tr');
        tableRows.forEach(function (row) {
            row.classList.add('blur');
        });
    };

</script>


<script>
    document.getElementById('hideFormButtondel').addEventListener('click', function () {
        var tbody = document.querySelector('#dataTableDel tbody tr');
        tbody.classList.toggle('blur');
    });

    window.onload = function () {
        var tbody = document.querySelector('#dataTableDel tbody tr');
        tbody.classList.add('blur');
    };

</script>

<script>
    document.getElementById('hideFormButtoncompleted').addEventListener('click', function () {
        var tbody = document.querySelector('#dataTablecompleted tbody');
        tbody.classList.toggle('blur');
    });

    window.onload = function () {
        var tbody = document.querySelector('#dataTablecompleted tbody');
        tbody.classList.add('blur');
    };

</script>


<script>
    document.getElementById('hideFormButtonInvoice').addEventListener('click', function () {
        var tbody = document.querySelector('#dataTableInvoice tbody');
        tbody.classList.toggle('blur');
    });

    window.onload = function () {
        var tbody = document.querySelector('#dataTableInvoice tbody');
        tbody.classList.add('blur');
    };

</script>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<script>
    $(document).ready(function () {
        let nextShipperNumber = 2; // Start with the next shipper number to be 2

        $('#addBtn').click(function () {
            let currentShipperNumber = nextShipperNumber++;

            let dynamicRowHTML =
                `<li class="nav-item d-flex" data-shipper-number="${currentShipperNumber}"><a class="nav-link p-0" id="formTab${currentShipperNumber}" data-bs-toggle="tab" href="#shipperForm${currentShipperNumber}" role="tab" aria-controls=shipperForm${currentShipperNumber}" aria-selected="true">Shipper ${currentShipperNumber}</a><i class="fa fa-trash remove" style="margin-top: 1px;margin-left: 12px;"></i></li>`;

            $('#navTabs').append(dynamicRowHTML);
            let formHTML =
                `<div class="tab-pane fade" id="shipperForm${currentShipperNumber}" role="tabpanel" aria-labelledby="formTab${currentShipperNumber}"><div class="row shipper-form">
                <div class="col-md-3">
                <div class="form-group">
                <label>Shipper<code>*</code><button type="button" data-toggle="modal" data-target="#add-shipper" style="background:0 0;border:none"><i class="fa fa-plus"></i>Add New</button></label>
                <input class="form-control load_shipper" name="load_shipper${currentShipperNumber}" id="load_shipper${currentShipperNumber}" required autocomplete="off" style="width:100%">
                <div class="form-control" style="height: auto !important; width: 100% !important;font-size: 11px;" readonly="" id="shipperList${currentShipperNumber}"></div>
                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                <label>Location</label>
                <input class="form-control load_shipper_location" name="load_shipper_location${currentShipperNumber}" id="load_shipper_location${currentShipperNumber}" style="width:100%">
                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group"><label>Appointment</label><input class="form-control" type="datetime-local" name="load_shipper_appointment${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Description</label><input class="form-control" name="load_shipper_description${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Commodity Type</label><input class="form-control select2" name="load_shipper_commodity_type${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Commodity Name<code>*</code></label><input class="form-control" name="load_shipper_commodity${currentShipperNumber}" type="text" required style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Qty</label><input type="number" class="form-control" name="load_shipper_qty${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Weight (lbs)</label><input class="form-control" type="number" name="load_shipper_weight${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Value($)<code>*</code></label><input type="number" class="form-control" name="load_shipper_value${currentShipperNumber}" required style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Shipping Notes</label><input class="form-control" name="load_shipper_shipping_notes${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>PO Numbers</label><input class="form-control" name="load_shipper_po_numbers${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Contact Number</label><input class="form-control" type="number" name="load_shipper_contact${currentShipperNumber}" style="width:100%"></div></div></div></div>`;

            $('#tabContent').append(formHTML);

            // Attach event handlers to the new shipper form inputs
            attachAutoCompleteHandlers(currentShipperNumber);
        });

        $('#navTabs').on('click', '.remove', function () {
            let tabId = $(this).parent('.nav-item').find('a').attr('href');
            $(this).parent('.nav-item').remove();
            $(tabId).remove();

            reorderShippers();
        });

        function reorderShippers() {
            let shipperCount = 1;
            $('#navTabs .nav-item').each(function () {
                let newShipperNumber = shipperCount++;
                let $navItem = $(this);
                let $navLink = $navItem.find('.nav-link');
                let oldShipperNumber = $navLink.attr('id').match(/\d+/)[0];

                // Update nav item
                $navLink.attr('id', `formTab${newShipperNumber}`);
                $navLink.attr('href', `#shipperForm${newShipperNumber}`);
                $navLink.attr('aria-controls', `shipperForm${newShipperNumber}`);
                $navLink.text(`Shipper ${newShipperNumber}`);

                // Update tab content
                let $tabContent = $(`#shipperForm${oldShipperNumber}`);
                $tabContent.attr('id', `shipperForm${newShipperNumber}`);
                $tabContent.attr('aria-labelledby', `formTab${newShipperNumber}`);

                // Update form fields' names and ids inside the tab content
                $tabContent.find('input, select').each(function () {
                    let $input = $(this);
                    let name = $input.attr('name');
                    let id = $input.attr('id');

                    if (name) {
                        $input.attr('name', name.replace(/\d+/, newShipperNumber));
                    }
                    if (id) {
                        $input.attr('id', id.replace(/\d+/, newShipperNumber));
                    }
                });
            });

            // Reset the next shipper number to the new count
            nextShipperNumber = shipperCount;
        }

        function attachAutoCompleteHandlers(shipperNumber) {
            $(`input[name="load_shipper${shipperNumber}"]`).on('keyup', function () {
                var query = $(this).val();
                fetchShipperNames(query, shipperNumber);

                // Clear the location field if shipper name is empty
                if (query.trim() === '') {
                    $(`input[name="load_shipper_location${shipperNumber}"]`).val('');
                }
            });

            // Listen for click event on shipper list items
            $(document).on('click', `#shipperList${shipperNumber} .item`, function () {
                var selectedShipperName = $(this).data('name');
                var selectedShipperAddress = $(this).data('address');
                var selectedShipperCity = $(this).data('city');
                var selectedShipperState = $(this).data('state');
                var selectedShipperCountry = $(this).data('country');
                var selectedShipperZip = $(this).data('zip');

                // Extract only the country name from the 'selectedShipperCountry' attribute
                var countryParts = selectedShipperCountry.split(' ');
                var countryName = countryParts.slice(1).join(' ');

                var fullAddress = selectedShipperAddress + ', ' + selectedShipperCity + ', ' +
                    selectedShipperState + ', ' + selectedShipperZip + ', ' + countryName;

                $(`input[name="load_shipper${shipperNumber}"]`).val(selectedShipperName);
                $(`input[name="load_shipper_location${shipperNumber}"]`).val(fullAddress);
                $(`#shipperList${shipperNumber}`).html('').hide(); // Clear the list
            });


            // Hide the dropdown when clicking outside
            $(document).on('click', function (event) {
                if (!$(event.target).closest(
                        `#shipperList${shipperNumber}, input[name="load_shipper${shipperNumber}"]`)
                    .length) {
                    $(`#shipperList${shipperNumber}`).html('').hide();
                }
            });
        }


    });

</script>


<script>
    $(document).ready(function () {
        let nextConsigneeNumber = 2; // Start with the next consignee number to be 2

        $('#addBtnconsignee').click(function () {
            let currentConsigneeNumber = nextConsigneeNumber++;

            let dynamicRowHTML = `
                <li class="nav-item d-flex" data-consignee-number="${currentConsigneeNumber}">
                    <a class="nav-link p-0" id="formTab${currentConsigneeNumber}" data-bs-toggle="tab" href="#consigneeSections${currentConsigneeNumber}" role="tab" aria-controls="consigneeSections${currentConsigneeNumber}" aria-selected="true">Consignee ${currentConsigneeNumber}</a>
                    ${currentConsigneeNumber > 1 ? '<i class="fa fa-trash remove" style="margin-top: 1px;margin-left: 12px;"></i>' : ''}
                </li>
            `;
            $('#navTabs1').append(dynamicRowHTML);

            let formHTML = `
                <div class="tab-pane fade" id="consigneeSections${currentConsigneeNumber}" role="tabpanel" aria-labelledby="formTab${currentConsigneeNumber}">
                    <div id="consignee-section">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Consignee <code>*</code>
                                        <button type="button" data-toggle="modal" data-target="#add-consigne" style="background: none; border: none;">
                                            <i class="fa fa-plus"></i>Add New
                                        </button>
                                    </label>
                                    <input class="form-control" name="load_consignee${currentConsigneeNumber}" required style="width: 100%;">
                                    <div class="form-control" style="height: auto !important; width: 100% !important; font-size: 11px;" readonly="" id="consigneeList${currentConsigneeNumber}"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input class="form-control" name="load_consignee_location${currentConsigneeNumber}" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Appointment</label>
                                    <input class="form-control" type="datetime-local" name="load_consignee_appointment${currentConsigneeNumber}" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input class="form-control" name="load_consignee_description${currentConsigneeNumber}" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Commodity Type</label>
                                    <input class="form-control select2" name="load_consignee_type${currentConsigneeNumber}" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Commodity Name <code>*</code></label>
                                    <input class="form-control" name="load_consignee_commodity${currentConsigneeNumber}" type="text" required style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input class="form-control" name="load_consignee_qty${currentConsigneeNumber}" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Weight (lbs)</label>
                                    <input class="form-control" type="number" name="load_consignee_weight${currentConsigneeNumber}" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Value($)<code>*</code></label>
                                    <input class="form-control" type="number" name="load_consignee_value${currentConsigneeNumber}" required style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Consignee Notes</label>
                                    <input class="form-control" name="load_consignee_delivery_notes${currentConsigneeNumber}" style="width: 100%;">
                                    <textarea class="form-control" name="load_consignee_notes${currentConsigneeNumber}" style="width: 100%; height: 31px !important;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>PO Numbers</label>
                                    <input class="form-control" name="load_consignee_po_numbers${currentConsigneeNumber}" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input class="form-control" type="number" name="load_consignee_contact${currentConsigneeNumber}" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('#tabContent1').append(formHTML);

            // Attach autocomplete functionality for the newly added consignee section
            attachAutoCompleteHandlers(currentConsigneeNumber);
        });

        $('#navTabs1').on('click', '.remove', function () {
            $(this).parent('.nav-item').remove();
            let tabId = $(this).parent('.nav-item').find('a').attr('href');
            $(tabId).remove();

            reorderConsignees();
        });

        function reorderConsignees() {
            let consigneeCount = 1;
            $('#navTabs1 .nav-item').each(function () {
                let newConsigneeNumber = consigneeCount++;
                let $navItem = $(this);
                let $navLink = $navItem.find('.nav-link');
                let oldConsigneeNumber = $navLink.attr('id').match(/\d+/)[0];

                // Update nav item
                $navLink.attr('id', `formTab${newConsigneeNumber}`);
                $navLink.attr('href', `#consigneeSections${newConsigneeNumber}`);
                $navLink.attr('aria-controls', `consigneeSections${newConsigneeNumber}`);
                $navLink.text(`Consignee ${newConsigneeNumber}`);

                // Update tab content
                let $tabContent = $(`#consigneeSections${oldConsigneeNumber}`);
                $tabContent.attr('id', `consigneeSections${newConsigneeNumber}`);
                $tabContent.attr('aria-labelledby', `formTab${newConsigneeNumber}`);

                // Update form fields' names and ids inside the tab content
                $tabContent.find('input, select, textarea').each(function () {
                    let $input = $(this);
                    let name = $input.attr('name');
                    let id = $input.attr('id');

                    if (name) {
                        $input.attr('name', name.replace(/\d+/, newConsigneeNumber));
                    }
                    if (id) {
                        $input.attr('id', id.replace(/\d+/, newConsigneeNumber));
                    }
                });
            });

            // Reset the next consignee number to the new count
            nextConsigneeNumber = consigneeCount;
        }

        // Attach autocomplete functionality for the initial consignee section
        attachAutoCompleteHandlers(1);

        function attachAutoCompleteHandlers(consigneeNumber) {
            $(`input[name="load_consignee${consigneeNumber}"]`).on('keyup', function () {
                var query = $(this).val().trim();
                fetchConsigneeNames(query, consigneeNumber);

                // Clear the location field if consignee name is empty
                if (query === '') {
                    $(`input[name="load_consignee_location${consigneeNumber}"]`).val('');
                }
            });

            // Listen for click event on consignee list items
            $(document).on('click', `#consigneeList${consigneeNumber} .item`, function () {
                var selectedConsigneeName = $(this).data('name');
                var selectedConsigneeAddress = $(this).data('address');
                var selectedConsigneeCity = $(this).data('city');
                var selectedConsigneeState = $(this).data('state');
                var selectedConsigneeCountry = $(this).data('country');
                var selectedConsigneeZip = $(this).data('zip');

                // Extract only the country name from the 'selectedConsigneeCountry' attribute
                var countryParts = selectedConsigneeCountry.split(' ');
                var countryName = countryParts.slice(1).join(' ');

                // Format the full address in the desired order
                var fullAddress = selectedConsigneeAddress + ', ' + selectedConsigneeCity + ', ' +
                    selectedConsigneeState + ', ' + selectedConsigneeZip + ', ' + countryName;

                $(`input[name="load_consignee${consigneeNumber}"]`).val(selectedConsigneeName);
                $(`input[name="load_consignee_location${consigneeNumber}"]`).val(fullAddress);
                $(`#consigneeList${consigneeNumber}`).html('').hide(); // Clear the list
            });


            // Hide the dropdown when clicking outside
            $(document).on('click', function (event) {
                if (!$(event.target).closest(
                        `#consigneeList${consigneeNumber}, input[name="load_consignee${consigneeNumber}"]`
                    ).length) {
                    $(`#consigneeList${consigneeNumber}`).html('').hide();
                }
            });
        }

        function fetchConsigneeNames(query, consigneeNumber) {
            if (query !== '') {
                $.ajax({
                    url: "{{ route('fetch.consignee.details') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    dataType: "json",
                    success: function (response) {
                        var html = '';
                        response.forEach(function (consignee) {
                            html +=
                                `<div class="item dropdown-item" data-name="${consignee.consignee_name}" data-address="${consignee.consignee_address}" data-city="${consignee.consignee_city}" data-state="${consignee.consignee_state}" data-country="${consignee.consignee_country}" data-zip="${consignee.consignee_zip}">${consignee.consignee_name}</div>`;
                        });
                        $(`#consigneeList${consigneeNumber}`).html(html).show();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $(`#consigneeList${consigneeNumber}`).html('').hide();
            }
        }
    });

</script>


<script>
    $(document).ready(function () {
        // Function to update final amount
        function updateFinalAmount() {
            var totalAmount = 0;
            // Loop through each shipper charge input field
            $('.shipperCharge').each(function () {
                var chargeAmount = parseFloat($(this).val()) || 0;
                // Add charge amount to total amount
                totalAmount += chargeAmount;
            });
            // Display total amount in the final input field
            $('#load_shipper_other_charges_input').val(totalAmount.toFixed(2));
        }

        // Add Charge Button Click Event
        $('#addChargeBtn').click(function () {
            // Clone the charge row and append it to the modal body
            $('#chargeRows').append(
                '<div class="col-md-6"><div class="form-group"><label>Charge Amount:</label><input type="number" class="form-control shipperCharge" name="shipperchargeAmount[]" placeholder="Enter charge amount"></div></div>'
            );
        });

        // Remove Charge Button Click Event (Delegated event handling)
        $(document).on('click', '.remove-charge', function () {
            // Remove the parent row of the clicked remove button
            $(this).closest('.col-md-6').remove();
            // Update the final amount after removing the charge
            updateFinalAmount();
        });

        // Update final amount whenever shipper charge amount changes
        $(document).on('input', '.shipperCharge', function () {
            // Update the final amount
            updateFinalAmount();
        });
    });

</script>


<script>
    $(document).ready(function () {
        $('#fileUploadForm').fileupload({
            dataType: 'json',
            done: function (e, data) {
                // Handle successful upload
                if (data.result.success) {
                    alert('Files uploaded successfully');
                } else {
                    alert('File upload failed: ' + data.result.message);
                }
            },
            fail: function (e, data) {
                // Handle upload failure
                alert('File upload failed');
            }
        });
    });

</script>


<script>
    $(document).ready(function () {
        $('#select-invoice').click(function () {
            $('.selected-invoice').prop('checked', this.checked);
        });

        $('.selected-invoice').click(function () {
            if ($('.selected-invoice:checked').length == $('.selected-invoice').length) {
                $('#select-invoice').prop('checked', true);
            } else {
                $('#select-invoice').prop('checked', false);
            }
        });
    });

</script>

<script>
    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.shipperchargeAmount').forEach(function (input) {
            let value = parseFloat(input.value);
            if (!isNaN(value)) {
                total += value;
            }
        });
        document.getElementById('totalShipperOtherChgarges').value = total.toFixed(2);
    }

    document.querySelectorAll('.shipperchargeAmount').forEach(function (input) {
        input.addEventListener('input', calculateTotal);
    });

    document.getElementById('addChargeBtn').addEventListener('click', function () {
        const template = document.getElementById('chargeRowTemplate');
        const clone = template.cloneNode(true);
        clone.style.display = 'flex';
        document.querySelector('.modal-body .container').appendChild(clone);
        clone.querySelectorAll('.shipperchargeAmount').forEach(function (input) {
            input.addEventListener('input', calculateTotal);
        });
        clone.querySelector('.remove-charge').addEventListener('click', function () {
            clone.remove();
            calculateTotal();
        });
    });

    document.querySelectorAll('.remove-charge').forEach(function (button) {
        button.addEventListener('click', function () {
            button.closest('.row').remove();
            calculateTotal();
        });
    });

</script>

<script>
    $(".readonly").on('keydown paste focus mousedown', function (e) {
        if (e.keyCode != 4) // ignore tab
            e.preventDefault();
    });

</script>



<script>
    $(document).ready(function () {
        function fetchShipperNames(query) {
            if (query.trim() !== '') {
                $.ajax({
                    url: "{{ route('fetch.shipper.details') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    dataType: "json",
                    success: function (response) {
                        var html = '';
                        if (response.error) {
                            html =
                                '<div class="item dropdown-item" style="border: none;padding: 4px 0;">' +
                                response.error + '</div>';
                        } else {
                            response.forEach(function (shipper) {
                                html +=
                                    '<div class="item dropdown-item" style="border: none;padding: 4px 0;" ' +
                                    'data-name="' + shipper.shipper_name + '" ' +
                                    'data-address="' + shipper.shipper_address + '" ' +
                                    'data-city="' + shipper.shipper_city + '" ' +
                                    'data-state="' + shipper.shipper_state + '" ' +
                                    'data-country="' + shipper.shipper_country + '" ' +
                                    'data-zip="' + shipper.shipper_zip + '">' +
                                    shipper.shipper_name + '</div>';
                            });
                        }
                        $('#shipperList').html(html).show();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $('#shipperList').html('').hide();
            }
        }

        $('#load_shipper').on('keyup', function () {
            var query = $(this).val();
            fetchShipperNames(query);

            // Clear the location field if shipper name is empty
            if (query.trim() === '') {
                $('#load_shipper_location').val('');
            }
        });

        // Listen for click event on shipper list items
        $(document).on('click', '#shipperList .item', function () {
            var selectedShipperName = $(this).data('name');
            var selectedShipperAddress = $(this).data('address');
            var selectedShipperCity = $(this).data('city');
            var selectedShipperState = $(this).data('state');
            var selectedShipperCountry = $(this).data('country');
            var selectedShipperZip = $(this).data('zip');

            // Extract only the country name from the 'selectedShipperCountry' attribute
            var countryParts = selectedShipperCountry.split(' ');
            var countryName = countryParts.slice(1).join(' ');

            // Format the full address as "address, city, state, zip, country"
            var fullAddress = selectedShipperAddress + ', ' + selectedShipperCity + ', ' +
                selectedShipperState + ', ' + selectedShipperZip + ', ' + countryName;

            $('#load_shipper').val(selectedShipperName);
            $('#load_shipper_location').val(fullAddress);
            $('#shipperList').html('').hide(); // Clear the list
        });

        // Hide the dropdown when clicking outside
        $(document).on('click', function (event) {
            if (!$(event.target).closest('#shipperList, #load_shipper').length) {
                $('#shipperList').html('').hide();
            }
        });
    });

</script>
<!-- Load Scripts Runs Here -->
<script>
    $(document).ready(function() {
        alert('Hello');
        // getLoadData();
        $('.load-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('loads.data') }}',
        type: 'GET',
        data: function(d) {
            d.id = 52;
        }
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'load_number', name: 'load_number' },
        { data: 'customer_refrence_number', name: 'customer_refrence_number' },
        { data: 'load_bill_to', name: 'load_bill_to' },
        { data: 'created_at', name: 'created_at' },
        { data: 'created_at', name: 'created_at' },
        { data: 'created_at', name: 'created_at' },
        { data: 'load_carrier', name: 'load_carrier' },
        { data: 'load_carrier', name: 'load_carrier' },
        { data: 'load_carrier', name: 'load_carrier' },
        { data: 'load_actual_delivery_date', name: 'load_actual_delivery_date' },
        { data: 'load_status', name: 'load_status' },
        { data: 'load_status', name: 'load_status' },
        { data: 'load_status', name: 'load_status' },
        { data: 'cpr_check', name: 'cpr_check' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});


        $('.broker-user-id').on('change', function() {
            // getLoadData();
        });

        function getLoadData() {
            var userId = $('#broker-user-id').val();
            userId = 52;

            console.log('Fetching data for user ID:', userId); // Debugging line

            // Destroy the existing DataTable if it exists
            if ($.fn.DataTable.isDataTable('.load-table')) {
                $('.load-table').DataTable().destroy();
            }

            $('.load-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('loads.data') }}',
                    type: 'GET',
                    data: function(d) {
                        d.id = userId; // Pass the user ID as a parameter in the AJAX call
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'customer_id', name: 'customer_id' },
                    { data: 'load_number', name: 'load_number' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        }
    });
</script>
@endsection
