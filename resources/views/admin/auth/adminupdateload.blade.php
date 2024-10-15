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
    .card-title {
        font-size: 13px;
        text-align: left;
        font-weight: 700;
    }
    .modal-content{
    padding: 12px 12px !important;
}
.nav {
    align-items: end;
    justify-content: left;
    width: 100%;
}
.card-body1 .form-group label {
    margin-bottom: 4px;
    font-weight: 600;
    font-size: 11px;
    text-align: left;
    color: #4a4a4a;
}
    .card-body {
        padding: 0;
    }

    .item {
        border: 1px solid #b4bbc1;
        padding: 3px;
        margin: 5px 0 0 0px;
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
        margin: -8px 0 0 0;
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
</style>
<section class="content">
    <div class="body_scroll">
        <div class="block-header" style="padding: 16px 15px !important">
            <h2>Load Data </h2>
        </div>

        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body"> 
                        <form method="POST" action="{{ route('admin.update.load', ['id' => $load->id]) }}" id="myFormLoad" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                    <div class="card-header">
                                        <h3 class="card-title" style="font-size:13px;">Add Load</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Load Number <code>*</code></label>
                                                    <input class="form-control" name="load_number" disabled
                                                        value="{{ $post->load_number }}" style="width: 100%;">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Bill To <code>*</code>&nbsp;
                                                        <a href="{{ route('customer') }}" target="blank" style="background: none; border: none;">
                                                            <i class="fa fa-plus mr-1"></i>Add New
                                                        </a>
                                                    </label>
                                                    <input type="text" id="load_bill_to" name="load_bill_to"
                                                        class="form-control" placeholder="Search Customer names..."
                                                        autocomplete="off" value="{{ $post->load_bill_to }}">
                                                    <input id="customerList" class="form-control"
                                                        style="display: none;" readonly></input>

                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Dispatcher <code>*</code></label>
                                                    <input class="form-control" name="load_dispatcher"
                                                        value="{{ $post->user->name }}" required readonly
                                                        style="width: 100%;">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control select2" name="load_status"
                                                        style="width: 100%;">
                                                        <option selected="selected" value="{{ $post->load_status }}">
                                                            {{ $post->load_status }}</option>
                                                        <option>Open</option>
                                                        <option>Covered</option>
                                                        <option>Dispatched</option>
                                                        <option>Loading</option>
                                                        <option>On Route</option>
                                                        <option>Un loading</option>
                                                        <option>Deliverd</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Work Order </label>
                                                    <input class="form-control" name="load_workorder"
                                                        value="{{ $post->load_workorder }}" style="width: 100%;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Payment Type <code>*</code></label>
                                                    <select class="form-control select2" required
                                                        name="load_payment_type" style="width: 100%;">
                                                        <option selected="selected"
                                                            value="{{ $post->load_payment_type }}">
                                                            {{ $post->load_payment_type }}"</option>
                                                        <option>Prepaid</option>
                                                        <option>Postpaid</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Load type</label>
                                                    <div class="select2-purple">
                                                        <select class="form-control select2" name="load_type_two"
                                                            style="width: 100%;">
                                                            <option selected="selected"
                                                                value="{{ $post->load_type_two }}">
                                                                {{ $post->load_type_two }} </option>
                                                            <option>OTR</option>
                                                            <option>DRAYAGE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Type <code>*</code></label>
                                                    <input class="form-control" required name="load_type"
                                                        value="{{ $post->load_type }}" style="width: 100%;">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Shipper Rate <code>*</code></label>
                                                    <input type="number" class="form-control number value" name="load_shipper_rate" id="load_shipper_rate" required value="{{ $post->load_shipper_rate }}" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>F.S.C Rate % <input hidden type="checkbox"
                                                            name="calculate_fsc_percentage"
                                                            id="calculate_fsc_percentage"></label>
                                                    <input class="form-control number percent" name="load_fsc_rate"
                                                        id="load_fsc_rate" value="{{ $post->load_fsc_rate }}"
                                                        style="width: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="other_charge">Other Change &nbsp; <i
                                                            class="fa fa-plus" data-toggle="modal"
                                                            data-target="#myModal" id="load_shipper_other_charges"></i>
                                                    </label>
                                                    <input class="form-control" style="width: 100%;">
                                                </div>
                                                <div class="modal close_shipper_other_charges_form" id="myModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Shipper Other Charges</h4>
                                                            </div>

                                                            <!-- Modal Body -->
                                                            <div class="modal-body">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="shipperchargeType">Charge
                                                                                    Type:</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="shipperchargeType[]"
                                                                                    value="{{ $post->load_other_change }} "
                                                                                    placeholder="Enter charge type">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Charge
                                                                                    Amount:</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    name="shipperchargeAmount[]"
                                                                                    placeholder="Enter charge amount"
                                                                                    value="{{ $post->load_other_change }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row" id="chargeRowTemplate"
                                                                        style="display: none;">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="shipperchargeType">Charge
                                                                                    Type:</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="shipperchargeType[]"
                                                                                    placeholder="Enter charge type">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Charge
                                                                                    Amount:</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    name="shipperchargeAmount[]"
                                                                                    placeholder="Enter charge amount">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Modal Footer -->
                                                            <div class="modal-footer">

                                                                <button type="button" class="btn btn-success"
                                                                    id="addChargeBtn">Add
                                                                    Charge</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Final Shipper Rate</label>
                                                    <!-- <input class="form-control" disabled name="shipper_load_final_rate" id="shipper_load_final_rate" value="{{ $post->shipper_load_final_rate }}" style="width: 100%;"> -->
                                                    <input type="text" class="form-control" name="shipper_load_final_rate" id="shipper_load_final_rate" value="{{ $post->shipper_load_final_rate }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>MC No <code>*</code></label>
                                                    <input class="form-control" required name="load_mc_no"
                                                        id="carrier_mc_ff_input" style="width: 100%;"
                                                        placeholder="Enter MC Number" value="{{ $post->load_mc_no }}">

                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Carrier <code>*</code></label>
                                                    <!-- <input type="text" id="load_carrier" name="load_carrier" class="form-control" style="width: 100%;" value="{{ $post->load_carrier }}" disabled> -->
                                                    <input type="text" id="load_carrier" name="load_carrier" value="{{ $post->load_carrier }}" class="form-control" style="width: 100%;" readonly>
                                                    
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Carrier Phone<code>*</code></label>
                                                    <!-- <input type="text" id="load_carrier_phone" name="load_carrier_phone" class="form-control" style="width: 100%;" value="{{ $post->load_carrier_phone }}" disabled> -->
                                                        <input type="text" id="load_carrier_phone" name="load_carrier_phone" value="{{ $post->load_carrier_phone }}" class="form-control" style="width: 100%;" readonly>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Advance Payment</label>
                                                    <input class="form-control" name="load_advance_payment"
                                                        value="{{ $post->load_advance_payment }}" style="width: 100%;"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Billing Type</label>
                                                    <select class="form-control select2" name="load_billing_type"
                                                        style="width: 100%;">
                                                        <option selected="selected"
                                                            value="{{ $post->load_billing_type }}">
                                                            {{ $post->load_billing_type }}</option>
                                                        <option>Factoring</option>
                                                        <option>Direct Billing</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Carrier Fee <code>*</code></label>
                                                    <input class="form-control" type="number" name="load_carrier_fee"
                                                        id="load_carrier_fee" value="{{ $post->load_carrier_fee }}"
                                                        required style="width: 100%;">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label>FSC Rate %</label>
                                                    <input type="text" name="load_billing_fsc_rate"
                                                        id="load_billing_fsc_rate" class="form-control"
                                                        value="{{ $post->load_billing_fsc_rate }}" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="other_charge">Other Charges <i class="fa fa-plus"
                                                            id="openModalIcon"></i> </label>

                                                    <input class="form-control" name="load_other_charge"
                                                        style="width: 100%;">
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="otherChargesModal" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content" id="model_content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Other
                                                                    Charges
                                                                </h5>
                                                                <!-- <input type="text" disabled name="totalothercharge" id="totalothercharge"> -->
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Add content for the modal body -->
                                                                <div class="container" id="container">
                                                                    <div class="row" id="chargeRowTemplate"
                                                                        style="margin-top: 10px;">
                                                                        <!-- Existing code for the first row -->

                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                    class="form-control typeofcharge"
                                                                                    placeholder="Please enter type of charges"
                                                                                    name="inputBox1[]"
                                                                                    value="{{ $post->load_other_charge }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <div class="form-group">
                                                                                <input type="text" value="="
                                                                                    class="form-control"
                                                                                    style="border: unset;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <input type="number"
                                                                                    class="form-control otheramount"
                                                                                    placeholder="Please enter amount"
                                                                                    name="inputBox2[]"
                                                                                    value="{{ $post->load_other_charge }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <a type="button"
                                                                                class="btn btn-sm btn-danger remove-charge">
                                                                                <i class="fa fa-window-close"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-info"
                                                                        id="add_charge">Add
                                                                        Charge</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Final Carrier Fee</label>
                                                    <input class="form-control" readonly name="load_final_carrier_fee"
                                                        value="{{ $post->load_final_carrier_fee }}"
                                                        id="load_final_carrier_fee" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Currency</label>
                                                    <select class="form-control select2" name="load_currency"
                                                        style="width: 100%;">
                                                        <option selected="selected"
                                                            value="{{ $post->load_carrier_fee }}">
                                                            {{ $post->load_carrier_fee }}</option>
                                                        <option>$</option>
                                                        <option>CAD</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Equipment Type <code>*</code></label>
                                                    <select class="form-control select2" required
                                                        name="load_equipment_type" style="width: 100%;">
                                                        <option selected="selected"
                                                            value="{{ $post->load_equipment_type }}">
                                                            {{ $post->load_equipment_type }}</option>
                                                        <option value="22' VAN">22' VAN</option>
                                                        <option value="48' Reefer">48' Reefer</option>
                                                        <option value="53' Reefer">53' Reefer</option>
                                                        <option value="53' VAN">53' VAN</option>
                                                        <option value="Air Freight">Air Freight</option>
                                                        <option value="Anhydros Ammonia">Anhydros
                                                            Ammonia</option>
                                                        <option value="Animal Carrier">Animal Carrier
                                                        </option>
                                                        <option value="Any Equipment">Any Equipment
                                                        </option>
                                                        <option value="Searching Services only">Any
                                                            Equipment (Searching
                                                            Services
                                                            only)</option>
                                                        <option value="Auto Carrier">Auto Carrier
                                                        </option>
                                                        <option value="B-Train/Supertrain">
                                                            B-Train/Supertrain</option>
                                                        <option value="Canada Only">B-Train/Supertrain
                                                            (Canada Only)</option>
                                                        <option value="Beam">Beam</option>
                                                        <option value="Belly Dump">Belly Dump</option>
                                                        <option value="Blanket Wrap Van">Blanket Wrap
                                                            Van</option>
                                                        <option value="Boat Hauling Trailer">Boat
                                                            Hauling Trailer</option>
                                                        <option value="Cargo Van (1 Ton)">Cargo Van (1
                                                            Ton)</option>
                                                        <option value="Cargo Vans (1 Ton capacity)">
                                                            Cargo Vans (1 Ton capacity)
                                                        </option>
                                                        <option value="Cargo/Small/Sprinter Van">
                                                            Cargo/Small/Sprinter Van
                                                        </option>
                                                        <option value="Conestoga">Conestoga</option>
                                                        <option value="Container Trailer">Container
                                                            Trailer</option>
                                                        <option value="Convertible Hopper">Convertible
                                                            Hopper</option>
                                                        <option value="Conveyor Belt">Conveyor Belt
                                                        </option>
                                                        <option value="Crane Truck">Crane Truck</option>
                                                        <option value="Curtain Siders">Curtain Siders
                                                        </option>
                                                        <option value="Curtain Van">Curtain Van</option>
                                                        <option value="Double Drop">Double Drop</option>
                                                        <option value="Double Drop Extendable">Double
                                                            Drop Extendable</option>
                                                        <option value="Drive Away">Drive Away</option>
                                                        <option value="Dump Trucks">Dump Trucks</option>
                                                        <option value="End Dump">End Dump</option>
                                                        <option value="Flat Intermodal">Flat Intermodal
                                                        </option>
                                                        <option value="Flat with Traps">Flat with Traps
                                                        </option>
                                                        <option value="FlatBed">FlatBed</option>
                                                        <option value="FlatBed - Air-ride">FlatBed -
                                                            Air-ride</option>
                                                        <option value="Flatbed Blanket Wrapped">Flatbed
                                                            Blanket Wrapped</option>
                                                        <option value="Flatbed Intermodal">Flatbed
                                                            Intermodal</option>
                                                        <option value="Flatbed or Step Deck">Flatbed or
                                                            Step Deck</option>
                                                        <option value="Flatbed or Van">Flatbed or Van
                                                        </option>
                                                        <option value="Flatbed or Vented Van">Flatbed or
                                                            Vented Van</option>
                                                        <option value="Flatbed Over-Dimension Loads">
                                                            Flatbed Over-Dimension
                                                            Loads
                                                        </option>
                                                        <option value="Flatbed With Sides">Flatbed With
                                                            Sides</option>
                                                        <option value="Flatbed, Step Deck or Van">
                                                            Flatbed, Step Deck or Van
                                                        </option>
                                                        <option value="Flatbed, Van or Reefer">Flatbed,
                                                            Van or Reefer</option>
                                                        <option value="Flatbed, Vented Van or Reefer">
                                                            Flatbed, Vented Van or
                                                            Reefer
                                                        </option>
                                                        <option value="Haul and Tow Unit">Haul and Tow
                                                            Unit</option>
                                                        <option value="Hazardous Material Load">
                                                            Hazardous Material Load</option>
                                                        <option value="Hopper Bottom">Hopper Bottom
                                                        </option>
                                                        <option value="Hot Shot">Hot Shot</option>
                                                        <option value="Labour">Labour</option>
                                                        <option value="Landoll Flatbed">Landoll Flatbed
                                                        </option>
                                                        <option value="Live Bottom Trailer">Live Bottom
                                                            Trailer</option>
                                                        <option value="Load-Out">Load-Out</option>
                                                        <option value="Load-Out are empty trailers you load and haul">
                                                            Load-Out
                                                            are
                                                            empty trailers you load and haul</option>
                                                        <option value="Lowboy">Lowboy</option>
                                                        <option value="Lowboy Over-Dimension Loads">
                                                            Lowboy Over-Dimension Loads
                                                        </option>
                                                        <option value="Maxi or Double Flat Trailers">
                                                            Maxi or Double Flat
                                                            Trailers
                                                        </option>
                                                        <option value="Mobile Home">Mobile Home</option>
                                                        <option value="Moving Van">Moving Van</option>
                                                        <option value="Multi-Axle Heavy Hauler">
                                                            Multi-Axle Heavy Hauler</option>
                                                        <option value="Ocean Freight">Ocean Freight
                                                        </option>
                                                        <option value="Open Top">Open Top</option>
                                                        <option value="Open Top Van">Open Top Van
                                                        </option>
                                                        <option value="Pneumatic">Pneumatic</option>
                                                        <option value="Power Only">Power Only</option>
                                                        <option value="Power Only (Tow-Away)">Power Only
                                                            (Tow-Away)</option>
                                                        <option value="Rail">Rail</option>
                                                        <option value="Reefer Pallet Exchange">Reefer
                                                            Pallet Exchange</option>
                                                        <option value="Refrigerated (Reefer)">
                                                            Refrigerated (Reefer)</option>
                                                        <option value="Refrigerated Carrier with Plant Decking">
                                                            Refrigerated
                                                            Carrier
                                                            with Plant Decking</option>
                                                        <option value="Refrigerated Intermodal">
                                                            Refrigerated Intermodal</option>
                                                        <option value="Removable Goose Neck">Removable
                                                            Goose Neck</option>
                                                        <option value="Multi-Axle Heavy Haulers">
                                                            Removable Goose Neck &amp;
                                                            Multi-Axle Heavy Haulers</option>
                                                        <option value="GN Extendable">RGN Extendable
                                                        </option>
                                                        <option value="Roll Top Conestoga">Roll Top
                                                            Conestoga</option>
                                                        <option value="Roller Bed">Roller Bed</option>
                                                        <option value="Specialized Trailers">Specialized
                                                            Trailers</option>
                                                        <option value="Step Deck">Step Deck</option>
                                                        <option value="Step Deck Conestoga">Step Deck
                                                            Conestoga</option>
                                                        <option value="Step Deck Extendable">Step Deck
                                                            Extendable</option>
                                                        <option value="Step Deck or Flat">Step Deck or
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
                                                        <option value="Straight Van">Straight Van
                                                        </option>
                                                        <option value="Stretch Trailer or Ext. Flat">
                                                            Stretch Trailer or Ext.
                                                            Flat
                                                        </option>
                                                        <option value="Stretch Trailer or Extendable Flatbed">
                                                            Stretch Trailer or
                                                            Extendable Flatbed</option>
                                                        <option value="Supplies">Supplies</option>
                                                        <option value="Tandem Van">Tandem Van</option>
                                                        <option value="Tanker">Tanker</option>
                                                        <option value="Tanker (Food grade, liquid, bulk, etc.)">
                                                            Tanker (Food
                                                            grade,
                                                            liquid, bulk, etc.)</option>
                                                        <option value="Team Driver Needed">Team Driver
                                                            Needed</option>
                                                        <option value="Tridem">Tridem</option>
                                                        <option value="Two 24 or 28 Foot Flatbeds">Two
                                                            24 or 28 Foot Flatbeds
                                                        </option>
                                                        <option value="Unspecified Specialized Trailers">
                                                            Unspecified Specialized
                                                            Trailers</option>
                                                        <option value="Van">Van</option>
                                                        <option value="Van - Air-Ride">Van - Air-Ride
                                                        </option>
                                                        <option value="Van Intermodal">Van Intermodal
                                                        </option>
                                                        <option value="Van or Flatbed">Van or Flatbed
                                                        </option>
                                                        <option value="Van or Reefer">Van or Reefer
                                                        </option>
                                                        <option value="Van Pallet Exchange">Van Pallet
                                                            Exchange</option>
                                                        <option value="Van with Liftgate">Van with
                                                            Liftgate</option>
                                                        <option value="Van, Reefer or Double Drop">Van,
                                                            Reefer or Double Drop
                                                        </option>
                                                        <option value="Vented Insulated Van">Vented
                                                            Insulated Van</option>
                                                        <option value="Vented Insulated Van or Refrigerated">
                                                            Vented Insulated
                                                            Van or
                                                            Refrigerated</option>
                                                        <option value="Vented Van">Vented Van</option>
                                                        <option value="Vented Van or Refrigerated">
                                                            Vented Van or Refrigerated
                                                        </option>
                                                        <option value="Walking Floor">Walking Floor
                                                        </option>
                                                        <option value="BOX Truck">BOX Truck</option>
                                                        <option value="Reefer Container">Reefer
                                                            Container</option>
                                                        <option value="Tandem">Tandem</option>
                                                        <option value="B Train">B Train</option>
                                                        <option value="Flatbed with Tarps">Flatbed with
                                                            Tarps</option>
                                                        <option value="Flatbed with straps">Flatbed with
                                                            straps</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Delivery Order</label>
                                                    <input class="form-control" type="file" readonly name="load_delivery_do_file" id="load_delivery_do_file" style="width: 100%;padding: 3px 5px" value="{{ $post->load_delivery_do_file }}">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    @php
                                        // Shipper Data Initialization
                                        $shipperData = json_decode($post->load_shipperr, true) ?? [];
                                        $shipperQty = json_decode($post->load_shipper_qty, true) ?? [];
                                        $shipperWeight = json_decode($post->load_shipper_weight, true) ?? [];
                                        $shipperDescription = json_decode($post->load_shipper_discription, true) ?? [];
                                        $shipperType = json_decode($post->load_shipper_commodity_type, true) ?? [];
                                        $shipperNotes = json_decode($post->load_shipper_shipping_notes, true) ?? [];
                                        $shipperContact = json_decode($post->load_shipper_contact, true) ?? [];
                                        $shipperLocation = json_decode($post->load_shipper_location, true) ?? [];
                                        $shipperAppointment = json_decode($post->load_shipper_appointment, true) ?? [];
                                        $shipperCommodity = json_decode($post->load_shipper_commodity, true) ?? [];
                                        $shipperValue = json_decode($post->load_shipper_value, true) ?? [];
                                        $shipperPoNumber = json_decode($post->load_shipper_po_numbers, true) ?? [];
                                        $allShippers = app(\App\Models\Shipper::class)->where('user_id', auth()->id())->get();
                                        $shipperCounter = count($shipperData) + 1; // Adjust counter based on existing data
                                    @endphp

                                <div class="table-responsive">
                                    <button id="btnAddShipper" type="button" class="btn btn-primary mt-4" style="padding: 4px 6px; font-size: 12px;">
                                        <i class="fa fa-plus" style="font-size: 10px;"></i> Add Shipper
                                    </button>
                                    <table class="table table-bordered" id="shipperTable">
                                        <thead>
                                            <tr>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Sr. No</th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Shipper <code>*</code></th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Shipper Location</th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Shipper Appointment</th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Commodity Type</th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Commodity Name<code>*</code></th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Qty</th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Weight (lbs)</th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Value ($) <code>*</code></th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">PO Numbers</th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Contact</th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Shipper Description</th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Shipper Notes</th>
                                                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shipperData as $key => $shipper)
                                            <tr id="shipperRow{{ $key + 1 }}">
                                                <td style="padding: 7px;">S {{ $key + 1 }}</td>
                                                <td>
                                                    <select class="form-control load_shipper" name="load_shipper{{ $key + 1 }}" id="load_shipper{{ $key + 1 }}" data-row="{{ $key + 1 }}" required>
                                                        <option value="{{ $shipper['name'] }}">{{ $shipper['name'] }}</option>
                                                        <option value="">Select Shipper</option>
                                                        @foreach($allShippers as $get)
                                                        <option value="{{ $get->shipper_name }}" data-id="{{ $get->id }}" data-location="{{ $get->location }}">
                                                            {{ $get->shipper_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td style="padding: 7px;">
                                                    <input class="form-control" readonly name="load_shipper_location{{ $key + 1 }}" id="load_shipper_location{{ $key + 1 }}" value="{{ $shipperLocation[$key]['location'] ?? '' }}" title="{{ $shipperLocation[$key]['location'] ?? '' }}">
                                                </td>
                                                <td style="padding: 7px;">
                                                    <input class="form-control" type="datetime-local" name="load_shipper_appointment{{ $key + 1 }}" value="{{ $shipperAppointment[$key]['appointment'] ?? '' }}">
                                                </td>
                                                <td style="padding: 7px;">
                                                    <input class="form-control" name="load_shipper_commodity_type{{ $key + 1 }}" value="{{ $shipperType[$key]['commodity_type'] ?? '' }}" >
                                                </td>
                                                <td style="padding: 7px;">
                                                    <input class="form-control" name="load_shipper_commodity{{ $key + 1 }}" required value="{{ $shipperCommodity[$key]['commodity_name'] ?? '' }}" required>
                                                </td>
                                                <td style="padding: 7px;">
                                                    <input class="form-control" name="load_shipper_qty{{ $key + 1 }}" type="number" value="{{ $shipperQty[$key]['shipper_qty'] ?? '' }}">
                                                </td>
                                                <td style="padding: 7px;">
                                                    <input class="form-control" name="load_shipper_weight{{ $key + 1 }}" type="number" value="{{ $shipperWeight[$key]['shipper_weight'] ?? '' }}">
                                                </td>
                                                <td style="padding: 7px;">
                                                    <input class="form-control" name="load_shipper_value{{ $key + 1 }}" required type="number" value="{{ $shipperValue[$key]['shipper_value'] ?? '' }}">
                                                </td>
                                                <td style="padding: 7px;">
                                                    <input class="form-control" name="load_shipper_po_numbers{{ $key + 1 }}" value="{{ $shipperPoNumber[$key]['shipping_po_numbers'] ?? '' }}">
                                                </td>
                                                <td style="padding: 7px;">
                                                    <input class="form-control" name="load_shipper_contact{{ $key + 1 }}" type="number" value="{{ $shipperContact[$key]['shipping_contact'] ?? '' }}">
                                                </td>
                                                <td style="padding: 7px;">
                                                    <input class="form-control" name="load_shipper_description{{ $key + 1 }}" value="{{ $shipperDescription[$key]['description'] ?? '' }}">
                                                </td>
                                                <td style="padding: 7px;">
                                                    <textarea class="form-control" name="load_shipper_shipping_notes{{ $key + 1 }}">{{ $shipperNotes[$key]['shipping_notes'] ?? '' }}</textarea>
                                                </td>
                                                <td style="padding: 7px;">
                                                    <a href="javascript:void(0);" class="btn-remove-shipper" data-row="shipperRow{{ $key + 1 }}"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <input type="hidden" id="shipper_count" name="shipper_count" value="{{ count($shipperData) }}">
                                </div>


@php
$counter = 1; // Start counter from 1
$consigneeData = json_decode($post->load_consignee, true) ?? [];
$consigneeQty = json_decode($post->load_consignee_qty, true) ?? [];
$consigneeWeight = json_decode($post->load_consignee_weight, true) ?? [];
$consigneeDescription = json_decode($post->load_consignee_discription, true) ?? [];
$consigneeType = json_decode($post->load_consignee_type, true) ?? [];
$consigneeNotes = json_decode($post->load_consigneer_notes, true) ?? [];
$consigneeLocation = json_decode($post->load_consignee_location, true) ?? [];
$consigneeAppointment = json_decode($post->load_consignee_appointment, true) ?? [];
$consigneeCommodity = json_decode($post->load_consignee_commodity, true) ?? [];
$consigneeValue = json_decode($post->load_consignee_value, true) ?? [];
$consigneeDeliveryNotes = json_decode($post->load_consignee_delivery_notes, true) ?? [];
$consigneePoNumber = json_decode($post->load_consignee_po_numbers, true) ?? [];
$consigneeContact = json_decode($post->load_consigneer_contact, true) ?? [];
$allConsignees = \App\Models\Consignee::where('user_id', auth()->id())->get();
$consigneeCounter = count($consigneeData);
@endphp

<div class="table-responsive">
    <button id="btnAddConsignee" type="button" class="btn btn-primary mt-4"
        style="padding: 4px 6px;font-size: 12px;">
        <i class="fa fa-plus mr-2" style="font-size: 10px;"></i> Add Consignee
    </button>
    <table class="table table-bordered" id="consigneeTable">
        <thead>
            <tr>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Sr. No</th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Consignee <code>*</code></th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Consignee Location</th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Consignee Appointment</th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Commodity Type</th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Commodity Name<code>*</code></th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Qty</th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Weight (lbs)</th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Value($) <code>*</code></th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">PO Number</th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Contact</th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Consignee Description</th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Consignee Notes</th>
                <th class="p-0" style="vertical-align: middle;font-size: 12px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consigneeData as $key => $consignee)
            <tr id="consigneeRow{{ $key + 1 }}">
                <td style="padding: 7px;">C {{ $key + 1 }}</td>
                <td style="padding: 7px;">
                    <select class="form-control load_consignee consignee-select" name="load_consignee_{{ $key + 1 }}" id="load_consignee_{{ $key + 1 }}" data-row="{{ $key + 1 }}" required>
                        <option value="{{ $consignee['name'] }}">{{ $consignee['name'] }}</option>
                        <option value="">Select Consignee</option>
                        @foreach($allConsignees as $get)
                            <option value="{{ $get->consignee_name }}" data-id="{{ $get->id }}">{{ $get->consignee_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td style="padding: 7px;">
                    <input class="form-control" name="load_consignee_location_{{ $key + 1 }}" id="load_consignee_location_{{ $key + 1 }}" title="{{ $consigneeLocation[$key]['location'] ?? '' }}" value="{{ $consigneeLocation[$key]['location'] ?? '' }}" readonly>
                </td>
                <td style="padding: 7px;">
                    <input class="form-control" type="datetime-local" name="load_consignee_appointment_{{ $key + 1 }}" value="{{ $consigneeAppointment[$key]['appointment'] ?? '' }}">
                </td>
                <td style="padding: 7px;">
                    <input class="form-control" name="load_consignee_type_{{ $key + 1 }}" value="{{ $consigneeType[$key]['consignee_type'] ?? '' }}">
                </td>
                <td style="padding: 7px;">
                    <input class="form-control" name="load_consignee_commodity_{{ $key + 1 }}" value="{{ $consigneeCommodity[$key]['consignee_commodity'] ?? '' }}" required>
                </td>
                <td style="padding: 7px;">
                    <input class="form-control" name="load_consignee_qty_{{ $key + 1 }}" value="{{ $consigneeQty[$key]['consignee_qty'] ?? '' }}">
                </td>
                <td style="padding: 7px;">
                    <input class="form-control" name="load_consignee_weight_{{ $key + 1 }}" type="number" value="{{ $consigneeWeight[$key]['consignee_weight'] ?? '' }}">
                </td>
                <td style="padding: 7px;">
                    <input class="form-control" required name="load_consignee_value_{{ $key + 1 }}" type="number" value="{{ $consigneeValue[$key]['consignee_value'] ?? '' }}">
                </td>
                <td style="padding: 7px;">
                    <input class="form-control" name="load_consignee_po_numbers_{{ $key + 1 }}" value="{{ $consigneePoNumber[$key]['consignee_po_number'] ?? '' }}">
                </td>
                <td style="padding: 7px;">
                    <input class="form-control" name="load_consigneer_contact_{{ $key + 1 }}" type="number" value="{{ $consigneeContact[$key]['consignee_contact'] ?? '' }}">
                </td>
                <td style="padding: 7px;">
                    <input class="form-control" name="load_consignee_discription_{{ $key + 1 }}" value="{{ $consigneeDescription[$key]['description'] ?? '' }}">
                </td>
                <td style="padding: 7px;">
                    <textarea class="form-control" style="width: auto;font-size: 12px;" name="load_consignee_notes_{{ $key + 1 }}">{{ isset($consigneeNotes[$key]['load_consignee_notes']) ? htmlspecialchars(trim($consigneeNotes[$key]['load_consignee_notes']), ENT_QUOTES, 'UTF-8') : '' }}</textarea>
                </td>
                <td style="padding: 7px;">
                    <a href="javascript:void(0);" class="btn-remove-consignee" data-row="consigneeRow{{ $key + 1 }}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<input type="hidden" id="consignee_count" name="consignee_count" value="{{ $consigneeCounter }}">



                                    <div class="text-center">
                                        <input type="submit" class="btn btn-info" value="Save" onclick="saveFormData()">
                                        <a href="{{ route('broker_data') }}" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                                    </div>
              
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



<script>
$(document).ready(function () {
    let shipperCounter = {{ $shipperCounter }}; // Start from the existing count

    // Function to update Sr. No
    function updateSrNo() {
        $('#shipperTable tbody tr').each(function(index) {
            $(this).find('td:first').text(`S ${index + 1}`); // Update Sr. No based on current index
        });
    }

    // Add Shipper Row
    $('#btnAddShipper').on('click', function () {
        shipperCounter++; // Increment counter for new row

        let newRow = `
        <tr id="shipperRow${shipperCounter}">
            <td style="padding: 7px;">S ${shipperCounter}</td>
            <td>
                <select class="form-control load_shipper" name="load_shipper${shipperCounter}" id="load_shipper${shipperCounter}" required>
                    <option value="">Select Shipper</option>
                    @foreach($allShippers as $get)
                        <option value="{{ $get->shipper_name }}" data-id="{{ $get->id }}" data-location="{{ $get->location }}">
                            {{ $get->shipper_name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td style="padding: 7px;">
                <input class="form-control" readonly name="load_shipper_location${shipperCounter}" id="load_shipper_location${shipperCounter}" title="{{ $shipperLocation[$key]['location'] ?? '' }}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" type="datetime-local" name="load_shipper_appointment${shipperCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" name="load_shipper_commodity_type${shipperCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" name="load_shipper_commodity${shipperCounter}" required>
            </td>
            <td style="padding: 7px;">
                <input type="number" class="form-control" name="load_shipper_qty${shipperCounter}">
            </td>
            <td style="padding: 7px;">
                <input type="number" class="form-control" name="load_shipper_weight${shipperCounter}">
            </td>
            <td style="padding: 7px;">
                <input type="number" class="form-control" required name="load_shipper_value${shipperCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" name="load_shipper_po_numbers${shipperCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" name="load_shipper_contact${shipperCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" name="load_shipper_description${shipperCounter}">
            </td>
            <td style="padding: 7px;">
                <textarea class="form-control" name="load_shipper_shipping_notes${shipperCounter}"></textarea>
            </td>
            <td style="padding: 7px;">
                <a href="javascript:void(0);" class="btn-remove-shipper" data-row="shipperRow${shipperCounter}"><i class="fa fa-trash"></i></a>
            </td>
        </tr>`;

        // Append new row to the table
        $('#shipperTable tbody').append(newRow);
        $('#shipper_count').val(shipperCounter); // Update hidden input for total count
        updateSrNo(); // Update Sr. No after adding new row
    });

    // Remove shipper row
    $(document).on('click', '.btn-remove-shipper', function () {
        const rowId = $(this).data('row');
        $('#' + rowId).remove(); // Remove the row
        shipperCounter--; // Decrease counter
        $('#shipper_count').val(shipperCounter); // Update shipper count
        updateSrNo(); // Update Sr. No after removal
    });

    // Fetch shipper details
    $(document).on('change', '.load_shipper', function () {
        const shipperId = $(this).find(':selected').data('id');
        const rowId = $(this).attr('id').replace('load_shipper', '');

        if (shipperId) {
            $.ajax({
                url: "{{ route('fetch.shipper.details.edit') }}",
                method: "GET",
                data: { id: shipperId },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('#load_shipper_location' + rowId).val(`${data.shipper_address}, ${data.shipper_city}, ${data.shipper_state}, ${data.shipper_zip}, ${data.shipper_country}`);
                    } else {
                        console.error('No data found for this Shipper.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });

    // Pre-fill shipper data on load
    @foreach ($shipperData as $key => $shipper)
        $('#load_shipper{{ $key + 1 }}').val('{{ $shipper['name'] }}').trigger('change');
        $('#load_shipper_location{{ $key + 1 }}').val('{{ $shipperLocation[$key]['location'] ?? '' }}'); // Keep the existing location
    @endforeach

    // Update Sr. No for existing rows on load
    updateSrNo();
});
</script>













<script>
$(document).ready(function () {
    let consigneeCounter = {{ $consigneeCounter }}; // Start from the existing count

    // Function to update Sr. No
    function updateSrNo() {
        $('#consigneeTable tbody tr').each(function(index) {
            $(this).find('td:first').text(`C ${index + 1}`); // Update Sr. No based on current index
        });
    }

    // Add Consignee Row
    $('#btnAddConsignee').on('click', function () {
        consigneeCounter++; // Increment counter for new row

        let newRow = `
        <tr id="consigneeRow${consigneeCounter}">
            <td style="padding: 7px;">C ${consigneeCounter}</td>
            <td style="padding: 7px;">
                <select class="form-control load_consignee consignee-select" name="load_consignee_${consigneeCounter}" id="load_consignee_${consigneeCounter}" data-row="${consigneeCounter}" required>
                    <option value="">Select Consignee</option>
                    @foreach($allConsignees as $get)
                        <option value="{{ $get->consignee_name }}" data-id="{{ $get->id }}">{{ $get->consignee_name }}</option>
                    @endforeach
                </select>
            </td>
            <td style="padding: 7px;">
                <input class="form-control" name="load_consignee_location_${consigneeCounter}" id="load_consignee_location_${consigneeCounter}" readonly title="{{ $consigneeLocation[$key]['location'] ?? '' }}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" type="datetime-local" name="load_consignee_appointment_${consigneeCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" name="load_consignee_type_${consigneeCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" name="load_consignee_commodity_${consigneeCounter}" required>
            </td>
            <td style="padding: 7px;">
                <input class="form-control" name="load_consignee_qty_${consigneeCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" type="number" name="load_consignee_weight_${consigneeCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" required type="number" name="load_consignee_value_${consigneeCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" name="load_consignee_po_numbers_${consigneeCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" type="number" name="load_consignee_contact_${consigneeCounter}">
            </td>
            <td style="padding: 7px;">
                <input class="form-control" name="load_consignee_description_${consigneeCounter}">
            </td>
            <td style="padding: 7px;">
                <textarea class="form-control" name="load_consignee_notes_${consigneeCounter}"></textarea>
            </td>
            <td style="padding: 7px;">
                <a href="javascript:void(0);" class="btn-remove-consignee" data-row="consigneeRow${consigneeCounter}"><i class="fa fa-trash"></i></a>
            </td>
        </tr>`;

        // Append new row to the table
        $('#consigneeTable tbody').append(newRow);
        $('#consignee_count').val(consigneeCounter); // Update hidden input for total count
        updateSrNo(); // Update Sr. No after adding new row
    });

    // Remove consignee row
    $(document).on('click', '.btn-remove-consignee', function () {
        const rowId = $(this).data('row');
        $('#' + rowId).remove(); // Remove the row
        updateSrNo(); // Update Sr. No after removal
        consigneeCounter--; // Decrement the counter to maintain accurate counting
        $('#consignee_count').val(consigneeCounter); // Update the hidden input field
    });

    // Fetch consignee details
    $(document).on('change', '.consignee-select', function () {
        const consigneeId = $(this).find(':selected').data('id');
        const rowId = $(this).attr('id').replace('load_consignee_', '');

        if (consigneeId) {
            $.ajax({
                url: "{{ route('fetch.consignee.details.edit') }}",
                method: "GET",
                data: { id: consigneeId },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('#load_consignee_location_' + rowId).val(`${data.consignee_address}, ${data.consignee_city}, ${data.consignee_state}, ${data.consignee_zip}, ${data.consignee_country}`);
                    } else {
                        console.error('No data found for this Consignee.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });

    // Pre-fill consignee data on load
    @foreach ($consigneeData as $key => $consignee)
        $('#load_consignee_{{ $key + 1 }}').val('{{ $consignee['name'] }}').trigger('change');
        $('#load_consignee_location_{{ $key + 1 }}').val('{{ $consigneeLocation[$key]['location'] ?? '' }}'); // Keep the existing location
    @endforeach

    // Update Sr. No for existing rows on load
    updateSrNo();
});
</script>


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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            $('#load_carrier').val(response.carrier_name);
                            $('#load_carrier_phone').val(response.carrier_telephone);
                        } else {
                            $('#load_carrier').val('No data found');
                            $('#load_carrier_phone').val('');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        $('#load_carrier').val('Error fetching data');
                        $('#load_carrier_phone').val('');
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
        function fetchCustomerNames(query) {
            if (query.trim().length >= 3) { // Check if the query length is at least three characters
                $.ajax({
                    url: "{{ route('fetch.customer.details') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    dataType: "json",
                    success: function (response) {
                        var customerNames = response.join(
                            '\n'); // Join the array of customer names with line breaks
                        $('#customerList').val(customerNames); // Set the textarea content
                        $('#customerList').show(); // Show the textarea
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
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
            var selectedCustomer = $(this).val();
            $('#load_bill_to').val(selectedCustomer); // Fill the input with the selected customer name
            $('#customerList').hide(); // Hide the textarea after selection
        });

        $('#load_bill_to').keyup(function () {
            var query = $(this).val();
            fetchCustomerNames(query);
        });
    });
</script>






<script>
    $(function () {
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
                        response.forEach(function (shipperName) {
                            html += '<div class="item" data-value="' + shipperName + '">' +
                                shipperName + '</div>';
                        });
                        $('#shipperList').html(html);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $('#shipperList').html('');
            }
        }

        $('input[name="load_shipper"]').keyup(function () {
            var query = $(this).val();
            fetchShipperNames(query);
        });

        // Listen for click event on shipper list items
        $(document).on('click', '#shipperList .item', function () {
            var selectedShipper = $(this).text();
            $('input[name="load_shipper"]').val(selectedShipper);
            $('#shipperList').html(''); // Clear the list
        });
    });
</script>

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
                        // Slice the response to show only the first 5 items
                        var limitedResponse = response.slice(0, 5);

                        var html = '';
                        limitedResponse.forEach(function (consigneeName) {
                            html += '<div class="item" data-value="' + consigneeName +
                                '">' + consigneeName + '</div>';
                        });
                        $('#consigneeList').html(html);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $('#consigneeList').html('');
            }
        }

        $('input[name="load_consignee"]').keyup(function () {
            var query = $(this).val();
            fetchConsigneeNames(query);
        });

        // Listen for click event on consignee list items
        $(document).on('click', '#consigneeList .item', function () {
            var selectedConsignee = $(this).text();
            $('input[name="load_consignee"]').val(selectedConsignee);
            $('#consigneeList').html(''); // Clear the list
        });
    });
</script>
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
                            html += '<div class="item dropdown-item" data-name="' +
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

            var fullAddress = selectedConsigneeAddress + ', ' + selectedConsigneeCity + ', ' +
                selectedConsigneeState + ', ' + selectedConsigneeCountry + ', ' + selectedConsigneeZip;

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
        let nextShipperNumber = 2; // Start with the next shipper number to be 2

        $('#addBtn').click(function () {
            let currentShipperNumber = nextShipperNumber++;

            let dynamicRowHTML = `<li class="nav-item d-flex" data-shipper-number="${currentShipperNumber}"><a class="nav-link p-0" id="formTab${currentShipperNumber}" data-bs-toggle="tab" href="#shipperForm${currentShipperNumber}" role="tab" aria-controls=shipperForm${currentShipperNumber}" aria-selected="true">Shipper ${currentShipperNumber}</a><i class="fa fa-trash remove" style="margin-top: 1px;margin-left: 12px;"></i></li>`;
			
            $('#navTabs').append(dynamicRowHTML);
			let formHTML = `<div class="tab-pane fade" id="shipperForm${currentShipperNumber}" role="tabpanel" aria-labelledby="formTab${currentShipperNumber}"><div class="row shipper-form"><div class="col-md-3"><div class="form-group"><label>Shipper<code>*</code><button type="button" data-toggle="modal" data-target="#add-shipper" style="background:0 0;border:none"><i class="fa fa-plus"></i>Add New</button></label><input class="form-control load_shipper" name="load_shipper${currentShipperNumber}" id="load_shipper${currentShipperNumber}" required autocomplete="off" style="width:100%"><div id="shipperList${currentShipperNumber}" class="dropdown-menu"></div></div></div><div class="col-md-3"><div class="form-group"><label>Location</label><input class="form-control load_shipper_location" name="load_shipper_location${currentShipperNumber}" id="load_shipper_location${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Appointment<code>*</code></label><input class="form-control" type="datetime-local" name="load_shipper_appointment${currentShipperNumber}" required style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Description</label><input class="form-control" name="load_shipper_description${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Commodity Type</label><input class="form-control select2" name="load_shipper_commodity_type${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Commodity Name<code>*</code></label><input class="form-control" name="load_shipper_commodity${currentShipperNumber}" type="text" required style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Qty</label><input type="number" class="form-control" name="load_shipper_qty${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Weight (lbs)</label><input class="form-control" type="number" name="load_shipper_weight${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Value($)<code>*</code></label><input type="number" class="form-control" name="load_shipper_value${currentShipperNumber}" required style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Shipping Notes</label><input class="form-control" name="load_shipper_shipping_notes${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>PO Numbers</label><input class="form-control" name="load_shipper_po_numbers${currentShipperNumber}" style="width:100%"></div></div><div class="col-md-3"><div class="form-group"><label>Contact Number</label><input class="form-control" type="number" name="load_shipper_contact${currentShipperNumber}" style="width:100%"></div></div></div></div>`;

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

                var fullAddress = selectedShipperAddress + ', ' + selectedShipperCity + ', ' +
                    selectedShipperState + ', ' + selectedShipperCountry + ', ' + selectedShipperZip;

                $(`input[name="load_shipper${shipperNumber}"]`).val(selectedShipperName);
                $(`input[name="load_shipper_location${shipperNumber}"]`).val(fullAddress);
                $(`#shipperList${shipperNumber}`).html('').hide(); // Clear the list
            });

            // Hide the dropdown when clicking outside
            $(document).on('click', function (event) {
                if (!$(event.target).closest(`#shipperList${shipperNumber}, input[name="load_shipper${shipperNumber}"]`).length) {
                    $(`#shipperList${shipperNumber}`).html('').hide();
                }
            });
        }

        function fetchShipperNames(query, shipperNumber) {
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
                        response.forEach(function (shipper) {
                            html += '<div class="item dropdown-item" data-name="' + shipper
                                .shipper_name + '" data-address="' + shipper
                                .shipper_address + '" data-city="' + shipper.shipper_city +
                                '" data-state="' + shipper.shipper_state +
                                '" data-country="' + shipper.shipper_country +
                                '" data-zip="' + shipper.shipper_zip + '">' + shipper
                                .shipper_name + '</div>';
                        });
                        $(`#shipperList${shipperNumber}`).html(html).show();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $(`#shipperList${shipperNumber}`).html('').hide();
            }
        }
    });
</script>





<script>
    function removeConsigneeTab(key) {
        var tab = document.getElementById('formTab' + key);
        var tabPane = document.getElementById('consigneeSections' + key);

        if (tab && tabPane) {
            tab.remove();
            tabPane.remove();

            // Select the first remaining tab if any
            var firstTab = document.querySelector('#navTabs1 .nav-link');
            var firstTabPane = document.querySelector('#tabContent1 .tab-pane');

            if (firstTab && firstTabPane) {
                firstTab.classList.add('active');
                firstTabPane.classList.add('show', 'active');
            }
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
@endsection