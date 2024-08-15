@extends('layouts.dashboard')

<style>
    /* Custom toastr styles */
    .toast-warning {
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center">All Review List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive pt-3">
                                    <table class="table table-hover review_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Profession</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reviews as $sl=>$review )
                                            <tr class="text-center">
                                                <td>{{$sl+1}}</td>
                                                <td>{{$review->name}}</td>
                                                <td>{{$review->profession}}</td>
                                                <td> <img width="100" height="60" style="border-radius: 50%" src="{{asset('upload/client')}}/{{$review->image}}" alt=""></td>
                                                <td>
                                                    <button data-id="{{$review->id}}" class="btn btn-danger delete_review"><svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center">Add Review</h4>
                            </div>
                            <div class="card-body">
                                <form id="add_form" action="{{route('add.review')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Profession</label>
                                        <input type="text" name="profession" id="profession" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Comment</label>
                                        <input type="text" name="comment" id="comment" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-100" id="addReview">Add Review</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
{!! Toastr::message() !!}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $(document).on('click', '#addReview', function(e){
        e.preventDefault();

        let name = $('#name').val();
        let profession = $('#profession').val();
        let comment = $('#comment').val();
        let image = $('#image')[0].files[0]; // Get the file
        let _token = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token

        if (!name || !profession || !comment || !image) {
            toastr.warning("Please fill all fields!", "Warning!", {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
            return false;
        }
        
        let formData = new FormData();
        formData.append('name', name);
        formData.append('profession', profession);
        formData.append('comment', comment);
        formData.append('image', image);
        formData.append('_token', _token);

        $.ajax({
            url: "{{route('add.review')}}",
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res){
                if (res.status === 'success') {
                    $('#add_form')[0].reset();
                    $('.review_table').load(location.href + ' .review_table');
                    toastr.success("Review added successfully!", "Success!", {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
                } else {
                    toastr.error(res.message, "Error!", {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
                }
            },
            error: function(xhr, status, error) {
                let err = JSON.parse(xhr.responseText);
                toastr.error(err.message, "Error!", {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            }
        });
    });
</script>

<script>
    $(document).on('click', '.delete_review', function(e){
        e.preventDefault();

        let review_id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('delete.review') }}", 
                    method: 'POST', 
                    data: {
                        _token: "{{ csrf_token() }}",
                        review_id: review_id,
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            $('.review_table').load(location.href + ' .review_table', function() {
                                Swal.fire(
                                    'Deleted!',
                                    'The review has been deleted.',
                                    'success'
                                );
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an issue deleting the review.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the review.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>


@endsection