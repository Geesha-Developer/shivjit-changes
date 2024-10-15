@extends('layouts.admin.app')
@section('content')
<section class="content">
    <div class="block-header" style="padding: 16px 15px !important;">
        <h2>Workflows for User</h2>
    </div>
    <div class="col-md-12">
        <label for="user_type" class="form-label"><b>Select User Type:</b></label><br>
        <select name="user_type" id="user_type" class="form-select" style="width:100%;height: 33px;border: 1px solid #ccc;" required>
            <option value="">-- Select User Type--</option>
            <option value="Admin">-- Admin--</option>
            <option value="Accounts_Admin">-- Accounts Admin--</option>
            <option value="Team_Lead">-- Team Lead--</option>
            <option value="Brokers">-- Brokers--</option>
        </select>
    </div>
    <div id="Admin" class="hideOptions" style="display:none;">
    <!-- User selection form -->
        <form action="{{ route('workflows.show') }}" method="POST" class="mb-4">
            @csrf
            <div class="row mt-3 ml-1">
                <div class="col-md-10">
                    <label for="user_id" class="form-label"><b>Select User:</b></label>
                    <select name="user_id" id="user_id" class="form-select" style="width:100%;height: 33px;border: 1px solid #ccc;" required>
                        <option value="">-- Select User --</option>
                        @foreach($admin as $user)
                        <option value="{{ $user->id }}"
                            {{ (isset($userId) && $userId == $user->id) ? 'selected' : '' }}>
                            {{ $user->name }} (ID: {{ $user->id }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" value="admin" />
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-info" style="margin-top: 28px;">View Workflows</button>
                </div>
            </div>
        </form>
    </div>
    <div class="hideOptions" id="Accounts_Admin" style="display:none;">
        <!-- User selection form -->
        <form action="{{ route('workflows.show') }}" method="POST" class="mb-4">
            @csrf
            <div class="row mt-3 ml-1">
                <div class="col-md-10">
                    <label for="user_id" class="form-label"><b>Select User:</b></label>
                    <select name="user_id" id="user_id" class="form-select" style="width:100%;height: 33px;border: 1px solid #ccc;" required>
                        <option value="">-- Select User --</option>
                        @foreach($accountsAdmin as $user)
                        <option value="{{ $user->id }}"
                            {{ (isset($userId) && $userId == $user->id) ? 'selected' : '' }}>
                            {{ $user->name }} (ID: {{ $user->id }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" value="Accounts_Admin" />
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-info" style="margin-top: 28px;">View Workflows</button>
                </div>
            </div>
        </form>
    </div>
    <div class="hideOptions" id="Team_Lead" style="display:none;">
        <!-- User selection form -->
        <form action="{{ route('workflows.show') }}" method="POST" class="mb-4">
            @csrf
            <div class="row mt-3 ml-1">
                <div class="col-md-10">
                    <label for="user_id" class="form-label"></b>Select User:</b></label><br>
                    <select name="user_id" id="user_id" class="form-select" style="width:100%;height: 33px;border: 1px solid #ccc;" required>
                        <option value="">-- Select User --</option>
                        @foreach($teamlead as $user)
                        <option value="{{ $user->id }}"
                            {{ (isset($userId) && $userId == $user->id) ? 'selected' : '' }}>
                            {{ $user->name }} (ID: {{ $user->id }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" value="Team_Lead" />
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-info" style="margin-top: 28px;">View Workflows</button>
                </div>
              </div>
        </form>
    </div>
    <div class="hideOptions" id="Brokers" style="display:none;">
        <!-- User selection form -->
        <form action="{{ route('workflows.show') }}" method="POST" class="mb-4">
            @csrf
            <div class="row mt-3 ml-1">
                <div class="col-md-10">
                    <label for="user_id" class="form-label"><b>Select User:</b></label>
                    <select name="user_id" id="user_id" class="form-select" style="width:100%;height: 33px;border: 1px solid #ccc;" required>
                        <option value="">-- Select User --</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            {{ (isset($userId) && $userId == $user->id) ? 'selected' : '' }}>
                            {{ $user->name }} (ID: {{ $user->id }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary" style="margin-top: 28px;">View Workflows</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Workflow logs table -->
    @if(isset($workflows))
   <div class="col-md-12">
   <h5 class="mt-3">Workflows for User ID: {{ $userId }}</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Guard Name</th>
                <th>Action</th>
                <th>Model Type</th>
                <th>Model ID</th>
                <th>Model Data</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @forelse($workflows as $workflow)
            <tr>
                <td>{{ $workflow->id }}</td>
                <td>{{ $workflow->guard_name }}</td>
                <td>{{ $workflow->action }}</td>
                <td>{{ $workflow->model_type }}</td>
                <td>{{ $workflow->model_id }}</td>
                <td>{{ $workflow->model_data }}</td>
                <td>{{ $workflow->created_at }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No workflows found for the selected user.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
   </div>
    @endif
</section>
<!-- Bootstrap JS (optional, if needed for additional functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('#user_type').on('change', function () {
        var selectedValue = $(this).val();
        if (selectedValue != '') {

            $('.hideOptions').hide();
            $('#' + selectedValue).show();
        } else {
            $('.hideOptions').hide();
        }
    });
</script>
@endsection