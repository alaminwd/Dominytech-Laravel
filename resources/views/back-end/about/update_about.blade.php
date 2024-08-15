@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 grid-margin stretch-card">
                <div class="card" style="height: auto !important">
                <div class="card-header">
                    <h6 class="card-title">Update About Information</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3 error-message"></div>
                    <form class="forms-sample about_form" action="{{route('update.about.content')}}"  method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$about_info->title}}">
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea name="desp" id="desp" class="form-control" style="height: 144px;" value="">{{$about_info->desp}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Total Project</label>
                            <input type="number" class="form-control" id="project" name="project" value="{{$about_info->project}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Happy Clients</label>
                            <input type="number" class="form-control" id="client" name="client" value="{{$about_info->client}}">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 w-100 update_content">Update About</button>
                    </form>
                </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin">
                <div class="card" style="height: auto !important">
                <div class="card-header">
                    <h6 class="card-title">Upload About Image</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3 invalid_image"></div>
                    <form class="forms-sample" action="{{route('update.about.image')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">About Image</label>
                            <input type="file" class="form-control" id="main_image" name="main_image">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Side Image</label>
                            <input type="file" class="form-control" id="side_image" name="side_image">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 w-100 upload_image">Upload Image</button>
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
    $(document).on('click', '.upload_image', function(e){
        e.preventDefault();
        let formData = new FormData();
        formData.append('main_image', $('#main_image')[0].files[0]);
        formData.append('side_image', $('#side_image')[0].files[0]);
      
        $.ajax({
        url: "{{ route('update.about.image') }}",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(res) {
            if (res.status === 'success') {
                alert(res.message);
                // You can reset the form or update the UI here
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
    
<script>
    $(document).on('click', '.update_content', function(e){
        e.preventDefault();
            let title = $('#title').val();
            let desp = $('#desp').val();
            let project = $('#project').val();
            let client = $('#client').val();

            $.ajax({
                url:"{{route('update.about.content')}}",
                method:'post',
                data:{title:title, desp:desp, project:project, client:client},
                success:function(res){
                    if(res.status == 'sucess'){
                        $('.about_form').load(location.href + ' .about_form', function() {
                                Swal.fire(
                                    'Deleted!',
                                    'The logo has been deleted.',
                                    'success'
                                );
                            });
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

@endsection