{{-- @extends('layouts.dashboard')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Basic Form</h6>
                    <form class="forms-sample" id="blogForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Class</label>
                            <input type="text" class="form-control" name="class">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Project Category</label>
                            <input type="text" class="form-control" name="category">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" class="form-control" name="slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Client Name</label>
                            <input type="text" class="form-control" name="client">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Short Description</label>
                            <input class="form-control" name="short_desp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Project Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <button type="button" id="submitBtn" class="btn btn-primary mr-2 w-50">Add Project</button>
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
@endsection --}}


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
  <div class="modal fade" id="AddprojectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="blog_Form" enctype="multipart/form-data" action="{{route('add.project')}}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Class</label>
                        {{-- <input type="text" class="form-control" name="class" id="class"> --}}
                        <select name="class" id="class">
                            <option value="0">--select any--</option>
                            <option value="uidesign">UI/UX Design</option>
                            <option value="wordpress">Wordpress</option>
                            <option value="webdesign">Web Design</option>
                            <option value="webdevelopment">Web Development</option>
                        </select>
                    </div>
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
                    <div class="form-group">
                        <label for="exampleInputEmail1">Client Name</label>
                        <input type="text" class="form-control" name="client" id="client">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Location</label>
                        <input type="text" class="form-control" name="location" id="location">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Short Description</label>
                        <textarea class="form-control" name="short_description" id="short_description" rows="5" placeholder="Max 255 character"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Upload Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_project">Save changes</button>
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
</body>
</html>
