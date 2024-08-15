@extends('layouts.dashboard');

<style>
    /* Custom toastr styles */
    .toast-warning {
        background-color: #f0ad4e !important;  /* Customize background color */
        color: #fff !important;  /* Customize text color */
    }
    .toast-error {
        background-color: #e3911e !important;  /* Customize background color */
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
            <div class="col-lg-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Content</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pt-3">
                            <form id="add_form" action="{{route('update.content')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">SubTitle</label>
                                    <input type="text" name="sub_title"  class="form-control" value="{{$contact->sub_title}}">
                                    <input type="hidden" name="id"  class="form-control" value="{{$contact->id}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title"  class="form-control" value="{{$contact->title}}"> 
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" class="form-control" value="{{$contact->desp}}">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100" id="updatecontent">Update Content</button>
                                </div>
                            </form>
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
         @if(Session::has('error'))
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
            }
                    toastr.error("{!! session('error') !!}");
        @endif
         @if(Session::has('success'))
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
            }
                    toastr.success("{!! session('success') !!}");
        @endif
</script>
@endsection