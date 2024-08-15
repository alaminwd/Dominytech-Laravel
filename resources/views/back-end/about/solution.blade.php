@extends('layouts.dashboard')
<style>
    /* Custom toastr styles */
    .toast-warning {
        background-color: #f0ad4e !important;  /* Customize background color */
        color: #fff !important;  /* Customize text color */
    }
    .toast-error {
        background-color: #f0ad4e !important;  /* Customize background color */
        color: #fff !important;  /* Customize text color */
    }
    .toast-success {
        background-color: #28a745 !important;  /* Customize background color */
        color: #fff !important;  /* Customize text color */
    }
  </style>
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('update.solution') }}" method="POST" id="solutionForm" enctype="multipart/form-data">
                            @csrf  
                            <div class="modal-header">
                                <h5 class="modal-title" id="categoryEditModal">Update Solution Contact Content</h5>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="id" value="{{ $solution->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $solution->title }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input type="text" class="form-control" name="desp" id="desp" value="{{ $solution->desp }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload Image</label>                 
                                    <input type="file" class="form-control" name="image" id="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                                <div class="mb-3">
                                    <img width="100" src="" id="blah" alt="">
                                </div>
                            </div>
                            <div class="modal-footer text-center d-block">
                                <button type="button" id="submitBtn" class="btn btn-primary w-50">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script>
    document.getElementById('submitBtn').addEventListener('click', function(event) {
        event.preventDefault();
        updateBlog();
    });

    function updateBlog() {
        let formData = new FormData(document.getElementById('solutionForm'));

        fetch('{{ route("update.solution") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(res => {
            if (res.status === 'error') {
                toastr.error(res.message.join('<br>'), "Error!", {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                });
            } else {
                toastr.success(res.message, "Success!", {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('An error occurred while updating the solution.', "Error!", {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            });
        });
    }
</script>
@endsection