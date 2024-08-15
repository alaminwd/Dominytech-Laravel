@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card" style="height: auto !important">
                    <div class="card-header">
                        <h4 class="card-title">Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('update.profile')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Username</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{auth::user()->name}}">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{auth::user()->email}}">
                                
                                </div>
                                <button type="submit" class="btn btn-primary mr-2 w-100 update_profile">Update Profile</button>
                                {{-- <div class="form-group">
                                    <input type="text" class="form-control input-default " placeholder="input-default">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-rounded" placeholder="input-rounded">
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Update Password</h6>
                </div>
                {{-- @if (session('old_wrong'))
                    <div class="alert alert-success">{{session('old_wrong')}}</div>
                @endif --}}
                <div class="card-body">
                    <div class="error-password"></div>
                    <div class="update-success mb-3"></div>
                    <form class="forms-sample" action="{{route('update.password')}}" method="POST" id="update_Form">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="old password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="password confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 w-100 update_password">Save Password</button>
                    </form>
                </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card" style="height: auto !important">
                    <div class="card-header">
                        <h6 class="card-title">Upload Image</h6>
                    </div>
                    <div class="card-body">
                        <div class="invalid_image"></div>
                        <div class="img_success mb-3"></div>
                        <form class="forms-sample" id="image_Form" action="{{route('update.image')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" placeholder="upload image">
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 w-100 upload_image">Save Image</button>
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


    {{-- update profile --}}

    <script>
        $(document).on('click', '.update_profile', function (para) {
            para.preventDefault();
            let name = $('#name').val();
            let email = $('#email').val();

            $.ajax({
                url:"{{route('update.profile')}}",
                method:'post',
                data:{name:name, email:email},
                success:function(res){
                    if(res.status == 'sucess'){
                        
                    }
                },
                error:function(err){
                    $('.error-message').html('');
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value){
                        $('.error-message').append(' <span class="text-danger">'+value+'</span> ');
                    })
                }
            });

        });
    </script>


    {{-- Update Password --}}

    <script>
       
        $(document).on('click', '.update_password', function (e) {
            e.preventDefault();
            let old_password = $('#old_password').val();
            let password = $('#password').val();
            let password_confirmation = $('#password_confirmation').val();
          

            $.ajax({
                url:"{{route('update.password')}}",
                method:'post',
                data:{old_password:old_password, password:password, password_confirmation:password_confirmation},
               
                success:function(res){
                    if(res.status == 'success' && res.message == 'Password successfully updated'){
                        $('#update_Form')[0].reset();
                        $('.update-success').append('<span class="text-success alert-success" style="padding:8px 20px">' + res.message + '</span>');
                    }
                },
                error: function (err) {
                    $('.error-password').html('');
                    let errors = err.responseJSON;
                    $.each(errors, function (index, value) {
                        $('.error-password').append('<span class="text-danger">' + value + '</span>');
                    });
                   
                },
            });

        });
    </script>


    {{-- Update photo --}}

    <script>
        $(document).on('submit', '#image_Form', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
    
            $.ajax({
                url: "{{ route('update.image') }}",
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status === 'success') {
                        $('#image_Form')[0].reset();
                        $('.img_success').append('<span class="text-success alert-success" style="padding:8px 20px">' + res.message + '</span>');
                    }
                },
                error: function(invalidImage) {
                    $('.invalid_image').html('');
                    let error = invalidImage.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.invalid_image').append('<span class="text-danger">' + value + '</span>');
                    });
                }
            });
        });
    </script>





@endsection