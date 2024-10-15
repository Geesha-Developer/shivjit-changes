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
    .modal .card-header h3 {
        font-size: 13px;
        text-align: left;
        margin-left: 21px;
        font-weight: 700;
    }

    .modal .card-header h3 {
        font-size: 13px;
        text-align: left;
        margin-left: 21px;
        font-weight: 700;
    }

    .modal .modal-header .close {
        color: #000;
        text-shadow: none;
        padding: 0 5px;
        font-size: 32px;
        top: 26px;
    }

    .modal .modal-title {
        font-size: 20px;
        text-align: left;
        font-weight: 700;
    }

    .modal-content .modal-header .modal-title {
        margin-top: 19px !important;
    }

    .form-section {
        display: none;
    }

    .form-section.active {
        display: block;
    }
</style>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>CPR Check </h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 p-0">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">ADD CPR</button>
                                <button type="button" class="btn btn-success" id="hideFormButton"><i
                                        class="fa fa-eye"></i></button>
                                <table class="table table-bordered table-hover js-basic-example dataTable">

                                    <thead>
                                        <tr>
                                            <th>MC No</th>
                                            <th>MC Reference No</th>
                                            <th>Carrier Name</th>
                                            <th>Load Type</th>
                                            <th>Dispatcher Name</th>
                                            <th>Dispatcher Email</th>
                                            <th>Driver Name</th>
                                            <th>Driver Number</th>
                                            <th>Added by User</th>
                                            <th>Team Lead</th>
                                            <th>Team Manager</th>
                                            <th>Ops Manager</th>
                                            <th>Created Date</th>
                                            <th>Approval Status</th>
                                            <th>Comments</th>
                                            <th>Actions</th>
                                            <th>Raise Exception</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1503188</td>
                                            <td>1220230724</td>
                                            <td>Seaport logistics</td>
                                            <td>10000</td>
                                            <td>CNC MACHINE</td>
                                            <td>Container Trailer</td>
                                            <td>Not Approved</td>
                                            <td>12/08/2023</td>
                                            <td>Dan Edwards</td>
                                            <td>Bella C</td>
                                            <td>Bella C</td>
                                            <td>Amren K_1</td>
                                            <td>Amren K_1</td>
                                            <td>Amren K_1</td>
                                            <td>Amren K_1</td>
                                            <td><i class="fa fa-edit text-info  " style="font-size: 18px;"></i></td>
                                            <td>
                                                <button type="button" class="btn" data-toggle="modal"
                                                    data-target="#exception"><i class="fa fa-book"></i></button>
                                            </td>
                                        </tr>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header pl-0">
                <h4 class="modal-title ml-3 mb-4">CPR Process</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST">
                <div class="card-body text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="m-0">MC Check Details</h6>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>MC Ref No <code>*</code></label>
                                <input type="number" class="form-control" required style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Commodity Type <code>*</code></label>
                                <input type="text" class="form-control select2" required
                                    style="width: 100%;height:30px;padding: 0px 0 0 10px;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Commodity Value <code>*</code></label>
                                <input type="number" class="form-control select2" required
                                    style="width: 100%;height:30px ;padding: 0px 0 0 10px;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Carrier Name<code>*</code></label>
                                <input type="text" class="form-control" required style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>MC Number<code>*</code></label>
                                <input type="number" class="form-control" required style="width: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body text-left mt-4">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="m-0">CPR Check Details</h6>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label mb-1">Load Type</label>
                                <select class="form-control shadow-none col-12 required" id="LoadTypeID"
                                    name="LoadTypeID"
                                    style="width:100%;border: 1px solid #ced4da;padding: 7px 0;border-radius: 7px;">
                                    <option value="">Please Select</option>
                                    <option value="1">OTR</option>
                                    <option value="2">Dray-age</option>
                                </select>
                                <span class="field-validation-valid" data-valmsg-for="LoadTypeID"
                                    data-valmsg-replace="true"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-left p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="formSection1" class="form-section">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="otrField1">Driver Name<code>*</code></label>
                                                    <input type="text" class="form-control" id="otrField1"
                                                        name="otrField1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="otrField1">Driver Phone<code>*</code></label>
                                                    <input type="number" class="form-control" id="otrField1"
                                                        name="otrField1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="otrField1">Truck No<code>*</code></label>
                                                    <input type="number" class="form-control" id="otrField1"
                                                        name="otrField1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="otrField1">Trailer No<code>*</code></label>
                                                    <input type="number" class="form-control" id="otrField1"
                                                        name="otrField1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="otrField1">VIN No<code>*</code></label>
                                                    <input type="number" class="form-control" id="otrField1"
                                                        name="otrField1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="otrField1">Dispatcher Name<code>*</code></label>
                                                    <input type="text" class="form-control" id="otrField1"
                                                        name="otrField1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="otrField1">Dispatcher Email<code>*</code></label>
                                                    <input type="email" class="form-control" id="otrField1"
                                                        name="otrField1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="otrField1">Dispatcher Phone<code>*</code></label>
                                                    <input type="text" class="form-control" id="otrField1"
                                                        name="otrField1" required>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div id="formSection2" class="form-section">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="otrField1">Dispatcher Name<code>*</code></label>
                                                    <input type="text" class="form-control" id="otrField1"
                                                        name="otrField1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="otrField1">Dispatcher Email<code>*</code></label>
                                                    <input type="email" class="form-control" id="otrField1"
                                                        name="otrField1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="otrField1">Dispatcher Phone<code>*</code></label>
                                                    <input type="text" class="form-control" id="otrField1"
                                                        name="otrField1" required>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer mt-4">
                    <input type="submit" class="btn btn-info" value="Add">
                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#LoadTypeID').on('change', function () {
            var selectedValue = $(this).val();

            // Hide all form sections
            $('.form-section').removeClass('active');

            // Show the selected form section
            if (selectedValue == '1') {
                $('#formSection1').addClass('active');
            } else if (selectedValue == '2') {
                $('#formSection2').addClass('active');
            }
        });
    });
</script>
@endsection

<div class="modal" id="exception">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Raise Exception</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Reason for Exception <code>*</code></label>
                            <textarea required style="width: 100%;border: 1px solid #ced4da;"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Ops Manager's Comments <code>*</code></label>
                            <textarea required style="width: 100%;border: 1px solid #ced4da;"></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Raise Exception</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>