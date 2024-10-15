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
<style>
     .check-box {
        margin-left: 20px;
    }

    .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
    }

    .active,
    .accordion:hover {
        background-color: #ccc;
    }

    .panel {
        padding: 0 18px;
        display: none;
        background-color: white;
        overflow: hidden;
    }
</style>

<div class="container mt-5">
    <div id="accordion">
        @foreach($users as $user)
        <!-- Accordion Item -->
        <div class="card">
            <div class="card-header" id="heading{{ $user->id }}">
                <h5 class="mb-0">
                    <button class="btn btn-link {{ $loop->first ? '' : 'collapsed' }}" data-toggle="collapse" data-target="#collapse{{ $user->id }}"
                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $user->id }}">
                        {{ $user->name }} - {{$user->role}}
                    </button>
                </h5>
            </div>

            <div id="collapse{{ $user->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $user->id }}" data-parent="#accordion">
                <div class="card-body">
                    
                          <div class="d-flex">
                          @if(!$user->can('manage accounting'))
                                <div class="check-box">
                                    <input type="checkbox" id="manage_accounting" name="manage_accounting" value="manage accounting" onchange="updatePermissions({{$user->id}},'manage accounting')">
                                    <label for="vehicle1"> Manage Accounting</label>
                                </div>
                            @else
                            <div class="check-box">
                                    <input type="checkbox" id="manage_accounting" name="manage_accounting" value="manage accounting" checked onchange="updatePermissions({{$user->id}},'manage accounting')">
                                    <label for="vehicle1"> Manage Accounting</label>
                                </div>
                            @endif    
                            
                            @if(!$user->can('manage account-manager'))
                            <div class="check-box">
                                    <input type="checkbox" id="manage_account_manager" name="manage account_manager" value="manage account-manager" onchange="updatePermissions({{$user->id}},'manage account-manager')">
                                    <label for="vehicle1"> Manage Account-Manager</label>
                                </div>
                            @else
                            <div class="check-box">
                                    <input type="checkbox" id="manage_account_manager" name="manage account_manager" value="manage account-manager" checked onchange="updatePermissions({{$user->id}},'manage account-manager')">
                                    <label for="vehicle1"> Manage Account-Manager</label>
                                </div>
                            @endif
                            @if(!$user->can('manage reporting'))
                            <div class="check-box">
                                    <input type="checkbox" id="manage_reporting" name="manage_reporting" value="manage reporting" onchange="updatePermissions({{$user->id}},'manage reporting')">
                                    <label for="vehicle1"> Manage Reporting</label>
                                </div>
                            @else
                            <div class="check-box">
                                    <input type="checkbox" id="manage_reporting" name="manage_reporting" value="manage reporting" checked onchange="updatePermissions({{$user->id}},'manage reporting')">
                                    <label for="vehicle1"> Manage Reporting</label>
                                </div>
                            @endif

                            @if(!$user->can('manage vendors'))
                            <div class="check-box">
                                    <input type="checkbox" id="manage_vendors" name="manage_vendors" value="manage vendors" onchange="updatePermissions({{$user->id}},'manage vendors')">
                                    <label for="vehicle1"> Manage Vendors</label>
                                </div>
                            @else
                            <div class="check-box">
                                    <input type="checkbox" id="manage_vendors" name="manage_vendors" value="manage vendors" checked onchange="updatePermissions({{$user->id}},'manage vendors')">
                                    <label for="vehicle1"> Manage Vendors</label>
                                </div>
                            @endif
                            
                            @if(!$user->can('view compliance'))
                            <div class="check-box">
                                    <input type="checkbox" id="view_compliance" name="view_compliance" value="view compliance" onchange="updatePermissions({{$user->id}},'view compliance')">
                                    <label for="vehicle1"> View Compliance</label>
                                </div>
                            @else
                            <div class="check-box">
                                    <input type="checkbox" id="view_compliance" name="view_compliance" value="view compliance" checked onchange="updatePermissions({{$user->id}},'view compliance')">
                                    <label for="vehicle1"> View Compliance</label>
                                </div>
                            @endif
                          </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
    function updatePermissions(user_id,permission){
        $.ajax({
            data:{
                user_id: user_id,
                permission: permission,
                _token:'{{ csrf_token() }}'
            },
            method:"POST",
            url:'/update-accounts-permissions',
            success: function(response){
                if(response.status == "successful"){
                    alert('Permission Updated');
                }else{
                    alert('Permission Not Updated');
                }
            },
            error: function(xhr, status, error) {
                alert('An unexpected error occurred: ' + error);
            }

        });
    }
</script>

@endsection
