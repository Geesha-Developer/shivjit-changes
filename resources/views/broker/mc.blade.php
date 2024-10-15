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
        font-size: 15px !important;
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
        font-size: 15px;
        text-align: left;
        font-weight: 700;
    }

    .modal-content .modal-header .modal-title {
        margin-top: 19px !important;
    }
</style>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>MC Check </h2>
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
                                    data-target="#exampleModal">ADD MC</button>
                                <button type="button" class="btn btn-success" id="hideFormButton"><i
                                        class="fa fa-eye"></i></button>
                                <table class="table table-bordered table-hover js-basic-example dataTable">

                                    <thead>
                                        <tr>
                                            <th>MC No</th>
                                            <th>MC Reference No</th>
                                            <th>Carrier Name</th>
                                            <th>Commodity Value</th>
                                            <th>Commodity Type</th>
                                            <th>Equipment Type</th>
                                            <th>Approval Status</th>
                                            <th>Date Added</th>
                                            <th>Added by User</th>
                                            <th>Team Lead</th>
                                            <th>Team Manager</th>
                                            <th>Ops Manager</th>
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
            <div class="modal-header">
                <button type="button" class="close mt-0" data-dismiss="modal" style="color: #000;">&times;</button>
            </div>
            <form method="POST">
                <div class="card-header">
                    <h3 class="card-title">Add MC Check</h3>
                </div>

                <div class="card-body text-left">
                    <div class="row">
                    <div class="col-md-4">
                            <div class="form-group">
                                <label>Dispatcher Name <code>*</code></label>
                                <input type="text" class="form-control" required style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>MC Number <code>*</code></label>
                                <input type="number" class="form-control" required style="width: 100%;">
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
                                <label>Carrier Email<code>*</code></label>
                                <input type="email" class="form-control" required style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact Number<code>*</code></label>
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
                                <label>Commodity Name <code>*</code></label>
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
                                <label>Equipment Type<code>*</code></label>
                                <select style="width:100%;border: 1px solid #ced4da;padding: .375rem .75rem;">
                                    <option>Select Equipment</option>
                                    <option>Container Trailer</option>
                                    <option>22'VAN</option>
                                    <option>48'Reefer</option>
                                    <option>53'Reefer</option>
                                    <option>53'VAN</option>
                                    <option>Air Freight</option>
                                    <option>Anhydros Ammonia</option>
                                    <option>Animal Carrier</option>
                                    <option>Any Equipment</option>
                                    <option>Any Equipment (Searching Services only)</option>
                                    <option>Auto Carrier</option>
                                    <option>B-Train/Supertrain</option>
                                    <option>B-Train/Supertrain(Canada Only)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>MC Purpose<code>*</code></label>
                                <input type="email" class="form-control" required style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="margin-bottom: 0;font-weight: 600;color: #4a4a4a;">Commodity
                                    Value Proof <code>*</code></label>
                                <input type="file" id="myFile" name="filename">
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