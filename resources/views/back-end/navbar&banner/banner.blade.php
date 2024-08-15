@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h5>Update Banner</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.banner') }}" method="POST" enctype="multipart/form-data" id="banner_form">
                            @csrf
                            <input type="hidden" name="banner_id" id="banner_id" value="{{$banner_info->id}}">
                            <div class="mb-3">
                                <label class="form-label">Sub Title</label>
                                <input type="text" name="sub_title" class="form-control" id="sub_title" value="{{ $banner_info->sub_title }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ $banner_info->title }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" name="desp" class="form-control" id="desp" value="{{ $banner_info->desp }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Banner Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                                <div id="current_image_display">
                                    @if ($banner_info->image)
                                        <p>Current Image: {{ $banner_info->image }}</p>
                                    @endif
                                </div>
                                @error('image')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6 m-auto">
                                    <div class="mb-3">
                                        <button class="btn bg-primary text-white form-control">Update Banner</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_script')
{{-- <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>

$(document).on('click', '.up_banner', function(e) {
    e.preventDefault();

    let formData = new FormData($('#banner_form')[0]);

    $.ajax({
        url: "{{ route('update.banner') }}",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            if(res.status == 'success') {
                $('#banner_form')[0].reset();
                $('.banner_table').load(location.href + ' .banner_table');
            }
        },
        error: function(err) {
            $('.error_message').html('');
            let error = err.responseJSON;

            $.each(error.errors, function(index, value) {
                $('.error_message').append('<span class="text-danger">' + value + '</span>');
            });
        }
    });
});

    
</script> --}}
@endsection