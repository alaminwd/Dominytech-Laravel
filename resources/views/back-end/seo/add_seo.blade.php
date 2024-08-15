@extends('layouts.dashboard');

<style>
    /* Custom toastr styles */
    .toast-warning {
        background-color: #f0ad4e !important;  /* Customize background color */
        color: #fff !important;  /* Customize text color */
    }
    .toast-error {
        background-color: #be4a55 !important;  /* Customize background color */
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Add SEO</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('add.seo')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body row">
                                <div class="form-group col-md-4">
                                    <label for="type">Select Type</label>
                                    <select class="form-control select2" name="type" id="type"
                                        data-placeholder="Select Type">
                                        <option selected>Select Type</option>
                                        <option value="1">Static</option>
                                        <option value="2">Product</option>
                                        <option value="3">Category</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter Title" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        placeholder="Enter Slug" value="">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="author">Author</label>
                                    <input type="text" class="form-control" id="author" name="author"
                                        placeholder="Enter Author" value="{{ old('author') }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="keywords">Keywords</label>
                                    <div class="myContainer"></div>
                                    <input type="text" class="form-control inputTags" id="keywords"
                                        name="keywords" placeholder="Enter Keywords" value="">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="canonical">Canonical</label>
                                    <input type="text" class="form-control" id="canonical" name="canonical"
                                        placeholder="Enter Canonical" value="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="og_locale">Og Locale</label>
                                    <input type="text" class="form-control" id="og_locale" name="og_locale"
                                        placeholder="Enter Og Locale" value="">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="og_url">Og Url</label>
                                    <input type="text" class="form-control" id="og_url" name="og_url"
                                        placeholder="Enter Og Url" value="">
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="og_type">Og Type</label>
                                    <input type="text" class="form-control" id="og_type" name="og_type"
                                        placeholder="Enter Og Type" value="">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control photoUpload" id="image" name="image"
                                        placeholder="Choose Image">
                                    <div>
                                        <img src="" class="previewHolder" alt="">
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="ckeditor">Description</label>
                                    <textarea type="text" class="form-control textEditor" rows="10" name="description" placeholder="Enter Description"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>

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
    //   @if(Session::has('invalid'))
    //         toastr.options =
    //         {
    //             "closeButton": true,
    //             "progressBar": true,
    //             "positionClass": "toast-bottom-right",
    //         }
    //                 toastr.success("{!! session('invalid') !!}");
    //     @endif

    @if ($errors->any())
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "timeOut": "5000",
            };

            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif

</script>
@endsection