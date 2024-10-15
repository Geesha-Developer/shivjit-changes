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
    <div class="block-header" style="padding: 16px 15px !important;">
        <h2>Team Assignment</h2>
    </div>
    <!-- Loader Element -->
    <div id="loader" style="display: none;">
        <div class="loader-overlay"></div>
        <div class="loader-content">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden"></span>
            </div>
            <p>Loading data, please wait...</p>
        </div>
        
    </div>

    @if (session('Success'))
        <div class="alert alert-success">
            {{ session('Success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Team Lead</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($broker as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <select class="form-control teamlead-select" data-user-id="{{ $user->id }}">
                        <!-- Options will be populated by AJAX -->
                    </select>
                </td>
                <td class="text-center">
                    <button class="btn btn-info update-teamlead" data-user-id="{{ $user->id }}">Update</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
<script>
$(document).ready(function(){
    // Show the loader when the document is ready
    $('#loader').show();
    $('body').css('pointer-events', 'none'); // Disable interactions with the page

    let requestsCompleted = 0;
    const totalRequests = $('.teamlead-select').length; // Total number of AJAX requests to be made

    $('.teamlead-select').each(function() {
        var userId = $(this).data('user-id');
        var selectElement = $(this);
        
        // AJAX request to get the list of team leads
        $.ajax({
            url: '{{ route('getTeamLeadList') }}',
            type: 'GET',
            data: { id: userId },
            success: function(response) {
                selectElement.html(response.optionData);
                requestsCompleted++;

                // Hide loader if all requests are completed
                if (requestsCompleted === totalRequests) {
                    $('#loader').hide();
                    $('body').css('pointer-events', 'auto'); // Enable interactions with the page
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                requestsCompleted++;

                // Hide loader if all requests are completed
                if (requestsCompleted === totalRequests) {
                    $('#loader').hide();
                    $('body').css('pointer-events', 'auto'); // Enable interactions with the page
                }
            }
        });
    });

    // Update team lead on button click
    $('.update-teamlead').click(function() {
        var userId = $(this).data('user-id');
        var teamleadId = $(this).closest('tr').find('.teamlead-select').val();

        $.ajax({
            url: '{{ route('updateBrokerTeamlead') }}',
            type: 'POST',
            data: {
                id: userId,
                teamlead: teamleadId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Team lead updated successfully');
                location.reload(); // Reload the page to reflect the changes
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
</script>

<style>
/* Loader Overlay Styles */
#loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.loader-content {
    text-align: center;
}

.loader-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
}
</style>
@endsection