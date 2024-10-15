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
    ul#fileList li {
    padding: 9px 12px;
    border-radius: 7px;
    margin-bottom: 18px;
    box-shadow: 0 4px 8px 0 rgb(0 0 0 / 10%), 0 6px 20px 0 rgb(0 0 0 / 4%);
    display: flex;
    justify-content: space-between;
}
ul#fileList li a{
    color:#000;
}
ul#fileList li .fa{
    position: absolute;
    right: 19px;
    top: 17px;
}
#fileViewModal .modal-header {
    background: #555;
    padding: 10px 28px !important;
    color: #fff;
    font-size: 13px;
}
#fileViewModal .close {
    color: #ffffff !important;
    top: 15px !important;
}
#fileList img {
    margin-right: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.modal.fade.show {
    background: #00000075;
}
.form-group label{
    margin-bottom: 0;
    font-weight: 600;
    text-align: left;
    font-size: 13px;
    color: #4a4a4a;
}
.modal-open .modal {
    background: #0000007d;
}
</style>

<section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Vendor System</h2>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-responsive dataTable no-footer" id="dataTable">
              <button type="button" style="float: unset;padding: 8px 9px !important;margin-top: 3px;" class="btn btn-success toggleBlurButton"><i class="fa fa-eye"></i></button>
                <thead>
                    <tr>
                        <th>Load#</th>
                        <th>Customer</th>
                        <th>Carrier</th>
                        <th>Status</th>
                        <th>Load Created</th>
                        <th>Dispatcher</th>
                        <th>Due Date</th>
                        <th>Quick Pay %</th>
                        <th>Payment Method</th>
                        <th>Ready to Pay</th>
                        <th>Carrier Payment</th>
                        <th>Carrier Paid Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendormanagement as $vendor)
                    <tr>
                        <td class="dynamic-data">{{ $vendor->load_number }}</td>
                        <td class="dynamic-data">{{ $vendor->load_bill_to }}</td>
                        <td class="dynamic-data">{{ $vendor->load_carrier }}</td>
                        <td class="dynamic-data">{{ $vendor->load_status }}</td>
                        <td class="dynamic-data">{{ $vendor->created_at }}</td>
                        <td class="dynamic-data">{{ $vendor->user->name }}</td>
                        <td class="dynamic-data">
                            @if($vendor->load_carrier_due_date != '' && $vendor->load_carrier_due_date != 'null') 
                                {{ $vendor->load_carrier_due_date }}
                            @else
                                <input type="date" class="load_carrier_due_date" name="load_carrier_due_date" value="{{ $vendor->load_carrier_due_date }}" data-id="{{ $vendor->id }}">
                            @endif
                        </td>
                        <td class="dynamic-data">
                            <select style="width: 100%;" name="quick_pay" class="quick_pay" data-id="{{ $vendor->id }}">
                                <option value="{{ $vendor->quick_pay }}">{{ $vendor->quick_pay ?? 'Please Select Quick Pay' }}</option>
                                <option value="6%">6%</option>
                                <option value="4%">4%</option>
                            </select>
                        </td>
                        <td class="dynamic-data">
                            <select style="width: 100%;" name="payment_method" class="payment_method" data-id="{{ $vendor->id }}">
                                <option value="{{ $vendor->payment_method }}">{{ $vendor->payment_method ?? 'Please Select Payment Method' }}</option>
                                <option value="ACH">ACH</option>
                                <option value="Quick Pay">Quick Pay</option>
                                <option value="OTR">OTR</option>
                                <option value="Zelle">Zelle</option>
                                <option value="Check">Check</option>
                                <option value="Wire">Wire</option>
                                <option value="Buyout">Buyout</option>
                            </select>
                        </td>
                        <td class="dynamic-data">
                            <select style="width: 100%;" name="ready_to_pay" class="ready_to_pay" data-id="{{ $vendor->id }}">
                                <option value="{{ $vendor->ready_to_pay }}">{{ $vendor->ready_to_pay ?? 'Please Select Ready to Pay' }}</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="Hold">Hold</option>
                            </select>
                        </td>
                        <td class="dynamic-data">
                            @if ($vendor->carrier_mark_as_paid != 'Paid')
                                <input type="checkbox" class="carrier_mark_as_paid" name="carrier_mark_as_paid" data-id="{{ $vendor->id }}" {{ $vendor->carrier_mark_as_paid == 'Paid' ? 'checked' : '' }}>
                            @else
                                Paid
                            @endif
                        </td>
                        <td class="dynamic-data">{{ $vendor->load_carrier_due_date_on }}</td>
                        <td class="dynamic-data text-center">
                            <button type="button" style="background: none;padding: 8px 7px;" class="btn" data-toggle="modal" data-target="#fileUploadModal" data-id="{{ $vendor->id }}" data-load_number="{{ $vendor->load_number }}">
                               <i class="fa fa-paperclip" style="font-size: 16px; color: #ce8d05;"></i>
                            </button>
                            <button type="button" style="background: none;padding: 8px 7px;" class="btn" data-toggle="modal" data-target="#edit-detail">
                                <i class="fa fa-edit" style="font-size: 16px; color: #0DCAF0;"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal" id="edit-detail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Edit</b></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body p-0">
         <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Due Date</label>
                            <input type="date" class="load_carrier_due_date" name="load_carrier_due_date" value="{{ $vendor->load_carrier_due_date }}" data-id="{{ $vendor->id }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quick Pay</label>
                            <select style="width: 100%;" name="quick_pay" class="quick_pay" data-id="{{ $vendor->id }}">
                                <option value="{{ $vendor->quick_pay }}">{{ $vendor->quick_pay ?? 'Please Select Quick Pay' }}</option>
                                <option value="6%">6%</option>
                                <option value="4%">4%</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select style="width: 100%;" name="payment_method" class="payment_method" data-id="{{ $vendor->id }}">
                                <option value="{{ $vendor->payment_method }}">{{ $vendor->payment_method ?? 'Please Select Payment Method' }}</option>
                                <option value="ACH">ACH</option>
                                <option value="Quick Pay">Quick Pay</option>
                                <option value="OTR">OTR</option>
                                <option value="Zelle">Zelle</option>
                                <option value="Check">Check</option>
                                <option value="Wire">Wire</option>
                                <option value="Buyout">Buyout</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ready to Pay</label>
                            <select style="width: 100%;" name="ready_to_pay" class="ready_to_pay" data-id="{{ $vendor->id }}">
                                <option value="{{ $vendor->ready_to_pay }}">{{ $vendor->ready_to_pay ?? 'Please Select Ready to Pay' }}</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="Hold">Hold</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
         </div>
      </div>
      <div class="text-center mb-3">
        <!-- <button type="button" class="btn btn-info">Save</button> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>
   <!-- Modal -->
