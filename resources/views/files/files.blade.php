@extends('layouts.broker.app')

@section('content')
<style>
    .upload-document {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .upload-document h4 {
        background: #555555;
        padding: 6px 0;
        color: #fff;
        font-weight: 700;
        margin: 0;
        font-size: 16px;
        border-radius: 7px;
    }

    .upload-document h6 {
        text-align: center;
        font-size: larger;
        margin: 11px 0;
    }

    @media (min-width: 576px) {
        select.form-control,
        input#customer_city,
        input#customer_zip,
        input.form-control {
            height: 40px !important;
            font-size: 13px;
        }
    }

    .form-control {
        display: none;
    }

    .newbtn {
        cursor: pointer;
        width: 100%;
        text-align: center;
        border: 1px dashed #5a770d;
        padding: 2px 0;
        border-radius: 10px;
    }

    .newbtn i {
        font-size: 16px;
        color: #5a770d;
    }

    .newbtn p b {
        color: #5a770d;
        font-size: 12px;
    }

    .upload-document ul li {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 0 7px;
        list-style: none;
        margin-bottom: 16px;
        border-radius: 10px;
        display: flex;
        justify-content: space-between;
    }

    .upload-document ul {
        padding-inline-start: 0;
    }

    .form-label {
        font-size: 12px;
    }
</style>

<section>
    <div class="container mt-5">
        <div class="upload-document">
            <h4 style="text-align:center">Load Number: {{ $load->load_number }}</h4>

            @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form class="mt-4 mb-4" action="{{ route('files.upload.post', ['filesId' => $load->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @foreach ([
                        'carrer_rate_cnfrm_doc' => 'Carrier Rate Confirmation',
                        'pod_doc' => 'Pod',
                        'shipper_rate_approval_doc' => 'Shipper Rate Approval (Screen Shot)',
                        'carrier_invoice_doc' => 'Carrier Invoice'
                    ] as $field => $label)
                    <div class="mb-3 col-md-3 text-center">
                        <label for="{{ $field }}" class="form-label"><b>{{ $label }}</b></label>
                        <label class="newbtn">
                            <i class="fa fa-paperclip"></i>
                            <input class="form-control form-control-lg" name="{{ $field }}" id="{{ $field }}" type="file">
                            <p class="m-0"><b>Upload document</b></p>
                        </label>
                    </div>
                    @endforeach

                    <div class="mb-3 col-md-12 text-center">
                        <label for="optional_docs" class="form-label"><b>Optional for extra Documents (Multiple File Support using ctrl+select)</b></label>
                        <label class="newbtn">
                            <i class="fa fa-paperclip"></i>
                            <input class="form-control form-control-lg" name="optional_docs[]" id="optional_docs" type="file" multiple>
                            <p class="m-0"><b>Upload document</b></p>
                        </label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-info" style="padding: 5px 19px;">Save File</button>
                </div>
            </form>

            <!-- Display Uploaded Files in Iframes -->
            @if (!empty($uploadedFiles))
            <div class="mt-3">
                <h5 class="mb-2"><b>Uploaded Files:</b></h5>
                <ul>
                    @foreach ($uploadedFiles as $field => $fileArray)
                        @if (is_array($fileArray))
                            @foreach ($fileArray as $subFile)
                                <li>
                                    <a href="{{ asset('storage/' . $subFile) }}" target="_blank" style="padding: 11px 0;">
                                        {{ basename($subFile) }}
                                    </a>
                                    <iframe src="{{ asset('storage/' . $subFile) }}" width="100%" style="display: contents; border:none;"></iframe>
                                    <button class="delete-file btn btn-danger" data-key="{{ $field }}" data-file="{{ $subFile }}" data-record-id="{{ $load->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
            @else
            <p style="color: red; padding: 10px; border-radius: 10px;">
                No Document Uploaded Yet. Please Upload The Document Accordingly.
            </p>
            @endif

        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-file').on('click', function(e) {
            e.preventDefault();

            var button = $(this);
            var fileKey = button.data('key');
            var filePath = button.data('file');
            var recordId = button.data('record-id');

            if (confirm('Are you sure you want to delete this file?')) {
                $.ajax({
                    url: '{{ route('delete.file.broker') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        record_id: recordId,
                        file_name: filePath
                    },
                    success: function(response) {
                        if (response.success) {
                            button.closest('li').remove();
                        } else {
                            alert('Failed to delete the file.');
                        }
                    },
                    error: function(response) {
                        alert('An error occurred while trying to delete the file.');
                    }
                });
                location.reload();
            }
        });
    });
</script>
@endsection
