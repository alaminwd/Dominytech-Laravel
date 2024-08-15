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
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4>Message Notification</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pt-3">
                            <table class="table table-hover message_table">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $sl=>$message )
                                    <tr class="text-center">
                                        <td>{{$sl+1}}</td>
                                        <td>{{$message->name}}</td>
                                        <td>{{$message->email}}</td>
                                        <td>{{substr($message->desp, 0, 25)}}..</td>
                                        {{-- <td><a href="#" class="btn btn-{{$category->status == 0 ? 'light':'success'}}">{{$category->status == 0 ? 'inactive':'active'}}</a></td> --}}
                                       
                                        <td>
                                            <div class="dropdown mb-3">
                                                <a href="javascript:void(0)" class="more-button" data-toggle="dropdown" aria-expanded="false">
                                                    <svg width="6" height="26" viewBox="0 0 6 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 3C6 4.65685 4.65685 6 3 6C1.34315 6 0 4.65685 0 3C0 1.34315 1.34315 0 3 0C4.65685 0 6 1.34315 6 3Z" fill="#585858"></path>
                                                        <path d="M6 13C6 14.6569 4.65685 16 3 16C1.34315 16 0 14.6569 0 13C0 11.3431 1.34315 10 3 10C4.65685 10 6 11.3431 6 13Z" fill="#585858"></path>
                                                        <path d="M6 23C6 24.6569 4.65685 26 3 26C1.34315 26 0 24.6569 0 23C0 21.3431 1.34315 20 3 20C4.65685 20 6 21.3431 6 23Z" fill="#585858"></path>
                                                    </svg>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <form action="{{ route('notifications.view') }}"  method="GET">
                                                        @csrf
                                                        <button class="dropdown-item" type="submit" name="message_id" value="{{$message->id}}">View</button>
                                                     </form>
                                                     <button type="submit" data-id="{{$message->id}}" id="deleteMessage" class="dropdown-item">Delete</button> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td>{{$messages->links()}}</td>
                                    </tr>
                                </tbody>
                            </table>
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
    $(document).on('click', '#deleteMessage', function(e){
        e.preventDefault();
        let notification_id = $(this).data('id');
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
                    url: "{{ route('delete.notification.message') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        notification_id: notification_id
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            $('.message_table').load(location.href + ' .message_table', function() {
                                Swal.fire(
                                    'Deleted!',
                                    'The Message has been deleted.',
                                    'success'
                                );
                            });
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'There was a problem deleting the Message.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>
{{-- <script>
    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        message_paginate(page);
    });

    function message_paginate(page){
        $.ajax({
            url: "/pagination/paginate-data?page=" + page,
            success: function(res){
                $('.table-data').html(res);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
            }
        });
    }
</script> --}}




@endsection