<div class="modal fade" id="fileUploadModal" tabindex="-1" role="dialog" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileUploadModalLabel"><b>Upload Carrier Documents</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fileUploadForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="load_number" id="load_number" value="">
                    <input type="file" name="carrierDoc[]" id="carrierDocs" multiple>
                    <div id="uploadedFiles"></div>
                    <a href="#" id="fetchUploadedFiles">Fetch Uploaded Files</a>
                </form>
            </div>
            <div class="text-center mb-3">
                <button type="button" class="btn btn-info" id="uploadFilesBtn">Upload Files</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Set CSRF token in AJAX header globally
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.load_carrier_due_date').change(function () {
            var date = $(this).val();
            var id = $(this).data('id'); // Retrieve the vendor ID from the data-id attribute

            $.ajax({
                url: '{{ route('update.load.date') }}',
                method: 'POST',
                data: {
                    id: id,
                    load_carrier_due_date: date
                },
                success: function (response) {
                    if (response.success) {
                        console.log('Date updated successfully');
                        // Disable the input field after successful update
                        $(this).prop('disabled', true);
                    } else {
                        console.error('Failed to update date');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error updating date:', xhr.responseText);
                    alert('Error updating date');
                }
            });
        });
    });
</script>



<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.carrier_mark_as_paid').change(function () {
            var isChecked = $(this).is(':checked');
            var id = $(this).data('id');

            $.ajax({
                url: '{{ route('update.load.checkbox') }}',
                method: 'POST',
                data: {
                    id: id,
                    carrier_mark_as_paid: isChecked ? 'Paid' : ''
                },
                success: function (response) {
                    if (response.success) {
                        console.log('Date and status updated successfully');
                    } else {
                        console.error('Failed to update date and status');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error updating date and status:', xhr.responseText);
                    alert('Error updating date and status');
                }
            });
        });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('select.quick_pay, select.payment_method, select.ready_to_pay').change(function() {
        var id = $(this).data('id');
        var quick_pay = $(this).closest('tr').find('.quick_pay').val();
        var payment_method = $(this).closest('tr').find('.payment_method').val();
        var ready_to_pay = $(this).closest('tr').find('.ready_to_pay').val();

        $.ajax({
            url: '{{ route("updateLoadDetails") }}', // Corrected URL with route helper
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                quick_pay: quick_pay,
                payment_method: payment_method,
                ready_to_pay: ready_to_pay
            },
            success: function(response) {
                // Handle success
                console.log('Data updated successfully');
            },
            error: function(response) {
                // Handle error
                console.log('Error updating data');
            }
        });
    });
});
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- <script>
    $(document).ready(function() {
        // When the modal is about to be shown
        $('#fileUploadModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var loadNumber = button.data('load_number'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('.modal-title').text('Upload Carrier Documents Load No. ' + loadNumber);
            modal.find('#load_number').val(loadNumber);
            modal.find('#fetchUploadedFiles').data('load_number', loadNumber);
        });

        // Upload files using AJAX
        $('#uploadFilesBtn').click(function(e) {
            e.preventDefault();
            var formData = new FormData($('#fileUploadForm')[0]);

            $.ajax({
                url: "{{ route('uploadCarrierDocs') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response.success);
                    $('#fileUploadModal').modal('hide');
                },
                error: function(response) {
                    alert('Error uploading files');
                }
            });
        });

        // Fetch uploaded files using AJAX
        $('#fetchUploadedFiles').click(function(e) {
            e.preventDefault();
            var loadNumber = $(this).data('load_number');

            $.ajax({
                url: "{{ route('fetchUploadedFiles') }}", // Ensure you have this route set up
                type: 'GET',
                data: { load_number: loadNumber },
                success: function(response) {
                    $('#uploadedFiles').html(response);
                },
                error: function(response) {
                    alert('Error fetching files');
                }
            });
        });
    });
