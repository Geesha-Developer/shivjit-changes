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
        position: absolute;
        right: 14px;
        color: #000;
        top: 8px !important;
        font-size: 32px;

    }

    button#hideFormButton {
        float: right;
    }
</style>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Carrier Listing </h2>
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
                                <table class="table table-bordered table-hover js-basic-example dataTable">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">ADD CARRIER</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('insert_carrier') }}" id="myForm" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-header">
                                                        <h3 class="card-title">Add Carrier</h3>
                                                        <button type="button" class="close" style="top: -5px;"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>

                                                    <div class="card-body text-left">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Carrier Name <code>*</code></label>
                                                                    <input class="form-control select2" required
                                                                        name="carrier_name" style="width: 100%; ">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="mr-2">M.C. #/F.F.#
                                                                        <code>*</code></label>
                                                                    <div class="d-flex" style="width: 100%;">
                                                                        <select class="form-control select2 mr-2"
                                                                            required name="carrier_mc_ff"
                                                                            style="width: 35% !important;height:35px ">
                                                                            <option selected="selected" value="FF">FF
                                                                            </option>
                                                                            <option selected="MC">MC</option>

                                                                        </select>
                                                                        <input type="text" class="form-control select2"
                                                                            required name="carrier_mc_ff_input"
                                                                            id="carrier_mc_ff_input"
                                                                            style="width: 65%; ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>D.O.T</label>
                                                                    <input class="form-control" name="carrier_dot"
                                                                        style="width: 100%; ">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Address<code>*</code></label>
                                                                    <input class="form-control" required
                                                                        name="carrier_address_two"
                                                                        style="width: 100%;  ">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Country<code>*</code></label>
                                                                    <select
                                                                        style="font-family: 'Poppins', sans-serif;font-weight: 400;font-size: 14px;line-height: 0.2em;color: #666;width: 100%;height:30px;padding: 0px 0 0 10px;" required class="form-control select2"
                                                                        name="carrier_country" id="country">
                                                                        <option style="font-family: 'Poppins', sans-serif;font-weight: 400;font-size: 15px;line-height: 0.2em;color: #666;" value="">Choose Country</option>

                                                                        @foreach($countries as $c)
                                                                        <option
                                                                            style="font-family: 'Poppins', sans-serif;font-weight: 400;font-size: 14px;line-height: 0.2em;color: #666;"
                                                                            value="{{$c->id}} {{ $c->name }}">{{$c->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>State<code>*</code></label>
                                                                    <div>
                                                                        <select
                                                                            style="font-family: 'Poppins', sans-serif;font-weight: 400;font-size: 14px;line-height: 0.2em;color: #666;width: 100%;height:30px;padding: 0px 0 0 10px;"
                                                                            class="form-control select2"
                                                                            name="carrier_state" id="state" required>
                                                                            <option
                                                                                style="font-family: 'Poppins', sans-serif;font-weight: 400;font-size: 14px;line-height: 0.2em;color: #666;"
                                                                                selected="selected">Please Select
                                                                            </option>
                                                                            @foreach($states as $s)
                                                                            <option
                                                                                style="font-family: 'Poppins', sans-serif;font-weight: 400;font-size: 14px;line-height: 0.2em;color: #666;">
                                                                                {{$s->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>City<code>*</code></label>
                                                                    <input class="form-control" name="carrier_city" required
                                                                        style="width: 100%;  ">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Zip<code>*</code></label>
                                                                    <input class="form-control" type="number" name="carrier_zip" required
                                                                        id="carrier_zip" style="width: 100%;  ">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>POC Name</label>
                                                                    <input class="form-control"
                                                                        name="carrier_contact_name"
                                                                        style="width: 100%; ">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input class="form-control" name="carrier_email"
                                                                        style="width: 100%; ">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Telephone<code>*</code></label>
                                                                    <input type="number" class="form-control" name="carrier_telephone" required
                                                                        id="carrier_telephone" style="width: 100%; ">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Extn. </label>
                                                                    <input class="form-control" name="carrier_extn"
                                                                        style="width: 100%; ">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Fax</label>
                                                                    <input class="form-control" name="carrier_fax"
                                                                        style="width: 100%; ">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Status <code>*</code></label>
                                                                    <div class="select2-purple">
                                                                        <select class="form-control select2"
                                                                            name="carrier_status" style="width: 100%; "
                                                                            required>
                                                                            <option selected="selected">Select</option>
                                                                            <option
                                                                                style="font-family: 'Poppins', sans-serif;">
                                                                                Active</option>
                                                                            <option
                                                                                style="font-family: 'Poppins', sans-serif;">
                                                                                In-Active</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Payment Terms </label>
                                                                    <div class="select2-purple">
                                                                        <select class="form-control select2"
                                                                            name="carrier_payment_terms"
                                                                            style="width: 100%;  ">
                                                                            <option selected="selected">Select Payment
                                                                            </option>
                                                                            <option
                                                                                style="font-family: 'Poppins', sans-serif;">
                                                                                Prepaid</option>
                                                                            <option
                                                                                style="font-family: 'Poppins', sans-serif;">
                                                                                Postpaid</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Factoring Company </label>
                                                                    <input class="form-control"
                                                                        name="carrier_factoring_company"
                                                                        style="width: 100%; ">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        style="margin-bottom: 0; font-weight: 600;color: #4a4a4a;">Notes</label>
                                                                    <textarea class="form-control" name="carrier_notes"
                                                                        style="width: 100%; height: 70px !important"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        style="margin-bottom: 0; font-weight: 600;color: #4a4a4a;">File
                                                                        Upload</label>
                                                                    <input type="file" class="form-control"
                                                                        name="carrier_file_upload[]"
                                                                        id="carrier_file_upload" multiple
                                                                        style="width: 100%; height: 70px !important">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-4 mb-4 text-center">
                                                            <input type="submit" class="btn btn-info" value="Add" style="padding: 8px 40px;">
                                                            <input type="button" class="btn btn-danger"
                                                                data-dismiss="modal" value="Cancel" style="font-size: 15px;padding: 8px 40px;">
                                                        </div>
                                                </form>
                                            </div>
                                            <thead>
                                                <tr>
                                                    <th>Carrier ID</th>
                                                    <th>Carrier Name</th>
                                                    <th>MC No. / FF No.</th>
                                                    <th>Address</th>
                                                    <th>Phone No.</th>
                                                    <th>Date Added</th>
                                                    <th>Added By Agent</th>
                                                    <th>Team Leader</th>
                                                    <th>Team Manager</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach($fetch as $fetches)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $fetches->carrier_name }}</td>
                                                        <td>{{ $fetches->carrier_mc_ff_input }}</td>
                                                        @php
                                                            $countryName = explode(' ', $fetches->carrier_country, 2)[1] ?? '';
                                                        @endphp
                                                        <td class="dynamic-data">
                                                            {{ $fetches->carrier_address_two }} {{ $countryName }} {{ $fetches->carrier_state }} {{ $fetches->carrier_city }} {{ $fetches->carrier_zip }}
                                                        </td>
                                                        <td>{{ $fetches->carrier_telephone }}</td>
                                                        <td>{{ $fetches->created_at->format('Y-m-d') }}</td>
                                                        <td>{{ $fetches->user->name }}</td>
                                                        <td>{{ $fetches->user->team_lead }}</td>
                                                        <td>{{ $fetches->user->manager }}</td>
                                                        <td>
                                                            @if($fetches->mc_check == 'Approved')
                                                                Approved
                                                            @elseif($fetches->mc_check == 'Not Approved' || is_null($fetches->mc_check))
                                                                Pending For Approval
                                                            @endif
                                                        </td>
                                                        <td>
                                                           <div class="d-flex">
                                                            <a href="{{ route('carriers.edit', $fetches->id) }}"><i class="fa fa-edit" style="font-size: 17px;color: #0dcaf0;"></i></a>
                                                                <form action="{{ route('carrier.delete', $fetches->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Carrier?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" style="border: none; background: none;">
                                                                        <i class="fa fa-trash" style="font-size: 17px; color: red;"></i>
                                                                    </button>
                                                                </form>
                                                           </div>
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

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    function deleteItem(id) {
        if (confirm("Are you sure you want to delete this item?")) {
            fetch(`/carrier/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })

            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Item deleted successfully');
                    location.reload();
                } else {
                    alert('Error deleting item');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting item');
            });
        }
    }
</script>




@endsection