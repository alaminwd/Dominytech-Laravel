@extends('layouts.dashboard')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* Custom toastr styles */
    .toast-warning {
        background-color: #f0ad4e !important;  /* Customize background color */
        color: #fff !important;  /* Customize text color */
    }
    .toast-error {
        background-color: #ff3366 !important;  /* Customize background color */
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
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4> Social Icon</h4>
                    {{-- <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary ">Add Category</button> --}}
                
                </div>
                <div class="card-body">
                    <div class="table-responsive pt-3">
                        <table class="table table-hover icon_table">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Icon</th>
                                    <th>Icon Link</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($icons as $sl=>$icon )
                                <tr class="text-center">
                                    <td>{{$sl+1}}</td>
                                    <td>{{$icon->icon}}</td>
                                    <td>{{$icon->icon_link}}</td>
                                    <td><a href="{{route('update.status', $icon->id)}}" class="btn btn-{{$icon->status == 0 ? 'light':'success'}}">{{$icon->status == 0 ? 'inactive':'active'}}</a></td>    
                                    <td>
                                        <button data-id="{{$icon->id}}" class="btn btn-danger delete_icon"><svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="height: auto !important">
                <div class="card-header">
                    <h6 class="card-title">Add Social Icon</h6>
                </div>
                <div class="card-body">
                    @php
                    $fonts = array(
                        'fa-brands fa-facebook-f',
                        'fa-brands fa-twitter',
                        'fa-brands fa-linkedin-in',
                        'fa-brands fa-instagram',
                        'fa-solid fa-globe',
                        // 'fa fa-youtube',
                        // 'fa fa-basketball',
                        // 'fa fa-behance',
                    );
                    @endphp
                    <form class="forms-sample" id="add_icon_form" action="{{ route('add.icon') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                        @foreach ($fonts as $font)
                            <i style="font-size: 24px; margin-right: 10px; color: red; cursor: pointer;" class="{{$font}} fa"></i>
                        @endforeach
                        </div>
                        <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="icon" required>
                        </div>
                        <div class="form-group">
                        <label for="icon_link">Icon Link</label>
                        <input type="url" class="form-control" id="icon_link" name="icon_link" placeholder="icon link" required>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 w-100 add_icon">Add Icon</button>
                    </form>
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
    $('.fa').click(function() {
        let icon = $(this).attr('class');
        $('#icon').val(icon);
    });

    $(document).on('click', '.add_icon', function(e) {
        e.preventDefault();

        let formData = $('#add_icon_form').serialize();

        $.ajax({
            url: "{{ route('add.icon') }}",
            method: 'post',
            data: formData,
            success: function(res) {
                if (res.status === 'success') {
                    $('.icon_table').load(location.href + ' .icon_table'),
                    $('#add_icon_form')[0].reset();
                    toastr.success("Icon added successfully!", "Success!", {
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
                let errorMessage = xhr.status + ': ' + xhr.statusText;
                toastr.error('Error - ' + errorMessage, "Error!", {
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
      $(document).on('click', '.delete_icon', function(e){
        e.preventDefault();
        let icon_id = $(this).data('id');
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
                    url: "{{ route('delete.icon') }}", // Make sure this route expects a POST/DELETE request
                    method: 'POST', // Use POST or DELETE
                    data: {
                        _token: "{{ csrf_token() }}", // Include CSRF token
                        icon_id: icon_id
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            $('.icon_table').load(location.href + ' .icon_table', function() {
                                Swal.fire(
                                    'Deleted!',
                                    'The user has been deleted.',
                                    'success'
                                );
                            });
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'There was a problem deleting the user.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>
    
<script>
    
    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
        }
            toastr.success("{!! session('success') !!}");
    @endif
    @if(Session::has('limit'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
        }
            toastr.error("{!! session('limit') !!}");
    @endif

  
</script>

@endsection