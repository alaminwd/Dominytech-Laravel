<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('back-end/vendors/core/core.css') }}">
	<!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('back-end/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('back-end/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<!-- endinject -->
  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{ asset('back-end/css/demo_1/style.css') }}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{ asset('back-end/images/favicon.png') }}" />
</head>
<body>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="blog_Form" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">--select category--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug">
                        <span class="full-slug-show">https://dominyteach.com/</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Short Description</label>
                        <textarea class="form-control" name="short_description" id="short_description" rows="5" placeholder="Max 100 character"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Long Description</label>
                        <textarea class="form-control long_desp" name="long_description" id="long_description" rows="5" placeholder="Max 250 character"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_blog">Save changes</button>
                </div>
            </div>
        </div>
    </form>
  </div>

	<!-- core:js -->
	<script src="{{ asset('back-end/vendors/core/core.js') }}"></script>
	<!-- endinject -->
  <!-- plugin js for this page -->
  <script src="{{ asset('back-end/vendors/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('back-end/vendors/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('back-end/vendors/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('back-end/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('back-end/vendors/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('back-end/vendors/progressbar.js/progressbar.min.js') }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- end plugin js for this page -->
	<!-- inject:js -->
	<script src="{{ asset('back-end/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('back-end/js/template.js') }}"></script>
	<!-- endinject -->
  <!-- custom js for this page -->
  <script src="{{ asset('back-end/js/dashboard.js') }}"></script>
  <script src="{{ asset('back-end/js/datepicker.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  
	<!-- end custom js for this page -->


    <script>
        $(document).ready(function() {
            $('.long_desp').summernote();
        });
    </script>
</body>
</html>
