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
                    <h2>All Users Data </h2>
                </div>
            </div>
        </div>

        <div class="container-fluid p-0">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                        <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-bordered table-responsive dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th style="background: #555555 !important;color: #fff !important;">Sr No.</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Emp Code</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Broker</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Email</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Address</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Office</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Manager</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Team Lead</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Emergency Number</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Created at</th>
                                            <th style="background: #555555 !important;color: #fff !important;">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach($getusers as $users)
                                        <tr>
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $i++ }}</td>
                                            @if($users->emp_code)
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $users->emp_code }}</td>
                                            @else
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">NA</td>
                                            @endif
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $users->name }}</td>
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $users->email }}</td>
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $users->address}}</td>
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $users->office}}</td>
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $users->manager }}</td>
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $users->team_lead }}</td>
                                            @if($users->emp_code)
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $users->emergency_contact }}</td>
                                            @else
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $users->emergency_contact }}</td>
                                            @endif
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;">{{ $users->created_at->format('d-m-Y h:i:s A') }}</td>
                                            <td class="dynamic-data" style="padding: 9px 10px !important; vertical-align: middle !important;" class="d-flex justify-content-center">
                                                <a href="javascript:void(0);" data-id="{{ $users->id }}" class="editAccount" data-toggle="modal" data-target="#editAccount"><i class="fa fa-edit" style="color:#0DCAF0;font-size: 17px;cursor: pointer;"></i></a>
                                                
                                                <!--<a href="javascript:void(0);" class="deleteAccount" data-id="{{ $users->id }}"><i class="fa fa-trash" style="color:red"></i></a>-->
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="modal fade" id="editAccount" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editAccountModalLabel">Edit User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editAccountForm">
                                                    @csrf
                                                    <input type="hidden" name="id" id="account_id">
                                                    <div class="form-group">
                                                        <label for="employee_code">Employee Code</label>
                                                        <input type="text" class="form-control" id="employee_code" name="employee_code">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="agent_name">Agent Name</label>
                                                        <input type="text" class="form-control" id="agent_name" name="agent_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="text" class="form-control" id="email" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" id="address" name="address">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="office">Office</label>
                                                        <input type="text" class="form-control" id="office" name="office">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="manager">Manager</label>
                                                        <input type="text" class="form-control" id="manager" name="manager">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="team_leader">Team Leader</label>
                                                        <input type="text" class="form-control" id="team_leader" name="team_leader">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="emergency_number">Emergency Number</label>
                                                        <input type="text" class="form-control" id="emergency_number" name="emergency_number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="created_at">Created At</label>
                                                        <input type="text" class="form-control" id="created_at" name="created_at" readonly>
                                                    </div>
                                                </form>

                                            </div>
                                            <div class="text-center mb-4">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-info" id="saveChanges">Save changes</button>
                                            </div>
                                        </div>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('.editAccount').on('click', function() {
        var accountId = $(this).data('id');

        // Make an AJAX request to fetch user details
        $.ajax({
            url: '/user/' + accountId + '/edit',
            method: 'GET',
            success: function(response) {
                // Populate the form fields with the response data
                $('#account_id').val(response.id);
                $('#agent_name').val(response.name);
                $('#password').val(''); // Leave password field blank for security
                $('#email').val(response.email );
                $('#address').val(response.address);
                $('#office').val(response.office);
                $('#manager').val(response.manager);
                $('#team_leader').val(response.team_lead);
                $('#emergency_number').val(response.emergency_contact);
                $('#employee_code').val(response.emp_code);
                $('#created_at').val(response.created_at);
                
                // Show the modal
                $('#editAccountModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });

    // Save changes
    $('#saveChanges').on('click', function() {
        var formData = $('#editAccountForm').serialize();

        $.ajax({
            url: '/user/update',
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('User updated successfully.');
                location.reload(); // Reload the page to see the changes
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.deleteAccount').on('click', function() {
        var accountId = $(this).data('id');

        // Confirm deletion
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: '/user/' + accountId,
                method: 'DELETE',
                success: function(response) {
                    alert('User deleted successfully.');
                    location.reload(); // Reload the page to see the changes
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred while deleting the user.');
                }
            });
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


@endsection