@extends('layouts.dashboard')


@section('content') 
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Recent Payments Queue</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th class="width80">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $sl=> $user )
                                    <tr>
                                        <td>{{$sl+1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if ($user->photo == null)
                                            <img width="60" height="60" style="border-radius: 50%" src="{{ Avatar::create($user->name)->toBase64()}}"/>
                                            @else
                                            <img width="60" height="60" style="border-radius: 50%" src="{{asset('upload/user')}}/{{$user->photo}}" alt="">
                                        @endif
                                        </td>
                                        <td>
                                            <button data-id="{{ $user->id }}" class="btn btn-danger delete_user">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
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

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $(document).on('click', '.delete_user', function (event) {
        event.preventDefault();
        let user_id = $(this).data('id');
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
                    url: "{{ route('user.delete') }}", // Make sure this route expects a POST/DELETE request
                    method: 'POST', // Use POST or DELETE
                    data: {
                        _token: "{{ csrf_token() }}", // Include CSRF token
                        user_id: user_id
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            $('.users_table').load(location.href + ' .users_table', function() {
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


@endsection