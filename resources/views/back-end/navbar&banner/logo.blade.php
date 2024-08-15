@extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Inverse table</h4>
                    <p class="card-description">
                        Add class <code>.table-dark</code>
                    </p>
                    <div class="table-responsive pt-3">
                        <table class="table table-hover logo_table">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Logo Name</th>
                                    <th>Logo Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logos as $sl=>$logo )
                                <tr class="text-center">
                                    <td>{{$sl+1}}</td>
                                    <td>{{$logo->logo_name}}</td>
                                        {{-- <img src="{{asset('upload/logo')}}/{{$logo->logo}}" width="100px" alt=""> --}}
                                    <td><img width="60" src="{{asset('upload/logo')}}/{{$logo->logo}}" alt=""></td>
                                    <td>
                                        {{-- <button class="btn btn-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </button> --}}

                                        <button class="btn btn-danger delete_logo" data-id="{{ $logo->id }}" ><svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Add Logo</h6>
                </div>
                <div class="error_message"></div>
                <div class="logo_upload_success"></div>
                <div class="card-body">
                    
                    {{-- <div class="img_success mb-3"></div> --}}
                    <form class="forms-sample " action="{{route('add.logo')}}" method="post" id="add_logo" enctype="multipart/form-data" >
                        @csrf
                            <div class="mb-3">
                                <label>Logo Name</label>
                                <input type="text" class="form-control" id="logo_name" name="logo_name">
                            </div>
                            <div class="mb-3">
                                <label>Logo Image</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Add Logo</button>
                            </div>
                    </form>
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
    $(document).on('submit', '#add_logo', function(e){
        e.preventDefault();
        
        let formData = new FormData(this);
    
        $.ajax({
            url: "{{ route('add.logo') }}",
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res.status === 'success') {
                    $('#add_logo')[0].reset();
                    $('.logo_table').load(location.href + ' .logo_table', function(){
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Your Logo successfully updated",
                            showConfirmButton: false,
                            timer: 1500
                            });
                    });
                    // $('.logo_upload_success').append('<span class="text-success alert-success" style="padding:8px 20px">' + res.message + '</span>');
                }
            },
            error: function(invalidImage) {
                $('.error_message').html('');
                let error = invalidImage.responseJSON;
                $.each(error.errors, function(index, value) {
                    $('.error_message').append('<span class="text-danger">' + value + '</span>');
                });
            }
        });
    });
</script>


<script>
    $(document).on('click', '.delete_logo', function (event) {
        event.preventDefault();
        let logo_id = $(this).data('id');
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
                    url: "{{ route('logo.delete') }}", // Make sure this route expects a POST/DELETE request
                    method: 'POST', // Use POST or DELETE
                    data: {
                        _token: "{{ csrf_token() }}", // Include CSRF token
                        logo_id: logo_id,
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            $('.logo_table').load(location.href + ' .logo_table', function() {
                                Swal.fire(
                                    'Deleted!',
                                    'The logo has been deleted.',
                                    'success'
                                );
                            });
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'There was a problem deleting the Logo.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>

@endsection