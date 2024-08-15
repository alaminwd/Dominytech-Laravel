@extends('layouts.dashboard')

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
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header" style="background:#0B2A97 ">
                        <h4 class="text-white text-center">Update Banner</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.footer')}}" method="POST" id="footerForm">
                            @csrf
                            <input type="hidden" name="id" value="{{ $footer_info->id }}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="text" name="email" class="form-control" value="{{ $footer_info->email }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $footer_info->phone }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description" rows="5" placeholder="Max 100 characters">{{ $footer_info->desp }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 m-auto">
                                <div class="mb-3">
                                    <button type="submit" class="btn text-white form-control" id="submitBtn" style="background:#0B2A97">Update Info</button>
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