</script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script>
$(document).ready(function() {
    // When the modal is about to be shown
    $('#fileUploadModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var loadNumber = button.data('load_number');
        var modal = $(this);
        modal.find('.modal-title').text('Upload Carrier Documents Load No. ' + loadNumber);
        modal.find('#load_number').val(loadNumber);
        modal.find('#fetchUploadedFiles').data('load_number', loadNumber);
        fetchUploadedFiles(loadNumber);
    });

    // Upload files using AJAX
    $('#uploadFilesBtn').click(function(e) {
        e.preventDefault();
        var loadNumber = $('#load_number').val();
        var formData = new FormData($('#fileUploadForm')[0]);

        $.ajax({
            url: "{{ route('uploadCarrierDocs') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.success);
                fetchUploadedFiles(loadNumber);
            },
            error: function(response) {
                alert('Error uploading files: ' + response.responseJSON.error);
            }
        });
    });

    // Fetch uploaded files using AJAX
    function fetchUploadedFiles(loadNumber) {
        $.ajax({
            url: "{{ route('fetchUploadedFiles') }}",
            type: 'GET',
            data: { load_number: loadNumber },
            success: function(response) {
                var fileList = '';
                response.files.forEach(function(file) {
                    var fileType = file.type;
                    var isImageOrPdf = fileType === 'image/jpeg' || fileType === 'image/png' || fileType === 'application/pdf';

                    // Add a delete icon for each file
                    fileList += '<li>' + file.name + 
                        (isImageOrPdf ? ' <a href="' + file.url + '" target="_blank">View</a>' : ' <span class="text-danger">(Not supported)</span>') +
                        ' <i class="fas fa-trash delete-file" data-load_number="' + loadNumber + '" data-file_name="' + file.name + '" style="cursor: pointer; color: red;" title="Delete"></i>' +
                        '</li>';
                });
                $('#uploadedFiles').html('<ul>' + fileList + '</ul>');
            },
            error: function(response) {
                alert('Error fetching files');
            }
        });
    }

    // Delete file functionality
    $(document).on('click', '.delete-file', function() {
        var loadNumber = $(this).data('load_number');
        var fileName = $(this).data('file_name');

        if (confirm('Are you sure you want to delete this file?')) {
            $.ajax({
                url: "{{ route('deleteUploadedFile') }}",
                type: 'DELETE',
                data: {
                    load_number: loadNumber,
                    file_name: fileName,
                    _token: $('input[name="_token"]').val() // Include CSRF token
                },
                success: function(response) {
                    alert(response.success);
                    fetchUploadedFiles(loadNumber); // Refresh the uploaded files
                },
                error: function(response) {
                    alert('Error deleting file: ' + response.responseJSON.error);
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